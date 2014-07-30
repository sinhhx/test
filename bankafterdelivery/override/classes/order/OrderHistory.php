<?php
class OrderHistory extends OrderHistoryCore
{
	public function addWithemail($autodate = true, $template_vars = false, Context $context = null)
	{
		if (!$context)
			$context = Context::getContext();
		$order = new Order($this->id_order);
		$last_order_state = $order->getCurrentOrderState();
		$new_order_state = new OrderState($this->id_order_state, Configuration::get('PS_LANG_DEFAULT'));

		if (!$this->add($autodate))
			return false;

		$result = Db::getInstance()->getRow('
			SELECT osl.`template`, c.`lastname`, c.`firstname`, osl.`name` AS osname, c.`email`, os.`module_name`
			FROM `'._DB_PREFIX_.'order_history` oh
				LEFT JOIN `'._DB_PREFIX_.'orders` o ON oh.`id_order` = o.`id_order`
				LEFT JOIN `'._DB_PREFIX_.'customer` c ON o.`id_customer` = c.`id_customer`
				LEFT JOIN `'._DB_PREFIX_.'order_state` os ON oh.`id_order_state` = os.`id_order_state`
				LEFT JOIN `'._DB_PREFIX_.'order_state_lang` osl ON (os.`id_order_state` = osl.`id_order_state` AND osl.`id_lang` = o.`id_lang`)
			WHERE oh.`id_order_history` = '.(int)$this->id.' AND os.`send_email` = 1');
		if (isset($result['template']) && Validate::isEmail($result['email']))
		{
			$topic = $result['osname'];
			$data = array(
				'{lastname}' => $result['lastname'],
				'{firstname}' => $result['firstname'],
				'{id_order}' => (int)$this->id_order,
				'{order_name}' => $order->getUniqReference()
			);
			if ($template_vars)
				$data = array_merge($data, $template_vars);

			if ($result['module_name'])
			{
				$module = Module::getInstanceByName($result['module_name']);
				if (Validate::isLoadedObject($module) && isset($module->extra_mail_vars) && is_array($module->extra_mail_vars))
					$data = array_merge($data, $module->extra_mail_vars);
			}

			$data['{total_paid}'] = Tools::displayPrice((float)$order->total_paid, new Currency((int)$order->id_currency), false);
			$data['{order_name}'] = $order->getUniqReference();

			// An additional email is sent the first time a virtual item is validated
			$virtual_products = $order->getVirtualProducts();

			if ($virtual_products && (!$last_order_state || !$last_order_state->logable) && $new_order_state && $new_order_state->logable)
			{
				$assign = array();
				foreach ($virtual_products as $key => $virtual_product)
				{
					$id_product_download = ProductDownload::getIdFromIdProduct($virtual_product['product_id']);
					$product_download = new ProductDownload($id_product_download);
					// If this virtual item has an associated file, we'll provide the link to download the file in the email
					if ($product_download->display_filename != '')
					{
						$assign[$key]['name'] = $product_download->display_filename;
						$dl_link = $product_download->getTextLink(false, $virtual_product['download_hash'])
							.'&id_order='.$order->id
							.'&secure_key='.$order->secure_key;
						$assign[$key]['link'] = $dl_link;
						if ($virtual_product['download_deadline'] != '0000-00-00 00:00:00')
							$assign[$key]['deadline'] = Tools::displayDate($virtual_product['download_deadline'], $order->id_lang);
						if ($product_download->nb_downloadable != 0)
							$assign[$key]['downloadable'] = $product_download->nb_downloadable;
					}
				}
				$context->smarty->assign('virtualProducts', $assign);
				$context->smarty->assign('id_order', $order->id);
				$iso = Language::getIsoById((int)($order->id_lang));
				$links = $context->smarty->fetch(_PS_MAIL_DIR_.$iso.'/download-product.tpl');
				$tmp_array = array('{nbProducts}' => count($virtual_products), '{virtualProducts}' => $links);
				$data = array_merge ($data, $tmp_array);
				// If there's at least one downloadable file
				if (!empty($assign))
					Mail::Send((int)$order->id_lang, 'download_product', Mail::l('Virtual product to download', $order->id_lang), $data, $result['email'], $result['firstname'].' '.$result['lastname'],
						null, null, null, null, _PS_MAIL_DIR_, false, (int)$order->id_shop);
			}

			if (Validate::isLoadedObject($order)) {
				if ($order->module == 'bankafterdelivery' && (int)Configuration::get('PS_INVOICE') && $new_order_state->invoice && $order->invoice_number) {
					$pdf = new PDF($order->getInvoicesCollection(), PDF::TEMPLATE_INVOICE, Context::getContext()->smarty);
					$file_attachement['content'] = $pdf->render(false);
					$file_attachement['name'] = Configuration::get('PS_INVOICE_PREFIX', (int)$order->id_lang).sprintf('%06d', $order->invoice_number).'.pdf';
					$file_attachement['mime'] = 'application/pdf';
				} else
					$file_attachement = null;

				Mail::Send((int)$order->id_lang, $result['template'], $topic, $data, $result['email'], $result['firstname'].' '.$result['lastname'],
					null, null, $file_attachement, null, _PS_MAIL_DIR_, false, (int)$order->id_shop);
			}
		}

		return true;
	}
}
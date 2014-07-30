<?php
if (!defined('_PS_VERSION_'))
	exit;

class BankAfterDelivery extends PaymentModule
{
	private $_html = '';
	private $_postErrors = array();

	public $bank_info;
	//public $address;
	public $extra_mail_vars;
	public $btad_mail_languages = array('de', 'en');

	public $limitDisplay = array( /*0 => array(
			'shop'     => 4,
			'group'    => 1,
			'operator' => 'smaller',
			'amount'   => 150,
		),
		1 => array(
			'shop'     => 4,
			'group'    => 6,
			'operator' => 'larger',
			'amount'   => 200,
		),*/
	);

	public function __construct()
	{
		$this->name    = 'bankafterdelivery';
		$this->tab     = 'payments_gateways';
		$this->version = '1.0';
		$this->author  = 'Ceres';

		$this->currencies      = true;
		$this->currencies_mode = 'checkbox';

		$this->bank_info = Configuration::get('CERES_BTAD_BANK_INFO');

		parent::__construct();

		$this->displayName      = $this->l('Bank transfer after delivery (BTAD)');
		$this->description      = $this->l('Module for accepting payments by bank transfer after delivery.');
		$this->confirmUninstall = $this->l('Are you sure you want to delete your details ?');

		if ((!isset($this->bank_info) || empty($this->bank_info)))
			$this->warning = $this->l('\'Bank Info\' must be configured in order to use this module correctly.');
		if (!count(Currency::checkPaymentCurrencies($this->id)))
			$this->warning = $this->l('No currency set for this module');

		$this->extra_mail_vars = array('{CERES_BTAD_BANK_INFO}' => Configuration::get('CERES_BTAD_BANK_INFO'));
	}

	public function install()
	{
		if (!parent::install() ||
			!$this->registerHook('payment') ||
			!$this->registerHook('paymentReturn') ||
			!$this->registerHook('displayPDFInvoice') ||
			!$this->registerHook('actionValidateOrder'))
			return false;
		$this->createOrderState();
		return true;
	}

	public function createOrderState()
	{
		if (!Configuration::get('CERES_BTAD_OS_INIT')) {
			$orderState       = new OrderState();
			$orderState->name = $orderState->template = array();
			$mailTemplate     = 'btad_paymentafterdelivery';
			foreach (Language::getLanguages() as $language) {
				$orderState->name[$language['id_lang']] = 'Payment After Delivery - BTAD Payment';
				$orderState->template[$language['id_lang']] = $mailTemplate;
			}

			$orderState->send_email = true;
			$orderState->color      = 'lightblue';
			$orderState->hidden     = false;
			$orderState->delivery   = false;
			$orderState->logable    = true;
			$orderState->invoice    = false;
			$orderState->paid       = true;
			$orderState->module_name = $this->name;

			if ($orderState->add()) {
				Configuration::updateValue('CERES_BTAD_OS_INIT', (int)$orderState->id);
				foreach ($this->btad_mail_languages as $lang) {
					copy(_PS_MODULE_DIR_ . $this->name . '/mails/' . $lang . '/' . $mailTemplate . '.html', _PS_MAIL_DIR_ . $lang . '/' . $mailTemplate . '.html');
					copy(_PS_MODULE_DIR_ . $this->name . '/mails/' . $lang . '/' . $mailTemplate . '.txt', _PS_MAIL_DIR_ . $lang . '/' . $mailTemplate . '.txt');
				}
			}
		}

		if (!Configuration::get('CERES_BTAD_OS_AWAITING_PAYMENT')) {
			$orderState       = new OrderState();
			$orderState->name = $orderState->template = array();
			$mailTemplate     = 'btad_shipped_awaitingpayment';
			foreach (Language::getLanguages() as $language) {
				$orderState->name[$language['id_lang']] = 'Shipped - Awaiting Payment - BTAD Payment';
				$orderState->template[$language['id_lang']] = $mailTemplate;
			}

			$orderState->send_email = true;
			$orderState->color      = '#DDEEFF';
			$orderState->hidden     = false;
			$orderState->delivery   = true;
			$orderState->shipped    = true;
			$orderState->logable    = true;
			$orderState->invoice    = true;
			$orderState->paid       = true;
			$orderState->module_name = $this->name;

			if ($orderState->add()) {
				Configuration::updateValue('CERES_BTAD_OS_AWAITING_PAYMENT', (int)$orderState->id);
				foreach ($this->btad_mail_languages as $lang) {
					copy(_PS_MODULE_DIR_ . $this->name . '/mails/' . $lang . '/' . $mailTemplate . '.html', _PS_MAIL_DIR_ . $lang . '/' . $mailTemplate . '.html');
					copy(_PS_MODULE_DIR_ . $this->name . '/mails/' . $lang . '/' . $mailTemplate . '.txt', _PS_MAIL_DIR_ . $lang . '/' . $mailTemplate . '.txt');
				}
			}
		}
	}

	public function uninstall()
	{
		if (!Configuration::deleteByName('CERES_BTAD_BANK_INFO') || !parent::uninstall())
			return false;
		return true;
	}

	private function _postValidation()
	{
		if (Tools::isSubmit('btnSubmit')) {
			if (!Tools::getValue('bank'))
				$this->_postErrors[] = $this->l('\'Bank Info\' field is required.');
		}
	}

	private function _postProcess()
	{
		if (Tools::isSubmit('btnSubmit')) {
			Configuration::updateValue('CERES_BTAD_BANK_INFO', Tools::getValue('bank'));
		}
		$this->_html .= '<div class="conf confirm"> ' . $this->l('Settings updated') . '</div>';
	}

	private function _displayForm()
	{
		$this->_html .=
			'<form action="' . Tools::htmlentitiesUTF8($_SERVER['REQUEST_URI']) . '" method="post">
			<fieldset>
			<legend><img src="../img/admin/contact.gif" />' . $this->l('Settings') . '</legend>
				<table border="0" width="500" cellpadding="0" cellspacing="0" id="form">
					<tr><td width="130" style="height: 35px;">' . $this->l('Bank Info') . '</td>
					<td>
						<textarea rows="5" cols="70" name="bank">' . Tools::htmlentitiesUTF8(Tools::getValue('bank', $this->bank_info)) . '</textarea>
						<p class="note">This info will be displayed in PDF invoice. You can use html tag but please make sure html tag is valid or pdf invoice cannot be created.</p>
					</td></tr>
					<tr><td colspan="2" align="center"><br /><input class="button" name="btnSubmit" value="' . $this->l('Update settings') . '" type="submit" /></td></tr>
				</table>
			</fieldset>
		</form>';
	}

	public function getContent()
	{
		$this->_html = '<h2>' . $this->displayName . '</h2>';

		if (Tools::isSubmit('btnSubmit')) {
			$this->_postValidation();
			if (!count($this->_postErrors))
				$this->_postProcess();
			else
				foreach ($this->_postErrors as $err)
					$this->_html .= '<div class="alert error">' . $err . '</div>';
		} else
			$this->_html .= '<br />';

		$this->_displayForm();

		return $this->_html;
	}

	public function hookPayment($params)
	{
		if (!$this->active || !$this->checkCurrency($params['cart']) || !$this->checkDisplayPayment($params['cart']))
			return;

		$this->smarty->assign(array(
			'this_path'     => $this->_path,
			'this_path_ssl' => Tools::getShopDomainSsl(true, true) . __PS_BASE_URI__ . 'modules/' . $this->name . '/'
		));
		return $this->display(__FILE__, 'payment.tpl');
	}

	public function hookPaymentReturn($params)
	{
		if (!$this->active)
			return;

		$state = $params['objOrder']->getCurrentState();
		if ($state == Configuration::get('CERES_BTAD_OS_INIT') || $state == Configuration::get('PS_OS_OUTOFSTOCK')) {
			$this->smarty->assign(array(
				'total_to_pay'  => Tools::displayPrice($params['total_to_pay'], $params['currencyObj'], false),
				'bank_info'     => $this->bank_info,
				'chequeAddress' => '', //todo: remove this
				'status'        => 'ok',
				'id_order'      => $params['objOrder']->id
			));
			if (isset($params['objOrder']->reference) && !empty($params['objOrder']->reference))
				$this->smarty->assign('reference', $params['objOrder']->reference);
		} else
			$this->smarty->assign('status', 'failed');
		return $this->display(__FILE__, 'payment_return.tpl');
	}

	public function hookDisplayPDFInvoice($params)
	{
		$order_invoice = $params['object'];
		if (!($order_invoice instanceof OrderInvoice))
			return;
		return Tools::nl2br($order_invoice->note);
	}

	public function hookActionValidateOrder($params)
	{
		$order = $params['order'];
		if ($order->module == 'bankafterdelivery') {
			$order->setInvoice(true);
			$id_invoice = Db::getInstance()->getValue('SELECT MAX(`id_order_invoice`) FROM `'._DB_PREFIX_.'order_invoice` WHERE `id_order` = '.(int)$order->id);
			$invoice = new OrderInvoice($id_invoice);
			$invoice->note = $this->bank_info;
			$invoice->update();
		}
	}

	//check display payment
	public function checkDisplayPayment(Cart $cart)
	{
		$context  = Context::getContext();
		$id_group = $context->customer->id_default_group;
		$total    = $cart->getOrderTotal(true, Cart::BOTH);

		if (isset($this->limitDisplay) && !empty($this->limitDisplay)) {
			foreach ($this->limitDisplay as $limit) {
				if ($limit['group'] == $id_group && $context->shop->id == $limit['shop']) {
					if ($limit['operator'] == 'larger')
						return $total > $limit['amount'];
					else
						return $total < $limit['amount'];
				}
			}
		}

		return true;
	}

	public function checkCurrency($cart)
	{
		$currency_order    = new Currency((int)($cart->id_currency));
		$currencies_module = $this->getCurrency((int)$cart->id_currency);

		if (is_array($currencies_module))
			foreach ($currencies_module as $currency_module)
				if ($currency_order->id == $currency_module['id_currency'])
					return true;
		return false;
	}
}

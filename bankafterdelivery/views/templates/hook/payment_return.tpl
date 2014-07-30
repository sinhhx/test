{if $status == 'ok'}
	<p>{l s='Your order on %s is complete.' sprintf=$shop_name mod='bankafterdelivery'}
		<br /><br />
		{l s='Please send us a money with:' mod='bankafterdelivery'}
		<br /><br />- {l s='an amount of' mod='bankafterdelivery'} <span class="price"><strong>{$total_to_pay}</strong></span>
		<br /><br />- {l s='Bank Info' mod='bankafterdelivery'} <strong>{if $bank_info}{$bank_info}{else}___________{/if}</strong>
		<br /><br />- {l s='after received delivery, please transfer money with above bank info' mod='bankafterdelivery'}
		{if !isset($reference)}
			<br /><br />- {l s='Do not forget to insert your order number #%d.' sprintf=$id_order mode='bankafterdelivery'}
		{else}
			<br /><br />- {l s='Do not forget to insert your order reference %s.' sprintf=$reference mode='bankafterdelivery'}
		{/if}
		<br /><br />{l s='An e-mail has been sent to you with this information.' mode='bankafterdelivery'}
		<br /><br /><strong>{l s='Your order will be sent as soon as we receive your payment.' mode='bankafterdelivery'}</strong>
		<br /><br />{l s='For any questions or for further information, please contact our' mode='bankafterdelivery'} <a href="{$link->getPageLink('contact', true)}">{l s='customer support' mode='bankafterdelivery'}</a>.
	</p>
{else}
	<p class="warning">
		{l s='We noticed a problem with your order. If you think this is an error, you can contact our' mode='bankafterdelivery'} 
		<a href="{$link->getPageLink('contact', true)}">{l s='customer support' mode='bankafterdelivery'}</a>.
	</p>
{/if}

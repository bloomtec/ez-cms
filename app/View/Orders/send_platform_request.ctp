<div class="interpagos form">
	<form id="InterpagosForm" name="Interpagos" method="post" action="https://secure.interpagos.net/gateway/">
		<input name="IdClient" type="hidden" id="IdClient" value="<?php echo $client_id; ?>" />
		<input name="Token" type="hidden" id="Token" value="<?php echo $token; ?>" />
		<input name="IDReference" type="hidden" id="IDReference" value="<?php echo $reference_id; ?>" />
		<input name="Reference" type="hidden" id="Reference" value="<?php echo $reference; ?>" />
		<input name="Currency" type="hidden" id="Currency" value="COP" />
		<input name="BaseAmount" type="hidden" id="BaseAmount" value="<?php echo $base; ?>" />
		<input name="TaxAmount" type="hidden" id="TaxAmount" value="<?php echo $tax; ?>" />
		<input name="TotalAmount" type="hidden" id="TotalAmount" value="<?php echo $total; ?>" />
		<input name="ShopperName" type="hidden" id="ShopperName" value="<?php echo $shopper_name; ?>" />
		<input name="ShopperEmail" type="hidden" id="ShopperEmail" value="<?php echo $shopper_email; ?>" />
		<input name="LanguajeInterface" type="hidden" id="LanguajeInterface" value="SP" />
		<input name="PayMethod" type="hidden" id="PayMethod" value="1" />
		<input name="RecurringBill" type="hidden" id="RecurringBill" value="0" />
		<input name="RecurringBillTimes" type="hidden" id="RecurringBillTimes" value="0" />
		<input name="ExtraData1" type="hidden" id="ExtraData1" value="<?php echo $user_id; ?>" />
		<input name="ExtraData2" type="hidden" id="ExtraData2" value="<?php echo $order_id; ?>" />
		<input name="ExtraData3" type="hidden" id="ExtraData3" value="<?php echo $user_address_id; ?>" />
		<input name="Test" type="hidden" id="Test" value="1" />
		<input name="Submit" type="submit" class="bot" id="button" value="Realizar Pago seguro"/>
	</form>
	<script type="text/javascript">
		$(function() {
			$('#InterpagosForm').submit();
		});
	</script>
</div>
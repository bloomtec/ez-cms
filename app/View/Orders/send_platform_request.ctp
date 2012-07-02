<div class="interpagos form">
	<form id="InterpagosForm" name="Interpagos" method="post" action="https://secure.interpagos.net/gateway/">
		<input name="IdClient" type="number" id="IdClient" value="<?php echo $client_id; ?>" />
		<input name="Token" type="text" id="Token" value="<?php echo $token; ?>" />
		<input type="text" name="IDReference" id="IDReference" value="<?php echo $reference_id; ?>" />
		<input name="Reference" type="text" id="Reference" value="<?php echo $reference; ?>" />
		<input name="Currency" type="text" id="Currency" value="COP" />
		<input name="BaseAmount" type="number" id="BaseAmount" value="<?php echo $base; ?>" />
		<input name="TaxAmount" type="number" id="TaxAmount" value="<?php echo $tax; ?>" />
		<input name="TotalAmount" type="number" id="TotalAmount" value="<?php echo $total; ?>" />
		<input name="ShopperName" type="text" id="ShopperName" value="<?php echo $shopper_name; ?>" />
		<input name="ShopperEmail" type="email" id="ShopperEmail" value="<?php echo $shopper_email; ?>" />
		<input name="LanguajeInterface" type="text" id="LanguajeInterface" value="SP" />
		<input name="PayMethod" type="number" id="PayMethod" value="1" />
		<input name="RecurringBill" type="number" id="RecurringBill" value="0" />
		<input name="RecurringBillTimes" type="number" id="RecurringBillTimes" value="0" />
		<input type="number" name="ExtraData1" id="ExtraData1" value="<?php echo $user_id; ?>" />
		<input type="number" name="ExtraData2" id="ExtraData2" value="<?php echo $order_id; ?>" />
		<input type="number" name="ExtraData3" id="ExtraData3" value="<?php echo $user_address_id; ?>" />
		<input name="Test" type="number" id="Test" value="1" />
		<input name="Submit" type="submit" class="bot" id="button" value="Realizar Pago seguro"/>
	</form>
	<script type="text/javascript">
		$(function() {
			//$('#InterpagosForm').submit();
		});
	</script>
</div>
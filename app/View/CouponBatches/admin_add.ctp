<div class="couponBatches form">
	<?php echo $this -> Form -> create('CouponBatch'); ?>
	<fieldset id="inputs">
		<legend>
			<?php echo __('Crear Cupones'); ?>
		</legend>
		<?php
		echo $this -> Form -> input('coupon_type_id', array('label' => 'Tipo De Cupones'));
		echo $this -> Form -> input('name', array('label' => 'Nombre'));
		echo $this -> Form -> input('quantity', array('label' => 'Cantidad', 'type' => 'number', 'min' => 0));
		echo $this -> Form -> hidden('discount');
		?>
	</fieldset>
	<?php //echo $this -> Form -> end(__('Crear'), array('id' => 'submit')); ?>
	<?php echo $this -> Form -> end(array('id' => 'FormSubmit', 'label' => 'Crear')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li>
			<?php echo $this -> Html -> link(__('Ver Cupones'), array('action' => 'index')); ?>
		</li>
	</ul>
</div>
<script type="text/javascript">
	$(function() {
		var valor = $('#CouponBatchDiscount').val();
		if($('#CouponBatchCouponTypeId').val() == 2 || $('#CouponBatchCouponTypeId').val() == 3) {
			$('#inputs').append('<div id="discount" class="input required"><label for="CouponBatchDiscount_">% De Descuento</label><input type="number" id="CouponBatchDiscount_" min="0" value="' + valor + '" name="data[CouponBatch][discount_]"></div>');
		} else {
			$('#discount').remove();
		}
		$('#CouponBatchCouponTypeId').change(function() {
			if($('#CouponBatchCouponTypeId').val() == 2 || $('#CouponBatchCouponTypeId').val() == 3) {
				$('#inputs').append('<div id="discount" class="input required"><label for="CouponBatchDiscount_">% De Descuento</label><input type="number" id="CouponBatchDiscount_" min="0" value="' + valor + '" name="data[CouponBatch][discount_]"></div>');
			} else {
				$('#discount').remove();
			}
		});
		$('#FormSubmit').click(function(e) {
			$('#CouponBatchDiscount').val($('#CouponBatchDiscount_').val());
			if($('#CouponBatchDiscount').val() < 0 || $('#CouponBatchDiscount').val() > 100) {
				e.preventDefault();
				alert('Ingrese un valor de descuento apropiado');
			}
		});
	});
</script>
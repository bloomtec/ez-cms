<div class="promotions form">
<?php echo $this -> Form -> create('Promotion'); ?>
	<fieldset id="inputs">
		<legend><?php echo __('Modificar El Estado De Promoción En El Sitio Web'); ?></legend>
		<?php
		echo $this -> Form -> input('id');
		echo $this -> Form -> input('coupon_type_id', array('label' => 'Tipo De Promoción', 'empty' => 'Seleccione...', 'value' => ''));
		echo $this -> Form -> input('name', array('label' => 'Nombre'));
		echo $this -> Form -> input('is_active', array('label' => 'Vigente'));
		echo $this -> Form -> hidden('coupon_id');
		echo $this -> Form -> hidden('discount');
		?>
	</fieldset>
<?php //echo $this -> Form -> end(__('Modificar')); ?>
<?php echo $this -> Form -> end(array('id' => 'FormSubmit', 'label' => 'Modificar')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this -> Html -> link(__('Volver'), array('action' => 'index')); ?></li>
	</ul>
</div>
<script type="text/javascript">
	$(function() {
		var valor = $('#PromotionDiscount').val();
		if($('#PromotionCouponTypeId').val() == 2 || $('#PromotionCouponTypeId').val() == 3) {
			$('#inputs').append('<div id="discount" class="input required"><label for="PromotionDiscount_">% De Descuento</label><input type="number" id="PromotionDiscount_" min="0" value="' + valor + '" name="data[Promotion][discount_]"></div>');
		} else {
			$('#discount').remove();
		}
		$('#PromotionCouponTypeId').change(function() {
			if($('#PromotionCouponTypeId').val() == 2 || $('#PromotionCouponTypeId').val() == 3) {
				$('#inputs').append('<div id="discount" class="input required"><label for="PromotionDiscount_">% De Descuento</label><input type="number" id="PromotionDiscount_" min="0" value="' + valor + '" name="data[Promotion][discount_]"></div>');
			} else {
				$('#discount').remove();
			}
		});
		$('#FormSubmit').click(function(e) {
			$('#PromotionDiscount').val($('#PromotionDiscount_').val());
			if($('#PromotionDiscount').val() < 0 || $('#PromotionDiscount').val() > 100) {
				e.preventDefault();
				alert('Ingrese un valor de descuento apropiado');
			}
		});
	});
</script>
<div class="orders form">
	<?php echo $this -> Form -> create('Order'); ?>
	<fieldset>
		<legend><?php echo __('Modificar Orden :: ' . $this -> request -> data['Order']['code']); ?></legend>
		<?php
		echo $this -> Form -> input('id');
		echo $this -> Form -> input('order_state_id', array('label' => 'Estado De La Orden', 'empty' => 'Seleccione...'));
		?>
	</fieldset>
	<?php //echo $this -> Form -> end(__('Modificar')); ?>
	<div class="submit">
		<input id="FormSubmit" type="submit" value="Modificar">
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this -> Html -> link(__('Ver Ordenes'), array('action' => 'index')); ?></li>
	</ul>
</div>
<script type="text/javascript">
	$(function() {
		$('#FormSubmit').click(function(e) {
			e.preventDefault();
			var opt = $("select#OrderOrderStateId option:selected");
			if(!opt.val()) {
				alert('Debe seleccionar una opción');
			} else {
				if(confirm('En realidad desea cambiar el estado de la orden a: ' + opt.text())) {
					$('#OrderAdminEditForm').submit();					
				}
			}
		});
	});
</script>
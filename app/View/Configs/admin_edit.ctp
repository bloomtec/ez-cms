<div class="configs form">
	<?php echo $this -> Form -> create('Config'); ?>
	<fieldset>
		<legend><?php echo __('Modificar Configuración'); ?></legend>
		<?php
			echo $this -> Form -> input('id');
			echo $this -> Form -> input('shipment_cost', array('label' => 'Costo De Envío'));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Modificar')); ?>
</div>
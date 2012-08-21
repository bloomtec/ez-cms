<div class="productSizes form">
	<?php echo $this -> Form -> create('ProductSize'); ?>
	<fieldset>
		<legend>
			<?php echo __('Agregar Talla'); ?>
		</legend>
		<?php
		echo $this -> Form -> input('name', array('label' => 'Talla'));
		//echo $this -> Form -> input('order');
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Agregar')); ?>
</div>

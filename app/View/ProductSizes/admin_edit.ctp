<div class="productSizes form">
	<?php echo $this -> Form -> create('ProductSize'); ?>
	<fieldset>
		<legend>
			<?php echo __('Modificar Talla'); ?>
		</legend>
		<?php
		echo $this -> Form -> input('id');
		echo $this -> Form -> input('name', array('label' => 'Talla'));
		//echo $this -> Form -> input('order');
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Modificar')); ?>
</div>
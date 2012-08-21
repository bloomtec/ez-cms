<div class="colors form">
	<?php echo $this -> Form -> create('Color'); ?>
	<fieldset>
		<legend>
			<?php echo __('Crear Color'); ?>
		</legend>
		<?php
		echo $this -> Form -> input('name', array('label' => 'Nombre'));
		echo $this -> Form -> input('code', array('label' => 'Código', 'maxlength' => 7, 'minlength' => 7));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Guardar')); ?>
</div>
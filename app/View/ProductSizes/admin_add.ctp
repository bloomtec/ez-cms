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
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li>
			<?php echo $this -> Html -> link(__('Ver Tallas'), array('action' => 'index')); ?>
		</li>
	</ul>
</div>
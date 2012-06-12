<div class="inventories form">
	<?php echo $this -> Form -> create('Inventory'); ?>
	<fieldset>
		<legend>
			<?php echo __('Modificar Inventario'); ?>
		</legend>
		<?php
		echo $this -> Form -> input('id');
		echo $this -> Form -> input('Info.producto', array('value' => $this -> request -> data['Product']['name'], 'disabled' => 'disabled'));
		echo $this -> Form -> input('Info.talla', array('value' => $this -> request -> data['ProductSize']['name'], 'disabled' => 'disabled'));
		echo $this -> Form -> input('quantity', array('label' => 'Cantidad', 'min' => '0'));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Modificar')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li>
			<?php echo $this -> Html -> link(__('Ver Inventarios'), array('action' => 'index')); ?>
		</li>
	</ul>
</div>

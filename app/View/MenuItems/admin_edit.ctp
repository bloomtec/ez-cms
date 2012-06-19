<div class="menuItems form">
	<?php echo $this -> Form -> create('MenuItem'); ?>
	<fieldset>
		<legend>
			<?php echo __('Modificar Ítem De Menú'); ?>
		</legend>
		<?php
		echo $this -> Form -> input('id');
		//echo $this -> Form -> input('position');
		echo $this -> Form -> input('menu_id', array('label' => 'Menú'));
		echo $this -> Form -> input('name', array('label' => 'Nombre'));
		echo $this -> Form -> input('link', array('label' => 'Enlace', 'type' => 'select', 'options' => $pages));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Modificar')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>

		<li>
			<?php echo $this -> Form -> postLink(__('Eliminar'), array('action' => 'delete', $this -> Form -> value('MenuItem.id')), null, __('¿Seguro desea eliminar %s?', $this -> Form -> value('MenuItem.name'))); ?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('Ver Ítems De Menú'), array('action' => 'index')); ?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('Ver Menús'), array('controller' => 'menus', 'action' => 'index')); ?>
		</li>
		<!--<li><?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add')); ?> </li>-->
	</ul>
</div>

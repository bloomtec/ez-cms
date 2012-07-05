<div class="menuItems form">
	<?php echo $this -> Form -> create('MenuItem'); ?>
	<fieldset>
		<legend>
			<?php echo __('Crear Ítem De Menú'); ?>
		</legend>
		<?php
		//echo $this -> Form -> input('position');
		echo $this -> Form -> input('menu_id', array('label' => 'Menú'));
		echo $this -> Form -> input('name', array('label' => 'Nombre'));
		echo $this -> Form -> input('link', array('label' => 'Enlace', 'type' => 'select', 'options' => $pages, 'empty' => 'Seleccione...'));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Crear')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li>
			<?php echo $this -> Html -> link(__('Ver Ítems De Menú'), array('action' => 'index')); ?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('Ver Menús'), array('controller' => 'menus', 'action' => 'index')); ?>
		</li>
	</ul>
</div>

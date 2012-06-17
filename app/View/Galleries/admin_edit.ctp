<div class="galleries form">
	<?php echo $this -> Form -> create('Gallery'); ?>
	<fieldset>
		<legend>
			<?php echo __('Modificar Galería'); ?>
		</legend>
		<?php
		echo $this -> Form -> input('id');
		echo $this->Form->input('product_id', array('label' => 'Producto', 'empty' => 'Seleccione...'));
		echo $this->Form->input('name', array('label' => 'Nombre'));
		echo $this->Form->input('description', array('label' => 'Descripción'));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Modificar')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>

		<li>
			<?php echo $this -> Form -> postLink(__('Eliminar'), array('action' => 'delete', $this -> Form -> value('Gallery.id')), null, __('¿Seguro desea eliminar %s?', $this -> Form -> value('Gallery.name'))); ?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('Ver Galerías'), array('action' => 'index')); ?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('Ver Productos'), array('controller' => 'products', 'action' => 'index')); ?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('Agregar Producto'), array('controller' => 'products', 'action' => 'add')); ?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('Ver Imagenes'), array('controller' => 'images', 'action' => 'index')); ?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('Agregar Imagen'), array('controller' => 'images', 'action' => 'add')); ?>
		</li>
	</ul>
</div>

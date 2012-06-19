<div class="categories form">
	<?php echo $this -> Form -> create('Category'); ?>
	<fieldset>
		<legend>
			<?php echo __('Modificar Categoría'); ?>
		</legend>
		<?php
		echo $this -> Form -> input('id');
		echo $this -> Form -> input('name', array('label' => 'Nombre'));
		echo $this -> Form -> input('description', array('label' => 'Descripción'));
		echo $this -> Form -> input('banner', array('label' => 'Banner', 'class' => 'editor'));
		echo $this -> Form -> hidden('image', array('label' => 'Imagen', 'id' => 'single-field', "value" => $this -> data["Category"]["image"]));
		echo $this -> Form -> input('is_promoted', array('label' => 'Promocionada'));
		//echo $this -> Form -> input('order', array('label' => 'Posición'));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Modificar')); ?>
</div>
<div class="images">
	<h2>Imagen</h2>
	<div class="preview">
		<?php echo $this -> Html -> image("uploads/215x215/" . $this -> data['Category']['image']); ?>
	</div>
	<div id="single-upload-category" controller="categories"></div>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li>
			<?php echo $this -> Form -> postLink(__('Eliminar'), array('action' => 'delete', $this -> Form -> value('Category.id')), null, __('¿Seguro desea eliminar %s?', $this -> Form -> value('Category.name'))); ?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('Ver Categorías'), array('action' => 'index')); ?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('Ver Productos'), array('controller' => 'products', 'action' => 'index')); ?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('Agregar Producto'), array('controller' => 'products', 'action' => 'add')); ?>
		</li>
	</ul>
</div>

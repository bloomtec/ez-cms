<div class="products form">
	<?php echo $this -> Form -> create('Product'); //debug($this -> data); ?>
	<fieldset>
		<legend>
			<?php echo __('Modificar Producto'); ?>
		</legend>
		<div class="datos">
		<?php
		echo $this -> Form -> input('id');
		echo $this -> Form -> input('category_id', array('label' => 'Categoría', 'empty' => 'Selecione...'));
		echo $this -> Form -> input('name', array('label' => 'Nombre'));
		echo $this -> Form -> input('reference', array('label' => 'Referencia'));
		echo $this -> Form -> input('price', array('label' => 'Precio'));
		echo $this -> Form -> input('tax_base', array('label' => 'Base I.V.A.'));
		echo $this -> Form -> input('tax_value', array('label' => 'Valor I.V.A.'));
		echo $this -> Form -> input('description', array('label' => 'Descripción'));
		//echo $this -> Form -> input('order', array('label' => ''));
		echo $this -> Form -> input('is_active', array('label' => 'Activo', 'checked' => 'checked'));
		echo $this -> Form -> input('is_promoted', array('label' => 'Promocionado'));
		echo $this -> Form -> input('is_novelty', array('label' => 'Novedad'));
		echo $this -> Form -> input('is_top_seller', array('label' => 'Más Vendido'));
		echo $this -> Form -> hidden('image', array('label' => 'Imagen', "value" => $this -> data["Product"]["image"]));
		?>
		</div>
		<div class="tallas">
		<?php
		echo $this -> Form -> input('ProductSize.size', array('label' => 'Tallas', 'type' => 'select', 'multiple' => 'checkbox'));
		?>
		</div>
	</fieldset>
	<?php echo $this -> Form -> end(__('Modificar')); ?>
</div>
<div class="images">
	<h2>Imagen</h2>
	<div class="preview">
		<?php echo $this -> Html -> image("uploads/" . $this -> data['Product']['image'], array("width" => 200)); ?>
	</div>
	<div id="single-upload" controller="products"></div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li>
			<?php echo $this -> Form -> postLink(__('Eliminar'), array('action' => 'delete', $this -> Form -> value('Product.id')), null, __('¿Seguro desea eliminar %s?', $this -> Form -> value('Product.name'))); ?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('Ver Productos'), array('action' => 'index')); ?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('Ver Categorías'), array('controller' => 'categories', 'action' => 'index')); ?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('Agregar Categoría'), array('controller' => 'categories', 'action' => 'add')); ?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('Ver Inventario'), array('controller' => 'inventories', 'action' => 'view')); ?>
		</li>
		<!--<li>
		<?php echo $this -> Html -> link(__('New Inventory'), array('controller' => 'inventories', 'action' => 'add')); ?>
		</li>-->
	</ul>
</div>

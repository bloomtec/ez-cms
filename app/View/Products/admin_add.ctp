<?php echo $this -> Html -> css('uploadify'); ?>
<?php echo $this -> Html -> script('jquery.uploadify.min'); ?>
<?php echo $this -> Html -> script('upload'); ?>
<div class="products form">
	<?php echo $this -> Form -> create('Product'); ?>
	<fieldset>
		<legend>
			<?php echo __('Crear Producto'); ?>
		</legend>
		<div class="datos">
		<?php
		echo $this -> Form -> input('category_id', array('label' => 'Categoría', 'empty' => 'Selecione...'));
		echo $this -> Form -> input('name', array('label' => 'Nombre'));
		echo $this -> Form -> input('reference', array('label' => 'Referencia'));
		echo $this -> Form -> input('price', array('label' => 'Precio'));
		echo $this -> Form -> input('tax_base', array('label' => 'Base I.V.A.', 'value' => '1.16'));
		echo $this -> Form -> input('tax_value', array('label' => 'Valor I.V.A.'));
		echo $this -> Form -> input('description', array('label' => 'Descripción'));
		//echo $this -> Form -> input('order', array('label' => ''));
		echo $this -> Form -> input('is_active', array('label' => 'Activo', 'checked' => 'checked'));
		echo $this -> Form -> input('is_promoted', array('label' => 'Promocionado'));
		echo $this -> Form -> input('is_novelty', array('label' => 'Novedad'));
		echo $this -> Form -> input('is_top_seller', array('label' => 'Más Vendido'));
		echo $this -> Form -> hidden('image', array('label' => 'Imagen', 'id' => 'single-field'));
		?>
		</div>
		<div class="tallas">
		<?php
		echo $this -> Form -> input('ProductSize.size', array('label' => 'Tallas', 'type' => 'select', 'multiple' => 'checkbox'));
		?>
		</div>
	</fieldset>
	<?php echo $this -> Form -> end(__('Crear')); ?>
</div>
<div class="images">
	<h2>Imagen</h2>
	<div class="preview"></div>
	<div id="single-upload" controller="products"></div>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
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
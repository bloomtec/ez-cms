<div class="categories form image">
	<?php echo $this -> Form -> create('Category'); ?>
	<fieldset>
		<legend>
			<?php echo __('Crear Categoría'); ?>
		</legend>
		<?php
		echo $this -> Form -> input('name', array('label' => 'Nombre'));
		echo $this -> Form -> input('description', array('label' => 'Descripción'));
		?>
		<div class="image-container to-right">
			<label>Imagen</label>
			<div class="preview"></div>
			<div id="single-upload-category" controller="categories"></div>
		</div>
		<div style="clear:both;"></div>
		<?php
		echo $this -> Form -> input('banner', array('label' => 'Banner', 'class' => 'editor', 'div' => 'textarea banner'));
		echo $this -> Form -> hidden('image', array('label' => 'Imagen', 'id' => 'single-field'));
		echo $this -> Form -> input('is_promoted', array('label' => 'Promocionada'));
		//echo $this -> Form -> input('order', array('label' => 'Posición'));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Crear')); ?>

	<div style="clear:both;"></div>
</div>

<div class="actions">
	<ul>
		<li>
			<?php echo $this -> Html -> link(__('Ver Categorías'), array('action' => 'index')); ?>
		</li>
	</ul>
</div>

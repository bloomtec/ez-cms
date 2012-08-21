<div class="galleries form">
	<?php echo $this -> Form -> create('Gallery'); ?>
	<fieldset>
		<legend>
			<?php echo __('Crear Galería'); ?>
		</legend>
		<?php
		//echo $this -> Form -> input('inventory_id', array('label' => 'Inventarios sin galería', 'empty' => 'Seleccione...'));
		echo $this -> Form -> input('name', array('label' => 'Nombre'));
		echo $this -> Form -> input('description', array('label' => 'Descripión'));
		echo $this -> Form -> hidden('image', array('id' => 'single-field'));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Crear')); ?>
</div>
<div class="images">
	<h2>Imagen</h2>
	<div class="preview"></div>
	<div id="single-upload-gallery" controller="galleries">

	</div>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>

		<li>
			<?php echo $this -> Html -> link(__('Ver Galerías'), array('action' => 'index')); ?>
		</li>
	</ul>
</div>
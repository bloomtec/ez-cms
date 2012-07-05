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
		?>
		<div class="image-container to-right">
			<label>Imagen</label>
			<div class="preview">
				<?php echo $this -> Html -> image("uploads/215x215/" . $this -> data['Category']['image']); ?>
			</div>
			<div id="single-upload-category" controller="categories"></div>
		</div>
		<?php
		echo $this -> Form -> input('banner', array('label' => 'Banner', 'class' => 'editor', 'div' => 'textarea banner'));
		echo $this -> Form -> hidden('image', array('label' => 'Imagen', 'id' => 'single-field', "value" => $this -> data["Category"]["image"]));
		echo $this -> Form -> input('is_promoted', array('label' => 'Promocionada'));
		//echo $this -> Form -> input('order', array('label' => 'Posición'));
		?>
		
	</fieldset>
	<?php echo $this -> Form -> end(__('Modificar')); ?>
</div>

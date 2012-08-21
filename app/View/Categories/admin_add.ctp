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
		echo $this -> Form -> hidden('promoted_image', array('label' => 'Imagen', 'id' => 'single-field-promoted'));
		?>
		<div style="clear:both;"></div>
		<div id="PromotedImage" class="image-container to-right" style="float:right; visibility:hidden;">
			<label>Imagen Promocionada</label>
			<div class="preview-promoted"></div>
			<div id="single-upload-category-promoted" controller="categories"></div>
		</div>
		<?php
		echo $this -> Form -> input('is_promoted', array('label' => 'Promocionada', 'div' => array('style' => 'max-width:30%; clear:none;')));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Crear')); ?>

	<div style="clear:both;"></div>
</div>
<script type="text/javascript">
	$(function(){
		$('#CategoryIsPromoted').change(function() {
			if($('#CategoryIsPromoted').is(':checked')) {
				$('#PromotedImage').css('visibility', 'visible');
			} else {
				$('#PromotedImage').css('visibility', 'hidden');
			}
		});
	});
</script>
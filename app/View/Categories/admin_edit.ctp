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
		echo $this -> Form -> hidden('promoted_image', array('label' => 'Imagen', 'id' => 'single-field-promoted'));
		?>
		<div style="clear:both;"></div>
		<div id="PromotedImage" class="image-container to-right" style="float:right; visibility:hidden;">
			<label>Imagen Promocionada</label>
			<div class="preview-promoted">
				<?php echo $this -> Html -> image("uploads/215x215/" . $this -> data['Category']['promoted_image']); ?>
			</div>
			<div id="single-upload-category-promoted" controller="categories"></div>
		</div>
		<?php
		echo $this -> Form -> input('is_promoted', array('label' => 'Promocionada', 'div' => array('style' => 'max-width:30%; clear:none;')));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Modificar')); ?>
</div>
<script type="text/javascript">
	$(function(){
		if($('#CategoryIsPromoted').is(':checked')) {
			$('#PromotedImage').css('visibility', 'visible');
		} else {
			$('#PromotedImage').css('visibility', 'hidden');
		}
		$('#CategoryIsPromoted').change(function() {
			if($('#CategoryIsPromoted').is(':checked')) {
				$('#PromotedImage').css('visibility', 'visible');
			} else {
				$('#PromotedImage').css('visibility', 'hidden');
			}
		});
	});
</script>
<div class="galleries form">
	<?php echo $this -> Form -> create('Gallery'); ?>
	<fieldset>
		<legend>
			<?php echo __('Asignar Imagen A Galerías'); ?>
		</legend>
		<?php //debug($galleries); ?>
		<?php foreach($galleries as $index => $gallery) : ?>
		<div class="gallery-container">
			<?php
				$gallery_id = $gallery['Gallery']['id'];
				echo $this -> Form -> hidden("Gallery.$gallery_id.id", array('value' => $gallery_id));
				echo $this -> Form -> hidden("Gallery.$gallery_id.image", array('value' => $gallery['Gallery']['image'], 'class' => 'gallery-single-upload', 'id' => $gallery_id));
			?>
			<div class="images">
				<h2>Imagen Principal Galería <?php echo $gallery['Gallery']['name']; ?></h2>
				<div id="preview-<?php echo $gallery_id; ?>"> 
					<?php if( $gallery['Gallery']['image']): ?>
						<img src="/img/uploads/150x150/<?php echo $gallery['Gallery']['image']; ?>" />						
					 <?php endif;?>	 
				 </div>
				<div id="single-upload-gallery-<?php echo $gallery_id; ?>" controller="galleries"></div>
			</div>
		</div>
		<?php endforeach; ?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Asignar')); ?>
</div>
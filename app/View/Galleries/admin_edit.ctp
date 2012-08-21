<div class="galleries form">
	<?php echo $this -> Form -> create('Gallery'); ?>
	<div class="images" style="float:right; min-width: 400px">
		<h2>Imagen Principal De La Galería</h2>
		<div class="main-img-preview"><img id="MainImg" src="/img/uploads/215x215/<?php echo $this -> request -> data['Gallery']['image']; ?>" /></div>
		<div id="single-upload-gallery" controller="galleries">
	
		</div>
	</div>
	<fieldset style="float:left; min-width:50%; max-width:60%">
		<legend>
			<?php echo __('Modificar Galería'); ?>
		</legend>
		<?php echo $this -> Form -> input('id'); ?>
		<?php echo $this -> Form -> input('name', array('label' => 'Nombre')); ?>
		<?php echo $this -> Form -> input('description', array('label' => 'Descripción')); ?>
		<?php echo $this -> Form -> hidden('image', array('id' => 'single-field'));	?>
	</fieldset>
	<div style="clear:both;"></div>
	<?php echo $this -> Form -> end(__('Modificar')); ?>
</div>
<div class="related">
	<?php //debug($this -> request -> data); ?>
	<h2>Imagenes En La Galería</h2>
	<table id="RelatedImages">
		<tbody id="RelatedImagesBody">
			<tr><td>ID</td><td>Imagen</td><td>Acciones</td></tr>
			<?php foreach($this -> request -> data['Image'] as $key => $image) : ?>
			<tr>
				<td><?php echo $image['id']; ?></td>
				<td>
					<img src="/img/uploads/50x50/<?php echo $image['path']; ?>" />
				</td>
				<td>
					<?php
						echo $this->Form->postLink(
							__('Eliminar'),
							array(
								'admin' => true,
								'controller' => 'images',
								'action' => 'delete',
								$image['id'],
								$this -> request -> data['Gallery']['prod_color_code'],
								$product_id
							),
							null,
							__('¿Seguro desea eliminar la imagen # %s?', $image['id'])
						);
					?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<br />
<div id="gallery_id" rel="<?php echo $this -> request -> data['Gallery']['id']; ?>"></div>
<div id="prod_color_code" rel="<?php echo $this -> request -> data['Gallery']['prod_color_code']; ?>"></div>
<div id="product_id" rel="<?php echo $product_id; ?>"></div>
<div class="images">
	<div class="preview"></div>
	<div id="multiple-upload-gallery" controller="galleries">

	</div>
</div>
<!--<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>

		<li>
			<?php echo $this -> Html -> link(__('Volver'), array('controller' => 'products', 'action' => 'edit', $product_id)); ?>
		</li>
	</ul>
</div>-->
<div class="galleries form">
	<?php echo $this -> Form -> create('Gallery'); ?>
	<fieldset>
		<legend>
			<?php echo __('Modificar Galería'); ?>
		</legend>
		<?php
		echo $this -> Form -> input('id');
		//echo $this -> Form -> input('inventory_id', array('label' => 'Inventarios sin galería'));
		echo $this -> Form -> input('name', array('label' => 'Nombre'));
		echo $this -> Form -> input('description', array('label' => 'Descripión'));
		echo $this -> Form -> hidden('image', array('id' => 'single-field'));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Modificar')); ?>
</div>
<div class="images">
	<h2>Imagen Principal</h2>
	<div class="main-img-preview"><img id="MainImg" src="/img/uploads/215x215/<?php echo $this -> request -> data['Gallery']['image']; ?>" /></div>
	<div id="single-upload-gallery" controller="galleries">

	</div>
</div>
<div id="gallery_id" rel="<?php echo $this -> request -> data['Gallery']['id']; ?>"></div>
<div id="prod_color_code" rel="<?php echo $this -> request -> data['Gallery']['prod_color_code']; ?>"></div>
<div id="product_id" rel="<?php echo $product_id; ?>"></div>
<div class="images">
	<h2>Imagenes Galería</h2>
	<div class="preview"></div>
	<div id="multiple-upload-gallery" controller="galleries">

	</div>
</div>
<div class="related">
	<?php //debug($this -> request -> data); ?>
	<table id="RelatedImages">
		<tbody>
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
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>

		<li>
			<?php echo $this -> Html -> link(__('Volver'), array('controller' => 'products', 'action' => 'edit', $product_id)); ?>
		</li>
	</ul>
</div>
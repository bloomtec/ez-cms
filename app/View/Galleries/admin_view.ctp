<div class="galleries view">
<h2><?php  echo __('Galería');?></h2>
	<dl>
		<!--<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['id']); ?>
			&nbsp;
		</dd>-->
		<!--<dt><?php echo __('Inventario'); ?></dt>
		<dd>
			<?php echo $this->Html->link($inventory['Inventory']['name_for_gallery'], array('controller' => 'inventories', 'action' => 'view', $inventory['Inventory']['id'])); ?>
			&nbsp;
		</dd>-->
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descripción'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Imagen'); ?></dt>
		<dd>
			<?php //echo h($gallery['Gallery']['image']); ?>
			<img src="/img/uploads/150x150/<?php echo $gallery['Gallery']['image']; ?>" />
			&nbsp;
		</dd>
		<dt><?php echo __('Creado'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div id="gallery_id" rel="<?php echo $gallery['Gallery']['id']; ?>"></div>
<div class="images">
	<h2>Subir Imagenes</h2>
	<div class="preview"></div>
	<div id="multiple-upload-gallery" controller="galleries">

	</div>
</div>
<div class="related">
	<?php //debug($gallery); ?>
	<table id="RelatedImages">
		<tbody>
			<tr><td>ID</td><td>Imagen</td><td>Acciones</td></tr>
			<?php foreach($gallery['Image'] as $key => $image) : ?>
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
								$gallery['Gallery']['id']
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
		<li><?php echo $this->Html->link(__('Modifciar Galería'), array('action' => 'edit', $gallery['Gallery']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Ver Galerías'), array('action' => 'index')); ?> </li>
		<!--<li><?php echo $this->Html->link(__('Agregar Galería'), array('action' => 'add')); ?> </li>-->
	</ul>
</div>

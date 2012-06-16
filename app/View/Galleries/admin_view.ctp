<div class="galleries view">
<h2><?php  echo __('Galería');?></h2>
	<dl>
		<!--<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['id']); ?>
			&nbsp;
		</dd>-->
		<dt><?php echo __('Producto'); ?></dt>
		<dd>
			<?php echo $this->Html->link($gallery['Product']['name'], array('controller' => 'products', 'action' => 'view', $gallery['Product']['id'])); ?>
			&nbsp;
		</dd>
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
		<dt><?php echo __('Creada'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificada'); ?></dt>
		<dd>
			<?php echo h($gallery['Gallery']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Modificar Galería'), array('action' => 'edit', $gallery['Gallery']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Eliminar Galería'), array('action' => 'delete', $gallery['Gallery']['id']), null, __('Are you sure you want to delete # %s?', $gallery['Gallery']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Ver Galerías'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Agregar Galería'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Ver Productos'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Agregar Producto'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Images'), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Image'), array('controller' => 'images', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Images');?></h3>
	<?php if (!empty($gallery['Image'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Gallery Id'); ?></th>
		<th><?php echo __('Caption'); ?></th>
		<th><?php echo __('Path'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($gallery['Image'] as $image): ?>
		<tr>
			<td><?php echo $image['id'];?></td>
			<td><?php echo $image['gallery_id'];?></td>
			<td><?php echo $image['caption'];?></td>
			<td><?php echo $image['path'];?></td>
			<td><?php echo $image['created'];?></td>
			<td><?php echo $image['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'images', 'action' => 'view', $image['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'images', 'action' => 'edit', $image['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'images', 'action' => 'delete', $image['id']), null, __('Are you sure you want to delete # %s?', $image['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Image'), array('controller' => 'images', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>

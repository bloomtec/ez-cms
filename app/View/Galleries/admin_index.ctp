<div class="galleries index">
	<h2><?php echo __('Galerias');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<!--<th><?php echo $this->Paginator->sort('id');?></th>-->
			<th><?php echo $this->Paginator->sort('product_id', 'Producto');?></th>
			<th><?php echo $this->Paginator->sort('name', 'Nombre');?></th>
			<th><?php echo $this->Paginator->sort('description', 'Descripción');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Creada');?></th>
			<th><?php echo $this->Paginator->sort('updated', 'Modificada');?></th>
			<th class="actions"><?php echo __('Acciones');?></th>
	</tr>
	<?php
	foreach ($galleries as $gallery): ?>
	<tr>
		<!--<td><?php echo h($gallery['Gallery']['id']); ?>&nbsp;</td>-->
		<td>
			<?php echo $this->Html->link($gallery['Product']['name'], array('controller' => 'products', 'action' => 'view', $gallery['Product']['id'])); ?>
		</td>
		<td><?php echo h($gallery['Gallery']['name']); ?>&nbsp;</td>
		<td><?php echo h($gallery['Gallery']['description']); ?>&nbsp;</td>
		<td><?php echo h($gallery['Gallery']['created']); ?>&nbsp;</td>
		<td><?php echo h($gallery['Gallery']['updated']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $gallery['Gallery']['id'])); ?>
			<?php echo $this->Html->link(__('Modificar'), array('action' => 'edit', $gallery['Gallery']['id'])); ?>
			<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $gallery['Gallery']['id']), null, __('Are you sure you want to delete # %s?', $gallery['Gallery']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página %page% de %pages%, mostrando %current% registros de un total de %count%, desde el %start%, hasta el %end%')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->first('<< ', array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->prev('< ' . __('anterior '), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__(' siguiente') . ' >', array(), null, array('class' => 'next disabled'));
		echo $this->Paginator->last(' >>', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Agregar Galería'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Ver Productos'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Agregar Producto'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Ver Imagenes'), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Agregar Imagen'), array('controller' => 'images', 'action' => 'add')); ?> </li>
	</ul>
</div>

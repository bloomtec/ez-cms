<div class="categories index">
	<h2><?php echo __('Categorías');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<!--<th><?php echo $this->Paginator->sort('id');?></th>-->
			<th><?php echo $this->Paginator->sort('name', 'Nombre');?></th>
			<!--<th><?php echo $this->Paginator->sort('description');?></th>-->
			<th><?php echo $this->Paginator->sort('image', 'Imagen');?></th>
			<th><?php echo $this->Paginator->sort('is_promoted', 'Promocionado');?></th>
			<th><?php echo $this->Paginator->sort('order', 'Posición');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Creada');?></th>
			<th><?php echo $this->Paginator->sort('updated', 'Modificada');?></th>
			<th class="actions"><?php echo __('Acciones');?></th>
	</tr>
	<?php
	foreach ($categories as $category): ?>
	<tr>
		<!--<td><?php echo h($category['Category']['id']); ?>&nbsp;</td>-->
		<td><?php echo h($category['Category']['name']); ?>&nbsp;</td>
		<!--<td><?php echo h($category['Category']['description']); ?>&nbsp;</td>-->
		<td>
			<?php //echo h($category['Category']['image']); ?>
			<img src="/img/uploads/50x50/<?php echo $category['Category']['image']; ?>" />
			&nbsp;
		</td>
		<td>
			<?php
				//echo h($category['Category']['is_promoted']);
				if($category['Category']['is_promoted']) {
					echo '<input type="checkbox" checked="checked" disabled="true" />';
				} else {
					echo '<input type="checkbox" disabled="true" />';
				}
			?>
			&nbsp;
		</td>
		<td><?php echo h($category['Category']['order']); ?>&nbsp;</td>
		<td><?php echo h($category['Category']['created']); ?>&nbsp;</td>
		<td><?php echo h($category['Category']['updated']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $category['Category']['id'])); ?>
			<?php echo $this->Html->link(__('Modificar'), array('action' => 'edit', $category['Category']['id'])); ?>
			<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $category['Category']['id']), null, __('¿Seguro desea eliminar %s?', $category['Category']['name'])); ?>
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
<div class="actions">	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Agregar Categoría'), array('action' => 'add')); ?></li>
	</ul>
</div>

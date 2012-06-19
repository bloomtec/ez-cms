<div class="galleries index">
	<h2><?php echo __('Galleries');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('inventory_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('image');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($galleries as $gallery): ?>
	<tr>
		<td><?php echo h($gallery['Gallery']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($gallery['Inventory']['product'], array('controller' => 'inventories', 'action' => 'view', $gallery['Inventory']['id'])); ?>
		</td>
		<td><?php echo h($gallery['Gallery']['name']); ?>&nbsp;</td>
		<td><?php echo h($gallery['Gallery']['description']); ?>&nbsp;</td>
		<td><?php echo h($gallery['Gallery']['image']); ?>&nbsp;</td>
		<td><?php echo h($gallery['Gallery']['created']); ?>&nbsp;</td>
		<td><?php echo h($gallery['Gallery']['updated']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $gallery['Gallery']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $gallery['Gallery']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $gallery['Gallery']['id']), null, __('Are you sure you want to delete # %s?', $gallery['Gallery']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Gallery'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Inventories'), array('controller' => 'inventories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inventory'), array('controller' => 'inventories', 'action' => 'add')); ?> </li>
	</ul>
</div>

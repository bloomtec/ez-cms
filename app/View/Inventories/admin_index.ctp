<div class="inventories index">
	<h2><?php echo __('Inventories');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('product_id');?></th>
			<th><?php echo $this->Paginator->sort('product_size_id');?></th>
			<th><?php echo $this->Paginator->sort('quantity');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('updated');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($inventories as $inventory): ?>
	<tr>
		<td><?php echo h($inventory['Inventory']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($inventory['Product']['name'], array('controller' => 'products', 'action' => 'view', $inventory['Product']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($inventory['ProductSize']['name'], array('controller' => 'product_sizes', 'action' => 'view', $inventory['ProductSize']['id'])); ?>
		</td>
		<td><?php echo h($inventory['Inventory']['quantity']); ?>&nbsp;</td>
		<td><?php echo h($inventory['Inventory']['created']); ?>&nbsp;</td>
		<td><?php echo h($inventory['Inventory']['updated']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $inventory['Inventory']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $inventory['Inventory']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $inventory['Inventory']['id']), null, __('Are you sure you want to delete # %s?', $inventory['Inventory']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Inventory'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Sizes'), array('controller' => 'product_sizes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Size'), array('controller' => 'product_sizes', 'action' => 'add')); ?> </li>
	</ul>
</div>

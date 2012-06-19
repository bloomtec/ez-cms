<div class="colors view">
<h2><?php  echo __('Color');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($color['Color']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($color['Color']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($color['Color']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($color['Color']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($color['Color']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Color'), array('action' => 'edit', $color['Color']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Color'), array('action' => 'delete', $color['Color']['id']), null, __('Are you sure you want to delete # %s?', $color['Color']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Colors'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Color'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Inventories'), array('controller' => 'inventories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inventory'), array('controller' => 'inventories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Inventories');?></h3>
	<?php if (!empty($color['Inventory'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Color Id'); ?></th>
		<th><?php echo __('Product Size Id'); ?></th>
		<th><?php echo __('Quantity'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($color['Inventory'] as $inventory): ?>
		<tr>
			<td><?php echo $inventory['id'];?></td>
			<td><?php echo $inventory['product_id'];?></td>
			<td><?php echo $inventory['color_id'];?></td>
			<td><?php echo $inventory['product_size_id'];?></td>
			<td><?php echo $inventory['quantity'];?></td>
			<td><?php echo $inventory['created'];?></td>
			<td><?php echo $inventory['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'inventories', 'action' => 'view', $inventory['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'inventories', 'action' => 'edit', $inventory['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'inventories', 'action' => 'delete', $inventory['id']), null, __('Are you sure you want to delete # %s?', $inventory['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Inventory'), array('controller' => 'inventories', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>

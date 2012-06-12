<div class="inventories view">
<h2><?php  echo __('Inventory');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($inventory['Product']['name'], array('controller' => 'products', 'action' => 'view', $inventory['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product Size'); ?></dt>
		<dd>
			<?php echo $this->Html->link($inventory['ProductSize']['name'], array('controller' => 'product_sizes', 'action' => 'view', $inventory['ProductSize']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Inventory'), array('action' => 'edit', $inventory['Inventory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Inventory'), array('action' => 'delete', $inventory['Inventory']['id']), null, __('Are you sure you want to delete # %s?', $inventory['Inventory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Inventories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inventory'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Sizes'), array('controller' => 'product_sizes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Size'), array('controller' => 'product_sizes', 'action' => 'add')); ?> </li>
	</ul>
</div>

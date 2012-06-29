<div class="orders view">
<h2><?php  echo __('Order');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($order['Order']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($order['Order']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order State'); ?></dt>
		<dd>
			<?php echo $this->Html->link($order['OrderState']['name'], array('controller' => 'order_states', 'action' => 'view', $order['OrderState']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comments'); ?></dt>
		<dd>
			<?php echo h($order['Order']['comments']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Information'); ?></dt>
		<dd>
			<?php echo h($order['Order']['information']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($order['User']['name'], array('controller' => 'users', 'action' => 'view', $order['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Address'); ?></dt>
		<dd>
			<?php echo $this->Html->link($order['UserAddress']['name'], array('controller' => 'user_addresses', 'action' => 'view', $order['UserAddress']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($order['Order']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($order['Order']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Order'), array('action' => 'edit', $order['Order']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Order'), array('action' => 'delete', $order['Order']['id']), null, __('Are you sure you want to delete # %s?', $order['Order']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order States'), array('controller' => 'order_states', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order State'), array('controller' => 'order_states', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Addresses'), array('controller' => 'user_addresses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Address'), array('controller' => 'user_addresses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('controller' => 'order_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Item'), array('controller' => 'order_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Order Items');?></h3>
	<?php if (!empty($order['OrderItem'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Order Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Color Id'); ?></th>
		<th><?php echo __('Product Size Id'); ?></th>
		<th><?php echo __('Quantity'); ?></th>
		<th><?php echo __('Single Item Price'); ?></th>
		<th><?php echo __('Single Item Tax'); ?></th>
		<th><?php echo __('Total Items Price'); ?></th>
		<th><?php echo __('Total Items Tax'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($order['OrderItem'] as $orderItem): ?>
		<tr>
			<td><?php echo $orderItem['id'];?></td>
			<td><?php echo $orderItem['order_id'];?></td>
			<td><?php echo $orderItem['product_id'];?></td>
			<td><?php echo $orderItem['color_id'];?></td>
			<td><?php echo $orderItem['product_size_id'];?></td>
			<td><?php echo $orderItem['quantity'];?></td>
			<td><?php echo $orderItem['single_item_price'];?></td>
			<td><?php echo $orderItem['single_item_tax'];?></td>
			<td><?php echo $orderItem['total_items_price'];?></td>
			<td><?php echo $orderItem['total_items_tax'];?></td>
			<td><?php echo $orderItem['created'];?></td>
			<td><?php echo $orderItem['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'order_items', 'action' => 'view', $orderItem['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'order_items', 'action' => 'edit', $orderItem['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'order_items', 'action' => 'delete', $orderItem['id']), null, __('Are you sure you want to delete # %s?', $orderItem['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Order Item'), array('controller' => 'order_items', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>

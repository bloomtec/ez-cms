<div class="shoppingCarts view">
<h2><?php  echo __('Shopping Cart');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($shoppingCart['ShoppingCart']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($shoppingCart['User']['name'], array('controller' => 'users', 'action' => 'view', $shoppingCart['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($shoppingCart['ShoppingCart']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($shoppingCart['ShoppingCart']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Shopping Cart'), array('action' => 'edit', $shoppingCart['ShoppingCart']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Shopping Cart'), array('action' => 'delete', $shoppingCart['ShoppingCart']['id']), null, __('Are you sure you want to delete # %s?', $shoppingCart['ShoppingCart']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Shopping Carts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shopping Cart'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cart Items'), array('controller' => 'cart_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cart Item'), array('controller' => 'cart_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Cart Items');?></h3>
	<?php if (!empty($shoppingCart['CartItem'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Shopping Cart Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Product Size Id'); ?></th>
		<th><?php echo __('Quantity'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($shoppingCart['CartItem'] as $cartItem): ?>
		<tr>
			<td><?php echo $cartItem['id'];?></td>
			<td><?php echo $cartItem['shopping_cart_id'];?></td>
			<td><?php echo $cartItem['product_id'];?></td>
			<td><?php echo $cartItem['product_size_id'];?></td>
			<td><?php echo $cartItem['quantity'];?></td>
			<td><?php echo $cartItem['created'];?></td>
			<td><?php echo $cartItem['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'cart_items', 'action' => 'view', $cartItem['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'cart_items', 'action' => 'edit', $cartItem['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'cart_items', 'action' => 'delete', $cartItem['id']), null, __('Are you sure you want to delete # %s?', $cartItem['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Cart Item'), array('controller' => 'cart_items', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>

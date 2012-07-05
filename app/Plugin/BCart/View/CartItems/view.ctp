<div class="cartItems view">
<h2><?php  echo __('Cart Item');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($cartItem['CartItem']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shopping Cart'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cartItem['ShoppingCart']['id'], array('controller' => 'shopping_carts', 'action' => 'view', $cartItem['ShoppingCart']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cartItem['Product']['name'], array('controller' => 'products', 'action' => 'view', $cartItem['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product Size'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cartItem['ProductSize']['name'], array('controller' => 'product_sizes', 'action' => 'view', $cartItem['ProductSize']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($cartItem['CartItem']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($cartItem['CartItem']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($cartItem['CartItem']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cart Item'), array('action' => 'edit', $cartItem['CartItem']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Cart Item'), array('action' => 'delete', $cartItem['CartItem']['id']), null, __('Are you sure you want to delete # %s?', $cartItem['CartItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cart Items'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cart Item'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shopping Carts'), array('controller' => 'shopping_carts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shopping Cart'), array('controller' => 'shopping_carts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Sizes'), array('controller' => 'product_sizes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Size'), array('controller' => 'product_sizes', 'action' => 'add')); ?> </li>
	</ul>
</div>

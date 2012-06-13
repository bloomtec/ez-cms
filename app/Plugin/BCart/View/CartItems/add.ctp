<div class="cartItems form">
<?php echo $this->Form->create('CartItem');?>
	<fieldset>
		<legend><?php echo __('Add Cart Item'); ?></legend>
	<?php
		echo $this->Form->input('shopping_cart_id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('product_size_id');
		echo $this->Form->input('quantity');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Cart Items'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Shopping Carts'), array('controller' => 'shopping_carts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shopping Cart'), array('controller' => 'shopping_carts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Sizes'), array('controller' => 'product_sizes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Size'), array('controller' => 'product_sizes', 'action' => 'add')); ?> </li>
	</ul>
</div>

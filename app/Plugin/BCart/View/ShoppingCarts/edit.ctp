<div class="shoppingCarts form">
<?php echo $this->Form->create('ShoppingCart');?>
	<fieldset>
		<legend><?php echo __('Edit Shopping Cart'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ShoppingCart.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ShoppingCart.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Shopping Carts'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cart Items'), array('controller' => 'cart_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cart Item'), array('controller' => 'cart_items', 'action' => 'add')); ?> </li>
	</ul>
</div>

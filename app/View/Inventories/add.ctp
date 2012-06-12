<div class="inventories form">
<?php echo $this->Form->create('Inventory');?>
	<fieldset>
		<legend><?php echo __('Add Inventory'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Inventories'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Sizes'), array('controller' => 'product_sizes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Size'), array('controller' => 'product_sizes', 'action' => 'add')); ?> </li>
	</ul>
</div>

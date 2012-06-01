<div class="menuItems form">
<?php echo $this->Form->create('MenuItem');?>
	<fieldset>
		<legend><?php echo __('Add Menu Item'); ?></legend>
	<?php
		echo $this->Form->input('position');
		echo $this->Form->input('menu_id');
		echo $this->Form->input('name');
		echo $this->Form->input('link');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Menu Items'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Menus'), array('controller' => 'menus', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add')); ?> </li>
	</ul>
</div>

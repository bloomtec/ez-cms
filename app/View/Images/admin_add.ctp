<div class="images form">
<?php echo $this->Form->create('Image');?>
	<fieldset>
		<legend><?php echo __('Admin Add Image'); ?></legend>
	<?php
		echo $this->Form->input('gallery_id');
		echo $this->Form->input('caption');
		echo $this->Form->input('path');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Images'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Galleries'), array('controller' => 'galleries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Gallery'), array('controller' => 'galleries', 'action' => 'add')); ?> </li>
	</ul>
</div>

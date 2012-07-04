<div class="surveys form">
<?php echo $this->Form->create('Survey');?>
	<fieldset>
 		<legend><?php __('Add Survey'); ?></legend>
	<?php
		echo $this->Form->input('titulo');
		echo $this->Form->input('estado');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Surveys', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Survey Options', true), array('controller' => 'survey_options', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Survey Option', true), array('controller' => 'survey_options', 'action' => 'add')); ?> </li>
	</ul>
</div>
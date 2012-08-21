<div class="surveyOptions form">
<?php echo $this->Form->create('SurveyOption');?>
	<fieldset>
 		<legend><?php __('Admin Add Survey Option'); ?></legend>
	<?php
		echo $this->Form->input('survey_id');
		echo $this->Form->input('name');
		echo $this->Form->input('votos');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Survey Options', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Surveys', true), array('controller' => 'surveys', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Survey', true), array('controller' => 'surveys', 'action' => 'add')); ?> </li>
	</ul>
</div>
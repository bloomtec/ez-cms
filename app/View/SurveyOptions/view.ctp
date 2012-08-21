<div class="surveyOptions view">
<h2><?php  __('Survey Option');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surveyOption['SurveyOption']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Survey'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($surveyOption['Survey']['titulo'], array('controller' => 'surveys', 'action' => 'view', $surveyOption['Survey']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surveyOption['SurveyOption']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Votos'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surveyOption['SurveyOption']['votos']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Survey Option', true), array('action' => 'edit', $surveyOption['SurveyOption']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Survey Option', true), array('action' => 'delete', $surveyOption['SurveyOption']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $surveyOption['SurveyOption']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Survey Options', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Survey Option', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Surveys', true), array('controller' => 'surveys', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Survey', true), array('controller' => 'surveys', 'action' => 'add')); ?> </li>
	</ul>
</div>

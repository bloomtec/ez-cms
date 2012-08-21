<div class="surveys view">
<h2><?php  __('Survey');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $survey['Survey']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Titulo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $survey['Survey']['titulo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Estado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $survey['Survey']['estado']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $survey['Survey']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $survey['Survey']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Survey', true), array('action' => 'edit', $survey['Survey']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Survey', true), array('action' => 'delete', $survey['Survey']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $survey['Survey']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Surveys', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Survey', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Survey Options', true), array('controller' => 'survey_options', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Survey Option', true), array('controller' => 'survey_options', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Survey Options');?></h3>
	<?php if (!empty($survey['SurveyOption'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Survey Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Votos'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($survey['SurveyOption'] as $surveyOption):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $surveyOption['id'];?></td>
			<td><?php echo $surveyOption['survey_id'];?></td>
			<td><?php echo $surveyOption['name'];?></td>
			<td><?php echo $surveyOption['votos'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'survey_options', 'action' => 'view', $surveyOption['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'survey_options', 'action' => 'edit', $surveyOption['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'survey_options', 'action' => 'delete', $surveyOption['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $surveyOption['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Survey Option', true), array('controller' => 'survey_options', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>

<div class="surveyOptions index">
	<h2><?php __('Survey Options');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('survey_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('votos');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($surveyOptions as $surveyOption):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $surveyOption['SurveyOption']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($surveyOption['Survey']['titulo'], array('controller' => 'surveys', 'action' => 'view', $surveyOption['Survey']['id'])); ?>
		</td>
		<td><?php echo $surveyOption['SurveyOption']['name']; ?>&nbsp;</td>
		<td><?php echo $surveyOption['SurveyOption']['votos']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $surveyOption['SurveyOption']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $surveyOption['SurveyOption']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $surveyOption['SurveyOption']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $surveyOption['SurveyOption']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página %page% de %pages%, mostrando %current% registros de un total de %count%, desde el %start%, hasta el %end%')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->first('<< ', array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->prev('< ' . __('anterior '), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__(' siguiente') . ' >', array(), null, array('class' => 'next disabled'));
		echo $this->Paginator->last(' >>', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Survey Option', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Surveys', true), array('controller' => 'surveys', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Survey', true), array('controller' => 'surveys', 'action' => 'add')); ?> </li>
	</ul>
</div>
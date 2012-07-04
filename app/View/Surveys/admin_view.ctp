<div class="surveys view">
<h2><?php  __('Encuesta');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>

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
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Creada'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $survey['Survey']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Actualizada'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $survey['Survey']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php 
$total=0;
foreach ($survey['SurveyOption'] as $surveyOption){
	$total+=$surveyOption['votos'];
}
?>
<div class="related">
	<h3><?php __('Opciones');?></h3>
	<?php if (!empty($survey['SurveyOption'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Name'); ?></th>
		<th><?php __('Votos'); ?></th>
		<th><?php __('Porcentaje'); ?></th>
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

			<td><?php echo $surveyOption['name'];?></td>
			<td><?php echo $surveyOption['votos'];?></td>
			<td><?php echo round($surveyOption['votos']/$total*100)/10;?></td>
		</tr>
	<?php endforeach; ?>
		<tr>
		<th>TOTAL</th>
		<th><?php echo $total; ?></th>
		<th><?php __('100%'); ?></th>
	</tr>
	</table>
<?php endif; ?>


</div>

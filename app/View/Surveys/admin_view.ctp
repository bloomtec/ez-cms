<div class="surveys view">
<h2><?php  __('Encuesta');?></h2>
	<dl>
		<dt> <?php echo __('Titulo'); ?> </dt>
		<dd>
			<?php echo $survey['Survey']['titulo']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Estado'); ?></dt>
		<dd>
			<?php
				if($survey['Survey']['estado']) {
					echo 'Activo';
				} else {
					echo 'Inactivo';
				}
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creada'); ?></dt>
		<dd>
			<?php echo $survey['Survey']['created']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Actualizada'); ?></dt>
		<dd>
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
		<th><?php echo  __('Name'); ?></th>
		<th><?php echo __('Votos'); ?></th>
		<th><?php echo __('Porcentaje'); ?></th>
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
			<td><?php if($total)echo round($surveyOption['votos']/$total*100);?> %</td>
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

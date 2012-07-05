<div class="colors view">
<h2><?php  echo __('Color');?></h2>
	<dl>
			
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($color['Color']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Código'); ?></dt>
		<dd>
			<span style="display:block;width:33px;float:left;background:<?php echo $color['Color']['code']; ?>">&nbsp;</span>
			&nbsp;
			<?php echo h($color['Color']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creado'); ?></dt>
		<dd>
			<?php echo h($color['Color']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($color['Color']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
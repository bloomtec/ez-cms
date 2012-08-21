<div class="colors index">
	<h2><?php echo __('Colores'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<!--<th><?php echo $this -> Paginator -> sort('id'); ?></th>-->
			<th><?php echo $this -> Paginator -> sort('name', 'Nombre'); ?></th>
			<th><?php echo $this -> Paginator -> sort('code', 'Código'); ?></th>
			<th><?php echo $this -> Paginator -> sort('created', 'Creado'); ?></th>
			<th><?php echo $this -> Paginator -> sort('updated', 'Modificado'); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
		</tr>
		<?php foreach ($colors as $color): ?>
		<tr>
			<!--<td><?php echo h($color['Color']['id']); ?>&nbsp;</td>-->
			<td><?php echo h($color['Color']['name']); ?>&nbsp;</td>
			<td><span style="display:block;width:33px;float:left;background:<?php echo $color['Color']['code']; ?>">&nbsp;</span> &nbsp; <?php echo h($color['Color']['code']); ?>&nbsp;</td>
			<td><?php echo h($color['Color']['created']); ?>&nbsp;</td>
			<td><?php echo h($color['Color']['updated']); ?>&nbsp;</td>
			<td class="actions"><?php echo $this -> Html -> link(__('Ver'), array('action' => 'view', $color['Color']['id'])); ?>
			<?php echo $this -> Html -> link(__('Modificar'), array('action' => 'edit', $color['Color']['id'])); ?>
			<?php //echo $this -> Form -> postLink(__('Eliminar'), array('action' => 'delete', $color['Color']['id']), null, __('Are you sure you want to delete # %s?', $color['Color']['id'])); ?></td>
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
	<ul>
		<li>
			<?php echo $this -> Html -> link(__('Agregar Color'), array('action' => 'add')); ?>
		</li>
	</ul>
</div>
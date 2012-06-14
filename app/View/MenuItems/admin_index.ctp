<div class="menuItems index">
	<h2><?php echo __('Menu Items');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<!--<th><?php echo $this->Paginator->sort('id');?></th>-->
			<th><?php echo $this->Paginator->sort('menu_id', 'Menú');?></th>
			<th><?php echo $this->Paginator->sort('name', 'Nombre');?></th>
			<th><?php echo $this->Paginator->sort('position', 'Posición');?></th>
			<th><?php echo $this->Paginator->sort('link', 'Enlace');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Creado');?></th>
			<th><?php echo $this->Paginator->sort('updated', 'Modificado');?></th>
			<th class="actions"><?php echo __('Acciones');?></th>
	</tr>
	<?php
	foreach ($menuItems as $menuItem): ?>
	<tr>
		<!--<td><?php echo h($menuItem['MenuItem']['id']); ?>&nbsp;</td>-->
		<td>
			<?php echo $this->Html->link($menuItem['Menu']['name'], array('controller' => 'menus', 'action' => 'view', $menuItem['Menu']['id'])); ?>
		</td>
		<td><?php echo h($menuItem['MenuItem']['name']); ?>&nbsp;</td>
		<td><?php echo h($menuItem['MenuItem']['position']); ?>&nbsp;</td>
		<td>
			<?php
				if(is_numeric($menuItem['MenuItem']['link'])) {
					echo h($pages[$menuItem['MenuItem']['link']]);
				} else {
					echo h($menuItem['MenuItem']['link']);
				}
			?>
			&nbsp;
		</td>
		<td><?php echo h($menuItem['MenuItem']['created']); ?>&nbsp;</td>
		<td><?php echo h($menuItem['MenuItem']['updated']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $menuItem['MenuItem']['id'])); ?>
			<?php
				if($menuItem['MenuItem']['id'] >= 20) {
					echo $this->Html->link(__('Modificar'), array('action' => 'edit', $menuItem['MenuItem']['id']));
					echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $menuItem['MenuItem']['id']), null, __('¿Seguro desea eliminar %s?', $menuItem['MenuItem']['name']));
				}
			?>
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
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Agregar Ítem De Menú'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Ver Menús'), array('controller' => 'menus', 'action' => 'index')); ?> </li>
		<!--<li><?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add')); ?> </li>-->
	</ul>
</div>

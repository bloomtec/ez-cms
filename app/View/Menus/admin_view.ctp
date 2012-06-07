<div class="menus view">
<h2><?php  echo __('Menú');?></h2>
	<dl>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($menu['Menu']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<!--<li><?php echo $this->Html->link(__('Edit Menu'), array('action' => 'edit', $menu['Menu']['id'])); ?> </li>-->
		<!--<li><?php echo $this->Form->postLink(__('Delete Menu'), array('action' => 'delete', $menu['Menu']['id']), null, __('Are you sure you want to delete # %s?', $menu['Menu']['id'])); ?> </li>-->
		<li><?php echo $this->Html->link(__('Ver Menús'), array('action' => 'index')); ?> </li>
		<!--<li><?php echo $this->Html->link(__('New Menu'), array('action' => 'add')); ?> </li>-->
		<li><?php echo $this->Html->link(__('Ver Ítems De Menú'), array('controller' => 'menu_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Crear Ítem De Menú'), array('controller' => 'menu_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Ítems De Menú Relacionados');?></h3>
	<?php if (!empty($menu['MenuItem'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Posición'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th><?php echo __('Enlace'); ?></th>
		<th><?php echo __('Creado'); ?></th>
		<th><?php echo __('Modificado'); ?></th>
		<th class="actions"><?php echo __('Acciones');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($menu['MenuItem'] as $menuItem): ?>
		<tr>
			<td><?php echo $menuItem['position'];?></td>
			<td><?php echo $menuItem['name'];?></td>
			<td><?php echo $menuItem['link'];?></td>
			<td><?php echo $menuItem['created'];?></td>
			<td><?php echo $menuItem['updated'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Ver'), array('controller' => 'menu_items', 'action' => 'view', $menuItem['id'])); ?>
				<?php echo $this->Html->link(__('Modificar'), array('controller' => 'menu_items', 'action' => 'edit', $menuItem['id'])); ?>
				<?php echo $this->Form->postLink(__('Eliminar'), array('controller' => 'menu_items', 'action' => 'delete', $menuItem['id']), null, __('¿Seguro desea eliminar %s?', $menuItem['name'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Crear Ítem De Menú'), array('controller' => 'menu_items', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
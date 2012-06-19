<div class="menuItems view">
<h2><?php  echo __('Menu Item');?></h2>
	<dl>
		<dt><?php echo __('Posición'); ?></dt>
		<dd>
			<?php echo h($menuItem['MenuItem']['position']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Menu'); ?></dt>
		<dd>
			<?php echo $this->Html->link($menuItem['Menu']['name'], array('controller' => 'menus', 'action' => 'view', $menuItem['Menu']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($menuItem['MenuItem']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Enlace'); ?></dt>
		<dd>
			<?php //echo h($menuItem['MenuItem']['link']); ?>
			<?php
				if(is_numeric($menuItem['MenuItem']['link'])) {
					echo h('Página ' . $pages[$menuItem['MenuItem']['link']]);
				} else {
					echo h($menuItem['MenuItem']['link']);
				}
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creado'); ?></dt>
		<dd>
			<?php echo h($menuItem['MenuItem']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($menuItem['MenuItem']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<?php if($menuItem['MenuItem']['id'] >= 20) : ?>
		<li><?php echo $this->Html->link(__('Modificar Ítem De Menú'), array('action' => 'edit', $menuItem['MenuItem']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Eliminar Ítem De Menú'), array('action' => 'delete', $menuItem['MenuItem']['id']), null, __('¿Seguro desea eliminar %s?', $menuItem['MenuItem']['name'])); ?> </li>
		<?php endif; ?>
		<li><?php echo $this->Html->link(__('Ver Ítems De Menú'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Agregar Ítem De Menú'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Ver Menús'), array('controller' => 'menus', 'action' => 'index')); ?> </li>
		<!--<li><?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add')); ?> </li>-->
	</ul>
</div>

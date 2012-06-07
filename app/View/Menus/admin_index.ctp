<div class="menus index">
	<h2><?php echo __('Menus'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<!--<th><?php echo $this -> Paginator -> sort('id'); ?></th>-->
			<!--<th><?php echo $this -> Paginator -> sort('position'); ?></th>-->
			<th><?php echo $this -> Paginator -> sort('name', 'Nombre'); ?></th>
			<!--<th><?php echo $this -> Paginator -> sort('created', 'Creado'); ?></th>-->
			<!--<th><?php echo $this -> Paginator -> sort('updated', 'Modificado'); ?></th>-->
			<th class="actions"><?php echo __('Acciones'); ?></th>
		</tr>
		<?php foreach ($menus as $menu): ?>
		<tr>
			<!--<td><?php echo h($menu['Menu']['id']); ?>&nbsp;</td>-->
			<!--<td><?php echo h($menu['Menu']['position']); ?>&nbsp;</td>-->
			<td><?php echo h($menu['Menu']['name']); ?>&nbsp;</td>
			<!--<td><?php echo h($menu['Menu']['created']); ?>&nbsp;</td>-->
			<!--<td><?php echo h($menu['Menu']['updated']); ?>&nbsp;</td>-->
			<td class="actions"><?php echo $this -> Html -> link(__('Ver'), array('action' => 'view', $menu['Menu']['id'])); ?>
			<?php // echo $this->Html->link(__('Edit'), array('action' => 'edit', $menu['Menu']['id'])); ?>
			<?php // echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $menu['Menu']['id']), null, __('Are you sure you want to delete # %s?', $menu['Menu']['id'])); ?></td>
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
		<li>
			<?php echo $this -> Html -> link(__('Ver Ítems De Menú'), array('controller' => 'menu_items', 'action' => 'index')); ?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('Agregar Ítem De Menú'), array('controller' => 'menu_items', 'action' => 'add')); ?>
		</li>
		<!--<li><?php echo $this->Html->link(__('New Menu'), array('action' => 'add')); ?></li>-->
	</ul>
</div>

<div class="pages index">
	<h2><?php echo __('Páginas'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<!--<th><?php echo $this->Paginator->sort('id');?></th>-->
			<th><?php echo $this -> Paginator -> sort('name', 'Nombre'); ?></th>
			<th><?php echo $this -> Paginator -> sort('description', 'Descripción'); ?></th>
			<!--<th><?php echo $this->Paginator->sort('keywords');?></th>-->
			<th><?php echo $this -> Paginator -> sort('is_active', 'Activa'); ?></th>
			<th><?php echo $this -> Paginator -> sort('created', 'Creada'); ?></th>
			<th><?php echo $this -> Paginator -> sort('updated', 'Modificada'); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
		</tr>
		<?php foreach ($pages as $page): ?>
		<tr>
			<!--<td><?php echo h($page['Page']['id']); ?>&nbsp;</td>-->
			<td><?php echo h($page['Page']['name']); ?>&nbsp;</td>
			<td><?php echo h($page['Page']['description']); ?>&nbsp;</td>
			<!--<td><?php echo h($page['Page']['keywords']); ?>&nbsp;</td>-->
			<td><?php echo h($page['Page']['is_active']); ?>&nbsp;</td>
			<td><?php echo h($page['Page']['created']); ?>&nbsp;</td>
			<td><?php echo h($page['Page']['updated']); ?>&nbsp;</td>
			<td class="actions"><?php echo $this -> Html -> link(__('Ver'), array('action' => 'view', $page['Page']['id'])); ?>
			<?php echo $this -> Html -> link(__('Modificar'), array('action' => 'edit', $page['Page']['id'])); ?>
			<?php echo $this -> Form -> postLink(__('Eliminar'), array('action' => 'delete', $page['Page']['id']), null, __('¿Seguro desea elimnar %s?', $page['Page']['name'])); ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
	<p>
		<?php
		echo $this -> Paginator -> counter(array('format' => __('Página %page% de %pages%, mostrando %current% registros de un total de %count%, desde el %start%, hasta el %end%')));
		?>
	</p>

	<div class="paging">
		<?php
		echo $this -> Paginator -> first('<< ', array(), null, array('class' => 'prev disabled'));
		echo $this -> Paginator -> prev('< ' . __('anterior '), array(), null, array('class' => 'prev disabled'));
		echo $this -> Paginator -> numbers(array('separator' => ''));
		echo $this -> Paginator -> next(__(' siguiente') . ' >', array(), null, array('class' => 'next disabled'));
		echo $this -> Paginator -> last(' >>', array(), null, array('class' => 'next disabled'));
		?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li>
			<?php echo $this -> Html -> link(__('Agregar Página'), array('action' => 'add')); ?>
		</li>
	</ul>
</div>

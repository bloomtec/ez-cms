<div class="inventories index">
	<h2><?php echo __('Inventories'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<!--<th><?php echo $this -> Paginator -> sort('id'); ?></th>-->
			<th><?php echo $this -> Paginator -> sort('product_id', 'Producto'); ?></th>
			<th><?php echo $this -> Paginator -> sort('color_id', 'Color'); ?></th>
			<th><?php echo $this -> Paginator -> sort('product_size_id', 'Talla'); ?></th>
			<th><?php echo $this -> Paginator -> sort('quantity', 'Cantidad'); ?></th>
			<th><?php echo $this -> Paginator -> sort('created', 'Creado'); ?></th>
			<th><?php echo $this -> Paginator -> sort('updated', 'Modificado'); ?></th>
		</tr>
		<?php foreach ($inventories as $inventory):	?>
		<tr>
			<!--<td><?php echo h($inventory['Inventory']['id']); ?>&nbsp;</td>-->
			<td><?php echo $this -> Html -> link($inventory['Product']['name'], array('controller' => 'products', 'action' => 'view', $inventory['Product']['id'])); ?></td>
			<td><?php echo $this -> Html -> link($inventory['Color']['name'], array('controller' => 'colors', 'action' => 'view', $inventory['Color']['id'])); ?></td>
			<td><?php echo $this -> Html -> link($inventory['ProductSize']['name'], array('controller' => 'product_sizes', 'action' => 'view', $inventory['ProductSize']['id'])); ?></td>
			<td><?php echo h($inventory['Inventory']['quantity']); ?>&nbsp;</td>
			<td><?php echo h($inventory['Inventory']['created']); ?>&nbsp;</td>
			<td><?php echo h($inventory['Inventory']['updated']); ?>&nbsp;</td>
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
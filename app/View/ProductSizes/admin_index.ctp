<div class="productSizes index">
	<h2><?php echo __('Product Sizes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<!--<th><?php echo $this -> Paginator -> sort('id'); ?></th>-->
			<th><?php echo $this -> Paginator -> sort('order', 'Posición'); ?></th>
			<th><?php echo $this -> Paginator -> sort('name', 'Talla'); ?></th>
			<th><?php echo $this -> Paginator -> sort('created', 'Creada'); ?></th>
			<th><?php echo $this -> Paginator -> sort('updated', 'Modificada'); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
		</tr>
		<?php foreach ($productSizes as $productSize): ?>
		<tr>
			<td><?php echo h($productSize['ProductSize']['id']); ?>&nbsp;</td>
			<td><?php echo h($productSize['ProductSize']['name']); ?>&nbsp;</td>
			<td><?php echo h($productSize['ProductSize']['order']); ?>&nbsp;</td>
			<td><?php echo h($productSize['ProductSize']['created']); ?>&nbsp;</td>
			<td><?php echo h($productSize['ProductSize']['updated']); ?>&nbsp;</td>
			<td class="actions"><?php echo $this -> Html -> link(__('View'), array('action' => 'view', $productSize['ProductSize']['id'])); ?>
			<?php echo $this -> Html -> link(__('Edit'), array('action' => 'edit', $productSize['ProductSize']['id'])); ?>
			<?php echo $this -> Form -> postLink(__('Delete'), array('action' => 'delete', $productSize['ProductSize']['id']), null, __('Are you sure you want to delete # %s?', $productSize['ProductSize']['id'])); ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
	<p>
		<?php
		echo $this -> Paginator -> counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));
		?>
	</p>

	<div class="paging">
		<?php
		echo $this -> Paginator -> prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this -> Paginator -> numbers(array('separator' => ''));
		echo $this -> Paginator -> next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li>
			<?php echo $this -> Html -> link(__('New Product Size'), array('action' => 'add')); ?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('List Inventories'), array('controller' => 'inventories', 'action' => 'index')); ?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('New Inventory'), array('controller' => 'inventories', 'action' => 'add')); ?>
		</li>
	</ul>
</div>

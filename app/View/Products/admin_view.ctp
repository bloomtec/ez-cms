<div class="products view">
<h2>
	<?php
		echo __('Producto');
	?>
</h2>
	<dl>
		<!--<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($product['Product']['id']); ?>
			&nbsp;
		</dd>-->
		<dt><?php echo __('Categoría'); ?></dt>
		<dd>
			<?php echo $this->Html->link($product['Category']['name'], array('controller' => 'categories', 'action' => 'view', $product['Category']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($product['Product']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Referencia'); ?></dt>
		<dd>
			<?php echo h($product['Product']['reference']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Precio'); ?></dt>
		<dd>
			<?php echo h($product['Product']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Base I.V.A.'); ?></dt>
		<dd>
			<?php echo h($product['Product']['tax_base']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Valor I.V.A.'); ?></dt>
		<dd>
			<?php echo h($product['Product']['tax_value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descripción'); ?></dt>
		<dd>
			<?php echo h($product['Product']['description']); ?>
			&nbsp;
		</dd>
		<!--<dt><?php echo __('Order'); ?></dt>
		<dd>
			<?php echo h($product['Product']['order']); ?>
			&nbsp;
		</dd>-->
		<dt><?php echo __('Activo'); ?></dt>
		<dd>
			<?php
				//echo h($product['Product']['is_active']);
				if($product['Product']['is_active']) {
					echo '<input type="checkbox" checked="checked" disabled="true" />';
				} else {
					echo '<input type="checkbox" disabled="true" />';
				}
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Promocionado'); ?></dt>
		<dd>
			<?php
				//echo h($product['Product']['is_promoted']);
				if($product['Product']['is_promoted']) {
					echo '<input type="checkbox" checked="checked" disabled="true" />';
				} else {
					echo '<input type="checkbox" disabled="true" />';
				}
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Novedad'); ?></dt>
		<dd>
			<?php
				//echo h($product['Product']['is_novelty']);
				if($product['Product']['is_novelty']) {
					echo '<input type="checkbox" checked="checked" disabled="true" />';
				} else {
					echo '<input type="checkbox" disabled="true" />';
				}
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Más Vendido'); ?></dt>
		<dd>
			<?php
				//echo h($product['Product']['is_top_seller']);
				if($product['Product']['is_top_seller']) {
					echo '<input type="checkbox" checked="checked" disabled="true" />';
				} else {
					echo '<input type="checkbox" disabled="true" />';
				}
			?>
			&nbsp;
		</dd>
		<dt><?php echo __('Imagen'); ?></dt>
		<dd>
			<!--<?php echo h($product['Product']['image']); ?>
			&nbsp;-->
			<img src="/img/uploads/215x215/<?php echo $product['Product']['image']; ?>" />
			&nbsp;
		</dd>
		<dt><?php echo __('Creado'); ?></dt>
		<dd>
			<?php echo h($product['Product']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificado'); ?></dt>
		<dd>
			<?php echo h($product['Product']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Modificar'), array('action' => 'edit', $product['Product']['id'])); ?> </li>
		<!--<li><?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $product['Product']['id']), null, __('¿Seguro desea eliminar %s?', $product['Product']['name'])); ?> </li>-->
		<li><?php echo $this->Html->link(__('Ver Productos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Agregar Producto'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Ver Categorías'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Agregar Categoría'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<!--<li><?php echo $this->Html->link(__('Ver Inventario'), array('controller' => 'inventories', 'action' => 'view')); ?> </li>-->
		<!--<li><?php echo $this->Html->link(__('New Inventory'), array('controller' => 'inventories', 'action' => 'add')); ?> </li>-->
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Inventario De Producto'); ?></h3>
	<?php if (!empty($product['Inventory'])): ?>
	<table id="sortable" cellpadding="0" cellspacing="0" controller="menu_items">
		<tbody>
			<tr class="ui-state-disabled">
				<th><?php echo __('Color'); ?></th>
				<th><?php echo __('Talla'); ?></th>
				<th><?php echo __('Cantidad'); ?></th>
			</tr>
			<?php $i = 0; foreach ($product['Inventory'] as $inventory):	?>
			<tr id="<?php echo $inventory['id']?>" class="ui-state-default">
				<td><?php echo $inventory['color']; ?></td>
				<td><?php echo $inventory['size']; ?></td>
				<td><?php echo $inventory['quantity']; ?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php endif; ?>
</div>
	
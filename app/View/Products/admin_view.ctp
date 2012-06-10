<div class="products view">
<h2><?php  echo __('Producto');?></h2>
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
			<?php echo h($product['Product']['image']); ?>
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
		<li><?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $product['Product']['id']), null, __('¿Seguro desea eliminar %s?', $product['Product']['name'])); ?> </li>
		<li><?php echo $this->Html->link(__('Ver Productos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Agregar Producto'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Ver Categorías'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Agregar Categoría'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Ver Inventario'), array('controller' => 'inventories', 'action' => 'view')); ?> </li>
		<!--<li><?php echo $this->Html->link(__('New Inventory'), array('controller' => 'inventories', 'action' => 'add')); ?> </li>-->
	</ul>
</div>
	<!--<div class="related">
		<h3><?php echo __('Related Inventories');?></h3>
	<?php if (!empty($product['Inventory'])):?>
		<dl>
			<dt><?php echo __('Id');?></dt>
		<dd>
	<?php echo $product['Inventory']['id'];?>
&nbsp;</dd>
		<dt><?php echo __('Product Id');?></dt>
		<dd>
	<?php echo $product['Inventory']['product_id'];?>
&nbsp;</dd>
		<dt><?php echo __('Quantity');?></dt>
		<dd>
	<?php echo $product['Inventory']['quantity'];?>
&nbsp;</dd>
		<dt><?php echo __('Created');?></dt>
		<dd>
	<?php echo $product['Inventory']['created'];?>
&nbsp;</dd>
		<dt><?php echo __('Updated');?></dt>
		<dd>
	<?php echo $product['Inventory']['updated'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Inventory'), array('controller' => 'inventories', 'action' => 'edit', $product['Inventory']['id'])); ?></li>
			</ul>
		</div>
	</div>-->
	
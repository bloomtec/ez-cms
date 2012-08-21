<div class="categories view">
<h2><?php  echo __('Categoría');?></h2>
	<dl>
		<!--<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($category['Category']['id']); ?>
			&nbsp;
		</dd>-->
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($category['Category']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descripción'); ?></dt>
		<dd>
			<?php echo h($category['Category']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Imagen'); ?></dt>
		<dd>
			<?php //echo h($category['Category']['image']); ?>
			<?php echo $this -> Html -> image("uploads/215x215/" . $category['Category']['image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Promocionada'); ?></dt>
		<dd>
			<?php
				//echo h($category['Category']['is_promoted']);
				if($category['Category']['is_promoted']) {
					echo '<input type="checkbox" checked="checked" disabled="true" />';
				} else {
					echo '<input type="checkbox" disabled="true" />';
				}
			?>
			&nbsp;
		</dd>
		<?php if($category['Category']['is_promoted']) : ?>
		<dt><?php echo __('Imagen Promocionada'); ?></dt>
		<dd>
			<?php //echo h($category['Category']['image']); ?>
			<?php echo $this -> Html -> image("uploads/215x215/" . $category['Category']['promoted_image']); ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		<dt><?php echo __('Posición'); ?></dt>
		<dd>
			<?php echo h($category['Category']['order']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creada'); ?></dt>
		<dd>
			<?php echo h($category['Category']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificada'); ?></dt>
		<dd>
			<?php echo h($category['Category']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Modificar'), array('action' => 'edit', $category['Category']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $category['Category']['id']), null, __('¿Seguro desea eliminar %s?', $category['Category']['name'])); ?> </li>
		<li><?php echo $this->Html->link(__('Ver Categorías'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Agregar Categoría'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Ver Productos'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Agregar Producto'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Productos Relacionados');?></h3>
	<?php if (!empty($category['Product'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>

		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Reference'); ?></th>
		<th><?php echo __('Precio'); ?></th>
		<th><?php echo __('Base I.V.A.'); ?></th>
		<th><?php echo __('Valor I.V.A.'); ?></th>
		<th><?php echo __('Activo'); ?></th>
		<th><?php echo __('Promocionado'); ?></th>
		<th><?php echo __('Novedad'); ?></th>
		<th><?php echo __('Más Vendido'); ?></th>
		<th><?php echo __('Imagen'); ?></th>
		<th class="actions"><?php echo __('Acciones');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($category['Product'] as $product): ?>
		<tr>
			<!--<td><?php echo $product['id'];?></td>-->
			<!--<td><?php echo $product['category_id'];?></td>-->
			<td><?php echo $product['name'];?></td>
			<td><?php echo $product['reference'];?></td>
			<td><?php echo $product['price'];?></td>
			<td><?php echo $product['tax_base'];?></td>
			<td><?php echo $product['tax_value'];?></td>
			<!--<td><?php echo $product['description'];?></td>-->
			<!--<td><?php echo $product['order'];?></td>-->
			<td><?php echo $product['is_active'];?></td>
			<td><?php echo $product['is_promoted'];?></td>
			<td><?php echo $product['is_novelty'];?></td>
			<td><?php echo $product['is_top_seller'];?></td>
			<td><?php echo $product['image'];?></td>
			<!--<td><?php echo $product['created'];?></td>-->
			<!--<td><?php echo $product['updated'];?></td>-->
			<td class="actions">
				<?php echo $this->Html->link(__('Ver'), array('controller' => 'products', 'action' => 'view', $product['id'])); ?>
				<?php echo $this->Html->link(__('Modificar'), array('controller' => 'products', 'action' => 'edit', $product['id'])); ?>
				<?php echo $this->Form->postLink(__('Eliminar'), array('controller' => 'products', 'action' => 'delete', $product['id']), null, __('¿Seguro desea eliminar %s?', $product['name'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('Agregar Producto'), array('controller' => 'products', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
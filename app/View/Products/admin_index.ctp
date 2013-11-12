<div class="products index">
	<h2><?php echo __('Productos');?></h2>
	<?php echo $this -> Form -> create('Search'); ?>
	<table id="ProductsSearch" class="search">
		<!--<tr>
			<th>Categoría</th><th>Nombre</th><th>Referencia</th><th>Activo</th><th>Promocionado</th><th>Novedad</th><th>Más Vendido</th><th></th>
		</tr>-->
		<tr>
			<td><?php echo $this -> Form -> input('Search.category_id', array('label' => 'Categoría', 'empty' => 'Seleccione...')); ?></td>
			<td><?php echo $this -> Form -> input('Search.name', array('label' => 'Nombre')); ?></td>
			<td><?php echo $this -> Form -> input('Search.reference', array('label' => 'Nombre')); ?></td>
			<td><?php echo $this -> Form -> input('Search.is_active', array('label' => 'Activo', 'type' => 'checkbox')); ?></td>
			<td><?php echo $this -> Form -> input('Search.is_promoted', array('label' => 'Promocionado', 'type' => 'checkbox')); ?></td>
			<td><?php echo $this -> Form -> input('Search.is_novelty', array('label' => 'Novedad', 'type' => 'checkbox')); ?></td>
			<td><?php echo $this -> Form -> input('Search.is_top_seller', array('label' => 'Más Vendido', 'type' => 'checkbox')); ?></td>
			<td><?php echo $this -> Form -> submit('Buscar'); ?></td>
		</tr>
	</table>
	<?php $this -> Form -> end(); ?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<!--<th><?php echo $this->Paginator->sort('id');?></th>-->
			<th><?php echo $this->Paginator->sort('category_id', 'Categoría');?></th>
			<th><?php echo $this->Paginator->sort('name', 'Nombre');?></th>
			<th><?php echo $this->Paginator->sort('reference', 'Referencia');?></th>
			<th><?php echo $this->Paginator->sort('price', 'Precio');?></th>
			<th><?php echo $this->Paginator->sort('is_active', 'Activo');?></th>
			<th><?php echo $this->Paginator->sort('is_promoted', 'Promocionado');?></th>
			<th><?php echo $this->Paginator->sort('is_novelty', 'Novedad');?></th>
			<th><?php echo $this->Paginator->sort('is_top_seller', 'Más Vendido');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Creado');?></th>
			<th><?php echo $this->Paginator->sort('updated', 'Modificado');?></th>
			<th class="actions"><?php echo __('Acciones');?></th>
	</tr>
	<?php
		//debug($products);
		foreach ($products as $product):
	?>
	<tr>
		<!--<td><?php echo h($product['Product']['id']); ?>&nbsp;</td>-->
		<td>
			<?php echo $this->Html->link($product['Category']['name'], array('controller' => 'categories', 'action' => 'view', $product['Category']['id'])); ?>
		</td>
		<td><?php echo h($product['Product']['name']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['reference']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['price']); ?>&nbsp;</td>
		
		<td>
			<?php
				//echo h($product['Product']['is_active']);
				if($product['Product']['is_active']) {
					echo '<input type="checkbox" checked="checked" disabled="true" />';
				} else {
					echo '<input type="checkbox" disabled="true" />';
				}
			?>
			&nbsp;
		</td>
		<td>
			<?php
				//echo h($product['Product']['is_promoted']);
				if($product['Product']['is_promoted']) {
					echo '<input type="checkbox" checked="checked" disabled="true" />';
				} else {
					echo '<input type="checkbox" disabled="true" />';
				}
			?>
			&nbsp;
		</td>
		<td>
			<?php
				//echo h($product['Product']['is_novelty']);
				if($product['Product']['is_novelty']) {
					echo '<input type="checkbox" checked="checked" disabled="true" />';
				} else {
					echo '<input type="checkbox" disabled="true" />';
				}
			?>
			&nbsp;
		</td>
		<td>
			<?php
				//echo h($product['Product']['is_top_seller']);
				if($product['Product']['is_top_seller']) {
					echo '<input type="checkbox" checked="checked" disabled="true" />';
				} else {
					echo '<input type="checkbox" disabled="true" />';
				}
			?>
			&nbsp;
		</td>
		<td><?php echo h($product['Product']['created']); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['updated']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $product['Product']['id'])); ?>
			<?php echo $this->Html->link(__('Modificar'), array('action' => 'edit', $product['Product']['id'])); ?>
			<?php echo $this->Html->link(__('Eliminar'), array('action' => 'delete', $product['Product']['id']), null, __('¿Seguro desea eliminar %s?', $product['Product']['name'])); ?>
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
	<ul>
		<li><?php echo $this->Html->link(__('Agregar Producto'), array('action' => 'add')); ?></li>
	</ul>
</div>
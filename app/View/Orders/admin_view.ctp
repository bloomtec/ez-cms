<div class="orders view">
<h2><?php  echo __('Order');?></h2>
	<dl>
		<dt><?php echo __('Código'); ?></dt>
		<dd>
			<?php echo h($order['Order']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Estado'); ?></dt>
		<dd>
			<?php echo $order['OrderState']['name']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comentarios'); ?></dt>
		<dd>
			<?php echo h($order['Order']['comments']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Información'); ?></dt>
		<dd>
			<?php echo h($order['Order']['information']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cupon'); ?></dt>
		<dd>
			<?php echo h($order['Order']['coupon_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Costo De Envío'); ?></dt>
		<dd>
			<?php echo h('$ ' . number_format($order['Order']['shipment_cost'], 2)); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Usuario'); ?></dt>
		<dd>
			<?php echo $this -> Html -> link($order['User']['username'], array('plugin' => 'user_control', 'controller' => 'users', 'action' => 'view', $order['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dirección'); ?></dt>
		<dd>
			<?php echo $order['UserAddress']['name'] . ' :: ' . $order['UserAddress']['address']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creada'); ?></dt>
		<dd>
			<?php echo h($order['Order']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modificada'); ?></dt>
		<dd>
			<?php echo h($order['Order']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Modificar Orden'), array('action' => 'edit', $order['Order']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Ver Ordenes'), array('action' => 'index')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Ítems Relacionados');?></h3>
	<?php if (!empty($order['OrderItem'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Produco'); ?></th>
		<th><?php echo __('Color'); ?></th>
		<th><?php echo __('Talla'); ?></th>
		<th><?php echo __('Cantidad'); ?></th>
		<th><?php echo __('Precio Unitario'); ?></th>
		<th><?php echo __('I.V.A. Unitario'); ?></th>
		<th><?php echo __('Total'); ?></th>
		<th><?php echo __('Total I.V.A.'); ?></th>
	</tr>
	<?php $i = 0; foreach ($order['OrderItem'] as $orderItem): ?>
		<tr>
			<td><?php echo $orderItem['Product']['reference'];?></td>
			<td><?php echo $orderItem['Color']['name'];?></td>
			<td><?php echo $orderItem['ProductSize']['name'];?></td>
			<td><?php echo $orderItem['quantity'];?></td>
			<td><?php echo '$ ' . number_format($orderItem['single_item_price'], 2); ?></td>
			<td><?php echo '$ ' . number_format($orderItem['single_item_tax'], 2); ?></td>
			<td><?php echo '$ ' . number_format($orderItem['total_items_price'], 2); ?></td>
			<td><?php echo '$ ' . number_format($orderItem['total_items_tax'], 2); ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>
</div>

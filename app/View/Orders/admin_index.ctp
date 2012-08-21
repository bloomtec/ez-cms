<div class="orders index">
	<h2><?php echo __('Ordenes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this -> Paginator -> sort('code', 'Código'); ?></th>
			<th><?php echo $this -> Paginator -> sort('order_state_id', 'Estado'); ?></th>
			<th><?php echo $this -> Paginator -> sort('user_id', 'Usuario'); ?></th>
			<th><?php echo $this -> Paginator -> sort('coupon_code', 'Cupon'); ?></th>
			<th><?php echo $this -> Paginator -> sort('shipment_cost', 'Costo De Envío'); ?></th>
			<th><?php echo $this -> Paginator -> sort('created', 'Creada'); ?></th>
			<th><?php echo $this -> Paginator -> sort('updated', 'Modificada'); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
		</tr>
		<?php foreach ($orders as $order): ?>
		<tr>
			<td><?php echo h($order['Order']['code']); ?>&nbsp;</td>
			<td><?php echo $order['OrderState']['name']; ?></td>
			<td><?php echo $this -> Html -> link($order['User']['username'], array('plugin' => 'user_control','controller' => 'users', 'action' => 'view', $order['User']['id'])); ?></td>
			<td><?php echo $order['Order']['coupon_code']; ?>&nbsp;</td>
			<td><?php echo $order['Order']['shipment_cost']; ?>&nbsp;</td>
			<td><?php echo h($order['Order']['created']); ?>&nbsp;</td>
			<td><?php echo h($order['Order']['updated']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this -> Html -> link(__('Ver'), array('action' => 'view', $order['Order']['id'])); ?>
				<?php echo $this -> Html -> link(__('Modificar'), array('action' => 'edit', $order['Order']['id'])); ?>
				<?php //echo $this -> Form -> postLink(__('Delete'), array('action' => 'delete', $order['Order']['id']), null, __('Are you sure you want to delete # %s?', $order['Order']['id'])); ?>
			</td>
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
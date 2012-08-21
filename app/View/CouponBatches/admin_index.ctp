<div class="couponBatches index">
	<h2><?php echo __('Grupos De Cupones'); ?></h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<!--<th><?php echo $this -> Paginator -> sort('id'); ?></th>-->
			<th><?php echo $this -> Paginator -> sort('coupon_type_id', 'Tipo De Cupones'); ?></th>
			<th><?php echo $this -> Paginator -> sort('name', 'Nombre'); ?></th>
			<th><?php echo $this -> Paginator -> sort('discount', 'Descuento'); ?></th>
			<th><?php echo $this -> Paginator -> sort('created', 'Creado'); ?></th>
			<!--<th><?php echo $this -> Paginator -> sort('updated'); ?></th>-->
			<th class="actions"><?php echo __('Acciones'); ?></th>
		</tr>
		<?php foreach ($couponBatches as $couponBatch):	?>
		<tr>
			<!--<td><?php echo h($couponBatch['CouponBatch']['id']); ?>&nbsp;</td>-->
			<td><?php echo h($couponBatch['CouponType']['name']); ?>&nbsp;</td>
			<td><?php echo h($couponBatch['CouponBatch']['name']); ?>&nbsp;</td>
			<td>
				<?php if($couponBatch['CouponBatch']['coupon_type_id'] == 2 || $couponBatch['CouponBatch']['coupon_type_id'] == 3) : ?>
				<?php echo h((1-$couponBatch['CouponBatch']['discount'])*100); ?>%
				<?php endif; ?>
				&nbsp;
			</td>
			<td><?php echo h($couponBatch['CouponBatch']['created']); ?>&nbsp;</td>
			<!--<td><?php echo h($couponBatch['CouponBatch']['updated']); ?>&nbsp;</td>-->
			<td class="actions">
				<?php echo $this -> Html -> link(__('Ver'), array('action' => 'view', $couponBatch['CouponBatch']['id'])); ?>
				<?php //echo $this -> Html -> link(__('Edit'), array('action' => 'edit', $couponBatch['CouponBatch']['id'])); ?>
				<?php //echo $this -> Form -> postLink(__('Delete'), array('action' => 'delete', $couponBatch['CouponBatch']['id']), null, __('Are you sure you want to delete # %s?', $couponBatch['CouponBatch']['id'])); ?>
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
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li>
			<?php echo $this -> Html -> link(__('Agregar Grupo De Cupones'), array('action' => 'add')); ?>
		</li>
	</ul>
</div>
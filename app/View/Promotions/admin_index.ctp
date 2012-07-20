<div class="promotions index">
	<h2><?php echo __('Promoción En El Sitio Web'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $this -> Paginator -> sort('coupon_type_id', 'Tipo De Promoción'); ?></th>
		<th><?php echo $this -> Paginator -> sort('is_active', 'Vigente'); ?></th>
		<th><?php echo $this -> Paginator -> sort('coupon_id', 'Cupon'); ?></th>
		<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($promotions as $promotion): ?>
	<tr>
		<td>
			<?php echo $this -> Html -> link($promotion['CouponType']['name'], array('controller' => 'coupon_types', 'action' => 'view', $promotion['CouponType']['id'])); ?>
		</td>
		<td>
			<?php
				if($promotion['Promotion']['is_active']) {
					echo '<input type="checkbox" disabled="true" checked="checked" />';
				} else {
					echo '<input type="checkbox" disabled="true" />';
				}
			?>
			&nbsp;
		</td>
		<td>
			<?php echo $promotion['Coupon']['code']; ?>
		</td>
		<td class="actions">
			<?php echo $this -> Html -> link(__('Modificar'), array('action' => 'edit', $promotion['Promotion']['id'])); ?>
			<?php
				if($promotion['Promotion']['is_active']) {
					echo $this -> Form -> postLink(__('Desactivar'), array('action' => 'setInactive', $promotion['Promotion']['id']), null, __('¿Desea desactivar la promoción en el sitio web?'));
				} else {
					echo $this -> Form -> postLink(__('Activar'), array('action' => 'setActive', $promotion['Promotion']['id']), null, __('¿Desea activar la promoción en el sitio web?'));
				}
			?>
		</td>
	</tr>
	<?php endforeach; ?>
	</table>
	<!--
	<p>
	<?php
	echo $this -> Paginator -> counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));
	?>	</p>

	<div class="paging">
	<?php
	echo $this -> Paginator -> prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
	echo $this -> Paginator -> numbers(array('separator' => ''));
	echo $this -> Paginator -> next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
	-->
</div>
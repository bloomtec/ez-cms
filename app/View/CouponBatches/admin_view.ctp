<div class="couponBatches view">
<h2><?php  echo __('Grupo De Cupones');?></h2>
	<dl>
		<dt><?php echo __('Tipo De Cupon'); ?></dt>
		<dd>
			<?php echo $this->Html->link($couponBatch['CouponType']['name'], array('controller' => 'coupon_types', 'action' => 'view', $couponBatch['CouponType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($couponBatch['CouponBatch']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descuento'); ?></dt>
		<dd>
			<?php if($couponBatch['CouponBatch']['coupon_type_id'] == 3) : ?>
			<?php echo h((1-$couponBatch['CouponBatch']['discount'])*100); ?>%
			<?php endif; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($couponBatch['CouponBatch']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Ver Grupos De Cupones'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Agregar Grupo De Cupones'), array('action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Cupones Relacionados');?></h3>
	<?php if (!empty($couponBatch['Coupon'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Código'); ?></th>
		<th><?php echo __('Activo'); ?></th>
		<th><?php echo __('Usado'); ?></th>
		<th><?php echo __('Creado'); ?></th>
		<th><?php echo __('Modificado'); ?></th>
		<th class="actions"><?php echo __('Acciones');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($couponBatch['Coupon'] as $coupon): ?>
		<tr>
			<td><?php echo $coupon['code'];?></td>
			<td>
				<?php if($coupon['is_active']) : ?>
				<input type="checkbox" checked="checked" disabled="true" />
				<?php endif; ?>
				<?php if(!$coupon['is_active']) : ?>
				<input type="checkbox" disabled="true" />
				<?php endif; ?>
			</td>
			<td>
				<?php if($coupon['is_used']) : ?>
				<input type="checkbox" checked="checked" disabled="true" />
				<?php endif; ?>
				<?php if(!$coupon['is_used']) : ?>
				<input type="checkbox" disabled="true" />
				<?php endif; ?>
			</td>
			<td><?php echo $coupon['created'];?></td>
			<td><?php echo $coupon['updated'];?></td>
			<td class="actions">
				<?php
					if($coupon['is_active']) {
						echo $this->Form->postLink(__('Desactivar'), array('controller' => 'coupon_batches', 'action' => 'deactivateCoupon', $couponBatch['CouponBatch']['id'], $coupon['id'], ), null, __('¿Seguro desea desactivar el cupon con el código: %s?', $coupon['code']));
					} elseif(!$coupon['is_active'] && !$coupon['is_used']) {
						echo $this->Form->postLink(__('Activar'), array('controller' => 'coupon_batches', 'action' => 'activateCoupon', $couponBatch['CouponBatch']['id'], $coupon['id'], ), null, __('¿Seguro desea desactivar el cupon con el código: %s?', $coupon['code']));
					}
				?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

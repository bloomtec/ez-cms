<div class="couponBatches form">
<?php echo $this->Form->create('CouponBatch');?>
	<fieldset>
		<legend><?php echo __('Admin Edit Coupon Batch'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('coupon_type_id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('CouponBatch.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('CouponBatch.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Coupon Batches'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Coupon Types'), array('controller' => 'coupon_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Coupon Type'), array('controller' => 'coupon_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Coupons'), array('controller' => 'coupons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Coupon'), array('controller' => 'coupons', 'action' => 'add')); ?> </li>
	</ul>
</div>

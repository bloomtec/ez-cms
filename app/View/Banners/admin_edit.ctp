<div class="banners form">
	<?php echo $this -> Form -> create('Banner'); ?>
	<fieldset>
		<legend>
			<?php echo __('Modificar Banner'); ?>
		</legend>
		<?php
		echo $this -> Form -> input('id');
		echo $this -> Form -> input('name', array('label' => 'Nombre'));
		echo $this -> Form -> input('content', array('label' => 'Contenido', 'class' => 'editor'));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Modificar')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<!--<li>
			<?php echo $this -> Form -> postLink(__('Delete'), array('action' => 'delete', $this -> Form -> value('Banner.id')), null, __('Are you sure you want to delete # %s?', $this -> Form -> value('Banner.id'))); ?>
		</li>-->
		<li>
			<?php echo $this -> Html -> link(__('Volver'), array('action' => 'index')); ?>
		</li>
	</ul>
</div>

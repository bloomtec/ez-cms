<div class="colors form">
	<?php echo $this -> Form -> create('Color'); ?>
	<fieldset>
		<legend>
			<?php echo __('Admin Edit Color'); ?>
		</legend>
		<?php
		echo $this -> Form -> input('id');
		echo $this -> Form -> input('name', array('label' => 'Nombre'));
		echo $this -> Form -> input('code', array('label' => 'Código', 'maxlength' => 7, 'minlength' => 7));
		?>
	</fieldset>
	<?php echo $this -> Form -> end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li>
			<?php echo $this -> Html -> link(__('Ver Colores'), array('action' => 'index')); ?>
		</li>
	</ul>
</div>

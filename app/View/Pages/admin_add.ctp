<div class="pages form">
<?php echo $this->Form->create('Page');?>
	<fieldset>
		<legend><?php echo __('Agregar Página'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label' => 'Nombre'));
		echo $this->Form->input('description', array('label' => 'Descripción'));
		echo $this->Form->input('keywords', array('label' => 'Palabras Clave'));
		echo $this->Form->input('content', array('label' => 'Contenido','class'=>'ckeditor'));
		echo $this->Form->input('left_content', array('label' => 'Contenido Izquierdo','class'=>'ckeditor'));
		echo $this->Form->input('is_active', array('label' => 'Página Activa'));		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enviar'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Volver'), array('action' => 'index'));?></li>
	</ul>
</div>
<div class="pages form">
<style id="styles" type="text/css">

		.cke_button_myDialogCmd .cke_icon
		{
			display: none !important;
		}

		.cke_button_myDialogCmd .cke_label
		{
			display: inline !important;
		}

	</style>
<?php echo $this->Form->create('Page');?>
	<fieldset>
		<legend><?php echo __('Modificar Página'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label' => 'Nombre'));
		echo $this->Form->input('description', array('label' => 'Descripción'));
		echo $this->Form->input('keywords', array('label' => 'Palabras Clave','div'=>'textarea to-right'));
		echo $this->Form->input('left_content', array('label' => 'Contenido Izquierdo','class'=>'editor2','div'=>'textarea left_content'));
		echo $this->Form->input('content', array('label' => 'Contenido','class'=>'editor','div'=>'textarea content'));
	?>
	<div style='clear:both'></div>
	<?php
		echo $this->Form->input('is_active', array('label' => 'Página Activa'));
	?>
	</fieldset>
<?php echo $this -> Html -> link('Vista previa',"#");?>
<?php echo $this->Form->end(__('Guardar'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Volver'), array('action' => 'index'));?></li>
	</ul>
</div>
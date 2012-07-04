<div class="surveys">
<?php echo $this->Form->create('Survey');?>
	<fieldset>
 		<legend><?php __('Nueva Encuesta'); ?></legend>
 		<div class="layer">
		<?php
			echo $this->Form->input('titulo');
			echo $this->Form->input('estado',array("label"=>"Activa?"));
		?>
		<p style="width:250px; margin-top:40px;">
			Si selecciona el campo activo esta encuesta quedara visible en la página y la actual no se visualizará más
		</p>
		</div>
		
		<div class="layer">
		<?php
			echo $this->Form->input('Options.0.name',array("label"=>"Opcion 1"));
		?>
		<?php
			echo $this->Form->input('Options.1.name',array("label"=>"Opcion 2"));
		?>
		<?php
			echo $this->Form->input('Options.2.name',array("label"=>"Opcion 3"));
		?>
		<?php
			echo $this->Form->input('Options.3.name',array("label"=>"Opcion 4"));
		?>
		<?php
			echo $this->Form->input('Options.4.name',array("label"=>"Opcion 5"));
		?>
		<?php
			echo $this->Form->input('Options.5.name',array("label"=>"Opcion 6"));
		?>
		</div>
	</fieldset>
<?php echo $this->Form->end(__('Guardar', true));?>
</div>

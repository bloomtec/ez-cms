<div class="surveys">
<?php echo $this->Form->create('Survey');?>
	<fieldset>
 		<legend><?php __('NuevaEncuesta'); ?></legend>
 		<div class="layer">
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('titulo', array('label' => 'Título'));
			echo $this->Form->input('estado',array("label"=>"Activa?"));
		?>
		<p style="width:250px; margin-top:40px;">
			Si selecciona el campo activo esta encuesta quedara visible en la página y la actual no se visualizará mas
		</p>
		</div>
		
		<div class="layer">
		<?php 
			$i=0;
			foreach($this->data["SurveyOption"] as $option):
				echo $this->Form->input('Options.'.$option["id"].'.id',array("type"=>"hidden","value"=>$option["id"]));
				echo $this->Form->input('Options.'.$option["id"].'.name',array("label"=>"Opción ".($i+1),"value"=>$option["name"]));
		 		$i++;
		 	endforeach;
		 ?>
		<?php 
			for(;$i<6;$i++){
				echo $this->Form->input('Options.-'.$i.'.name',array("label"=>"Opción ".($i+1)));
			}
		?>
		
		</div>
	</fieldset>
<?php echo $this->Form->end(__('Guardar', true));?>
</div>

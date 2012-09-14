<div class="banner">
	<?php echo $this -> requestAction("/banners/get/contacto");?>
</div>
<div id="left-col">
	<?php  echo $this -> element ("novedad");?>
</div>
<div id="right-col" class='black-wrapper form'>
	<div id="contacto">
	<?php echo $this -> Form->create("Page",array("action"=>"contacto","controller"=>"pages"));?>
	<fieldset>
		<h1>
			Formulario De Contacto
		</h1>
		<p style="line-height: 20px;">
			Hemos creado este espacio para que nuestros clientes nos aporten comentarios y sugerencias con respecto a nuestra página web. Todas sus palabras son valiosas para nuestra compañía, nuestro crecimiento, nuestro progreso. Buscamos mejorar nuestro servicio para darle al cliente lo que necesita. Gracias por tu tiempo.
		</p>
		<?php echo $this -> Form->input("nombre_contacto",array("label"=>"Nombre (s):",'required'=>'required'));?>
		<?php echo $this -> Form->input("email",array("label"=>"Dirección E-mail:",'type'=>'email','required'=>'required'));?>
		<?php echo $this -> Form->input("telefono",array('div' => ' input last',"label"=>"Teléfono:",'required'=>'required'));?>
		<div style="clear:both;"></div>
		<?php echo $this -> Form->input("comentario",array('type'=>'textarea',"label"=>"Comentario (s)",'required'=>'required'));?>
		<div style="clear:both;"></div>
		<?php echo $this -> Form->end(__('Envíar', true), array('div' => false));?>
	</fieldset>
	<div style="clear:both;"></div>
	</div>
</div>
<script>
	$(function(){
		$('#PageContactoForm').validator({ lang: 'es', position:"bottom left"});
	});
</script>
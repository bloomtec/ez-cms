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
			Formulario de contacto
		</h1>
		<p>Con el fin de conocer sus preguntas y opiniones sobre nuestros productos y servicios tanto en red como en nuestras tiendas, ponemos a su disposición esta sección en la cual podrá enviarnos sus comentarios y sugerencias, nuestro equipo de soporte estará atento para brindarle colaboración que usted necesite.</p>
		<?php echo $this -> Form->input("nombre_contacto",array("label"=>"Escribe tu (s) Nombre (s):",'required'=>'required'));?>
		<?php echo $this -> Form->input("email",array("label"=>"Dirección E-mail:",'type'=>'email','required'=>'required'));?>
		<?php echo $this -> Form->input("telefono",array('div' => ' input last',"label"=>"Teléfono:",'required'=>'required'));?>
		<div style="clear:both;"></div>
		<?php echo $this -> Form->input("comentario",array('type'=>'textarea',"label"=>"Escribe tu (s) Comentario (s)",'required'=>'required'));?>
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
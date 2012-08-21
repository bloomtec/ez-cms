<div class="pages form">
<?php echo $this->Form->create('Page');?>
	<fieldset>
		<legend><?php echo __('Agregar Página'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label' => 'Nombre'));
		echo $this->Form->input('description', array('label' => 'Descripción'));
		echo $this->Form->input('keywords', array('label' => 'Palabras Clave'));
		echo '<div class="textarea left_content">';
		echo '<label style="clear:both;">Contenido Izquierdo</label>';
		echo $this->Form->input('element1', array('label' => 'Elemento 1','options'=>array('survey'=>'Encuesta','novedad'=>'Novedades','mas-vendidos'=>'Mas Vendidos'),'empty'=>'ninguno'));
		echo $this->Form->input('element2', array('label' => 'Elemento 2','options'=>array('survey'=>'Encuesta','novedad'=>'Novedades','mas-vendidos'=>'Mas Vendidos'),'empty'=>'ninguno'));
		echo $this->Form->input('element3', array('label' => 'Elemento 3','options'=>array('survey'=>'Encuesta','novedad'=>'Novedades','mas-vendidos'=>'Mas Vendidos'),'empty'=>'ninguno'));

		echo $this->Form->input('left_content', array('label' => false,'class'=>'editor2','div'=>false));
		echo "</div>";
		echo $this->Form->input('content', array('label' => 'Contenido','class'=>'editor','div'=>'textarea left_content'));
	?>
	<div style='clear:both'></div>
	<?php
		echo $this->Form->input('is_active', array('label' => 'Página Activa'));
	?>
	</fieldset>
<?php echo $this -> Html -> link('Vista previa',array('controller'=>'pages','action'=>'preview','admin'=>true),array('target'=>'_blank','class'=>'preview'));?>
<?php echo $this->Form->end(__('Guardar'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Ver Páginas'), array('action' => 'index'));?></li>
	</ul>
</div>
<script>
	$('a.preview').click(function(e){
		e.preventDefault();
		var href= $(this).attr('href');
		BJS.post('/admin/pages/beforePrev',
			{
				left_content: $('.editor2').val(),
				content: $('.editor').val(),
				element1: $('#PageElement1').val(),
				element2: $('#PageElement2').val(),
				element3: $('#PageElement3').val(),
			},
			function(data){
			if(data){
				window.open(href,'','toolbars=no,scrollbars=yes,location=no,statusbars=no,menubars=no,height=600,width=1000,');
			}
		});
	});
</script>
<div class="pages form">
<?php echo $this->Form->create('Page');?>
	<fieldset>
		<legend><?php echo __('Agregar Página'); ?></legend>
	<?php
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
		BJS.post('/admin/pages/beforePrev',{left_content:$('.editor2').val(),content:$('.editor').val()},function(data){
			if(data){
				window.open(href,'','toolbars=no,scrollbars=yes,location=no,statusbars=no,menubars=no,height=600,width=1000,');
			}
		});
	});
</script>

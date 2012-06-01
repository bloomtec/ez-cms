<div class="pages form">
<?php echo $this->Form->create('Page');?>
	<fieldset>
		<legend><?php echo __('Agregar Página'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label' => 'Nombre'));
		echo $this->Form->input('description', array('label' => 'Descripción'));
		echo $this->Form->input('content', array('label' => 'Contenido'));
		echo $this->Form->input('left_content', array('label' => 'Contenido Izquierdo'));
		echo $this->Form->input('right_content', array('label' => 'Contenido Derecho'));
		echo $this->Form->input('keywords', array('label' => 'Palabras Clave'));
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
<?php echo $this -> Html -> script('Ez.ckeditor/ckeditor'); ?>
<script type="text/javascript">
	CKEDITOR.replace('data[Page][content]', {
		filebrowserUploadUrl : '/upload.php',
		filebrowserBrowseUrl : '/admin/pages/wysiwyg',
	});
</script>
<script type="text/javascript">
	CKEDITOR.replace('data[Page][left_content]', {
		filebrowserUploadUrl : '/upload.php',
		filebrowserBrowseUrl : '/admin/pages/wysiwyg',
	});
</script>
<script type="text/javascript">
	CKEDITOR.replace('data[Page][right_content]', {
		filebrowserUploadUrl : '/upload.php',
		filebrowserBrowseUrl : '/admin/pages/wysiwyg',
	});
</script>
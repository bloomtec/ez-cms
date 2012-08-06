<div id="pages">
<div id="left-col">
	<?php echo $this -> element('novedad'); ?>
	<?php echo $this -> element('resumen-carrito'); ?>
</div>
<div id="right-col" class='black-wrapper carrito-view'>
	<h2>Mis Favoritos</h2>
	<p>
		Las mujeres siempre queremos tener zapatos para toda ocasión… En esta lista encontrarás todos los productos que tú has seleccionado como Favoritos.
		Seguramente en tu lista hay muchos estilos que te gustaría tener, no los dejes a un lado…
		Sí son tus Favoritos, no te olvides de ellos, agrégalos a tu Carrito!!
	</p>
	<div class="tabla-carrito">
		<div class="actualizando">
			Actualizando tus favoritos...
		</div>
		<div class="content">
			
		</div>
		<?php // Carga el contenido via AJAX ?>
	</div>
	
</div>
<div style="clear:both;"></div>
</div>
<script type="text/javascript">
	$(function(){
		$('.tabla-carrito .content').load('/pages/tablaFavoritos');
	});
</script>
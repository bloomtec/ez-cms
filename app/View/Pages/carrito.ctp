<div id="pages">
<div id="left-col">
	<?php echo $this -> element('novedad'); ?>
	<?php echo $this -> element('resumen-favoritos'); ?>
</div>
<div id="right-col" class='black-wrapper carrito-view'>
	<h2>Mi Carrito</h2>
	<p>
	Gracias por realizar tus compras en <a href="/" class="rosa">www.priceshoes.com.co</a>	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ac lorem velit, quis auctor sem. In luctus enim a eros sodales consequat. Proin ultrices venenatis venenatis. Proin lectus arcu, ultrices id ultricies eu, tempus in elit. Vivamus fermentum arcu sed felis rutrum luctus. Ut at tempor nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Quisque et dolor justo, non molestie dolor. Proin convallis pulvinar aliquam. Proin vitae sapien nunc, a condimentum justo. 
	</p>
	<div class="tabla-carrito">
	<?php // Carga el contenido via AJAX ?>
	</div>
	
</div>
<div style="clear:both;"></div>
</div>
<script type="text/javascript">
	$(function(){
		$('.tabla-carrito').load('/pages/tablaCarrito');
	});
</script>
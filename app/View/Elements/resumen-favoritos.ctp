<?php 
// esta variable recibe el producto aleatoreo

?>
<div id="promocion" class="caja-producto-lateral">
	<div class="titulo">
		<h1>Mis Favoritos <img src="/img/favoritos_2.png" class="carrito" alt="carrito"> </h1>
	</div>
	<div class="resumen-favoritos">
		<div class="actualizando">
			Actualizando tus favoritos..
			<br />
		</div>
		<div class="content">
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('.resumen-favoritos .content').load('/pages/resumenFavoritos',function(){
			$('.resumen-favoritos .actualizando').hide();
		});
	});
</script>

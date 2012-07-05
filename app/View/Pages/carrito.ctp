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
		<div class="actualizando">
			Actualizando el carrito...
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
		$('.tabla-carrito .content').load('/pages/tablaCarrito',function(){
			rel=$(".direcciones li.selected").attr('rel');
			updateAddressForm(rel);
			$('#OrderTablaCarritoForm').validator({ lang: 'es', position:"bottom left"});
		});
		$('.tabla-carrito').on('click','.direcciones li',function(){
			$that=$(this);
			rel=$that.attr('rel');
			$('.direcciones li').removeClass('selected');
			$that.addClass('selected');		
			updateAddressForm(rel);	
		});
		function updateAddressForm(rel){
			if($.isNumeric(rel)){
				address=addresses[rel];
				$("#UserAddressCountry").val(address['UserAddress']['country']).attr('disabled',true);
				$("#UserAddressState").val(address['UserAddress']['state']).attr('disabled',true);
				$("#UserAddressCity").val(address['UserAddress']['city']).attr('disabled',true);
				$("#UserAddressPhone").val(address['UserAddress']['phone']).attr('disabled',true);
				$("#UserAddressAddress").val(address['UserAddress']['address']).attr('disabled',true);
				$("#UserAddressId").val(address['UserAddress']['id']);
			}else{
				if(rel=="nueva-direccion"){
					$("#UserAddressCountry").val("").attr('disabled',false);
					$("#UserAddressState").val("").attr('disabled',false);
					$("#UserAddressCity").val("").attr('disabled',false);
					$("#UserAddressPhone").val("").attr('disabled',false);
					$("#UserAddressAddress").val("").attr('disabled',false);
					$("#UserAddressId").val("");
				}
			}
			
		}
	});
</script>
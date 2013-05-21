<div >
<div id="left-col">
	<?php echo $this -> element('novedad'); ?>
	<?php echo $this -> element('resumen-favoritos'); ?>
</div>
<div id="right-col" class='black-wrapper carrito-view' style="padding-top: 10px;">
	<h2>Mi Carrito</h2>
	<p style="line-height: 20px;">
	Gracias por comprar en <a href="/" class="rosa">www.priceshoes.com.co</a>. Abajo encontrarás un resumen con los productos que has agregado a tu Carrito de compras. Rectifica los productos y las cantidades que tú elegiste; si tienes algún Cupón de descuento, aplícalo en la casilla mostrada, llena tus datos de envío y por último puedes culminar tu pago dando clic en el botón “Proceder a Pagar”. 
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
        var d = new Date();
        var n = d.getMilliseconds();
		$('.tabla-carrito .content').load('/pages/tablaCarrito?_t='+n,function(){

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
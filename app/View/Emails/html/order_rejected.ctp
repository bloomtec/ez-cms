<div id="EmailContainer">
	<div class="email-header" style="background: #DC3682;">
		<img alt="Price Shoes" src="http://<?php echo Configure::read('site_domain'); ?>/img/logo_correos.jpg">
		<h2 style="float: right; margin-right: 30px; padding: 12px; color: white;">Orden Confirmada</h2>
	</div>
	<div style="min-height: 10px;"></div>
	<div style="background: #DC3682; min-height: 5px;"></div>
	<div id="VerticalDiv" style="background: none repeat scroll 0 0 #DC3682; float: left; max-width: 5px; min-width: 5px;"></div>
	<div style="float: left; margin-left: 25px; width: 95%;">
		<br />
		<div style="background: none repeat scroll 0 0 #DC3682; color: white; margin-bottom: auto; margin-left: auto; margin-right: auto; min-height: 25px; padding: 9px 5px 5px 10px;">
			Gracias por comprar en <b><a style="color: white;">priceshoes.com.co</a></b>
		</div>
		<br />
		<p>
			<b>Apreciado(a) <?php echo $order['User']['name'] . ' ' . $order['User']['lastname']; ?>,</b>
		</p>
		<p>
			La orden #<?php echo $order['Order']['code']; ?> emitida el día <?php echo $order['Order']['created']; ?> no pudo finalizar con éxito.
			Le pedimos que se comunique con las entidades relacionadas para solucionar el inconveniente y, una vez resuelto, intente nuevamente
			realizar su compra.
		</p>
		<p>
			Esperamos tenerte nuevamente en nuestra tienda virtual<br />
			<a href="http://<?php echo Configure::read('site_domain'); ?>/tienda-virtual">www.priceshoes.com.co/tienda-virtual</a>
		</p>
		<p>
			Atentamente,
		</p>
		<p>
			Servicio al cliente Price Shoes
			<br />
			<a href="mailto:servicioalcliente@priceshoes.com.co">servicioalcliente@priceshoes.com.co</a>
		</p>
	</div>
	<div style="clear: both;"></div>
</div>
<script language="JavaScript" type="text/javascript">
	document.getElementById("VerticalDiv").style.height=document.getElementById("EmailContainer").offsetHeight;
</script>
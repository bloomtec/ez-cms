<div>
	<div class="email-header" style="background: #DC3682;">
		<img alt="Price Shoes" src="http://<?php echo Configure::read('site_domain'); ?>/img/logo_correos.jpg">
		<h2 style="float: right; margin-right: 30px; padding: 12px; color: white;">Restablecer Contraseña</h2>
	</div>
	<div class="email-content">
		<p>
			<b>Apreciado(a) <?php echo $user; ?>,</b>
		</p>
		<p>
			Recibimos un mensaje donde solicitas un cambio de contrase&ntilde;a.
			Te hemos enviado una contraseña provisional para que puedas ingresar a tu cuenta de <a id="SiteLink" href="http://www.priceshoes.com.co" style="color: #DC3682;">priceshoes.com.co</a>
		</p>
		<p>
			Te recomendamos que cuando ingreses de nuevo, cambies tu contrase&ntilde;a por otra que puedas recordar con facilidad.
		</p>
		<p>
			Contrase&ntilde;a provisional: <b><?php echo $password; ?></b>
		</p>
		<p>
			Si necesitas ayuda o tienes alguna duda, escríbenos al correo <a href="mailto:servicioalcliente@priceshoes.com.co">servicioalcliente@priceshoes.com.co</a>
		</p>
		<p>
			Atentamente,
		</p>
		<p>
			<b>Servicio al Cliente Price Shoes</b>
		</p>
	</div>
	<div class="email-footer" style="background: #DC3682; min-height: 5px;"></div>
</div>
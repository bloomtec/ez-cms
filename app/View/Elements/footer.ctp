<div id="footer"  class="black-wrapper">
	<div class='wrapper'>
		<div id="info-wrapper">
			<div class="registrar">
			<h2>Regístra tu correo</h2>
				<form id="mail" action='http://madmimi.com/signups/subscribe/34704' method='post'>
					<div>
						<div class="input text">
							<input id='signup_email' class='layout' name='signup[email]' type='text' />
						</div>
						<input name='commit' class='button' type='submit' value='Enviar' />
					</div>
				</form>
				<p>
					Al registrar mi dirección de correo electrónico, certifico que la información que proporciono es correcta y que soy mayor de edad.
				</p>

			</div>	
			<div class="paginas-inferior">
				<h3>Priceshoes On-line</h3>
				<?php echo $this -> element('menu-paginas-inferior')?>
			</div>	
			<div class="menu-fijo">
				<div class="cuenta">
					<h3>Mi Cuenta</h3>
					<ul>
						<li>
							<?php echo $this -> Html->link("Registro","/registro");
							?>
						</li>
						<li>
							<?php echo $this -> Html->link("Ver Carrito","/carrito")
							?>
						</li>

						<li>
							<?php echo $this -> Html->link("Ayuda",array("controller"=>"pages","action"=>"view","ayuda"))
							?>
						</li>
					</ul>
				</div>
				<div class="favoritos">
					<h3>Favoritos</h3>
					<p>
						Es fácil asignar etiquetas a tus favoritos.
					</p>
				</div>
				<div style='clear:both;'></div>
				<div class="formas-de-pago">
					<?php echo $this -> Html -> image('tarjetas.png'); ?>
				</div>
			</div>

			<div style='clear:both;'></div>
		</div>
		<?php echo $this -> element('second-nav');?>
	</div>
</div>
<div id="footer"  class="black-wrapper">
	<div class='wrapper'>
		<div id="info-wrapper">
			<div class="registrar">
				<h2>Registra tu correo</h2>
				<?php //echo $this -> Form -> create('User', array('plugin' => true, 'controller' => 'users', 'action' => 'registerEmail')); ?>
				<form id="mail" accept-charset="utf-8" method="post" controller="users" action="/user_control/users/registerEmail">
					<div>
						<?php echo $this -> Form -> input('email', array('label' => false,'value'=>'')); ?>
						<?php echo $this -> Form -> submit('Enviar'); ?>
					</div>
				<?php //echo $this -> Form -> end(); ?>
				</form>
				<p>
					Al registrar mi dirección de correo electrónico, certifico que la información que proporciono es correcta y que soy mayor de edad.
				</p>
				<div class="sociales">
					<ul>
						<li>
							<a href="http://www.facebook.com/priceshoes.co" target="_blank"><img alt="facebook" src="/img/facebook2.png" ></a>			</li>
						<li>
							<a href="https://twitter.com/PriceShoesColom" target="_blank"><img alt="twitter" src="/img/twitter2.png"></a>			</li>
						<?php /*
						<li>
							<a href="http://www.linkedin.com/" target="_blank"><img alt="linkedin" src="/img/linkedin.png"></a>			
						</li>
						*/?>
						<li>
							<h1>Síguenos!!</h1>
						</li>
					</ul>
				</div>
			</div>
			<div class="paginas-inferior">
				<h3>Priceshoes On-line</h3>
				<?php echo $this -> element('menu-paginas-inferior'); ?>
			</div>
			<div class="menu-fijo">
				<div class="cuenta">
					<h3>Mi Cuenta</h3>
					<ul>
						<li>
							<?php echo $this -> Html -> link("Registro", "/registro"); ?>
						</li>
						<li>
							<?php echo $this -> Html -> link("Ver Carrito", "/carrito"); ?>
						</li>

						<li>
							<a href="/ayuda">Ayuda</a>
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
		<?php echo $this -> element('second-nav'); ?>
	</div>
</div>
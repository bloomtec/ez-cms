<div id="footer"  class="black-wrapper">
	<div class='wrapper'>
		<div id="info-wrapper">
			<div class="registrar">
				<h2>Regístra tu correo</h2>
				<?php echo $this -> Form -> create('User', array('action' => 'registerEmail')); ?>
				<form id="mail" accept-charset="utf-8" method="post" controller="users" action="/user_control/users/registerEmail">
					<div>
						<?php echo $this -> Form -> input('email', array('label' => false,'value'=>'')); ?>
						<?php echo $this -> Form -> submit('Enviar'); ?>
					</div>
					<?php echo $this -> Form -> end(); ?>
					<p>
						Al registrar mi dirección de correo electrónico, certifico que la información que proporciono es correcta y que soy mayor de edad.
					</p>
			</div>
			<div class="paginas-inferior">
				<h3>Priceshoes On-line</h3>
				<?php echo $this -> element('menu-paginas-inferior')
				?>
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
							<?php echo $this -> Html -> link("Ayuda", array("controller" => "pages", "action" => "view", 'plugin' => false, "ayuda")); ?>
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
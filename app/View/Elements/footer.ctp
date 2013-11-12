<div id="footer"  class="black-wrapper">
	<div class='wrapper'>
		<div id="info-wrapper">
			<div class="registrar">
				<h2>Registra tu correo</h2>
				<?php //echo $this -> Form -> create('User', array('plugin' => true, 'controller' => 'users', 'action' => 'registerEmail')); ?>
				<form id="mail" accept-charset="utf-8" method="post" controller="users" action="/user_control/users/registerEmail">
					<div>
						<?php echo $this -> Form -> input('User.email', array('label' => false,'value'=>'')); ?>
						<?php echo $this -> Form -> submit('Enviar'); ?>
					</div>
				<?php //echo $this -> Form -> end(); ?>
				</form>
				<p>
					Al registrar mi dirección de correo electrónico, certifico que la información que proporciono es correcta y que soy mayor de edad.
				</p>

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
					<h3>Atención al cliente</h3>
                    <ul>
                        <li>
                            <a href="/pages/contacto">Contacto</a>
                        </li>

                        <li>
                            <a href="/pages/view/29">Quejas y Reclamos </a>
                        </li>

                        <li>
                            <a href="/pages/view/27">Políticas de Devolución, Cambio o Garantía</a>
                        </li>


                    </ul>

				</div>
				<div class="paginas-inferior">
                    <h3>Priceshoes On-line</h3>
                    <?php echo $this -> element('menu-paginas-inferior'); ?>
                </div>
				<div style='clear:both;'></div>
                <div class="sociales">
                    <ul>
                        <li>
                            <a href="http://www.facebook.com/priceshoes.co" target="_blank"><img alt="facebook" src="/img/facebook2.png" ></a>			</li>
                        <li>
                            <a href="https://twitter.com/PriceShoesCO" target="_blank"><img alt="twitter" src="/img/twitter2.png"></a>			</li>
                        <?php /*
						<li>
							<a href="http://www.linkedin.com/" target="_blank"><img alt="linkedin" src="/img/linkedin.png"></a>
						</li>
						*/?>
                        <h1>Síguenos!!</h1>
                        <div style="clear: both;"></div>
                    </ul>
                </div>
				<div class="formas-de-pago">
					<?php echo $this -> Html -> image('tarjetas.png'); ?>
				</div>

			</div>

			<div style='clear:both;'></div>
		</div>
		<?php echo $this -> element('second-nav'); ?>
	</div>
</div>
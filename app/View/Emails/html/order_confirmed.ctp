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
		<div style="margin-left: auto; margin-bottom: auto; margin-right: auto; margin-top: auto; max-height: 240px; max-width: 530px; min-height: 240px; min-width: 530px;">
			<table style="margin: auto; min-width: 524px; padding-right: 70px;">
				<tr>
					<td width="210" align="right"><img alt="Price Shoes" src="http://<?php echo Configure::read('site_domain'); ?>/img/check_correos.jpg"></td>
					<td width="60" align="center"><img alt="Price Shoes" src="http://<?php echo Configure::read('site_domain'); ?>/img/arrow_correos.jpg"></td>
					<td width="240" align="left"><img alt="Price Shoes" src="http://<?php echo Configure::read('site_domain'); ?>/img/check_correos.jpg"></td>
				</tr>
			</table>
			<table style="margin: auto; min-width: 524px;">
				<tr>
					<td width="210" rowspan="4" valign="top">
						<h3>ORDEN RECIBIDA</h3>
						<p>
							Hemos recibido su orden y estamos procesandola.
						</p>
					</td>
					<td width="60" rowspan="4" valign="top"></td>
					<td width="240" rowspan="4" valign="top">
						<h3>ORDEN CONFIRMADA</h3>
						<p>
							Su orden será enviada.
							<br>
							Fecha estimada de entrega:
							<br>
							<?php
								$date = date('Y-m-d', time()); // Fecha actual
								$deliveryDate = strtotime(date('Y-m-d', strtotime($date)) . ' +1 days ');
								$dateNumber = date('N', strtotime(date($deliveryDate)));
								if($dateNumber == 7) { $deliveryDate = strtotime(date('Y-m-d', strtotime($date)) . ' +2 days '); }
								echo date('M d / Y', $deliveryDate);
							?>				
						</p>
					</td>
				</tr>
			</table>
		</div>
		<div style="clear:both;"></div>
		<p>
			<b>Apreciado(a) <?php echo $order['User']['name'] . ' ' . $order['User']['lastname']; ?>,</b>
		</p>
		<p>
			Gracias por elegir priceshoes.com.co; tu orden ha sido procesada con &eacute;xito.
			Abajo encontrar&aacute;s un resumen de los productos que ser&aacute;n enviados.
		</p>
		<table>
			<tr><td>Orden</td><td><?php echo '#' . $order['Order']['code']; ?></td></tr>
			<tr><td>Nombre</td><td><?php echo $order['User']['name'] . ' ' . $order['User']['lastname']; ?></td></tr>
			<tr><td>Dirección</td><td><?php echo $order['UserAddress']['address']; ?></td></tr>
			<tr><td>Departamento</td><td><?php echo $order['UserAddress']['state']; ?></td></tr>
			<tr><td>Ciudad</td><td><?php echo $order['UserAddress']['city']; ?></td></tr>
			<tr><td>Tel&eacute;fono</td><td><?php echo $order['UserAddress']['phone']; ?></td></tr>
		</table>
		<p>
			Los productos asociados a la orden de compra son:
		</p>
		<table>
			<thead>
				<tr>
					<td style="text-align: center;">Producto</td>
					<td style="text-align: center;">Valor</td>
					<td style="text-align: center;">Cantidad</td>
					<td style="text-align: center;">Total</td>
				</tr>
			</thead>
			<tbody>
				<?php $subTotal = 0; ?>
				<?php foreach($order['OrderItem'] as $key => $item) : ?>
				<tr>
					<td><img alt="<?php echo $item['Product']['reference']; ?>" src="http://<?php echo Configure::read('site_domain') . '/img/uploads/50x50/' . $item['image']; ?>"></td>
					<td style="text-align: center;"><?php echo '$ ' . number_format($item['single_item_price'], 2); ?></td>
					<td style="text-align: center;"><?php echo $item['quantity']; ?></td>
					<td style="text-align: center;"><?php echo '$ ' . number_format($item['total_items_price'], 2); ?></td>
				</tr>
				<?php $subTotal += $item['total_items_price']; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
		<p>
			El valor del envío para esta orden es de: <b><?php echo '$ ' . number_format($order['Order']['shipment_cost'], 2); ?></b>
		</p>
		<?php if(isset($order['Order']['coupon_code']) && !empty($order['Order']['coupon_code'])) { ?>
		<p>
			Se utiliz&oacute; el cup&oacute;n <b><?php echo $order['Order']['coupon_code']; ?></b> y el total de la compra es <b><?php echo '$ ' . number_format($subTotal + $order['Order']['shipment_cost'], 2); ?></b>
		</p>
		<?php } else { ?>
		<p>
			El total de la compra es <b><?php echo '$ ' . number_format($subTotal + $order['Order']['shipment_cost'], 2); ?></b>
		</p>
		<?php } ?>
		<p>
			Esperamos tenerte nuevamente en nuestra tienda virtual<br />
			<a href="http://<?php echo Configure::read('site_domain'); ?>/tienda-virtual">www.priceshoes.com.co/tienda-virtual</a>
		</p>
		<p>
			Si tienes alguna pregunta o inquietud acerca de tu orden, por favor cont&aacute;ctanos al siguiente correo electr&oacute;nico: <a href="mailto:servicioalcliente@priceshoes.com.co">servicioalcliente@priceshoes.com.co</a>
		</p>
	</div>
	<div style="clear: both;"></div>
</div>
<script language="JavaScript" type="text/javascript">
	document.getElementById("VerticalDiv").style.height=document.getElementById("EmailContainer").offsetHeight;
</script>
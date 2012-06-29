<div id="pages">
<div id="left-col">
	<?php echo $this -> element('novedad'); ?>
	<?php echo $this -> element('resumen-carrito'); ?>
</div>
<div id="right-col" class='black-wrapper carrito-view'>
	<h2>Mis Favoritos</h2>
	<p>
	Gracias por realizar tus compras en <a href="/" class="rosa">www.priceshoes.com.co</a>	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ac lorem velit, quis auctor sem. In luctus enim a eros sodales consequat. Proin ultrices venenatis venenatis. Proin lectus arcu, ultrices id ultricies eu, tempus in elit. Vivamus fermentum arcu sed felis rutrum luctus. Ut at tempor nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Quisque et dolor justo, non molestie dolor. Proin convallis pulvinar aliquam. Proin vitae sapien nunc, a condimentum justo. 
	</p>
	<div class="tabla-carrito">
		<div class="content">
			<?php
				// Obtener el carrito
				$favoritos = $this -> requestAction('/b_cart/ShoppingCarts/get');
			?>
			<?php if(isset($favoritos['CartItem']) && !empty($favoritos['CartItem'])){?>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="2" class="tablaCarrito">
					<tr class="entryTableHeader">
						<th colspan="2" align="center">Producto</th>
						<th align="center">Descripción</td>
						
					</tr>
					<?php foreach($favoritos['CartItem'] as $item) { ?>
					<tr class="content">
						<td width="80" align="center" class="left">
							<?php
							  echo 	$this -> Html->link(
											$this -> Html->image(
														'/img/uploads/100x100/' . $item['image'],
														array('border' => '0')
													),
													array('action' => '../products/view/'.$item['Product']['id']."/".$item['color_id']),
													array('escape' => false)
											); 
							?>

						</td>
						<td>
							<h3><?php echo $this -> Html->link( $item['Product']['name'], "/products/view/".$item['Product']['id']."/".$item['color_id']);?></h3>
							<span>Ref. <?php echo $item['Product']['reference'] ?></span>							
						</td>
						<td class="description">
							<p>
								<?php echo $item['Product']['description'];?>
							</p>
						</td>
					
					</tr>
					<?php
							}
					?>
					
			</table>
			<?php } else { ?>
					<p class="rosa" style="text-align:center; font-size:18px; margin-top:20px;">No productos en tus favoritos </p>
			<?php } ?>
			<?php if(isset($addresses)):?>
				<script type="text/javascript">
					var addresses=<?php echo json_encode($addresses);?>
				</script>
			<?php endif;?>
		</div>
		<?php // Carga el contenido via AJAX ?>
	</div>
	
</div>
<div style="clear:both;"></div>
</div>
			<?php
				// Obtener el carrito
				
				$favoritos = $this -> requestAction('/favorites/get');
			//	debug($favoritos);
			?>
			<?php if(isset($favoritos['FavoriteItem']) && !empty($favoritos['FavoriteItem'])){?>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="2" class="tablaCarrito">
					<tr class="entryTableHeader">
						<th colspan="2" align="center">Producto</th>
						<th align="center">Precio</td>
					</tr>
					<?php foreach($favoritos['FavoriteItem'] as $item) { ?>
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
								<?php echo "$ ".number_format($item['Product']['price'], 0, ' ', '.');?>
							</p>
							<ul class="botones-caracteristicas" style="float:right;width:180px;">								
								<li class="to-cart-favoritos">
									<?php $product = $item; //debug($product); ?>
									<?php echo $this->Html->link("Añadir al carrito","#",array('class'=>'boton-carrito show-cart-options')); ?>
									<?php echo $this -> Form->create('bcart');?>
									<?php echo $this -> Form -> hidden('product_id-'.$product['Product']['id'],array('class'=>'id','id'=>'product_id','value'=>$product['Product']['id'])); ?>
									<?php echo $this -> Form -> hidden('color_id-'.$product['Product']['id'],array('class'=>'color_id','value'=>$product['color_id'])); ?>
									<?php echo $this -> Form -> hidden('product_size_id-'.$product['Product']['id'],array('label'=>'Talla','class'=>'product_size_id', 'value'=>$product['product_size_id'])); ?>
									<?php echo $this -> Form -> hidden('quantity-'.$product['Product']['id'],array('label'=>'Cantidad','class'=>'quantity', 'value'=>'1')); ?>
									<div class="actions">
										<a class="button addCartItem" href="/b_cart/shopping_carts/addCartItem/">Aceptar</a>
										<a class="button cancelar">Cancelar</a>
									</div>
									<?php echo $this -> Form ->end();?>
									<div class="add-cart">
										Producto añadido al Carrito <a href="/carrito">Ir a pagar</a>
									</div>
									<div style="clear:left"></div>
							    </li>
								<li>
									<?php echo $this -> Html->link('Quitar de Mis Favoritos', '/favorites/removeFavoriteItem/'.$item['id'],array("rel"=>$item['id'],"class"=>"removeFavoriteItem rosa"));?>
								</li>
							</ul>
						</td>
					
					</tr>
					<?php
							}
					?>
					
			</table>
			<?php } else { ?>
					<p class="rosa" style="text-align:center; font-size:18px; margin-top:20px;">[ No hay productos en tus Favoritos ]</p>
			<?php } ?>
			<?php if(isset($addresses)):?>
				<script type="text/javascript">
					var addresses=<?php echo json_encode($addresses);?>
				</script>
			<?php endif;?>
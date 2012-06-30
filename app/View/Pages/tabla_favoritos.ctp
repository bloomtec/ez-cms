			<?php
				// Obtener el carrito
				
				$favoritos = $this -> requestAction('/favorites/get');
			//	debug($favoritos);
			?>
			<?php if(isset($favoritos['FavoriteItem']) && !empty($favoritos['FavoriteItem'])){?>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="2" class="tablaCarrito">
					<tr class="entryTableHeader">
						<th colspan="2" align="center">Producto</th>
						<th align="center">Descripción</td>
						
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
								<?php echo $item['Product']['description'];?>
							</p>
								<?php echo $this -> Html->link('Quitar de mis favoritos', '/favorites/removeFavoriteItem/'.$item['id'],array("rel"=>$item['id'],"class"=>"removeFavoriteItem rosa",'style'=>'float:right;'));?>
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
<?php $shopping_cart = $this -> requestAction('/b_cart/ShoppingCarts/get'); ?>
<?php if(isset($shopping_cart['CartItem']) && !empty($shopping_cart['CartItem'])):?>
<?php $subTotal=0; ?>
<div class="container-tabla">	
	<table id="cesta-tabla">
		<?php foreach($shopping_cart['CartItem'] as $item):?>
			<?php 
				$subTotal += $item['Product']['price'] * $item['quantity'];
			?>
			<tr>
				<td width="20%">
					<?php
						echo $this -> Html -> link(
							$this -> Html->image('uploads/50x50/'.
								$item['image'],
								array('border' => '0','width' => '50px')),
								'/products/view/'.$item['Product']['id'].'/'.$item['color_id'],
								array('escape' => false)
						);
					?>
				</td>
				<td width="60%" style="vertical-align:middle; text-align: center;">
					<?php echo $this -> Html->link($item['Product']['name'], '/products/view/'.$item['Product']['id'].'/'.$item['color_id'],array('class'=>'rosa'));?>
				</br>
					<?php echo $item['quantity']; ?> x <?php  echo "$ ".number_format($item['Product']['price'], 0, ' ', '.'); ?>
				</td>
				<td width="20%" style="vertical-align:middle; text-align: center;">
					<?php //echo $this -> Html->link('Añadir otro par', '/carts/add/inventory_id:'.$item['inventories']['id'].'category_id:'.$item['categories']['id']);?>
					<?php echo $this -> Html->link('Quitar', '/b_cart/ShoppingCarts/removeCartItem/'.$item['id'],array("rel"=>$item['id'],"class"=>"removeCartItem rosa"));?>
				</td>
			</tr>
		<?php endforeach;?>
		<tr id="TotalResumenCarrito">
			<td class="resumen-total" align="right">Total</td>
			<td class="resumen-total" width="30%" align="right"><?php echo   "$ ".number_format( $subTotal, 0, ' ', '.');?></td>
			<td class="resumen-total"></td>
		</tr>
		<tr id="FinalResumenCarrito" class="final">
			<td class="resumen-final" colspan="2" align="center"><?php echo $this -> Html->link('Ir al carrito de compras','/carrito',array('class'=>'rosa'));?></td>
		</tr>
	</table>
</div>
<?php endif;?>
<?php if(empty($shopping_cart['CartItem'])):?>
	<p>[ No hay productos en tu Carrito ]</p>
<?php endif;?>
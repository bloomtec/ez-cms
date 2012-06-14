<?php
$shopping_cart = $this -> requestAction('/b_cart/ShoppingCarts/get');
?>
	<?php if(isset($shopping_cart['ShoppingCart']['CartItem']) && !empty($shopping_cart['ShoppingCart']['CartItem'])):?>
	<?php $subTotal=0; ?>
	<div class="container-tabla">	
		<table id="cesta-tabla">
			<?php foreach($shopping_cart['ShoppingCart']['CartItem'] as $item):?>
				<?php 
					$subTotal += $item['Product']['price'] * $item['CartItem']['quantity'];
				?>
				<tr>
					<td width="20%">
						<?php
							echo $this -> Html -> link(
								$this -> Html->image(
									'/img/uploads/50x50/' . $item['Product']['image'],
									array('border' => '0','width' => '50px')),
									'/products/view/'.$item['Product']['id'],
									array('escape' => false)
							);
						?>
					</td>
					<td width="60%" style="vertical-align:middle; text-align: center;">
						<?php echo $this -> Html->link($item['Product']['name'], '/products/view/'.$item['Product']['id'],array('class'=>'rosa'));?>
					</br>
						<?php echo $item['CartItem']['quantity']; ?> x <?php  echo "$ ".number_format($item['Product']['price'], 0, ' ', '.'); ?>
					</td>
					<td width="20%" style="vertical-align:middle; text-align: center;">
						<!-- <?php Configure::read('Shop.currency');?><?php echo '$' . $item['Product']['price'] * $item['CartItem']['quantity'];?> -->
						<?php //echo $this -> Html->link('Añadir otro par', '/carts/add/inventory_id:'.$item['inventories']['id'].'category_id:'.$item['categories']['id']);?>
						<?php echo $this -> Html->link('Quitar', '/ShoppingCarts/removeCartItem/'.$item['CartItem']['id'],array("rel"=>$item['CartItem']['id'],"class"=>"removeCartItem rosa"));?>
					</td>
				</tr>
			<?php endforeach;?>
			<tr>
				<td align="right">Total</td>
				<td width="30%" align="right"><?php echo   "$ ".number_format( $subTotal, 0, ' ', '.');?></td>
				<td></td>
			</tr>
			<tr class="final">
				<td colspan="2" align="center"><?php echo $this -> Html->link('Ir al carrito de compras','/carrito',array('class'=>'rosa'));?></td>
			</tr>
		</table>
	</div>
	<?php endif;?>
	<?php if(empty($shopping_cart['ShoppingCart']['CartItem'])):?>
		<p>No tiene Items en el carrito</p>
	<?php endif;?>
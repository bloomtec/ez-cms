<?php
	// Obtener el carrito
	//$shopping_cart = $this -> requestAction('/b_cart/ShoppingCarts/get');
	//debug($shopping_cart);
	$shopping_cart=array(
		'ShoppingCart' => array(
			'CartItem' => array(
				0 => array(
								'CartItem' => array(
									'id'=>'1',
									'shopping_cart_id' => '', // si es de usuario registrado
									'product_id' => '',
									'product_size_id' => '',
									'quantity' => '5',
									'created' => '',
									'updated' =>''
								),
								'Product' => array(
									'id' => '2',
									'name'=>'Producto de prueba',
									'reference'=>'9344555',
									'image'=>'http://priceshoes.com.co/img/uploads/200x200/2052208591311286139981708.jpg',
									'price'=>'50000'
								),
								'ProductSize' => array(
									'id'=>'37',
									'name'=>'37'
								)
				),
				1 => array(
								'CartItem' => array(
									'id'=>'2',
									'shopping_cart_id' => '', // si es de usuario registrado
									'product_id' => '',
									'product_size_id' => '',
									'quantity' => '3',
									'created' => '',
									'updated' =>''
								),
								'Product' => array(
									'id' => '2',
									'name'=>'Producto Estrella',
									'reference'=>'9344sdf555',
									'image'=>'http://priceshoes.com.co/img/uploads/200x200/2052208591311286139981708.jpg',
									'price'=>'70000'
								),
								'ProductSize' => array(
									'id'=>'35',
									'name'=>'35'
								)
				),
			)
		)
	);
?>
<?php if(isset($shopping_cart['ShoppingCart']['CartItem']) && !empty($shopping_cart['ShoppingCart']['CartItem'])){?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="2" class="tablaCarrito">
		<?php
			$subTotal=0;
		?>
		<tr class="entryTableHeader">
			<th colspan="2" align="center">Producto</th>
			<th align="center">Precio</td>
			<th width="75" align="center">Cantidad</th>
			<th align="center">Total</td>

		</tr>
		<?php
			foreach($shopping_cart['ShoppingCart']['CartItem'] as $item) {
				$subTotal += $item['Product']['price'] * $item['CartItem']['quantity'];
		?>
		<tr class="content">
			<td width="80" align="center" class="left">
				<?php
				  echo 	$this -> Html->link(
				      			$this -> Html->image(
											'/img/uploads/100x100/' . $item['Product']['image'],
				      						array('border' => '0')
										),
				      					array('action' => '../products/view/'.$item['Product']['id']),
				      					array('escape' => false)
								); 
				?>

			</td>
			<td>
				<h3><?php echo $this -> Html->link( $item['Product']['name'], "/products/view/".$item['Product']['id']);?></h3>
				<span>Ref. <?php echo $item['Product']['reference'] ?></span>
				<span>Talla <?php echo $item['ProductSize']['name']; ?></span>
			</td>
			<td align="center">
				<?php echo "$".number_format( $item['Product']['price'], 0, ' ', '.'); ?>
			</td>
			<td width="115" align="center">
				<?php echo $this -> Form -> create('CartItem', array('url'=>'/carts/updates/','class'=>'updateCartItem')); ?>
				<?php echo $this -> Form -> input('quantity', array('type'=>'text', 'label'=>'', 'value'=>$item['CartItem']['quantity']));?>
				<?php echo $this -> Form -> end("Actualizar");?>
			</td>
			<td align="center" class="right">
				<?php echo "$ ".number_format($item['Product']['price'] * $item['CartItem']['quantity'], 0, ' ', '.');?>
				<br />
				<?php echo $this -> Html->link('Eliminar','/ShoppingCarts/removeCartItem/'.$item['CartItem']['id'],array('class'=>'removeCartItem'));?>
			</td>
		
		</tr>
		<?php
				}
		?>
		<tr class="total">
			<th colspan="3"style="background:none;">
				
			</th>
			<th colspan="1"style="text-align:right;">
				Total
			</th>
			<th style="text-align:center;">
			
				<?php if (isset($subTotal)) echo "$ ".number_format($subTotal, 0, ' ', '.');?>
			</th>

		</tr>
</table>
<?php } else { ?>

<?php } ?>
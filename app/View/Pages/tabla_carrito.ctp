<?php
	// Obtener el carrito
	$shopping_cart = $this -> requestAction('/b_cart/ShoppingCarts/get');
?>
<?php if(isset($shopping_cart['CartItem']) && !empty($shopping_cart['CartItem'])){?>
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
			foreach($shopping_cart['CartItem'] as $item) {
				$subTotal += $item['Product']['price'] * $item['quantity'];
		?>
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
				<span>Talla <?php echo $item['ProductSize']['name']; ?></span>
			</td>
			<td align="center" class="price">
				<?php echo "$".number_format( $item['Product']['price'], 0, ' ', '.'); ?>
			</td>
			<td width="115" align="center" class="quantity">
				<?php echo $this -> Form -> create('CartItem-'.$item['id'], array('url'=>'/carts/updates/','class'=>'updateCartItem','rel'=>$item['id'])); ?>
				<?php
					$options=null;				
					$invetory=$this -> requestAction('/inventories/getQuantity/'.$item['product_id'].'/'.$item['color_id'].'/'.$item['product_size_id']);
					for($i=1;$i <= $invetory['Inventory']['quantity'];$i++){
						$options[$i]=$i;
					}
				?>
				<?php echo $this -> Form -> input('quantity', array('type'=>'select','options'=>$options, 'label'=>'', 'value'=>$item['quantity']));?>
				<?php echo $this -> Form -> end("Actualizar");?>
			</td>
			<td align="center" class="right total">
				<?php echo "$ ".number_format($item['Product']['price'] * $item['quantity'], 0, ' ', '.');?>
				<br />
				<?php echo $this -> Html->link('Eliminar','/b_cart/ShoppingCarts/removeCartItem/'.$item['id'],array('class'=>'removeCartItem'));?>
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
<table class="pago" width="550" border="0" align="center" cellpadding="10" cellspacing="0">
	<tr align="center">
		<td>
			
		</td>
		<td>
			<?php
				echo $this -> Form -> create(null, array('url'=>'/orders/recibirDatosCarrito/'));
				echo $this -> Form->radio("Tarjeta.tipo_de_tarjeta", array("Credito", "Debito"), array("default"=>"Credito"));
				echo $this -> Form -> end('Proceder a pagar');
			?>
		</td>
	</tr>
</table>
<?php } else { ?>
		<p class="rosa" style="text-align:center; font-size:18px; margin-top:20px;">No tienes item en el carrito </p>
<?php } ?>
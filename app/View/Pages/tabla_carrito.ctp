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
<div class="datos-envio">
	<?php	echo $this -> Form -> create('Order', array('url'=>'/orders/add')); ?>
		<?php if(!$this -> Session -> read('Auth.User.id')): ?>
		<div>
			<h2 class="rosa">Datos de usuario</h2>
			<?php echo $this -> Form -> input('User.email', array('label' => 'e-mail', 'type' => 'email', 'required' => 'required')); ?>
			<?php echo $this -> Form -> input('User.verify_email', array('label' => 'Confirma tu e-mail', 'type' => 'email', 'required' => 'required', 'data-equals' => 'data[User][email]')); ?>
			<?php //echo $this -> Form -> input('password',array('type'=>'password','div' => 'password ',"label"=>"Contraseña",'required'=>'required'));?>
			<?php //echo $this -> Form -> input('verify_password',array('type'=>'password','div' => 'password ',"label"=>"Escribe de nuevo tu contraseña",'required'=>'required','data-equals'=>"data[User][password]"));?>
			<br style="clear:both;"/>
			<?php echo $this -> Form -> input('User.name',array('div' => 'input',"label"=>"Escribe tu (s) Nombre (s)",'required'=>'required'));?>
			<?php echo $this -> Form -> input('User.lastname',array('div' => 'input',"label"=>"Escribe tu (s) Apellido (s)",'required'=>'required'));?>
			<div style="clear:both;"></div>
		</div>
		<?php endif; ?>
		<div>
		<h2 class='rosa'>Dirección de envío</h2>
		<p>Danos la dirección donde quieres que se envie tu pedido, esta dirección puede ser una de las que tienes registrada o puedes indicar una nueva</p>
		<?php if($this -> Session -> read('Auth.User.id')){  ?>
			<?php $addresses=$this ->requestAction("/user_control/user_addresses/get"); $i=0; ?>
			<ul class="direcciones">
				<?php foreach($addresses as $address):?>
				<li rel="<?php echo $i; ?>" <?php if($i==0) echo "class='selected'"; $i+=1;?>> <?php echo $address['UserAddress']['name']?></li>
				<?php endforeach;?>
				<li rel="nueva-direccion"> Nueva </li>
			</ul>
			<?php echo $this -> Form->hidden("UserAddress.id");?>
			<?php echo $this -> Form->input("UserAddress.country",array("label"=>"País",'required'=>'required','disabled'=>true));?>
			<?php echo $this -> Form->input("UserAddress.state",array("label"=>"Departamento",'required'=>'required','disabled'=>true));?>
			<br style="clear:both;"/>
			<?php echo $this -> Form->input("UserAddress.city",array("label"=>"Ciudad",'required'=>'required','disabled'=>true));?>
			<?php echo $this -> Form->input("UserAddress.phone",array("label"=>"Teléfono",'disabled'=>true));?>
			<br style="clear:both;"/>
			<?php echo $this -> Form->input("UserAddress.address",array("label"=>"Dirección",'required'=>'required', 'type' => 'textarea','disabled'=>true));?>
		<?php } else { ?>
			<?php echo $this -> Form->input("UserAddress.country",array("label"=>"País",'required'=>'required'));?>
			<?php echo $this -> Form->input("UserAddress.state",array("label"=>"Departamento",'required'=>'required'));?>
			<br style="clear:both;"/>
			<?php echo $this -> Form->input("UserAddress.city",array("label"=>"Ciudad",'required'=>'required'));?>
			<?php echo $this -> Form->input("UserAddress.phone",array("label"=>"Teléfono"));?>
			<br style="clear:both;"/>
			<?php echo $this -> Form->input("UserAddress.address",array("label"=>"Dirección",'required'=>'required', 'type' => 'textarea'));?>
		<?php } ?>
			<div style="clear:both"></div>			
		</div>
		<div>
			<h2 class='rosa'>Comentarios</h2>
			<?php echo $this -> Form->input("comments",array("label"=>false,'required'=>'required', 'type' => 'textarea'));?>
			<div style="clear:both"></div>
		</div>
		<div style="clear:both"></div>
		<?php	echo $this -> Form -> end('Proceder a pagar'); ?>
</div>

<?php } else { ?>
		<p class="rosa" style="text-align:center; font-size:18px; margin-top:20px;">No tienes item en el carrito </p>
<?php } ?>
<?php if(isset($addresses)):?>
	<script type="text/javascript">
		var addresses=<?php echo json_encode($addresses);?>
	</script>
<?php endif;?>
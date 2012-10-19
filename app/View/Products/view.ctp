
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1&appId=157362437721922";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php echo $this -> Html -> script('bcart');?>
<?php echo $this -> Html -> script('jquery-ui.custom.min');?>
<?php //debug($product);?>
<div class="products view">
	<div id="left-col">
		<?php echo $this -> element('novedad'); ?>
		<?php echo $this -> element('resumen-carrito'); ?>
	</div>
	<div id="right-col">
		<div class='black-wrapper cat-description'>
			<h3><?php echo $this -> Html->link($product['Category']['name'],array('controller'=>'categories','action'=>'view','plugin'=>false,$product['Category']['id']),array('class'=>'rosa','style'=>'text-decoration:underline;'))." -> ".$product['Product']['name'];?></h3>
			<p>
			<?php echo $product['Product']['description'];?>
			</p>
		</div> 	
		<?php echo $this -> element('galeria');?>	
		<div class="caracteristicas">
			<div class="colores">			
				<h2>Colores:</h2>
				<ul class="cuadros-colores">
				<?php $productColors; ?>
					<?php if ($product['Inventory']): ?>
						<?php 
							$j=0;
							foreach($product['Inventory'] as $inventory): 						
						?>	
						<?php if(!isset($productColors[$inventory['color_id']])&&$inventory['quantity']): 
								$class="";
								if($j==0){
									if($inventory['color_id']==$this -> params['pass'][1]){
										 $class='first-child selected';
									}else{
										 $class='first-child';
									}	
									$j+=1;
								}elseif($inventory['color_id']==$this -> params['pass'][1]){
									 $class='selected';
								}
						?>
						
								<li rel="<?php echo $inventory['color_id'];?>" <?php echo "class='$class'";?> style="background:<?php echo $inventory['color_code'];?>"></li>
						<?php 	$productColors[$inventory['color_id']]=$inventory["color"];
							endif; 								
						?>
						
						<?php endforeach; ?>
					<?php endif; ?>	
				</ul>
				<div style="clear:both"></div>
			</div>
			<div class="tallas">			
				<h2>Tallas Disponibles:</h2>
				<ul class="cuadros-tallas">
				<?php $productSizes; $options=null;?>
					<?php if (!empty($product['Inventory'])): ?>
						<?php 
							$i=0;
							foreach($product['Inventory'] as $inventory): 
						
						?>
						<?php 	if($inventory['color_id']==$this -> params['pass'][1] && $inventory['quantity']>0): 
									$productSizes[$inventory['product_size_id']]=$inventory["size"];
						?>
									<?php 
										if($i==0){
											for($k=1; $k <= $inventory['quantity']; $k++){
												$options[$k]=$k;
											}
										}
									?>
									<li data="<?php echo $inventory['quantity']?>" rel="<?php echo $inventory['product_size_id'];?>" <?php if($i==0) {echo "class='selected first-child'"; $i+=1;}?>> <?php echo $inventory["size"] ?></li>
					  	<?php							
								endif;							
							endforeach; 
						?>
					<?php endif; ?>	
				</ul>
				<div style="clear:both"></div>
			</div>
			<h2>Precio: <span class='price'><?php echo "$ ".number_format($product['Product']['price'], 0, ' ', '.'); ?></span></h2> 
			<ul class="botones-caracteristicas">
				<?php //if($session->read("Auth.User.id")):?>			
				<li class="to-cart">
					<?php echo $this->Html->link("Añadir al carrito","#",array('class'=>'boton-carrito show-cart-options')); ?>
					<?php echo $this -> Form->create('bcart');?>
					<?php echo $this -> Form -> hidden('product_id-'.$product['Product']['id'],array('class'=>'id','id'=>'product_id','value'=>$product['Product']['id']))?>
					<?php echo $this -> Form -> hidden('color_id-'.$product['Product']['id'],array('class'=>'color_id','value'=>$this -> params['pass'][1]))?>
					<?php echo $this -> Form -> input('product_size_id-'.$product['Product']['id'],array('label'=>'Talla','class'=>'product_size_id','options'=>$productSizes))?>
					<?php echo $this -> Form -> input('quantity-'.$product['Product']['id'],array('label'=>'Cantidad','class'=>'quantity','type'=>'select','options'=>$options,'value'=>'1'))?>
					<div class="actions">
						<a class="button addCartItem" href="/b_cart/shopping_carts/addCartItem/">Aceptar</a>
						<a class="button cancelar" href="#">Cancelar</a>
					</div>
					<?php echo $this -> Form ->end();?>
					<div class="add-cart">
						Producto añadido al Carrito <a href="/carrito">Ir a pagar</a>
					</div>
					<div style="clear:left"></div>
			    </li>
				<?php if($this -> Session -> read('Auth.User.id')): ?>
				<li>
					<?php echo $this->Html->link("Añadir a favoritos",array('controller' => 'favorites', 'action' => 'addFavoriteItem', $product['Category']['id']),array('class'=>'boton-favoritos addFavoriteItem')); ?>
			   		<div class="add-confirm">
						Producto añadido a favoritos.
					</div>
				<div style="clear:left"></div>			   
				</li>
				 <?php endif;?>
				<li class='social'>
					<div class="tweet">
						<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo Configure::read('site_domain').$this -> Html -> url('');?>" data-text="Me encantan estos zapatos!!!" data-via="PriceShoesColom" data-lang="es"></a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</div>
					<!--
					<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
							<a  onclick="window.open('http://twitter.com/share?url=<?php echo rawurlencode("http://".$_SERVER["SERVER_NAME"]."/products/view/".$this -> Html-> url("/products/view/".$product["Product"]["id"]));?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');"class="boton-twitter" target="_blank">Compartir en twitter</a>
					<div style="clear:left"></div>
					-->
					
			    </li>
				<li class='social'>
					<!--<a class='boton-facebook' href="javascript: void(0);" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo urlencode("http://".$_SERVER['SERVER_NAME'].$this -> Html -> url("/products/view/".$product["Product"]["id"]));?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');">
						Compartir en facebook
					</a> -->
				<!--
				<div class="fb-like" data-href="http://priceshoes.com.co/products/view/<?php echo $product['Product']['id']?>" data-send="false" data-width="280" data-show-faces="true"></div>
					<div style="clear:left"></div>
			    -->
				<fb:like href="<?php echo Configure::read('site_domain').$this -> Html -> url('');?>" width="200" height="80"/>
				</li>
				
			</ul>
			
		</div>
	</div>
	<div style="clear:both;"></div>
</div>
<script type="text/javascript">
if(location.hash){
	getProductData(true);
}else{
	getProductData(false);
}
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1&appId=157362437721922";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php echo $this -> Html -> script('bcart');?>
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
			<div class="tallas">
			
				Tallas Disponibles:
				<ul class="cuadros-tallas">
				<?php $productSizes; ?>
					<?php if (!empty($product['Inventory'])): ?>
						<?php 
							foreach($product['Inventory'] as $inventory): 
							$productSizes[$inventory['product_size_id']]=$inventory["size"];
						?>
					  		<li rel="<?php echo $inventory['product_size_id'];?>"> <?php echo $inventory["size"] ?></li>
					  	<?php endforeach; ?>
					<?php endif; ?>	
				</ul>
				<div style="clear:both"></div>
			</div>
			<ul class="botones-caracteristicas">
				<?php //if($session->read("Auth.User.id")):?>			
				<li class="to-cart">
				<?php echo $this->Html->link("Añadir al carrito","#",array('class'=>'boton-carrito show-cart-options')); ?>
						<?php echo $this -> Form->create('bcart');?>
							<?php echo $this -> Form -> hidden('product_id-'.$product['Product']['id'],array('class'=>'id','value'=>$product['Product']['id']))?>
							<?php echo $this -> Form -> input('product_size_id-'.$product['Product']['id'],array('label'=>'talla','class'=>'product_size_id','options'=>$productSizes))?>
							<?php echo $this -> Form -> input('quantity-'.$product['Product']['id'],array('label'=>'Cantidad','class'=>'quantity','type'=>'number','value'=>'1'))?>
							<div class="actions">
								<a class="button addCartItem" href="/b_cart/shopping_carts/updateCartItem/">aceptar</a>
								<a class="button cancelar">cancelar</a>
							</div>
						<?php echo $this -> Form ->end();?>
					<div class="add-cart">
						producto añadido al carrito
					</div>
				<div style="clear:left"></div>
			    </li>
				<li>
					<?php echo $this->Html->link("Añadir a favoritos",array('controller' => 'favorites', 'action' => 'addToFavorite', $product['Category']['id']),array('class'=>'boton-favoritos')); ?>
			   		<div class="add-confirm">
						producto añadido a favoritos
					</div>
				<div style="clear:left"></div>
			    <?php //endif;?>
				</li>
				<li class='social'>
					<div class="tweet">
						<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://priceshoes.com.co/products/view/<?php echo $product['Product']['id']?>" data-text="Me encantan estos zapatos!!!" data-via="PriceShoesColom" data-lang="es"></a>
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
				<div class="fb-like" data-href="http://priceshoes.com.co/products/view/<?php echo $product['Product']['id']?>" data-send="false" data-width="280" data-show-faces="true"></div>
					<div style="clear:left"></div>
			    </li>
				
			</ul>
			
		</div>
	</div>
	<div style="clear:both;"></div>
</div>
	
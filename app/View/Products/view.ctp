<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1&appId=157362437721922";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
			<ul class="botones-caracteristicas">
				<?php //if($session->read("Auth.User.id")):?>
				<li>
					<?php echo $this->Html->link("Añadir a favoritos",array('controller' => 'favorites', 'action' => 'addToFavorite', $product['Category']['id']),array('class'=>'boton-favoritos')); ?>
			   		<div class="add-confirm">
						producto añadido a favoritos
					</div>
				<div style="clear:left"></div>
			    <?php //endif;?>
				</li>
				<li>
				<?php echo $this->Html->link("Añadir al carrito",array('controller' => 'categories', 'action' => 'view', $product['Category']['id']),array('class'=>'boton-carrito')); ?>
			    	<div class="add-cart">
						producto añadido al carrito
					</div>
				<div style="clear:left"></div>
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
			<div class="tallas">
				Tallas:
				<ul class="cuadros-tallas">
					<?php $inventarios=null;//$this->requestAction("/products/getColores/".$product['Product']['id']); ?>
					<?php if (!empty($inventarios)): ?>
						<?php $j=0;foreach($inventario["Talla"] as $talla): ;?>
					  		<li rel="<?php echo $talla['id'];?>" class="<?php if($j++==0) echo "selected"?>"> <?php echo $talla["nombre"] ?></li>
					  	<?php endforeach; ?>
					<?php endif; ?>	
				</ul>
				<div style="clear:both"></div>
			</div>
		</div>
	</div>
	<div style="clear:both;"></div>
</div>
	
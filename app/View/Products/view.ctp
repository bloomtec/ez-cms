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
		
		</div>
	</div>
	<div style="clear:both;"></div>
</div>
	
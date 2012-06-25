<?php 
// esta variable recibe el producto aleatoreo
$product = $this->requestAction('/products/getNovelty');
debug($product);
?>
<div id="promocion" class="caja-producto-lateral">
	<div class="titulo">
		<h1>Novedades</h1>
	</div>
	<?php if (!empty($product['Product'])):?>
	<?php echo $this->Html->image($product["Product"]['image'])?>
	<?php echo $this->Html->para(false,$product["Product"]["reference"])?>
	<?php echo $this->Html->para("precio","$".number_format($product["Product"]['price'], 0, ' ', '.')) ?>
	<?php echo $this->Html->link("Detalle",array("controller"=>"products","action"=>"view",$product["Product"]['id']),array('class'=>'button')) ?>
	<?php endif ?>
</div>
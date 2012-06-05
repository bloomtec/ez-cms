<?php 
// esta variable recibe el producto aleatoreo
//$product = $this->requestAction('/products/novedad');
	$product=array("Product"=>array(
		"ref"=>"161220",
		"imagen"=>"http://priceshoes.com.co/img/uploads/200x200/7612205391311285939421453.jpg",
		"precio"=>"50000",
		"id"=>"1"
	));
?>
<div id="promocion" class="caja-producto-lateral">
	<div class="titulo">
		<h1>Novedades</h1>
	</div>
	<?php if (!empty($product['Product'])):?>
	<?php echo $this->Html->image($product["Product"]['imagen'])?>
	<?php echo $this->Html->para(false,$product["Product"]["ref"])?>
	<?php echo $this->Html->para("precio","$".number_format($product["Product"]['precio'], 0, ' ', '.')) ?>
	<?php echo $this->Html->link("Detalle",array("controller"=>"products","action"=>"view",$product["Product"]['id']),array('class'=>'button')) ?>
	<?php endif ?>
</div>
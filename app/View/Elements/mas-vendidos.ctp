<?php 
// esta variable recibe el producto aleatoreo
$product = $this->requestAction('/products/getTopSeller');
?>
<div id="promocion" class="caja-producto-lateral">
	<div class="titulo">
		<h1>Más Vendidos</h1>
	</div>
	<?php if (!empty($product['Product'])):?>
	<?php echo $this->Html->image('/img/uploads/215x215/'.$product["Inventory"][0]['image'])?>
	<?php echo $this->Html->para(false,$product["Product"]["reference"])?>
	<?php echo $this->Html->para("precio","$".number_format($product["Product"]['price'], 0, ' ', '.')) ?>
	<?php echo $this->Html->link("Detalle",array("controller"=>"products","action"=>"view",$product["Product"]['id'],$product["Inventory"][0]['color_id']),array('class'=>'button')) ?>
	<?php endif ?>
</div>

<?php 
// esta variable recibe el producto aleatoreo
//$product = $this->requestAction('/products/novedad');
	$product=array("Product"=>array(
		"reference"=>"161220",
		"imagen"=>"http://priceshoes.com.co/img/uploads/200x200/7612205391311285939421453.jpg",
		"precio"=>"50000",
		"id"=>"1"
	));
?>
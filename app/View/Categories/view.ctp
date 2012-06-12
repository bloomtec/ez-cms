

<div class="categories view">
	<?php if(isset($category['Category']['banner']) && !empty($category['Category']['banner'])):?>
	<div class="banner">
		<?php echo $category['Category']['banner'];?>
	</div>
	<?php endif;?>
	<div id="left-col">
		<?php echo $this -> element('novedad'); ?>
		<?php echo $this -> element('mas-vendidos'); ?>
	</div>
	<div id="right-col" style="padding-top:0; padding-right:0; width:650px;">
		<div class='black-wrapper cat-description'>
			<h3><?php echo $category['Category']['name'];?></h3>
			<p>
			<?php echo $category['Category']['description'];?>
			</p>
		</div> 
		<?php 
			$product=array(
				"reference"=>"161220",
				"image"=>"http://priceshoes.com.co/img/uploads/200x200/7612205391311285939421453.jpg",
				"price"=>"50000",
				"id"=>"1",
				"name"=>"prueba"
			);
		?>
		<ul class="catalogo-productos">
			<?php $i=1;?>
			<?php foreach($products as $product):?>
			<li <?php if($i%3 == 0) echo "class='last'"?> > 
				<?php echo $this -> Html -> link($this -> Html -> image($product['Product']['image']),array("controller"=>"products","action"=>"view",$product['Product']['id']),array('escape'=>false));?>
				<?php echo $this -> Html -> link($product['Product']['name'],array("controller"=>"products","action"=>"view",$product['Product']['id'])); ?>
				<span class="price"><?php echo "$".number_format($product['Product']['price'], 0, ' ', '.'); ?></span>
			</li>
			<?php $i+=1; ?>
			<?php endforeach;?>
		</ul>
	</div>
	<div style="clear:both;"></div>
</div>

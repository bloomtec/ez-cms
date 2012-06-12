

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
	<div id="right-col">
		<div class='black-wrapper cat-description'>
			<h3><?php echo $category['Category']['name'];?></h3>
			<p>
			<?php echo $category['Category']['description'];?>
			</p>
		</div> 
		
		<ul class="catalogo-productos">
			<?php $i=1;?>
			<?php foreach($products as $product):?>
			<li <?php if($i%3 == 0) echo "class='last'"?> > 
				<?php echo $this -> Html -> link($this -> Html -> image($product['Product']['image']),array("controller"=>"products","action"=>"view",$product['Product']['id']),array('escape'=>false));?>
				<?php echo $this -> Html -> link($product['Product']['name'],array("controller"=>"products","action"=>"view",$product['Product']['id'])); ?>
				<span class="price"><?php echo "$ ".number_format($product['Product']['price'], 0, ' ', '.'); ?></span>
			</li>
			<?php $i+=1; ?>
			<?php endforeach;?>
			<div style="clear:both;"></div>
		</ul>
		<div class="paginado">
			<p>
			<?php
			echo $this->Paginator->counter(array(
			'format' => __('Existen %count% productos en esta categoría!')
			));
			?>	
			</p>
			<div class="paging">
			<?php
				echo $this->Paginator->first('<< ', array('class' => 'first','title'=>'ir al inicio'));
				echo $this->Paginator->prev('< ' . __('anterior '), array(), null, array('class' => 'prev disabled'));
				echo $this->Paginator->numbers(array('separator' => ''));
				echo $this->Paginator->next(__(' siguiente') . ' >', array(), null, array('class' => 'next disabled'));
				echo $this->Paginator->last(' >>', array('class' => 'next last','title'=>'ir al final'));
			?>
			</div>
			<div style="clear:both;"></div>
		</div>
	</div>
	<div style="clear:both;"></div>
</div>

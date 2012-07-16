<?php if(isset($inventories) && !empty($inventories)){?>
<ul class="catalogo-productos">
	<?php $i=1;?>
	<?php foreach($inventories as $product):?>
	<li <?php if($i%3 == 0) echo "class='last'"?> > 
		<?php echo $this -> Html -> link($this -> Html -> image("uploads/215x215/".$product['Inventory']['image']),array("controller"=>"products","action"=>"view",$product['Product']['id'],$product['Inventory']['color_id']),array('escape'=>false));?>
		<?php echo $this -> Html -> link($product['Product']['name'],array("controller"=>"products","action"=>"view",$product['Product']['id'],$product['Inventory']['color_id'])); ?>
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
<?php }else{?>
	<p class='no-hay-productos'>
		No Hay Productos en la categoria
	</p>
<?php }?>
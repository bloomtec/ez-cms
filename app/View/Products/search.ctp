<div class="products index" style="margin:auto; padding:20px; width:720px;">
	<h2><?php echo __('Resultado de la Búsqueda'); ?></h2>
	<?php if(isset($products) && !empty($products)){?>
	<ul class="catalogo-productos" style="padding: 20px;">
		<?php $i=1;?>
		<?php foreach($products as $product): ?>
		<?php
			$index = rand(1, count($product['Inventory']) - 1);
		?>
		<li <?php if($i%3 == 0) echo "class='last'"?> > 
			<?php
				echo
				$this -> Html -> link(
					$this -> Html -> image('uploads/215x215/' . $product['Inventory'][$index]['image']),
					array(
						"controller" => "products",
						"action" => "view",
						$product['Product']['id'],
						$product['Inventory'][$index]['color_id']
					),
					array(
						'escape'=>false
					)
				);
			?>
			<?php
				echo
				$this -> Html -> link(
					$product['Product']['name'],
					array(
						"controller"=>"products",
						"action"=>"view",
						$product['Product']['id'],
						$product['Inventory'][$index]['color_id']
					)
				);
			?>
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
		'format' => __('Se encontraron %count% productos.')
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
			No se encontraron productos con esa referencia.
		</p>
	<?php }?>
</div>
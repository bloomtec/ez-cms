<?php
$favoritos = $this -> requestAction('/favorites/get');
?>
<?php if(isset($favoritos['FavoriteItem']) && !empty($favoritos['FavoriteItem'])):?>
<?php $subTotal=0; ?>
	<div class="container-tabla">	
		<table id="cesta-tabla">
			<?php foreach($favoritos['FavoriteItem'] as $item):?>
				<tr>
					<td width="20%">
						<?php
							echo $this -> Html -> link(
								$this -> Html->image('uploads/50x50/'.
									$item['image'],
									array('border' => '0','width' => '50px')),
									'/products/view/'.$item['Product']['id'].'/'.$item['color_id'],
									array('escape' => false)
							);
						?>
					</td>
					<td width="60%" style="vertical-align:middle; text-align: center;">
						<?php echo $this -> Html->link($item['Product']['name'], '/products/view/'.$item['Product']['id'].'/'.$item['color_id'],array('class'=>'rosa'));?>
					</td>
					<td width="20%" style="vertical-align:middle; text-align: center;">
						<?php //echo $this -> Html->link('Añadir otro par', '/carts/add/inventory_id:'.$item['inventories']['id'].'category_id:'.$item['categories']['id']);?>
						<?php echo $this -> Html->link('Quitar', '/favorites/removeFavoriteItem/'.$item['id'],array("rel"=>$item['id'],"class"=>"removeFavoriteItem rosa"));?>
					</td>
				</tr>
			<?php endforeach;?>
		</table>
	</div>
<?php endif;?>
<?php if(empty($favoritos['FavoriteItem'])):?>
	<p>[ No hay productos en tus Favoritos ]</p>
<?php endif;?>
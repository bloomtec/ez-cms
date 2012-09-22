<div id="menu-categorias">
	<?php echo $this -> Html->image('menu-cat-flecha.png',array('class'=>'detalle-submenu'));?>
	<div class="container">
		<?php /* 
		<div class="foto-categoria">
			<?php //echo $this -> Html -> image('logo_borde.png');?>
		</div>
		 */?>
		<ul>
			<?php $categories = $this -> requestAction('/categories/get'); ?>
			<?php foreach($categories as $key => $category) : ?>
			<li>
				<?php /*<img src="/img/uploads/215x215/<?php echo $category['Category']['image']; ?>" /> */?>
				<a href="<?php echo '/categories/view/' . $category['Category']['id']; ?>"><?php echo $category['Category']['name']; ?></a>
			</li>
			<?php endforeach; ?>
			<div style="clear:both;"></div>
		</ul>
	</div>
</div>
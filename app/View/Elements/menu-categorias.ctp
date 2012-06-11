<div id="menu-categorias">
	<div class="container">
		<div class="foto-categoria">
			
		</div>
		<ul>
			<?php
				$menu_items = $this -> requestAction('/menus/getMenuItems/principal');
				foreach ($menu_items as $key => $menu_item) :
			?>
			<li>
				<img src="http://priceshoes.com.co/img/uploads/200x200/7612205391311285939421453.jpg" />
				<a href="<?php echo '/pages/view/' . $menu_item['MenuItem']['link']; ?>"><?php echo $menu_item['MenuItem']['name']; ?></a>
			</li>
			
			<?php endforeach; ?>
			<div style="clear:both;"></div>
		</ul>
	</div>
</div>
<ul>
	<?php
		$menu_items = $this -> requestAction('/menus/getMenuItems/paginas-inferior');
		foreach ($menu_items as $key => $menu_item) :
	?>
		<?php //if($menu_item['MenuItem']['id'] < 20): ?>
		<!--<li>-->
			<!--<a href="--><?php //echo '/pages/' . $menu_item['MenuItem']['link']; ?><!--">--><?php //echo $menu_item['MenuItem']['name']; ?><!--</a>-->
		<!--</li>-->
		<?php //endif; ?>
		<?php if($menu_item['MenuItem']['id'] >= 20): ?>
		<li>
			<a href="<?php echo '/pages/view/' . $menu_item['MenuItem']['link']; ?>"><?php echo $menu_item['MenuItem']['name']; ?></a>
		</li>
		<?php endif; ?>
	<?php endforeach; ?>
</ul>
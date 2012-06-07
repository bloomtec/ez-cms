<ul>
	<?php
		$menu_items = $this -> requestAction('/menus/getMenuItems/principal');
		foreach ($menu_items as $key => $menu_item) :
	?>
	<li>
		<a href="<?php echo $menu_item['MenuItem']['link']; ?>"><?php echo $menu_item['MenuItem']['name']; ?></a>
	</li>
	<?php endforeach; ?>
</ul>
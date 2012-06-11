

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
		<?php echo $category['Category']['name'];?>
	</div>
	<div style="clear:both;"></div>
</div>

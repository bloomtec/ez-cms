<div class="categories view">
	<?php if(isset($category['Category']['banner']) && !empty($category['Category']['banner'])):?>
	<div class="banner">
		<?php echo $category['Category']['banner']; ?>
	</div>
	<?php endif; ?>
	<div id="left-col">
		<?php echo $this -> element('survey'); ?>
		<?php echo $this -> element('novedad'); ?>
		<?php echo $this -> element('mas-vendidos'); ?>
	</div>
	<div id="right-col">
		<div class='black-wrapper cat-description'>
			<h3><?php echo $category['Category']['name']; ?></h3>
			<p style="line-height: 17px;"><?php echo $category['Category']['description']; ?></p>
		</div> 
		
		<?php echo $this -> element('listado-por-inventarios'); ?>
		
	</div>
	<div style="clear:both;"></div>
</div>

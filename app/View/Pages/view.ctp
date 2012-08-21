<div id="left-col">
	<?php if($page['Page']['element1']) echo $this -> element($page['Page']['element1']);?>
	<?php if($page['Page']['element2']) echo $this -> element($page['Page']['element2']);?>
	<?php if($page['Page']['element3']) echo $this -> element($page['Page']['element3']);?>
	<?php echo $page['Page']['left_content'];?>
</div>
<div id="right-col" class='black-wrapper'>
	<?php echo $page['Page']['content'];?>
</div>
<div class="promocionados">
	<ul>
		<?php $i=0; ?>
		<?php foreach($categories as $category):?>
			<?php if($i<5){?>
			<?php 
			$class="";
				if($i==0){
					$class="class='first'";
				}elseif($i==4){
					$class="class='last'";
				}
			?>
			<li <?php echo $class;?>> 
			<?php echo $this->Html->image("uploads/".$category["Category"]["image"])?>
			<?php echo $this->Html->link($category["Category"]["name"],array("controller"=>"categories","action"=>"view",$category["Category"]["id"])) ?>
			</li>
			<?php }$i++;?>
		<?php endforeach;?>
	</ul>
	<div style="clear:both"></div>
</div>
<?php echo $this->requestAction("/banners/get/indice-categoria");?>
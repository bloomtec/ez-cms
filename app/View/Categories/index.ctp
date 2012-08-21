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
			<?php
				echo $this -> Html -> image(
					"uploads/" . $category["Category"]["image"],
					array(
						'alt' => $category["Category"]["name"],
						'url' => array(
							"controller" => "categories",
							"action" => "view",
							$category["Category"]["id"]
						)
					)
				);
			?>
			<?php
				echo $this -> Html -> link(
					$category["Category"]["name"],
					array(
						"controller" => "categories",
						"action" => "view",
						$category["Category"]["id"],
					),
					array(
						'class' => 'name'
					)
				);
			?>
			</li>
			<?php }$i++;?>
		<?php endforeach;?>
	</ul>
	<div style="clear:both"></div>
</div>
<?php echo $this->requestAction("/banners/get/indice-categoria");?>
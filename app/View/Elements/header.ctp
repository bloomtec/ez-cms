<div id="header">
	<h1 class='logo'><a href="/">  PRICE SHOES </a></h1>
	<div class="left">
		<div id="buscar">
			<?php echo $this -> Form->create("Product",array("action"=>"search","controller"=>"products"));?>
	              <?php echo $this -> Form->input("search",array("label"=>false,'class'=>'layout'));?>
	        <?php echo $this -> Form->end('Buscar');?>
		</div>	
		
		<ul class="opciones">
			<li>
				<?php 
				echo $this -> Html->link("Mi Cuenta",array("controller"=>"users","action"=>"login"));
				?>
			</li>
		    <li>
		        <?php 
            	if(!$this -> Session->read("Auth.User.id")){
            		echo $this -> Html->link("Registro","/registro");
				}else{
					 echo $this -> Html->link("Salir",array("controller"=>"users","action"=>"logout"));
				}		
			?>
		    </li>
		</ul>
	</div>
	<div style="clear:both;"></div>	
	<ul id="main-nav">
	   	<li>
	        <?php echo $this -> Html->link("Acerca de",array("controller"=>"pages","action"=>"view","acerca-de"))?>
	    </li>
	    <li>
	        <?php echo $this -> Html->link("Nuestras Tiendas",array("controller"=>"pages","action"=>"view","nuestras-tiendas"))?>
	    </li>
	    <li>
	        <?php echo $this -> Html->link("Tendencias",array("controller"=>"pages","action"=>"view","tendencias"))?>
	    </li>
	    <li>
	        <?php echo $this -> Html->link("Tienda Virtual","/tienda-virtual")?>
	    </li>
	   	<li>
			<?php echo $this -> Html->link("Franquicias",array("controller"=>"pages","action"=>"view","franquicias"))?>
		</li>
		<li>
			<?php echo $this -> Html->link("Contacto",array("controller"=>"pages","action"=>"contacto"))?>
		</li>
	 </ul>
</div>
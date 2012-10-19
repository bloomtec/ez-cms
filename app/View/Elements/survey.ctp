
<div id="sondeo"  class="caja-producto-lateral">
	<div class="titulo">
		<h1>Sondeo</h1>
	</div>
	<?php $sondeo=$this->requestAction("/surveys/sondeo");?>
	<?php //$sondeo['Survey']['titulo']="Que tipo de zapatos utilizas los fines de semana?";?>
	<?php /*$sondeo['SurveyOption']=array(
		"0"=>array("id"=>"1","name"=>"Plataformas"),
		"1"=>array("id"=>"2","name"=>"Tennis"),
		"2"=>array("id"=>"3","name"=>"Bajitos"),
		"3"=>array("id"=>"4","name"=>"Baletas"),
		"4"=>array("id"=>"5","name"=>"Tacones altos"),
		"5"=>array("id"=>"6","name"=>"Tacones Medios"),

	);*/?>
	<?php //debug($this -> Session->read("voto"));?>
	<div class="wrapper">
		<?php if($sondeo && !$this -> Session->read("voto")){?>
		<h3><?php echo $sondeo["Survey"]["titulo"]; ?></h3>
		<ul>
		<?php foreach($sondeo["SurveyOption"] as $i=>$option):?>
			<li><span <?php if($i==0) echo "class='activo'"?> rel="<?php echo $option["id"];?>"></span> <?php echo $option["name"]?></li>
		<?php endforeach;?>
		</ul>
		<div class="button votar">Votar</div>
		<div style="clear:both;"></div>
		<?php }else{?>
			<p style="text-align:center;">No hay sondeo disponibles </p>
		<?php } ?>
		
	</div>	
	<div class="mensaje">
		Gracias por participar de la encuesta. Tu opinión es muy valiosa para nosotros.
	</div>	
</div>
<script type="">
	$(function(){
		var sondeo=function(){
			$("#sondeo li span").click(function(){
				var activo=$(this);
				$("#sondeo li span").removeClass("activo");
				activo.addClass("activo");
							
			});
			$("#sondeo .votar").click(function(){
			BJS.post("/surveys/voting",{optionId:$("#sondeo span.activo").attr("rel")},function(data){
					if(data){
						$("#sondeo .wrapper").fadeOut("slow",function(){
							$("#sondeo .mensaje").fadeIn();
						});
					}
				});
			});
		}();
	});
</script>
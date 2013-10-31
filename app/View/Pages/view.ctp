<?php /*if($page['Page']['id'] == 1):?>
    <div class="promocionados">
        <?php echo $page['Page']['content'];?>
    </div>
<?php else: ?>
<div id="left-col">
	<?php if($page['Page']['element1']) echo $this -> element($page['Page']['element1']);?>
	<?php if($page['Page']['element2']) echo $this -> element($page['Page']['element2']);?>
	<?php if($page['Page']['element3']) echo $this -> element($page['Page']['element3']);?>
	<?php echo $page['Page']['left_content'];?>
</div>
<div id="right-col" class='black-wrapper'>
	<?php echo $page['Page']['content'];?>
</div>

<?php endif; */?>


<?php if(!$page['Page']['element1'] && !$page['Page']['element2'] && !$page['Page']['element3']):?>
    <div class="promocionados">
        <?php echo $page['Page']['content'];?>
    </div>
<?php else: ?>
    <div id="left-col">
        <?php if($page['Page']['element1']) echo $this -> element($page['Page']['element1']);?>
        <?php if($page['Page']['element2']) echo $this -> element($page['Page']['element2']);?>
        <?php if($page['Page']['element3']) echo $this -> element($page['Page']['element3']);?>
        <?php echo $page['Page']['left_content'];?>
    </div>
    <div id="right-col" class='black-wrapper'>
        <?php echo $page['Page']['content'];?>
    </div>
<?php /*
<script type="text/javascript">
	$(function() {
		if($.browser.msie)
			alert(
				'Estas usando Internet explorer ' + $.browser.version
					+ "\nPara garantizar la correcta funcionalidad del sitio"
					+ "\nutiliza la última versión de Chrome o Firefox"
					+ "\n<< Versiones de Internet Explorer menores a la 9 contendrán errores >>"
			);
	});
</script>
  */?>

<?php endif;?>
<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo 'PriceShoes'?> :: 
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		
		echo $this->Html->css('reset');
		//echo $this->Html->css('ie');
		echo $this->Html->css('styles');
		
		echo $this->Html->Script('jquery.min');
		echo $this->Html->Script('jquery.tools.min');
		//echo $this->Html->Script('cufon');
		echo $this -> Html -> script('common'); 
		//echo $this->Html->Script('HelveticaNeueLT_LightExt2_400-HelveticaNeueLT_LightExt2_400.font');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
<script type="text/javascript"> 
	/*Cufon.now(); 
	Cufon.set('fontFamily', 'HelveticaNeueLT LightExt2').replace('body');*/
</script>
</head>
<body id="profile" class="<?php echo $this -> action;?>">
	<div id="container">
		<?php echo $this -> element('header');?>
		<div id="content">
			<div id="left-col">
			<?php echo $this -> element('novedad');?>
			<?php echo $this -> element('resumen-favoritos');?>
			</div>
			<div id="right-col">
				<ul id="profile-menu">
					<li class='profile'> <a href="/user_control/users/profile">Mi Perfil</a></li>
					<li class='edit'> <a href="/user_control/users/edit">Modificar Datos</a></li>
					<li class='orders'> <a href="/user_control/users/orders">Mis Pedidos</a></li>
				</ul>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
			</div>
			<div style="clear:both;"> </div>
		</div>
	</div>
	<?php echo $this -> element('footer');?>
	<?php echo $this->element('sql_dump'); ?>
<?php if(!Configure::read('debug')):?>
	<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//cdn.zopim.com/?RydcgQ0EvdOO6ZP5TRy6z7UuI5kGyn9f';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
<!--End of Zopim Live Chat Script-->
<?php endif;?>
</body>
</html>

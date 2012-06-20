$(function(){
	// FUNCIONALIDADES GENERALES CARRITO
	$('.to-cart .cancelar').click(function(){
		$('.to-cart.open').removeClass('open');// funciona para 
	});
	$('.to-cart .addCartItem').click(function(e){
		e.preventDefault();
		$that=$(this);
		$form=$that.parent().parent();		
		BJS.JSON($that.attr('href')+$form.find('input.id').val()+"/"+$form.find('select.product_size_id option:selected').val()+"/"+$form.find('input.quantity').val()+"/"+$form.find('input.color_id').val(),{},function(response){
			if(response.success){
				$('.resumen-carrito').load('/pages/resumenCarrito');
				$('.to-cart.open').removeClass('open');
				$('.add-cart').show();
				setTimeout(function(){
				$('.add-cart').hide();
				},2000);
				
			}else{
				alert('No se pudo actualizar el carrito, ¡intenta nuevamente!');
			}
			
		});
		
		
	});

	$('.resumen-carrito').on('click','.removeCartItem',function(e){
		e.preventDefault();
		$that=$(this);
		BJS.JSON($that.attr('href'),{},function(response){
			if(response.success){
				$('.resumen-carrito').load('/pages/resumenCarrito');
			}else{
				alert('No se pudo actualizar el carrito, ¡intenta nuevamente!');
			}
			
		});
	});
	$('.tabla-carrito').on('click','.removeCartItem',function(e){
		e.preventDefault();
		$that=$(this);
		$height=$('.tabla-carrito').height()+"px";
		$('.actualizando').css({'height':$height,'line-height':$height}).show();
		BJS.JSON($that.attr('href'),{},function(response){
			if(response.success){
				$('.tabla-carrito .content').load('/pages/tablaCarrito',function(){
					$('.actualizando').hide();
				});
			}else{
				alert('No se pudo actualizar el carrito, ¡intenta nuevamente!');
			}
			
		});
	});
	
	$('.tabla-carrito').on('submit','form.updateCartItem',function(e){
		e.preventDefault();
		$height=$('.tabla-carrito').height()+"px";
		$('.actualizando').css({'height':$height,'line-height':$height}).show();
		var $that=$(this);
		var quantity=$that.find('input[type="number"]').val();
		BJS.JSON('/b_cart/shopping_carts/updateCartItem/'+$that.attr('rel')+"/"+quantity,{},function(response){
			if(response.success){
				$('.tabla-carrito .content').load('/pages/tablaCarrito',function(){
					$('.actualizando').hide();
				});
			}else{
				alert('No se pudo actualizar el carrito, ¡intenta nuevamente!');
			}
			
		});
		
		// '/b_cart/shopping_carts/get'
	});
	//FUNCIONALIDADES PARA PRODUCTS/VIEW
	$('body').click(function(e){		
		if($('.to-cart.open').length){// si está abierto el cuadro de comprar
			if(!$(e.target).parents().is('.to-cart')&&!$(e.target).is('.to-cart')){
				$('.to-cart.open').removeClass('open');
			}
		}
	});
	$('.cuadros-tallas').on('click','li',function(){
		$that=$(this);
		$('select.product_size_id').val($that.attr('rel'));
		$('.cuadros-tallas li').removeClass('selected');
		$that.addClass('selected');
	});
	$('.cuadros-colores').on('click','li',function(){
		$that=$(this);
		$('input.color_id').val($that.attr('rel'));
		$('.cuadros-colores li').removeClass('selected');
		$that.addClass('selected');
	});
	$('select.product_size_id').change(function(){
		$that=$(this);
		$('.cuadros-tallas li').removeClass('selected');
		$('.cuadros-tallas li[rel="'+$that.val()+'"]').addClass('selected');
	});
	$('.show-cart-options').click(function(e){
		e.preventDefault();
		$parent=$(this).parent();
		if($parent.is('.open')){
			$parent.removeClass('open');
		}else{
			$parent.addClass('open');
		}
	});
	
	
	
});
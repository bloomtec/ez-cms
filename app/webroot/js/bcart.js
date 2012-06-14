$(function(){
	$('.show-cart-options').click(function(e){
		e.preventDefault();
		$parent=$(this).parent();
		if($parent.is('.open')){
			$parent.removeClass('open');
		}else{
			$parent.addClass('open');
		}
	});
	$('.to-cart .cancelar').click(function(){
		$('.to-cart.open').removeClass('open');// funciona para 
	});
	$('.to-cart .addCartItem').click(function(e){
		e.preventDefault();
		$that=$(this);
		$form=$that.parent().parent();		
		BJS.JSON($that.attr('href')+$form.find('input.id').val()+"/"+$form.find('select.product_size_id option:selected').val()+"/"+$form.find('input.quantity').val(),{},function(response){
			if(response.success){
				$('.resumen-carrito').load('/pages/resumenCarrito');
			}else{
				alert('No se pudo actualizar el carrito, ¡intenta nuevamente!');
			}
			
		});
		
		
	});

	$('.tabla-carrito').on('click','.removeCartItem',function(e){
		e.preventDefault();
	});
	
	$('.tabla-carrito').on('submit','form.updateCartItem',function(e){
		e.preventDefault();
		var $that=$(this);
		var quantity=$that.find('input[type="number"]').val();
		alert(quantity);
		BJS.JSON('/b_cart/shopping_carts/updateCartItem/'+$that.attr('rel')+"/"+quantity,{},function(response){
			if(response.succes){
				$('.tabla-carrito').load('/pages/tablaCarrito');
			}else{
				alert('No se pudo actualizar el carrito, ¡intenta nuevamente!');
			}
			
		});
		
		// '/b_cart/shopping_carts/get'
	});
	
});
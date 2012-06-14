$(function(){
	$('.show-cart-options').click(function(e){
		e.preventDefault();
		$parent=$(this).parent();
		console.log($parent);
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
		alert($that.attr('href'));
		
		
	});

	$('.tabla-carrito').on('click','.removeCartItem',function(e){
		e.preventDefault();
	});
	
	$('.tabla-carrito').on('submit','form.updateCartItem',function(e){
		e.preventDefault();
		var $that=$(this);
		var quantity=$that.find('input[type="number"]').val();
		alert(quantity);
		BJS.JSON('/b_cart/shopping_carts/updateCartItem/'+$that.attr('rel')+"/"+quantity,{},function(){
			$('.tabla-carrito').load('/pages/tablaCarrito');
		});
		
		// '/b_cart/shopping_carts/get'
	});
	
});
var galeria;
$(function(){
	// FUNCIONALIDADES GENERALES CARRITO
	$('.to-cart .cancelar').click(function(){
		$('.to-cart.open').removeClass('open');// funciona para 
	});
	$('.to-cart .addCartItem').click(function(e){
		e.preventDefault();
		$that=$(this);
		$form=$that.parent().parent();		
		BJS.JSON($that.attr('href')+$form.find('input.id').val()+"/"+$form.find('input.color_id').val()+"/"+$form.find('select.product_size_id option:selected').val()+ "/"+$form.find('select.quantity').val(),{},function(response){
			if(response.success){
				$('.resumen-carrito').load('/pages/resumenCarrito');
				$('.to-cart.open').removeClass('open');
				$('.add-cart').show();
				setTimeout(function(){
				$('.add-cart').hide();
				},2000);
				
			}else{
				alert(response.message);
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
				alert(response.message);
			}
			
		});
	});
	
	$('.tabla-carrito').on('submit','form.updateCartItem',function(e){
		e.preventDefault();
		$height=$('.tabla-carrito').height()+"px";
		$('.actualizando').css({'height':$height,'line-height':$height}).show();
		var $that=$(this);
		var quantity=$that.find('select').val();
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
	// FUNCIONALIDADES FAVORITOS
	$('.addFavoriteItem').click(function(e){
		e.preventDefault();
		$that=$(this);
		$form=$that.parent().parent();		
		BJS.JSON('/favorites/addFavoriteItem/'+$form.find('input.id').val()+"/"+$form.find('input.color_id').val()+"/"+$form.find('select.product_size_id option:selected').val(),{},function(response){
			if(response.success){
				$('.add-confirm').show();
				setTimeout(function(){
				$('.add-confirm').hide();
				},2000);
				
			}else{
				alert(response.message);
			}
			
		});		
	});
	$('.resumen-favoritos').on('click','.removeFavoriteItem',function(e){
		e.preventDefault();
		$that=$(this);
		BJS.JSON($that.attr('href'),{},function(response){
			if(response.success){
				$('.resumen-favoritos .content').load('/pages/resumenFavoritos');
			}else{
				alert(response.message);
			}
			
		});
	});
	$('.tabla-carrito').on('click','.removeFavoriteItem',function(e){
		e.preventDefault();
		$that=$(this);
		$height=$('.tabla-carrito').height()+"px";
		$('.actualizando').css({'height':$height,'line-height':$height}).show();
		BJS.JSON($that.attr('href'),{},function(response){
			if(response.success){
				$('.tabla-carrito .content').load('/pages/tablaFavoritos',function(){
					$('.actualizando').hide();
				});
			}else{
				alert(response.message);
			}
			
		});
	});
	
	
	
	
	
	
	//FUNCIONALIDADES PARA PRODUCTS/VIEW
	galeria={
		ORIGINAL_WIDTH:360,
		ORIGINAL_HEIGHT:360,
		MAX_WIDTH:750,
		MAX_HEIGHT:750,
		DURATION:400,
		last_width:360,
		last_height:360,
		last_top:0,
		last_left:0,
		zoom_ratio:50,
		init:function(){
			//FUNCIONES ZOOM
			that=this;
			$(".galeria").on("click",".zoom-in",function(){
				that.guardarEstado();
				var newWidth= that.last_width + that.zoom_ratio;	
				if(newWidth<=that.MAX_WIDTH){
					$(".imagen-container img").animate({"width":newWidth,"height":newWidth,left:that.last_left-(that.zoom_ratio/2),top:that.last_top-(that.zoom_ratio/2)},that.DURATION);
				}
				
			});			
			$(".galeria").on("click",".zoom-out",function(){
				that.guardarEstado();
				var newWidth=that.last_width - that.zoom_ratio;
				if(newWidth>=that.ORIGINAL_WIDTH){
					$(".imagen-container img").animate({"width":newWidth,"height":newWidth,left:that.last_left+(that.zoom_ratio/2),top:that.last_top+(that.zoom_ratio/2)},that.DURATION);
				}
				
			});
			$(".galeria").on("click",".reset",function(){
				that.guardarEstado();
				that.reset();
			});
		},
		reset:function(){
			that=this;
			$(".imagen-container img").animate({"width":that.ORIGINAL_WIDTH,"height":that.ORIGINAL_HEIGHT,left:0,top:0},that.DURATION);
		},
		change:function(gallery){					
					if(typeof gallery['Image']['0']!="undefined"){
					$(".galeria .imagen-container").html("<img src='/img/uploads/750x750/"+gallery['Image']['0']['path']+"'>");
					$(".galeria .thumbs").html("");
					$.each(gallery['Image'],function(i,image){
						$(".galeria .thumbs").append("<img src='/img/uploads/100x100/"+image['path']+"'>");
					});
					$(".imagen-container img").draggable({ drag: function(event, ui) {
						if(ui.position.top>=0){// Controla limites horizontales
							ui.position.top=0;
						}
						if(ui.position.left>=0){// Controla limites horizontales
							ui.position.left=0;
						}
						var maxLeft=(parseInt($(".galeria .imagen-container img").width())- that.ORIGINAL_WIDTH);
						if(ui.position.left<=-maxLeft){// Controla limites horizontales
							ui.position.left=-maxLeft;
						}
						var maxTop=(parseInt($(".galeria .imagen-container img").height())- that.ORIGINAL_HEIGHT);
						if(ui.position.top<=-maxTop){// Controla limites horizontales
							ui.position.top=-maxTop;
						}
					}});
					}else{
						//NO HAY GALERIA
					}
					
				

	
		},
		guardarEstado:function(){
			that.last_width=parseFloat($(".imagen-container img").width());
			that.last_height=parseFloat($(".imagen-container img").height());
			that.last_top=parseFloat($(".imagen-container img").css("top"));
			that.last_left=parseFloat($(".imagen-container img").css("left"));
		},				
	};
	galeria.init();

	$(".galeria .thumbs img").live("click",function(){
		var newSrc=$(this).attr("src").replace("100x100","750x750");
		$(".galeria .imagen-container img").attr("src",newSrc);
	});
	
	
	$('body').click(function(e){		
		if($('.to-cart.open').length){// si está abierto el cuadro de comprar
			if(!$(e.target).parents().is('.to-cart')&&!$(e.target).is('.to-cart')){
				$('.to-cart.open').removeClass('open');
			}
		}
	});
	$('.cuadros-tallas').on('click','li',function(){
		$that=$(this);
		quantity=parseInt($that.attr('data'));
		$('select.product_size_id').val($that.attr('rel'));		
		updateSelectQuantity(quantity);
		
		$('.cuadros-tallas li').removeClass('selected');
		$that.addClass('selected');
	});
	
	$('.cuadros-colores').on('click','li',function(){
		$that=$(this);		
		//window.location=$that.attr('rel');
		window.location.hash=$that.attr('rel');		
		getProductData(true);
	});
	$('select.product_size_id').change(function(){
		$that=$(this);
		$('.cuadros-tallas li').removeClass('selected');
		$('.cuadros-tallas li[rel="'+$that.val()+'"]').addClass('selected');
		quantity=parseInt($('.cuadros-tallas li[rel="'+$that.val()+'"]').attr('data'));
		updateSelectQuantity(quantity);
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
function updateSelectQuantity(quantity){
	$('select.quantity').html('');
	for(i=1;i<=quantity;i++){
		if(i==1){
			$('select.quantity').append('<option value="'+i+'" selected="selected">'+i+'</option>');
		}else{
			$('select.quantity').append('<option value="'+i+'">'+i+'</option>');
		}					
	}
}
function getProductData(getTallas){
	if(location.hash){
		var color=location.hash.slice(1);
		$('.cuadros-colores li').removeClass('selected');
		var $that=$('li[rel="'+color+'"]');
		$('input.color_id').val($that.attr('rel'));
		$that.addClass('selected');
	}else{
		var color=$('input.color_id').val();
		var $that=$('li[rel="'+color+'"]');
	}
	BJS.JSON("/inventories/getInventoryData/"+$('input#product_id').val()+"/"+color,{},function(response){
		if(getTallas && response.ProductSize){		
			var $tallas=$('ul.cuadros-tallas');
			var $selecTallas=$('select.product_size_id');
			$tallas.html("");
			$selecTallas.html("");
			j=0;
			quantity=0;
			numTallas=BJS.objectSize(response.ProductSize);
			$.each(response.ProductSize,function(i,val){
				clase="";
				if(j==0){
					clase="selected first-child";
					quantity=val.quantity;
				}
				j+=1;
				$tallas.append('<li data="'+val.quantity+'" rel="'+i+'" class="'+clase+'">'+val.size+'</li>');
				$selecTallas.append('<option value="'+i+'">'+val.size+'</option>');
				if(j == numTallas){//Acctualiza las tallas
					updateSelectQuantity(quantity);
				}
			});
		}
		if(response.Gallery){
			galeria.change(response.Gallery);
		}
		
	});
}
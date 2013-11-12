$(function() {

	/**
	 * Asignar cupon automaticamente cuando este sea de una promoción del sitio como tal.
	 */
	BJS.get('/promotions/getPromotionCouponId', {}, function(couponCode) {
		if(couponCode) {
			$('#CouponCode').val(couponCode);
			verifyCoupon(couponCode);
		}
	});
	/**
	 * Solicitar obtener la información del cupon digitado
	 */
	$('#SetCoupon').click(function() {
      //  alert("hola");
		var couponCode = $('#CouponCode').val();
        verifyCoupon(couponCode);
	});

	/**
	 * Obtener la información de un cupon especifico
	 */
	function verifyCoupon(couponCode) {
		if(couponCode) {
			var couponInfo = null;
			BJS.get('/coupon_batches/getCouponInfo/' + couponCode, {}, function(couponData) {
				couponInfo = $.parseJSON(couponData);
				if(couponInfo) {
					// Asignar el cupon al formulario
					$('#OrderCouponCode').val(couponCode);

					// Obtener el carrito y procesar la información
					BJS.JSON('/b_cart/shopping_carts/get/1', {}, function(shoppingCartData) {
						var subTotal = 0;

						/**
						 * Proceso para cuando solo sea % de descuento en la compra
						 */
						if (couponInfo.CouponBatch.coupon_type_id == 3) {
							$.each($('.cart-item'), function(i, val) {
								subTotal += getDiscountXPercentOfTotal($(val).attr('rel'), couponInfo.CouponBatch.discount);
							})
						} else {
							/**
							 * Proceso para cuando se es pague uno lleve 2 o paque el 2do a un % de descuento
							 */
							// Obtener el total de pares de zapatos comprados
							var totalItems = 0;
							$.each(shoppingCartData.CartItem, function(i, item) {
								totalItems += parseInt(item.quantity);
								item.displayPrice = 0;
							});
							// Ver cuantas parejas de pares de zapatos hay
							var pairs = parseInt(totalItems / 2);
							// Procesar el pedido y obtener los descuentos acorde el tipo de cupon (solo aplica a los pares)
							do {
								// Recorrer los items comprados de mayor a menor precio
								for(pos = 0, foundFirst = false; pos < shoppingCartData.CartItem.length & !foundFirst; pos += 1) {
									// Verificar la cantidad de pares comprados del ítem
									if(parseInt(shoppingCartData.CartItem[pos].quantity) >= 1) {
										// Hay uno o más de un par de zapatos de este ítem
										shoppingCartData.CartItem[pos].quantity -= 1;
										foundFirst = true;
										subTotal += parseInt(shoppingCartData.CartItem[pos].price);
										shoppingCartData.CartItem[pos].displayPrice += parseInt(shoppingCartData.CartItem[pos].price)
										/**
										 * Se redujo la cantidad en 1 lo que implica que se reviso este par de zapatos.
										 * Proceder a aplicar descuentos apliclables a los pares con menores precios.
										 * NOTA: Proceso en el siguiente for()...
										 */
									} else {
										// Ya fueron procesados los pares de zapatos de este ítem
									}
								}
								// Recorrer los items comprados de menor a mayor precio
								for(pos = shoppingCartData.CartItem.length - 1, foundLast = false; pos >= 0  & !foundLast; pos -= 1) {
									// Verificar la cantidad de pares comprados del ítem
									if(parseInt(shoppingCartData.CartItem[pos].quantity) >= 1) {
										// Hay uno o más de un par de zapatos de este ítem
										foundLast = true;
										priceWithDiscount = 0;
										/**
										 * Verificar que tipo de descuento es y aplicarlo
										 */
										// Pague uno lleve 2
										if (couponInfo.CouponBatch.coupon_type_id == 1) {
											subTotal += 0;
										}
										// Pague el 2do a X% de descuento
										else if (couponInfo.CouponBatch.coupon_type_id == 2) {
											// Encontrar el valor de descuento y asignar subTotal
											itemPrice = parseInt(shoppingCartData.CartItem[pos].price);
											discount = couponInfo.CouponBatch.discount;
											priceWithDiscount = itemPrice * discount
											subTotal += priceWithDiscount;
											shoppingCartData.CartItem[pos].displayPrice += priceWithDiscount;
										}
										shoppingCartData.CartItem[pos].quantity -= 1;
									} else {
										// Ya fueron procesados los pares de zapatos de este ítem
									}
								}
								pairs -= 1;
							} while(pairs > 0);
							// Procesar los pares restantes
							$.each(shoppingCartData.CartItem, function(i, item) {
								if(item.quantity > 0) {
									item.displayPrice += parseInt(item.quantity) * parseInt(item.price);
									subTotal += parseInt(item.quantity) * parseInt(item.price);
								}
							});
						}

						$.each(shoppingCartData.CartItem, function(i, item) {
							priceBeforeCoupon = parseInt(priceFormat($('#CartItem-' + item.id + 'Total').text()));
							priceAfterCoupon = parseInt(item.displayPrice);

							if(priceBeforeCoupon > priceAfterCoupon) {
								$('#CartItem-' + item.id + 'Total').css('text-decoration', 'line-through');
								$('#CartItem-' + item.id + 'Discount').text(numberFormat(priceAfterCoupon));
							}
						});
						if(parseInt(subTotal) > 0 && parseInt($('#TotalCarrito').attr('rel')) > parseInt(subTotal)) {
							if($('#CostoDeEnvio')) {
								subTotal += parseInt(priceFormat($('#CostoDeEnvio').text()));
							}
							$('#CouponDiscount').text(numberFormat(subTotal));
							$('#TotalCarrito').css('text-decoration', 'line-through');
						} else {
							$('#CouponDiscount').text('');
							$('#TotalCarrito').css('text-decoration', '');
						}
					});

				} else {
					// Indicar error en el código del cupon y limpiar campos
					alert('El código de cupon ' + couponCode + ' no parece ser válido. Por favor, intente de nuevo.');
					$('#CouponCode').val('');
					$('#OrderCouponCode').val('');
					$.each($('.cart-item'), function(i, val) {
						$('#CartItem-' + $(val).attr('rel') + 'Total').css('text-decoration', '');
						$('#CartItem-' + $(val).attr('rel') + 'Discount').text('');
					});
					$('#TotalCarrito').css('text-decoration', '');
					$('#CouponDiscount').text('');
				}
			});
		}
	}

	function getDiscountXPercentOfTotal(itemID, discountPercentage) {
		var quantity = $('#CartItem-' + itemID + 'Quantity').val();
		var price = $('#CartItem-' + itemID + 'Price').attr('rel');
		var discount = price - (price * discountPercentage);
		$('#CartItem-' + itemID + 'Total').css('text-decoration', 'line-through');
		var itemTotal = (price * quantity) - (discount * quantity);
		$('#CartItem-' + itemID + 'Discount').text(numberFormat(itemTotal));
		return itemTotal;
	}

	function numberFormat(str) {
		var amount = new String(str);
		amount = amount.split("").reverse();
		var output = "";
		for (var i = 0; i <= amount.length - 1; i++) {
			output = amount[i] + output;
			if ((i + 1) % 3 == 0 && (amount.length - 1) !== i)
				output = '.' + output;
		}
		return '$ ' + output;
	}

	function priceFormat(str) {
		var amount = new String(str);
		amount = amount.split("").reverse();
		var output = "";
		for (var i = 0; i <= amount.length - 1; i++) {
			if(amount[i] != '$' & amount[i] != '.') {
				output = amount[i] + output;
			}
		}
		return output;
	}
});

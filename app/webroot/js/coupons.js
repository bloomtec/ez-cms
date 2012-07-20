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
		var couponCode = $('#CouponCode').val();
		verifyCoupon(couponCode);
	});
	
	/**
	 * Obtener la información de un cupon especifico
	 */
	function verifyCoupon(couponCode) {
		if(couponCode) {
			var couponInfo = null;
			BJS.get('/coupon_batches/getCouponInfo/' + couponCode, {}, function(data) {
				couponInfo = $.parseJSON(data);
				if(couponInfo) {
					// Asignar el cupon al formulario
					$('#OrderCouponCode').val(couponCode);
					var subTotal = 0;
					$.each($('.cart-item'), function(i, val) {
						// Pague uno lleve 2
						if (couponInfo.CouponBatch.coupon_type_id == 1) {
							subTotal += getDiscountBuyOneGetOne($(val).attr('rel'));
						}
						// Pague el 2do a X% de descuento
						else if (couponInfo.CouponBatch.coupon_type_id == 2) {
							subTotal += getDiscount2ndXPercent($(val).attr('rel'), couponInfo.CouponBatch.discount);
						}
						// X% de descuento en la compra
						else if (couponInfo.CouponBatch.coupon_type_id == 3) {							
							subTotal += getDiscountXPercentOfTotal($(val).attr('rel'), couponInfo.CouponBatch.discount);
						}
					});
					if(parseInt(subTotal) > 0 && parseInt($('#TotalCarrito').attr('rel')) > parseInt(subTotal)) {
						$('#CouponDiscount').text(numberFormat(subTotal));
						$('#TotalCarrito').css('text-decoration', 'line-through');
					} else {
						$('#CouponDiscount').text('');
						$('#TotalCarrito').css('text-decoration', '');
					}
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
	
	function getDiscountBuyOneGetOne(itemID) {
		var quantity = $('#CartItem-' + itemID + 'Quantity').val();
		var price = $('#CartItem-' + itemID + 'Price').attr('rel');
		var pairs = parseInt(quantity / 2);
		if (pairs >= 1) {
			var discount = price * pairs; //console.log(discount);
			$('#CartItem-' + itemID + 'Total').css('text-decoration', 'line-through');
			var itemTotal = (price * quantity) - discount;
			$('#CartItem-' + itemID + 'Discount').text(numberFormat(itemTotal));
			return itemTotal;
		} else {
			// No hay 2do par
			return 0;
		}
	}

	function getDiscount2ndXPercent(itemID, discountPercentage) {
		var quantity = $('#CartItem-' + itemID + 'Quantity').val();
		var price = $('#CartItem-' + itemID + 'Price').attr('rel');
		var pairs = parseInt(quantity / 2);
		if (pairs >= 1) {
			var discount = price - (price * discountPercentage);
			$('#CartItem-' + itemID + 'Total').css('text-decoration', 'line-through');
			var itemTotal = (price * quantity) - (discount * pairs);
			$('#CartItem-' + itemID + 'Discount').text(numberFormat(itemTotal));
			return itemTotal;
		} else {
			// No hay 2do par
			return 0;
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

});

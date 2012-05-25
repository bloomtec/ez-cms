$(function() {

	$.tools.validator.fn(
			"[data-equals]",
			{
				en : 'Value mismatch with corresponding field',
				es : 'El valor difiere al del campo correspondiente'	
			},
			function(el, value) {
		var compare = $('[name="' + el.attr('data-equals') + '"]').val();
		return compare == value ? true : false;
	});

	$.tools.validator.localize("es", {
		'*' : 'Corrija el valor en este campo',
		':email' : 'Ingrese un correo electrónico válido',
		':number' : 'Ingrese un valor numérico',
		':radio' : 'Seleccione una opción',
		':url' : 'Ingrese una URL válida',
		'[max]' : 'Ingrese un valor no mayor a $1',
		'[min]' : 'Ingrese un valor mayor o igual a $1',
		'[required]' : 'Este campo es requerido'
	});

});

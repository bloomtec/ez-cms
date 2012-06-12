$(document).ready(function() {
	
	var path = "/img/uploads";

	$('#single-upload').uploadify({
		'uploader' : '/swf/uploadify.swf',
		'script' : '/uploadify.php',
		'folder' : path,
		'buttonImg' : '/img/subir-imagenes.png',
		'width' : 147,
		'height' : 37,
		'auto' : true,
		'cancelImg' : '/img/uploadify-cancel.png',
		'onComplete' : function(a, b, c, d) {
			var name = c.name;
			$(".preview").html('<img  src="' + d + '" />');
			var file = d.split("/");
			var nombre = file[(file.length - 1)];
			$("#single-field").val(nombre);
			$.post("/products/uploadify_add", {
				'name' : nombre,
				'folder' : path
			}, function(data) {

			});
		}
	});

}); 
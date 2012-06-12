$(document).ready(function() {
	
	var server = "";
	var path = "img/uploads";

	$('#single-upload').uploadify({
		'uploader' : server + 'swf/uploadify.swf',
		'script' : server + 'uploadify.php',
		'folder' : server + path,
		'buttonImg' : server + 'img/subir-imagenes.png',
		'width' : 147,
		'height' : 37,
		'auto' : true,
		'cancelImg' : server + 'img/uploadify-cancel.png',
		'onComplete' : function(a, b, c, d) {
			var name = c.name;
			$(".preview").html('<img  src="' + d + '" />');
			var file = d.split("/");
			var nombre = file[(file.length - 1)];
			$("#single-field").val(nombre);
			$.post("/products/uploadify_add", {
				'name' : nombre,
				'folder' : server + path
			}, function(data) {

			});
		}
	});

}); 
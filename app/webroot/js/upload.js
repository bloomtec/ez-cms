$(document).ready(function() {

	$('#single-upload').uploadify({
		'swf' : '/swf/uploadify.swf',
		'uploader' : '/uploadify.php',
		'buttonText' : 'Subir Imagen',
		'width' : 147,
		'height' : 37,
		'cancelImg' : '/img/uploadify-cancel.png',
		//'debug' : true,
		'onUploadSuccess' : function(file, data, response) {
			alert(data);
			/*if(response) {
				var name = file.name;
				$(".preview").html('<img  src="' + data + '" />');
				var fileName = data.split("/");
				fileName = fileName[(fileName.length - 1)];
				$("#single-field").val(fileName);
				$.post("/products/uploadify_add", {
					'name' : fileName,
					'folder' : 'uploads'
				}, function(data) {
					//console.log(data);
				});
			}*/
		}
	});

});

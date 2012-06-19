$(document).ready(function() {

	$('#single-upload-category').uploadify({
		'swf' : '/swf/uploadify.swf',
		'checkExisting' : '/check-exists.php',
		'uploader' : '/uploadify.php',
		'buttonText' : 'Subir Imagen',
		'width' : 147,
		'height' : 37,
		'cancelImg' : '/img/uploadify-cancel.png',
		'multi' : false,
		//'debug' : true,
		'onUploadSuccess' : function(file, data, response) {
			if(response) {
				var name = file.name;
				$(".preview").html('<img  src="' + data + '" />');
				var fileName = data.split("/");
				fileName = fileName[(fileName.length - 1)];
				$("#single-field").val(fileName);
				$.post("/categories/uploadify_add", {
					'name' : fileName,
					'folder' : 'uploads'
				}, function(data) {
					//console.log(data);
				});
			}
		}
	});

	$('#single-upload-product').uploadify({
		'swf' : '/swf/uploadify.swf',
		'checkExisting' : '/check-exists.php',
		'uploader' : '/uploadify.php',
		'buttonText' : 'Subir Imagen',
		'width' : 147,
		'height' : 37,
		'cancelImg' : '/img/uploadify-cancel.png',
		'multi' : false,
		//'debug' : true,
		'onUploadSuccess' : function(file, data, response) {
			if(response) {
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
			}
		}
	});

	$('#single-upload-gallery').uploadify({
		'swf' : '/swf/uploadify.swf',
		'checkExisting' : '/check-exists.php',
		'uploader' : '/uploadify.php',
		'buttonText' : 'Subir Imagen',
		'width' : 147,
		'height' : 37,
		'cancelImg' : '/img/uploadify-cancel.png',
		'multi' : false,
		//'debug' : true,
		'onUploadSuccess' : function(file, data, response) {
			if(response) {
				var name = file.name;
				$(".preview").html('<img  src="' + data + '" />');
				var fileName = data.split("/");
				fileName = fileName[(fileName.length - 1)];
				$("#single-field").val(fileName);
				$.post("/galleries/uploadify_add", {
					'name' : fileName,
					'folder' : 'uploads'
				}, function(data) {
					//console.log(data);
				});
			}
		}
	});

	$('#multiple-upload-gallery').uploadify({
		'swf' : '/swf/uploadify.swf',
		'checkExisting' : '/check-exists.php',
		'uploader' : '/uploadify.php',
		'buttonText' : 'Subir Imagenes',
		'width' : 147,
		'height' : 37,
		'cancelImg' : '/img/uploadify-cancel.png',
		//'debug' : true,
		'onUploadSuccess' : function(file, data, response) {
			if(response) {
				var name = file.name;
				var fileName = data.split("/");
				fileName = fileName[(fileName.length - 1)];
				$.post("/images/uploadify_add", {
					'name' : fileName,
					'folder' : 'uploads',
					'gallery_id' : $('#gallery_id').attr('rel')
				}, function(data) {
					//console.log(data);
				});
			}
		},
		'onQueueComplete' : function(queueData) {
			var location = '/admin/galleries/view/' + $('#gallery_id').attr('rel');
			window.location.replace(location);
		}
	});

	$.each($('.gallery-single-upload'), function(i, val) {
		$('#single-upload-gallery-' + val.id).uploadify({
			'swf' : '/swf/uploadify.swf',
			'checkExisting' : '/check-exists.php',
			'uploader' : '/uploadify.php',
			'buttonText' : 'Subir Imagen',
			'width' : 147,
			'height' : 37,
			'cancelImg' : '/img/uploadify-cancel.png',
			'multi' : false,
			//'debug' : true,
			'onUploadSuccess' : function(file, data, response) {
				if(response) {
					var name = file.name;
					$('#preview-' + val.id).html('<img width="150" height="150" src="' + data + '" />');
					var fileName = data.split("/");
					fileName = fileName[(fileName.length - 1)];
					$(val).val(fileName);
					$.post("/galleries/uploadify_add", {
						'name' : fileName,
						'folder' : 'uploads'
					}, function(data) {
						//console.log(data);
					});
				}
			}
		});
	});

});

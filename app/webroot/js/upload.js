$(document).ready(function() {
	
	/**
	 * Categoría
	 */
	$('#single-upload-category').uploadify({
		'swf' : '/swf/uploadify.swf',
		'checkExisting' : '/check-exists.php',
		'uploader' : '/uploadify.php',
		'buttonText' : 'Subir Imagen',
		'width' : 80,
		'height' : 20,
		'cancelImg' : '/img/uploadify-cancel.png',
		'multi' : false,
		//'debug' : true,
		'onUploadSuccess' : function(file, data, response) {
			if(response) {
				var name = file.name;
				$("#single-field").val(data);
				$.post("/categories/uploadify_add", {
					'name' : data,
					'folder' : 'uploads'
				}, function(confirm) {
					if(confirm){
						$(".preview").html('<img  src="/img/uploads/215x215/' + data + '" />');
					}				
				});
			}
		}
	});
	
	/**
	 * Categoría
	 */
	$('#single-upload-category-promoted').uploadify({
		'swf' : '/swf/uploadify.swf',
		'checkExisting' : '/check-exists.php',
		'uploader' : '/uploadify.php',
		'buttonText' : 'Subir Imagen',
		'width' : 80,
		'height' : 20,
		'cancelImg' : '/img/uploadify-cancel.png',
		'multi' : false,
		//'debug' : true,
		'onUploadSuccess' : function(file, data, response) {
			if(response) {
				var name = file.name;
				$("#single-field-promoted").val(data);
				$.post("/categories/uploadify_add", {
					'name' : data,
					'folder' : 'uploads'
				}, function(confirm) {
					if(confirm){
						$(".preview-promoted").html('<img  src="/img/uploads/215x215/' + data + '" />');
					}				
				});
			}
		}
	});
	
	/**
	 * Producto
	 */
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
				var fileName = data.split("/");
				fileName = fileName[(fileName.length - 1)];
				$("#single-field").val(fileName);
				$.post("/products/uploadify_add", {
					'name' : fileName,
					'folder' : 'uploads'
				}, function(confirm) {
					if(confirm) {
						$(".preview").html('<img  src="/img/uploads/215x215/' + data + '" />');
					}
				});
			}
		}
	});
	
	/**
	 * Imagen principal galería
	 */
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
				var fileName = data.split("/");
				fileName = fileName[(fileName.length - 1)];
				$("#single-field").val(fileName);
				$.post("/galleries/uploadify_add", {
					'name' : fileName,
					'folder' : 'uploads'
				}, function(confirm) {
					if(confirm) {
						$('#MainImg').remove();
						$(".main-img-preview").html('<img  src="/img/uploads/215x215/' + data + '" />');
					}
				});
			}
		}
	});
	
	/**
	 * Multiples imagenes galería
	 */
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
					'gallery_id' : $('#gallery_id').attr('rel'),
					'prod_color_code' : $('#prod_color_code').attr('rel'),
					'product_id' : $('#product_id').attr('rel')
				}, function(data) {
					data = $.parseJSON(data);
					if(data.success) {
						var htmlData =
						'<tr><td>' 
						+ data.image_id 
						+ '</td><td><img src="/img/uploads/50x50/' 
						+ fileName 
						+ '"></td><td><form method="post" style="display:none;" id="post_UploadedID'
						+ data.image_id
						+ '" name="post_UploadedID' + data.image_id + '" action="/admin/images/delete/' + data.image_id + '/' + data.prod_color_code + '/' + data.product_id + '">'
						+ '<input type="hidden" value="POST" name="_method"></form>'
						+ '<a onclick="if (confirm(\'¿Seguro desea eliminar la imagen #' + data.image_id + '?\')) { document.post_UploadedID' + data.image_id + '.submit(); } event.returnValue = false; return false;" href="#">Eliminar</a>'
						+ '</td></tr>';
						//console.log(htmlData);
						$('#RelatedImagesBody').append(htmlData);
					}
				});
			}
		}
		/*,
		'onQueueComplete' : function(queueData) {
			setTimeout(
				function() {
					var location = '/admin/galleries/edit/' + $('#prod_color_code').attr('rel') + '/' + $('#product_id').attr('rel');
					window.location.replace(location);
				},
				2000
			);
		}*/
	});
	
	/**
	 * Wizard
	 */
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
					var fileName = data.split("/");
					fileName = fileName[(fileName.length - 1)];
					$(val).val(fileName);
					$.post("/galleries/uploadify_add", {
						'name' : fileName,
						'folder' : 'uploads'
					}, function(success) {
						if(success) {
							$('#preview-' + val.id).html('<img src="/img/uploads/215x215/' + data + '" />');
						}
					});
				}
			}
		});
	});

});

$(document).ready(function() {
	var server = '/'
	var path = "uploads";

	$('#upload').uploadify({
		'uploader' : server + 'swf/uploadify.swf',
		'script' : server + 'uploadify.php',
		'folder' : server + 'app/webroot/' + path,
		'auto' : true,
		'buttonImg' : server + 'app/webroot/img/subir-imagenes.png',
		'width' : 147,
		'height' : 37,
		'cancelImg' : server + 'img/cancel.png',
		'onComplete' : function(a, b, c, d) {
			/*var name=c.name;
			 $(".selectImagePath").append('<option value="productos/'+name+'" selected="selected">'+name+'</option>');
			 $(".product_image").html('<img width="300px" src="'+server+'img/productos/'+name+'" />');
			 */
		}
	});

	$('#single-upload').uploadify({
		'uploader' : server + 'swf/uploadify.swf',
		'script' : server + 'uploadify.php',
		'folder' : server + 'app/webroot/img/' + path,
		'buttonImg' : server + 'app/webroot/img/subir-imagenes.png',
		'width' : 147,
		'height' : 37,
		'auto' : true,
		'cancelImg' : server + 'img/cancel.png',
		'onComplete' : function(a, b, c, d) {
			var name = c.name;
			$(".preview").html('<img  src="' + d + '" />');
			var file = d.split("/");
			var nombre = file[(file.length - 1)];
			$("#single-field").val(nombre);
			$.post(server + "images/uploadfy_add", {
				'name' : nombre,
				'folder' : path
			}, function(data) {

			});
		}
	});

	$('#multiple-upload').uploadify({
		'uploader' : server + 'swf/uploadify.swf',
		'script' : server + 'uploadify.php',
		'buttonImg' : server + 'app/webroot/img/subir-imagenes.png',
		'width' : 147,
		'height' : 37,
		'cancelImg' : server + 'app/webroot/img',
		'folder' : server + 'app/webroot/img/' + path,
		'multi' : true,
		'auto' : true,
		'fileExt' : '*.jpg;*.gif;*.png;*.PNG;*.JPG;*.GIF',
		'fileDesc' : 'Image Files (.JPG, .GIF, .PNG)',
		'queueID' : 'custom-queue',
		'queueSizeLimit' : 10,
		'simUploadLimit' : 10,
		'removeCompleted' : false,
		'onSelectOnce' : function(event, data) {
			$('#status-message').text(data.filesSelected + ' files have been added to the queue.');
		},
		'onComplete' : function(a, b, c, d) {
			var name = c.name;
			$(".preview").html('<img  src="' + d + '" />');
			var file = d.split("/");
			var nombre = file[(file.length - 1)];
			var galeriaId = $("li.selected").attr('id');
			$("#single-field").val(nombre);
			$.post(server + "images/uploadfy_add", {
				'name' : nombre,
				'folder' : path,
				'galeriaId' : galeriaId
			}, function(data) {
				if(data) {
					$(".foticos ul").append("<li rel='" + data + "'> <img src='/priceshoes/img/" + path + "/200x200/" + nombre + "'></img> <div class='borrar pointer'> borrar </div> <a class='modificar' target='_blank' href='/priceshoes/admin/images/edit/'>Modificar</a> </li>");
				}
			});

		},
		'onAllComplete' : function(event, data) {
			$('#status-message').text(data.filesUploaded + ' files uploaded, ' + data.errors + ' errors.');
		}
	});

	$('ul.galeria li').click(function() {
		$('ul.galeria li').removeClass('selected');
		$(this).addClass("selected");
	});

}); 
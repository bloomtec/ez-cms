$(function() {// CONFIGURACIONES JQUERYS PLUGINS

	$('textarea.editor').ckeditor(function() {

	}, {
		filebrowserUploadUrl : '/wysiwyg/upload.php',
		filebrowserBrowseUrl : '/admin/ez/options/fileBrowser',
		height : 350
	});
	
	$('textarea.editor2').ckeditor(function() {

	}, {
		filebrowserUploadUrl : '/wysiwyg/upload.php',
		filebrowserBrowseUrl : '/admin/ez/options/fileBrowser'//,
		//toolbar : 'Dialog',
		//extraPlugins : 'cakeElements',
	});
	/*if($('textarea.editor2').length){
		var editor = $('textarea.editor2').ckeditorGet();		
		editor.on('pluginsLoaded', function(ev) {
			// If our custom dialog has not been registered, do that now.
			if(!CKEDITOR.dialog.exists('cakeElements')) {
				// We need to do the following trick to find out the dialog
				// definition file URL path. In the real world, you would simply
				// point to an absolute path directly, like "/mydir/mydialog.js".
				var href = '/ez/js/cakeElements/plugin.js';
				// Finally, register the dialog.
				CKEDITOR.dialog.add('cakeElements', href);
			}

			// Register the command used to open the dialog.
			editor.addCommand('cakeElementsDialog', new CKEDITOR.dialogCommand('cakeElementsDialog'));

			// Add the a custom toolbar buttons, which fires the above
			// command..
			editor.ui.addButton( 'cakeElements',
			{
				label: 'Elementos',
				command: 'cakeElementsDialog',
				icon: '/img/b_zoom_in_ac.png'
			});
		});
	}*/
	
});
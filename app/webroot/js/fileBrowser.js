$(function(){
		var wysiwyg=function(){
		$("#fileBrowser .container .seleccionar").live("click",function(){
		function getUrlParam(paramName)
		{
		  var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
		  var match = window.location.search.match(reParam) ;
		 
		  return (match && match.length > 1) ? match[1] : '' ;
		}
		var funcNum = getUrlParam('CKEditorFuncNum');
		var fileUrl =$(this).attr("rel");
		window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl);
		window.close();
		});
		$(".delete").click(function(){
			var source=this;
			$.post("/admin/images/deleteWysiwygImage",{path:$(this).attr("rel")},function(borrada){
				if(borrada){
					$(source).parents('li').remove();
				}
			})
		});
	}();
});

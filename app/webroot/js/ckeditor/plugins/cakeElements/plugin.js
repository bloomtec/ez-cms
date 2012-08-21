CKEDITOR.plugins.add('cakeElements',
{
	init: function( editor )
	{
		// Plugin logic goes here...
	},
	
});
CKEDITOR.dialog.add( 'cakeElementsDialog', function( editor )
{
	return {
		title : 'Elemento a adjuntar',
		minWidth : 400,
		minHeight : 200,
		contents :
		[
			{
				id : 'general',
				label : 'Settings',
				elements :
				[
				 	// UI elements of the Settings tab.
				 	{
				 		type:'html',
				 		html: 'Puedes agregar hasta 3 elementos predefinidos a tu pagina:'
				 	},
				 	{
				 		type: 'select',
				 		id: 'element1',
				 		label: 'Elemento 1',
				 		items:
				 		[
				 			['Sondeos','survey'],
				 			['producto mas vendido','mas-vendidos'],
				 			['novedades','novedad'],
				 		]	

				 	},
				 	{
				 		type: 'select',
				 		id: 'element2',
				 		label: 'Elemento 2',
				 		items:
				 		[
				 			['Sondeos','survey'],
				 			['producto mas vendido','mas-vendidos'],
				 			['novedades','novedad'],
				 		]	

				 	},
				 	{
				 		type: 'select',
				 		id: 'element3',
				 		label: 'Elemento 3',
				 		items:
				 		[
				 			['Sondeos','survey'],
				 			['producto mas vendido','mas-vendidos'],
				 			['novedades','novedad'],
				 		]	

				 	},
				]
			}
		]
	};
});
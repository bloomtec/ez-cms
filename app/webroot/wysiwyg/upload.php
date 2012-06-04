<?php
/*
 Uploadify v2.1.4
 Release Date: November 8, 2010

 Copyright (c) 2010 Ronnie Garcia, Travis Nickels

 Permission is hereby granted, free of charge, to any person obtaining a copy
 of this software and associated documentation files (the "Software"), to deal
 in the Software without restriction, including without limitation the rights
 to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 copies of the Software, and to permit persons to whom the Software is
 furnished to do so, subject to the following conditions:

 The above copyright notice and this permission notice shall be included in
 all copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 THE SOFTWARE.
 */
if (!empty($_FILES)) {
	$tempFile = $_FILES['upload']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . "/app/webroot/wysiwyg" . '/';
	$fileParts = pathinfo($_FILES['upload']['name']);
	$targetFile =  str_replace('//','/',$targetPath) . $_FILES['upload']['name'];
	if (!file_exists($targetFile)) {
		// El archivo no existe
		//
		move_uploaded_file($tempFile, $targetFile);
		echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $targetFile);
	} else {
		// El archivo existe
		//

		// Partir el nombre en partes
		//
		$doc_name_parts = explode('.', $_FILES['upload']['name']);

		// Sacar la extension del documento
		//
		$doc_ext = strtolower($doc_name_parts[sizeof($doc_name_parts) - 1]);

		// Quitar la extension del nombre del documento
		//
		unset($doc_name_parts[sizeof($doc_name_parts) - 1]);

		// Dejar el nombre del documento completo de nuevo
		//
		$doc_name = implode('.', $doc_name_parts);

		// Crear un nombre que no exista ya entre los documentos
		//
		for ($i = 1; true; $i++) {
			$tmp_name = $doc_name . ' (' . $i . ').' . $doc_ext;

			$targetFile = str_replace('//', '/', $targetPath) . $tmp_name;

			if (file_exists($targetFile)) {
				// Existe un documento con el nombre nuevo, seguir creando.
				//
			} else {
				// No existe un documento con el nuevo nombre, crearlo.
				//
				move_uploaded_file($tempFile, $targetFile);
				echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $targetFile);
				break;
			}
		}

	}


	// $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
	// $fileTypes  = str_replace(';','|',$fileTypes);
	// $typesArray = split('\|',$fileTypes);
	// $fileParts  = pathinfo($_FILES['Filedata']['name']);

	// if (in_array($fileParts['extension'],$typesArray)) {
	// Uncomment the following line if you want to make the directory if it doesn't exist
	// mkdir(str_replace('//','/',$targetPath), 0755, true);

	
	// } else {
	// 	echo 'Invalid file type.';
	// }
}
?>
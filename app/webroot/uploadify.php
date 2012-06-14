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
 *//*
 if (!empty($_FILES)) {
 $tempFile = $_FILES['Filedata']['tmp_name'];
 //$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
 $targetPath = IMAGES . $_REQUEST['folder'] . '/';
 $fileParts = pathinfo($_FILES['Filedata']['name']);
 $fechaActual = gmdate('His', time() + $gmt);
 $time = explode(' ', microtime());
 list($totalSeconds, $extraMilliseconds) = array($time[1], (int)round($time[0] * 1000, 3));
 $stringFinal = rand(100, 1000) . $fechaActual . $totalSeconds . $extraMilliseconds . rand(0, 1000);
 $targetFile = str_replace('//', '/', $targetPath) . $stringFinal . "." . $fileParts['extension'];

 // $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
 // $fileTypes  = str_replace(';','|',$fileTypes);
 // $typesArray = split('\|',$fileTypes);
 // $fileParts  = pathinfo($_FILES['Filedata']['name']);

 // if (in_array($fileParts['extension'],$typesArray)) {
 // Uncomment the following line if you want to make the directory if it doesn't exist
 // mkdir(str_replace('//','/',$targetPath), 0755, true);

 move_uploaded_file($tempFile, $targetFile);
 echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $targetFile);
 // } else {
 // 	echo 'Invalid file type.';
 // }
 } */
?>
<?php
/*
 Uploadify
 Copyright (c) 2012 Reactive Apps, Ronnie Garcia
 Released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
 */

// Define a destination
$targetFolder = '/app/webroot/img/uploads';
// Relative to the root

if (!empty($_FILES)) {
	$fileData = $_FILES['Filedata'];
	$tempFile = $fileData['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile = rtrim($targetPath, '/') . '/' . $fileData['name'];

	// Validate the file type
	$fileTypes = array('jpg', 'jpeg', 'gif', 'png');
	// File extensions
	$fileParts = pathinfo($fileData['name']);

	if (in_array($fileParts['extension'], $fileTypes)) {
		if (move_uploaded_file($tempFile, $targetFile)) {
			echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $targetFile);
		} else {
			echo '
			:: Error ::
			Info inicial
			Archivo temporal: ' . $tempFile . '
			Archivo destino: ' . $targetFile . '
			No se pudo guardar el archivo.
			
			Info adicional
			' . print_r($fileData, true);
		}

		//echo '1';
	} else {
		echo
		':: Error ::
		Tipo de archivo no valido.';
	}
}
?>
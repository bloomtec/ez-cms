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
	
	// Sección para crear nombre de archivo único
	$fileParts  = pathinfo($_FILES['Filedata']['name']);
	$fechaActual = gmdate('His', time());
	$time = explode(' ',microtime());
    list($totalSeconds, $extraMilliseconds) = array($time[1], (int)round($time[0]*1000,3));
    $stringFinal = rand(100, 1000).$fechaActual . $totalSeconds . $extraMilliseconds.rand(0, 1000);
	
	//$targetFile = rtrim($targetPath, '/') . '/' . $fileData['name']; // Asignación original
	// Asignar destino con el nombre de archivo único
	$targetFile = rtrim($targetPath, '/') . '/' . $stringFinal . '.' . $fileParts['extension'];

	// Validate the file type
	$fileTypes = array('jpg', 'jpeg', 'gif', 'png');
	// File extensions
	$fileParts = pathinfo($fileData['name']);

	if (in_array($fileParts['extension'], $fileTypes)) {
		if (move_uploaded_file($tempFile, $targetFile)) {
			time_nanosleep(0, 5000000);
			echo $stringFinal . '.' . $fileParts['extension'];
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
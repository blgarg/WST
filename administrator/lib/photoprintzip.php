<?php
//include("dbcon.php");
session_start();
include ("../../settings.php");

global $config_var;

global $DataSet;

global $model;

$config_var = new config(); // would be global settings


//$config_var = new config();
//$Session = new session();
	
	
// HTTP headers for no cache etc
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
	
// Settings
//$targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
//$targetDir = $_SERVER['DOCUMENT_ROOT'].'/plupload/examples/uploads';
	
$targetDir = $config_var->UPLOAD_ROOT.'images/zip/zipfiles/';
	
$cleanupTargetDir = true; // Remove old files
$maxFileAge = 5 * 3600; // Temp file age in seconds
	
// 5 minutes execution time
@set_time_limit(5 * 60);
	
// Uncomment this one to fake upload time
// usleep(5000);

	
// Get parameters
$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
$fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';
$numfiles = isset($_REQUEST["numfile"]) ? $_REQUEST["numfile"] : '';


	
// Clean the fileName for security reasons
$fileName = preg_replace('/[^\w\._]+/', '_', $fileName);
	
// Make sure the fileName is unique but only if chunking is disabled
if ($chunks < 2 && file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName)) {
	$ext = strrpos($fileName, '.');
	$fileName_a = substr($fileName, 0, $ext);
	$fileName_b = substr($fileName, $ext);
		
	$count = 1;
	while (file_exists($targetDir . DIRECTORY_SEPARATOR . $fileName_a . '_' . $count . $fileName_b))
		$count++;
		
	$fileName = $fileName_a . '_' . $count . $fileName_b;
}
	
$filePath = $targetDir ."". $fileName;

// Create target dir
if (!file_exists($targetDir))
	@mkdir($targetDir);
	
// Remove old temp files
if ($cleanupTargetDir && is_dir($targetDir) && ($dir = opendir($targetDir))) {
	while (($file = readdir($dir)) !== false) {
		$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
			
		// Remove temp file if it is older than the max age and is not the current file
		if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge) && ($tmpfilePath != "{$filePath}.part")) {
			@unlink($tmpfilePath);
		}
	}
		
	closedir($dir);
} else
	die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
	
	
// Look for the content type header
if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
	$contentType = $_SERVER["HTTP_CONTENT_TYPE"];
	
if (isset($_SERVER["CONTENT_TYPE"]))
	$contentType = $_SERVER["CONTENT_TYPE"];
	
// Handle non multipart uploads older WebKit versions didn't support multipart in HTML5
if (strpos($contentType, "multipart") !== false) {
	if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
		// Open temp file
		$out = fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
		if ($out) {
			// Read binary input stream and append it to temp file
			$in = fopen($_FILES['file']['tmp_name'], "rb");
				
			if ($in) {
				while ($buff = fread($in, 4096))
					fwrite($out, $buff);
			} else
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			fclose($in);
			fclose($out);
			@unlink($_FILES['file']['tmp_name']);
		} else
			die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
	} else
		die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
} else {
	// Open temp file
	$out = fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
	if ($out) {
		// Read binary input stream and append it to temp file
		$in = fopen("php://input", "rb");
			
		if ($in) {
			while ($buff = fread($in, 4096))
				fwrite($out, $buff);
		} else
			die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			
		fclose($in);
		fclose($out);
	} else
		die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
}
	
// Check if file has been uploaded
if (!$chunks || $chunk == $chunks - 1) {
	// Strip the temp .part suffix off
	rename("{$filePath}.part", $filePath);
}
	
	
// Return JSON-RPC response
//	die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
	
			


$randomCode = rand(5,100);
	
$filename = $randomCode.'_'.@$_FILES["onlyzip"]["name"];
$filename = str_replace(" ","-",$filename);
$numfiles = $_REQUEST['filenum'];
	
	
$source = $_FILES["onlyzip"]["tmp_name"];
$type = $_FILES["onlyzip"]["type"];
//	$target_path = @$_SERVER[DOCUMENT_ROOT]."/extractzip/zipfile/".$filename;

$target_path = $config_var->UPLOAD_ROOT.'images/zip/zipfiles'.$filename;
	
if(move_uploaded_file($source, $target_path))
{
	echo '{"jsonrpc" : "2.0", "Message" : {"Files uploaded successfully"}}';
}
	


	
$ua = $_SERVER["HTTP_USER_AGENT"];
$linux = strpos($ua, 'Linux');
$windows = strpos($ua, 'Windows');

	
$target_path=$filePath;
	
$countfiles = 0;
$zip = new ZipArchive;
if ( $zip->open($target_path) === true ) {

	$countfiles = $zip->numFiles;


	$realdirName = @current(explode(".",$fileName));
			$zip->extractTo($config_var->UPLOAD_ROOT.'images/zip/Zipfiles/'.$_SESSION['gallery_id']);
	
      
	$_SESSION['extracteddir'] = $realdirName;
	
	/*
	if($linux > 0){
		$_SESSION['extracteddir'] = $newfolderName;
	}
	if($windows > 0){
		$_SESSION['extracteddir'] = $realdirName;
	}
  */
	 
	 $_SESSION['countfiles'] = $countfiles;
	
		
	//	$delfolder = @$_SERVER[DOCUMENT_ROOT]."/extractzip/".$foldername;
	$delfolder = $config_var->UPLOAD_ROOT.'images/zip/Zipfiles/'.$foldername;
		
	//rename("./$foldername", "./$changedname"); // no error
	//chmod("./$changedname", 0777);  // octal correct value of mode
		
	$zip->close();
	//echo "<font style='margin-left: 500px;' color='green'>Files have been Uploaded Sucessfully</font><br>";
	unlink($target_path);
	// @header('location:./displayimg.php');
	$_SESSION['succ']="Images for the gallery has been uploaded";
	echo "2";
	//	@header('Location:index.php?mod=mod_photoprinting&view=listing');
	exit();
}
else{
	$zip->close();
	unlink($target_path);
	echo "4";
	//	header("Location:index.php?mod=mod_photoprinting&view=default&r=4");
	exit();

	//echo "<font style='margin-left: 500px;' color='red'>Not Zip file</font>";
	//exit();
}


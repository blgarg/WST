<?php
$file = 'uploads/videos/flv_videos/'.$_POST['flvDownload_video'];
$file_name = $_POST['flvVideo_name'];
$withoutExt = pathinfo($file_name, PATHINFO_FILENAME);
$mpVideoName = $withoutExt.'.mp4';
$size = filesize($file); 
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
header("Content-Type: application/force-download"); 
header("Content-Description: File Transfer"); 
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-Type: application/flv");
header('Content-Disposition: attachment; filename="'.$mpVideoName.'"');
header("Content-Length: ".$size);
readfile($file);
exit();
?>
<?php
$receivedFile = 'uploads/videos/'.$_POST['download_video'];
$new_flv= 'uploads/videos/'.$_POST['video_name'];

$file= exec('ffmpeg -i $receivedFile $new_flv.mp4');

echo $file_name = $_POST['video_name'];
$size = filesize($file); 
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
header("Content-Type: application/force-download"); 
header("Content-Description: File Transfer"); 
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header('Content-type: video/wmv');
header('Content-Disposition: attachment; filename="'.$file_name.'"');
header("Content-Length: ".$size);
readfile($file);
exit();
?>
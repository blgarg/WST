<?php
// this  is an module controller page
ob_start();
global $renderUrl;
global $DataSet;
$controller = new controller();
$controller->setTPL($renderUrl);
$controller->render();
?>
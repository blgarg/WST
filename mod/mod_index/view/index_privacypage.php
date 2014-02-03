<?php
global $config_var;

//print_r($config_var->UPLOAD_ROOT); die;
/*if(!isset($_REQUEST['form']) || $_REQUEST['form'] ==''){
	header("Location: /wst/");
}else{
$_SESSION['views']=$_REQUEST['form']; 
}*/
$model_index_privacypage = new model_index_privacypage();
 
 $privacypage_data = $model_index_privacypage ->getPrivacyPage();
//echo "<pre>"; print_r($privacypage_data); die;
?>

    <!--ConTent-->

<div class="inner-hdr">
        	<img src="<?php echo $config_var->WEB_TPL_URL;?>images/privacy-txt.png" alt="" />
        </div>
        
        <!--Inner Text-->
        <div class="inner-txt">
        	<div class="gap-10"></div>
			
      <?php echo htmlspecialchars_decode($privacypage_data[1]['page_content']) ; ?>
           </div>
     <!--//ConTent-->
	

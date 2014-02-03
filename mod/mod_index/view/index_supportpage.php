<?php
global $config_var;
$model_index_supportpage = new model_index_supportpage();
$supportpage_data = $model_index_supportpage ->getSupportPage();
?>
     <!--ConTent-->
    <div class="content" style="padding-top:0;">
   		<div class="inner-hdr">
		Support
        	<!--<img src="<?php echo $config_var->WEB_TPL_URL;?>images/terms-conditions-txt.png" alt="" />-->
        </div>
        
        <!--Inner Text-->
        <div class="inner-txt">
        	<div class="gap-10"></div>
      <?php 
	        echo htmlspecialchars_decode($supportpage_data[5]['page_content']) ; ?>
         </div>
     <!--//ConTent-->
	
</div>
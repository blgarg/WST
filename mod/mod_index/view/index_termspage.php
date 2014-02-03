<?php
global $config_var;
$model_index_termspage = new model_index_termspage();
$termspage_data = $model_index_termspage ->getTermsPage();
?>
     <!--ConTent-->
    <div class="content" style="padding-top:0;">
   		<div class="inner-hdr">
        	<img src="<?php echo $config_var->WEB_TPL_URL;?>images/terms-conditions-txt.png" alt="" />
        </div>
        
        <!--Inner Text-->
        <div class="inner-txt">
        	<div class="gap-10"></div>
      <?php echo htmlspecialchars_decode($termspage_data[0]['page_content']) ; ?>
           </div>
     <!--//ConTent-->
	
</div>
<?php 
global $config_var;  
global $DataSet;
//config URL 
//$config_var->ADMIN_TPL_URL
	if((isset($_REQUEST['bannerId']))&&(@$_REQUEST['bannerId'] != '')){ 
	 $bannerId = (int)@$_REQUEST['bannerId']; 
	 $model_newsBanner_ViewBanner = new model_newsBanner_ViewBanner();
	 $Banners = $model_newsBanner_ViewBanner->getBannerData($_REQUEST);
								
}          
?>

<!--  start content-table-inner ...................................................................... START -->
	<div id="content-table-inner" class="Add_New_Web_Page">
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
    <td style="width:73%">
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form" >
            <tr>
                <th valign="top"  colspan="2">Title:</th>
            </tr>
            <tr>
            	 <td colspan="2"><?php echo @$Banners->bannerTitle;?></td>
            </tr>
            
            <tr>
                <th valign="top"  colspan="2">Description:</th>
            </tr>
            <tr>
            	 <td colspan="2"><?php echo wordwrap(@$Banners->bannerDesc,120,"<br />");?></td>
            </tr>
            
            <tr>
                <th valign="top"  colspan="2">Image:</th>
            </tr>
            <tr>
            	 <td colspan="2"><img  src="<?php echo $config_var->UPLOAD_URL."newsBanner/resizedImg/".$Banners->bannerId."_img.".$Banners->bannerImgSrc;?>"  border="0"/></td>
            </tr>
         
        </table>
      
	<!-- end id-form  -->

	</td>
	<td align="left">

	<!--  start related-activities -->
	<div id="related-activities">
		
		<!--  start related-act-top -->
		<div id="related-act-top">
		<a href="#"  id="Categories_top" style="cursor:text">Latest News Banner</a>
        </div>
		<!-- end related-act-top -->
		
		<!--  start related-act-bottom -->
		<div id="related-act-bottom">
		
			<!--  start related-act-inner -->
			<div id="related-act-inner" style="float:left">
			 		<?php 
						  $JDatabaseMySQL = new JDatabaseMySQL();
						  $JDatabaseMySQL->sql = "SELECT * FROM mgl_news_banner order by bannerId DESC limit 10";
						  $JDatabaseMySQL->query();
						  $latestBanners = $JDatabaseMySQL->loadAssoc();
						  ?>
					<ul>
                    <?php   $j = 0;
					        for($i=0;$i<count($latestBanners);$i++): $j++;?>
							<li><div id="checkbox"><?php echo @$j;?></div>
                            <div id="cat_name" class="breakword">
							<a href="./?mod=mod_newsBanner&view=ViewBanner&m=1&bannerId=<?php echo $latestBanners[$i]['bannerId'];?>">
							<?php if(strlen(@$latestBanners[$i]['bannerTitle']) >50){ echo ucfirst(substr(@$latestBanners[$i]['bannerTitle'],0,50))."...";}else{ echo @$latestBanners[$i]['bannerTitle'];}?>
                            </a>
                            </div>
                            </li> 
                        
                                           
					<?php endfor; ?>						                      
					</ul>
				</div>
				
			</div>
			<!-- end related-act-inner -->
			<div class="clear"></div>
		
		</div>
		
</td>
</tr>
<tr>
<td><img src="<?php echo $config_var->ADMIN_TPL_URL;?>/images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
<td></td>
</tr>
</table>

 
<div class="clear"></div>
 

</div>
		
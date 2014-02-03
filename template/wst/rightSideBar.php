<div class="right_con fr">              
               	<div class="free_viveo">                
                <?php  $aweberOb = new theme();
				echo $aweberOb->getAweber_form();
			  ?>
                </div>    
                
           <!--Read What These Top Fitness Experts Have To Say -->  
               <?php if(!isset($_REQUEST['userblog']) && (@$_REQUEST['userblog'] =='')){ ?>
                <div class="topExperts clear" style="margin-bottom:20px;">
               		 <p align="center">Read What These<br />
 <span class="skyblue">Top Fitness Experts</span> <br />
Have To Say</p>
                </div>
				<?php } ?>
                <?php $theme = new theme(); $sidebar = $theme->getSideBars();?>
                <?php
				if(isset($_REQUEST['userblog']) && (@$_REQUEST['userblog'] !='')){
				$userblogname = @$_REQUEST['userblog'];
				for($i=0;$i<count($sidebar);$i++){
				$col_id = $sidebar[$i]['column_id'];
				
				?>
                  <div class="experts" style="border:#B3E4F4 1px solid;height:25px;margin-bottom:0px !important;">
               		<div class="expert_name" style="height:auto !important;padding-top:0px;padding-bottom:0px;background:#1A588A">
                    	<h2 style="width:100%;text-align:center;height:auto;"><span style="color:#FFFFFF"><?php echo ucfirst($sidebar[$i]['column_block_name']); ?></span></h2><br />
						<br class="clear" />                       
					</div>
                    </div>
                    
                <div class="experts" style="padding:0px 3px 0px 3px;margin-top:0px;padding-top:0px;">
               		<p class="clear"> <?php if(strlen($sidebar[$i]['block_content']) !=''){ echo ucfirst(substr($sidebar[$i]['block_content'],0,100)); } ?> </p>
					<a href="<?php echo  $config_var->WEB_URL.'?userblog='.$userblogname.'&Rightcontent='.$col_id; ?>" class="clear readmore">Read More...
                    </a>  
                    <div class="clear"></div>
                </div>
                <?php }}else{ ?>
 				<div class="experts">
                <?php  $theme = new theme(); $topexpert_sidebar = $theme->HomePage_Topexpert();
				for($t=0;$t<count($topexpert_sidebar);$t++){
				$title = $topexpert_sidebar[$t]['page_title']; ?>
                <div style="border-bottom:#CCCCCC 1px dotted;margin-bottom:10px;padding-bottom:10px;">
               		<div class="expert_name">
                    <?php $image = $config_var->UPLOAD_URL.'user/original/'.$topexpert_sidebar[$t]['page_image'];
						  $noimage =  $config_var->WEB_URL.'images/no_image.jpg';  ?>
                    	<?php if($topexpert_sidebar[$t]['page_image'] != ''){ ?>
                        <?php /*?><img src="<?php echo  $config_var->WEB_URL;?>thumb.php?src=<?php echo $image; ?>&w=100&height=80&zc=1&rand=<?php echo rand();?>" alt="<?php echo $title;?>" class="fl"/ width="100" height="80"><?php */?> <?php } ?>
                        <h2 style="width:100%;float:left;line-height:20px;"><span><a href="<?php echo  $config_var->WEB_URL.'?topExpert='.$topexpert_sidebar[$t]['page_url']; ?>"><?php echo ucfirst(wordwrap($title,15,"\n", true)); ?></a></span></h2>
						<br class="clear" />                       
					</div>
                   <p class="clear">
				   <?php if(strlen($topexpert_sidebar[$t]['page_content']) >200){ echo wordwrap(ucfirst(substr($topexpert_sidebar[$t]['page_content'],0,200)),25,"\n", true); }else{ echo ucfirst($topexpert_sidebar[$t]['page_content']);}  ?> </p>
                   <?php if(strlen($topexpert_sidebar[$t]['page_content']) >200){?>
                    <p> <a href="<?php echo  $config_var->WEB_URL.'?topExpert='.$topexpert_sidebar[$t]['page_url']; ?>" class="clear readmore">Read More...</a> </p>
                     <?php } ?> 
                    <div class="clear"></div>
                 </div>   
                    <?php } ?>
                </div>
                                
                <?php } ?>
                <?php $theme = new theme(); $ItemcoverPage = $theme->coverPage();?>
                <?php
				
				for($CP=0;$CP<count($ItemcoverPage);$CP++){
				/*
				print_r($ItemcoverPage[$CP]);*/
				if($ItemcoverPage[$CP]['show'] !=0){
				
				//echo "<pre>"; print_r($coverPage['coverPage_content']);
				$coverPagecontent = unserialize($ItemcoverPage[$CP]['coverPage_content']);
				//echo "<pre>"; print_r($coverPagecontent);
				
				?>
                <br />
                
                <?php if($ItemcoverPage[$CP]['coverPage_id'] ==1){ ?>
                <div class="experts" style="height:25px;margin-bottom:0px !important;border-bottom:none">
                   	<h2 style="height:auto; padding-bottom:10px; ">
               		<p style=" text-align:center;margin-bottom: 10px; padding-bottom: 10px; padding-top:10px; color:#FFFFFF; background-color:#5AADCD;">
						<?php echo $ItemcoverPage[$CP]['coverPage_lines']; ?>
               			</p></h2> 
						                      
				
                    </div>
                    <?php } ?>
                    <br/>
                    <?php if($ItemcoverPage[$CP]['coverPage_id'] ==2){ ?>
                <!--<div class="experts" style="border:#B3E4F4 1px solid;height:25px;margin-bottom:0px !important;">
               		<div class="expert_name" style="height:auto !important;padding-top:0px;padding-bottom:0px;background:#78BCD6">
                    	<h2 style="width:100%;text-align:center;height:auto;"><span style="color:#FFFFFF"><?php // print $ItemcoverPage[$CP]['coverPage_item_Name']; ?></span></h2><br />
						<br class="clear" />                       
					</div>
                    </div>-->
               
               <h2 style="text-align:center;height:auto; padding-bottom:10px; ">
               <p style="margin-bottom: 10px; padding-bottom: 10px; padding-top:10px; color:#FFFFFF; background-color:#5AADCD;">
					<?php echo $ItemcoverPage[$CP]['coverPage_lines']; ?>
               </p></h2>   
                <div  style="padding:0px 3px 0px 3px;margin-top:0px;padding-top:0px;border-bottom:none">
                <?php if($coverPagecontent['FB_show_key'] !=0){ ?>
                
               		<a href="<?php print $coverPagecontent['FB_url_key']; ?>" title="facebook" target="_blank"  >
                    <img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/facebook_doc.jpg" alt="Facebook"/> 
                    </a><br />
                    <?php } ?>
                    <?php if($coverPagecontent['TW_show_key'] !=0){ ?>
                    <a href="<?php print $coverPagecontent['twitter_url_key']; ?>" title="twitter" target="_blank" >
                    <img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/twitter.jpg" alt="Twitter#"/>
                    </a>
                    
                    <?php }} ?>
               
                <?php if($ItemcoverPage[$CP]['coverPage_id'] ==3){
					if($coverPagecontent['content_key'] !='undefined'){ ?>
                <h2 style="height:auto; padding-bottom:10px; ">
               <p style=" text-align:center;margin-bottom: 10px; padding-bottom: 10px; padding-top:10px; color:#FFFFFF; background-color:#5AADCD;">
					<?php echo $ItemcoverPage[$CP]['coverPage_lines']; ?>
               </p></h2> 
               <?php $theme = new theme(); $storycontent = $theme->storycontentCoverpage($ItemcoverPage[$CP]['coverPage_item_id']); 
			   foreach($storycontent as $story){  ?>
               <div class="experts">
                <span style="color:#3399FF; font-weight:bold;">
				   <?php echo ucfirst($story['content_name']); ?></span>
                <div style="padding:0px 3px 0px 3px;margin-top:0px;padding-top:0px;border-bottom:none">
                <?php echo ucfirst($story['content_dec']); ?>
                </div>
                </div>
                <?php } } } ?>

                   <?php if($ItemcoverPage[$CP]['coverPage_id'] ==4){
				   if($coverPagecontent['news_key'] !='undefined'){  ?>
                   <h2 style="height:auto; padding-bottom:10px; ">
               <p style=" text-align:center;margin-bottom: 10px; padding-bottom: 10px; padding-top:10px; color:#FFFFFF; background-color:#5AADCD;">
					<?php echo $ItemcoverPage[$CP]['coverPage_lines']; ?>
               </p></h2> 
                   <?php $theme = new theme(); $Newscontent = $theme->NewscontentCoverpage($ItemcoverPage[$CP]['coverPage_item_id']); 
			   				foreach($Newscontent as $news){  ?>
               <div class="experts">
               <span style="color:#3399FF; font-weight:bold;">
				   <?php echo ucfirst($news['content_name']); ?></span>
                <div style="padding:0px 3px 0px 3px;margin-top:0px;padding-top:0px;border-bottom:none">
                <?php  echo ucfirst($news['content_dec']); ?>
                </div>
                </div>
                <?php } } } ?> 
               
			   <?php if($ItemcoverPage[$CP]['coverPage_id'] ==5){
			     if($coverPagecontent['linkTitle_key'] !='undefined'){?>
                 <div style="border:#5AADCD dotted 1px;" >	
                           <h2 style="text-align:center;height:auto; padding-bottom:10px; ">
                           <p class="experts" style="color:#FFFFFF; background-color:#5AADCD; font-weight:bold;">
                                <?php echo $ItemcoverPage[$CP]['coverPage_lines']; ?>
                           </p></h2>
                           <?php $theme = new theme(); $Linkcontent = $theme->LinkcontentCoverpage($ItemcoverPage[$CP]['coverPage_item_id']); 
                                        foreach($Linkcontent as $Links){  ?>
                            <div style="height:25px;margin-bottom:0px !important;" >
                                <div class="expert_name" style="height:auto !important;padding-top:0px;padding-bottom:0px;">
                                    <h3 style="width:100%;text-align:center;height:auto; "><span style="color:#FFFFFF">
                                    <a href="<?php echo $Links['content_dec']; ?>" target="_blank" style="text-decoration:underline;" title="<?php echo $Links['content_name']; ?>" ><?php echo $Links['content_name']; ?></a></span></h3><br />
                                    <br class="clear" />                       
                                </div>
                                </div>
                    
                    
                <?php } echo "</div>";} } ?> 
                
                 <?php if($ItemcoverPage[$CP]['coverPage_id'] ==6){ 
			     if($coverPagecontent['message_key'] !='undefined'){?>
                 <p style=" padding:5px 0 5px 5px; color:#FFFFFF; background-color:#5AADCD; font-weight:bold;">
					<?php echo $ItemcoverPage[$CP]['coverPage_lines']; ?>
               </p>
                 <div class="experts1" style="padding:0px 3px 0px 3px;margin-top:0px;padding-top:0px;">
                <?php  print $coverPagecontent['message_key']; ?>
                </div>
               <div class="experts" style="height:25px; margin-top:15px !important;">
               		<div class="expert_name" style="height:auto !important;padding-top:0px;padding-bottom:0px;">
                    <form action='http://maps.google.com/maps' method='get' target='_blank'>
                    	<input type='hidden' name='daddr' value="<?php print $coverPagecontent['Address_key']; ?>" />
						<input type="submit" style="margin-left:15px;" value="Get Direction"  />
                        </form>
						<br class="clear" />                       
					</div>
                    </div>
                    
                <?php }} ?> 
                
                <?php if($ItemcoverPage[$CP]['coverPage_id'] ==7){ 
			     if($coverPagecontent['bannerlink_key'] !='undefined'){?>
                 <div  >
                 <p class="experts" style="color:#FFFFFF; background-color:#5AADCD; font-weight:bold;">
					<?php echo $ItemcoverPage[$CP]['coverPage_lines']; ?>
               </p>
                 <div style="padding:0px 3px 0px 3px; text-align:center;">
                <a href="<?php  print $coverPagecontent['bannerlink_key']; ?>" title="<?php  print $coverPagecontent['bannerlink_key']; ?>" target="<?php  print $coverPagecontent['bannerlink_key']; ?>"><?php  print $coverPagecontent['bannerlink_key']; ?></a>
                </div>
               <div  style="height:150px; margin-top:15px !important;">
               <?php if($coverPagecontent['Image_key'] !=''){ ?>	
                   <img src="<?php echo  $config_var->UPLOAD_URL.'user/original/'.$coverPagecontent['Image_key']; ?>" alt="Banner_image_path_invaild" width="150" height="120" title="Banner" style="margin-left:25px; padding-bottom:10px;"  /> 
				<?php } ?>
						<br class="clear" />                       
					
                    </div>
                    </div><br />
                <?php }} ?> 


				<?php if($ItemcoverPage[$CP]['coverPage_id'] ==8){ 
			     if($coverPagecontent['customContent_key'] !='undefined'){
				 ?>
                 <p style=" padding:5px 0 5px 5px; color:#FFFFFF; text-align:center; background-color:#5AADCD; font-weight:bold;">
					<?php echo $ItemcoverPage[$CP]['coverPage_lines']; ?>
               </p>
                 <div class="experts" style="padding:0px 3px 0px 3px;margin-top:0px;padding-top:0px;">
                <?php  print wordwrap($coverPagecontent['customContent_key'],32,"\n", true); ?>
                </div>
                    
                <?php }} ?> 
                
                <?php if($ItemcoverPage[$CP]['coverPage_id'] ==9){ 
			     if($coverPagecontent['facebookPageurl_key'] !='undefined'){
				 ?>
                 <div class="experts" style="padding:0px 3px 0px 3px;margin-top:0px;padding-top:0px;">
                <a href="<?php  print $coverPagecontent['facebookPageurl_key']; ?>" target="_blank" style="text-decoration:underline; color:#0033FF; font-weight:bold;" title="" ><?php  print wordwrap($coverPagecontent['facebookPageurl_key'],25,"\n", true); ?></a>
                <br />
                
                <div>
                <br class="clear" />    
                
                </div>
                </div>
                
                    
                <?php }} ?> 
               
               <?php }}  ?>
               
</div>
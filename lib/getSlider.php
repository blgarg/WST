<?php 
 include '../settings.php';
 require_once('mysql/mysql.php');
 global $config_var;  
 class slider extends JDatabaseMySQL
{
	var $userId;
	var $qry;
	var $_result = '';   
	
	 function initialize(){ return;}
	 function getvarp(){return ;}
				
	function getSlider()
	{	
		      $this->sql = "SELECT * FROM mgl_news_banner WHERE Actions=1";
			  	if($this->query())
				{
				 return $this->loadAssoc();
			   	}
	 }			
	
	
	function getLimitData($data,$limit)
	{
			$DataLen = strlen($data);
			if($DataLen >$limit)
			{
				return substr($data,0,$limit+1).".....";
			}else{
				return $data;
			}
	}		
 }

$slider = new slider();
$sliderData = $slider->getSlider();
?>	
<div class="content-txt-div">
                	<!--Header Text-->
                    <div class="content-lt-hdr">
                    	News
                    </div>
                     <!--Flash Div-->
                        <div class="flash-div">
                        	 <div id="slider" style="z-index:888;">
                               <?php
					            for($i=0;$i<count($sliderData);$i++){ ?> 
                               <a href="<?php echo $sliderData[$i]['bannerLink']; ?>" target="_blank"><img src="<?php echo $config_var->UPLOAD_URL.'newsBanner/resizedImg/'.$sliderData[$i]['bannerId'].'_img.'.$sliderData[$i]['bannerImgSrc']; ?>" alt=""  title="<b><a href ='<?php echo $sliderData[$i]['bannerLink'];?>' target='_blank' style='text-decoration:none;color:#FFFFFF;'><?php echo ucfirst($slider->getLimitData($sliderData[$i]['bannerTitle'],110)); ?></a></b><br><?php echo ucfirst($slider->getLimitData($sliderData[$i]['bannerDesc'],250)); ?>"  /></a>
                                <?php  } ?>  
                       </div>
				 </div>
                        <!-- //Flash Div-->
                </div>


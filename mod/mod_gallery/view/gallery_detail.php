<?php 
global $config_var;  
global $DataSet;
global $model;
//config URL 
function imageResize($width, $height, $target) {
				
					//takes the larger size of the width and height and applies the formula accordingly...this is so this script will work dynamically with any size image

					if ($width > $height) {
					$percentage = ($target / $width);
					} else {
					$percentage = ($target / $height);
					}

					//gets the new value and applies the percentage, then rounds the value
					$width = round($width * $percentage);
					$height = round($height * $percentage);

					//returns the new sizes in html image tag format...this is so you can plug this function inside an image tag and just get the

					return "width='$width' height='$height'";

					}
//$config_var->ADMIN_TPL_URL
if(isset($_GET['id']) && $_GET['id']!='')
{
	$id=$_GET['id'];
	$gallery_detail = $model->getDetail($_GET['id']);
	$_SESSION['gallery_id']= $_GET['id'];
	if(is_dir($config_var->UPLOAD_ROOT."images/".$_GET['id']))
	$images= scandir($config_var->UPLOAD_ROOT."images/".$_GET['id']);
	else
	$images=array();
}
if(count($images)<=27){
?>
<style>
.numbering-outer
{
	display:none;
}
</style>
<?php }?>
<script src="<?php echo $config_var->WEB_TPL_URL;?>js/jquery.pagination.js" type="text/javascript"></script>
<script>
    var pagination_options = {
      num_edge_entries: 2,
      num_display_entries: 2,
      callback: pageselectCallback,
      items_per_page:24
    }
    function pageselectCallback(page_index, jq){
      var items_per_page = pagination_options.items_per_page;
      var offset = page_index * items_per_page;
	  var new_content = $('#hiddenresult div.result').slice(offset, offset + items_per_page).clone();
      $('#Searchresult').empty().append(new_content);
      return false;
    }
    function initPagination() {
      var num_entries = $('#hiddenresult div.result').length;
      // Create pagination element
	  
		$("#Pagination").pagination(num_entries, pagination_options);
	  
    }
    $(document).ready(function(){      
     
	  initPagination();
	  
    });
</script>
		<div class="inner-hdr">
        	<img src="<?php echo $config_var->WEB_TPL_URL; ?>images/photos-txt.png" alt="" />
        </div>
        
        <!--Inner Text-->
        <div class="inner-txt">

           <?php $cnt=0;foreach($images as $img){
				if($img != "." && $img != ".." && $img != "thumbnails" && $img != "thumbs.db"){
				
				$ext = explode(".",$img);
					if($ext['1'] == "jpg" || $ext['1'] == "png" ||$ext['1'] == "gif")
					$cnt++ ;
										
				}
				
			}
			 ?>
           <!--Bar Guide Container--> 
            <div class="bar-guide-con">
            	<div class="b-guide-hdr" style="float:left; ">
                	 <?php echo $gallery_detail[0]['image_title'];?> | <?php if($cnt>0){echo $cnt ;}else{ echo "0 ";}?> photos  
                   
                		<a href="?mod=mod_gallery&view=default&s=3" style="float:right; color:#ffffff; padding-right:5px;">Back to Gallery</a>
                   
                </div>
                <div class="bar-guide-txt">
                
                	<!--Photo Album Row-->
					
						<?php if(count($images)>0){?>		
							<div id="Searchresult" style="min-height:200px; overflow:hidden;"></div>
						  <table width="100%">
							<tr>
								<td style="padding-left:400px;">
									<span class="numbering-outer">
										
										<div id="Pagination" class="pagination"></div>
										
									</span>
								</td>
							</tr>
						</table>

						  <div id="hiddenresult" style="display:none;"  > 
							
							<?php
										
										for($i=2;$i<count($images);$i++){
										
										if($images[$i] !== '.' && $images[$i] !== '..' && $images[$i] !== 'Thumbs.db' && $images[$i]!=='thumbnails'){
								$testing =   $config_var->UPLOAD_URL."images/".$_GET['id']."/".$images[$i]; 
								
			$webMainUrl = $config_var->WEB_URL;
		   $image = str_replace($webMainUrl,'',$testing);
		   $sizes = getimagesize($image);
				
				$width = $sizes[0];
				$height = $sizes[1];
							if ($width > $height) {
							$width2=$width/4;
									// Landscape
									?>
										<div class="result photo-album-img" style="width:<?php echo $width2; ?>" >
										<a href="?mod=mod_gallery&view=fullDetail&s=3&id=<?php echo $_GET['id'];?>&img=<?php echo $images[$i];?>"><img title ="<?php echo $images[$i];?>" src="<?php echo $config_var->UPLOAD_URL."images/".$_GET['id']."/".$images[$i];?>" class="test" width="<?php echo $width2; ?>"  /></a>
														
							</div>
									<?php
								} else {
								?>
							
							
							<div class="result photo-album-img" >
										<a href="?mod=mod_gallery&view=fullDetail&s=3&id=<?php echo $_GET['id'];?>&img=<?php echo $images[$i];?>"><img title ="<?php echo $images[$i];?>" src="<?php echo $config_var->UPLOAD_URL."images/".$_GET['id']."/thumbnails/".$images[$i];?>"   width="144" height="192" class="demo" /></a>
														
							</div>
							
							<?php 
							}
							}	} ?>
						</div>	
				   
				  </div>
				<?php }?>
								
					</div>
                    
                    <!--//Photo Album Row-->
                
                </div>
            </div>
			 <!--//Bar Guide Container--> 

            
          <div class="clr"></div>
        </div>
        <!--//Inner Text-->
        		
	<div style="float:left;width:100%;">
	

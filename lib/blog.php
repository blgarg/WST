<?php 
 include '../settings.php';
 require_once('mysql/mysql.php');
 global $config_var;  
 class postBlog extends JDatabaseMySQL
{
	var $userId;
	var $qry;
	
	function getFeaturedPost()
	{	
		          $this->qry = "SELECT post.* ,featuredPost.post_id FROM wp_posts as post,wp_featured_posts as featuredPost
							WHERE post.ID =featuredPost.post_id order by post.ID DESC limit 3";
					$this->sql = $this->qry;
					if($this->query())
					{
					return $this->loadAssoc();
					}
	 }
	 
	 function getPostAuthorName($id)
		{
			$this->sql = "SELECT  users.display_name FROM wp_users as users WHERE users.ID = '$id'";
			  if($this->query()){
				 $DATA = $this->getArray();
				 return "&nbsp;".ucfirst($DATA['display_name'])."&nbsp;";
			   }
		}
		
	function getPostAuthor($id,$field)
		{
			$this->sql = "SELECT  usersMeta.meta_value FROM wp_usermeta as usersMeta WHERE usersMeta.user_id = '$id' AND meta_key = '$field'";
			  if($this->query()){
				 $DATA = $this->getArray();
				 return $DATA['meta_value'];
			   }
		}
		
	function _remove_image($text)
		{
			$text = preg_replace("/<img[^>]+\>/i", "", $text); 
			return $text;
		}									 
		
		function getLimitData($data,$limit)
		{
			$DataLen = strlen($data);
			if($DataLen >$limit)
			{
				return substr($data,0,$limit)."...";
			}else{
				return $data;
			}
		}		
	    
		
}

 $postBlog = new postBlog();
  
 //$postBlogData =  $postBlog->show(); 
 // print_r($postBlogData);
?>					

                        <?php	
                            $featuedBlogPost = $postBlog->getFeaturedPost();
							   for($i=0;$i<count($featuedBlogPost);$i++){ 
						   			$postAuthorName = $postBlog->getPostAuthorName($featuedBlogPost[$i]['post_author']);
									//$model_index_default->getPostAuthor($UserId,'fieldName');
						   ?> 
                            <div class="blog-post" style="height:auto;">
                            	<!--Image-->
                                <div class="blog-post-img">
                                	<img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/c1-img.gif" alt="" />
                                </div>
                                <!--Image-->
                                	<!--Blog Post Text-->
                                    <div class="blog-post-txt">
                                    	<h3><a href="<?php echo $featuedBlogPost[$i]['guid'];?>" target="_blank">
										<?php echo ucfirst($featuedBlogPost[$i]['post_title']);?></a>
                                        </h3>
                                        <h4>Post By:<?php echo $postAuthorName; ?> On <?php echo date('l, F jS, Y',strtotime($featuedBlogPost[$i]['post_date']))?></h4>
                                       <?php 
									   $filterData = $postBlog->_remove_image($featuedBlogPost[$i]['post_content']);
									   $postContent  = $postBlog->getLimitData($filterData,300);
									   //echo trim($postContent);
									   echo @mb_convert_encoding($postContent, 'UTF-8', $chr);
									  
									   ?>
                                       <!--Blog Comments div-->
                                        <div class="blog-comments-div">
                                         <a href="<?php echo $featuedBlogPost[$i]['guid'];?>" target="_blank" title="Read Full Post" class="fl">
                                        	<img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/read-full-post.gif" alt="Read Full Post"  />
                                          </a>
                                          	
                                           <div class="blog-comment">
                                           		<a href="<?php echo $featuedBlogPost[$i]['guid'];?>#comments" target="_blank" title="Post Comments" ><img src="<?php echo  $config_var->WEB_TPL_URL; ?>images/comment-icon.gif" alt=""  style="margin-right:3px;" /> Comments (<?php echo $featuedBlogPost[$i]['comment_count'];?>)</a>
                                           </div> 
                                          <!-- 
                                          <a href="javascript:;" title="Like" class="fl">
                                        	<img src="<?php //echo  $config_var->WEB_TPL_URL; ?>images/facebook-like-img.gif" alt="like"  />
                                          </a>-->
                                          
                                           <!--<div class="blog-comment-like">
                                           <div id="fb-root"></div><script src="http://widgets.fbshare.me/files/fbshare.js"></script><fb:like href="<?php //echo $featuedBlogPost[$i]['guid'];?>" send="true" width="400" show_faces="true" font="arial"></fb:like>
                                           </div>-->
                                          
                                          
                                        </div>
                                         <!-- //Blog Comments div-->
                                         
                                    </div>
                                    <!-- //Blog Post Text-->
                                
                               <div class="clr"></div>
                            </div>
                            <?php } ?>
                            <!-- //Blog Post-->
                           
                        
              
                       <!-- //Left mid text-->
    
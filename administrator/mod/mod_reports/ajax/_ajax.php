<?php


function get_addLeftColHtml(){ ?>
	<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <tr>
            <th valign="top">Position<span class="red">*</span> :</th>
            <td>
            <input type="radio" name="column_position" value="left"   id="column_position"/>
            &nbsp;Left&nbsp;&nbsp;&nbsp;
            <input type="radio" name="column_position" value="right"  id="column_position"/>&nbsp;Right</td>
          </tr>
          
           
           <tr>
                 <th valign="top">Name<span class="red">*</span> :</th>
                <td><input type="text"  name="column_name"  id="blockname" value="" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
         <tr>
         <tr>
                 <th valign="top">Content :</th>
                <td><textarea style="width:400px;height:120px;" id="blockContent"></textarea></td>
            </tr>
         <tr>
         
            <th>&nbsp;</th>
            <td valign="top">
                
                <input type="hidden" name="mod" value="mod_blog"  />
                <input type="button" value="" class="form-submit"  name="button" onclick="saveColumn();" style="cursor:pointer;"/>
                <input type="button" value="" class="form-reset"  onclick="window.location.href='./?mod=mod_blogSetting&view=default&m=1'"  style="cursor:pointer;"/>
            </td>
            </tr>
        </table>
<?php }?>


<?php
function get_saveColumn()
{

$session = new session();
$idUser = @$session->getVar("userAccountID");
$JDatabaseMySQL2 = new JDatabaseMySQL();
$desc = addslashes(@$_REQUEST['blockDesc']);
						  $JDatabaseMySQL2->sql = "insert into mgl_blog_column(column_id,column_block_name,column_type,user_id,Actions) values(NULL,'".$_REQUEST['blockname']."','".$_REQUEST['blockType']."','".$idUser."','".$_REQUEST['Actions']."')";
						  
						  if($JDatabaseMySQL2->query()){
						   $id = mysql_insert_id();
						   $JDatabaseMySQL2->sql = "insert into mgl_block_content(user_block_id,block_content) values('".$id."','".$desc."')";
						   
						   if($JDatabaseMySQL2->query()){
							  $isRun = 1;
							  }
							  }else{
							  $isRun = 2;
							  }
							  $result = array("isAction"=>$isRun,"test"=>$JDatabaseMySQL2->sql);
							  $result = json_encode($result);
							  echo $result;
}
?>


<?php 

function get_addLinkfromHTML(){ 
if(isset($_REQUEST['Link_id']) && $_REQUEST['Link_id'] >= 0){

$Link_id = $_REQUEST['Link_id']; 
$JDatabaseMySQL2 = new JDatabaseMySQL();

$JDatabaseMySQL2->sql = "SELECT * FROM custom_tab_links WHERE custon_link_id ='$Link_id'";
$JDatabaseMySQL2->query();
$istherelink =  $JDatabaseMySQL2->loadAssoc();
}
?>
<div style="border:#CCCCCC 1px solid;">
<div style="margin-left:10px; padding:15px 0 15px 0;">
<p class="title_blog_menu"><h2>Add Link</h2></p>
	<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
           <tr>
                 <th valign="top">Link Text<span class="red">*</span> :</th>
                <td><input type="text"  name="link_name"  id="link_name" value="<?php echo $istherelink[0]['link_name']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
         <tr>
                 <th valign="top">Link URL :</th>
                <td><input type="text"  name="link_url"  id="link_url" value="<?php echo $istherelink[0]['link_url']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
         <tr>
         
            <th>&nbsp;</th>
            <td valign="top">
                
                <input type="hidden" name="mod" value="mod_blog"  />
                <input type="hidden" name="Action" value="1" id="Action"/>
                <?php if(isset($_REQUEST['Link_id']) && $_REQUEST['Link_id'] >= 0){ ?>
                <input type="button" value="" class="form-submit"  name="button" onclick="updatelink(<?php echo $istherelink[0]['custon_link_id']; ?>)" style="cursor:pointer;"/>
                <input type="button" value="" class="form-reset"  onclick="window.location.href='./?mod=mod_blogSetting&view=default&m=1'"  style="cursor:pointer;"/>
                <?php }else{ ?>
				<input type="button" value="" class="form-submit"  name="button" onclick="savelink();" style="cursor:pointer;"/>
                <input type="button" value="" class="form-reset"  onclick="window.location.href='./?mod=mod_blogSetting&view=default&m=1'"  style="cursor:pointer;"/>
                <?php } ?>
            </td>
            </tr>
        </table>
        </div>
</div>
<?php }?>

<?php

function saveTabLink(){

$session = new session();
$idUser = @$session->getVar("userAccountID");

$JDatabaseMySQL2 = new JDatabaseMySQL();

$JDatabaseMySQL2->sql = "SELECT * FROM custom_tab WHERE user_id ='$idUser'";
$JDatabaseMySQL2->query();
$isthereTab =  $JDatabaseMySQL2->loadAssoc();
$custom_tab_id = $isthereTab[0]['custom_tab_id'];

if(isset($_REQUEST['link_id']) && $_REQUEST['link_id'] > 0){
$link = $_REQUEST['link_id'];

		$JDatabaseMySQL2->sql = "UPDATE custom_tab_links SET link_name = '".$_REQUEST['linkName']."', link_url = '".$_REQUEST['linkUrl']."' 
		WHERE custon_link_id = '".$link."'";
		
						  if($JDatabaseMySQL2->query()){
						  $isRun = 1;
						  }else{
						  $isRun = 2;
						  }
						  $result = array("isAction"=>$isRun,"test"=>$JDatabaseMySQL2->sql);
					 	  $result = json_encode($result);
 					      echo $result;

}else{
		
		$JDatabaseMySQL2->sql = "insert into custom_tab_links(custom_tab_id,user_id,link_name,link_url,Actions)
 values('".$custom_tab_id."','".$idUser."','".$_REQUEST['linkName']."', '".$_REQUEST['linkUrl']."','".$_REQUEST['Action']."')";
						  if($JDatabaseMySQL2->query()){
						  $isRun = 1;
						  }else{
						  $isRun = 2;
						  }
						  $result = array("isAction"=>$isRun,"test"=>$JDatabaseMySQL2->sql);
					 	  $result = json_encode($result);
 					      echo $result; 
    } 
}

function get_custom_video_page()
{
  $session = new session();
$idUser = @$session->getVar("userAccountID");

$JDatabaseMySQL2 = new JDatabaseMySQL();

$JDatabaseMySQL2->sql = "SELECT * FROM  custom_video_page WHERE user_id ='$idUser'";
$JDatabaseMySQL2->query();
$isthereTab =  $JDatabaseMySQL2->loadAssoc();
$custom_tab_id = $isthereTab[0]['custom_video_page_id'];

if($custom_tab_id && $custom_tab_id > 0){
		$JDatabaseMySQL2->sql = "UPDATE custom_video_page SET custom_page_name= '".$_REQUEST['custom_page_name']."', video_page_headline = '".$_REQUEST['video_page_headline']."', action = '".$_REQUEST['action']."'
		WHERE 	user_id = '".$idUser."'";
		
						  if($JDatabaseMySQL2->query()){
						  $isRun = 1;
						  }else{
						  $isRun = 2;
						  }
						  $result = array("isAction"=>$isRun,"test"=>$JDatabaseMySQL2->sql);
					 	  $result = json_encode($result);
 					      echo $result;

}else{


		
		$JDatabaseMySQL2->sql = "insert into custom_video_page(custom_page_name,video_page_headline,user_id,action)
 values('".$_REQUEST['custom_page_name']."', '".$_REQUEST['video_page_headline']."','".$idUser."','".$_REQUEST['action']."')";
						  if($JDatabaseMySQL2->query()){
						  $isRun = 1;
						  }else{
						  $isRun = 2;
						  }
						  $result = array("isAction"=>$isRun,"test"=>$JDatabaseMySQL2->sql);
					 	  $result = json_encode($result);
 					      echo $result; 
}
}


function delete_Link(){


$Link_id = @$_REQUEST['Link_id'];
$JDatabaseMySQL2 = new JDatabaseMySQL();
			$JDatabaseMySQL2->sql = "delete FROM custom_tab_links WHERE custon_link_id  in(".$Link_id.") ";
						  if($JDatabaseMySQL2->query()){
						  $isRun = 1;
						  }else{
						  $isRun = 2;
						  }
						  $result = array("isAction"=>$isRun,"test"=>$JDatabaseMySQL2->sql);
					 	  $result = json_encode($result);
 					      echo $result;
}
?>



<?php
function get_updateCoverPagefrm(){ 
if(isset($_REQUEST['coverPage_id']) && $_REQUEST['coverPage_id'] > 0){

 
$coverPage_id = $_REQUEST['coverPage_id']; 
$JDatabaseMySQL2 = new JDatabaseMySQL();
$session = new session();
$idUser = @$session->getVar("userAccountID");


$JDatabaseMySQL2->sql = "SELECT * FROM items_coverPages WHERE user_id= '$idUser' and coverPage_id ='$coverPage_id'";
$JDatabaseMySQL2->query();
$istherecoverPage =  $JDatabaseMySQL2->loadAssoc();
//echo "<pre>"; print_r($istherecoverPage);

$fetch_content = $istherecoverPage[0]['coverPage_content'];
$getcontent = unserialize($fetch_content);

//print_r($getcontent);
}

if($_REQUEST['coverPage_id'] ==1){
?>
<div style="border:#CCCCCC 1px solid;">
<div style="margin-left:10px; padding:15px 0 15px 0;">
<p class="title_blog_menu"><h2><?php echo $istherecoverPage[0]['coverPage_item_Name']; ?></h2></p><br />
	<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
           <tr>
                 <th valign="top">Item Name<span class="red">*</span> :</th>
                <td><input type="text" readonly="readonly"  name="CoverPage_name"  id="CoverPage_name" value="<?php echo $istherecoverPage[0]['coverPage_item_Name']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
         <tr>
                 <th valign="top">Headline Text :</th>
                <td><input type="text"  name="coverPage_lines"  id="coverPage_lines" value="<?php  echo $istherecoverPage[0]['coverPage_lines']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
            <tr>
                 <th valign="top">&nbsp;</th>
                <td><input type="checkbox" <?php if(($istherecoverPage[0]['show']) ==1){ ?>checked="checked"<?php }else{  } ?> name="show" id="show" value="1"   />&nbsp;Show the Headline for This Item</td>
            </tr>
         <tr>
         
            <th>&nbsp;</th>
            <td valign="top">
                
                <input type="hidden" name="mod" value="mod_blog"  />
                <input type="hidden" name="Action" value="1" id="Action"/>
                <input type="button" value="" class="form-submit"  name="button" onclick="updatecoverPage(<?php echo $istherecoverPage[0]['coverPage_item_id']; ?>)" style="cursor:pointer;"/>
                <input type="button" value="" class="form-reset"  onclick="window.location.href='./?mod=mod_blogSetting&view=default&m=1'"  style="cursor:pointer;"/>
                       
                
            </td>
            </tr>
        </table>
        </div>
</div>
<?php }	if($_REQUEST['coverPage_id'] ==2){ ?>


<div style="border:#CCCCCC 1px solid;">
<div style="margin-left:10px; padding:15px 0 15px 0;">
<p class="title_blog_menu"><h2><?php echo $istherecoverPage[0]['coverPage_item_Name']; ?></h2></p><br />
	<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
           <tr>
                 <th valign="top">Item Name<span class="red">*</span> :</th>
                <td><input type="text" readonly="readonly" name="CoverPage_name"  id="CoverPage_name" value="<?php echo $istherecoverPage[0]['coverPage_item_Name']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
         <tr>
                 <th valign="top">Headline Text :</th>
                <td><input type="text"  name="coverPage_lines"  id="coverPage_lines" value="<?php  echo $istherecoverPage[0]['coverPage_lines']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
            <tr>
                 <th valign="top">&nbsp;</th>
                <td><input type="checkbox" <?php if(($istherecoverPage[0]['show']) ==1){ ?>checked="checked"<?php }else{  } ?> name="show" id="show" value="1"   />&nbsp;Show the Headline for This Item</td>
            </tr>
            <tr>
                 <th valign="top">&nbsp;</th>
                <td><input type="checkbox" <?php if(($getcontent['FB_show_key']) ==1){ ?>checked="checked"<?php }else{  } ?> name="FB_show" id="FB_show" value="1"   />&nbsp;Show Facebook </td>
            </tr>
            <tr>
                 <th valign="top">Facebook URL :</th>
                <td><input type="text"  name="FB_url"  id="FB_url" value="<?php echo $getcontent['FB_url_key']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
            <tr>
                 <th valign="top">&nbsp;</th>
                <td><input type="checkbox" <?php if(($getcontent['TW_show_key']) ==1){ ?>checked="checked"<?php }else{  } ?>  name="TW_show" id="TW_show" value="1"   />&nbsp;Show Twitter</td>
            </tr>
            <tr>
                 <th valign="top">Twitter URL :</th>
                <td><input type="text"  name="twitter_url"  id="twitter_url" value="<?php echo $getcontent['twitter_url_key']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
         <tr>
         
            <th>&nbsp;</th>
            <td valign="top">
                
                <input type="hidden" name="mod" value="mod_blog"  />
                <input type="hidden" name="Action" value="1" id="Action"/>
                <input type="button" value="" class="form-submit"  name="button" onclick="updatecoverPage1(<?php echo $istherecoverPage[0]['coverPage_item_id']; ?>)" style="cursor:pointer;"/>
                <input type="button" value="" class="form-reset"  onclick="window.location.href='./?mod=mod_blogSetting&view=default&m=1'"  style="cursor:pointer;"/>
                       
                
            </td>
            </tr>
        </table>
        </div>
</div>
	
<?php } ?>

<?php if($_REQUEST['coverPage_id'] ==3){ ?>


<div style="border:#CCCCCC 1px solid;">
<div style="margin-left:10px; padding:15px 0 15px 0;">
<p class="title_blog_menu"><h2><?php echo $istherecoverPage[0]['coverPage_item_Name']; ?></h2></p><br />
	<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
           <tr>
                 <th valign="top">Item Name<span class="red">*</span> :</th>
                <td><input type="text" readonly="readonly" name="CoverPage_name"  id="CoverPage_name" value="<?php echo $istherecoverPage[0]['coverPage_item_Name']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
         <tr>
                 <th valign="top">Headline Text :</th>
                <td><input type="text"  name="coverPage_lines"  id="coverPage_lines" value="<?php  echo $istherecoverPage[0]['coverPage_lines']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
            <tr>
                 <th valign="top">&nbsp;</th>
                <td><input type="checkbox" <?php if(($istherecoverPage[0]['show']) ==1){ ?>checked="checked"<?php }else{  } ?> name="show" id="show" value="1"   />&nbsp;Show the Headline for This Item</td>
            </tr>
            <tr>
               <th valign="top" ><a href="javascript:;" title="Add story" style="color:#6699FF;" onclick="addstory('add');">Add Success Story</a></th>
               <td>&nbsp;</td>
            </tr>
                   
            <tr>
             <td>&nbsp;</td>
               <td>
              
               <table bgcolor="#CCCCCC">
                    <?php 
					$JDatabaseMySQL2->sql = "select * from itemcontent_coverpage where item_id= '".$istherecoverPage[0]['coverPage_item_id']."' ";
					$JDatabaseMySQL2->query();
					$Itemcontent =  $JDatabaseMySQL2->loadAssoc();
					$Countcontent =  $JDatabaseMySQL2->getNumRows();
					
					if(count($Itemcontent) > 0){ 
					for($i=0;$i<count($Itemcontent);$i++){
					 ?>
                      <tr>
                                <td style="text-align:center; line-height: 28px;min-width: 130px;padding: 0 0 10px; width: 130px; ">
								<?php echo $Itemcontent[$i]['content_name'];  ?></td>
                                <td style="text-align:center; line-height: 28px;min-width: 130px;padding: 0 0 10px; width: 130px; ">
                                <a href="javascript:;" title="Edit story" style="color:#6699FF;" onclick="addstory('edit','<?php echo $Itemcontent[$i]['content_id'];  ?>');">Edit</a></td>
                                 <td style="text-align:center; line-height: 28px;min-width: 130px;padding: 0 0 10px; width: 130px; "><a href="javascript:;" title="Delete story" style="color:#6699FF;" onclick="deletestory('deleteStory','<?php echo $Itemcontent[$i]['content_id'];  ?>');">Delete</a></td>
                       <?php } }else{ ?>          
                        <td style="text-align:center; line-height: 28px;padding: 0 5px 5px 5px;  ">There is no Records</td>
                        <?php } ?>         
	                     </tr>
              </table>
                    
              </td>
           </tr>
           <tr>
             <th>&nbsp;</th>
               <td>&nbsp;
                 
              </td>
           </tr>
           <tr>
             <th>&nbsp;</th>
               <td>
                  <div id="success_story" ></div>
              </td>
           </tr>
            
            
         <tr>
         
            <th>&nbsp;</th>
            <td valign="top">
                
                <input type="hidden" name="mod" value="mod_blog"  />
                <input type="hidden" name="Action" value="1" id="Action"/>
                <input type="button" value="" class="form-submit"  name="button" onclick="updatecoverPage3(<?php echo $istherecoverPage[0]['coverPage_item_id']; ?>)" style="cursor:pointer;"/>
                <input type="button" value="" class="form-reset"  onclick="window.location.href='./?mod=mod_blogSetting&view=default&m=1'"  style="cursor:pointer;"/>
                       
                
            </td>
            </tr>
        </table>
        </div>
</div>
	
<?php } ?>


<?php if($_REQUEST['coverPage_id'] ==4){ ?>


<div style="border:#CCCCCC 1px solid;">
<div style="margin-left:10px; padding:15px 0 15px 0;">
<p class="title_blog_menu"><h2><?php echo $istherecoverPage[0]['coverPage_item_Name']; ?></h2></p><br />
	<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
           <tr>
                 <th valign="top">Item Name<span class="red">*</span> :</th>
                <td><input type="text" readonly="readonly" name="CoverPage_name"  id="CoverPage_name" value="<?php echo $istherecoverPage[0]['coverPage_item_Name']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
         <tr>
                 <th valign="top">Headline Text :</th>
                <td><input type="text"  name="coverPage_lines"  id="coverPage_lines" value="<?php  echo $istherecoverPage[0]['coverPage_lines']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
            <tr>
                 <th valign="top">&nbsp;</th>
                <td><input type="checkbox" <?php if(($istherecoverPage[0]['show']) ==1){ ?>checked="checked"<?php }else{  } ?> name="show" id="show" value="1"   />&nbsp;Show the Headline for This Item</td>
            </tr>
            <tr>
                 <th valign="top" ><a href="javascript:;" title="Add news" style="color:#6699FF;" onclick="addnews('Addnews',0);">Add News</a></th>
                <td>&nbsp;</td>
            </tr>
            
            <tr>
             <td>&nbsp;</td>
               <td>
              
               <table bgcolor="#CCCCCC">
                    <?php 
					$ItemID = $istherecoverPage[0]['coverPage_item_id'];
					$JDatabaseMySQL2->sql = "select * from itemcontent_coverpage where item_id IN('$ItemID') ";
					$JDatabaseMySQL2->query();
					$Itemcontent =  $JDatabaseMySQL2->loadAssoc();
					//$Countcontent =  $JDatabaseMySQL2->getNumRows(); kundal
					//echo count($Itemcontent);
					if(count($Itemcontent) > 0){ 
					for($i=0;$i<count($Itemcontent);$i++){
					 ?>
                      <tr>
                                <td style="text-align:center; line-height: 28px;min-width: 130px;padding: 0 0 10px; width: 130px; ">
								<?php echo $Itemcontent[$i]['content_name'];  ?></td>
                                <td style="text-align:center; line-height: 28px;min-width: 130px;padding: 0 0 10px; width: 130px; ">
                                <a href="javascript:;" title="Edit news" style="color:#6699FF;" onclick="addnews('editnews','<?php echo $Itemcontent[$i]['content_id'];  ?>');">Edit</a></td>
                                 <td style="text-align:center; line-height: 28px;min-width: 130px;padding: 0 0 10px; width: 130px; "><a href="javascript:;" title="Delete news" style="color:#6699FF;" onclick="DeleteNews('deletenews','<?php echo $Itemcontent[$i]['content_id'];  ?>');">Delete</a></td>
                       <?php } }else{ ?>
                        <td style="text-align:center; line-height: 28px;padding: 0 5px 5px 5px;  ">There is no Records</td>
                        <?php } ?>         
                      </tr>
                      
                </table>
                    
              </td>
           </tr>	
            <tr>
                 <th >&nbsp;</th>
                <td>&nbsp;</td>
            </tr>
            
            <tr>
                 <th>&nbsp;</th>
                <td><div id="add_news" ></div></td>
            </tr>
         <tr>
         
            <th>&nbsp;</th>
            <td valign="top">
                <input type="hidden" name="mod" value="mod_blog"  />
                <input type="hidden" name="Action" value="1" id="Action"/>
                <input type="button" value="" class="form-submit"  name="button" onclick="updatecoverPage4(<?php echo $istherecoverPage[0]['coverPage_item_id']; ?>)" style="cursor:pointer;"/>
                <input type="button" value="" class="form-reset"  onclick="window.location.href='./?mod=mod_blogSetting&view=default&m=1'"  style="cursor:pointer;"/>
            </td>
            </tr>
        </table>
        </div>
</div>
<?php } ?>

<?php if($_REQUEST['coverPage_id'] ==5){ ?>


<div style="border:#CCCCCC 1px solid;">
<div style="margin-left:10px; padding:15px 0 15px 0;">
<p class="title_blog_menu"><h2><?php echo $istherecoverPage[0]['coverPage_item_Name']; ?></h2></p><br />
	<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
           <tr>
                 <th valign="top">Item Name<span class="red">*</span> :</th>
                <td><input type="text" readonly="readonly" name="CoverPage_name"  id="CoverPage_name" value="<?php echo $istherecoverPage[0]['coverPage_item_Name']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
         <tr>
                 <th valign="top">Headline Text :</th>
                <td><input type="text"  name="coverPage_lines"  id="coverPage_lines" value="<?php  echo $istherecoverPage[0]['coverPage_lines']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
            <tr>
                 <th valign="top">&nbsp;</th>
                <td><input type="checkbox" <?php if(($istherecoverPage[0]['show']) ==1){ ?>checked="checked"<?php }else{  } ?> name="show" id="show" value="1"   />&nbsp;Show the Headline for This Item</td>
            </tr>
            <tr>
                 <th valign="top" ><a href="javascript:;" title="Add Link" style="color:#6699FF;" onclick="addLink('AddLink',0);">Add Links</a></th>
                <td>&nbsp;</td>
            </tr>
            <tr>
             <td>&nbsp;</td>
               <td>
              
               <table bgcolor="#CCCCCC">
                    <?php 
					$ItemID = $istherecoverPage[0]['coverPage_item_id'];
					$JDatabaseMySQL2->sql = "select * from itemcontent_coverpage where item_id IN('$ItemID') ";
					$JDatabaseMySQL2->query();
					$Itemcontent =  $JDatabaseMySQL2->loadAssoc();
					if(count($Itemcontent) > 0){ 
					for($i=0;$i<count($Itemcontent);$i++){
					 ?>
                      <tr>
                                <td style="text-align:center; line-height: 28px;min-width: 130px;padding: 0 0 10px; width: 130px; ">
								<?php echo $Itemcontent[$i]['content_name'];  ?></td>
                                <td style="text-align:center; line-height: 28px;min-width: 130px;padding: 0 0 10px; width: 130px; ">
                                <a href="javascript:;" title="Edit Link" style="color:#6699FF;" onclick="addLink('editLink','<?php echo $Itemcontent[$i]['content_id'];  ?>');">Edit</a></td>
                                 <td style="text-align:center; line-height: 28px;min-width: 130px;padding: 0 0 10px; width: 130px; "><a href="javascript:;" title="Delete Link" style="color:#6699FF;" onclick="RemoveLink('RemoveLink','<?php echo $Itemcontent[$i]['content_id'];  ?>');">Delete</a></td>
                       <?php } }else{ ?>
                        <td style="text-align:center; line-height: 28px;padding: 0 5px 5px 5px;  ">There is no Records</td>
                        <?php } ?>         
                      </tr>
                      
                </table>
                    
              </td>
           </tr>
            
            
                     <tr>
                 <th>&nbsp;</th>
                <td>&nbsp;</td>
            </tr>
            <tr>
                 <th>&nbsp;</th>
                <td><div id="add_Link" ></div></td>
            </tr>
            
         <tr>
         
            <th>&nbsp;</th>
            <td valign="top">
                <input type="hidden" name="mod" value="mod_blog"  />
                <input type="hidden" name="Action" value="1" id="Action"/>
                <input type="button" value="" class="form-submit"  name="button" onclick="updatecoverPage5(<?php echo $istherecoverPage[0]['coverPage_item_id']; ?>)" style="cursor:pointer;"/>
                <input type="button" value="" class="form-reset"  onclick="window.location.href='./?mod=mod_blogSetting&view=default&m=1'"  style="cursor:pointer;"/>
            </td>
            </tr>
        </table>
        </div>
</div>
<?php } ?>

<?php 	if($_REQUEST['coverPage_id'] ==6){ ?>


<div style="border:#CCCCCC 1px solid;">
<div style="margin-left:10px; padding:15px 0 15px 0;">
<p class="title_blog_menu"><h2><?php echo $istherecoverPage[0]['coverPage_item_Name']; ?></h2></p><br />
	<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
           <tr>
                 <th valign="top">Item Name<span class="red">*</span> :</th>
                <td><input type="text" readonly="readonly" name="CoverPage_name"  id="CoverPage_name" value="<?php echo $istherecoverPage[0]['coverPage_item_Name']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
         <tr>
                 <th valign="top">Headline Text :</th>
                <td><input type="text"  name="coverPage_lines"  id="coverPage_lines" value="<?php  echo $istherecoverPage[0]['coverPage_lines']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
            <tr>
                 <th valign="top">&nbsp;</th>
                <td><input type="checkbox" <?php if(($istherecoverPage[0]['show']) ==1){ ?>checked="checked"<?php }else{  } ?> name="show" id="show" value="1"   />&nbsp;Show the Headline for This Item</td>
            </tr>
            
            <tr>
                 <th valign="top">Message :</th>
                <td><textarea  name="message"  id="message" style="width:400px;"><?php echo $getcontent['message_key'];  ?></textarea></td>
            </tr>
            
            <tr>
                 <th valign="top">Your Address :</th>
                <td><input type="text"  name="your_address"  id="your_address" value="<?php  echo $getcontent['Address_key']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
         <tr>
         
            <th>&nbsp;</th>
            <td valign="top">
                
                <input type="hidden" name="mod" value="mod_blog"  />
                <input type="hidden" name="Action" value="1" id="Action"/>
                <input type="button" value="" class="form-submit"  name="button" onclick="updatecoverPage6(<?php echo $istherecoverPage[0]['coverPage_item_id']; ?>)" style="cursor:pointer;"/>
                <input type="button" value="" class="form-reset"  onclick="window.location.href='./?mod=mod_blogSetting&view=default&m=1'"  style="cursor:pointer;"/>
                       
                
            </td>
            </tr>
        </table>
        </div>
</div>
	
<?php } ?>

<?php 	if($_REQUEST['coverPage_id'] ==7){ ?>


<div style="border:#CCCCCC 1px solid;">
<div style="margin-left:10px; padding:15px 0 15px 0;">
<p class="title_blog_menu"><h2><?php echo $istherecoverPage[0]['coverPage_item_Name']; ?></h2></p><br />
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="bannerfrm" id="bannerfrm" enctype="multipart/form-data" >	
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
           <tr>
                 <th valign="top">Item Name<span class="red">*</span> :</th>
                <td><input type="text" readonly="readonly"  name="CoverPage_name"  id="CoverPage_name" value="<?php echo $istherecoverPage[0]['coverPage_item_Name']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
         <tr>
                 <th valign="top">Headline Text :</th>
                <td><input type="text"  name="coverPage_lines"  id="coverPage_lines" value="<?php  echo $istherecoverPage[0]['coverPage_lines']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
            <tr>
                 <th valign="top">&nbsp;</th>
                <td><input type="checkbox" <?php if(($istherecoverPage[0]['show']) ==1){ ?>checked="checked"<?php }else{  } ?> name="show" id="show" value="1"   />&nbsp;Show the Headline for This Item</td>
            </tr>
            
            <tr>
                 <th valign="top">Banner URL :</th>
                <td><input type="text"  name="Banner_Link"  id="Banner_Link" value="<?php  echo $getcontent['bannerlink_key']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
            
            <tr>
                 <th valign="top">Banner Image :</th>
                <td><input type="file"  name="Banner_Image"  id="Banner_Image" class="textbox"  style="width:400px;"/></td>
            </tr>
         <tr>
         
            <th>&nbsp;</th>
            <td valign="top">
                
                <input type="hidden" name="mod" value="mod_blog"  />
                <input type="hidden" name="Action" value="1" id="Action"/>
                <input type="hidden" name="coverPage_id" value="<?php echo $istherecoverPage[0]['coverPage_item_id']; ?>" id="coverPage_id"/>
                <input type="hidden" name="ajax_call_method"  value="updatecoverPage7" id="ajax_call_method"  />
                <input type="submit" value="" class="form-submit"  name="submit"  style="cursor:pointer;" />
                <input type="button" value="" class="form-reset"  onclick="window.location.href='./?mod=mod_blogSetting&view=default&m=1'"  style="cursor:pointer;"/>
                       
                
            </td>
            </tr>
        </table>
        </form>
        </div>
</div>
	
<?php } ?>

<?php 	if($_REQUEST['coverPage_id'] ==8){ ?>


<div style="border:#CCCCCC 1px solid;">
<div style="margin-left:10px; padding:15px 0 15px 0;">
<p class="title_blog_menu"><h2><?php echo $istherecoverPage[0]['coverPage_item_Name']; ?></h2></p><br />
	<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
           <tr>
                 <th valign="top">Item Name<span class="red">*</span> :</th>
                <td><input type="text" readonly="readonly"  name="CoverPage_name"  id="CoverPage_name" value="<?php echo $istherecoverPage[0]['coverPage_item_Name']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
         <tr>
                 <th valign="top">Headline Text :</th>
                <td><input type="text"  name="coverPage_lines"  id="coverPage_lines" value="<?php  echo $istherecoverPage[0]['coverPage_lines']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
            <tr>
                 <th valign="top">&nbsp;</th>
                <td><input type="checkbox" <?php if(($istherecoverPage[0]['show']) ==1){ ?>checked="checked"<?php }else{  } ?> name="show" id="show" value="1"   />&nbsp;Show the Headline for This Item</td>
            </tr>
            
            <tr>
                 <th valign="top">Content :</th>
                <td><textarea  name="custom_content"  id="custom_content" style="width:400px;" ><?php  echo $getcontent['customContent_key']; ?></textarea></td>
            </tr>
            
            
         <tr>
         
            <th>&nbsp;</th>
            <td valign="top">
                
                <input type="hidden" name="mod" value="mod_blog"  />
                <input type="hidden" name="Action" value="1" id="Action"/>
                <input type="button" value="" class="form-submit"  name="button" onclick="updatecoverPage8(<?php echo $istherecoverPage[0]['coverPage_item_id']; ?>)" style="cursor:pointer;"/>
                <input type="button" value="" class="form-reset"  onclick="window.location.href='./?mod=mod_blogSetting&view=default&m=1'"  style="cursor:pointer;"/>
                       
                
            </td>
            </tr>
        </table>
        </div>
</div>
	
<?php } ?>

<?php 	if($_REQUEST['coverPage_id'] ==9){ ?>


<div style="border:#CCCCCC 1px solid;">
<div style="margin-left:10px; padding:15px 0 15px 0;">
<p class="title_blog_menu"><h2><?php echo $istherecoverPage[0]['coverPage_item_Name']; ?></h2></p><br />
	<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
           <tr>
                 <th valign="top">Item Name<span class="red">*</span> :</th>
                <td><input type="text" readonly="readonly" name="CoverPage_name"  id="CoverPage_name" value="<?php echo $istherecoverPage[0]['coverPage_item_Name']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
         <tr>
                 <th valign="top">Headline Text :</th>
                <td><input type="text"  name="coverPage_lines"  id="coverPage_lines" value="<?php  echo $istherecoverPage[0]['coverPage_lines']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
            <tr>
                 <th valign="top">&nbsp;</th>
                <td><input type="checkbox" <?php if(($istherecoverPage[0]['show']) ==1){ ?>checked="checked"<?php }else{  } ?> name="show" id="show" value="1"   />&nbsp;Show the Headline for This Item</td>
            </tr>
            
            <tr>
                 <th valign="top">Facebook Page URL:</th>
                <td><input type="text"  name="facebook_Page_url"  id="facebook_Page_url" value="<?php  echo $getcontent['facebookPageurl_key']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
            <tr>
                 <th valign="top">&nbsp;</th>
                <td><input type="checkbox" <?php if(($getcontent['find_us_FB_key']) ==1){ ?>checked="checked"<?php }else{  } ?> name="find_us_FB" id="find_us_FB" />&nbsp;Show 'Find us on Facebook' header</td>
            </tr>
            <tr>
                 <th valign="top">&nbsp;</th>
                <td><input type="checkbox" <?php if(($getcontent['show_face_key']) ==1){ ?>checked="checked"<?php }else{  } ?> name="show_face" id="show_face"  />&nbsp;Show Faces</td>
            </tr>
            <tr>
                 <th valign="top">&nbsp;</th>
                <td><input type="checkbox" <?php if(($getcontent['show_updates_key']) ==1){ ?>checked="checked"<?php }else{  } ?> name="show_updates" id="show_updates"/>&nbsp;Show Updates</td>
            </tr>
            
            
         <tr>
         
            <th>&nbsp;</th>
            <td valign="top">
                
                <input type="hidden" name="mod" value="mod_blog"  />
                <input type="hidden" name="Action" value="1" id="Action"/>
                <input type="button" value="" class="form-submit"  name="button" onclick="updatecoverPage9(<?php echo $istherecoverPage[0]['coverPage_item_id']; ?>)" style="cursor:pointer;"/>
                <input type="button" value="" class="form-reset"  onclick="window.location.href='./?mod=mod_blogSetting&view=default&m=1'"  style="cursor:pointer;"/>
                       
                
            </td>
            </tr>
        </table>
        </div>
</div>
	
<?php } }  ?>


<?php function EditLinks(){
		$item_id = @$_REQUEST['Item_id'];
		$JDatabaseMySQL2 = new JDatabaseMySQL();
		
		$JDatabaseMySQL2->sql = "SELECT * FROM itemcontent_coverpage WHERE content_id ='$item_id'";
		$JDatabaseMySQL2->query();
		$coverPagecontent =  $JDatabaseMySQL2->getArray();

 ?>
            <tr>
                 <th valign="top">Link Title :</th>
                <td><input type="text"  name="LinkTitle"  id="LinkTitle" value="<?php echo $coverPagecontent['content_name']; ?>"  maxlength="60" class="textbox"  style="width:400px;"/></td>
            </tr>
            <tr>
                 <th valign="top">Link URL :</th>
                 <input type="hidden" name="EDITadd" value="<?php echo $coverPagecontent['content_id']; ?>" id="EDITadd"  />
                <td><input type="text"  name="Link_url" value="<?php echo $coverPagecontent['content_dec']; ?>"  id="Link_url" maxlength="60" class="textbox"  style="width:400px;"/></td>
            </tr>


<?php }  function ADDLinks(){ ?>
            <tr>
                 <th valign="top">Link Title :</th>
                <td><input type="text"  name="LinkTitle"  id="LinkTitle"  maxlength="60" class="textbox"  style="width:400px;"/></td>
            </tr>
            <tr>
                 <th valign="top">Link URL :</th>
                 <input type="hidden" name="EDITadd" value="add" id="EDITadd"  />
                <td><input type="text"  name="Link_url"  id="Link_url" maxlength="60" class="textbox"  style="width:400px;"/></td>
            </tr>


<?php } 


 function editNews(){

$item_id = @$_REQUEST['Item_id'];
$JDatabaseMySQL2 = new JDatabaseMySQL();

$JDatabaseMySQL2->sql = "SELECT * FROM itemcontent_coverpage WHERE content_id ='$item_id'";
$JDatabaseMySQL2->query();
$coverPagecontent =  $JDatabaseMySQL2->getArray();

?>
            <tr>
                 <th valign="top">Name :</th>
                <td><input type="text" name="NewsTitle" id="NewsTitle" value="<?php echo $coverPagecontent['content_name']; ?>" maxlength="70" class="textbox" style="width:400px;"  /></td>
            </tr>
            <tr>
                 <th valign="top">Content :</th>
                 <input type="hidden" name="EDITadd" value="<?php echo $coverPagecontent['content_id']; ?>" id="EDITadd"  />
                <td>
                <textarea name="News" id="News"  style="width:400px;"><?php echo $coverPagecontent['content_dec']; ?></textarea>
                </td>
            </tr>

<?php }  function addNews(){ ?>
            <tr>
                 <th valign="top">Date/Title :</th>
                <td><input type="text"  name="NewsTitle"  id="NewsTitle" maxlength="60" class="textbox"  style="width:400px;"/></td>
            </tr>
            <tr>
                 <th valign="top">News :</th>
                  <input type="hidden" name="EDITadd" value="add" id="EDITadd"  />
                <td><textarea   name="News"  id="News" style="width:400px;"></textarea></td>
            </tr>


<?php } 



 function editsuccessStory(){

 
$item_id = @$_REQUEST['Item_id'];
$JDatabaseMySQL2 = new JDatabaseMySQL();
$session = new session();
$idUser = @$session->getVar("userAccountID");

$JDatabaseMySQL2->sql = "SELECT * FROM itemcontent_coverpage WHERE content_id ='$item_id'";
$JDatabaseMySQL2->query();
$coverPagecontent =  $JDatabaseMySQL2->getArray();


?>
            <tr>
                 <th valign="top">Name :</th>
                <td><input type="text" name="content_name" id="content_name" value="<?php echo $coverPagecontent['content_name']; ?>" maxlength="70" class="textbox" style="width:400px;"  /></td>
            </tr>
            <tr>
                 <th valign="top">Content :</th>
                 <input type="hidden" name="EDITadd" value="<?php echo $coverPagecontent['content_id']; ?>" id="EDITadd"  />
                <td>
                <textarea name="story_content" id="story_content"  style="width:400px;"><?php echo $coverPagecontent['content_dec']; ?></textarea>
                </td>
            </tr>

<?php }  function addsuccessStory(){ ?>
            <tr>
                 <th valign="top">Name :</th>
                <td><input type="text" name="content_name" id="content_name"  maxlength="70" class="textbox" style="width:400px;"  /></td>
            </tr>
            <tr>
                 <th valign="top">Content :</th>
                 <input type="hidden" name="EDITadd" value="add" id="EDITadd"  />
                <td>
                <textarea name="story_content" id="story_content"  style="width:400px;"></textarea>
                </td>
            </tr>

<?php } ?>


<?php function PageToarticleFooter(){ 
if(isset($_REQUEST['Page_ID']) && @$_REQUEST['Page_ID'] !=''){ 

$page_title = @$_REQUEST['Page_ID'];

$JDatabaseMySQL2 = new JDatabaseMySQL();
$session = new session();
$idUser = @$session->getVar("userAccountID");
$JDatabaseMySQL2->sql = "SELECT * FROM mgl_page_categories WHERE `cat_id`= '$page_title'";
$JDatabaseMySQL2->query();
$categoryDetails =  $JDatabaseMySQL2->getArray();

$cat_title = $categoryDetails['cat_name'];


 $JDatabaseMySQL2->sql = "SELECT * FROM footer_article WHERE `user_id`= '$idUser' AND `page_id`= '$page_title'";
$JDatabaseMySQL2->query();
$isthereFooterPages =  $JDatabaseMySQL2->loadAssoc();

$footer_content = $isthereFooterPages[0]['footerArticle_content'];
$getfootercontent = unserialize($footer_content);

?>

<div style="border:#CCCCCC 1px solid;margin-top:20px">
<div style="margin-left:10px; padding:15px 0 15px 0;">
<p class="title_blog_menu"><h2><?php echo ucfirst($cat_title); ?></h2></p><br />
 
<table border="0" cellpadding="0" cellspacing="0"  id="id-footer" >
           <tr>
                 <th valign="top" align="left">Headline: &nbsp;</th>
                <td><input style="vertical-align:top;width:400px;"  type="text"  name="headline_text"  id="headline_text" value="<?php  echo $isthereFooterPages[0]['headline_text']; ?>" maxlength="70" class="textbox" /></td>
            </tr>
 			<tr><td colspan="2">&nbsp;</td></tr>
           <tr>
                 <th valign="top" align="left">Show Headline: &nbsp;</th>
                <td><input style="vertical-align:bottom" type="checkbox" <?php if(($isthereFooterPages[0]['headline_show']) ==1){ ?>checked="checked"<?php }else{  } ?> name="show_headline" id="show_headline" /></td>
            </tr>
            
            <tr><td colspan="2">&nbsp;</td></tr>
            <tr><td colspan="2">&nbsp;</td></tr>
            <tr><td>&nbsp;</td>
            <td><strong>Select Your Content type: </strong></td></tr>
 			<tr><td colspan="2">&nbsp;</td></tr>
            <tr>
                 <th ><input style="margin-left:110px;vertical-align:middle" <?php if(($isthereFooterPages[0]['selected_footerArticle']) ==1){ ?>checked="checked"<?php }else{ } ?> type="radio" value="1" name="active_content" id="active_content_none" /></th>
                 
                <td>&nbsp;None</td>
            </tr>
             <tr><td colspan="2">&nbsp;</td></tr>
            <tr>
                 <th><input style="margin-left:110px;vertical-align:middle" <?php if(($isthereFooterPages[0]['selected_footerArticle']) ==2){ ?>checked="checked"<?php }else{ } ?> type="radio" value="2" name="active_content" id="active_content_image" /></th>
                <td>&nbsp;Image URL:<input type="text"  name="Image_url"  id="Image_url" value="<?php echo $getfootercontent['Image_url_key']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
             <tr><td colspan="2">&nbsp;</td></tr>
            <tr>
                 <th valign="top"></th>
                <td>&nbsp;Link URL: &nbsp;&nbsp;<input type="text"  name="linkTofooter"  id="linkTofooter" value="<?php  echo $getfootercontent['linkTofooter_key']; ?>" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
             <tr><td colspan="2">&nbsp;</td></tr>
            <tr>
                 <th valign="top"><input style="margin-left:110px;" <?php if(($isthereFooterPages[0]['selected_footerArticle']) ==3){ ?>checked="checked"<?php }else{ } ?> type="radio" value="3" name="active_content" id="active_content_text" /></th>
                <td><p>&nbsp;Text or HTML :</p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea  name="footerArticle_text"  id="footerArticle_text" ><?php  echo $getfootercontent['footerArticle_text_key']; ?></textarea></td>
            </tr>
             <tr><td colspan="2">&nbsp;</td></tr>
         <tr>
         
            <th>&nbsp;</th>
            <td valign="top">
                
                <input type="hidden" name="mod" value="mod_blog"  />
                <input type="hidden" name="Action" value="1" id="Action"/>
                <input type="button" value="" class="form-submit"  name="button" onclick="getfooterfrmValues('<?php echo $page_title; ?>')" style="cursor:pointer;"/>
                <input type="button" value="" class="form-reset"  onclick="window.location.href='./?mod=mod_blogSetting&view=default&m=1'"  style="cursor:pointer;"/>
                       
                
            </td>
            </tr>
        </table>
        </div>
</div>
<?php } ?>


<?php } ?>












<?php 
function delete_coverPage()
					{
$ItemcoverPageID = @$_REQUEST['ItemcoverPage_id'];
$JDatabaseMySQL2 = new JDatabaseMySQL();
			$JDatabaseMySQL2->sql = "delete FROM items_coverPages WHERE coverPage_item_id  in(".$ItemcoverPageID.") ";
						  if($JDatabaseMySQL2->query()){
						  $isRun = 1;
						  }else{
						  $isRun = 2;
						  }
						  $result = array("isAction"=>$isRun,"test"=>$JDatabaseMySQL2->sql);
					 	  $result = json_encode($result);
 					      echo $result;
					}
function DeleteStory()
					{
$contentID = @$_REQUEST['content_id'];
$JDatabaseMySQL2 = new JDatabaseMySQL();
			$JDatabaseMySQL2->sql = "delete FROM itemcontent_coverpage WHERE content_id  in(".$contentID.") ";
						  if($JDatabaseMySQL2->query()){
						  $isRun = 1;
						  }else{
						  $isRun = 2;
						  }
						  $result = array("isAction"=>$isRun,"test"=>$JDatabaseMySQL2->sql);
					 	  $result = json_encode($result);
 					      echo $result;
					}
					
					

function updatecurrentCoverPage(){

$JDatabaseMySQL2 = new JDatabaseMySQL();


if(isset($_REQUEST['coverPage_id']) && $_REQUEST['coverPage_id'] > 0){
$coverPage_id = $_REQUEST['coverPage_id'];

	   	$JDatabaseMySQL2->sql = "UPDATE items_coverpages SET `coverPage_item_Name`= '".$_REQUEST['covePageName']."', `coverPage_lines`= '".$_REQUEST['coverPagelines']."', `show`= '".$_REQUEST['show']."' WHERE `coverPage_item_id` in(".$coverPage_id.") ";
		
						  if($JDatabaseMySQL2->query()){
						  $isRun = 1;
						  }else{
						  $isRun = 2;
						  }
						  $result = array("isAction"=>$isRun,"test"=>$JDatabaseMySQL2->sql);
					 	  $result = json_encode($result);
 					      echo $result;

						}

}


function updatecurrentCoverPage1(){



$JDatabaseMySQL2 = new JDatabaseMySQL();


if(isset($_REQUEST['coverPage_id']) && $_REQUEST['coverPage_id'] > 0){
$coverPage_id = $_REQUEST['coverPage_id'];

$contentData = array();
$contentData['FB_show_key'] = mysql_real_escape_string($_REQUEST['FB_show']);
$contentData['FB_url_key'] = mysql_real_escape_string($_REQUEST['FB_url']);
$contentData['TW_show_key'] = mysql_real_escape_string($_REQUEST['TW_show']);
$contentData['twitter_url_key'] = mysql_real_escape_string($_REQUEST['twitter_url']);

$contentData = serialize($contentData);

	   	$JDatabaseMySQL2->sql = "UPDATE items_coverpages SET `coverPage_item_Name`= '".$_REQUEST['covePageName']."', `coverPage_lines`= '".$_REQUEST['coverPagelines']."', `show`= '".$_REQUEST['show']."', `coverPage_content`= '".$contentData."' WHERE `coverPage_item_id` in(".$coverPage_id.") ";
		
						  if($JDatabaseMySQL2->query()){
						  $isRun = 1;
						  }else{
						  $isRun = 2;
						  }
						  $result = array("isAction"=>$isRun,"test"=>$JDatabaseMySQL2->sql);
					 	  $result = json_encode($result);
 					      echo $result;

						}
}

function updatecurrentCoverPage3()
{	
$Editcontent = @$_REQUEST['edit_add'];
$JDatabaseMySQL2 = new JDatabaseMySQL();

if(isset($_REQUEST['coverPage_id']) && @$_REQUEST['coverPage_id'] > 0){
	$ItemcoverPage_id = $_REQUEST['coverPage_id'];

						$JDatabaseMySQL2->sql = "UPDATE items_coverpages SET `coverPage_item_Name`= '".$_REQUEST['covePageName']."', `coverPage_lines`= '".$_REQUEST['coverPagelines']."', `show`= '".$_REQUEST['show']."' WHERE `coverPage_item_id` in(".$ItemcoverPage_id.") ";
		
				if(isset($_REQUEST['covePageName']) && @$_REQUEST['content_name'] == 'undefined'){
					if($JDatabaseMySQL2->query()){
						$isRun = 1;
						  }
						else{
						  $isRun = 2;
						  }
						  $result = array("isAction"=>$isRun,"test"=>$JDatabaseMySQL2->sql);
						  $result = json_encode($result);
						  echo $result;
				
				}else{	
						if($Editcontent >0){
							$JDatabaseMySQL2->sql = "UPDATE itemcontent_coverpage SET content_name= '".$_REQUEST['content_name']."', content_dec= '".$_REQUEST['content']."' WHERE content_id= '".$Editcontent."' ";

						}else{
						$JDatabaseMySQL2->sql = "INSERT INTO itemcontent_coverpage (`content_name`,`content_dec`,`item_id`,`Actions`) VALUE('".$_REQUEST['content_name']."','".$_REQUEST['content']."','".$ItemcoverPage_id."','".$_REQUEST['show']."')";
						}		
								
							if($JDatabaseMySQL2->query()){	
									
							  $isRun = 1;
							  }
							else{
							  $isRun = 2;
							  }
							  $result = array("isAction"=>$isRun,"test"=>$JDatabaseMySQL2->sql);
							  $result = json_encode($result);
							  echo $result;
							  
					}
		}
}


function updatecurrentCoverPage4()
{	
$Editcontent = @$_REQUEST['edit_add'];
$JDatabaseMySQL2 = new JDatabaseMySQL();

if(isset($_REQUEST['coverPage_id']) && @$_REQUEST['coverPage_id'] > 0){
	$ItemcoverPage_id = $_REQUEST['coverPage_id'];

						$JDatabaseMySQL2->sql = "UPDATE items_coverpages SET `coverPage_item_Name`= '".$_REQUEST['covePageName']."', `coverPage_lines`= '".$_REQUEST['coverPagelines']."', `show`= '".$_REQUEST['show']."' WHERE `coverPage_item_id` in(".$ItemcoverPage_id.") ";
						
					if(isset($_REQUEST['covePageName']) && @$_REQUEST['newsTitle'] == 'undefined'){
					
					
					if($JDatabaseMySQL2->query()){
						$isRun = 1;
						  }
						else{
						  $isRun = 2;
						  }
						  $result = array("isAction"=>$isRun,"test"=>$JDatabaseMySQL2->sql);
						  $result = json_encode($result);
						  echo $result;
					
					}else{
					
					
							if($Editcontent != 0){
									$JDatabaseMySQL2->sql = "UPDATE itemcontent_coverpage SET content_name= '".$_REQUEST['newsTitle']."', content_dec= '".$_REQUEST['news']."' WHERE content_id= '".$Editcontent."' ";
		
								}else{
								//print_r($_REQUEST); die;
								$JDatabaseMySQL2->sql = "INSERT INTO itemcontent_coverpage (`content_name`,`content_dec`,`item_id`,`Actions`) VALUE('".$_REQUEST['newsTitle']."','".$_REQUEST['news']."','".$ItemcoverPage_id."','".$_REQUEST['show']."')";
								}		
								
							if($JDatabaseMySQL2->query()){	
									
							  $isRun = 1;
							  }
							else{
							  $isRun = 2;
							  }
							  $result = array("isAction"=>$isRun,"test"=>$JDatabaseMySQL2->sql);
							  $result = json_encode($result);
							  echo $result;
						  }	  
		}
}


function deleteNews()
					{
$contentID = @$_REQUEST['content_id'];
$JDatabaseMySQL2 = new JDatabaseMySQL();
			$JDatabaseMySQL2->sql = "delete FROM itemcontent_coverpage WHERE content_id  in(".$contentID.") ";
						  if($JDatabaseMySQL2->query()){
						  $isRun = 1;
						  }else{
						  $isRun = 2;
						  }
						  $result = array("isAction"=>$isRun,"test"=>$JDatabaseMySQL2->sql);
					 	  $result = json_encode($result);
 					      echo $result;
		}



function updatecurrentCoverPage5()
{	
$Editcontent = @$_REQUEST['edit_add'];
$JDatabaseMySQL2 = new JDatabaseMySQL();

if(isset($_REQUEST['coverPage_id']) && @$_REQUEST['coverPage_id'] > 0){
	$ItemcoverPage_id = $_REQUEST['coverPage_id'];

						$JDatabaseMySQL2->sql = "UPDATE items_coverpages SET `coverPage_item_Name`= '".$_REQUEST['covePageName']."', `coverPage_lines`= '".$_REQUEST['coverPagelines']."', `show`= '".$_REQUEST['show']."' WHERE `coverPage_item_id` in(".$ItemcoverPage_id.") ";
						
					if(isset($_REQUEST['covePageName']) && @$_REQUEST['linkTitle'] == 'undefined'){
					
					
					if($JDatabaseMySQL2->query()){
						$isRun = 1;
						  }
						else{
						  $isRun = 2;
						  }
						  $result = array("isAction"=>$isRun,"test"=>$JDatabaseMySQL2->sql);
						  $result = json_encode($result);
						  echo $result;
					
					}else{
					
					
							if($Editcontent != 0){
									$JDatabaseMySQL2->sql = "UPDATE itemcontent_coverpage SET content_name= '".$_REQUEST['linkTitle']."', content_dec= '".$_REQUEST['linkurl']."' WHERE content_id= '".$Editcontent."' ";
		
								}else{
								
								$JDatabaseMySQL2->sql = "INSERT INTO itemcontent_coverpage (`content_name`,`content_dec`,`item_id`,`Actions`) VALUE('".$_REQUEST['linkTitle']."','".$_REQUEST['linkurl']."','".$ItemcoverPage_id."','".$_REQUEST['show']."')";
								}		
								
							if($JDatabaseMySQL2->query()){	
									
							  $isRun = 1;
							  }
							else{
							  $isRun = 2;
							  }
							  $result = array("isAction"=>$isRun,"test"=>$JDatabaseMySQL2->sql);
							  $result = json_encode($result);
							  echo $result;
						  }	  
		}
}

function removelink()
					{
$contentID = @$_REQUEST['content_id'];
$JDatabaseMySQL2 = new JDatabaseMySQL();
			$JDatabaseMySQL2->sql = "delete FROM itemcontent_coverpage WHERE content_id  in(".$contentID.") ";
						  if($JDatabaseMySQL2->query()){
						  $isRun = 1;
						  }else{
						  $isRun = 2;
						  }
						  $result = array("isAction"=>$isRun,"test"=>$JDatabaseMySQL2->sql);
					 	  $result = json_encode($result);
 					      echo $result;
		}




function updatecurrentCoverPage6()
{
$JDatabaseMySQL2 = new JDatabaseMySQL();

if(isset($_REQUEST['coverPage_id']) && $_REQUEST['coverPage_id'] > 0){
$coverPage_id = $_REQUEST['coverPage_id'];

$contentData = array();
$contentData['message_key'] = mysql_real_escape_string($_REQUEST['message']);
$contentData['Address_key'] = mysql_real_escape_string($_REQUEST['Address']);
$contentData = serialize($contentData);


	   $JDatabaseMySQL2->sql = "UPDATE items_coverpages SET `coverPage_item_Name`= '".$_REQUEST['covePageName']."', `coverPage_lines`= '".$_REQUEST['coverPagelines']."', `show`= '".$_REQUEST['show']."', `coverPage_content`= '".$contentData."' WHERE `coverPage_item_id` in(".$coverPage_id.") ";
		
						  if($JDatabaseMySQL2->query()){
						  $isRun = 1;
						  }else{
						  $isRun = 2;
						  }
						  $result = array("isAction"=>$isRun,"test"=>$JDatabaseMySQL2->sql);
					 	  $result = json_encode($result);
 					      echo $result;

						}
	}


function updatecurrentCoverPage7()
{   
$config_var = new config();
$JDatabaseMySQL2 = new JDatabaseMySQL();
$show = @$_REQUEST['show'];
if(isset($_REQUEST['coverPage_id']) && @$_REQUEST['coverPage_id'] > 0){
$coverPage_id = $_REQUEST['coverPage_id'];
$randomNo = rand(5,20);

if($_FILES['Banner_Image']['name'] != ''){
$filename = $randomNo.'_'.$_FILES['Banner_Image']['name'];
}else{ $filename = ''; }

$tmp_name = @$_FILES['Banner_Image']['tmp_name'];
$location = $config_var->UPLOAD_ROOT.'user/original/'.$filename;

if(move_uploaded_file($tmp_name,$location)){  }

$contentData = array();
$contentData['bannerlink_key'] = mysql_real_escape_string(@$_REQUEST['Banner_Link']);
$contentData['Image_key'] = $filename;
$contentData = serialize($contentData);


	   $JDatabaseMySQL2->sql = "UPDATE items_coverpages SET `coverPage_item_Name`= '".@$_REQUEST['CoverPage_name']."', `coverPage_lines`= '".@$_REQUEST['coverPage_lines']."', `show`= '$show', `coverPage_content`= '".$contentData."' WHERE `coverPage_item_id` in(".$coverPage_id.") "; 
		
						  if($JDatabaseMySQL2->query()){
						 @header('Location:'.$config_var->USER_URL.'index.php?mod=mod_blogSetting&view=default&m=1&s=6');
                           
						  }else{ 
						  @header('Location:'.$config_var->USER_URL.'index.php?mod=mod_blogSetting&view=default&m=1&r=6');
						  }
						}
}


function updatecurrentCoverPage8()
{
$JDatabaseMySQL2 = new JDatabaseMySQL();

if(isset($_REQUEST['coverPage_id']) && $_REQUEST['coverPage_id'] > 0){
$coverPage_id = $_REQUEST['coverPage_id'];


$contentData = array();
$contentData['customContent_key'] = mysql_real_escape_string($_REQUEST['custom_Content']);
$contentData = serialize($contentData);


	   $JDatabaseMySQL2->sql = "UPDATE items_coverpages SET `coverPage_item_Name`= '".$_REQUEST['covePageName']."', `coverPage_lines`= '".$_REQUEST['coverPagelines']."', `show`= '".$_REQUEST['show']."', `coverPage_content`= '".$contentData."' WHERE `coverPage_item_id` in(".$coverPage_id.") ";
		
						  if($JDatabaseMySQL2->query()){
						  $isRun = 1;
						  }else{
						  $isRun = 2;
						  }
						  $result = array("isAction"=>$isRun,"test"=>$JDatabaseMySQL2->sql);
					 	  $result = json_encode($result);
 					      echo $result;

						}
	}




?>


<?php 

function get_addRightColHtml(){ ?>

	<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <!--<tr>
            <th valign="top">Position<span class="red">*</span> :</th>
            <td>
            <input type="h" name="column_position" value="right" checked="checked"   id="column_position"/>
            &nbsp;Right</td>
          </tr>-->
          
           <input type="hidden" name="column_position" value="right" id="column_position"/>
           <tr>
                 <th valign="top">Name<span class="red">*</span> :</th>
                <td><input type="text"  name="column_name"  id="blockname" value="" maxlength="70" class="textbox"  style="width:400px;"/></td>
            </tr>
         <tr>
         <tr>
                 <th valign="top">Content :</th>
                <td><textarea style="width:400px;height:120px;" id="blockContent"></textarea></td>
            </tr>
             <tr>
                 <th valign="top">Activate :</th>
                <td><input type="checkbox"  value="" checked="checked" id="active_column"></textarea></td>
            </tr>
         <tr>
         
            <th>&nbsp;</th>
            <td valign="top">
                
                <input type="hidden" name="mod" value="mod_blog"  />
                <input type="button" value="" class="form-submit"  name="button" onclick="saveColumn();" style="cursor:pointer;"/>
                <input type="button" value="" class="form-reset"  onclick="window.location.href='./?mod=mod_blogSetting&view=default&m=1'"  style="cursor:pointer;"/>
            </td>
            </tr>
        </table>
<?php }

function get_editdata($columnid){


$JDatabaseMySQL2 = new JDatabaseMySQL();
						  $JDatabaseMySQL2->sql = "select * from mgl_blog_column as a LEFT JOIN mgl_block_content as b on a.column_id=b.user_block_id where a.column_id=".$columnid;
						  if($JDatabaseMySQL2->query()){
						  $isRun = 1;
						 
						  }else{
						  $isRun = 2;
						  }
						  $result = mysql_query($JDatabaseMySQL2->sql);
						  $row = mysql_fetch_array( $result );


					 	  
 					      return $row;
}						  

function quaterly()
{
?>
      				<select  class="selectbox" name="quarter" id="quarter" style="width:100%;padding:3px 0 0 6px;"  >
                    <option value="0" >Select Quarter</option>
                    <option value="1" >First Quarter</option>
                    <option value="2" >Second Quarter</option>
                    <option value="3" >Third Quarter</option>
                    <option value="4" >Fourth Quarter</option>
                    </select> 
<?php
}

function halfyearly()
{
?>
<select  class="selectbox" name="selecthalf" id="selecthalf" style="width:100%;padding:3px 0 0 6px;"  >
                    <option value="0" >Select Half</option>
                      <option value="1">First Half</option>
                        <option value="2">Second Half</option>
                    </select>
<?php
}
?>






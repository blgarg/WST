<?php 
global $config_var;  
global $DataSet;
global $model;
//config URL 

if((isset($_SESSION['user_Id']))&&(@$_SESSION['user_Id'] != '')){ 
	$user_id = (int)@$_SESSION['user_Id']; 
	$CatDb_OB = new JDatabaseMySQL();
	$CatDb_OB->sql = "SELECT * FROM admin WHERE user_id = '$user_id'";
	$CatDb_OB->query();
	$PAGE_SEC_SET = $CatDb_OB->getArray();
	
	$model_editAdmin = new model_users_editadmin();
	$userdata = $model_editAdmin->getUserData($user_id);

   
   
  
}          


?>

<!--  start content-table-inner ...................................................................... START -->
	<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_users&view=editadmin&d=3" method="post" id="adddUserFrm" name="adddUserFrm" enctype="multipart/form-data" >
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top" >
    <td align="left">
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
          
          
          
          <tr>
            <th valign="top">Current Password :</th>
            <td><input type="password"  name="password"  id="password" class="textbox" value="" maxlength="25" autocomplete="off"/></td>
          </tr>
          
            <tr>
            <th valign="top">New Password :</th>
            <td><input type="password"  name="npassword"  id="npassword" class="textbox" value="" maxlength="25" autocomplete="off"/></td>
          </tr>
           
           <tr>
            <th valign="top">Confirm Password :</th>
            <td><input type="password"  name="cpassword"  id="cpassword" class="textbox" value="" maxlength="25" autocomplete="off"/></td>
          </tr>
          
          

        
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                  <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id ;?>"  />
                  
                <input type="hidden" name="controller" value="edit_admin"  />
                <input type="hidden" name="mod" value="mod_users"  />
                <input type="button" value="Update" title="Update"  name="button" onclick="checkEditAdmin();" style="cursor:pointer;width:70px;height:30px;"/>
				<a href = "./index.php??mod=mod_dashboard&d=1" title="Cancel" ><input type="button" value="Cancel" name="button_cancel" style="cursor:pointer;width:70px;height:30px;" /></a>
				
              </td>
            </tr>
        </table>
      
	<!-- end id-form  -->

	</td>
	<td align="left">

	<!--  start related-activities -->
    
    <div id="related-activities">
		
		<?php /*<div id="related-act-top">
		<a href="#"  id="Categories_top" style="cursor:text">RECENT USERS </a>
        </div>
		<div id="related-act-bottom">
		
			<div id="related-act-inner" style="float:left">
			 		<ul>
					<?php 
						  $JDatabaseMySQL = new JDatabaseMySQL();
						 $JDatabaseMySQL->sql = "SELECT * FROM mgl_users WHERE user_role != 'admin' ORDER BY user_id DESC LIMIT 0,10";
						  $JDatabaseMySQL->query();
						  $users = $JDatabaseMySQL->loadAssoc();
						 for($i=0;$i<count($users); $i++){
						 $userName= $users[$i]['user_firstname'].' '.$users[$i]['user_lastname'];
						 if(strlen($userName)>50){
						 $userName=substr($userName,0,50).'....';
						 }
						 ?>
					
                   
							<li><div id="cat_name" class="breakword"><a href="?mod=mod_users&view=detailUser&user_id=<?php echo $users[$i]['user_id']; ?>&d=2"><?php  echo ucfirst(@$userName);?></a></div></li> 
                        
                         <?php } ?>                  
										                      
					</ul>
				</div>
				
			</div>
			<div class="clear"></div> */ ?>
		
		</div>
        
	<!-- End related activities -->
		
</td>
</tr>
<tr>
<td><img src="<?php echo $config_var->ADMIN_TPL_URL;?>/images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
<td></td>
</tr>
</table>
 </form> 
 
<div class="clear"></div>
 

</div>
		
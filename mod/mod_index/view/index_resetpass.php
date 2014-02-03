<script type="text/javascript">
function valid(){
if($('.errorMsg')){
$('.errorMsg').hide();
$('.server_succ').hide();
}
}
</script>
<?php
global $config_var;
if(isset($_SESSION['error']) && $_SESSION['error']=='Wrong URL')
{
	$_SESSION['error']= "The link has either expired or used already.";
	echo '<br><p style="text-align:center!important;color:#ff0000;">The link has either expired or used already.</p>';
	unset($_SESSION['error']);
	//die;
}
else
{
?>
<!--Content Text-->
    	<div class="content-txt">
        	<form method="post" action="?mod=mod_index&view=resetpass&id=<?php echo $_REQUEST['id']; ?>&reset=<?php echo $_REQUEST['reset']; ?>&s=5" id="resetpass" autocomplete="off">
            <input type="hidden" id="controller" name="controller" value="resetpass" />
			<input type="hidden" id="mod" name="mod" value="mod_index" />
			<input type="hidden" id="view" name="view" value="resetpass" />
			
            	<div class="inner-hdr"  style="width: 1000px; padding-bottom: 15px; padding-top: 15px; margin-left: -20px;">
				<img src="<?php echo $config_var->WEB_TPL_URL;?>images/chanagepass.png" alt="" />
				</div>
				<div class="login-outer">
				<?php if(isset($_SESSION['succ']) && $_SESSION['succ']!=""){?>
					<span class="server_succ"><?php echo $_SESSION['succ'];?></span>
				<?php $_SESSION['succ']="";unset($_SESSION['succ']);}
				else if(isset($_SESSION['error']) && $_SESSION['error']!=""){?>
				<span class="errorMsg"><?php echo @$_SESSION['error'];?></span>
				<?php $_SESSION['error']="";unset($_SESSION['error']);} ?>
				
                <?php if(isset($error) && $error!=""){?>
					<div class="errorMsg"><?php echo $error;?></div>
				<?php $error="";}?>
				<input type="hidden" id="id" name="id" value="<?php echo $_REQUEST['id']; ?>" />
			<table width="100%" border="0" cellspacing="0" cellpadding="10">
                  <tr>
                    <td width="200" align="Left">New Password :</td>
                    <td><input type="password" id="new_password" onfocus="valid()" minlength="6" maxlength="20" name="new_password" value=""  /></td>
                  </tr>
				   <tr>
                    <td width="200" align="Left">Confirm New Password :</td>
                    <td><input  type="password" maxlength="20" onfocus="valid()" id="confirm_new_password" name="confirm_new_password" value="" /></td>
                  </tr>
                   <tr>
                    <td width="200" align="right">&nbsp;</td>
                    <td><input type="submit" value="Submit" class="grey-btn" title="Submit"/>
					
					</td>
                  </tr>
                </table>
                
            </div>
			</form>
        </div>
		<?php }?>
        <!--//Content Text-->
 </div>
     <!--//ConTent-->
	
<div class="clr"></div>    
</div>
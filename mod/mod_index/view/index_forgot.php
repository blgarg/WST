<script type="text/javascript">
function valid(){
if($('.server_error')){
$('.server_error').hide();
$('.server_succ').hide();
}
}
</script>
<?php
global $config_var;
$model_index_forgot = new model_index_forgot();
?>
<!--Content Text-->
    	<div class="content-txt">
		<div class="inner-hdr"  style="width: 1000px; padding-bottom: 15px; padding-top: 15px; margin-left: -20px;">
				<img src="<?php echo $config_var->WEB_TPL_URL;?>images/forgotpass.png" alt="" />
				</div>
        	<form method="post" action="?mod=mod_index&view=forgot&s=5" id="forogt">
            <input type="hidden" id="controller" name="controller" value="forgot" />
			<input type="hidden" id="mod" name="mod" value="mod_index" />
			<input type="hidden" id="view" name="view" value="forgot" />
		
            	

                	
               <div class="login-outer">
			   <table width="100%" border="0" cellspacing="0" cellpadding="10">
			   <tr><td colspan="2" align="center" ><?php if(isset($_SESSION['error']) && $_SESSION['error']!=""){?>
				<span class="server_error"><?php echo @$_SESSION['error'];?></span>
				<?php $_SESSION['error']="";unset($_SESSION['error']);}?>
                  </td></tr>
				  <tr>
                    <td width="390" align="right">Email ID<span style="color:red;">*</span>:</td>
                    <td><input type="text" name="email" value="" onfocus="valid();" id="email" /></td>
                  </tr>
                 
                   <tr>
                    <td width="390" align="right">&nbsp;</td>
                    <td>
					<input type="submit" value="Submit" id="btn_submit" name="btn_submit" class="grey-btn" title="Submit"/>
					<a href="?mod=mod_index&view=login&s=5"><input type="button" value="Cancel" id="cancel_submit" name="cancel_submit" class="grey-btn" title="Cancel"/></a>
					</td>
                  </tr>
                </table>
                
            </div>
			</form>
        </div>
        <!--//Content Text-->
	 </div>
     <!--//ConTent-->
	
<div class="clr"></div>    
</div>
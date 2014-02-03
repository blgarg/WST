<?php global $config_var;?>
<!--Content Text-->
    	<div class="content-txt">
		<div class="inner-hdr"  style="width: 1000px; padding-bottom: 15px; padding-top: 15px; margin-left: -20px;">
				<img src="<?php echo $config_var->WEB_TPL_URL;?>images/contactus.png" alt="" />
				</div>
        	<form method="post" action="?mod=mod_index&view=contactus" id="contactus">
            <input type="hidden" id="controller" name="controller" value="contactus" />
			<input type="hidden" id="mod" name="mod" value="mod_index" />
			<input type="hidden" id="view" name="view" value="contactus" />
		 <div class="login-outer">
			   <table width="100%" border="0" cellspacing="0" cellpadding="10">
			  <tr><td colspan="2" align="center" >
				<?php if(isset($_SESSION['succ']) && $_SESSION['succ']!=""){?>
					<span class="server_succ"><?php echo $_SESSION['succ'];?></span>
				<?php $_SESSION['succ']="";unset($_SESSION['succ']);}
				else if(isset($_SESSION['error']) && $_SESSION['error']!=""){?>
				<span class="server_error"><?php echo @$_SESSION['error'];?></span>
				<?php $_SESSION['error']="";unset($_SESSION['error']);} ?>
                  </td></tr>
				  <tr>
                    <td width="390" align="right">Your Name<span style="color:red;">*</span>:</td>
                    <td><input type="text" name="yname" value="" onfocus="valid();" id="yname" maxlength="50" /></td>
                  </tr>
                  <tr>
                    <td width="390" align="right">Email ID<span style="color:red;">*</span>:</td>
                    <td><input type="text" name="email" value="" onfocus="valid();" id="email" maxlength="80"/></td>
                  </tr>
				  <tr>
                    <td width="390" align="right">Subject<span style="color:red;">*</span>:</td>
                    <td><input type="text" name="subject" value="" onfocus="valid();" id="subject" maxlength="30" /></td>
                  </tr>
				  <tr>
                    <td width="390" align="right">Message:</td>
                    <td><textarea name="message" value=""id="message" cols="27" rows="6"></textarea>
					</td>
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
  <div class="clr"></div>    
  



<?php 
global $config_var;  
global $DataSet;
 ?>
<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
				<!--  start message-green -->
				<div id="message-green" style="margin-top:-20px;">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="green-left"><img src="<?php echo $config_var->ADMIN_TPL_URL;?>images/shared/success.png"   alt=""  />&nbsp;Product added sucessfully. <a href="">Add new one.</a></td>
					<td class="green-right"><a class="close-green"><img src="<?php echo $config_var->ADMIN_TPL_URL;?>images/table/icon_close_green.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div>
				<!--  end message-green -->
			<!--  Grid -box ............................................... -->
			<div  style="margin-left:0px;margin-bottom:10px;width:100%;">
			<table border="0" cellpadding="0" cellspacing="0" align="left">
			<tr>
			<td valign="top">
			<select  class="styledselect" >
			<option value="">Status</option>
			<option value="">Activated</option>
			<option value="">Deactivated</option>
			</select> 
			</td>
			<td valign="top">
			<select  class="styledselect" >
			<option value="">Status</option>
			<option value="">Activated</option>
			<option value="">Deactivated</option>
			</select> 
			</td>
			<td valign="top">
			<select  class="styledselect" >
			<option value="">Status</option>
			<option value="">Activated</option>
			<option value="">Deactivated</option>
			</select> 
			</td>
			</tr>
			</table>
			
			<table border="0" cellpadding="0" cellspacing="0" align="left">
			<tr>
			<td valign="top"><input type="text" value="Search" onblur="if (this.value=='') { this.value='Search'; }" onfocus="if (this.value=='Search') { this.value=''; }" class="top-search-inp" /></td>
			<td>&nbsp;</td>
			<td valign="top">
			<input type="button"  class="button_r"   value="Search" />
			</td>
			</tr>
			</table>
			
			<table border="0" cellpadding="0" cellspacing="0" align="right">
			<tr>
			<td valign="top"> <?php print $DataSet['nav'];?></td>
			</tr>
			</table>
			
			<div class="clear"></div>
			</div>
			<!-- end  Grid -box........... -->
			
	
			
		
				<!--  start product-table ..................................................................................... -->
				<form id="mainform" action="">
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					<th class="table-header-check"><a id="toggle-all" ></a> </th>
					<th class="table-header-repeat line-left"><a href="">Last Name</a>	</th>
					<th class="table-header-repeat line-left "><a href="">First Name</a></th>
					<th class="table-header-repeat line-left"><a href="">Email</a></th>
					<th class="table-header-repeat line-left"><a href="">Due</a></th>
					<th class="table-header-options line-left"><a href="">Options</a></th>
				</tr>
				<?php 
				      $Pages  =  $DataSet['result'];
				
				for($i = 0;$i<count($Pages);$i++){	?>
				<tr <?php if($i%2==0){?>class="alternate-row"<?php } ?>>
					<td><input  type="checkbox" name="page_id" value="<?php echo $Pages["$i"]['ID'];?>"/></td>
					<td><?php echo $Pages["$i"]['post_title'];?></td>
					<td><?php echo $Pages["$i"]['post_date'];?></td>
					<td width="200"><?php echo $Pages["$i"]['guid'];?></td>
					<td width="200"><?php echo $Pages["$i"]['post_content'];?></td>
					<td class="options-width">
					<a href="" title="Edit" class="icon-1 info-tooltip"></a>
					<a href="" title="Edit" class="icon-2 info-tooltip"></a>
					<a href="" title="Edit" class="icon-3 info-tooltip"></a>
					<a href="" title="Edit" class="icon-4 info-tooltip"></a>
					<a href="" title="Edit" class="icon-5 info-tooltip"></a>
					</td>
				</tr>
				<?php  }?>
				
				
				
				
				
				</table>
				<!--  end product-table................................... --> 
				</form>
			</div>
			<!--  end content-table  -->
		    <?php print $DataSet['nav'];?>
			
			
			<!--  start paging..................................................... -->
			
			<!--  end paging................ -->
			
			
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
		
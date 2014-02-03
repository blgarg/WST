<?php 
global $config_var;  
global $model;
global $DataSet;
 ?>
      
        <div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
			<!--  Grid -box ............................................... -->
			<div  style="margin-left:0px;margin-bottom:10px;width:100%;">
			<form id="form1" name="form1" method="post" action="">
			  <table width="100%" border="0" style="color:#000;font-size:22px;font-weight:bold;">
                <tr>
                  <td><div align="center" style="padding:20px 0px 20px 0px;"><a href="<?php echo $config_var->ADMIN_URL."?mod=mod_reports&view=saleReport&m=6&d=13";?>"><?php echo GENERATESALEBOOKREPORT2;?></a></div></td>
                  <td><div align="center" style="padding:20px 0px 20px 0px;"><a href="<?php echo $config_var->ADMIN_URL."?mod=mod_reports&view=publicationbook&m=6&d=13";?>"><?php echo GENERATEPUBLISHBOOKREPORT2;?></a></div></td>
                </tr>
                <tr>
                  <td><div align="center" style="padding:20px 0px 20px 0px;"><a href="<?php echo $config_var->ADMIN_URL."?mod=mod_reports&view=grantRecieved&m=6&d=13";?>"><?php echo GENERATEGRANTREPORT2;?></a></div></td>
                  <td><div align="center" style="padding:20px 0px 20px 0px;"><a href="<?php echo $config_var->ADMIN_URL."?mod=mod_reports&view=reprintedbook&m=6&d=13";?>"><?php echo GENERATEBOOKSREPRINTEDREPORT2;?></a></div></td>
                </tr>
                <tr>
                  <td><div align="center" style="padding:20px 0px 20px 0px;"><a href="<?php echo $config_var->ADMIN_URL."?mod=mod_reports&view=issuebook&m=6&d=13";?>"><?php echo GENERATEBOOKSISSUEREPORT2;?></a></div></td>
                  <td><div align="center" style="padding:20px 0px 20px 0px;"><a href="<?php echo $config_var->ADMIN_URL."?mod=mod_reports&view=giftbook&m=6&d=13";?>"><?php echo GENERATEBOOKSGIFTREPORT2;?></a></div></td>
                </tr>
                <tr>
                  <td><div align="center" style="padding:20px 0px 20px 0px;"><a href="<?php echo $config_var->ADMIN_URL."?mod=mod_reports&view=agents&m=6&d=13";?>"><?php echo GENERATESALEREPRESENTTATIVEREPORT;?></a></div></td>
                  <td><div align="center" style="padding:20px 0px 20px 0px;"><a href="<?php echo $config_var->ADMIN_URL."?mod=mod_reports&view=writers&m=6&d=13";?>"><?php echo GENERATEWRITERSREPORT;?></a></div></td>
                </tr>
                
                <tr>
                  
                  <td><div align="center" style="padding:20px 0px 20px 0px;"><a href="<?php echo $config_var->ADMIN_URL."?mod=mod_reports&view=pendingReport&m=6&d=13";?>"><?php echo GENERATEPENDINGPAYMENTREPORT;?></a></div></td>
                  
                  <td><div align="center" style="padding:20px 0px 20px 0px;"><a href="<?php echo $config_var->ADMIN_URL."?mod=mod_reports&view=ledgerReport&m=6&d=13";?>"><?php echo GENERATELEDGERREPORT;?></a></div></td>
                  
                </tr>
				<tr>
                  
                  <td><div align="center" style="padding:20px 0px 20px 0px;"><a href="<?php echo $config_var->ADMIN_URL."?mod=mod_reports&view=loanReport&m=6&d=13";?>"><?php echo GENERATE_L_O_R;?></a></div></td>
                  
                  <td><div align="center" style="padding:20px 0px 20px 0px;"><a href="<?php echo $config_var->ADMIN_URL."?mod=mod_reports&view=cashReport&m=6&d=13";?>"><?php echo GENERATE_C_O_R;?></a></div></td>
                  
                </tr>
				<tr>
                  
                  <td><div align="center" style="padding:20px 0px 20px 0px;"><a href="<?php echo $config_var->ADMIN_URL."?mod=mod_reports&view=publishreprintReport&m=6&d=13";?>"><?php echo GENERATE_P_R_R;?></a></div></td>
                  
                  <td></td>
                  
                </tr>
                
              </table>
                        </form>
			<div class="clear"></div>
			</div>
		  <!-- end  Grid -box........... -->
			
	
			
		
				<!--  start product-table ..................................................................................... -->
				
		  </div>
			<!--  end content-table  -->
	
			
			
			<!--  start paging..................................................... -->
			
			<!--  end paging................ -->
			
			
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
		
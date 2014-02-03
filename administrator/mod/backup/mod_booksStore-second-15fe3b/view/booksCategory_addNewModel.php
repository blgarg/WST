<?php 
global $config_var;  
global $DataSet;


// Create class instance.

/*$modelName =$date =$month =$year =$Birthplace =$Stats =$Country =$Deceased =$Photographer =$images =$death='';
if(isset($_REQUEST['modelName']) && $_REQUEST['modelName']!=''){
	
	$modelName = $_REQUEST['modelName'];
}
if(isset($_REQUEST['model_lname']) && $_REQUEST['model_lname']!=''){
	
	$modellname = $_REQUEST['model_lname'];
}

if(isset($_REQUEST['model_appeared']) && $_REQUEST['model_appeared']!=''){
	
	$modelappeared = $_REQUEST['model_appeared'];
}

if(isset($_REQUEST['date']) && $_REQUEST['date']!=''){
	
	$date = $_REQUEST['date'];
}

if(isset($_REQUEST['month']) && $_REQUEST['month']!=''){
	
	$month = $_REQUEST['month'];
}
if(isset($_REQUEST['year']) && $_REQUEST['year']!=''){
	
	$year = $_REQUEST['year'];
}

if(isset($_REQUEST['Stats']) && $_REQUEST['Stats']!=''){
	
	$Stats = $_REQUEST['Stats'];
}
if(isset($_REQUEST['Country']) && $_REQUEST['Country']!=''){
	
	$Country = $_REQUEST['Country'];
}
if(isset($_REQUEST['Deceased']) && $_REQUEST['Deceased']!=''){
	
	$Deceased = $_REQUEST['Deceased'];
}
if(isset($_REQUEST['Photographer']) && $_REQUEST['Photographer']!=''){
	
	$Photographer = $_REQUEST['Photographer'];
}
if(isset($_REQUEST['images']) && $_REQUEST['images']!=''){
	
	$images = $_REQUEST['images'];
}
if(isset($_REQUEST['CauseDeath']) && $_REQUEST['CauseDeath']!=''){
	
	$death = $_REQUEST['CauseDeath'];
}*/



/*$model_cms_addNewModel = new model_cms_addNewModel();
$countryList = $model_cms_addNewModel->countryList($_REQUEST); */
?>


<style>
.DOB{ height: 25px;
	font-size:14px;
	padding:0px 0px 0px 6px;
	border: 1px solid #d7d7d7;
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;
	border-radius: 8px;
	line-height:24px; }
	.inputField{ height: 25px;
	font-size:14px;
	padding:0px 0px 0px 6px;
	border: 1px solid #d7d7d7;
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;
	border-radius: 8px;
	line-height:24px; }
	.stats{ height: 25px;
	font-size:14px;
	padding:0px 0px 0px 6px;
	border: 1px solid #d7d7d7;
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;
	border-radius: 8px;
	line-height:24px; }
	
</style>

<!--  start content-table-inner ...................................................................... START -->
	<div id="content-table-inner" class="Add_New_Web_Page">
	 <form action="./index.php?mod=mod_cms&view=addNewPage&m=1" method="post" id="addmodelFrm" name="addmodelFrm" enctype="multipart/form-data"  onSubmit="return checkAddmodel();" >
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
   <td style="width:73%">
    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
            <tr>
                <th valign="top">Fisrt Name<span class="red">*</span> :</th>
                <td><input type="text"  name="modelName" value="<?php echo $modelName; ?>"  id="modelName" maxlength="50" class="textbox"/></td>
            </tr>
            <tr>
                <th valign="top">Last Name<span class="red">*</span> :</th>
                <td><input type="text"  name="model_lname" value="<?php echo $modellname; ?>"  id="model_lname" maxlength="50" class="textbox"/></td>
            </tr>
            
          
           <tr>
            <th valign="top">Birth Date <span class="red">*</span>:</th>
            <td><input type="text" readonly="readonly" name="d_b_o" value="<?php echo $date; ?>"  id="DOB_datepicker" maxlength="12" size="12" class="DOB" /></td>
           </tr>
           <!--<tr>
                <th valign="top">Place of Birth <span class="red">*</span>:</th>
                <td><input type="text"  name="Birthplace"  id="Birthplace" value="<?php //echo $Birthplace; ?>" maxlength="50" class="textbox"/></td>
            </tr>-->
        <tr>
             
                <th valign="top">Stats <span class="red">*</span>:</th>
                <td>
                <input type="text" name="Stats_height" value="<?php echo $Stats; ?>"id="Stats_height" maxlength="8" size="8" class="DOB" /><strong><span style="color:#999999"> height(5'4 1/4")</span></strong>
                <input type="text" name="Stats_weight"   id="Stats_weight" maxlength="7" size="7" class="DOB" /><strong><span style="color:#999999"> weight(128 lbs)</span></strong>
                <input type="text" name="Stats_measurement"   id="Stats_measurement" maxlength="15" size="15" class="DOB" />
                <strong><span style="color:#999999"> measurement(32-23-32.2)</span></strong></td>
            </tr>
       <tr>
                <th valign="top">Country <span class="red">*</span>:</th>
                <td><select  name="Country"  id="Country" class="selectbox"/>
                    <option value="0">Select Country</option>
                    <?php for($i=0;$i<count($countryList);$i++){ ?>
                    <option value="<?php echo $countryList[$i]['name']; ?>"><?php echo $countryList[$i]['name']; ?></option>
                    <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th valign="top">Appeared Date<span class="red">*</span> :</th>
                <td>
                <?php include_once $config_var->LIB_WEB_ROOT.'Helper.php'; $monthobj = Helper::getMonths(); ?>
                <select  name="appear_month" id="appear_month" class="DOB" style="width:70px;" ><?php echo $monthobj; ?></select> &nbsp;&nbsp;
                
                <input type="text" name="appear_year" id="appear_year"  maxlength="4" size="5" class="DOB" onblur="checkModelAppeard(this.value);" />
                &nbsp;<strong><span style="color:#999999">&nbsp;Example: month , year</span></strong></td>
            </tr>
            
                 
        <tr>
                <th valign="top">Deceased Date:</th>
                <td>
                <input type="text" readonly="readonly" name="Deceased" value="<?php echo $date; ?>"  id="Deceased_datepicker" maxlength="12" size="12" class="DOB" />
            
                </td>
            </tr>    
        <tr>
                <th valign="top">Photographer :</th>
                <td><input type="text" value="<?php echo $Photographer; ?>"  name="Photographer"  id="Photographer" maxlength="50" class="textbox"/></td>
            </tr>
          <tr>
        <tr>
                <th valign="top">Cause of death :</th>
                <td><textarea name="CauseDeath"  id="CauseDeath" ><?php echo $death; ?></textarea></td>
            </tr>  
          
            <th valign="top">Model Images :</th>
            <td><!--<p><label style="color:#999999;">Multiple Image uploading</label><br />
             <input type="file" name="images[]" class="multi" accept="gif|jpg|bmp|png|gif"  /></p>-->
             hdpi image (480*800) &nbsp;&nbsp;<input type="file" name="imagehdpi_800"  accept="gif|jpg|png|gif"  /><br /><br />
             shdpi image (480*854) <input type="file" name="imagehdpi_854"  accept="gif|jpg|png|gif"  /><br /><br />
             ldpi image (240*320) &nbsp;&nbsp;&nbsp;<input type="file" name="imageldpi"  accept="gif|jpg|png|gif"  /><br /><br />
             mdpi image (320*480) &nbsp;<input type="file" name="imagemdpi"  accept="gif|jpg|png|gif"  /><br /><br />
             xhdpi Image (600*1024) <input type="file" name="imagetab"  accept="gif|jpg|png|gif"  /><br /><span style="color:#999999"><strong>Allowed Images Formats</strong> : jpg,png,gif</span></td>
          </tr>
        <tr>
            <th>&nbsp;</th>
            <td valign="top">
                <input type="hidden" name="controller" value="add_new_cms"  />
                <input type="hidden" name="mod" value="mod_cms"  />
                <input type="button" value="" class="form-submit"  name="button" onclick="checkAddmodel();" style="cursor:pointer;"/>
                <input type="button" value="" class="form-reset"  onclick="window.location.href='./?mod=mod_cms&view=default&m=1'"  style="cursor:pointer;"/>
            </td>
            </tr>
        </table>
      
	<!-- end id-form  -->

	</td>
	<td align="left">

	<!--  start related-activities -->
	<?php /*<div id="related-activities">
		
		<!--  start related-act-top -->
		<div id="related-act-top">
		<a href="#"  id="Categories_top"  style="cursor:text">Latest Model</a>
        </div>
		<!-- end related-act-top -->
		
		<!--  start related-act-bottom -->
		<div id="related-act-bottom">
		
			<!--  start related-act-inner -->
			<div id="related-act-inner" style="float:left">
			 		<?php 
						  $JDatabaseMySQL = new JDatabaseMySQL();
						  $JDatabaseMySQL->sql = "SELECT * FROM mgl_models order by model_id DESC limit 10";
						  $JDatabaseMySQL->query();
						  $latestModel = $JDatabaseMySQL->loadAssoc();
						  ?>
					<ul>
                    <?php   $j = 0;
					        for($i=0;$i<count($latestModel);$i++): $j++;?>
							<li><div id="checkbox"><?php echo @$j;?></div>
                            <div id="cat_name" class="breakword">
							<!--<a href="./?mod=mod_cms&view=ViewBanner&m=1&bannerId=<?php //echo $latestBanners[$i]['model_id'];?>">-->
							<?php if(strlen(@$latestModel[$i]['model_name']) >50){ echo ucfirst(substr(@$latestModel[$i]['model_name'],0,50))."...";}else{ echo @ucfirst($latestModel[$i]['model_name']);}?>
                            <!--</a>-->
                            </div>
                            </li> 
                        
                                           
					<?php endfor; ?>						                      
					</ul>
				</div>
				
			</div>
			<!-- end related-act-inner by Rohit kundal -->
			<div class="clear"></div>
		
		</div> */?>
		
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
		
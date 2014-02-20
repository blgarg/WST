<?php 
global $config_var;
global $mdb;
global $Controller;
global $toolBar;
$userInfo = new userInfo();
$Session = new session();
$userInfo->userId= $Session->getSessionVar('user_Id');
$userData = $userInfo->getUserInfo();
$globalsettings = $userInfo->getGlobalSettings();
$site = new site(); 

 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $config_var->title;?></title>
<link rel="shortcut icon" href="./template/system/images/favicon.ico">
<link rel="stylesheet" href="./template/system/css/screen.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="./template/system/css/progressbar.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="./template/system/css/cms.css" type="text/css" media="screen" title="default" />


<!--[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
<![endif]-->
<!--  jquery core -->

<script src="./template/system/js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>
<script src="<?php echo $config_var->ADMIN_TPL_URL;?>js/jquery.form.js"></script> 
<?php if(isset($common_js)){?>
<script src="<?php print $common_js;?>" type="text/javascript"></script>
<?php } ?>
<?php if(function_exists('mod_js'))echo mod_js();?>
<!-- Player script -->


<script src="<?php echo $config_var->WEB_TPL_URL?>js/jwplayer.js" type="text/javascript"></script>

<script type="text/javascript">jwplayer.key="PchTp4SnN301Y51Iq9BKg4AlaYESNxPDnT7COA==";</script>

<!-- End Player script  -->
<!--  checkbox styling script -->
<script src="./template/system/js/jquery/jquery.bind.js" type="text/javascript"></script>




<!--  styled select box script version 1 -->
<script src="./template/system/js/jquery/jquery.selectbox-0.5.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect').selectbox({ inputClass: "selectbox_styled" });
});
</script>
 



<!--  styled select box script version 2 --> 
<script src="./template/system/js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect_form_1').selectbox({ inputClass: "styledselect_form_1" });
	$('.styledselect_form_2').selectbox({ inputClass: "styledselect_form_2" });
});
</script>

<!--  styled select box script version 3 --> 
<script src="./template/system/js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect_pages').selectbox({ inputClass: "styledselect_pages" });
});
</script>

<!--  styled file upload script --> 
<script src="./template/system/js/jquery/jquery.filestyle.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
  $(function() {
      $("input.file_1").filestyle({ 
          image: "./template/system/images/forms/choose-file.gif",
          imageheight : 21,
          imagewidth : 78,
          width : 310
      });
  });
</script>

<!-- Custom jquery scripts -->
<script src="./template/system/js/jquery/custom_jquery.js" type="text/javascript"></script>
 
<!-- Tooltips -->
<script src="./template/system/js/jquery/jquery.tooltip.js" type="text/javascript"></script>
<script src="./template/system/js/jquery/jquery.dimensions.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$('a.info-tooltip ').tooltip({
		track: true,
		delay: 1,
		fixPNG: true, 
		showURL: false,
		showBody: " - ",
		top: -30,
		left: -100
	});
});
</script> 


<!--  date picker script -->
<link rel="stylesheet" href="./template/system/css/datePicker.css" type="text/css" />
<script src="./template/system/js/jquery/date.js" type="text/javascript"></script>
<script src="./template/system/js/jquery/jquery.datePicker.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
        $(function()
{

// initialise the "Select date" link
$('#date-pick')
	.datePicker(
		// associate the link with a date picker
		{
			createButton:false,
			startDate:'01/01/2005',
			endDate:'31/12/2020'
		}
	).bind(
		// when the link is clicked display the date picker
		'click',
		function()
		{
			updateSelects($(this).dpGetSelected()[0]);
			$(this).dpDisplay();
			return false;
		}
	).bind(
		// when a date is selected update the SELECTs
		'dateSelected',
		function(e, selectedDate, $td, state)
		{
			updateSelects(selectedDate);
		}
	).bind(
		'dpClosed',
		function(e, selected)
		{
			updateSelects(selected[0]);
		}
	);
	
var updateSelects = function (selectedDate)
{
	var selectedDate = new Date(selectedDate);
	$('#d option[value=' + selectedDate.getDate() + ']').attr('selected', 'selected');
	$('#m option[value=' + (selectedDate.getMonth()+1) + ']').attr('selected', 'selected');
	$('#y option[value=' + (selectedDate.getFullYear()) + ']').attr('selected', 'selected');
}
// listen for when the selects are changed and update the picker
$('#d, #m, #y')
	.bind(
		'change',
		function()
		{
			var d = new Date(
						$('#y').val(),
						$('#m').val()-1,
						$('#d').val()
					);
			$('#date-pick').dpSetSelected(d.asString());
		}
	);

// default the position of the selects to today
var today = new Date();
updateSelects(today.getTime());

// and update the datePicker to reflect it...
$('#d').trigger('change');
});
</script>

<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="./template/system/js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	//Close Popups and Fade Layer
$('a.closePopup').live('click', function() { //When clicking on the close or fade layer...
    $('#fade , .popup_block').fadeOut('9000',function() {
        $('#fade, a.closePopup').remove();  //fade them both out
    });
    return false;
});

$(document).pngFix( );
});
</script>



<link rel="stylesheet" href="../jsApp/accordian/development-bundle/themes/base/jquery.ui.all.css">
	<script src="../jsApp/accordian/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="../jsApp/accordian/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="../jsApp/accordian/development-bundle/ui/jquery.ui.accordion.js"></script>
    <script src="../jsApp/accordian/development-bundle/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../jsApp/accordian/development-bundle/demos/demos.css">
	<script>
	$(function() {
		var icons = {
			header: "ui-icon-circle-arrow-e",
			headerSelected: "ui-icon-circle-arrow-s"
		};
		$( "#accordion" ).accordion({
			icons: icons
		});
});


function showWaitPopUp(id,showClose,query){
  var querySrting = '';
  var whatIsDo;
  var ids;
  var popID = id; //Get Popup Name
   closeButton='';
   try{ 
   		querySrting = query.split('&');
   		whatIsDo = querySrting[0];
   		ids = parseInt(querySrting[1]);
    $.ajax({
		type: "POST",
          url: "./lib/mod_rank/rank.php",
          data: "action="+whatIsDo+"&idIs="+ids+"&randval="+ Math.random(),
		  dataType: 'json',
          cache: false,
          success: function(res){
			if(res.isAction == 1)
			{    
			   //alert(res.no);
			   $("div#putOutPut").html(res.data);
			  //if(parseInt(res.resp) !=1){$("div#mainDiv").html(res.resp);}
			  				
			}
          }
	 		});
	  }catch(e){}
	  
   if(showClose){
   closeButton= '<a href="#" class="closePopup"></a>';
   }
   var popWidth = '500';
   $('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend(closeButton);

    //Define margin for center alignment (vertical   horizontal) - we add 80px to the height/width to accomodate for the padding  and border width defined in the css
    var popMargTop = ($('#' + popID).height() + 80) / 2;
    var popMargLeft = ($('#' + popID).width() + 80) / 2;

    //Apply Margin to Popup
    $('#' + popID).css({
        'margin-left' : -popMargLeft
    });

    //Fade in Background
    $('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.
    $('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Fade in the fade layer - .css({'filter' : 'alpha(opacity=80)'}) is used to fix the IE Bug on fading transparencies 
    return false;
}
</script>

<!-----multiple image upload code by Rohit kundal----------->


  <script type="text/javascript">
  function change_language(value){
  document.yourlanguage.submit();  /*if(value==1)
  {
  //alert('jshrjsm');
  window.location.href='setsession.php?hin=hin';
  }
  else if(value==2)
  {
  //alert('jsm');
  window.location.href='setsession.php?en=en';
  }*/
  }
  </script>
  
    
</head>
<body style="min-width:1005px"> 
<!-- Start: page-top-outer -->
<div id="page-top-outer" >    

<!-- Start: page-top -->
<div id="page-top">

	<!-- start logo -->
	<div id="logo" style="width:45%;">
	<a href="<?php echo $config_var->ADMIN_URL;?>" style="color:#FFFFFF;">
    <h1>WST</h1><?php ?>
   </a>
	</div>
	<!-- end logo -->
	
	<!--  start top-search -->
	<div id="top-search" style="width:300px;float:right;">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" align="right">
			<tr>
				
				<td align="right" >
					<div style="float:right;">
						<div class="showhide-account" style="float:left;width:125px;color:#FFFFFF; padding-right:"><?php echo "WELCOME ADMIN";?> <strong><?php if(strlen($userData->user_display_name) >16){ echo ucfirst(substr($userData->user_display_name,0,16)).".."; }else{ echo ucfirst($userData->user_display_name);}?></strong> </div>				 
						 <div style="float:left;width:3%; margin-top:10px;">|</div>
						 <div class="" style="color:#FFF; float: left; width: 80px; text-align: right; margin: 10px 5px 0pt;">
						 <a href="./login_logout.php?controller=DoLogOut" id="logout" style="float:left;color:white;margin:0 10px 0 2px;" title="Logout"><b><?php echo LOGOUT;?><!--<img src="<?php echo $config_var->ADMIN_TPL_URL;?>images/shared/nav/nav_logout.gif" width="64" height="14" alt="" />--></b></a>
						 </div> 
					</div>
					
				</td>
			</tr>
		</table>
	</div>
 	<!--  end top-search -->
 	<div class="clear"></div>

</div>
<!-- End: page-top -->

</div>
<!-- End: page-top-outer -->

 
<!--  start nav-outer-repeat................................................................................................. START -->
<div class="nav-outer-repeat"> 
<!--  start nav-outer -->
<div class="nav-outer"> 

		<!-- start nav-right -->
		
		<!-- end nav-right -->


		<!--  start nav -->
		<div class="nav">
       
		<div class="table" style="width:100%;">
		
		<ul <?php if(@$_GET['mod'] == ''  || @$_GET['mod'] == 'mod_upcoming' || @$_GET['mod'] == 'mod_type' || @$_GET['mod'] == 'mod_dashboard' || @$_GET['mod']=='mod_cms' || (@$_GET['mod']=='mod_users' && @$_GET['d']==3) || (@$_GET['mod']=='mod_users' && @$_GET['d']==9)){?>class="current"<?php }else{?>class="select"<?php }?>><li>
		<a href='<?php echo $config_var->ADMIN_URL."?mod=mod_dashboard&d=1";?>' title="Dashboard"><b>Dashboard</b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub <?php if(@$_GET['mod'] == '' || @$_GET['mod'] == 'mod_upcoming' || @$_GET['mod'] == 'mod_type' || @$_GET['mod'] == 'mod_dashboard' || @$_GET['mod']=='mod_cms' || (@$_GET['mod']=='mod_users' && @$_GET['d']==3)|| (@$_GET['mod']=='mod_users' && @$_GET['d']==9) ||@$_GET['mod'] == 'mod_users' ){?>show<?php }?>">
			<ul class="sub">
				<li <?php if(@$_GET['d'] == '1'){?>class="sub_show"<?php }?>>
				<a href='<?php echo $config_var->ADMIN_URL."?mod=mod_dashboard&view=default&d=1"; ?>'title="Control Panel">Control Panel</a></li>
                  <li <?php if( @$_GET['d'] == '2'){?>class="sub_show"<?php }?>>
				<a href='<?php echo $config_var->ADMIN_URL."?mod=mod_cms&view=default&d=2"; ?>'title="CMS">CMS</a></li>             
					<li <?php if(@$_GET['d'] == '3'){?>class="sub_show"<?php }?>>
				<a href='<?php echo $config_var->ADMIN_URL."?mod=mod_users&view=editadmin&d=3"; ?>'title="Change Password">Change Password</a></li>
					<li <?php if(@$_GET['d'] == '9'){?>class="sub_show"<?php }?>>
				<a href='<?php echo $config_var->ADMIN_URL."?mod=mod_users&view=editprofile&d=9"; ?>'title="Change Profile">Change Profile</a></li>
					<li <?php if(@$_GET['d'] == '4'){?>class="sub_show"<?php }?>>
				<a href='<?php echo $config_var->ADMIN_URL."?mod=mod_type&view=default&d=4"; ?>'title="Type">Type</a></li>	
				<li <?php if(@$_GET['d'] == '8'){?>class="sub_show"<?php }?>>
				<a href='<?php echo $config_var->ADMIN_URL."?mod=mod_upcoming&view=default&d=8"; ?>'title="Upcoming">Upcoming</a></li>	
				<li>
				<a href='<?php echo $config_var->ADMIN_URL."?mod=mod_tour&view=addImage&id=100000000000455"; ?>'title="Upcoming">Tour Gallery</a></li>
				
         </ul>                      
				
		</div>
		
		<div class="nav-divider">&nbsp;</div>
		<!-- Start gallery menu-->
		<ul <?php if(@$_GET['mod'] == 'mod_gallery' ){ ?>class="current"<?php }else{?>class="select"<?php }?>>
		<li>
		<a href='<?php echo $config_var->ADMIN_URL."?mod=mod_gallery&view=default&d=2";?>' title="Gallery"><b>Gallery</b></a>
		</li>
		</ul>
		<div class="nav-divider">&nbsp;</div>
		<!-- Videos Menu-->
			<ul <?php if(@$_GET['mod'] == 'mod_video'){?>class="current"<?php }else{?>class="select"<?php }?>><li>
		<a href='<?php echo $config_var->ADMIN_URL."?mod=mod_video&view=default&m=2";?>' title="Video"><b>Videos</b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		
		<!--<ul <?php if(@$_GET['mod'] == '' || @$_GET['mod'] == 'mod_video' ){ ?> class="current"<?php }else{?>class="select"<?php }?>>>
			<li>
				<a href='<?php echo $config_var->ADMIN_URL."?mod=mod_video&view=default&m=1";?>'><b>Videos</b></a>
			</li>
		</ul>-->
		<!-- End of video-->
		<div class="nav-divider">&nbsp;</div>

		<!-- End Category menu-->  
		<!-- Start Category menu-->
		<ul <?php if( @$_GET['mod'] == 'mod_Category'){?>class="current"<?php }else{?>class="select"<?php }?>>
		<li>
		<a href='<?php echo $config_var->ADMIN_URL."?mod=mod_Category&view=default&d=3";?>' title="Category"><b>Category</b></a>
		</li>
		</ul>
		
		<div class="nav-divider">&nbsp;</div>

		<!-- End Category menu-->                   
        
        <ul <?php if(@$_GET['mod'] == 'mod_users' && @$_GET['m']==1){?>class="current"<?php }else{?>class="select"<?php }?>>
		<li><a href='<?php echo $config_var->ADMIN_URL."?mod=mod_users&view=default&m=1";?>' title="Manage User"><b> Manage Users</b></a><!--[if IE 7]><!--><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub <?php if(@$_GET['mod'] == 'mod_users' ){?>show<?php }?>">
			
		</div>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		
     
	 <div class="nav-divider">&nbsp;</div>
		<!-- Start gallery menu-->
		<ul <?php if(@$_GET['mod'] == 'mod_bar' ){ ?>class="current"<?php }else{?>class="select"<?php }?>>
		<li>
		<a href='<?php echo $config_var->ADMIN_URL."?mod=mod_bar&view=default&d=6";?>' title="Bar & Pub"><b>Bar &amp; Pub </b></a>
		</li>
		</ul>
	<div class="nav-divider">&nbsp;</div>
	
	<!-- *************** New tab ****************************-->
	
		
		<!-- Start gallery menu-->
		<ul <?php if(@$_GET['mod'] == 'mod_travel' ){ ?>class="current"<?php }else{?>class="select"<?php }?>>
		<li>

		<a href='<?php echo $config_var->ADMIN_URL."?mod=mod_travel&view=default&d=6";?>' title="Travel Guide"><b>Travel Guide </b></a>
		</li>
		</ul>
	<div class="nav-divider">&nbsp;</div>
	
	 <!--- ************** New tab  *************** -->
		<ul <?php if(@$_GET['mod'] == 'mod_payments'){?>class="current"<?php }else{?>class="select"<?php }?>>
		<li><a href='<?php echo $config_var->ADMIN_URL."?mod=mod_payments&view=default&m=1";?>' title="Manage Payment"><b> Manage Payment </b></a><!--[if IE 7]><!--><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub <?php if(@$_GET['mod'] == 'mod_manageUser' || @$_GET['mod'] == 'mod_AnotherEmployees'){?>show<?php }?>">
			
		</div>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		
		<div class="nav-divider">&nbsp;</div>
	
	 <!--- ************** New tab  *************** -->
		<ul <?php if(@$_GET['mod'] == 'mod_partygirls'){?>class="current"<?php }else{?>class="select"<?php }?>>
		<li><a href='<?php echo $config_var->ADMIN_URL."?mod=mod_partygirls&view=default&m=1";?>' title="Manage Party Girls"><b>Manage Party Girls </b></a><!--[if IE 7]><!--><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub <?php if(@$_GET['mod'] == 'mod_partygirls'){?>show<?php }?>">
			
		</div>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
	 
	 	<div class="nav-divider">&nbsp;</div>

		<!-- End Category menu-->                   
        
        <ul <?php if(@$_GET['type']== 'forum'){?>class="current"<?php }else{?>class="select"<?php }?>>
		<li><a href='<?php echo $config_var->ADMIN_URL."?mod=mod_forum&view=default&d=1&type=forum";?>' title="Forum"><b> Forum</b></a><!--[if IE 7]><!--><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub <?php if(@$_GET['type']== 'forum'){?>show<?php }?>">
			<ul class="sub">
				<li <?php if(@$_GET['d'] == '1'){?>class="sub_show"<?php }?>>
				<a href='<?php echo $config_var->ADMIN_URL."?mod=mod_forum&view=default&d=1&type=forum"; ?>'title="Manage Forum">Manage Forum</a></li>
                  <li <?php if( @$_GET['d'] == '2'){?>class="sub_show"<?php }?>>
				<a href='<?php echo $config_var->ADMIN_URL."?mod=mod_forumcat&view=default&d=2&type=forum"; ?>'title="Manage Category">Manage Category</a></li> 
				 <li <?php if( @$_GET['d'] == '3'){?>class="sub_show"<?php }?>>
				<a href='<?php echo $config_var->ADMIN_URL."?mod=mod_forumsubcat&view=default&d=3&type=forum"; ?>'title="Manage Sub Category">Manage Sub Category</a></li>             
					<li <?php if(@$_GET['d'] == '4'){?>class="sub_show"<?php }?>>
				<a href='<?php echo $config_var->ADMIN_URL."?mod=mod_forum&view=manage_posts&d=4&type=forum"; ?>'title="Manage Posts">Manage Posts</a></li>
				
				</ul>
		</div>
		
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
	 
	 <!-- -->
        
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		
		<div class="clear"></div>
		</div>
       
	</div>	
		
		<div class="clear"></div>
		</div>
		<!--  start nav -->


<div class="clear"></div>
<!--  start nav-outer -->
</div>
<!--  start nav-outer-repeat................................................... END -->

 <div class="clear"></div>
 
<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer" >
<!-- start content -->
<div id="content">

	<div id="element-box" style="margin-top:-5px;margin-bottom:15px;"> 
			
			 <div  class="m">
			 <table width="100%" cellpadding="0" cellspacing="0" border="0">
			 <tr><td align="left" >
	               <div id="page-heading" style="height:15px;">
				   
                   <h1><span class="<?php echo @$icon;?>"></span><?php echo $modTitle ;?></h1>
	               </div>
				   </td>
				   <td align="right" width="50%">
					   <?php echo @$toolBar->tooBar(); ?>
				   </td>
			</tr>
			</table>
</div>
			
			 <div class="b"> 
				<div class="b"> 
					<div class="b"></div> 
				</div> 
			</div> 
   		</div>
<div class="clear">&nbsp;</div>


	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table" >
	<tr>
		<th rowspan="3" class="sized"></th>
		<th class="topleft"></th>
		<td id="tbl-border-top">&nbsp;</td>
		<th class="topright"></th>
		<th rowspan="3" class="sized"></th>
	</tr>
	<tr>
		<td id="tbl-border-left"></td>
		<td valign="top" style="padding-top:0px !important;">
		<?php if(isset($_SESSION['error']) && $_SESSION['error']!=''){?>
		<div id="content-table-inner-susecc" class="content-table-inner" style="height:30px;margin-bottom:10px;">
			<div id="table-content" style="margin-top:-10px;">
					<!--  start message-green -->
					<div id="message-red" style="margin-top:0px;">
					<table border="0" width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td class="red-left"><img src="<?php echo $config_var->ADMIN_TPL_URL;?>images/shared/delete.png"   alt=""  />&nbsp;<?php echo @$_SESSION['error'];$_SESSION['error']="";unset($_SESSION['error']);?></td>
						<td class="red-right"><a class="close-red"><img src="<?php echo $config_var->ADMIN_TPL_URL;?>images/table/icon_close_red.gif"   alt="" /></a></td>
					</tr>
					</table>
					</div>
		   </div>
	   </div>
		
		<?php }else if(isset($_SESSION['succ']) && $_SESSION['succ']!=''){?>
		<div id="content-table-inner-susecc" class="content-table-inner" style="height:30px;margin-bottom:10px;">
			<div id="table-content" style="margin-top:0px;">
				<!--  start message-green -->
				<div id="message-green" style="margin-top:0px;">
					<table border="0" width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td class="green-left"><img src="<?php echo $config_var->ADMIN_TPL_URL;?>images/shared/success.png"   alt=""  />&nbsp;<?php echo @$_SESSION['succ'];$_SESSION['succ']="";unset($_SESSION['succ']);?></td>
						<td class="green-right"><a class="close-green"><img src="<?php echo $config_var->ADMIN_TPL_URL;?>images/table/icon_close_green.gif"   alt="" /></a></td>
					</tr>
					</table>
				</div>
			</div>
		</div>
		<?php }?>
		<?php if(isset($_REQUEST['s']) || isset($_REQUEST['r']) ){?>
        <!--  start content-table-inner ...................................................................... START -->
        <div id="content-table-inner-susecc" class="content-table-inner" style="height:30px;margin-bottom:10px;">
        <?php if(isset($_REQUEST['s'])){?>
		<!--  start table-content  -->
			<div id="table-content" style="margin-top:0px;">
				<!--  start message-green -->
				<div id="message-green" style="margin-top:0px;">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="green-left"><img src="<?php echo $config_var->ADMIN_TPL_URL;?>images/shared/success.png"   alt=""  />&nbsp;<?php echo @$s_mess;?></td>
					<td class="green-right"><a class="close-green"><img src="<?php echo $config_var->ADMIN_TPL_URL;?>images/table/icon_close_green.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div>
       </div>
       <?php } ?>
       
     <?php if(isset($_REQUEST['r'])){?>
       <div id="table-content" style="margin-top:-10px;">
				<!--  start message-green -->
				<div id="message-red" style="margin-top:0px;">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="red-left"><img src="<?php echo $config_var->ADMIN_TPL_URL;?>images/shared/delete.png"   alt=""  />&nbsp;<?php echo @$r_mess;?></td>
					<td class="red-right"><a class="close-red"><img src="<?php echo $config_var->ADMIN_TPL_URL;?>images/table/icon_close_red.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div>
       </div>
       <?php } ?>
       
       </div>
       <?php } ?>
	   
       <div id="content-table-inner" style="height:30px;margin-bottom:10px;display:none;">
		<!--  start table-content  -->
			<div id="table-content">
				<!--  start message-green -->
				<div id="message-red" style="margin-top:0px;">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="red-left"><img src="<?php echo $config_var->ADMIN_TPL_URL;?>images/shared/delete.png"   alt=""  />&nbsp;<span id="err_mess"></span></td>
					<td class="red-right"><a class="close-red"><img src="<?php echo $config_var->ADMIN_TPL_URL;?>images/table/icon_close_red.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div>
       </div></div>
        
        <!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content"  >
			 <!--  start product-table ..................................................................................... -->
				<?php $themeClass->getThemeModule();?>
				<!--  end product-table................................... --> 
				
			</div>
			<!--  end content-table  -->
			<div class="clear"></div>
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
		</td>
		<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
	</table>
	<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<div id="footer" style="margin-top:0px;">
	<!--  start footer-left -->
	<div id="footer-left">
	Copyright &copy; 2012 <span id="spanYear"></span>WST. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
<!-- POP UP-->
<div id="sign_in" class="popup_block">
<div id="putOutPut"></div>
</div>
<!-- POP UP END -->
 
</body>
</html>

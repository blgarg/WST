<?php 
global $config_var;
global $mdb;
global $Controller;
global $toolBar;
$userInfo = new userInfo();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<?php if(@$_GET['mod']!=='mod_index' || @$_GET['view']!=='tour') {?>
<title>
<?php $globalsettings = $userInfo->getGlobalSettings();
if(@$_GET['mod']=='mod_index' && @$_GET['view']=='tour')
{echo "";}
else if(@$_GET['mod']=='mod_index' && (@$_GET['view']=='default' || @$_GET['view']==''))
{echo "WST";}
else if(@$_GET['mod']=='mod_index' && @$_GET['view']=='home')
{echo "WST - Home";}
else if(@$_GET['mod']=='mod_index' && @$_GET['view']=='login')
{echo "WST - Login";}
else if(@$_GET['mod']=='mod_index' && @$_GET['view']=='forgot')
{echo "WST - Forgot";}
else if(@$_GET['mod']=='mod_index' && @$_GET['view']=='compliance')
{echo "WST - 18 U.S.C. - 2257 Compliance Notice";}
else if((@$_GET['mod']=='mod_gallery' && @$_GET['view']=='default') || (@$_GET['mod']=='mod_gallery'))
{echo "WST - Gallery";}
else if((@$_GET['mod']=='mod_video' && @$_GET['view']=='default') || (@$_GET['mod']=='mod_video'))
{echo "WST - Videos";}
else if((@$_GET['mod']=='mod_joinus' && @$_GET['view']=='default') || (@$_GET['mod']=='mod_joinus'))
{echo "WST - Join Now";}
else if(@$_GET['mod']=='mod_index' && @$_GET['view']=='termspage' )
{echo "WST - Terms and Conditions";}
else if(@$_GET['mod']=='mod_index' && @$_GET['view']=='privacypage' )
{echo "";}
else if(@$_GET['mod']=='mod_index' && @$_GET['view']=='forgot' )
{echo "WST - Forgot Password";}
else if(@$_GET['mod']=='mod_index' && @$_GET['view']=='changepass' )
{echo "WST - Change Password";}
else if(@$_GET['mod']=='mod_index' && @$_GET['view']=='contactus' )
{echo "WST - Contact Us";}
else if((@$_GET['mod']=='mod_travel' && @$_GET['view']=='default') || (@$_GET['mod']=='mod_travel'))
{echo "WST - Sex Travel Adventures";}
else if((@$_GET['mod']=='mod_partygirls' && @$_GET['view']=='default') || (@$_GET['mod']=='mod_partygirls'))
{echo "WST - Party Girls";}
else if((@$_GET['mod']=='mod_barguide' && @$_GET['view']=='default') || (@$_GET['mod']=='mod_barguide'))
{echo "WST - Bar Guide";}else{echo "WST";}?>
</title>
<?php }?>
<link rel="shortcut icon" href="<?php echo $config_var->WEB_TPL_URL;?>images/favicon.ico">
<script src="<?php echo $config_var->WEB_TPL_URL;?>js/jquery-1.4.1.min.js" type="text/javascript"></script>
<script src="<?php echo $config_var->WEB_URL;?>jsApp/common.js" type="text/javascript"></script>
<script src="<?php echo $config_var->WEB_TPL_URL;?>js/jquery.jcarousel.js" type="text/javascript"></script>
<script src="<?php echo $config_var->WEB_TPL_URL?>js/jquery.jcarousel.min.js" type="text/javascript"></script>
<?php include $config_var->WEB_ROOT.'mod/'.$theme_mod."/js/"."js.php";?>
<script src="<?php echo $config_var->WEB_TPL_URL?>js/jwplayer.js" type="text/javascript"></script>
<script src="<?php echo $config_var->WEB_TPL_URL?>js/mootools-1.3.2-core.js" type="text/javascript"></script>
<script src="<?php echo $config_var->WEB_TPL_URL?>js/mootools-1.3.2.1-more.js" type="text/javascript"></script>
<script src="<?php echo $config_var->WEB_TPL_URL?>js/slideshow.js" type="text/javascript"></script>
<script src="<?php echo $config_var->WEB_TPL_URL?>js/slideshow.flash.js" type="text/javascript"></script>
<script src="<?php echo $config_var->WEB_TPL_URL?>js/slideshow.fold.js" type="text/javascript"></script>
<script src="<?php echo $config_var->WEB_TPL_URL?>js/slideshow.kenburns.js" type="text/javascript"></script>
<script src="<?php echo $config_var->WEB_TPL_URL?>js/slideshow.push.js" type="text/javascript"></script>
<script src="<?php echo $config_var->WEB_TPL_URL?>js/gsmapsearch.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo $config_var->WEB_TPL_URL;?>css/style.css" type="text/css" media="screen" title="default" />
<link rel="stylesheet" href="<?php echo $config_var->WEB_TPL_URL;?>css/rating.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo $config_var->WEB_TPL_URL;?>css/slideshow.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo $config_var->WEB_TPL_URL;?>css/map_slider.css" type="text/css" media="screen"/>
</head>
<body style=""> 
<!-- header start -->
<div class="wrapper">
	<div class="hdr">
    	<div class="logo-banner"><img src="<?php echo $config_var->WEB_TPL_URL;?>images/logo-banner.jpg" alt="" /></div>
        <?php if(isset($_GET['mod']) && $_GET['mod']!='index'){?>
		<div class="nav">
        	<ul>
              <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=''){?>
				<li><a href="<?php echo $config_var->WEB_URL;?>?mod=mod_index&view=home&form=agree&s=1" <?php if($_REQUEST['mod']=='mod_index' && $_REQUEST['view']=='home'){ echo "class='sltd'"; } ?> title="HOME">HOME</a></li>
				<li><a href="<?php echo $config_var->WEB_URL ;?>?mod=mod_partygirls&view=default" <?php if($_REQUEST['mod']=='mod_partygirls'){ echo "class='sltd'"; } ?> title="Party Girls">Party Girls</a></li>
				<li><a href="<?php echo $config_var->WEB_URL;?>?mod=mod_travel&view=default" <?php if(isset($_REQUEST['mod']) && $_REQUEST['mod']=='mod_travel'){ echo 'class="sltd"';}?> title="SEX TRAVEL ADVENTURES">TRAVEL GUIDE</a></li>
				<li><a href="<?php echo $config_var->WEB_URL;?>?mod=mod_barguide&view=default" <?php if(isset($_REQUEST['mod']) && $_REQUEST['mod']=='mod_barguide'){ echo 'class="sltd"';}?> title="BAR GUIDE">BAR GUIDE</a></li>
				<li><a href="<?php echo $config_var->WEB_URL;?>?mod=mod_gallery&view=default&s=3" <?php if($_REQUEST['mod']=='mod_gallery'){ echo "class='sltd'"; } ?> title="GALLERY">Gallery</a></li>
                <li><a href="<?php echo $config_var->WEB_URL;?>?mod=mod_video&view=default" <?php if(isset($_REQUEST['mod']) && $_REQUEST['mod']=='mod_video'){ echo 'class="sltd"';}?> title="VIDEOS">Videos</a></li>
				<li><a href="<?php echo $config_var->WEB_URL;?>?mod=mod_index&view=contactus" <?php if(isset($_REQUEST['view']) && $_REQUEST['view']=='contactus'){ echo "class='sltd'"; } ?> title="CONTACT US">CONTACT US</a></li>
				<li><a href="<?php echo $config_var->WEB_URL;?>logout.php" title="LOGOUT">Logout</a></li>
				<?php }else{?>
				<li><a href="<?php echo $config_var->WEB_URL ;?>?mod=mod_partygirls&view=default" <?php if($_REQUEST['mod']=='mod_partygirls'){ echo "class='sltd'"; } ?> title="Party Girls">Party Girls</a></li>
				<li><a href="<?php echo $config_var->WEB_URL;?>?mod=mod_index&view=tour" <?php if($_REQUEST['view']=='tour'){ echo "class='sltd'"; } ?> title="TOUR">TOUR</a></li>
                <li><a href="<?php echo $config_var->WEB_URL;?>?mod=mod_index&view=login&s=5" <?php if($_REQUEST['s']=='5'){ echo "class='sltd'"; } ?> title="LOGIN">LOGIN</a></li>
                <li><a href="<?php echo $config_var->WEB_URL;?>?mod=mod_joinus&view=default&s=6" <?php if($_REQUEST['s']=='6'){ echo "class='sltd'"; } ?> title="JOIN NOW">JOIN NOW</a></li>
				<li><a href="<?php echo $config_var->WEB_URL;?>?mod=mod_index&view=contactus" <?php if(isset($_REQUEST['view']) && $_REQUEST['view']=='contactus'){ echo "class='sltd'"; } ?> title="CONTACT US">CONTACT US</a></li>
				<?php }?>
			</ul>
        </div>
		<?php }?>
 </div>
    <div class="content" style="padding-top:0;">
   <?php $themeClass->getThemeModule();?>
	</div>
   <div class="clr"></div> 
<!--Footer-->
 </div>
<div class="footer">
	<div class="footer-txt">
    	<div class="ftr-lt"> Copyright &copy; 2012 WorldSexTraveler.com. All Rights Reserved</div>
	  <div class="ftr-rt">
	  <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=''){?>
	  <a href="<?php echo $config_var->WEB_URL;?>phpBB3">Forum</a> |
	  <?php } ?>
	  <a href="<?php echo $config_var->WEB_URL."?mod=mod_index&view=compliance" ; ?>"> 18 U.S.C. 2257 Record-Keeping Requirements Compliance Statement </a> | 
	  <a href="<?php echo $config_var->WEB_URL."?mod=mod_index&view=termspage&s=7" ; ?>"> Terms</a>  | <a href="<?php echo $config_var->WEB_URL."?mod=mod_index&view=privacypage&s=8" ; ?>"> Privacy</a>
	   | <a href="<?php echo $config_var->WEB_URL."?mod=mod_index&view=supportpage&s=21" ; ?>"> Support</a>
	  </div>
 </div>
</div>
<!-- END --->
</body>
</html>

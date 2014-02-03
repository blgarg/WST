<?php  //$site = new site(); 

		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>World Sex Travelers </title>

<link href="<?php echo $config_var->WEB_TPL_URL;?>css/style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="<?php echo $config_var->WEB_TPL_URL;?>images/favicon.ico">
</head>
<body>


<!--header-->
<div class="wrapper"> <!-- open tag here end in footer -->
	<div class="hdr">
    	<div class="logo-banner"><img src="<?php echo $config_var->WEB_TPL_URL;?>images/logo-banner.jpg" alt="" /></div>
        <?php if(isset($_GET['page']) && $_GET['page']!=''){?>
		<div class="nav">
        	<ul>
            	<li><a href="/?page=home" title="HOME" <?php if($_GET['page']=='home'){?> class="sltd"<?php }?>>HOME</a></li>
                <li><a href="javascript:;" title="SEX TRAVEL ADVENTURES">SEX TRAVEL ADVENTURES</a></li>
                <li><a href="javascript:;" title="MODELS">MODELS</a></li>
                <li><a href="javascript:;" title="MEMBERS">MEMBERS</a></li>
                <li><a href="<?php echo $config_var->WEB_URL;?>login.php" title="LOGIN" <?php if($_GET['page']=='login'){?> class="sltd"<?php }?>>LOGIN</a></li>
                <li><a href="javascript:;" title="JOIN NOW">JOIN NOW</a></li>
            </ul>
        </div>
		<?php }?>
    </div>
<!--header-->
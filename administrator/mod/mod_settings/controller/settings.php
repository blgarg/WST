<?php
class settings_controller{
      var $modName  = '';
   function runController(){
        
		 switch(@$_REQUEST['controller'])
		  {
				
				
				case 'global_setting':
				$model_settings_set = new model_settings_default();
				$objects = new stdClass();
				$objects->websitename = @addslashes($_REQUEST['website_name']);
				$objects->logotext = @addslashes($_REQUEST['logo_text']);
				$objects->emailsubject = @addslashes($_REQUEST['email_subject']);
				$objects->emailaddress = @addslashes($_REQUEST['email_address']);
				$objects->contactnumber = @addslashes($_REQUEST['contact_number']);
				$objects->logotext_en = @addslashes($_REQUEST['logo_text2']);
				$objects->footertext = @addslashes($_REQUEST['footer_text']);
				$objects->billheading = @addslashes($_REQUEST['billheading']);
				$objects->billheadingenglish = @addslashes($_REQUEST['billheadingenglish']);
				$objects->billaddress = @addslashes($_REQUEST['addresshindi']);
 				$objects->billaddressenglish = @addslashes($_REQUEST['addressenglish']);
				$objects->displayLogo = isset($_REQUEST['displayLogo'])?addslashes($_REQUEST['displayLogo']):'0';
				if(isset($_FILES['logo_image']) && $_FILES['logo_image']['name']!=''){
				$objects->logoimage = @addslashes($_FILES['logo_image']['name']);
				}
				/*$objects->datecreated =  date('Y-m-d');*/
				$objects->datemodified =  date('Y-m-d');
			    $where ='WHERE id=1';
				if($model_settings_set->updateRecord($objects,$_FILES,'mgl_settings',$where)){
				     @header('Location:index.php?mod=mod_settings&view=default&d=4&s=1');}else{@header('Location:index.php?mod=mod_cms&view=default&r=1');
				 }
				break;
        
		}
	
   }
}
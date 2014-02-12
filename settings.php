<?php
define("_CFG_DEBUG",0);	
error_reporting(0);
	session_start();
								 
if(_CFG_DEBUG)						
	error_reporting(E_ALL);			
else
	error_reporting(E_ERROR);	
ini_set('display_errors', '0');
ini_set("upload_max_filesize", "256M"); 
ini_set("max_execution_time", "1800"); 
ini_set("memory_limit", "256M"); 
ini_set("short_open_tag", "0");

## GLOBAL VARIBLE
class config	
{
var $SITE_DIR = 'wst';
var $WEB_URL = '';
var $WEB_ROOT = '';
var $ADMIN_ROOT ='';
var $ADMIN_URL ='';
var $Manege_model ='';
var $ADMIN_MOD_URL = '';
var $ADMIN_INC_URL = '';
var $ADMIN_TPL_PATH = '';
var $ADMIN_TPL_URL = '';
var $UPLOAD_ROOT = '';
var $UPLOAD_URL = '';
var $YOUTUBE_API_KEY = 'AI39si6bPoVuOQJycYHcfGN4uet3Gzb98NhtIhYgQcJgrHLE1X5EKp9qEvwS5yp-0wlmx_uaal2tnRqeRH1bpRa6cE1Kh9wkdw';
var $YOUTUBE_USERNAME = 'mindsingh';
var $YOUTUBE_PASSWORD = 'mind@123';
var $title = 'WST';

# DATABASE CONNECTION VARIABLES
var $HOST_NAME = 'localhost';
var $HOST_USER = 'root';
var $HOST_PASS = 'vV64hK';
var $DB_NAME = 'wst';
var $DB_PREFIX = '';
# INITIALIZE VARIABLES 
function __construct()
{
$this->ADMIN_URL = 'http://'.$_SERVER['HTTP_HOST'].'/administrator/';
$this->ADMIN_MOD_URL = $this->ADMIN_URL.'mod/';
$this->ADMIN_ROOT = $_SERVER['DOCUMENT_ROOT'].'/administrator/'; 
$this->Manege_model_js = 'http://'.$_SERVER['HTTP_HOST'].'/administrator/mod/mod_manageModel/js/';
$this->Manege_model_css = 'http://'.$_SERVER['HTTP_HOST'].'/administrator/mod/mod_manageModel/css/';
$this->Manege_Bill_css = 'http://'.$_SERVER['HTTP_HOST'].'/administrator/template/system/css/';
$this->Manege_Bill_images = 'http://'.$_SERVER['HTTP_HOST'].'/administrator/template/system/images/';
$this->ADMIN_TPL_URL = $this->ADMIN_URL."template/system/"; 
$this->ADMIN_INC_URL = $this->ADMIN_URL.'inc/';
$this->ADMIN_TPL_PATH = $this->ADMIN_URL.'template/';
$this->WEB_ROOT = $_SERVER['DOCUMENT_ROOT'].'/';
$this->WEB_URL = 'http://'.$_SERVER['HTTP_HOST'].'/';
$this->WEB_TPL_URL = $this->WEB_URL."template/wst/";
$this->WEB_TPL_ROOT = $this->WEB_ROOT."template/wst/";
$this->WEB_INC_URL = $this->WEB_URL.'inc/';
$this->WEB_TPL_PATH = $this->WEB_URL.'template/wst/';
$this->UPLOAD_ROOT = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
$this->UPLOAD_URL = 'http://'.$_SERVER['HTTP_HOST'].'/uploads/';
$this->LIB_ROOT = $_SERVER['DOCUMENT_ROOT'].'/'; 
$this->LIB_WEB_ROOT = $this->WEB_URL.'lib/';  
$this->thumb = '.././uploads/images/thumbnail' ;
$this->bar_thumb = '.././uploads/bar_images/thumbnails' ;
$this->img = '.././uploads/images' ;
$this->bar_img = '.././uploads/bar_images' ;
$this->thumbparty = '.././uploads/partygirls_images/thumbnail' ;
$this->partygirls = ".././uploads/partygirls_images";

	 } // END OF CONSTRUTOR
}
$config_var = new config(); // would be global settings 
define("ADDNEW","ADD NEW");
?>

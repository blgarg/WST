<?php function mod_js(){ global $jsPath;?>
<script src="<?php echo $jsPath;?>validateForms.js" type="text/javascript"></script>
<script src="<?php echo $jsPath;?>otherJstuff.js" type="text/javascript"></script>
<script type="text/javascript">
function checkSettings()
{
	var submitForm = false;
	if(document.getElementById('content-table-inner-suceess')){
	$('#content-table-inner-suceess').hide('slow');
	}
	if(document.getElementById('content-table-inner-susecc'))
	document.getElementById('content-table-inner-susecc').style.display='none';
	with (window.document.adddSettingtFrm) { 
	
	var email_str = document.adddSettingtFrm.email_address.value;
	
	var filter=email_str.match(/^[^0-9][a-z0-9_]+([.][a-z0-9_]+)*[@][a-z0-9]+([.][a-z0-9]+)*[.][a-z]{2,4}$/i);
	
	   if(isEmpty(website_name, '<?php echo Website_Name ?>')){
	    return;
	   }else if (isEmpty(logo_text, '<?php echo Logo_Hindi ?>')) {
			return;
		}	
		else if (isEmpty(logo_text2, '<?php echo Logo_English ?>')) {
			return;
		}
		else if (isEmpty(email_subject, '<?php echo Email_Subject ?>')) {
			return;
		}else if (isEmpty(email_address, '<?php echo Enter_Valid_Email ?>')) {
			return;
		}else if (filter==null)
			{
			document.getElementById('content-table-inner').style.display = ''; 
	    	document.getElementById('err_mess').innerHTML = "<?php echo Email_Validate ?>";	
			
			document.adddSettingtFrm.email_address.focus();
			return false;
			}
		else if (echeck(email_str)==false){
	
		email_str="";
		document.adddSettingtFrm.email_address.focus();
		return false;
	}
		else if (isEmpty(contact_number, '<?php echo Contact ?>')) {
			return;
		}else if (isEmpty(footer_text, '<?php echo Footer_Text ?>')) {
			return;
		}else if (email(email_address,'<?php echo Invalid_Email ?>')) {
			return;
		}else if (validateContact(contact_number,'<?php echo Invalid_Contact ?>')) {
			return;
		}else if (isEmpty(billheading, '<?php echo Billheading_Hindi ?>')) {
			return;
		}else if (isEmpty(billheadingenglish, '<?php echo Billheading_English ?>')) {
			return;
		}else if (isEmpty(addresshindi, '<?php echo Address_Hindi ?>')) {
			return;
		}else if (isEmpty(addressenglish, '<?php echo Address_English ?>')) {
			return;
		}else {
				
			   /*if($("#showchangeLink") && !$('#showchangeLink').is(":visible") ){
                  if(isEmptyImage(logo_image, 'Please select logo image')){
		           return false;
		          }else if (isValidImage(logo_image, 'Please upload valid image type')){
						return;
				  }
			}*/
		 submit();
		 }
	  }
 }

</script>
<?php }?>
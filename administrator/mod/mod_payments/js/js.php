<?php function mod_js(){ global $jsPath;?>
<script src="<?php echo $jsPath;?>validateForms.js" type="text/javascript"></script>
<script src="<?php echo $jsPath;?>otherJstuff.js" type="text/javascript"></script>
<script type="text/javascript">
function pageAction(controller)
{
	
	 $("#content-table-inner-susecc").hide(); 
	var checkFound = false;
	var chkboxlen = document.getElementsByName('mag_id[]').length;
	
	for(var i=0;i<chkboxlen;i++){
		if (document.getElementsByName('mag_id[]')[i].checked){
			checkFound = true;
		}
	}
	
	if (checkFound != true) {
		document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = '<?php echo Magazine_Select ?>';

	}else {
   
		 document.getElementById("controller").value = controller;
		 var contr= '';
		 if(controller=="delete"){
		 	contr='<?php echo delete ?>'; 
		 	}
		 	else if(controller=="activate"){
		 	contr='<?php echo activate ?>'; 
		 	}
		 	else if(controller=="deactivate"){
		 	contr='<?php echo deactivate ?>'; 
		 	}
		 if(confirm('<?php echo Category_Really_Confirm ?> '+contr+' <?php echo Category_Selected_Record ?>'))
		 { 
			document.mainform.submit();
		 }
		 else{
			
			 return false;
		 }
	}
}

function checkAddpmt()
{
	with (window.document.adddPageFrm) { 
	    if(isEmpty(recv_pmt, '<?php echo Enter_Payment ?>')) {
			return false;
		}
		else {
			submit();
		}
	}
}

</script>
<?php }?>
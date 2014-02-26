<?php function mod_js(){ global $jsPath;?>
<script src="<?php echo $jsPath;?>validateForms.js" type="text/javascript"></script>
<script src="<?php echo $jsPath;?>otherJstuff.js" type="text/javascript"></script>
<script type="text/javascript">
function pageAction(controller)
{
	 $("#content-table-inner-susecc").hide(); 
	var checkFound = false;
	var chkboxlen = document.getElementsByName('cat_id[]').length;
	
	for(var i=0;i<chkboxlen;i++){
		if (document.getElementsByName('cat_id[]')[i].checked){
			checkFound = true;
		}
	}
	
	if (checkFound != true) {
		document.getElementById('content-table-inner').style.display = ''; 
	    document.getElementById('err_mess').innerHTML = 'Please select at least one record.';

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
		 if(confirm('Do you really want to '+contr+' the record(s)'))
		 { 
			document.mainform.submit();
		 }
		 else{
			
			 return false;
		 }
	}
}

function checkAddCategory()
{
	with (window.document.adddPageFrm) { 
	    if (isEmpty(category_title, 'Please enter category title.')) {
			return false;
		}else if(onlytext(category_title,'Please enter only text.')){
			return false;
		}else if(validateHtml(category_title,'Special characters are not allowed in category title')){
			return false;
		}else {
			submit();
		}
	}
}
</script>
<?php }?>
<?php function mod_js(){ global $jsPath;?>
<script src="<?php echo $jsPath;?>validateForms.js" type="text/javascript"></script>
<script src="<?php echo $jsPath;?>jquery.pagination.js" type="text/javascript"></script>
<script src="<?php echo $jsPath;?>otherJstuff.js" type="text/javascript"></script>
<script src="<?php echo $jsPath;?>plupload.js" type="text/javascript"></script>
<script src="<?php echo $jsPath;?>plupload.flash.js" type="text/javascript"></script>
<script src="<?php echo $jsPath;?>plupload.html4.js" type="text/javascript"></script>
<script src="<?php echo $jsPath;?>plupload.full.js" type="text/javascript"></script>
<script src="<?php echo $jsPath;?>plupload.html5.js" type="text/javascript"></script>
<script src="<?php echo $jsPath;?>plupload.html5.js" type="text/javascript"></script>

<script type="text/javascript">

$(document).ready(function(){


	// Custom example logic
	var HOST_PATH = "https://"+window.location.hostname+"/";
	function $(id) {
		return document.getElementById(id);	
	}
	var uploader = new plupload.Uploader({
		runtimes : 'gears,html5,silverlight,browserplus,flash,html4',
		browse_button : 'pickfiles',
		container: 'container',
		max_file_size : '1000mb',
		url : 'lib/photoprintzip.php?id=<?php echo $_SESSION['gallery_id'];?>',
		//url : 'index.php?mod=mod_photoprinting&controller=zip&tmpimg=ys',
		chunk_size : '10mb',
	    unique_names : true,
		//resize : {width : 320, height : 240, quality : 90},
		flash_swf_url : '<?php echo $jsPath;?>plupload.flash.swf',
		filters : [
			/*{title : "Image files", extensions : "jpg,gif,png"},*/
			{title : "Zip files", extensions : "zip"}
		]
	});
	uploader.init();
	

	   /*

	uploader.bind('Init', function(up, params) {
		$('filelist').innerHTML = "<div>Current runtime: " + params.runtime + "</div>";
		
	});

	*/

	

	uploader.bind('BeforeUpload', function (up, file) {
		multi_selection:false;
		up.settings.multipart_params = {numfile: document.getElementById('filenum').value}
		document.getElementById('pickfiles').style.display="none";
	});
	    
	uploader.bind('FilesAdded', function(up, files) {
		
		for (var i in files) {
			$('filelist').innerHTML += '<div id="' + files[i].id + '">' + files[i].name + ' (' + plupload.formatSize(files[i].size) + ') <b id="'+files[i].id+'"></b></div>';
		}
		uploader.start();
	});

	uploader.bind('UploadProgress', function(up, file) {
		$(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span><div id='progress' class='progress-bar blue stripes'><span style='width: "+file.percent+"%'></span></div>";
			
	});

	uploader.bind('UploadComplete', function(up, file) {
  			// document.getElementById('progress_'+file.id).style.display="none";
			 document.getElementById('pickfiles').style.display="block";
		 //return false;
	});

	
	uploader.bind('FileUploaded', function(up, file, response) {

		//rsdata=response.toSource().split('@#$%*$%^');
	   
		rsdata=response.response;
		// console.log(response.response);
	
	    if(rsdata=='2')
	    {
		    
			window.location="index.php?mod=mod_gallery&view=addImage&id=<?php echo $_REQUEST['id'];?>";
	    	
	    }
	    else if(rsdata=='3')
		{
	    	// window.location="index.php?mod=mod_photoprinting&view=default&r=3";
	    	document.getElementById('errdiv').style.display="block";
	    	document.getElementById('errdiv').innerHTML="<?php echo Images_type_error; ?>";
			document.getElementById(''+file.id).style.display="none";
			document.getElementById('pickfiles').style.display="block";
	    	
	    }
	    else if(rsdata=='4')
	    {
		   // window.location="index.php?mod=mod_photoprinting&view=default&r=4";

	    	document.getElementById('errdiv').style.display="block";
	    	document.getElementById('errdiv').innerHTML="<?php echo Not_Zip_file; ?>";
			document.getElementById(''+file.id).style.display="none";
			document.getElementById('pickfiles').style.display="block";
	    }
	    else if(rsdata=='5')
	    { 
		     // $("#errdiv").show();
	    	//$("#errdiv").html('just test');

	    	document.getElementById('errdiv').style.display="block";
	    	document.getElementById('errdiv').innerHTML="<?php echo file_count_error; ?>";
	    	document.getElementById(''+file.id).style.display="none";
			document.getElementById('pickfiles').style.display="block";
		  //  window.location="index.php?mod=mod_photoprinting&view=default&r=1&nm=";
	    }

	    else if(rsdata=='6')
	    { 
		     // $("#errdiv").show();
	    	//$("#errdiv").html('just test');

	    	document.getElementById('errdiv').style.display="block";
	    	document.getElementById('errdiv').innerHTML="<?php echo file_count_error_fifty; ?>";
	    	document.getElementById(''+file.id).style.display="none";
			document.getElementById('pickfiles').style.display="block";
		  //  window.location="index.php?mod=mod_photoprinting&view=default&r=1&nm=";
	    }
	     
	  });
	  
	
});
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
	    document.getElementById('err_mess').innerHTML = 'Please select at least one record';

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
		 if(confirm('Do you really want to '+contr+' the record(s) ?'))
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
	    if (isEmpty(category_title, '<?php echo Category_Title;?>')) {
			return false;
		}
		else if(isLen(category_title,'151','<?php echo Category_Limit;?>')){
			return false;
		}else {
			submit();
		}
	}
}
function pageselectCallback(page_index, jq){
                // Get number of elements per pagionation page from form
                var items_per_page = $('#items_per_page').val();
                var max_elem = Math.min((page_index+1) * items_per_page, members.length);
                var newcontent = '';

                // Iterate through a selection of the content and build an HTML string
                for(var i=page_index*items_per_page;i<max_elem;i++)
                {
                    newcontent += '<dt>' + members[i][0] + '</dt>';
                    newcontent += '<dd class="state">' + members[i][2] + '</dd>';
                    newcontent += '<dd class="party">' + members[i][3] + '</dd>';
                }

                // Replace old content with new content
                $('#Searchresult').html(newcontent);

                // Prevent click eventpropagation
                return false;
            }

            // The form contains fields for many pagiantion optiosn so you can
            // quickly see the resuluts of the different options.
            // This function creates an option object for the pagination function.
            // This will be be unnecessary in your application where you just set
            // the options once.
            function getOptionsFromForm(){
                var opt = {callback: pageselectCallback};
                // Collect options from the text fields - the fields are named like their option counterparts
                $("input:text").each(function(){
                    opt[this.name] = this.className.match(/numeric/) ? parseInt(this.value) : this.value;
                });
                // Avoid html injections in this demo
                var htmlspecialchars ={ "&":"&amp;", "<":"&lt;", ">":"&gt;", '"':"&quot;"}
                $.each(htmlspecialchars, function(k,v){
                    opt.prev_text = opt.prev_text.replace(k,v);
                    opt.next_text = opt.next_text.replace(k,v);
                })
                return opt;
            }

            
           

</script>
<?php }?>
$(document).ready(function() {
	
	
		
	/*$('input').checkBox();
	$('#toggle-all').click(function(){
 	$('#toggle-all').toggleClass('toggle-checked');
	$('#mainform input[type=checkbox]').checkBox('toggle');
	return false;
	});*/

});

function displayOverLay(overlayId)
	 {  	
	 	 $(document).ready(function(){
			var overLayId = 'textOverLay_'+overlayId;
			$('#'+overLayId).show();
	});
}

function hideOverLay(overlayId)
	 {  	
	 	 $(document).ready(function(){
			var overLayId = 'textOverLay_'+overlayId;
			$('#'+overLayId).hide();
	});
}
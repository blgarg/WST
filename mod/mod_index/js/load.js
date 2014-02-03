// JavaScript Document
var islogin=false;
$(document).ready(function()
{   loadHome();
	
});	

/**Load Slider**/
function loadHome()
{   
  $('#content-txt').html('<div class="content-txt-mid" style="padding:0px;border:#D3D2CC 1px solid;width:997px; background:#FFFFFF; margin:auto;"><div class="content-txt-div"  style="background:#FFFFFF;width:96%;height:400px; padding:1% 2% 1% 2%; float:left;"><h1 align="center">PAGE NOT FOUND</h1><div class="clr"></div></div></div>');
$('div.content-txt-div').html("<div style='text-align:center;'><img src='./template/system/images/loader.gif'  id='loderImg'/></div>").fadeTo(900,1,function()
{  
  $.ajax({
			   type: "POST",
			   url: "./lib/landingPage.php",
			   data: "act=landingPage&randval="+ Math.random(),
				   success: function(data)
				   {
					
								$("#content-txt").fadeIn('slow');
								$("#content-txt").html(data);
								loadSlider();
								loadRecentActivity();
								loadFeaturedPost();
								loadFeaturedContest('1');
								loadTopRankedUsers();
						        if(varified){
						     	 showWaitPopUp('wait_for_registeration',0);
								}
					}
	 		});
	  
});
 }

/**Load Slider**/
function loadSlider()
{  
    
	  $.ajax({
			   type: "POST",
			   url: "./lib/getSlider.php",
			   data: "act=slider",
				   success: function(data)
				   {
					$("div#getSlider").fadeTo(10,1.0,function()
							{
								$("#getSlider").fadeIn('slow');
								$("#getSlider").html(data);
								setTimeout('runslider()',1000);
							 });
					}
	 		});
	  
  
 
 }
 
 /**Load Recent Activities**/
function loadRecentActivity()
{  
    
	$.ajax({
			   type: "POST",
			   url: "./lib/getRecentActivity.php",
			   data: "act=recentActivity",
				   success: function(data)
				   {
					$("div#getRecentActiveity").fadeTo(10,1.0,function()
							{
								$("#getRecentActiveity").fadeIn('slow');
								$("#getRecentActiveity").html(data);
							});
					}
	 		});
	  
  

 }

/**Load feature posts**/
function loadFeaturedPost()
{  
	  $.ajax({
			   type: "POST",
			   url: "./lib/blog.php",
			   data: "act=blog",
				   success: function(data)
				   {
						  $("div#featuredPost").fadeTo(10,1.0,function()
							{
								$("#featuredPost").fadeIn('slow');
								$("#featuredPost").html(data);
							 });
					}
	 		});
	  
  

 }
 
/**Load feature contest**/
function loadFeaturedContest(p)
{ 
	$("#content_f").fadeOut('fast');
		$.ajax({
			   	type: "POST",
				url: "./lib/featuredContest.php",
				data: "page="+p,
					success: function(data)
					{	
							$("div#content_f").fadeTo(30,1.0,function()
								{
										$("#content_f").fadeIn('slow');
										$("#content_f").html(data);
										$('#loderImg').hide();
								});
					}
			});		
								 


}

 /**Load TOP RANKED USERS**/
function loadTopRankedUsers()
{   
    
	  $.ajax({
			   type: "POST",
			   url: "./lib/topRanked.php",
			   data: "act=topRankedUsers",
				   success: function(data)
				   {
					$("div#getToRankedUsers").fadeTo(10,1.0,function()
							{
								$("#getToRankedUsers").fadeIn('slow');
								$("#getToRankedUsers").html(data);
								
							 });
					}
	 		});
	  
   
	 
 }
 
 
  /**Load getMusicians**/
function getMusicians()
{   
     $('#content-txt').html('<div class="content-txt-mid" style="padding:0px;border:#D3D2CC 1px solid;width:997px; background:#FFFFFF; margin:auto;"><div class="content-txt-div"  style="background:#FFFFFF;width:96%;height:400px; padding:1% 2% 1% 2%; float:left;"><h1 align="center">PAGE NOT FOUND</h1><div class="clr"></div></div></div>');
$('div.content-txt-div').html("<div style='text-align:center;'><img src='./template/system/images/loader.gif'  id='loderImg'/></div>").fadeTo(900,1,function()
{
	  $.ajax({
			   type: "POST",
			   url: "./lib/getMusicians.php",
			   data: "act=getMusicians",
				   success: function(data)
				   {
					$("#content-txt").fadeTo(10,1.0,function()
							{
								$("#content-txt").fadeIn('slow');
								$("#content-txt").html(data);
							});
					}
	 		});
	  
    });
	 
 }


/**Load getFanHomepage**/
function getfanHomePage()
{   
$('#content-txt').html('<div class="content-txt-mid" style="padding:0px;border:#D3D2CC 1px solid;width:997px; background:#FFFFFF; margin:auto;"><div class="content-txt-div"  style="background:#FFFFFF;width:96%;height:400px; padding:1% 2% 1% 2%; float:left;"><h1 align="center">PAGE NOT FOUND</h1><div class="clr"></div></div></div>');
$('div.content-txt-div').html("<div style='text-align:center;'><img src='./template/system/images/loader.gif'  id='loderImg'/></div>").fadeTo(900,1,function()
{
	  $.ajax({
			   type: "POST",
			   url: "./lib/fan_default.php",
			   data: "act=getMusicians&randval="+ Math.random(),
				   success: function(data)
				   {
					hideAlert();
					$("#content-txt").fadeTo(10,1.0,function()
							{
								$("#content-txt").fadeIn('slow');
								$("#content-txt").html(data);
								UserprofileUser();
							});
					}
	 		});
	  
    });
	 
 }
 
 
 
 /**Load getArtistHomepage**/
function getArtistHomePage()
{   
    $('#content-txt').html('<div class="content-txt-mid" style="padding:0px;border:#D3D2CC 1px solid;width:997px; background:#FFFFFF; margin:auto;"><div class="content-txt-div"  style="background:#FFFFFF;width:96%;height:400px; padding:1% 2% 1% 2%; float:left;"><h1 align="center">PAGE NOT FOUND</h1><div class="clr"></div></div></div>');
	$('div.content-txt-div').html("<div style='text-align:center;'><img src='./template/system/images/loader.gif'  id='loderImg'/></div>").fadeTo(900,1,function()
	{
	 $.ajax({
			   type: "POST",
			   url: "./lib/artist_default.php",
			   data: "act=getMusicians&randval="+ Math.random(),
				   success: function(data)
				   {
					   hideAlert();
					   $("#content-txt").fadeTo(10,1.0,function()
							{
								
								$("#content-txt").fadeIn('slow');
								$("#content-txt").html(data);
								UserprofileUser();
								 
							});
					}
	 		});
	  
    });
	 
 }
 
 /**Load public profiles**/
function getPublicProfile(userId,userType)
{   
    var userType;
	var userUrl;
	userType = userType;
	if(userType == '1'){ userUrl =  './lib/artist_public.php';}
	if(userType == '2'){ userUrl =  './lib/fan_public.php';}
	 $('#content-txt').html('<div class="content-txt-mid" style="padding:0px;border:#D3D2CC 1px solid;width:997px; background:#FFFFFF; margin:auto;"><div class="content-txt-div"  style="background:#FFFFFF;width:96%;height:400px; padding:1% 2% 1% 2%; float:left;"><h1 align="center">PAGE NOT FOUND</h1><div class="clr"></div></div></div>');
$('div.content-txt-div').html("<div style='text-align:center;'><img src='./template/system/images/loader.gif'  id='loderImg'/></div>").fadeTo(900,1,function()
{
	  $.ajax({
			   type: "POST",
			   url: userUrl,
			   data: "act=getPublicProfiles&userId="+userId+"&randval="+ Math.random(),
				   success: function(data)
				   {
					$("#content-txt").fadeTo(10,1.0,function()
							{
								$("#content-txt").fadeIn('slow');
								$("#content-txt").html(data);
							});
					}
	 		});
	  
    });
	 
 }


function prev(p) 
{
	 $('#content_f').show("fast");
	 loadFeaturedContest(p);
 }
	
function next(p) 
{	 
	$('#content_f').show("fast");
	loadFeaturedContest(p);
 }	


function prevCompete(p,sortBy) 
{
	  getCompetePage(p,sortBy);
 }
	
function nextCompete(p,sortBy) 
{	 
	getCompetePage(p,sortBy);
 }

function prevMoreEntries(p,contest_id) 
{
	  getContestEntries(p,contest_id);
 }
	
function nextMoreEntries(p,contest_id) 
{	 
	getContestEntries(p,contest_id);
 }



function runslider() {
    $('#slider').nivoSlider({
        effect:'fade', // Specify sets like: 'fold,fade,sliceDown,sliceUp,random'
        slices:15, // For slice animations
        boxCols: 8, // For box animations
        boxRows: 4, // For box animations
        animSpeed:500, // Slide transition speed
        pauseTime:3000, // How long each slide will show
        startSlide:0, // Set starting Slide (0 index)
        directionNav:true, // Next & Prev navigation
        directionNavHide:true, // Only show on hover
        controlNav:true, // 1,2,3... navigation
        controlNavThumbs:false, // Use thumbnails for Control Nav
        controlNavThumbsFromRel:false, // Use image rel for thumbs
        controlNavThumbsSearch: '.jpg', // Replace this with...
        controlNavThumbsReplace: '_thumb.jpg', // ...this in thumb Image src
        keyboardNav:true, // Use left & right arrows
        pauseOnHover:true, // Stop animation while hovering
        manualAdvance:false, // Force manual transitions
        captionOpacity:0.8, // Universal caption opacity
        prevText: '<img src="./template/system/images/flash-lt-arrow.png">',  // Prev directionNav text
        nextText: '<img src="./template/system/images/flash-rt-arrow.png">', // Next directionNav text
		beforeChange: function(){}, // Triggers before a slide transition
        afterChange: function(){}, // Triggers after a slide transition
        slideshowEnd: function(){}, // Triggers after all slides have been shown
        lastSlide: function(){}, // Triggers when last slide is shown
        afterLoad: function(){} // Triggers when slider has loaded
    });

 }
 
 
function getContestDetail(contestId){
   
   $.ajax({
			   type: "POST",
			   url: "./lib/contestDetail.php",
			   data: "contestId="+contestId+"&act=landingPage",
				   success: function(data)
				   {
					
								$("#content-txt").fadeIn('slow');
								$("#content-txt").html(data);
								//loadFeaturedContest('1');
								//loadTopRankedUsers();
         	      }
	 	});
  }

 
/*****LOAD HTML FORM******/
function loadFanHTML(action)
{ 
	
	$.ajax({type: "POST",url: "./lib/fantemplate.php",data: "action="+action+"&randval="+ Math.random(),
		  success: function(data){
		   $("#user_content").fadeTo(10,1.0,function()
		   { $("#user_content").fadeIn('slow');
			 $("#user_content").html(data);
		    });
		}
	 });
 }

 /*****LOAD PLAYLIST******/
function load_play_list(videoId,userId)
{ 
	 var dataString;
	 dataString = "userId="+userId+"&youtube_video_id="+videoId;
	 
	 $.ajax({
          type: "POST",
          url: "./lib/usersModel.php",
          data: dataString+"&action=get_user_play_list",
		  dataType: 'json',
          cache: true,
          success: function(res){
			if(res.isAction == 1)
			{    
			  $("div#mainDiv").html(res.resp);
			  //if(parseInt(res.resp) !=1){$("div#mainDiv").html(res.resp);}
			  				
			}
          }
         });
}



function load_play_list_all_video(uId,userId)
{ 
	 var dataString;
	 dataString = "userId="+userId+"&uId="+uId;
	 
	 $.ajax({
          type: "POST",
          url: "./lib/usersModel.php",
          data: dataString+"&action=get_user_play_list_all_songs",
		  dataType: 'json',
          cache: true,
          success: function(res){
			if(res.isAction == 1)
			{    
			  $("div#mainDiv").html(res.resp);
			  //if(parseInt(res.resp) !=1){$("div#mainDiv").html(res.resp);}
			  				
			}
          }
         });
}




/*****LOAD HTML FORM******/
function loadPage(pageId)
{ 
    
$('#content-txt').html('<div class="content-txt-mid" style="padding:0px;border:#D3D2CC 1px solid;width:997px; background:#FFFFFF; margin:auto;"><div class="content-txt-div"  style="background:#FFFFFF;width:96%;height:400px; padding:1% 2% 1% 2%; float:left;"><h1 align="center">PAGE NOT FOUND</h1><div class="clr"></div></div></div>');
	$('div.content-txt-div').html("<div style='text-align:center;'><img src='./template/system/images/loader.gif'  id='loderImg'/></div>").fadeTo(900,1,function()
	{$.ajax({ type: "POST",
			   url: "./lib/page.php",
			   data: "act=loadPage&pageId="+pageId+"&randval="+ Math.random(),
				   success: function(data)
				   { $("#content-txt").fadeTo(10,1.0,function(){$("#content-txt").fadeIn('slow');$("#content-txt").html(data);});}
			});
	});
 }
 
 
 
 function featuredArtist(pageId)
{ 
   $.ajax({ type: "POST",
			   url: "./lib/featuredArtist.php",
			   data: "act=loadPage&pageId="+pageId+"&randval="+ Math.random(),
				   success: function(data)
				   { $("#content-txt").fadeTo(10,1.0,function(){$("#content-txt").fadeIn('slow');$("#content-txt").html(data);});}
			});
	
 }
 
 
 function getMoreRecentActivities(){
    
	 $.ajax({ type: "POST",
			   url: "./lib/getRecentActivityMore.php",
			   data: "act=loadPage&randval="+ Math.random(),
				   success: function(data)
				   { $("#content-txt").fadeTo(10,1.0,function(){$("#content-txt").fadeIn('slow');$("#content-txt").html(data);});}
			});
	
 }
 
 
  function featuredVideo(pageId)
{ 
   $.ajax({ type: "POST",
			   url: "./lib/featuredVideos.php",
			   data: "act=loadPage&pageId="+pageId+"&randval="+ Math.random(),
				   success: function(data)
				   { $("#content-txt").fadeTo(10,1.0,function(){$("#content-txt").fadeIn('slow');$("#content-txt").html(data);});}
			});
	
 }
 
 
 
 function topRanking(pageId)
{ 
   $.ajax({ type: "POST",
			   url: "./lib/toprankig.php",
			   data: "act=loadPage&pageId="+pageId+"&randval="+ Math.random(),
				   success: function(data)
				   { $("#content-txt").fadeTo(10,1.0,function(){$("#content-txt").fadeIn('slow');$("#content-txt").html(data);});}
			});
	
 }



  function getuserProfile(){
   userType=getUserType() ;
   if(parseInt(userType) == 1){
   getArtistHomePage();
   }else if(parseInt(userType) == 2){
   getfanHomePage();
  }else{
	getfanHomePage();
	}
 }
  
/** LOAD COMPETE PAGE**/
function getCompetePage(p,SORT_BY_WHAT)
{   
    var sort_by;
	if(SORT_BY_WHAT){sort_by = SORT_BY_WHAT;}
	else{sort_by = '';}
	$('#content-txt').html('<div class="content-txt-mid" style="padding:0px;border:#D3D2CC 1px solid;width:997px; background:#FFFFFF; margin:auto;"><div class="content-txt-div"  style="background:#FFFFFF;width:96%;height:700px; padding:1% 2% 1% 2%; float:left;"><h1 align="center">PAGE NOT FOUND</h1><div class="clr"></div></div></div>');
	$('div.content-txt-div').html("<div style='text-align:center;'><img src='./template/system/images/loader.gif'  id='loderImg'/></div>").fadeTo(900,1,function()
	{
	 try{
		 
	 $.ajax({
			   type: "POST",
			   url: "./lib/competePage.php",
			   data: "page="+p+"&act=getCompetePage&SORT_BY_WHAT="+sort_by+"&randval="+ Math.random(),
				   success: function(data)
				   {
					 $("#content-txt").fadeTo(10,1.0,function()
							{
								$("#content-txt").fadeIn('slow');
								$("#content-txt").html(data);
							});
					}
	 		});
	  }catch(e){}
    });
 }
 
 
 
 
 function getDiscoverPage(modelId)
{   
	$('#content-txt').html('<div class="content-txt-mid" style="padding:0px;border:#D3D2CC 1px solid;width:997px; background:#FFFFFF; margin:auto;"><div class="content-txt-div"  style="background:#FFFFFF;width:96%;height:700px; padding:1% 2% 1% 2%; float:left;"><h1 align="center">PAGE NOT FOUND</h1><div class="clr"></div></div></div>');
	$('div.content-txt-div').html("<div style='text-align:center;'><img src='./template/system/images/loader.gif'  id='loderImg'/></div>").fadeTo(900,1,function()
	{
	 try{
		
		 modelId = parseInt(modelId);
	$.ajax({
			   type: "POST",
			   url: "./lib/discoverPage.php",
			   data: "act=changeModel&modelId="+modelId+"&randval="+ Math.random(),
				   success: function(data)
				   {
					 $("#content-txt").fadeTo(10,1.0,function()
							{
								$("#content-txt").fadeIn('slow');
								$("#content-txt").html(data);
							    $("#selectdModel").val(modelId);
								for(i=1;i<7;i++){
								    if(i==parseInt(modelId)){
									 document.getElementById("model"+i).setAttribute("class", "org_sltd");
									}else{
								    document.getElementById("model"+i).setAttribute("class", "grey_txt_box");
									}
								}
							});
					}
	 		});
	  }catch(e){}
    });
 }
 
 
 
 function getDiscoverPageLeftPanel(modelId)
{   
	
	   $("#selectdModel").val(modelId);
	    
	$('#dis_rt_mid').html("<div style='text-align:center;'><img src='./template/system/images/loader.gif'  id='loderImg'/></div>").fadeTo(900,1,function()
	{
	  $.ajax({
			   type: "POST",
			   url: "./lib/discoverPage.php",
			   data: "act=getLeftPanel&modelId="+modelId+"&randval="+ Math.random(),
				   success: function(data)
				   {
					 $("#dis_rt_mid").fadeTo(10,1.0,function()
							{
								$("#dis_rt_mid").fadeIn('slow');
								$("#dis_rt_mid").html(data);
							    for(i=1;i<7;i++){
								    if(i==parseInt(modelId)){
									 document.getElementById("model"+i).setAttribute("class", "org_sltd");
									}else{
								    document.getElementById("model"+i).setAttribute("class", "grey_txt_box");
									}
								}
						   });
					 }
	 		   });
	    });
   
 }
 
 
 
  function getDiscoverFilterResults(modelId)
{   
	modelId = $("#selectdModel").val();
	var subscribers = $("#subscriber_amount").val();
	var views = $("#views_amount").val();
	var rating = $("#avg_rating_amount").val();
	
	
	$('#dis_rt_mid').html("<div style='text-align:center;'><img src='./template/system/images/loader.gif'  id='loderImg'/></div>").fadeTo(900,1,function()
	{
	  $.ajax({
			   type: "POST",
			   url: "./lib/discoverPage.php",
			   data: "act=getLeftPanel&modelId="+modelId+"&subscriber="+subscribers+"&views="+views+"&rating="+rating+"&randval="+ Math.random(),
				   success: function(data)
				   {
					 $("#dis_rt_mid").fadeTo(10,1.0,function()
							{
								$("#dis_rt_mid").fadeIn('slow');
								$("#dis_rt_mid").html(data);
							    for(i=1;i<7;i++){
								    if(i==parseInt(modelId)){
									 document.getElementById("model"+i).setAttribute("class", "org_sltd");
									}else{
								    document.getElementById("model"+i).setAttribute("class", "grey_txt_box");
									}
								}
							});
					}
	 		});
	   });
   
 }
 
 
function getContestEntries(p,contestId){
    $.ajax({
			   type: "POST",
			   url: "./lib/moreEntries.php",
			   data: "page="+p+"&contestId="+contestId+"&act=getContestEntries",
				   success: function(data)
				   {
					
								$("#content-txt").fadeIn('slow');
								$("#content-txt").html(data);
								//loadFeaturedContest('1');
								//loadTopRankedUsers();
         	      }
	 	});
  }
  
  
  function getModelDescription(modelId){
       
	   modelId = parseInt(modelId);
								switch(modelId){
							  case 1 :
							  $('#model_detail_description').html('<i> Most Influence - The overall Tunezy ranking.  This takes into account everything that makes an artist relevant on the web.  Views, fans, social connectivity - everything is considered.</i>');
							  break;
							 case 2 :
							 $('#model_detail_description').html('<i> Going Viral - These artists have recently started turning heads.  Find out who is blowing up, and help spread the word.</i>');
							 break;
							 case 3 :
							 $('#model_detail_description').html('<i> The Young and Talented - The next Beiber is lurking here.  Discover the natural talent of the world\'s youth!.</i>');
							 break;
							 
							 case 4 :  
							 $('#model_detail_description').html('<i> The Most Discussed - Want to be in the loop?  See which artists are being commented on most.</i>');
							 break;
							 
							 case 5 :  
							 $('#model_detail_description').html('<i> Recently Released - Want to know the latest releases before anyone else?  Check out which amazing artists have released videos very recently.</i>');
							 break;
							 
							 case 6 :  
							 $('#model_detail_description').html('<i> The Most Favored  -  See who is loved the most in the Tunezy Community!.</i>');
							 break;
							
						    default:
							}
  }
  
/*****LOAD PLAYLIST******/
function UserprofileUser()
{ 
 
   $('div#setUserProfileImage').html("<div style='text-align:center;'><img src='./template/system/images/loader.gif'  id='loderImg'/></div>").fadeTo(900,1,function()
	{
	  $("div#setUserProfileImage").html();
	 try{
	 $.ajax({
		type: "POST",
          url: "./lib/usersModel.php",
          data: "action=USER_PROFILE_IMAGES&randval="+ Math.random(),
		  dataType: 'json',
          cache: false,
          success: function(res){
			if(res.isAction == 1)
			{    
			  $("div#setUserProfileImage").html(res.IMAGE);
			  //if(parseInt(res.resp) !=1){$("div#mainDiv").html(res.resp);}
			  				
			}
          }
	 		});
	  }catch(e){}
    });
 }

function showChangePicOption()
{  	$(document).ready(function(){
		$("#changeProfilePicsUser").show();
	});
}
function HideChangePicOption()
{  $(document).ready(function(){
		$("#changeProfilePicsUser").hide();
	});
}	


 /*****Load Video Rank******/
function load_video_rank(videoId,contestId,action_like_or_dislike)
{ 
	 var dataString;
	 dataString = "contestId="+contestId+"&videoId="+videoId;
	 
	 $.ajax({
          type: "POST",
          url: "./lib/doVideoRank.php",
          data: dataString+"&action="+action_like_or_dislike+"&randval="+ Math.random(),
		  dataType: 'json',
          cache: true,
          success: function(res){
			if(res.isAction == 1)
			{  
			 $("div#mainDiv").html(res.resp);
			if(res.action == 'like')
			{
			  $("#like_"+videoId).html("<img src='./template/system/images/loader.gif'  id='loderImg' height='30'/>").fadeTo(900,1,function(){
				$("#like_"+videoId).html('Likes '+res.num_likes);
			 });
			}
			 
			 if(res.action == 'dislike'){
				$("#dislike_"+videoId).html("<img src='./template/system/images/loader.gif'  id='loderImg' height='30'/>").fadeTo(900,1,function(){
				$("#dislike_"+videoId).html('Dislikes '+res.num_dislikes);
			 });
			 }
			 
			  //if(parseInt(res.resp) !=1){$("div#mainDiv").html(res.resp);}
			  				
			}
          }
      });
}


/*****Load Video Comments******/
function load_video_comments(videoId,contestId)
{ 
	 var dataString;
	 dataString = "contestId="+contestId+"&videoId="+videoId;
	 $.ajax({
          type: "POST",
          url: "./lib/video_comment.php",
          data: dataString+"&action=load_video_comments&randval="+ Math.random(),
		  dataType: 'json',
          cache: true,
          success: function(res){
			if(res.isAction == 1)
			{  
			 $("div#video_comments_mainDiv").html("<img src='./template/system/images/loader.gif'  id='loderImg' height='100'/>").fadeTo(900,1,function(){
				$("div#video_comments_mainDiv").html(res.resp);
				
			 });
			}
          }
      });
}

/*****Load Video Comments******/
function post_video_comments(videoId,contestId)
{ 
	
	var dataString;
	 var _comment_text;
	 _comment_text = $("#post_comment_text").val();
	 dataString = "contestId="+contestId+"&videoId="+videoId+"&comment_text="+_comment_text;
	 if(_comment_text != ''){
	 $.ajax({
          type: "POST",
          url: "./lib/video_comment.php",
          data: dataString+"&action=save_video_comments&randval="+ Math.random(),
		  dataType: 'json',
          cache: true,
          success: function(res){
			if(res.isAction == 1)
			{  
			   $("span#post_image_load").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='./template/system/images/ajax-loader_2.gif'  id='loderImg' height='20'/><br />").fadeTo(900,1,function(){
			        
					 load_video_comments_test(videoId,contestId);
					        			        			 
			 });
			}
          }
      });
	 }else{
	 alert('Please enter comment.');
	 }
}


function load_video_comments_test(videoId,contestId)
{ 
	 var dataString;
	 dataString = "contestId="+contestId+"&videoId="+videoId;
	 $.ajax({
          type: "POST",
          url: "./lib/video_comment.php",
          data: dataString+"&action=load_video_comments&randval="+ Math.random(),
		  dataType: 'json',
          cache: true,
          success: function(res){
			if(res.isAction == 1)
			{  
			 $("div#video_comments_mainDiv").fadeTo(900,1,function(){
				$("div#video_comments_mainDiv").html(res.resp);
				
			 });
			}
          }
      });
}

function delete_comment(comment_id)
{ 
	 var dataString;
	 dataString = "comment_id="+comment_id;
	 $.ajax({
          type: "POST",
          url: "./lib/video_comment.php",
          data: dataString+"&action=delete_video_comment&randval="+ Math.random(),
		  dataType: 'json',
          cache: true,
          success: function(res){
			if(res.isAction == 1)
			{  
			 	$("p#comment_id_"+res.comment_id).fadeOut("slow");
			}
          }
      });
}

/*********ADD TO MY TUNE CREW**********/
function addToMyTuneCrewFunc(fanId,ArtistId){
var getFanId;
var getArtistId;
try{	
		getFanId = parseInt(fanId);
		getArtistId = parseInt(ArtistId);
		$.ajax({
		type: "POST",
        url: "./lib/usersModel.php",
        data: "action=fan_add_to_my_tune_crew&getFanId="+getFanId+"&getArtistId="+getArtistId+"&randval="+ Math.random(),
		dataType: 'json',
        cache: false,
        success: function(res){
		if(res.isAction == 1){    
			if(res.status == 1){
				$("a#addToMyTuneCrewFunc_id").hide();
				alert("Successfully added to your account.");
			}
		if(res.status == 2){
				$("a#addToMyTuneCrewFunc_id").show();
				alert("Sorry, There is something missing.");
			}
		} // END OF SUCCESS
        }
	 		}); // END OF AJAX
}catch(e){} // END OF TRY AND CATCH

} // END OF FUNCTION 


/*********ADD TO MY FAVOURIT ARTIST**********/
function addMyCurrentFavouritArtistFunc(fanId,ArtistId){
var getFanId;
var getArtistId;
try{	
		getFanId = parseInt(fanId);
		getArtistId = parseInt(ArtistId);
		$.ajax({
		type: "POST",
        url: "./lib/usersModel.php",
        data: "action=fan_add_to_my_favourit_artist&getFanId="+getFanId+"&getArtistId="+getArtistId+"&randval="+ Math.random(),
		dataType: 'json',
        cache: false,
        success: function(res){
		if(res.isAction == 1){    
			if(res.status == 1){
				$("a#addMyCurrentFavouritArtistFunc_id").hide();
				alert("Successfully added to your account.");
			}
		if(res.status == 2){
				$("a#addMyCurrentFavouritArtistFunc_id").show();
				alert("Sorry, There is something missing.");
			}
		}
        }// END OF SUCCESS
	 		}); // END OF AJAX
}catch(e){} // END OF TRY AND CATCH

} // END OF FUNCTION

// Share Profile
function fbs_click(){
	u=location.href;
    t=document.title;
    window.open('http://www.facebook.com/sharer.php?u=http://tunezy.com&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=726,height=436');return false;
}


/*********LOAD DISCOVER PAGE**********/
function contestArchivesPage(){
try{	
		$('#content-txt').html('<div class="content-txt-mid" style="padding:0px;border:#D3D2CC 1px solid;width:997px; background:#FFFFFF; margin:auto;"><div class="content-txt-div"  style="background:#FFFFFF;width:96%;height:400px; padding:1% 2% 1% 2%; float:left;"><h1 align="center">PAGE NOT FOUND</h1><div class="clr"></div></div></div>');
	$('div.content-txt-div').html("<div style='text-align:center;'><img src='./template/system/images/loader.gif'  id='loderImg'/></div>").fadeTo(900,1,function()
	{$.ajax({ type: "POST",
			   url: "./lib/Archives.php",
			   data: "action=contestArchivesPage&randval="+ Math.random(),
				   success: function(data)
				   { $("#content-txt").fadeTo(10,1.0,function(){$("#content-txt").fadeIn('slow');$("#content-txt").html(data);});}
			});
	});
	
}catch(e){} // END OF TRY AND CATCH


} // END OF FUNCTION



function searchArtist(){

 $('#dis_rt_mid').html("<div style='text-align:center;'><img src='./template/system/images/loader.gif'  id='loderImg'/></div>").fadeTo(900,1,function()
	{
	  $.ajax({
			   type: "POST",
			   url: "./lib/discoverPage.php",
			   data: "act=searchArtistviaName&artistName="+$('#get_artist_name').val()+"&randval="+ Math.random(),
				   success: function(data)
				   {
					 $("#dis_rt_mid").fadeTo(10,1.0,function()
							{
								$("#dis_rt_mid").fadeIn('slow');
								$("#dis_rt_mid").html(data);
							});
					}
	 		});
	   });
   
 }
 
 
 
 
 function searchArtistHome(){
 $('#content-txt').html('<div class="content-txt-mid" style="padding:0px;border:#D3D2CC 1px solid;width:997px; background:#FFFFFF; margin:auto;"><div class="content-txt-div"  style="background:#FFFFFF;width:96%;height:400px; padding:1% 2% 1% 2%; float:left;"><h1 align="center">PAGE NOT FOUND</h1><div class="clr"></div></div></div>');
	$('div.content-txt-div').html("<div style='text-align:center;'><img src='./template/system/images/loader.gif'  id='loderImg'/></div>").fadeTo(900,1,function()
	{
	 $.ajax({
			   type: "POST",
			   url: "./lib/search.php",
			   data: "act=searchArtistviaName&artistName="+$('#get_artist_name_home').val()+"&randval="+ Math.random(),
				   success: function(data)
				   {
					 $("#content-txt").fadeTo(10,1.0,function()
							{
								$("#content-txt").fadeIn('slow');
								$("#content-txt").html(data);
							});
					}
	 		});
	   });
   
 }
 
 
 function getUserinfo(youTubeId,ImgSrc,ArtistName,userId){
	
    $.ajax({
			   type: "POST",
			   url: "./lib/discoverPage.php",
			   data: "act=getArtistDetail&artistName="+ArtistName+"&artistPic="+ImgSrc+"&youtubeId="+youTubeId+"&userId="+userId+"&randval="+ Math.random(),
				   success: function(data)
				   {
					  $('#UserInfoContent').html(data);
				      showPopForUserInfo('showPopForUserInfo');
				  }
	 		});
   
 }// END OF FUNCTION


/*********LOAD ARCHIEVES CONTENT**********/
function contestArchivesPage_Content(archive_year_month){
try{	
		$('#content-txt').html('<div class="content-txt-mid" style="padding:0px;border:#D3D2CC 1px solid;width:997px; background:#FFFFFF; margin:auto;"><div class="content-txt-div"  style="background:#FFFFFF;width:96%;height:400px; padding:1% 2% 1% 2%; float:left;"><h1 align="center">PAGE NOT FOUND</h1><div class="clr"></div></div></div>');
	$('div.content-txt-div').html("<div style='text-align:center;'><img src='./template/system/images/loader.gif'  id='loderImg'/></div>").fadeTo(900,1,function()
	{$.ajax({ type: "POST",
			   url: "./lib/Archives.php",
			   data: "action=getArchiveContestPage&archive_year_month="+archive_year_month+"&randval="+ Math.random(),
				   success: function(data)
				   { $("#content-txt").fadeTo(10,1.0,function(){$("#content-txt").fadeIn('slow');$("#content-txt").html(data);});}
			});
	});
	
}catch(e){} // END OF TRY AND CATCH

} // END OF FUNCTION

// go back function 
function goback(page){
	pageId = parseInt(page);
	switch(pageId)
	{
	case 1:
	  getCompetePage(1);	
	  break;
	case 2:
	 break;
	}
} // END GOBACK

//Auto Complete 
function getValue(){
	
	$.ajax({
		type: "POST",
        url: "./lib/usersModel.php",
        data: "action=getArtistSuggestion&randval="+ Math.random(),
		dataType: 'json',
        cache: false,
        success: function(res){
			if(res.isAction == 1){
			var userS = eval(res.NameUserId);
			$("#get_artist_name").focus().autocomplete(userS);
			}
        }// END OF SUCCESS
	 }); // END OF AJAX
	
}// END Auto Complete >>>>>>> .r463


function getValueHome(){
	
	$.ajax({
		type: "POST",
        url: "./lib/usersModel.php",
        data: "action=getArtistSuggestion&randval="+ Math.random(),
		dataType: 'json',
        cache: false,
        success: function(res){
			if(res.isAction == 1){
			var userS = eval(res.NameUserId);
			$("#get_artist_name_home").focus().autocomplete(userS);
			}
        }// END OF SUCCESS
	 }); // END OF AJAX
	
}// END Auto Complete >>>>>>> .r463


function addSongTovideoList(youtubeId,uId){
   ytVideoApp.listVideoaddtoplayList(youtubeId,uId); 
}

//Load Person Too Profile Pic
$(function()
{
  var hideDelay = 500;  
  var currentID;
  var hideTimer = null;
  var container = $('<div id="personPopupContainer">'
      + '<table width="" border="0" cellspacing="0" cellpadding="0" align="center" class="personPopupPopup">'
      + '<tr>'
      + '   <td class="corner topLeft"></td>'
      + '   <td class="top"></td>'
      + '   <td class="corner topRight"></td>'
      + '</tr>'
      + '<tr>'
      + '   <td class="left">&nbsp;</td>'
      + '   <td><div id="personPopupContent"></div></td>'
      + '   <td class="right">&nbsp;</td>'
      + '</tr>'
      + '<tr>'
      + '   <td class="corner bottomLeft">&nbsp;</td>'
      + '   <td class="bottom">&nbsp;</td>'
      + '   <td class="corner bottomRight"></td>'
      + '</tr>'
      + '</table><div class="pointer"></div>'
      + '</div>');

  $('body').append(container);
  $('.personPopupTrigger').live('mouseover', function()
  {
      // format of 'rel' tag: pageid,personguid
      var settings = $(this).attr('rel').split(',');
      var pageID = settings[1];
      currentID = settings[0];
	  var brosers;
	  var browser_version;
	  // If no guid in url rel tag, don't popup blank
      if (currentID == '')
          return;

      if (hideTimer)
          clearTimeout(hideTimer);

      var pos = $(this).offset();
      var width = $(this).width();
	   var height = $(this).height();
	   var margin_top = 220;
        if ( $.browser.mozilla) {
    		margin_top = 220;
		}
  		if ($.browser.webkit) {
			margin_top = 220;  		
		}
   		if ($.browser.msie) {
   		   margin_top = 150;
  		}


	 
      container.css({
          //left: (pos.left + width) + 'px',
         // top: pos.top - 5 + 'px'
		 
		 left: (pos.left + 30) + 'px',
         top: pos.top + -margin_top+ 'px'
      });
	 
	   
  	 $('#personPopupContent').html('&nbsp;');
		
      $.ajax({
          type: 'GET',
          url: './lib/html/userToolTp.php',
          data: 'page=' + pageID + '&userId=' + currentID,
          success: function(data)
          {
              // Verify that we're pointed to a page that returned the expected results.
              if (data.indexOf('personPopupResult') < 0)
              {
               $('#personPopupContent').html('<span >Page ' + pageID + ' did not return a valid result for person ' + currentID + 'Please have your administrator check the error log.</span>');
              }
          	$('#personPopupContent').html(data);
           
          }
      });

      container.css('display', 'block');
  });

  $('.personPopupTrigger').live('mouseout', function()
  {
      if (hideTimer)
          clearTimeout(hideTimer);
      hideTimer = setTimeout(function()
      {
          container.css('display', 'none');
      }, hideDelay);
  });

  // Allow mouse over of details without hiding details
  $('#personPopupContainer').mouseover(function()
  {
      if (hideTimer)
          clearTimeout(hideTimer);
  });

  // Hide after mouseout
  $('#personPopupContainer').mouseout(function()
  {
      if (hideTimer)
          clearTimeout(hideTimer);
      hideTimer = setTimeout(function()
      {
          container.css('display', 'none');
      }, hideDelay);
  });
});
// End Profile Pic

//Search Website functions
function searchWebsite(searchedText){
	try{	
		$('#content-txt').html('<div class="content-txt-mid" style="padding:0px;border:#D3D2CC 1px solid;width:997px; background:#FFFFFF; margin:auto;"><div class="content-txt-div"  style="background:#FFFFFF;width:96%;height:400px; padding:1% 2% 1% 2%; float:left;"><h1 align="center">PAGE NOT FOUND</h1><div class="clr"></div></div></div>');
	$('div.content-txt-div').html("<div style='text-align:center;'><img src='./template/system/images/loader.gif'  id='loderImg'/></div>").fadeTo(900,1,function()
	{$.ajax({ type: "POST",
			   url: "./lib/Archives.php",
			   data: "action=getArchiveContestPage&archive_year_month="+archive_year_month+"&randval="+ Math.random(),
				   success: function(data)
				   { $("#content-txt").fadeTo(10,1.0,function(){$("#content-txt").fadeIn('slow');$("#content-txt").html(data);});}
			});
	});
	
}catch(e){} // END OF TRY AND CATCH

return false;
}
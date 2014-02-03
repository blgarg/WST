/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email

*/
/** * provides namespacing for the YouTube Video Application PHP version (ytVideoApp */
var ytVideoApp = {};
ytVideoApp.MAX_RESULTS_LIST = 4;
/*** navigation button id used to page to the previous page of*/
ytVideoApp.PREVIOUS_PAGE_BUTTON = 'previousPageButton';
/*** navigation button id used to page to the next page of*/
ytVideoApp.NEXT_PAGE_BUTTON = 'nextPageButton';
/*** container div for navigation elements*/
ytVideoApp.NAVIGATION_DIV = 'navigationForm';
/*** container div id used to hold list of videos*/
ytVideoApp.VIDEO_LIST_CONTAINER_DIV = 'searchResultsVideoList';
/* * container div id used to hold video search results*/
ytVideoApp.VIDEO_SEARCH_RESULTS_DIV = 'searchResultsVideoColumn';
/**container div id used to hold the video player*/
ytVideoApp.VIDEO_PLAYER_DIV = 'videoPlayer';
/** * container div id used to hold the search box displayed at the top of*/
ytVideoApp.TOP_SEARCH_CONTAINER_DIV = 'searchBox';
/** container div to show detailed upload status*/
ytVideoApp.VIDEO_UPLOAD_STATUS = 'detailedUploadStatus';
/** * container div to hold the form for syndicated upload*/
ytVideoApp.SYNDICATED_UPLOAD_DIV = 'videouploadform';
/** * container div to hold the form to edit video meta-data*/
ytVideoApp.VIDEO_DATA_EDIT_DIV = 'editForm';
/** * containder div to hold authentication link in special cases where auth gets*/
ytVideoApp.AUTHSUB_REQUEST_DIV = 'generateAuthSubLink';
/** * container div to hold the form for editing video meta-data*/
ytVideoApp.VIDEO_META_DATA_EDIT_DIV = 'editVideoMetaDataDiv';
/*** container div to hold the form for adding a new playlist*/
ytVideoApp.PLAYLIST_ADD_DIV = 'addNewPlaylist';
/*** the page number to use for the next page navigation button*/
ytVideoApp.nextPage = 2;
/**
 * the page number to use for the previous page navigation button
 * @type Number
 */
ytVideoApp.previousPage = 0;

/** * the last search term used to query - allows for the navigation*/
ytVideoApp.previousSearchTerm = '';

/*** the last query type used for querying - allows for the navigation*/
ytVideoApp.previousQueryType = 'all';
ytVideoApp.listVideos = function(op, searchTerm, page, sortBy,uId) {
   ytVideoApp.previousSearchTerm = searchTerm; 
  ytVideoApp.previousQueryType = op; 
  var maxResults = ytVideoApp.MAX_RESULTS_LIST;
  var startIndex =  (((page - 1) * ytVideoApp.MAX_RESULTS_LIST) + 1);
  ytVideoApp.presentFeed(op, maxResults, startIndex, searchTerm,sortBy,uId);
 };
ytVideoApp.listVideosuser = function(op, searchTerm, page, sortBy,uId) {
   ytVideoApp.previousSearchTerm = searchTerm; 
  ytVideoApp.previousQueryType = op; 
  var maxResults = ytVideoApp.MAX_RESULTS_LIST;
  var startIndex =  (((page - 1) * ytVideoApp.MAX_RESULTS_LIST) + 1);
  ytVideoApp.presentFeeduser(op, maxResults, startIndex, searchTerm,sortBy,uId);
 };
ytVideoApp.listVideoaddtoplayList = function(youtubeId,uId) {
 
  var params ='operation=addtoplayList&youtubeId='+youtubeId+'&uId='+uId;
   var filePath = 'lib/youtube.php';
   ytVideoApp.sendRequestAddtoplayList(filePath,params, '',uId); 
 };
/** Sends an AJAX request to the server to retrieve a list of videos or*/
ytVideoApp.sendRequest = function(filePath, params, resultDivName) {
	 
	if (window.XMLHttpRequest) {
    var xmlhr = new XMLHttpRequest();
  } else {
    var xmlhr = new ActiveXObject('MSXML2.XMLHTTP.3.0');
  }

  xmlhr.open('POST', filePath);
  xmlhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
  
  xmlhr.onreadystatechange = function() {
    var resultDiv = document.getElementById(resultDivName);
	 if(resultDiv){
	 resultDiv.innerHTML = '<img src="template/system/images/loader.gif" alt="wait" />';
	 }
    if (xmlhr.readyState == 1) {
     } else if (xmlhr.readyState == 4 && xmlhr.status == 200) {
      if (xmlhr.responseText) {
		 $('#type').val('1');
         if(resultDiv){
		 resultDiv.innerHTML = xmlhr.responseText;
			 if(document.getElementById('searchResultsVideoListMore')){
			  document.getElementById('searchResultsVideoListMore').innerHTML = xmlhr.responseText;
			 }
		 }else{
		$('#wait_for_registeration').hide();
		 $('#isyoutubeauth').val('1');
		 $('#facebookUsername').val('');
		 $('#userBio').show();
		 var myJSONObject =eval('(' +xmlhr.responseText+ ')');
		 if(myJSONObject.fristName){
		 $('#first_name').val(myJSONObject.fristName)
		 }
		 if(myJSONObject.lastName){
		 $('#last_name').val(myJSONObject.lastName)
		 }
		  if(myJSONObject.userName){
		  
		  $('#username_add').val(myJSONObject.userName)
		}
		 if(myJSONObject.bio){
		  $('#bio').val(myJSONObject.bio)
		 }
		 
		  if(myJSONObject.location){
		}
		 
		if(myJSONObject.countryIndex){
		    $("#country").attr('selectedIndex', myJSONObject.countryIndex);
		}
		 if(myJSONObject.subscriber){
			   $('#subscriber').val(myJSONObject.subscriber);
			 }
		if(myJSONObject.hometown){
			   $('#stateText').val(myJSONObject.hometown);
			 }	 
	     if(myJSONObject.prifilePicUrl){
			   $('#youtubepic').val(myJSONObject.prifilePicUrl);
		 }
		 if(myJSONObject.gender && myJSONObject.gender=='f'){
		 $('#female').attr('checked', true);
         }
		  showWaitPopUp('sign_up',1)	
		}
     }
 } else if (xmlhr.readyState == 4) {
   }
  }
  xmlhr.send(params);
 }
ytVideoApp.sendFeedRequest = function(filePath, params, resultDivName) {
	if (window.XMLHttpRequest) {
    var xmlhr = new XMLHttpRequest();
  } else {
    var xmlhr = new ActiveXObject('MSXML2.XMLHTTP.3.0');
  }
xmlhr.open('POST', filePath);
  xmlhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
   xmlhr.onreadystatechange = function() {
  if (xmlhr.readyState == 1) {
     } else if (xmlhr.readyState == 4 && xmlhr.status == 200) {
      if (xmlhr.responseText) {
		$('#mereyoutube').html(xmlhr.responseText);
	}
 } else if (xmlhr.readyState == 4) {
     }
  }
  xmlhr.send(params);
 }
ytVideoApp.sendRequestMywork = function(filePath, params, resultDivName) {
	 
	if (window.XMLHttpRequest) {
    var xmlhr = new XMLHttpRequest();
  } else {
    var xmlhr = new ActiveXObject('MSXML2.XMLHTTP.3.0');
  }
xmlhr.open('POST', filePath);
  xmlhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
  
  xmlhr.onreadystatechange = function() {
    var resultDiv = document.getElementById(resultDivName);
	 if(resultDiv){
	 resultDiv.innerHTML = '<img src="template/system/images/loader.gif" alt="wait" />';
	 }
    if (xmlhr.readyState == 1) {
     } else if (xmlhr.readyState == 4 && xmlhr.status == 200) {
      if (xmlhr.responseText) {
		$('#type').val('1');
		 listVideo = xmlhr.responseText.split('@@@');
		 resultDiv.innerHTML = listVideo[0];
			 if(document.getElementById('searchResultsVideoListMore')){
			 if(listVideo[1]){
			 $('#view_more_video').show();
			  document.getElementById('searchResultsVideoListMore').innerHTML = listVideo[1];
			 }else{
			  $('#view_more_video').hide();
			 }
			 }
	 }
 } else if (xmlhr.readyState == 4) {
   }
  }
  xmlhr.send(params);
 }
ytVideoApp.sendRequestMyworkuser = function(filePath, params, resultDivName){
	if (window.XMLHttpRequest) {
    var xmlhr = new XMLHttpRequest();
  } else {
    var xmlhr = new ActiveXObject('MSXML2.XMLHTTP.3.0');
  }
xmlhr.open('POST', filePath);
  xmlhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
  xmlhr.onreadystatechange = function() {
    var resultDiv = document.getElementById(resultDivName);
	 if(resultDiv){
	 resultDiv.innerHTML = '<img src="template/system/images/loader.gif" alt="wait" />';
	 }
    if (xmlhr.readyState == 1) {
     } else if (xmlhr.readyState == 4 && xmlhr.status == 200) {
      if (xmlhr.responseText) {
		 listVideo = xmlhr.responseText.split('@@@');
		 if(listVideo[1]){
		resultDiv.innerHTML = listVideo[1];
		$('#my_panel').css("width", "610px");
        $('#view_uploaded_video').show();
		}else{
		 resultDiv.innerHTML = 'No video uploaded yet.';
		 $('#video_list_to_add').hide();
		}
	}
 } else if (xmlhr.readyState == 4) {
   }
  }
  xmlhr.send(params);
 }
 ytVideoApp.sendRequestAddtoplayList = function(filePath, params, resultDivName,uId){
	if (window.XMLHttpRequest) {
    var xmlhr = new XMLHttpRequest();
  } else {
    var xmlhr = new ActiveXObject('MSXML2.XMLHTTP.3.0');
  }
 xmlhr.open('POST', filePath);
  xmlhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
  xmlhr.onreadystatechange = function() {
    var resultDiv = document.getElementById(resultDivName);
	 if(resultDiv){
	 resultDiv.innerHTML = '<img src="template/system/images/loader.gif" alt="wait" />';
	 }
    if (xmlhr.readyState == 1) {
     } else if (xmlhr.readyState == 4 && xmlhr.status == 200) {
      if (xmlhr.responseText) {
		parent.openPlayListDivforAllVIdeo('addToPlayList',uId,'365');
		 }
 } else if (xmlhr.readyState == 4) {
  }
  }
  xmlhr.send(params);
 }
 /*** Uses ytVideoApp.sendRequest to display a YT video player and metadata for the*/
ytVideoApp.presentVideo = function(videoId, updateThumbnail,title,duration,uId){
$.ajax({
          type: "POST",
          url: "lib/youtube.php",
          data: "operation=videoEnrty&videoId="+videoId+"&thumb="+updateThumbnail+"&title="+title+"&duration="+duration+"&uId="+uId,
          success: function(msg){
	         $('#music_frame').contents().find('#frameHeight').val(document.getElementById('music_frame').style.height); 
             $('#music_frame').contents().find('#mywork').val(videoId);
             $('#music_frame').contents().find('#playListId').val('');
			 window.top.music_frame.document.song.submit();
          }
       });
}
ytVideoApp.subscriberAndview=function(username){
   
   var params ='operation=getview&username='+username;
   var filePath = 'lib/youtube.php';
   ytVideoApp.sendFeedRequest(filePath, params, '');

}
ytVideoApp.registerUser=function(){
   uploadingVideosPopUP('uploadingVideosPopUP',1);
   var params ='operation=register';
   var filePath = 'lib/youtube.php';
   ytVideoApp.sendRequestToregiserMusician(filePath, params, '');

}
ytVideoApp.sendRequestToregiserMusician = function(filePath, params, resultDivName){
	if (window.XMLHttpRequest) {
    var xmlhr = new XMLHttpRequest();
  } else {
    var xmlhr = new ActiveXObject('MSXML2.XMLHTTP.3.0');
  }
xmlhr.open('POST', filePath);
  xmlhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
  xmlhr.onreadystatechange = function(){
    if (xmlhr.readyState == 1) {
     } else if (xmlhr.readyState == 4 && xmlhr.status == 200) {
       hideAlert();
	 xmlhr.responseText = parseInt(xmlhr.responseText);
	 if (xmlhr.responseText==1) {
	   }else{
	   alert('Youtube username already exits. please try again');
	  }
    getArtistHomePage()
	 
 } else if (xmlhr.readyState == 4) {
   }
  }
  xmlhr.send(params);
 }
/*** Creates a form to enter video meta-data in preparation for syndicated upload.*/
ytVideoApp.prepareUploadForm = function(){ 
     
  var  metaDataForm = ['<br clear="all"><form id="uploadForm" ',
    'onsubmit="ytVideoApp.prepareSyndicatedUpload(',
    'this.videoTitle.value, ',
    'this.videoDescription.value, ',
    'this.videoCategory.value, ',
    'this.videoTags.value); ',
    'return false;">',
    'Enter video title:<br /><input size="50" name="videoTitle" ',
    'type="text" /><br />',
    'Enter video description:<br /><textarea cols="50" ',
    'name="videoDescription"></textarea><br />',
    'Select a category: <select name="videoCategory">',
    '<option value="Music">Music</option>',
    '</select><br />',
    'Enter some tags to describe your video ',
    '<em>(separated by spaces)</em>:<br />',
    '<input name="videoTags" type="text" size="50" value="tunezy" /><br />',
    '<input type="submit" value="upload ">',
    '</form>'].join('');
  document.getElementById(ytVideoApp.SYNDICATED_UPLOAD_DIV).innerHTML = metaDataForm;
}
/** * Uses ytVideoApp.sendRequest to prepare a syndicated upload.*/
ytVideoApp.prepareSyndicatedUpload = function(videoTitle, videoDescription, videoCategory, videoTags) {
  showWaitPopUp('videouploadform',0);
  var filePath = 'lib/youtube.php';
  var params = 'operation=create_upload_form' +
               '&videoTitle=' + videoTitle +
               '&videoDescription=' + videoDescription +
               '&videoCategory=' + videoCategory +
               '&videoTags=' + videoTags;
  ytVideoApp.sendRequest(filePath, params, ytVideoApp.SYNDICATED_UPLOAD_DIV);
}
/** * Uses ytVideoApp.sendRequest to create the authSub link.*/
ytVideoApp.presentAuthLink = function() {
  var filePath = 'lib/youtube.php';
  var params = 'operation=auth_sub_request';
  ytVideoApp.sendRequest(filePath, params, ytVideoApp.AUTHSUB_REQUEST_DIV);
 }
/** * Uses ytVideoApp.sendRequest to check a videos upload status.*/
ytVideoApp.checkUploadDetails = function(videoId) {
  var filePath = 'lib/youtube.php';
  var params = 'operation=check_upload_status' +
               '&videoId=' + videoId;
  ytVideoApp.sendRequest(filePath, params, ytVideoApp.VIDEO_UPLOAD_STATUS);
}
/** * Creates an HTML form to edit a video's meta-data, populated with the */
ytVideoApp.presentMetaDataEditForm = function(oldVideoTitle, oldVideoDescription, oldVideoCategory, oldVideoTags, videoId) {
  // split oldVideoTags by comma and present as whitespace separated
  var oldVideoTagsArray = oldVideoTags.split(',');
  oldVideoTags = oldVideoTagsArray.join(' ');
  var editMetaDataForm = ['<form id="editForm" ',
    'onsubmit="ytVideoApp.editMetaData(',
    'this.newVideoTitle.value, ',
    'this.newVideoDescription.value, ',
    'this.newVideoCategory.value, ',
    'this.newVideoTags.value, ',
    'this.videoId.value);',
    'return false;">',
    'Enter a new video title:<br />',
    '<input size="50" name="newVideoTitle" ',
    'type="text" value="',
    oldVideoTitle,
    '"/><br />',
    'Enter a new video description:<br />',
    '<textarea cols="50" name="newVideoDescription">', 
    oldVideoDescription,
    '</textarea><br />',
    'Select a new category: <select ',
    'name="newVideoCategory">',
    '<option value="Autos">Autos &amp; Vehicles</option>',
    '<option value="Music">Music</option>',
    '<option value="Animals">Pets &amp; Animals</option>',
    '<option value="Sports">Sports</option>',
    '<option value="Travel">Travel &amp; Events</option>',
    '<option value="Games">Gadgets &amp; Games</option>',
    '<option value="Comedy">Comedy</option>',
    '<option value="People">People &amp; Blogs</option>',
    '<option value="News">News &amp; Politics</option>',
    '<option value="Entertainment">Entertainment</option>',
    '<option value="Education">Education</option>',
    '<option value="Howto">Howto &amp; Style</option>',
    '<option value="Nonprofit">Nonprofit &amp; Activism</option>',
    '<option value="Tech">Science &amp; Technology</option>',
    '</select><br />',
    'Enter some new tags to describe your video ',
    '<em>(separated by spaces)</em>:<br />',
    '<input name="newVideoTags" type="text" size="50" ',
    'value="',
    oldVideoTags,
    '"/><br />',
    '<input name="videoId" type="hidden" value="',
    videoId,
    '" /><br />',
    '<input type="submit" value="go">',
    '</form>'].join('');
  
  document.getElementById(ytVideoApp.VIDEO_SEARCH_RESULTS_DIV).innerHTML = editMetaDataForm;
}
/** * Uses ytVideoApp.sendRequest to submit updated video meta-data.*/
ytVideoApp.editMetaData = function(newVideoTitle, newVideoDescription, newVideoCategory, newVideoTags, videoId) {
  var filePath = 'lib/youtube.php';
  var params = 'operation=edit_meta_data' +
               '&newVideoTitle=' + newVideoTitle +
               '&newVideoDescription=' + newVideoDescription +
               '&newVideoCategory=' + newVideoCategory +
               '&newVideoTags=' + newVideoTags +
               '&videoId=' + videoId;
  ytVideoApp.sendRequest(filePath, params, ytVideoApp.VIDEO_SEARCH_RESULTS_DIV);
};
/*** Confirms whether user wants to delete a video.*/
ytVideoApp.confirmDeletion = function(videoId) {
  var answer =  confirm('Do you really want to delete the video with id: ' + videoId + ' ?');
  if (answer) {
    ytVideoApp.prepareDeletion(videoId);
  }
}
/*** Uses ytVideoApp.sendRequest to request a video to be deleted.*/
ytVideoApp.prepareDeletion = function(videoId) {
  var filePath = 'lib/youtube.php';
  var params = 'operation=delete_video' +
               '&videoId=' + videoId;

  var table  = document.getElementById('videoResultList');
  var indexOfRowToBeDeleted = -1;
  var tableRows = document.getElementsByTagName('TR');
  for (var i = 0, tableRow; tableRow = tableRows[i]; i++) {
    if (tableRow.id == videoId) {
      indexOfRowToBeDeleted = i;
    }
  }
  if (indexOfRowToBeDeleted > -1) {
    table.deleteRow(indexOfRowToBeDeleted);
  }
  ytVideoApp.sendRequest(filePath, params, ytVideoApp.VIDEO_SEARCH_RESULTS_DIV);
}
/*** Uses ytVideoApp.sendRequest to display a list of of YT videos.*/
ytVideoApp.presentFeed = function(op, maxResults, startIndex, searchTerm,sortBy,uId){
  var params = 'operation=' + op + 
               '&maxResults=' + maxResults +
               '&startIndex=' + startIndex + 
			   '&sortBy=' + sortBy +
               '&searchTerm=' + searchTerm +
			   '&uId=' + uId;
  var filePath = 'lib/youtube.php';
  ytVideoApp.sendRequestMywork(filePath,params, ytVideoApp.VIDEO_LIST_CONTAINER_DIV);
};
ytVideoApp.presentFeeduser = function(op, maxResults, startIndex, searchTerm,sortBy,uId){
  var params = 'operation=' + op + 
               '&maxResults=' + maxResults +
               '&startIndex=' + startIndex + 
			   '&sortBy=' + sortBy +
               '&searchTerm=' + searchTerm +
			   '&uId=' + uId;
  var filePath = 'lib/youtube.php';
  ytVideoApp.sendRequestMyworkuser(filePath,params, 'videoListofauser');
};
/*** Updates the variables used by the navigation buttons and the 'enabled' */
	ytVideoApp.updateNavigation = function(page) {
	 ytVideoApp.nextPage = page + 1;
	  ytVideoApp.previousPage = page - 1;
	  document.getElementById(ytVideoApp.NEXT_PAGE_BUTTON).style.display = 'inline';
	  document.getElementById(ytVideoApp.PREVIOUS_PAGE_BUTTON).style.display = 'inline';
	  if (ytVideoApp.previousPage < 1) {
		document.getElementById(ytVideoApp.PREVIOUS_PAGE_BUTTON).disabled = true;
	  } else {
		document.getElementById(ytVideoApp.PREVIOUS_PAGE_BUTTON).disabled = false;
	  }
	  document.getElementById(ytVideoApp.NEXT_PAGE_BUTTON).disabled = false;
};

/*** Hides the navigation.*/
ytVideoApp.hideNavigation = function() {
  document.getElementById(ytVideoApp.NAVIGATION_DIV).style.display = 'none';
};
/** Update video results div*/
ytVideoApp.refreshSearchResults = function() {
  document.getElementById(ytVideoApp.VIDEO_SEARCH_RESULTS_DIV).innerHTML = '';
}
/** Method called when the query type has been changed.  Clears out the*/
ytVideoApp.queryTypeChanged = function(op, searchTermInputElement) {
  if (op == 'search_username') {
    searchTermInputElement.value = '-- enter username --';
  } else if (op != 'search_all') {
    searchTermInputElement.value = '';
  }
};

/*** Create a basic HTML form to use for creating a new playlist.*/
ytVideoApp.prepareCreatePlaylistForm = function() {
  var newPlaylistForm = ['<br /><form id="addPlaylist" ',
    'onsubmit="ytVideoApp.createNewPlaylist(this.newPlaylistTitle.value, ',
    'this.newPlaylistDescription.value); ">',
    'Enter a title for the new playlist:<br />',
    '<input size="50" name="newPlaylistTitle" type="text" /><br />',
    'Enter a description:<br />',
    '<textarea cols="25" name="newPlaylistDescription" >',
    '</textarea><br />',
    '<input type="submit" value="go">',
    '</form>'].join('');
    
  document.getElementById(ytVideoApp.PLAYLIST_ADD_DIV).innerHTML = newPlaylistForm;
}
/*** Uses ytVideoApp.sendRequest to create a new playlist.*/
ytVideoApp.createNewPlaylist = function(playlistTitle, playlistDescription) {
  var filePath = 'lib/youtube.php';
  var params = 'operation=create_playlist' +
               '&playlistTitle=' + playlistTitle +
               '&playlistDescription=' + playlistDescription;
  ytVideoApp.hideNavigation();
  ytVideoApp.sendRequest(filePath, params, ytVideoApp.VIDEO_SEARCH_RESULTS_DIV);
}

/*** Confirm user wants to delete a playlist*/
ytVideoApp.confirmPlaylistDeletion = function(playlistTitle) {
  var answer =  confirm('Do you really want to delete the playlist titled : ' + 
    playlistTitle + ' ?');
  if (answer) {
    ytVideoApp.deletePlaylist(playlistTitle);
  }
}

/** Uses ytVideoApp.sendRequest to delete a playlist.*/
ytVideoApp.deletePlaylist = function(playlistTitle) {
  var filePath = 'lib/youtube.php';
  var params = 'operation=delete_playlist' +
               '&playlistTitle=' + playlistTitle;
  ytVideoApp.sendRequest(filePath, params, ytVideoApp.VIDEO_SEARCH_RESULTS_DIV);
}

/*** Create a basic HTML form to use for modifying a playlist.*/
ytVideoApp.prepareUpdatePlaylistForm = function(oldPlaylistTitle, oldPlaylistDescription) {
  var playlistUpdateForm = ['<br /><form id="updatePlaylist" ',
    'onsubmit="ytVideoApp.updatePlaylist(this.newPlaylistTitle.value, ',
    'this.newPlaylistDescription.value, this.oldPlaylistTitle.value);">',
    'Enter a title for the new playlist:<br />',
    '<input size="50" name="newPlaylistTitle" type="text" value="',
    oldPlaylistTitle,
    '"/><br />',
    'Enter a description:<br />',
    '<textarea cols="25" name="newPlaylistDescription" >',
    oldPlaylistDescription,
    '</textarea><br />',
    '<input type="submit" value="go" />',
    '<input type="hidden" value="',
    oldPlaylistTitle,
    '" name="oldPlaylistTitle" />',
    '</form>'].join('');
    document.getElementById(ytVideoApp.VIDEO_SEARCH_RESULTS_DIV).innerHTML = playlistUpdateForm;
}
/*** Uses ytVideoApp.sendRequest to update a playlist.*/
ytVideoApp.updatePlaylist = function(newPlaylistTitle, newPlaylistDescription, oldPlaylistTitle) {
  var filePath = 'lib/youtube.php';
  var params = 'operation=update_playlist' +
               '&newPlaylistTitle=' + newPlaylistTitle +
               '&newPlaylistDescription=' + newPlaylistDescription +
               '&oldPlaylistTitle=' + oldPlaylistTitle;
  ytVideoApp.sendRequest(filePath, params, ytVideoApp.VIDEO_LIST_CONTAINER_DIV);
}
/**Uses ytVideoApp.sendRequest to retrieve a users playlist.*/
ytVideoApp.retrievePlaylists = function() {
  var filePath = 'lib/youtube.php';
  var params = 'operation=retrieve_playlists';
  ytVideoApp.hideNavigation();
  ytVideoApp.sendRequest(filePath, params, ytVideoApp.VIDEO_LIST_CONTAINER_DIV);
}

ytVideoApp.getVideoDeatil = function(vId){
 
 var filePath = 'lib/youtube.php';
  var params = 'operation=videoDetail' +
               '&vId=' + vId;
  ytVideoApp.sendVideoRequest(filePath, params, '');
}
ytVideoApp.getAddVideoDeatil = function(vId,contestId){
  
 var filePath = 'lib/youtube.php';
  var params = 'operation=videoAddDetail' +
               '&vId=' + vId +'&contestId='+contestId;
  ytVideoApp.sendAddVideoRequest(filePath, params, '');
}
ytVideoApp.sendAddVideoRequest = function(filePath, params, resultDivName) {
	if (window.XMLHttpRequest) {
		var xmlhr = new XMLHttpRequest();
	  } else {
		var xmlhr = new ActiveXObject('MSXML2.XMLHTTP.3.0');
	  }
	xmlhr.open('POST', filePath);
	  xmlhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
	  xmlhr.onreadystatechange = function() {
	  if (xmlhr.readyState == 1) {
		 } else if (xmlhr.readyState == 4 && xmlhr.status == 200) {
		  alert(xmlhr.responseText);
		   hideAlert();
		} else if (xmlhr.readyState == 4) {
		}
	  }
	  xmlhr.send(params);

}
ytVideoApp.sendVideoRequest = function(filePath, params, resultDivName){
	if (window.XMLHttpRequest) {
    var xmlhr = new XMLHttpRequest();
  } else {
    var xmlhr = new ActiveXObject('MSXML2.XMLHTTP.3.0');
  }
 xmlhr.open('POST', filePath);
  xmlhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
 xmlhr.onreadystatechange = function() {
   if (xmlhr.readyState == 1) {
     } else if (xmlhr.readyState == 4 && xmlhr.status == 200) {
      if (xmlhr.responseText) {
		alert(xmlhr.responseText);
		hideAlert();
		getCompetePage(1,'');
	}else{
	alert('Unable to add your video in the contest please try again');
	}
 } else if (xmlhr.readyState == 4) {
    }
  }
  xmlhr.send(params);
 }
  ytVideoApp.getFeaturedUsers=function(){
      $('div.content-txt-div').html("<div style='text-align:center;'><img src='./template/system/images/loader.gif'  id='loderImg'/></div>")
	  var filePath = 'lib/youtube.php';
	  var params = 'operation=getFraturedArtist';
  ytVideoApp.sendFeaturedUsers(filePath, params, ytVideoApp.VIDEO_SEARCH_RESULTS_DIV);
 }
 ytVideoApp.sendFeaturedUsers = function(filePath, params, resultDivName) {
	 
	if (window.XMLHttpRequest) {
    var xmlhr = new XMLHttpRequest();
  } else {
    var xmlhr = new ActiveXObject('MSXML2.XMLHTTP.3.0');
  }
xmlhr.open('POST', filePath);
  xmlhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
   xmlhr.onreadystatechange = function() {
   if (xmlhr.readyState == 1) {
     } else if (xmlhr.readyState == 4 && xmlhr.status == 200) {
      if (xmlhr.responseText) {
		 $('div.content-txt-div').html(xmlhr.responseText);
	}
 } else if (xmlhr.readyState == 4) {
    }
  }
  xmlhr.send(params);
 }
ytVideoApp.getFeaturedVideos=function(){
      $('div.content-txt-div').html("<div style='text-align:center;'><img src='./template/system/images/loader.gif'  id='loderImg'/></div>")
	  var filePath = 'lib/youtube.php';
	  var params = 'operation=getFraturedVideo';
  ytVideoApp.sendFeaturedVideo(filePath, params, ytVideoApp.VIDEO_SEARCH_RESULTS_DIV);
 }
ytVideoApp.sendFeaturedVideo = function(filePath, params, resultDivName) {
	if (window.XMLHttpRequest) {
    var xmlhr = new XMLHttpRequest();
  } else {
    var xmlhr = new ActiveXObject('MSXML2.XMLHTTP.3.0');
  }
xmlhr.open('POST', filePath);
  xmlhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
 xmlhr.onreadystatechange = function() {
   if (xmlhr.readyState == 1) {
     } else if (xmlhr.readyState == 4 && xmlhr.status == 200) {
      if (xmlhr.responseText) {
		 $('div.content-txt-div').html(xmlhr.responseText);
	}
 } else if (xmlhr.readyState == 4) {
      //alert('Invalid response received - Status: ' + xmlhr.status);
    }
  }
  xmlhr.send(params);
 }
 ytVideoApp.getVideoView = function(vId){
  var filePath = 'lib/youtube.php';
  var params = 'operation=videoView' +
               '&vId=' + vId;
  ytVideoApp.getVideoViewRequest(filePath, params, 'last_video_view_count');

 }
 ytVideoApp.getVideoViewRequest=function(filePath, params, resultDivName) {
	if (window.XMLHttpRequest) {
    var xmlhr = new XMLHttpRequest();
  } else {
    var xmlhr = new ActiveXObject('MSXML2.XMLHTTP.3.0');
  }
xmlhr.open('POST', filePath);
  xmlhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
  
  xmlhr.onreadystatechange = function() {
   if (xmlhr.readyState == 1) {
     } else if (xmlhr.readyState == 4 && xmlhr.status == 200) {
		  $('#'+resultDivName).html('Views : '+xmlhr.responseText);
		 } else if (xmlhr.readyState == 4) {
    }
  }
  xmlhr.send(params);
 }
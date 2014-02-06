/*
 * FCKeditor - The text editor for Internet - http://www.fckeditor.net
 * Copyright (C) 2003-2007 Frederico Caldeira Knabben
 *
 * == BEGIN LICENSE ==
 *
 * Licensed under the terms of any of the following licenses at your
 * choice:
 *
 *  - GNU General Public License Version 2 or later (the "GPL")
 *    http://www.gnu.org/licenses/gpl.html
 *
 *  - GNU Lesser General Public License Version 2.1 or later (the "LGPL")
 *    http://www.gnu.org/licenses/lgpl.html
 *
 *  - Mozilla Public License Version 1.1 or later (the "MPL")
 *    http://www.mozilla.org/MPL/MPL-1.1.html
 *
 * == END LICENSE ==
 *
 * Creation and initialization of the "FCK" object. This is the main object
 * that represents an editor instance.
 */

// FCK represents the active editor instance.
var FCK =
{
	Name			: FCKURLParams[ 'InstanceName' ],
	Status			: FCK_STATUS_NOTLOADED,
	EditMode		: FCK_EDITMODE_WYSIWYG,
	Toolbar			: null,
	HasFocus		: false,
	DataProcessor	: new FCKDataProcessor(),

	AttachToOnSelectionChange : function( functionPointer )
	{
		this.Events.AttachEvent( 'OnSelectionChange', functionPointer ) ;
	},

	GetLinkedFieldValue : function()
	{
		return this.LinkedField.value ;
	},

	GetParentForm : function()
	{
		return this.LinkedField.form ;
	} ,

	// # START : IsDirty implementation

	StartupValue : '',

	IsDirty : function()
	{
		if ( this.EditMode == FCK_EDITMODE_SOURCE )
			return ( this.StartupValue != this.EditingArea.Textarea.value ) ;
		else
			return ( this.StartupValue != this.EditorDocument.body.innerHTML ) ;
	},

	ResetIsDirty : function()
	{
		if ( this.EditMode == FCK_EDITMODE_SOURCE )
			this.StartupValue = this.EditingArea.Textarea.value ;
		else if ( this.EditorDocument.body )
			this.StartupValue = this.EditorDocument.body.innerHTML ;
	},

	// # END : IsDirty implementation

	StartEditor : function()
	{
		this.TempBaseTag = FCKConfig.BaseHref.length > 0 ? '<base href="' + FCKConfig.BaseHref + '" _fcktemp="true"></base>' : '' ;

		// Setup the keystroke handler.
		var oKeystrokeHandler = FCK.KeystrokeHandler = new FCKKeystrokeHandler() ;
		oKeystrokeHandler.OnKeystroke = _FCK_KeystrokeHandler_OnKeystroke ;

		oKeystrokeHandler.SetKeystrokes( FCKConfig.Keystrokes ) ;

		// In IE7, if the editor tries to access the clipboard by code, a dialog is
		// shown to the user asking if the application is allowed to access or not.
		// Due to the IE implementation of it, the KeystrokeHandler will not work
		//well in this case, so we must leave the pasting keys to have their default behavior.
		if ( FCKBrowserInfo.IsIE7 )
		{
			if ( ( CTRL + 86 /*V*/ ) in oKeystrokeHandler.Keystrokes )
				oKeystrokeHandler.SetKeystrokes( [ CTRL + 86, true ] ) ;

			if ( ( SHIFT + 45 /*INS*/ ) in oKeystrokeHandler.Keystrokes )
				oKeystrokeHandler.SetKeystrokes( [ SHIFT + 45, true ] ) ;
		}

		this.EditingArea = new FCKEditingArea( document.getElementById( 'xEditingArea' ) ) ;
		this.EditingArea.FFSpellChecker = FCKConfig.FirefoxSpellChecker ;

		// Final setup of the lists lib.
		FCKListsLib.Setup() ;

		// Set the editor's startup contents
		this.SetData( this.GetLinkedFieldValue(), true ) ;
	},

	Focus : function()
	{
		FCK.EditingArea.Focus() ;
	},

	SetStatus : function( newStatus )
	{
		this.Status = newStatus ;

		if ( newStatus == FCK_STATUS_ACTIVE )
		{
			FCKFocusManager.AddWindow( window, true ) ;

			if ( FCKBrowserInfo.IsIE )
				FCKFocusManager.AddWindow( window.frameElement, true ) ;

			// Force the focus in the editor.
			if ( FCKConfig.StartupFocus )
				FCK.Focus() ;
		}

		this.Events.FireEvent( 'OnStatusChange', newStatus ) ;
	},

	// Fixes the body by moving all inline and text nodes to appropriate block
	// elements.
	FixBody : function()
	{
		var sBlockTag = FCKConfig.EnterMode ;

		// In 'br' mode, no fix must be done.
		if ( sBlockTag != 'p' && sBlockTag != 'div' )
			return ;

		var oDocument = this.EditorDocument ;

		if ( !oDocument )
			return ;

		var oBody = oDocument.body ;

		if ( !oBody )
			return ;

		FCKDomTools.TrimNode( oBody ) ;

		var oNode = oBody.firstChild ;
		var oNewBlock ;

		while ( oNode )
		{
			var bMoveNode = false ;

			switch ( oNode.nodeType )
			{
				// Element Node.
				case 1 :
					if ( !FCKListsLib.BlockElements[ oNode.nodeName.toLowerCase() ] )
						bMoveNode = true ;
					break ;

				// Text Node.
				case 3 :
					// Ignore space only or empty text.
					if ( oNewBlock || oNode.nodeValue.Trim().length > 0 )
						bMoveNode = true ;
			}

			if ( bMoveNode )
			{
				var oParent = oNode.parentNode ;

				if ( !oNewBlock )
					oNewBlock = oParent.insertBefore( oDocument.createElement( sBlockTag ), oNode ) ;

				oNewBlock.appendChild( oParent.removeChild( oNode ) ) ;

				oNode = oNewBlock.nextSibling ;
			}
			else
			{
				if ( oNewBlock )
				{
					FCKDomTools.TrimNode( oNewBlock ) ;
					oNewBlock = null ;
				}
				oNode = oNode.nextSibling ;
			}
		}

		if ( oNewBlock )
			FCKDomTools.TrimNode( oNewBlock ) ;
	},

	GetData : function( format )
	{
		// We assume that if the user is in source editing, the editor value must
		// represent the exact contents of the source, as the user wanted it to be.
		if ( FCK.EditMode == FCK_EDITMODE_SOURCE )
				return FCK.EditingArea.Textarea.value ;

		this.FixBody() ;

		var oDoc = FCK.EditorDocument ;
		if ( !oDoc )
			return null ;

		var isFullPage = FCKConfig.FullPage ;

		// Call the Data Processor to generate the output data.
		var data = FCK.DataProcessor.ConvertToDataFormat(
			isFullPage ? oDoc.getElementsByTagName( 'html' )[0] : oDoc.body,
			!isFullPage,
			FCKConfig.IgnoreEmptyParagraphValue,
			format ) ;

		// Restore protected attributes.
		data = FCK.ProtectEventsRestore( data ) ;

		if ( FCKBrowserInfo.IsIE )
			data = data.replace( FCKRegexLib.ToReplace, '$1' ) ;

		if ( isFullPage )
		{
			if ( FCK.DocTypeDeclaration && FCK.DocTypeDeclaration.length > 0 )
				data = FCK.DocTypeDeclaration + '\n' + data ;

			if ( FCK.XmlDeclaration && FCK.XmlDeclaration.length > 0 )
				data = FCK.XmlDeclaration + '\n' + data ;
		}

		return FCKConfig.ProtectedSource.Revert( data ) ;
	},

	UpdateLinkedField : function()
	{
		FCK.LinkedField.value = FCK.GetXHTML( FCKConfig.FormatOutput ) ;
		FCK.Events.FireEvent( 'OnAfterLinkedFieldUpdate' ) ;
	},

	RegisteredDoubleClickHandlers : new Object(),

	OnDoubleClick : function( element )
	{
		var oHandler = FCK.RegisteredDoubleClickHandlers[ element.tagName ] ;
		if ( oHandler )
			oHandler( element ) ;
	},

	// Register objects that can handle double click operations.
	RegisterDoubleClickHandler : function( handlerFunction, tag )
	{
		FCK.RegisteredDoubleClickHandlers[ tag.toUpperCase() ] = handlerFunction ;
	},

	OnAfterSetHTML : function()
	{
		FCKDocumentProcessor.Process( FCK.EditorDocument ) ;
		FCKUndo.SaveUndoStep() ;

		FCK.Events.FireEvent( 'OnSelectionChange' ) ;
		FCK.Events.FireEvent( 'OnAfterSetHTML' ) ;
	},

	// Saves URLs on links and images on special attributes, so they don't change when
	// moving around.
	ProtectUrls : function( html )
	{
		// <A> href
		html = html.replace( FCKRegexLib.ProtectUrlsA	, '$& _fcksavedurl=$1' ) ;

		// <IMG> src
		html = html.replace( FCKRegexLib.ProtectUrlsImg	, '$& _fcksavedurl=$1' ) ;

		return html ;
	},

	// Saves event attributes (like onclick) so they don't get executed while
	// editing.
	ProtectEvents : function( html )
	{
		return html.replace( FCKRegexLib.TagsWithEvent, _FCK_ProtectEvents_ReplaceTags ) ;
	},

	ProtectEventsRestore : function( html )
	{
		return html.replace( FCKRegexLib.ProtectedEvents, _FCK_ProtectEvents_RestoreEvents ) ;
	},

	ProtectTags : function( html )
	{
		var sTags = FCKConfig.ProtectedTags ;

		// IE doesn't support <abbr> and it breaks it. Let's protect it.
		if ( FCKBrowserInfo.IsIE )
			sTags += sTags.length > 0 ? '|ABBR|XML' : 'ABBR|XML' ;

		var oRegex ;
		if ( sTags.length > 0 )
		{
			oRegex = new RegExp( '<(' + sTags + ')(?!\w|:)', 'gi' ) ;
			html = html.replace( oRegex, '<FCK:$1' ) ;

			oRegex = new RegExp( '<\/(' + sTags + ')>', 'gi' ) ;
			html = html.replace( oRegex, '<\/FCK:$1>' ) ;
		}

		// Protect some empty elements. We must do it separately becase the
		// original tag may not contain the closing slash, like <hr>:
		//		- <meta> tags get executed, so if you have a redirect meta, the
		//		  content will move to the target page.
		//		- <hr> may destroy the document structure if not well
		//		  positioned. The trick is protect it here and restore them in
		//		  the FCKDocumentProcessor.
		sTags = 'META' ;
		if ( FCKBrowserInfo.IsIE )
			sTags += '|HR' ;

		oRegex = new RegExp( '<((' + sTags + ')(?=\\s|>|/)[\\s\\S]*?)/?>', 'gi' ) ;
		html = html.replace( oRegex, '<FCK:$1 />' ) ;

		return html ;
	},

	SetData : function( data, resetIsDirty )
	{
		this.EditingArea.Mode = FCK.EditMode ;

		if ( FCK.EditMode == FCK_EDITMODE_WYSIWYG )
		{
			// Save the resetIsDirty for later use (async)
			this._ForceResetIsDirty = ( resetIsDirty === true ) ;

			// Protect parts of the code that must remain untouched (and invisible)
			// during editing.
			data = FCKConfig.ProtectedSource.Protect( data ) ;

			// Call the Data Processor to transform the data.
			data = FCK.DataProcessor.ConvertToHtml( data ) ;

			// Fix for invalid self-closing tags (see #152).
			data = data.replace( FCKRegexLib.InvalidSelfCloseTags, '$1></$2>' ) ;

			// Protect event attributes (they could get fired in the editing area).
			data = FCK.ProtectEvents( data ) ;

			// Protect some things from the browser itself.
			data = FCK.ProtectUrls( data ) ;
			data = FCK.ProtectTags( data ) ;

			// Firefox can't handle correctly the editing of the STRONG and EM tags.
			// We must replace them with B and I.
			// TODO : remove this check  if possible, as soon as the new style system is in use.
			if ( FCKBrowserInfo.IsGecko )
			{
				data = data.replace( FCKRegexLib.StrongOpener, '<b$1' ) ;
				data = data.replace( FCKRegexLib.StrongCloser, '<\/b>' ) ;
				data = data.replace( FCKRegexLib.EmOpener, '<i$1' ) ;
				data = data.replace( FCKRegexLib.EmCloser, '<\/i>' ) ;
			}

			// Insert the base tag (FCKConfig.BaseHref), if not exists in the source.
			// The base must be the first tag in the HEAD, to get relative
			// links on styles, for example.
			if ( FCK.TempBaseTag.length > 0 && !FCKRegexLib.HasBaseTag.test( data ) )
				data = data.replace( FCKRegexLib.HeadOpener, '$&' + FCK.TempBaseTag ) ;

			// Build the HTML for the additional things we need on <head>.
			var sHeadExtra = '' ;

			if ( !FCKConfig.FullPage )
				sHeadExtra += _FCK_GetEditorAreaStyleTags() ;

			if ( FCKBrowserInfo.IsIE )
				sHeadExtra += FCK._GetBehaviorsStyle() ;
			else if ( FCKConfig.ShowBorders )
				sHeadExtra += '<link href="' + FCKConfig.FullBasePath + 'css/fck_showtableborders_gecko.css" rel="stylesheet" type="text/css" _fcktemp="true" />' ;

			sHeadExtra += '<link href="' + FCKConfig.FullBasePath + 'css/fck_internal.css" rel="stylesheet" type="text/css" _fcktemp="true" />' ;

			// Attention: do not change it before testing it well (sample07)!
			// This is tricky... if the head ends with <meta ... content type>,
			// Firefox will break. But, it works if we place our extra stuff as
			// the last elements in the HEAD.
			data = data.replace( FCKRegexLib.HeadCloser, sHeadExtra + '$&' ) ;

			// Load the HTML in the editing area.
			this.EditingArea.OnLoad = _FCK_EditingArea_OnLoad ;
			this.EditingArea.Start( data ) ;
		}
		else
		{
			// Remove the references to the following elements, as the editing area
			// IFRAME will be removed.
			FCK.EditorWindow	= null ;
			FCK.EditorDocument	= null ;

			this.EditingArea.OnLoad = null ;
			this.EditingArea.Start( data ) ;

			// Enables the context menu in the textarea.
			this.EditingArea.Textarea._FCKShowContextMenu = true ;

			// Removes the enter key handler.
			FCK.EnterKeyHandler = null ;

			if ( resetIsDirty )
				this.ResetIsDirty() ;

			// Listen for keystroke events.
			FCK.KeystrokeHandler.AttachToElement( this.EditingArea.Textarea ) ;

			this.EditingArea.Textarea.focus() ;

			FCK.Events.FireEvent( 'OnAfterSetHTML' ) ;
		}

		if ( FCKBrowserInfo.IsGecko )
			window.onresize() ;
	},

	// For the FocusManager
	HasFocus : false,


	// This collection is used by the browser specific implementations to tell
	// wich named commands must be handled separately.
	RedirectNamedCommands : new Object(),

	ExecuteNamedCommand : function( commandName, commandParameter, noRedirect )
	{
		FCKUndo.SaveUndoStep() ;

		if ( !noRedirect && FCK.RedirectNamedCommands[ commandName ] != null )
			FCK.ExecuteRedirectedNamedCommand( commandName, commandParameter ) ;
		else
		{
			FCK.Focus() ;
			FCK.EditorDocument.execCommand( commandName, false, commandParameter ) ;
			FCK.Events.FireEvent( 'OnSelectionChange' ) ;
		}

		FCKUndo.SaveUndoStep() ;
	},

	GetNamedCommandState : function( commandName )
	{
		try
		{

			if ( !FCK.EditorDocument.queryCommandEnabled( commandName ) )
				return FCK_TRISTATE_DISABLED ;
			else
				return FCK.EditorDocument.queryCommandState( commandName ) ? FCK_TRISTATE_ON : FCK_TRISTATE_OFF ;
		}
		catch ( e )
		{
			return FCK_TRISTATE_OFF ;
		}
	},

	GetNamedCommandValue : function( commandName )
	{
		var sValue = '' ;
		var eState = FCK.GetNamedCommandState( commandName ) ;

		if ( eState == FCK_TRISTATE_DISABLED )
			return null ;

		try
		{
			sValue = this.EditorDocument.queryCommandValue( commandName ) ;
		}
		catch(e) {}

		return sValue ? sValue : '' ;
	},

	PasteFromWord : function()
	{
		FCKDialog.OpenDialog( 'FCKDialog_Paste', FCKLang.PasteFromWord, 'dialog/fck_paste.html', 400, 330, 'Word' ) ;
	},

	Preview : function()
	{
		var iWidth	= FCKConfig.ScreenWidth * 0.8 ;
		var iHeight	= FCKConfig.ScreenHeight * 0.7 ;
		var iLeft	= ( FCKConfig.ScreenWidth - iWidth ) / 2 ;
		var oWindow = window.open( '', null, 'toolbar=yes,location=no,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=' + iWidth + ',height=' + iHeight + ',left=' + iLeft ) ;

		var sHTML ;

		if ( FCKConfig.FullPage )
		{
			if ( FCK.TempBaseTag.length > 0 )
				sHTML = FCK.TempBaseTag + FCK.GetXHTML() ;
			else
				sHTML = FCK.GetXHTML() ;
		}
		else
		{
			sHTML =
				FCKConfig.DocType +
				'<html dir="' + FCKConfig.ContentLangDirection + '">' +
				'<head>' +
				FCK.TempBaseTag +
				'<title>' + FCKLang.Preview + '</title>' +
				_FCK_GetEditorAreaStyleTags() +
				'</head><body>' +
				FCK.GetXHTML() +
				'</body></html>' ;
		}

		oWindow.document.write( sHTML );
		oWindow.document.close();
	},

	SwitchEditMode : function( noUndo )
	{
		var bIsWysiwyg = ( FCK.EditMode == FCK_EDITMODE_WYSIWYG ) ;

		// Save the current IsDirty state, so we may restore it after the switch.
		var bIsDirty = FCK.IsDirty() ;

		var sHtml ;

		// Update the HTML in the view output to show.
		if ( bIsWysiwyg )
		{
			if ( !noUndo && FCKBrowserInfo.IsIE )
				FCKUndo.SaveUndoStep() ;

			sHtml = FCK.GetXHTML( FCKConfig.FormatSource ) ;

			if ( sHtml == null )
				return false ;
		}
		else
			sHtml = this.EditingArea.Textarea.value ;

		FCK.EditMode = bIsWysiwyg ? FCK_EDITMODE_SOURCE : FCK_EDITMODE_WYSIWYG ;

		FCK.SetData( sHtml, !bIsDirty ) ;

		// Set the Focus.
		FCK.Focus() ;

		// Update the toolbar (Running it directly causes IE to fail).
		FCKTools.RunFunction( FCK.ToolbarSet.RefreshModeState, FCK.ToolbarSet ) ;

		return true ;
	},

	InsertElement : function( element )
	{
		// The parameter may be a string (element name), so transform it in an element.
		if ( typeof element == 'string' )
			element = this.EditorDocument.createElement( element ) ;
		
		var elementName = element.nodeName.toLowerCase() ;

		// Create a range for the selection. V3 will have a new selection
		// object that may internaly supply this feature.
		var range = new FCKDomRange( this.EditorWindow ) ;

		if ( FCKListsLib.BlockElements[ elementName ] != null )
		{
			range.SplitBlock() ;
			range.InsertNode( element ) ;
			
			var next = FCKDomTools.GetNextSourceElement( element, false, null, [ 'hr','br','param','img','area','input' ] ) ;

			// Be sure that we have something after the new element, so we can move the cursor there.
			if ( !next && FCKConfig.EnterMode != 'br')
			{
				next = this.EditorDocument.body.appendChild( this.EditorDocument.createElement( FCKConfig.EnterMode ) ) ;
				
				if ( FCKBrowserInfo.IsGecko )
					next.innerHTML = GECKO_BOGUS ;
			}
			
			if ( FCKListsLib.EmptyElements[ elementName ] == null )
				range.MoveToElementEditStart( element ) ;
			else if ( next )
				range.MoveToElementEditStart( next ) ;
			else
				range.MoveToPosition( element, 4 ) ;

			if ( FCKBrowserInfo.IsGecko )
			{
				if ( next ) 
					next.scrollIntoView( false ) ;
				element.scrollIntoView( false ) ;
			}
		}
		else
		{
			// Delete the current selection and insert the node.
			range.MoveToSelection() ;
			range.DeleteContents() ;
			range.InsertNode( element ) ;

			// Move the selection right after the new element.
			// DISCUSSION: Should we select the element instead?
			range.SetStart( element, 4 ) ;
			range.SetEnd( element, 4 ) ;
		}

		range.Select() ;
		range.Release() ;

		// REMOVE IT: The focus should not really be set here. It is up to the
		// calling code to reset the focus if needed.
		this.Focus() ;

		return element ;
	},

	_InsertBlockElement : function( blockElement )
	{
	}
} ;

FCK.Events	= new FCKEvents( FCK ) ;

// DEPRECATED in favor or "GetData".
FCK.GetHTML	= FCK.GetXHTML = FCK.GetData ;

// DEPRECATED in favor of "SetData".
FCK.SetHTML = FCK.SetData ;

// InsertElementAndGetIt and CreateElement are Deprecated : returns the same value as InsertElement.
FCK.InsertElementAndGetIt = FCK.CreateElement = FCK.InsertElement ;

// Replace all events attributes (like onclick).
function _FCK_ProtectEvents_ReplaceTags( tagMatch )
{
	return tagMatch.replace( FCKRegexLib.EventAttributes, _FCK_ProtectEvents_ReplaceEvents ) ;
}

// Replace an event attribute with its respective __fckprotectedatt attribute.
// The original event markup will be encoded and saved as the value of the new
// attribute.
function _FCK_ProtectEvents_ReplaceEvents( eventMatch, attName )
{
	return ' ' + attName + '_fckprotectedatt="' + eventMatch.ReplaceAll( [/&/g,/'/g,/"/g,/=/g,/</g,/>/g,/\r/g,/\n/g], ['&apos;','&#39;','&quot;','&#61;','&lt;','&gt;','&#10;','&#13;'] ) + '"' ;
}

function _FCK_ProtectEvents_RestoreEvents( match, encodedOriginal )
{
	return encodedOriginal.ReplaceAll( [/&#39;/g,/&quot;/g,/&#61;/g,/&lt;/g,/&gt;/g,/&#10;/g,/&#13;/g,/&apos;/g], ["'",'"','=','<','>','\r','\n','&'] ) ;
}

function _FCK_EditingArea_OnLoad()
{
	// Get the editor's window and document (DOM)
	FCK.EditorWindow	= FCK.EditingArea.Window ;
	FCK.EditorDocument	= FCK.EditingArea.Document ;

	FCK.InitializeBehaviors() ;

	// Create the enter key handler
	if ( !FCKConfig.DisableEnterKeyHandler )
		FCK.EnterKeyHandler = new FCKEnterKey( FCK.EditorWindow, FCKConfig.EnterMode, FCKConfig.ShiftEnterMode ) ;

	// Listen for keystroke events.
	FCK.KeystrokeHandler.AttachToElement( FCK.EditorDocument ) ;

	if ( FCK._ForceResetIsDirty )
		FCK.ResetIsDirty() ;

	// This is a tricky thing for IE. In some cases, even if the cursor is
	// blinking in the editing, the keystroke handler doesn't catch keyboard
	// events. We must activate the editing area to make it work. (#142).
	if ( FCKBrowserInfo.IsIE && FCK.HasFocus )
		FCK.EditorDocument.body.setActive() ;

	FCK.OnAfterSetHTML() ;

	// Check if it is not a startup call, otherwise complete the startup.
	if ( FCK.Status != FCK_STATUS_NOTLOADED )
		return ;

	FCK.SetStatus( FCK_STATUS_ACTIVE ) ;
}

function _FCK_GetEditorAreaStyleTags()
{
	var sTags = '' ;
	var aCSSs = FCKConfig.EditorAreaCSS ;

	for ( var i = 0 ; i < aCSSs.length ; i++ )
		sTags += '<link href="' + aCSSs[i] + '" rel="stylesheet" type="text/css" />' ;

	return sTags ;
}

function _FCK_KeystrokeHandler_OnKeystroke( keystroke, keystrokeValue )
{
	if ( FCK.Status != FCK_STATUS_COMPLETE )
		return false ;

	if ( FCK.EditMode == FCK_EDITMODE_WYSIWYG )
	{
		if ( keystrokeValue == 'Paste' )
			return !FCK.Events.FireEvent( 'OnPaste' ) ;
	}
	else
	{
		// In source mode, some actions must have their default behavior.
		if ( keystrokeValue.Equals( 'Paste', 'Undo', 'Redo', 'SelectAll' ) )
			return false ;
	}

	// The return value indicates if the default behavior of the keystroke must
	// be cancelled. Let's do that only if the Execute() call explicitelly returns "false".
	var oCommand = FCK.Commands.GetCommand( keystrokeValue ) ;
	return ( oCommand.Execute.apply( oCommand, FCKTools.ArgumentsToArray( arguments, 2 ) ) !== false ) ;
}

// Set the FCK.LinkedField reference to the field that will be used to post the
// editor data.
(function()
{
	// There is a bug on IE... getElementById returns any META tag that has the
	// name set to the ID you are looking for. So the best way in to get the array
	// by names and look for the correct one.
	// As ASP.Net generates a ID that is different from the Name, we must also
	// look for the field based on the ID (the first one is the ID).

	var oDocument = window.parent.document ;

	// Try to get the field using the ID.
	var eLinkedField = oDocument.getElementById( FCK.Name ) ;

	var i = 0;
	while ( eLinkedField || i == 0 )
	{
		if ( eLinkedField && eLinkedField.tagName.toLowerCase().Equals( 'input', 'textarea' ) )
		{
			FCK.LinkedField = eLinkedField ;
			break ;
		}

		eLinkedField = oDocument.getElementsByName( FCK.Name )[i++] ;
	}
})() ;

var FCKTempBin =
{
	Elements : new Array(),

	AddElement : function( element )
	{
		var iIndex = this.Elements.length ;
		this.Elements[ iIndex ] = element ;
		return iIndex ;
	},

	RemoveElement : function( index )
	{
		var e = this.Elements[ index ] ;
		this.Elements[ index ] = null ;
		return e ;
	},

	Reset : function()
	{
		var i = 0 ;
		while ( i < this.Elements.length )
			this.Elements[ i++ ] = null ;
		this.Elements.length = 0 ;
	}
} ;



// # Focus Manager: Manages the focus in the editor.
var FCKFocusManager = FCK.FocusManager =
{
	IsLocked : false,

	AddWindow : function( win, sendToEditingArea )
	{
		var oTarget ;

		if ( FCKBrowserInfo.IsIE )
			oTarget = win.nodeType == 1 ? win : win.frameElement ? win.frameElement : win.document ;
		else
			oTarget = win.document ;

		FCKTools.AddEventListener( oTarget, 'blur', FCKFocusManager_Win_OnBlur ) ;
		FCKTools.AddEventListener( oTarget, 'focus', sendToEditingArea ? FCKFocusManager_Win_OnFocus_Area : FCKFocusManager_Win_OnFocus ) ;
	},

	RemoveWindow : function( win )
	{
		if ( FCKBrowserInfo.IsIE )
			oTarget = win.nodeType == 1 ? win : win.frameElement ? win.frameElement : win.document ;
		else
			oTarget = win.document ;

		FCKTools.RemoveEventListener( oTarget, 'blur', FCKFocusManager_Win_OnBlur ) ;
		FCKTools.RemoveEventListener( oTarget, 'focus', FCKFocusManager_Win_OnFocus_Area ) ;
		FCKTools.RemoveEventListener( oTarget, 'focus', FCKFocusManager_Win_OnFocus ) ;
	},

	Lock : function()
	{
		this.IsLocked = true ;
	},

	Unlock : function()
	{
		if ( this._HasPendingBlur )
			FCKFocusManager._Timer = window.setTimeout( FCKFocusManager_FireOnBlur, 100 ) ;

		this.IsLocked = false ;
	},

	_ResetTimer : function()
	{
		this._HasPendingBlur = false ;

		if ( this._Timer )
		{
			window.clearTimeout( this._Timer ) ;
			delete this._Timer ;
		}
	}
} ;

function FCKFocusManager_Win_OnBlur()
{
	if ( typeof(FCK) != 'undefined' && FCK.HasFocus )
	{
		FCKFocusManager._ResetTimer() ;
		FCKFocusManager._Timer = window.setTimeout( FCKFocusManager_FireOnBlur, 100 ) ;
	}
}

function FCKFocusManager_FireOnBlur()
{
	if ( FCKFocusManager.IsLocked )
		FCKFocusManager._HasPendingBlur = true ;
	else
	{
		FCK.HasFocus = false ;
		FCK.Events.FireEvent( "OnBlur" ) ;
	}
}

function FCKFocusManager_Win_OnFocus_Area()
{
	FCK.Focus() ;
	FCKFocusManager_Win_OnFocus() ;
}

function FCKFocusManager_Win_OnFocus()
{
	FCKFocusManager._ResetTimer() ;

	if ( !FCK.HasFocus && !FCKFocusManager.IsLocked )
	{
		FCK.HasFocus = true ;
		FCK.Events.FireEvent( "OnFocus" ) ;
	}
}
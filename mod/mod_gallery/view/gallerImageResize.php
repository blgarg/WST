<?php
/*	  ThumbFly 2.0 - by kailey lampert (kailey@trepmal.com, trepmal.com)

	to include your on-the-fly thumbnail do this:
	<img src="<?php echo thumbfly( array( 'src'=>'image.jpg' , 'w' => 250 , 'clean' => true ) ); ?>" />

	free to use & modify, you could probably make it better anyway - in fact, if you do, let me know!

	params (array):
		src = relative/server path to image (required)
		w	   = desired width (optional, default = null)
		h	   = desired height (optional, default = null)
		name = name of thumbnail (optional, default = src)
		clean = boolean (optional, default = false) if true, remakes thumbs with same name
		warn = boolean (optional, default = false) if true, creates a 'brkn img' image where it can't create thumbnail

		(width & height: if one is defined - image will be scaled, if neither - height & width will be halved)		  */

function thumbfly( $params ) {
	$defaults = array('src' => null, 'w' => null, 'h' => null, 'name' => null, 'clean' => false, 'warn' => false);
	$params = array_merge($defaults, $params);
	extract($params); //get $src, $w, $h, $name, $clean, $warn
	$w  = isset($w) ? $w : false;
	$h = isset($h) ? $h : false; 

	$tmpdir = 'tmp-tf/'; if (!is_dir($tmpdir)) mkdir($tmpdir);
	$newname = (isset($name) ? $name : $src);
	$subdir = (dirname($newname)) ? dirname($newname) : '' ;
	if (!is_dir($tmpdir.$subdir)) mkdir($tmpdir.$subdir);
	$newname = $tmpdir.$newname;
	$type = @exif_imagetype($src);

	if($warn) $clean = false; if($clean) { if (is_file($newname)) unlink($newname); }

	$ok_types = array('1','2','3'); // not perfect, but what is?
	if (!isset($src) || !is_file($src) || !in_array($type,$ok_types) || $warn ) : //unusable src

		if		  ( !$w && !$h ) { $w = 135;	  $h = 45; } // if no width or height given, use defaults
		else if ( !$w && $h )  { $w = $h; } // if 1 dimension given, make it square
		else if ( !$h && $w )  { $h = $w; } // if 1 dimension given, make it square
		$img = imagecreatetruecolor($w, $h);
		$text_color = imagecolorallocate($img, 200, 200, 200);
		imagestring($img, 2, 5, 10, 'brkn img', $text_color);
		if ($warn)	  { imagejpeg($img,$newname); }
		else		{ $newname = ''; }
		imagedestroy($img);

	elseif (is_file($newname)) : // if tmp img exists..
		/* nothing happening... */
	else :  //src is real and thumb isn't cached... let's start resizing!

		list($ow, $oh) = getimagesize($src); //get dimensions of src img
		$or = $ow/$oh; //original ratio

		if		  ( !$w && !$h ) { $w = $ow*(0.5);	$h = $oh*(0.5); } // if no width or height given - change defaults here!
		else if ( !$w && $h )  { $w = ($h*$or); } //only height? scale
		else if ( !$h && $w )  { $h = ($w/$or); } //only width? scale
		$r = $w/$h; //here to prevent division by zero

		$image_thumb = imagecreatetruecolor($w,$h); //create blank canvas in defined proportions

		$modwidth = $ow;	$modheight = $oh; //scaled size to work from
		$off_w = 0;			 $off_h = 0; //offsets
		if ($r > $or) :			 //if new is more landscape-y than original
			$modheight = $ow/$r;	//slice off some of top & bottom
			$off_h = ($oh-$modheight)/2; //get .5 the diff for centering (even slicing)
		elseif ($ratio < $or) :	 //and reverse...
			$modwidth = $oh*$r;
			$off_w = ($ow-$modwidth)/2;
		endif;

		switch ($type) {
			case 1: /*gif*/
				$image_original = imagecreatefromgif($src);
				$trns_ind = imagecolortransparent($image_original);
				if ($trns_ind >= 0) {
					$trns_color	= imagecolorsforindex($image_original,  $trns_ind);
					$trns_ind	= imagecolorallocate($image_thumb, $trns_color['red'], $trns_color['green'], $trns_color['blue']);
					imagefill($image_thumb, 0, 0, $trns_ind);
					imagecolortransparent($image_thumb, $trns_ind);
				}
				imagecopyresampled($image_thumb, $image_original, '0', '0', $off_w, $off_h, $w, $h, $modwidth, $modheight);
				$the_thumb .= '.gif'; $thumb_loc .= '.gif';
				imagegif($image_thumb, $newname);
			  break;
			case 2: /*jpg*/
				$image_original = imagecreatefromjpeg($src);
				imagecopyresampled($image_thumb, $image_original, '0', '0', $off_w, $off_h, $w, $h, $modwidth, $modheight);
				imagejpeg($image_thumb, $newname, 100);
			  break;
			case 3: /*png*/
				$image_original = imagecreatefrompng($src);
				imagealphablending( $image_thumb, false );
				imagesavealpha( $image_thumb, true );
				imagecopyresampled($image_thumb, $image_original, '0', '0', $off_w, $off_h, $w, $h, $modwidth, $modheight);
				imagepng($image_thumb, $newname);
			  break;
		}//end switch
		imagedestroy($image_thumb);
	endif;
	return $newname;
}// end function
?>
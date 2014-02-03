<?php
// jsloader.php
if(!isIE()){
// GZIP data automatically for browsers that support it
// this will automatically set the appropriate headers and perform additional browser compatibility
ob_start('ob_gzhandler');
}

header("Content-Type: text/javascript");
header("Expires: ".date(DATE_RFC1123,strtotime("+360 days"))); // Expire in a year
header("Cache-Control: private, max-age=9999"); // set cache to private (don't use public proxy, set cache age to a few hours)

// output each js file simply as strings -- faster and safer than include()
// add all of your site's shared JS files here
readfile("./prototype.js");
readfile("./scriptaculous.all.js");
readfile("./sifr3.js");
readfile("./sifr3-config.js");

function isIE(){
// check if browser is Internet Explorer less than 7 (6 and earlier had
// problems with GZIP even though it might request it
list($xxx,$browser,$version) = browser_info();

if($browser == "msie" && $version < 7){
return true;
}

return false;
}

// Courtesy robert at broofa dot com
function browser_info($agent=null) {
// Declare known browsers to look for
$known = array('msie', 'firefox', 'safari', 'webkit', 'opera', 'netscape',
'konqueror', 'gecko');

// Clean up agent and build regex that matches phrases for known browsers
// (e.g. "Firefox/2.0" or "MSIE 6.0" (This only matches the major and minor
// version numbers.  E.g. "2.0.0.6" is parsed as simply "2.0"
$agent = strtolower($agent ? $agent : $_SERVER['HTTP_USER_AGENT']);
$pattern = '#(?<browser>' . join('|', $known) .
')[/ ]+(?<version>[0-9]+(?:\.[0-9]+)?)#';

// Find all phrases (or return empty array if none found)
if (!preg_match_all($pattern, $agent, $matches)) return array();

// Since some UAs have more than one phrase (e.g Firefox has a Gecko phrase,
// Opera 7,8 have a MSIE phrase), use the last one found (the right-most one
// in the UA).  That's usually the most correct.
$i = count($matches['browser'])-1;
return array($matches['browser'][$i] => $matches['version'][$i]);
}
?>
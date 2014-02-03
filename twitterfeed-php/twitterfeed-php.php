<?
    $username = "Blal";
    $limit = 50;
    $feed = 'http://twitter.com/statuses/user_timeline.rss?screen_name='.$username.'&count='.$limit;
    $tweets = file_get_contents($feed);
    
		$tweets = str_replace("&", "&", $tweets);	
		$tweets = str_replace("<", "<", $tweets);
		$tweets = str_replace(">", ">", $tweets);
		$tweet = explode("<item>", $tweets);
    $tcount = count($tweet) - 1;

for ($i = 1; $i <= $tcount; $i++) {
    $endtweet = explode("</item>", $tweet[$i]);
    $title = explode("<title>", $endtweet[0]);
    $content = explode("</title>", $title[1]);
		$content[0] = str_replace("&#8211;", "&mdash;", $content[0]);
	
		$content[0] = preg_replace("/(http:\/\/|(www\.))(([^\s<]{4,68})[^\s<]*)/", '<a href="http://$2$3" target="_blank">$1$2$4</a>', $content[0]);
		$content[0] = str_replace("$username: ", "", $content[0]);
		$content[0] = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $content[0]);
		$content[0] = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $content[0]);
    $mytweets[] = $content[0];
}

while (list(, $v) = each($mytweets)) {
	$tweetout .= "<div>$v</div>\n";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Twitter Feed with PHP</title>
<link rel="stylesheet" href="twitterfeed-php.css">
</head>

<body>

<div class="twitter" id="phptweets">
<h1>Twitter Feed with PHP</h1>
<?=$tweetout;?></div>	


</body>
</html>

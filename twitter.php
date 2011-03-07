<?php

	$cachefile = '_cache/twitter.html';
	$cachetime = 120 * 2; // 2 hours
	// $cachetime = 1; // 2 hours
	if (file_exists($cachefile) && (time() - $cachetime < filemtime($cachefile))) {
		include($cachefile);
		echo "<!-- Cached ".date('jS F Y H:i', filemtime($cachefile))." -->";
		exit;
	}
	
	ob_start();
	$rss = 'http://twitter.com/statuses/user_timeline/7173592.rss';

	require_once('_includes/helpers.php');
	require_once('_includes/php-simplepie/simplepie.class.php');
	$twitter = new SimplePie();
	$twitter->set_cache_location('./_includes/php-simplepie/cache');
	$twitter->set_feed_url($rss);
	$twitter->init();
	$twitter->handle_content_type();
	
	$section = 'twitter';
	$page_title = 'Michael Flanagan';
	include('_includes/header.php');
?>


		<div id="originalLink"><a href="http://twitter.com/micflan">Source: <span>@micflan on Twitter</span></a></div>
		<div id="blogWrap">
			<?php foreach ($twitter->get_items() as $item): ?>

				<div class="item box">
					<?php 
						$text = htmlentities($item->get_content());
						autolink($text);
					?>
					<div class="span-10 post_content"><div class="tweet"><?php echo $text; ?></div></div>
					<div class="block post_date last"><span><a href="<?php echo $item->get_permalink() ?>"><?php echo $item->get_date('j M Y'); ?></a></span></div>
				</div>
			<?php endforeach; ?>
		</div>




<?php include('_includes/footer.php');

$fp = fopen($cachefile, 'w'); // open the cache file for writing
fwrite($fp, ob_get_contents()); // save the contents of output buffer to the file
fclose($fp); // close the file
ob_end_flush(); // Send the output to the browser
?>

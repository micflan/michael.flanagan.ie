<?php

	$cachefile = '_cache/tumblr.html';
	$cachetime = 120 * 60; // 2 hours
	// $cachetime = 1; // 2 hours
	if (file_exists($cachefile) && (time() - $cachetime < filemtime($cachefile))) {
		include($cachefile);
		echo "<!-- Cached ".date('jS F Y H:i', filemtime($cachefile))." -->";
		exit;
	}
	
	ob_start();
	$rss = 'http://micflan.tumblr.com/rss';
	
	require_once('_includes/php-simplepie/simplepie.class.php');
	$blog = new SimplePie();
	$blog->set_cache_location('./_includes/php-simplepie/cache');
	$blog->set_feed_url($rss);
	$blog->init();
	$blog->handle_content_type();
	
	$section = 'tumblr';
	$page_title = 'Michael Flanagan';
	include('_includes/header.php');
?>


<div id="originalLink"><a href="http://micflan.tumblr.com/">Visit micflan.tumblr.com</a></div>
<div id="blogWrap">
	<?php foreach ($blog->get_items() as $item): ?>
		<div class="item box">
			<h2 class="span-10 post_title"><a href="<?php echo $item->get_permalink(); ?>"><?php echo $item->get_title(); ?></a></h2>
			<div class="block post_date last"><span><?php echo $item->get_date('j M Y'); ?></span></div>
			<div class="clear post_content"><?php echo $item->get_content(); ?></div>
		</div>
	<?php endforeach; ?>
</div>




<?php include('_includes/footer.php');

$fp = fopen($cachefile, 'w'); // open the cache file for writing
fwrite($fp, ob_get_contents()); // save the contents of output buffer to the file
fclose($fp); // close the file
ob_end_flush(); // Send the output to the browser
?>
<?php
	$cachefile = '_cache/bookmarks.html';
	$cachetime = 120 * 60; // 2 hours
	// $cachetime = 1; // 2 hours
	if (file_exists($cachefile) && (time() - $cachetime < filemtime($cachefile))) {
		include($cachefile);
		echo "<!-- Cached ".date('jS F Y H:i', filemtime($cachefile))." -->";
		exit;
	}

	ob_start();

	$rss = 'http://feeds.delicious.com/v2/rss/micflan?count=15';
	require_once('_includes/class.delicious.php');
	require_once('_includes/helpers.php');
	
	$d = new delicious_api_parser();
	$bookmarks = $d->parse_posts_recent();
	$section = 'bookmarks';
	$page_title = 'Michael Flanagan';

	include('_includes/header.php');
?>



<div id="originalLink"><a href="http://delicious.com/micflan">Source: <span>delicious.com/micflan</span></a></div>
<div id="blogWrap">
	<?php foreach ($bookmarks as $item): ?>
		<?php $tags = explode(' ', $item['tag']) ?>
		<div class="item box">
			<div class="span-10 post_title"><a href="<?php echo $item['href'] ?>"><?php echo $item['description']; ?></a></div>
			<div class="block post_date last"><span><?php echo  date_delicious($item['time']); ?></span></div>
			<div class="post_content">
				<span>
					<strong>tagged with : </strong>
					<?php
						foreach ($tags as $key => $tag)
						{
							echo "<a href=\"http://delicious.com/micflan/$tag\">$tag</a> ";
						}
					?>
				</span>
			</div>
		</div>
	<?php endforeach; ?>
</div>




<?php include('_includes/footer.php');

$fp = fopen($cachefile, 'w'); // open the cache file for writing
fwrite($fp, ob_get_contents()); // save the contents of output buffer to the file
fclose($fp); // close the file
ob_end_flush(); // Send the output to the browser


?>

<?php

	$cachefile = '_cache/blog.html';
	$cachetime = (120 * 60) * 12; // 24 hours
	// $cachetime = 1; // 2 hours
	if (file_exists($cachefile) && (time() - $cachetime < filemtime($cachefile))) {
		include($cachefile);
		echo "<!-- Cached ".date('jS F Y H:i', filemtime($cachefile))." -->";
		exit;
	}
	
	ob_start();
	$rss = 'http://michael.flanagan.ie/blog/index.php/feed/';

	require_once('_includes/config.php');
	require_once('_includes/Typography.php');
	require_once('_includes/php-simplepie/simplepie.class.php');
	$type = new Typography();

	mysql_connect($config['wp_dbhost'], $config['wp_dbuser'], $config['wp_dbpass']) or die(mysql_error());
	mysql_select_db($config['wp_dbname']) or die(mysql_error());

	$query  = "SELECT * FROM wp_posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_date desc LIMIT 15";
	$result = mysql_query($query);

	while($row = mysql_fetch_assoc($result, MYSQL_ASSOC))
	{
		$blogs[] = $row;
	}
	
	$section = 'blog';
	$page_title = 'Michael Flanagan';
	include('_includes/header.php');
?>


		<div id="blogWrap">
			<?php foreach ($blogs as $blog): ?>
				<div class="item box">
					<div class="span-10 post_title"><a href="/read/<?php echo $blog['ID'] . '/' . $blog['post_name']; ?>"><?php echo $blog['post_title']; ?></a></div>
					<div class="block post_date last"><span><?php echo date('j M Y', strtotime($blog['post_date'])); ?></span></div>
					<div class="clear post_content"><?php echo $type->auto_typography($blog['post_content']); ?></div>
				</div>
			<?php endforeach; ?>
		</div>




<?php include('_includes/footer.php'); 


$fp = fopen($cachefile, 'w'); // open the cache file for writing
fwrite($fp, ob_get_contents()); // save the contents of output buffer to the file
fclose($fp); // close the file
ob_end_flush(); // Send the output to the browser
?>

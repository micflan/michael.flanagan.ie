<?php
	error_reporting(E_ALL);
	ini_set('display_errors',1);

	require_once('_includes/config.php');
	require_once('_includes/Typography.php');
	require_once('_includes/helpers.php');
	$type = new Typography();

	$section = 'blog';
	$page_title = 'Michael Flanagan';

	$uri = explode('/', $_SERVER["REQUEST_URI"]);
	if (!is_numeric($uri[2]))
	{
		header('Location: /blog');
	}

	mysql_connect($config['wp_dbhost'], $config['wp_dbuser'], $config['wp_dbpass']) or die(mysql_error());
	mysql_select_db($config['wp_dbname']) or die(mysql_error());

	$query  = "SELECT * FROM wp_posts WHERE id = ".$uri[2]." LIMIT 1";
	$result = mysql_query($query);

	$blog = mysql_fetch_array($result, MYSQL_ASSOC);
	$rss = 'http://michael.flanagan.ie/blog/index.php/feed/';

	include('_includes/header.php');
?>


		<div id="blogWrap">
				<div class="item box">
					<div class="span-10 post_title"><span><?php echo $blog['post_title']; ?></span></div>
					<div class="block post_date last"><span><?php echo date('j M Y', strtotime($blog['post_date'])); ?></span></div>
					<div class="clear post_content"><?php echo $type->auto_typography($blog['post_content']); ?></div>
				</div>
		</div>




<?php include('_includes/footer.php'); 

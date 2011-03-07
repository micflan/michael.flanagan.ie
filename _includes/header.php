<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title><?php echo $page_title ?></title>
	<?php if ($rss) echo '<link rel="alternate" type="application/rss+xml" title="'.$section.' feed" href="'.$rss.'" />';?>
	<link rel="stylesheet" href="/_css/blueprint.css" type="text/css" media="only screen" title="no title" charset="utf-8" />
	<link rel="stylesheet" href="/_css/custom.css" type="text/css" media="screen" title="no title" charset="utf-8" />

	<link media="only screen and (max-device-width: 480px)" href="/_css/mobile.css" type="text/css" rel="stylesheet" />
	<meta name="viewport" content="initial-scale = 2.3, user-scalable = no" />
	<script type="text/javascript">
		window.scrollTo(0, 1);
	</script>
</head>

<body id="<?php echo $section ?>Body">

	<div class="container">
		<h1><a href="/">michael flanagan</a></h1>

		<div id="content" class="span-16 floatRight">

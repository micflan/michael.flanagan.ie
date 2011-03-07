<?php
	require_once('_includes/Typography.php');
	$type = new Typography();

	$rss = null;
	$section = 'work';
	$page_title = 'Michael Flanagan';
	include('_includes/header.php');
?>


<div id="helloWrap">
	<div class="box">
		<h2>Work</h2>
		<div class="box">
			<p><strong>The text below is lifted from my <a href="http://www.linkedin.com/in/micflan">LinkenIn profile</a>, which is a good place to get in touch and keep track of anything work related. But I'll try and update this page soon enough with some nicer looking copy and maybe even an image or two!</strong></p>
<hr />
<?php echo $type->auto_typography("<strong>Summary</strong>

Web developer with a passion for the open web. Available to work on or talk about any interesting projects or development roles in a freelance capacity.

My most recent work has been with Web Together (www.webtogether.ie), a Dublin based web design agency, where I developed and continue to maintain a number of projects which utilize the CodeIgniter PHP framework, including a robust, modular and designer friendly content management system.

Stand alone projects with Web Together:
<a href=\"http://managementbriefs.com/\">Management Briefs</a>
<a href=\"http://bandpages.ie/\">Bandpages.ie</a>
<a href=\"http://clontarfresidents.com/\">Clontarf Residents</a>
<a href=\"http://fetch.ie/\">Fetch.ie</a>

'Buy From The Builder' project with Web Together:
<a href=\"http://mgnewhomes.ie/\">M&amp;G New Homes</a>
<a href=\"http://mullennewhomes.ie/\">Mullen New Homes</a>
<a href=\"http://lismeennewhomes.ie/\">Lismeen New Homes</a>

Selection of websites using the 'Web Together CMS':
<a href=\"http://orjconstruction.ie/\">ORJ Construction</a>
<a href=\"http://chtc.ie/\">CHTC Limited</a>
<a href=\"http://dbass.ie/\">DBASS Accounting</a>
<a href=\"http://irishhearingaids.ie/\">Irish Hearing Aids</a>
<a href=\"http://hrforsmes.ie/\">HR For SME's</a>
<a href=\"http://orfs.ie/\">ORFS.ie</a>

<strong>Specialties</strong>
Web Application Development.
Primarily but not exclusive to PHP, CodeIgniter, HTML, CSS, jQuery, MySQL."); ?>
			<hr />
			<p>To get in touch, drop an email to <a href="mailto:michael@flanagan.ie"><strong>michael@flanagan.ie</strong></a>, find me on Twitter as <a href="http://twitter.com/micflan"><strong>@micflan</strong></a>, or chat on the phone to <strong>+353 (0)86 3966 007</strong>.</p>
		</div>
	</div>
</div>



<?php include('_includes/footer.php'); ?>

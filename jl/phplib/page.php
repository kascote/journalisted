<?php

require_once '../conf/general';
require_once '../../phplib/person.php';
require_once 'gatso.php';

function page_header( $title, $params=array() )
{
	header( 'Content-Type: text/html; charset=utf-8' );

    $P = person_if_signed_on(true); /* Don't renew any login cookie. */

	$datestring = date( 'l d.m.Y' );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title><?=$title ?></title>
  <style type="text/css" media="all">@import "/style.css";</style>
  <meta name="Content-Type" content="text/html; charset=UTF-8" />
<?php

	if (array_key_exists('rss', $params))
	{
		foreach ($params['rss'] as $rss_title => $rss_url)
		{
			printf( "  <link rel=\"alternate\" type=\"application/rss+xml\" title=\"%s\" href=\"%s\">\n", $rss_title, $rss_url );
		}
	}

?>
  <script type="text/javascript" src="/jl.js"></script>
</head>

<body>
 <div id="menu">
  <ul>
    <li class="cover">
      <a href="/about">Cover Story</a><br />
      What is journa-list?
    </li>
    <li class="all">
      <a href="/list">All Journalists</a><br />
      Alphabetical list of UK Journalists
    </li>
    <li class="subject">
      <a href="/tags">Subject Index</a><br />
      See what journalists are writing about
    </li>
    <li class="my">
      <a href="/alert">My Journa-list</a><br />
      Build your own newspaper
    </li>
  </ul>
 </div>

 <div id="head">
  <h1><a href="/"><span></span>Journa-list</a></h1>
  <h2>&#0133;read all about them!</h2>
  <p>
    <strong>FREE!</strong><br />
    <?php echo $datestring; ?><br />
    <br />
    A <a href="http://www.mediastandardstrust.com">Media Standards Trust</a> Publication
  </p>
 </div>



<?php
	if( $P )
	{
		if ($P->name_or_blank())
			$name = $P->name;
		else
			$name = $P->email;
		print "<div id=\"hellouser\">\n";
		print "Hello, {$name}\n";
		print "[<a href=\"/logout\">log out</a>]<br>\n";
		print "<small>(<a href=\"/logout\">this isn't you? click here</a>)</small><br>\n";
		print "</div>\n";
	}
?>


<div id="content">
<?php
	// TODO:
	// * login box
	// * Log-out option for logged-in users

/*
	if( $P )
	{
		if ($P->name_or_blank())
			$name = $P->name;
		else
			$name = $P->email;
		print "<div id=\"hellouser\">\n";
		print "Hello, {$name}\n";
//		print "[<a href=\"/logout\">log out</a>]<br>\n";
		print "<small>(<a href=\"/logout\">this isn't you? click here</a>)</small><br>\n";
		print "</div>\n";
	}
*/

/*
	// some extra menu items for logged-in users
	if( $P )
	{
?>
<li><a href="/logout">Log out</a></li>
<?php
	}
*/

?>
<?php
}


function page_footer( $params=array() )
{

?>
</div>
<div id="footer">
<?php

	gatso_report_html();

?>
Journa-list is a <a href="http://www.mediastandardstrust.com">Media Standards Trust</a> project.<br>
Questions? Comments? Suggestions? <a href="mailto:team@journa-list.dyndns.org">Let us know</a>
</div>
</body>
</html>
<?php

//	debug_comment_timestamp();

}

?>

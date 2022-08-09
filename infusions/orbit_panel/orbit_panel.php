<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2011 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: orbit_panel.php
| Version: 1.0
| Author: jikaka
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (!defined("IN_FUSION")) { die("Access Denied"); }

if (file_exists(INFUSIONS."orbit_panel/locale/".$settings['locale'].".php")) {
	include INFUSIONS."orbit_panel/locale/".$settings['locale'].".php";
} else {
	include INFUSIONS."orbit_panel/locale/English.php";
}

add_to_head("
<link type='text/css' href='".INFUSIONS."orbit_panel/css/styles.css' media='screen' rel='stylesheet' />
<script type='text/javascript' src='".INFUSIONS."orbit_panel/js/jquery.orbit-1.2.3.min.js'></script>
<!--[if IE]>
<style type='text/css'>
	.timer { display: none !important; }
	div.caption { background:transparent; filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000,endColorstr=#99000000);zoom: 1; }
</style>
<![endif]-->
<script type='text/javascript'>
	$(window).load(function() {
	$('#featured').orbit();
});
</script>
");

$result=dbquery(
	"SELECT * FROM ".$db_prefix."photo_albums ta ".
	"JOIN ".$db_prefix."photos USING (album_id)
	WHERE ".groupaccess('album_access')."
	ORDER BY photo_datestamp DESC LIMIT 0,10"
	);

opentable($locale['op001']);
if (dbrows($result)!= "0") {
	echo "<div align='center'><div id='featured'>";
	while($data = dbarray($result)) {
		echo "<a href='".BASEDIR."photogallery.php?photo_id=".$data['photo_id']."' class='side'>";
		echo "<img src='".PHOTOS."album_".$data['album_id']."/".$data['photo_filename']."' width='700' height='350' title='".$data['photo_title']."' alt='".$data['photo_title']."' border='0' />";
		echo "</a>";	
	}
	echo "</div></div>";
} else {
	echo $locale['op002'];
}
closetable();
?>
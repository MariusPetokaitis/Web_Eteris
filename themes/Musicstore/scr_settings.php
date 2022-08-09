<?php
include_once BASEDIR."config.php";

if (!defined("IN_FUSION")) { header("Location:../../index.php"); exit; }
function dbin($query) {
	$result = @mysql_query($query);
	if (!$result) {
		echo mysql_error();
		return false;
	} else {
		return $result;
	}
}
function naujienos($info,$sep="",$class="") {
	global $locale; $res = "";
	$link_class = $class ? " class='$class' " : "";
	$res .= "[<a href='profile.php?lookup=".$info['user_id']."'".$link_class.">".$info['user_name']."</a>]&nbsp;&nbsp;";
	$res .= $info['news_ext'] == "y" || $info['news_allow_comments'] ? "\n" : "\n";
	return $res;
}
function papildomi($info,$sep,$class="") {
	global $locale; $res = "";
	$link_class = $class ? " class='$class' " : "";
	if (!isset($_GET['readmore']) && $info['news_ext'] == "y") $res = "<a href='news.php?readmore=".$info['news_id']."'".$link_class.">".$locale['042']."</a>&nbsp;&nbsp;";
	if ($info['news_allow_comments']) $res .= "<a href='news.php?readmore=".$info['news_id']."'".$link_class.">".$info['news_comments'].$locale['043']."</a>&nbsp;&nbsp;";
	if ($info['news_ext'] == "y" || $info['news_allow_comments']) 
	$res .= " <a href='print.php?type=N&amp;item_id=".$info['news_id']."' target=_blank>".$locale['045']."</a>\n";
	return $res;
}
function rodata($info,$sep="",$class="") {
	global $locale; $res = "";
	$link_class = $class ? " class='$class' " : "";
	$res .= $locale['041'].showdate("shortdate", $info['news_date']);
	return $res;
}
?>
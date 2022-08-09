<?php
if (!defined("IN_FUSION")) { die("Access Denied"); }

define("THEME_WIDTH", "960");
define("THEME_BULLET", "<span class='bullet'>&middot;</span>");

require_once INCLUDES."theme_functions_include.php";

//v7 sublinks
function thesublinks($sep="&middot;",$class="") {
	$i = 0; $res = "";
	$sres = dbquery("SELECT * FROM ".DB_PREFIX."site_links WHERE link_position>='2' AND ".groupaccess('link_visibility')." AND link_url!='---' ORDER BY link_order ASC");
	if (dbrows($sres)) {
		while($sdata = dbarray($sres)) {
					if ($i != 0) { $res .= " ".$sep."\n"; } else { $res .= "\n"; }
					$link_target = $sdata['link_window'] == "1" ? " target='_blank'" : "";
					$link_class = $class ? " class='$class'" : "";
					if (strstr($sdata['link_url'], "http://") || strstr($sdata['link_url'], "https://")) {
						$res .= "<a href='".$sdata['link_url']."'".$link_target.$link_class.">".$sdata['link_name']."</a>";
					} else {
						$res .= "<a href='".BASEDIR.$sdata['link_url']."'".$link_target.$link_class.">".$sdata['link_name']."</a>";
					}

				$i++;
		}
	}
	if ($i != 0) { return $res; } else { return "&nbsp;"; }
}


function render_page($license=false) {

	global $settings, $main_style, $locale;

	//Header
	echo "<table cellpadding='0' cellspacing='0' width='".THEME_WIDTH."' align='center'>\n<tr>\n";
	echo "<td class='full-header'></td>\n";
	echo "</tr>\n</table>\n";

//sublinks css
	echo "<table width='".THEME_WIDTH."' border='0' cellspacing='0' cellpadding='0' align='center'><tr/><td/>";
	echo "<div id='altlinkler'>";
	echo "<ul><li>".thesublinks("</li>\n<li>");
	echo "</li></ul><div class='clear-both'>&nbsp;</div></div>";
	echo "</td></tr></table>\n";


	//Content
	echo "<table cellpadding='0' cellspacing='0' width='".THEME_WIDTH."' align='center' class='$main_style'>\n<tr>\n";
	if (LEFT) { echo "<td class='side-border-left' valign='top'>".LEFT."</td>"; }
	echo "<td class='main-bg' valign='top'>".U_CENTER.CONTENT.L_CENTER."</td>";
	if (RIGHT) { echo "<td class='side-border-right' valign='top'>".RIGHT."</td>"; }
	echo "</tr>\n</table>\n";

	//Footer
	echo "<table cellpadding='0' cellspacing='0' width='".THEME_WIDTH."' align='center'>\n<tr>\n";
	echo "<td align='center' class='bottom-footer'><br />".stripslashes($settings['footer']);
	if (!$license) { echo "EnergyONE by <a href='http://www.phpfusionstyle.com/news.php'>PHPfusionStyle.com</a>
<br />\n".showcopyright();  }

	echo "</td>\n";
	echo "</tr>\n</table>\n";

}

function render_news($subject, $news, $info) {

	echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
	echo "<td class='capmain-left'></td>\n";
	echo "<td class='capmain'>".$subject."</td>\n";
	echo "<td class='capmain-right'></td>\n";
	echo "</tr>\n</table>\n";
	echo "<table width='100%' cellpadding='0' cellspacing='0' class='spacer'>\n<tr>\n";
	echo "<td class='capmain-center-left'></td>\n";
	echo "<td class='main-body middle-border'>".$news."</td>\n";
	echo "<td class='capmain-center-right'></td>\n";
	echo "</tr>\n<tr>\n";
	echo "<td class='capmain-bottom-left'></td>\n";
	echo "<td align='center' class='news-footer middle-border'>\n";
	echo newsposter($info,"&middot;").newsopts($info,"&middot;").itemoptions("N",$info['news_id']);
	echo "</td>\n";
	echo "<td class='capmain-bottom-right'></td>\n";
	echo "</tr>\n</table>\n";

}

function render_article($subject, $article, $info) {

	echo "<table width='100%' cellpadding='0' cellspacing='0'>\n<tr>\n";
	echo "<td class='capmain-left'></td>\n";
	echo "<td class='capmain'>".$subject."</td>\n";
	echo "<td class='capmain-right'></td>\n";
	echo "</tr>\n</table>\n";
	echo "<table width='100%' cellpadding='0' cellspacing='0' class='spacer'>\n<tr>\n";
	echo "<td class='capmain-center-left'></td>\n";
	echo "<td class='main-body middle-border'>".($info['article_breaks'] == "y" ? nl2br($article) : $article)."</td>\n";
	echo "<td class='capmain-center-right'></td>\n";
	echo "</tr>\n<tr>\n";
	echo "<td class='capmain-bottom-left'></td>\n";
	echo "<td align='center' class='news-footer'>\n";
	echo articleposter($info," &middot;").articleopts($info,"&middot;").itemoptions("A",$info['article_id']);
	echo "</td>\n";
  echo "<td class='capmain-bottom-right'></td>\n";
  echo "</tr>\n</table>\n";

}

function opentable($title) {

	echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
	echo "<td class='capmain-left'></td>\n";
	echo "<td class='capmain'>".$title."</td>\n";
	echo "<td class='capmain-right'></td>\n";
	echo "</tr>\n</table>\n";
	echo "<table cellpadding='0' cellspacing='0' width='100%' class='spacer'>\n<tr>\n";
	echo "<td class='capmain-center-left'></td>\n";
	echo "<td class='main-body'>\n";

}

function closetable() {

	echo "</td>\n";
	echo "<td class='capmain-center-right'></td>\n";
	echo "</tr><tr>\n";
	echo "<td class='capmain-bottom-left'></td>\n";
	echo "<td class='news-footer'></td>\n";
	echo "<td class='capmain-bottom-right'></td>\n";
//	echo "</tr><tr>\n";
	echo "</tr>\n</table>\n";

}

function openside($title, $collapse = false, $state = "on") {

	global $panel_collapse; $panel_collapse = $collapse;

	echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
	echo "<td class='scapmain-left'></td>\n";
	echo "<td class='scapmain'>$title</td>\n";
	if ($collapse == true) {
		$boxname = str_replace(" ", "", $title);
		echo "<td class='scapmain' align='right'>".panelbutton($state, $boxname)."</td>\n";
	}
	echo "<td class='scapmain-right'></td>\n";
 	echo "</tr>\n</table>\n";
	echo "<table cellpadding='0' cellspacing='0' width='100%' class='spacer'>\n<tr>\n";
	echo "<td class='scapmain-center-left'></td>\n";
	echo "<td class='side-body'>\n";
	if ($collapse == true) { echo panelstate($state, $boxname); }

}

function closeside() {

	global $panel_collapse;

	if ($panel_collapse == true) { echo "</div>\n"; }
	echo "</td>\n";
	echo "<td class='scapmain-center-right'></td>\n";
  echo "</tr><tr>\n";
  echo "<td class='scapmain-bottom-left'></td>\n";
  echo "<td class='side-footer'></td>\n";
	echo "<td class='scapmain-bottom-right'></td>\n";
  echo "</table>\n";

}
?>
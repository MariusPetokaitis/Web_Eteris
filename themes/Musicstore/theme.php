<?php
if (!defined("IN_FUSION")) { die("Access Denied"); }

define("THEME_WIDTH", "980");
define("THEME_BULLET", "<img src='".THEME."images/bullet.gif' alt='' style='border:0' />");

require_once INCLUDES."theme_functions_include.php";

function render_page($license=false) {

	global $aidlink, $settings, $main_style, $locale, $userdata;

	//Header
	echo "<table cellspacing='0' cellpadding='0' width='".THEME_WIDTH."' align='center'>\n<tr>\n";
	echo "<td>\n";

	
	 echo "<table height='229' cellSpacing='0' cellPadding='0' width='100%' border='0'>
	<tr>
	
	<td>";
	include_once "Header.php";
	
	
	
	
	//Content
	echo "<table cellpadding='0' cellspacing='0' class='border' width='".THEME_WIDTH."' align='center'>\n<tr>\n";
	if (LEFT) { echo "<td class='side-border-left' valign='top'>".LEFT."</td>"; }
	echo "<td class='main-bg' valign='top'>".U_CENTER.CONTENT.L_CENTER."</td>";
	if (RIGHT) { echo "<td class='side-border-right' valign='top'>".RIGHT."</td>"; }
	echo "</tr>\n</table>\n";
	
	//Footer

	echo "<table cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td class='footer' colspan=3><hr><br>".stripslashes($settings['footer'])."</td>
</tr>
<tr>
<td class='footer'>Powered by <a HREF='http://www.php-fusion.co.uk'>PHP-Fusion</A><br />Released as free software<br> without warranties under <a href='http://www.fsf.org/licensing/licenses/agpl-3.0.html' target='_blank' title='' class='white'>GNU Affero GPL</a> v3.</A><br><br>

<td align='center' class='footer'>
</td><td class='footer' width='33%' align='center'>".showcounter()." | ".sprintf($locale['global_172'], substr((get_microtime() - START_TIME),0,4))."<br /><br>Musicstore Theme by Assensvej<br>	visit <a HREF='http://www.assensvej.dk/7/'>Assensvej.dk</A>.</TD>
</tr>
</table>
</td>
</tr>
</table>\n";






}

function render_news($subject, $news, $info) {

	echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
	echo "<td class='capmain'>".$subject."</td>\n";
	echo "</tr>\n<tr>\n";
	echo "<td class='main-body'>".$news."</td>\n";
	echo "</tr>\n<tr>\n";
	echo "<td align='center' class='news-footer'>\n";
	echo newsposter($info," &middot;").newsopts($info,"&middot;").itemoptions("N",$info['news_id']);
	echo "</td>\n</tr>\n</table>\n";

}

function render_article($subject, $article, $info) {
	
	echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
	echo "<td class='capmain'>".$subject."</td>\n";
	echo "</tr>\n<tr>\n";
	echo "<td class='main-body'>".($info['article_breaks'] == "y" ? nl2br($article) : $article)."</td>\n";
	echo "</tr>\n<tr>\n";
	echo "<td align='center' class='news-footer'>\n";
	echo articleposter($info," &middot;").articleopts($info,"&middot;").itemoptions("A",$info['article_id']);
	echo "</td>\n</tr>\n</table>\n";

}

function opentable($title) {

	echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
	echo "<td class='capmain'>".$title."</td>\n";
	echo "</tr>\n<tr>\n";
	echo "<td class='main-body'>\n";

}

function closetable() {

	echo "</td>\n</tr>\n</table>\n";

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
	echo "<td class='side-body'>\n";	
	if ($collapse == true) { echo panelstate($state, $boxname); }

}

function closeside() {

	global $panel_collapse;

	if ($panel_collapse == true) { echo "</div>\n"; }	
	echo "</td>\n</tr>\n</table>\n";
echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n<td height='5'></td>\n</tr>\n</table>\n";

}
?>
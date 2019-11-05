<?php
/*
+------------------------------------------------------------------------------+
|     e107 Mobile  v2.2 by Martinj
|	November 2010
|	Visit www.martinj.co.uk for help and support
+------------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }
$e107ren=strlen(footerlink)==84 ? base64_decode(footerlink) : die(EMP_WARN_0);
@include_once(e_THEME."e107mobile/languages/".e_LANGUAGE.".php");
@include_once(e_THEME."e107mobile/languages/English.php");

$register_sc[]='E107MOBILE';
$register_sc[]='NEWSCOMMENTS';

$themename = "e107mobile";
$themeversion = "2.1";
$themeauthor = "martinj";
$themeemail = "martinleeds@gmail.com";
$themewebsite = "http://www.martinj.co.uk";
$themedate = "28/11/2010";
$themeinfo = "Mobile phone friendly theme. Works with the e107mobile plugin.";
define("STANDARDS_MODE", TRUE);
$xhtmlcompliant = TRUE;
$csscompliant = TRUE;
$theme_css_php = TRUE;

global $pref;

// GET THEME OPTIONS
$em_theme=explode("|",$pref['mobile_colourScheme']);
$em_link=explode("|",$pref['mobile_linkStyle']);

function theme_head() {
	global $pref;
	require_once("e107mobile_class.php");
		$retval="<meta name='viewport' content='width=device-width' />
		<style type=\"text/css\">".getMobileCSS($pref['mobile_colourScheme'],$pref['mobile_linkStyle'])."</style>";
			return  $retval;
	}

$layout = "_default";

$HEADER = "
<table style='width: 100%;'>
<tr><td>";
	if($em_theme[0]=="") {
		$Hinc="{SITENAME}";
	}
	else {
		$Hinc=$em_theme[0];
	}

	if(!$em_link[3]) {
	$em_link[3]='3';
	}

$HEADER .="<div id='header'><a href='".SITEURL."'>".$Hinc."</a>
</div>
<div id='topnav'>{SITELINKS=menu:".$em_link[3]."}</div>
</td></tr>
</table>

<table style='width: 100%;'>
<tr><td>
";

if($_SESSION['e107mobile']=='e107_mobile_theme') {
	$e107ren="<div class='smalltext' style='text-align:center'>{E107MOBILE}</div><br/><div class='smalltext' style='text-align:center'><a href='".e_BASE."?e107mobile=off'>".LAN_EMP_12."</a><br/><br/>$e107ren<br/></div>";
		$erendermobile=strpos($e107ren,'rtin') ? true : die(EMP_WARN_1);
}

if(isset($pref['mobile_menu'])) {
	switch($pref['mobile_menu'])
	{
	case "0":
	$FOOTER="</td></tr></table>".$e107ren;
	break;

	case "1":
	$FOOTER="</td></tr></table><table style='width: 100%;'><tr><td>{MENU=1}</td></tr></table>".$e107ren."<br/>";
	break;

	case "2":
	$FOOTER="</td></tr></table><table style='width: 100%;'><tr><td>{MENU=1}</td></tr><tr><td>{MENU=2}</td></tr></table>".$e107ren."<br/>";
	break;

	default:
	$FOOTER = "</td></tr></table>".$e107ren;
	}
}
else {
$FOOTER = "
</td></tr></table>".$e107ren;
}

$NEWSSTYLE = "
<h2>
{NEWSTITLELINK=extend}
</h2>
<div class='bodytable' style='text-align:left'>
{NEWSBODY}
{EXTENDED}
</div>
<div style='text-align:left' class='smalltext'>
<br />{NEWSAUTHOR}&nbsp;
on&nbsp;
{NEWSDATE}<br/>
<b>{NEWSCOMMENTS}</b>
</div>
<hr/>";

define("ICONSTYLE", "float: left; border:0");
define("COMMENTLINK", LAN_THEME_3);
define("COMMENTOFFSTRING", LAN_THEME_2);
define("PRE_EXTENDEDSTRING", "<br /><br />[ ");
define("EXTENDEDSTRING", LAN_THEME_4);
define("POST_EXTENDEDSTRING", " ]<br />");
define("TRACKBACKSTRING", LAN_THEME_5);
define("TRACKBACKBEFORESTRING", " | ");

function linkstyle($sTheStyle)
{
$aSLinkSet['prelink'] = "<ul class='nav'>";
$aSLinkSet['postlink'] = "</ul>";
$aSLinkSet['linkstart'] = "<li class='topnav'>";
$aSLinkSet['linkend'] = "</li>";
return $aSLinkSet;
}

$erendermobile=true ? '' : die(EMP_WARN_2);

function tablestyle($caption, $text, $mode)
{
	echo "<h4>{$caption}</h4>{$text}
	<br />";
}

$COMMENTSTYLE = "
<table style='width: 100%;'>
<tr>
<td style='width: 100%;'>
<div>
{COMMENT} {COMMENTEDIT}
</div>
</td>
</tr><tr>
<td style='width: 30%; text-align: right;'>{USERNAME} @ <span class='smalltext'>{TIMEDATE}</span><br /><span class='smalltext'>{REPLY}</span></td>
</tr>
</table>
";

$CHATBOXSTYLE = "
<b>{USERNAME}</b>
<div class='smalltext'>
{MESSAGE}
</div>
<br />";

$SEARCH_SHORTCODE = "
            <input type='text' name='s' id='s' value='".LAN_THEME_5."'/>
            <input type='submit' id='submit' name='q' value='".LAN_THEME_6."' class='button' />
            <div class='searchbottom'>&nbsp;</div>
";

?>
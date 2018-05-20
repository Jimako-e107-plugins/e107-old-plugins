<?php

// [multilanguage]
$lan_file = e_THEME."ebattles/languages/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file : e_THEME."ebattles/languages/English.php");

// Set theme info
$themename = "eBattles";
$themeversion = "1.0";
$themeauthor = "www.ebattles.net";
$themedate = "05/01/09";
$themeinfo = "Theme eBattles";
$xhtmlcompliant = TRUE;	// If set to TRUE will display an XHTML compliant logo in theme manager
$csscompliant = TRUE;	// If set to TRUE will display a CSS compliant logo in theme manager

define("IMODE", "lite");
require_once(THEME."eb_custom_login.php"); // DEFINE EB_CUSTOM_LOGIN
require_once(THEME."comment_template.php");

// This theme requires e107 v0.7 or higher.

//[layout]
$layout = "_default";

$flashheader = "
<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000'
codebase='http://active.macromedia.com/flash2/cabs/swflash.cab#version=5,0,42,0'
id='Movie1' width='' height=''>
<param name='movie' value='".THEME."images/'>
<param name='quality' value='high'>
<param name='bgcolor' value='#000000'>
<embed name='Movie1' src='".THEME."images/' quality='high' bgcolor='#000000
width='' height=''
type='application/x-shockwave-flash'
pluginspage='http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash'>
</embed>
</object>
";

$HEADER = "
	<table cellpadding='0' cellspacing='3' class='topborder' style='width:100%'>
		<tr>
			<td class='logo' colspan='3' style='text-align:center; vertical-align:middle; height:68px'>
			<img src='".THEME."images/logo.png' alt='eBattles' />
			</td>
		</tr>
		<tr>
            <td style='width:50%; text-align:left'>
		    {SITELINKS_ALT=no_icons+noclick}
            </td>
            <td style='width:25%; text-align:right'>
            {CUSTOM=clock}
            </td>
            <td style='width:20%; text-align:right'>
            {CUSTOM=search+default}
            </td>
		</tr>
		<tr>
		    <td style='text-align:center; vertical-align:top' colspan='3'>
		    </td>
		</tr>
	</table>

	<table cellpadding='0' cellspacing='0' border='0' style='width:100%; margin-top:5px'>
		<tr>
			<td style='width:10%; vertical-align:top;'>
				{MENU=1}
			</td>

			<td style='width:70%; vertical-align:top;'>
";

$FOOTER = "
{MENU=3}
</td>
<td class='right_menu'>
{MENU=2}
</td>
<td class='rightr5'><img src='".THEME."images/blank.gif' width='1' alt='' class='ffimgfix' />
</td>
</tr>
</table>

<table style='width:100%' cellspacing='0' cellpadding='0'>
<tr>
<td class='r4c1'><img src='".THEME."images/blank.gif' width='1' height='38' alt='' class='ffimgfix' /></td>
<td class='r4c2' style='width:100%;white-space:nowrap'>
{SITEDISCLAIMER}
</td>
<td class='r4c3'><img src='".THEME."images/blank.gif' width='1' height='38' alt='' class='ffimgfix' /></td>
</tr>
</table>
";

$CUSTOMHEADER['eBattles Layout'] = "
	<table cellpadding='0' cellspacing='3' class='topborder' style='width:100%'>
		<tr>
			<td class='logo' colspan='3' style='text-align:center; vertical-align:middle; height:68px'>
			<img src='".THEME."images/logo.png' alt='eBattles' />
			</td>
		</tr>
		<tr>
            <td style='width:50%; text-align:left'>
		    {SITELINKS_ALT=no_icons+noclick}
            </td>
            <td style='width:25%; text-align:right'>
            {CUSTOM=clock}
            </td>
            <td style='width:20%; text-align:right'>
            {CUSTOM=search+default}
            </td>
		</tr>
		<tr>
		    <td style='text-align:center; vertical-align:top' colspan='3'>
		    </td>
		</tr>
	</table>

	<table cellpadding='0' cellspacing='0' border='0' style='width:100%; margin-top:5px'>
		<tr>
			<td style='width:10%; vertical-align:top;'>
				{MENU=1}
			</td>

			<td style='width:95%; vertical-align:top;'>
";

$CUSTOMFOOTER['eBattles Layout'] = "
{MENU=3}
</td>
<td class='rightr5'><img src='".THEME."images/blank.gif' width='1' alt='' class='ffimgfix' />
</td>
</tr>
</table>

<table style='width:100%' cellspacing='0' cellpadding='0'>
<tr>
<td class='r4c1'><img src='".THEME."images/blank.gif' width='1' height='38' alt='' class='ffimgfix' /></td>
<td class='r4c2' style='width:100%;white-space:nowrap'>
{SITEDISCLAIMER}
</td>
<td class='r4c3'><img src='".THEME."images/blank.gif' width='1' height='38' alt='' class='ffimgfix' /></td>
</tr>
</table>
";

$CUSTOMPAGES['eBattles Layout'] = "claninfo.php clanmanage.php clans.php eventcreate.php eventinfo.php eventmanage.php eventmatchs.php events.php eventspast.php ";

// [theme foot]
function theme_foot() {
echo '
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1993764-1";
urchinTracker();
</script>
';
} 

//[newsstyle]

$NEWSSTYLE = "

	<div style='cursor:pointer' onclick=\"expandit('exp_news_{NEWSID}')\">
    <table cellpadding='0' cellspacing='0' border='0'>
	    <tr>
	        <td class='mt1'><img src='".THEME."images/blank.gif' width='7' height='35' alt='' class='ffimgfix' /></td>
			<td class='mtm' style='width:100%;white-space:nowrap'>
			{NEWSICON}&nbsp;{STICKY_ICON}{NEWSTITLE}
			</td>
		<td class='mt2'><img src='".THEME."images/blank.gif' width='19' height='35' alt='' class='ffimgfix' /></td>
	    </tr>
	</table>
	</div>

	<div id='exp_news_{NEWSID}'>
	<table cellpadding='0' cellspacing='0' border='0'>
		<tr>
			<td class='mleft'><img src='".THEME."images/blank.gif' width='7' alt='' />
			</td>
			<td class='middlemiddle' style='width:100%'>
				{NEWSIMAGE}
				{NEWSBODY}
				{EXTENDED}
				<div class='newscomments'>
				<img class='news_comments_icon' src='".THEME_ABS."images/comments_16.png' alt='' />&nbsp;
					{NEWSCOMMENTS}{TRACKBACK}
				</div>
				<div class='newscomments' style='text-align:center'>
					<span style='white-space:nowrap'> ".LAN_THEME_5." {NEWSAUTHOR} ".LAN_THEME_6." </span>
					<span style='white-space:nowrap'>{NEWSDATE}</span>
					<span style='white-space:nowrap'>&nbsp;&nbsp;{EMAILICON}{PRINTICON}{PDFICON}{ADMINOPTIONS}</span>
				</div>
			</td>
			<td class='mright'><img src='".THEME."images/blank.gif' width='7' alt='' />
			</td>
		</tr>
	</table>
	</div>
	
";


//[newsbits]
// Define attributes associated with news style.

define('ICONMAIL', 'email_16.png');
define('ICONPRINT', 'print_16.png');
define('ICONSTYLE', 'float: left; border:0');
define('COMMENTOFFSTRING', LAN_THEME_1);
define('COMMENTLINK', LAN_THEME_2);
define('PRE_EXTENDEDSTRING', '<br /><br />[ ');
define('EXTENDEDSTRING', LAN_THEME_3);
define('POST_EXTENDEDSTRING', ' ]<br />');


//[mainlinkstyle]

//define(PRELINK, "<div>&raquo; ");
//define(POSTLINK, "</div>");
define(LINKSTART, "");
//define(LINKEND, "<br /><img style='margin-top: 2px; margin-bottom: 2px;' width='190' height='1' src='".THEME."images/hr.png'><br />");
define(LINKEND, "&raquo; ");
define(LINKALIGN, "center");


//[menustyle]

function tablestyle($caption, $text)
{
  global $expand_menu_counter;
  $expand_menu_counter += 1;

  $expand_autohide_list = array("w000t");
  if (in_array($caption, $expand_autohide_list)) { $expand_autohide = "display:none"; } else { unset($expand_autohide); }

  echo "
	<div style='cursor:pointer' onclick=\"expandit('exp_menu_$expand_menu_counter')\">	
	<table cellpadding='0' cellspacing='0'>
	    <tr>
	        <td class='mt1'><img src='".THEME."images/blank.gif' width='7' height='35' alt='' class='ffimgfix' /></td>
			<td class='mtm' style='width:100%;white-space:nowrap'>".$caption."</td>
			<td class='mt2'><img src='".THEME."images/blank.gif' width='19' height='35' alt='' class='ffimgfix' /></td>
	    </tr>
	</table>
	</div>
	
	<div id='exp_menu_$expand_menu_counter' style='$expand_autohide'>
	<table cellpadding='0' cellspacing='0'>
		<tr>
			<td class='mleft'><img src='".THEME."images/blank.gif' width='7' alt='' />
			</td>
			<td class='middlemiddle' style='width:100%'>".$text."</td>
			<td class='mright'><img src='".THEME."images/blank.gif' width='7' alt='' />
			</td>
		</tr>
	</table>
	</div>

	<table style='width:100%' cellspacing='0' cellpadding='0' >
		<tr>
			<td class='md1'><img src='".THEME."images/blank.gif' width='7' height='10' alt='' class='ffimgfix' /></td>
			<td class='mdbg' style='width:100%'>
			<div style='width: 100%; text-align: center;'>
            <img style='margin-top: auto; margin-bottom: auto; margin-left: auto; margin-right: auto;' src='".THEME."images/blank.gif' width='160' height='0' alt='' class='ffimgfix' />
            </div>
            </td>
			<td class='md2'><img src='".THEME."images/blank.gif' width='19' height='10' alt='' class='ffimgfix' /></td>
		</tr>
	</table>
	";
}


//[pollstyle]

$POLLSTYLE = <<< EOF
<b> {QUESTION} </b>
<br /><br />
{OPTIONS=<span class='alttd'>OPTION</span><br />BAR<br /><span class='smalltext'>PERCENTAGE VOTES</span><br /><br />\n}
<div style='text-align:center' class='smalltext'>{VOTE_TOTAL} {COMMENTS}
<br />
</div>
EOF;


//	[chatboxstyle]

$CHATBOXSTYLE = "
<div class='spacer'>
<div class='forumheader3'>
<img src='".THEME."images/bullet2.gif' alt='bullet' />
<b>{USERNAME}</b><br />
<span class='smalltext'>{TIMEDATE}</span><br />
{MESSAGE}
</div>
</div>";


//[commentstyle]

$COMMENTSTYLE = "
	<div style='text-align:center'>
		<table style='width:100%'>
			<tr>
				<td colspan='2' class='alttd'>
					{SUBJECT}
					<b>
						{USERNAME}
					</b>
 					| 
 					{TIMEDATE}
				</td>
			</tr>
			<tr>
				<td style='width:30%; vertical-align:top'>
					<div class='spacer'>
						{AVATAR}
					</div>
					<span class='smalltext'>
						{LEVEL}
						{COMMENTS}
						{JOINED}
						{REPLY}
					</span>
				</td>
				<td style='width:70%; vertical-align:top'>
					{COMMENT}
				</td>
			</tr>
		</table>
	</div>
<br />";
?>

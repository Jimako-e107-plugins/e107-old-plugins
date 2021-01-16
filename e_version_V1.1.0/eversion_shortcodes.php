<?php
include_once(e_HANDLER . 'shortcode_handler.php');
$eversion_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
/*
SC_BEGIN EVRSN_PLUGNAME
global $evrsn_from, $eversion_id, $tp, $eversion_name;
$retval = "<a href='" . e_PLUGIN . "e_version/eversion.php?$evrsn_from.view.$eversion_id'>" . $tp->toHTML($eversion_name) . "</a>";
return $retval;
SC_END

SC_BEGIN EVRSN_PLUGTITLE
global $evrsn_from, $eversion_id, $tp, $eversion_title;
$retval = "<a href='" . e_PLUGIN . "e_version/eversion.php?$evrsn_from.view.$eversion_id'>" . $tp->toHTML($eversion_title) . "</a>";
return $retval;
SC_END

SC_BEGIN EVRSN_VERSION
global $eversion_major, $eversion_minor, $eversion_beta;
$retval = $eversion_major . "." . $eversion_minor . ($eversion_beta > 0?" " . EVERSION_8 . $eversion_beta:"");
return $retval;
SC_END

SC_BEGIN EVRSN_DATE
global $tp, $eversion_date, $evrsn_conv;
$retval = $evrsn_conv->convert_date($eversion_date, $parm);
return $retval;
SC_END

SC_BEGIN EVRSN_ICON
global $tp, $eversion_icon;
if (!empty($eversion_icon))
{
	$retval = "<div style='text-align:center;' ><img src='images/plugicons/".$eversion_icon."' style='border:0;' alt='' title='' /></div>";
}
else
{
	$retval = "<div style='text-align:center;' ><img src='images/plugicons/blank.png' style='border:0;' alt='' title='' /></div>";
}

return $retval;
SC_END

SC_BEGIN EVRSN_AUTHOR
global $tp, $eversion_author;
$retval = $tp->toHTML($eversion_author);
return $retval;
SC_END

SC_BEGIN EVRSN_DLOAD
global $tp, $eversion_dlpath;
if (empty($eversion_dlpath))
{
$retval ="<img src='./images/blank.png' style='border:0;' title='' alt='' />";
}
else
{
$retval = "<a href='" . $eversion_dlpath . "'><img src='./images/download.png' style='border:0;' title='" . EVERSION_15 . "' alt='" . EVERSION_15 . "' /></a>";
}
return $retval;
SC_END

SC_BEGIN EVRSN_NP
global $evrsn_db,$pref,$tp,$evrsn_from,$eversion_id;
$evrsn_count = $evrsn_db->db_Count("eversion", "(*)");
$evrsn_npaction = "list.$eversion_id";
$evrsn_npparms = $evrsn_count . "," . $pref['eversion_noplug'] . "," . $evrsn_from . "," . e_SELF . '?' . "[FROM]." . $evrsn_npaction;
return $tp->parseTemplate("{NEXTPREV={$evrsn_npparms}}");
SC_END

SC_BEGIN EVRSN_RSS
global $PLUGINS_DIRECTORY;
$evrsn_rssdb = new DB;
if ($evrsn_rssdb->db_Select("rss","*","rss_path='e_version'"))
{
$retval .= "<a href='" . e_BASE . $PLUGINS_DIRECTORY . "rss_menu/rss.php?eversion.1'><img src='images/rss1.png' alt='RSS 1' title='RSS 1' style='border:0;' /></a>&nbsp;&nbsp;";
$retval .= "<a href='" . e_BASE . $PLUGINS_DIRECTORY . "rss_menu/rss.php?eversion.2'><img src='images/rss2.png' alt='RSS 2' title='RSS 2' style='border:0;' /></a>&nbsp;&nbsp;";
$retval .= "<a href='" . e_BASE . $PLUGINS_DIRECTORY . "rss_menu/rss.php?eversion.3'><img src='images/rss3.png' alt='RSS RDF' title='RSS RDF' style='border:0;' /></a>&nbsp;&nbsp;";
$retval .= "<a href='" . e_BASE . $PLUGINS_DIRECTORY . "rss_menu/rss.php?eversion.4'><img src='images/rss4.png' alt='RSS ATOM' title='RSS ATOM' style='border:0;' /></a>";
}
else
{
$retval .= "";
}
return $retval;

SC_END

SC_BEGIN EVRSN_PNAME
global $evrsn_row,$tp;

return $tp->toHTML($evrsn_row['eversion_name']);
SC_END

SC_BEGIN EVRSN_TITLE
global $evrsn_row,$tp;

return $tp->toHTML($evrsn_row['eversion_title']);
SC_END

SC_BEGIN EVRSN_VNUMBER
global $evrsn_row,$tp;
$retval = $evrsn_row['eversion_major'] . "." . $evrsn_row['eversion_minor'] . ($evrsn_row['eversion_beta'] > 0?" " . EVERSION_8 . $evrsn_row['eversion_beta']:"");
return $tp->toHTML($retval);
SC_END

SC_BEGIN EVRSN_VDATE
global $evrsn_row,$tp,$evrsn_conv;
$retval = $evrsn_conv->convert_date($evrsn_row['eversion_date'], $parm);
return $tp->toHTML($retval);
SC_END

SC_BEGIN EVRSN_AUTH
global $evrsn_row,$tp,$evrsn_conv;
return $tp->toHTML($evrsn_row['eversion_author']);
SC_END

SC_BEGIN EVRSN_REVISIONS
global $evrsn_row,$tp,$evrsn_conv;
return $tp->toHTML($evrsn_row['eversion_revisions']);
SC_END

SC_BEGIN EVRSN_COMMENTS
global $evrsn_row,$tp,$evrsn_conv;
return $tp->toHTML($evrsn_row['eversion_comments']);
SC_END

SC_BEGIN EVRSN_DLPATH
global $evrsn_row,$tp,$evrsn_conv;
if (empty($evrsn_row['eversion_dlpath']))
{
	return EVERSION_24;
}
else
{
	return "<a href='".$evrsn_row['eversion_dlpath'] . "'>" . EVERSION_15 . "</a>";
}

SC_END

SC_BEGIN EVRSN_SUPPORT
global $evrsn_row,$tp,$evrsn_conv;
if (empty($evrsn_row['eversion_support']))
{
	return EVERSION_25;
}
else
{
	return "<a href='" . $evrsn_row['eversion_support'] . "'>" . EVERSION_20 . "</a>";
}
SC_END

SC_BEGIN EVRSN_BUGS
global $evrsn_row,$tp,$evrsn_conv;
if (empty($evrsn_row['eversion_bugtrack']))
{
	return EVERSION_27;
}
else
{
	return "<a href='" . $evrsn_row['eversion_bugtrack'] . "'>" . EVERSION_29 . "</a>";
}
SC_END

SC_BEGIN BACK_BUTTON

return "<img src='images/back.png' alt='back' title='back' style='border:0;' onclick='history.go(-1)'' />";
SC_END

SC_BEGIN UP_BUTTON
global $evrsn_id;

return "<a href='" . e_SELF . "?$evrsn_from.list.$evrsn_id'><img src='./images/updir.png' alt='up' title='up'  style='border:0;'/></a>";
SC_END
// *
* /
?>
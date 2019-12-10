<?php

if(!defined('e107_INIT'))
{
	exit;
}


class eversion_shortcodes extends e_shortcode
{
	public $override = false; // when set to true, existing core/plugin shortcodes matching methods below will be overridden. 
	
	private $plugPrefs = array();
   
  
	function __construct()
	{ 
    $this->plugPrefs = e107::getPlugConfig('eversion')->getPref();

	}

function sc_evrsn_plugname($parm = null) { 
global $evrsn_from, $eversion_id,   $eversion_name;
$retval = "<a href='" . e_PLUGIN_ABS . "eversion/eversion.php?$evrsn_from.view.$eversion_id'>" . e107::getParser()->toHTML($eversion_name) . "</a>";
return $retval;
}

function sc_evrsn_plugtitle($parm = null)  // Naming:  "sc_" + [plugin-directory] + '_uniquename'
{
	$retval = "<a href='" . e_PLUGIN_ABS . "eversion/eversion.php?$evrsn_from.view.".$this->var['eversion_id']."'>"  .$this->var['eversion_title'].  "</a>";
	return $retval;	
}

function sc_evrsn_version($parm = null) 
{
	$retval = $this->var['eversion_major']. "." . $this->var['eversion_minor'] . ($this->var['eversion_beta'] > 0?" " . EVERSION_8 . $this->var['eversion_beta']:"");
	return $retval;
}

function sc_evrsn_date($parm = null) {
	global $evrsn_conv;
	$retval = $evrsn_conv->convert_date($this->var['eversion_date'], $parm);
	return $retval;
}

function sc_evrsn_icon($parm = null)  // Naming:  "sc_" + [plugin-directory] + '_uniquename'
{
	if (!empty($eversion_icon))
	{
		$retval = "<div style='text-align:center;' ><img src='images/plugicons/".$this->var['eversion_icon']."' style='border:0;' alt='' title='' /></div>";
	}
	else
	{
		$retval = "<div style='text-align:center;' ><img src='images/plugicons/blank.png' style='border:0;' alt='' title='' /></div>";
	}
	return $retval;
}

function sc_evrsn_author($parm = null) {
$retval = e107::getParser()->toHTML($this->var['eversion_author']);
return $retval;
}

function sc_evrsn_dload($parm = null) {
	if (empty($this->var['eversion_dlpath'])) 	{
		$retval ="<img src='./images/blank.png' style='border:0;' title='' alt='' />";
	}
	else {
	  $eversion_dpath = SITEURL . "download.php?view." . $this->var['eversion_dlpath'];  /* todo change e107::url  */	  
		$retval = "<a href='" . $eversion_dpath . "'><img src='./images/download.png' style='border:0;' title='" . EVERSION_15 . "' alt='" . EVERSION_15 . "' /></a>";
	}
	return $retval;
}

function sc_evrsn_np($parm = null) {
global $evrsn_db,$pref,$tp,$evrsn_from,$eversion_id;
$evrsn_count = $evrsn_db->db_Count("eversion", "(*)");
$evrsn_npaction = "list.$eversion_id";
$evrsn_npparms = $evrsn_count . "," . $pref['eversion_noplug'] . "," . $evrsn_from . "," . e_SELF . '?' . "[FROM]." . $evrsn_npaction;
return $tp->parseTemplate("{NEXTPREV={$evrsn_npparms}}");
}

function sc_evrsn_rss($parm = null) {
global $PLUGINS_DIRECTORY;
$evrsn_rssdb = new DB;
if ($evrsn_rssdb->db_Select("rss","*","rss_path='eversion'"))
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

}

function sc_evrsn_pname($parm = null) {
return e107::getParser()->toHTML($this->var['eversion_name']);
}

function sc_evrsn_title($parm = null) {
return e107::getParser()->toHTML($this->var['eversion_title']);
}

function sc_evrsn_vnumber($parm = null) {
$retval = $this->var['eversion_major'] . "." . $this->var['eversion_minor'] . ($this->var['eversion_beta'] > 0?" " . EVERSION_8 . $this->var['eversion_beta']:"");
return e107::getParser()->toHTML($retval);
}

function sc_evrsn_vdate($parm = null) {
global $evrsn_conv;
$retval = $evrsn_conv->convert_date($this->var['eversion_date'], $parm);
return e107::getParser()->toHTML($retval);
}

function sc_evrsn_auth($parm = null) {
return e107::getParser()->toHTML($this->var['eversion_author']);
}

function sc_evrsn_revisions($parm = null) {
return e107::getParser()->toHTML($this->var['eversion_revisions']);
}

function sc_evrsn_comments($parm = null) {
return e107::getParser()->toHTML($this->var['eversion_comments']);
}

function sc_evrsn_dlpath($parm = null) {
 
if (empty($this->var['eversion_dlpath']))
{
	return EVERSION_24;
}
else
{
	$eversion_dpath = SITEURL . "download.php?view." . $this->var['eversion_dlpath'];  /* todo change e107::url  */
	return "<a href='".$eversion_dpath . "'>" . EVERSION_15 . "</a>";
}

}

function sc_evrsn_support($parm = null) {
 
if (empty($this->var['eversion_support']))
{
	return EVERSION_25;
}
else
{
  $eversion_spath = SITEURL . $PLUGINS_DIRECTORY . "forum/forum_viewforum.php?id=" . $this->var['eversion_support'];
	return "<a href='" . $eversion_spath . "'>" . EVERSION_20 . "</a>";
}
}

function sc_evrsn_bugs($parm = null) {
 
if (empty($this->var['eversion_bugtrack']))
{
	return EVERSION_27;
}
else
{
	return "<a href='" . $this->var['eversion_bugtrack'] . "'>" . EVERSION_29 . "</a>";
}
}

function sc_BACK_BUTTON($parm = null) {

return "<img src='images/back.png' alt='back' title='".EVERSION_31."' style='border:0;' onclick='history.go(-1)'' />";
}

function sc_up_button($parm = null) {
global $evrsn_id;

return "<a href='" . e_SELF . "?$evrsn_from.list.$evrsn_id'><img src='./images/updir.png' alt='up' title='".EVERSION_32."'  style='border:0;'/></a>";
}
}
?>
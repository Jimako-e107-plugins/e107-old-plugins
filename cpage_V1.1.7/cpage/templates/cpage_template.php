<?php
/*
+---------------------------------------------------------------+
|        Enhanced Custom Pages for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2009
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

if (!defined('e107_INIT')) {
    exit;
}
if (!defined('USER_WIDTH')) {
    define(USER_WIDTH, "width:100%;");
}
include_lan(e_PLUGIN . "cpage/languages/" . e_LANGUAGE . "_cpage.php");
global $cpage_shortcodes;
// ********************************************************************************************
// *
// * Template area for list of pages
// *
// ********************************************************************************************
if (!isset($CPAGE_TEMPLATE['HEADER'])) {
    $CPAGE_TEMPLATE['HEADER'] = "<h1>Site Map</h1><br />";
}
if (!isset($CPAGE_TEMPLATE['CATEGORY'])) {
	$CPAGE_TEMPLATE['CATEGORY'] = "{CPAGE_LIST_BULLET} <b>{CPAGE_LIST_CATEGORY}</b><br />";
}
$sc_style['CPAGE_LIST_INDENT']['pre'] = '&nbsp;&nbsp;&nbsp;&nbsp;';
$sc_style['CPAGE_LIST_INDENT']['post'] = '';

if (!isset($CPAGE_TEMPLATE['DETAIL'])) {
    $CPAGE_TEMPLATE['DETAIL'] = "{CPAGE_LIST_INDENT}{CPAGE_LIST_BULLET} {CPAGE_LIST_PAGE}<br />";
}
if (!isset($CPAGE_TEMPLATE['NODETAIL'])) {
    $CPAGE_TEMPLATE['NODETAIL'] = "";
}
if (!isset($CPAGE_TEMPLATE['FOOTER'])) {
    $CPAGE_TEMPLATE['FOOTER'] = "";
}
// ********************************************************************************************
// *
// * Template area for show page
// *
// ********************************************************************************************
// * Pre and Post for shortcodes
$sc_style['CPAGE_AUTHOR']['pre'] = CPAGE_11 . ' ';
$sc_style['CPAGE_AUTHOR']['post'] = '';

$sc_style['CPAGE_CREATED']['pre'] = CPAGE_12 . ' ';
$sc_style['CPAGE_CREATED']['post'] = '';

$sc_style['CPAGE_LASTUPDATED']['pre'] = CPAGE_13 . ' ';
$sc_style['CPAGE_LASTUPDATED']['post'] = '';

$sc_style['CPAGE_VIEWS']['pre'] = CPAGE_14 . ' ';
$sc_style['CPAGE_VIEWS']['post'] = '';

$sc_style['CPAGE_UNIQUE']['pre'] = CPAGE_15 . ' ';
$sc_style['CPAGE_UNIQUE']['post'] = '';

$sc_style['CPAGE_AUTHOR']['pre'] = CPAGE_11 . ' ';
$sc_style['CPAGE_AUTHOR']['post'] = '';

$sc_style['CPAGE_EMAIL']['pre'] = ' ';
$sc_style['CPAGE_EMAIL']['post'] = '';
$sc_style['CPAGE_PRINT']['pre'] = ' ';
$sc_style['CPAGE_PRINT']['post'] = '';
$sc_style['CPAGE_PDF']['pre'] = ' ';
$sc_style['CPAGE_PDF']['post'] = '';

if (!isset($CPAGE_TEMPLATE['PAGE_HEADER'])) {
    $CPAGE_TEMPLATE['PAGE_HEADER'] = "
{CPAGE_EMAIL}{CPAGE_PRINT}{CPAGE_PDF}<br /><br />
<h1><div id='cpage_ptitle'>{CPAGE_TITLE}</div></h1><br />
";
}

if (!isset($CPAGE_TEMPLATE['PAGE_BODY'])) {
    $CPAGE_TEMPLATE['PAGE_BODY'] = "
<div id='cpage_body' style='width:100%'>
	<div id='cpage_body_c' style='width:100%'>{CPAGE_BODY}<br /></div>
</div><br />
";
}
if (!isset($CPAGE_TEMPLATE['PAGE_FOOTER'])) {
    $CPAGE_TEMPLATE['PAGE_FOOTER'] = "
<span style='text-align:center;'>{CPAGE_PAGES}</span>
<hr />{CPAGE_AUTHOR=linkon}<br />
{CPAGE_CREATED=short} {CPAGE_LASTUPDATED=short}<br />
{CPAGE_VIEWS} {CPAGE_UNIQUE}<br />
{CPAGE_RATE}<br />
{CPAGE_SHOWCOMMENTS}
<div id='cpage_comments' style='display:inline;'>
	{CPAGE_COMMENT}<br />
	{CPAGE_COMMENT_FORM}
</div>
";
}

if (!isset($CPAGE_TEMPLATE['NOPAGE'])) {
    $CPAGE_TEMPLATE['NOPAGE'] = CPAGE_04;
}
if (!isset($CPAGE_TEMPLATE['PASSWORD'])) {
    $CPAGE_TEMPLATE['PASSWORD'] = CPAGE_16 . " <br />" . CPAGE_17 . "<br />{CPAGE_PASSWORD}<br />{CPAGE_SUBMIT}";
}
if (!isset($CPAGE_TEMPLATE['NOTIP'])) {
    $CPAGE_TEMPLATE['NOTIP'] = CPAGE_CP67 ;
}
if (!isset($CPAGE_TEMPLATE['PAGE_EXPIRED'])) {
	$CPAGE_TEMPLATE['PAGE_EXPIRED'] = CPAGE_CP110 ;
}
if (!isset($CPAGE_TEMPLATE['PAGE_PRINT'])) {
    $CPAGE_TEMPLATE['PAGE_PRINT'] = "
{CPAGE_TITLE} <br />{CPAGE_BODY}<br /><br />
<hr />{CPAGE_AUTHOR=linkoff}<br />
{CPAGE_CREATED=short} {CPAGE_LASTUPDATED=short}<br />
{CPAGE_VIEWS} {CPAGE_UNIQUE}<br />
{CPAGE_RATE}<br />
{CPAGE_COMMENT}<br />
{CPAGE_COMMENT_FORM}
";
}
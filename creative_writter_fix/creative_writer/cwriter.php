<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2018 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 */

if (!defined('e107_INIT'))
{
	require_once("../../class2.php");
}


if (!e107::isInstalled('creative_writer'))
{
	e107::redirect();
}

e107::lan('creative_writer');
 
// define the over ride meta tags
// define("PAGE_NAME", ECLASSF_1);
// check if we use the wysiwyg for text areas

$pref = e107::pref('creative_writer');

 
$e_wysiwyg = "cwriter_cdetails";
if ($pref['wysiwyg'])
{
    $WYSIWYG = true;
}
require_once(e_HANDLER . "userclass_class.php");
require_once(e_HANDLER . "ren_help.php");
 
$creative_writer = e107::getSingleton('creative_writer',e_PLUGIN.'creative_writer/includes/creative_writer.class.php');

 

require_once(HEADERF);
$cwriter_from = 0;
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $cwriter_from = intval($_POST['cwriter_from']);
    $action = $_POST['action'];
    $cwriter_bookid = intval($_POST['cwriter_bookid']);
    $cwriter_chapterid = intval($_POST['cwriter_chapterid']);
} elseif (e_QUERY)
{
    $cwriter_temp = explode(".", e_QUERY);
    $cwriter_from = intval($cwriter_temp[0]);
    $action = $cwriter_temp[1];
    $cwriter_bookid = intval($cwriter_temp[2]);
    $cwriter_chapterid = intval($cwriter_temp[3]);
}
 
if (empty($action))
{
    $action = "show";
}
  

if (!empty($_POST['subrev']) && USER)
{
    if (!$sql->db_Select("cw_review", "cw_review_id", "where cw_review_book=$cwriter_bookid and substring_index(cw_reviewer," . ",1) = " . USERID, "nowhere", false))
    {
        $sql->db_Insert("cw_review", "
	0,
	$cwriter_bookid,
	'" . USERID . "." . USERNAME . "',
	'" . $tp->toDB($_POST['cwreview']) . "',
	0,
	" . time(), false);
    }
    $action = "review";
}
 
if ($action == "review")
{
 $creative_writer->render('review');
}
elseif ($action == "show")
{
	$creative_writer->render('show');	
}
else $ns->tablerender(CWRITER_01, $cwriter_text);


require_once(FOOTERF);

?>
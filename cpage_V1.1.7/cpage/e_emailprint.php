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

require_once(e_PLUGIN . 'cpage/includes/cpage_shortcodes.php');
require_once(e_PLUGIN . 'cpage/templates/cpage_template.php');
require_once(e_HANDLER . 'date_handler.php');
        require_once(e_PLUGIN."cpage/includes/cpage_pageclass.php");
include_lan(e_PLUGIN . "cpage/languages/" . e_LANGUAGE . "_cpage.php");

function print_item($id)
{
    global $cpage_show_obj,$cpage_obj;
	if (!is_object($cpage_obj)) {
		require_once(e_PLUGIN."cpage/includes/cpage_class.php");
		$cpage_obj = new cpage;
	}
    if (!is_object($cpage_show_obj)) {

        $cpage_show_obj = new cpage_show;
    }
    $text = $cpage_show_obj->print_page($id);
    return $text;
}

function email_item($id)
{
    global $tp, $sql, $PLUGINS_DIRECTORY,$cpage_obj;
	if (!is_object($cpage_obj)) {
		require_once(e_PLUGIN."cpage/includes/cpage_class.php");
		$cpage_obj = new cpage;
	}
    $cpage_arg = "select * from #cpage_page
        left join #user on substring_index(cpage_author,'.',1) = user_id where cpage_id={$id} and find_in_set(cpage_class,'" . USERCLASS_LIST . "') ";

    $sql->db_Select_gen($cpage_arg);
    $row = $sql->db_Fetch();
$url=SITEURL.$cpage_obj->make_url($row['cpage_link'],$row['cpage_id'],0,$row['cpage_title']);
    $message = CPAGE_MAIL01 . "<br /><a href='" . $url . "'>" .$url . "</a><br /><br />\n\n";
    $message .= "<strong>" . CPAGE_MAIL02 . "</strong><br /> " . $row['cpage_title'] ;
    return $message;
}
function print_item_pdf($id)
{
    // // always return an array with the following data:
    global $cpage_show_obj,$cpage_obj;
	if (!is_object($cpage_obj)) {
		require_once(e_PLUGIN."cpage/includes/cpage_class.php");
		$cpage_obj = new cpage;
	}
    if (!is_object($cpage_show_obj)) {

        $cpage_show_obj = new cpage_show;
    }
    $text = $cpage_show_obj->print_page($id);
    return array($text, $creator, $author, $title, $subject, $keywords, $url);
}

?>
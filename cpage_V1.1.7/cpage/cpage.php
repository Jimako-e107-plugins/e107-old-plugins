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
require_once("class2.php");
#error_reporting(E_ALL);

include_lan(e_PLUGIN . "cpage/languages/" . e_LANGUAGE . "_cpage.php");
// to do - add caching
require_once(e_HANDLER . 'date_handler.php');
require_once(e_HANDLER . "userclass_class.php");
$cpage_conv = new convert;
require_once(e_PLUGIN . 'cpage/includes/cpage_shortcodes.php');

if (file_exists(THEME . 'cpage_template.php')) {
    require_once(THEME . 'cpage_template.php');
}else {
    require_once(e_PLUGIN . 'cpage/templates/cpage_template.php');
}
if (!is_object($cpage_obj)) {
    require_once(e_PLUGIN . "cpage/includes/cpage_class.php");
    $cpage_obj = new cpage;
}
// create the page object
if (!is_object($cpage_show_obj)) {
    require_once(e_PLUGIN . "cpage/includes/cpage_pageclass.php");
    $cpage_show_obj = new cpage_show;
}

$cpage_show_obj->cpage_rater = new cpage_rater;
require_once(e_HANDLER . "comment_class.php");
$cobj = new comment;
$footer_js[] = SITEURL . $PLUGINS_DIRECTORY . 'cpage/includes/cpage.js';

if (e_QUERY) {
    // we are doing a page
    $tmp = explode('.', e_QUERY);
    $cpage_show_obj->cpage_pageid = intval($tmp[0]);
    $cpage_show_obj->currentpage = intval($tmp[1]);
    $action = $tmp[2];
    // print "$action $cpage_show_obj->currentpage";
    if ($action == 'ajax') {
        $cpage_ajax['content'] = $cpage_show_obj->show_page($cpage_show_obj->cpage_pageid, true);
        $cpage_ajax['maxpages'] = $cpage_show_obj->pagecount;
        $cpage_ajax['nowon'] = $cpage_show_obj->currentpage;
        $cpage_ajax['browser_title'] = $cpage_show_obj->browser_title;
        $cpage_ajax['page_id'] = $cpage_show_obj->cpage_pageid;
        echo json_encode($cpage_ajax);
        exit();
    }
    if (isset($_POST['commentsubmit'])) {
        // comment submitted
        $cobj->enter_comment($_POST['author_name'], $_POST['comment'], "cpage", $cpage_show_obj->cpage_pageid, $pid, $_POST['subject']);
        $cpage_obj->clear_cache();
    }

    $cpage_text = $cpage_show_obj->show_page($cpage_show_obj->cpage_pageid);
} elseif (isset($_POST['cpage_submit'])) {
    // doing a passworded page
    $cpage_show_obj->cpage_pageid = intval($_POST['cpage_pageid']);
    // print $cpage_show_obj->cpage_pageid;
    $cpage_show_obj->currentpage = 0;
    $cpage_text = $cpage_show_obj->show_page($cpage_show_obj->cpage_pageid);
} else {
    // we are listing pages
    if ($CPAGE_PREF['cpage_list'] >0) {
        // ok to list
        $cpage_text = $cpage_show_obj->list_pages();
    } else {
        $cpage_text = CPAGE_03;
    }
}

require(HEADERF);
$ns->tablerender($cpage_show_obj->browser_title, $cpage_text, 'cpage_list');
require(FOOTERF);
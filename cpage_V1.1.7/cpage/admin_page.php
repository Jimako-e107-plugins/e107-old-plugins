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
require_once("../../class2.php");
error_reporting(E_ALL);
if (!getperms("P")) {
    header("location:" . e_HTTP . "index.php");
    exit;
}

$e_sub_cat = 'custom';
$e_wysiwyg = "data";
require_once(e_HANDLER . "ren_help.php");
require_once(e_HANDLER . "date_handler.php");
require_once(e_HANDLER . "userclass_class.php");
$cpage_conv = new convert;
require_once(e_HANDLER . "calendar/calendar_class.php");
$cpage_cal = new DHTML_Calendar(true);

function headerjs()
{
    // load the js for the calendar control
    // can't use $eplug_js as that's not supported in e107 admin header
    global $cpage_cal;
    $js = $cpage_cal->load_files();
    return $js;
}

require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH")) {
    define(ADMIN_WIDTH, "width:100%");
}

if (!is_object($cpage_obj)) {
    require_once("includes/cpage_class.php");
    $cpage_obj = new cpage;
}
// class is only used in this script so it is in this script
$cpage_pageobj = new cpage_page;

if (isset($_SESSION['cpage_from'])) {
    $cpage_pageobj->cpage_from = $_SESSION['cpage_from'];
}
if (isset($_SESSION['cpage_currentcategory'])) {
    $cpage_pageobj->cpage_currentcategory = $_SESSION['cpage_currentcategory'];
}
if (isset($_SESSION['cpage_search'])) {
    $cpage_pageobj->cpage_search = $_SESSION['cpage_search'];
}
// work out any parameters passed to the script
// if search has changed or category changed then reset from
if (e_QUERY) {
    // print "equery";
    $tmp = explode('.', e_QUERY);
    $cpage_pageobj->cpage_action = $tmp[0];

    if ($tmp[0] == 'list') {
        $cpage_pageobj->cpage_from = intval($tmp[1]);
        $_SESSION['cpage_from'] = intval($tmp[1]);
        $cpage_pageobj->cpage_currentcategory = intval($tmp[2]);
        $_SESSION['cpage_currentcategory'] = intval($tmp[2]);
    } else {
        $cpage_pageobj->cpage_record['cpage_id'] = intval($tmp[1]);
        $cpage_pageobj->cpage_currentpage = intval($tmp[1]);
    }
} elseif (isset($_POST)) {
    // print "post";
    $cpage_pageobj->cpage_currentpage = intval($_POST['pageid']);
    $cpage_pageobj->cpage_from = $_SESSION['cpage_from'];
    if ($cpage_pageobj->cpage_search != $tp->toDB($_POST['cpage_search'])) {
        // search changed
        $cpage_pageobj->cpage_from = 0;
    }
    $cpage_pageobj->cpage_search = $tp->toDB($_POST['cpage_search']);
    if ($cpage_pageobj->cpage_currentcategory != $tp->toDB($_POST['cpage_currentcategory'])) {
        // category changed
        $cpage_pageobj->cpage_from = 0;
    }
    $cpage_pageobj->cpage_currentcategory = $tp->toDB($_POST['cpage_currentcategory']);
    $_SESSION['cpage_currentcategory'] = $cpage_pageobj->cpage_currentcategory;
    $_SESSION['cpage_search'] = $cpage_pageobj->cpage_search ;
} else {
    $_SESSION['cpage_search'] == '';
    $_SESSION['cpage_currentcategory'] = 0;
    $_SESSION['cpage_from'] = 0;
    $cpage_pageobj->cpage_from = 0;
    $cpage_pageobj->cpage_search = '';
    $cpage_pageobj->cpage_currentcategory = 0;
}

/**
* Action - Delete - deletes the selected page
*/
if ($cpage_pageobj->cpage_action == 'delete') {
    // delete the selected page
    // should really confirm it first - to do currently only done in javascript
    if ($cpage_pageobj->delete_page($cpage_pageobj->cpage_currentpage)) {
    	$cpage_pageobj->cpage_msg_type='success';
        $cpage_pageobj->cpage_message .= CPAGE_CP44;
    } else {
    	$cpage_pageobj->cpage_msg_type='error';
        $cpage_pageobj->cpage_message .= CPAGE_CP45;
    }
    // having deleted it now list the remaining pages
    $cpage_pageobj->cpage_action = 'list';
}
/**
* Action - Remove - deletes the revisions for the selected page
*/
if ($cpage_pageobj->cpage_action == 'removerev') {
    // remove all revisions belonging to this page
    // should really confirm it first - to do currently only done in javascript
    if ($cpage_pageobj->remove_onerevision($cpage_pageobj->cpage_currentpage)) {
    	    	$cpage_pageobj->cpage_msg_type='success';
        $cpage_pageobj->cpage_message .= CPAGE_CP93;
    } else {
    	    	$cpage_pageobj->cpage_msg_type='error';
        $cpage_pageobj->cpage_message .= CPAGE_CP94;
    }
    // now list existing pages
    $cpage_pageobj->cpage_action = 'list';
}

/**
* Action - Remove - deletes the revisions for the selected page
*/
if ($cpage_pageobj->cpage_action == 'remove') {
    // remove all revisions belonging to this page
    // should really confirm it first - to do currently only done in javascript
    if ($cpage_pageobj->remove_revisions($cpage_pageobj->cpage_currentpage)) {
    	    	$cpage_pageobj->cpage_msg_type='success';
        $cpage_pageobj->cpage_message .= CPAGE_CP95;
    } else {
    	    	$cpage_pageobj->cpage_msg_type='error';
        $cpage_pageobj->cpage_message .= CPAGE_CP96;
    }
    // now list existing pages
    $cpage_pageobj->cpage_action = 'list';
}
/**
* Action - revert - deletes the revisions for the selected page
*/
if ($cpage_pageobj->cpage_action == 'revert') {
    // remove all revisions belonging to this page
    // should really confirm it first - to do currently only done in javascript
    // $cpage_pageobj->cpage_currentpage in this case is actually the id of the revision not the page
    if ($cpage_pageobj->revert_revision($cpage_pageobj->cpage_currentpage)) {
    	    	$cpage_pageobj->cpage_msg_type='success';
        $cpage_pageobj->cpage_message .= CPAGE_CP97;
    } else {
    	    	$cpage_pageobj->cpage_msg_type='error';
        $cpage_pageobj->cpage_message .= CPAGE_CP98;
    }
    // now list existing pages
    $cpage_pageobj->cpage_action = 'list';
}
if (isset($_POST['submitPage']) || isset($_POST['uploadfiles'])) {
    // either the submit button or upload files button has been clicked
    // process the form submittion
    // $cpage_pageobj->process_form();
    if (isset($_FILES)) {
        // If there are any files to upload then process them
        // and then reedit the page if it was an upload files
        $cpage_pageobj->upload_files();
    }
    if (isset($_POST['uploadfiles'])) {
        // we clicked on uploaded files so reedit
        $cpage_pageobj->cpage_action = 'reedit';
    } else {
        // we clicked on save the record
        $cpage_pageobj->cpage_action = 'save';
    }
}
/**
* Action - Copy - Copy the selected page to a new page
*/
if ($cpage_pageobj->cpage_action == 'copy') {
    if ($cpage_pageobj->copy_page($cpage_pageobj->cpage_currentpage)) {
    	    	$cpage_pageobj->cpage_msg_type='success';
        $cpage_pageobj->cpage_message .= CPAGE_CP75;
    } else {
    	    	$cpage_pageobj->cpage_msg_type='error';
        $cpage_pageobj->cpage_message .= CPAGE_CP76;
    }
    // now list existing pages
    $cpage_pageobj->cpage_action = 'list';
}
/**
* Action - save - insert or update the page
*/
if ($cpage_pageobj->cpage_action == 'save') {
    // process the form for saving/inserting toDB type stuff and data validation
    $cpage_processok = $cpage_pageobj->process_form();
    if (!$cpage_processok) {
        $cpage_pageobj->cpage_action = 'reedit';
    		$cpage_pageobj->cpage_msg_type='validation';
        $cpage_pageobj->cpage_message .= CPAGE_CP40;
    } else {
        // update/create  the page
        if ($cpage_pageobj->cpage_currentpage == 0) {
            // we are creating a new page
            if ($insertid = $cpage_pageobj->insert_record()) {
                $cpage_pageobj->update_sitelink($insertid, $cpage_pageobj->cpage_record['cpage_link'], $cpage_pageobj->cpage_record['cpage_class']);
                	$cpage_pageobj->cpage_msg_type='success';
				$cpage_pageobj->cpage_message .= CPAGE_CP32;
            } else {
            		$cpage_pageobj->cpage_msg_type='error';
                $cpage_pageobj->cpage_message .= CPAGE_CP33;
            }
        } else {
            // save the page
            // insert a copy with this as the parent
            if ($cpage_pageobj->make_revision($cpage_pageobj->cpage_currentpage)) {
                if ($cpage_pageobj->save_record($cpage_pageobj->cpage_currentpage)) {
                    $cpage_pageobj->update_sitelink($cpage_pageobj->cpage_record['cpage_id'], $cpage_pageobj->cpage_record['cpage_link'], $cpage_pageobj->cpage_record['cpage_class']);
                    $cpage_pageobj->cpage_message .= CPAGE_CP34;
                		$cpage_pageobj->cpage_msg_type='success';
                } else {
                		$cpage_pageobj->cpage_msg_type='error';
                    $cpage_pageobj->cpage_message .= CPAGE_CP35;
                }
            } else {
            		$cpage_pageobj->cpage_msg_type='error';
                $cpage_pageobj->cpage_message .= CPAGE_CP87;
            }
        }
        // now list existing pages
        $cpage_pageobj->cpage_action = 'list';
    }
}
/**
* Action - edit reedit or add - Edit/create custom page
*/
if ($cpage_pageobj->cpage_action == 'edit' || $cpage_pageobj->cpage_action == 'reedit' || $cpage_pageobj->cpage_action == 'add') {
    if ($cpage_pageobj->cpage_action == 'reedit') {
        $cpage_pageobj->cpage_currentpage = intval($_POST['pageid']);
    }
    $text = $cpage_pageobj->createPage($cpage_pageobj->cpage_currentpage);
}
/**
* Action - list - list all the custom pages
*/

if ($cpage_pageobj->cpage_action == 'list' || empty($cpage_pageobj->cpage_action)) {
    $text = $cpage_pageobj->showExistingPages();
}
$ns->tablerender(CPAGE_CP01, $text);
require_once(e_ADMIN . "footer.php");
// * End of main program
/**
*/
/**
* cpage_page
*
* @package
* @author kealb
* @copyright Copyright (c) 2009
* @version $Id$
* @access public
* @version 1.1
* @since 1.1
*/
class cpage_page {
    var $cpage_action = 'list'; // current action
    var $cpage_record = array(); // the current record's contents
    var $cpage_currentpage = 0; // the current page record id
    var $cpage_currentcategory = 0; // the current category
    var $cpage_from = 0; // start from page 0
    var $cpage_search = ''; // blank search
	public $cpage_msg_type;
	public $cpage_message;// any status message
    /**
    * Constructor
    */
    function __construct()
    {
        $this->cpage_action = 'list'; // default to list pages
    }
    /**
    * cpage_page::createPage()
    *
    * @param integer $pageid ID of the custom page
    * @param string $action action to take - can be add (default), edit or reedit
    * @return string html form for editing the record
    * @author Father Barry <http://www.keal.me.uk>
    * @copyright Copyright (c) 2009, Barry Keal
    * @since 1.1
    * @version 1.1
    */
    function createPage($pageid = 0, $action = 'add')
    {
        global $sql, $tp, $CPAGE_PREF, $cpage_msg, $cpage_cal, $PLUGINS_DIRECTORY;
        if ($this->cpage_action == "edit") {
            // we are editing this page so retrieve the record
            $query = "SELECT p.*,l.link_name FROM #cpage_page AS p
			LEFT JOIN #links AS l ON l.link_url='$cpage_urltitle'
			 WHERE p.cpage_id ='$pageid' LIMIT 1";

            if ($sql->db_Select_gen($query, false)) {
                $row = $sql->db_Fetch();
                $cpage_title = $tp->toFORM($row['cpage_title']);
                $data = $tp->toFORM($row['cpage_text']);
                $cpage_showdate_flag = $row['cpage_showdate_flag'];
                $cpage_lastdate_flag = $row['cpage_lastdate_flag'];
                $cpage_showauthor_flag = $row['cpage_showauthor_flag'];
                $cpage_rating_flag = $row['cpage_rating_flag'];
                $cpage_comment_flag = $row['cpage_comment_flag'];
                $cpage_page_flag = $row['cpage_page_flag'];
                $cpage_menu_flag = $row['cpage_menu_flag'];
                $cpage_email_flag = $row['cpage_email_flag'];
                $cpage_print_flag = $row['cpage_print_flag'];
                $cpage_pdf_flag = $row['cpage_pdf_flag'];
                $cpage_views_flag = $row['cpage_views_flag'];
                $cpage_unique_flag = $row['cpage_unique_flag'];
                $cpage_password = $tp->toFORM($row['cpage_password']);
                $cpage_class = $row['cpage_class'];
                $cpage_ip_restrict = $row['cpage_ip_restrict'];
                $cpage_meta_description = $tp->toFORM($row['cpage_meta_description']);
                $cpage_meta_keywords = $tp->toFORM($row['cpage_meta_keywords']);
                $cpage_meta_title = $tp->toFORM($row['cpage_meta_title']);
                $cpage_views = $row['cpage_views'];
                $cpage_unique = $row['cpage_unique'];
                $cpage_lastupdate = $row['cpage_lastupdate'];
                $cpage_link = $row['cpage_link'];
                $cpage_canonical = $row['cpage_canonical'];
                $cpage_revision = $row['cpage_revision'];
                $cpage_showfrom = $row['cpage_showfrom'];
                $cpage_showto = $row['cpage_showto'];
                $cpage_category = $row['cpage_category'];
            }
        } elseif ($this->cpage_action == "reedit") {
            // we are re-editing this page - maybe after an image upload
            $cpage_title = $_POST['cpage_title'];
            $data = $_POST['data'];
            $cpage_showdate_flag = $_POST['cpage_showdate_flag '];
            $cpage_lastdate_flag = $_POST['cpage_lastdate_flag '];
            $cpage_showauthor_flag = $_POST['cpage_showauthor_flag'];
            $cpage_rating_flag = $_POST['cpage_rating_flag'];
            $cpage_comment_flag = $_POST['cpage_comment_flag'];
            $cpage_page_flag = $_POST['cpage_page_flag'];
            $cpage_menu_flag = $_POST['cpage_menu_flag'];
            $cpage_email_flag = $_POST['cpage_email_flag'];
            $cpage_print_flag = $_POST['cpage_print_flag'];
            $cpage_pdf_flag = $_POST['cpage_pdf_flag'];
            $cpage_views_flag == $_POST['cpage_views_flag'];
            $cpage_unique_flag == $_POST['cpage_unique_flag'];
            $cpage_password = $_POST['cpage_password'];
            $cpage_class = $_POST['cpage_class'];
            $cpage_ip_restrict = $_POST['cpage_ip_restrict'];
            $cpage_meta_description = $_POST['cpage_meta_description'];
            $cpage_meta_keywords = $_POST['cpage_meta_keywords'];
            $cpage_meta_title = $_POST['cpage_meta_title'];
            $cpage_lastupdate = $_POST['cpage_lastupdate'];
            $cpage_link = $_POST['cpage_link'];
            $cpage_canonical = $_POST['cpage_canonical'];
            $cpage_revision = $_POST['cpage_revision'];
            $cpage_showfrom = $_POST['cpage_showfrom'];
            $cpage_showto = $_POST['cpage_showto'];
            $cpage_category = $_POST['cpage_category'];
        } else {
            // this is a new page so set according to defaults
            $cpage_rating_flag = $CPAGE_PREF['cpage_rating_flag'];
            $cpage_comment_flag = $CPAGE_PREF['cpage_comment_flag'];
            $cpage_showdate_flag = $CPAGE_PREF['cpage_showdate_flag'];
            $cpage_lastdate_flag = $CPAGE_PREF['cpage_lastdate_flag'];
            $cpage_showauthor_flag = $CPAGE_PREF['cpage_showauthor_flag'];
            $cpage_page_flag = $CPAGE_PREF['cpage_page_flag'] ;
            $cpage_menu_flag = $CPAGE_PREF['cpage_menu_flag'] ;
            $cpage_email_flag = $CPAGE_PREF['cpage_email_flag'] ;
            $cpage_print_flag = $CPAGE_PREF['cpage_print_flag'] ;
            $cpage_pdf_flag = $CPAGE_PREF['cpage_pdf_flag'] ;
            $cpage_views_flag = $CPAGE_PREF['cpage_views_flag'] ;
            $cpage_unique_flag = $CPAGE_PREF['cpage_unique_flag'] ;
            $cpage_class = $CPAGE_PREF['cpage_class'] ;
            $cpage_category = $CPAGE_PREF['cpage_category'] ;
            $cpage_ip_restrict = $tp->toFORM($CPAGE_PREF['cpage_ip_restrict']);
            $cpage_lastupdate = time();
        }
        // set the calendar options
        $cpage_options['firstDay'] = 1;
        $cpage_options['showsTime'] = true;
        $cpage_options['showOthers'] = false;
        $cpage_options['weekNumbers'] = false;
        $cpage_df = "%Y-%m-%d %H:%M"; ;
        $cpage_options['ifFormat'] = $cpage_df;
        $cpage_attrib['class'] = "tbox";

        $cpage_attrib['name'] = "cpage_lastupdate";
        $cpage_attrib['value'] = ($cpage_lastupdate > 0?date("Y-m-d H:i", $cpage_lastupdate):"");
        $cpage_updateto = $cpage_cal->make_input_field($cpage_options, $cpage_attrib);

        $cpage_attrib['name'] = "cpage_showfrom";
        $cpage_attrib['value'] = ($cpage_showfrom > 0?date("Y-m-d H:i", $cpage_showfrom):"");
        $cpage_showfrom = $cpage_cal->make_input_field($cpage_options, $cpage_attrib);

        $cpage_attrib['name'] = "cpage_showto";
        $cpage_attrib['value'] = ($cpage_showto > 0?date("Y-m-d H:i", $cpage_showto):"");
        $cpage_showto = $cpage_cal->make_input_field($cpage_options, $cpage_attrib);

        $text = "
<div style='text-align:center'>
	<form method='post' action='" . e_SELF . "' id='dataform' enctype='multipart/form-data'>
		<div>
			<input type='hidden' name='pageid' value='$pageid' />
			<input type='hidden' name='__referer' value='" . POST_REFERER . "' />
		</div>
		<table style='" . ADMIN_WIDTH . "' class='fborder'>
			<tr>
				<td colspan='2' style='text-align:left' class='fcaption'>" . CPAGE_CP27 . "</td>
			</tr>
			<tr>
				<td colspan='2' style='text-align:left' class='forumheader2'><a href='" . e_SELF . "?list'><img src='images/updir.png' style='border:0px' alt='" . CPAGE_CP37 . "' title='" . CPAGE_CP37 . "' /></a> <b>" . $this->cpage_message . "</b></td>
			</tr>
			<tr>
				<td style='width:25%' class='forumheader3'>" . CPAGE_CP09 . "</td>
				<td style='width:75%' class='forumheader3'>
					<input class='tbox' type='text' name='cpage_title' size='50' value='" . $cpage_title . "' maxlength='250' />
				</td>
			</tr>
			<tr>
				<td style='width:25%' class='forumheader3'>" . CPAGE_CP112 . "</td>
				<td style='width:75%' class='forumheader3'>
					<select name='cpage_category' class='tbox' >
						<option value='0' " . ($cpage_category == 0?"selected='selected'":"") . " >" . CPAGE_C14 . "</option>";
        $sql->db_Select('cpage_category', '*', 'order by cpage_cat_name', 'nowhere', false);
        while ($row = $sql->db_Fetch()) {
            $text .= "<option value='" . $row['cpage_cat_id'] . "' " . ($cpage_category == $row['cpage_cat_id']?"selected='selected'":"") . " >" . $tp->toFORM($row['cpage_cat_name']) . "</option>";
        }
        $text .= "
    				</select>
    			</td>
    		</tr>
			<tr>
				<td style='width:25%' class='forumheader3'>" . CPAGE_CP10 . "</td>
				<td style='width:75%' class='forumheader3'>";

        $insertjs = (!e_WYSIWYG)?"rows='19' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);' style='width:95%'": "rows='25' style='width:100%' ";
        $data = $tp->toForm($data, false, true); // Make sure we convert HTML tags to entities
        $text .= "<textarea class='tbox' id='data' name='data' cols='80'   $insertjs>" . (strstr($data, "[img]http") ? $data : str_replace("[img]../", "[img]", $data)) . "</textarea>";
        $text .= "<br />" . display_help('', "cpage") . "
				</td>
			</tr>
			<tr>
				<td style='width:25%' class='forumheader3'>" . CPAGE_CP11 . "</td>
				<td style='width:75%;' class='forumheader3'><a style='cursor:pointer' onclick='expandit(this);'>" . CPAGE_CP48 . "</a>
					<div style='display:none;'>" . $this->cpage_upload() . "</div>
				</td>
			</tr>
			<tr>
				<td style='width:25%' class='forumheader3'>" . CPAGE_CP49 . "</td>
				<td style='width:75%;' class='forumheader3'>
					<a style='cursor:pointer' onclick='expandit(this);'>" . CPAGE_CP50 . "</a>
					<div style='display:none;'>
						<br />
						<input type='radio' name='cpage_rating_flag' id='cpage_rating_flag_on' value='1'" . ($cpage_rating_flag ? " checked='checked'" : "") . " /><label for='cpage_rating_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
						<input type='radio' name='cpage_rating_flag' id='cpage_rating_flag_off' value='0'" . ($cpage_rating_flag ? "" : " checked='checked'") . " /><label for='cpage_rating_flag_off'> " . CPAGE_CP14 . "</label>
						&nbsp;&nbsp;" . CPAGE_CP12 . "<br />
						<input type='radio' name='cpage_comment_flag' id='cpage_comment_flag_on' value='1'" . ($cpage_comment_flag ? " checked='checked'" : "") . " /><label for='cpage_comment_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
						<input type='radio' name='cpage_comment_flag' id='cpage_comment_flag_off' value='0'" . ($cpage_comment_flag ? "" : " checked='checked'") . " /><label for='cpage_comment_flag_off'> " . CPAGE_CP14 . "</label>
						&nbsp;&nbsp;" . CPAGE_CP15 . "<br />
						<input type='radio' name='cpage_showdate_flag' id='cpage_showdate_flag_on' value='1'" . ($cpage_showdate_flag ? " checked='checked'" : "") . " /><label for='cpage_showdate_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
						<input type='radio' name='cpage_showdate_flag' id='cpage_showdate_flag_off' value='0'" . ($cpage_showdate_flag ? "" : " checked='checked'") . " /><label for='cpage_showdate_flag_off'> " . CPAGE_CP14 . "</label>
						&nbsp;&nbsp;" . CPAGE_CP16 . "<br />
						<input type='radio' name='cpage_lastdate_flag' id='cpage_lastdate_flag_on' value='1'" . ($cpage_lastdate_flag ? " checked='checked'" : "") . " /><label for='cpage_lastdate_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
						<input type='radio' name='cpage_lastdate_flag' id='cpage_lastdate_flag_off' value='0'" . ($cpage_lastdate_flag ? "" : " checked='checked'") . " /><label for='cpage_lastdate_flag_off'> " . CPAGE_CP14 . "</label>
						&nbsp;&nbsp;" . CPAGE_CP42 . "<br />
						<input type='radio' name='cpage_showauthor_flag' id='cpage_showauthor_flag_on' value='1'" . ($cpage_showauthor_flag ? " checked='checked'" : "") . " /><label for='cpage_showauthor_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
						<input type='radio' name='cpage_showauthor_flag' id='cpage_showauthor_flag_off' value='0'" . ($cpage_showauthor_flag ? "" : " checked='checked'") . " /><label for='cpage_showauthor_flag_off'> " . CPAGE_CP14 . "</label>
						&nbsp;&nbsp;" . CPAGE_CP41 . "<br />

						<input type='radio' name='cpage_page_flag' id='cpage_page_flag_on' value='1'" . ($cpage_page_flag ? " checked='checked'" : "") . " /><label for='cpage_page_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
						<input type='radio' name='cpage_page_flag' id='cpage_page_flag_off' value='0'" . ($cpage_page_flag ? "" : " checked='checked'") . " /><label for='cpage_page_flag_off'> " . CPAGE_CP14 . "</label>
						&nbsp;&nbsp;" . CPAGE_CP59 . "<br />
						<input type='radio' name='cpage_menu_flag' id='cpage_menu_flag_on' value='1'" . ($cpage_menu_flag ? " checked='checked'" : "") . " /><label for='cpage_menu_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
						<input type='radio' name='cpage_menu_flag' id='cpage_menu_flag_off' value='0'" . ($cpage_menu_flag ? "" : " checked='checked'") . " /><label for='cpage_menu_flag_off'> " . CPAGE_CP14 . "</label>
						&nbsp;&nbsp;" . CPAGE_CP60 . "<br />

						<input type='radio' name='cpage_email_flag' id='cpage_email_flag_on' value='1'" . ($cpage_email_flag ? " checked='checked'" : "") . " /><label for='cpage_email_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
						<input type='radio' name='cpage_email_flag' id='cpage_email_flag_off' value='0'" . ($cpage_email_flag ? "" : " checked='checked'") . " /><label for='cpage_email_flag_off'> " . CPAGE_CP14 . "</label>
						&nbsp;&nbsp;" . CPAGE_CP61 . "<br />
						<input type='radio' name='cpage_print_flag' id='cpage_print_flag_on' value='1'" . ($cpage_print_flag ? " checked='checked'" : "") . " /><label for='cpage_print_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
						<input type='radio' name='cpage_print_flag' id='cpage_print_flag_off' value='0'" . ($cpage_print_flag ? "" : " checked='checked'") . " /><label for='cpage_print_flag_off'> " . CPAGE_CP14 . "</label>
						&nbsp;&nbsp;" . CPAGE_CP62 . "<br />
						<input type='radio' name='cpage_pdf_flag' id='cpage_pdf_flag_on' value='1'" . ($cpage_pdf_flag ? " checked='checked'" : "") . " /><label for='cpage_pdf_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
						<input type='radio' name='cpage_pdf_flag' id='cpage_pdf_flag_off' value='0'" . ($cpage_pdf_flag ? "" : " checked='checked'") . " /><label for='cpage_pdf_flag_off'> " . CPAGE_CP14 . "</label>
						&nbsp;&nbsp;" . CPAGE_CP63 . "<br />

						<input type='radio' name='cpage_views_flag' id='cpage_views_flag_on' value='1'" . ($cpage_views_flag ? " checked='checked'" : "") . " /><label for='cpage_views_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
						<input type='radio' name='cpage_views_flag' id='cpage_views_flag_off' value='0'" . ($cpage_views_flag ? "" : " checked='checked'") . " /><label for='cpage_views_flag_off'> " . CPAGE_CP14 . "</label>
						&nbsp;&nbsp;" . CPAGE_CP17 . "<br />
						<input type='radio' name='cpage_unique_flag' id='cpage_unique_flag_on' value='1'" . ($cpage_unique_flag ? " checked='checked'" : "") . " /><label for='cpage_unique_flag_on'> " . CPAGE_CP13 . "</label>&nbsp;&nbsp;
						<input type='radio' name='cpage_unique_flag' id='cpage_unique_flag_off' value='0'" . ($cpage_unique_flag ? "" : " checked='checked'") . " /><label for='cpage_unique_flag_off'> " . CPAGE_CP14 . "</label>
						&nbsp;&nbsp;" . CPAGE_CP31 . "<br />
					</div>
				</td>
			</tr>
			<tr>
				<td style='width:25%' class='forumheader3'>" . CPAGE_CP52 . "</td>
				<td style='width:75%;' class='forumheader3'>
					<a style='cursor:pointer' onclick='expandit(this);'>" . CPAGE_CP51 . "</a>
					<div style='display:none;'>
						<br /><b>" . CPAGE_CP28 . "</b><br />
						<textarea rows='6' cols='80' style='width:95%;' class='tbox' name='cpage_meta_description'>" . $cpage_meta_description . "</textarea>
						<br /><br /><b>" . CPAGE_CP29 . "</b><br />
						<textarea rows='6' cols='80' style='width:95%;' class='tbox' name='cpage_meta_keywords'>" . $cpage_meta_keywords . "</textarea>
						<br /><br /><b>" . CPAGE_CP30 . "</b><br />
						<input class='tbox' type='text' name='cpage_meta_title' style='width:75%;' value='" . $cpage_meta_title . "' maxlength='50' />
					</div>
				</td>
			</tr>
			<tr>
				<td style='width:25%' class='forumheader3'>" . CPAGE_CP53 . "</td>
				<td style='width:75%;' class='forumheader3'>
					<a style='cursor:pointer' onclick='expandit(this);'>" . CPAGE_CP54 . "</a>
					<div style='display:none;'>
						<input class='tbox' type='text' name='cpage_views' size='15' value='" . $cpage_views . "' maxlength='10' />&nbsp;&nbsp;" . CPAGE_CP38 . "&nbsp;&nbsp;<br />
						<input class='tbox' type='text' name='cpage_unique' size='15' value='" . $cpage_unique . "' maxlength='10' />&nbsp;&nbsp;" . CPAGE_CP39 . "&nbsp;&nbsp;<br /><br />
						{$cpage_updateto}&nbsp;&nbsp;" . CPAGE_CP46 . "<br />
						<input class='tbox' type='checkbox' name='cpage_setnow' id='cpage_setnow' value='1' " . ($cpage_setnow == 1?"checked='checked'":"") . " /> <label for='cpage_setnow' >" . CPAGE_CP47 . "</label>
					<br /><br />{$cpage_showfrom} " . CPAGE_CP108 . "<br />{$cpage_showto} " . CPAGE_CP109 . "
					</div>
				</td>
			</tr>
			<tr>
				<td style='width:25%' class='forumheader3'>" . CPAGE_CP55 . "</td>
				<td style='width:75%;' class='forumheader3'>
					<a style='cursor:pointer' onclick='expandit(this);'>" . CPAGE_CP56 . "</a>
					<div style='display:none;'>
						<br />" . CPAGE_CP18 . "&nbsp;&nbsp;
							<input class='tbox' type='text' name='cpage_password' size='20' value='" . $cpage_password . "' maxlength='50' />
						<br />" . CPAGE_CP24 . "&nbsp;&nbsp;
							" . r_userclass("cpage_class", $cpage_class, "off", "public,guest,nobody,member,main,admin,classes") . "
						<!--
						<br /><br /><b>" . CPAGE_CP57 . "</b>
							<textarea class='tbox' name='cpage_ip_restrict' style='width:80%;' rows='6' cols='80'>" . $cpage_ip_restrict . "</textarea>
						-->
					</div>
				</td>
			</tr>
			<tr>
				<td style='width:25%' class='forumheader3'>" . CPAGE_CP20 . "<br /><span class='smalltext'>" . CPAGE_CP21 . "</span></td>
				<td style='width:75%' class='forumheader3'>
					<input class='tbox' type='text' name='cpage_link' style='width:75%;' value='" . $cpage_link . "' maxlength='100' /><br /><span class='smalltext'><i>" . CPAGE_CP99 . "</i></span>
				</td>
			</tr>
			<tr>
				<td style='width:25%' class='forumheader3'>" . CPAGE_CP100 . "</td>
				<td style='width:75%' class='forumheader3'>
					<input class='tbox' type='text' name='cpage_canonical' style='width:75%;' value='" . $cpage_canonical . "' maxlength='100' /><br /><span class='smalltext'><i>" . CPAGE_CP101 . "</i></span>
				</td>
			</tr>
			<tr>
				<td style='width:25%' class='forumheader3'>" . CPAGE_CP82 . "</td>
				<td style='width:75%' class='forumheader3'>{$cpage_revision}<input type='hidden' name='cpage_revision'  value='" . $cpage_revision . "' /></td>
			</tr>
			<tr>
				<td colspan='2' style='text-align:center' class='forumheader2'>
					<input class='button' type='submit' name='submitPage' value='" . CPAGE_CP26 . "' />
		    	</td>
			</tr>
			<tr>
				<td colspan='2' style='text-align:center' class='fcaption'>&nbsp;</td>
			</tr>
		</table>
	</form>
</div>";
        return $text;
    }
    /**
    * cpage_page::showExistingPages()
    * Lists all the custom pages
    *
    * @return string - the list in html format
    * @author Father Barry <http://www.keal.me.uk>
    * @copyright Copyright (c) 2009, Barry Keal
    * @since 1.1
    * @version 1.1
    */
    function showExistingPages()
    {
        global $prototype_obj,$sql, $tp, $ns, $cpage_msg, $cpage_obj, $CPAGE_PREF, $cpage_conv, $PLUGINS_DIRECTORY;
        $current_cat = $this->cpage_currentcategory;
        $limit = 20;
        $text .= "
<form method='post' id='cpage_search' action='" . e_SELF . "'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='3' class='fcaption'>" . CPAGE_CP06 . "</td>
		</tr>
		<tr>
			<td colspan='3' class='forumheader2'>".$prototype_obj->message_box($this->cpage_msg_type,$this->cpage_message)."</td>
		</tr>
		<tr>
			<td colspan='3' class='forumheader2'>&nbsp;</td>
		</tr>
		<tr>
			<td colspan='3' class='forumheader2'>".CPAGE_CP112."
				<select name='cpage_currentcategory' class='tbox' onchange='this.form.submit()'>
					<option value='0' " . ($current_cat == 0?"selected='selected'":"") . " >" . CPAGE_C14 . "</option>";
        $sql->db_Select('cpage_category', '*', 'order by cpage_cat_name', 'nowhere', false);
        while ($row = $sql->db_Fetch()) {
            $text .= "<option value='" . $row['cpage_cat_id'] . "' " . ($row['cpage_cat_id'] == $current_cat?"selected='selected'":"") . " >" . $tp->toFORM($row['cpage_cat_name']) . "</option>";
        }
        $text .= "
  					</select>
    		</td>
		</tr>
		<tr>
			<td style='width:10%; text-align: center;' class='forumheader2'>" . CPAGE_CP02 . "</td>
			<td style='width:70%' class='forumheader2'>" . CPAGE_CP03 . "</td>
			<td style='width:20%; text-align: center;' class='forumheader2'>" . CPAGE_CP04 . "</td>
		</tr>";
        if (empty($this->cpage_search)) {
            // no filtering going on
            $where_clause = '';
            if ($current_cat > 0) {
                $where_clause = "where cpage_category=" . $current_cat;
            }
            $cpage_count = $sql->db_Count('cpage_page', '(cpage_id)', "{$where_clause}", false);
        } else {
            // there is a search term
            $cpage_search = '%' . $this->cpage_search . '%';
            if ($current_cat > 0) {
                $where_cat = " cpage_category=" . $current_cat . ' and ';
            }
            $where_clause = "WHERE $where_cat (cpage_title LIKE '{$cpage_search}' OR cpage_text LIKE '{$cpage_search}' OR cpage_meta_description LIKE '{$cpage_search}' OR cpage_meta_keywords LIKE '{$cpage_search}' OR cpage_meta_title LIKE '{$cpage_search}' OR cpage_link LIKE '{$cpage_search}') ";
            $cpage_count = $sql->db_Count('cpage_page', '(cpage_id)', " where $where_cat (cpage_title like '{$cpage_search}' or cpage_text like '{$cpage_search}' or  cpage_meta_description like '{$cpage_search}' or cpage_meta_keywords like '{$cpage_search}' or cpage_meta_title like '{$cpage_search}' or cpage_link like '{$cpage_search}' )", false);
        }
        // print "<br>count $cpage_count from $this->cpage_from<br>";
        $action = "list";
        $parms = $cpage_count . ",{$limit}," . $this->cpage_from . "," . e_SELF . '?' . $action . ".[FROM]." . $this->cpage_currentcategory ;
        $cpage_nextprev = $tp->parseTemplate("{NEXTPREV={$parms}}") . "";
        $this->cpage_from = intval($this->cpage_from);
        if ($sql->db_Select_gen("
SELECT stlimit.cpage_id,t.cpage_id,t.cpage_link,t.cpage_title,r.cpage_r_revision_id,r.cpage_r_id,r.cpage_r_datestamp,r.cpage_r_lastupdate,r.cpage_r_revisor,r.cpage_r_revision FROM (SELECT cpage_id FROM #cpage_page
{$where_clause}
ORDER BY cpage_id LIMIT " . $this->cpage_from . ",{$limit}) AS stlimit
LEFT JOIN #cpage_page AS t ON t.cpage_id=stlimit.cpage_id
LEFT JOIN #cpage_revisions AS r ON r.cpage_r_id=stlimit.cpage_id
ORDER BY stlimit.cpage_id ASC,cpage_r_revision desc" , false)) {
            // we have records
            $currentrecid = 0;
            $page_array = $sql->db_getList('ALL');
            // print_a($page_array);
            $rowcount = count($page_array);

            for($index = 1;$index <= $rowcount;++$index) {
                // step through each of the records
                $pages = $page_array[$index];
                $title_text = $pages['cpage_title'];
                $link_name = $pages['cpage_link'];
                $link_title = $pages['cpage_title'];
                if ($currentrecid != $pages['cpage_id']) {
                    // new record
                    $text .= "
		<tr>
			<td style='width:5%; text-align: center;' class='forumheader3'>{$pages['cpage_id']}</td>
			<td style='width:60%' class='forumheader3'>
            	<div style='display:inline;float:left;'><a href='" . e_BASE . $cpage_obj->make_url($link_name, $pages['cpage_id'], 0, $link_title) . "'>{$title_text}</a></div>
			    <div style='display:inline;float:right;'>";
                    if ($cpage_obj->cpage_revisions) {
                        $text .= "
                	<a href='#' onclick=\"expandit('cpage_revision_" . $pages['cpage_id'] . "')\" ><img src='images/archive_16.png' style='border:0px' alt='" . CPAGE_CP88 . "' title='" . CPAGE_CP88 . "' /></a>&nbsp;&nbsp;";
                    }
                    $text .= "<a href='#' onclick=\"expandit('cpage_link_" . $pages['cpage_id'] . "')\" ><img src='images/info_16.png' style='border:0px' alt='" . CPAGE_CP102 . "' title='" . CPAGE_CP102 . "' /></a>
				</div>
				<div id='cpage_link_" . $pages['cpage_id'] . "' style='display:none;' ><br/>Link Name: {$link_name}<br />Link URL: " . SITEURL . $cpage_obj->make_url($link_name, $pages['cpage_id'], 0, $link_title) . "</div>
				<div id='cpage_revision_" . $pages['cpage_id'] . "' style='display:none;' >
					<table style='width:100%;' >
						<tr>
							<td style='width:10%;text-align:right;' >" . CPAGE_CP83 . "&nbsp;</td>
							<td style='width:35%;' >" . CPAGE_CP84 . "</td>
							<td style='width:45%;' >" . CPAGE_CP85 . "</td>
							<td style='width:10%;text-align:center;' >" . CPAGE_CP86 . "</td>
						</tr>
							";
                }
                $currentrecid = $pages['cpage_id'];
                $tmp = explode('.', $pages['cpage_r_revisor'], 2);
                $username = $tmp[1];
                if ($pages['cpage_r_id'] > 0) {
                    $text .= "
						<tr>
							<td style='width:10%;text-align:right;' >" . $pages['cpage_r_revision'] . "&nbsp;</td>
							<td style='width:35%;' >" . $username . "</td>
							<td style='width:45%;' >" . $cpage_conv->convert_date($pages['cpage_r_lastupdate'], 'long') . "</td>
							<td style='width:10%;text-align:center;' >
								<a href='" . e_SELF . "?revert." . $pages['cpage_r_revision_id'] . "' onclick=\"return jsconfirm('" . CPAGE_CP79 . "')\" ><img src='images/page_previous_16.png' style='border:0px;' alt='" . CPAGE_CP78 . "' title='" . CPAGE_CP78 . "' /></a>&nbsp;
								<a href='" . e_SELF . "?removerev." . $pages['cpage_r_revision_id'] . "' onclick=\"return jsconfirm('" . CPAGE_CP92 . "')\" ><img src='images/page_remove_16.png' style='border:0px;' alt='" . CPAGE_CP91 . "' title='" . CPAGE_CP91 . "' /></a>
							</td>
						</tr>";
                }
                $nextpage_id = $page_array[$index + 1]['cpage_id']; // get the next page id
                // print "$currentrecid $nextpage_id $index $rowcount - ";
                if ($currentrecid != $nextpage_id || $index == $rowcount) {
                    $text .= "
					</table>
					<a href='" . e_SELF . "?remove." . $pages['cpage_id'] . "' onclick=\"return jsconfirm('" . CPAGE_CP80 . "')\" ><img src='images/page_remove_16.png' style='border:0px;' alt='" . CPAGE_CP81 . "' title='" . CPAGE_CP81 . "' /></a>
				</div>
			</td>
			<td style='width:20%; text-align: center;' class='forumheader3'>
				<a href='" . e_SELF . "?edit.{$pages['cpage_id']}'><img src='" . e_IMAGE . "admin_images/edit_16.png' style='border:0px' alt='" . CPAGE_CP07 . "' title='" . CPAGE_CP07 . "' /></a>&nbsp;&nbsp;
				<a href='" . e_SELF . "?copy.{$pages['cpage_id']}' onclick=\"return jsconfirm('" . CPAGE_CP77 . "')\"><img src='images/page_add_16.png' style='border:0px' alt='" . CPAGE_CP73 . "' title='" . CPAGE_CP73 . "' /></a>&nbsp;&nbsp;
				<a href='" . e_SELF . "?delete.{$pages['cpage_id']}' onclick=\"return jsconfirm('" . CPAGE_CP05 . " : $pages[cpage_id] ')\"><img src='" . e_IMAGE . "admin_images/delete_16.png' style='border:0px' alt='" . CPAGE_CP08 . "' title='" . CPAGE_CP08 . "' /></a>
			</td>
		</tr>";
                }
            } // end while
        } else {
            // no custom pages yet
            $text .= "
		<tr>
			<td colspan='3' style='text-align:center;' class='forumheader3'>" . CPAGE_CP43 . "</td>
		</tr>";
        } // end if $sql
        $text .= "
		<tr>
			<td colspan='3' class='forumheader2'>

				<div style='display:inline;float:left;'>
					<a href='" . e_SELF . "?add.0'><img src='images/page_add_16.png' style='border:0px;' alt='" . CPAGE_CP36 . "' title='" . CPAGE_CP36 . "' /></a>
				$cpage_nextprev
				</div>
				<div style='display:inline;float:right;'>
						<input type='text' class='tbox' name='cpage_search' value='" . $this->cpage_search . "' /> <input type='image' src='" . e_IMAGE . "admin_images/search_16.png' style='border:0px;' alt='" . CPAGE_CP90 . "' title='" . CPAGE_CP90 . "' />
				</div>

			</td>
		</tr>
		<tr>
			<td colspan='3' class='fcaption'>&nbsp;</td>
		</tr>
	</table>
</form>	";
        return $text;
    } // end func
    /**
    * cpage_page::upload_files()
    * Upload any images and if necessary, create thumbnails
    *
    * @return
    * @author Father Barry <http://www.keal.me.uk>
    * @copyright Copyright (c) 2009, Barry Keal
    * @since 1.1
    * @version 1.1
    */
    function upload_files()
    {
        // to do - add error handling
        global $pref, $action;
        $pref['upload_storagetype'] = "1";
        require_once(e_HANDLER . "upload_handler.php");
                require_once(e_HANDLER . "resize_handler.php");
        // use the proper file upload thingy - to do
        $uploaded = file_upload(e_IMAGE . "custom/");


        foreach($_POST['uploadtype'] as $key => $uploadtype) {
            if ($uploadtype == "thumb") {
                rename(e_IMAGE . "custom/" . $uploaded[$key]['name'], e_IMAGE . "custom/thumb_" . $uploaded[$key]['name']);
            }

            if ($uploadtype == "resize" && $_POST['resize_value']) {

              resize_image(e_IMAGE . "custom/" . $uploaded[$key]['name'], e_IMAGE . "custom/" . $uploaded[$key]['name'], $_POST['resize_value'], "copy");
            }
        }

        $this->cpage_action = 'reedit';
    }
    /**
    * cpage_page::delete_page()
    * Delete a custom page and all associated records
    *
    * @param mixed $page_id
    * @return boolean true if successful false if failure
    * @version 1.1
    * @since 1.1
    * @author Father Barry
    */
    function delete_page($page_id = 0)
    {
        if ($page_id == 0) {
            return false;
        }
        global $sql;
        if ($sql->db_Delete('cpage_page', 'cpage_id=' . $page_id, false)) {
            // page deleted now delete comments, ratings and revisions
            $sql->db_Delete ('comments', "comment_item_id = {$page_id} and comment_type='cpage'", false);
            $sql->db_Delete ('rate', "rate_itemid = {$page_id} and rate_table='cpage'", false);
            $sql->db_Delete('cpage_view_history', "cpage_hist_page='{$page_id}-'", false);
            $this->remove_revisions($page_id);
            // remove links
            $seo_off = "cpage.php?{$page_id}";
            $seo_on = "cpage-{$page_id}-";
            $sql->db_Delete('links', "link_url like '%{$seo_off}%' or link_url like '%{$seo_on}%'", false);

            return true;
        } else {
            return false;
        }
    }
    /**
    * cpage_page::process_form()
    * Process the form data and check required fields completed
    *
    * @return boolean true on success false on missing required fields
    * @version 1.1
    * @since 1.1
    * @author Father Barry
    */
    function process_form()
    {
        global $tp, $CPAGE_PREF;
        $this->cpage_record['cpage_id'] = intval($_POST['pageid']);
        $this->cpage_record['cpage_title'] = $tp->toDB($_POST['cpage_title']);
        $this->cpage_record['cpage_text'] = $tp->toDB($_POST['data']);
        $this->cpage_record['cpage_author'] = USERID . '.' . USERNAME;
        $this->cpage_record['cpage_datestamp'] = time();
        $this->cpage_record['cpage_showdate_flag'] = intval($_POST['cpage_showdate_flag']);
        $this->cpage_record['cpage_lastdate_flag'] = intval($_POST['cpage_lastdate_flag']);
        $this->cpage_record['cpage_showauthor_flag'] = intval($_POST['cpage_showauthor_flag']);
        $this->cpage_record['cpage_rating_flag'] = intval($_POST['cpage_rating_flag']);
        $this->cpage_record['cpage_comment_flag'] = intval($_POST['cpage_comment_flag']);
        $this->cpage_record['cpage_page_flag'] = intval($_POST['cpage_page_flag']);
        $this->cpage_record['cpage_menu_flag'] = intval($_POST['cpage_menu_flag']);
        $this->cpage_record['cpage_email_flag'] = intval($_POST['cpage_email_flag']);
        $this->cpage_record['cpage_print_flag'] = intval($_POST['cpage_print_flag']);
        $this->cpage_record['cpage_pdf_flag'] = intval($_POST['cpage_pdf_flag']);
        $this->cpage_record['cpage_views_flag'] = intval($_POST['cpage_views_flag']);
        $this->cpage_record['cpage_unique_flag'] = intval($_POST['cpage_unique_flag']);
        $this->cpage_record['cpage_password'] = $tp->toDB($_POST['cpage_password']);
        $this->cpage_record['cpage_class'] = intval($_POST['cpage_class']);
        $this->cpage_record['cpage_ip_restrict'] = $tp->toDB($_POST['cpage_ip_restrict']);
        $this->cpage_record['cpage_meta_description'] = $tp->toDB($_POST['cpage_meta_description']);
        $this->cpage_record['cpage_meta_keywords'] = $tp->toDB($_POST['cpage_meta_keywords']);
        $this->cpage_record['cpage_meta_title'] = $tp->toDB($_POST['cpage_meta_title']);
        $this->cpage_record['cpage_views'] = intval($_POST['cpage_views']);
        $this->cpage_record['cpage_unique'] = intval($_POST['cpage_unique']);
        if ($CPAGE_PREF['cpage_revisions'] == 1) {
            $this->cpage_record['cpage_revision'] = intval($_POST['cpage_revision']) + 1;
        } else {
            $this->cpage_record['cpage_revision'] = 0;
        }
        $this->cpage_record['cpage_link'] = $tp->toDB($_POST['cpage_link']);
        $this->cpage_record['cpage_canonical'] = $tp->toDB($_POST['cpage_canonical']);
        $this->cpage_record['cpage_setnow'] = intval($_POST['cpage_setnow']);
        if ($this->cpage_record['cpage_setnow'] == 1) {
            // set to current time
            $this->cpage_record['cpage_lastupdate'] = time();
        } else {
            // convert the date
            if (!empty($_POST['cpage_lastupdate'])) {
                $tmp_dt = explode(' ', $_POST['cpage_lastupdate']);
                $tmp_d = explode('-', $tmp_dt[0]);
                $tmp_t = explode(':', $tmp_dt[1]);
                $this->cpage_record['cpage_lastupdate'] = mktime($tmp_t[0], $tmp_t[1], 0, $tmp_d[1], $tmp_d[2], $tmp_d[0]);
            } else {
                $this->cpage_record['cpage_lastupdate'] = 0;
            }
        }
        if (!empty($_POST['cpage_showfrom'])) {
            $tmp_dt = explode(' ', $_POST['cpage_showfrom']);
            $tmp_d = explode('-', $tmp_dt[0]);
            $tmp_t = explode(':', $tmp_dt[1]);
            $this->cpage_record['cpage_showfrom'] = mktime($tmp_t[0], $tmp_t[1], 0, $tmp_d[1], $tmp_d[2], $tmp_d[0]);
        } else {
            $this->cpage_record['cpage_showfrom'] = 0;
        }
        if (!empty($_POST['cpage_showto'])) {
            $tmp_dt = explode(' ', $_POST['cpage_showto']);
            $tmp_d = explode('-', $tmp_dt[0]);
            $tmp_t = explode(':', $tmp_dt[1]);
            $this->cpage_record['cpage_showto'] = mktime($tmp_t[0], $tmp_t[1], 0, $tmp_d[1], $tmp_d[2], $tmp_d[0]);
        } else {
            $this->cpage_record['cpage_showto'] = 0;
        }
        $this->cpage_record['cpage_category'] = intval($_POST['cpage_category']);
        // *
        // do checks for invalid data
        // *
        // print $this->cpage_record['cpage_title'].'-'.$this->cpage_record['cpage_text'].'-'. $this->cpage_record['cpage_link'].'-';
        if (empty($this->cpage_record['cpage_title']) || empty($this->cpage_record['cpage_text'])) {
            // there was a problem so reedit
            return false;
        } else {
            // its OK to save it
            return true;
        }
    }
    /**
    * cpage_page::insert_record()
    * Insert a new record after process_files done
    *
    * @return mixed OK insertid or false if not inserted
    * @version 1.1
    * @since 1.1
    * @author Father Barry
    */
    function insert_record()
    {
        // this should be called AFTER process files
        // add a new record
        global $sql;
        $arg = "
    '{$this->cpage_record['cpage_id']}',
    '{$this->cpage_record['cpage_title']}',
    '{$this->cpage_record['cpage_text']}',
    '{$this->cpage_record['cpage_author']}',
    '{$this->cpage_record['cpage_datestamp']}',
    '{$this->cpage_record['cpage_showdate_flag']}',
    '{$this->cpage_record['cpage_lastdate_flag']}',
    '{$this->cpage_record['cpage_showauthor_flag']}',
    '{$this->cpage_record['cpage_rating_flag']}',
    '{$this->cpage_record['cpage_comment_flag']}',
    '{$this->cpage_record['cpage_page_flag']}',
    '{$this->cpage_record['cpage_menu_flag']}',
    '{$this->cpage_record['cpage_email_flag']}',
    '{$this->cpage_record['cpage_print_flag']}',
    '{$this->cpage_record['cpage_pdf_flag']}',
    '{$this->cpage_record['cpage_views_flag']}',
    '{$this->cpage_record['cpage_unique_flag']}',
    '{$this->cpage_record['cpage_password']}',
    '{$this->cpage_record['cpage_class']}',
    '{$this->cpage_record['cpage_ip_restrict']}',
    '{$this->cpage_record['cpage_meta_description']}',
    '{$this->cpage_record['cpage_meta_keywords']}',
    '{$this->cpage_record['cpage_meta_title']}',
    '{$this->cpage_record['cpage_views']}',
    '{$this->cpage_record['cpage_unique']}',
    '{$this->cpage_record['cpage_lastupdate']}',
    '{$this->cpage_record['cpage_revision']}',
    '{$this->cpage_record['cpage_link']}',
    '{$this->cpage_record['cpage_canonical']}',
    '{$this->cpage_record['cpage_showfrom']}',
    '{$this->cpage_record['cpage_showto']}',
    '{$this->cpage_record['cpage_category']}'
    ";
        if ($insertid = $sql->db_Insert('cpage_page', $arg, false)) {
            // ok
            return $insertid;
            // create the new link
        } else {
            // not ok
            return false;
        }
    }
    /**
    * cpage_page::save_record()
    * Save the record
    *
    * @return mixed OK true or false if not inserted
    * @version 1.1
    * @since 1.1
    * @author Father Barry
    */
    function save_record($page_id = 0)
    {
        if ($page_id == 0) {
            return false;
        }
        // update record
        global $sql, $CPAGE_PREF;
        $arg = "
    cpage_title='{$this->cpage_record['cpage_title']}',
    cpage_text='{$this->cpage_record['cpage_text']}',
    cpage_author='{$this->cpage_record['cpage_author']}',
    cpage_showdate_flag='{$this->cpage_record['cpage_showdate_flag']}',
    cpage_lastdate_flag='{$this->cpage_record['cpage_lastdate_flag']}',
    cpage_showauthor_flag='{$this->cpage_record['cpage_showauthor_flag']}',
    cpage_rating_flag='{$this->cpage_record['cpage_rating_flag']}',
    cpage_comment_flag='{$this->cpage_record['cpage_comment_flag']}',
    cpage_page_flag='{$this->cpage_record['cpage_page_flag']}',
    cpage_menu_flag='{$this->cpage_record['cpage_menu_flag']}',
    cpage_email_flag='{$this->cpage_record['cpage_email_flag']}',
    cpage_print_flag='{$this->cpage_record['cpage_print_flag']}',
    cpage_pdf_flag='{$this->cpage_record['cpage_pdf_flag']}',
    cpage_views_flag='{$this->cpage_record['cpage_views_flag']}',
    cpage_unique_flag='{$this->cpage_record['cpage_unique_flag']}',
    cpage_password='{$this->cpage_record['cpage_password']}',
    cpage_class='{$this->cpage_record['cpage_class']}',
    cpage_ip_restrict='{$this->cpage_record['cpage_ip_restrict']}',
    cpage_meta_description='{$this->cpage_record['cpage_meta_description']}',
    cpage_meta_keywords='{$this->cpage_record['cpage_meta_keywords']}',
    cpage_meta_title='{$this->cpage_record['cpage_meta_title']}',
    cpage_views='{$this->cpage_record['cpage_views']}',
    cpage_unique='{$this->cpage_record['cpage_unique']}',
    cpage_lastupdate='{$this->cpage_record['cpage_lastupdate']}',
    cpage_revision='{$this->cpage_record['cpage_revision']}',
    cpage_link='{$this->cpage_record['cpage_link']}',
    cpage_canonical='{$this->cpage_record['cpage_canonical']}',
    cpage_showfrom='{$this->cpage_record['cpage_showfrom']}',
    cpage_showto='{$this->cpage_record['cpage_showto']}',
    cpage_category='{$this->cpage_record['cpage_category']}'
    where cpage_id= '{$page_id}'";
        // we are saving revisions so do the update
        if ($sql->db_Update('cpage_page', $arg, false)) {
            // saved ok
            return true;
        } else {
            // not ok
            return false;
        }
    }
    /**
    * cpage_page::make_revision()
    * Make a revision copy of the specified page
    *
    * @param mixed $parent
    * @return insertid if OK, true if revisions turned off or false on failure
    * @version 1.1
    * @since 1.1
    * @author Father Barry
    */
    function make_revision($parent = 0)
    {
        if ($parent == 0) {
            return false;
        }
        global $sql, $cpage_obj, $CPAGE_PREF;
        if (!$cpage_obj->cpage_revisions) {
            // revisions are turned off so return true
            return true;
        }
        // get the current record values
        $sql->db_Select('cpage_page', '*', "where cpage_id={$parent}", 'nowhere', false);
        $oldrec = $sql->db_Fetch();
        $oldrec['cpage_revisor'] = USERID . '.' . USERNAME;
        $arg = "
    '0',
    '{$parent}',
    '{$oldrec['cpage_title']}',
    '{$oldrec['cpage_text']}',
    '{$oldrec['cpage_author']}',
    '{$oldrec['cpage_datestamp']}',
    '{$oldrec['cpage_showdate_flag']}',
    '{$oldrec['cpage_lastdate_flag']}',
    '{$oldrec['cpage_showauthor_flag']}',
    '{$oldrec['cpage_rating_flag']}',
    '{$oldrec['cpage_comment_flag']}',
    '{$oldrec['cpage_page_flag']}',
    '{$oldrec['cpage_menu_flag']}',
    '{$oldrec['cpage_email_flag']}',
    '{$oldrec['cpage_print_flag']}',
    '{$oldrec['cpage_pdf_flag']}',
    '{$oldrec['cpage_views_flag']}',
    '{$oldrec['cpage_unique_flag']}',
    '{$oldrec['cpage_password']}',
    '{$oldrec['cpage_class']}',
    '{$oldrec['cpage_ip_restrict']}',
    '{$oldrec['cpage_meta_description']}',
    '{$oldrec['cpage_meta_keywords']}',
    '{$oldrec['cpage_meta_title']}',
    '{$oldrec['cpage_views']}',
    '{$oldrec['cpage_unique']}',
    '" . time() . "',
    '{$oldrec['cpage_revision']}',
    '{$oldrec['cpage_revisor']}',
    '{$oldrec['cpage_link']}',
    '{$oldrec['cpage_canonical']}',
    '{$oldrec['cpage_showfrom']}',
    '{$oldrec['cpage_showto']}',
    '{$oldrec['cpage_category']}'
    ";
        if ($insertid = $sql->db_Insert('cpage_revisions', $arg, false)) {
            return $insertid;
        } else {
            return false;
        }
    }
    /**
    * cpage_page::cpage_upload()
    * Create the HTML to make the upload section of the edit page.
    * needs to move to the shortcode
    *
    * @return
    * @version 1.1
    * @since 1.1
    * @author Father Barry
    */
    function cpage_upload()
    {
        $upload_type = "
				<select class='tbox' name='uploadtype[]' >
					<option value='resize' >" . CPAGE_CP68 . "</option>
					<option value='image' >" . CPAGE_CP69 . "</option>
					<option value='thumb' >" . CPAGE_CP70 . "</option>
				</select>";
        $text .= "
   <!-- Upload Custom Images -->
	<div style='width:90%'>
   		<div id='up_container' >
   			<span id='upline' style='white-space:nowrap'>
   				<input class='tbox' type='file' name='file_userfile[]' size='40' /> $upload_type
   			</span>
   			<br />
   		</div>
   		<table style='width:100%'>
   			<tr>
   				<td ><input type='button' class='button' value=\"" . CPAGE_SC03 . "\" onclick=\"duplicateHTML('upline','up_container');\"  /></td>
				<td>" . CPAGE_CP71 . " <input class='tbox' type='text' name='resize_value' value='100' size='3' /> px</td>
   				<td><input class='button' type='submit' name='uploadfiles' value=\"" . CPAGE_SC04 . "\"  /></td>
			</tr>
   		</table>
   </div>
   <!-- End Upload Custom Images -->
   ";
        return $text;
    }
    /**
    * cpage_page::remove_revisions()
    * Remove all revisions associated with the specified page
    *
    * @param integer $revs_id
    * @return boolean true on success or false on failure
    * @version 1.1
    * @since 1.1
    * @author Father Barry
    */
    function remove_revisions($revs_id = 0)
    {
        if ($revs_id == 0) {
            return false;
        }
        global $sql, $CPAGE_PREF;
        if ($CPAGE_PREF['cpage_revisions'] != 1) {
            // revisions are turned off so return true
            return true;
        } ;
        if ($sql->db_Delete('cpage_revisions', 'cpage_r_id=' . $revs_id, false)) {
            return true;
        } else {
            return false;
        }
    }
    /**
    * cpage_page::copy_page()
    * Makes an exact copy of the page with Copy of prefixing the title and link
    *
    * @param integer $page_id page to copy
    * @return mixed insert id if ok else false
    * @version 1.1
    * @since 1.1
    * @author Father Barry
    */
    function copy_page($page_id = 0)
    {
        if ($page_id == 0) {
            return false;
        }
        global $sql;
        // read in page
        $sql->db_Select('cpage_page', '*', 'where cpage_id=' . $page_id, 'nowhere', false);
        $oldrec = $sql->db_Fetch();
        // change title & dates
        $oldrec['cpage_title'] = CPAGE_CP74 . ' ' . $oldrec['cpage_title'];
        $oldrec['cpage_revision'] = 0;
        $oldrec['cpage_datestamp'] = time();
        $oldrec['cpage_lastupdate'] = time();
        $oldrec['cpage_link'] = CPAGE_CP74 . ' ' . $oldrec['cpage_link'];
        // save page
        $arg = "
    '0',
    '{$oldrec['cpage_title']}',
    '{$oldrec['cpage_text']}',
    '{$oldrec['cpage_author']}',
    '{$oldrec['cpage_datestamp']}',
    '{$oldrec['cpage_showdate_flag']}',
    '{$oldrec['cpage_lastdate_flag']}',
    '{$oldrec['cpage_showauthor_flag']}',
    '{$oldrec['cpage_rating_flag']}',
    '{$oldrec['cpage_comment_flag']}',
    '{$oldrec['cpage_page_flag']}',
    '{$oldrec['cpage_menu_flag']}',
    '{$oldrec['cpage_email_flag']}',
    '{$oldrec['cpage_print_flag']}',
    '{$oldrec['cpage_pdf_flag']}',
    '{$oldrec['cpage_views_flag']}',
    '{$oldrec['cpage_unique_flag']}',
    '{$oldrec['cpage_password']}',
    '{$oldrec['cpage_class']}',
    '{$oldrec['cpage_ip_restrict']}',
    '{$oldrec['cpage_meta_description']}',
    '{$oldrec['cpage_meta_keywords']}',
    '{$oldrec['cpage_meta_title']}',
    '{$oldrec['cpage_views']}',
    '{$oldrec['cpage_unique']}',
    '{$oldrec['cpage_lastupdate']}',
    '{$oldrec['cpage_revision']}',
    '{$oldrec['cpage_link']}',
    '{$oldrec['cpage_canonical']}',
    '{$oldrec['cpage_showfrom']}',
    '{$oldrec['cpage_showto']}',
    '{$oldrec['cpage_category']}'
    ";
        if ($insert_id = $sql->db_Insert('cpage_page', $arg, false)) {
            // ok
            // create the new link
            return $insert_id;
        } else {
            // not ok
            return false;
        }
    } // end method
    /**
    * cpage_page::revert_revision()
    * Fetches the revision and replaces the parent page after saving that as a revision
    *
    * @param integer $page_id
    * @return true on success false on failure
    * @version 1.1
    * @since 1.1
    * @author Father Barry
    */
    function revert_revision($page_id = 0)
    {
        if ($page_id == 0) {
            return false;
        }
        global $sql, $tp, $CPAGE_PREF;
        if ($CPAGE_PREF['cpage_revisions'] != 1) {
            // revisions are turned off so return true
            return true;
        } ;
        // get the revision details
        if ($sql->db_Select('cpage_revisions', '*', "where cpage_r_revision_id={$page_id}", 'nowhere', false)) {
            extract($sql->db_Fetch());
            // make the current record a revision
            if ($this->make_revision($cpage_r_id)) {
                // now get the revision and make it the main
                $this->cpage_record['cpage_title'] = $tp->toDB($cpage_r_title);
                $this->cpage_record['cpage_text'] = $tp->toDB($cpage_r_text);
                $this->cpage_record['cpage_author'] = $tp->toDB($cpage_r_author);
                $this->cpage_record['cpage_datestamp'] = $cpage_r_datestamp;
                $this->cpage_record['cpage_showdate_flag'] = intval($cpage_r_showdate_flag);
                $this->cpage_record['cpage_lastdate_flag'] = intval($cpage_r_lastdate_flag);
                $this->cpage_record['cpage_showauthor_flag'] = intval($cpage_r_showauthor_flag);
                $this->cpage_record['cpage_rating_flag'] = intval($cpage_r_rating_flag);
                $this->cpage_record['cpage_comment_flag'] = intval($cpage_r_comment_flag);
                $this->cpage_record['cpage_page_flag'] = intval($cpage_r_page_flag);
                $this->cpage_record['cpage_menu_flag'] = intval($cpage_r_menu_flag);
                $this->cpage_record['cpage_email_flag'] = intval($cpage_r_email_flag);
                $this->cpage_record['cpage_print_flag'] = intval($cpage_r_print_flag);
                $this->cpage_record['cpage_pdf_flag'] = intval($cpage_r_pdf_flag);
                $this->cpage_record['cpage_views_flag'] = intval($cpage_r_views_flag);
                $this->cpage_record['cpage_unique_flag'] = intval($cpage_r_unique_flag);
                $this->cpage_record['cpage_password'] = $tp->toDB($cpage_r_password);
                $this->cpage_record['cpage_class'] = intval($cpage_r_class);
                $this->cpage_record['cpage_ip_restrict'] = $tp->toDB($cpage_r_ip_restrict);
                $this->cpage_record['cpage_meta_description'] = $tp->toDB($cpage_r_meta_description);
                $this->cpage_record['cpage_meta_keywords'] = $tp->toDB($cpage_r_meta_keywords);
                $this->cpage_record['cpage_meta_title'] = $tp->toDB($cpage_r_meta_title);
                $this->cpage_record['cpage_views'] = intval($cpage_r_views);
                $this->cpage_record['cpage_unique'] = intval($cpage_r_unique);
                $this->cpage_record['cpage_lastupdate'] = intval($cpage_r_lastupdate);
                $this->cpage_record['cpage_revision'] = intval($cpage_r_revision);
                $this->cpage_record['cpage_link'] = $tp->toDB($cpage_r_link);
                $this->cpage_record['cpage_canonical'] = $tp->toDB($cpage_r_canonical);
                $this->cpage_record['cpage_showfrom'] = intval($cpage_r_showfrom);
                $this->cpage_record['cpage_showto'] = intval($cpage_r_showto);
                $this->cpage_record['cpage_category'] = intval($cpage_r_category);
                if ($this->save_record($cpage_r_id)) {
                    // record saved OK
                    return true;
                } else {
                    // failed to save record
                    return false;
                }
            } else {
                // failed to make the revision
                return false;
            }
        } else {
            // failed to load the revision
            return false;
        }
    } // end method
    function remove_onerevision($revs_id = 0)
    {
        if ($revs_id == 0) {
            return false;
        }
        global $sql, $CPAGE_PREF;
        if ($CPAGE_PREF['cpage_revisions'] != 1) {
            // revisions are turned off so return true
            return true;
        } ;
        if ($sql->db_Delete('cpage_revisions', 'cpage_r_revision_id=' . $revs_id, false)) {
            return true;
        } else {
            return false;
        }
    }
    function update_sitelink($page_id = 0, $page_title = '', $link_class = 0)
    {
        global $sql, $tp, $CPAGE_PREF, $cpage_obj;
        // retrieve the old link
        $seo_off = "cpage.php?{$page_id}";
        $seo_on = "cpage-{$page_id}-";
        if ($sql->db_Select('links', 'link_id', "where link_url like '%{$seo_off}%' or link_url like '%{$seo_on}%'", 'nowhere', false)) {
            // we found a link
            extract($sql->db_Fetch());
        }
        $new_link = $tp->toDB("" . $cpage_obj->make_url($page_link, $page_id, 0, $page_title));
        $new_title = $tp->toDB($page_title);
        // update/insert new link
        if ($link_id > 0) {
            // update
            if (empty($page_title)) {
                $sql->db_Delete('links', "link_id={$link_id}", false);
            } else {
                if ($sql->db_Update('links', "link_url='{$new_link}',link_name='{$new_title}' where link_id={$link_id}", false)) {
                    $retval = true;
                } else {
                    $retval = false;
                }
            }
        } else {
            // insert
            if (empty($page_title)) {
                return true;
            } else {
                if ($sql->db_Insert('links', "0,'{$new_title}','{$new_link}','','',1,1,0,0,{$link_class}", false)) {
                    $retval = true;
                } else {
                    $retval = false;
                }
            }
        }
        return $retval;
    }
} // end class
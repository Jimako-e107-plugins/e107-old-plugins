<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|
|
|
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms("P"))
{
    header("location:" . e_BASE . "index.php");
}

$e_wysiwyg = "data";
$eplug_css = 'includes/js/ajax.css';
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
global $FAQ_PREF;
require_once("includes/faq_class.php");
if (!is_object($faq_obj))
{
    $faq_obj = new FAQ;
}

define("e_FAQs_DEVELOP", true);

$faqpost = new faqpost;
// $action
// $subaction
// $category
// $faq
if (e_QUERY)
{
    list($action, $sub_action, $id, $from, $parent, $order) = explode(".", e_QUERY);
    unset($tmp);
}
else
{
    $action = "main";
    $sub_action = "main";
    $id = 0;
    $from = 0;
    $parent = 0;
}
if(e_DEBUG && e_FAQs_DEVELOP) {
 print_a($action); print_a($sub_action);
}
$from = ($from ? $from : 0);
$amount = 50;
// _POST Handling....
if (isset($_POST['cancel']))
{
    $message = FAQ_ADLAN_28;
}
if (isset($_FILES['faq_gfile']['name'][0]))
{
    require_once(e_HANDLER . "upload_handler.php");
    $faq_fileoptions = array('file_mask' => 'jpg,gif,png', 'file_array_name' => 'faq_gfile', 'overwrite' => true);
    $faq_upresult = process_uploaded_files(e_PLUGIN . "faq/graphics", false, $faq_fileoptions);
}
if (isset($_POST['faq_author']))
{
    // we have an author to find
    $sql->db_Select('user', 'concat(user_id,".",user_name) as postername', 'where user_name="' . $tp->toDB($_POST['faq_author']) . '"', 'nowhere', false);
    extract($sql->db_Fetch()) ;
}
$faq_poster = $postername;

if (isset($_POST['faq_update_entry']))
{
    if ($_POST['faq_question'] != "" || $_POST['data'] != "")
    {
        // faq_pcomments faq_prating
        if ($FAQ_PREF['faq_log'] > 0)
        {
            $faq_plugin = FAQ_LOG_01;
            $faq_action = FAQ_LOG_02 . " " . intval($_POST['faq_id']);
        }
        else
        {
            $faq_plugin = "";
            $faq_action = "";
        }
        if (intval($_POST['faq_pcomments']) == 1)
        {
            $sql->db_Delete("comments", "comment_item_id=" . intval($_POST['faq_id']) . " and comment_type='faqfb'", false, $faq_plugin, $faq_action);
        }
        if ($FAQ_PREF['faq_log'] > 0)
        {
            $faq_plugin = FAQ_LOG_01;
            $faq_action = FAQ_LOG_03 . " " . intval($_POST['faq_id']);
        }
        else
        {
            $faq_plugin = "";
            $faq_action = "";
        }
        if (intval($_POST['faq_prating']) == 1)
        {
            $sql->db_Delete("rate", "rate_itemid=" . intval($_POST['faq_id']) . " and rate_table='faq'", false, $faq_plugin, $faq_action);
        }

        $faqneworder = intval(intval($_POST['faqoldorder']));
        $faqoldorder = $faqneworder;
        $faq_oldparent = intval(intval($_POST['faqoldparent']));
        // if parent <> oldparent then it is being moved so sort out the order
        if ($faq_oldparent <> intval(intval($_POST['faq_parent'])))
        {
            $sql->db_Update("faq", "faq_order=faq_order-1 WHERE faq_parent= '$faq_oldparent' and faq_order > '$faqoldorder' ");
            $faqneworder = $sql->db_Count("faq", "(*)", "WHERE faq_parent='" . intval($_POST['faq_parent']) . "' ") + 1;
        }

        $faq_question = $tp->toDB($_POST['faq_question']);
        $data = $tp->toDB($_POST['data']);
        if ($FAQ_PREF['faq_log'] > 0)
        {
            $faq_plugin = FAQ_LOG_01;
            $faq_action = FAQ_LOG_04 . " " . intval($_POST['faq_id']);
        }
        else
        {
            $faq_plugin = "";
            $faq_action = "";
        }
        $sql->db_Update("faq", "faq_updated=".time().",faq_parent='" . intval($_POST['faq_parent']) . "', faq_question ='$faq_question', faq_answer='" . $tp->toDB($data) . "', faq_comment='" . intval($_POST['faq_comment']) . "', faq_author='" . $tp->toDB($faq_poster) . "', faq_order='$faqneworder', faq_approved='" . intval($_POST['faq_approved']) . "' WHERE faq_id='" . intval($_POST['faq_id']) . "' ", false, $faq_plugin , $faq_action);
        if ($_POST['faq_pviews'] == 1)
        {
            if ($FAQ_PREF['faq_log'] > 0)
            {
                $faq_plugin = FAQ_LOG_01;
                $faq_action = FAQ_LOG_05 . " " . intval($_POST['faq_id']);
            }
            else
            {
                $faq_plugin = "";
                $faq_action = "";
            }
            $sql->db_Update("faq", "faq_views='0', faq_viewer ='', faq_unique='0' WHERE faq_id='" . intval($_POST['faq_id']) . "' ", false, $faq_plugin , $faq_action);
        }
        $message = FAQ_ADLAN_29;
        unset($faq_question, $data);
        $faq_obj->faq_cache_clear();
    }
    else
    {
        $message = FAQ_ADLAN_30;
    }
    $action = "edit";
    $sub_action = "entries";
}

if (isset($_POST['faq_insert_entry']))
{
    $message = "-";
    if ($_POST['faq_question'] != "" || $_POST['data'] != "")
    {
        // $faq_poster = $_POST['faq_author'];
        $faq_question = $tp->toDB($_POST['faq_question']);
        $data = $tp->toDB($_POST['data']);
        $count = ($sql->db_Count("faq", "(*)", "WHERE faq_parent='" . intval($_POST['faq_parent']) . "' ") + 1);
        if ($FAQ_PREF['faq_log'] > 0)
        {
            $faq_plugin = FAQ_LOG_01;
            $faq_action = FAQ_LOG_06;
        }
        else
        {
            $faq_plugin = "";
            $faq_action = "";
        }

        $faq_insid = $sql->db_Insert("faq", " 0, '" . intval($_POST['faq_parent']) . "', '" . $faq_question . "', '" . $data . "', '" . intval($_POST['faq_comment']) . "', '" . time() . "', '" . $tp->toDB($faq_poster) . "', '" . $count . "','" . intval($_POST['faq_approved']) . "',0,'',0,".time(), false, $faq_plugin, $faq_action);
        $message = FAQ_ADLAN_32;
        $faq_obj->faq_cache_clear();
        unset($faq_question, $data);
    }
    else
    {
        $message = FAQ_ADLAN_30;
    }
    // $from =$_POST['faq_parent'];
    $from = $faq_insid;
    $id = intval($_POST['faq_parent']);
    $action = "edit";
    $sub_action = "entries";
}

if (isset($_POST['parent_edit']))
{
    $sql->db_Select("faq", "*", "faq_id='" . intval($_POST['faq_parent']) . "' ");
    list($p_id, $parent, $p_question, $p_answer, $p_comment) = $sql->db_Fetch();
    $edit_parent = true;
}
else
{
    $edit_parent = false;
}
// Insert Parent
if (isset($_POST['faq_info_add']))
{
    if ($_POST['faq_info_title'] != "" || $_POST['faq_info_about'] != "")
    {
        $faq_info_title = $tp->toDB($_POST['faq_info_title']);
        $faq_info_about = $tp->toDB($_POST['faq_info_about']);
        $count = ($sql->db_Count("faq_info", "(*)", "WHERE faq_info_parent='" . intval($_POST['faq_info_parent']) . "' ") + 1);
        if ($FAQ_PREF['faq_log'] > 0)
        {
            $faq_plugin = FAQ_LOG_01;
            $faq_action = FAQ_LOG_07;
        }
        else
        {
            $faq_plugin = "";
            $faq_action = "";
        }

        $sql->db_Insert("faq_info", " 0, '" . $faq_info_title . "', '" . $faq_info_about . "', '" . intval($_POST['faq_info_parent']) . "', '" . intval($_POST['faq_info_class']) . "', '" . $count . "' , '" . $tp->toDB($_POST['faq_info_icon']) . "'", false, $faq_plugin, $faq_action);
        $message = FAQ_ADLAN_85;
        unset($faq_title, $faq_about);
        $faq_obj->faq_cache_clear();
    }
    else
    {
        $message = FAQ_ADLAN_30;
    }
    $action = "main";
}
// Edit Parent.
if (isset($_POST['faq_info_edit']))
{
    if ($_POST['faq_info_title'] != "" || $_POST['faq_info_about'] != "")
    {
        $faq_info_title = $tp->toDB($_POST['faq_info_title']);
        $faq_info_about = $tp->toDB($_POST['faq_info_about']);
        if ($FAQ_PREF['faq_log'] > 0)
        {
            $faq_plugin = FAQ_LOG_01;
            $faq_action = FAQ_LOG_08 . " " . intval($_POST['faq_info_id']);
        }
        else
        {
            $faq_plugin = "";
            $faq_action = "";
        }
        $sql->db_Update("faq_info", "faq_info_title ='$faq_info_title', faq_info_about='$faq_info_about', faq_info_parent='" . intval($_POST['faq_info_parent']) . "', faq_info_class='" . intval($_POST['faq_info_class']) . "', faq_info_icon='" . $tp->toDB($_POST['faq_info_icon']) . "' WHERE faq_info_id='" . intval($_POST['faq_info_id']) . "' ", false, $faq_plugin, $faq_action);
        $message = FAQ_ADLAN_33;
        unset($faq_info_title, $faq_info_about);

        $faq_obj->faq_cache_clear();
    }
    else
    {
        $message = FAQ_ADLAN_30; // You left a field blank
    }
    $action = "main";
}

if (isset($message))
{
    $ns->tablerender("", "<div style='text-align:center'><b>" . $message . "</b></div>");
}
// ============------=++++++++++++++++++++++++++++++++++++++++++++++
// ACTIONS ===========
// ============-----------
if (isset($_POST['confirm_del_parent']))
{
    $id = intval($_POST['parid']);
    $faq_parent = intval($_POST['oldfaqinfoparent']);
    $faq_info_oldorder = intval($_POST['oldfaqinfoorder']);
    $faq_info_oldid = intval($_POST['oldfaqinfoid']);
    $sql->db_Update("faq_info", "faq_info_order=faq_info_order-1 WHERE faq_info_order>'$faq_info_oldorder' AND faq_info_parent= '$faq_parent'");
    $sql->db_Delete("faq_info", "faq_info_id='$faq_info_oldid' ", false, "FAQ", "FAQ Category Deleted " . $faq_info_oldid);
    $message = FAQ_ADLAN_74;
    $faq_obj->faq_cache_clear();
    $ns->tablerender("", "<div style='text-align:center'><b>" . $message . "</b></div>");
}

if ($action == "delparent")
{
    $faqpost->del_parent($sub_action, $id);
}

if ($action == "main")
{
    $faqpost->show_existing_parents($action, $sub_action, $id, $from, $amount);
}

if ($action == "info")
{
    $faqpost->edit_parent_info($action, $sub_action, $id, $from, $amount);
}

if ($action == "add")
{
    $faqpost->edit_parent_info($action, $sub_action, "", $from, $amount);
}

if ($action == "edit")
{
    $faqpost->edit_entries($action, $sub_action, $id, $from, $amount);
}

if ($action == "sub")
{
    $faqpost->edit_entries($action, $sub_action, $id, $from, $amount);
}

if ($action == "mvup")
{
    if ($order > 1)
    {
        // print "from $from sub $sub_action id $id<br>";
        $sql->db_Update("faq_info", "faq_info_order=faq_info_order+1 WHERE faq_info_order='" . ($order-1) . "' AND faq_info_parent= '" . intval($parent) . "'");
        $sql->db_Update("faq_info", "faq_info_order=faq_info_order-1 WHERE faq_info_id='" . intval($id) . "' AND faq_info_parent= '" . intval($parent) . "'");
        $faq_obj->faq_cache_clear();
    }
    $action = "main";
    $sub_action = "";
    $faqpost->show_existing_parents($action, $sub_action, $id, $from, $amount);
}

if ($action == "mvdn")
{
    // get the largest order
    $sql->db_Select("faq_info", "max(faq_info_order) as tops", "faq_info_parent = " . intval($parent));
    $faq_tops = $sql->db_Fetch();
    $faq_max = $faq_tops[0];
    if ($order < $faq_max)
    {
        $sql->db_Update("faq_info", "faq_info_order=faq_info_order-1 WHERE faq_info_order='" . ($order + 1) . "' AND faq_info_parent= '" . intval($parent) . "'");
        $sql->db_Update("faq_info", "faq_info_order=faq_info_order+1 WHERE faq_info_id='" . intval($id) . "' AND faq_info_parent= '" . intval($parent) . "'");
    }
    $action = "main";
    $sub_action = "";
    $faqpost->show_existing_parents($action, $sub_action, $id, $from, $amount);
    $faq_obj->faq_cache_clear();
}

if ($action == "entup")
{
    // $order = $from;
    if ($order > 1)
    {
        $sql->db_Update("faq", "faq_order=faq_order+1 WHERE faq_order='" . ($order-1) . "' AND faq_parent= '" . intval($parent) . "'");
        $sql->db_Update("faq", "faq_order=faq_order-1 WHERE faq_id='" . intval($from) . "' AND faq_parent= '" . intval($parent) . "'");
    }
    $action = "edit";
    $sub_action = "entries";
    $faqpost->edit_entries($action, $sub_action, $parent, $from, $amount);
    $faq_obj->faq_cache_clear();
}

if ($action == "entdn")
{
    // $order = $from;
    $sql->db_Select("faq", "max(faq_order) as tops", "faq_parent = " . intval($parent) . "");
    $faq_tops = $sql->db_Fetch();
    $faq_max = $faq_tops[0];
    if ($order < $faq_max)
    {
        $sql->db_Update("faq", "faq_order=faq_order-1 WHERE faq_order='" . ($order + 1) . "' AND faq_parent= '" . intval($parent) . "'");
        $sql->db_Update("faq", "faq_order=faq_order+1 WHERE faq_id='" . intval($from) . "' AND faq_parent= '" . intval($parent) . "'");
    }
    $action = "edit";
    $sub_action = "entries";
    $faqpost->edit_entries($action, $sub_action, $parent, $from, $amount);
    $faq_obj->faq_cache_clear();
}

if ($action == "delentry")
{
    $faqpost->del_entry($action, $sub_action, $id, $from, $parent, $order);
    $faq_obj->faq_cache_clear();
}

if (isset($_POST['confirm_del_entry']))
{
    // move the order up
    // print "p $parent o $order ";
    $sql->db_Update("faq", "faq_order=faq_order - 1 where faq_order>$order and faq_parent=" . intval($parent) . "");
    $sql->db_Delete("faq", " faq_id='" . intval($from) . "' ", false, "FAQ", "FAQ Deleted " . intval($from));
    // Delete any comments for this faq
    $sql->db_Delete("comments", " comment_type='faqfb' and comment_item_id='" . intval($from) . "'");
    $message = FAQ_ADLAN_74;
    $ns->tablerender("", "<span style='text-align:center'><b>" . $message . "</b></span>");
    $action = "edit";
    $sub_action = "entries";
    $faqpost->edit_entries($action, $sub_action, $id , $from, $amount);
    $faq_obj->faq_cache_clear();
}
require_once(e_ADMIN . "footer.php");
// end Main Program
// ++++++++++++ CLASS // FUNCTIONS ++++++++++++++++++++++
class faqpost
{
    // ********************************************************
    // Delete Entry
    // ********************************************************
    function del_entry($action, $sub_action, $id, $from, $parent, $order)
    {
        global $sql, $ns, $tp;
        $sql->db_Select("faq", "*", "faq_id='" . intval($from) . "' ");
        list($del_id, $delp_id, $del_question) = $sql->db_Fetch();
        $faq_text = "
<form method='post' action='" . e_SELF . "?confirm.delentry.$id.$from.$parent.$order'>
	<div style='text-align:center'>
        " . FAQ_ADLAN_23 . "<br /><b> ('" . $tp->toHTML($del_question, false, "no_make_clickable no_replace emotes_off") . "') </b><br />" . FAQ_ADLAN_24 . "
		<br /><br />
		<input class='button' type='submit' name='cancel' value='" . FAQ_ADLAN_25 . "' />
		<input class='button' type='submit' name='confirm_del_entry' value='" . FAQ_ADLAN_26 . "' />
		<input type='hidden' name='id' value='" . intval($id) . "' />
	</div>
</form>";
        $ns->tablerender(FAQ_ADLAN_27, $faq_text);
        // exit;
    }

    function del_parent($sub_action, $id)
    {
        global $sql, $ns, $tp;
        $faq_faqs = $sql->db_Count("faq", "(*)", "where faq_parent='" . intval($id) . "'");
        $faq_cats = $sql->db_Count("faq_info", "(*)", "where faq_info_parent='" . intval($id) . "'");
        if ($faq_faqs > 0 || $faq_cats > 0)
        {
            $sql->db_Select("faq_info", "*", "faq_info_id='" . intval($id) . "' ");
            $row = $sql->db_Fetch();
            $faq_text .= "
<div class='fborder' style='text-align:left'>
        " . FAQ_ADLAN_111 . " " . $tp->toHTML($row['faq_info_title'], false, "no_make_clickable no_replace emotes_off") . " " . FAQ_ADLAN_112 . "
</div>";
        }
        else
        {
            $sql->db_Select("faq_info", "*", "faq_info_id='" . $id . "' ");
            $row = $sql->db_Fetch();
            $faq_text = "
<form method='post' action='" . e_SELF . "'>
	<div style='text-align:center'>
		<input type='hidden' name='oldfaqinfoorder' value='" . intval($row['faq_info_order']) . "' />
		<input type='hidden' name='oldfaqinfoparent' value='" . intval($row['faq_info_parent']) . "' />
		<input type='hidden' name='oldfaqinfoid' value='" . intval($row['faq_info_id']) . "' />
        " . FAQ_ADLAN_23 . "<br /><b> ('" . $row['faq_info_title'] . "') </b><br />" . FAQ_ADLAN_24 . "
		<br /><br />
			<input class='button' type='submit' name='cancel' value='" . FAQ_ADLAN_25 . "' />
			<input class='button' type='submit' name='confirm_del_parent' value='" . FAQ_ADLAN_26 . "' />
			<input type='hidden' name='parid' value='" . intval($id) . "' />
	</div>
</form>";
        }
        $ns->tablerender(FAQ_ADLAN_27, $faq_text);
        // exit;
    }

    function show_existing_parents($action, $sub_action, $id, $from, $amount)
    {
        // ##### Display scrolling list of existing FAQ items ---------------------------------------------------------------------------------------------------------
        global $sql2, $sql, $ns, $tp;
        if (!is_object($sql3))
        {
            $sql3 = new db;
        }
        $faq_text = "
<div style='text-align:center'>
<div style='border : solid 1px #000; padding : 0px; width : auto; height : 320px; overflow : auto; '>";
        if ($sql->db_Select("faq_info", "*", "where faq_info_parent='0' ORDER BY faq_info_order ASC", "nowhere", false))
        {
            $faq_text .= "
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
    	<tr>
			<td colspan='2' style='text-align:left; width:55%' class='fcaption'>" . FAQ_ADLAN_76 . "</td>
            <td style='text-align:center; width:12%' class='fcaption'>" . FAQ_ADLAN_80 . "</td>
            <td colspan='2' style='width:20%; text-align:center' class='fcaption'>" . FAQ_ADLAN_81 . "</td>
        </tr>";
            while ($row = $sql->db_Fetch())
            {
                extract($row);
                $faq_text .= "
		<tr>
        	<td colspan='3' style='width:65%' class='forumheader'>" . ($faq_info_title ? $tp->toHTML($faq_info_title, false, "no_make_clickable no_replace emotes_off") : "[" . NWSLAN_42 . "]") . "</td>
            <td style='width:5%; text-align:center;margin-left:auto;margin-right:auto' class='forumheader'>
            	<a href='" . e_SELF . "?mvup.category.$faq_info_id.0.$faq_info_parent.$faq_info_order'><img title='" . FAQ_ADLAN_91 . "' src='./images/up.png' style='padding:2px;border:0px' alt='" . FAQ_ADLAN_91 . "' /></a><br />
                <a href='" . e_SELF . "?mvdn.category.$faq_info_id.0.$faq_info_parent.$faq_info_order'><img title='" . FAQ_ADLAN_92 . "' src='./images/down.png' style='padding:2px;border:0px' alt='" . FAQ_ADLAN_92 . "' /></a>
            </td>
            <td style='width:25%; text-align:right' class='forumheader'>
            	<input type='button' class='button' id='main_info_{$faq_info_id}' name='main_info_{$faq_info_id}' onclick=\"document.location='" . e_SELF . "?info.edit.$faq_info_id.$from'\" value='" . FAQ_ADLAN_71 . "' />
            	<input type='button' class='button' id='main_delete_{$faq_info_id}' name='main_delete_{$faq_info_id}' onclick=\"document.location='" . e_SELF . "?delparent.entries.$faq_info_id.$from'\" value='" . FAQ_ADLAN_50 . "' />
            </td>
        </tr>";
                $subparents = $sql2->db_Select("faq_info", "*", "faq_info_parent='" . $faq_info_id . "' ORDER BY faq_info_order ASC");
                if (!$subparents)
                {
                    $faq_text .= "
		<tr>
			<td colspan='5' style='text-align:center' class='forumheader3'>" . FAQ_ADLAN_75 . "</td>
		</tr>";
                }
                else
                {
                    while ($row = $sql2->db_Fetch())
                    {
                        extract($row);
                        $faq_text .= "
		<tr>
        	<td style='width:5%;vertical-align:middle' class='forumheader3'><img src='" . e_PLUGIN . "faq/images/faq.png' alt='' /></td>
            <td style='width:53%' class='forumheader3'><a href='" . e_PLUGIN . "faq/faq.php?cat.$faq_info_id'>" . ($faq_info_title ?$tp->toHTML($faq_info_title, false, "no_make_clickable no_replace emotes_off") : "[" . NWSLAN_42 . "]") . "</a></td>
            <td style='width:12%; text-align:center' class='forumheader3'>";
                        $cnt = $sql3->db_Count("faq", "(*)", "WHERE faq_parent = '" . intval($faq_info_id) . "' ");
                        $faq_text .= $cnt;
                        $faq_text .= "
            </td>
            <td style='width:5%; text-align:center;margin-left:auto;margin-right:auto' class='forumheader3'>
            	<a href='" . e_SELF . "?mvup.category.$faq_info_id.0.$faq_info_parent.$faq_info_order'><img title='" . FAQ_ADLAN_91 . "' src='./images/up.png' style='padding:2px;border:0px' alt='" . FAQ_ADLAN_91 . "' /></a><br />
                <a href='" . e_SELF . "?mvdn.category.$faq_info_id.0.$faq_info_parent.$faq_info_order'><img title='" . FAQ_ADLAN_92 . "' src='./images/down.png' style='padding:2px;border:0px' alt='" . FAQ_ADLAN_92 . "' /></a>
            </td>
            <td style='width:25%; text-align:right' class='forumheader3'>
	        	<input type='button' class='button' id='main_edit_{$faq_info_id}' name='main_edit_{$faq_info_id}' onclick=\"document.location='" . e_SELF . "?edit.entries.$faq_info_id.$from'\" value='" . FAQ_ADLAN_142 . "' />
	        	<input type='button' class='button' id='main_info_{$faq_info_id}' name='main_info_{$faq_info_id}' onclick=\"document.location='" . e_SELF . "?info.edit.$faq_info_id.$from'\" value='" . FAQ_ADLAN_71 . "' />
	        	<input type='button' class='button' id='main_delete_{$faq_info_id}' name='main_delete_{$faq_info_id}' onclick=\"document.location='" . e_SELF . "?delparent.entries.$faq_info_id.$from'\" value='" . FAQ_ADLAN_50 . "' />
            </td>
		</tr>";
                    }
                }
            }
            $faq_text .= "
	</table>";
        }
        else
        {
            $faq_text .= "
	<div style='text-align:center'>" . FAQ_ADLAN_86 . "<br />" . FAQ_ADLAN_87 . "</div>";
        }
        $faq_text .= "
</div>
</div>";
        $ns->tablerender("FAQ", $faq_text);
    }
    // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function edit_parent_info($action, $sub_action, $id, $from, $amount)
    {
        global $sql, $ns, $tp, $PLUGINS_DIRECTORY;
        if ($id)
        {
            $sql->db_Select("faq_info", "*", " faq_info_id = '" . intval($id) . "' ");
            $row = $sql->db_Fetch();
            extract($row);
        }
        $faq_text = "
<form method='post' action='" . e_SELF . "?" . e_QUERY . "'>
	<table class='fborder' style='" . ADMIN_WIDTH . "' >";
        if ($faq_edit == true)
        {
            $faq_text .= "
		<tr>
        	<td colspan='2' class='border'>
        		<span class='caption'>" . FAQ_ADLAN_38 . "</span>
        	</td>
        </tr>";
        }
        else
        {
            $faq_text .= "
		<tr>
        	<td class='fcaption' colspan='2' >
        		<span class='caption'>" . FAQ_ADLAN_57 . "</span>
        	</td>
        </tr>";
        }

        $faq_text .= "
		<tr>
        	<td class='forumheader3' style='width:20%'>" . FAQ_ADLAN_79 . "</td>
        	<td class='forumheader3' style='width:80%'>";
        $faq_text .= "<select class='tbox' name='faq_info_parent' ><option value='0'>" . FAQ_ADLAN_77 . "</option>";
        $sql->db_Select("faq_info", "*", "faq_info_parent='0'");
        while ($par = $sql->db_Fetch())
        {
            $selected = ($faq_info_parent == $par['faq_info_id']) ? " selected='selected'" : "";
            $faq_text .= "<option value='" . $par['faq_info_id'] . "' $selected>" . $tp->toFORM($par['faq_info_title']) . "</option>";
        }
        $faq_text .= " </select>
			</td>
		</tr>
		<tr>
        	<td class='forumheader3' style='width:20%'>" . FAQ_ADLAN_39 . "</td>
        	<td class='forumheader3' style='width:80%'>
        		<input class='tbox' type='text' name='faq_info_title' size='60' value='" . $tp->toFORM($faq_info_title) . "'  />
        	</td>
        </tr>
        <tr>
	        <td class='forumheader3' style='width:20%'>" . FAQ_ADLAN_40 . "</td>
    	    <td class='forumheader3' style='width:80%'>
        		<textarea class='tbox' name='faq_info_about' cols='70' rows='10'>" . $tp->toFORM($faq_info_about) . "</textarea>
        	</td>
        </tr>
        <tr>
	        <td class='forumheader3' style='width:40%; vertical-align:top'>" . FAQ_ADLAN_73 . "</td>"; // visible to
        $faq_text .= "
			<td class='forumheader3'>" . r_userclass("faq_info_class", $faq_info_class, "off", "public,guest,nobody,member,admin,main,classes") . "</td>
        </tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . FAQ_ADLAN_129 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='text' id='faq_info_icon' name='faq_info_icon' size='60' value='" . $tp->toFORM($faq_info_icon) . "' maxlength='200' /><br />";
        require_once(e_HANDLER . "file_class.php");
        $faq_fl = new e_file;
        $faq_list = $faq_fl->get_files(e_PLUGIN . "faq/images/caticons/", '');
        if ($id)
        {
            $sql->db_Select("faq_info", "*", " faq_info_id = '" . intval($id) . "' ");
            $row = $sql->db_Fetch();
            extract($row);
        }
        foreach($faq_list as $faq_catlogo)
        {
            $faq_text .= "<a href=\"javascript:insertext('" . $faq_catlogo['fname'] . "','faq_info_icon')\"><img src='" . $faq_catlogo['path'] . $faq_catlogo['fname'] . "' style='border-width:1px' alt='' /></a> ";
        }

        $faq_text .= "
			</td>
		</tr>
    	<tr>
			<td class='fcaption' colspan='2' style='text-align:left'>";
        if ($id)
        {
            $faq_text .= " <input class='button' type='submit' name='faq_info_edit' value='" . FAQ_ADLAN_72 . "' />";
        }
        else
        {
            $faq_text .= " <input class='button' type='submit' name='faq_info_add' value='" . FAQ_ADLAN_42 . "' />";
        }
        $faq_text .= "<input type='hidden' name='faq_info_id' value='" . intval($id) . "' />
			</td>
    	</tr>
    </table>
</form>";
        $ns->tablerender(FAQ_ADLAN_43, $faq_text);
    } // end of function.
    function edit_entries($action, $sub_action, $id, $from, $amount)
    {
        global $sql, $ns, $tp, $pref, $FAQ_PREF, $PLUGINS_DIRECTORY;
        $id = intval($id);
        $from = intval($from);
        if ($sub_action == "entries")
        {
            $faq_cat = $sql->retrieve("faq_info", "*", "faq_info_id='" . intval($id) . " LIMIT 1 '");
          //  $faq_row = $sql->db_Fetch();
          //  $faq_cat = $faq_row['faq_info_title'];
          if(e_DEBUG && e_FAQs_DEVELOP) {
					      print_a($faq_cat);
					}
            $faq_text .= "\n\n<!-- Sub entry -->\n\n
<div style='text-align:left'>
<table class='fborder' style='" . ADMIN_WIDTH . "' >
    <tr>
        <td colspan='2' class='forumheader3' style='width:80%;'>";
            $sql->db_Select("faq", "*", "faq_parent='$id' ORDER BY faq_order ASC");
            $faq_text .= "
			<div style='border : solid 1px #000; width : 100%; height : 320px; overflow : auto; '>
        		<table class='fborder' style='width:99%; border:0px'>
        			<tr>
        				<td class='fcaption' style='width:70%'>" . FAQ_ADLAN_49 . " <b>" . $tp->toHTML($faq_cat, false, "no_make_clickable no_replace emotes_off") . "</b></td>
        				<td class='fcaption' style='text-align:center'>" . FAQ_ADLAN_89 . "</td>
        				<td class='fcaption' style='text-align:center'>" . FAQ_ADLAN_90 . "</td>
					</tr>
        ";
            while (list($pfaq_id, $pfaq_parent, $pfaq_question, $pfaq_answer, $pfaq_comment, $pfaq_datestamp, $pfaq_author, $pfaq_order) = $sql->db_Fetch())
            {
                $pfaq_question = substr($pfaq_question, 0, 50) . " ... ";
                $faq_text .= "
					<tr>
	                	<td style='width:70%' class='forumheader3'>" . ($pfaq_question ? $tp->toHTML($pfaq_question, false, "no_make_clickable no_replace emotes_off") : "[" . NWSLAN_42 . "]") . "</td>
                  		<td style='width:5%; text-align:center' class='forumheader3'>
                    		<a href='" . e_SELF . "?entup.record.$pfaq_parent.$pfaq_id.$pfaq_parent.$pfaq_order'><img title='" . FAQ_ADLAN_91 . "' src='./images/up.png' style='padding:2px;border:0px' alt='" . FAQ_ADLAN_91 . "' /></a><br />
                    		<a href='" . e_SELF . "?entdn.record.$pfaq_parent.$pfaq_id.$pfaq_parent.$pfaq_order'><img title='" . FAQ_ADLAN_92 . "' src='./images/down.png' style='padding:2px;border:0px' alt='" . FAQ_ADLAN_92 . "' /></a>
                    	</td>
                  		<td style='width:30%; text-align:center' class='forumheader3'>
	                  		<input type='button' class='button' id='entry_edit{$pfaq_id}' name='entry_edit{$pfaq_id}' onclick=\"document.location='" . e_SELF . "?edit.record.$id.$pfaq_id.$pfaq_parent.$pfaq_order'\" value='" . FAQ_ADLAN_45 . "' />
    	              		<input type='button' class='button' id='entry_delete{$pfaq_id}' name='entry_delete{$pfaq_id}' onclick=\"document.location='" . e_SELF . "?delentry.record.$id.$pfaq_id.$pfaq_parent.$pfaq_order'\" value='" . FAQ_ADLAN_50 . "' />
                  		</td>
                  </tr>";
            }
            $faq_text .= "
				</table>
			</div>
		</td>
	</tr>
</table>
</div>";
        }
        else
        {
            if ($from > 0)
            {
                $row = $sql->retrieve("faq", "*", " faq_id = '" . intval($from) . "' LIMIT 1 ");
                //$row = $sql->db_Fetch();
                //extract($row);
                if(e_DEBUG && e_FAQs_DEVELOP) {
					     			print_a($row);
								}
            }
            $data = $faq_answer;
            $faq_text .= "


<div style='text-align:left'>
	<form method='post' class='edit_entries' action='" . e_SELF . "?edit.entries.$id.$from' id='dataform' enctype='multipart/form-data'>
		<div>
			<input type='hidden' name='faqoldid' value='$faq_id' />
			<input type='hidden' name='faqoldparent' value='$faq_parent' />
			<input type='hidden' name='faqoldorder' value='$faq_order' />
		</div>
	    <table class='fborder' style='" . ADMIN_WIDTH . "' >
    		<tr>
        		<td class='fcaption' colspan='2' style='text-align:center'>";
            $faq_text .= (is_numeric($from)) ? FAQ_ADLAN_45 : FAQ_ADLAN_82;
            $faq_text .= " " . FAQ_ADLAN_83 . "
				</td>
			</tr>
        	<tr>
        		<td class='forumheader3' style='width:20%'>" . FAQ_ADLAN_78 . "</td>
        		<td class='forumheader3' style='width:80%'>";
            $faq_text .= "<select class='tbox' name='faq_parent' >";
            $records = $sql->retrieve("faq_info", "*", "faq_info_parent !='0' ", true);
            
            //$row = $sql->db_Fetch();
            //extract($row);
            if(e_DEBUG && e_FAQs_DEVELOP) {
					     		//	print_a($records);
						}
								
           foreach ($records as $prow)
            {
                //extract($prow);
                $selected = $prow['faq_info_id'] == $id ? " selected='selected'" : "";
                $faq_text .= "<option value='" . $prow['faq_info_id'] . "' $selected>" . $tp->toFORM($prow['faq_info_title']) . "</option>";
            }
            $faq_text .= " </select>
            	</td>
            </tr>
        	<tr>
        		<td class='forumheader3' style='width:20%'>" . FAQ_ADLAN_51 . "</td>
        		<td class='forumheader3' style='width:80%'>
			        <input class='tbox' type='text' name='faq_question' style='width:100%' value='" . $tp->toFORM($faq_question) . "'  />
        		</td>
        	</tr>
	        <tr>
    		    <td class='forumheader3' style='width:20%;vertical-align:top;' >" . FAQ_ADLAN_60 . "</td>
        		<td class='forumheader3' style='width:80%' >
        			<textarea id='data' class='tbox' name='data' style='width:100%' rows='15' cols='30' onselect=\"storeCaret(this);\" onclick=\"storeCaret(this);\" onkeyup=\"storeCaret(this);\">" . $tp->toDB($data) . "</textarea>";
            if (!$pref['wysiwyg'])
            {
                $faq_text .= "
					<input  type='text' class='helpbox' id='helpb' name='helpb' size='70' style='width:100%'/><br />" . display_help("helpb");
            }
            $faq_text .= "
				</td>
			</tr>
			<tr>
				<td class='forumheader3' style='width:20%' >" . FAQ_ADLAN_119 . "</td>
				<td class='forumheader3' style='width:80%'>
					<a style='cursor: pointer; cursor: hand' onclick=\"expandit(this);\">" . FAQ_IMGLAN_03 . "</a>
					<div style='display: none;'>
						<div id='up_container' >
							<span id='upline' style='white-space:nowrap'>
								<input class='tbox' type='file' name='faq_gfile[]' size='70%' />\n
							</span>
						</div>
						<table style='width:100%'>
							<tr>
								<td>
									<input type='button' class='button' value='" . FAQ_IMGLAN_01 . "' onclick=\"duplicateHTML('upline','up_container');\"  />
								</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
			<tr>
        		<td class='forumheader3'  style='width:20%; vertical-align:top'>" . FAQ_ADLAN_52 . "</td>";
            if (!is_numeric($faq_comment))
            {
                $faq_comment = $FAQ_PREF['faq_defcomments'];
            }
            $faq_text .= "
				<td class='forumheader3' >" . r_userclass("faq_comment", $faq_comment, "off", "public,guest,nobody,member,admin,main,classes") . "</td>
            </tr>";
             $faq_user = explode(".", $faq_author, 2);
             $faq_userid = $faq_user[0];
            $faq_text .= "

			<tr>
				<td class='forumheader3'>" . FAQ_ADLAN_127 . "</td>
				<td class='forumheader3'><input type='text' id='faq_username' name='faq_author' class='tbox' value='" . $tp->toFORM($faq_user[1]) . "' onkeyup='ajax_showOptions(this,\"\",event)' /></td>
			</tr>
			<tr>
				<td class='forumheader3'>" . FAQ_ADLAN_130 . "</td>
				<td class='forumheader3'>
					<input type='checkbox' class='tbox' style='border:0;' value='1' name='faq_approved' " . ($faq_approved > 0?"checked='checked'":"") . " />
				</td>
			</tr>
			<tr>
			 	<td class='forumheader3'>" . FAQ_ADLAN_138 . "</td>
				<td class='forumheader3'>
					<input type='checkbox' class='tbox' style='border:0;' value='1' name='faq_pviews'  />
				</td>
			</tr>
			<tr>
			 	<td class='forumheader3'>" . FAQ_ADLAN_136 . "</td>
				 <td class='forumheader3'>
					<input type='checkbox' class='tbox' style='border:0;' value='1' name='faq_pcomments'  />
				</td>
			</tr>
			<tr>
			 	<td class='forumheader3'>" . FAQ_ADLAN_137 . "</td>
				 <td class='forumheader3'>
					<input type='checkbox' class='tbox' style='border:0;' value='1' name='faq_prating'  />
				</td>
			</tr>
			<tr>
				<td class='forumheader' colspan='2' style='text-align:center'>";
            if ($action == "sub")
            {
                $faq_text .= "<input class='button' type='submit' name='faq_insert_entry' value='" . FAQ_ADLAN_54 . "' />";
            }
            else
            {
                $faq_text .= "<input class='button' type='submit' name='faq_update_entry' value='" . FAQ_ADLAN_53 . "$faq_id' />
            	<input type='hidden' name='faq_id' value='$from' /> ";
            }

            $faq_text .= "<input type='hidden' name='faq' value='$faq' />
        		</td>
        	</tr>
        </table>
	</form>
</div>";
            $sql->db_Select("faq_info", "*", "faq_info_id='" . intval($id) . "'");
            $row = $sql->db_Fetch();
            extract($row);
        }
        $faq_text.="<script type='text/javascript'>
		var ajaxBox_offsetX = 0;
		var ajaxBox_offsetY =0;
		var ajax_list_externalFile = \"" . SITEURL . $PLUGINS_DIRECTORY . "faq/getusername.php\"; // Path to external file
		var minimumLettersBeforeLookup = 3; // Number of letters entered before a lookup is performed.
	</script>
	<script type='text/javascript' src='".e_PLUGIN."faq/includes/js/ajax.js' >	</script>
	<script type='text/javascript' src='".e_PLUGIN."faq/includes/js/ajax-dynamic-list.js' ></script>";
        $ns->tablerender(" <b>$faq_info_title</b> " . FAQ_ADLAN_88 . "# $faq_id", $faq_text);
    }
} // end class.

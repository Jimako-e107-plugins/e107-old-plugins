<?php
/*
+---------------------------------------------------------------+
|        Portfolio manager for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
require_once(e_PLUGIN . "portfolio/includes/portfolio_class.php");
if (!is_object($portfolio_obj))
{
    $portfolio_obj = new portfolio;
}
require_once(e_PLUGIN . "portfolio/includes/portfolio_shortcodes.php");
require_once(e_HANDLER . "rate_class.php");
$rater = new rater;
require_once(e_HANDLER . "ren_help.php");
if ($portfolio_obj->portfolio_vote && isset($pref['plug_installed']['vote']) && (file_exists(e_THEME . "vote_portfolio_template.php") || file_exists(e_PLUGIN . "portfolio/templates/vote_portfolio_template.php")))
{
    if (file_exists(e_THEME . "vote_portfolio_template.php"))
    {
        define(PORTFOLIO_THEME, e_THEME . "vote_portfolio_template.php");
    }
    else
    {
        define(PORTFOLIO_THEME, e_PLUGIN . "portfolio/templates/vote_portfolio_template.php");
    }
}
else
{
    if (file_exists(e_THEME . "portfolio_template.php"))
    {
        define(PORTFOLIO_THEME, e_THEME . "portfolio_template.php");
    }
    else
    {
        define(PORTFOLIO_THEME, e_PLUGIN . "portfolio/templates/portfolio_template.php");
    }
}
// define("PAGE_NAME", $PORTFOLIO_PREF['portfolio_caption']);
if (!empty($PORTFOLIO_PREF['portfolio_metadesc']) && !defined("META_DESCRIPTION"))
{
    define("META_DESCRIPTION", $PORTFOLIO_PREF['portfolio_metadesc']);
}
if (!empty($PORTFOLIO_PREF['portfolio_metakey']) && !defined("META_KEYWORDS"))
{
    define("META_KEYWORDS", $PORTFOLIO_PREF['portfolio_metakey']);
}
// Check that valid user class to do this if not tell them
if (!check_class($PORTFOLIO_PREF['portfolio_userclass']))
{
    require_once(HEADERF);
    $ns->tablerender(PORTFOLIO_3, PORTFOLIO_2);
    require_once(FOOTERF);
    exit;
}
require_once(e_HANDLER . "comment_class.php");
$portfolio_cobj = new comment;
$portfolio_gen = new convert;
// $portfolio_action = "list";
$portfolio_from = 0;
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $portfolio_from = intval($_POST['portfolio_from']);
    $portfolio_action = $_POST['portfolio_action'];
    $portfolio_id = intval($_POST['portfolio_id']);
} elseif (e_QUERY)
{
    $tmp = explode(".", e_QUERY);
    $portfolio_from = intval($tmp[0]);
    $portfolio_action = $tmp[1];
    $portfolio_id = intval($tmp[2]);
}
$portfolio_upviews = true;
if (isset($_POST['commentsubmit']))
{
    $portfolio_upviews = false;
    $tmp = explode(".", e_QUERY);
    $portfolio_from = intval($tmp[0]);
    $portfolio_action = "show";
    $portfolio_id = intval($tmp[2]);
    $portfolio_cobj->enter_comment($_POST['author_name'], $_POST['comment'], "portfolio", $portfolio_id, $pid, $_POST['subject']);
}
if ($portfolio_action == 'show' && $portfolio_id == 0)
{
    $portfolio_action = '';
}
// require_once(HEADERF);
if (isset($_POST['portfolio_delete']))
{
    // $sql->db_Select("portfolio_person", "*", "where portfolio_person_id=$portfolio_id", "nowhere", false);
    // extract($sql->db_Fetch());
    // $portfolio_tmp = explode(".", $portfolio_person_poster, 2);
    if (!$portfolio_obj->portfolio_super)
    {
        // not permitted
        require_once(HEADERF);
        require_once(PORTFOLIO_THEME);
        $portfolio_text .= $tp->parseTemplate($PORTFOLIO_NODELETE, false, $portfolio_shortcodes);
    }
    else
    {
        // confirm deletion
        $sql->db_Delete("portfolio_person", "portfolio_person_id=$portfolio_id", false);
        $sql->db_Delete("rate", "rate_itemid=$portfolio_id and rate_table='portfolio'", false);
        $sql->db_Delete("comments", "comment_item_id=$portfolio_id and comment_type='portfolio'", false);
    }
}
if ($portfolio_action == "delete")
{
    $sql->db_Select("portfolio_person", "*", "where portfolio_person_id={$portfolio_id}", "nowhere", false);
    extract($sql->db_Fetch());
    // $portfolio_tmp = explode(".", $portfolio_person_poster, 2);
    if (!$portfolio_obj->portfolio_super)
    {
        // not permitted
        require_once(HEADERF);
        require_once(PORTFOLIO_THEME);
        $portfolio_text .= $tp->parseTemplate($PORTFOLIO_NODELETE, false, $portfolio_shortcodes);
    }
    else
    {
        // confirm deletion
        require_once(HEADERF);
        require_once(PORTFOLIO_THEME);
        $portfolio_text .= "
<form method='post' action='" . e_SELF . "' id='portfolio_delete' >
	<div>
		<input type='hidden' name='portfolio_id' value='$portfolio_id' />
	</div>";
        $portfolio_text .= $tp->parseTemplate($PORTFOLIO_DELETE, false, $portfolio_shortcodes);
        $portfolio_text .= "
</form>";
    }
}

if (isset($_POST['portfolio_submit']))
{
    // print_a($_POST['portfolio_catlist']);
    print $portfolio_person_poster;
    if (empty($portfolio_person_poster))
    {
        $portfolio_person_poster = USERID . "." . USERNAME;
    }

    $portfolio_tmp = explode(".", $portfolio_person_poster, 2);
    $portfolio_uppath = e_PLUGIN . "portfolio/uploads/portfolio/" . $portfolio_tmp[0] . "/";
    if (!file_exists($portfolio_uppath))
    {
        mkdir($portfolio_uppath);

        $portfolio_fp = fopen($portfolio_uppath . "index.htm", "w+");
        fclose($portfolio_fp);
    }
    if ($sql->db_Select("portfolio_person", "*", "where portfolio_person_id=$portfolio_id", "nowhere", false))
    {
        extract($sql->db_Fetch());
        $portfolio_tmp = explode(".", $portfolio_person_poster, 2);

        $portfolio_uppath = e_PLUGIN . "portfolio/uploads/portfolio/" . $portfolio_tmp[0] . "/";
        // print $portfolio_person_poster;
        if (intval($_POST['portfolio_delattachment']) == 1)
        {
            unlink($portfolio_uppath . $portfolio_person_attachment);
            $portfolio_person_attachment = "~del~";
        }
        if (intval($_POST['portfolio_delete_portrait'][1]) == 1)
        {
            unlink($portfolio_uppath . $portfolio_person_portrait1);
            $portfolio_person_portrait1 = "~del~";
        }
        if (intval($_POST['portfolio_delete_portrait'][2]) == 1)
        {
            unlink($portfolio_uppath . $portfolio_person_portrait2);
            $portfolio_person_portrait2 = "~del~";
        }
        if (intval($_POST['portfolio_delete_portrait'][3]) == 1)
        {
            unlink($portfolio_uppath . $portfolio_person_portrait3);
            $portfolio_person_portrait3 = "~del~";
        }
        if (intval($_POST['portfolio_delete_gallery'][1]) == 1)
        {
            unlink($portfolio_uppath . $portfolio_person_gallery1);
            $portfolio_person_gallery1 = "~del~";
        }

        if (intval($_POST['portfolio_delete_gallery'][2]) == 1)
        {
            unlink($portfolio_uppath . $portfolio_person_gallery2);
            $portfolio_person_gallery2 = "~del~";
        }
        if (intval($_POST['portfolio_delete_gallery'][3]) == 1)
        {
            unlink($portfolio_uppath . $portfolio_person_gallery3);
            $portfolio_person_gallery3 = "";
        }
        if (intval($_POST['portfolio_delete_gallery'][4]) == 1)
        {
            unlink($portfolio_uppath . $portfolio_person_gallery4);
            $portfolio_person_gallery4 = "";
        }
        if (intval($_POST['portfolio_delete_gallery'][5]) == 1)
        {
            unlink($portfolio_uppath . $portfolio_person_gallery5);
            $portfolio_person_gallery5 = "";
        }
        if (intval($_POST['portfolio_delete_gallery'][6]) == 1)
        {
            unlink($portfolio_uppath . $portfolio_person_gallery6);
            $portfolio_person_gallery6 = "";
        }

        $portfolio_uploaderrors = array(
            UPLOAD_ERR_INI_SIZE => PORTFOLIO_ERR_01,
            UPLOAD_ERR_FORM_SIZE => PORTFOLIO_ERR_02,
            UPLOAD_ERR_PARTIAL => PORTFOLIO_ERR_03,
            UPLOAD_ERR_NO_FILE => PORTFOLIO_ERR_04,
            UPLOAD_ERR_NO_TMP_DIR => PORTFOLIO_ERR_06,
            UPLOAD_ERR_CANT_WRITE => PORTFOLIO_ERR_07,
            UPLOAD_ERR_EXTENSION => PORTFOLIO_ERR_08,
            );
        // do deletions if necessary can only do them if a record exists
    }
    require_once(e_HANDLER . "upload_handler.php");
    // Upload attachment
    if (isset($_FILES['portfolio_person_attachment']['name'][0]))
    {
        $portfolio_fileoptions = array('filetypes' => false, 'extra_file_types' => $PORTFOLIO_PREF['portfolio_extnattach'], 'max_upload_size' => $PORTFOLIO_PREF['portfolio_maxattach'] . "k", 'file_array_name' => 'portfolio_person_attachment', 'overwrite' => true);
        $portfolio_upresult = process_uploaded_files($portfolio_uppath, false, $portfolio_fileoptions);
    }
    foreach($portfolio_upresult as $portfolio_row)
    {
        if ($portfolio_row['error'] == 0)
        {
            $portfolio_person_attachment = $portfolio_row['name'];
            $portfolio_msg .= PORTFOLIO_ERR_20 . " <b>" . $portfolio_person_attachment . "</b> " . PORTFOLIO_ERR_21 . "<br />";
        }
        else
        {
            $portfolio_msg .= $portfolio_row['message'];
        }
    }
    // Upload portraits
    // print_a($_FILES['portfolio_person_portrait']);
    if (isset($_FILES['portfolio_person_portrait']['name']))
    {
        $portfolio_fileoptions = array('filetypes' => false, 'extra_file_types' => $PORTFOLIO_PREF['portfolio_extnimage'], 'max_upload_size' => $PORTFOLIO_PREF['portfolio_maximage'] . "k", 'file_array_name' => 'portfolio_person_portrait', 'overwrite' => true);
        $portfolio_upresult = process_uploaded_files($portfolio_uppath, false, $portfolio_fileoptions);
    }
    // print_a($portfolio_upresult);
    foreach($portfolio_upresult as $portfolio_row)
    {
        // print_a($portfolio_row);
        // print_a($portfolio_row);
        if ($portfolio_row['error'] == 0)
        {
            if ($portfolio_row['index'] == 1)
            {
                $portfolio_person_portrait1 = $portfolio_row['name'];
            }
            if ($portfolio_row['index'] == 2)
            {
                $portfolio_person_portrait2 = $portfolio_row['name'];
            }
            if ($portfolio_row['index'] == 3)
            {
                $portfolio_person_portrait3 = $portfolio_row['name'];
            }
            // $portfolio_person_attachment = $portfolio_row['rawname'];
            $portfolio_msg .= PORTFOLIO_ERR_22 . " <b>" . $portfolio_person_attachment . "</b> " . PORTFOLIO_ERR_21 . "<br />";
        }
        else
        {
            $portfolio_msg .= $portfolio_row['message'];
        }
    }
    // upload gallery
    if (isset($_FILES['portfolio_person_gallery']['name']))
    {
        $portfolio_fileoptions = array('filetypes' => false, 'extra_file_types' => $PORTFOLIO_PREF['portfolio_extnimage'], 'max_upload_size' => $PORTFOLIO_PREF['portfolio_maximage'] . "k", 'file_array_name' => 'portfolio_person_gallery', 'overwrite' => true);
        $portfolio_upresult = process_uploaded_files($portfolio_uppath, false, $portfolio_fileoptions);
    }

    foreach($portfolio_upresult as $portfolio_row)
    {
        // print_a($portfolio_row);
        if ($portfolio_row['error'] == 0)
        {
            switch ($portfolio_row['index'])
            {
                case 1:
                    $portfolio_person_gallery1 = $portfolio_row['name'];
                    break;
                case 2:
                    $portfolio_person_gallery2 = $portfolio_row['name'];
                    break;
                case 3:
                    $portfolio_person_gallery3 = $portfolio_row['name'];
                    break;
                case 4:
                    $portfolio_person_gallery4 = $portfolio_row['name'];
                    break;
                case 5:
                    $portfolio_person_gallery5 = $portfolio_row['name'];
                    break;
                case 6:
                    $portfolio_person_gallery6 = $portfolio_row['name'];
                    break;
            }

            $portfolio_msg .= PORTFOLIO_ERR_23 . " <b>" . $portfolio_person_attachment . "</b> " . PORTFOLIO_ERR_21 . "<br />";
        }
        else
        {
            $portfolio_msg .= $portfolio_row['message'];
        }
    }

    $portfolio_person_cat = implode(",", $_POST['portfolio_catlist']);
    // print $portfolio_msg;
    if ($portfolio_id == 0)
    {
        $portfolio_new_arg = "0,
    '" . $tp->toDB($_POST['portfolio_person_name']) . "',
    '" . USERID . "." . USERNAME . "',
    '" . $tp->toDB($_POST['portfolio_person_contact']) . "',
    '" . $tp->toDB($_POST['portfolio_person_phone']) . "',
    '" . $tp->toDB($_POST['portfolio_person_email']) . "',
    '" . $tp->toDB($_POST['portfolio_person_websiteurl']) . "',
    '" . $tp->toDB($_POST['portfolio_person_websitename']) . "',
    '" . $tp->toDB($_POST['portfolio_person_affiliate1']) . "',
    '" . $tp->toDB($_POST['portfolio_person_affiliateurl1']) . "',
    '" . $tp->toDB($_POST['portfolio_person_affiliate2']) . "',
    '" . $tp->toDB($_POST['portfolio_person_affiliateurl2']) . "',
    '" . $tp->toDB($_POST['portfolio_person_affiliate3']) . "',
    '" . $tp->toDB($_POST['portfolio_person_affiliateurl3']) . "',
    '" . $tp->toDB($_POST['portfolio_person_biography']) . "',
    '" . $tp->toDB($_POST['portfolio_person_additional']) . "',
    '" . $tp->toDB($_POST['portfolio_person_comments']) . "',
    '" . $tp->toDB($portfolio_person_portrait1) . "',
 	'" . $tp->toDB($_POST['portfolio_person_portraittext1']) . "',
    '" . $tp->toDB($portfolio_person_portrait2) . "',
 	'" . $tp->toDB($_POST['portfolio_person_portraittext2']) . "',
    '" . $tp->toDB($portfolio_person_portrait3) . "',
 	'" . $tp->toDB($_POST['portfolio_person_portraittext3']) . "',
    '" . $tp->toDB($portfolio_person_gallery1) . "',
 	'" . $tp->toDB($_POST['portfolio_person_gallerytext1']) . "',
    '" . $tp->toDB($portfolio_person_gallery2) . "',
 	'" . $tp->toDB($_POST['portfolio_person_gallerytext2']) . "',
    '" . $tp->toDB($portfolio_person_gallery3) . "',
 	'" . $tp->toDB($_POST['portfolio_person_gallerytext3']) . "',
    '" . $tp->toDB($portfolio_person_gallery4) . "',
 	'" . $tp->toDB($_POST['portfolio_person_gallerytext4']) . "',
    '" . $tp->toDB($portfolio_person_gallery5) . "',
 	'" . $tp->toDB($_POST['portfolio_person_gallerytext5']) . "',
    '" . $tp->toDB($portfolio_person_gallery6) . "',
 	'" . $tp->toDB($_POST['portfolio_person_gallerytext6']) . "',
 	'" . $tp->toDB($_POST['portfolio_person_videolink']) . "',
 	'" . $tp->toDB($_POST['portfolio_person_videolinktext']) . "',
 	    '" . $tp->toDB($portfolio_person_attachment) . "',
 	'" . $tp->toDB($portfolio_person_cat) . "',
 	'" . time() . "',
 	'" . time() . "',
 	'0',
 	'" . intval($_POST['portfolio_person_show']) . "',
 	'" . intval($_POST['portfolio_person_showemail']) . "',
 	'" . intval($_POST['portfolio_person_showphone']) . "',
 	'0',
 	'0',
 	''";
        $portfolio_id = $sql->db_Insert("portfolio_person", $portfolio_new_arg, false);
        $edata_sn = array("itemid" => $portfolio_id, "user" => USERNAME, "biography" => $_POST['portfolio_person_biography'], "itemtitle" => $_POST['portfolio_person_name']);
        $e_event->trigger("portfolio_new", $edata_sn);
        if (is_object($gold_obj) && $gold_obj->gold_plugins['portfolio'] == 1 && $PORTFOLIO_PREF['portfolio_goldpost'] > 0)
        {
            // *	Parameters	: 	$gold_param['gold_user_id'] (default no user)
            // *				: 	$gold_param['gold_who_id'] (default no user)
            // *				:	$gold_param['gold_amount'] (default no amount)
            // *				:	$gold_param['gold_type'] (default "adjustment")
            // *				:	$gold_param['gold_action'] 	credit - add to account
            // *												debit - subtract from account
            // *				:	$gold_param['gold_plugin'] (default no plugin)
            // *				:	$gold_param['gold_log'] (default "")
            // *				:	$gold_param['gold_forum'] (default 0)
            $gold_param['gold_user_id'] = USERID;
            $gold_param['gold_who_id'] = 0;
            $gold_param['gold_amount'] = $PORTFOLIO_PREF['portfolio_goldpost'];
            $gold_param['gold_type'] = PORTFOLIO_GOLD_07;
            $gold_param['gold_plugin'] = 'portfolio';
            $gold_param['gold_action'] = 'debit';
            $gold_param['gold_log'] = PORTFOLIO_GOLD_08 . ' ' . $_POST['portfolio_person_name'];
            $gold_param['gold_forum'] = 0;
            $gold_obj->gold_modify($gold_param);
        }
    }
    else
    {
        $portfolio_new_arg = "
    portfolio_person_name = '" . $tp->toDB($_POST['portfolio_person_name']) . "',
    portfolio_person_contact = '" . $tp->toDB($_POST['portfolio_person_contact']) . "',
    portfolio_person_phone = '" . $tp->toDB($_POST['portfolio_person_phone']) . "',
    portfolio_person_email = '" . $tp->toDB($_POST['portfolio_person_email']) . "',
    portfolio_person_websiteurl = '" . $tp->toDB($_POST['portfolio_person_websiteurl']) . "',
    portfolio_person_websitename = '" . $tp->toDB($_POST['portfolio_person_websitename']) . "',
    portfolio_person_affiliate1 = '" . $tp->toDB($_POST['portfolio_person_affiliate1']) . "',
    portfolio_person_affiliateurl1 = '" . $tp->toDB($_POST['portfolio_person_affiliateurl1']) . "',
    portfolio_person_affiliate2 = '" . $tp->toDB($_POST['portfolio_person_affiliate2']) . "',
    portfolio_person_affiliateurl2 = '" . $tp->toDB($_POST['portfolio_person_affiliateurl2']) . "',
    portfolio_person_affiliate3 = '" . $tp->toDB($_POST['portfolio_person_affiliate3']) . "',
    portfolio_person_affiliateurl3 = '" . $tp->toDB($_POST['portfolio_person_affiliateurl3']) . "',
    portfolio_person_biography = '" . $tp->toDB($_POST['portfolio_person_biography']) . "',
    portfolio_person_additional = '" . $tp->toDB($_POST['portfolio_person_additional']) . "',
    portfolio_person_comments = '" . $tp->toDB($_POST['portfolio_person_comments']) . "',
	portfolio_person_portraittext1 = '" . $tp->toDB($_POST['portfolio_person_portraittext1']) . "',
 	portfolio_person_portraittext2 = '" . $tp->toDB($_POST['portfolio_person_portraittext2']) . "',
 	portfolio_person_portraittext3 = '" . $tp->toDB($_POST['portfolio_person_portraittext3']) . "',
 	portfolio_person_gallerytext1 = '" . $tp->toDB($_POST['portfolio_person_gallerytext1']) . "',
 	portfolio_person_gallerytext2 = '" . $tp->toDB($_POST['portfolio_person_gallerytext2']) . "',
 	portfolio_person_gallerytext3 = '" . $tp->toDB($_POST['portfolio_person_gallerytext3']) . "',
 	portfolio_person_gallerytext4 = '" . $tp->toDB($_POST['portfolio_person_gallerytext4']) . "',
 	portfolio_person_gallerytext5 = '" . $tp->toDB($_POST['portfolio_person_gallerytext5']) . "',
 	portfolio_person_gallerytext6 = '" . $tp->toDB($_POST['portfolio_person_gallerytext6']) . "',
 	portfolio_person_videolink = '" . $tp->toDB($_POST['portfolio_person_videolink']) . "',
 	portfolio_person_videolinktext = '" . $tp->toDB($_POST['portfolio_person_videolinktext']) . "',
 	portfolio_person_cat = '" . $tp->toDB($portfolio_person_cat) . "',
 	portfolio_person_show = '" . intval($_POST['portfolio_person_show']) . "',
 	portfolio_person_showemail= '" . intval($_POST['portfolio_person_showemail']) . "',
 	portfolio_person_showphone = '" . intval($_POST['portfolio_person_showphone']) . "',	";
        if (!empty($portfolio_person_portrait1))
        {
            if ($portfolio_person_portrait1 == "~del~")
            {
                $portfolio_new_arg .= "portfolio_person_portrait1 = '',";
            }
            else
            {
                $portfolio_new_arg .= "portfolio_person_portrait1 = '" . $tp->toDB($portfolio_person_portrait1) . "',";
            }
        }
        if (!empty($portfolio_person_portrait2))
        {
            if ($portfolio_person_portrait2 == "~del~")
            {
                $portfolio_new_arg .= "portfolio_person_portrait2 = '',";
            }
            else
            {
                $portfolio_new_arg .= "portfolio_person_portrait2 = '" . $tp->toDB($portfolio_person_portrait2) . "',";
            }
        }
        if (!empty($portfolio_person_portrait3))
        {
            if ($portfolio_person_portrait3 == "~del~")
            {
                $portfolio_new_arg .= "portfolio_person_portrait3 = '',";
            }
            else
            {
                $portfolio_new_arg .= "portfolio_person_portrait3 = '" . $tp->toDB($portfolio_person_portrait3) . "',";
            }
        }

        if (!empty($portfolio_person_gallery1))
        {
            if ($portfolio_person_gallery1 == "~del~")
            {
                $portfolio_new_arg .= "portfolio_person_gallery1 = '',";
            }
            else
            {
                $portfolio_new_arg .= "portfolio_person_gallery1 = '" . $tp->toDB($portfolio_person_gallery1) . "',";
            }
        }
        if (!empty($portfolio_person_gallery2))
        {
            if ($portfolio_person_gallery2 == "~del~")
            {
                $portfolio_new_arg .= "portfolio_person_gallery2 = '',";
            }
            else
            {
                $portfolio_new_arg .= "portfolio_person_gallery2 = '" . $tp->toDB($portfolio_person_gallery2) . "',";
            }
        }
        if (!empty($portfolio_person_gallery3))
        {
            if ($portfolio_person_gallery3 == "~del~")
            {
                $portfolio_new_arg .= "portfolio_person_gallery3 = '',";
            }
            else
            {
                $portfolio_new_arg .= "portfolio_person_gallery3 = '" . $tp->toDB($portfolio_person_gallery3) . "',";
            }
        }
        if (!empty($portfolio_person_gallery4))
        {
            if ($portfolio_person_gallery4 == "~del~")
            {
                $portfolio_new_arg .= "portfolio_person_gallery4 = '',";
            }
            else
            {
                $portfolio_new_arg .= "portfolio_person_gallery4 = '" . $tp->toDB($portfolio_person_gallery4) . "',";
            }
        }
        if (!empty($portfolio_person_gallery5))
        {
            if ($portfolio_person_gallery5 == "~del~")
            {
                $portfolio_new_arg .= "portfolio_person_gallery5 = '',";
            }
            else
            {
                $portfolio_new_arg .= "portfolio_person_gallery5 = '" . $tp->toDB($portfolio_person_gallery5) . "',";
            }
        }
        if (!empty($portfolio_person_gallery6))
        {
            if ($portfolio_person_gallery6 == "~del~")
            {
                $portfolio_new_arg .= "portfolio_person_gallery6 = '',";
            }
            else
            {
                $portfolio_new_arg .= "portfolio_person_gallery6 = '" . $tp->toDB($portfolio_person_gallery6) . "',";
            }
        }
        if (!empty($portfolio_person_attachment))
        {
            if ($portfolio_person_attachment == "~del~")
            {
                $portfolio_new_arg .= "portfolio_person_attachment = '',";
            }
            else
            {
                $portfolio_new_arg .= "portfolio_person_attachment = '" . $tp->toDB($portfolio_person_attachment) . "',";
            }
        }

        $portfolio_new_arg .= "
    portfolio_person_updated = '" . time() . "'
	where portfolio_person_id= $portfolio_id";
        $sql->db_Update("portfolio_person", $portfolio_new_arg, false);
        $edata_sn = array("itemid" => $portfolio_id, "user" => USERNAME, "biography" => $_POST['portfolio_person_biography'], "itemtitle" => $_POST['portfolio_person_name']);
        $e_event->trigger("portfolio_update", $edata_sn);
    }
    // print_a($portfolio_upresult);
    $portfolio_action = "list";
}

if ($portfolio_action == "list" || $portfolio_action == "")
{
    $cache_tag = "portfoliolist";
    if ($cacheData = $e107cache->retrieve($cache_tag))
    {
        $portfolio_text .= $cacheData;
    }
    else
    {
        define("PAGE_NAME", PORTFOLIO_56 . " : ");
        require_once(HEADERF);
        require_once(PORTFOLIO_THEME);
        $sql3 = new db;
        $portfolio_text .= $tp->parseTemplate($PORTFOLIO_LIST_HEADER, false, $portfolio_shortcodes);
        // $portfolio_total = $sql->db_Count("portfolio_cat", "(*)", "where portfoliocat_parent=0");
        // List all people
        $portfolio_arg = "
		SELECT a.portfoliocat_id, a.portfoliocat_name,a.portfoliocat_description,a.portfoliocat_parent,count(b.portfoliocat_id) as num
 		FROM #portfolio_cat as a
		left join #portfolio_cat as b  on a.portfoliocat_id = b.portfoliocat_parent
		where a.portfoliocat_parent=0
		group by a.portfoliocat_id
 		order by a.portfoliocat_order";
        $portfolio_text .= $tp->parseTemplate($PORTFOLIO_LIST_PROJECT_HEADER, true, $portfolio_shortcodes);
        if ($sql->db_Select_gen($portfolio_arg, false))
        {
            while ($portfolio_row = $sql->db_Fetch())
            {
                $portfolio_text .= $tp->parseTemplate($PORTFOLIO_LIST_PROJECT_DETAIL, true, $portfolio_shortcodes);

                if ($portfolio_obj->portfolio_show)
                {
                    $portfolio_arg = "
                SELECT portfoliocat_id, portfoliocat_name, portfoliocat_description FROM #portfolio_cat
				where portfoliocat_parent = '" . $portfolio_row['portfoliocat_id'] . "'
				order by portfoliocat_order asc";
                    if ($sql2->db_Select_gen($portfolio_arg, false))
                    {
                        $portfolio_text .= $tp->parseTemplate($PORTFOLIO_LIST_SUB_HEADER, true, $portfolio_shortcodes);
                        while ($portfolio_row2 = $sql2->db_Fetch())
                        {
                            $portfolio_count = $sql3->db_Count("portfolio_person", "(*)", "where find_in_set(" . $portfolio_row2['portfoliocat_id'] . ",portfolio_person_cat)", false);
                            $portfolio_text .= $tp->parseTemplate($PORTFOLIO_LIST_SUB_DETAIL, true, $portfolio_shortcodes);
                        }
                    }
                    else
                    {
                        $portfolio_text .= $tp->parseTemplate($PORTFOLIO_LIST_NOITEM, true, $portfolio_shortcodes);
                    }
                }
                else
                {
                    // $portfolio_arg = "
                    // SELECT portfoliocat_id, portfoliocat_name, portfoliocat_description FROM #portfolio_cat
                    // where portfoliocat_parent = '" . $portfolio_row['portfoliocat_id'] . "'
                    // order by portfoliocat_order asc";
                    // if ($sql2->db_Select_gen($portfolio_arg, false))
                    // {
                    // $portfolio_text .= $tp->parseTemplate($PORTFOLIO_LIST_SUB_HEADER, true, $portfolio_shortcodes);
                    // while ($portfolio_row2 = $sql2->db_Fetch())
                    // {
                    // $portfolio_count = $sql3->db_Count("portfolio_person", "(*)", "where find_in_set(" . $portfolio_row2['portfoliocat_id'] . ",portfolio_person_cat)", false);
                    $sql->db_Select_gen("
						 select distinct portfolio_person_id from #portfolio_person
						 where  find_in_set(" . $portfolio_row['portfoliocat_id'] . ",portfolio_person_cat)", false);
                    $portfolio_text .= $tp->parseTemplate($PORTFOLIO_LIST_SUB_DETAIL, true, $portfolio_shortcodes);
                    // }
                    // }
                    // else
                    // {
                    // $portfolio_text .= $tp->parseTemplate($PORTFOLIO_LIST_NOITEM, true, $portfolio_shortcodes);
                    // }
                }
            }
        }
        else
        {
            $portfolio_text .= $tp->parseTemplate($PORTFOLIO_LIST_NOITEM, true, $portfolio_shortcodes);
        }
        // $action = "list";
        // $parms = $portfolio_total . "," . $portfolio_obj->portfolio_perpage . "," . $portfolio_from . "," . e_SELF . '?' . "[FROM]." . $action;
        // $portfolio_nextprev = $tp->parseTemplate("{NEXTPREV={$parms}}") . "";
        $portfolio_text .= $tp->parseTemplate($PORTFOLIO_LIST_FOOTER, true, $portfolio_shortcodes);
        $e107cache->set($cache_tag, $portfolio_text);
    }
}

if ($portfolio_obj->portfolio_post && ($portfolio_action == "new" || $portfolio_action == "edit"))
{
    if (is_object($gold_obj) && $portfolio_action == "new" && $gold_obj->gold_plugins['portfolio'] == 1 && $PORTFOLIO_PREF['portfolio_goldpost'] > 0 && $PORTFOLIO_PREF['portfolio_goldpost'] > $gold_obj->gold_balance(USERID))
    {
        require_once(HEADERF);
        require_once(PORTFOLIO_THEME);
        $portfolio_text = PORTFOLIO_GOLD_12 . ' ' . $gold_obj->formation($gold_obj->gold_balance(USERID)) . ' ' . PORTFOLIO_GOLD_14;
    }
    else
    {
        $portfolio_cap1 = ($portfolio_action == "new"?PORTFOLIO_ED_001:PORTFOLIO_ED_002);
        $portfolio_text .= "
<script type='text/javascript'>
<!--
function portfolio_check()
{
var retval=true;
var portfolio_multi=document.getElementById('portfolio_catlist').selectedIndex;
var portfolio_name=document.getElementById('portfolio_person_name').value;
if (portfolio_name=='')
{
	alert('" . PORTFOLIO_ED_048 . "');
	retval=false;
}
if(portfolio_multi<1)
{
	alert('" . PORTFOLIO_ED_049 . "');
	retval=false;
}
return retval;
}
function portfolio_images()
{
	document.getElementById('portfolio_detailtab').style.display='';
	document.getElementById('portfolio_imagetab').style.display='none';
	document.getElementById('portfolio_detailbutton').disabled=true;
	document.getElementById('portfolio_imagebutton').disabled=false;
}

function portfolio_details()
{
	document.getElementById('portfolio_detailtab').style.display='none';
	document.getElementById('portfolio_imagetab').style.display='';
	document.getElementById('portfolio_detailbutton').disabled=false;
	document.getElementById('portfolio_imagebutton').disabled=true;
}

-->
</script>
<form id='dataform' method='post' action='" . e_SELF . "' enctype='multipart/form-data' onsubmit=\"return portfolio_check()\">
	<div>
		<input type='hidden' value='$portfolio_id' name='portfolio_id' />
		<input type='hidden' value='save' name='portfolioaction' />
	</div>";
        require_once(HEADERF);
        require_once(PORTFOLIO_THEME);
        if ($portfolio_id > 0)
        {
            $sql->db_Select("portfolio_person", "*", "where portfolio_person_id=$portfolio_id", "nowhere", false);
            extract($sql->db_Fetch());
            $portfolio_tmp = explode(".", $portfolio_person_poster, 2);
            $portfolio_path = $portfolio_tmp[0];
        }
        $portfolio_text .= $tp->parseTemplate($PORTFOLIO_EDIT_PERSON, false, $portfolio_shortcodes);
        $portfolio_text .= "
</form>";
    }
}
if ($portfolio_action == "proj")
{
    $cache_tag = "portfolioproj";
    if ($cacheData = $e107cache->retrieve($cache_tag))
    {
        $portfolio_text .= $cacheData;
    }
    else
    {
        // This has sub people
        $portfolio_catfrom = $portfolio_from;
        $portfolio_count = $sql->db_Count("portfolio_cat", "(*)", "where portfoliocat_parent='$portfolio_id'", false);
        if ($portfolio_count > 0)
        {
            $sql->db_Select("portfolio_cat", "*", "where portfoliocat_parent='$portfolio_id' order by portfoliocat_order ", "nowhere", false);
            while ($portfolio_row = $sql->db_Fetch())
            {
                extract($portfolio_row);
                $portfolio_slist .= "<a href='?$portfolio_from.dept.$portfoliocat_id'>" . $tp->toHTML($portfoliocat_name, false) . "</a><br />";
            }
        }
        else
        {
            $portfolio_slist = PORTFOLIO_28;
        }
        $sql->db_Select("portfolio_cat", "*", "where portfoliocat_id='$portfolio_id' order by portfoliocat_order", "nowhere", false);
        extract($sql->db_Fetch());
        $portfolio_lu = $portfolio_gen->convert_date($portfoliocat_updated, "long");
        define("PAGE_NAME", PORTFOLIO_55 . " : " . $tp->toFORM($portfoliocat_name));
        require_once(HEADERF);
        require_once(PORTFOLIO_THEME);
        $portfolio_text .= $tp->parseTemplate($PORTFOLIO_DEPT_PROJ, false, $portfolio_shortcodes);
        $e107cache->set($cache_tag, $portfolio_text);
    }
}
if ($portfolio_action == "dept")
{
    // Show the portfolio with the staff
    $sql->db_Select("portfolio_cat", "*", "where portfoliocat_id='$portfolio_id'", "nowhere", false);
    $portfolio_row = $sql->db_Fetch();
    extract($portfolio_row);
    $portfolio_type = $portfolio_row['portfoliocat_parent'];
    // # Get Staff list
    $cache_tag = "portfoliodept";
    if ($cacheData = $e107cache->retrieve($cache_tag))
    {
        $portfolio_text .= $cacheData;
    }
    else
    {
        $portfolio_count = $sql->db_Count("portfolio_person", "(portfolio_person_id)", " where find_in_set($portfolio_id,portfolio_person_cat)", false);
        if ($sql->db_Select("portfolio_person", "portfolio_person_id,portfolio_person_name", " where find_in_set($portfolio_id,portfolio_person_cat) order by portfolio_person_name limit $portfolio_from," . $portfolio_obj->portfolio_perpage, "nowhere", false))
        {
            while ($portfolio_row = $sql->db_Fetch())
            {
                extract($portfolio_row);
                $portfolio_slist .= "<a href='?$portfolio_from.show.$portfolio_person_id'>" . $tp->toHTML($portfolio_person_name, false) . "</a><br />" .
                (!empty($portfolio_person_title)?$tp->toHTML($portfolio_person_title, false) . "<br /><br />":"<br />");
            }
        }
        else
        {
            $portfolio_slist = PORTFOLIO_5;
        }
        // $sql->db_Select("portfolio_cat", "*", "where portfoliocat_id='$portfolio_id' order by portfoliocat_order", "nowhere", false);
        // $portfolio_row = $sql->db_Fetch();
        // extract($portfolio_row);
        $action = "dept." . $portfolio_id;
        $parms = $portfolio_count . "," . $portfolio_obj->portfolio_perpage . "," . $portfolio_from . "," . e_SELF . '?' . "[FROM]." . $action;
        $portfolio_nextprev = $tp->parseTemplate("{NEXTPREV={$parms}}") . "";

        $portfolio_lu = $portfolio_gen->convert_date($portfoliocat_updated, "long");
        define("PAGE_NAME", PORTFOLIO_54 . " : " . $tp->toFORM($portfoliocat_name));
        require_once(HEADERF);
        require_once(PORTFOLIO_THEME);
        $portfolio_text = $tp->parseTemplate($PORTFOLIO_DEPT_STAFF, false, $portfolio_shortcodes);
        $e107cache->set($cache_tag, $portfolio_text);
    }
}

if ($portfolio_action == "show")
{
    if (is_object($gold_obj) && $gold_obj->gold_plugins['portfolio'] == 1 && $PORTFOLIO_PREF['portfolio_goldview'] > 0 && $PORTFOLIO_PREF['portfolio_goldview'] > $gold_obj->gold_balance(USERID))
    {
        define("PAGE_NAME", $PORTFOLIO_PREF['portfolio_caption'] . " : " . $tp->toFORM($portfolio_person_name));
        require_once(HEADERF);
        require_once(PORTFOLIO_THEME);
        $portfolio_text = PORTFOLIO_GOLD_12 . ' ' . $gold_obj->formation($gold_obj->gold_balance(USERID)) . ' ' . PORTFOLIO_GOLD_13;
    }
    else
    {
        $sql->db_Select("portfolio_person", "*", " portfolio_person_id='$portfolio_id'");
        $portfolio_row = $sql->db_Fetch();
        extract($portfolio_row);

        if ($portfolio_upviews)
        {
            // if we have not just posted a comment then update the number of views
            if (USER)
            {
                $portfolio_usercheck = USERID;
            }
            else
            {
                $portfolio_usercheck = $e107->getip();
            }
            $portfolio_person_uniquelist .= $portfolio_usercheck . ",";
            // update views and unique views
            $sql2->db_Update("portfolio_person", "portfolio_person_views=portfolio_person_views+1 where portfolio_person_id=$portfolio_id", false);
            $sql2->db_Update("portfolio_person", "portfolio_person_unique = portfolio_person_unique + 1,portfolio_person_uniquelist ='" . $portfolio_person_uniquelist . "' where portfolio_person_id='$portfolio_id' and (ISNULL(portfolio_person_uniquelist) or not find_in_set('$portfolio_usercheck',portfolio_person_uniquelist)) ", false);
            if (is_object($gold_obj) && $gold_obj->gold_plugins['portfolio'] == 1 && $PORTFOLIO_PREF['portfolio_goldpost'] > 0)
            {
                // *	Parameters	: 	$gold_param['gold_user_id'] (default no user)
                // *				: 	$gold_param['gold_who_id'] (default no user)
                // *				:	$gold_param['gold_amount'] (default no amount)
                // *				:	$gold_param['gold_type'] (default "adjustment")
                // *				:	$gold_param['gold_action'] 	credit - add to account
                // *												debit - subtract from account
                // *				:	$gold_param['gold_plugin'] (default no plugin)
                // *				:	$gold_param['gold_log'] (default "")
                // *				:	$gold_param['gold_forum'] (default 0)
                $gold_param['gold_user_id'] = USERID;
                $gold_param['gold_who_id'] = 0;
                $gold_param['gold_amount'] = $PORTFOLIO_PREF['portfolio_goldview'];
                $gold_param['gold_action'] = 'debit';
                $gold_param['gold_type'] = PORTFOLIO_GOLD_10;
                $gold_param['gold_plugin'] = 'portfolio';
                $gold_param['gold_log'] = PORTFOLIO_GOLD_09 . ' ' . $portfolio_person_name;
                $gold_param['gold_forum'] = 0;
                $gold_obj->gold_modify($gold_param);
            }
        }

        if ($ratearray = $rater->getrating("portfolio", $portfolio_id))
        {
            if (defined("IMODE"))
            {
                $portfolio_star = e_IMAGE . "rate/" . IMODE;
            }
            else
            {
                $image = $portfolio_star = e_IMAGE . "rate/lite";
            }
            for($c = 1;
                $c <= $ratearray[1];
                $c++)
            {
                $portfolio_view_rating .= "<img src='{$portfolio_star}/star.png' alt='' />";
            }
            if ($ratearray[2])
            {
                $portfolio_view_rating .= "<img src='{$portfolio_star}/" . $ratearray[2] . ".png'  alt='' />";
            }
            if ($ratearray[2] == "")
            {
                $ratearray[2] = 0;
            }
            $portfolio_view_rating .= "&nbsp;" . $ratearray[1] . "." . $ratearray[2] . " - " . $ratearray[0] . "&nbsp;";
            $portfolio_view_rating .= ($ratearray[0] == 1 ? PORTFOLIO_36 : PORTFOLIO_35);
        }
        else
        {
            $portfolio_view_rating .= PORTFOLIO_38;
        }

        if (!$rater->checkrated("portfolio", $portfolio_id) && USER)
        {
            $portfolio_view_rating .= $rater->rateselect("&nbsp;<b>" . PORTFOLIO_39, "portfolio", $portfolio_id) . "</b>";
        }
        else if (!USER)
        {
            $portfolio_view_rating .= "&nbsp;";
        }
        else
        {
            $portfolio_view_rating .= "&nbsp;&nbsp;" . PORTFOLIO_37;
        }
        $portfolio_view_rating .= "&nbsp;";

        $portfolio_tmp = explode(".", $portfolio_person_poster, 2);
        $portfolio_path = e_PLUGIN . "portfolio/uploads/portfolio/" . $portfolio_tmp[0] . "/";
        $portfolio_lu = $portfolio_gen->convert_date($portfolio_person_updated, "long");
        define("PAGE_NAME", $PORTFOLIO_PREF['portfolio_caption'] . " : " . $tp->toFORM($portfolio_person_name));
        require_once(HEADERF);
        require_once(PORTFOLIO_THEME);
        $portfolio_text = $tp->parseTemplate(PORTFOLIO_SHOW_HEADER($portfolio_person_id, $portfolio_person_name), false, $portfolio_shortcodes);
        // $portfolio_text .= $tp->parseTemplate($FAQ_LISTPARENT_FOOTER, false, $faq_shortcodes);
    }
}

$ns->tablerender($PORTFOLIO_PREF['portfolio_caption'], $portfolio_text);
require_once(FOOTERF);

?>
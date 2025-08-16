<?php
// **************************************************************************
// *
// *  Newslinks Menu for e107 v7
// *
// **************************************************************************
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
require_once(e_PLUGIN . "newslink/includes/newslink_class.php");
if (!is_object($newslink_obj))
{
    $newslink_obj = new newslink;
}
// get template
if (is_readable(THEME . "newslink_template.php"))
{
    define(NEWSLINK_THEME, THEME . "newslink_template.php");
}
else
{
    define(NEWSLINK_THEME, e_PLUGIN . "newslink/templates/newslink_template.php");
}
require_once(e_PLUGIN . "newslink/includes/newslink_shortcodes.php");
$e_wysiwyg = "newslink_body";
if ($NEWSLINK_PREF['wysiwyg'])
{
    $WYSIWYG = true;
    define(e_WYSIWYG, true);
}
else
{
    define(e_WYSIWYG, false);
}
// define the over ride meta tags
// define("e_PAGETITLE", NEWSLINK_A2);
if (!empty($NEWSLINK_PREF['newslink_metad']))
{
    define("META_DESCRIPTION", $NEWSLINK_PREF['newslink_metad']);
}
if (!empty($NEWSLINK_PREF['newslink_metak']))
{
    define("META_KEYWORDS", $NEWSLINK_PREF['newslink_metak']);
}
require_once(e_HANDLER . "rate_class.php");
$rater = new rater;
if (!is_object($newslink_secimg))
{
    $newslink_secimg = new secure_image;
}
if (!defined(IMODE))
{
    define(IMODE, "lite");
}
// *
$newslink_gen = new convert;

if (!$newslink_obj->newslink_reader)
{
    // Check that valid user class to do this if not tell them
    require_once(HEADERF);
    $newslink_text = "<table style='width:97%' class='fborder'>
	<tr><td class='fcaption'>" . NEWSLINK_1 . "</td></tr>
	<tr><td class='forumheader3'>" . NEWSLINK_2 . "</td></tr>
	<tr><td class='fcaption'><a href='" . SITEURL . "index.php'>" . NEWSLINK_66 . "</a></td></tr></table>";
    $ns->tablerender(NEWSLINK_1, $newslink_text);
    require_once(FOOTERF);
    exit;
}
$newslink_from = 0;
$newslink_newslinkcat = 0;
$newslink_newslinkid = 0;
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $newslink_from = intval($_POST['newslink_from']);
    $newslink_action = $_POST['newslink_action'];
    $newslink_newslinkid = intval($_POST['newslink_newslinkid']);
    $newslink_newslinkcat = intval($_POST['newslink_newslinkcat']);
    $newslink_newslinkorder = intval($_POST['newslink_newslinkorder']);
} elseif (e_QUERY)
{
    $tmp = explode(".", e_QUERY);
    $newslink_from = intval($tmp[0]);
    $newslink_action = $tmp[1];
    $newslink_newslinkid = intval($tmp[2]);
    $newslink_newslinkcat = intval($tmp[3]);
    $newslink_newslinkorder = intval($tmp[4]);
}
$newslink_newslinkorder = (is_numeric($newslink_newslinkorder)?$newslink_newslinkorder:$NEWSLINK_PREF['newslink_deforder']);
$newslink_action = (empty($newslink_action)?"show":$newslink_action);

if ($_POST['newslink_select'] > 0)
{
    $newslink_newslinkcat = $_POST['newslink_select'];
    $newslink_from = 0;
}

if (isset($_POST['newslink_submit']))
{
    // form submitted
    if (USER)
    {
        $newslink_username = USERID . "." . USERNAME;
    }
    else
    {
        $newslink_username = (empty($_POST['newslink_username'])?"Anon":$_POST['newslink_username']);
        $newslink_username = "0." . $newslink_username ;
    }

    $newslink_approved = ($newslink_obj->newslink_autoapprove?1:0);
    if ((!USER && $NEWSLINK_PREF['newslink_captcha'] > 0) && (!$newslink_secimg->verify_code($_POST['newslink_rand_num'], $_POST['newslink_code_verify'])))
    {
        // invalid captcha
        $newslink_submsg = NEWSLINK_132;
        $newslink_action = "submit";
    }
    else
    {
        if ($sql->db_Select("newslink_newslink", "newslink_id", "where newslink_name='" . $tp->toDB($_POST['newslink_name']) . "' and newslink_body='" . $tp->toDB($_POST['newslink_body']) . "'", "nowhere", false))
        {
            $newslinkubmitted .= NEWSLINK_122;
        }
        else
        {
            $newslink_args = "
		'0',
		'" . $tp->toDB($_POST['newslink_name']) . "',
		'" . $tp->toDB($_POST['newslink_link']) . "',
		'" . $tp->toDB($newslink_username) . "',
		'" . $tp->toDB($_POST['newslink_body']) . "',
		'" . $_POST['newslink_select'] . "',
		'" . $newslink_approved . "',
		'" . time() . "',0,'',0";
            $newslink_newid = $sql->db_Insert("newslink_newslink", $newslink_args, false);
            if ($newslink_newid)
            {
                $newslink_sn = array("user" => USERNAME, "itemtitle" => $_POST['newslink_name'], "catid" => intval($newslink_newid));
                $e_event->trigger("newslinkpost", $newslink_sn);
                $newslinkubmitted = ($newslink_approved == 1?NEWSLINK_121:NEWSLINK_18);
            }
            else
            {
                $newslinkubmitted = NEWSLINK_19 ;
            }
            $newslink_action = "show";
        }
    }
}
// case "edit":
if ($newslink_action == "submit")
{
    if ($newslink_obj->newslink_creator || ($newslink_newslinkid > 0 && $newslink_obj->newslink_ownedit))
    {
        // Check that valid user class to do this if not tell them
        if ($newslink_newslinkid > 0)
        {
            $sql->db_Select("newslink_newslink", "*", "where newslink_id=$newslink_newslinkid", "nowhere", false);
            $newslink_row = $sql->db_Fetch();
            extract($newslink_row);
        }
        require_once(NEWSLINK_THEME);
        $newslink_text .= $tp->parseTemplate($NEWSLINK_NEWSLINKSUBMIT_PRE, false, $newslink_shortcodes);
        $newslink_text .= "
				<script type=\"text/javascript\">
			function newslinkcheckform(thisform)
			{
				var testresults=true;
				if (thisform.newslink_username.value=='' || thisform.newslink_name.value=='' || thisform.newslink_link.value=='' || thisform.newslink_body.value=='' )
				{
					alert('" . NEWSLINK_65 . "');
					testresults=false;
				}
				if (testresults)
				{
					if (thisform.subbed.value=='no')
	  				{
						thisform.subbed.value='yes';
				   		testresults=true;
					}
					else
					{
		   				alert('" . NEWSLINK_64 . "');
				   		return false;
			   		}
				}
				return testresults;
			}
		</script>

			<form id='dataform' action='" . e_SELF . "' method='post' onsubmit='return newslinkcheckform(this)'>
			<div>
				<input type='hidden' name='newslink_from' value='$newslink_from' />
				<input type='hidden' name='newslink_newslinkid' value='$newslink_newslinkid' />
				<input type='hidden' name='newslink_newslinkcat' value='$newslink_newslinkcat' />
				<input type='hidden' name='newslink_rand_num' value='" . $newslink_secimg->random_number . "' />
				<input type='hidden' name='subbed' value='no' />
				<input type='hidden' name='newslink_action' value='submitit' />
			</div>";
			$newslink_newslinkcat=$_POST['newslink_select'];
        $newslink_text .= $tp->parseTemplate($NEWSLINK_NEWSLINKSUBMIT_FORM, false, $newslink_shortcodes);
        $newslink_text .= "</form>";
        $newslink_text .= $tp->parseTemplate($NEWSLINK_NEWSLINKSUBMIT_POST, false, $newslink_shortcodes);
    }
    else
    {
        require_once(HEADERF);
        $newslink_text = "
				<table style='" . USER_WIDTH . "'  class='fborder'>
					<tr>
						<td class='fcaption'>" . NEWSLINK_1 . "</td>
					</tr>
					<tr>
						<td class='forumheader3'>" . NEWSLINK_67 . "</td>
					</tr>
					<tr>
						<td class='fcaption'><a href='" . SITEURL . "index.php'>" . NEWSLINK_66 . "</a></td>
					</tr>
				</table>";
        $ns->tablerender(NEWSLINK_1, $newslink_text);
        require_once(FOOTERF);
        exit;
    }
}
if ($newslink_action == "view")
{
    $sql->db_Update("newslink_newslink", "newslink_views=newslink_views+1 where newslink_id=$newslink_newslinkid", false);
    if (USER)
    {
        $newslink_vlist = USERID ;
    }
    else
    {
        $newslink_vlist = $e107->getip() ;
    }
    $newslink_vlisting = $newslink_ . ",";
    $sql->db_Update("newslink_newslink", "newslink_unique=newslink_unique+1,
	newslink_viewer=if(newslink_viewer,concat(newslink_viewer,'{$newslink_vlisting}'),'{$newslink_vlisting}')
	where (isnull(newslink_viewer) or not find_in_set('{$cwriter_vlist}',newslink_viewer))  and newslink_id=$newslink_newslinkid", false);
    $newslink_arg = "select * from #newslink_newslink left join #newslink_category on newslink_category_id=newslink_category where newslink_id='$newslink_newslinkid' and find_in_set(newslink_category_read,'" . USERCLASS_LIST . "')";
    require_once(NEWSLINK_THEME);
    $newslink_text .= $tp->parseTemplate($NEWSLINK_NEWSLINKSHOW_PRE , false, $newslink_shortcodes);
    if ($sql->db_Select_gen($newslink_arg))
    {
        $newslink_row = $sql->db_Fetch();
        extract($newslink_row);
        $newslink_text .= $tp->parseTemplate($NEWSLINK_NEWSLINKSHOW_HEADER, true, $newslink_shortcodes);
    }
    else
    {
        $newslink_text .= $tp->parseTemplate($NEWSLINK_NEWSLINKSHOW_NONE, true, $newslink_shortcodes);
    }
    $newslink_text .= $tp->parseTemplate($NEWSLINK_NEWSLINKSHOW_POST, false, $newslink_shortcodes);
}
if ($newslink_action == "show")
{
    global $newslink_desc;
    $newslink_desc = "";
    $newslink_text .= "
<form id='dataform'  action='" . e_SELF . "' method='post'>
	<div>
		<input type='hidden' name='newslink_from' value='$newslink_from' />
		<input type='hidden' name='newslink_newslinkid' value='$newslink_newslinkid' />
		<input type='hidden' name='newslink_newslinkorder' value='$newslink_newslinkorder' />
	</div>";
    require_once(NEWSLINK_THEME);
    $newslink_text .= $tp->parseTemplate($NEWSLINK_LIST_TABLE, false, $newslink_shortcodes);
    // Switch to determine sort order
    // 1 sorts on the poster name using the substring_index in mysql to determine the poster name
    // 2 sorts on the posted/last edited date most recent first
    // 0 or none specified sorts on the newslink name
    if ($newslink_newslinkcat > 0)
    {
        $newslink_argcat = " and newslink_category='$newslink_newslinkcat'";
    }

    $newslink_text .= $tp->parseTemplate($NEWSLINK_NEWSLINKLIST_SORT, false, $newslink_shortcodes);
    switch ($newslink_newslinkorder)
    {
        case "1":
            $newslink_arg = "select *,substring_index(newslink_author,'.',-1) as newslinkord from #newslink_newslink
					left join #newslink_category on newslink_category=newslink_category_id
					where  newslink_approved >0 $newslink_argcat and find_in_set(newslink_category_read,'" . USERCLASS_LIST . "') order by newslink_category_name  asc limit $newslink_from," . $NEWSLINK_PREF['newslink_perpage'];
            break;
        case "2":
            $newslink_arg = "select * from #newslink_newslink
					left join #newslink_category on newslink_category=newslink_category_id
					where newslink_approved >0 $newslink_argcat and find_in_set(newslink_category_read,'" . USERCLASS_LIST . "') order by newslink_posted desc limit $newslink_from," . $NEWSLINK_PREF['newslink_perpage'];
            break;
        default: ;
            $newslink_arg = "select * from #newslink_newslink
					left join #newslink_category on newslink_category=newslink_category_id
					where newslink_approved >0 $newslink_argcat and find_in_set(newslink_category_read,'" . USERCLASS_LIST . "') order by newslink_name asc limit $newslink_from," . $NEWSLINK_PREF['newslink_perpage'];
    } // switch
    if ($sql->db_Select_gen($newslink_arg))
    {
        while ($newslink_row = $sql->db_Fetch())
        {
            extract($newslink_row);
            if (substr($newslink_link, 0, 4) != "http")
            {
                $newslink_link = "http://" . $newslink_link;
            }
            $newslink_linkurl = "<a href='" . $newslink_link . "' rel='external'>" . $tp->toFORM($newslink_name) . "</a>";
            $newslink_text .= $tp->parseTemplate($NEWSLINK_NEWSLINKLIST_LIST, false, $newslink_shortcodes);
        } // while
    }
    else
    {
        $newslink_text .= $tp->parseTemplate($NEWSLINK_NEWSLINKLIST_NONEWSLINK, false, $newslink_shortcode);
    }
    $newslink_text .= $tp->parseTemplate($NEWSLINK_NEWSLINKLIST_FOOTER, false, $newslink_shortcode);
    $newslink_text .= "
</form>";
}
if ($newslink_newslinkcat == 0)
{
    $newslink_category_name = NEWSLINK_119;
}

$newslink_menu_title = NEWSLINK_A2 . ": " . NEWSLINK_96 . " - " . $newslink_category_name;
define("e_PAGETITLE", $newslink_menu_title);
require_once(HEADERF);
$ns->tablerender(NEWSLINK_1, $newslink_text);
require_once(FOOTERF);

?>
<?php
if (!defined('e107_INIT'))
{
    exit;
}
include_once(e_HANDLER . 'shortcode_handler.php');
global $newslink_shortcodes, $tp;
$newslink_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
/*
SC_BEGIN NEWSLINK_MANAGE
global $newslink_obj;
if (USER && ($newslink_obj->newslink_ownedit || $newslink_obj->newslink_admin))
{
	$retval = "<a href='".e_PLUGIN."newslink/manage_newslink.php' >".NEWSLINK_124."</a>";
}
elseif ($newslink_obj->newslink_creator )
{
	$retval = "<a href='".e_SELF."?0.submit' >".NEWSLINK_11."</a>";
}
else
{
	$retval="";
}
return $retval;
SC_END

SC_BEGIN NEWSLINK_CAT_SEL
global $row, $tp, $sql, $newslink_desc, $newslink_desc, $newslink_newslinkcat,$newslink_catcount;

$newslink_desc = NEWSLINK_109;
$newslink_catcount=0;
$newslink_selcat = "<select class='tbox' name='newslink_select' ";
$newslink_selcat .= ($parm == "nosubmit"?"":" onchange='this.form.submit()' ");
$newslink_selcat .= ">";
if ($sql->db_Select("newslink_category", "*", "where find_in_set(newslink_category_read,'" . USERCLASS_LIST . "') order by newslink_category_name", "nowhere"))
{
    if ($parm != "nosubmit")
    {
        $newslink_selcat .= "<option value='0' " . ($newslink_newslinkcat == 0?"selected='selected'":"") . ">" . NEWSLINK_108 . "</option>";
    }
    while ($newslink_row = $sql->db_Fetch())
    {
    	$newslink_catcount++;
        $newslink_selcat .= "<option value='" . $newslink_row['newslink_category_id'] . "'";
        $newslink_newslinkcat = ($newslink_newslinkcat > 0?$newslink_newslinkcat :0);
        // $newslink_selcat .= ($newslink_category_id == $newslink_newslinkcat?" selected='selected'":"");
        if ($newslink_row['newslink_category_id'] == $newslink_newslinkcat)
        {
            $newslink_selcat .= " selected='selected'";

            $newslink_desc = $newslink_row['newslink_category_description'];
        }
        $newslink_selcat .= ">" . $newslink_row['newslink_category_name'] . "</option>";
    } // while
}
else
{
    $newslink_selcat .= "<option value=''>" . NEWSLINK_4 . "</option>";
}
$newslink_selcat .= "</select>";
if ($newslink_newslinkcat == 0)
{
    $newslink_desc = NEWSLINK_109;
}
return $newslink_selcat;
SC_END

SC_BEGIN NEWSLINK_CAT_DESC
global $newslink_desc;
return $newslink_desc;
SC_END

SC_BEGIN NEWSLINK_CAT_NEWSLINK
global $newslink_newslinkorder, $newslink_from, $newslink_newslinkid, $newslink_newslinkcat, $newslink_newslinkorder;
switch ($newslink_newslinkorder)
{
    case 1:
        $retval = "<a href='?$newslink_from.show.$newslink_newslinkid.$newslink_newslinkcat.0' title='" . NEWSLINK_63 . NEWSLINK_60 . "' >  " . NEWSLINK_60 . "</a>";
        break;
    case 2:
        $retval = "<a href='?$newslink_from.show.$newslink_newslinkid.$newslink_newslinkcat.0' title='" . NEWSLINK_63 . NEWSLINK_60 . "' >  " . NEWSLINK_60 . "</a>";
        break;
    case 0:
    default:
        $retval = "<strong>" . NEWSLINK_60 . "</strong>&nbsp;<img src='./images/darrow.gif' style='border:0;' alt='' />";
        break;
}
return $retval;
SC_END

SC_BEGIN NEWSLINK_CAT_NAMEHEAD
global $newslink_newslinkorder, $newslink_from, $newslink_newslinkid, $newslink_newslinkcat, $newslink_newslinkorder;

switch ($newslink_newslinkorder)
{
    case "1":
        $retval = "<strong>" . NEWSLINK_61 . "</strong>&nbsp;<img src='./images/darrow.gif' style='border:0;' alt='' />";
        break;
    case "2":
        $retval = "<a href='?$newslink_from.show.$newslink_newslinkid.$newslink_newslinkcat.1' title='" . NEWSLINK_63 . NEWSLINK_61 . "' >  " . NEWSLINK_61 . "</a>";
        break;
    default:
        $retval = "<a href='?$newslink_from.show.$newslink_newslinkid.$newslink_newslinkcat.1' title='" . NEWSLINK_63 . NEWSLINK_61 . "' >  " . NEWSLINK_61 . "</a>";
        break;
}
return $retval;

SC_END

SC_BEGIN NEWSLINK_CAT_DATE
global $newslink_newslinkorder, $newslink_from, $newslink_newslinkid, $newslink_newslinkcat, $newslink_newslinkorder;
switch ($newslink_newslinkorder)
{
    case "1":
        $retval = "<a href='?$newslink_from.show.$newslink_newslinkid.$newslink_newslinkcat.2' title='" . NEWSLINK_63 . NEWSLINK_62 . "' >  " . NEWSLINK_62 . "</a>";
        break;
    case "2":
        $retval = "<strong>" . NEWSLINK_62 . "</strong>&nbsp;<img src='./images/darrow.gif' style='border:0;' alt='' />";
        break;
    default:
        $retval = "<a href='?$newslink_from.show.$newslink_newslinkid.$newslink_newslinkcat.2' title='" . NEWSLINK_63 . NEWSLINK_62 . "' >  " . NEWSLINK_62 . "</a>";
        break;
}
return $retval;

SC_END

SC_BEGIN NEWSLINK_CAT_RATEING
global $newslink_id,$newslink_newslinkid, $rater, $NEWSLINK_PREF;
if ($NEWSLINK_PREF['newslink_rating'] < 0)
{
if ($ratearray = $rater->getrating("newslink", $newslink_id))
{

    for($c = 1; $c <= $ratearray[1]; $c++)
    {
        $newslink_view_rating .= "<img src='images/star.png' alt='' />";
    }
    if ($ratearray[2])
    {
        $newslink_view_rating .= "<img src='images/" . $ratearray[2] . ".png'  alt='' />";
    }
    if ($ratearray[2] == "")
    {
        $ratearray[2] = 0;
    }
    $newslink_view_rating .= "&nbsp;" . $ratearray[1] . "." . $ratearray[2] . " - " . $ratearray[0] . "&nbsp;";
    $newslink_view_rating .= ($ratearray[0] == 1 ? NEWSLINK_89 : NEWSLINK_88);
}
else
{
$newslink_view_rating .= " " . NEWSLINK_87;
}

if (strtolower($parm) != "none" && USER)
{
    if (!$rater->checkrated("newslink", $newslink_id) )
    {
 	    #$newslink_view_rating .= " " . NEWSLINK_87;
 	    $newslink_view_rating .= $rater->rateselect("<br /><b>" . NEWSLINK_85, "newslink", $newslink_id) . "</b>";

    }
    else
    {
		$newslink_view_rating .= "<br />" . NEWSLINK_86;
    }

}
else
{
$newslink_view_rating .= "&nbsp;";
}
}
else{
$newslink_view_rating="";
}
return $newslink_view_rating;
SC_END

SC_BEGIN NEWSLINK_CAT_NEWSLINKLIST_NP
global $tp, $newslink_newslinkid, $newslink_from, $newslink_newslinkcat, $newslink_newslinkorder, $sql, $NEWSLINK_PREF,$newslink_catcount;

if ($newslink_newslinkcat > 0 || $newslink_catcount==1)
{
    $newslink_argcat = " and newslink_category='$newslink_newslinkcat'";
}

$newslink_count = $sql->db_Count("newslink_newslink", "(*)", " where newslink_approved > '0' $newslink_argcat");

$action = "show.$newslink_newslinkid.$newslink_newslinkcat.$newslink_newslinkorder";
$parms = $newslink_count . "," . $NEWSLINK_PREF['newslink_perpage'] . "," . $newslink_from . "," . e_SELF . '?' . "[FROM]." . $action;
return $tp->parseTemplate("{NEXTPREV={$parms}}");
SC_END

SC_BEGIN NEWSLINK_CAT_NEWSLINKLIST
global $newslink_linkurl;
return $newslink_linkurl;

SC_END
SC_BEGIN NEWSLINK_LINK_DESC
global $newslink_body;
return $newslink_body;
SC_END

SC_BEGIN NEWSLINK_CAT_NAME
global $tp,$newslink_category_name;
return $tp->toHTML($newslink_category_name,false);
SC_END

SC_BEGIN NEWSLINK_CAT_POSTLIST
global $tp, $newslink_author;
$newslink_poster = explode(".", $newslink_author);
$newslink_postername = $newslink_poster[1];
return $tp->toHTML($newslink_postername, false);
SC_END

SC_BEGIN NEWSLINK_CAT_DATELIST
global $newslink_posted, $newslink_gen;
$newslink_posted = $newslink_gen->convert_date($newslink_posted, $parm);
return $newslink_posted;
SC_END

SC_BEGIN NEWSLINK_CAT_SUBMIT
global $tp,$newslink_obj, $NEWSLINK_PREF,$newslink_id, $newslink_from, $newslink_newslinkcat, $newslink_newslinkorder;

if ($newslink_obj->newslink_creator  || $newslink_obj->newslink_ownedit || $newslink_obj->newslink_admin)
{
	if (($newslink_obj->newslink_creator &&  $newslink_obj->newslink_ownedit ||  $newslink_obj->newslink_admin)
	{
		return "<a href='manage_newslink.php'>" . NEWSLINK_124 . "</a>";
	}
	elseif ($newslink_obj->newslink_creator)
	{
		return "<a href='?$newslink_from.submit'>" . NEWSLINK_11 . "</a>";
	}
}
else
{
	return "&nbsp;";
}
SC_END

SC_BEGIN NEWSLINK_CAT_MSG
global $newslinkubmitted;
return $newslinkubmitted;
SC_END

SC_BEGIN NEWSLINK_SHOW_UP
global $tp, $newslink_newslinkid, $newslink_from, $newslink_newslinkcat, $newslink_newslinkorder;
return "<a href='?$newslink_from.show.$newslink_newslinkid.$newslink_newslinkcat.$newslink_newslinkorder'><img src='./images/updir.png' style='border:0;' alt='" . NEWSLINK_15 . "' title='" . NEWSLINK_15 . "' /></a>";
SC_END

SC_BEGIN NEWSLINK_SHOW_PRINT
global $tp, $newslink_id, $newslink_newslinkid;
return "<a href='../../print.php?plugin:newslink.$newslink_newslinkid' ><img src='" . e_IMAGE . "generic/" . IMODE . "/printer.png' style='border:0;' title='" . NEWSLINK_93 . "' alt='" . NEWSLINK_93 . "' /></a>";
SC_END

SC_BEGIN NEWSLINK_SHOW_EMAIL
global $tp, $newslink_id, $newslink_newslinkid;
return "<a href='../../email.php?plugin:newslink." . $newslink_newslinkid . "'><img src='" . e_IMAGE . "generic/" . IMODE . "/email.png' style='border:0' alt='" . NEWSLINK_94 . "' title='" . NEWSLINK_94 . "' /></a>";
SC_END

SC_BEGIN NEWSLINK_SHOW_NAME
global $tp, $newslink_name;
return $tp->toHTML($newslink_name, false);
SC_END

SC_BEGIN NEWSLINK_SHOW_BODY
global $tp, $newslink_body;
return $tp->toHTML($newslink_body, true);
SC_END

SC_BEGIN NEWSLINK_SHOW_POSTER
global $tp, $newslink_author;
$newslink_tmp = explode(".", $newslink_author);

return $tp->toHTML($newslink_tmp[1], false);
SC_END

SC_BEGIN NEWSLINK_SHOW_VIEWS
global $tp, $newslink_views;
return $tp->toHTML($newslink_views, false);
SC_END

SC_BEGIN NEWSLINK_SHOW_UNIQUE
global $tp, $newslink_unique;
return $tp->toHTML($newslink_unique, false);
SC_END


SC_BEGIN NEWSLINK_SUBMIT_RESULT
	global  $newslinkubmitted;
	return $newslinkubmitted;
SC_END

SC_BEGIN NEWSLINK_SUBMIT_POSTER
if (USER)
{
    $retval = USERNAME."<input type='hidden' name='newslink_username' value='".USERNAME."' />";
}
else
{
    $retval = "<input type='text' style='width:50%;' class='tbox' name='newslink_username' value='".$_POST['newslink_username']."' />";
}
return $retval;
SC_END

SC_BEGIN NEWSLINK_SUBMIT_NAME

return "<input type='text' size='60%' maxlength='50' class='tbox' name='newslink_name' value='" . $_POST['newslink_name'] . "' />";

SC_END

SC_BEGIN NEWSLINK_SUBMIT_LINK

return "<input type='text' size='80%' maxlength='150' class='tbox' name='newslink_link' value='" . $_POST['newslink_link'] . "' />";

SC_END

SC_BEGIN NEWSLINK_SUBMIT_BODY
global $tp, $NEWSLINK_PREF, $newslink_body, $BBCODE_TEMPLATE;

require_once(e_HANDLER . "ren_help.php");

$insertjs = (!$NEWSLINK_PREF['wysiwyg'])?"rows='10' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'":
"rows='20' style='width:100%' ";
$newslink_body = $tp->toForm($newslink_body);
$retval .= "<textarea class='tbox' id='newslink_body' name='newslink_body' cols='80'  style='width:95%' $insertjs>" . (strstr($newslink_body, "[img]http") ? $_POST['newslink_body'] : str_replace("[img]../", "[img]", $_POST['newslink_body'])) . "</textarea>";
if (!$NEWSLINK_PREF['wysiwyg'])
{
    $retval .= "
				<br />" . display_help("helpb", "comment");
}
return $retval;
SC_END

SC_BEGIN NEWSLINK_CONT_BUTTON
return "<input type='submit' class='tbox' name='newslink_submit' value='" . NEWSLINK_123 . "' />";
SC_END

SC_BEGIN NEWSLINK_SUBMIT_BUTTON
return "<input type='submit' class='tbox' name='newslink_submit' value='" . NEWSLINK_17 . "' />";
SC_END

SC_BEGIN NEWSLINK_RSS
global $newslink_newslinkcat, $PLUGINS_DIRECTORY;
$retval = NEWSLINK_112 . "&nbsp;";
if ($newslink_newslinkcat > 0)
{
    $newslink_rsscat = "." . $newslink_newslinkcat;
    $retval = NEWSLINK_113 . "&nbsp;";
}
$retval .= "<a href='" . e_BASE . $PLUGINS_DIRECTORY . "rss_menu/rss.php?newslink.1{$newslink_rsscat}'><img src='images/rss1.png' alt='RSS 1' title='RSS 1' style='border:0;' /></a>&nbsp;&nbsp;";
$retval .= "<a href='" . e_BASE . $PLUGINS_DIRECTORY . "rss_menu/rss.php?newslink.2{$newslink_rsscat}'><img src='images/rss2.png' alt='RSS 2' title='RSS 2' style='border:0;' /></a>&nbsp;&nbsp;";
$retval .= "<a href='" . e_BASE . $PLUGINS_DIRECTORY . "rss_menu/rss.php?newslink.3{$newslink_rsscat}'><img src='images/rss3.png' alt='RSS RDF' title='RSS RDF' style='border:0;' /></a>&nbsp;&nbsp;";
$retval .= "<a href='" . e_BASE . $PLUGINS_DIRECTORY . "rss_menu/rss.php?newslink.4{$newslink_rsscat}'><img src='images/rss4.png' alt='RSS ATOM' title='RSS ATOM' style='border:0;' /></a>";
return $retval;

SC_END

SC_BEGIN NEWSLINK_MENU_URL
global $newslink_linkurl;
return $newslink_linkurl;
SC_END

SC_BEGIN NEWSLINK_MENU_COUNT
global $newslink_newslinkcount;
return $newslink_newslinkcount;
SC_END

SC_BEGIN NEWSLINK_MENU_CATCOUNT
global $newslink_catcount;
return $newslink_catcount;
SC_END

SC_BEGIN NEWSLINK_MENU_BULLET
return "<img src='" . THEME . "images/bullet2.gif' alt='' />";
SC_END

SC_BEGIN NEWSLINK_MENU_BODY
global $tp,$newslink_body;
return $tp->toHTML($newslink_body, false);
SC_END

SC_BEGIN NEWSLINK_MENU_CATNAME
global $tp,$newslink_category_name;
return  $tp->toHTML($newslink_category_name, false);
SC_END

SC_BEGIN NEWSLINK_MENU_POSTERNAME
global $tp,$newslink_postername;
return $tp->toHTML($newslink_postername, false);
SC_END

SC_BEGIN NEWSLINK_MENU_POSTERNAME
global $tp,$newslink_postername;
return $tp->toHTML($newslink_postername, false);
SC_END

SC_BEGIN NEWSLINK_MENU_POSTED
global $tp,$newslink_posted;
return $tp->toHTML($newslink_posted, false);
SC_END

SC_BEGIN NEWSLINK_EDIT_SECURE
global $newslink_secimg,$NEWSLINK_PREF;
if (!USER && $NEWSLINK_PREF['newslink_captcha']>0)
{
	return "<br />".NEWSLINK_131 ." ".$newslink_secimg->r_image()."<input class='tbox' type='text' name='newslink_code_verify' size='15' maxlength='20' />";
}
else
{
	return "&nbsp;";
}
SC_END

SC_BEGIN NEWSLINK_SUBMIT_MSG
global $newslink_submsg;
return $newslink_submsg;
SC_END
*/
?>
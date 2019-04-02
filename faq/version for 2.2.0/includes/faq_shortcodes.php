<?php
include_once(e_HANDLER . 'shortcode_handler.php');
$faq_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);

if (!defined('IMODE')) {
   define("IMODE", "lite");
}

global $pref;
 
/*

SC_BEGIN FAQ_STATS_LINK
global $faq_obj;
if ($faq_obj->faq_viewstats)
{
	return "<a href='".e_PLUGIN."faq/faq_stats.php'>".FAQLAN_135."</a>";
}
else
{
	return "";
}
SC_END

SC_BEGIN FAQ_PDF
global $faq_id,$sql,$pref;
if ($pref['plug_installed'][pdf])
{
	return "<a href='".e_PLUGIN."pdf/pdf.php?plugin:faq.$faq_id'><img src='".e_PLUGIN."pdf/images/pdf_16.png' style='border:0;' alt='pdf' /></a>";
}
else
{
	return "";
}
SC_END

SC_BEGIN FAQ_MESSAGE
global $message;
return $message;
SC_END

SC_BEGIN FAQ_EDIT_USER
return "<input type='text' name='faq_submittedby' class='tbox' style='width:50%;' />";
SC_END

SC_BEGIN FAQ_LOGO
if (file_exists(e_PLUGIN."faq/images/faq_logo.png"))
{
	return "<img src='images/faq_logo.png' style='border:0;' alt='logo'/>";
}
else
{
	return "";
}
SC_END

SC_BEGIN FAQ_EDIT_CAPTION
global $idx;
return (is_numeric($idx)? FAQLAN_43." ".$idx: FAQLAN_59. FAQLAN_50);
SC_END

SC_BEGIN FAQ_EDIT_SUBMIT
    $retval = "<input class='button' type='submit' name='faq_submit' value='" . FAQ_ADLAN_53 ." '/>";
    return $retval;
SC_END

SC_BEGIN FAQ_EDIT_COMMENTS
global $faq_comment,$FAQ_PREF;
require_once(e_HANDLER . "userclass_class.php");
if (!is_numeric($faq_comment))
{
	$faq_comment = $FAQ_PREF['faq_defcomments'];
}
$retval = r_userclass("faq_comment", $faq_comment, "", "public,guest,nobody,member,admin,classes");
return $retval;
SC_END

SC_BEGIN FAQ_EDIT_PICTURE
$text ="<a style='cursor: pointer; cursor: hand' onclick='expandit(this);'>".FAQ_IMGLAN_03."</a>
		<div style='display: none;'>
				<div id='up_container' >
					<span id='upline' style='white-space:nowrap'>
						<input class='tbox' type='file' name='faq_gfile[]' size='70%' />\n
					</span>
				</div>";

			$text .="
				<table style='width:100%'>
					<tr>
						<td><input type='button' class='button' value='".FAQ_IMGLAN_01."' onclick=\"duplicateHTML('upline','up_container');\"  /></td>
						<td><input class='button' type='submit' name='submitupload' value='".FAQ_IMGLAN_02."' /></td>
					</tr>
				</table>
		</div>";
return $text;
SC_END

SC_BEGIN FAQ_EDIT_QUESTION
global $faq_question,$tp;
return "<input class='tbox' type='text' name='faq_question' style='width:90%;' value='".$tp->toFORM($faq_question)."'  />";
SC_END

SC_BEGIN FAQ_EDIT_ANSWER
global $tp,$pref,$FAQ_PREF,$faq_answer,$e_wysiwyg;
require_once(e_HANDLER . "ren_help.php");
$insertjs = ( (e107::getPref('wysiwyg',false) != false) )?"rows='10' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'":
            "rows='20' style='width:100%' ";
            $faq_answer = $tp->toForm($faq_answer);
            $retval .= "<textarea class='tbox' id='data' name='data' cols='80'  style='width:95%' $insertjs>" . (strstr($faq_answer, "[img]http") ? $faq_answer : str_replace("[img]../", "[img]", $faq_answer)) . "</textarea>";
            //  e107::wysiwyg() doesn't work BC issue?
						if ( (e107::getPref('wysiwyg',false) != false) )
            {
                $retval .= "
				<div style='text-align:left'>" . display_help("helpb","comment"). "</div>";
            }
return $retval;

SC_END

SC_BEGIN FAQ_EDIT_CATEGORY
global $tp,$sql,$faq_parent,$id,$faq_action,$faq_obj;
if ($faq_action=="new")
{
	$faq_sl=$id;
}
else
{
	$faq_sl=$faq_parent;
}
if ($faq_obj->faq_simple)
{
	// in simple mode only give the option for the available category
	$faq_where="and faq_info_id = ".$faq_obj->faq_simpleid;
}
else
{
	$faq_where="";
}
$retval = "<select  class='tbox' id='faq_parent' name='faq_parent' >";
    $sql->db_Select("faq_info", "*", "where faq_info_parent !='0' $faq_where and find_in_set(faq_info_class,'" . USERCLASS_LIST . "') ","nowhere",false);
    while ($prow = $sql->db_Fetch())
    {
        extract($row);
        $selected = $prow['faq_info_id'] == $faq_sl ? " selected='selected'" : "";
        $retval .= "<option value=\"" . $prow['faq_info_id'] . "\" $selected >" . $tp->toFORM($prow['faq_info_title']) . "</option>";
    }
    $retval .= " </select>";

    return $retval;
SC_END

SC_BEGIN FAQ_UPDIR
global $faq_obj,$faq_action,$faq_parent,$faq_from,$id,$idx,$faq_simple;
if ($faq_action=="edit" || $faq_action=="reedit")
{
	return "<a href='" . e_SELF . "?$faq_from.cat.$id.$idx.$faq_parent'><img src='./images/updir.png' alt='" . FAQLAN_46 . "' title='" . FAQLAN_46 . "' style='border:0;' /></a>";
}
if ($idx>0)
{
	return "<a href='" . e_SELF . "?$faq_from.cat.$faq_parent'><img src='./images/updir.png' alt='" . FAQLAN_46 . "' title='" . FAQLAN_46 . "' style='border:0;' /></a>";
}
else
{
	if (!$faq_obj->faq_simple)
	{
		return "<a href='" . e_SELF . "?0.main.$id'><img src='./images/updir.png' alt='" . FAQLAN_46 . "' title='" . FAQLAN_46 . "' style='border:0;' /></a>";
	}
	else
	{
		return"";
	}
}
SC_END

SC_BEGIN FAQ_ITEM_UNIQUE
global $faq_unique;
return $faq_unique;
SC_END

SC_BEGIN FAQ_ITEM_RATE
global $faq_rate_text;
return $faq_rate_text;
SC_END

SC_BEGIN FAQ_ITEM_VIEWS
global $faq_views;
return $faq_views;
SC_END

SC_BEGIN FAQ_ITEM_POSTED
global $faq_datestamp;
if(empty($parm))
{
	$parm='short';
}
if($faq_datestamp>0)
{
require_once(e_HANDLER . "date_handler.php");
$con = new convert;
return $con->convert_date($faq_datestamp, $parm);
}
else
{
return '';
}
SC_END

SC_BEGIN FAQ_ITEM_UPDATED
global $faq_updated,$faq_datestamp;
if(empty($parm))
{
	$parm='short';
}
if($faq_updated>0)
{
	require_once(e_HANDLER . "date_handler.php");
	$con = new convert;
	return $con->convert_date($faq_updated, $parm);
}
elseif($faq_datestamp>0)
{
	require_once(e_HANDLER . "date_handler.php");
	$con = new convert;
	return $con->convert_date($faq_datestamp, $parm);
}
{
return '';
}
SC_END

SC_BEGIN FAQ_ITEM_AUTHOR
global $faq_author;
$faq_tmp = explode(".", $faq_author,2);
if ($faq_tmp[0]>0)
{
	return "<a href='../../user.php?id.".$faq_tmp[0]."' >".$faq_tmp[1]."</a>";
}
else
{
	return $faq_tmp[1];
}
SC_END

SC_BEGIN FAQ_ITEM_QUESTION
global $tp, $faq_question;
return $tp->toHTML($faq_question, false, "no_make_clickable no_replace emotes_off");
SC_END

SC_BEGIN FAQ_ITEM_ANSWER
global $tp, $faq_answer;
return $tp->toHTML($faq_answer, true,"constants body");
SC_END
SC_BEGIN FAQ_ITEM_QICON
return "<img src='" . e_PLUGIN . "faq/images/q.png' alt='' />";
SC_END

SC_BEGIN FAQ_ITEM_AICON
return"<img src='" . e_PLUGIN . "faq/images/a.png' alt='' />";
SC_END

SC_BEGIN FAQ_ITEM_PRINT
global $idx;
return "<a href='../../print.php?plugin:faq.$idx' ><img src='" . e_IMAGE . "generic/" . IMODE . "/printer.png' style='border:0;' title='" . FAQLAN_60 . "' alt='" . FAQLAN_60 . "' /></a>";
SC_END

SC_BEGIN FAQ_ITEM_CAPTION
global $faq_id;
return "&nbsp;FAQ #" . $faq_id;
SC_END

SC_BEGIN FAQ_ITEM_EDIT
global $faq_obj,$faq_authid, $faq_from, $faq_parent, $faq_id;
if ($faq_obj->faq_super || ($faq_obj->faq_ownedit && $faq_authid == USERID))
{
    return "<a href='" . e_SELF . "?$faq_from.edit.$faq_parent." . $faq_id . "'><img src='" . e_IMAGE . "generic/" . IMODE . "/edit.png' style='border:0' alt='" . FAQLAN_43 . "' title='" . FAQLAN_43 . "' /></a>";
}
else
{
    return "";
}
SC_END

SC_BEGIN FAQ_EMAIL
global $faq_id,$faq_obj;
if ($faq_obj->faq_sendto)
{
    return "<a href='../../email.php?plugin:faq." . $faq_id . "'><img src='" . e_IMAGE . "generic/" . IMODE . "/email.png' style='border:0' alt='" . FAQLAN_68 . "' title='" . FAQLAN_68 . "' /></a>";
}
else
{
	return "";
}
SC_END

SC_BEGIN FAQ_NEXTPREV
global $faq_count, $FAQ_PREF, $faq_from, $tp, $id;
$faq_action = "cat.$id.";
$parms = $faq_count . "," . $FAQ_PREF['faq_perpage'] . "," . $faq_from . "," . e_SELF . '?' . "[FROM]." . $faq_action;

$faq_nextprev = $tp->parseTemplate("{NEXTPREV={$parms}}");
if (!empty($faq_nextprev))
{
    $retval = $faq_nextprev;
}
else
{
    $retval = "";
}
return $retval;

SC_END

SC_BEGIN FAQ_LIST_RATE
global $faq_view_rating;
return $faq_view_rating;
SC_END

SC_BEGIN FAQ_CAPTION
global $tp, $faq_cat_name;
$caption = FAQLAN_51 . ": " .$tp->toHTML($faq_cat_name,false, "no_make_clickable no_replace emotes_off") . "&nbsp;" ;
return $caption;
SC_END

SC_BEGIN FAQ_LIST_FAQ
global $res, $tp, $faq_question, $id, $faq_id, $faq_from;
if ($res > 0)
{
    return "<a href='" . e_SELF . "?$faq_from.cat.$id.$faq_id'>" . $tp->toHTML($faq_question, false, "no_make_clickable no_replace emotes_off") . "</a>";
}
else
{
    return FAQLAN_103;
}
SC_END

SC_BEGIN FAQ_LIST_FAQ_EXPAND_QUESTION
global $res, $tp, $faq_question, $id, $faq_id, $faq_from, $faq_answer;
$text = '

                    <a data-toggle="collapse" data-parent="#accordion"   href="#collapse'.$faq_id.'">'.$tp->toHTML($faq_question, false, "no_make_clickable no_replace emotes_off").'</a>
             
         
 
        ';
return $text;
SC_END

SC_BEGIN FAQ_LIST_FAQ_EXPAND_ANSWER
global $res, $tp, $faq_question, $id, $faq_id, $faq_from, $faq_answer;
 
 
$text = '
  <div id="collapse'.$faq_id.'" class="panel-collapse collapse in">
      <div class="panel-body">
       '.e107::getParser()->text_truncate($tp->toHTML($faq_answer, true, 'TITLE'), 100, '...') .'
      </div>
  </div>';
 
  
return $text;
SC_END

SC_BEGIN FAQ_LIST_FAQ_EXPAND_ANSWER_DETAIL
global $res, $tp, $faq_question, $id, $faq_id, $faq_from;
if ($res > 0)
{
    return "<a class='btn faq_detail_link' href='" . e_SELF . "?$faq_from.cat.$id.$faq_id'>" . LAN_READ_MORE . "</a>";
}
else
{
    return FAQLAN_103;
}
SC_END

SC_BEGIN FAQ_LIST_ICON
global $res;
if ($res > 0)
{
    return "<img src='" . e_PLUGIN . "faq/images/faq.png' style='border:0;' alt='' />";
}
else
{
    return "";
}
SC_END


SC_BEGIN FAQ_NEW
global $id, $FAQ_PREF,$faq_from;
if (check_class($FAQ_PREF['add_faq']))
{
    return "<a href=\"". e_PLUGIN ."faq/faq.php?$faq_from.new.{$id}\"><img src='./images/new.gif' style='border:0;' alt='" . FAQLAN_47 . "' title='" . FAQLAN_47 . "' /></a>";
}
else
{
    return "";
}
SC_END

SC_BEGIN FAQ_PARENT_TITLE
global $tp, $faq_info_title, $faq_info_about;

return ($faq_info_title ? $tp->toHTML($faq_info_title,false, "no_make_clickable no_replace emotes_off") : "[" . FAQLAN_102 . "]") ;

SC_END

SC_BEGIN FAQ_PARENT_CATICON
global $faq_info_icon,$faq_info_title,$tp;

if (empty($faq_info_icon))
{
	$faq_info_icon="faq.png";
}
return "<img src='" . e_PLUGIN . "faq/images/caticons/".$tp->toFORM($faq_info_icon)."' alt='".$tp->toFORM($faq_info_title)."' title='".$tp->toFORM($faq_info_title)."' />";

SC_END

SC_BEGIN FAQ_PARENT_ICON
global $faq_info_icon,$faq_info_title,$tp,$faq_info_id;

if (empty($faq_info_icon))
{
	$faq_info_icon="faq.png";
}
if ($parm=="link")
{
    return "<a href='".e_SELF."?0.cat.$faq_info_id' ><img src='" . e_PLUGIN . "faq/images/caticons/".$tp->toFORM($faq_info_icon)."' style='border:0;' alt='".$tp->toFORM($faq_info_title)."' title='".$tp->toFORM($faq_info_title)."' /></a>";
}
else
{
    return "<img src='" . e_PLUGIN . "faq/images/caticons/".$tp->toFORM($faq_info_icon)."' style='border:0;' alt='".$tp->toFORM($faq_info_title)."' title='".$tp->toFORM($faq_info_title)."' />";
}
SC_END

SC_BEGIN FAQ_PARENT_ABOUT
global $tp, $faq_from, $faq_info_id, $faq_info_title, $faq_info_about, $subparents;
if ($subparents)
{
    return $tp->toHTML($faq_info_about,false, "no_make_clickable no_replace emotes_off " );
}
else
{
	return "&nbsp;";
}

SC_END
SC_BEGIN FAQ_PARENT_FAQ
global $tp, $faq_from, $faq_info_id, $faq_info_title, $faq_info_about, $subparents,$cnt;
if ($subparents>0)
{
	if ($cnt==0)
	{
    	return $tp->toHTML($faq_info_title,false, "no_make_clickable no_replace emotes_off");
	}
	else
	{
    	return "<a href='" . e_SELF . "?0.cat.$faq_info_id' title='" . FAQLAN_78 . " " . $cnt . " " . FAQLAN_79 . "'  >" . ($faq_info_title ? $tp->toHTML($faq_info_title,false, "no_make_clickable no_replace emotes_off") : "[" . FAQLAN_102 . "]") . "</a>";
	}
}
else
{
    return FAQ_ADLAN_75;
}
SC_END

SC_BEGIN FAQ_PARENT_ABOUT
	global $faq_info_about;
	return $faq_info_about;
SC_END

SC_BEGIN FAQ_PARENT_COUNT
global $cnt, $subparents;
if ($subparents)
{
    return "$cnt";
}
else
{
    return "&nbsp;";
}
SC_END
*/
?>
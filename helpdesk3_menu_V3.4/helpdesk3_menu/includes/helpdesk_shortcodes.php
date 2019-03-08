<?php
include_once(e_HANDLER . 'shortcode_handler.php');
$hdu_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
/*
SC_BEGIN HDU_TITLE
global $tp, $HELPDESK_PREF;
return $tp->toHTML($HELPDESK_PREF['hduprefs_title'], false, "no_make_clickable emotes_off");
SC_END

SC_BEGIN HDU_MESSAGETOP
global $tp, $HELPDESK_PREF;
return $tp->toHTML($HELPDESK_PREF['hduprefs_messagetop'], true, 'no_make_clickable emotes_off');
SC_END

SC_BEGIN HDU_MESSAGE
global $hdu_savemsg;
return $hdu_savemsg;
SC_END

SC_BEGIN HDU_PHONE
global $tp, $HELPDESK_PREF;
if(!empty($HELPDESK_PREF['hduprefs_phone']))
{
	return HDU_102 . ' ' . $tp->toHTML($HELPDESK_PREF['hduprefs_phone'], false, 'no_make_clickable emotes_off');
}
else
{
	return '&nbsp;';
}
SC_END

SC_BEGIN HDU_FAQ
global $tp, $HELPDESK_PREF;
if(!empty($HELPDESK_PREF['hduprefs_faq']))
{
return "<a href='" . $tp->toHTML($HELPDESK_PREF['hduprefs_faq']) . "' >" . HDU_207 . "</a>";
}
else
{
	return '&nbsp;';
}
SC_END

SC_BEGIN HDU_NEWTICKET
global $helpdesk_obj,$show;
if ($helpdesk_obj->hdu_poster)
{
	return "<a href ='".e_PLUGIN."helpdesk3_menu/helpdesk.php?0.newticket.0' ><img src='./images/new.gif' style='border:0;' alt='' title='" . HDU_52 . "' /></a>";
}
else
{
	return;
}
SC_END

SC_BEGIN HDU_REPORTS
global $helpdesk_obj,$from,$id;
if ($helpdesk_obj->hdu_super || $helpdesk_obj->hdu_technician)
{
    return "<a href ='".e_PLUGIN."helpdesk3_menu/helpdesk.php?$from.repmenu.$id' ><img src='".e_PLUGIN."helpdesk3_menu/images/print.gif' style='border:0;' alt='' title='" . HDU_101 . "' /></a>";
}
SC_END

SC_BEGIN HDU_FILTER
global $hdu_filtselect;
return $hdu_filtselect;
SC_END

SC_BEGIN HDU_GOTOREC
global $hdu_goto;
return "<input type ='text' name ='goto' maxlength ='5' value ='" . $hdu_goto . "' size ='10' class ='tbox' />";
SC_END

SC_BEGIN HDU_DOFILTER
return "<input type ='submit' class='button' style='border:0;' name ='filterit' value ='" . HDU_74 . "' alt='" . HDU_74 . "' title='" . HDU_74 . "' />";
SC_END

SC_BEGIN HDU_TICKET_STATUS
global $hdu_imgtag;
return $hdu_imgtag;
SC_END

SC_BEGIN HDU_TICKET_ID
global $hdu_id;
return $hdu_id;
SC_END

SC_BEGIN HDU_TICKET_ID
global $hdu_id;
return $hdu_id;
SC_END

SC_BEGIN HDU_TICKET_SUMMARY
global $tp, $hdu_id, $hdu_summary,$from;
return "<a href ='".e_PLUGIN."helpdesk3_menu/helpdesk.php?$from.show." . $hdu_id  . "' > " . $tp->toFORM($hdu_summary) . "</a>";
SC_END

SC_BEGIN HDU_TICKET_POSTED
global $helpdesk_obj, $hdu_datestamp;
if ($hdu_datestamp>0)
{
	return date($parm,$hdu_datestamp);
}
else
{
	return "";
}
SC_END

SC_BEGIN HDU_TICKET_CATEGORY
global $hducat_category, $tp;
return $tp->toHTML($hducat_category, false);
SC_END

SC_BEGIN HDU_TICKET_POSTER
global $poster;
return $poster;
SC_END

SC_BEGIN HDU_TICKET_RESOLUTION
global $tp, $hdures_resolution,$hdures_help;
if(!empty($hdures_help))
{
$text_to_pop=$tp->toFORM($hdures_help);
return "<span style='border-bottom: 3px double;' onmouseout=\"hdu_hideTooltip()\" onmouseover=\"hdu_showTooltip(event,'" .$text_to_pop . "');return false\">".$tp->toHTML($hdures_resolution, false)."</span>";
}
else
{
return $tp->toHTML($hdures_resolution, false);
}
SC_END

SC_BEGIN HDU_TICKET_HELPDESK
global $tp, $hdudesk_name;
return $tp->toHTML($hdudesk_name, false);
SC_END

SC_BEGIN HDU_MESSAGEBOTTOM
global $tp, $HELPDESK_PREF;
return $tp->toHTML($HELPDESK_PREF['hduprefs_messagebottom'], false);
SC_END

SC_BEGIN HDU_RIGHTS
global $hdu_rights;
return $hdu_rights;
SC_END

SC_BEGIN HDU_NEXTPREV
global $hdu_nextprev;
return $hdu_nextprev;
SC_END

SC_BEGIN HDU_SHOW_ACTION
global $helpdesk_obj;
if ($helpdesk_obj->hdu_new)
{
	return "New Ticket";
}
else
{
	return "Edit ticket";
}
SC_END

SC_BEGIN HDU_PRIORITYCOLOUR
global $helpdesk_obj,$hdu_priority;
 return $helpdesk_obj->hduprefs_colours[$hdu_priority];
SC_END

SC_BEGIN HDU_SHOW_UPDIR
global $id, $R1,$from;
return "<a href='".e_PLUGIN."helpdesk3_menu/helpdesk.php?$from.list.$id'><img src='./images/updir.png' alt='" . HDU_73 . "' title='" . HDU_73 . "' style='border:0;' /></a>";
SC_END



SC_BEGIN HDU_SHOW_PRINT
global $helpdesk_obj, $id, $R1,$from;
if (!$helpdesk_obj->hdu_new)
{
    return "<a href='../../print.php?plugin:helpdesk3_menu.$id'><img src='" . e_IMAGE . "generic/" . IMODE . "/printer.png' alt='" . HDU_104 . "' title='" . HDU_104 . "' style='border:0;' /></a>";
}
SC_END


SC_BEGIN HDU_SHOW_EMAILLINK
global $helpdesk_obj, $id;
if (!$helpdesk_obj->hdu_new && (!$helpdesk_obj->hduprefs_posteronly || $helpdesk_obj->hdu_super))
{
    return "<a href='../../email.php?plugin:helpdesk3_menu.$id'><img src='" . e_IMAGE . "generic/" . IMODE . "/email.png' alt='" . HDU_255 . "' title='" . HDU_255 . "' style='border:0;' /></a>";
}
else
{
	return "";
}
SC_END


SC_BEGIN HDU_SHOW_PDF
global $helpdesk_obj, $id, $R1,$from;
if (!$helpdesk_obj->hdu_new )
{
    return "<a href='".e_PLUGIN."helpdesk3_menu/helpdesk.php?$from.print.$id'><img src='" . e_PLUGIN."helpdesk3_menu/images/pdf_16.png' alt='" . HDU_229 . "' title='" . HDU_229 . "' style='border:0;' /></a>";
}
else
{
	return "";
}
SC_END

SC_BEGIN HDU_SHOW_TABLIST
global $helpdesk_obj,$hdu_posterid;

$hdu_show=($helpdesk_obj->hduprefs_showfinance?1:0);
$hdu_comm=(!$helpdesk_obj->hdu_new && (USERID==$hdu_posterid || $helpdesk_obj->hduprefs_allread || $helpdesk_obj->hdu_super || $helpdesk_obj->hdu_technician)?1:0);
$retval = "<input type='button' disabled='disabled' class='button' onclick=\"hdu_show('ticket',$hdu_show,$hdu_comm);\" value='".HDU_247."' id='hdu_t' name='hdu_t' />&nbsp;";
if(!$helpdesk_obj->hdu_new || $helpdesk_obj->hdu_super || $helpdesk_obj->hdu_technician)
{
	$retval .= "<input type='button' class='button' onclick=\"hdu_show('details',$hdu_show,$hdu_comm);\" value='".HDU_246."' name='hdu_d' id='hdu_d'/>&nbsp;";
}
if ((!$helpdesk_obj->hdu_new || $helpdesk_obj->hdu_super || $helpdesk_obj->hdu_technician)&& $helpdesk_obj->hduprefs_showfinance)
{
	$retval.="<input type='button' class='button' onclick=\"hdu_show('finance',$hdu_show,$hdu_comm);\" value='".HDU_245."' id='hdu_f' name='hdu_f' />&nbsp;";
}
if (!$helpdesk_obj->hdu_new && (USERID==$hdu_posterid || $helpdesk_obj->hduprefs_allread || $helpdesk_obj->hdu_super || $helpdesk_obj->hdu_technician))
{
	$retval .= "<input type='button' class='button' onclick=\"hdu_show('comment',$hdu_show,$hdu_comm);\" value='".HDU_244."' name='hdu_c' id='hdu_c' />";
}
return $retval;
SC_END

SC_BEGIN HDU_SHOW_USER
global $helpdesk_obj, $tp, $hdu_sel_users, $hdupostername;

if ($helpdesk_obj->hdu_new && ($helpdesk_obj->hdu_super || $helpdesk_obj->hdu_technician))
{
    return $hdu_sel_users;
}
else
{
    return $tp->toHTML($hdupostername);
}

SC_END

SC_BEGIN HDU_SHOW_DATEPOSTED
global $helpdesk_obj, $hdu_datestamp;
if ($hdu_datestamp>0)
{
	return $helpdesk_obj->hduconvert_date->convert_date($hdu_datestamp);
}
else
{
	return "";
}
SC_END

SC_BEGIN HDU_SHOW_PRIORITY
global $helpdesk_obj, $hdu_priority;
if (!$helpdesk_obj->hdu_print &&( $helpdesk_obj->hdu_technician || $helpdesk_obj->hdu_new || $helpdesk_obj->hdu_super || $helpdesk_obj->quick))
{
    // If edit rights
    $retval .= "
    <select name='hdu_priority' class='tbox' onchange=\"changed()\">" .
    ($hdu_priority == "1"?"<option selected='selected' value='1'>" . HDU_137 . "</option>":"<option value='1'>" . HDU_137 . "</option>") .
    ($hdu_priority == "2"?"<option selected='selected' value='2'>" . HDU_138 . "</option>":"<option value='2'>" . HDU_138 . "</option>") .
    ($hdu_priority == "3"?"<option selected='selected' value='3'>" . HDU_139 . "</option>":"<option value='3'>" . HDU_139 . "</option>") .
    ($hdu_priority == "4"?"<option selected='selected' value='4'>" . HDU_140 . "</option>":"<option value='4'>" . HDU_140 . "</option>") .
    ($hdu_priority == "5"?"<option selected='selected' value='5'>" . HDU_141 . "</option>":"<option value='5'>" . HDU_141 . "</option>") . "</select>";
}
else
{
    // Not editing so just show the priority
    $retval .=
    ($hdu_priority == "1"?HDU_137:"") .
    ($hdu_priority == "2"?HDU_138:"") .
    ($hdu_priority == "3"?HDU_139:"") .
    ($hdu_priority == "4"?HDU_140:"") .
    ($hdu_priority == "5"?HDU_141:"") ;
}
return $retval;
SC_END

SC_BEGIN HDU_SHOW_SUMMARY
global $tp, $helpdesk_obj, $hdu_summary;
if (!$helpdesk_obj->hdu_print &&( $helpdesk_obj->hdu_technician || $helpdesk_obj->hdu_new || $helpdesk_obj->hdu_super || $helpdesk_obj->quick))
{
    $retval = "<input type='text'  onkeyup=\"changed()\" name='hdu_summary' class='tbox' value=\"" . $tp->toFORM($hdu_summary) . "\" style='width:90%;' maxlength='50' />";
}
else
{
    $retval = $tp->toHTML($hdu_summary, false);
}
return $retval;
SC_END

SC_BEGIN HDU_SHOW_CATEGORY
global $tp, $sql, $helpdesk_obj, $hdu_category;
if (!$helpdesk_obj->hdu_print &&( $helpdesk_obj->hdu_technician || $helpdesk_obj->hdu_new || $helpdesk_obj->hdu_super || $helpdesk_obj->quick))
{
    // If editing display select
    $retval = "<select class='tbox'  onchange=\"changed()\" name='hdu_category'><option value='0'>" . HDU_136 . "</option>";
    if ($sql->db_Select("hdu_categories", "hducat_id,hducat_category", " order by hducat_category", "nowhere"))
    {
        while ($hdu_catrow = $sql->db_Fetch())
        {
            extract($hdu_catrow);
            $retval .= "<option value='$hducat_id' " .
            ($hducat_id == $hdu_category?"selected='selected'":"") . ">" . $tp->toFORM($hducat_category) . "</option>";
        } // while
    }
    $retval .= "</select>";
}
else
{
    // otherwise just show the category (if any)
    if ($sql->db_Select("hdu_categories", "hducat_id,hducat_category", "hducat_id='hdu_category'"))
    {
        $hdu_catrow = $sql->db_Fetch();
        {
            extract($hdu_catrow);
            $retval = $hducat_category;
        } // while
    }
    else
    {
        // no categories to show
        $retval = HDU_136;
    }
}
return $retval;
SC_END

SC_BEGIN HDU_SHOW_ASSET
global $tp, $hdu_tagno, $helpdesk_obj;
if (!$helpdesk_obj->hdu_print &&( $helpdesk_obj->hdu_technician || $helpdesk_obj->hdu_new || $helpdesk_obj->hdu_super || $helpdesk_obj->quick))
{
    $retval = "<input type='text'  onkeyup=\"changed()\" name='hdu_tagno' class='tbox' size='20' maxlength='20' value='" . $tp->toFORM($hdu_tagno) . "' />";
}
else
{
    $retval = $tp->toHTML($hdu_tagno, false);
}
return $retval;
SC_END

SC_BEGIN HDU_SHOW_DESCRIPTION
global $tp, $hdu_description, $helpdesk_obj;
if (!$helpdesk_obj->hdu_print &&($helpdesk_obj->hdu_technician || $helpdesk_obj->hdu_new || $helpdesk_obj->hdu_super || $helpdesk_obj->quick))
{
    $retval = "<textarea rows='7'  onkeyup=\"changed()\" cols='40' style='width:97%;'  class='tbox' name='hdu_description'>" . $tp->toFORM($hdu_description) . "</textarea>";
}
else
{
    $retval = $tp->toHTML($hdu_description, false);
}
return $retval;
SC_END

SC_BEGIN HDU_SHOW_EMAIL
global $tp, $helpdesk_obj, $hdu_email;

    if ($helpdesk_obj->hdu_showemail)
    {
        // If the user wants to hide their email address - respect this
        $retval = HDU_159;
    }
    else
    {
        // otherwise show it using javascript to minimise spam bots
        // Put the java in some time
        $retval = $tp->toHTML($hdu_email, false);
    }
return $retval;
SC_END

SC_BEGIN HDU_SHOW_DELETE
global $helpdesk_obj,$id,$from;
if (!$helpdesk_obj->hdu_new && $helpdesk_obj->hdu_super)
{
	return "<a href='".e_PLUGIN."helpdesk3_menu/helpdesk.php?$from.delete.$id' ><img src='".e_IMAGE."admin_images/delete_16.png' style='border:0px;' alt='".HDU_228."' title='".HDU_228."' /></a>";
}
else
{
	return "";
}
SC_END


SC_BEGIN HDU_SHOW_STATUS
global $tp, $hdures_resolution, $hdu_resolution, $helpdesk_obj;

if (!$helpdesk_obj->hdu_print && ($helpdesk_obj->hdu_technician || $helpdesk_obj->hdu_super))
{
    $retval = $helpdesk_obj->hdu_getstatussel($hdu_resolution);
}
else
{
    if (empty($hdures_resolution))
    {
        $hdures_resolution = HDU_136;
    }
    $retval = $tp->toHTML($hdures_resolution, false);
}
return $retval;
SC_END

SC_BEGIN HDU_SHOW_ASSIGNEDTO
global $tp, $sql, $hdu_tech, $helpdesk_obj;
if (!$helpdesk_obj->hdu_print && $helpdesk_obj->hdu_super)
{
    $retval = HDU_25 . " " . HDU_175;
    $hdu_techsel = "<select name='hdu_tech' class='tbox' onchange=\"changed()\">";
    if ($sql->db_Select("hdu_helpdesk", "hdudesk_id,hdudesk_name", "order by hdudesk_name", "nowhere"))
    {
        $hdu_techsel .= "<option value='0'" .
        ($hdu_tech == 0?" selected='selected'":"") . ">" . HDU_41 . "</option>";
        while ($hdu_techrow = $sql->db_Fetch())
        {
            extract($hdu_techrow);
            $hdu_techsel .= "<option value='$hdudesk_id'" .
            ($hdu_tech == $hdudesk_id?" selected='selected'":"") . ">" . $tp->toFORM($hdudesk_name) . "</option>";
        } // while
    }
    else
    {
        $hdu_techsel .= "	<option value='0'>" . HDU_157 . "</option>";
    }
    $hdu_techsel .= "</select>";
    $retval = $hdu_techsel ;
}
else
{
    // get the name of the help desk
    $sql->db_Select("hdu_helpdesk", "hdudesk_id,hdudesk_name", "hdudesk_id='$hdu_tech'");
    $hdu_row = $sql->db_Fetch();
    extract($hdu_row);
    $retval = $tp->toHTML($hdudesk_name, false);
}
return $retval;
SC_END

SC_BEGIN HDU_SHOW_ALLOCATE_TIME
global $tp, $hdu_allocated, $helpdesk_obj;
if ($hdu_allocated == 0)
{
    // Not yet allocated so can't display assigned date
    $retval = HDU_41;
}
else
{
    $retval = $helpdesk_obj->hduconvert_date->convert_date($hdu_allocated);
}
return $retval;
SC_END

SC_BEGIN HDU_SHOW_CLOSED

global $tp, $hdu_closed, $helpdesk_obj;
if ($hdu_closed == 0)
{
    // Not closed
    $retval = HDU_38;
}
else
{
    // Display date ticket was closed
    $retval = $helpdesk_obj->hduconvert_date->convert_date($hdu_closed);
}
return $retval;
SC_END

SC_BEGIN HDU_SHOW_FIX
global $tp, $sql, $helpdesk_obj, $hdu_fix,$hdu_fixother;
if ($helpdesk_obj->hduprefs_showfixes)
{
    if (!$helpdesk_obj->hdu_print && ($helpdesk_obj->hdu_technician || $helpdesk_obj->hdu_super || $helpdesk_obj->quick))
    {
        $retval = "<select class='tbox' name='hdu_fix' onchange=\"changed()\"><option value='0'>" . HDU_153 . "</option>";
        if ($sql->db_Select("hdu_fixes", "hdufix_id,hdufix_fix", "order by hdufix_fix", "nowhere"))
        {
            while ($hdu_fixrow = $sql->db_Fetch())
            {
                extract($hdu_fixrow);
                $retval .= "<option value='$hdufix_id' " .
                ($hdufix_id == $hdu_fix?"selected='selected' ":"") . ">" . $tp->toFORM($hdufix_fix) . "</option>";
            }
        }
        else
        {
            $retval .= "<option value='0'>" . HDU_136 . "</option>";
        }
        $retval .= "</select><br />
        <br />
		<textarea name='hdu_fixother' onkeyup=\"changed()\" class='tbox' rows='6' cols='50' style='width:95%'>".$tp->toFORM($hdu_fixother)."</textarea>";
    }
    else
    {
        if ($sql->db_Select("hdu_fixes", "hdufix_id,hdufix_fix", "hdufix_id='$hdu_fix'"))
        {
            while ($hdu_fixrow = $sql->db_Fetch())
            {
                extract($hdu_fixrow);
                $hdu_fixname = $tp->toHTML($hdufix_fix);
            }
        }
        $retval = $tp->toHTML($hdu_fixname, false) ;
    }
}
else
{
    if (!$helpdesk_obj->hdu_print && ($helpdesk_obj->hdu_technician || $helpdesk_obj->hdu_super || $helpdesk_obj->quick))
    {
        $retval .= "<textarea name='hdu_fixother'  onkeyup=\"changed()\" class='tbox' rows='4' style='width:97%;'  cols='35'>" . $tp->toFORM($hdu_fixother) . "</textarea>";
    }
    else
    {
        $retval .= $tp->toHTML($hdu_fixother, false);
    }
}
return $retval;
SC_END

SC_BEGIN HDU_SHOW_FIXCOST
global $hdu_fixcost,$helpdesk_obj;
if (!$helpdesk_obj->hdu_print && ($helpdesk_obj->hdu_technician || $helpdesk_obj->hdu_super || $helpdesk_obj->quick))
{
	return "<input type='text' size='15'  onkeyup=\"changed()\" maxlength='10' name='hdu_fixcost' class='tbox' value='$hdu_fixcost' />";
}
else
{
	return $hdu_fixcost;
}
SC_END

SC_BEGIN HDU_SHOW_HOURS
global $hdu_hours,$helpdesk_obj;
if (!$helpdesk_obj->hdu_print && ($helpdesk_obj->hdu_technician || $helpdesk_obj->hdu_super || $helpdesk_obj->quick))
{
	return "<input type='text' size='15'  onkeyup=\"changed()\" maxlength='10' name='hdu_hours' class='tbox' value='$hdu_hours' />";
}
else
{
	return $hdu_hours;
}
SC_END

SC_BEGIN HDU_SHOW_RATE
global $hdu_hrate,$helpdesk_obj;
if (!$helpdesk_obj->hdu_print && ($helpdesk_obj->hdu_technician || $helpdesk_obj->hdu_super))
{
	return "<input type='text' size='15' onkeyup=\"changed()\" maxlength='10' name='hdu_hrate' class='tbox' value='$hdu_hrate' />";
}
else
{
	return $hdu_hrate;
}
SC_END

SC_BEGIN HDU_SHOW_COST
global $hdu_hcost;
return $hdu_hcost;
SC_END

SC_BEGIN HDU_SHOW_TRAVEL
global $hdu_distance,$helpdesk_obj;
if (!$helpdesk_obj->hdu_print && ($helpdesk_obj->hdu_technician || $helpdesk_obj->hdu_super || $helpdesk_obj->quick))
{
	return "<input type='text' size='15' onkeyup=\"changed()\" maxlength='10' name='hdu_distance' class='tbox' value='$hdu_distance' />";
}
else
{
	return $hdu_distance;
}
SC_END

SC_BEGIN HDU_SHOW_DISTANCERATE
global $hdu_drate,$helpdesk_obj;
if (!$helpdesk_obj->hdu_print && ($helpdesk_obj->hdu_technician || $helpdesk_obj->hdu_super || $helpdesk_obj->quick))
{
	return "<input type='text' size='15' onkeyup=\"changed()\" maxlength='10' name='hdu_drate' class='tbox' value='$hdu_drate' />";
}
else
{
	return $hdu_drate;
}
SC_END

SC_BEGIN HDU_SHOW_DISTANCECOST
global $hdu_dcost;
return $hdu_dcost;
SC_END

SC_BEGIN HDU_SHOW_EQUPTCOST
global $hdu_eqptcost,$helpdesk_obj;
if (!$helpdesk_obj->hdu_print && ($helpdesk_obj->hdu_technician || $helpdesk_obj->hdu_super || $helpdesk_obj->quick))
{
	return "<input type='text' size='15' onkeyup=\"changed()\"  maxlength='10' name='hdu_eqptcost' class='tbox' value='$hdu_eqptcost' />";
}
else
{
	return $hdu_eqptcost;
}
SC_END

SC_BEGIN HDU_SHOW_CALLOUT
global $helpdesk_obj,$hdu_callout;
if (!$helpdesk_obj->hdu_print && ($helpdesk_obj->hdu_technician || $helpdesk_obj->hdu_super || $helpdesk_obj->quick))
{
	return "<input type='text' size='15' onkeyup=\"changed()\"  maxlength='10' name='hdu_callout' class='tbox' value='$hdu_callout' />";
}
else
{
	return $hdu_callout;
}
SC_END

SC_BEGIN HDU_SHOW_TOTALCOST
global $hdu_totalcost;
return $hdu_totalcost;
SC_END

SC_BEGIN HDU_SHOW_SUBMIT
global $helpdesk_obj,$hdu_closed,$hdu_posterid;
if ($hdu_closed == 0 || ($helpdesk_obj->hdu_super || $helpdesk_obj->hdu_technician || (USERID == $hdu_posterid && $helpdesk_obj->hduprefs_reopen)))
{
    // Submit button
    $retval = "<input type='submit' disabled='disabled' class='button' id='formok' name='formok' value='" . HDU_210 . "' />";
}
else
{
    $retval= "";
}
return $retval;
SC_END

SC_BEGIN HDU_SHOW_COMMENTDATE
global $helpdesk_obj,$hduc_date;
return  $helpdesk_obj->hduconvert_date->convert_date($hduc_date, "short");
SC_END

SC_BEGIN HDU_SHOW_COMMENTPOSTER
global $tp,$hduc_postername;
return $tp->toHTML($hduc_postername,false);
SC_END

SC_BEGIN HDU_SHOW_COMMENT
global $tp,$hduc_comment;
return $tp->toHTML($hduc_comment,false);
SC_END

SC_BEGIN HDU_SHOW_NEWCOMMENT
global $helpdesk_obj,$hdu_closed,$hdu_posterid;

if ($hdu_closed == 0 || ($helpdesk_obj->hdu_super || $helpdesk_obj->hdu_technician || (USERID == $hdu_posterid && $helpdesk_obj->hduprefs_reopen)))
{
	return "<textarea cols='40' onkeyup=\"changed()\"  rows='4' style='width:99%' name='hduc_comment'></textarea>";
}

SC_END

SC_BEGIN HDU_DELETE_CONFIRM
return "<input type='submit' class='button' name='hdu_confirm' value='".HDU_231."' />";
SC_END

SC_BEGIN HDU_DELETE_CANCEL
return "<input type='submit' class='button' name='hdu_cancel' value='".HDU_232."' />";
SC_END






*/

?>
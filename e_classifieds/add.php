<?php

require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}

require_once(e_HANDLER . "userclass_class.php");
require_once(e_HANDLER . "ren_help.php");
// check class for creating editing ads
if (!check_class($pref['eclassf_create']))
{
    require_once(HEADERF);
    $ns->tablerender(ECLASSF_54, ECLASSF_53);
    require_once(FOOTERF) ;
    exit;
}
// upload
require_once(HEADERF);
require_once("upload_pic.php");
$actvar = $_POST["actvar"];
$action = $_POST['action'];
$catname2 = $_POST["catname2"];
$catid = $_POST["catid"];
$eclassf_action = $_POST['eclassf_action'];
if ($actvar == "delete")
{
    if ($_POST['confirm'])
    {
        $sql->db_Delete("eclassf_ads", "eclassf_cid=$catid");
        $eclassf_msg = ECLASSF_66;
    }
    else
    {
        $eclassf_msg = ECLASSF_65;
    }
    $action = "";
}
if ($pref['eclassf_valid'] > 0)
{
    $month = date("n");
    $day = date("j");
    $year = date("Y");

    $ptime = mktime(0, 0, 0, $month, $day, $year);
    $adlength = $pref['eclassf_valid'] * 86400;
    $ptime = $ptime + $adlength;
}
else
{
    $ptime = 0;
}
// ----------------NEW INSERT---------------
if ($eclassf_action == "save")
{
    if ($_POST['eclassf_delpic'] == "1")
    {
        unlink(e_PLUGIN . "e_classifieds/images/classifieds/" . $_POST['eclassf_cpic']);
        unlink(e_PLUGIN . "e_classifieds/images/classifieds/thumb_" . $_POST['eclassf_cpic']);
        $_POST['eclassf_cpic'] = "";
    }
    $cpic = "";
    $file = "";
    if (!empty($_FILES['file_userfile']['name']) && $pref['eclassf_pictype'] == 1)
    {
        $userid = USERID . "_";

        $evrsn_up = evrsn_fileup("file_userfile", e_PLUGIN . "e_classifieds/images/classifieds/", $userid);
        switch ($evrsn_up['result'])
        {
            case "0":
            default:
                $evrsn_upmess = ECLASSF_92;
                $cpic = "";
                $file = "";
                break;
            case "1":
                $evrsn_upmess = "";
                $cpic = $evrsn_up['filename'];
                $file = $evrsn_up['filename'];
                makeThumbnail($file, $pref['eclassf_thumbheight']);
				chmod("./images/classifieds/".$file,0644);
                break;
            case "2":
                $evrsn_upmess = ECLASSF_93;
                $cpic = "";
                $file = "";
                break;
            case "3":
                $evrsn_upmess = ECLASSF_94;
                $cpic = "";
                $file = "";
                break;
        }
    }
    else
    {
        $cpic = $_POST['eclassf_cpic'];
    }
    // $eclassf_action = "submit";
    if ($pref['eclassf_approval'] == 1)
    {
        $eclassf_approved = 0;
        $eclassf_msg = ECLASSF_48;
    }
    else
    {
        $eclassf_approved = 1;
        $eclassf_msg = ECLASSF_68;
    }
    if ($actvar == "edit")
    {
        # if (!file_exists(e_PLUGIN . "e_classifieds/images/classifieds/thumb_" . $cpic) && $pref['eclassf_pictype'] == 1)
        # {
        # makeThumbnail($cpic, $t_ht = 100);
        # }
        $eclassf_res = $sql->db_Update("eclassf_ads", "
		eclassf_cname='" . $tp->toDB($_POST['eclassf_cname']) . "',
		eclassf_cdesc='" . $tp->toDB($_POST['eclassf_cdesc']) . "',
		eclassf_ccat='" . $tp->toDB($_POST['eclassf_ccat']) . "',
		eclassf_cpic='$cpic',
		eclassf_cdetails='" . $tp->toDB($_POST['eclassf_cdetails']) . "',
		eclassf_capproved='$eclassf_approved',
		eclassf_cuser='" . USERID . "." . $tp->toDB(USERNAME) . "',
		eclassf_cph='" . $tp->toDB($_POST['eclassf_cph']) . "',
		eclassf_price='" . $tp->toDB($_POST['eclassf_price']) . "',
		eclassf_last='" . time() . "',
		eclassf_counter='" . $tp->toDB($_POST['eclassf_counter']) . "',
		eclassf_cph='" . $tp->toDB($_POST['eclassf_cph']) . "',
		eclassf_cemail='" . $tp->toDB($_POST['eclassf_cemail']) . "'
		WHERE eclassf_cid='$catid'",false);
        if ($eclassf_res)
        {
            $edata_sn = array("action" => "update", "user" => USERNAME, "itemtitle" => $_POST['eclassf_cdesc'], "catid" => intval($catid));
            $e_event->trigger("eclassfpost", $edata_sn);
            $eclassf_msg = $eclassf_msg;
        }
        else
        {
            $eclassf_msg = ECLASSF_67;
        }
    }

    if ($actvar == "new")
    {
        # if ($pref['eclassf_pictype'] == 1)
        # {
        # makeThumbnail($cpic, $t_ht = 100);
        # }
        $eclassf_adid = $sql->db_Insert("eclassf_ads", "
		0, '" . $tp->toDB($_POST['eclassf_cname']) . "',
		'" . $tp->toDB($_POST['eclassf_cdesc']) . "',
		'" . $tp->toDB($_POST['eclassf_ccat']) . "',
		'$cpic',
		'" . $tp->toDB($_POST['eclassf_cdetails']) . "',
		'$eclassf_approved',
		'" . USERID . "." . $tp->toDB(USERNAME) . "',
		'" . $tp->toDB($_POST['eclassf_cph']) . "',
		'" . $tp->toDB($_POST['eclassf_cemail']) . "',
		'" . time() . "',
		'$ptime',
		'" . time() . "',
		'" . $tp->toDB($_POST['eclassf_price']) . "','0',
		'" . $_POST['eclassf_counter'] . "'") ;
        if ($eclassf_adid)
        {
            $edata_sn = array("action" => "new", "user" => USERNAME, "itemtitle" => $_POST['eclassf_cdesc'], "catid" => intval($eclassf_adid));
            $e_event->trigger("eclassfpost", $edata_sn);
            $eclassf_msg = $eclassf_msg;
        }
        else
        {
            $eclassf_msg = ECLASSF_67;
        }
    }
    $action = "";
}
// -----------------------------------------
// Mod submitted by Sl4sh3r
if ($action <> "godo")
{
    $eclassf_text = "
    <form id=\"config\"  method=\"post\" action=\"" . e_SELF . "?0.mge.\">
            <table class=\"border\" style='width:97%' >";

    $eclassf_text .= "<tr><td class='fcaption' colspan='2'>" . ECLASSF_20 . "</td></tr>";
    $eclassf_text .= "<tr><td class='forumheader2' colspan='2' style='text-align:left' >
            <a href='" . e_SELF . "?$eclassf_from.cat.$eclassf_catid.$eclassf_subid.$eclassf_itemid'><img src='./images/updir.png' alt='logo' style='border:0'/></a></td></tr>";
    if (!empty($eclassf_msg))
    {
        $eclassf_text .= "<tr><td class=\"forumheader2\" colspan='2'>" . $eclassf_msg . " </td></tr>";
    }
    $eclassf_text .= "<tr><td class=\"forumheader3\">" . ECLASSF_20 . "</td><td class=\"forumheader3\" style='width:70%text-align:left'>
        <select class='tbox' name='catid'>";
    $sql->db_Select("eclassf_ads", "*", "eclassf_cuser regexp '^" . USERID . "[.]' order by eclassf_cname");

    while ($row = $sql->db_Fetch())
    {
        $eyetom = $row['eclassf_cid'];
        $eyename = $row['eclassf_cname'];
        $eclassf_text .= "<option value='$eyetom' " .
        ($catid == $eyetom?"selected='selected'":"") . ">$eyename</option>";
        $some = true;
    }

    if (!$some)
    {
        $eclassf_text .= "<option value='0' " . ($catid == none?"selected='selected'":"") . ">" . $tp->toHTML(ECLASSF_76) . "</option>";
    }

    $eclassf_text .= "</select><br />";
    if ($some)
    {
        $eclassf_text .= "<input type='radio' checked='checked' name='actvar' value='edit' />" . $tp->toHTML(ECLASSF_21) . "<br />
		<input type='radio' name='actvar' value='new' /> " . $tp->toHTML(ECLASSF_57) . "<br />";
    }
    else
    {
        $eclassf_text .= "<input type='radio' disabled='disabled' name='actvar' value='edit' />" . $tp->toHTML(ECLASSF_21) . "<br />
		<input type='radio' checked='checked' name='actvar' value='new' /> " . $tp->toHTML(ECLASSF_57) . "<br />";
    }

    $eclassf_text .= "<input type='radio' name='actvar' value='delete' /> " . $tp->toHTML(ECLASSF_22) . "
    <input type='checkbox' name='confirm' style='border:0' class='tbox' />" . $tp->toHTML(ECLASSF_58) . "
    <input type='hidden' name='action' value='godo' />
    </td></tr>
    <tr><td class='fcaption' colspan='2'><input class='tbox' type='submit' value='" . ECLASSF_39 . "' name='doaction' /></td></tr></table></form>";
    $ns->tablerender(ECLASSF_23, $eclassf_text);
}

if ($action == "godo")
{
    if ($actvar == "edit")
    {
        $sql->db_Select("eclassf_ads", "*", "eclassf_cid = $catid");
        $row = $sql->db_Fetch();
        extract($row);
        $actvar = "edit";
    }
    else
    {
        $actvar = "new";
    }

    $eclassf_text = "
	<script type='text/javascript'>
	<!-- Begin
	var doneit;
	function checkok(thisform)
	{

		if (doneit=='yes')
		{
			alert('" . ECLASSF_38 . "');
			return false;
		}

		if (thisform.catname2.value=='0'
			|| thisform.eclassf_cname.value=='0'
			|| thisform.eclassf_cdesc.value==''
			|| thisform.eclassf_cemail.value=='')
		{
			alert('" . ECLASSF_37 . "');
			return false;
		}
		else
		{
			doneit='yes';
			thisform.submit();
		}
	}
	//-->
	</script>
	<form enctype='multipart/form-data' onsubmit='return checkok(this);' id=\"config2\" method=\"post\" action=\"" . e_SELF . "?0.mge.\">
	<table class=\"border\" style='width:97%'>";
    $eclassf_text .= "<tr><td class='fcaption' colspan='2' style='text-align:left;' >" . ECLASSF_99 . "&nbsp;</td></tr>";

    $eclassf_text .= "<tr><td class='forumheader2' colspan='2' style='text-align:left;' >
			<a href='" . e_SELF . "?$eclassf_from.mge.$eclassf_catid.$eclassf_subid.$eclassf_itemid'><img src='./images/updir.png' alt='logo' style='border:0;'/></a></td></tr>";
###############################
    $eclassf_catlist = "<select class='tbox' name='eclassf_ccat'>";
    $eclassf_arg = "select * from #eclassf_subcats as s
		left join #eclassf_cats as c
		on s.eclassf_ccatid = c.eclassf_catid order by eclassf_catname,eclassf_subname";
    if ($sql->db_Select_gen($eclassf_arg, false))
    {
        $eclassf_current = "";
        while ($eclassf_row = $sql->db_Fetch())
        {
            if ($eclassf_current != $eclassf_row['eclassf_catname'])
            {
                $eclassf_current = $eclassf_row['eclassf_catname'];
                $eclassf_catlist .= "<option value='0' disabled='disabled'>" . $eclassf_row['eclassf_catname'] . "</option>";
            }
            $eclassf_catlist .= "<option value='" . $eclassf_row['eclassf_subid'] . "'";
            if ($eclassf_row['eclassf_subid'] == $eclassf_ccat)
            {
                $eclassf_catlist .= " selected='selected'";
            }

            $eclassf_catlist .= "> &nbsp;&raquo;&nbsp;" . $eclassf_row['eclassf_subname'] . "</option>";
            # print "<br>".$eclassf_current. "- " . $eclassf_row['eclassf_subname']  ;
        } // while
        $eclassf_catlist .= "</select>";
    }

    else
    {
        $eclassf_catlist .= "<option value='0' >".ECLASSF_51."</select>";
    }
############################################################
#    if ($actvar == "edit")
#    {
#        $eclassf_text .= "<input type='hidden' name='catname2' value='$amcat' />";
#        $eclassf_text .= "<input type='hidden' name='eclassf_ccat' value='$eclassf_ccat' />";
#    }
#    else
#    {
#        $eclassf_text .= "<tr><td class=\"forumheader3\">" . ECLASSF_24 . "</td><td class=\"forumheader3\" style='width:80%;text-align:left;'>
#			<select class='tbox' name='catname2' onchange='this.form.eclassf_action.value=\"\";this.form.submit()'>";
#        $eclassf_text .= "<option value='0'>" . ECLASSF_25 . "</option>";
#        $sql->db_Select("eclassf_cats", "*", "find_in_set(eclassf_catclass,'" . USERCLASS_LIST . "')");
#        while ($row = $sql->db_Fetch())
#        {
#            $eyetom = $row['eclassf_catid'];
#            $eyename = $row['eclassf_catname'];
#            $eclassf_text .= "<option value='$eyetom'" .
#            ($eyetom == $catname2?"selected='selected'":"") . ">$eyename</option>";
#        }
#        // Testing subcat selection
#        $eclassf_text .= "</select>&nbsp;<i>" . ECLASSF_27 . "</i></td></tr>
#		<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_34 . "</td><td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
#		<select class='tbox' name='eclassf_ccat'>";
#        // $eclassf_text .= "<option value='0'></option>";
#        if ($sql->db_Select("eclassf_subcats", "*", "eclassf_ccatid=$catname2"))
#        {
#            while ($row = $sql->db_Fetch())
#            {
#                $eyetom = $row['eclassf_subid'];
#                $eyename = $row['eclassf_subname'];
#                $eclassf_text .= "<option value='$eyetom'>$eyename</option>";
#            }
#        }
#        else
#        {
#            $eclassf_text .= "<option value='0'>" . ECLASSF_51 . "</option>";
#        }
#
#        $eclassf_text .= "</select>&nbsp;<i>" . ECLASSF_27 . "</i></td></tr>";
#    }
    // -------------------------
    // $eclassf_text .= "</select></td></tr>";
    $eclassf_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_26 . ":</td><td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
	<input type='text' name='eclassf_cname' class='tbox' style='width:60%' value='".$tp->toFORM($eclassf_cname)."' />&nbsp;<i>" . ECLASSF_27 . "</i></td></tr>";

    $eclassf_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_28 . ":</td><td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
	<input type='text' name='eclassf_cdesc' class='tbox' style='width:60%' value='".$tp->toFORM($eclassf_cdesc)."' />&nbsp;<i>" . ECLASSF_27 . "</i></td></tr>
		<tr>
			<td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_34 . "</td><td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
		$eclassf_catlist
			</td>
		</tr>
	";
    switch ($pref['eclassf_pictype'])
    {
        // Upload to server
        case 1:
            // If there is no file specified or the image is missing allow an upload
            // Otherwise just display the name of the picture
            if (empty($eclassf_cpic) || !file_exists("./images/classifieds/" . $eclassf_cpic))
            {
                $eclassf_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_29 . ":</td><td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
				<input class='tbox' name='file_userfile' type='file' size='47' />&nbsp;<br /><i>" . ECLASSF_55 . "</i></td></tr>";
            }
            else
            {
                $eclassf_text .= "<tr>
				<td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_29 . ":</td>
				<td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>" . $eclassf_cpic . "<br /><i>" . ECLASSF_62 . "</i>
<br />" . ECLASSF_89 . "<input type='checkbox' name='eclassf_delpic' value='1' />
				<input type='hidden' name='eclassf_cpic' value='$eclassf_cpic' /></td>
				</tr>";
            }
            break;
        // Use remote picture by URL
        case 2:
            $eclassf_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_30 . ":</td>
		<td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
		<input class='tbox' name='eclassf_cpic' type='text' style='width:80%;' value='" . $eclassf_cpic . "'/><br /><i>" . ECLASSF_63 . "</i></td></tr>";
            break;
        // No pictures in use
        case 0:
        default: ;
    } // switch
    if ($pref['eclassf_useremail'] == 1)
    {
        $eclassf_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_32 . ":</td><td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
		<input type='input' name='eclassf_cemail' class='tbox' style='width:150px' value='$eclassf_cemail' />&nbsp;<i>" . ECLASSF_27 . "</i></td></tr>";
    }
    else
    {
        $eclassf_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_32 . ":</td><td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
		<input type='hidden' name='eclassf_cemail' class='tbox' value='" . USEREMAIL . "' />" . ECLASSF_56 . " " . USEREMAIL . "</td></tr>";
    }
    $eclassf_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_60 . ":</td><td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
		<input type='input' name='eclassf_price' class='tbox' style='width:150px;text-align:left;' value='".$tp->toFORM($eclassf_price)."' /></td></tr>";

    $eclassf_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_12 . ":</td><td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
		<input type='input' name='eclassf_cph' class='tbox' style='width:150px;text-align:left;' value='".$tp->toFORM($eclassf_cph)."' /></td></tr>";
    $eclassf_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_33 . ":</td><td class='forumheader3'>";
    // HTML Area code
    // <tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_33 . ":</td><td class='forumheader3'>
    // <textarea class='tbox' style='width:80%;vertical-align:top;' rows='8' name='eclassf_cdetails'  onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>" . $eclassf_cdetails . "</textarea><br />" . ren_help(2) . "
    $insertjs = (!$pref['wysiwyg'])?"rows='15' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'":
    "rows='25' style='width:100%' ";
    $eclassf_cdetails = $tp->toForm($eclassf_cdetails);
    $eclassf_text .= "<textarea class='tbox' id='eclassf_cdetails' name='eclassf_cdetails' cols='80'  style='width:95%' $insertjs>" . (strstr($eclassf_cdetails, "[img]http") ? $eclassf_cdetails : str_replace("[img]../", "[img]", $eclassf_cdetails)) . "</textarea>";

    if (!$pref['wysiwyg'])
    {
        $eclassf_text .= "<input id='helpb' class='helpbox' type='text' name='helpb' size='100' style='width:95%'/>
			<br />" . display_help("helpb");
    }
    // End HTML Area Code
    $eclassf_text .= "</td></tr>";
    if ($eclassf_capproved != 1 && $pref['eclassf_approval'] == 1)
    {
        $eclassf_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_84 . "</td><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_83 . "</td></tr>";
    }
    // Counter
    if ($pref['eclassf_counter'] == "ALL")
    {
        $eclassf_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_87 . ":</td><td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
	<select class='tbox' name='eclassf_counter'>
	<option value='' " . ($eclassf_counter == ''?"selected='selected'":"") . ">" . ECLASSF_88 . "</option>
	<option value='cb' " . ($eclassf_counter == 'cb'?"selected='selected'":"") . ">Coloured Blocks</option>
	<option value='crt' " . ($eclassf_counter == 'crt'?"selected='selected'":"") . ">CRTs</option>
	<option value='flame' " . ($eclassf_counter == 'flame'?"selected='selected'":"") . ">Flames</option>
	<option value='floppy' " . ($eclassf_counter == 'floppy'?"selected='selected'":"") . ">Floppy Disks</option>
	<option value='heart' " . ($eclassf_counter == 'heart'?"selected='selected'":"") . ">Hearts</option>
	<option value='jelly' " . ($eclassf_counter == 'jelly'?"selected='selected'":"") . ">Jelly</option>
	<option value='lcd' " . ($eclassf_counter == 'lcd'?"selected='selected'":"") . ">LCD HP Calculator</option>
	<option value='lcdg' " . ($eclassf_counter == 'lcdg'?"selected='selected'":"") . ">LED Green</option>
	<option value='purple' " . ($eclassf_counter == 'purple'?"selected='selected'":"") . ">Purple</option>
	<option value='slant' " . ($eclassf_counter == 'slant'?"selected='selected'":"") . ">Slant</option>
	<option value='snowm' " . ($eclassf_counter == 'snowm'?"selected='selected'":"") . ">Snowman</option>
	<option value='text' " . ($eclassf_counter == 'text'?"selected='selected'":"") . ">Text</option>
	<option value='tree' " . ($eclassf_counter == 'tree'?"selected='selected'":"") . ">Christmas Tree</option>
	<option value='turf' " . ($eclassf_counter == 'turf'?"selected='selected'":"") . ">Turf</option>
	</select>
	</td></tr>";
    }
    // -------------------->
    $eclassf_text .= "<tr><td colspan=\"2\" class=\"fcaption\" style='text-align:left'>
	<input class='button' type='submit' value='" . ECLASSF_64 . "' onclick='this.form.eclassf_action.value=\"save\";'name='merc' />";

    if ($actvar == "edit")
    {
        if ($pref['eclassf_approval'] == 1 && $eclassf_capproved == 1)
        {
            $eclassf_text .= "<br /><em>" . ECLASSF_85 . "</em>";
        }
        $eclassf_text .= "<input type='hidden' name='catid' value='$catid'>";
        $caption = ECLASSF_36;
    }
    else
    {
        $eclassf_text .= "<input type='hidden' name='catid' value='0'>";
        $caption = ECLASSF_35;
    }
    $eclassf_text .= "<input type='hidden' name='actvar' value='$actvar' />
			<input type='hidden' name='action' value='godo' />
			<input type='hidden' name='eclassf_action' value='' />
			</td></tr></table></form>";

    $ns->tablerender($caption, $eclassf_text);
}

require_once(FOOTERF);

?>
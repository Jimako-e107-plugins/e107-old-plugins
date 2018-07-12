<?php

require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms("P"))
{
    header("location:" . e_BASE . "index.php");
    exit;
}
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "e_classifieds/languages/admin/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "e_classifieds/languages/admin/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "e_classifieds/languages/admin/English.php");
}
$e_wysiwyg = "eclassf_cdetails";
if ($pref['wysiwyg'])
{
    $WYSIWYG = true;
}
// Calendar bits (uses the one from e107 calendar
require_once(e_HANDLER . "calendar/calendar_class.php");
$eclassf_cal = new DHTML_Calendar(true);

$eclassf_text .= $eclassf_cal->load_files();

require_once(e_HANDLER . "userclass_class.php");
require_once(e_HANDLER . "ren_help.php");

require_once(e_ADMIN . "auth.php");

$actvar = $_POST["actvar"];
$action = $_POST['action'];
$catname2 = $_POST["catname2"];
$catid = $_POST["catid"];
$eclassf_action = $_POST['eclassf_action'];
if (empty($pref['eclassf_dformat']))
{
    $pref['eclassf_dformat'] = "d-m-Y";
}
if ($actvar == "delete")
{
    if ($_POST['confirm'])
    {
        $sql->db_Delete("eclassf_ads", "eclassf_cid=$catid");
        $eclassf_msg = ECLASSF_A79;
    }
    else
    {
        $eclassf_msg = ECLASSF_A78;
    }
    $action = "";
}

if ($eclassf_action == "save")
{
    if ($_POST['eclassf_delpic'] == "1")
    {
        unlink(e_PLUGIN . "e_classifieds/images/classifieds/" . $_POST['eclassf_cpic']);
        unlink(e_PLUGIN . "e_classifieds/images/classifieds/thumb_" . $_POST['eclassf_cpic']);
        $_POST['eclassf_cpic'] = "";
    }
    if (!empty($_POST['eclassf_cpdate']))
    {
        $eclassf_tmp = explode("-", $_POST['eclassf_cpdate']);
        switch ($pref['eclassf_dformat'])
        {
            case "m-d-Y":
                $ptime = mktime(0, 0, 0, $eclassf_tmp[0], $eclassf_tmp[1], $eclassf_tmp[2]);
                break;
            case "Y-m-d":
                $ptime = mktime(0, 0, 0, $eclassf_tmp[1], $eclassf_tmp[2], $eclassf_tmp[0]);
                break;
            case "d-m-Y":
            default:
                $ptime = mktime(0, 0, 0, $eclassf_tmp[1], $eclassf_tmp[0], $eclassf_tmp[2]);
                break;
        }
    }
    else
    {
        $ptime = "";
    }
    if (!empty($_FILES['file_userfile']['name']) && $pref['eclassf_pictype'] == 1)
    {
        $userid = $_POST['eclassf_cuserid'] . "_";

        require_once("upload_pic.php");
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
    // if (!file_exists(e_PLUGIN . "e_classifieds/images/classifieds/thumb_" . $cpic) && $pref['eclassf_pictype'] == 1)
    // {
    // makeThumbnail($cpic, $t_ht = 100);
    // }
    // get user name from db
    $sql->db_Select("user", "user_name", "user_id='" . $_POST['eclassf_cuserid'] . "'");
    $eclassf_row = $sql->db_Fetch();
    $eclassf_uname = $_POST['eclassf_cuserid'] . "." . $eclassf_row['user_name'];
    if ($actvar == "edit")
    {
        $eclassf_ok = $sql->db_Update("eclassf_ads", "
		eclassf_cname='" . $tp->toDB($_POST['eclassf_cname']) . "',
		eclassf_cdesc='" . $tp->toDB($_POST['eclassf_cdesc']) . "',
		eclassf_ccat='" . $tp->toDB($_POST['catname']) . "',
		eclassf_cpic='$cpic',
		eclassf_cdetails='" . $tp->toDB($_POST['eclassf_cdetails']) . "',
		eclassf_capproved='$eclassf_approved',
		eclassf_cuser='" . $tp->toDB($eclassf_uname) . "',
		eclassf_cph='" . $tp->toDB($_POST['eclassf_cph']) . "',
		eclassf_cemail='" . $tp->toDB($_POST['eclassf_cemail']) . "',
		eclassf_capproved='" . $tp->toDB($_POST['eclassf_capproved']) . "',
		eclassf_price='" . $tp->toDB($_POST['eclassf_price']) . "',
		eclassf_counter='" . $tp->toDB($_POST['eclassf_counter']) . "',
		eclassf_last='" . time() . "',
		eclassf_cpdate='" . $tp->toDB($ptime) . "'
		WHERE eclassf_cid='$catid'") ;
        if ($eclassf_ok)
        {
            $eclassf_msg = ECLASSF_A75;
        }
        else
        {
            $eclassf_msg = ECLASSF_A81;
        }
    }

    if ($actvar == "new")
    {
        // $eclassf_exptime = time() + ($pref['eclassf_valid'] * 86400);
        $eclassf_adid = $sql->db_Insert("eclassf_ads", "
		0, '" . $tp->toDB($_POST['eclassf_cname']) . "',
		'" . $tp->toDB($_POST['eclassf_cdesc']) . "',
		'" . $tp->toDB($_POST['catname']) . "',
		'$cpic',
		'" . $tp->toDB($_POST['eclassf_cdetails']) . "',
		'" . $tp->toDB($_POST['eclassf_capproved']) . "',
		'" . $tp->toDB($eclassf_uname) . "',
		'" . $tp->toDB($_POST['eclassf_cph']) . "',
		'" . $tp->toDB($_POST['eclassf_cemail']) . "',
		'" . time() . "',
		'$ptime','0',
		'" . $tp->toDB($_POST['eclassf_price']) . "','0',
		'" . $tp->toDB($_POST['eclassf_counter']) . "'");
        if ($eclassf_adid)
        {
            $eclassf_msg = ECLASSF_A75;
        }
        else
        {
            $eclassf_msg = ECLASSF_A81;
        }
    }
    $action = "";
}
// -----------------------------------------
if ($action <> "godo")
{
    $eclassf_text .= "
	<form id=\"config\"  method=\"post\" action=\"" . e_SELF . "\">
            <table class=\"fborder\" style='width:97%' >";

    $eclassf_text .= "<tr><td class=\"fcaption\" colspan='2'>" . ECLASSF_A54 . "</td></tr>";

    $eclassf_text .= "<tr><td class=\"forumheader2\" colspan='2'>" . $eclassf_msg . "&nbsp;";
    if (!empty($evrsn_upmess))
    {
        $eclassf_text .= "<br />" . $evrsn_upmess;
    }
    $eclassf_text .= "</td></tr>";
    $eclassf_text .= "<tr><td class=\"forumheader3\" style='width:20%;text-align:left;'>" . ECLASSF_A19 . "</td><td class=\"forumheader3\" style='width:80%;text-align:left;'>
		<select class='tbox' name='catid'>";
    $eclassf_yes = false;
    if ($sql->db_Select("eclassf_ads", "eclassf_cid,eclassf_cname", " order by eclassf_cname", "nowhere"))
    {
        $eclassf_yes = true;
        while ($row = $sql->db_Fetch())
        {
            $eyetom = $row['eclassf_cid'];
            $eyename = $row['eclassf_cname'];
            $eclassf_text .= "<option value='$eyetom' " .
            ($catid == $eyetom?"selected='selected'":"") . ">$eyename</option>";
        }
    }
    else
    {
        $eclassf_text .= "<option value='0' >" . ECLASSF_A92 . "</option>";
    }

    $eclassf_text .= "</select><br />";
    $eclassf_text .= "
	<input type='radio' checked='checked' name='actvar' value='edit' " . ($eclassf_yes?"checked='checked'":"disabled='disabled'") . " />" . ECLASSF_A20 . " <br />
	<input type='radio' name='actvar' value='new' " . (!$eclassf_yes?"checked='checked'":"") . " /> " . ECLASSF_A21 . "<br />
	<input type='radio' name='actvar' value='delete' /> " . ECLASSF_A22 . " &nbsp;
	<input type='checkbox' name='confirm' class='tbox' />" . ECLASSF_A23 . "
	<input type='hidden' name='action' value='godo' />
	</td></tr>
	<tr><td class='fcaption' colspan='2'><input class='tbox' type='submit' value='" . ECLASSF_A24 . "' name='doaction' />
	</td></tr></table></form>";

    $ns->tablerender(ECLASSF_A1, $eclassf_text);
}
if ($action == "godo")
{
    if ($actvar == "edit")
    {
        $sql->db_Select("eclassf_ads", "*", "eclassf_cid = $catid");
        $row = $sql->db_Fetch();
        extract($row);
        $actvar = "edit";
        $caption = ECLASSF_A61;
    }
    else
    {
        $caption = ECLASSF_A60;
        $actvar = "new";
    }

    $eclassf_text .= "
	<script type='text/javascript'>
	<!-- Begin
	function checkok(thisform)
	{

		if (thisform.catname.value=='0'
			|| thisform.eclassf_cname.value=='0'
			|| thisform.eclassf_cdesc.value==''
			|| thisform.eclassf_cemail.value=='')
		{
			alert('" . ECLASSF_A57 . "');
			return false;
		}
		else
		{
			thisform.submit();
		}
	}
	//-->
	</script>
	<form enctype='multipart/form-data' onsubmit='return checkok(this);' id=\"config2\" method=\"post\" action=\"" . e_SELF . "\">
	<table class=\"fborder\" style='width:97%'>";
    $eclassf_text .= "<tr><td class='fcaption' colspan='2' style='text-align:left;' >" . $caption . "</td></tr>";

    $eclassf_catlist = "<select class='tbox' name='catname'>";
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
            // print "<br>".$eclassf_current. "- " . $eclassf_row['eclassf_subname']  ;
        } // while
        $eclassf_catlist .= "</select>";
    }

    else
    {
        $eclassf_text .= "</select>&nbsp;<i>" . ECLASSF_A59 . "</i></td></tr>";
    }

    // -------------------------
    // $eclassf_text .= "</select></td></tr>";
    $eclassf_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_A62 . ":</td><td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
	<input type='text' name='eclassf_cname' class='tbox' style='width:60%' value='$eclassf_cname' />&nbsp;<i>" . ECLASSF_A59 . "</i></td></tr>";

    $eclassf_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_A63 . ":</td><td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
	<input type='text' name='eclassf_cdesc' class='tbox' style='width:60%' value='$eclassf_cdesc' />&nbsp;<i>" . ECLASSF_A59 . "</i></td></tr>";
 $eclassf_text .= "<tr><td class=\"forumheader3\">" . ECLASSF_A36 . "</td><td class=\"forumheader3\" style='width:80%;text-align:left;'>
			$eclassf_catlist
			</td></tr>";
    switch ($pref['eclassf_pictype'])
    {
        // Upload to server
        case 1:
            // If there is no file specified or the image is missing allow an upload
            // Otherwise just display the name of the picture
            if (empty($eclassf_cpic) || !file_exists("./images/classifieds/" . $eclassf_cpic))
            {
                $eclassf_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_A40 . ":</td><td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
				<input class='tbox' name='file_userfile' type='file' size='47' />&nbsp;<br /><i>" . ECLASSF_A110 . "</i></td></tr>";
            }
            else
            {
                $eclassf_text .= "<tr>
				<td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_A40 . ":</td>
				<td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>" . $eclassf_cpic . "<br /><i>" . ECLASSF_A106 . "</i>
<br />" . ECLASSF_A112 . "<input type='checkbox' name='eclassf_delpic' value='1' />
				<input type='hidden' name='eclassf_cpic' value='$eclassf_cpic'</td>
				</tr>";
            }
            break;
        // Use remote picture by URL
        case 2:
            $eclassf_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_A40 . ":</td>
		<td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
		<input class='tbox' name='eclassf_cpic' type='text' style='width:80%;' value='" . $eclassf_cpic . "'/><br /><i>" . ECLASSF_A66 . "</i></td></tr>";
            break;
        // No pictures in use
        case 0:
        default: ;
    } // switch
    $eclassf_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_A65 . ":</td><td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'><input type='text' name='eclassf_cph' class='tbox' style='width:150px' value='" . $eclassf_cph . "' />&nbsp;</td></tr>";

    $eclassf_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_A67 . ":</td><td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
		<input type='input' name='eclassf_cemail' class='tbox' style='width:150px' value='$eclassf_cemail' />&nbsp;<i>" . ECLASSF_A59 . "</i></td></tr>";

    $eclassf_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_A68 . ":</td><td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
		<input type='input' name='eclassf_price' class='tbox' style='width:150px;text-align:right;' value='$eclassf_price' /></td></tr>";
    $eclassf_sel = "<select name='eclassf_cuserid' class='tbox' >";
    $sql->db_Select("user", "user_id,user_name", "order by user_name", "nowhere");
    $eclassf_tmp = explode(".", $eclassf_cuser);
    $eclassf_nid = $eclassf_tmp[0];
    while ($row = $sql->db_Fetch())
    {
        extract($row);
        // print $eclassf_cuser.$user_name;
        $eclassf_sel .= "<option value='$user_id' " .
        ($eclassf_nid == $user_id?"selected='selected'":"") . ">".$tp->toFORM($user_name)."</option>";
    }
    $eclassf_sel .= "</select>";
    $eclassf_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_A72 . ":</td><td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
		$eclassf_sel&nbsp;<i>" . ECLASSF_A59 . "</i></td></tr>";
    // calendar options
    $eclassf_dformat = str_replace("d", "%d", $pref['eclassf_dformat']);
    $eclassf_dformat = str_replace("m", "%m", $eclassf_dformat);
    $eclassf_dformat = str_replace("Y", "%Y", $eclassf_dformat);
    if ($actvar == "new" && $pref['eclassf_valid'] > 0)
    {
        $eclassf_cpdate = $eclassf_exptime = time() + ($pref['eclassf_valid'] * 86400);
    }

    $eclassf_cal_options['firstDay'] = 1;
    $eclassf_cal_options['showsTime'] = false;
    $eclassf_cal_options['showOthers'] = false;
    $eclassf_cal_options['weekNumbers'] = false;
    $eclassf_cal_options['ifFormat'] = $eclassf_dformat;
    $eclassf_cal_attrib['class'] = "tbox";
    $eclassf_cal_attrib['name'] = "eclassf_cpdate";
    $eclassf_cal_attrib['value'] = ($eclassf_cpdate > 0?date($pref['eclassf_dformat'], $eclassf_cpdate):"");
    $eclassf_desc = $eclassf_cal->make_input_field($eclassf_cal_options, $eclassf_cal_attrib);
    // $eclassf_desdate = date("l d F Y", $itrq_decisiondate);
    $eclassf_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_A73 . ":</td><td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
		$eclassf_desc </td></tr>";
    // end cal
    if ($pref['eclassf_approval'] == 0 && $actvar == "new")
    {
        $eclassf_capproved = 1;
    }
    $eclassf_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_A74 . ":</td><td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
		<input type='checkbox' name='eclassf_capproved' class='tbox' style='' value='1'" .
    ($eclassf_capproved == 1?"checked='checked'":"") . " /></td></tr>";

    $eclassf_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_A69 . ":</td><td class='forumheader3'>
	";
    // HTML AREA CODE
    $insertjs = (!$pref['wysiwyg'])?"rows='15' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'":
    "rows='25' style='width:100%' ";
    $eclassf_cdetails = $tp->toForm($eclassf_cdetails);
    $eclassf_text .= "<textarea class='tbox' id='eclassf_cdetails' name='eclassf_cdetails' cols='80'  style='width:95%' $insertjs>" . (strstr($eclassf_cdetails, "[img]http") ? $eclassf_cdetails : str_replace("[img]../", "[img]", $eclassf_cdetails)) . "</textarea>";

    if (!$pref['wysiwyg'])
    {
        $eclassf_text .= "<input id='helpb' class='helpbox' type='text' name='helpb' size='100' style='width:95%'/>
			<br />" . display_help("helpb");
    }
    // END HTML AREA CODE
    // Counter
    $eclassf_text .= "</td></tr>
	<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . ECLASSF_A107 . ":</td><td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
	<select class='tbox' name='eclassf_counter'>
	<option value='' " . ($eclassf_counter == ''?"selected='selected'":"") . ">" . ECLASSF_A108 . "</option>
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
    // -------------------->
    $eclassf_text .= "<tr><td colspan=\"2\" class=\"fcaption\" style='text-align:left'>
	<input class='button' type='submit' value='" . ECLASSF_A70 . "' onclick='this.form.eclassf_action.value=\"save\";'name='merc' />
	</td></tr></table>
	<div>";

    if ($actvar == "edit")
    {
        $eclassf_text .= "<input type='hidden' name='eclassf_ccat' value='$eclassf_ccat'>";
        $eclassf_text .= "<input type='hidden' name='catid' value='$catid'>";
    }
    else
    {
        $eclassf_text .= "<input type='hidden' name='catid' value='0'>";
    }
    $eclassf_text .= "<input type='hidden' name='actvar' value='$actvar' />
			<input type='hidden' name='action' value='godo' />
			<input type='hidden' name='eclassf_action' value='' />
			</div></form>";

    $ns->tablerender(ECLASSF_A1, $eclassf_text);
}

require_once(e_ADMIN . "footer.php");

?>
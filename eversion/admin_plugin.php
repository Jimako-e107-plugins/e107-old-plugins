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

e107::lan('eversion',true); 

require_once(e_HANDLER . "userclass_class.php");
require_once(e_ADMIN . "auth.php");

$eversion_action = $_POST['eversion_action'];
$eversion_selcat = $_POST['eversion_selcat'];
$eversion_edit = false;
// Calendar bits (uses the one from e107 calendar
// * If we are updating then update or insert the record
if ($eversion_action == 'update')
{
    $eversion_id = $_POST['eversion_id'];
    $evrsn_datetemp = $_POST['eversion_date'];
    if ($eversion_id == 0)
    {
        // New record so add it
        $eversion_args = "
		'0',
		'" . $tp->toDB($_POST['eversion_name']) . "',
		'" . $tp->toDB($_POST['eversion_title']) . "',
		'" . $tp->toDB($_POST['eversion_major']) . "',
		'" . $tp->toDB($_POST['eversion_minor']) . "',
		'" . $tp->toDB($_POST['eversion_beta']) . "',
		'" . $tp->toDB($_POST['eversion_date']) . "',
		'" . $tp->toDB($_POST['eversion_author']) . "',
		'" . $tp->toDB($_POST['eversion_revisions']) . "',
		'" . $tp->toDB($_POST['eversion_comments']) . "',
		'" . $tp->toDB($_POST['eversion_dlpath']) . "','" . time() . "',0,
		'" . $tp->toDB($_POST['eversion_support']) . "',
		'" . $tp->toDB($_POST['eversion_icon']) . "',
		'" . $tp->toDB($_POST['eversion_bugtrack']) . "'";
        if ($sql->db_Insert("eversion", $eversion_args))
        {
            $eversion_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . EVERSION_A51 . "</strong></td></tr>";
        }
    }
    else
    {
        // Update existing
        $eversion_args = "
		eversion_name = '" . $tp->toDB($_POST['eversion_name']) . "',
		eversion_title = '" . $tp->toDB($_POST['eversion_title']) . "',
		eversion_major = '" . $tp->toDB($_POST['eversion_major']) . "',
		eversion_minor = '" . $tp->toDB($_POST['eversion_minor']) . "',
		eversion_beta = '" . $tp->toDB($_POST['eversion_beta']) . "',
		eversion_date = '" . $tp->toDB($_POST['eversion_date']) . "',
		eversion_author = '" . $tp->toDB($_POST['eversion_author']) . "',
		eversion_revisions = '" . $tp->toDB($_POST['eversion_revisions']) . "',
		eversion_comments = '" . $tp->toDB($_POST['eversion_comments']) . "',
		eversion_dlpath = '" . $tp->toDB($_POST['eversion_dlpath']) . "',
		eversion_support = '" . $tp->toDB($_POST['eversion_support']) . "',
		eversion_icon = '" . $tp->toDB($_POST['eversion_icon']) . "',
		eversion_bugtrack = '" . $tp->toDB($_POST['eversion_bugtrack']) . "',
		eversion_updated = '" . time() . "' where eversion_id='$eversion_id'";
        if ($sql->db_Update("eversion", $eversion_args, false))
        {
            // Changes saved
            $eversion_msg .= "<tr><td class='forumheader3' colspan='2'><b>" . EVERSION_A52 . "</b></td></tr>";
        }
    }
    // now it is saved, generate the XML file
    gen_file();
    e107::getCache()->clear("nq_eversion_menu");
}
// We are creating, editing or deleting a record
if ($eversion_action == 'dothings')
{
    $eversion_id = $_POST['eversion_selcat'];
    $eversion_do = $_POST['eversion_recdel'];
    $eversion_dodel = false;

    switch ($eversion_do)
    {
        case '1': // Edit existing record
            {
                // We edit the record
                $sql->db_Select("eversion", "*", "eversion_id='$eversion_id'");
                $eversion_row = $sql->db_Fetch() ;
                extract($eversion_row);
                $eversion_edit = true;
                break;
            }
        case '2': // New category
            {
                // Create new record
                $eversion_id = 0;
                // set all fields to zero/blank
                $eversion_edit = true;
                break;
            }
        case '3':
            {
                // delete the record
                if ($_POST['eversion_okdel'] == '1')
                {
                    if ($sql->db_Delete("eversion", " eversion_id='$eversion_id'"))
                    {
                        $eversion_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . EVERSION_A53 . "</strong></td></tr>";
                    }
                    else
                    {
                        $eversion_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . EVERSION_A54 . "</strong></td></tr>";
                    }
                }
                else
                {
                    $eversion_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . EVERSION_A55 . "</strong></td></tr>";
                }

                $eversion_dodel = true;
                $eversion_edit = false;
            }
    }

    if (!$eversion_dodel)
    {
        $eversion_text .= "
		<form id='myclassupdate' method='post' action='" . e_SELF . "'>

		<table style='width:97%;' class='fborder'>
		<tr><td colspan='2' class='fcaption'>" . EVERSION_A30 . "
		<input type='hidden' value='$eversion_id' name='eversion_id' />
		<input type='hidden' value='$eversion_selcat' name='eversion_selcat' />
		<input type='hidden' value='update' name='eversion_action' /></td></tr>
		$eversion_msg
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . EVERSION_A41 . "</td><td  class='forumheader3'><input type='text' class='tbox' style='width:40%;' name='eversion_title' value='" . $tp->toFORM($eversion_title) . "' /></td></tr>
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . EVERSION_A40 . "</td><td  class='forumheader3'><input type='text' class='tbox' style='width:40%;' name='eversion_name' value='" . $tp->toFORM($eversion_name) . "' /></td></tr>
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . EVERSION_A42 . "</td><td  class='forumheader3'><input type='text' class='tbox' style='width:10%;' name='eversion_major' value='" . $tp->toFORM($eversion_major) . "' /></td></tr>
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . EVERSION_A43 . "</td><td  class='forumheader3'><input type='text' class='tbox' style='width:10%;' name='eversion_minor' value='" . $tp->toFORM($eversion_minor) . "' /></td></tr>
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . EVERSION_A44 . "</td><td  class='forumheader3'><input type='text' class='tbox' style='width:10%;' name='eversion_beta' value='" . $tp->toFORM($eversion_beta) . "' /></td></tr>";
        // calendar options
        if (empty($pref['eversion_dformat']))
        {
            $pref['eversion_dformat'] = "d-m-Y";
        }
        $evrsn_cal_options['firstDay'] = 1;
        $evrsn_cal_options['showsTime'] = false;
        $evrsn_cal_options['showOthers'] = false;
        $evrsn_cal_options['weekNumbers'] = false;

        $evrsn_dformat = str_replace("d", "%d", $pref['eversion_dformat']);
        $evrsn_dformat = str_replace("m", "%m", $evrsn_dformat);
        $evrsn_dformat = str_replace("Y", "%Y", $evrsn_dformat);

        $evrsn_cal_options['ifFormat'] = $evrsn_dformat;
        $evrsn_cal_attrib['class'] = "tbox";
        $evrsn_cal_attrib['name'] = "eversion_date";

        $evrsn_cal_attrib['value'] = ($eversion_date > 0?date($pref['eversion_dformat'], $eversion_date):"");

        $evrsn_desc = e107::getForm()->datepicker($evrsn_cal_attrib['name'], $evrsn_cal_attrib['value']);
        $eversion_text .= "
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . EVERSION_A45 . "</td><td  class='forumheader3'>" . $evrsn_desc . "</td></tr>";
        $eversion_iconlist = "<select name='eversion_icon' class='tbox'>";
        if ($handle = opendir("./images/plugicons"))
        {
            $eversion_iconlist .= "<option value=\"\"> </option>";
            while (false !== ($file = readdir($handle)))
            {
                if ($file <> "." && $file <> "..")
                {
                    $eversion_iconlist .= "<option value=\"" . $file . "\" " .
                    ($file == $eversion_icon ? " selected " : " ") . ">" . $file . "</option>";
                }
            }

            closedir($handle);
        }
        $eversion_iconlist .= "</select>";
        if ($pref['eversion_usedownloads'])
        {
            $eversion_dlsel = "<select class='tbox' name='eversion_dlpath'>";
            $sql->db_Select("download", "download_id,download_name", "order by download_name", "nowhere", false);
            $eversion_dlsel .= "<option value='' " . ($eversion_dpath == $eversion_dlpath?"selected='selected'":"") . ">" . EVERSION_A64 . "</option>";

            while ($eversion_row = $sql->db_Fetch())
            {
                $eversion_dpath = SITEURL . "download.php?view." . $eversion_row['download_id'];
                $eversion_dlsel .= "<option value='" . $eversion_dpath . "' " . ($eversion_dpath == $eversion_dlpath?"selected='selected'":"") . ">" . $tp->toFORM($eversion_row['download_name']) . "</option>";
            } // while
            $eversion_dlsel .= "</select>";
        }
        else
        {
            $eversion_dlsel = "<input type='text' class='tbox' style='width:90%;' name='eversion_dlpath' value='" . $tp->toFORM($eversion_dlpath) . "' />";
        }
        if ($pref['eversion_useforums'])
        {
            $eversion_slsel = "<select class='tbox' name='eversion_support'>";
            $sql->db_Select("forum", "forum_id,forum_name", "order by forum_name", "nowhere", false);
            $eversion_slsel .= "<option value='' " . ($eversion_spath == $eversion_support?"selected='selected'":"") . ">" . EVERSION_A65 . "</option>";
            while ($eversion_row = $sql->db_Fetch())
            {
                $eversion_spath = SITEURL . $PLUGINS_DIRECTORY . "forum/forum_viewforum.php?" . $eversion_row['forum_id'];
                $eversion_slsel .= "<option value='" . $eversion_spath . "' " . ($eversion_spath == $eversion_support?"selected='selected'":"") . ">" . $tp->toFORM($eversion_row['forum_name']) . "</option>";
            } // while
            $eversion_slsel .= "</select>";
        }
        else
        {
            $eversion_slsel = "<input type='text' class='tbox' style='width:90%;' name='eversion_support' value='" . $tp->toFORM($eversion_support) . "' />";
        }
        if ($pref['eversion_usebugs'])
        {
            $eversion_bgsel = "<select class='tbox' name='eversion_bugtrack'>";
            $sql->db_Select("bugtrack_apps", "bugtrack_app_id,bugtrack_app_name", "order by bugtrack_app_name", "nowhere", false);
            $eversion_bgsel .= "<option value='' " . ($eversion_bpath == $eversion_bugtrack?"selected='selected'":"") . ">" . EVERSION_A66 . "</option>";
            while ($eversion_row = $sql->db_Fetch())
            {
                $eversion_bpath = SITEURL . $PLUGINS_DIRECTORY . "bug_tracker/bugs.php?0.view." . $eversion_row['bugtrack_app_id'] . ".0.0";
                $eversion_bgsel .= "<option value='" . $eversion_bpath . "' " . ($eversion_bpath == $eversion_bugtrack?"selected='selected'":"") . ">" . $tp->toFORM($eversion_row['bugtrack_app_name']) . "</option>";
            } // while
            $eversion_bgsel .= "</select>";
        }
        else
        {
            $eversion_bgsel = "<input type='text' class='tbox' style='width:90%;' name='eversion_bugtrack' value='" . $tp->toFORM($eversion_bugtrack) . "' />";
        }

        $eversion_text .= "
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . EVERSION_A46 . "</td><td  class='forumheader3'><input type='text' class='tbox' style='width:30%;' name='eversion_author' value='" . $tp->toFORM($eversion_author) . "' /></td></tr>
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . EVERSION_A67 . "</td><td  class='forumheader3'>$eversion_iconlist</td></tr>
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . EVERSION_A47 . "</td><td  class='forumheader3'><textarea rows='6' style='width:80%;' class='tbox' name='eversion_revisions' >" . $tp->toFORM($eversion_revisions) . "</textarea><br /></td></tr>
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . EVERSION_A48 . "</td><td  class='forumheader3'><textarea rows='6' style='width:80%;' class='tbox' name='eversion_comments' >" . $tp->toFORM($eversion_comments) . "</textarea><br /></td></tr>
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . EVERSION_A49 . "</td><td  class='forumheader3'>$eversion_dlsel</td></tr>
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . EVERSION_A59 . "</td><td  class='forumheader3'>$eversion_slsel</td></tr>
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . EVERSION_A60 . "</td><td  class='forumheader3'>$eversion_bgsel</td></tr>
		<tr><td colspan='2' class='fcaption'><input type='submit' name='submits' value='" . EVERSION_A35 . "' class='tbox' /></td></tr>
		</table></form>";
    }
}
if (!$eversion_edit)
{
    // Get the category names to display in combo box
    // then display actions available
    $eversion_2_db = new DB;
    $eversion_yes = false;
    if ($eversion_2_db->db_Select("eversion", "eversion_id,eversion_title", " order by eversion_name", "nowhere"))
    {
        $eversion_yes = true;
        while ($eversion_row = $eversion_2_db->db_Fetch())
        {
            extract($eversion_row);
            $eversion_catopt .= "<option value='$eversion_id'" .
            ($eversion_id == $eversion_selcat?" selected='selected'":"") . ">$eversion_title</option>";
        }
    }
    else
    {
        $eversion_catopt .= "<option value='0'>" . EVERSION_A37 . "</option>";
    }

    $eversion_text .= "
	<form id='myclassform' method='post' action='" . e_SELF . "'>

	<table width='97%' class='fborder'>
	<tr><td colspan='2' class='fcaption'>" . EVERSION_A30 . "	<input type='hidden' value='dothings' name='eversion_action' /></td></tr>
	$eversion_msg
	<tr><td style='width:20%;' class='forumheader3'>" . EVERSION_A36 . "</td><td  class='forumheader3'>
	<select name='eversion_selcat' class='tbox'>$eversion_catopt</select></td></tr>
	<tr><td style='width:20%;' class='forumheader3'>" . EVERSION_A38 . "</td><td  class='forumheader3'>
	<input type='radio' name='eversion_recdel' value='1' " . ($eversion_yes?"checked='checked'":"disabled='disabled'") . " /> " . EVERSION_A31 . "<br />
	<input type='radio' name='eversion_recdel' value='2' " . (!$eversion_yes?"checked='checked'":"") . "/> " . EVERSION_A32 . "<br />
	<input type='radio' name='eversion_recdel' value='3' /> " . EVERSION_A33 . "
	<input type='checkbox' name='eversion_okdel' value='1' />" . EVERSION_A34 . "</td></tr>
	<tr><td colspan='2' class='fcaption'>
	<input type='submit' name='submits' value='" . EVERSION_A35 . "' class='tbox' /></td></tr>
	</table></form>";
}

$ns->tablerender(EVERSION_A1, $eversion_text);

require_once(e_ADMIN . "footer.php");

function gen_file()
{
    global $e107, $PLUGINS_DIRECTORY;
    // Generate the file containing version info
    $evrsn_db = new DB;
    // $evrsn_array = array();
    // Retrieve all plugins
    $evrsn_db->db_Select("eversion", "*");
    $xmlout = "<?xml version=\"1.0\" ?>
	<plugins>";
    while ($evrsn_row = $evrsn_db->db_Fetch())
    {
        extract($evrsn_row);
        // used for text version
        $evrsn_array[] = array("plugin" => $eversion_name, "version" => $eversion_major . "." . $eversion_minor . "." . $eversion_beta, "date" => "111", "URL" => $e107->base_path . $PLUGINS_DIRECTORY . "eversion/eversion.php?0.view." . $eversion_id);
        // used for xml version
        $xmlout .= "<plugin>" . $eversion_name . " </plugin>";
        $xmlout .= "<version>" . $eversion_major . "." . $eversion_minor . "." . $eversion_beta . "</version>";
        $xmlout .= "<date>" . $eversion_updated . " </date>";
        $xmlout .= "<author>" . $eversion_author . " </author>";
        $xmlout .= "<title>" . $eversion_title . " </title>";
        $xmlout .= "<URL>" . $e107->base_path . $PLUGINS_DIRECTORY . "eversion/eversion.php?0.view." . $eversion_id . "</URL>";
        $xmlout .= "<dlpath>" . (empty($eversion_dlpath)?" ":$eversion_dlpath) . "</dlpath>";
    } // while
    $xmlout .= "</plugins>";
    $evrsn_ser = serialize($evrsn_array);
    $evrsn_fp = fopen("./xml/eversion.txt", "w");
    fwrite($evrsn_fp, $evrsn_ser);
    fclose($evrsn_fp);
    $evrsn_fp = fopen("./xml/eversion.xml", "w");
    fwrite($evrsn_fp, $xmlout);
    fclose($evrsn_fp);
}

?>
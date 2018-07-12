<?php
require_once("../../class2.php");
if (!defined('e107_INIT')) { exit; }
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
require_once(e_HANDLER . "userclass_class.php");
require_once(e_ADMIN . "auth.php");
$eclassf_action = $_POST['eclassf_action'];
$eclassf_edit = false;
// * If we are updating then update or insert the record
if ($eclassf_action == 'update')
{
    $eclassf_id = $_POST['eclassf_id'];
    if ($eclassf_id == 0)
    {
        // New record so add it
        $eclassf_args = "
		'0',
		'" . $tp->toDB($_POST['eclassf_ccatid']) . "',
		'" . $tp->toDB($_POST['eclassf_subname']) . "',
		'" . $tp->toDB($_POST['eclassf_subicon']) . "'";
        if ($sql->db_Insert("eclassf_subcats", $eclassf_args))
        {
            $eclassf_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . ECLASSF_A28 . "</strong></td></tr>";
        }
    }
    else
    {
        // Update existing
        $eclassf_args = "
		eclassf_ccatid='" . $tp->toDB($_POST['eclassf_ccatid']) . "',
		eclassf_subname='" . $tp->toDB($_POST['eclassf_subname']) . "',
		eclassf_subicon='" . $tp->toDB($_POST['eclassf_subicon']) . "'

		where eclassf_subid='$eclassf_id'";
        if ($sql->db_Update("eclassf_subcats", $eclassf_args))
        {
            // Changes saved
            $eclassf_msg .= "<tr><td class='forumheader3' colspan='2'><b>" . ECLASSF_A28 . "</b></td></tr>";
        }
    }
}
// We are creating, editing or deleting a record
if ($eclassf_action == 'dothings')
{
    $eclassf_id = $_POST['eclassf_selcat'];
    $eclassf_id2 = $_POST['eclassf_maincat'];
    $eclassf_do = $_POST['eclassf_recdel'];
    $eclassf_dodel = false;
    switch ($eclassf_do)
    {
        case '1': // Edit existing record
            {
                // We edit the record

                $sql->db_Select("eclassf_subcats", "*", "eclassf_subid='$eclassf_id'");
                $eclassf_row = $sql->db_Fetch() ;
                extract($eclassf_row);
                $eclassf_edit = true;
                break;
            }
        case '2': // New category
            {
                // Create new record
                $eclassf_id = 0;
                // set all fields to zero/blank
				$eclassf_ccatid=$eclassf_id2;
                $eclassf_edit = true;
                break;
            }
        case '3':
            {
                // delete the record
                if ($_POST['eclassf_okdel'] == '1')
                {
                    if ($sql->db_Select("eclassf_ads", "eclassf_cid", " where eclassf_ccat='$eclassf_id'", "nowhere"))
                    {
                        $eclassf_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . ECLASSF_A29 . "</strong></td></tr>";
                    }
                    else
                    {
                        if ($sql->db_Delete("eclassf_subcats", " eclassf_subid='$eclassf_id'"))
                        {
                            $eclassf_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . ECLASSF_A30 . "</strong></td></tr>";
                        }
                        else
                        {
                            $eclassf_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . ECLASSF_A31 . "</strong></td></tr>";
                        }
                    }
                }
                else
                {
                    $eclassf_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . ECLASSF_A32 . "</strong></td></tr>";
                }

                $eclassf_dodel = true;
                $eclassf_edit = false;
            }
    }

    if (!$eclassf_dodel)
    {

        $sql2->db_Select("eclassf_cats", "eclassf_catid,eclassf_catname", " order by eclassf_catname", "nowhere");
        while ($eclassf_row = $sql2->db_Fetch())
        {
            extract($eclassf_row);
            if ($maincat == 0)
            {
                $maincat = $eclassf_ccatid;
            }
            $eclassf_catopt1 .= "<option value='$eclassf_catid'" .
            ($eclassf_catid == $eclassf_ccatid?" selected='selected'":"") . ">$eclassf_catname</option>";
        }
            $eclassf_iconlist="<select name='eclassf_subicon' class='tbox'>";
        if ($handle = opendir("./images/icons"))
        {
            $eclassf_iconlist .= "<option value=\"\"> </option>";
            while (false !== ($file = readdir($handle)))
            {
                if ($file <> "." && $file <> "..")
                    $eclassf_iconlist .= "<option value=\"" . $file . "\" " .
                    ($file == $eclassf_subicon ? " selected " : " ") . ">" . $file . "</option>";
            }

            closedir($handle);
        }
        $eclassf_iconlist.="</select>";
        $eclassf_text .= "
		<form id='eclassfupdate' method='post' action='" . e_SELF . "'>

		<table style='width:97%;' class='fborder'>
		<tr><td colspan='2' class='fcaption'>" . ECLASSF_A17 . "
		<input type='hidden' value='$eclassf_ccatid' name='eclassf_maincat' />
		<input type='hidden' value='$eclassf_id' name='eclassf_id' />
		<input type='hidden' value='update' name='eclassf_action' /></td></tr>
		$eclassf_msg
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . ECLASSF_A36 . "</td><td  class='forumheader3'>	<select name='eclassf_ccatid' class='tbox' >$eclassf_catopt1</select></td></tr>
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . ECLASSF_A35 . "</td><td  class='forumheader3'><input type='text' class='tbox' name='eclassf_subname' value='$eclassf_subname' /><br /></td></tr>
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . ECLASSF_95 . "</td><td  class='forumheader3'>".$eclassf_iconlist."</td></tr>
		<tr><td colspan='2' class='fcaption'><input type='submit' name='submits' value='" . ECLASSF_A24 . "' class='tbox' /></td></tr>
		</table></form>";
    }
}
if (!$eclassf_edit)
{
    // Get the category names to display in combo box
    // then display actions available
    $eclassf_id2 = $_POST['eclassf_maincat'];
    if (!$_POST['eclassf_maincat'] > 0)
    {
        $maincat = 0;
    }
    else
    {
        $maincat = $_POST['eclassf_maincat'];
    }

    if ($sql2->db_Select("eclassf_cats", "eclassf_catid,eclassf_catname", " order by eclassf_catname", "nowhere"))
    {
        while ($eclassf_row = $sql2->db_Fetch())
        {
            extract($eclassf_row);
            if ($maincat == 0)
            {
                $maincat = $eclassf_catid;
            }
            $eclassf_catopt1 .= "<option value='$eclassf_catid'" .
            ($eclassf_id2 == $eclassf_catid?" selected='selected'":"") . ">$eclassf_catname</option>";
        }
    }
    else
    {
        $eclassf_catopt .= "<option value='0'>" . ECLASSF_A18 . "</option>";
    }
    $eclassf_yes=false;
    if ($sql2->db_Select("eclassf_subcats", "eclassf_subid,eclassf_ccatid,eclassf_subname", " where eclassf_ccatid='" . $maincat . "' order by eclassf_subname", "nowhere"))
    {
    $eclassf_yes=true;
        while ($eclassf_row = $sql2->db_Fetch())
        {
            #extract($eclassf_row);

            $eclassf_catopt .= "<option value='".$eclassf_row['eclassf_subid']."'" .
            ($eclassf_id ==  $eclassf_row['eclassf_subid']?" selected='selected'":"") . ">".$eclassf_row['eclassf_subname']."</option>";
        }
    }
    else
    {
        $eclassf_catopt .= "<option value='0'>" . ECLASSF_A34 . "</option>";
    }

    $eclassf_text .= "
	<form id='eclassfform' method='post' action='" . e_SELF . "'>

	<table width='97%' class='fborder'>
	<tr><td colspan='2' class='fcaption'>" . ECLASSF_A3 . "	<input type='hidden' value='donothings' name='eclassf_action' /></td></tr>
	$eclassf_msg
	<tr><td style='width:20%;' class='forumheader3'>" . ECLASSF_A3 . "</td><td  class='forumheader3'>
	<select name='eclassf_maincat' class='tbox' onchange='this.form.submit()'>$eclassf_catopt1</select></td></tr>
	<tr><td colspan='2' class='fcaption'>" . ECLASSF_A33 . "</td></tr>
		<tr><td style='width:20%;' class='forumheader3'>" . ECLASSF_A33 . "</td><td  class='forumheader3'>
	<select name='eclassf_selcat' class='tbox'>$eclassf_catopt</select></td></tr>
	<tr><td style='width:20%;' class='forumheader3'>" . ECLASSF_A19 . "</td><td  class='forumheader3'>
	<input type='radio' name='eclassf_recdel' value='1' ".($eclassf_yes?"checked='checked'":"disabled='disabled'")." /> " . ECLASSF_A20 . "<br />
	<input type='radio' name='eclassf_recdel' value='2' ".(!$eclassf_yes?"checked='checked'":"")."/> " . ECLASSF_A21 . "<br />
	<input type='radio' name='eclassf_recdel' value='3' /> " . ECLASSF_A22 . "
	<input type='checkbox' name='eclassf_okdel' value='1' />" . ECLASSF_A23 . "</td></tr>
	<tr><td colspan='2' class='fcaption'>
	<input type='button' name='submits' value='" . ECLASSF_A24 . "' class='tbox' onclick='this.form.eclassf_action.value=\"dothings\";this.form.submit()' /></td></tr>
	</table></form>";
}

$ns->tablerender(ECLASSF_A1, $eclassf_text);

require_once(e_ADMIN . "footer.php");

?>
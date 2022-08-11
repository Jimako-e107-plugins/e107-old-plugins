<?php
/*
+---------------------------------------------------------------+
|        Recipe Menu v2.00 - by Barry
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
    exit;
}

if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "recipe_menu/languages/admin/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "recipe_menu/languages/admin/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "recipe_menu/languages/admin/English.php");
}
require_once(e_HANDLER . "userclass_class.php");
require_once(e_ADMIN . "auth.php");
require_once(e_HANDLER . "cache_handler.php");
$recipe_menu_action = $_POST['recipe_menu_action'];
$recipe_menu_edit = false;
// * If we are updating then update or insert the record
if ($recipe_menu_action == 'update')
{
    $recipe_menu_id = $_POST['recipe_menu_id'];
    if ($recipe_menu_id == 0)
    {
        // New record so add it
        $recipe_menu_args = "
		'0',
		'" . $tp->toDB($_POST['recipe_category_name']) . "',
		'" . $tp->toDB($_POST['recipe_category_description']) . "'," . time().",
		'" . $tp->toDB($_POST['recipe_category_icon']) . "'";
        if ($sql->db_Insert("recipemenu_category", $recipe_menu_args))
        {
            $recipe_menu_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . RCPEMENU_A26 . "</strong></td></tr>";
        }
        else
        {
            $recipe_menu_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . RCPEMENU_A27 . "</strong></td></tr>";
        }
    }
    else
    {
        // Update existing
        $recipe_menu_args = "
		recipe_category_name='" . $tp->toDB($_POST['recipe_category_name']) . "',
		recipe_category_description='" . $tp->toDB($_POST['recipe_category_description']) . "',
		recipe_category_icon='" . $tp->toDB($_POST['recipe_category_icon']) . "',
		recipe_category_updated='" . time() . "'
		where recipe_category_id='$recipe_menu_id'";
        if ($sql->db_Update("recipemenu_category", $recipe_menu_args))
        {
            // Changes saved
            $recipe_menu_msg .= "<tr><td class='forumheader3' colspan='2'><b>" . RCPEMENU_A28 . "</b></td></tr>";
        }
        else
        {
            $recipe_menu_msg .= "<tr><td class='forumheader3' colspan='2'><b>" . RCPEMENU_A29 . "</b></td></tr>";
        }
    }
        if ($pref['cachestatus'] == 1)
    {
        $e107cache->clear("recipetop_menu");
    }
}
// We are creating, editing or deleting a record
if ($recipe_menu_action == 'dothings')
{
    $recipe_menu_id = $_POST['recipe_menu_selcat'];
    $recipe_menu_do = $_POST['recipe_menu_recdel'];
    $recipe_menu_dodel = false;

    switch ($recipe_menu_do)
    {
        case '1': // Edit existing record
            {
                // We edit the record
                $sql->db_Select("recipemenu_category", "*", "recipe_category_id='$recipe_menu_id'");
                $recipe_menu_row = $sql->db_Fetch() ;
                extract($recipe_menu_row);
                $recipe_menu_cap1 = RCPEMENU_A24;
                $recipe_menu_edit = true;
                break;
            }
        case '2': // New category
            {
                // Create new record
                $recipe_menu_id = 0;
                // set all fields to zero/blank
                $recipe_category_name = "";
                $recipe_category_description = "";
                $recipe_menu_cap1 = RCPEMENU_A23;
                $recipe_menu_edit = true;
                break;
            }
        case '3':
            {
                // delete the record
                if ($_POST['recipe_menu_okdel'] == '1')
                {
                    if ($sql->db_Select("recipemenu_recipe", "recipe_id", " where recipe_category='$recipe_menu_id'", "nowhere"))
                    {
                        $recipe_menu_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . RCPEMENU_A59 . "</strong></td></tr>";
                    }
                    else
                    {
                        if ($sql->db_Delete("recipemenu_category", " recipe_category_id='$recipe_menu_id'"))
                        {
                            $recipe_menu_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . RCPEMENU_A30 . "</strong></td></tr>";
                        }
                        else
                        {
                            $recipe_menu_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . RCPEMENU_A32 . "</strong></td></tr>";
                        }
                    }
                }
                else
                {
                    $recipe_menu_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . RCPEMENU_A31 . "</strong></td></tr>";
                }

                $recipe_menu_dodel = true;
                $recipe_menu_edit = false;
            }
    }

    if (!$recipe_menu_dodel)
    {
    // get file list
require_once(e_HANDLER . "file_class.php");
#print $pref['snow_fall'] ;
$recipe_menu_fl = new e_file;

$thumblist = $recipe_menu_fl->get_files(e_PLUGIN."recipe_menu/images/caticons/", '');
        $recipe_menu_text .= "
		<form id='recipeupdate' method='post' action='" . e_SELF . "'>

		<table style='width:97%;' class='fborder'>
		<tr><td colspan='2' class='fcaption'>$recipe_menu_cap1<input type='hidden' value='$recipe_menu_id' name='recipe_menu_id' />
		<input type='hidden' value='update' name='recipe_menu_action' /></td></tr>
		$recipe_menu_msg
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . RCPEMENU_A21 . "</td><td  class='forumheader3'><input type='text' class='tbox' name='recipe_category_name' value='" . $tp->toFORM($recipe_category_name) . "' /></td></tr>
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . RCPEMENU_A22 . "</td><td  class='forumheader3'><textarea rows='6' cols='50' class='tbox' name='recipe_category_description' >" . $tp->toFORM($recipe_category_description) . "</textarea><br /></td></tr>

		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . RCPEMENU_A129 . "</td><td  class='forumheader3'><input type='text' class='tbox' id='recipe_category_icon' name='recipe_category_icon' value='".$recipe_category_icon."' /><br />";
		foreach($thumblist as $icon)
{
    $recipe_menu_text  .= "<a href=\"javascript:insertext('" . $icon['fname'] . "','recipe_category_icon','newsicn')\"><img src='" . $icon['path'] . $icon['fname'] . "' style='border:0' alt='' /></a> ";
}
$recipe_menu_text .= "</td></tr>

		<tr><td colspan='2' class='fcaption'><input type='submit' name='submits' value='" . RCPEMENU_A10 . "' class='tbox' /></td></tr>
		</table></form>";
    }
}
if (!$recipe_menu_edit)
{
    // Get the category names to display in combo box
    // then display actions available
    $recipemenu2_yes = false;
    if ($sql2->db_Select("recipemenu_category", "recipe_category_id,recipe_category_name", " order by recipe_category_name", "nowhere"))
    {
        $recipemenu2_yes = true;
        while ($recipe_menu_row = $sql2->db_Fetch())
        {
            extract($recipe_menu_row);
            $recipe_menu_catopt .= "<option value='$recipe_category_id'" .
            ($recipe_menu_id == $recipe_category_id?" selected='selected'":"") . ">" . $tp->toFORM($recipe_category_name) . "</option>";
        }
    }
    else
    {
        $recipe_menu_catopt .= "<option value='0'>" . RCPEMENU_A19 . "</option>";
    }

    $recipe_menu_text .= "
	<form id='recipeform' method='post' action='" . e_SELF . "'>

	<table width='97%' class='fborder'>
	<tr><td colspan='2' class='fcaption'>" . RCPEMENU_A11 . "	<input type='hidden' value='dothings' name='recipe_menu_action' /></td></tr>
	$recipe_menu_msg
	<tr><td style='width:20%;' class='forumheader3'>" . RCPEMENU_A12 . "</td><td  class='forumheader3'><select name='recipe_menu_selcat' class='tbox'>$recipe_menu_catopt</select></td></tr>
	<tr><td style='width:20%;' class='forumheader3'>" . RCPEMENU_A18 . "</td><td  class='forumheader3'>
	<input type='radio' name='recipe_menu_recdel' value='1'  " . ($recipemenu2_yes?"checked='checked'":"disabled='disabled'") . " /> " . RCPEMENU_A13 . "<br />
	<input type='radio' name='recipe_menu_recdel' value='2'" . (!$recipemenu2_yes?"checked='checked'":"'") . " /> " . RCPEMENU_A14 . "<br />
	<input type='radio' name='recipe_menu_recdel' value='3' /> " . RCPEMENU_A15 . "
	<input type='checkbox' name='recipe_menu_okdel' value='1' />" . RCPEMENU_A16 . "</td></tr>
	<tr><td colspan='2' class='fcaption'>
	<input type='submit' name='submits' value='" . RCPEMENU_A17 . "' class='tbox' /></td></tr>


	</table></form>";
}

$ns->tablerender(RCPEMENU_A2, $recipe_menu_text);

require_once(e_ADMIN . "footer.php");

?>
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
require_once(e_HANDLER . "ren_help.php");
require_once(e_HANDLER . "cache_handler.php");
$recipemenu_action = $_POST['recipemenu_action'];

$recipemenu_edit = false;
// * If we are updating then update or insert the record
if ($recipemenu_action == 'update')
{
    if ($_POST['recipemenu_delpic'] == 1)
    {
        unlink("./images/pictures/" . $_POST['recipe_picture']);
        $_POST['recipe_picture'] = "";
    }
    $recipemenu_recipeid = $tp->toDB($_POST['recipemenu_recipeid']);
    $recipemenu_tmp = explode(".", $_POST['recipe_user'],2);
    $recipemenu_userid = $recipemenu_tmp[0];
    $recipemenu_username = $recipemenu_tmp[1];
    $file = $_POST['recipe_picture'];
    // Picture upload
    if (!empty($_FILES['file_userfile']['name']))
    {
        $userid = $recipemenu_userid . "_";
        require_once("upload_pic.php");
        $recipemenu_up = evrsn_fileup("file_userfile", e_PLUGIN . "recipe_menu/images/pictures/", $userid);
        switch ($recipemenu_up['result'])
        {
            case "0":
            default:
                $recipemenu_upmess = RCPEMENU_106;
                $cpic = "";
                $file = "";
                break;
            case "1":
                $recipemenu_upmess = "";
                $cpic = $recipemenu_up['filename'];
                $file = $recipemenu_up['filename'];
                chmod("images/pictures/" . $file, 0755);

                break;
            case "2":
                $recipemenu_upmess = RCPEMENU_107;
                $cpic = "";
                $file = "";
                break;
            case "3":
                $recipemenu_upmess = RCPEMENU_108;
                $cpic = "";
                $file = "";
                break;
        }
    }
    else
    {
        $file = $_POST['recipe_picture'];
    }
    // end picture upload
    if ($recipemenu_recipeid == 0)
    {
        // New record so add it
        $recipemenu_args = "'0',
		'" . $tp->toDB($_POST['recipe_name']) . "',
		'" . $recipemenu_userid . "." . $recipemenu_username . "',
		'" . $tp->toDB($_POST['recipe_servings']) . "',
		'" . $tp->toDB($_POST['recipe_preptime']) . "',
		'" . $tp->toDB($_POST['recipe_ingredients']) . "',
		'" . $tp->toDB($_POST['recipe_body']) . "',
		'" . $tp->toDB($_POST['recipe_source']) . "',
		'" . $tp->toDB($_POST['recipe_nutrition']) . "',
		'" . $tp->toDB($_POST['recipemenu_select']) . "','1'," . time() . ",'" . $file . "',0,''" ;
        if ($sql->db_Insert("recipemenu_recipes", $recipemenu_args))
        {
            $recipemenu_msg .= "<tr><td class='forumheader3' colspan='2'><b>" . RCPEMENU_A55 . "</b></td></tr>";
        }
        else
        {
            $recipemenu_msg .= "<tr><td class='forumheader3' colspan='2'><b>" . RCPEMENU_A56 . "</b></td></tr>";
        }
    }
    else
    {
        // Update existing
        $recipemenu_args = "
		recipe_name='" . $tp->toDB($_POST['recipe_name']) . "',
		recipe_author='" . $recipemenu_userid . "." . $recipemenu_username . "',
		recipe_servings='" . $tp->toDB($_POST['recipe_servings']) . "',
		recipe_preptime='" . $tp->toDB($_POST['recipe_preptime']) . "',
		recipe_ingredients='" . $tp->toDB($_POST['recipe_ingredients']) . "',
		recipe_body='" . $tp->toDB($_POST['recipe_body']) . "',
		recipe_source='" . $tp->toDB($_POST['recipe_source']) . "',
		recipe_nutrition='" . $tp->toDB($_POST['recipe_nutrition']) . "',
		recipe_category='" . $tp->toDB($_POST['recipemenu_select']) . "',
		recipe_approved='" . $tp->toDB($_POST['recipe_approved']) . "',
		recipe_picture='" . $file . "',
		recipe_posted='" . time() . "'
		where recipe_id='$recipemenu_recipeid'";
        if ($sql->db_Update("recipemenu_recipes", $recipemenu_args))
        {
            // Changes saved
            $recipemenu_msg .= "<tr><td class='forumheader3' colspan='2'><b>" . RCPEMENU_A53 . "</b> " . $recipemenu_upmess . "</td></tr>";
        }
        else
        {
            $recipemenu_msg .= "<tr><td class='forumheader3' colspan='2'><b>" . RCPEMENU_A54 . "</b></td></tr>";
        }
    }
    if ($pref['cachestatus'] == 1)
    {
        $e107cache->clear("recipetop_menu");
    }
}
// We are creating, editing or deleting a record
if ($recipemenu_action == 'dothings')
{
    $recipemenu_recipeid = $_POST['recipemenu_selcat'];
    $recipemenu_do = $_POST['recipemenu_recdel'];
    $recipemenu_dodel = false;
    switch ($recipemenu_do)
    {
        case '1': // Edit existing record
            {
                // We edit the record
                $sql->db_Select("recipemenu_recipes", "*", "recipe_id='$recipemenu_recipeid'");
                $recipemenu_row = $sql->db_Fetch() ;
                extract($recipemenu_row);
                $recipemenu_cap1 = RCPEMENU_A24;
                $recipemenu_edit = true;
                break;
            }
        case '2': // New category
            {
                // Create new record
                $recipemenu_recipeid = 0;
                // set all fields to zero/blank
                $recipe_name = "";
                $recipe_body = "";
                $recipemenu_cap1 = RCPEMENU_A23;
                $recipemenu_edit = true;
                break;
            }
        case '3':
            {
                // delete the record
                if ($_POST['recipemenu_okdel'] == '1')
                {
                    $sql->db_Select("recipemenu_recipes", "recipe_picture", " recipe_id='$recipemenu_recipeid'");
                    $recipemenu_row = $sql->db_Fetch();
                    extract($recipemenu_row);
                    if ($sql->db_Delete("recipemenu_recipes", " recipe_id='$recipemenu_recipeid'"))
                    {
                        $recipemenu_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . RCPEMENU_A58 . "</strong></td></tr>";
                        $sql->db_Delete("rate", " rate_table='recipe' and rate_itemid='$recipemenu_recipeid'");
                        unlink("./images/pictures/" . $recipe_picture);
                    }
                    else
                    {
                        $recipemenu_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . RCPEMENU_A57 . "</strong></td></tr>";
                    }
                }
                else
                {
                    $recipemenu_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . RCPEMENU_A31 . "</strong></td></tr>";
                }
                $recipemenu_dodel = true;
                $recipemenu_edit = false;
            }
    }

    if (!$recipemenu_dodel)
    {
        require_once(e_HANDLER . "ren_help.php");
        $recipemenu_poster = explode(".", $recipe_author);
        $recipemenu_posterid = $recipemenu_poster[0];
        $recipemenu_postername = $recipemenu_poster[1];
        $recipemenu_postername = substr($recipe_author, strpos($recipe_author, ".") + 1);
        $recipemenu_text .= "<form enctype='multipart/form-data' id='recipemenu_form' name='recipemenu_form' action='" . e_SELF . "' method='post'>
<input type='hidden' name='recipemenu_from' value='$recipemenu_from' />
<input type='hidden' name='recipemenu_recipeid' value='$recipemenu_recipeid' />
<input type='hidden' name='recipemenu_recipecat' value='$recipemenu_recipecat' />
<input type='hidden' name='recipemenu_action' value='update' />

<table class='fborder' style='width:97%;'>
<tr><td class='fcaption' colspan='2'>" . RCPEMENU_A52 . "</td></tr>";
        $recipemenu_select = "<select class='tbox' name='recipe_user'>";
        $recipemenu_tmp = explode(".", $recipe_author,2);
        $recipemenu_postername=$recipemenu_tmp[1];
        $sql->db_Select("user", "user_id,user_name", "order by user_name", "nowhere");
        if ($recipemenu_posterid == 0)
        {
            $recipemenu_select .= "<option value='0.$recipemenu_postername' " . ($recipemenu_posterid == 0?"selected='selected'":"") . ">Anon - " . $recipemenu_postername . "</option";
        }
        while ($recipemenu_row = $sql->db_Fetch())
        {
            extract($recipemenu_row);
            $recipemenu_select .= "<option value='$user_id." . $user_name . "' " . ($recipemenu_posterid == $user_id ?" selected='selected'":"") . ">" . $user_name . "</option>";
        } // while
        $recipemenu_select .= "</select>";
        $recipemenu_text .= "<tr><td class='forumheader3' style='width:30%;'>" . RCPEMENU_A42 . "</td>
			<td class='forumheader3' style='width:70%;'>" . $recipemenu_select . "</td></tr>";
        $recipemenu_selcat = "<select class='tbox' name='recipemenu_select'>";
        if ($sql->db_Select("recipemenu_category", "*", " order by recipe_category_name", "nowhere", ""))
        {
            $recipemenu_selcat .= "<option value='0' > </option>";
            while ($recipemenu_row = $sql->db_Fetch())
            {
                extract($recipemenu_row);
                $recipemenu_selcat .= "<option value='$recipe_category_id'";
                $recipemenu_selcat .= ($recipe_category == $recipe_category_id?" selected='selected'":"");
                $recipemenu_selcat .= ">" . $tp->toFORM($recipe_category_name) . "</option>";
            } // while
        }
        else
        {
            $recipemenu_selcat .= "<option value='0'>" . RCPEMENU_A19 . "</option>";
        }
        $recipemenu_selcat .= "</select>";
        $recipemenu_text .= "<tr>
<td class='forumheader3' style='width:30%;'>" . RCPEMENU_A12 . "</td>
<td class='forumheader3' style='width:70%;'>" . $recipemenu_selcat . "</td>
</tr>
    <tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_A50 . "</td>
	<td class='forumheader3' style='width:70%;vertical-align:top;'><input type='text' size='50' class='tbox' name='recipe_name' value='" . $recipe_name . "' /></td></tr>";
        // upload picture
        if (empty($recipe_picture) || !file_exists("./images/pictures/" . $recipe_picture))
        {
            $recipemenu_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . RCPEMENU_A108 . ":</td><td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
				<input class='tbox' name='file_userfile' type='file' size='47' />&nbsp;<br /><i>" . RCPEMENU_A109 . "</i></td></tr>";
        }
        else
        {
            $recipemenu_text .= "<tr>
				<td class=\"forumheader3\" style='vertical-align:top;' >" . RCPEMENU_A108 . ":</td>
				<td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>" . $recipe_picture . "<br /><i>" . RCPEMENU_A110 . "</i>
<br />" . RCPEMENU_A111 . "<input type='checkbox' name='recipemenu_delpic' value='1' />
				<input type='hidden' name='recipe_picture' value='" . $recipe_picture . "'</td>
				</tr>";
        }
        // end upload picture
        if ($pref['recipe_menu_preptime'] > 0)
        {
            $recipemenu_text .= "
    <tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_A76 . "</td>
	<td class='forumheader3' style='width:70%;vertical-align:top;'><input type='text' size='50' class='tbox' name='recipe_preptime' value='" . $tp->toFORM($recipe_preptime) . "' /></td></tr>";
        }
        if ($pref['recipe_menu_servings'] > 0)
        {
            $recipemenu_text .= "
    <tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_A75 . "</td>
	<td class='forumheader3' style='width:70%;vertical-align:top;'><input type='text' size='50' class='tbox' name='recipe_servings' value='" . $tp->toFORM($recipe_servings) . "' /></td></tr>";
        }
        $recipemenu_text .= "
    <tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_A73 . "</td>
	<td class='forumheader3' style='width:70%;vertical-align:top;'><textarea rows='8' cols='60' class='tbox' name='recipe_ingredients' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>" . $tp->toFORM($recipe_ingredients) . "</textarea><br />" . display_help("helpa") . "</td></tr>

    <tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_A51 . "</td>
	<td class='forumheader3' style='width:70%;vertical-align:top;'><textarea rows='8' cols='60' class='tbox' name='recipe_body' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>" . $tp->toFORM($recipe_body) . "</textarea><br />" . display_help("helpb") . " </td></tr> ";
        if ($pref['recipe_menu_nutrition'] > 0)
        {
            $recipemenu_text .= " <tr><td class = 'forumheader3' style = 'width:30%;vertical-align:top;' > " . RCPEMENU_A77 . " </td ><td class = 'forumheader3' style = 'width:70%;vertical-align:top;' ><textarea rows = '8' cols = '60' class = 'tbox' name = 'recipe_nutrition' onselect = 'storeCaret(this);' onclick = 'storeCaret(this);' onkeyup = 'storeCaret(this);' >" . $tp->toFORM($recipe_nutrition) . "</textarea><br />" . display_help("helpc") . "</td></tr>";
        }
        if ($pref['recipe_menu_credit'] > 0)
        {
            $recipemenu_text .= "
    <tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_A74 . "</td>
	<td class='forumheader3' style='width:70%;vertical-align:top;'><textarea rows='8' cols='60' class='tbox' name='recipe_source' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>" . $tp->toFORM($recipe_source) . "</textarea><br />" . display_help("helpd") . "</td></tr>";
        }

        if ($recipemenu_recipeid > 0)
        {
            $recipemenu_text .= " <tr><td class='forumheader3' style='width:30%;'>" . RCPEMENU_A44 . "</td>
	<td class='forumheader3' style='width:70%;'><input type='checkbox' class='tbox' value='1' name='recipe_approved' " .
            ($recipe_approved > 0?" checked='checked' ":"") . " /></td></tr>";
        }
        $recipemenu_text .= "<tr><td class='fcaption' colspan='2'><input type='submit' class='tbox' name='recipemenu_submit' value='" . RCPEMENU_A17 . "' /></td></tr>
</table></form>";
    }
}
if (!$recipemenu_edit)
{
    // Get the category names to display in combo box
    // then display actions available
    $recipemenu2_yes = false;
    if ($sql2->db_Select("recipemenu_recipes", "recipe_id,recipe_name", " order by recipe_name", "nowhere"))
    {
        $recipemenu2_yes = true;
        while ($recipemenu_row = $sql2->db_Fetch())
        {
            extract($recipemenu_row);
            $recipemenu_catopt .= "<option value='$recipe_id'" .
            ($recipemenu_id == $recipe_id?" selected='selected'":"") . ">" . $tp->toFORM($recipe_name) . "</option>";
        }
    }
    else
    {
        $recipemenu_catopt .= "<option value='0'>" . RCPEMENU_A60 . "</option>";
    }

    $recipemenu_text .= "
	<form id='recipeform' method='post' action='" . e_SELF . "'>

	<table style='width:97%;' class='fborder'>
	<tr><td colspan='2' class='fcaption'>" . RCPEMENU_A52 . "<input type='hidden' value='dothings' name='recipemenu_action' /></td></tr>
	$recipemenu_msg
	<tr><td style='width:20%;' class='forumheader3'>" . RCPEMENU_A49 . "</td><td  class='forumheader3'><select name='recipemenu_selcat' class='tbox'>$recipemenu_catopt</select></td></tr>
	<tr><td style='width:20%;' class='forumheader3'>" . RCPEMENU_A18 . "</td><td  class='forumheader3'>
	<input type='radio' name='recipemenu_recdel' value='1' " . ($recipemenu2_yes?"checked='checked'":"disabled='disabled'") . " /> " . RCPEMENU_A13 . "<br />
	<input type='radio' name='recipemenu_recdel' value='2' " . (!$recipemenu2_yes?"checked='checked'":"''") . " /> " . RCPEMENU_A14 . "<br />
	<input type='radio' name='recipemenu_recdel' value='3' /> " . RCPEMENU_A15 . "
	<input type='checkbox' name='recipemenu_okdel' value='1' />" . RCPEMENU_A16 . "</td></tr>
	<tr><td colspan='2' class='fcaption'><input type='submit' name='submits' value='" . RCPEMENU_A17 . "' class='tbox' /></td></tr>
	</table></form>";
}

$ns->tablerender(RCPEMENU_A2, $recipemenu_text);
require_once(e_ADMIN . "footer.php");

?>
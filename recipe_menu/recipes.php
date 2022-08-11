<?php
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "recipe_menu/languages/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "recipe_menu/languages/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "recipe_menu/languages/English.php");
}
require_once(e_HANDLER . "ren_help.php");
require_once(e_HANDLER . "rate_class.php");
$rater = new rater;
require_once(e_HANDLER . "comment_class.php");
$cobj = new comment;
if (!empty($pref['recipe_menu_ptitle']))
{
    define("e_PAGETITLE", $pref['recipe_menu_ptitle']);
}
define(e_WYSIWYG, false);
require_once(e_HANDLER . "emailprint_class.php");
$recipemenu_user = check_class($pref['recipe_menu_readclass']);
$recipemenu_submit = check_class($pref['recipe_menu_submitclass']);
if (!isset($gen))
{
    $gen = new convert;
}
if (!$recipemenu_user)
    // Check that valid user class to do this if not tell them
    {
        require_once(HEADERF);
    $recipemenu_text = "<table style='width:97%' class='fborder'>
	<tr><td class='fcaption'>" . RCPEMENU_1 . "</td></tr>
	<tr><td class='forumheader3'>" . RCPEMENU_2 . "</td></tr>
	<tr><td class='fcaption'><a href='" . SITEURL . "index.php'>" . RCPEMENU_66 . "</a></td></tr></table>";
    $ns->tablerender(RCPEMENU_1, $recipemenu_text);
    require_once(FOOTERF);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $recipemenu_from = intval($_POST['recipemenu_from']);
    $recipemenu_action = $_POST['recipemenu_action'];
    $recipemenu_recipeid = intval($_POST['recipemenu_recipeid']);
    $recipemenu_recipecat = intval($_POST['recipemenu_recipecat']);
    $recipemenu_recipeorder = intval($_POST['recipemenu_recipeorder']);
} elseif (e_QUERY)
{
    $tmp = explode(".", e_QUERY);
    $recipemenu_from = intval($tmp[0]);
    $recipemenu_action = $tmp[1];
    $recipemenu_recipeid = intval($tmp[2]);
    $recipemenu_recipecat = intval($tmp[3]);
    $recipemenu_recipeorder = intval($tmp[4]);
}
$recipemenu_from = ($recipemenu_from > 0?$recipemenu_from:0);
$recipemenu_recipeorder = (is_numeric($recipemenu_recipeorder)?$recipemenu_recipeorder:$pref['recipe_menu_deforder']);
$recipemenu_recipecat = (is_numeric($recipemenu_recipecat)?$recipemenu_recipecat:0);
$recipemenu_recipeid = (is_numeric($recipemenu_recipeid)?$recipemenu_recipeid:0);
$recipemenu_action = (empty($recipemenu_action)?"show":$recipemenu_action);
if ($_POST['recipemenu_select'] > 0)
{
    $recipemenu_recipecat = $_POST['recipemenu_select'];
}

if (isset($_POST['commentsubmit']))
{
    $tmp = explode(".", e_QUERY);
    $recipemenu_from = intval($tmp[0]);
    $recipemenu_action = "view";
    $recipemenu_recipeid = intval($tmp[2]);
    $cobj->enter_comment($_POST['author_name'], $_POST['comment'], "recipe", $recipemenu_recipeid, $pid, $_POST['subject']);
}

switch ($recipemenu_action)
{
    case "submitit":
        {
            // Picture upload
            if (!empty($_FILES['file_userfile']['name']))
            {
                $userid = USERID . "_";
                require_once("upload_pic.php");
                $recipemenu_up = evrsn_fileup("file_userfile", e_PLUGIN . "recipe_menu/images/pictures/", $userid);
                switch ($recipemenu_up['result'])
                {
                    case "0":
                    default:
                        $recipemenu_upmess = RCPEMENU_118;
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
                        $recipemenu_upmess = RCPEMENU_119;
                        $cpic = "";
                        $file = "";
                        break;
                    case "3":
                        $recipemenu_upmess = RCPEMENU_120;
                        $cpic = "";
                        $file = "";
                        break;
                }
            }
            else
            {
                $cpic = "";
            }
            // end picture upload
            if (USER)
            {
                $recipemenu_username = USERID . "." . USERNAME;
            }
            else
            {
                $recipemenu_username = (empty($_POST['recipemenu_username'])?"Anon":$_POST['recipemenu_username']);
                $recipemenu_username = "0." . $recipemenu_username ;
            }
            if (check_class())
            {
                $recipemenu_approved = 1;
            }
            else
            {
                $recipemenu_approved = 0;
            }
            $recipemenu_args = "'0',
		'" . $tp->toDB($_POST['recipe_name']) . "',
		'" . $tp->toDB($recipemenu_username) . "',
		'" . $tp->toDB($_POST['recipe_servings']) . "',
		'" . $tp->toDB($_POST['recipe_preptime']) . "',
		'" . $tp->toDB($_POST['recipe_ingredients']) . "',
		'" . $tp->toDB($_POST['recipe_body']) . "',
		'" . $tp->toDB($_POST['recipe_source']) . "',
		'" . $tp->toDB($_POST['recipe_nutrition']) . "',
		'" . $_POST['recipemenu_select'] . "','$recipemenu_approved'," . time() . ",'" . $file . "',0,''";
            $recipemenu_id = $sql->db_Insert("recipemenu_recipes", $recipemenu_args);
            if ($recipemenu_id)
            {
                $recipemenu_text .= "<table class='fborder' style='width:97%;'>
<tr><td class='fcaption' colspan='2'>" . RCPEMENU_11 . "</td></tr>
<tr><td class='forumheader3' colspan='2'>" . RCPEMENU_18 . " " . $recipemenu_upmess . "</td></tr>
<tr><td class='fcaption' colspan='2'><a href='?$recipemenu_from.show.$recipemenu_recipeid.$recipemenu_cat.$recipemenu_recipeorder'>" . RCPEMENU_15 . "</a></td>
</tr></table>";
                $edata_sn = array("user" => USERNAME, "itemtitle" => $_POST['recipe_name'], "catid" => intval($recipemenu_id));
                $e_event->trigger("rcppost", $edata_sn);
            }
            else
            {
                $recipemenu_text .= "<table class='fborder' style='width:97%;'>
<tr><td class='fcaption' colspan='2'>" . RCPEMENU_11 . "</td></tr>
<tr><td class='forumheader3' colspan='2'>" . RCPEMENU_19 . "</td></tr>
<tr><td class='fcaption' colspan='2'><a href='?$recipemenu_from.show.$recipemenu_recipeid.$recipemenu_cat.$recipemenu_recipeorder'>" . RCPEMENU_15 . "</a></td>
</tr></table>";
            }
        }
        break;
    case "view":
        {
            $recipemenu_text .= "<form id='recipe' action='" . e_SELF . "' method='post'>
			<table class='fborder' style='width:97%;'>";
            if (file_exists("./images/banner.png"))
            {
                $recipemenu_text .= "<tr><td class='forumheader3' colspan='2' style='text-align:center;'><img src='./images/banner.png' alt='' title='' /></td></tr>";
            }
            $recipemenu_text .= "
				<tr><td class='fcaption' colspan='2'>" . RCPEMENU_9 . "</td></tr>
				<tr><td class='forumheader3' colspan='2'><a href='?$recipemenu_from.show.$recipemenu_recipeid.$recipemenu_recipecat.$recipemenu_recipeorder'><img src='./images/updir.png' style='border:0;' alt='" . RCPEMENU_15 . "' title='" . RCPEMENU_15 . "' /></a>";
            $imode = (IMODE == "dark"?"dark":"lite");
            if ($pref['recipe_menu_email'] > 0)
            {
                $recipemenu_text .= "&nbsp;&nbsp;<a href='../../email.php?plugin:recipe_menu.$recipemenu_recipeid' title='" . RCPEMENU_92 . "'><img src='" . e_IMAGE . "generic/$imode/email.png' style='border:0;' alt='" . RCPEMENU_92 . "' /></a>&nbsp;";
            }
            if ($pref['recipe_menu_print'] > 0)
            {
                $recipemenu_text .= "&nbsp;&nbsp;<a href='../../print.php?plugin:recipe_menu.$recipemenu_recipeid' title='" . RCPEMENU_91 . "'><img src='" . e_IMAGE . "generic/$imode/printer.png' style='border:0;' alt='" . RCPEMENU_91 . "' /></a>";
            }
            if ($sql->db_Select("plugin", "*", "where plugin_path='pdf' and plugin_installflag=1", "nowhere", false))
            {
                $recipemenu_text .= "&nbsp;
			<a href='" . e_PLUGIN . "pdf/pdf.php?plugin:recipe_menu.$recipemenu_recipeid' title='" . RCPEMENU_138 . "'><img src='" . e_PLUGIN . "pdf/images/pdf_16.png' style='border:0;' alt='" . RCPEMENU_138 . "' /></a>";
            }
            $recipemenu_text .= "
			</td></tr>";
            if ($sql->db_Select("recipemenu_recipes", "*", "where recipe_id='$recipemenu_recipeid' and recipe_approved > '0'", "nowhere"))
            {
                $recipemenu_row = $sql->db_Fetch();
                extract($recipemenu_row);
                $comment_to = $recipemenu_recipeid;
                $comment_sub = "Re: " . $tp->toFORM($recipe_name, false);
                $recipemenu_postername = substr($recipe_author, strpos($recipe_author, ".") + 1);
                if (USER)
                {
                    $recipemenu_usercheck = USERID;
                }
                else
                {
                    $recipemenu_usercheck = $e107->getip();
                }
                $recipe_viewers .= $recipemenu_usercheck . ",";
                $sql->db_Update("recipemenu_recipes", "recipe_views = recipe_views + 1,recipe_viewers ='" . $recipe_viewers . "' where not find_in_set('$recipemenu_usercheck',recipe_viewers) and recipe_id='$recipemenu_recipeid'", false);
                if ($pref['cachestatus'] == 1)
                {
                    $e107cache->clear("recipetop_menu");
                }
                if (!empty($recipe_picture) && file_exists("./images/pictures/" . $recipe_picture))
                {
                    $recipemenu_text .= "<tr><td class='forumheader3' colspan='2' style='text-align:center;'>
					<img src='./images/pictures/" . $recipe_picture . "' style='border:0;' height='" . $pref['recipe_menu_height'] . "' width='" . $pref['recipe_menu_width'] . "' title='" . RCPEMENU_9 . "' alt='" . RCPEMENU_9 . "' />
					</td></tr>";
                }

                $recipemenu_text .= "
		<tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_14 . "</td><td class='forumheader3'>" . $tp->toHTML($recipe_name, false) . "</td></tr>";
                if ($pref['recipe_menu_preptime'] > 0)
                {
                    $recipemenu_text .= "
		<tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_21 . "</td><td class='forumheader3'>" . $tp->toHTML($recipe_preptime, false) . "</td></tr>";
                }
                if ($pref['recipe_menu_servings'] > 0)
                {
                    $recipemenu_text .= "
		<tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_22 . "</td><td class='forumheader3'>" . $tp->toHTML($recipe_servings, false) . "</td></tr>";
                }
                $recipemenu_text .= "
		<tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_90 . "</td><td class='forumheader3'>" . $tp->toHTML($recipe_ingredients, true) . "</td></tr>
		<tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_13 . "</td><td class='forumheader3'>" . $tp->toHTML($recipe_body, true) . "</td></tr>";
                if ($pref['recipe_menu_nutrition'] > 0)
                {
                    $recipemenu_text .= "
		<tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_23 . "</td><td class='forumheader3'>" . $tp->toHTML($recipe_nutrition, true) . "</td></tr>";
                }
                if ($pref['recipe_menu_credit'] > 0)
                {
                    $recipemenu_text .= "
		<tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_20 . "</td><td class='forumheader3'>" . $tp->toHTML($recipe_source, true) . "&nbsp;</td></tr>";
                }
                $recipemenu_text .= "
		<tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_10 . "</td><td class='forumheader3'>" . $tp->toHTML($recipemenu_postername, false) . "</td></tr>";
                $recipemenu_text .= "
		<tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_62 . "</td><td class='forumheader3'>" . $tp->toHTML($gen->convert_date($recipe_posted, "long"), false) . "</td></tr>";
                if ($pref['recipe_rating'] > 0)
                {
                    $RECIPE_VIEW_RATING .= "<tr><td style='text-align:right;vertical-align:top;' class='forumheader3' colspan='2'>";
                    if ($ratearray = $rater->getrating("recipe", $recipemenu_recipeid))
                    {
                        for($c = 1;
                            $c <= $ratearray[1];
                            $c++)
                        {
                            $RECIPE_VIEW_RATING .= "<img src='images/star.png' alt='' />";
                        }
                        if ($ratearray[2])
                        {
                            $RECIPE_VIEW_RATING .= "<img src='images/" . $ratearray[2] . ".png'  alt='' />";
                        }
                        if ($ratearray[2] == "")
                        {
                            $ratearray[2] = 0;
                        }
                        $RECIPE_VIEW_RATING .= "&nbsp;" . $ratearray[1] . "." . $ratearray[2] . " - " . $ratearray[0] . "&nbsp;";
                        $RECIPE_VIEW_RATING .= ($ratearray[0] == 1 ? RCPEMENU_89 : RCPEMENU_88);
                    }
                    else
                    {
                        $RECIPE_VIEW_RATING .= RCPEMENU_87;
                    }

                    if (!$rater->checkrated("recipe", $recipemenu_recipeid) && USER)
                    {
                        $RECIPE_VIEW_RATING .= $rater->rateselect("&nbsp;&nbsp;&nbsp;&nbsp; <b>" . RCPEMENU_85, "recipe", $recipemenu_recipeid) . "</b>";
                    }
                    else if (!USER)
                    {
                        $RECIPE_VIEW_RATING .= "&nbsp;";
                    }
                    else
                    {
                        $RECIPE_VIEW_RATING .= "&nbsp;" . RCPEMENU_86;
                    }
                    $RECIPE_VIEW_RATING .= "&nbsp;</td></tr>";

                    $recipemenu_text .= "$RECIPE_VIEW_RATING";
                }

                $recipemenu_text .= "<tr><td class='fcaption' colspan='2'>&nbsp;</td></tr>";
            }
            else
            {
                $recipemenu_text .= "<tr><td class='forumheader3' colspan='2'>" . RCPEMENU_73 . "</td></tr>";
            }
            $recipemenu_text .= "</table></form>";
        }
        break;
    case "submit":
        {
            if (!$recipemenu_submit)
                // Check that valid user class to do this if not tell them
                {
                    $recipemenu_text = "<table style='width:97%' class='fborder'>
	<tr><td class='fcaption'>" . RCPEMENU_1 . "</td></tr>
	<tr><td class='forumheader3'>" . RCPEMENU_67 . "</td></tr>
	<tr><td class='fcaption'><a href='" . SITEURL . "index.php'>" . RCPEMENU_66 . "</a></td></tr></table>";
                require_once(HEADERF);
                $ns->tablerender(RCPEMENU_1, $recipemenu_text);
                require_once(FOOTERF);
                exit;
            }
            require_once(e_HANDLER . "ren_help.php");
            $recipemenu_text .= "<script type=\"text/javascript\">
			function recipecheckform(thisform)
			{
				var testresults=true;
				if (thisform.recipe_name.value=='' || thisform.recipe_body.value=='' || thisform.recipe_ingredients.value=='' )
				{
					alert('" . RCPEMENU_65 . "');
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
		   				alert('" . RCPEMENU_64 . "');
				   		return false;
			   		}
				}
				return testresults;
			}
		</script>

			<form enctype='multipart/form-data' id='recipemenu_form' action='" . e_SELF . "' method='post' onsubmit='return recipecheckform(this)'>
<div>
<input type='hidden' name='recipemenu_from' value='$recipemenu_from' />
<input type='hidden' name='recipemenu_recipeid' value='$recipemenu_recipeid' />
<input type='hidden' name='recipemenu_recipecat' value='$recipemenu_recipecat' />
<input type='hidden' name='recipemenu_recipeorder' value='$recipemenu_recipeorder' />
<input type='hidden' name='subbed' value='no' />
<input type='hidden' name='recipemenu_action' value='submitit' />
</div>

<table class='fborder' style='width:97%;'>
<tr><td class='fcaption' colspan='2'>" . RCPEMENU_3 . "</td></tr>
<tr><td class='forumheader3' colspan='2'><a href='?$recipemenu_from.show.$recipemenu_recipeid.$recipemenu_recipecat.$recipemenu_recipeorder'><img src='./images/updir.png' style='border:0;' alt='" . RCPEMENU_15 . "' title='" . RCPEMENU_15 . "' /></a></td></tr>";
            if (USER)
            {
                $recipemenu_text .= "<tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_10 . "</td>
			<td class='forumheader3' style='width:70%;vertical-align:top;'>" . USERNAME . "</td></tr>";
            }
            else
            {
                $recipemenu_text .= "<tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_10 . "</td>
			<td class='forumheader3' style='width:70%;vertical-align:top;'><input type='text' class='tbox' name='recipemenu_username' /></td></tr>";
            }

            $recipemenu_selcat = "<select class='tbox' name='recipemenu_select'>";
            if ($sql->db_Select("recipemenu_category", "*", " order by recipe_category_name", "nowhere"))
            {
                while ($recipemenu_row = $sql->db_Fetch())
                {
                    extract($recipemenu_row);
                    $recipemenu_selcat .= "<option value='$recipe_category_id'";
                    $recipemenu_recipecat = ($recipemenu_recipecat > 0?$recipemenu_recipecat :$recipe_category_id);
                    $recipemenu_selcat .= ($recipe_category_id == $recipemenu_recipecat?" selected='selected'":"");
                    $recipemenu_selcat .= ">" . $recipe_category_name . "</option>";
                } // while
            }
            else
            {
                $recipemenu_selcat .= "<option value='0'>" . RCPEMENU_4 . "</option>";
            }
            $recipemenu_selcat .= "</select>";
            $recipemenu_text .= "<tr>
<td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_16 . "</td>
<td class='forumheader3' style='width:70%;vertical-align:top;'>" . $recipemenu_selcat . "</td>
</tr>
    <tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_14 . "</td>
	<td class='forumheader3' style='width:70%;vertical-align:top;'><input type='text' size='60' class='tbox' name='recipe_name' /></td></tr>";
            // Picture upload
            $recipemenu_text .= "<tr><td class=\"forumheader3\" style='vertical-align:top;' >" . RCPEMENU_104 . ":</td><td class=\"forumheader3\" style='width:80%;text-align:left;vertical-align:top;'>
				<input class='tbox' name='file_userfile' type='file' size='47' />&nbsp;<br /><i>" . RCPEMENU_105 . "</i></td></tr>";
            // end picture upload
            if ($pref['recipe_menu_preptime'] > 0)
            {
                $recipemenu_text .= "
    <tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_21 . "</td>
	<td class='forumheader3' style='width:70%;vertical-align:top;'><input type='text' size='60' class='tbox' name='recipe_preptime' /></td></tr>";
            }
            if ($pref['recipe_menu_servings'] > 0)
            {
                $recipemenu_text .= "
    <tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_22 . "</td>
	<td class='forumheader3' style='width:70%;vertical-align:top;'><input type='text' size='60' class='tbox' name='recipe_servings' /></td></tr>";
            }
            $recipemenu_text .= "
    <tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_90 . "</td>
	<td class='forumheader3' style='width:70%;vertical-align:top;'><textarea rows='8' cols='60' class='tbox' name='recipe_ingredients' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'></textarea><br />" . display_help("helpa") . "</td></tr>

    <tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_13 . "</td>
	<td class='forumheader3' style='width:70%;vertical-align:top;'><textarea rows='8' cols='60' class='tbox' name='recipe_body' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'></textarea><br />" . display_help("helpb") . "</td></tr>";
            if ($pref['recipe_menu_nutrition'] > 0)
            {
                $recipemenu_text .= "
    <tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_23 . "</td>
	<td class='forumheader3' style='width:70%;vertical-align:top;'><textarea rows='8' cols='60' class='tbox' name='recipe_nutrition' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'></textarea><br />" . display_help("helpc") . "</td></tr>";
            }
            if ($pref['recipe_menu_credit'] > 0)
            {
                $recipemenu_text .= "
    <tr><td class='forumheader3' style='width:30%;vertical-align:top;'>" . RCPEMENU_20 . "</td>
	<td class='forumheader3' style='width:70%;vertical-align:top;'><textarea rows='8' cols='60' class='tbox' name='recipe_source' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'></textarea><br />" . display_help("helpd") . "</td></tr>";
            }
            $recipemenu_text .= "
	<tr><td class='forumheader3' colspan='2'><em>" . RCPEMENU_69 . "</em></td></tr>
<tr><td class='fcaption' colspan='2'><input type='submit' class='tbox' name='recipemenu_submit' value='" . RCPEMENU_17 . "' /></td></tr>
</table></form>";
        }
        break;
    default:
        {
            $recipemenu_text .= "<form id='recipemenu_form' action='" . e_SELF . "' method='post'>
            <div>
    <input type='hidden' name='recipemenu_from' value='$recipemenu_from' />
<input type='hidden' name='recipemenu_recipeid' value='$recipemenu_recipeid' />
<input type='hidden' name='recipemenu_recipeorder' value='$recipemenu_recipeorder' />
</div>

<table class='fborder' style='width:97%;'>";
            if (file_exists("./images/banner.png"))
            {
                $recipemenu_text .= "<tr><td class='forumheader3' colspan='2' style='text-align:center;'><img src='./images/banner.png' alt='' title='' /></td></tr>";
            }
            $recipemenu_text .= "<tr><td class='fcaption' colspan='2'>" . RCPEMENU_3 . "
</td></tr>";
            $recipemenu_selcat = "<select class='tbox' name='recipemenu_select' onchange='this.form.submit()'>";
            $recipemenu_selcat .= "<option value='' >" . RCPEMENU_111 . "</option>";
            if ($sql->db_Select("recipemenu_category", "*", " order by recipe_category_name", "nowhere", false))
            {
                while ($recipemenu_row = $sql->db_Fetch())
                {
                    extract($recipemenu_row);
                    $recipemenu_selcat .= "<option value='$recipe_category_id' " . ($recipe_category_id == $recipemenu_recipecat?" selected='selected'":"");
                    $recipemenu_selcat .= ">" . $tp->toFORM($recipe_category_name) . "</option>";
                } // while
            }
            else
            {
                $recipemenu_selcat .= "<option value='0'>" . RCPEMENU_4 . "</option>";
            }
            $recipemenu_selcat .= "</select>";
            $recipemenu_text .= "<tr>
<td class='forumheader3' style='width:30%;'>" . RCPEMENU_5 . "</td>
<td class='forumheader3' style='width:70%;'>" . $recipemenu_selcat . "
<input type='submit' name='recipemenu_filter' value='" . RCPEMENU_6 . "' class='tbox' /></td>
</tr>
<tr><td class='forumheader3' colspan='2'>" . $tp->toHTML($recipemenu_desc) . "</td></tr></table></form>
";
            if ($recipemenu_recipecat > 0)
            {
                $recipemenu_where = "recipe_category='$recipemenu_recipecat'";
                $sql->db_Select("recipemenu_category", "*", "where recipe_category_id = '$recipemenu_recipecat'", "nowhere", false);
                $recipemenu_row = $sql->db_Fetch();
                $recipemenu_catname = $tp->toHTML($recipemenu_row['recipe_category_name']);
                if ($recipemenu_row['recipe_category_icon'] && file_exists("images/caticons/" . $recipemenu_row['recipe_category_icon']))
                {
                    $recipemenu_caticon = "<img src='images/caticons/" . $recipemenu_row['recipe_category_icon'] . "' style='border:0;' alt='' />";
                }
                else
                {
                    $recipemenu_caticon = "<img src='images/recipe_32.gif' style='border:0;' alt='' />";
                }
            }
            else
            {
                $recipemenu_where = "recipe_id > 0 ";
                $recipemenu_caticon = "<img src='images/recipe_32.gif' style='border:0;' alt='' />";
                $recipemenu_catname = RCPEMENU_111;
            }

            $recipemenu_text .= "<table class='fborder' style='width:97%;'>
<tr><td class='fcaption' colspan='3' style='vertical-align:middle;' >{$recipemenu_caticon} " . RCPEMENU_7 . " " . RCPEMENU_112 . " <strong>" . $tp->toHTML($recipemenu_catname) . "</strong> </td></tr>";
            // Switch to determine sort order
            // 1 sorts on the poster name using the substring_index in mysql to determine the poster name
            // 2 sorts on the posted/last edited date most recent first
            // 0 or none specified sorts on the recipe name
            switch ($recipemenu_recipeorder)
            {
                case "1":
                    $recipemenu_text .= "<tr>
		<td class='forumheader3' style='width:40%;'><a href='?$recipemenu_from.show.$recipemenu_recipeid.$recipemenu_recipecat.0' title='" . RCPEMENU_63 . RCPEMENU_60 . "' >  " . RCPEMENU_60 . "</a></td>
		<td class='forumheader3' style='width:30%;'><strong>" . RCPEMENU_61 . "</strong></td>
		<td class='forumheader3' style='width:30%;'><a href='?$recipemenu_from.show.$recipemenu_recipeid.$recipemenu_recipecat.2' title='" . RCPEMENU_63 . RCPEMENU_62 . "' >  " . RCPEMENU_62 . "</a></td>
		</tr>";
                    $recipemenu_arg = "select *,substring_index(recipe_author,'.',-1) as recipeord from " . MPREFIX . "recipemenu_recipes
					where $recipemenu_where and recipe_approved >0 order by recipeord asc limit $recipemenu_from," . $pref['recipe_menu_perpage'];
                    break;
                case "2":
                    $recipemenu_text .= "<tr>
		<td class='forumheader3' style='width:40%;'><a href='?$recipemenu_from.show.$recipemenu_recipeid.$recipemenu_recipecat.0' title='" . RCPEMENU_63 . RCPEMENU_60 . "' >  " . RCPEMENU_60 . "</a></td>
		<td class='forumheader3' style='width:30%;'><a href='?$recipemenu_from.show.$recipemenu_recipeid.$recipemenu_recipecat.1' title='" . RCPEMENU_63 . RCPEMENU_61 . "' >  " . RCPEMENU_61 . "</a></td>
		<td class='forumheader3' style='width:30%;'><strong>" . RCPEMENU_62 . "</strong></td>
		</tr>";
                    $recipemenu_arg = "select * from " . MPREFIX . "recipemenu_recipes
					where $recipemenu_where and recipe_approved >0 order by recipe_posted desc limit $recipemenu_from," . $pref['recipe_menu_perpage'];
                    break;
                default:
                    $recipemenu_text .= "<tr>
		<td class='forumheader3' style='width:40%;'><strong>" . RCPEMENU_60 . "</strong></td>
		<td class='forumheader3' style='width:30%;'><a href='?$recipemenu_from.show.$recipemenu_recipeid.$recipemenu_recipecat.1' title='" . RCPEMENU_63 . RCPEMENU_61 . "' >  " . RCPEMENU_61 . "</a></td>
		<td class='forumheader3' style='width:30%;'><a href='?$recipemenu_from.show.$recipemenu_recipeid.$recipemenu_recipecat.2' title='" . RCPEMENU_63 . RCPEMENU_62 . "' >  " . RCPEMENU_62 . "</a></td>
		</tr>";
                    $recipemenu_arg = "select * from " . MPREFIX . "recipemenu_recipes
					where $recipemenu_where and recipe_approved >0 order by recipe_name asc limit $recipemenu_from," . $pref['recipe_menu_perpage'];
                    break;
            } // switch
            $recipemenu_count = $sql->db_Count("recipemenu_recipes", "(*)", " where $recipemenu_where and recipe_approved > '0'");
            if ($sql->db_Select_gen($recipemenu_arg))
            {
                while ($recipemenu_row = $sql->db_Fetch())
                {
                    extract($recipemenu_row);
                    $RECIPE_VIEW_RATING = "";
                    if ($ratearray = $rater->getrating("recipe", $recipe_id))
                    {
                        for($c = 1;
                            $c <= $ratearray[1];
                            $c++)
                        {
                            $RECIPE_VIEW_RATING .= "<img src='images/star.png' alt='' />";
                        }
                        if ($ratearray[2])
                        {
                            $RECIPE_VIEW_RATING .= "<img src='images/" . $ratearray[2] . ".png'  alt='' />";
                        }
                        if ($ratearray[2] == "")
                        {
                            $ratearray[2] = 0;
                        }
                        // $RECIPE_VIEW_RATING .="&nbsp;" . $ratearray[1] . "." . $ratearray[2] . " - " . $ratearray[0] . "&nbsp;";
                        // $RECIPE_VIEW_RATING .=($ratearray[0]==1 ? RCPEMENU_89 : RCPEMENU_88);
                    }
                    else
                    {
                        $RECIPE_VIEW_RATING .= RCPEMENU_87;
                    }

                    $recipemenu_postername = substr($recipe_author, strpos($recipe_author, ".") + 1);

                    $recipemenu_posted = $gen->convert_date($recipe_posted, "short");
                    $recipemenu_text .= "<tr>
		<td class='forumheader3' style='width:50%;'><a href='?$recipemenu_from.view.$recipe_id.$recipemenu_recipecat.$recipemenu_recipeorder' >" . $tp->toHTML($recipe_name, false) . "</a>";
                    if ($pref['recipe_rating'] > 0)
                    {
                        $recipemenu_text .= "<br />$RECIPE_VIEW_RATING";
                    }
                    $recipemenu_text .= "</td>
		<td class='forumheader3' style='width:25%;'>" . $tp->toHTML($recipemenu_postername, false) . "</td>
		<td class='forumheader3' style='width:25%;'>" . $tp->toHTML($recipemenu_posted, false) . "</td>
		</tr>";
                } // while
            }
            else
            {
                $recipemenu_text .= "<tr>
		<td class='forumheader3' colspan='3'>" . RCPEMENU_8 . "</td>
		</tr>";
            }
            if (check_class($pref['recipe_stats']))
            {
                $recipemenu_text .= "<tr><td class='forumheader2' colspan='3' style='vertical-align:top;'><a href='recipe_stats.php'>" . RCPEMENU_153 . "</a></td></tr>";
            }
            $action = "show.$recipemenu_recipeid.$recipemenu_recipecat.$recipemenu_recipeorder";
            $parms = $recipemenu_count . "," . $pref['recipe_menu_perpage'] . "," . $recipemenu_from . "," . e_SELF . '?' . "[FROM]." . $action;
            $recipemenu_nextprev = $tp->parseTemplate("{NEXTPREV={$parms}}") . "";
            if (!empty($recipemenu_nextprev))
            {
                $recipemenu_text .= "<tr><td class='fcaption' colspan='3'>" . $recipemenu_nextprev . "</td></tr>";
            }

            if ($recipemenu_submit)
            {
                $recipemenu_text .= "<tr><td class='fcaption' colspan='3' style='vertical-align:top;'>";
                if (USER && check_class($pref['recipe_menu_adminclass']))
                {
                    $recipemenu_text .= "<a href='user_recipe.php'>" . RCPEMENU_113 . "</a>";
                }
                else
                {
                    $recipemenu_text .= "<a href='?$recipemenu_from.submit.$recipemenu_recipeid.$recipemenu_recipecat.$recipemenu_recipeorder'>" . RCPEMENU_11 . "</a>";
                }

                $recipemenu_text .= "</td></tr>";
            }

            $recipemenu_text .= "</table>";
        }
} // switch
require_once(HEADERF);
$ns->tablerender(RCPEMENU_1, $recipemenu_text);
if ($comment_to > 0 && $pref['recipe_comments'] > 0)
{
    $cobj->compose_comment("recipe", "comment", $comment_to, $width, $comment_sub, $showrate = false);
}

require_once(FOOTERF);

?>
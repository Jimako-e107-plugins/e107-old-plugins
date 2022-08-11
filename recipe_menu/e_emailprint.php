<?php

if (!defined('e107_INIT'))
{
    exit;
}
function print_item($id)
{
    global $tp, $pref, $sql;
    if (!check_class($pref['recipe_menu_readclass']))
    {
        return;
    }

    if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "recipe_menu/languages/" . e_LANGUAGE . ".php"))
    {
        include_once(e_PLUGIN . "recipe_menu/languages/" . e_LANGUAGE . ".php");
    }
    else
    {
        include_once(e_PLUGIN . "recipe_menu/languages/English.php");
    }
    $sql->db_Select("recipemenu_recipes", "*", "recipe_id=\"$id\" ");
    $row = $sql->db_Fetch();
    extract($row);
    $recipe_ingredients = $tp->toHTML($recipe_ingredients);
    $recipe_body = $tp->toHTML($recipe_body);
    $recipe_servings = $tp->toHTML($recipe_servings);
    $recipe_preptime = $tp->toHTML($recipe_preptime);
    $recipe_nutrition = $tp->toHTML($recipe_nutrition);
    $recipe_source = $tp->toHTML($recipe_source);
    $a_name = substr($recipe_author, strpos($recipe_author, ".") + 1);
    // $recipe_posted = $con -> convert_date($recipe_posted, "long");
    $text = "<span style=\"font-size: 16px; color: black; font-family: Tahoma, Verdana, Arial, Helvetica; text-decoration: none\">
	<b>" . $recipe_name . "</b></span>
<span style=\"font-size: 12px; color: black; font-family: Tahoma, Verdana, Arial, Helvetica; text-decoration: none\"><br /><br />";

    if (!empty($recipe_picture) && file_exists(e_PLUGIN . "recipe_menu/images/pictures/" . $recipe_picture))
    {
        $text .= "<img src='" . e_PLUGIN . "recipe_menu/images/pictures/" . $recipe_picture . "' style='border:0;' width='" . $pref['recipe_menu_width'] . "' height='" . $pref['recipe_menu_height'] . "'title='" . RCPEMENU_9 . "' alt='" . RCPEMENU_9 . "' /><br /><br />";
    }
    if (strlen($recipe_preptime))
    {
        $text .= "
	<b>" . RCPEMENU_102 . "</b>
	<br />$recipe_preptime	<br /><br />";
    }
    if (strlen($recipe_servings))
    {
        $text .= "
	<b>" . RCPEMENU_22 . "</b>
	<br />$recipe_servings	<br /><br />";
    }
    $text .= "
	<b>" . RCPEMENU_90 . "</b>
	<br />$recipe_ingredients 	<br /><br />";
    $text .= "
    <b>" . RCPEMENU_13 . "</b>
	<br />$recipe_body  <br /><br />";
    if (strlen($recipe_nutrition))
    {
        $text .= "
	<b>" . RCPEMENU_103 . "</b>
	<br />$recipe_nutrition<br /><br />";
    }
    if (strlen($recipe_source))
    {
        $text .= "
	<b>" . RCPEMENU_20 . "</b>
	<br />$recipe_source<br />";
    }
    require_once(e_HANDLER . 'date_handler.php');
    $rd = new convert;
    $recipe_date = $rd->convert_date($recipe_posted);
    $text .= "
<br /></span>
<span style=\"font-size: 10px; color: black; font-family: Tahoma, Verdana, Arial, Helvetica; text-decoration: none\">
	<em><b>" . RCPEMENU_61 . "</b><br />" . $a_name . RCPEMENU_57 . $recipe_date . "</em>
	<br /><br /><hr />
	" . RCPEMENU_137 ." ". SITENAME . "
	<br />
	( " . SITEURLBASE . e_PLUGIN_ABS . "recipe_menu/recipes.php?0.view." . $recipe_id . ".$recipe_category )
	</span>";

    require_once(e_HANDLER . 'bbcode_handler.php');
    $e_bb = new e_bbcode;
    $text = $e_bb->parseBBCodes($text, '');
    return $text;
}

function email_item($id)
{
    global $pref, $tp, $sql;
    if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "recipe_menu/languages/" . e_LANGUAGE . ".php"))
    {
        include_once(e_PLUGIN . "recipe_menu/languages/" . e_LANGUAGE . ".php");
    }
    else
    {
        include_once(e_PLUGIN . "recipe_menu/languages/English.php");
    }

    $recipe_arg = "select * from #recipemenu_recipes left join #recipemenu_category on recipe_category=recipe_category_id where recipe_id='$id'";
    $sql->db_Select_gen($recipe_arg);
    $row = $sql->db_Fetch();

    $message .= RCPEMENU_93 . " " . SITEURL . e_PLUGIN . "recipe_menu/recipes.php?0.view." . $id . "." . $row['recipe_category'] . "\n\n";
    $message .= RCPEMENU_94 . " - " . $row['recipe_name'] . "\n\n";
    $message .= RCPEMENU_99 . " - " . $row['recipe_category_name'] . "\n\n";
    $recipe_preptime = $row['recipe_preptime'];
    if (strlen($recipe_preptime))
    {
        $message .= RCPEMENU_102 . " - " . $recipe_preptime . "\n\n";
    }
    $recipe_servings = $row['recipe_servings'];
    if (strlen($recipe_servings))
    {
        $message .= RCPEMENU_22 . " - " . $recipe_servings . "\n\n";
    }
    $message .= RCPEMENU_95 . "\n" . $row['recipe_ingredients'] . "\n\n";
    $recipe_nutrition = $row['recipe_nutrition'];
    if (strlen($recipe_nutrition))
    {
        $message .= RCPEMENU_103 . "\n" . $recipe_nutrition . "\n\n";
    }
    $recipe_source = $row['recipe_source'];
    if (strlen($recipe_source))
    {
        $message .= RCPEMENU_20 . "\n" . $recipe_source . "\n\n";
    }
    $recipe_author = substr($row['recipe_author'], strpos($row['recipe_author'], ".") + 1);
    require_once(e_HANDLER . 'date_handler.php');
    $rd = new convert;
    $recipe_date = $rd->convert_date($row['recipe_posted']);
    $message .= RCPEMENU_96 . "\n" . $row['recipe_body'] . "\n\n" . RCPEMENU_97 . " " . $recipe_author . " " . RCPEMENU_98 . " " . $recipe_date . "\n";
    return $message;
}

function print_item_pdf($id)
{
    global $tp, $pref, $sql;
    if (!check_class($pref['recipe_menu_readclass']))
    {
        return;
    }

    if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "recipe_menu/languages/" . e_LANGUAGE . ".php"))
    {
        include_once(e_PLUGIN . "recipe_menu/languages/" . e_LANGUAGE . ".php");
    }
    else
    {
        include_once(e_PLUGIN . "recipe_menu/languages/English.php");
    }
    $sql->db_Select("recipemenu_recipes", "*", "recipe_id=\"$id\" ");
    $row = $sql->db_Fetch();
    extract($row);
    $recipe_ingredients = $tp->toHTML($recipe_ingredients);
    $recipe_body = $tp->toHTML($recipe_body);
    $recipe_servings = $tp->toHTML($recipe_servings);
    $recipe_preptime = $tp->toHTML($recipe_preptime);
    $recipe_nutrition = $tp->toHTML($recipe_nutrition);
    $recipe_source = $tp->toHTML($recipe_source);
    $a_name = substr($recipe_author, strpos($recipe_author, ".") + 1);
    // $recipe_posted = $con -> convert_date($recipe_posted, "long");
    $text = "<span style=\"font-size: 16px; color: black; font-family: Tahoma, Verdana, Arial, Helvetica; text-decoration: none\">
	<b>" . $recipe_name . "</b></span>
<span style=\"font-size: 12px; color: black; font-family: Tahoma, Verdana, Arial, Helvetica; text-decoration: none\"><br /><br />";

    if (!empty($recipe_picture) && file_exists(e_PLUGIN . "recipe_menu/images/pictures/" . $recipe_picture))
    {
        $text .= "<img src='" . e_PLUGIN . "recipe_menu/images/pictures/" . $recipe_picture . "' style='border:0;' width='" . $pref['recipe_menu_width'] . "' height='" . $pref['recipe_menu_height'] . "'title='" . RCPEMENU_9 . "' alt='" . RCPEMENU_9 . "' /><br /><br />";
    }
    if (strlen($recipe_preptime))
    {
        $text .= "
	<b>" . RCPEMENU_102 . "</b>
	<br />$recipe_preptime	<br /><br />";
    }
    if (strlen($recipe_servings))
    {
        $text .= "
	<b>" . RCPEMENU_22 . "</b>
	<br />$recipe_servings	<br /><br />";
    }
    $text .= "
	<b>" . RCPEMENU_90 . "</b>
	<br />$recipe_ingredients 	<br /><br />";
    $text .= "
    <b>" . RCPEMENU_13 . "</b>
	<br />$recipe_body  <br /><br />";
    if (strlen($recipe_nutrition))
    {
        $text .= "
	<b>" . RCPEMENU_103 . "</b>
	<br />$recipe_nutrition<br /><br />";
    }
    if (strlen($recipe_source))
    {
        $text .= "
	<b>" . RCPEMENU_20 . "</b>
	<br />$recipe_source<br />";
    }
    require_once(e_HANDLER . 'date_handler.php');
    $rd = new convert;
    $recipe_date = $rd->convert_date($recipe_posted);
    $text .= "
<br /></span>
<span style=\"font-size: 10px; color: black; font-family: Tahoma, Verdana, Arial, Helvetica; text-decoration: none\">
	<em><b>" . RCPEMENU_61 . "</b><br />" . $a_name . RCPEMENU_57 . $recipe_date . "</em>
	<br /><br /><hr />
	" . RCPEMENU_137 . " " . SITENAME . "
	<br />
	( " . SITEURLBASE . e_PLUGIN_ABS . "recipe_menu/recipes.php?0.view." . $recipe_id . ".$recipe_category.0 )
	</span>";

    require_once(e_HANDLER . 'bbcode_handler.php');
    $e_bb = new e_bbcode;
    $text = $e_bb->parseBBCodes($text, '');
    // the following defines are processed in the document properties of the pdf file
    // Do NOT add parser function to the variables, leave them as raw data !
    // as the pdf methods will handle this !
    $text = $text; //define text
    $creator = SITENAME; //define creator
    $author = "baz" . $faq_tmp[1]; //define author
    $title = "Recipe" . $id; //define title
    $subject = "Recipe"; //define subject
    $keywords = "test"; //define keywords

    // define url to use in the header of the pdf file
    $url = SITEURLBASE . e_PLUGIN_ABS . "recipe_menu/recipies.php?0.view." . $recipe_id . ".$recipe_category.0";
    // always return an array with the following data:
    return array($text, $creator, $author, $title, $subject, $keywords, $url);
}

?>
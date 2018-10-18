<?php
/*
+---------------------------------------------------------------+
|        Reviewer Plugin for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . "reviewer/languages/" . e_LANGUAGE . ".php");
require_once(e_PLUGIN . "reviewer/includes/reviewer_class.php");
require_once(e_PLUGIN . "reviewer/includes/reviewer_shortcodes.php");

function print_item($id)
{
    global $tp, $REVIEWER_PREF, $sql, $gen, $reviewer_shortcodes, $reviewer_logoexists, $reviewer_caticon, $reviewer_colspan, $reviewer_votes, $reviewer_items_picture,
    $reviewer_rate1, $reviewer_rate2, $reviewer_rate3, $reviewer_rate4, $reviewer_rate5, $reviewer_rate6, $reviewer_rate7, $reviewer_rate8, $reviewer_rate9, $reviewer_rate10,
    $reviewer_category_name, $reviewer_items_name, $reviewer_items_description, $reviewer_reviewer_postername, $reviewer_reviewer_posted, $reviewer_reviewer_review,
    $reviewer_reviewer_rate1, $reviewer_reviewer_rate2, $reviewer_reviewer_rate3, $reviewer_reviewer_rate4, $reviewer_reviewer_rate5, $reviewer_reviewer_rate6, $reviewer_reviewer_rate7, $reviewer_reviewer_rate8, $reviewer_reviewer_rate9, $reviewer_reviewer_rate10,
    $reviewer_category_rate1, $reviewer_category_rate2, $reviewer_category_rate3, $reviewer_category_rate4, $reviewer_category_rate5, $reviewer_category_rate6, $reviewer_category_rate7, $reviewer_category_rate8, $reviewer_category_rate9, $reviewer_category_rate10,
    $reviewer_use1, $reviewer_use2, $reviewer_use3, $reviewer_use4, $reviewer_use5, $reviewer_use6, $reviewer_use7, $reviewer_use8, $reviewer_use9, $reviewer_use10,$reviewer_rateo;
    if (!is_object($reviewer_obj))
    {
        $reviewer_obj = new reviewer;
    }
    if (file_exists(e_THEME . "reviewer_print_template.php"))
    {
        define(REVIEWER_TEMPLATE, e_THEME . "reviewer_print_template.php");
    }
    else
    {
        define(REVIEWER_TEMPLATE, e_PLUGIN . "reviewer/templates/reviewer_print_template.php");
    }
    if ($id < 0)
    {
        $id = $id * -1;
        // $reviewer_colspan = $REVIEWER_PREF['reviewer_use1'] + $REVIEWER_PREF['reviewer_use2'] + $REVIEWER_PREF['reviewer_use3'] + $REVIEWER_PREF['reviewer_use4'] + $REVIEWER_PREF['reviewer_use5'] + 3;
        $reviewer_arg = "select * from #reviewer_reviewer
    left join #reviewer_items on reviewer_reviewer_itemid = reviewer_items_id
    left join #reviewer_category on reviewer_items_catid=reviewer_category_id
where reviewer_reviewer_id={$id}
order by reviewer_reviewer_posted";
        if ($sql->db_Select_gen($reviewer_arg, false))
        {
            extract($sql->db_Fetch());
            if ($REVIEWER_PREF['reviewer_usecat'] == 1)
            {
                $reviewer_use1 = $reviewer_category_use1;
                $reviewer_use2 = $reviewer_category_use2;
                $reviewer_use3 = $reviewer_category_use3;
                $reviewer_use4 = $reviewer_category_use4;
                $reviewer_use5 = $reviewer_category_use5;
                $reviewer_use6 = $reviewer_category_use6;
                $reviewer_use7 = $reviewer_category_use7;
                $reviewer_use8 = $reviewer_category_use8;
                $reviewer_use9 = $reviewer_category_use9;
                $reviewer_use10 = $reviewer_category_use10;
            }
            else
            {
                // not using category then get the settings from prefs
                $reviewer_use1 = $REVIEWER_PREF['reviewer_use1'];
                $reviewer_use2 = $REVIEWER_PREF['reviewer_use2'];
                $reviewer_use3 = $REVIEWER_PREF['reviewer_use3'];
                $reviewer_use4 = $REVIEWER_PREF['reviewer_use4'];
                $reviewer_use5 = $REVIEWER_PREF['reviewer_use5'];
                $reviewer_use6 = $REVIEWER_PREF['reviewer_use6'];
                $reviewer_use7 = $REVIEWER_PREF['reviewer_use7'];
                $reviewer_use8 = $REVIEWER_PREF['reviewer_use8'];
                $reviewer_use9 = $REVIEWER_PREF['reviewer_use9'];
                $reviewer_use10 = $REVIEWER_PREF['reviewer_use10'];
            }
            $reviewer_caticon = $reviewer_category_icon;
            $reviewer_logoexists = (file_exists(e_PLUGIN . "reviewer/images/caticons/" . $reviewer_caticon) && is_readable(e_PLUGIN . "reviewer/images/caticons/" . $reviewer_caticon));

            define(e_PAGETITLE, REVIEWER_P003 . $reviewer_items_name);
            require_once(REVIEWER_TEMPLATE);
            $reviewer_text .= $tp->parsetemplate($REVIEWER_PRINTABLE_HEADER, false, $reviewer_shortcodes);
            $reviewer_item_edit = "<a href='" . e_SELF . "?0.edit.$reviewer_reviewer_id'><img src='" . e_IMAGE . "admin_images/edit_16.png' style='border:0px;'  alt='edit' /></a>";
            $reviewer_item_delete = "<a href='" . e_SELF . "?0.delete.$reviewer_reviewer_id'><img src='" . e_IMAGE . "admin_images/delete_16.png' style='border:0px;'  alt='edit' /></a>";
            $reviewer_tmp = explode(".", $reviewer_reviewer_postername, 2);
            $reviewer_reviewer_postername = $reviewer_tmp[1];
            $reviewer_rate1 = $reviewer_obj->rate_image($reviewer_items_rate1);
            $reviewer_rate2 = $reviewer_obj->rate_image($reviewer_items_rate2);
            $reviewer_rate3 = $reviewer_obj->rate_image($reviewer_items_rate3);
            $reviewer_rate4 = $reviewer_obj->rate_image($reviewer_items_rate4);
            $reviewer_rate5 = $reviewer_obj->rate_image($reviewer_items_rate5);
            $reviewer_rate6 = $reviewer_obj->rate_image($reviewer_items_rate6);
            $reviewer_rate7 = $reviewer_obj->rate_image($reviewer_items_rate7);
            $reviewer_rate8 = $reviewer_obj->rate_image($reviewer_items_rate8);
            $reviewer_rate9 = $reviewer_obj->rate_image($reviewer_items_rate9);
            $reviewer_rate10 = $reviewer_obj->rate_image($reviewer_items_rate10);
            $reviewer_rateo = $reviewer_obj->rate_image($reviewer_items_rate);
            $reviewer_text .= $tp->parsetemplate($REVIEWER_PRINTABLE_DETAIL, false, $reviewer_shortcodes);
            $reviewer_text .= $tp->parsetemplate($REVIEWER_PRINTABLE_FOOTER, false, $reviewer_shortcodes);
        }
        $reviewer_docomments = 1;
    }
    else
    {
        $reviewer_count = $sql->db_Select_gen("select * from #reviewer_items
	left join #reviewer_category on reviewer_items_catid= reviewer_category_id
	where reviewer_items_id=$id", false);
        if ($reviewer_count > 0)
        {
            extract($sql->db_Fetch());
            if ($REVIEWER_PREF['reviewer_usecat'] == 1)
            {
                $reviewer_use1 = $reviewer_category_use1;
                $reviewer_use2 = $reviewer_category_use2;
                $reviewer_use3 = $reviewer_category_use3;
                $reviewer_use4 = $reviewer_category_use4;
                $reviewer_use5 = $reviewer_category_use5;
                $reviewer_use6 = $reviewer_category_use6;
                $reviewer_use7 = $reviewer_category_use7;
                $reviewer_use8 = $reviewer_category_use8;
                $reviewer_use9 = $reviewer_category_use9;
                $reviewer_use10 = $reviewer_category_use10;
            }
            else
            {
                // not using category then get the settings from prefs
                $reviewer_use1 = $REVIEWER_PREF['reviewer_use1'];
                $reviewer_use2 = $REVIEWER_PREF['reviewer_use2'];
                $reviewer_use3 = $REVIEWER_PREF['reviewer_use3'];
                $reviewer_use4 = $REVIEWER_PREF['reviewer_use4'];
                $reviewer_use5 = $REVIEWER_PREF['reviewer_use5'];
                $reviewer_use6 = $REVIEWER_PREF['reviewer_use6'];
                $reviewer_use7 = $REVIEWER_PREF['reviewer_use7'];
                $reviewer_use8 = $REVIEWER_PREF['reviewer_use8'];
                $reviewer_use9 = $REVIEWER_PREF['reviewer_use9'];
                $reviewer_use10 = $REVIEWER_PREF['reviewer_use10'];
            }
            $reviewer_caticon = $reviewer_category_icon;
            $reviewer_logoexists = is_readable(e_PLUGIN . "reviewer/images/caticons/" . $reviewer_caticon);
            if ($REVIEWER_PREF['reviewer_usecat'] == 1)
            {
                $reviewer_colspan = $reviewer_category_use1 + $reviewer_category_use2 + $reviewer_category_use3 + $reviewer_category_use4 + $reviewer_category_use5 + $reviewer_category_use6 + $reviewer_category_use7 + $reviewer_category_use8 + $reviewer_category_use9 + $reviewer_category_use10 + 2;
            }
            else
            {
                $reviewer_colspan = $REVIEWER_PREF['reviewer_use1'] + $REVIEWER_PREF['reviewer_use2'] + $REVIEWER_PREF['reviewer_use3'] + $REVIEWER_PREF['reviewer_use4'] + $REVIEWER_PREF['reviewer_use5'] + $REVIEWER_PREF['reviewer_use6'] + $REVIEWER_PREF['reviewer_use7'] + $REVIEWER_PREF['reviewer_use8'] + $REVIEWER_PREF['reviewer_use9'] + $REVIEWER_PREF['reviewer_use10'] + 2;
            }
            $reviewer_votes = $reviewer_items_votes;
            $reviewer_rate1 = $reviewer_obj->rate_image($reviewer_items_rate1);
            $reviewer_rate2 = $reviewer_obj->rate_image($reviewer_items_rate2);
            $reviewer_rate3 = $reviewer_obj->rate_image($reviewer_items_rate3);
            $reviewer_rate4 = $reviewer_obj->rate_image($reviewer_items_rate4);
            $reviewer_rate5 = $reviewer_obj->rate_image($reviewer_items_rate5);
            $reviewer_rate6 = $reviewer_obj->rate_image($reviewer_items_rate6);
            $reviewer_rate7 = $reviewer_obj->rate_image($reviewer_items_rate7);
            $reviewer_rate8 = $reviewer_obj->rate_image($reviewer_items_rate8);
            $reviewer_rate9 = $reviewer_obj->rate_image($reviewer_items_rate9);
            $reviewer_rate10 = $reviewer_obj->rate_image($reviewer_items_rate10);

            $reviewer_rateo = $reviewer_obj->rate_image($reviewer_items_rate);
            $reviewer_reviewer_ep = $reviewer_itemid;
            define(e_PAGETITLE, REVIEWER_P002 . $reviewer_items_name);
            require_once(REVIEWER_TEMPLATE);
            $reviewer_text .= $tp->parsetemplate($REVIEWER_PRINTITEM_HEADER, false, $reviewer_shortcodes);
            $reviewer_arg = "select * from #reviewer_reviewer
where reviewer_reviewer_itemid={$id}
order by reviewer_reviewer_posted";
            if ($sql->db_Select_gen($reviewer_arg, false))
            {
                while ($reviewer_list = $sql->db_Fetch())
                {
                    extract($reviewer_list);

                    $reviewer_a = explode(".", $reviewer_reviewer_postername);
                    $reviewer_b = explode(".", $reviewer_postername);
                    if ($reviewer_a[0] == $reviewer_b[0])
                    {
                        $reviewer_allow_new = false;
                    }
                    $reviewer_tmp = explode(".", $reviewer_reviewer_postername, 2);
                    $reviewer_reviewer_postername = $reviewer_tmp[1];
                    // $reviewer_item_detail = "<a href='" . e_SELF . "?0.view.$reviewer_reviewer_id'>" . REVIEWER_H005 . "</a>";
                    $reviewer_rate1 = $reviewer_obj->rate_image($reviewer_items_rate1);
                    $reviewer_rate2 = $reviewer_obj->rate_image($reviewer_items_rate2);
                    $reviewer_rate3 = $reviewer_obj->rate_image($reviewer_items_rate3);
                    $reviewer_rate4 = $reviewer_obj->rate_image($reviewer_items_rate4);
                    $reviewer_rate5 = $reviewer_obj->rate_image($reviewer_items_rate5);
                    $reviewer_rate6 = $reviewer_obj->rate_image($reviewer_items_rate6);
                    $reviewer_rate7 = $reviewer_obj->rate_image($reviewer_items_rate7);
                    $reviewer_rate8 = $reviewer_obj->rate_image($reviewer_items_rate8);
                    $reviewer_rate9 = $reviewer_obj->rate_image($reviewer_items_rate9);
                    $reviewer_rate10 = $reviewer_obj->rate_image($reviewer_items_rate10);
                    $reviewer_rateo = $reviewer_obj->rate_image($reviewer_items_rate);
                    $reviewer_text .= $tp->parsetemplate($REVIEWER_PRINTITEM_DETAIL, false, $reviewer_shortcodes);
                }
            }
            else
            {
                $reviewer_text .= $tp->parsetemplate($REVIEWER_PRINTITEM_NOITEMS, false, $reviewer_shortcodes);
            }
            $reviewer_text .= $tp->parsetemplate($REVIEWER_PRINTITEM_FOOTER, false, $reviewer_shortcodes);
        }
        else
        {
            require_once(REVIEWER_TEMPLATE);
            $reviewer_text .= $tp->parsetemplate($REVIEWER_PRINTITEM_NOITEMS, false, $reviewer_shortcodes);
        }
    }
    return $reviewer_text;
}

function email_item($id)
{
    global $reviewer_obj, $tp, $REVIEWER_PREF, $sql;

    if (!is_object($reviewer_obj))
    {
        $reviewer_obj = new reviewer;
    }
    if ($id < 0)
    {
        $id = intval($id * -1);
        $reviewer_arg = "select * from #reviewer_reviewer
    left join #reviewer_items on reviewer_reviewer_itemid = reviewer_items_id
    left join #reviewer_category on reviewer_items_catid=reviewer_category_id
where reviewer_reviewer_id={$id}
order by reviewer_reviewer_posted";
        $sql->db_Select_gen($reviewer_arg, false);

        $row = $sql->db_Fetch();

        $message .= " <a href='" . SITEURL . e_PLUGIN . "reviewer/reviewer.php?0.view.$id'>" . REVIEWER_EM1 . "</a><br /><br />";
        $message .= "<strong>" . REVIEWER_EM2 . "</strong> - " . $row['reviewer_items_name'] . "<br />";
        $message .= "<strong>" . REVIEWER_EM3 . "</strong> - " . $row['reviewer_category_name'] . " <br /><br />";

        $reviewer_author = substr($row['reviewer_reviewer_postername'], strpos($row['reviewer_reviewer_postername'], ".") + 1);
        require_once(e_HANDLER . 'date_handler.php');
        $rd = new convert;
        $reviewer_date = $rd->convert_date($row['reviewer_reviewer_posted'], "short");
        $message .= "<strong>" . REVIEWER_EM4 . "</strong> " . $reviewer_author . " <strong>" . REVIEWER_EM5 . "</strong> " . $reviewer_date . "<br />";
        return $message;
    }
    else
    {
        $reviewer_arg = "select * from #reviewer_items
	left join #reviewer_category on reviewer_items_catid= reviewer_category_id
	where reviewer_items_id=$id";
        $sql->db_Select_gen($reviewer_arg, false);

        $row = $sql->db_Fetch();

        $message .= " <a href='" . SITEURL . e_PLUGIN . "reviewer/reviewer.php?0.item.$id'>" . REVIEWER_EM1 . "</a><br /><br />";
        $message .= "<strong>" . REVIEWER_EM2 . "</strong> - " . $row['reviewer_items_name'] . "<br />";
        $message .= "<strong>" . REVIEWER_EM3 . "</strong> - " . $row['reviewer_category_name'] . " <br /><br />";
        $message .= "<strong>" . REVIEWER_EM6 . "</strong> - " . $row['reviewer_items_rate'] . " ";
        $message .= "<strong>" . REVIEWER_EM7 . "</strong> - " . $row['reviewer_items_votes'] . " " . REVIEWER_EM8 . " <br /><br />";
        // require_once(e_HANDLER . 'date_handler.php');
        // $rd = new convert;
        // $reviewer_date = $rd->convert_date($row['reviewer_reviewer_posted'], "short");
        // $message .= "<strong>" . REVIEWER_EM4 . "</strong> " . $reviewer_author . " <strong>" . REVIEWER_EM5 . "</strong> " . $reviewer_date . "<br />";
        return $message;
    }
}
/*
function print_item_pdf($id)
{
    global $reviewer_id, $reviewer_name, $reviewer_picture, $reviewer_preptime, $reviewer_ingredients, $reviewer_servings,
    $reviewer_body, $reviewer_source, $reviewer_nutrition, $reviewermenu_postername, $reviewer_posted, $RECIPE_VIEW_RATING,
    $reviewer_shortcodes, $reviewer_obj, $tp, $RECIPE_PREF, $sql, $gen;
    if (file_exists(e_THEME . "recipe_template.php"))
    {
        define(REVIEWER_TEMPLATE, e_THEME . "recipe_pdf_template.php");
    }
    else
    {
        define(REVIEWER_TEMPLATE, e_PLUGIN . "recipe_menu/templates/recipe_pdf_template.php");
    }
    if (!is_object($reviewer_obj))
    {
        $reviewer_obj = new recipe;
    }

    if (!check_class($RECIPE_PREF['recipe_menu_readclass']))
    {
        return;
    }
    if (!isset($gen))
    {
        $gen = new convert;
    }
    if (!isset($reviewer_rater))
    {
        $reviewer_rater = new rater;
    }

    $sql->db_Select("recipemenu_recipes", "*", "recipe_id='$id' ");
    $row = $sql->db_Fetch();
    extract($row);
    $reviewer_id = $id;
    $reviewer_posted = $gen->convert_date($reviewer_posted, "long");
    $reviewermenu_temp = explode(".", $reviewer_author, 2);
    $reviewermenu_postername = $reviewermenu_temp[1];
    $RECIPE_VIEW_RATING = "";
    // if ($reviewer_ratearray = $reviewer_rater->getrating("recipe", $id))
    // {
    // for($c = 1; $c <= $reviewer_ratearray[1];$c++)
    // {
    // $RECIPE_VIEW_RATING .= "<img src='" . e_PLUGIN . "recipe_menu/images/star.png' alt='' />";
    // }
    // if ($reviewer_ratearray[2])
    // {
    // $RECIPE_VIEW_RATING .= "<img src='" . e_PLUGIN . "recipe_menu/images/" . $reviewer_ratearray[2] . ".png'  alt='' />";
    // }
    // if ($reviewer_ratearray[2] == "")
    // {
    // $reviewer_ratearray[2] = 0;
    // }
    // }
    // else
    // {
    // $RECIPE_VIEW_RATING .= RCPEMENU_87;
    // }
    require_once(REVIEWER_TEMPLATE);
    $reviewermenu_text .= $tp->parsetemplate($RECIPE_PDF_HEADER, false, $reviewer_shortcodes);
    $reviewermenu_text .= $tp->parsetemplate($RECIPE_PDF_DETAIL, false, $reviewer_shortcodes);
    $reviewermenu_text .= $tp->parsetemplate($RECIPE_PDF_FOOTER, false, $reviewer_shortcodes);
    // the following defines are processed in the document properties of the pdf file
    // Do NOT add parser function to the variables, leave them as raw data !
    // as the pdf methods will handle this !
    $creator = SITENAME; //define creator
    $author = $reviewermenu_postername; //define author
    $title = "Recipe " . $id; //define title
    $subject = $reviewer_name; //define subject
    $keywords = ""; //define keywords
    // define url to use in the header of the pdf file
    $url = SITEURLBASE ;
    // always return an array with the following data:
    // print $reviewermenu_text;
    return array($reviewermenu_text, $creator, $author, $title, $subject, $keywords, $url);
}

*/
?>
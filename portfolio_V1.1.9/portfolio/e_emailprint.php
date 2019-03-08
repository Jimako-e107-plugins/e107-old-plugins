<?php
/*
+---------------------------------------------------------------+
|        Portfolio manager for e107 v7xx - by Father Barry
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
function print_item($id)
{
    global $tp, $portfolio_obj, $sql, $portfolio_shortcodes, $portfolio_id, $portfolio_path,
    $portfolio_person_name, $portfolio_person_contact, $portfolio_person_phone, $portfolio_person_email, $portfolio_person_websiteurl, $portfolio_person_websitename,
    $portfolio_view_rating, $portfolio_person_showemail, $portfolio_person_showphone, $portfolio_person_affiliate1, $portfolio_person_affiliate2, $portfolio_person_affiliate3,
    $portfolio_person_biography, $portfolio_person_additional, $portfolio_person_portrait1, $portfolio_person_portraittext1, $portfolio_person_portrait2, $portfolio_person_portraittext2,
    $portfolio_person_gallery1, $portfolio_person_gallerytext1, $portfolio_person_gallery2, $portfolio_person_gallerytext2, $portfolio_person_gallery3, $portfolio_person_gallerytext3,
    $portfolio_person_gallery4, $portfolio_person_gallerytext4, $portfolio_person_gallery5, $portfolio_person_gallerytext5, $portfolio_person_gallery6, $portfolio_person_gallerytext6;
    require_once(e_PLUGIN . "portfolio/includes/portfolio_class.php");
    if (!is_object($portfolio_obj))
    {
        $portfolio_obj = new portfolio;
    }
    require_once(e_HANDLER . "rate_class.php");
    $rater = new rater;
    require_once(e_HANDLER . "date_handler.php");
    $con = new convert;
    if (is_readable(THEME . "portfolio_template.php"))
    {
        define(PORTFOLIO_THEME, THEME . "portfolio_template.php");
    }
    else
    {
        define(PORTFOLIO_THEME, e_PLUGIN . "portfolio/templates/portfolio_template.php");
    }
    if ($sql->db_Select("portfolio_person", "*", " portfolio_person_id='$id'"))
    {
        $row = $sql->db_Fetch();
        extract($row);
        if ($ratearray = $rater->getrating("portfolio", $id))
        {
            if (defined("IMODE"))
            {
                $portfolio_star = e_IMAGE . "rate/" . IMODE;
            }
            else
            {
                $image = $portfolio_star = e_IMAGE . "rate/lite";
            }
            for($c = 1;
                $c <= $ratearray[1];
                $c++)
            {
                $portfolio_view_rating .= "<img src='{$portfolio_star}/star.png' alt='' />";
            }
            if ($ratearray[2])
            {
                $portfolio_view_rating .= "<img src='{$portfolio_star}/" . $ratearray[2] . ".png'  alt='' />";
            }
            if ($ratearray[2] == "")
            {
                $ratearray[2] = 0;
            }
            $portfolio_view_rating .= "&nbsp;" . $ratearray[1] . "." . $ratearray[2] . " - " . $ratearray[0] . "&nbsp;";
            $portfolio_view_rating .= ($ratearray[0] == 1 ? PORTFOLIO_36 : PORTFOLIO_35);
        }
        else
        {
            $portfolio_view_rating .= PORTFOLIO_38;
        }

#        if (!$rater->checkrated("portfolio", $id) && USER)
#        {
#            $portfolio_view_rating .= $rater->rateselect("&nbsp;<b>" . PORTFOLIO_39, "portfolio", $id) . "</b>";
#        }
#        else if (!USER)
#        {
#            $portfolio_view_rating .= "&nbsp;";
#        }
#        else
#        {
           # $portfolio_view_rating .= "&nbsp;&nbsp;" . PORTFOLIO_37;
#        }
        $portfolio_view_rating .= "&nbsp;";

        $portfolio_tmp = explode(".", $portfolio_person_poster, 2);
        $portfolio_path = e_PLUGIN . "portfolio/uploads/portfolio/" . $portfolio_tmp[0] . "/";
        $portfolio_lu = $con->convert_date($portfolio_person_updated, "long");
        require_once(PORTFOLIO_THEME);
        require_once(e_PLUGIN."portfolio/includes/portfolio_shortcodes.php");
        $portfolio_text = $tp->parseTemplate(PORTFOLIO_PRINT_HEADER($portfolio_person_id, $portfolio_person_name), false, $portfolio_shortcodes);
    }
    return $portfolio_text;
}

function email_item($id)
{
    global $tp, $sql;
    require_once(e_PLUGIN . "portfolio/includes/portfolio_class.php");
    if (!is_object($portfolio_obj))
    {
        $portfolio_obj = new portfolio;
    }

    $sql->db_Select("portfolio_person", "*", " portfolio_person_id='$id'");
    $row = $sql->db_Fetch();

    $portfolio_message = PORTFOLIO_42 . "<br /><br /><a href='" . SITEURL . e_PLUGIN . "portfolio/portfolio.php?0.show.$id'>" . PORTFOLIO_41 . "</a><br /><br />";
    $portfolio_message .= PORTFOLIO_43 . "\"" . $tp->toHTML($row['portfolio_person_name'], false) . "\"<br /><br /><br />" ;

    return $portfolio_message;
}

function print_item_pdf($id)
{
    // NOTE THIS IS NOT YET FEASIBLE DUE TO FAILINGS IN THE PDF PLUGIN
    global $tp, $portfolio_obj, $sql, $portfolio_shortcodes, $portfolio_id, $portfolio_path,
    $portfolio_person_name, $portfolio_person_contact, $portfolio_person_phone, $portfolio_person_email, $portfolio_person_websiteurl, $portfolio_person_websitename,
    $portfolio_view_rating, $portfolio_person_showemail, $portfolio_person_showphone, $portfolio_person_affiliate1, $portfolio_person_affiliate2, $portfolio_person_affiliate3,
    $portfolio_person_biography, $portfolio_person_additional, $portfolio_person_portrait1, $portfolio_person_portraittext1, $portfolio_person_portrait2, $portfolio_person_portraittext2,
    $portfolio_person_gallery1, $portfolio_person_gallerytext1, $portfolio_person_gallery2, $portfolio_person_gallerytext2, $portfolio_person_gallery3, $portfolio_person_gallerytext3,
    $portfolio_person_gallery4, $portfolio_person_gallerytext4, $portfolio_person_gallery5, $portfolio_person_gallerytext5, $portfolio_person_gallery6, $portfolio_person_gallerytext6;
    require_once(e_PLUGIN . "portfolio/includes/portfolio_class.php");
    if (!is_object($portfolio_obj))
    {
        $portfolio_obj = new portfolio;
    }
    require_once(e_HANDLER . "rate_class.php");
    $rater = new rater;
    require_once(e_HANDLER . "date_handler.php");
    $con = new convert;
    if (is_readable(THEME . "portfolio_template.php"))
    {
        define(PORTFOLIO_THEME, THEME . "portfolio_template.php");
    }
    else
    {
        define(PORTFOLIO_THEME, e_PLUGIN . "portfolio/templates/portfolio_template.php");
    }
    if ($sql->db_Select("portfolio_person", "*", " portfolio_person_id='$id'"))
    {
        $row = $sql->db_Fetch();
        extract($row);
        if ($ratearray = $rater->getrating("portfolio", $id))
        {
            if (defined("IMODE"))
            {
                $portfolio_star = e_IMAGE . "rate/" . IMODE;
            }
            else
            {
                $image = $portfolio_star = e_IMAGE . "rate/lite";
            }
            for($c = 1;
                $c <= $ratearray[1];
                $c++)
            {
                $portfolio_view_rating .= "<img src='{$portfolio_star}/star.png' alt='' />";
            }
            if ($ratearray[2])
            {
                $portfolio_view_rating .= "<img src='{$portfolio_star}/" . $ratearray[2] . ".png'  alt='' />";
            }
            if ($ratearray[2] == "")
            {
                $ratearray[2] = 0;
            }
            $portfolio_view_rating .= "&nbsp;" . $ratearray[1] . "." . $ratearray[2] . " - " . $ratearray[0] . "&nbsp;";
            $portfolio_view_rating .= ($ratearray[0] == 1 ? PORTFOLIO_36 : PORTFOLIO_35);
        }
        else
        {
            $portfolio_view_rating .= PORTFOLIO_38;
        }

        if (!$rater->checkrated("portfolio", $id) && USER)
        {
            $portfolio_view_rating .= $rater->rateselect("&nbsp;<b>" . PORTFOLIO_39, "portfolio", $id) . "</b>";
        }
        else if (!USER)
        {
            $portfolio_view_rating .= "&nbsp;";
        }
        else
        {
            $portfolio_view_rating .= "&nbsp;&nbsp;" . PORTFOLIO_37;
        }
        $portfolio_view_rating .= "&nbsp;";

        $portfolio_tmp = explode(".", $portfolio_person_poster, 2);
        $portfolio_path = e_PLUGIN . "portfolio/uploads/portfolio/" . $portfolio_tmp[0] . "/";
        $portfolio_lu = $con->convert_date($portfolio_person_updated, "long");
        require_once(PORTFOLIO_THEME);
        $portfolio_text = $tp->parseTemplate(PORTFOLIO_PRINT_HEADER($portfolio_person_id, $portfolio_person_name), false, $portfolio_shortcodes);
    }
    else
    {
        $portfolio_text = FAQLAN_66;
    }
    // the following defines are processed in the document properties of the pdf file
    // Do NOT add parser function to the variables, leave them as raw data !
    // as the pdf methods will handle this !
    $text = $portfolio_text; //define text
    $creator = SITENAME; //define creator
    $author = $faq_tmp[1]; //define author
    $title = "FAQ" . $id; //define title
    $subject = "Question"; //define subject
    $keywords = "test"; //define keywords
    // define url to use in the header of the pdf file
    $url = SITEURLBASE . e_PLUGIN_ABS . "faq/faq.php?0.cat." . $row['faq_id'];
    // always return an array with the following data:
    return array($text, $creator, $author, $title, $subject, $keywords, $url);
}

?>
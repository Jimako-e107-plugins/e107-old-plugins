<?php

if (!defined('e107_INIT'))
{
    exit;
}
function print_item($id)
{
    global $tp, $FAQ_PREF, $sql;
    require_once("includes/faq_class.php");
    if (!is_object($faq_obj))
    {
        $faq_obj = new FAQ;
    }
    if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "faq/languages/" . e_LANGUAGE . ".php"))
    {
        include_once(e_PLUGIN . "faq/languages/" . e_LANGUAGE . ".php");
    }
    else
    {
        include_once(e_PLUGIN . "faq/languages/English.php");
    }
    require_once(e_HANDLER . "date_handler.php");
    $con = new convert;
    $faq_arg = "select * from #faq left join #faq_info on faq_parent=faq_info_id where faq_id='" . intval($id) . "' and find_in_set(faq_info_class,'" . USERCLASS_LIST . "')";
    if ($sql->db_Select_Gen($faq_arg))
    {
        $row = $sql->db_Fetch();
        extract($row);
        $faq_question = $tp->toHTML($faq_question, false);
        $faq_answer = $tp->toHTML($faq_answer, true);
        // Check if new format
        $faq_tmp = explode(".", $faq_author, 2);
        $faq_userid = $faq_tmp[0];
        $faq_posted = $con->convert_date($faq_datestamp, "long");
        $text = "
<span style=\"font-size: 12px; color: black; font-family: Tahoma, Verdana, Arial, Helvetica; text-decoration: none\">
	<b>" . FAQLAN_62 . "</b>
	<br /><br /><b>" . FAQLAN_55 . "</b>
	<br />$faq_question
	<br /><br /><b>" . FAQLAN_56 . "</b>
	<br />$faq_answer</span><span style=\"font-size: 10px; color: black; font-family: Tahoma, Verdana, Arial, Helvetica; text-decoration: none\">";
        if ($FAQ_PREF['faq_showposter'] > 0)
        {
            $text .= "<br /><br /><em><b>" . FAQLAN_64 . "</b><br />" . FAQLAN_65 . " " . $faq_posted . " " . FAQLAN_63 . " " . $faq_tmp[1] . " " . $faq_nlr . "</em><br /><br />";
        }
        $text .= "<br />
	<hr />
	" . SITENAME . "
	</span>";
    }
    else
    {
        $text = FAQLAN_66;
    }
    // $text = str_replace("graphics/", e_PLUGIN . "faq/graphics/", $text);
    // require_once(e_HANDLER . 'bbcode_handler.php');
    // $faq_bb = new e_bbcode;
    // $text = $faq_bb->parseBBCodes($text, '');
    return $text;
}

function email_item($id)
{
    global $tp, $sql;
    require_once("includes/faq_class.php");
    if (!is_object($faq_obj))
    {
        $faq_obj = new FAQ;
    }

    $faq_arg = "select * from #faq left join #faq_info on faq_parent=faq_info_id where faq_id='" . intval($id) . "'";
    $sql->db_Select_gen($faq_arg);
    $row = $sql->db_Fetch();

    $faq_message = FAQLAN_70 . "\n\n<a href='" . SITEURL . e_PLUGIN . "faq/faq.php?0.cat." . $row['faq_parent'] . "." . $id . "'>" . SITEURL . e_PLUGIN . "faq/faq.php?0.cat." . $row['faq_parent'] . "." . $id . "</a>\n\n";
    $faq_message .= FAQLAN_71 . "\"" . $tp->toHTML($row['faq_question']) . "\"\n\n" ;

    return $faq_message;
}

function print_item_pdf($id)
{
    global $tp, $content_shortcodes;
    global $tp, $FAQ_PREF, $sql;
    require_once("includes/faq_class.php");
    if (!is_object($faq_obj))
    {
        $faq_obj = new FAQ;
    }
    require_once(e_HANDLER . "date_handler.php");
    $con = new convert;
    $faq_arg = "select * from #faq left join #faq_info on faq_parent=faq_info_id where faq_id='" . intval($id) . "' and find_in_set(faq_info_class,'" . USERCLASS_LIST . "')";
    if ($sql->db_Select_Gen($faq_arg))
    {
        $row = $sql->db_Fetch();
        extract($row);
        $faq_question = $tp->toHTML($faq_question, false);
        $faq_answer = $tp->toHTML($faq_answer, true);
        // Check if new format
        $faq_tmp = explode(".", $faq_author, 2);
        $faq_userid = $faq_tmp[0];

        $faq_posted = $con->convert_date($faq_datestamp, "long");
        $text = "
<span style=\"font-size: 12px; color: black; font-family: Tahoma, Verdana, Arial, Helvetica; text-decoration: none\">
	<b>" . FAQLAN_62 . "</b>
	<br /><br /><b>" . FAQLAN_55 . "</b>
	<br />$faq_question
	<br /><br /><b>" . FAQLAN_56 . "</b>
	<br />$faq_answer</span><span style=\"font-size: 10px; color: black; font-family: Tahoma, Verdana, Arial, Helvetica; text-decoration: none\">";
        if ($FAQ_PREF['faq_showposter'] > 0)
        {
            $text .= "<br /><hr><br /><em><b>" . FAQLAN_64 . "</b><br />" . FAQLAN_65 . " " . $faq_posted . " " . FAQLAN_63 . " " . $faq_tmp[1] . " " . $faq_nlr . "</em><br /><br />";
        }
        $text .= "<br />
	<hr />
	" . SITENAME . "
	</span>";
    }
    else
    {
        $text = FAQLAN_66;
    }
    // the following defines are processed in the document properties of the pdf file
    // Do NOT add parser function to the variables, leave them as raw data !
    // as the pdf methods will handle this !
    $text = $text; //define text
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
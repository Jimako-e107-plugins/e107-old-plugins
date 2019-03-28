<?php

require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
require_once(e_HANDLER . "comment_class.php");

$mes = e107::getMessage();

require_once("includes/faq_class.php");
if (!is_object($faq_obj))
{
    $faq_obj = new FAQ;
}
if (is_readable(THEME . "faq_template.php"))
{
    define(FAQ_THEME, THEME . "faq_template.php");
}
else
{
    define(FAQ_THEME, e_PLUGIN . "faq/templates/faq_template.php");
}
require_once(e_PLUGIN . "faq/includes/faq_shortcodes.php");
$e_wysiwyg = "data";

if (!defined('FAQLAN_FAQ')) {
   define("FAQLAN_FAQ", "FAQ");
}

if (!$faq_obj->faq_read)
{
    require_once(FAQ_THEME);
    $faq_text .= $tp->parseTemplate($FAQ_NO_ACCESS, true, $faq_shortcodes);
    require_once(HEADERF);
    $faq_obj->tablerender(FAQLAN_FAQ , $faq_text, 'faq');
    require_once(FOOTERF);
    exit;
}
if (!is_object($faq_rater))
{
    $faq_rater = new rater;
}
if (e_QUERY)
{
    $faq_qs = explode(".", e_QUERY);
    if (is_numeric($faq_qs[0]))
    {
        $faq_from = intval($faq_qs[0]);
        $faq_action = $faq_qs[1];
        $id = intval($faq_qs[2]);
        $idx = intval($faq_qs[3]);
    }
    else
    {
        $faq_from = 0;
        $faq_action = $faq_qs[0];
        $id = intval($faq_qs[1]);
        $idx = intval($faq_qs[2]);
    }
}
else
{
    $faq_action = $_POST['action'];
    $id = intval($_POST['id']);
    $faq_from = intval($_POST['faq_from']);

    $idx = intval($_POST['idx']);
}
// *
// *
// experimental work on auto meta tag for description and keyworms
// *
// *
if ($idx > 0 && $faq_action == 'cat' && $sql->db_Select('faq', 'faq_question,faq_answer', 'where faq_id=' . $idx, 'nowhere', false))
{
    extract($sql->db_Fetch());

    define("e_PAGETITLE", FAQLAN_150 . $idx . ' : ' . $tp->toFORM($faq_question));
    $search = array ('@<script[^>]*?>.*?</script>@si', // Strip out javascript
        '@<[\/\!]*?[^<>]*?>@si', // Strip out HTML tags
        '@{[\/\!]*?[^{}]*?}@si', // Strip out e107 tags
        '@&(quot|#34);@i', // Replace HTML entities
        '@&(amp|#38);@i',
        '@&(lt|#60);@i',
        '@&(gt|#62);@i',
        '@&(nbsp|#160);@i',
        '@&(iexcl|#161);@i',
        '@&(cent|#162);@i',
        '@&(pound|#163);@i',
        '@&(copy|#169);@i',
        '@&#(\d+);@e',
        '|[[\/\!]*?[^\[\]]*?]|si', // strip out bbcode tags
        '@([\t\r\n])[\s]+@', // Strip out white space
        );
    // evaluate as php
    $replace = array (' ',
        ' ',
        ' ',
        ' ',
        ' ',
        ' ',
        ' ',
        ' ',
        ' ',
        ' ',
        ' ',
        ' ',
        ' ',
        ' ',
        ' ');
    $faq_nanswer = preg_replace($search, $replace, strip_tags($faq_answer));
    $faq_nanswer = str_replace(',,', '', $faq_nanswer);

    $faq_keynames = explode(' ', $faq_nanswer);
    $faq_cleaned = array_filter($faq_keynames, faq_clean);
    $faq_keylist = array_unique($faq_cleaned);
    $faq_keywords = implode(',', $faq_keylist);
    define("META_KEYWORDS", $faq_keywords);

    define("META_DESCRIPTION", FAQLAN_149 . $faq_question . ' : ' . $tp->text_truncate($faq_nanswer, 100,'[...]'));

}
else
{
    if (!empty($FAQ_PREF['faq_description']))
    {
        define("META_DESCRIPTION", $FAQ_PREF['faq_description']);
    }
    if (!empty($FAQ_PREF['faq_keywords']))
    {
        define("META_KEYWORDS", $FAQ_PREF['faq_keywords']);
    }

    if (!empty($FAQ_PREF['faq_title']))
    {
        define("e_PAGETITLE", $FAQ_PREF['faq_title']);
    }
}
require_once(HEADERF);
$faq_cobj = new comment;
// print $faq_action;
if (isset($_POST['commentsubmit']))
{
    $tmp = explode(".", e_QUERY);
    $faq_faq_from = intval($tmp[0]);
    $faq_action = "cat";
    $idz = intval($tmp[2]);
    $idx = intval($tmp[3]);
    $pid = (isset($_POST['pid']) ? $_POST['pid'] : 0);
    $faq_cobj->enter_comment($_POST['author_name'], $_POST['comment'], "faqfb", $idx, $pid, $_POST['subject']);
    $faq_obj->faq_cache_clear();
}
// Upload pictures
if (isset($_FILES['faq_gfile']['name'][0]))
{
    unset($_POST['faq_submit']);

    require_once(e_HANDLER . "upload_handler.php");
    $faq_fileoptions = array('file_mask' => 'jpg,gif,png', 'file_array_name' => 'faq_gfile', 'overwrite' => true);
    $faq_upresult = process_uploaded_files(e_PLUGIN . "faq/graphics", false, $faq_fileoptions);
    if (isset($_POST['submitupload']))
    {
        $faq_action = 'reedit';
    }
    else
    {
        $faq_action = 'save';
    }
}
// print $faq_action;
if ($faq_action == "save")
{
    // print "here";
    if ($idx > 0)
    {
        // an existing record so we save it
        if ($_POST['faq_question'] != "" && $_POST['data'] != "")
        {
            if ($sql->db_Select("faq", "faq_id", "where faq_id<>'" . intval($idx) . "' and faq_question ='" . $tp->toDB($_POST['faq_question']) . "' and faq_parent=" . intval($_POST['faq_parent']) . " ", "nowhere", false))
            {
                $message = FAQLAN_105; //define(FAQLAN_105, "An FAQ with this question already exists in this category");
                $faq_action = "reedit";
                $mes->addError($message);
				echo $mes->render();
            }
            else
            {
                $faq_question = $tp->toDB($_POST['faq_question']);
                $data = $tp->toDB($_POST['data']);
                $sql->db_Update("faq", "faq_parent='" . intval($_POST['faq_parent']) . "', faq_question ='$faq_question', faq_answer='$data', faq_comment='" . intval($_POST['faq_comment']) . "',faq_updated='" . time() . "'  WHERE faq_id='" . intval($idx) . "' ", false, "FAQ", "FAQ Updated " . intval($idx));
                $message = FAQ_ADLAN_29;  //define(FAQ_ADLAN_29, "FAQ entry updated");
                $faq_action = "cat";
                $mes->addSuccess($message);
				echo $mes->render();
                // unset($faq_question, $data);
            }
        }
        else
        {
            $message = FAQ_ADLAN_30; //define(FAQ_ADLAN_30, "You left a required field blank.");
            $faq_action = "reedit";
            $mes->addError($message);
            echo $mes->render();
        }
    }
    else
    {
        // a new record so we create it
        $message = "";
        $faq_action = "cat";
        if ($sql->db_Select("faq", "faq_id", "where faq_question ='" . $tp->toDB($_POST['faq_question']) . "' and faq_parent=" . intval($_POST['faq_parent']) . " ", "nowhere", false))
        {
            $message = FAQLAN_105;  //define(FAQLAN_105, "An FAQ with this question already exists in this category");
            $faq_action = "reedit";
            $mes->addError($message);
			echo $mes->render();
        }
        else
        {
            if ($_POST['faq_question'] != "" && $_POST['data'] != "")
            {
                if (USER)
                {
                    $faq_poster = USERID . "." . USERNAME;
                }
                else
                {
                    $faq_poster = "0." . $_POST['faq_submittedby'];
                }
                $faq_appr = ($faq_obj->faq_autoapprove?1:0);
                $faq_question = $tp->toDB($_POST['faq_question']);
                $data = $tp->toDB($_POST['data']);
                $count = ($sql->db_Count("faq", "(*)", "WHERE faq_parent='" . $_POST['faq_parent'] . "' ") + 1);
                $faq_newid = $sql->db_Insert("faq", " 0, '" . $_POST['faq_parent'] . "', '$faq_question', '$data', '" . intval($_POST['faq_comment']) . "', '" . time() . "', '" . $faq_poster . "', '" . $count . "','" . $faq_appr . "',0,'',0, ".time(), false, "FAQ", "FAQ Submitted");
                if ($faq_obj->faq_autoapprove)
                {
                    $message = FAQ_ADLAN_32;  //define(FAQ_ADLAN_32, "New FAQ item created and entered into database.");
                    $mes->addSuccess($message);
				    echo $mes->render();
                }
                else
                {
                    $message = FAQ_ADLAN_132;  //define(FAQ_ADLAN_132, "Your FAQ has been submitted and will be reviewed by an administrator");
                    $mes->addInfo($message);
				    echo $mes->render();
                }
                $edata_sn = array("user" => USERNAME, "itemtitle" => $_POST['faq_question'], "catid" => intval($faq_newid));
                $e_event->trigger("faqpost", $edata_sn);
                // unset($faq_question, $data);
                $faq_action = 'cat';
            }
            else
            {
                $message = FAQ_ADLAN_30;  //define(FAQ_ADLAN_30, "You left a required field blank.");
                $faq_action = "reedit";
                $mes->addError($message);
				echo $mes->render();
            }
        }
        $id = $_POST['faq_parent'];
    }
    $faq_obj->faq_cache_clear();
}
// Actions +++++++++++++++++++++++++++++
if ($faq_obj->faq_simple && ($faq_action == "" || $faq_action == "main"))
{
    $faq_action = "cat";
    // $sql->db_Select("faq_info", "*", "where faq_info_parent>0 and find_in_set(faq_info_class,'" . USERCLASS_LIST . "') order by faq_info_id", "nowhere", false);
    // $faq_row = $sql->db_Fetch();
    // unset($idx);
    // $id = $faq_row['faq_info_id'];
    $id = $faq_obj->faq_simpleid;
}
if ($faq_action == "" || $faq_action == "main")
{
    require_once(FAQ_THEME);
    $faq_text = $faq_obj->show_parents($faq_action, $sub_action, $id, $faq_from, $amount);
    $faq_obj->tablerender(FAQLAN_FAQ, $faq_text, 'faq');
}

if ($faq_action == "cat")
{
    require_once(FAQ_THEME);
    if ($idx > 0)
    {
        $faq_text = $faq_obj->view_faq($idx) ;
    }
    else
    {
        $faq_text = $faq_obj->view_list($faq_action, $id) ;
    }
    $faq_obj->tablerender(FAQLAN_FAQ, $faq_text, 'faq');
}

if (($faq_action == "edit" || $faq_action == "new" || $faq_action == "reedit") && (($faq_obj->faq_ownedit && USER) || $faq_obj->faq_add))
{
    require_once(FAQ_THEME);
    $faq_text = $faq_obj->add_faq($faq_action, $id, $idx);
    $faq_obj->tablerender(FAQLAN_67, $faq_text, 'faq');
}

require_once(FOOTERF);

function faq_clean($value)
{
    return strlen($value) > 3;
}

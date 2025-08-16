<?php
require_once(e_PLUGIN . "newslink/includes/newslink_class.php");
function print_item($id)
{
    global $tp, $NEWSLINK_PREF, $sql;
    require_once(e_PLUGIN . "newslink/includes/newslink_class.php");
    if (!is_object($newslink_obj))
    {
        $newslink_obj = new newslink;
    }
    if ($newslink_obj->newslink_admin || $newslink_obj->newslink_reader)
    {
        require_once(e_HANDLER . "date_handler.php");
        $newslink_con = new convert;
        $newslink_arg = "select * from #newslink_newslink left join #newslink_category on newslink_category=newslink_category_id where newslink_id='$id' and find_in_set(newslink_category_read,'" . USERCLASS_LIST . "')";
        if ($sql->db_Select_Gen($newslink_arg))
        {
            $newslink_row = $sql->db_Fetch();
            extract($newslink_row);
            $newslink_question = $tp->toHTML($newslink_name);
            $newslink_answer = $tp->toHTML($newslink_body);
            // Check if new format
            if (strpos($newslink_author, "."))
            {
                $newslink_tmp = explode(".", $newslink_author);
                $newslink_userid = $newslink_tmp[0];
            }
            else
            {
                $newslink_userid = $newslink_author;
            }
            if ($sql->db_Select("user", "*", "user_id=\"$newslink_userid\" "))
            {
                // user exists so use the details
                list($a_id, $a_name) = $sql->db_Fetch();
                $newslink_nlr = "";
            }
            else
            {
                $newslink_nlr = newslinkLAN_77;
                if ($newslink_tmp[1] == "")
                {
                    $a_id = 0;
                    $a_name = "Anon";
                }
                else
                {
                    // use the stored details
                    $a_id = $newslink_userid;
                    $a_name = $newslink_tmp[1];
                }
            }
            $newslink_posted = $newslink_con->convert_date($newslink_posted, "long");
            $newslink_text = "
<span style=\"font-size: 12px; color: black; font-family: Tahoma, Verdana, Arial, Helvetica; text-decoration: none\">
<b>" . NEWSLINK_95 . "</b>
	<br />$newslink_question
	<br />
	<br />$newslink_answer</span><span style=\"font-size: 10px; color: black; font-family: Tahoma, Verdana, Arial, Helvetica; text-decoration: none\">";

            $newslink_text .= "<br /><br /><em><b>" . NEWSLINK_103 . "</b><br />" . NEWSLINK_101 . " " . $newslink_posted . " " . NEWSLINK_102 . " " . $a_name . " " . $newslink_nlr . "</em><br /><br />";
            $newslink_text .= "
	<hr />
	" . NEWSLINK_125 . " " . SITENAME . "
	</span>";
        }
        else
        {
            $newslink_text = NEWSLINK_104;
        }
        $newslink_pos = $a_id . "." . $a_name;
        $sql->db_Update("newslink", "newslink_author='" . $newslink_pos . "' where newslink_id='" . $id . "'");

        $newslink_text = str_replace("graphics/", e_PLUGIN . "newslink/graphics/", $newslink_text);
        require_once(e_HANDLER . 'bbcode_handler.php');
        $e_bb = new e_bbcode;
        $newslink_text = $e_bb->parseBBCodes($newslink_text, '');
    }
    else
    {
        $newslink_text = NEWSLINK_82;
    }
    return $newslink_text;
}

function email_item($id)
{
    global $tp, $sql;
    require_once(e_PLUGIN . "newslink/includes/newslink_class.php");
    if (!is_object($newslink_obj))
    {
        $newslink_obj = new newslink;
    }
    if ($newslink_obj->newslink_admin || $newslink_obj->newslink_reader)
    {
        $newslink_arg = "select * from #newslink_newslink left join #newslink_category on newslink_category=newslink_category_id where newslink_id='$id' and find_in_set(newslink_category_read,'" . USERCLASS_LIST . "')";
        if ($sql->db_Select_gen($newslink_arg))
        {
            $newslink_row = $sql->db_Fetch();
            $newslink_message = NEWSLINK_105 . "\n\n" . SITEURL . e_PLUGIN . "newslink/newslink.php?0.view." . $id . "." . $newslink_row['newslink_category'] . "\n\n";
            $newslink_message .= NEWSLINK_106 . "\"" . $newslink_row['newslink_name'] . "\"\n\n" . NEWSLINK_107 . "\n\n";

            return $newslink_message;
        }
    }
}

?>
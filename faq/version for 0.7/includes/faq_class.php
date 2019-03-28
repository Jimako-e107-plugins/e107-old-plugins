<?php

include_lan(e_PLUGIN . "faq/languages/admin/" . e_LANGUAGE . ".php");
include_lan(e_PLUGIN . "faq/languages/" . e_LANGUAGE . ".php");
require_once(e_HANDLER . "ren_help.php");
require_once(e_HANDLER . "news_class.php");
require_once(e_HANDLER . "form_handler.php");
require_once(e_HANDLER . "userclass_class.php");

require_once(e_HANDLER . "rate_class.php");
class faq
{
    var $faq_read = false;
    var $faq_ownedit = false;
    var $faq_super = false;
    var $faq_add = false;
    var $faq_autoapprove = false;
    var $faq_sendto = false;
    var $faq_viewstats = false;
    var $faq_rating = false;
    var $faq_simple = false;
    var $faq_simpleid = 0;
    var $faq_log = false;
    var $faq_random = false;
    var $faq_topnum = 0;
    // var $faq_sendto = false;
    function faq()
    {
        global $FAQ_PREF;
        $this->load_prefs();
        $this->faq_super = check_class($FAQ_PREF['faq_super']);
        $this->faq_add = check_class($FAQ_PREF['add_faq']) || $this->faq_super;
        $this->faq_read = check_class($FAQ_PREF['faq_user']) || $this->faq_add || $this->faq_super;
        $this->faq_autoapprove = check_class($FAQ_PREF['faq_approve']) || $this->faq_super;
        $this->faq_viewstats = check_class($FAQ_PREF['faq_stats']) || $this->faq_super;
        $this->faq_sendto = check_class($FAQ_PREF['faq_sendto']) || $this->faq_super;
        $this->faq_ownedit = $FAQ_PREF['faq_ownedit'];
        $this->faq_rating = $FAQ_PREF['faq_rating'] > 0;
        $this->faq_showposter = $FAQ_PREF['faq_showposter'] > 0;
        $this->faq_picupload = $FAQ_PREF['faq_picupload'] > 0;
        $this->faq_simple = $FAQ_PREF['faq_simple'] > 0;
        $this->faq_simpleid = $FAQ_PREF['faq_simple'] ;
        $this->faq_log = $FAQ_PREF['faq_log'] > 0 ;
        $this->faq_random = $FAQ_PREF['faq_showrand'] > 0 ;
        $this->faq_topnum = $FAQ_PREF['faq_top'];
        /*
 		// For debugging
        if ($this->faq_super)
        {
            print "super ";
        }
        if ($this->faq_add)
        {
            print "add ";
        }
        if ($this->faq_read)
        {
            print "read ";
        }
*/
    }
    // ********************************************************************************************
    // *
    // * FAQ load and Save prefs
    // *
    // ********************************************************************************************
    function getdefaultprefs()
    {
        global $FAQ_PREF, $pref;
        if (isset($pref['faq_user']))
        {
            // if we have prefs set in the old way copy them to the new way and delete those prefs
            $FAQ_PREF['faq_user'] = $pref['faq_user'];
            $FAQ_PREF['add_faq'] = $pref['add_faq'];
            $FAQ_PREF['faq_approve'] = $pref['faq_approve'];
            $FAQ_PREF['faq_defcomments'] = $pref['faq_defcomments'];
            $FAQ_PREF['faq_allowcomments'] = $pref['faq_allowcomments'];
            $FAQ_PREF['faq_ownedit'] = $pref['faq_ownedit'];
            $FAQ_PREF['faq_super'] = $pref['faq_super'];
            $FAQ_PREF['faq_description'] = $pref['faq_description'];
            $FAQ_PREF['faq_keywords'] = $pref['faq_keywords'];
            $FAQ_PREF['faq_showposter'] = $pref['faq_showposter'];
            $FAQ_PREF['faq_picupload'] = $pref['faq_picupload'];
            $FAQ_PREF['faq_sendto'] = $pref['faq_sendto'];
            $FAQ_PREF['faq_title'] = $pref['faq_title'];
            $FAQ_PREF['faq_mtext'] = $pref['faq_mtext'];
            $FAQ_PREF['faq_perpage'] = $pref['faq_perpage'];
            $FAQ_PREF['faq_showrand'] = $pref['faq_showrand'];
            $FAQ_PREF['faq_top'] = $pref['faq_top'];
            $FAQ_PREF['faq_log'] = $pref['faq_log'];
            $FAQ_PREF['faq_stats'] = $pref['faq_stats'];
            $FAQ_PREF['faq_rating'] = $pref['faq_rating'];
            $FAQ_PREF['faq_simple'] = $pref['faq_simple'];

            unset($pref['faq_user']);
            unset($pref['add_faq']);
            unset($pref['faq_approve']);
            unset($pref['faq_defcomments']);
            unset($pref['faq_allowcomments']);
            unset($pref['faq_ownedit']);
            unset($pref['faq_super']);
            unset($pref['faq_description']);
            unset($pref['faq_keywords']);
            unset($pref['faq_showposter']);
            unset($pref['faq_picupload']);
            unset($pref['faq_sendto']);
            unset($pref['faq_title']);
            unset($pref['faq_mtext']);
            unset($pref['faq_perpage']);
            unset($pref['faq_showrand']);
            unset($pref['faq_top']);
            unset($pref['faq_log']);
            unset($pref['faq_stats']);
            unset($pref['faq_rating']);
            unset($pref['faq_simple']);
            $this->save_prefs();
            save_prefs();
        }
        else
        {
            // otherwise create new default prefs
            $FAQ_PREF = array("faq_user" => 254,
                "add_faq" => 254,
                "faq_approve" => 254,
                "faq_defcomments" => 254,
                "faq_allowcomments" => 254,
                "faq_ownedit" => 0,
                "faq_super" => 254,
                "faq_keywords" => "Blank",
                "faq_description" => "Blank",
                "faq_showposter" => 1,
                "faq_picupload" => 1,
                "faq_sendto" => 254,
                "faq_title" => "FAQ",
                "faq_mtext" => "Did you know?",
                "faq_perpage" => 10,
                "faq_showrand" => 1,
                "faq_top" => 10,
                "faq_log" => 1,
                "faq_stats" => 254,
                "faq_rating" => 1,
                "faq_simple" => 0
                );
        }
    }
    function save_prefs()
    {
        global $sql, $eArrayStorage, $FAQ_PREF;
        // save preferences to database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $tmp = $eArrayStorage->WriteArray($FAQ_PREF);
        $sql->db_Update("core", "e107_value='$tmp' where e107_name='faq'", false);
        return ;
    }
    function load_prefs()
    {
        global $sql, $eArrayStorage, $FAQ_PREF;
        // get preferences faq_from database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $num_rows = $sql->db_Select("core", "*", "e107_name='faq' ");
        $row = $sql->db_Fetch();
        if (empty($row['e107_value']))
        {
            // insert default preferences if none exist
            $this->getDefaultPrefs();
            $tmp = $eArrayStorage->WriteArray($FAQ_PREF);
            $sql->db_Insert("core", "'faq', '$tmp' ");
            $sql->db_Select("core", "*", "e107_name='faq' ");
        }
        else
        {
            $FAQ_PREF = $eArrayStorage->ReadArray($row['e107_value']);
        }
        return;
    }
    function faq_cache_clear($faq_menu = false)
    {
        global $e107cache;
        $e107cache->clear("nq_faqtop_menu");
        $e107cache->clear("nq_faq_menu");
        $e107cache->clear("nq_faqnew_menu");
        if (!$faq_menu)
        {
            // if we're not just clearing the menu
            $e107cache->clear("faq");
            $e107cache->clear("faqcat");
        }
    }
    function show_parents($faq_action, $sub_action, $id, $faq_from, $amount)
    {
        global $e107, $e107cache, $subparents, $faq_view_rating, $faq_info_id, $faq_info_title, $faq_info_icon, $faq_info_about, $cnt, $sql, $sql2, $rs, $tp, $FAQ_PREF, $faq_from, $faq_shortcodes, $FAQ_LISTPARENT_FOOTER, $FAQ_LISTPARENT_DETAIL, $FAQ_LISTPARENT_HEADER, $FAQ_LISTPARENT_TABLE;
        $cache_tag = "faq";
        if ($cacheData = $e107cache->retrieve($cache_tag))
        {
            $faq_text .= $cacheData;
        }
        else
        {
            $sql3 = new db;
            $faq_cache .= $tp->parseTemplate($FAQ_LISTPARENT_HEADER, true, $faq_shortcodes);
            if ($sql->db_Select("faq_info", "*", "where faq_info_parent='0' and find_in_set(faq_info_class,'" . USERCLASS_LIST . "') ORDER BY faq_info_order ASC", "nowhere", false))
            {
                while ($row3 = $sql->db_Fetch())
                {
                    extract($row3);
                    $subparents = $sql2->db_Select("faq_info", "*", "where faq_info_parent='" . intval($faq_info_id) . "' and find_in_set(faq_info_class,'" . USERCLASS_LIST . "') ORDER BY faq_info_order ASC", "nowhere", false);
                    $faq_cache .= $tp->parseTemplate($FAQ_LISTPARENT_TABLE, true, $faq_shortcodes);
                    if (!$subparents)
                    {
                        $faq_cache .= $tp->parseTemplate($FAQ_LISTPARENT_DETAIL, true, $faq_shortcodes);
                    }
                    else
                    {
                        while ($row = $sql2->db_Fetch())
                        {
                            extract($row);
                            $cnt = $sql3->db_Count("faq", "(*)", "WHERE faq_parent = '$faq_info_id' and faq_approved > 0 ");
                            $faq_cache .= $tp->parseTemplate($FAQ_LISTPARENT_DETAIL, true, $faq_shortcodes);
                        }
                    }
                }
            }
            $faq_cache .= $tp->parseTemplate($FAQ_LISTPARENT_FOOTER, true, $faq_shortcodes);
            $e107cache->set($cache_tag, $faq_cache);
            $faq_text .= $faq_cache;
        }

        return $faq_text;
    }
    function view_list($faq_action, $id)
    {
        global $e107, $e107cache, $faq_cat_name, $faq_view_rating, $faq_rater, $sql, $faq_action, $row2, $res, $faq_count, $faq_info_icon, $faq_id, $id, $faq_from, $faq_question, $ns, $aj, $FAQ_PREF, $faq_from, $tp, $FAQ_LIST_HEADER, $FAQ_LIST_DETAIL, $FAQ_LIST_FOOTER, $faq_shortcodes;
        $cache_tag = "faqcat";
        if ($cacheData = $e107cache->retrieve($cache_tag))
        {
            $faq_text .= $cacheData;
        }
        else
        {
            // get the category
            $sql->db_Select("faq_info", "*", "where faq_info_id='" . intval($id) . "' ", "nowhere", false);
            $row2 = $sql->db_Fetch();
            $faq_info_icon = $row2['faq_info_icon'];
            $faq_cat_name = $row2['faq_info_title'];
            $faq_text .= $tp->parseTemplate($FAQ_LIST_HEADER, true, $faq_shortcodes);
            // check that this category is permitted for the user
            if (check_class($row2['faq_info_class']))
            {
                // count the records for the page display
                $faq_count = $sql->db_Count("faq", "(*)", "where faq_parent='$id' and faq_approved > 0 ");
                $faq_arg = "select faq_question,faq_id,faq_parent from #faq
		left join #faq_info on faq_info_id=faq_parent where faq_parent='$id' and faq_approved > 0 and find_in_set(faq_info_class,'" . USERCLASS_LIST . "') order by faq_order limit $faq_from," . $FAQ_PREF['faq_perpage'] . "";
                if ($res = $sql->db_Select_gen($faq_arg))
                {
                    while ($row = $sql->db_Fetch())
                    {
                        extract($row);
                        $faq_view_rating = "";
                        if ($faq_ratearray = $faq_rater->getrating("faq", $faq_id))
                        {
                            if (defined("IMODE"))
                            {
                                $faq_star = e_IMAGE . "rate/" . IMODE;
                            }
                            else
                            {
                                $image = $faq_star = e_IMAGE . "rate/lite";
                            }
                            for($c = 1;
                                $c <= $faq_ratearray[1];
                                $c++)
                            {
                                $faq_view_rating .= "<img src='{$faq_star}/star.png' alt='' />";
                            }
                            if ($faq_ratearray[2])
                            {
                                $faq_view_rating .= "<img src='{$faq_star}/" . $faq_ratearray[2] . ".png'  alt='' />";
                            }
                            if ($faq_ratearray[2] == "")
                            {
                                $faq_ratearray[2] = 0;
                            }
                            $faq_view_rating .= "&nbsp;&nbsp;" . $faq_ratearray[1] . "." . $faq_ratearray[2] . " - " . $faq_ratearray[0] . "&nbsp;";
                            $faq_view_rating .= ($faq_ratearray[0] == 1 ? FAQLAN_115 : FAQLAN_114);
                        }
                        else
                        {
                            $faq_view_rating = "&nbsp;";
                        }
                        $faq_text .= $tp->parseTemplate($FAQ_LIST_DETAIL, true, $faq_shortcodes);
                    }
                }
                else
                {
                    $faq_text .= $tp->parseTemplate($FAQ_LIST_DETAIL, true, $faq_shortcodes);
                }
            }

            $faq_text .= $tp->parseTemplate($FAQ_LIST_FOOTER, true, $faq_shortcodes);
            $faq_cache .= $tp->parseTemplate($FAQ_LISTPARENT_FOOTER, true, $faq_shortcodes);
            $e107cache->set($cache_tag, $faq_text);
        }
        return $faq_text;
    }
    function view_faq($idx)
    {
        global $pref, $e107, $faq_obj, $e107cache, $faq_rater, $faq_rate_text, $idx, $sql2, $faq_datestamp, $faq_author, $faq_views,
        $faq_unique, $faq_answer, $faq_question, $faq_from, $faq_parent, $faq_authid,
        $faq_id, $ns, $sql, $tp, $FAQ_PREF, $faq_cobj, $faq_from, $faq_id, $faq_shortcodes,
        $FAQ_ITEM_HEADER, $FAQ_ITEM_FOOTER, $FAQ_ITEM_DETAIL,$faq_updated;
        $faq_arg = "select f.*,i.* from #faq as f left join #faq_info as i on faq_parent=faq_info_id where find_in_set(faq_info_class,'" . USERCLASS_LIST . "') and faq_id='$idx'";
        if (!$sql->db_Select_Gen($faq_arg, false))
        {
            $faq_text .= "<table class='fborder' width='97%'>
		<tr><td class='fcaption'>" . FAQLAN_67 . "</td></tr>
		<tr><td class='forumheader3'>" . FAQLAN_80 . "<br />
		<a href='" . e_PLUGIN . "faq/faq.php'>" . FAQLAN_75 . "</a></td></tr></table>";
            $ns->tablerender(FAQLAN_FAQ, $faq_text);
        }
        else
        {
            $row = $sql->db_Fetch();
            extract($row);
            if (USER)
            {
                $faq_usercheck = USERID;
            }
            else
            {
                $faq_usercheck = $e107->getip();
            }
            $faq_viewer .= $faq_usercheck . ",";
            $sql->db_Update("faq", "faq_unique=faq_unique+1,faq_viewer='" . $faq_viewer . "' where (isnull(faq_viewer) or not find_in_set('{$faq_usercheck}',faq_viewer)) and faq_id='$idx'", false);
            $sql->db_Update("faq", "faq_views=faq_views+1 where faq_id='$idx'", false);
            $faq_obj->faq_cache_clear(true);
            $sql->db_Select_Gen($faq_arg, false);
            $row = $sql->db_Fetch();
            extract($row);
            $faq_tmp = explode(".", $faq_author, 2);
            $faq_authid = $faq_tmp[0];
            // Do rating if turned on
            if ($faq_obj->faq_rating)
            {
                // rating
                if ($faq_ratearray = $faq_rater->getrating("faq", $idx))
                {
                    if (defined("IMODE"))
                    {
                        $faq_star = e_IMAGE . "rate/" . IMODE;
                    }
                    else
                    {
                        $image = $faq_star = e_IMAGE . "rate/lite";
                    }
                    for($c = 1;
                        $c <= $faq_ratearray[1];
                        $c++)
                    {
                        $faq_view_rating .= "<img src='{$faq_star}/star.png' alt='' />";
                    }
                    if ($faq_ratearray[2])
                    {
                        $faq_view_rating .= "<img src='{$faq_star}/" . $faq_ratearray[2] . ".png'  alt='' />";
                    }
                    if ($faq_ratearray[2] == "")
                    {
                        $faq_ratearray[2] = 0;
                    }
                    $faq_view_rating .= "&nbsp;&nbsp;" . $faq_ratearray[1] . "." . $faq_ratearray[2] . " - " . $faq_ratearray[0] . "&nbsp;";
                    $faq_view_rating .= ($faq_ratearray[0] == 1 ? FAQLAN_115 : FAQLAN_114);
                }
                else
                {
                    $faq_view_rating .= FAQLAN_116;
                }

                if (!$faq_rater->checkrated("faq", $idx) && USER)
                {
                    $faq_view_rating .= $faq_rater->rateselect("<br /><b>" . FAQLAN_117 . " ", "faq", $idx) . "</b>";
                }
                else if (!USER)
                {
                    $faq_view_rating .= "&nbsp;";
                }
                else
                {
                    $faq_view_rating .= " (" . FAQLAN_118 . ")";
                }
                $faq_view_rating .= "&nbsp;";
                // rating
                $faq_rate_text .= $faq_view_rating;
            }
            $theanswer = $tp->parseTemplate($FAQ_ITEM_HEADER, true, $faq_shortcodes);
            $theanswer .= $tp->parseTemplate($FAQ_ITEM_DETAIL, true, $faq_shortcodes);
            $theanswer .= $tp->parseTemplate($FAQ_ITEM_FOOTER, true, $faq_shortcodes);

            $faq_text .= $theanswer;
            $subject = (!$subject ? $tp->toFORM($faq_question, false, "no_make_clickable no_replace emotes_off") : $subject);
            // If this faq allows comments
            if (check_class($faq_comment))
            {
                $faq_action = "comment";
                $table = "faqfb";

                $query = ($pref['nested_comments'] ? "where comment_item_id='$idx' AND comment_type='$table' AND comment_pid='0' ORDER BY comment_datestamp" : "where comment_item_id='$idx' AND comment_type='$table' ORDER BY comment_datestamp");
                if ($comment_total = $sql2->db_Select("comments", "*", $query, "nowhere", false))
                {
                    $width = 0;
                    while ($row = $sql2->db_Fetch())
                    {
                        $faq_text .= $faq_cobj->render_comment($row, $table, $faq_action, $idx , $width, $subject);
                    }
                }

                $faq_text .= $faq_cobj->form_comment($faq_action, $table, $idx , $subject, $content_type, true, false, false);
                if (ADMIN && getperms("B"))
                {
                    $faq_text .= "<div style='text-align:right'><a href='" . e_ADMIN . "modcomment.php?faqfb.$faq_id'>moderate comments</a></div><br />";
                }
            } // end of check_class
            return $faq_text;
        }
    }
    function add_faq($faq_action, $id, $idx)
    {
        global $e107, $faq_obj, $faq_answer, $message, $faq_comment, $faq_parent, $faq_question, $tp, $sql, $rs, $FAQ_PREF, $faq_from, $idx, $faq_shortcodes, $FAQ_EDIT_FOOTER, $FAQ_EDIT_DETAIL, $FAQ_EDIT_HEADER;
        $userid = USERID;
        if ($faq_action == "new")
        {
            $data = "";
            $faq_question = "";
        }
        if ($faq_action == "reedit")
        {
            $faq_answer = $_POST['data'];
            $faq_parent = $_POST['faq_parent'];
            $faq_question = $_POST['faq_question'];
            $faq_comment = $_POST['faq_comment'];
        }
        if ($faq_action == "edit")
        {
            $sql->db_Select("faq", "*", " faq_id = '$idx' ");
            $row = $sql->db_Fetch();
            extract($row);
            $data = $faq_answer;
            $sql->db_Select("faq_info", "*", "faq_info_id='$faq'");
            $row = $sql->db_Fetch();
            extract($row);
        }
        $faq_text .= "<form method='post' action='" . e_SELF . "?' id='dataform' enctype='multipart/form-data'>
	<div>
	<input type='hidden' name='faq' value='$faq' />
	<input type='hidden' name='id' value='$id' />
	<input type='hidden' name='idx' value='$idx' />
	<input type='hidden' name='faq_from' value='$faq_from' />
	<input type='hidden' name='action' value='save' />
	</div>";
        $faq_text .= $tp->parseTemplate($FAQ_EDIT_HEADER, true, $faq_shortcodes);
        $faq_text .= $tp->parseTemplate($FAQ_EDIT_DETAIL, true, $faq_shortcodes);
        $faq_text .= $tp->parseTemplate($FAQ_EDIT_FOOTER, true, $faq_shortcodes);
        $faq_text .= "</form>";
        return $faq_text;
    }
    function tablerender($caption, $text, $mode = "default", $return = false)
    {
        global $ns, $FAQ_PREF;
        // do the mod rewrite steps if installed
        #$modules = apache_get_modules();
        if ( $FAQ_PREF['faq_seo'] == 1 && file_exists(e_PLUGIN.'faq/.htaccess'))
        {
            $patterns[0] = '/' . $PLUGINS_DIRECTORY . '\/faq\/faq\.php\?([0-9]+).([a-z]+).([0-9]+).([0-9]+)/';
            $patterns[1] = '/' . $PLUGINS_DIRECTORY . '\/faq\/faq\.php\?([0-9]+).([a-z]+).([0-9]+)/';
            $patterns[2] = '/' . $PLUGINS_DIRECTORY . '\/faq\/faq_stats\.php/';
            $replacements[0] = '/faq/faq-$1-$2-$3-$4.html';
            $replacements[1] = '/faq/faq-$1-$2-$3.html';
            $replacements[2] = '/faq/faq_stats.html';

            $text = preg_replace($patterns, $replacements, $text);
        }
        $ns->tablerender($caption, $text, $mode , $return);
    }
    function regen_htaccess($onoff)
    {
        $hta = '.htaccess';
        $pattern = array("\n", "\r");
        $replace = array("", "");
        if (is_writable($hta) || !file_exists($hta))
        {
            // open the file for reading and get the contents
            $file = file($hta);
            $skip_line = false;
            unset($new_line);
            foreach($file as $line)
            {
                if (strpos($line, '*** FAQ REWRITE BEGIN ***') > 0)
                {
                    // we start skipping
                    $skip_line = true;
                }

                if (!$skip_line)
                {
                    // print strlen($line) . '<br>';
                    $new_line[] = str_replace($pattern, $replace, $line);
                }
                if (strpos($line, '*** FAQ REWRITE END ***') > 0)
                {
                    $skip_line = false;
                }
            }
            if ($onoff == 'on')
            {
                $base_loc = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
                $new_line[] = "#*** FAQ REWRITE BEGIN ***";
                $new_line[] = 'RewriteEngine On';
                $new_line[] = "RewriteBase $base_loc";
                $new_line[] = 'RewriteRule faq.html faq.php';
                $new_line[] = 'RewriteRule faq_stats.html faq_stats.php';
                $new_line[] = 'RewriteRule faq-([0-9]*)-([a-z]*)-([0-9]*)\.html(.*)$ faq.php?$1.$2.$3';
                $new_line[] = 'RewriteRule faq-([0-9]*)-([a-z]*)-([0-9]*)-([0-9]*)\.html(.*)$ faq.php?$1.$2.$3.$4';
                $new_line[] = '#*** FAQ REWRITE END ***';
                $outwrite = implode("\n", $new_line);
            }
            else
            {

                $outwrite = implode("\n", $new_line);
            }
            $retval = 0;
            if ($fp = fopen('tmp.txt', 'wt'))
            {
                // we can open the file for reading
                if (fwrite($fp, $outwrite)!==false)
                {
                    fclose($fp);
                    // we have written the new data to temp file OK
                    if (is_readable('old.htaccess'))
                    {
                        // there is an old htaccess file so delete it
                        if (!unlink('old.htaccess'))
                        {
                            $retval = 2;
                        }
                    }
                    if ($retval == 0)
                    {
                        // old one deleted OK so rename the existing to the old one
                        if (is_readable('.htaccess'))
                        {
                            // if there is an old .htaccess then rename it
                            if (!rename('.htaccess', 'old.htaccess'))
                            {
                                $retval = 3;
                            }
                        }
                    }
                    if ($retval == 0)
                    {
                        // successfully renamed existing htaccess to old.htaccess
                        // so rename the temp file to .htaccess
                        if (!rename('tmp.txt', '.htaccess'))
                        {
                            $retval = 4;
                        }
                    }
                }
                else
                {
                    // unable to open temporary file
                    $retval = 5;
                }
            }
            else
            {
                fclose($fp);
                $retval = 1;
            }
            return $retval;
            // unlink('old.htaccess');
            // print_a($new_line);
        }
    }
}

<?php
/*
+---------------------------------------------------------------+
|	Auto Promote Plugin for e107
|
|	Copyright (C) Father Barry Keal 2003 - 2009
|	http://www.keal.me.uk
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . "auto_promote/languages/admin/" . e_LANGUAGE . ".php");
require(e_HANDLER . "mail.php");
class auto_promote
{
    var $aprom_uclass;
    var $aprom_threshold;
    function auto_promote()
    {
        $this->load_prefs();

        $aprom_t1 = explode('~', APROM_THRESHOLDS);

        foreach($aprom_t1 as $row)
        {
            $aprom_tmp = explode(',', $row);
            $this->aprom_threshold[ $aprom_tmp[0]] = $aprom_tmp[1];
        }
        // print "<pre>";
        // print_r($this->aprom_threshold);
        // print "</pre>";
    }
    // ********************************************************************************************
    // *
    // * aprom load and Save prefs
    // *
    // ********************************************************************************************
    function getdefaultprefs()
    {
        global $APROM_PREF;
        $APROM_PREF = array("aprom_css" => 1,
            "aprom_emailname" => "Admin",
            "aprom_emailfrom" => "admin@example.com",
            "aprom_pmfrom" => 0,
            "aprom_active" => 0,
            "aprom_cont" => 0
            );
    }
    function save_prefs()
    {
        global $sql, $eArrayStorage, $APROM_PREF;
        // save preferences to database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $tmp = $eArrayStorage->WriteArray($APROM_PREF);
        $sql->db_Update("core", "e107_value='$tmp' where e107_name='aprom'", false);
        return ;
    }
    function load_prefs()
    {
        global $sql, $eArrayStorage, $APROM_PREF;
        // get preferences from database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $num_rows = $sql->db_Select("core", "*", "e107_name='aprom' ");
        $row = $sql->db_Fetch();

        if (empty($row['e107_value']))
        {
            // insert default preferences if none exist
            $this->getDefaultPrefs();
            $tmp = $eArrayStorage->WriteArray($APROM_PREF);
            $sql->db_Insert("core", "'aprom', '$tmp' ");
            $sql->db_Select("core", "*", "e107_name='aprom' ");
        }
        else
        {
            $APROM_PREF = $eArrayStorage->ReadArray($row['e107_value']);
        }
        return;
    }
    function do_promote()
    {
        include_lan(e_PLUGIN . "auto_promote/languages/admin/" . e_LANGUAGE . ".php");
        global $sql, $sql2, $tp, $aprom_classlist, $mail_head, $mail_foot, $aprom_pm, $sysprefs, $aprom_pmfrom;
        // get the list of classes
        $sql->db_Select("userclass_classes", "userclass_id,userclass_name", "order by userclass_name", "nowhere", false);
        while ($aprom_row = $sql->db_Fetch())
        {
            $aprom_classlist[$aprom_row['userclass_id']] = $aprom_row['userclass_name'];
        } // while
        $aprom_sql = new db;
        // don't use $sql as this is already used by PM
        // Get handlers
        require(e_PLUGIN . "pm/pm_class.php");
        require(e_PLUGIN . "pm/pm_func.php");
        $aprom_pm = new private_message;
        include_once(is_readable($lan_file) ? $lan_file : e_PLUGIN . "pm/languages/English.php");
        $lan_file = e_PLUGIN . "pm/languages/" . e_LANGUAGE . ".php";
        $retrieve_prefs[] = 'pm_prefs';
        $pm_prefs = $sysprefs->getArray("pm_prefs");
        // set up message header and footer for emails
        $aprom_pmfrom = ($pref['aprom_pmfrom'] > 0?$pref['aprom_pmfrom']:1);
        $mail_head = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\n";
        $mail_head .= "<html xmlns='http://www.w3.org/1999/xhtml' >\n";
        $mail_head .= "<head><meta http-equiv='content-type' content='text/html; charset=utf-8' />\n";
        if ($pref['aprom_css'] == 1)
        {
            // Use the site theme for the email, embed in email
            $theme = $THEMES_DIRECTORY . $pref['sitetheme'] . "/";
            $style_css = file_get_contents(e_THEME . $pref['sitetheme'] . "/style.css");
            $mail_head .= "<style>\n" . $style_css . "\n</style>";
            $mail_head .= "</head>\n<body>\n";
            $mail_head .= "<div style='padding:10px;width:97%'><div class='forumheader3'>\n";
            $mail_foot = "</div></div></body></html>";
            // .
        }
        else
        {
            $message = $mail_head;
            $mail_head .= "</head>\n<body>\n";
            $mail_foot .= "</body></html>";
        }
        // Get each of the criteria and then process each one
        if ($aprom_sql->db_Select("aprom", "*", "order by aprom_order asc", "nowhere", false))
        {
            while ($aprom_row = $aprom_sql->db_Fetch())
            {
                // For each of the rows in aprom do the promotion
                extract($aprom_row);
                $retval .= "<tr>";

                switch ($aprom_basis)
                {
                    case 0:
                        // Select on forum posts
                        if ($aprom_from == 255 && $aprom_to == 255)
                        {
                            // nothing to do
                        }
                        else
                        {
                            // if there is a from or to class
                            if ($aprom_from != 255)
                            {
                                $arg = "and find_in_set('$aprom_from',user_class)";
                            }

                            $sql2->db_Select("user", "user_id,user_name,user_email", "where user_forums $aprom_method $aprom_level and (not find_in_set('$aprom_to',user_class) $arg ) ", "nowhere", false);
                            // $sql2->db_Select("user", "user_id,user_name,user_email", "where user_forums>=$aprom_level  ", "nowhere", false);
                            while ($aprom_user = $sql2->db_Fetch())
                            {
                                // html_entity_decode(
                                extract($aprom_user);
                                $aprom_emsg = APROM_AMESSAGE . " " . $user_name . "\n\n" . APROM_AMESSAGEF1 . " " . $this->aprom_threshold[$aprom_method] . ' ' . $aprom_level . " " . APROM_AMESSAGEF4 . "\n\n";
                                if ($aprom_from != 255)
                                {
                                    $this->remove_from($aprom_from, $user_id);
                                    $aprom_emsg .= APROM_AMESSAGEF2 . " [b]" . $aprom_classlist[$aprom_from] . "[/b]\n\n";
                                }
                                if ($aprom_to != 255)
                                {
                                    $this->add_to($aprom_to, $user_id);
                                    $aprom_emsg .= APROM_AMESSAGEF3 . " [b]" . $aprom_classlist[$aprom_to] . "[/b]\n\n";
                                }
                                $aprom_emsg .= APROM_FOOTER;
                                $retval .= "<tr>";
                                $retval .= "<td class='forumheader3' style='text-align:left;' >" . APROM_P0 . "</td>";
                                $retval .= "<td class='forumheader3' style='text-align:center;' >$aprom_method</td>";
                                $retval .= "<td class='forumheader3' style='text-align:right;' >$aprom_level</td>";
                                $retval .= "<td class='forumheader3'>" . $aprom_classlist[$aprom_from] . "</td>";
                                $retval .= "<td class='forumheader3'>" . $aprom_classlist[$aprom_to] . "</td>";
                                $retval .= "<td class='forumheader3'>" . $user_name . "</td>";
                                $retval .= "</tr>";

                                $this->do_notify($aprom_notify, $user_id, APROM_SUBJECT, $aprom_emsg, $user_name, $user_email);
                            } // while
                        }
                        break;
                    case 1:
                        // Select on chat posts
                        if ($aprom_from == 255 && $aprom_to == 255)
                        {
                        }
                        else
                        {
                            if ($aprom_from != 255)
                            {
                                $arg = "and find_in_set('$aprom_from',user_class)";
                            }
                            $sql2->db_Select("user", "user_id,user_name,user_email", "where user_chats $aprom_method $aprom_level   and (not find_in_set('$aprom_to',user_class) $arg )", "nowhere", false);

                            while ($aprom_user = $sql2->db_Fetch())
                            {
                                extract($aprom_user);
                                $aprom_emsg = APROM_AMESSAGE . " " . $user_name . "\n\n" . APROM_AMESSAGEC1 . " " . $this->aprom_threshold[$aprom_method] . ' ' . $aprom_level . " " . APROM_AMESSAGEC4 . "\n\n";
                                if ($aprom_from != 255)
                                {
                                    $this->remove_from($aprom_from, $user_id);
                                    $aprom_emsg .= APROM_AMESSAGEC2 . " [b]" . $aprom_classlist[$aprom_from] . "[/b]\n\n";
                                }
                                if ($aprom_to != 255)
                                {
                                    $this->add_to($aprom_to, $user_id);
                                    $aprom_emsg .= APROM_AMESSAGEC3 . " [b]" . $aprom_classlist[$aprom_to] . "[/b]\n\n";
                                }
                                $aprom_emsg .= APROM_FOOTER;
                                $retval .= "<tr>";
                                $retval .= "<td class='forumheader3' style='text-align:left;' >" . APROM_P1 . "</td>";
                                $retval .= "<td class='forumheader3' style='text-align:center;' >$aprom_method</td>";
                                $retval .= "<td class='forumheader3' style='text-align:right;' >$aprom_level</td>";
                                $retval .= "<td class='forumheader3'>" . $aprom_classlist[$aprom_from] . "</td>";
                                $retval .= "<td class='forumheader3'>" . $aprom_classlist[$aprom_to] . "</td>";
                                $retval .= "<td class='forumheader3'>" . $user_name . "</td>";
                                $retval .= "</tr>";

                                $this->do_notify($aprom_notify, $user_id, APROM_SUBJECT, $aprom_emsg, $user_name, $user_email);
                            } // while
                        }
                        break;
                    case 2:
                        // Select on days membership
                        $aprom_joindate = time() - ($aprom_level * 60 * 60 * 24);

                        if ($aprom_from == 255 && $aprom_to == 255)
                        {
                        }
                        else
                        {
                            if ($aprom_from != 255)
                            {
                                $arg = "and find_in_set('$aprom_from',user_class)";
                            }
                            $sql2->db_Select("user", "user_id,user_name,user_email", "where datediff(CURDATE() , from_unixtime(`user_join`)) $aprom_method $aprom_level  and (not find_in_set('$aprom_to',user_class) $arg )", "nowhere", false);
                            while ($aprom_user = $sql2->db_Fetch())
                            {
                                extract($aprom_user);
                                $aprom_emsg = APROM_AMESSAGE . " " . $user_name . "\n\n" . APROM_AMESSAGED1 . " " . $this->aprom_threshold[$aprom_method] . ' ' . $aprom_level . " " . APROM_AMESSAGED4 . "\n\n";
                                if ($aprom_from != 255)
                                {
                                    $this->remove_from($aprom_from, $user_id);
                                    $aprom_emsg .= APROM_AMESSAGED2 . " [b]" . $aprom_classlist[$aprom_from] . "[/b]\n\n";
                                }
                                if ($aprom_to != 255)
                                {
                                    $this->add_to($aprom_to, $user_id);
                                    $aprom_emsg .= APROM_AMESSAGED3 . " [b]" . $aprom_classlist[$aprom_to] . "[/b]\n\n";
                                }
                                $aprom_emsg .= APROM_FOOTER;
                                $retval .= "<tr>";
                                $retval .= "<td class='forumheader3' style='text-align:left;' >" . APROM_P2 . "</td>";
                                $retval .= "<td class='forumheader3' style='text-align:center;' >$aprom_method</td>";
                                $retval .= "<td class='forumheader3' style='text-align:right;' >$aprom_level</td>";
                                $retval .= "<td class='forumheader3'>" . $aprom_classlist[$aprom_from] . "</td>";
                                $retval .= "<td class='forumheader3'>" . $aprom_classlist[$aprom_to] . "</td>";
                                $retval .= "<td class='forumheader3'>" . $user_name . "</td>";
                                $retval .= "</tr>";

                                $this->do_notify($aprom_notify, $user_id, APROM_SUBJECT, $aprom_emsg, $user_name, $user_email);
                            } // while
                        }
                        break;
                    case 3:
                        // Select on days since last visit
                        $aprom_lastdate = time() - ($aprom_level * 60 * 60 * 24);
                        if ($aprom_from == 255 && $aprom_to == 255)
                        {
                        }
                        else
                        {
                            if ($aprom_from != 255)
                            {
                                $arg = "and find_in_set('$aprom_from',user_class)";
                            }
                            $sql2->db_Select("user", "user_id,user_name,user_email", "where datediff(CURDATE() , from_unixtime(`user_lastvisit`)) $aprom_method $aprom_level and (not find_in_set('$aprom_to',user_class) $arg )", "nowhere", false);
                            while ($aprom_user = $sql2->db_Fetch())
                            {
                                extract($aprom_user);
                                $aprom_emsg = APROM_AMESSAGE . " " . $user_name . "\n\n" . APROM_AMESSAGEV1 . " " . $this->aprom_threshold[$aprom_method] . ' ' . $aprom_level . " " . APROM_AMESSAGEV4 . "\n\n";
                                if ($aprom_from != 255)
                                {
                                    $this->remove_from($aprom_from, $user_id);
                                    $aprom_emsg .= APROM_AMESSAGEV2 . " [b]" . $aprom_classlist[$aprom_from] . "[/b]\n\n";
                                }
                                if ($aprom_to != 255)
                                {
                                    $this->add_to($aprom_to, $user_id);
                                    $aprom_emsg .= APROM_AMESSAGEV3 . " [b]" . $aprom_classlist[$aprom_to] . "[/b]\n\n";
                                }
                                $aprom_emsg .= APROM_FOOTER;
                                $retval .= "<tr>";
                                $retval .= "<td class='forumheader3' style='text-align:left;' >" . APROM_P2 . "</td>";
                                $retval .= "<td class='forumheader3' style='text-align:center;' >$aprom_method</td>";
                                $retval .= "<td class='forumheader3' style='text-align:right;' >$aprom_level</td>";
                                $retval .= "<td class='forumheader3'>" . $aprom_classlist[$aprom_from] . "</td>";
                                $retval .= "<td class='forumheader3'>" . $aprom_classlist[$aprom_to] . "</td>";
                                $retval .= "<td class='forumheader3'>" . $user_name . "</td>";
                                $retval .= "</tr>";

                                $this->do_notify($aprom_notify, $user_id, APROM_SUBJECT, $aprom_emsg, $user_name, $user_email);
                            } // while
                        }
                        break;
                    case 6:
                        // Select on Level
                        $aprom_joindate = time() - ($aprom_level * 60 * 60 * 24);
                        if ($aprom_from == 255 && $aprom_to == 255)
                        {
                        }
                        else
                        {
                            if ($aprom_from != 255)
                            {
                                $arg = "and find_in_set('$aprom_from',user_class)";
                            }
                            $sql2->db_Select("user", "user_id,user_name,,user_email,user_chats,user_comments,user_forums,user_visits", "where ceiling( ( (user_chats * 2) + (user_comments*5) + (user_forums*5) + user_visits ) /4) >$aprom_level  and (not find_in_set('$aprom_to',user_class) $arg )", "nowhere", false);
                            while ($aprom_user = $sql2->db_Fetch())
                            {
                                extract($aprom_user);
                                $aprom_emsg = APROM_AMESSAGE . " " . $user_name . "\n\n" . APROM_AMESSAGEL1 . " " . $this->aprom_threshold[$aprom_method] . ' ' . $aprom_level . " " . APROM_AMESSAGEL4 . "\n\n";
                                if ($aprom_from != 255)
                                {
                                    $this->remove_from($aprom_from, $user_id);
                                    $aprom_emsg .= APROM_AMESSAGEL2 . " [b]" . $aprom_classlist[$aprom_from] . "[/b]\n\n";
                                }
                                if ($aprom_to != 255)
                                {
                                    $this->add_to($aprom_to, $user_id);
                                    $aprom_emsg .= APROM_AMESSAGEL3 . " [b]" . $aprom_classlist[$aprom_to] . "[/b]\n\n";
                                }
                                $aprom_emsg .= APROM_FOOTER;
                                $retval .= "<tr>";
                                $retval .= "<td class='forumheader3' style='text-align:left;' >" . APROM_P6 . "</td>";
                                $retval .= "<td class='forumheader3' style='text-align:center;' >$aprom_method</td>";
                                $retval .= "<td class='forumheader3' style='text-align:right;' >$aprom_level</td>";
                                $retval .= "<td class='forumheader3'>" . $aprom_classlist[$aprom_from] . "</td>";
                                $retval .= "<td class='forumheader3'>" . $aprom_classlist[$aprom_to] . "</td>";
                                $retval .= "<td class='forumheader3'>" . $user_name . "</td>";
                                $retval .= "</tr>";

                                $this->do_notify($aprom_notify, $user_id, APROM_SUBJECT, $aprom_emsg, $user_name, $user_email);
                            } // while
                        }
                        break;

                    default: ;
                } // switch
            } // while
        }

        return $retval;
    }
    function auto_preview()
    {
        global $sql, $sql2, $tp, $aprom_classlist;
        $sql->db_Select("userclass_classes", "userclass_id,userclass_name", "order by userclass_name", "nowhere", false);
        // $aprom_classlist[0] = APROM_A39;
        while ($aprom_row = $sql->db_Fetch())
        {
            $aprom_classlist[$aprom_row['userclass_id']] = $aprom_row['userclass_name'];
        } // while
        // print_a($aprom_classlist);
        if ($sql->db_Select("aprom", "*", "order by aprom_order asc", "nowhere", false))
        {
            while ($aprom_row = $sql->db_Fetch())
            {
                // For each of the rows in aprom do the promotion
                extract($aprom_row);
                $aprom_notimage = "<img src='images/blank.png' alt='none' title='none' />";
                if ($aprom_notify == 1)
                {
                    $aprom_notimage = "<img src='images/email.png' alt='mail' title='mail' />";
                }
                if ($aprom_notify == 2)
                {
                    $aprom_notimage = "<img src='images/pm.png' alt='pm' title='pm' />";
                }
                $retval .= "<tr>";
                switch ($aprom_basis)
                {
                    case 0:
                        // Select on forum posts
                        if ($aprom_from != 255)
                        {
                            $arg = "and find_in_set('$aprom_from',user_class)";
                        }
                        if ($aprom_from == 255 && $aprom_to == 255)
                        {
                            $count = 0;
                        }
                        else
                        {
                            $count = $sql2->db_Select("user", "user_id,user_name", "where user_forums $aprom_method $aprom_level and (not find_in_set('$aprom_to',user_class) $arg )", "nowhere", false);
                        }
                        if ($count > 0)
                        {
                            while ($row = $sql2->db_Fetch())
                            {
                                $list .= "<br />" . $tp->toHTML($row['user_name'], false);
                            }
                        }
                        $retval .= "<td class='forumheader3' style='text-align:left;' > $aprom_notimage " . APROM_P0 . " </td>";
                        $retval .= "<td class='forumheader3' style='text-align:center;' >$aprom_method</td>";
                        $retval .= "<td class='forumheader3' style='text-align:right;' >$aprom_level</td>";
                        $retval .= "<td class='forumheader3'>" . $aprom_classlist[$aprom_from] . "</td>";
                        $retval .= "<td class='forumheader3'>" . $aprom_classlist[$aprom_to] . "</td>";
                        $retval .= "<td class='forumheader3' style='text-align:right;' >$count <input type='button' class='button' name='aprombutton$aprom_id$aprom_basis' value='view' onclick=\"expandit('aprom_{$aprom_id}_{$aprom_basis}')\" /><div id='aprom_{$aprom_id}_{$aprom_basis}' style='display:none'>$list</div></td>";
                        break;
                    case 1:
                        $list = "";
                        // Select on chat posts
                        if ($aprom_from != 255)
                        {
                            $arg = "and find_in_set('$aprom_from',user_class)";
                        }
                        if ($aprom_from == 255 && $aprom_to == 255)
                        {
                            $count = 0;
                        }
                        else
                        {
                            $count = $sql2->db_Select("user", "user_id,user_name", "where user_chats $aprom_method $aprom_level and (not find_in_set('$aprom_to',user_class) $arg )", "nowhere", false);
                        }
                        if ($count > 0)
                        {
                            while ($row = $sql2->db_Fetch())
                            {
                                $list .= "<br />" . $tp->toHTML($row['user_name'], false);
                            }
                        }
                        $retval .= "<td class='forumheader3' style='text-align:left;' >$aprom_notimage " . APROM_P1 . " </td>";
                        $retval .= "<td class='forumheader3' style='text-align:center;' >$aprom_method</td>";
                        $retval .= "<td class='forumheader3' style='text-align:right;' >$aprom_level</td>";
                        $retval .= "<td class='forumheader3'>" . $aprom_classlist[$aprom_from] . "</td>";
                        $retval .= "<td class='forumheader3'>" . $aprom_classlist[$aprom_to] . "</td>";
                        $retval .= "<td class='forumheader3' style='text-align:right;' >$count <input type='button' class='button' name='aprombutton$aprom_id$aprom_basis' value='view' onclick=\"expandit('aprom_{$aprom_id}_{$aprom_basis}')\" /><div id='aprom_{$aprom_id}_{$aprom_basis}' style='display:none'>$list</div></td>";
                        break;
                    case 2:
                        // Select on days membership
                        $list = "";

                        if ($aprom_from != 255)
                        {
                            $arg = "and find_in_set('$aprom_from',user_class)";
                        }
                        $aprom_joindate = time() - ($aprom_level * 60 * 60 * 24);
                        if ($aprom_from == 255 && $aprom_to == 255)
                        {
                            $count = 0;
                        }
                        else
                        {
                            $count = $sql2->db_Select("user", "user_id,user_name", "where datediff(CURDATE() , from_unixtime(`user_join`)) $aprom_method $aprom_level  and (not find_in_set('$aprom_to',user_class) $arg )", "nowhere", false);
                        }
                        if ($count > 0)
                        {
                            while ($row = $sql2->db_Fetch())
                            {
                                $list .= "<br />" . $tp->toHTML($row['user_name'], false);
                            }
                        }
                        $retval .= "<td class='forumheader3' style='text-align:left;' >$aprom_notimage " . APROM_P2 . "</td>";
                        $retval .= "<td class='forumheader3' style='text-align:center;' >$aprom_method</td>";
                        $retval .= "<td class='forumheader3' style='text-align:right;' >$aprom_level</td>";
                        $retval .= "<td class='forumheader3'>" . $aprom_classlist[$aprom_from] . "</td>";
                        $retval .= "<td class='forumheader3'>" . $aprom_classlist[$aprom_to] . "</td>";
                        $retval .= "<td class='forumheader3' style='text-align:right;' >$count <input type='button' class='button' name='aprombutton$aprom_id$aprom_basis' value='view' onclick=\"expandit('aprom_{$aprom_id}_{$aprom_basis}')\" /><div id='aprom_{$aprom_id}_{$aprom_basis}' style='display:none'>$list</div></td>";
                        break;
                    case 3:
                        // Select on last visit
                        $list = "";
                        if ($aprom_from != 255)
                        {
                            $arg = "and find_in_set('$aprom_from',user_class)";
                        }
                        $aprom_lastdate = time() - ($aprom_level * 60 * 60 * 24);
                        if ($aprom_from == 255 && $aprom_to == 255)
                        {
                            $count = 0;
                        }
                        else
                        {
                            $count = $sql2->db_Select("user", "user_id,user_name", "where datediff(CURDATE() , from_unixtime(`user_lastvisit`)) $aprom_method $aprom_level  and (not find_in_set('$aprom_to',user_class) $arg )", "nowhere", false);
                        }
                        if ($count > 0)
                        {
                            while ($row = $sql2->db_Fetch())
                            {
                                $list .= "<br />" . $tp->toHTML($row['user_name'], false);
                            }
                        }
                        $retval .= "<td class='forumheader3' style='text-align:left;' >$aprom_notimage " . APROM_P3 . " </td>";
                        $retval .= "<td class='forumheader3' style='text-align:center;' >$aprom_method</td>";
                        $retval .= "<td class='forumheader3' style='text-align:right;' >$aprom_level</td>";
                        $retval .= "<td class='forumheader3'>" . $aprom_classlist[$aprom_from] . "</td>";
                        $retval .= "<td class='forumheader3'>" . $aprom_classlist[$aprom_to] . "</td>";
                        $retval .= "<td class='forumheader3' style='text-align:right;' >$count <input type='button' class='button' name='aprombutton$aprom_id$aprom_basis' value='view' onclick=\"expandit('aprom_{$aprom_id}_{$aprom_basis}')\" /><div id='aprom_{$aprom_id}_{$aprom_basis}' style='display:none'>$list</div></td>";
                        break;
                    case 6:
                        // Select on Level
                        $list = "";
                        if ($aprom_from != 255)
                        {
                            $arg = "and find_in_set('$aprom_from',user_class)";
                        }
                        if ($aprom_from == 255 && $aprom_to == 255)
                        {
                            $count = 0;
                        }
                        else
                        {
                            $count = $sql2->db_Select("user", "user_id,user_name", "where ceiling( ( (user_chats * 2) + (user_comments*5) + (user_forums*5) + user_visits ) /4) >$aprom_level  and (not find_in_set('$aprom_to',user_class) $arg )", "nowhere", false);
                        }
                        if ($count > 0)
                        {
                            while ($row = $sql2->db_Fetch())
                            {
                                $list .= "<br />" . $tp->toHTML($row['user_name'], false);
                            }
                        }
                        $retval .= "<td class='forumheader3' style='text-align:left;' >$aprom_notimage" . APROM_P6 . " </td>";
                        $retval .= "<td class='forumheader3' style='text-align:center;' >$aprom_method</td>";
                        $retval .= "<td class='forumheader3' style='text-align:right;' >$aprom_level</td>";
                        $retval .= "<td class='forumheader3'>" . $aprom_classlist[$aprom_from] . "</td>";
                        $retval .= "<td class='forumheader3'>" . $aprom_classlist[$aprom_to] . "</td>";
                        $retval .= "<td class='forumheader3' style='text-align:right;' >$count  <input type='button' class='button' name='aprombutton$aprom_id$aprom_basis' value='view' onclick=\"expandit('aprom_{$aprom_id}_{$aprom_basis}')\" /><div id='aprom_{$aprom_id}_{$aprom_basis}' style='display:none' $list </div></td>";
                        break;

                    default: ;
                } // switch
                $retval .= "</tr>";
            } // while
        }

        return $retval;
    }
    function add_to($aprom_class, $aprom_user)
    {
        if ($aprom_class == 255 || $aprom_class == 0)
        {
            return;
        }
        else
        {
            $sql3 = new DB;
            $aprom_uclass = $sql3->db_Select("user", "user_id,user_class,user_admin", "where user_id=$aprom_user ", "nowhere", false);
            while ($aprom_urow = $sql3->db_Fetch())
            {
                // for each user
                // explode it
                $aprom_classlist = explode(",", $aprom_urow['user_class']);

                if (!array_search($aprom_toclass, $aprom_classlist))
                {
                    // check to see if it currently exists if not then add it
                    $aprom_classlist[] = $aprom_class;
                }
                foreach($aprom_classlist as $aprom_key => $aprom_item)
                {
                    if (empty($aprom_item) || is_null($aprom_item))
                    {
                        // delete any empty class elements
                        unset($aprom_classlist[$aprom_key]);
                    }
                }
                // make a new array
                $aprom_newlist = array_values($aprom_classlist);
                $aprom_newlist = array_unique($aprom_classlist);
                // implode it
                $aprom_newarray = implode(",", $aprom_newlist);
                // write it back
                $aprom_uclass = $sql3->db_Update("user", "user_class='$aprom_newarray' where user_id=" . $aprom_user, false);
            } // while
        }
    }

    function remove_from($aprom_class, $aprom_user)
    {
        $sql3 = new DB;
        $aprom_uclass = $sql3->db_Select("user", "user_class", "where user_id=$aprom_user", "nowhere", false);
        $aprom_urow = $sql3->db_Fetch();
        // explode it
        $aprom_classlist = explode(",", $aprom_urow['user_class']);
        // check each element to see if it needs removing
        foreach($aprom_classlist as $aprom_key => $aprom_item)
        {
            if ($aprom_item == $aprom_class || is_null($aprom_item))
            {
                unset($aprom_classlist[$aprom_key]);
            }
        }
        // make a new array
        $aprom_newlist = array_values($aprom_classlist);
        // implode it
        $aprom_newarray = implode(",", $aprom_newlist);
        // write it back
        $aprom_uclass = $sql3->db_Update("user", "user_class='$aprom_newarray' where user_id=$aprom_user", false);
    }
    function do_notify($method, $user_id, $subject, $message, $user_name, $user_email)
    {
        global $sysprefs, $pref, $tp, $THEMES_DIRECTORY, $IMAGES_DIRECTORY, $mail_head, $mail_foot, $aprom_pmfrom, $aprom_pm, $pm_prefs;

        switch ($method)
        {
            case 1:
                $h_message = $mail_head;
                $h_message .= $tp->toHTML($message, true);
                $h_message = str_replace("&quot;", '"', $h_message);
                $h_message = str_replace('src="', 'src="' . SITEURL, $h_message);
                $h_message .= $mail_foot;
                if (empty($user_name) || empty($user_email))
                {
                    print "error with user name $user_name - user email $user_email<br />";
                }
                else
                {
                    sendemail($user_email, $subject, $h_message, $user_name, $pref['aprom_emailfrom'], $pref['aprom_emailname']);
                }
                break;
            case 2:
                if ($user_id > 0)
                {
                    $aprom_vars['pm_subject'] = $subject;
                    $aprom_vars['pm_message'] = $message;
                    $aprom_vars['to_info']['user_id'] = $user_id;
                    $aprom_vars['from_id'] = $aprom_pmfrom;
                    $aprom_vars['to_info']['user_email'] = $user_email;
                    $aprom_vars['to_info']['user_name'] = $user_name;
                    $aprom_vars['to_info']['user_class'] = $user_class;
                    $res = $aprom_pm->add($aprom_vars);
                }
                break;
            default: ;
        } // switch
    }
    function ap_userclass($ap_field, $ap_current)
    {
        global $sql, $tp;
        $sql->db_Select("userclass_classes", "userclass_id,userclass_name", "order by userclass_name", "nowhere", false);
        // $aprom_classlist[0] = APROM_A39;
        $retval = "<select class='tbox' name='{$ap_field}' >";
        $retval .= "<option value='0' " . (0 == $ap_current) . ">" . APROM_A39 . "</option>";
        while ($aprom_row = $sql->db_Fetch())
        {
            $retval .= "<option value='" . $aprom_classlist[$aprom_row['userclass_id']] . "' " . ($aprom_classlist[$aprom_row['userclass_id']] == $ap_current) . ">" . $tp->toFORM($aprom_row['userclass_name']) . "</option>";
        } // while
        $retval .= "</select>";
        return $retval;
    }
    function ap_ordersel($current = 0, $row = 0, $total = 0)
    {
        $retval = '<select class="tbox" name="aprom_order[' . $row . ']">';
        for($i = 1;$i <= $total;$i++)
        {
            $retval .= "<option value='$i' " . ($current == $i?'selected="selected"':'') . ">$i</option>";
        }
        $retval .= '</select>';
        return $retval;
    }
}

?>
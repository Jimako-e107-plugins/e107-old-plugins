<?php
/*
+---------------------------------------------------------------+
|	Timed Userclass Plugin for e107
|
|	Copyright (C) Father Barry Keal 2003 - 2008
|	http://www.keal.me.uk
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
class timed_userclass
{
    var $tclass_dateform = "d-m-Y";
    var $tclass_doall = false;
    var $tclass_active = false;
    function timed_userclass()
    {
        global $tp, $TCLASS_PREF;
        $this->load_prefs();
        $this->tclass_dateform = $tp->toFORM($TCLASS_PREF['tclass_dateform']);
        $this->tclass_doall = $TCLASS_PREF['tclass_doall'] == 1;
        $this->tclass_active = $TCLASS_PREF['tclass_active'] == 1;
        $this->tclass_lastcheck = $TCLASS_PREF['tclass_lastcheck'];
    }
    // ********************************************************************************************
    // *
    // * load and Save prefs
    // *
    // ********************************************************************************************
    function getdefaultprefs()
    {
        global $TCLASS_PREF;
        $TCLASS_PREF = array("tclass_css" => 1,
            "tclass_doall" => 0,
            "tclass_emailname" => "Admin",
            "tclass_emailfrom" => "admin@example.com",
            "tclass_dateform" => "d-m-Y",
            "tclass_lastcheck" => 0,
            "tclass_pmfrom" => 0,
            "tclass_active" => 0
            );
    }
    function save_prefs()
    {
        global $sql, $eArrayStorage, $TCLASS_PREF;
        // save preferences to database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $tmp = $eArrayStorage->WriteArray($TCLASS_PREF);
        $sql->db_Update("core", "e107_value='$tmp' where e107_name='tuclass'", false);
        return ;
    }
    function load_prefs()
    {
        global $sql, $eArrayStorage, $TCLASS_PREF;
        // get preferences from database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $num_rows = $sql->db_Select("core", "*", "e107_name='tuclass' ");
        $row = $sql->db_Fetch();

        if (empty($row['e107_value']))
        {
            // insert default preferences if none exist
            $this->getDefaultPrefs();
            $tmp = $eArrayStorage->WriteArray($TCLASS_PREF);
            $sql->db_Insert("core", "'tuclass', '$tmp' ");
            $sql->db_Select("core", "*", "e107_name='tuclass' ");
        }
        else
        {
            $TCLASS_PREF = $eArrayStorage->ReadArray($row['e107_value']);
        }
        return;
    }
    function do_promote($tclass_promoteid = 0, $tclass_row)
    {
        global $sql;
        $tclass_now = time();
        $tclass_today = mktime(0, 0, 0, date("m", $tclass_now), date("d", $tclass_now), date("Y", $tclass_now)) + 86400;
        include_lan(e_PLUGIN . "timed_userclass/languages/admin/" . e_LANGUAGE . ".php");
        global $sql2, $tp, $tclass_classlist, $mail_head, $mail_foot, $tclass_pm, $sysprefs, $tclass_pmfrom;
        $tclass_sql = new db;
        // don't use $sql as this is already used by PM
        // Get handlers
        require_once(e_HANDLER . "mail.php");
        require_once(e_PLUGIN . "pm/pm_class.php");
        require_once(e_PLUGIN . "pm/pm_func.php");
        $tclass_pm = new private_message;
        include_once(is_readable($lan_file) ? $lan_file : e_PLUGIN . "pm/languages/English.php");
        $lan_file = e_PLUGIN . "pm/languages/" . e_LANGUAGE . ".php";
        $retrieve_prefs[] = 'pm_prefs';
        $pm_prefs = $sysprefs->getArray("pm_prefs");
        // set up message header and footer for emails
        $tclass_pmfrom = ($TCLASS_PREF['tclass_pmfrom'] > 0?$TCLASS_PREF['tclass_pmfrom']:1);

        $mail_head = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\n";
        $mail_head .= "<html xmlns='http://www.w3.org/1999/xhtml' >\n";
        $mail_head .= "<head><meta http-equiv='content-type' content='text/html; charset=utf-8' />\n";
        if ($pref['tclass_css'] == 1)
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
        // make array of user classes
        $sql->db_Select("userclass_classes", "userclass_id,userclass_name", "", "", false);
        $tclass_userclass_tmp = $sql->db_getList();
        foreach($tclass_userclass_tmp as $row)
        {
            $tclass_userclass_list[$row['userclass_id']] = $row['userclass_name'];
        }
        // print "<pre>";
        // print_r($tclass_userclass_list);
        // print"</pre>";
        foreach($tclass_row as $tclass_record)
        {
            if ($tclass_record['tclass_start'] <= $tclass_today)
            {
                if ($sql->db_Select("user", "user_name,user_email", "where user_id=" . $tclass_record['tclass_userid'] . "", "nowhere", false))
                {
                    extract($sql->db_Fetch());
                }

                if ($tclass_record['tclass_from'] > 0 && $tclass_record['tclass_from'] != 255)
                {
                    // remove from class
                    $this->remove_from($tclass_record['tclass_from'], $tclass_record['tclass_userid']);
                    if ($tclass_record['tclass_notify'] > 0)
                    {
                        $tclass_emsg = TCLASS_AMESSAGE . " <b>" . $user_name . "</b><br /><br />" . TCLASS_AMESSAGEC1 . "<br .><br />" . TCLASS_AMESSAGEC2 . " <b>" . $tp->toHTML($tclass_userclass_list[$tclass_record['tclass_from']], false) . "</b> " . "<br /><br />" . TCLASS_FOOTER;
                        $this->do_notify($tclass_record['tclass_notify'], $tclass_record['tclass_userid'], TCLASS_SUBJECT, $tclass_emsg, $user_name, $user_email);
                    }
                }
                if ($tclass_record['tclass_from'] > 0 && $tclass_record['tclass_to'] != 255)
                {
                    // add to class
                    $this->add_to($tclass_record['tclass_to'], $tclass_record['tclass_userid']);
                    if ($tclass_record['tclass_notify'] > 0)
                    {
                        $tclass_emsg = TCLASS_AMESSAGE . " <b>" . $user_name . "</b><br /><br />" . TCLASS_AMESSAGEF1 . "<br .><br />" . TCLASS_AMESSAGEF2 . " <b>" . $tp->toHTML($tclass_userclass_list[$tclass_record['tclass_to']], false) . "</b> " . "<br /><br />" . TCLASS_FOOTER;
                        $this->do_notify($tclass_record['tclass_notify'], $tclass_record['tclass_userid'], TCLASS_SUBJECT, $tclass_emsg, $user_name, $user_email);
                    }
                }
                if ($tclass_record['tclass_admin'] == 1)
                {
                    // remove admin status
                    $sql->db_Update("user", "user_admin=0 where user_id=" . $tclass_record['tclass_userid'], false);
                    if ($tclass_record['tclass_notify'] > 0)
                    {
                        $tclass_emsg = TCLASS_AMESSAGE . " <b>" . $user_name . "</b><br /><br />" . TCLASS_AMESSAGED1 . "<br .><br />" . TCLASS_AMESSAGED2 . "<br /><br />" . TCLASS_FOOTER;
                        $this->do_notify($tclass_record['tclass_notify'], $tclass_record['tclass_userid'], TCLASS_SUBJECT, $tclass_emsg, $user_name, $user_email);
                    }
                }
                 $sql->db_Update("tclass", "tclass_donestart=1 where tclass_id=" . $tclass_record['tclass_id'] . "", false);
            }
        }
        return $retval;
    }
    function add_to($tclass_class, $tclass_user)
    {
        if ($tclass_class == 255 || $tclass_class == 0)
        {
            return;
        }
        else
        {
            $sql3 = new DB;
            $tclass_uclass = $sql3->db_Select("user", "user_id,user_class,user_admin", "where user_id=$tclass_user ", "nowhere", false);
            while ($tclass_urow = $sql3->db_Fetch())
            {
                // for each user
                // explode it
                $tclass_classlist = explode(",", $tclass_urow['user_class']);

                if (!array_search($tclass_toclass, $tclass_classlist))
                {
                    // check to see if it currently exists if not then add it
                    $tclass_classlist[] = $tclass_class;
                }
                foreach($tclass_classlist as $tclass_key => $tclass_item)
                {
                    if (empty($tclass_item) || is_null($tclass_item))
                    {
                        // delete any empty class elements
                        unset($tclass_classlist[$tclass_key]);
                    }
                }
                // make a new array
                $tclass_newlist = array_values($tclass_classlist);
                // implode it
                $tclass_newlist = array_unique($tclass_newlist);
                $tclass_newarray = implode(",", $tclass_newlist);
                // write it back
                $tclass_uclass = $sql3->db_Update("user", "user_class='$tclass_newarray' where user_id=" . $tclass_user, false);
            } // while
        }
    }

    function remove_from($tclass_class, $tclass_user)
    {
        $sql3 = new DB;
        $tclass_uclass = $sql3->db_Select("user", "user_class", "where user_id=$tclass_user", "nowhere", false);
        $tclass_urow = $sql3->db_Fetch();
        // explode it
        $tclass_classlist = explode(",", $tclass_urow['user_class']);
        // check each element to see if it needs removing
        foreach($tclass_classlist as $tclass_key => $tclass_item)
        {
            if ($tclass_item == $tclass_class || is_null($tclass_item))
            {
                unset($tclass_classlist[$tclass_key]);
            }
        }
        // make a new array
        $tclass_newlist = array_values($tclass_classlist);
        // implode it
        $tclass_newarray = implode(",", $tclass_newlist);
        // write it back
        $tclass_uclass = $sql3->db_Update("user", "user_class='$tclass_newarray' where user_id=$tclass_user", false);
    }
    function do_notify($method, $user_id, $subject, $message, $user_name, $user_email)
    {

        global $sysprefs, $sql, $pref, $tp, $THEMES_DIRECTORY, $IMAGES_DIRECTORY, $mail_head, $mail_foot, $tclass_pmfrom, $tclass_pm, $pm_prefs;

        switch ($method)
        {
            case 1:

                $h_message = $mail_head;
                $h_message .= $tp->toHTML($message, true);
                $h_message = str_replace("&quot;", '"', $h_message);
                $h_message = str_replace('src="', 'src="' . SITEURL, $h_message);
                $h_message .= $mail_foot;
                // get email address and name
                if (empty($user_name) || empty($user_email))
                {
                    print "error with $user_name $user_email";
                }
                else
                {
                    sendemail($user_email, $subject, $h_message, $user_name, $pref['tclass_emailfrom'], $pref['tclass_emailname']);
                }
                break;
            case 2:
                if ($user_id > 0)
                {
                    $tclass_vars['pm_subject'] = $subject;
                    $tclass_vars['pm_message'] = $message;
                    $tclass_vars['to_info']['user_id'] = $user_id;
                    $tclass_vars['from_id'] = $tclass_pmfrom;
                    $tclass_vars['to_info']['user_email'] = $user_email;
                    $tclass_vars['to_info']['user_name'] = $user_name;
                    $tclass_vars['to_info']['user_class'] = $user_class;
                    $res = $tclass_pm->add($tclass_vars);
                }
                break;
            default: ;
        } // switch
    }
}

?>
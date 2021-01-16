<?php
/*
+---------------------------------------------------------------+
|        MyLevel Menu for e107 v7xx - by Father Barry
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


class mylevel
{
    // var $mylevel_admin = false; // is user an admin
    var $mylevel_excludeclass = 0; // Exclude class
    var $mylevel_userate = 0; // Rating Method
    var $mylevel_nolevel = false; // In excluded class
    var $mylevel_excluded = array();
    var $mylevel_display = "bar";
    var $mylevel_max = 0;

    function mylevel()
    {
        global $MYLEVEL_PREF;
        $this->load_prefs();
        // $this->mylevel_admin = check_class($MYLEVEL_PREF['mylevel_adminclass']);
        $this->mylevel_excludeclass = $MYLEVEL_PREF['mylevel_excludeclass'];
        $this->mylevel_userate = $MYLEVEL_PREF['mylevel_userate'];
        $this->mylevel_nolevel = check_class($MYLEVEL_PREF['mylevel_excludeclass']);
        $this->mylevel_display = $MYLEVEL_PREF['mylevel_display'];
        $this->get_excluded();
        $this->max = $this->get_max();
    }
    // ********************************************************************************************
    // *
    // * My Level load and Save prefs
    // *
    // ********************************************************************************************
    function getdefaultprefs()
    {
        global $MYLEVEL_PREF;
        $MYLEVEL_PREF = array("mylevel_adminclass" => 5,
            "mylevel_display" => "bar",
            "mylevel_userate" => 0
            );
    }
    function save_prefs()
    {
        global $sql, $eArrayStorage, $MYLEVEL_PREF;
        // save preferences to database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $tmp = $eArrayStorage->WriteArray($MYLEVEL_PREF);
        $sql->db_Update("core", "e107_value='$tmp' where e107_name='mylevel'", false);
        return ;
    }
    function load_prefs()
    {
        global $sql, $eArrayStorage, $MYLEVEL_PREF;
        // get preferences from database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $num_rows = $sql->db_Select("core", "*", "e107_name='mylevel' ");
        $row = $sql->db_Fetch();

        if (empty($row['e107_value']))
        {
            // insert default preferences if none exist
            $this->getDefaultPrefs();
            $tmp = $eArrayStorage->WriteArray($MYLEVEL_PREF);
            $sql->db_Insert("core", "'mylevel', '$tmp' ");
            $sql->db_Select("core", "*", "e107_name='mylevel' ");
        }
        else
        {
            $MYLEVEL_PREF = $eArrayStorage->ReadArray($row['e107_value']);
        }
        return;
    }
    function check_requires($requirements = '')
    {
        if (is_array($requirements))
        {
            foreach($requirements as $file)
            {
                if (!file_exists($file) || !is_readable($file))
                {
                   $retval.= "There may be a problem with " . $file.'<br />';
                }
            }
        }
        return $retval;
    }
    function get_max()
    {
        // Get the max contribution
        if (!is_object($mylevel_db))
        {
            $mylevel_db = new DB;
        }

        $mylevel_db->db_Select_gen("select max(mylevel_contribution) as maxcont from #mylevel left join #user on user_id=mylevel_id where not find_in_set(" . $this->mylevel_excludeclass . ",user_class)", false);
        $mylevel_row = $mylevel_db->db_Fetch();
        return $mylevel_row['maxcont'];
    }
    function get_contribution($mylevel_id = USERID)
    {
        // Calculate the user's contribution
        if (!is_object($mylevel_db))
        {
            $mylevel_db = new DB;
        }
        if ($mylevel_db->db_Select_gen("select ( (user_forums*5) + (user_comments*5) + (user_chats * 2) +(user_visits/4)) as contribution  from #user where user_id = $mylevel_id ", false))
        {
            $mylevel_row = $mylevel_db->db_Fetch();
            return $mylevel_row['contribution'];
        }
        else
        {
            return 0;
        }
    }
    function update_user($mylevel_userid, $mylevel_cont, $mylevel_calclevel)
    {
        global $mylevel_db;
        if (!is_object($mylevel_db))
        {
            $mylevel_db = new DB;
        }
        if ($this->mylevel_userate == 0)
        {
            if (!$mylevel_db->db_Select("mylevel", "mylevel_id", "where mylevel_id=$mylevel_userid", "nowhere", false))
            {
                // if we couldnt update it (doesn't exist) then add it
                $mylevel_db->db_Insert("mylevel", "$mylevel_userid,$mylevel_calclevel,'',$mylevel_cont", false);
            }
        }
        else
        {
            if (!$mylevel_db->db_Update("mylevel", "mylevel_contribution=$mylevel_cont,mylevel_level=$mylevel_calclevel where mylevel_id=$mylevel_userid", false))
            {
                // if we couldnt update it (doesn't exist) then add it
                $mylevel_db->db_Insert("mylevel", "$mylevel_userid,$mylevel_calclevel,'',$mylevel_cont", false);
            }
        }
    }
    function get_users()
    {
        global $sql;
        if ($this->mylevel_excludeclass == 255)
        {
            $sql->db_Select("user", "user_id", "", "nowhere", false);
        }
        else
        {
            $sql->db_Select("user", "user_id", "where not find_in_set($this->mylevel_excludeclass,user_class)", "nowhere", false);
        }

        while ($row = $sql->db_Fetch())
        {
            $mylevel_userid = $row['user_id'];
            // get their current contribution
            $mylevel_cont = $this->get_contribution($mylevel_userid);
            // calculate their level
            $mylevel_calclevel = $this->user_level($mylevel_cont);
            // update their level
            $this->update_user($mylevel_userid, $mylevel_cont, $mylevel_calclevel);
        }
    }
    function get_excluded()
    {
        // Generate an array of those who are excluded from my level.
        if ($this->mylevel_excludeclass != 255)
        {
            global $sql;
            $sql->db_Select("user", "user_id", "where find_in_set(" . $this->mylevel_excludeclass . ",user_class)", "nowhere", false);
            while ($row = $sql->db_Fetch())
            {
                $this->mylevel_excluded[] = $row['user_id'];
            }
        }
    }
    function user_level($mylevel_contribution)
    {
        // use the e107 rating type system
        // calc the users rating 1 - 10 as a percentage of the highest level
        switch ($this->mylevel_userate)
        {
            case 1:
                $retval = intval (round($mylevel_contribution / $this->max * 10, 0));
                $retval = ($retval < 1?1:$retval);
                break;
            case 2:
                $retval = intval(11 - (round($mylevel_contribution / $this->max * 10, 0)));
                break;
        }
        if ($retval < 1)
        {
            $retval = 1;
        }
        if ($retval > 10)
        {
            $retval = 10;
        }
        return $retval;
    }
    function user_title()
    {
        if ($this->mylevel_userate == 2)
        {
            $retval = MYLEVEL_RTITLE;
        }
        else
        {
            $retval = MYLEVEL_TITLE;
        }
        return $retval;
    }
    function user_warn()
    {
        if ($this->mylevel_userate == 2)
        {
            $retval = explode(",", MYLEVEL_RWARN);
        }
        else
        {
            $retval = explode(",", MYLEVEL_WARN);
        }
        return $retval;
    }
    function location()
    {
        if ($this->mylevel_userate == 2)
        {
            $retval = "reverse";
        }
        else
        {
            $retval = "normal";
        }
        return $retval;
    }
}

?>
<?php
/*
+---------------------------------------------------------------+
|        Latest Release Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2009
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . "latestrelease_menu/languages/" . e_LANGUAGE . ".php");

class latestrelease
{
    function latestrelease()
    {
        global $LATESTRELEASE_PREF;
        $this->load_prefs();
    }
    function getdefaultprefs()
    {
        global $LATESTRELEASE_PREF,$pref;
        $LATESTRELEASE_PREF = array("latedl_limitdown" => 10,
            "latedl_maxchars" => 200,
            "latedl_dlbutton" => 1,
            "latedl_dlsize" => 1,
            "latedl_dlcat" => 1,
            "latedl_dlauth" => 1,
            "latedl_dlcount" => 1,
            "latedl_dlstamp" => 1,
            "latedl_dp" => '.',
            "latedl_thou" => ',',
            "latedl_class" => 'forumheader3',
            "latedl_expand" => 1,
            "latedl_down_allow_description" => 1,
            "latedl_top" => 0,
            );
            unset($pref['latedl_limitdown']);
            unset($pref['latedl_maxchars']);
            unset($pref['latedl_dlbutton']);
            unset($pref['latedl_dlsize']);
            unset($pref['latedl_dlauth']);
            unset($pref['latedl_dlcount']);
            unset($pref['latedl_dlstamp']);
            unset($pref['latedl_dp']);
            unset($pref['latedl_thou']);
            unset($pref['latedl_class']);
            unset($pref['latedl_expand']);
            unset($pref['latedl_down_allow_description']);
            save_prefs();

    }
    function save_prefs()
    {
        global $sql, $eArrayStorage, $LATESTRELEASE_PREF;
        // save preferences to database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $tmp = $eArrayStorage->WriteArray($LATESTRELEASE_PREF);
        $sql->db_Update("core", "e107_value='$tmp' where e107_name='latestrelease'", false);
        return ;
    }
    function load_prefs()
    {
        global $sql, $eArrayStorage, $LATESTRELEASE_PREF;
        // get preferences from database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $num_rows = $sql->db_Select("core", "*", "e107_name='latestrelease' ");
        $row = $sql->db_Fetch();

        if (empty($row['e107_value']))
        {
            // insert default preferences if none exist
            $this->getDefaultPrefs();
            $tmp = $eArrayStorage->WriteArray($LATESTRELEASE_PREF);
            $sql->db_Insert("core", "'latestrelease', '$tmp' ");
            $sql->db_Select("core", "*", "e107_name='latestrelease' ");
        }
        else
        {
            $LATESTRELEASE_PREF = $eArrayStorage->ReadArray($row['e107_value']);
        }
        return;
    }
}

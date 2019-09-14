<?php

class league_table
{
    function league_table()
    {
        $this->load_prefs();
    }
    function getdefaultprefs()
    {
        global $LEAGUE_PREFS ;
        $LEAGUE_PREFS = array("league_played" => 1,
            "league_won" => 1,
            "league_lost" => 1,
            "league_drawn" => 1,
            "league_scored" => 1,
            "league_conceded" => 1,
            "league_points" => 1,
            "league_bonus" => 1,
            "league_mplayed" => 1,
            "league_mwon" => 1,
            "league_mlost" => 1,
            "league_mdrawn" => 1,
            "league_mscored" => 1,
            "league_mconceded" => 1,
            "league_mpoints" => 1,
            "league_mbonus" => 1,
            "league_dateform" => "long"
            );
    }

    function save_prefs()
    {
        global $sql, $eArrayStorage, $LEAGUE_PREFS;
        // save preferences to database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $tmp = $eArrayStorage->WriteArray($LEAGUE_PREFS);
        $sql->db_Update("core", "e107_value='$tmp' where e107_name='league_table'", false);
        return ;
    }

    function load_prefs()
    {
        global $sql, $eArrayStorage, $LEAGUE_PREFS;
        // get preferences from database
        if (!is_object($sql))
        {
            $sql = new db;
        }
        $num_rows = $sql->db_Select("core", "*", "e107_name='league_table' ");
        $row = $sql->db_Fetch();

        if (empty($row['e107_value']))
        {
            // insert default preferences if none exist
            $this->getDefaultPrefs();
            $tmp = $eArrayStorage->WriteArray($LEAGUE_PREFS);
            $sql->db_Insert("core", "'league_table', '$tmp' ");
            $sql->db_Select("core", "*", "e107_name='league_table' ");
        }
        else
        {
            $LEAGUE_PREFS = $eArrayStorage->ReadArray($row['e107_value']);
        }
        return;
    }
}

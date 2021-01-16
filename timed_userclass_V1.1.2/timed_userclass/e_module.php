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
if (!defined('e107_INIT'))
{
    exit;
}

require_once(e_PLUGIN . "timed_userclass/includes/timed_userclass_class.php");
if (!is_object($tclass_obj))
{
    $tclass_obj = new timed_userclass;
}
global $TCLASS_PREF, $sql, $tp, $tclass_classlist, $tclass_obj;
$tclass_now = time()+($pref['time_offset']*3600);
#print date("d m Y H:i",$tclass_now);
// only check once every 24 hours
#$tclass_today = mktime(0, 0, 0, date("m", $tclass_now), date("d", $tclass_now), date("Y", $tclass_now)) + 3600;
$tclass_today = time();

if ($tclass_obj->tclass_doall)
{

    if ($tclass_obj->tclass_active && ($tclass_now - $tclass_obj->tclass_lastcheck) >= 3600)
    {
        $TCLASS_PREF['tclass_lastcheck'] = $tclass_now;
        $tclass_obj->save_prefs();
        // do all users
        if ($sql->db_Select("tclass", "*", "where tclass_start <= $tclass_now and tclass_donestart = 0
	 order by tclass_start asc" , "nowhere", false))
        {
            $tclass_row = $sql->db_getList();
            # print "<pre>";
            # print_r($tclass_row);
           #  print "<br>Rec ".$tclass_row['tclass_id'];
          #   print "</pre>";
            $tclass_obj->do_promote(USERID, $tclass_row);
        }
    }
}
else
{
    // do one user who has just visited site
    if (USERID > 0)
    {
        if ($sql->db_Select("tclass", "*", "where tclass_userid=" . USERID . " and	tclass_start <= $tclass_now and tclass_donestart = 0
	 order by tclass_start asc" , "nowhere", false))
        {
            $tclass_row = $sql->db_getList();
            // print "<pre>";
            // print_r($tclass_row);
            // print "<br>Rec ".$tclass_row[1]['tclass_id'];
            // print "</pre>";
            $tclass_obj->do_promote(USERID, $tclass_row);
        }
    }
}

?>
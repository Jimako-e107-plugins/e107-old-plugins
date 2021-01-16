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
if (!defined('e107_INIT'))
{
    exit;
}
global $APROM_PREF, $sql, $tp, $aprom_classlist, $aprom_obj;
if (!is_object($aprom_obj))
{
    require_once(e_PLUGIN . "auto_promote/includes/auto_promote_class.php");
    $aprom_obj = new auto_promote;
}


if ($APROM_PREF['aprom_active'] != 1 || strpos(e_SELF, "auto_promote") > 0)
{
    return;
}
$aprom_doupdate = true;
// print "" . $APROM_PREF['aprom_last'] . "<br>" . (time() - (86400));
if ($APROM_PREF['aprom_cont'] != 1)
{
    // just check once per day
    $aprom_doupdate = $APROM_PREF['aprom_last'] < (time() - (3600));
}
// print $APROM_PREF['aprom_last'];
if ($aprom_doupdate)
{
    // print "here";
    $sql->db_Select("userclass_classes", "userclass_id,userclass_name", "order by userclass_name", "nowhere", false);
    while ($aprom_row = $sql->db_Fetch())
    {
        $aprom_classlist[$aprom_row['userclass_id']] = $aprom_row['userclass_name'];
    } // while
    $aprom_obj->do_promote();
    $APROM_PREF['aprom_last'] = time();
    $aprom_obj->save_prefs();
}

?>
<?php
/*
+---------------------------------------------------------------+
|	Auto Assign Plugin for e107
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

function auto_assign_usersup($data)
{
    global $sql, $pref;
    $name = $data['name'];
    $logname = $data['loginname'];
    // get the existing userclasses the person is a member of (on sign up)
    // has to be done as a query because insufficent info is passed across
    $sql->db_Select('user', 'user_class', 'where user_name="' . $name . '" and user_loginname = "' . $logname . '" ', 'nowhere', false);
    $row = $sql->db_Fetch();
    $class_extant = explode(',', $row['user_class']);

    foreach($class_extant as $key => $value)
    if (intval($value) == 0)
    {
        unset($class_extant[$key]);
    }
    $add = false;
    if ($pref['autoassign_class1'] <> 255 && !in_array($pref['autoassign_class1'], $class_extant))
    {
        $class_extant[] = $pref['autoassign_class1'];
    }
    if ($pref['autoassign_class2'] <> 255 && !in_array($pref['autoassign_class2'], $class_extant))
    {
        $class_extant[] = $pref['autoassign_class2'];
    }
    if ($pref['autoassign_class3'] <> 255 && !in_array($pref['autoassign_class3'], $class_extant))
    {
        $class_extant[] = $pref['autoassign_class3'];
    }
    if ($pref['autoassign_class4'] <> 255 && !in_array($pref['autoassign_class4'], $class_extant))
    {
        $class_extant[] = $pref['autoassign_class4'];
    }
    if ($pref['autoassign_class5'] <> 255 && !in_array($pref['autoassign_class5'], $class_extant))
    {
        $class_extant[] = $pref['autoassign_class5'];
    }
    $new_array = array_unique($class_extant);
    sort($new_array);

    $class_list = implode(',', $new_array);

    $sql->db_Update('user', 'user_class="' . $class_list . '" where user_name="' . $name . '" and user_loginname = "' . $logname . '" ', false);
}

?>
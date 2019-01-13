<?php
// include language file
include_lan(e_PLUGIN."roster/languages/admin/".e_LANGUAGE.".php");

global $pageid;

//Roster Management
$butname[]  = roster_LAN_ADMIN_ROSTER_MENU_1;
$butlink[]  = "admin_ngroup.php";
$butid[]    = "newgroup";

$butname[]  = roster_LAN_ADMIN_ROSTER_MENU_2;
$butlink[]  = "admin_egroup.php";
$butid[]    = "editgroup";

$butname[]  = roster_LAN_ADMIN_ROSTER_MENU_3;
$butlink[]  = "admin_nmem.php";
$butid[]    = "newmember";

$butname[]  = roster_LAN_ADMIN_ROSTER_MENU_4;
$butlink[]  = "admin_emem.php";
$butid[]    = "editmember";

for ($i=0; $i<count($butname); $i++) {
    $var[$butid[$i]]['text'] = $butname[$i];
    $var[$butid[$i]]['link'] = $butlink[$i];
};  
 
show_admin_menu(CPANEL, $pageid, $var);

unset($var);
unset($butname);
unset($butlink);
unset($butid);

?>

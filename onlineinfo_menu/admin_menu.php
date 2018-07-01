<?php
/*
+---------------------------------------------------------------+
|     Easy-Admin-Menu v1.0 - by Cameron ( www.e107coders.org)
|     For the e107 CMS by Steve Dunstan
|     www.e107.org
+---------------------------------------------------------------+
*/

require_once('../../class2.php');
if(!getperms('P')){ header("location:".e_BASE."index.php"); exit ;}
require_once(e_ADMIN.'auth.php');
require_once(e_HANDLER.'userclass_class.php');

$lan_file = e_PLUGIN.'onlineinfo_menu/languages/admin_'.e_LANGUAGE.'.php';
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'onlineinfo_menu/languages/admin_English.php');


    $menutitle = ONLINEINFO_LOGIN_MENU_A77;

    $butname[] = ONLINEINFO_LOGIN_MENU_A71;  // Admin Menu Button Name
    $butlink[] = "admin_config.php";  // Admin Menu Button Link.

    $butname[] = ONLINEINFO_LOGIN_MENU_A101;  // Admin Menu Button Name
    $butlink[] = "admin_config_usercols.php";  // Admin Menu Button Link.

    $butname[] = ONLINEINFO_LOGIN_MENU_A72;  // Admin Menu Button Name
    $butlink[] = "admin_config_who.php";   // Admin Menu Button Link.

 	$butname[] = ONLINEINFO_LOGIN_MENU_A76;  // Admin Menu Button Name
    $butlink[] = "admin_config_late.php";   // Admin Menu Button Link.  
    
    $butname[] = ONLINEINFO_LOGIN_MENU_A73;  // Admin Menu Button Name
    $butlink[] = "admin_config_extra.php";   // Admin Menu Button Link.

    $butname[] = ONLINEINFO_LOGIN_MENU_A36;  // Admin Menu Button Name
    $butlink[] = "admin_config_order.php";   // Admin Menu Button Link.
    
    $butname[] = ONLINEINFO_LOGIN_MENU_A127;  // Admin Menu Button Name
    $butlink[] = "admin_suspend.php";   // Admin Menu Button Link.   
    

    $butname[] = ONLINEINFO_LOGIN_MENU_A183;  // Admin Menu Button Name
    $butlink[] = "admin_vupdate.php";   // Admin Menu Button Link.


    $butname[] = ONLINEINFO_IPB_A1;  // Admin Menu Button Name
    $butlink[] = "admin_config_IPB.php";   // Admin Menu Button Link.
    
    $butname[] = ONLINEINFO_SMF_1;  // Admin Menu Button Name
    $butlink[] = "admin_config_smf.php";   // Admin Menu Button Link.

	$butname[] = ONLINEINFO_LOGIN_MENU_A110;  // Admin Menu Button Name
    $butlink[] = "admin_config_flashchat.php";   // Admin Menu Button Link.
    
    $butname[] = ONLINEINFO_LOGIN_MENU_A145;  // Admin Menu Button Name
    $butlink[] = "admin_config_gallery2.php";   // Admin Menu Button Link.
    
    $butname[] = ONLINEINFO_LOGIN_MENU_A184;  // Admin Menu Button Name
    $butlink[] = "admin_config_coppermine.php";   // Admin Menu Button Link.

    for ($i=0; $i<count($butname); $i++) {
    $option = 'option_'.$i;
   if(IsSet($_POST[$option])){
    $link = $butlink[$i];
    header("location: $link");
    exit;
    }
}



    $text = '<div style="text-align:center">
    <form method="post" action="'.e_SELF.'">
    <table style="width:85%" class="fborder">';

    for ($i=0; $i<count($butname); $i++) {
    	
    	if($butname[$i]==ONLINEINFO_IPB_A1){$text.='<tr><td class="forumheader3" style="width:30%; font-weight:bold; text-align:center;"><hr>'.ONLINEINFO_LOGIN_MENU_A149.'<hr></td></tr>';}
    	
    	
    $text .='
    <tr>
    <td class="forumheader3" style="width:30%; text-align:center"><input class="button" style="width: 100%" type="submit" name="option_'.$i.'" value="'.$butname[$i].'" /></td>
    </tr>';

    };

    $text .='</table>
    </form>
    ';
    



    $ns -> tablerender($menutitle, $text);



?>
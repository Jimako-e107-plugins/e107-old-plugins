<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Event trigger: e107_plugins/sgallery/e_module.php
|        Email: secretr@e107bg.org
|        $Revision: 739 $
|        $Date: 2008-04-22 14:03:31 +0300 (Tue, 22 Apr 2008) $
|        $Author: secretr $
|	     Copyright Corllete Lab ( http://www.clabteam.com ) under GNU GPL License (http://gnu.org)
|        Free Support: http://free-source.net/
+----------------------------------------------------------------------------------------------------+
*/
$e_event -> register("postuserset", "sgallery_postuserset");

function sgallery_postuserset($data) {
    global $sql, $tp;

    $uname = $data['username'] ? $data['username'] : $data['userloginname'];
    
    $uid = 0;
    //missing user_id in user data array!
    if($data['email']) {
        $data['email'] = $tp->toDB($data['email']);
        if($sql->db_Select('user',"user_id", "user_email='{$data['email']}'")) {
            $tmp = $sql -> db_Fetch();
            $uid = $tmp['user_id'];
        }
    }
    
    if(!$uid || !$uname) return ''; //shoud not happen
    $newstr = $uid.'.'.$tp->toDB($uname);
    
    $sql -> db_Update("sgallery", "sgal_user='{$newstr}' WHERE sgal_user LIKE '{$uid}.%'");
    $sql -> db_Update("sgallery_submit", "submit_user='{$newstr}' WHERE submit_user LIKE '{$uid}.%'");
}
?>
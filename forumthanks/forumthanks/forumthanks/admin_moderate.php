<?php

   require_once("../../class2.php");

   if (!getperms("P")) {
      header("location:".e_HTTP."index.php");
      exit;
   }

   require_once(e_ADMIN."auth.php");
   
   $e_sub_cat = 'moderate';
   

   $tmp             = explode(".", e_QUERY);
   $action          = preg_replace('#\W#', '', $tmp[0]);
   $id              = intval($tmp[1]);
   
   include_lan(e_PLUGIN.'forumthanks/languages/'.e_LANGUAGE.'/lan_admin_thanks.php');

if ($action=='mo'){

 
   if(isset($_POST['confirmdelete']))
   {

   $sql->db_Delete("forum_thanks","Thanks_ToUserID = $id");

   $ns->tablerender("Deleted!", "Thanks Removed!");
   require_once(e_ADMIN."footer.php");
   exit;
   }
   elseif(isset($_POST['denydelete']))
   {
   $ns->tablerender("Denied", "Not Deleted");
   require_once(e_ADMIN."footer.php");
   exit;
   }
                                          
   $cnt = $sql->db_count("forum_thanks","(*)","where Thanks_ToUserID = $id");
   $text = "  <div style='text-align:center'>
              <form method='post' action='".e_SELF."?".e_QUERY."'>\n
              <table style='".USER_WIDTH."' class='fborder'>
                <tr style='vertical-align:top'>
                <td colspan='2' style='text-align:center' class=''>
                ".LAN_AT18." $id ".LAN_AT19." $cnt ".LAN_AT20."
                <p> ".LAN_AT17."
                <input class='button' type='submit' name='confirmdelete' value='".LAN_AT21."' />
                <input class='button' type='submit' name='denydelete' value='".LAN_AT22."' />
                </td>
                </tr>
              </table>
              </form>
              </div>
           ";

}


else{
    $text = '<script src="'.e_PLUGIN.'forumthanks/js/matchuser.js"></script>';

    $text .= "".LAN_AT15."
              <input class='tbox search' type='text' name='q' size='20' onkeyup='showHint(this.value)'".$value_text." maxlength='50' />
              <span id='usr_hint'></span>
               ";
}

   $ns->tablerender(LAN_AT14, $text);



   require_once(e_ADMIN."footer.php");
?>


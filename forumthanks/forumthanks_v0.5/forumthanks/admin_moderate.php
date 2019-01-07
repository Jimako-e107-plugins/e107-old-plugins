<?php

   require_once("../../class2.php");

   if (!getperms("P")) {
      header("location:".e_HTTP."index.php");
      exit;
   }

   require_once(e_ADMIN."auth.php");

   $tmp             = explode(".", e_QUERY);
   $action          = preg_replace('#\W#', '', $tmp[0]);
   $id              = intval($tmp[1]);

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
                User $id has been thanked $cnt time(s)
                <p> Delete all thanks for user?  This cannot be undone. Take regular database backups.
                <input class='button' type='submit' name='confirmdelete' value='Yes' />
                <input class='button' type='submit' name='denydelete' value='No' />
                </td>
                </tr>
              </table>
              </form>
              </div>
           ";

}


else{
    $text = '<script src="'.e_PLUGIN.'forumthanks/js/matchuser.js"></script>';

    $text .= "Enter User name to search for:
              <input class='tbox search' type='text' name='q' size='20' onkeyup='showHint(this.value)'".$value_text." maxlength='50' />
              <span id='usr_hint'></span>
               ";
}

   $ns->tablerender("Moderate User", $text);



   require_once(e_ADMIN."footer.php");
?>


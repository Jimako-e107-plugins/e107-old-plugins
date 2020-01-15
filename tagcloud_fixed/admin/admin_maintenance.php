<?php

require_once("admin_leftblock.php");

if (!getperms("P")) {
	header("location:".e_HTTP."index.php");
	exit;
}
 
class currentplugin_adminArea extends leftblock_adminArea
{
       
}
  
new currentplugin_adminArea();

require_once(e_PLUGIN.'tagcloud/tagcloud_class.php');
$tagcloud = new e107tagcloud;


$plugPrefs = e107::getPlugConfig('tagcloud')->getPref();
 
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."userclass_class.php");


//-------------------------------------------------------
//----------------  Handle form posting
 
if (isset($_POST['menu'])) {

 $query ="select distinct menu_path from #menus
         where abs(menu_path)>0";

 $sql->db_select_gen($query);
 $row = $sql->db_getlist();
 foreach ($row as $del){
  $sql->db_delete("tag_main","Tag_Type ='news' and Tag_Item_ID= ".$del['menu_path']) ;
 }


 $message ="e107 menu Page tags removed";
}

if (isset($_POST['orphan'])) {

        $message ="Not yet implemented - coming soon!";
}

if (isset($_POST['minlen'])) {

   $query = "Delete 
              #tag_main
             where 
              CHAR_LENGTH(Tag_Name) <".$plugPrefs['tags_minlen'];

   $cnt = $sql->db_delete("tag_main","CHAR_LENGTH(Tag_Name) <".$plugPrefs['tags_minlen']);

   $message = $cnt." tags less than ".$plugPrefs['tags_minlen']." characters long removed";
}




   // Display
   if (isset($message)) {
	$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}




$text = "<div style='text-align:center'>
	<form method='post' action='".e_SELF."' id='cfgform'>
	<table style='".ADMIN_WIDTH."' class='fborder'>


	<tr>
	<td class='forumheader3' style='width:40%'>Remove Orphan tags:</td>
        <td class='forumheader3' style='width:60%'>
	<input class='button' type='submit' name='orphan' value='Delete' />
	</td>
	</tr>
	
	<tr>
	<td class='forumheader3' style='width:40%'>Remove tags less than min pref:<br>(Currently set at:".$plugPrefs['tags_minlen'].")</td>
        <td class='forumheader3' style='width:60%'>
	<input class='button' type='submit' name='minlen' value='Delete' />
	</td>
	</tr>
	<tr>
	<td class='forumheader3' style='width:40%'>Delete tags associated with custom menu pages (ie <a href='".e_ADMIN."cpage.php'>here</a>)</td>
        <td class='forumheader3' style='width:60%'>
	<input class='button' type='submit' name='menu' value='Delete' />
	</td>
	</tr>

	</table>
	</form>
	</div>";





   // The usual, tell e107 what to include on the page
   $ns->tablerender("Prefs", $text);

   require_once(e_ADMIN."footer.php");
?>


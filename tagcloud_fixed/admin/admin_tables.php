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

   if (!getperms("P")) {
      header("location:".e_HTTP."index.php");
      exit;
   }


   require_once(e_ADMIN."auth.php");


//--get contents of config, load into form
//--have 1 extra empty one, if populated we add a new config entry - validate it first!
//--have update, delete, active options
//--also, could have a reset tags button, a tag count

   $message ="Don't alter this if you are not familiar with e107 table structures!";

if (isset($_POST['update'])) {
   //ADD:needs some validation in here, ie check that the user entered details are usable
   $insert="null,0,'".$_POST['New_ID']."','".$_POST['New_Title']."','".$_POST['New_Body']."','".$_POST['New_Table']."','".$_POST['New_Datestamp']."'";
    echo "$insert";
    $sql->db_insert("tag_config",$insert);

    $message = "Updates Entered!";
   }

   if (isset($message)) {
	$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
   }

//form header
$text = "
        <div style='text-align:center'>
	<form method='post' action='".e_SELF."' id='tabform'>
	<table style='".ADMIN_WIDTH."' class='fborder'>
        <tr>
        <td class='fcaption' style='width:15%'>Area</td>
        <td class='fcaption' style='width:15%'>Table</td>
        <td class='fcaption' style='width:15'>Id Column</td>
        <td class='fcaption' style='width:15%'>Title Field</td>
        <td class='fcaption' style='width:15%'>Body Field</td>
        <td class='fcaption' style='width:15%'>Datestamp</td>
        <td class='fcaption' style='width:10%'>Delete</td>
	</tr>
	";

   /*Tag_Config_ID
   Tag_Config_Flag
   Tag_Config_Field_ID
   Tag_Config_Field_Title
   Tag_Config_Field_Body
   Tag_Config_Field_Table
   Tag_Config_Field_Datestamp*/

if($sql->select("tag_config","*"))
          { $cnt = 0;
            $cnt++;
            while ($config = $sql->fetch())
                 {
                 //build up existing form rows
                 $text .= "
                 <tr>
                 <td class='fcaption' style='width:15%'>".$config['Tag_Config_Field_Table']."</td>
               	 <td class='forumheader3' style='width:15%'><input  class='tbox' type='text' name='".$config['Tag_Config_ID']."' value = '".$config['Tag_Config_Field_Table']."'     SIZE='15' MAXLENGTH='20'/></td>
               	 <td class='forumheader3' style='width:15%'><input  class='tbox' type='text' name='".$config['Tag_Config_ID']."' value = '".$config['Tag_Config_Field_ID']."'        SIZE='15' MAXLENGTH='20'/></td>
               	 <td class='forumheader3' style='width:15%'><input  class='tbox' type='text' name='".$config['Tag_Config_ID']."' value = '".$config['Tag_Config_Field_Title']."'     SIZE='15' MAXLENGTH='20'/></td>
               	 <td class='forumheader3' style='width:15%'><input  class='tbox' type='text' name='".$config['Tag_Config_ID']."' value = '".$config['Tag_Config_Field_Body']."'      SIZE='15' MAXLENGTH='20'/></td>
               	 <td class='forumheader3' style='width:15%'><input  class='tbox' type='text' name='".$config['Tag_Config_ID']."' value = '".$config['Tag_Config_Field_Datestamp']."' SIZE='15' MAXLENGTH='20'/></td>
               	 <td class='forumheader3' style='width:10%'><input type='checkbox' /></td>
	         </tr>
                 <tr>
                 <td class='fcaption' style='width:15%'></td>
               	 <td colspan='4' class='forumheader3' style='width:15%'>Tag Link: <input  class='tbox' type='text' name='".$config['Tag_Config_ID']."' value = '".$config['Tag_Config_Link']."'     SIZE='50' MAXLENGTH='50'/></td>
               	 <td colspan='2' class='forumheader3' style='width:15%'>Tag Area: <input  class='tbox' type='text' name='".$config['Tag_Config_ID']."' value = '".$config['Tag_Config_Area']."'     SIZE='10' MAXLENGTH='10'/></td>
	         </tr>
                 ";
                                             }
}

//add one empty form row here
                 $text .= "
                 <tr>
                 <td colspan='7' style='text-align:center' class='forumheader'>
             	 Enter New Below:
                 </td>
		 </tr>
                 <tr>
              	 <td class='fcaption' style='width:15%'></td>
               	 <td class='forumheader3' style='width:15%'><input  class='tbox' type='text' name='New_Table'     SIZE='10' MAXLENGTH='20'/></td>
               	 <td class='forumheader3' style='width:15%'><input  class='tbox' type='text' name='New_ID'        SIZE='10' MAXLENGTH='20'/></td>
               	 <td class='forumheader3' style='width:15%'><input  class='tbox' type='text' name='New_Title'     SIZE='10' MAXLENGTH='20'/></td>
               	 <td class='forumheader3' style='width:15%'><input  class='tbox' type='text' name='New_Body'      SIZE='10' MAXLENGTH='20'/></td>
               	 <td class='forumheader3' style='width:15%'><input  class='tbox' type='text' name='New_Datestamp' SIZE='10' MAXLENGTH='20'/></td>
               	 <td class='forumheader3' style='width:10%'></td>
	         </tr>
	         <tr>
                 <td class='fcaption' style='width:15%'></td>
               	 <td colspan='4' class='forumheader3' style='width:15%'>Tag Link: <input  class='tbox' type='text' name='Tag_Config_Link'   SIZE='50' MAXLENGTH='50'/></td>
               	 <td colspan='2' class='forumheader3' style='width:15%'>Tag Area: <input  class='tbox' type='text' name='Tag_Config_Area'   SIZE='10' MAXLENGTH='10'/></td>
	         </tr>
                 <tr>
                 <td colspan='7' style='text-align:center' class='forumheader'>
             	 <input class='button' type='submit' name='update' value='Enter changes' />
                 </td>
		 </tr>
                 </table>
	         </form>
	         </div>
                 ";






   // The usual, tell e107 what to include on the page
   $ns->tablerender("Advanced Table Config", $text);

   require_once(e_ADMIN."footer.php");
?>


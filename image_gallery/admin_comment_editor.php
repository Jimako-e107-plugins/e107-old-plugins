<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/admin_comment_editor.php
|
| Revision: 0.9.7
| Date: 2008/02/15
| Author: Krassswr
|
|	krassswr@abv.bg
|
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

   // Remember that we must include class2.php
   require_once("../../class2.php");

   // Check current user is an admin, redirect to main site if not
   if (!getperms("P")) {
      header("location:".e_HTTP."index.php");
      exit;
   }

   // Include page header stuff for admin pages
   require_once(e_ADMIN."auth.php");
   require_once(e_HANDLER."form_handler.php");
   require_once(e_HANDLER."userclass_class.php");

   // Handle preferences form being submitted
   // n.b. to complex to list in this example

   // Our informative text
   $lan_file = e_PLUGIN."image_gallery/languages/image_gallery_".e_LANGUAGE.".php";
   require_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."image_gallery/languages/image_gallery_English.php");

   include_lan(e_PLUGIN.'clock_menu/languages/'.e_LANGUAGE.'.php');

   require_once("myfuncs.php");
   require_once ("functions.php");

   function admin_comment_editor_adminmenu() {
      show_menu("Comment");
   }

global $conn;
$conn = @mysql_connect($mySQLserver,$mySQLuser,$mySQLpassword);
if ($conn==FALSE) {
      die("<br />ERROR: cannot connect to database<br />" );
  }

//e107 DB API
global $mydb;
$mydb = new db();
$mydb->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);


     function printclasses($author_id, $mydb)
    {
        $classnames = '';
        $propperuser = FALSE;
        $mydb->db_Select("user", "user_class, user_perms", "user_id = '$author_id'");
        $result1 = $result->mySQLrows;
        if ($result1 > 0)
        {
            $row1 = $mydb->db_Fetch(MYSQL_ASSOC);
            $userclasses = $row1['user_class'];
        }
        if ($row1['user_perms'] == "0" OR $row['user_perms'] == "0."){$classnames = "Admin<br />"; return $classnames;}
        $arrayuserclasses = explode(",", $userclasses);
        foreach ($arrayuserclasses as $key => $value)
        {
            $mydb->db_Select("userclass_classes", "userclass_name", "userclass_id = '$value'");
            $result1 = $result->mySQLrows;
            if ($result1 > 0)
            {
                $row1 = $mydb->db_Fetch(MYSQL_ASSOC);
                //$row1 = mysql_fetch_row($result1);
            }
            $classnames .= $row1[0]."<br />";
        }
        return $classnames;
        //check class
        //get names of user classes
    }
     /* DA ot tuk po4vam az   DELL */

if(isset($_POST['delete']))
{
	$tmp = array_keys($_POST['delete']);
	list($delete, $del_id) = explode("_", $tmp[0]);
}

if ($delete == "comment" && $del_id)
{
    $result = $mydb->db_Delete("tbl_comment", "index_comment = '$del_id'");
    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
	unset($delete, $del_id);
}
/* DA DELL END*/



 // EDITING
/*EDIT NEW*/
if(isset($_POST['edit']))
{
  	$tmp = array_keys($_POST['edit']);
	list($edit, $edit_id) = explode("_", $tmp[0]);
}

if ($edit == "commentid" && $edit_id)
{
   if (isset($_POST['editcomment']) AND $_POST['editcomment'] != ''){
        $comment = mysql_real_escape_string(trim($_POST['editcomment']));
    }
   $result = $myfb->db_Update("tbl_comment", "im_id_comment = '$comment'", "index_comment = '$edit_id'");
    if (!$result) {
        die('Error, updating comment: ' . mysql_error());
    }
	unset($edit, $edit_id, $comment);
}
/*EDIT*/

/*FILTERING*/
$flag_filter = FALSE;
$year = date('o');
$month = date('n');
$day = date('j');
if (isset($_POST['year']) AND isset($_POST['month']) AND isset($_POST['day']))
{
    $year = (int)$_POST['year'];
    $month = (int)$_POST['month'];
    $day = (int)$_POST['day'];
    if (checkdate($month,$day,$year))
    {
        $datata = $year."-".$month."-".$day;
        $flag_filter = TRUE;
    }else
    {
        $ns->tablerender(image_gallery_CONFIG_L1, image_gallery_CONFIG_COMEL5);
        mysql_close ($conn);
        require_once(e_ADMIN."footer.php");
    }
}

if (isset($_GET['year']) AND isset($_GET['month']) AND isset($_GET['day']) AND
$_GET['year']!="" AND $_GET['month']!="" AND $_GET['day']!="")
{   $flag_filter = TRUE;
    $year = (int)$_GET['year'];
    $month = (int)$_GET['month'];
    $day = (int)$_GET['day'];
    $datata = $year."-".$month."-".$day;
}
/*FILTERING*/

   $text ='

<script type="text/javascript">
function show_hide_field(field)

{

  veld = eval("document.getElementById(field).style.display");

  if (veld == \'block\')
  {
    eval("document.getElementById(field).style.display = \'none\'");
  }

  else
  {
    eval("document.getElementById(field).style.display = \'block\'");
  }
}
</script>';


   //add pageing
   $albumPerPage = $pref['img_commentsPerPage'];
$pageNumber  = isset($_GET['pageNum']) ? (int)$_GET['pageNum'] : 1;

$offset = abs($pageNumber - 1) * $albumPerPage;  //abs

$serial = $offset + 1;
   //end add pageing

   if ($flag_filter)
   {
      $query = "
        SELECT DISTINCT im.im_id, im.im_description, im.im_title, im.im_thumbnail, im.im_album_id
        FROM `#tbl_image` AS im  JOIN `#tbl_comment` AS cm ON im.im_id = cm.im_id WHERE comment_datestamp > '".$datata."' ORDER BY im_id,index_comment DESC";
   }
   else{
     $query = "
     SELECT DISTINCT im.im_id, im.im_description, im.im_title, im.im_thumbnail, im.im_album_id
      FROM `#tbl_image` AS im  JOIN `#tbl_comment` AS cm ON im.im_id = cm.im_id ORDER BY im_id,index_comment DESC";
    }

   //$result = mysql_query($query . " LIMIT $offset,$albumPerPage", $conn) or die('Error, get image info failed. ' . mysql_error());
   $mydb->db_Select_gen($query . " LIMIT $offset,$albumPerPage");
   $result = $mydb->mySQLrows;
   //drop down filters
   $text .= '<FORM ACTION="" METHOD=post>
            <SELECT NAME="year">
            <OPTION VALUE="">'.image_gallery_CONFIG_COMEL1;
            for ($i= date('o'); $i>date('o')-6; $i--)
            {   //echo $year.'a'; continue;
                if(isset($year) and $year != $i)
                {
                   $text.='<OPTION VALUE="'.$i.'">'.$i.'';
                }
                else{
                   $text.='<OPTION selected VALUE="'.$i.'">'.$i.'';
                }
            }
   $text .='</SELECT>
            <SELECT NAME="month">
            <OPTION VALUE="">'.image_gallery_CONFIG_COMEL2;
            for ($i= 1; $i<=12; $i++)
            {   $tmp="CLOCK_MENU_L".($i+11);
                if(isset($month) and $month !=$i)
                {
                    $text.='<OPTION VALUE="'.$i.'">'.constant($tmp).'</option>';
                }
                else{
                    $text.='<OPTION selected VALUE="'.$i.'">'.constant($tmp).'</option>';
                }
            }

   $text .='</SELECT>
            <SELECT NAME="day">
            <OPTION VALUE="">'.image_gallery_CONFIG_COMEL3;

            for ($i= 1; $i<=31; $i++)
            {
                if(isset($day) and $day !=$i)
                {
                    $text.='<OPTION VALUE="'.$i.'">'.$i.'';
                }
                else{
                    $text.='<OPTION selected VALUE="'.$i.'">'.$i.'';
                }
            }
   $text.='</SELECT>
           <INPUT TYPE=submit VALUE="'.image_gallery_CONFIG_COMEL4.'" />
           </FORM><br />';
      //drop down filters.

   $text .= '</table><table width="100%" border="1" class=\'maintable\' cellspacing=\'0\' cellpadding=\'0\'>';

       $URLaddress =str_replace('admin_comment_editor.php', 'image_gallery.php', $_SERVER["PHP_SELF"]);

       $mydb2 = new db();
       $mydb2->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);

       $mydb3 = new db();
       $mydb3->db_Connect($mySQLserver, $mySQLuser, $mySQLpassword, $mySQLdefaultdb);

       while ($row = $mydb->db_Fetch(MYSQL_ASSOC)) {

        $imageId = (INT) $row['im_id'];


        if ($flag_filter)
        {
            $mydb2->db_Select("tbl_comment", "index_comment, im_author, im_id_comment, comment_datestamp, im_author_ip, im_author_id, im_id",  "im_id = '$imageId' and comment_datestamp > '$datata' ORDER BY index_comment DESC");
            $result1 = $mydb2->mySQLrows;
        }else
        {
            $mydb2->db_Select("tbl_comment", "index_comment, im_author, im_id_comment, comment_datestamp, im_author_ip, im_author_id, im_id", "im_id = '$imageId' ORDER BY index_comment DESC");
            $result1 = $mydb2->mySQLrows;
        }
        $m_rows = $result;
        if($m_rows != 0)
          {


         //<a href="?page=image-detail&amp;album=' . $albumId . '&amp;image=' . $row['im_id'] . '">
		 //   <img style="margin:4px;" src="viewImage.php?type=glthumbnail&amp;name=' . $row['im_thumbnail'] . '" border="0" alt="'. $row['im_title'] .'" /></a>
	    $text .= '<tr>
                    <td width="1%" valign=\'top\' class=\'fcaption\'>
                    <center>
                    <a href="'.$URLaddress.'?page=image-detail&amp;album=' . $row['im_album_id'] . '&amp;image=' . $row['im_id'] . '">
		            <img style="margin:4px;" src="viewImage.php?type=glthumbnail&amp;name=' . $row['im_thumbnail'] . '" border="0" alt="'. $row['im_title'] .'" /></a>
                    </center><br />
                    <center>' . $row['im_title'] . '</center>
                    <p><b>'.image_gallery_CONFIG_L9.':</b>' . $row['im_description'] . '</td>
                    <td valign=\'top\'>' ;


          $i = 0;
          $num_rows = $result1;
       if ($num_rows !== 0)
       {

             $text .= "<table width=\"100%\" class='maintable' cellspacing='0' cellpadding='0'><tr>
                       <td class='forumheader' style='vertical-align:top'>".image_gallery_Lanauthor."</td>
                       <td class='forumheader' style='vertical-align:top'>".image_gallery_Lancomments."</td>
                       <td class='forumheader' style='vertical-align:top'>".image_gallery_Lanadmin."</td></tr>";
        while ($myrow = $mydb2->db_Fetch(MYSQL_ASSOC)) {

                $text.="<tr><td width=\"100\" class='forumheader3' style='vertical-align:top'><b>".$myrow['im_author']."</b><br />".printclasses($myrow['im_author_id'], $mydb3)."<br />".image_gallery_CONFIG_L23.":".$myrow['comment_datestamp']."</td><td class='forumheader3' style='vertical-align:top'>";

             $text .= $myrow['im_id_comment']."<DIV id=\"ig".$myrow['index_comment']."\" style=\"DISPLAY: none\">
                                <table><tr><td><center>
                                <form action=".e_SELF."?".e_QUERY." id='image_gallery".$myrow['index_comment']."' method='post'><br />
                                <textarea name=\"editcomment\" rows=\"10\" cols=\"56\">".$myrow['im_id_comment']."</textarea>
                                <input type=\"submit\" name='edit[commentid_{$myrow['index_comment']}]' value=".image_gallery_CONFIG_L20." class='button' />
                                </form></center></td></tr></table></div>";


                $text.="</td><td class='forumheader3' style='vertical-align:top' width=\"100\">".image_gallery_LanIp.": ".$myrow['im_author_ip']."<br /><center>
                                   <form action=".e_SELF."?".e_QUERY." id='image_gallery".$myrow['index_comment']."a' method='post'>
                                   <input type='image' title='".image_gallery_CONFIG_LCOMMDel."' name='delete[comment_{$myrow['index_comment']}]' src='".ADMIN_DELETE_ICON_PATH."' onclick=\"return jsconfirm('".image_gallery_Landelete."?')\"/>
                                   <IMG alt=\"".image_gallery_CONFIG_LCOMMEdit."\"onclick=\"show_hide_field('ig".$myrow[index_comment]."');\" height=16 src='".ADMIN_EDIT_ICON_PATH."' width=\"16\" /></form></center></td>";

                $text.="</tr>";
         }
         $text .="</Table>";
       }

 }
  else {

  $test .="</td></tr></table>";
  }

 }
$mydb2->db_Close();
$mydb3->db_Close();

   //add pageing
   $result = $mydb->db_Select_gen($query);
   $totalResults = $mydb->mySQLrows;

   if($flag_filter)
   {
       $text .="</td><tr><td style='text-align: center' colspan = 3 >". getPagingLink($totalResults, $pageNumber, $albumPerPage, "page=admin_comment_editor&amp;year=".$year."&amp;month=".$month."&amp;day=".$day."");
   }else{
       $text .="</td><tr><td style='text-align: center' colspan = 3 >". getPagingLink($totalResults, $pageNumber, $albumPerPage, "page=admin_comment_editor");
   }
   //end add pageing

   $test .="</td></tr></table>";


   $ns->tablerender(image_gallery_CONFIG_L1, $text);
   $mydb->db_Close();
   require_once(e_ADMIN."footer.php");

?>
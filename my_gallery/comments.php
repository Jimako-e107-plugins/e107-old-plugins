<?php
/*
+ ----------------------------------------------------------------------------------------------+
|     e107 website system  : http://e107.org.ru
|     Released under the terms and conditions of the GNU General Public License (http://gnu.org).
|
|     Plugin "my_gallery"
|     Author: Alex ANP alex-anp@ya.ru
+-----------------------------------------------------------------------------------------------+
*/

require_once("../../class2.php");

$lan_file = e_PLUGIN."my_gallery/languages/".e_LANGUAGE.".php";
include_once((file_exists($lan_file) ? $lan_file : e_PLUGIN."my_gallery/languages/English.php"));

$mydb = new db();

// ============ Comments Add/Read Begin ==============
if ($_GET['comm_id'] && $pref['mygallery_comments']) {
$comm_id = $_GET['comm_id'];

if ($comm_id == "add") {
   	$img = $_GET['img'];

    $values = array("img_name" => $img);
    $mydb->db_Insert("my_gallery", $values);
    $comm_id = "";
    $mydb->db_Select("my_gallery", "img_id", "img_name = '".$img."'");
    while($row = $mydb->db_Fetch()) {
        $comm_id = $row['img_id'];
        }
    header("location:".e_SELF."?comm_id=".$comm_id."");
    exit;
    }

$mydb->db_Select("my_gallery", "*", "img_id = '".$comm_id."'");
    while($row = $mydb->db_Fetch()) {
        $img = $row['img_name'];
        $img_title = $row['img_title'];
        $img_text = $row['img_description'];
        list($img_user_id, $img_user, $img_user_mail) = explode(".", $row['img_user']);
        if ($img_user_mail !="") $img_user_mail = explode("@", $img_user_mail);
        }

    $info = getimagesize("$img");
  	$a_img = array();
    $a_img = explode("/", $img);

    $img_h = $pref['mygallery_foto_icon_height'];
    $img_w = $pref['mygallery_foto_icon_width'];
    $tn_scr = "foto.php";
    if ($pref['mygallery_slide_show']) $tn_scr = "tn_foto.php";

$img_title = $tp->toHTML($img_title, true);
$img_text = $tp->toHTML($img_text, true);

$comm_text = "<div class='my_gall_comm_img'><table>
<tr>
  <td width='".$img_w."'>
    <img src='".$tn_scr."?img=".$img."&h=".$img_h."&w=".$img_w."'>
  </td>
  <td>
    ".($img_title != "" ? "<div class='my_gall_img_title'>".$img_title."</div>" : "" )."
    ".($img_text != "" ? "<div class='my_gall_img_text'>".$img_text."</div>" : "" )."
    ".(getperms("P") ? "<div class='memo_edit_buton'><a href='memo_edit.php?comm_id=".$comm_id."'>".MYGAL_L038."</a></div>" : "")."
    ".(($img_user_id != "" and $img_user_id != "0") ? "".MYGAL_L067.": <a href='".e_HTTP."user.php?id.".$img_user_id."'>".$img_user."</a>" : "")."
    ".(($img_user_id != "" and $img_user_id == "0") ? "".MYGAL_L067.": <a href='javascript:window.location=\"mai\"+\"lto:\"+\"$img_user_mail[0]\"+\"@\"+\"$img_user_mail[1]\";self.close();'>".$img_user."</a>" : "")."
    <br>".MYGAL_L027." ".$a_img[3]."
    <br>".MYGAL_L026." ".$info[0]."x".$info[1]."
    <br>".MYGAL_L046." ".$a_img[1]."/".$a_img[2]."</a>
    <br><a href='dload.php?file=".$img."'>".MYGAL_L022."</a>
  </td>
</tr>
</table></div>";

require_once(e_HANDLER."comment_class.php");
$cobj = new comment;

function pageRating($page_rating_flag, $comm_id)
	{
	  $rate_text = '';      // Notice removal
		if($page_rating_flag)
		{
			require_once(e_HANDLER."rate_class.php");
			$rater = new rater;
			$rate_text = "<br /><table style='width:100%'><tr><td style='width:50%'>";

			if ($ratearray = $rater->getrating("my_gallery", $comm_id))
			{
				if ($ratearray[2] == "")
				{
					$ratearray[2] = 0;
				}
				$rate_text .= "<img src='".e_IMAGE."rate/box/box".$ratearray[1].".png' alt='' style='vertical-align:middle;' />\n";
				$rate_text .= "&nbsp;".$ratearray[1].".".$ratearray[2]." - ".$ratearray[0]."&nbsp;";
				$rate_text .= ($ratearray[0] == 1 ? "vote" : "votes");
			}
			else
			{
				$rating .= LAN_PAGE_dl_13;
			}
			$rate_text .= "</td><td style='width:50%; text-align:right'>";

			if (!$rater->checkrated("my_gallery", $comm_id) && USER)
			{
				$rate_text .= $rater->rateselect("", "my_gallery", $comm_id);
			}
			else if(!USER)
			{
				$rate_text .= "&nbsp;";
			}
			else
			{
				$rate_text .= "";
			}
			$rate_text .= "</td></tr></table>";
		}
		return $rate_text;
	}



if (isset($_POST['commentsubmit']) && $pref['mygallery_comments'])
	{
	$cobj->enter_comment($_POST['author_name'], $_POST['comment'], 'my_gallery', $comm_id, $pid, $_POST['subject']);
	}

$action = "comments";

if ($action == "comments") {

$CUSTOMHEADER = "

";

$CUSTOMFOOTER = "

";

$CUSTOMPAGES .= " comments.php";



require_once(HEADERF);

    $comm_text .= pageRating($pref['mygallery_raters'], $comm_id);
    $ns -> tablerender($pref['mygallery_gallery_name'], $comm_text);
    $cobj -> compose_comment("my_gallery", "comment", $comm_id, "", $img, $showrate=FALSE);
    }

require_once(FOOTERF);

}
// ============ Comments Add/Read End ==============

?>
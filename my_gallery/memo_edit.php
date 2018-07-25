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
require_once(e_HANDLER."ren_help.php");

$mydb = new db();

$lan_file = e_PLUGIN."my_gallery/languages/".e_LANGUAGE.".php";
include_once((file_exists($lan_file) ? $lan_file : e_PLUGIN."my_gallery/languages/English.php"));

if(IsSet($_POST['updatesettings'])) {
    $name = $_POST['name'];
    $memo = $_POST['memo'];
    $gallery = $_POST['gallery'];

$memo_text = '<?php
$name = "'.$name.'";
$memo = "'.$memo.'";
?>';

    $filename = "$gallery/index.php";
    $fw = fopen ($filename, "wb");
    if ($fw) {
        fwrite($fw, $memo_text);
        //echo "Save OK! <br>";
        fclose($fws);
        }
      //echo "$gallery <br> $name <br> $memo ";
      header("location:".e_PLUGIN."my_gallery/my_gallery.php?gallery=$gallery");
      exit;
    }


if (getperms("P") and $_GET['gallery']) {

require_once(HEADERF);

if ($_GET['gallery']) $gallery = $_GET['gallery'];
if ($_GET['page']) $page = $_GET['page'];

if (file_exists("$gallery/index.php")) include_once("$gallery/index.php");

$text = "<!-- #### Memo Edit #### -->";
$text .= "<div class='memo_edit_msg'>".MYGAL_L034."<br>".$gallery."</div>";
$text .= "<form name='setings' action='memo_edit.php' method='post'>
<input type='hidden' name='gallery' value='$gallery'>
".MYGAL_L036."
<br><input class='tbox' type='text' name='name' size='60' value='$name' >
<br>".MYGAL_L037."
<br><textarea class='tbox' name='memo' rows='6' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);' style='width: 90%'>$memo</textarea>
<br>".display_help()."
<div align='center'><input class='button' type='submit' name='updatesettings' value='".MYGAL_L035."'></div>
</form>";

} else {
    $caption = "";
    $text = "Admin only!!!";
    }

// ========== Image Info Edit Script ================
if(IsSet($_POST['image_info_submit'])) {
    $comm_id = $_POST['comm_id'];
    $img_title = $_POST['img_title'];
    $img_text = $_POST['img_text'];
    $img_title = $tp->toDB($img_title);
    $img_text = $tp->toDB($img_text);

    $mydb->db_Update("my_gallery", "img_title='$img_title', img_description='$img_text' WHERE img_id='$comm_id'");

    header("location:".e_PLUGIN."my_gallery/comments.php?comm_id=$comm_id");
    exit;
}

if (getperms("P") && $_GET['comm_id']) {

$caption = "";

$comm_id = $_GET['comm_id'];

$mydb->db_Select("my_gallery", "*", "img_id = '".$comm_id."'");
    while($row = $mydb->db_Fetch()) {
        $img_id = $row['img_id'];
        $img = $row['img_name'];
        $img_title = $row['img_title'];
        $img_text = $row['img_description'];
        }

$CUSTOMHEADER = "

";

$CUSTOMFOOTER = "

";

$CUSTOMPAGES .= " memo_edit.php";

require_once(HEADERF);

$text = "
<form name='image_info_edit' action='memo_edit.php' method='post'>
<input type='hidden' name='comm_id' value='$comm_id'>
<input type='hidden' name='img' value='$img'>
".MYGAL_L036."
<br><input class='tbox' type='text' name='img_title' size='60' value='$img_title'>
<br>".MYGAL_L037."
<br><textarea class='tbox' name='img_text' rows='6' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);' style='width: 90%'>$img_text</textarea>
<br>".display_help()."
<div align='center'><input class='button' type='submit' name='image_info_submit' value='".MYGAL_L035."'></div>
</form>
";

}



$ns -> tablerender($caption, $text);
require_once(FOOTERF);

?>
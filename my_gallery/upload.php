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

if (!$pref['upload_enabled'] || $pref['upload_class'] == 255) {
	header("location: ".e_BASE."index.php");
	exit;
}

$lan_file = e_PLUGIN."my_gallery/languages/".e_LANGUAGE.".php";
include_once((file_exists($lan_file) ? $lan_file : e_PLUGIN."my_gallery/languages/English.php"));

require_once(HEADERF);

if (!defined("USER_WIDTH")){ define("USER_WIDTH","width:97%"); }

if (!check_class($pref['upload_class'])) {
	$text = "<div style='text-align:center'>".MYGAL_L060."</div>";
	$ns->tablerender(MYGAL_L061, $text);
	require_once(FOOTERF);
	exit;
}

if (isset($_POST['upload'])) {
	if (($_POST['file_email'] || USER == TRUE) && $_POST['file_name'] && $_POST['file_description'] && $_POST['gallery_sections']) {

    $image_url = "upload/";
    if ($_POST['gallery_sections']) $image_url = $_POST['gallery_sections'];

		require_once(e_HANDLER."upload_handler.php");
		$uploaded = file_upload(e_PLUGIN."my_gallery/".$image_url, "unique");

		$file = $uploaded[0]['name'];
		$filetype = $uploaded[0]['type'];
		$filesize = $uploaded[0]['size'];

		if (!$pref['upload_maxfilesize']) {
			$pref['upload_maxfilesize'] = ini_get('upload_max_filesize') * 1048576;
		}


		if ($filesize > $pref['upload_maxfilesize']) {
			$message = MYGAL_L064;
		} else {
			if (is_array($uploaded)) {
				$poster = (USER ? USERID.".".USERNAME : "0.".$_POST['file_poster'].".".$_POST['file_email']);
				$_POST['file_email'] = ($_POST['file_email'] ? $_POST['file_email'] : USEREMAIL);
				$_POST['file_description'] = $tp->toDB($_POST['file_description']);
				$file_time = time();

			   	$sql_text = array(
                "img_name" =>           $tp -> toDB($image_url."".$file),
                "img_title" =>          $tp -> toDB($_POST['file_name']),
                "img_description" =>    $tp -> toDB($_POST['file_description']),
                "img_user" =>           $tp -> toDB($poster),
                "img_status" =>         'upload'
                );

                $sql->db_Insert("my_gallery", $sql_text);

				$message .= "<br />".MYGAL_L059;
			}
		}

	} else {
		require_once(e_HANDLER."message_handler.php");
		message_handler("ALERT", 5);
	}
}

if (isset($message)) {

	$ns->tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
//	require_once(FOOTERF);
//	exit;
}

$text = "<div style='text-align:center'>
	<form enctype='multipart/form-data' method='post' action='".e_SELF."'>
	<table style='".USER_WIDTH."' class='fborder'>
	<tr>
	<td style='width:20%' class='forumheader3'><span style='text-decoration:underline'>".MYGAL_L046."</span></td>
	<td style='width:80%' class='forumheader3'>";

//========= Select folders list ==================
$folder = $pref['mygallery_folder'];
$text .= "
    <select name='gallery_sections' class='tbox'>
    <option value=''>&nbsp;</option>";

if ($handle = opendir($folder))
{
  while (false !== ($folder_a = readdir($handle)))
  {
   if ($folder_a != "." && $folder_a != ".." && $folder_a != "index.php")  { $nav_a[] = $folder_a; }
  }
closedir($handle);
}
sort($nav_a);
foreach ($nav_a as $folder_a)
        {
        $text .= "<optgroup label='".$folder_a."'>";
        $nav_b = "";
        if ($handle = opendir("$folder/$folder_a"))
            {
            while (false !== ($folder_b = readdir($handle)))
                {
                 if ($folder_b != "." && $folder_b != ".." && $folder_b != "index.php")  { $nav_b[]= $folder_b; }
                }
            closedir($handle);
            }
        sort($nav_b);
        //$text_nav .= "<div class='mygall_folder_b'>";
        foreach ($nav_b as $folder_b)
                {
                $text .= "<option value='".$folder."/".$folder_a."/".$folder_b."/'>".$folder_b."</option>";
                }
        $text_nav .= "</optgroup>";
        }
$text .= "</select></td></tr>";

if (!USER) {
	$text .= "<tr>
		<td style='width:30%' class='forumheader3'>".MYGAL_L062.":</td>
		<td style='width:70%' class='forumheader3'><input class='tbox' style='width:90%' name='file_poster' type='text' size='50' maxlength='100' /></td>
		</tr>

		<tr>
		<td style='width:30%' class='forumheader3'><span style='text-decoration:underline'>".MYGAL_L063.":</span></td>
		<td style='width:70%' class='forumheader3'><input class='tbox' style='width:90%' name='file_email' type='text' size='50' maxlength='100' value='".USEREMAIL."' /></td>
		</tr>";
}

$text .= "
	<tr>
	<td style='width:30%' class='forumheader3'><span style='text-decoration:underline'>".MYGAL_L036.":</span></td>
	<td style='width:70%' class='forumheader3'><input class='tbox' style='width:90%'  name='file_name' type='text' size='50' maxlength='100' /></td>
	</tr>

	<tr>
	<td style='width:30%' class='forumheader3'><span style='text-decoration:underline'>".MYGAL_L037.":</span></td>
	<td style='width:70%' class='forumheader3'><textarea class='tbox' style='width:90%' name='file_description' cols='59' rows='6'></textarea></td>
	</tr>

	<tr>
	<td style='width:30%' class='forumheader3'><span style='text-decoration:underline'>".MYGAL_L027."</span></td>
	<td style='width:70%' class='forumheader3'><input class='tbox' style='width:90%'  name='file_userfile[]' type='file' size='47' /></td>
	</tr>

	<tr>
	<td style='text-align:center' colspan='2' class='forumheader'><input class='button' type='submit' name='upload' value='".MYGAL_L035."' /></td>
	</tr>
	</table>
	</form>
	</div>";

$ns->tablerender(MYGAL_L058, $text);

require_once(FOOTERF);
?>

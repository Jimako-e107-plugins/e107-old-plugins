<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/admin_prefs.php
|
| Revision: 0.9.6.5
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

   require_once("myfuncs.php");
   require_once ("functions.php");
   function admin_prefs_adminmenu() {
      show_menu("Prefs");
   }

if(e_QUERY == "u") {
	$ns->tablerender("", "<div style='text-align:center'><b>".image_gallery_CONFIG_L3."</b></div>");
} //po langa

if (isset($_POST['updateprefs']))
{
	unset($_POST['updateprefs']);

	foreach($_POST as $key => $value)
	{
		$pref[$key] = $tp->toDB($value);
	}

	$e107cache->clear();
	save_prefs();
	$sql -> db_Select_gen("TRUNCATE ".MPREFIX."online");
    header("location:".e_PLUGIN."image_gallery/admin_prefs.php?u");
	exit;
}

//global $conn;

/*$conn = @mysql_connect($mySQLserver,$mySQLuser,$mySQLpassword);
if ($conn==FALSE) {
      die("<BR>ERROR: cannot connect to database<BR>" );
  }

$query = "SELECT userclass_id, userclass_name FROM ".MPREFIX."userclass_classes";
$result = mysql_query($query, $conn) or die('Delete image failed. ' . mysql_error());
*/
/*
$classlist = '';
$classlist .= '<option value="">'.image_gallery_CONFIG_Lnone.'</option>';

while ($row = mysql_fetch_assoc($result)) {
        $classid = $row['userclass_id'];
        $classname = $row['userclass_name'];
        if ($classid == $pref['img_userclass'])
            {$classlist .='<option value="' . $classid . '" selected';}
          else{$classlist .='<option value="' . $classid . '"';}
        $classlist .='>' . $classname . '</option>';
} */
$classlist2 = r_userclass("img_userclass", $pref['img_userclass'], "off", "main,admin,classes,matchclass,member,nobody");

$text .= "<div style='text-align:center'>";
if ($gdv = gdVersion()) {
     if ($gdv >=2) {
         $text .=  '<font color="#00CC00">TrueColor functions may be used.</font>';
     } else {
         $text .=  '<font color="#FF9900">GD version is 1. Avoid the TrueColor functions. You need GD 2 library</font>';
     }
   } else {
       $text .=  '<font color="red">The GD extension isn\'t loaded. You need GD 2 library</font>';
   }
//add to see if working directories are chmoded correct.

$filename = $pref['img_GALLERY_IMG_DIR'];
if (is_writable($filename)) {
        $text .= '<br /><font color="#00CC00">Gallery dir has right permitions.</font>';
} else {
        $text .= '<br /><font color="red">Gallery dir is not writable!</font>';
}

$filename2 = $pref['img_ALBUM_IMG_DIR'];
if (is_writable($filename2)) {
        $text .= '<br /><font color="#00CC00">Album dir has right permitions.</font>';
} else {
        $text .= '<br /><font color="red">Album dir is not writable!</font>';
}

$filename3 = $pref['img_GALLERY_IMG_DIR'].'thumbnail/';
if (is_writable($filename3)) {
        $text .= '<br /><font color="#00CC00">Thumbnail dir has right permitions.</font>';
} else {
        $text .= '<br /><font color="red">Thumbnail dir is not writable!</font>';
}
// END add to see if working directories are chmoded correct.
 
$text .= "</div>";

$text .= "<div style='text-align:center'>
	<div style='text-align:center; ".ADMIN_WIDTH."; margin-left: auto; margin-right: auto'>
    <form method='post' action='".e_SELF."' name='prefs'>
<center><table class='fborder' style='".ADMIN_WIDTH."'>
<tr><td class='forumheader2'>".image_gallery_CONFIG_L32.":</td><td class='forumheader3'> ";
/*
$text .= "<select name=\"img_userclass\" class='tbox' id=\"img_userclass\">
        <option value=\"\">-- ".image_gallery_CONFIG_L33." --</option>
        ".$classlist."
    </select>";
*/
$text .= $classlist2;
$text .= "</td></tr><tr>
<td class='forumheader2'>".image_gallery_CONFIG_L34.":
</td>
<td class='forumheader3'>
<input type='text' class='tbox' size='3' name='img_THUMBNAIL_WIDTH' value='".$pref['img_THUMBNAIL_WIDTH']."' />
</td>
</tr>
<tr>
<td class='forumheader2'>".image_gallery_CONFIG_L66.":
</td>
<td class='forumheader3'>
<input type='text' class='tbox' size='3' name='img_MAXIMG_WIDTH' value='".$pref['img_MAXIMG_WIDTH']."' />
</td>
</tr>
<tr>
<td class='forumheader2'>".image_gallery_CONFIG_L67.":
</td>
<td class='forumheader3'>
<input type='text' class='tbox' size='3' name='img_MAXIMG_HIGHT' value='".$pref['img_MAXIMG_HIGHT']."' />
</td>
</tr>
<tr>
<td class='forumheader2'>".image_gallery_CONFIG_L36.":
</td>
<td class='forumheader3'>
<input type='text' size='90' class='tbox' maxlength='500' name='img_ALBUM_IMG_DIR' value=\"".$pref['img_ALBUM_IMG_DIR']."\" />
</td>
</tr>
<tr>
<td class='forumheader2'>".image_gallery_CONFIG_L35.":
</td>
<td class='forumheader3'>
<input type='text' size='90' class='tbox' maxlength='500' name='img_GALLERY_IMG_DIR' value=\"".$pref['img_GALLERY_IMG_DIR']."\" />
</td>
</tr>
<tr>
<td class='forumheader2'>".image_gallery_CONFIG_L37.":
</td>
<td class='forumheader3'>
<input type='text' size='2' class='tbox' maxlength='20' name='img_albumPerPage' value='".$pref['img_albumPerPage']."' />
</td>
</tr>
<tr>
<td class='forumheader2'>".image_gallery_CONFIG_L38.":
</td>
<td class='forumheader3'>
<input type='text' size='2' class='tbox' maxlength='20' name='img_imagePerPage' value='".$pref['img_imagePerPage']."' />
</td>
</tr>
<tr>
<td class='forumheader2'>".image_gallery_CONFIG_L39.":
</td>
<td class='forumheader3'>
<input type='text' class='tbox' size='2' maxlength='100' name='img_colsPerRow' value='".$pref['img_colsPerRow']."' />
</td>
</tr>
<tr>
<td class='forumheader2'>".image_gallery_CONFIG_L68.":
</td>
<td class='forumheader3'>
<input type='text' class='tbox' size='2' maxlength='100' name='img_commentsPerPage' value='".$pref['img_commentsPerPage']."' />
</td>
</tr>
<tr>
<td class='forumheader2'>".image_gallery_CONFIG_L71.":
</td>
<td class='forumheader3'>
<select name='img_enablecomments' size='1'>";
if ($pref['img_enablecomments'])
{
    $text .="<option value='1' selected='selected'>Yes</option>
    <option value='0'>No</option>
    </select>";
}else{
    $text .="<option value='1'>Yes</option>
    <option value='0' selected='selected'>No</option>
    </select>";
}

$text .="
</td>
</tr>

";
   /*$text .= "<tr><td class='fcaption'></td><td class='fcaption'>
        <br>DOCUMENT_ROOT:".$_SERVER["DOCUMENT_ROOT"]."<br>
        <br>SCRIPT_FILENAME:".$_SERVER["SCRIPT_FILENAME"]."<br>
        <br>ORIG_SCRIPT_FILENAME:".$_SERVER["ORIG_SCRIPT_FILENAME"]."<br>
        <br>PATH_TRANSLATED:".$_SERVER["PATH_TRANSLATED"]."<br>
        <br>REQUEST_URI:".$_SERVER["REQUEST_URI"]."<br>
        <br>PHP_SELF:".$_SERVER["PHP_SELF"]."<br>
   </td></tr>";*/

   $text .= pref_submit();
   $text .= "</table></div>";
   $text .= "</form></div></div>";

   $ns->tablerender(image_gallery_CONFIG_L1, $text);

   /*mysql_close ($conn);*/
   require_once(e_ADMIN."footer.php");

   function pref_submit() {
	$text = "<tr>
		<td colspan='2' style='text-align:center' class='forumheader'>";
	$text .= "<input class='button' type='submit' name='updateprefs' value='".image_gallery_CONFIG_L2."' />";
	$text .= "</td>
		</tr></center>";    //po langa
	return $text;
}

function gdVersion($user_ver = 0)
{
   if (! extension_loaded('gd')) { return; }
   static $gd_ver = 0;
   // Just accept the specified setting if it's 1.
   if ($user_ver == 1) { $gd_ver = 1; return 1; }
   // Use the static variable if function was called previously.
   if ($user_ver !=2 && $gd_ver > 0 ) { return $gd_ver; }
   // Use the gd_info() function if possible.
   if (function_exists('gd_info')) {
       $ver_info = gd_info();
       preg_match('/\d/', $ver_info['GD Version'], $match);
       $gd_ver = $match[0];
       return $match[0];
   }
   // If phpinfo() is disabled use a specified / fail-safe choice...
   if (preg_match('/phpinfo/', ini_get('disable_functions'))) {
       if ($user_ver == 2) {
           $gd_ver = 2;
           return 2;
       } else {
           $gd_ver = 1;
           return 1;
       }
   }
   // ...otherwise use phpinfo().
   ob_start();
   phpinfo(8);
   $info = ob_get_contents();
   ob_end_clean();
   $info = stristr($info, 'gd version');
   preg_match('/\d/', $info, $match);
   $gd_ver = $match[0];
   return $match[0];
} // End gdVersion()

?>
<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     �Steve Dunstan 2001-2002
|     http://e107.org
|     jalist@e107.org
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $Source: /cvsroot/e107/e107_0.7/e107_admin/filemanager.php,v $
|     $Revision: 1.23 $
|     $Date: 2008/04/01 20:06:33 $
|     $Author: e107steved $
+----------------------------------------------------------------------------+
*/
require_once("../../class2.php");

   if (!getperms("6")) {
      header("location:".e_HTTP."index.php");
      exit;
   }

   include_lan(e_LANGUAGEDIR.e_LANGUAGE.'/admin/lan_admin.php');
   include_lan(e_LANGUAGEDIR.e_LANGUAGE.'/admin/lan_filemanager.php');
   include_lan(e_PLUGIN.'forumthanks/languages/'.e_LANGUAGE.'/lan_thanks.php');
   include_lan(e_PLUGIN.'forumthanks/languages/'.e_LANGUAGE.'/lan_admin_thanks.php');
   
    $e_sub_cat = 'filemanager';
   
    require_once(e_ADMIN."auth.php");
   
   

$imagedir = e_IMAGE."filemanager/";

	$dir_options[0] = LAN_TFM3;
	$dir_options[1] = LAN_TFM1;
	$dir_options[2] = LAN_TFM2;


	$adchoice[0] = e_PLUGIN."forumthanks/user_images/";
	$adchoice[1] = e_PLUGIN."forumthanks/user_images/thank/";
	$adchoice[2] = e_PLUGIN."forumthanks/user_images/loading/";
	


$path = str_replace("../", "", e_QUERY);

if($path == "plugins/forumthanks/user_images/loading/" || $path == "plugins/forumthanks/user_images/thank/" || $path == "plugins/forumthanks/user_images/"){$path = $path;}
else {$path = "plugins/forumthanks/user_images/";}

if (!$path) {
	$path = str_replace("../", "", $adchoice[0]);
}

$ok = (e_QUERY == '' || '../../'.substr(e_QUERY, 0, strlen(e_PLUGIN)-6) == e_PLUGIN);

if($path == "/" || !$ok)
{
	$path = $adchoice[0];
	echo "<b>Debug</b> ".$path." <br />";
}


// ===============================================

if (isset($_POST['deleteconfirm'])) 
{
  foreach($_POST['deleteconfirm'] as $key=>$delfile)
  {
	// check for delete.
	if (isset($_POST['selectedfile'][$key]) && isset($_POST['deletefiles'])) {
		if (!$_POST['ac'] == md5(ADMINPWCHANGE)) {
			exit;
		}
		$destination_file = e_BASE.$delfile;
		if (@unlink($destination_file)) {
			$message .= FMLAN_26." '".$destination_file."' ".FMLAN_27.".<br />";
		} else {
			$message .= FMLAN_28." '".$destination_file."'.<br />";
		}
	}

	// check for move to downloads or downloadimages.
	if (isset($_POST['selectedfile'][$key]) && (isset($_POST['movetodls'])) ){
	$newfile = str_replace($path,"",$delfile);

	// Move file to whatever folder.
		if (isset($_POST['movetodls'])){

			$newpath = $_POST['movepath'];

			if (rename(e_BASE.$delfile,$newpath.$newfile)){
				$message .= FMLAN_38." ".$newpath.$newfile."<br />";
			} else {
				$message .= FMLAN_39." ".$newpath.$newfile."<br />";
				$message .= (!is_writable($newpath)) ? $newpath.LAN_NOTWRITABLE : "";
			}
		}
	}
  }
}



if (isset($_POST['upload'])) {
	if (!$_POST['ac'] == md5(ADMINPWCHANGE)) {
		exit;
	}
	$pref['upload_storagetype'] = "1";
	require_once(e_HANDLER."upload_handler.php");
	$files = $_FILES['file_userfile'];
	foreach($files['name'] as $key => $name) {
		if ($files['size'][$key]) {
			$uploaded = file_upload(e_BASE.$_POST['upload_dir'][$key]);
		}
	}
}

if (isset($message)) {
	$ns->tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
}

if (strpos(e_QUERY, ".") && !is_dir(realpath(e_BASE.$path))){
	echo "<iframe style=\"width:100%\" src=\"".e_BASE.e_QUERY."\" height=\"300\" scrolling=\"yes\"></iframe><br /><br />";
	if (!strpos(e_QUERY, "/")) {
		$path = "";
	} else {
		$path = substr($path, 0, strrpos(substr($path, 0, -1), "/"))."/";
	}
}

$files = array();
$dirs = array();
$path = explode("?", $path);
$path = $path[0];
$path = explode(".. ", $path);
$path = $path[0];

if ($handle = opendir(e_BASE.$path)) {
	while (false !== ($file = readdir($handle))) {
		if ($file != "." && $file != "..") {

			if (getenv('windir') && is_file(e_BASE.$path."\\".$file)) {
				if (is_file(e_BASE.$path."\\".$file)) {
					$files[] = $file;
				} else {
					$dirs[] = $file;
				}
			} else {
				if (is_file(e_BASE.$path."/".$file)) {
					$files[] = $file;
				} else {
					$dirs[] = $file;
				}
			}
		}
	}
}
closedir($handle);

if (count($files) != 0) {
	sort($files);
}
if (count($dirs) != 0) {
	sort($dirs);
}

if (count($files) == 1) {
	$cstr = FMLAN_12;
} else {
	$cstr = FMLAN_13;
}

if (count($dirs) == 1) {
	$dstr = FMLAN_14;
} else {
	$dstr = FMLAN_15;
}

$pathd = $path;

$text = "<div style='text-align:center'>\n
	<form method='post' action='".e_SELF."?".e_QUERY."'>\n
	<table style='".ADMIN_WIDTH."' class='fborder'>\n
	<tr>\n\n

	<td style='width:70%' class='forumheader3'>\n
	".FMLAN_32."
	</td>\n
	<td class='forumheader3' style='text-align:center; width:30%'>\n";


	foreach($dir_options as $key=>$opt){
		$select = (str_replace("../","",$adchoice[$key]) == e_QUERY) ? "selected='selected'" : "";
		$text .= "<a href =".'"'.e_SELF."?".str_replace("../","",$adchoice[$key]).'"><b>'.LAN_TFM4." ".$opt."</b></a><br><br>";
	}

$text .= "
	</td>\n
	</tr>\n\n

	<tr style='vertical-align:top'>\n
	<td colspan='2'  style='text-align:center' class='forumheader'>\n
	</td>\n
	</tr>\n\n

	</table>\n
	</form>\n
	</div>";
$ns->tablerender(FMLAN_34, $text);


$text = "<form enctype=\"multipart/form-data\" action=\"".e_SELF.(e_QUERY ? "?".e_QUERY : "")."\" method=\"post\">
	<div style=\"text-align:center\">
	<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"1000000\" />
	<table class='fborder' style=\"".ADMIN_WIDTH."\">";

$text .= "<tr>
	<td style=\"width:5%\" class=\"fcaption\">&nbsp;</td>
	<td style=\"width:30%\" class=\"fcaption\"><b>".FMLAN_17."</b></td>
	<td class=\"fcaption\"><b>".FMLAN_18."</b></td>
	<td style=\"width:30%\" class=\"fcaption\"><b>".FMLAN_19."</b></td>
	<td class=\"fcaption\"><b>".LAN_OPTIONS."</b></td>
	</tr>";

if ($path != e_FILE) {
	if (substr_count($path, "/") == 1) {
		$pathup = e_SELF;
	} else {
		$pathup = e_SELF."?".substr($path, 0, strrpos(substr($path, 0, -1), "/"))."/";
	}
	$text .= "<tr><td colspan=\"5\" class=\"forumheader3\"><a href=\"".$pathup."\"><img src=\"".$imagedir."updir.png\" alt=\"".FMLAN_30."\" style=\"border:0\" /></a> 
		<a href=\"filemanager.php\"><img src=\"".$imagedir."home.png\" alt=\"".FMLAN_16."\" style=\"border:0\" /></a>
		</td>
		</tr>";
}

$c = 0;
while ($dirs[$c]) {
	$dirsize = dirsize($path.$dirs[$c]);
	$text .= "<tr>
		<td class=\"forumheader3\" style=\"vertical-align:middle; text-align:center; width:5%\">
		<a href=\"".e_SELF."?".$path.$dirs[$c]."/\"><img src=\"".$imagedir."folder.png\" alt=\"".$dirs[$c]." ".FMLAN_31."\" style=\"border:0\" /></a>
		</td>
		<td style=\"width:30%\" class=\"forumheader3\">
		<a href=\"".e_SELF."?".$path.$dirs[$c]."/\">".$dirs[$c]."</a>
		</td>
		<td class=\"forumheader3\">".$dirsize."
		</td>
		<td class=\"forumheader3\">&nbsp;</td>
		<td class=\"forumheader3\">";
	if (FILE_UPLOADS && is_writable(e_BASE.$path.$dirs[$c])) {
		$text .= "<input class=\"button\" type=\"button\" name=\"erquest\" value=\"".FMLAN_21."\" onclick=\"expandit(this)\" />
			<div style=\"display:none;\">
			<input class=\"tbox\" type=\"file\" name=\"file_userfile[]\" size=\"50\" />
			<input class=\"button\" type=\"submit\" name=\"upload\" value=\"".FMLAN_22."\" />
			<input type=\"hidden\" name=\"upload_dir[]\" value=\"".$path.$dirs[$c]."\" />
			</div>";
	} else {
		$text .= "&nbsp;";
	}
	$text .= "</td>
		</tr>


		";
	$c++;
}

$c = 0;
while ($files[$c]) {
	$img = substr(strrchr($files[$c], "."), 1, 3);
	if (!$img || !preg_match("/css|exe|gif|htm|jpg|js|php|png|txt|xml|zip/i", $img)) {
		$img = "def";
	}
	$size = parsesize(filesize(e_BASE.$path."/".$files[$c]));
	$text .= "<tr>
		<td class=\"forumheader3\" style=\"vertical-align:middle; text-align:center; width:5%\">
		<img src=\"".$imagedir.$img.".png\" alt=\"".$files[$c]."\" style=\"border:0\" />
		</td>
		<td style=\"width:30%\" class=\"forumheader3\">
		<a href=\"".e_SELF."?".$path.$files[$c]."\">".$files[$c]."</a>
		</td>";
	$gen = new convert;
	$filedate = $gen -> convert_date(filemtime(e_BASE.$path."/".$files[$c]), "forum");
	$text .= "<td style=\"width:10%\" class=\"forumheader3\">".$size."</td>
		<td style=\"width:30%\" class=\"forumheader3\">".$filedate."</td>
		<td class=\"forumheader3\">";

	$text .= "<input  type=\"checkbox\" name=\"selectedfile[$c]\" value=\"1\" />";
	$text .="<input type=\"hidden\" name=\"deleteconfirm[$c]\" value=\"".$path.$files[$c]."\" />";

	$text .="</td>
		</tr>";
	$c++;
}

	$text .= "<tr><td colspan='5' class='forumheader' style='text-align:right'>";

	$text .= "<input class=\"button\" type=\"submit\" name=\"deletefiles\" value=\"".FMLAN_43."\" onclick=\"return jsconfirm('".$tp->toJS(FMLAN_46)."') \" />
		</td></tr></table>
		<input type='hidden' name='ac' value='".md5(ADMINPWCHANGE)."' />
		</div>
		</form>";

$ns->tablerender(FMLAN_29.": <b>root/".$pathd."</b>&nbsp;&nbsp;[ ".count($dirs)." ".$dstr.", ".count($files)." ".$cstr." ]", $text);

function dirsize($dir) {
	$_SERVER["DOCUMENT_ROOT"].e_HTTP.$dir;
	$dh = @opendir($_SERVER["DOCUMENT_ROOT"].e_HTTP.$dir);
	$size = 0;
	while ($file = @readdir($dh)) {
		if ($file != "." and $file != "..") {
			$path = $dir."/".$file;
			if (is_file($_SERVER["DOCUMENT_ROOT"].e_HTTP.$path)) {
				$size += filesize($_SERVER["DOCUMENT_ROOT"].e_HTTP.$path);
			} else {
				$size += dirsize($path."/");
			}
		}
	}
	@closedir($dh);
	return parsesize($size);
}

function parsesize($size) {
	$kb = 1024;
	$mb = 1024 * $kb;
	$gb = 1024 * $mb;
	$tb = 1024 * $gb;
	if ($size < $kb) {
		return $size." b";
	}
	else if($size < $mb) {
		return round($size/$kb, 2)." kb";
	}
	else if($size < $gb) {
		return round($size/$mb, 2)." mb";
	}
	else if($size < $tb) {
		return round($size/$gb, 2)." gb";
	} else {
		return round($size/$tb, 2)." tb";
	}
}

require_once(e_ADMIN."footer.php");
?>
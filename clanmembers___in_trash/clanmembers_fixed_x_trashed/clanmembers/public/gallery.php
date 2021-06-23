<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Members 1.0                                           |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!defined('CM_PUB') && $conf['enablegallery']) {
    die ("Access Denied");
}

$userid = 0;
$memberid = intval($_GET['memberid']);
if($memberid > 0 && ADMIN){
	$userid = $memberid;
	$uplurl = "&memberid=$userid";
	$delreturn = "clanmembers.php?deleteimage&memberid=$userid";
	$title = _MANGALLOF.cm_getuser_name($userid);
}else{
	$userid = USERID;
	$uplurl = "";
	$delreturn = "clanmembers.php?deleteimage";
	$title = _MANURGALL;
}

if(!is_clanmember($userid)){
	header("Location: clanmembers.php");
	die();
}

?>
<script type="text/javascript">
function DelImage(id){
	var sure = confirm("<?php echo _SUREDELIMG;?>");
	if(sure){
		document.location = "<?php echo $delreturn;?>&id="+id
	}
}
</script>
<?php
			
$text = "<a href='clanmembers.php?profile&memberid=$userid'>"._RETURNTOPROFILE."</a><br /><br />";
$sql->db_Select("clan_members_gallery", "*", "userid='$userid'");
$images = $sql->db_Rows();
if($images < $conf['maximages'] or $conf['maximages'] == 0){
	$text .= "<form method='post' action='clanmembers.php?upload".$uplurl."' enctype=\"multipart/form-data\">";
	$text .= "<input type='file' name='newimage'><input type='submit' class='button' value='"._UPLOAD."'>
	<input type='hidden' name='e-token' value='".e_TOKEN."' />
	</form><br />";
}else{
	$text .= "<b>"._MAX." ".$conf['maximages']." "._IMGSALLOWED."</b><br /><br />";
}
	while($row = $sql->db_Fetch()){
		$id = $row['id'];
		$url = "images/Gallery/".$row['url'];
		$width = "";
		if($url !="" && file_exists($url)){
			$size = getimagesize($url);
			if($size[0] > $conf['thumbwidth']){
				$width = "width='".$conf['thumbwidth']."'";
			}
		}
		$text .= "<div style='display:inline-block;text-align:center;'><img src='$url' $width><br /><a href='javascript:DelImage($id);'>"._DEL."</a><br />&nbsp;</div>&nbsp;";		
	}

$ns->tablerender($title, $text);
?>
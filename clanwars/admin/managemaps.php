<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Wars 1.0                                              |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!defined('WARS_ADMIN') or !preg_match("/admin\.php\?ManageMaps/i", $_SERVER['REQUEST_URI'])) {
    die ("You can't access this file directly...");
}
?>
<link rel="stylesheet" href="includes/maps.css" />
<script type="text/javascript">
var suredelmap = "<?php echo _SUREDELMAPDELALLWARS;?>";
var errordelmap = "<?php echo _WERRORDELMAP;?>";
</script>
<script type="text/javascript" src="includes/maps.js"></script>

<?php
$gid = intval($_GET['gid']);

	$text = "<div class='nowrap'>
			<table border='0' cellspacing='0' cellpadding='2'>
				<tr>
					<td width='100'><b>"._IMAGE."</b></td>
					<td width='98'><b>"._WMAPNAME."</b></td>
					<td width='118'>&nbsp;</td>
				</tr>
			</table>
		</div>
		<div id='mapsdiv'>";

	$result = $sql->db_Select("clan_wars_maps", "*", "gid='$gid' order by name ASC");
		while ($row = $sql->db_Fetch()) {
			
			$mid = intval($row['mid']);
			$name = $row['name'];
			$image = $row['image'];
			
			$mapimage = "&nbsp;";
			if(file_exists("images/Maps/$image") && $image){
				$mapimage = "<img src='images/Maps/$image' width='100' />";
			}

			$text .= "<div class='mainwrap forumheader3' id='map$mid'>
					<table border='0' cellspacing='0' cellpadding='2'>
						<tr>
							<td width='100'>$mapimage</td>
							<td width='98'>$name</td>
							<td width='118' style='text-align:right;' nowrap><input type='button' class='iconpointer button' value='"._WEDIT."' onclick=\"window.location='admin.php?EditMap&mid=$mid&gid=$gid'\">&nbsp;<input type='button' class='iconpointer button' value='"._WDEL."' onclick='delData($mid);'></td>
						</tr>
					</table>
				</div>";
		}
		$text .= "</div>
				<div class='nowrap'>
				<form action='admin.php?AddMap&gid=$gid' method='post' enctype='multipart/form-data'>
					<table border='0' cellspacing='0' cellpadding='2'>
						<tr>
							<td width='100'><input type='file' name='mapimage' style='width:90px;margin:0;'></td>
							<td width='98'><input type='text' name='mapname' style='width:90px;margin:0;'></td>
							<td width='118' style='text-align:right;' nowrap><input type='submit' class='iconpointer button' value='Add Map'></td>
						</tr>
					</table>
				<input type='hidden' name='e-token' value='".e_TOKEN."' />
				</form>
				</div>";
		$ns->tablerender(_MANMAPS, "<center>".$text."</center>");
?>
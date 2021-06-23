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

if (!defined('CM_ADMIN')) {
	die ("Access Denied");
}

$rid = intval($_GET['rid']);

	?>
	<script type="text/javascript">
	function CheckForm(){
		if(document.getElementById('awardtitle').value !=""){
			return true;
		}else{
			alert("<?php echo _FILLINTITLE;?>");
			return false;
		}
	}	
	</script>	
	<?php
	
$sql->db_Select("clan_members_awards", "*", "rid='$rid'");
$row = $sql->db_Fetch();
	$title = $row['title'];
	$description = $row['description'];		
	$image = $row['image'];		
					
echo"<center><table><tr><td align='left'>";
echo "<center><font class='title'><b>"._EDITAWARD."</b></font><br><br></center>";

echo "<form action='admin.php?saveaward' method='post' enctype='multipart/form-data' onSubmit='return CheckForm();'>
	<table border='0' cellpadding='0' cellspacing='2'>
		<tr>
			<td align='left'>"._TITLE.": </td>
			<td align='left'><input type='text' id='awardtitle' name='awardtitle' value='$title' size='25' maxlength='40'></td>
		</tr>
		<tr>
			<td align='left'>"._DESCR.": </td>
			<td align='left'><textarea name='awarddescription' cols='25' rows='6'>$description</textarea></td>
		</tr>
		<tr>
			<td align='left'>"._NEWIMG.": </td>
			<td align='left'><input type='file' name='awardimage' size='15' ></td>
		</tr>
		<tr>
			<td align='left' colspan='2'><font style='font-size:9px;'>"._LEAVEEMPTYNOTCHANGE."</font></td>
		</tr>
		
	</table>
	<br />
	<input type='hidden' name='rid' value='".$rid."' />
	<input type='hidden' name='e-token' value='".e_TOKEN."' />
	<input type='submit' name='submit' value='"._SAVECHANGES."'> 
	</form>";
echo"</td></tr></table></center>";
	

?>
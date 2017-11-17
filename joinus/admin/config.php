<?php
/*
+ -----------------------------------------------------------------+
| e107: Join Us 1.0                                                |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/
if (!defined('JOIN_ADMIN') or !preg_match("/admin.php\?Config/i", $_SERVER['REQUEST_URI'])) {
    die ("Access denied.");
}

?>
<link rel="stylesheet" href="includes/jquery.autocomplete.css" />
<style type="text/css">
.warstitle{
	font-size:1.1em;
	font-weight: bold;
}
#configtable td{
	padding: 1px;
}
</style>

<?php
	$text =  "<center>
	<table align='center'><tr><td>		
	
	<form method='post' action='admin.php?SaveConfig'>
	<table cellspacing='1' cellpadding='3' border='0' width='300' id='configtable'>
	<tr>
		<td align='left' nowrap>"._MAILTO.": </td>
		<td align='left'><input type='text' name='mailto' value='".$conf['mailto']."' size='20' /></td>
	</tr>
	<tr>
		<td align='left' nowrap>"._SENDMAIL.": </td>
		<td align='left'><label><input type='radio' name='sendmail' value='1' ".(($conf['sendmail'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='sendmail' value='0' ".(($conf['sendmail'])?"":"checked").">"._NO."</label></td>
	</tr>
	<tr>
		<td align='left' nowrap>"._MUSTREGISTER.": </td>
		<td align='left'><label><input type='radio' name='mustregister' value='1' ".(($conf['mustregister'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='mustregister' value='0' ".(($conf['mustregister'])?"":"checked").">"._NO."</label></td>
	</tr>";
	if (isset($pref['plug_installed']['clanmembers'])){
		$text .= "<tr>
			<td align='left' nowrap>"._LINKWITHMEMBERS.": </td>
			<td align='left'><label><input type='radio' name='linkmembers' value='1' ".(($conf['linkmembers'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='linkmembers' value='0' ".(($conf['linkmembers'])?"":"checked").">"._NO."</label></td>
		</tr>";
	}
	$text .= "<tr>
			<td align='left' nowrap>"._POSTFORUMTHREAD.": </td>
			<td align='left'><label><input type='radio' name='postthread' value='1' ".(($conf['postthread'])?"checked":"").">"._YES."</label>&nbsp;&nbsp;<label><input type='radio' name='postthread' value='0' ".(($conf['postthread'])?"":"checked").">"._NO."</label></td>
		</tr>
		<tr>
			<td align='left' nowrap>"._POSTIN.": </td>
			<td align='left'><select name='postin'>";
			$sql1 = new db;
			$sql->db_Select("forum", "*", "forum_parent!=0 and forum_sub=0");
				while($row = $sql->db_Fetch()){
					$text .= "<option value='".$row['forum_id']."'".($row['forum_id']==$conf['postin']?" selected":"").">".$row['forum_name']."</option>";
					$sql1->db_Select("forum", "*", "forum_sub=".$row['forum_id']);
					while($row2 = $sql1->db_Fetch()){
						$text .= "<option value='".$row2['forum_id']."'".($row2['forum_id']==$conf['postin']?" selected":"").">&nbsp;&nbsp;-&nbsp;".$row2['forum_name']."&nbsp;</option>";
					}
				}
			$text .= "</select></td>
		</tr>
		<tr>
		<td align='left' nowrap>"._THREADTITLE.": </td>
		<td align='left'><input type='text' name='threadtitle' value='".$conf['threadtitle']."' size='20' /></td>
	</tr>
		<tr>
			<td align='left' colspan='2'>"._JOINTEXT.": </td>
		</tr>
		<tr>
			<td align='left' colspan='2'><textarea name='jointext' style='width:100%;height:80px;'>".$conf['jointext']."</textarea></td>
		</tr>
	</table>	
	
	</td></tr>
	
	<tr><td>		
		
	<br /><br /><input type='submit' class='button' value='"._SAVECHANGES."'>
	<input type='hidden' name='e-token' value='".e_TOKEN."' />
  </form>
  
  </td></tr></table></center>";
  
  $ns->tablerender(_CONFIG, $text);
	  
?>
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
	?>
    <style type="text/css">
	#memberstable td{
		vertical-align:middle;
		text-align:center;
	}
	</style>
    <script type="text/javascript">
	function DelMember(memberid, member){
		var sure = confirm("<?php echo _SUREDELMEMBER;?>"+member+"?");
		if(sure){
			top.cmupdate.document.location = "admin_old.php?delmember&memberid="+memberid;
			document.getElementById("member"+memberid).style.display = "none";
		}
	}
	</script>
    <?php
				
	//List Members			

	$text .="<table style='".ADMIN_WIDTH."' class='fborder' id='memberstable'>
	<tr>
		<td class='fcaption'><b>"._NAME."</b></td>";
		if(VisibleInfo("Realname")){
		$text .= "<td class='fcaption'><b>".$infolang['Realname']."</b></td>";
		}if(VisibleInfo("Gender")){
		$text .= "<td class='fcaption'><b>".$infolang['Gender']."</b></td>";
		}if(VisibleInfo("Age") or VisibleInfo("Birthday")){
		$text .= "<td class='fcaption'><b>".$infolang['Birthday']."</b></td>";
		}if(VisibleInfo("Country")){
		$text .="<td class='fcaption'><b>".$infolang['Country']."</b></td>";
		}if(VisibleInfo("Location")){
		$text .="<td class='fcaption'><b>".$infolang['Location']."</b></td>";
		}if(VisibleInfo("Xfire")){
		$text .="<td class='fcaption'><b>".$infolang['Xfire']."</b></td>";
		}if(VisibleInfo("Steam ID")){
		$text .= "<td class='fcaption'><b>".$infolang['Steam ID']."</b></td>";
		}if(VisibleInfo("Join Date")){
		$text .= "<td class='fcaption'><b>".$infolang['Join Date']."</b></td>";
		}if($conf['rank_per_game'] == 0 && (VisibleInfo("Rank") or VisibleInfo("Rank Image"))){
		$text .= "<td class='fcaption'><b>".$infolang['Rank']."</b></td>";
		}if(VisibleInfo("Activity") > 0){
		$text .= "<td class='fcaption'><b>".$infolang['Activity']."</b></td>";}
		$text .= "<td class='fcaption'></td>
	</tr>";
	

	$sql->db_Select_gen("SELECT i.*, u.user_name from #clan_members_info i, #user u WHERE u.user_id=i.userid order by u.user_name");
		while($row = $sql->db_Fetch()){
			$member = $row['user_name'];
			$memberid = $row['userid'];
			$realname = $row['realname'];
			$birthday = $row['birthday'];
			$country = $row['country'];
			$location = $row['location'];
			$xfire = $row['xfire'];
			$steam = $row['steam'];
			$joindate = $row['joindate'];
			$rank = $row['rank'];
			$active = $row['active'];
			$gender = $row['gender'];
			
			$sql2 = new db;
			$sql2->db_Select("clan_members_ranks", "rank", "rid='$rank'");
			$rowrank = $sql2->db_Fetch();
			$rank = $rowrank['rank'];

			$text .= "<tr id='member$memberid'>
					<td class='forumheader3' style='text-align:left;'>$member</td>";
					if(VisibleInfo("Realname")){
					$text .="<td class='forumheader3'>$realname</td>";
					}if(VisibleInfo("Gender")){
					$text .="<td class='forumheader3'>$gender</td>";
					}if(VisibleInfo("Age") or VisibleInfo("Birthday")){
						if($birthday != 1){
							$text .= "<td class='forumheader3'>".date($conf['birthformat'],$birthday)."</td>";
						}else{
							$text .= "<td class='forumheader3'>&nbsp;</td>";
						}
					}if(VisibleInfo("Country")){
					$text .="<td class='forumheader3'><img src='".e_IMAGE."clan/flags/$country.png' border='0' title='$country'></td>";
					}if(VisibleInfo("Location")){
					$text .="<td class='forumheader3'>$location</td>";
					}if(VisibleInfo("Xfire")){
					$text .="<td class='forumheader3'>$xfire</td>";
					}if(VisibleInfo("Steam ID")){
					$text .= "<td class='forumheader3'>$steam</td>";
					}if(VisibleInfo("Join Date")){
						if($joindate != 1){
							$text .= "<td class='forumheader3'>".date($conf['joinformat'],$joindate)."</td>";
						}else{
							$text .= "<td class='forumheader3'>&nbsp;</td>";
						}
					}if($conf['rank_per_game'] == 0 && (VisibleInfo("Rank") or VisibleInfo("Rank Image"))){
					$text .="<td class='forumheader3'>$rank</td>";
					}if(VisibleInfo("Activity")){
						if($active == 1){
						$text .="<td class='forumheader3'><font color='#008000'>"._ACTIVE."</font></td>";
						}else{
						$text .="<td class='forumheader3'><font color='#FF0000'>"._INACTIVE."</font></td>";
						}
					}
					
					$text .= "<td class='forumheader3' width='10' nowrap><input type='button' class='button' value='"._EDIT."' onclick=\"window.location='admin_old.php?editmember&memberid=$memberid'\">&nbsp;<input type='button' class='button' value='"._DEL."' onclick=\"DelMember('$memberid','$member');\"></td>
					</tr>";
			}
			$text .="</table>";
		
		echo'<iframe name="cmupdate" id="cmupdate" style="width:0;height:0;display:none;" src="#"></iframe>';
		$ns -> tablerender(_EDITMEMBERS, $text);

			
			
?>
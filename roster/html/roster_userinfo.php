<?php

class userinfo_html {

	function uinfo_show($m_id) {
	global $sql;

		// get the member
		$member_q = $sql->db_Select("roster_members", "*", "roster_member_id='".$m_id."'");
		$member_a = $sql->db_Fetch(MYSQL_ASSOC);

		$rank = explode(",", $member_a['roster_member_rank']);

      		$enlisted = date("dMY", $member_a['roster_member_enlisted']);
      		$enlisted = strtoupper($enlisted);
      		$patterns[0] = "/JUN/";
      		$patterns[1] = "/JUL/";
      		$patterns[2] = "/SEP/";
      		$replacements[0] = "JUNE";
      		$replacements[1] = "JULY";
      		$replacements[2] = "SEPT";
      		$enlisted = preg_replace($patterns, $replacements, $enlisted);

		$time = time();
		$timeinservice = ceil(($time - $member_a['roster_member_enlisted'])/(24*60*60));
		if($timeinservice == 1){
			$timeinservice = $timeinservice." day";
		}else{
			$timeinservice = $timeinservice." days";
		}

		$ureport_q = $sql->db_Select("roster_members", "*", "roster_member_id='".$member_a['roster_member_unitreport']."'");
		$ureport_a = $sql->db_Fetch(MYSQL_ASSOC);
		$ureport_rank = explode(",", $ureport_a['roster_member_rank']);
		$ureport = $ureport_rank[2]."-".$ureport_a['roster_member_name'];

		$dreport_q = $sql->db_Select("roster_members", "*", "roster_member_id='".$member_a['roster_member_dutyreport']."'");
		$dreport_a = $sql->db_Fetch(MYSQL_ASSOC);
		$dreport_rank = explode(",", $dreport_a['roster_member_rank']);
		$dreport = $dreport_rank[2]."-".$dreport_a['roster_member_name'];

		$rankdate = date("dMY", $member_a['roster_member_rankdate']);
      		$rankdate = strtoupper($rankdate);
      		$patterns[0] = "/JUN/";
      		$patterns[1] = "/JUL/";
      		$patterns[2] = "/SEP/";
      		$replacements[0] = "JUNE";
      		$replacements[1] = "JULY";
      		$replacements[2] = "SEPT";
      		$rankdate = preg_replace($patterns, $replacements, $rankdate);

		$time = time();
		$timeingrade = ceil(($time - $member_a['roster_member_rankdate'])/(24*60*60));
		if($timeingrade == 1){
			$timeingrade = $timeingrade." day";
		}
		else{
			$timeingrade = $timeingrade." days";
		}

		$pfile = nl2br($member_a['roster_member_pfile']);
		$xfireprofile = "<img src=http://miniprofile.xfire.com/bg/bg/type/0/".$member_a['roster_member_xfire'].".png border='0'/>";
		
		return '
			<table class="roster" width="100%">
				<tr>
					<td class="roster_uniform" ><img src="'.e_PLUGIN.'roster/images/uniform/'.$m_id.'.png" border="0" /></td>
				</tr>
			</table>
			<table class="roster" width="100%">
				<tr>
					<td class="roster_main" colspan="5">'.roster_LAN_UINFO_PJACKET.'</td>
				</tr>
				<tr>	
					<td width="25%">'.roster_LAN_UINFO_LOCATION.':</td>
					<td width="74%">'.$member_a['roster_member_location'].'</td>
				</tr>
				<tr>
					<td width="25%">'.roster_LAN_UINFO_ENLISTED.':</td>
					<td width="74%">'.$enlisted.'</td>
				</tr>
				<tr>	
					<td width="25%">'.roster_LAN_UINFO_TIMEINSERVICE.':</td>
					<td width="74%">'.$timeinservice.'</td>
				</tr>
				<tr>
					<td width="25%">'.roster_LAN_UINFO_UASSIGN.':</td>
					<td width="74%">'.$member_a['roster_member_unit'].'</td>
				</tr>
			</table>
			<table class="roster" width="100%">
				<tr>
					<td class="roster_main">'.roster_LAN_UINFO_PFILE.'</td>
				</tr>
				<tr>
					<td>'.$pfile.'</td>
				</tr>
			</table>
			<table class="roster" width="100%">
				<tr>
					<td class="roster_main">'.roster_LAN_UINFO_XFIREPROFILE.'</td>
				</tr>
				<tr>
					<td class="roster_xfireprofile">'.$xfireprofile.'</td>
				</tr>
			</table>
		';
	} // end function uinfo_show()

} // end class userinfo
?>
<?php
include(e_PLUGIN."/advance_online_menu/language/".e_LANGUAGE.".php");

global $listuserson, $listuserson, $ADMIN_DIRECTORY, $gen;
$gen = new convert;

if ((MEMBERS_ONLINE + GUESTS_ONLINE) > ($menu_pref['most_members_online'] + $menu_pref['most_guests_online'])) {
		$menu_pref['most_members_online'] = MEMBERS_ONLINE;
		$menu_pref['most_guests_online'] = GUESTS_ONLINE;
		$menu_pref['most_online_datestamp'] = time();
		$tmp = addslashes(serialize($menu_pref));
		$sql->db_Update("core", "e107_value='".$tmp."' WHERE e107_name='menu_pref' ");
}

if($pref['aom_mm_s']) {
	$tm_n = $sql->db_Count("user","(*)","where user_ban='0'");
	if($tm_n == "") {
		$tm_n = 1;
	}
	
	$datestamp = $gen->convert_date($menu_pref['most_online_datestamp'], "short");
	$more = "
		<table width='100%' class='fborder'>
			<tr>
				<td colspan='2'>
					<span style='font-weight: bold;'>
						".AO_OTHER." ".AO_INFORMATION.":
					</span>
				</td>
			</tr>
			<tr>
				<td>
					<span class='smalltext'>
						".AO_TM."
					</span>
				</td>
				<td style='text-align: right;'>
					<span class='smalltext'>
						".$tm_n."
					</span>
				</td>
			</tr>
			<tr>
				<td>
					<span class='smalltext'>
						".AO_MOSTON."
						<br />
						<i>(".AO_MEMBERS.": ".$menu_pref['most_members_online']."
						, ".AO_GUESTS.": ".$menu_pref['most_guests_online'].")</i>
					</span>
				</td>
				<td style='text-align: right;'>
					<span class='smalltext'>
						".($menu_pref['most_members_online'] + $menu_pref['most_guests_online'])."
						<br /><i>".$datestamp."</i>
					</span>
				</td>
			</tr>
		</table>";
		
	$more_b = "
		<a class='smalltext' style='cursor: pointer;' onClick='aom_js_hide(); aom_js_show(\"AO_OTHER\")'>
			".AO_OTHER."
		</a>".$pref['aom_seperator'];
}

if($pref['aom_nm_s']) {
	$nm_o = "
		<table style='width: 100%;' class='fborder'>
			<tr>
				<td colspan='2'>
					<span style='font-weight: bold;'>
						".AO_NEWEST." ".AO_MEMBERS.":
					</span>
				</td>
			</tr>";
	$sql->db_Select("user", "user_id, user_name, user_join", "user_ban='0' ORDER BY user_join DESC LIMIT ".$pref['aom_nm_l_n']);
	while($nm_r = $sql->db_Fetch()) {
		extract($nm_r);
		$gen = new convert;
		$datestamp = $gen->convert_date($user_join, "short");
		$nm_o .= "
			<tr>
				<td>
					<a class='smalltext' href='".e_BASE."user.php?id.".$user_id."'>
						".$user_name."
					</a>
				</td>
				<td style='text-align: right;'>
					<span class='smalltext'>
						".$datestamp."
					</span>
				</td>
			</tr>";
	}
	$nm_o .= "
		</table>";
	
	$newest_b = "
		<a class='smalltext' style='cursor: pointer;' onClick='aom_js_hide(); aom_js_show(\"AO_NEWEST\")'>
			".AO_NEWEST."
		</a>".$pref['aom_seperator'];
}

if($pref['aom_lm_s']) {
	$lm_o = "
		<table style='width: 100%;' class='fborder'>
			<tr>
				<td colspan='2'>
					<span style='font-weight: bold;'>
						".AO_LATEST." ".AO_SEEN.":
					</span>
				</td>
			</tr>";
	$sql->db_Select("user", "user_id, user_name, user_currentvisit", "user_ban='0' ORDER BY user_currentvisit DESC LIMIT ".$pref['aom_lm_l_n']);
	while($nm_r = $sql->db_Fetch()) {
		extract($nm_r);
		$datestamp = $user_currentvisit ? $gen->convert_date($user_currentvisit, "short") : "<i>".AO_NOI."</i>";
		$lm_o .= "
			<tr>
				<td>
					<a class='smalltext' href='".e_BASE."user.php?id.".$user_id."'>
						".$user_name."
					</a>
				</td>
				<td style='text-align: right;'>
					<span class='smalltext'>
						".$datestamp."
					</span>
				</td>
			</tr>";
	}
	$lm_o .= "
		</table>";
		
	$latest_b = "
		<a class='smalltext' style='cursor: pointer;' onClick='aom_js_hide(); aom_js_show(\"AO_LATEST\")'>
			".AO_LATEST."
		</a>".$pref['aom_seperator'];
}

if($pref['aom_om_s']) {
	$online = "
		<table width='100%' class='fborder'>
			<tr>
				<td colspan='2'>
					<span style='font-weight: bold;'>
						".AO_ONLINE." ".AO_MEMBERS.":
					</span>
				</td>
			</tr>";
	if (MEMBERS_ONLINE) {
		$online .= "
				<tr>
					<td colspan='2' style='text-align: center;'>
						<span class='smalltext' style='font-weight: bold;'>".AO_MEMBERS.": ".MEMBERS_ONLINE."</span>
					</td>
				</tr>";
		foreach($listuserson as $uinfo => $pinfo) {
			list($oid, $oname) = explode(".", $uinfo, 2);
			$online_location_page = substr(strrchr($pinfo, "/"), 1);
			if ($pinfo == "log.php" || $pinfo == "error.php") {
				$online_location_page = "news.php";
				$pinfo = "news.php";
			}
			if ($online_location_page == "request.php") {
				$pinfo = "download.php";
			}
			if (strstr($online_location_page, "forum")) {
				$pinfo = e_PLUGIN."forum/forum.php";
				$online_location_page = "forum.php";
			}
			if (strstr($online_location_page, "content")) {
				$pinfo = "content.php";
				$online_location_page = "content.php";
			}
			if (strstr($online_location_page, "comment")) {
				$pinfo = "comment.php";
				$online_location_page = "comment.php";
			}
			
			$online .= "
				<tr>
					<td>
						<img src='".e_IMAGE_ABS."admin_images/users_16.png' />
						<a class='smalltext' href='".e_BASE."user.php?id.".$oid."'>
							".$oname."
						</a>
					</td>
					<td style='text-align: right;'>";
			(!strstr($pinfo, $ADMIN_DIRECTORY) ? $online .= " <a class='smalltext' href='".$pinfo."'>".$online_location_page."</a>" : $online .= "<span class='smalltext'>".$online_location_page."</span>");
			if(ADMIN) {
				$sql->db_Select("user", "user_ip", "user_id='".$oid."'");
				while($admin_row = $sql->db_Fetch()) {
					extract($admin_row);
					$online .= "<br /><span class='smalltext'>".$user_ip."</span>";
				}
			}
			$online .= "
					</td>
				</tr>";
		}
	}
	
	if (GUESTS_ONLINE) {
		$online .= "
				<tr>
					<td colspan='2' style='text-align: center;'>
						<span class='smalltext' style='font-weight: bold;'>".AO_GUESTS.": ".GUESTS_ONLINE."</span>
					</td>
				</tr>";
		$sql->db_Select("online", "online_ip, online_location", "online_user_id='0'");
			while($go_r = $sql->db_Fetch()) {
				extract($go_r);
				
				$online_location_page = substr(strrchr($online_location, "/"), 1);
				if ($online_location == "log.php" || $online_location == "error.php") {
				$online_location_page = "news.php";
					$online_location = "news.php";
				}
				if ($online_location_page == "request.php") {
					$online_location = "download.php";
				}
				if (strstr($online_location_page, "forum")) {
					$online_location = e_PLUGIN."forum/forum.php";
					$online_location_page = "forum.php";
				}
				if (strstr($online_location_page, "content")) {
					$online_location = "content.php";
					$online_location_page = "content.php";
				}
				if (strstr($online_location_page, "comment")) {
					$online_location = "comment.php";
					$online_location_page = "comment.php";
				}
				
				$online .= "
				<tr>
					<td>
						<span class='smalltext'>
							".AO_GUEST."
						</span>
					</td>
					<td style='text-align: right;'>
						<span class='smalltext'>
							<a class='smalltext' href='".$online_location."'>".$online_location_page."</a>";
				
				if($pref['ao_menu_show_guests']) {
					$online .= "<br />".$online_ip;
				} elseif(ADMIN) {
					$online .= "<br />".$online_ip;
				}
				
				$online .= "
						</span>
					</td>";
			}
	}
	$online .= "
		</table>";
		
	$online_b = $pref['aom_seperator']."
		<a class='smalltext' style='cursor: pointer;' onClick='aom_js_hide(); aom_js_show(\"AO_ONLINE\")'>
			".AO_ONLINE."
		</a>".$pref['aom_seperator'];
} else { $online_b = $pref['aom_seperator']; }

$menu = "
	<script type='text/javascript'>
	function aom_js_hide() {
		document.getElementById('AO_ONLINE').style.display = 'none';
		document.getElementById('AO_LATEST').style.display = 'none';
		document.getElementById('AO_NEWEST').style.display = 'none';
		document.getElementById('AO_OTHER').style.display = 'none';
	};

	function aom_js_show(id) {
		document.getElementById(id).style.display = 'block'; 
	};
	</script>
	".$online_b.$latest_b.$newest_b.$more_b."
	<div id='AO_ONLINE'"; if($pref['aom_om_s']) { $menu .= " style='display: block;'"; } else { $menu .= " style='display: none;'"; } $menu .= ">
		".$online."
	</div>
	<div id='AO_LATEST'"; if(!$pref['aom_om_s']) { $menu .= " style='display: block;'"; } else { $menu .= " style='display: none;'"; } $menu .= ">
		".$lm_o."
	</div>
	<div id='AO_NEWEST'"; if((!$pref['aom_om_s']) && (!$pref['aom_lm_s'])) { $menu .= " style='display: block;'"; } else { $menu .= " style='display: none;'"; } $menu .= ">
		".$nm_o."
	</div>
	<div id='AO_OTHER'"; if((!$pref['aom_om_s']) && (!$pref['aom_lm_s']) && (!$pref['aom_nm_s'])) { $menu .= " style='display: block;'"; } else { $menu .= " style='display: none;'"; } $menu .= ">
		".$more."
	</div>
	";

$ns->tablerender($pref['ao_menu_name'], $menu);
?>
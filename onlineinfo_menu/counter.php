<?php
if (!defined('e107_INIT')) { exit; }


if (isset($pref['statActivate']) && $pref['statActivate'] == true) {


	if(check_class($extraclass)){

	if($extrahide==1){

	         $text .= '<div id="counter-title" style="cursor:hand; font-size: '.$onlineinfomenufsize.'px; text-align:left; vertical-align: middle; width:'.$onlineinfomenuwidth.'; font-weight: bold;" title="'.ONLINEINFO_LOGIN_MENU_L42.'">&nbsp;'.ONLINEINFO_LOGIN_MENU_L42.'</div>';
	         $text .= '<div id="counter" class="switchgroup1" style="display:none">';

			}else{

				$text .='<div class="smallblacktext" style="font-size:'.$onlineinfomenufsize.'px; margin-left:5px; margin-top:10px; font-weight:bold;">'.ONLINEINFO_LOGIN_MENU_L42.'</div>
				<div style="text-align:left">';
			}


		if (isset($pref['statActivate']) && $pref['statActivate'] == true) {
			$pageName = preg_replace('/(\?.*)|(\_.*)|(\.php)/', '', basename (e_SELF));
			$logfile = e_PLUGIN.'log/logs/logp_'.date('z.Y', time()).'.php';
			if(!is_readable($logfile))
			{
				if(ADMIN && !$pref['statCountAdmin'])
				{
					$text .= '<div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';font-weight: italic;">** '.ONLINEINFO_COUNTER_L1.' **</div>';
				}
				$total = 1;
				$unique = 1;
				$siteTotal = 1;
				$siteUnique = 1;
				$totalever = 1;
				$uniqueever = 1;
			} else {

				require($logfile);
				if($sql -> db_Select("logstats", "*", "log_id='statTotal' OR log_id='statUnique' OR log_id='pageTotal'"))
				{
					while($row = $sql -> db_Fetch())
					{
						if($row['log_id'] == 'statTotal')
						{
							$siteTotal += $row['log_data'];
						}
							else if($row['log_id'] == 'statUnique')
						{
							$siteUnique += $row['log_data'];
						}
							else
						{
							$dbPageInfo = unserialize($row['log_data']);
							$totalPageEver = ($dbPageInfo[$pageName]['ttlv'] ? $dbPageInfo[$pageName]['ttlv'] : 0);
							$uniquePageEver = ($dbPageInfo[$pageName]['unqv'] ? $dbPageInfo[$pageName]['unqv'] : 0);
						}
					}
				}
				$pageName = preg_replace('/(\?.*)|(\_.*)|(\.php)/', '', basename (e_SELF));
				$total = ($pageInfo[$pageName]['ttl'] ? $pageInfo[$pageName]['ttl'] : 0);
				$unique = ($pageInfo[$pageName]['unq'] ? $pageInfo[$pageName]['unq'] : 0);
				$totalever = ($pageInfo[$pageName]['ttlv'] ? $pageInfo[$pageName]['ttlv'] : 0) + $totalPageEver + $total;
				$uniqueever = ($pageInfo[$pageName]['unqv'] ? $pageInfo[$pageName]['unqv'] : 0) + $uniquePageEver + $unique;
			}


			$text .= '<div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';font-weight: bold;">'.ONLINEINFO_COUNTER_L2.'</div><div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';">'.ONLINEINFO_COUNTER_L3.': '.$total.'</div><div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';">'.ONLINEINFO_COUNTER_L5.': '.$unique.'</div><br />
			
			<div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';font-weight: bold;">'.ONLINEINFO_COUNTER_L4.'</div><div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';">'.ONLINEINFO_COUNTER_L3.': '.$totalever.'</div><div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';">'.ONLINEINFO_COUNTER_L5.': '.$uniqueever.'</div><br />
			
			<div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';font-weight: bold;">'.ONLINEINFO_COUNTER_L6.'</div><div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';">'.ONLINEINFO_COUNTER_L3.': '.$siteTotal.'</div><div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';">'.ONLINEINFO_COUNTER_L5.': '.$siteUnique.'</div>';

			unset($dbPageInfo);


				if((MEMBERS_ONLINE + GUESTS_ONLINE) > ($pref['most_members_online'] + $pref['most_guests_online'])){
							$pref['most_members_online'] = MEMBERS_ONLINE;
							$pref['most_guests_online'] = GUESTS_ONLINE;
							$pref['most_online_datestamp'] = time();
							save_prefs();
						}
						if(!is_object($gen)){
							$gen = new convert;
						}

						$datestamp = $gen->convert_date($pref['most_online_datestamp'], '');
						
						$text .= '<br /><div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.'; font-weight: bold;">'.ONLINE_EL8.': '.($pref['most_members_online'] + $pref['most_guests_online']).'</div><div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';">('.ONLINE_EL2.$pref['most_members_online'].', '.ONLINE_EL1.$pref['most_guests_online'].')</div><div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';">'.ONLINE_EL9.' '.$datestamp.'</div><br />';
						$total_members = $sql -> db_Count("user");


				$text .='</div>';

		}
		else
		{
			if(ADMIN)
			{
				$text .= '<div class="smalltext" style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';">'.ONLINEINFO_COUNTER_L8.'</div>
				<br /></div>';

			}
		}
	}


}else
{
 // if log is not running

			if (ADMIN)

			{

				if(check_class($extraclass)){

				if($extrahide==1){
	         $text .= '<div id="counter-title" style="cursor:hand; text-align:left; vertical-align: middle; width:'.$onlineinfomenuwidth.';" title="'.ONLINEINFO_LOGIN_MENU_L42.'"><b>&nbsp;'.ONLINEINFO_LOGIN_MENU_L42.'</b></div>
			 <div id="counter" class="switchgroup1" style="display:none">';

						}else{

							$text .='<div class="smallblacktext" style="font-size: 14px;font-weight:bold;">'.ONLINEINFO_LOGIN_MENU_L42.'</div>
							<div style="text-align:left">';
						}

			$text .= '<div class="smalltext"  style="margin-left:5px; text-align:left; width:'.$onlineinfomenuwidth.';">'.ONLINEINFO_COUNTER_L8.'</div>
			
			<br /></div>';

			}

			}
}

?>
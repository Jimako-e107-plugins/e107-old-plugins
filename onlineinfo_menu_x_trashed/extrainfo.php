<?php
if (!defined('e107_INIT')) { exit; }

if(check_class($orderclass))
{

		if($orderhide==1){


        $text .= '<div id="info-title" style="cursor:hand; text-align:left; font-size: '.$onlineinfomenufsize.'px; vertical-align: middle; width:'.$onlineinfomenuwidth.'; font-weight:bold;" title="'.ONLINEINFO_LOGIN_MENU_L38.'">&nbsp;'.ONLINEINFO_LOGIN_MENU_L38.'</div>
		<div id="info" class="switchgroup1" style="display:none;text-align:left; width:'.$onlineinfomenuwidth.'; margin-left:16px;">';

		}

		$extrasql=new db;
		$script="SELECT * FROM ".MPREFIX."onlineinfo_cache Where type='extraorder' ORDER BY type_order";
		$onlineinfoextra = $extrasql->db_Select_gen($script);


		while ($extrarow = $extrasql->db_Fetch()){

		 $extrahide=$extrarow['cache_hide'];
		 $extraclass=$extrarow['cache_userclass'];
		 $extraacache=$extrarow['cache_active'];
		 $extracachetime=$extrarow['cache_timestamp'];
		 $extrarecords=$extrarow['cache_records'];

		 require_once(e_PLUGIN.'onlineinfo_menu/'.$extrarow['cache'].'.php');

		}

		if($orderhide==1){ $text .='<br/></div>';}

}
?>
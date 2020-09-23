<?php
//if (!defined('e107_INIT')) { exit; }

require_once('../../class2.php');

$lan_file = e_PLUGIN.'onlineinfo_menu/languages/'.e_LANGUAGE.'.php';
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'onlineinfo_menu/languages/English.php');

$qs = explode('.', e_QUERY);

$text='';

	if($qs[0]=='addbuddy')
	{
		if (!$sql -> db_Select("onlineinfo_friends", "*", "amigo_user='".USERID."' AND amigo_amigo='".$qs[1]."'"))
		{
			if ($sql -> db_Insert("onlineinfo_friends", "0, '".USERID."', '".$qs[1]."' "))
			{
				$text.= '<div style="text-align:center;font-weight:bold;padding: 5px 5px 5px 5px;">'.AMIGO_4.'</div>';
				$caption=AMIGO_4;
			}else{
				$text.= '<div style="text-align:center;font-weight:bold;padding: 5px 5px 5px 5px;"><img src="'.e_PLUGIN.'onlineinfo_menu/images/error.png" style="vertical-align:middle" width="15" height="15" alt="IMPORTANT!" title="IMPORTANT!" />&nbsp;&nbsp;'.AMIGO_8.'</div>';
			$caption=AMIGO_5;
			}
		}else{
			$text.= '<div style="text-align:center;font-weight:bold;padding: 5px 5px 5px 5px;"><img src="'.e_PLUGIN.'onlineinfo_menu/images/error.png" style="vertical-align:middle" width="15" height="15" alt="IMPORTANT!" title="IMPORTANT!" />&nbsp;&nbsp;'.AMIGO_5.'</div>';
			$caption=AMIGO_5;
		}
	}



$text.= '<center><input type=button onClick="self.close();" value="Close this window"></center>';

echo $text;

?>
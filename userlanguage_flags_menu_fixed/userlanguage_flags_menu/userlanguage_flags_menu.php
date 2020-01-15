<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Plugin file :  e107_plugins/userlanguage_flags_menu/userlanguage_flags_menu.php
|        Revision    1.5
|        Date        26.07.2013
|        Author      JmoRava, Oxigen ( www.e107.funsite.cz ) 
+----------------------------------------------------------------------------------------------------+
*/


if(!defined('e107_INIT'))
{
	exit;
}
 
if(!e107::isInstalled('userlanguage_flags_menu'))
{
	e107::redirect(e_BASE . 'index.php');
}

$pref = e107::pref('userlanguage_flags_menu'); 

unset($text);

$slng = e107::getLanguage();
 
if(!$pref['user_lan_use']){  
	$languageList = explode(',', e_LANLIST);   
	//$lanlist = (e107::getPref()['multilanguage']>0?$languageList:array());   /* rica-carv */
	//$lanlist = $languageList:array();      cause white screen
	$fl = new e_file;   
	$lanlist = $fl->get_dirs(e_LANGUAGEDIR);
	sort($lanlist);  
	//$action = (e_QUERY && !$_GET['elan']) ? e_SELF."?".e_QUERY : e_SELF;
	$action = e_REQUEST_URI;
 
	$text = "<div style='text-align:".$pref['lanflags_aling']."'>\n";
	if($pref['lanflags_render'] == '1'){
			$text .= "<form method='post' action='".$action."'><div class='lan_flag'><select name='sitelanguage' class='tbox' >";
		foreach($lanlist as $langval){
			unset($selected);
			if($langval == USERLAN || ($langval == $pref['sitelanguage'] && USERLAN == "")){
				$selected = "selected='selected'";}
			$text .= "<option value='".$langval."' $selected>".$langval."</option>\n ";
		}
		$text .= "</select>";
		$text .= "<br /><br /><input class='button' type='submit' name='setlanguage' value='".USLFM_P_5."' /></div></form>";
	}else{
		foreach($lanlist as $langval)
		{
		$text .= "<form method='post' action='".$action."' style='display:inline;' class='lan_flag'>
    <p style='display:inline;'><input type='hidden' name='setlanguage' value='".USLFM_P_5."' />
    <input type='hidden' name='sitelanguage' value='".$langval."' />
    <input type='image' style='display:inline' src='".e_PLUGIN_ABS."userlanguage_flags_menu/flags/".$pref['lanflags_typ']."/".$langval.".png' alt='".$langval."' title='".$langval."' width='".$pref['lanflags_size']."' /> </p></form>\n";
		}
	}
	$text .= "</div>";
}
if ($pref['lanflags_title_on'] == "1"){
	$ns->tablerender(USLFM_P_1, $text, 'user_lan_flags');	
}else{
	echo $text;
}
unset($text);
?>
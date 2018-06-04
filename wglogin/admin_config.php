<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/gsitemap/admin_config.php $
|     $Revision: 13011 $
|     $Id: admin_config.php 13011 2012-10-28 16:26:00Z e107steved $
|     $Author: e107steved $
+----------------------------------------------------------------------------+
*/
require_once("../../class2.php");
if(!isset($pref['plug_installed']['wglogin']) || !getperms("P"))
{
	header("location:".e_BASE."index.php"); 
	exit;
}
include_lan(e_PLUGIN."wglogin/languages/".e_LANGUAGE.".php");
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."userclass_class.php");


$wga = new wgladmin;



class wgladmin
{
/*+----------------------#######################################################################################---------------------+*/
	var $wgprefs;

	/* constructor */
	function wgladmin()
	{
		global $e107, $sql;
		/*Load prefs*/
		$this->wgprefs=$this->getWGPref();
		/*Run routines*/
		switch (e_QUERY){
			case "authorization":
				$this->authsettings();
			break;
			case "rank":
				$this->ranksettings();
			break;
			default:
				$this->mainsettings();
			break;
		}
	}
	
	function getWGPref()
	{
        global $sql, $eArrayStorage;

        $num_rows = $sql -> db_Select("core", "*", "e107_name='wglogin' ");
        if ($num_rows == 0) 
		{
            $wg_pref = array("wg_clan_tag"=>"", "wg_appid"=>"");
            $tmp = $eArrayStorage->WriteArray($wg_pref);
            $sql -> db_Insert("core", "'wglogin', '{$tmp}' ");
            $sql -> db_Select("core", "*", "e107_name='wglogin' ");
        }
        $row = $sql -> db_Fetch();
        $wg_pref = $eArrayStorage->ReadArray($row['e107_value']);

        return $wg_pref;
    }


    function UpdateWGPref()
	{
        global $sql, $eArrayStorage, $tp;

        $num_rows = $sql -> db_Select("core", "*", "e107_name='wglogin' ");
        if ($num_rows == 0)
		{
            $sql -> db_Insert("core", "'wglogin', '' ");	// Create dummy entry if none present
        }
		else
		{
            $row = $sql->db_Fetch(MYSQL_ASSOC);


            //assign new preferences
            foreach($_POST as $k => $v){
                if(strpos($k, "wg_") === 0){
                    $wg_pref[$k] = $tp->toDB($v);
                }
            }

            //create new array of preferences
            $tmp = $eArrayStorage->WriteArray($wg_pref);

            $sql -> db_Update("core", "e107_value = '{$tmp}' WHERE e107_name = 'wglogin' ");
        }
        return $wg_pref;
    }

	
	/*Main settings routine*/
	function mainsettings(){
		global $ns, $sql;
		if(isset($_POST['main_submit'])){
			$message="<div style='text-align:center'>".WGLAN_112."</div>";
			$this->wgprefs=$this->UpdateWGPref();
			$ns->tablerender(WGLAN_107, $message);	
		}
		$text="<form method='post' action='".e_SELF.(e_QUERY?'?'.e_QUERY:'')."'>
		<table style='".ADMIN_WIDTH."' class='fborder'><tr>";
		
		$text.="<td class='forumheader3' width='30%'>".WGLAN_110."</td>
		<td class='forumheader3' width='70%'>
			<input class='tbox' type='text' id='wg_appid' name='wg_appid' value='".$this->wgprefs['wg_appid']."' size='60' maxlength='100' />
		</td></tr><tr>
		";
		
		$text.="<td class='forumheader3' width='30%'>".WGLAN_111."</td>
		<td class='forumheader3' width='70%'>
			<input class='tbox' type='text' id='wg_clan_tag' name='wg_clan_tag' value='".$this->wgprefs['wg_clan_tag']."' size='60' maxlength='100' />
		</td></tr><tr>
		";
		
		$count=$sql->db_Select('userclass_classes','*', '');
		for($i=0; $i<$count; $i++){
			$u_classes[$i]=$sql->db_Fetch();
		}
		
		foreach($u_classes as $u_class){
			$options.="<option value='".$u_class['userclass_id']."'>".$u_class['userclass_name']." (".$u_class['userclass_description'].")</option>";
		}

		$text.="<td class='forumheader3' width='30%'>".WGLAN_113."</td>
		<td class='forumheader3' width='70%'>
				<select class='tbox' id='wg_clan_class' name = 'wg_clan_class'> 
			        ".str_replace("value='".$this->wgprefs['wg_clan_class']."'", "selected value='".$this->wgprefs['wg_clan_class']."'", $options)."
    			</select>
		</td></tr><tr>
		";

		$text.="<td class='forumheader3' width='30%'>".WGLAN_114."</td>
		<td class='forumheader3' width='70%'>
				<select class='tbox' id='wg_guest_class' name = 'wg_guest_class'> 
			        ".str_replace("value='".$this->wgprefs['wg_guest_class']."'", "selected value='".$this->wgprefs['wg_guest_class']."'", $options)."
    			</select>
		</td></tr><tr>
		";
		
		$text.="<td class='forumheader3' colspan='2' style='text-align:center'>
		<input class='button' type='submit' name='main_submit' value='".WGLAN_106."' />
		";
		
		$text.="</tr></table></form>";
		$ns->tablerender(WGLAN_103, $text);	
	}
	
	/*Authorization settings routine*/
	function authsettings(){
		global $ns;
		if(isset($_POST['main_submit'])){
			//$message="<div style='text-align:center'>".WGLAN_112."</div>";
			$this->wgprefs=$this->UpdateWGPref();
			$ns->tablerender(WGLAN_107, $message);	
		}
		
		$text="<form method='post' action='".e_SELF.(e_QUERY?'?'.e_QUERY:'')."'>
		<table style='".ADMIN_WIDTH."' class='fborder'><tr>";
		
		/*$text.="<td class='forumheader3' width='30%'>".WGLAN_110."</td>
		<td class='forumheader3' width='70%'>
			<input class='tbox' type='text' id='appid' name='appid' value='".$this->wgprefs['wg_appid']."' size='60' maxlength='100' />
		</td></tr><tr>
		";
		
		$text.="<td class='forumheader3' width='30%'>".WGLAN_111."</td>
		<td class='forumheader3' width='70%'>
			<input class='tbox' type='text' id='clan_tag' name='clan_tag' value='".$this->wgprefs['wg_clan_tag']."' size='60' maxlength='100' />
		</td></tr><tr>
		";*/
		
		$text.="<td class='forumheader3' colspan='2'>
		<input class='button' type='submit' name='auth_submit' value='".WGLAN_106."' />
		";
		
		$text.="</tr></table></form>";
		$ns->tablerender(WGLAN_105, $text);	
	}
	
	/*Rank settings routine*/
	function ranksettings(){
		global $ns, $sql, $tp;

		if(isset($_POST['rank_submit'])){
			
			if($sql->db_Update('wglogin_userclasses', "name='".$_POST['name']
													 ."', name_i18n='".$_POST['name_i18n']
													 ."', userclass_id=".$_POST['userclass_id']
													 ." WHERE clid=".$_POST['clid'])){
				$message="<div style='text-align:center'>".WGLAN_135.$_POST['clid']." (".$_POST['name_i18n'].")".WGLAN_136."</div>";
				$ns->tablerender(WGLAN_107, $message);
			}else{
				$message="<div style='text-align:center'>".WGLAN_135.$_POST['clid']." (".$_POST['name_i18n'].")".WGLAN_136_E."</div>";
				$ns->tablerender(WGLAN_107_E, $message);	
			}
		}

		if(isset($_POST['rank_delete'])){
			
			if($sql->db_Delete('wglogin_userclasses', 'clid='.$_POST['clid'])){
				$message="<div style='text-align:center'>".WGLAN_137.$_POST['clid']." (".$_POST['name_i18n'].")".WGLAN_138."</div>";
				$ns->tablerender(WGLAN_107, $message);
			}else{
				$message="<div style='text-align:center'>".WGLAN_137.$_POST['clid']." (".$_POST['name_i18n'].")".WGLAN_138_Е."</div>";
				$ns->tablerender(WGLAN_107_E, $message);	
			}
		}
		
		if(isset($_POST['rank_create'])){
			if($_POST['name']=='' || $_POST['name_i18n']=='' || $_POST['userclass_id']==''){
				$message="<div style='text-align:center'>".WGLAN_142."</div>";
				$ns->tablerender(WGLAN_107_E, $message);
			}else{
				if($sql->db_Insert('wglogin_userclasses', "'', '".$_POST['name']."', '".$_POST['name_i18n']."', ".$_POST['userclass_id'])){
					$message="<div style='text-align:center'>".WGLAN_140.$_POST['name_i18n'].WGLAN_141."</div>";
					$ns->tablerender(WGLAN_107_A, $message);
				}else{
					$message="<div style='text-align:center'>".WGLAN_140.$_POST['name_i18n'].WGLAN_141_Е."</div>";
					$ns->tablerender(WGLAN_107_E, $message);	
				}
			}
		}
		
		$count=$sql->db_Select('wglogin_userclasses','*', '');
		for($i=0; $i<$count; $i++){
			$classes[$i]=$sql->db_Fetch(MYSQL_ASSOC);
		}

		$count=$sql->db_Select('userclass_classes','*', '');
		for($i=0; $i<$count; $i++){
			$u_classes[$i]=$sql->db_Fetch();
		}
		
		foreach($u_classes as $u_class){
			$options.="<option value='".$u_class['userclass_id']."'>".$u_class['userclass_name']." (".$u_class['userclass_description'].")</option>";
		}
		
		$text="<table style='".ADMIN_WIDTH."' class='fborder'><tr>
		<td class='fcaption' style='text-align:center; vertical-align:middle'>".WGLAN_130."</td>
		<td class='fcaption' style='text-align:center; vertical-align:middle'>".WGLAN_131."</td>
		<td class='fcaption' style='text-align:center; vertical-align:middle'>".WGLAN_132."</td>
		<td class='fcaption' style='text-align:center; vertical-align:middle'>".WGLAN_133."</td>
		<td class='fcaption' style='text-align:center; vertical-align:middle'>".WGLAN_134."</td>
		</tr><tr>";
				
		foreach($classes as $class){
			$text.="<form method='post' action='".e_SELF.(e_QUERY?'?'.e_QUERY:'')."'>
			<td class='forumheader3' style='text-align:center; vertical-align:middle'>
				".$class['clid']."<input type='hidden' id='clid' name='clid' value='".$class['clid']."' />
			</td>
			<td class='forumheader3' style='text-align:center; vertical-align:middle'>
				<input class='tbox' type='text' id='name' name='name' value='".$class['name']."' />
			</td>
			<td class='forumheader3' style='text-align:center; vertical-align:middle'>
				<input class='tbox' type='text' id='name_i18n' name='name_i18n' value='".$class['name_i18n']."' />
			</td>
			<td class='forumheader3' style='text-align:center; vertical-align:middle'>
				<select class='tbox' id='userclass_id' name = 'userclass_id'> 
			        ".str_replace("value='".$class['userclass_id']."'", "selected value='".$class['userclass_id']."'", $options)."
    			</select>
			</td>
			<td class='forumheader3' style='text-align:center; vertical-align:middle'>
				<input class='button' type='submit' name='rank_submit' value='".WGLAN_106."' />
				<input class='button' type='submit' name='rank_delete' value='".WGLAN_106_D."' />
			</td>
			</form></tr>\n<tr>";
		}		
		
		$text.="<td colspan='5' class='fcaption' style='text-align:center; vertical-align:middle'>".WGLAN_139."</td></tr>";
		$text.="<form method='post' action='".e_SELF.(e_QUERY?'?'.e_QUERY:'')."'><tr>
			<td class='forumheader3' style='text-align:center; vertical-align:middle'>
				&nbsp;
			</td>
			<td class='forumheader3' style='text-align:center; vertical-align:middle'>
				<input class='tbox' type='text' id='name' name='name' value='' />
			</td>
			<td class='forumheader3' style='text-align:center; vertical-align:middle'>
				<input class='tbox' type='text' id='name_i18n' name='name_i18n' value='' />
			</td>
			<td class='forumheader3' style='text-align:center; vertical-align:middle'>
				<select class='tbox' id='userclass_id' name = 'userclass_id'> 
			        ".$options."
    			</select>
			</td>
			<td class='forumheader3' style='text-align:center; vertical-align:middle'>
			
			</td>
		</tr><tr>
			<td colspan='5' class='fcaption' style='text-align:center; vertical-align:middle'>
				<input class='button' type='submit' name='rank_create' value='".WGLAN_106_A."' />
			</td>
		</tr></form><tr>";
		$text.="</tr></table>";
		$ns->tablerender(WGLAN_109, $text);	
	}

/*+----------------------#######################################################################################---------------------+*/
}

require_once(e_ADMIN."footer.php");


function admin_config_adminmenu() {
	$action = (e_QUERY) ? e_QUERY : "list";
    $var['list']['text'] = WGLAN_102;
	$var['list']['link'] = e_SELF;
	$var['list']['perm'] = "7";
	//$var['authorization']['text'] = WGLAN_104;
	//$var['authorization']['link'] = e_SELF."?authorization";
	//$var['authorization']['perm'] = "7";
    $var['rank']['text'] = WGLAN_108 ;
	$var['rank']['link'] = e_SELF."?rank";
	$var['rank']['perm'] = "7";
	//$var['import']['text'] = GSLAN_23;
	//$var['import']['link'] = e_SELF."?import";
	//$var['import']['perm'] = "0";
	show_admin_menu(WGLAN_101, $action, $var);
}

?>
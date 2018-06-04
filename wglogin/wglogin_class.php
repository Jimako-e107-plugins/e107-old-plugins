<?php

if(!defined('WGLOGIN')){exit('Do not enter here from direct link');}

class wglogin

{

	var $wgprefs;
	//Constructor--------------------------------------------------------------------------------------

	function wglogin(){

		global $e107, $sql;
		
		$this->wgprefs=$this->getWGPref();
		
		define('APPID', $this->wgprefs['wg_appid']);

		define('URL', $_SERVER['SERVER_NAME']."/".e_PLUGIN.'wglogin/wglogin.php');
		
	}

	//END----------------------------------------------------------------------------------------------

	//Getting prefs------------------------------------------------------------------------------------
	function getWGPref()
	{
        global $sql, $eArrayStorage;

        $num_rows = $sql -> db_Select("core", "*", "e107_name='wglogin' ");
        $row = $sql -> db_Fetch();
        $wg_pref = $eArrayStorage->ReadArray($row['e107_value']);

        return $wg_pref;
    }
	//END------------------------------------------------------------------------------------------------

	//Getting personal data from WG----------------------------------------------------------------------

	function getpersonal($acc_id, $token){

		$context=stream_context_create(

			array('http'=>

				array(

					'method'=>'POST',

					'header'=>'Content-type: application/x-www-form-urlencoded',

					'content'=>http_build_query(

						array(

							'application_id' => APPID,

							'access_token' => $token,

							'account_id' => $acc_id

						)

					)

				)

			)

		);

		$personal=json_decode(@file_get_contents("https://api.worldoftanks.ru/wot/account/info/", false, $context),true);//получаем персональную информацию
		if($personal['status']=='ok'){

			$personal=$personal['data'];

			foreach($personal as $pers){

				return $pers;

			}

		}else{

			return FALSE;

		}

	}

	//END------------------------------------------------------------------------------------------------

	

	//Getting clan's member data from WG-----------------------------------------------------------------

	function getcmember($acc_id){

		$context=stream_context_create(

			array('http'=>

				array(

					'method'=>'POST',

					'header'=>'Content-type: application/x-www-form-urlencoded',

					'content'=>http_build_query(

						array(

							'application_id' => APPID,

							'account_id' => $acc_id

						)

					)

				)

			)

		);

		$member=json_decode(@file_get_contents("https://api.worldoftanks.ru/wgn/clans/membersinfo/", false, $context),true);//получаем персональную информацию

		if($member['status']=='ok'){

			$member=$member['data'];

			foreach($member as $mmbr){

				return $mmbr;

			}

		}else{

			return FALSE;

		}

	}

	//END------------------------------------------------------------------------------------------------

	//Getting clanID by TAG------------------------------------------------------------------------------
	function getclantag($clantag){
		$context=stream_context_create(

			array('http'=>

				array(

					'method'=>'POST',

					'header'=>'Content-type: application/x-www-form-urlencoded',

					'content'=>http_build_query(

						array(

							'application_id' => APPID,

							'fields' => "tag,clan_id",
							
							'search' => $clantag,
							
							'limit' => "1"

						)

					)

				)

			)

		);

		$clan=json_decode(@file_get_contents("https://api.worldoftanks.ru/wgn/clans/list/", false, $context),true);
		
		if($clan['status'] == 'ok'){
			
			return $clan['data'][0]['clan_id'];	
			
		}else{
			
			return FALSE;	
			
		}
		
	}
	//END------------------------------------------------------------------------------------------------	

	//Getting clan data from WG--------------------------------------------------------------------------

	function getclan($clan_id, $token){

		$context=stream_context_create(

		array('http'=>

			array(

				'method'=>'POST',

				'header'=>'Content-type: application/x-www-form-urlencoded',

				'content'=>http_build_query(

					array(

						'application_id' => APPID,

						'clan_id' => $clan_id,

						'access_token' => $token

					)

				)

			)

		));

		$clan=json_decode(@file_get_contents("https://api.worldoftanks.ru/wgn/clans/info/", false, $context),true);//получаем персональную информацию

		if($clan['status']=='ok'){

			$clan=$clan['data'];

			foreach($clan as $cl){

				return $cl;

			}

		}else{

			return FALSE;

		}	

	}

	//END------------------------------------------------------------------------------------------------

		

	//Find account id in database-------------------------------------------------------------------------

	function finduser($uid){

		global $sql;

		if($sql->db_Select('user', '*', 'user_id='.$uid)) return true;

		else return false;

	}		

	//END--------------------------------------------------------------------------------------------------

	

	//Getting userclass------------------------------------------------------------------------------------

	function getclass($class, $clan){

		global $sql, $tp;
		if($sql->db_Select('wglogin_userclasses', '*', "name='".$tp->toDB($class)."'") && $clan===$this->wgprefs['wg_clan_tag']){
			$row=$sql->db_Fetch();
			$cid=$row['userclass_id'].','.$this->wgprefs['wg_clan_class'];	
		}else{
			$cid=$this->wgprefs['wg_guest_class'];	
		}
		return $cid;
	}

	//END--------------------------------------------------------------------------------------------------

	

	//Register new user------------------------------------------------------------------------------------

	function register($ud){
		if(!isset($ud) || !is_array($ud)) exit;	

		$cid=$this->getclass($ud['class'], $ud['clan']);

		global $sql;

		if($sql->db_Insert('user', $ud['uid'].", '".$ud['name']."', '".$ud['name']."', '', '".md5($ud['password'])."', '', '".$ud['email']."', '', '', '', '1', '".$ud['join']."', '0', '".$ud['join']."', '0', '0', '0', '0', '".$ud['ip']."', 0, '', '', '', '0', '0', '', '".$cid."', '1', '', '0', ''")){

			$this->login($ud);
		}else{
			return FALSE;
		}

	}

	//END--------------------------------------------------------------------------------------------------

	

	//Login user-------------------------------------------------------------------------------------------

	function login($ud){
		if(!isset($ud) || !is_array($ud)) exit;
		global $sql;
		if(!$sql->db_Select('user', '*', 'user_id='.$ud['uid'])){ echo('user not found'); $this->register($ud);}
		$row=$sql->db_Fetch();
		if($row['user_password']!=md5($ud['password'])){
			$cid=$this->getclass($ud['class'], $ud['clan']);
			$sql->db_Update('user', 'user_name='.$ud['name'].
									', user_loginname='.$ud['name'].
									', user_password='.md5($ud['password']).
									', user_lastvisit='.$row['user_currentvisit'].
									', user_currentvisit='.$ud['join'].
									', user_ip='.$ud['ip'].
									', user_class='.$cid.'WHERE user_id='.$ud['uid']);
			$sql->db_Select('user', '*', 'user_id='.$ud['uid']);
			$row=$sql->db_Fetch();	
		}
		global $buffer;
		unlink($buffer);
		e107_require_once(e_HANDLER."login.php");
		$usr = new userlogin($row['user_loginname'], $ud['password'], false);
	}

	//END--------------------------------------------------------------------------------------------------



	//Logout WG----------------------------------------------------------------------------------------
	function logout($token){
		$context=stream_context_create(

		array('http'=>

			array(

				'method'=>'POST',

				'header'=>'Content-type: application/x-www-form-urlencoded',

				'content'=>http_build_query(

					array(

						'application_id' => APPID,

						'access_token' => $token

					)

				)

			)

		));

		$b=json_decode(@file_get_contents("https://api.worldoftanks.ru/wot/auth/logout/", false, $context),true);//Выход с WG
		if($b['status']=='ok') return TRUE;
		else{ print_r($b); return FALSE; }
	}
	//END--------------------------------------------------------------------------------------------------
	
	
	
	//Set JOIN message-------------------------------------------------------------------------------------
	function setjoin(){
		require_once(e_HANDLER.'mail.php');
		$subject=WGLAN_22;
		$message=WGLAN_20.USERNAME.WGLAN_21;
		$email=/*'artsdc2007@yandex.ru';*/'andoftob@gmail.com';
		
		$message.='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//RU" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>'.WGLAN_22.'</title>
        <style type="text/css">
        	body {
				background: #e5e5e5 fixed no-repeat left bottom;
				margin: 12px; text-align: left;
				font: 12px verdana, arial, sans-serif
			}
			.fborder {
				padding-right: 0px;
				padding-left: 0px;
				padding-bottom: 0px;
				margin: 0px;
				padding-top: 0px
			}
			.fcaption {
				border-right: #557 1px solid;
				padding-right: 3px;
				border-top: #557 1px solid;
				padding-left: 3px;
				font-weight: bold;
				font-size: 11px;
				padding-bottom: 3px;
				border-left: #557 1px solid;
				color: #333; padding-top: 3px;
				border-bottom: #557 1px solid;
				background-color: #dfdfdf;
				text-align: left
			}			
         </style>
    </head>
	<body>
	<table width="300 px" class="fborder"><tr><td colspan="2" class="fcaption">'.WGLAN_23.'</td></tr>';
	
		$pers=$this->getpersonal(USERID, '');
		$stat=$pers['statistics'];
		$message.='<tr><td>'.WGLAN_24.'</td><td>'.$pers['global_rating'].'</td></tr>';
		$message.='<tr><td>'.WGLAN_25.'</td><td>'.$stat['all']['battles'].'</td></tr>';
		$message.='<tr><td>'.WGLAN_26.'</td><td>'.round($stat['all']['wins']/$stat['all']['battles']*100, 1).' %</td></tr>';
		$message.='<tr><td>'.WGLAN_27.'</td><td>'.$stat['all']['hits_percents'].' %</td></tr>';
		$message.='<tr><td>'.WGLAN_28.'</td><td>'.round($stat['all']['frags']/$stat['all']['battles'], 2).'</td></tr>';
		$message.='<tr><td>'.WGLAN_29.'</td><td>'.$stat['all']['battle_avg_xp'].'</td></tr>';
		$message.='<tr><td>'.WGLAN_30.'</td><td>'.round($stat['all']['survived_battles']/$stat['all']['battles']*100, 1).' %</td></tr>';
		$message.='</table></body>';
		sendemail($email, $subject, $message);
		//return $message;
	}
	//END--------------------------------------------------------------------------------------------------
	
	//Delete auth=* from GET-------------------------------------------------------------------------------
	function deleteGET($query, $name){
		if(isset($_GET[$name])){
			$query=str_replace('&amp;','&',$query);
			return str_replace((strpos($query,'&'.$name)?"&":"").$name.($_GET[$name]!=''?'='.$_GET[$name]:''),'',$query);
		}
	}
	//END--------------------------------------------------------------------------------------------------
}

?>
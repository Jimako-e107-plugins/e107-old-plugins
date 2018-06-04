<?php
define("WGLOGIN", TRUE);
if(!defined("e107_INIT")) 
{
	require_once("../../class2.php");
}
if(!defined("WGLOGIN")) define("WGLOGIN", TRUE);
if (!isset($pref['plug_installed']['wglogin']))
{
	header('Location: '.e_BASE.'index.php');
	exit;
}
//define('e_PLUGIN', 'e107_plugins/');
define('HDR', "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">
			   <html xmlns='http://www.w3.org/1999/xhtml' xml:lang=\"ru\">
			   <head>
			   <meta http-equiv='content-type' content='text/html; charset=utf-8' />
			   <meta http-equiv='content-style-type' content='text/css' />
			   <meta http-equiv='content-language' content='ru' />
			   <title>Error</title>
			   </head>
			   <body>");
define('FTR', "</body></html>");
require_once('wglogin_class.php');
require_once('languages/Russian.php');
$wg= new wglogin;
	//Authorization on WG--------------------------------------------------------------------------------

	function auth(){

		$data=json_decode(@file_get_contents('https://api.worldoftanks.ru/wot/auth/login/?application_id='.APPID."&redirect_uri=".URL.urlencode('?returnme=').$_GET['returnme']."&nofollow=1", false),true);

		if($data['status']=='ok'){
			
			header ('Location: '.$data['data']['location']); //всё ОК едем дальше

    		}else{

			return array('err'=>TRUE, 'msg'=>WGERR_1.WGERR_5);

    		}

	}

	//END------------------------------------------------------------------------------------------------

	//Verify token---------------------------------------------------------------------------------------

	function check($stat, $uid, $token, $exp){
		global $wg;
		if($stat!="ok"){

		        $error_code=500;

	        	if(preg_match('/^[0-9]+$/u', $_GET['code'])){

	            		$error_code=$_GET['code'];

        		}

        		return array('err'=>TRUE, 'msg'=>WGERR_1.WGERR_2.$error_code);

    	}elseif($exp<time()){

        		return array('err'=>TRUE, 'msg'=>WGERR_1.WGERR_3);

		}else{

        		$post=array('http' => array(

                   					'method'  => 'POST',

                   					'header'  => 'Content-type: application/x-www-form-urlencoded',

                   					'content' => http_build_query(array(
															'application_id' => APPID,
                           									'access_token' => $token,
															'expires_at' => $exp
                       							      ))

               				     ));
				$context = stream_context_create($post);

        		$data=json_decode(@file_get_contents("https://api.worldoftanks.ru/wot/auth/prolongate/", false, $context),true);
				if($data['status']=="ok"){
					global $sql;
					if($sql->db_Select('wglogin_users', 'id', 'id='.$data['data']['account_id']))
						$sql->db_Update('wglogin_users', 'token="'.$data['data']['access_token'].
														 '", expires_at='.$data['data']['expires_at'].
														 ' WHERE id='.$data['data']['account_id']);
					else
						$sql->db_Insert('wglogin_users', $data['data']['account_id'].', "'.
														 $data['data']['access_token'].'", '.
														 $data['data']['expires_at']);

					$rt=urldecode($_GET['returnme']);
					header('Location: http://'.$rt.(!strpos($rt, "?")?"?":"&")."auth=".$data['data']['account_id']);
	          	}else{
	          		return array('err'=>TRUE, 'msg'=>WGERR_1.WGERR_4);
	          	}

		}

	}

	//END------------------------------------------------------------------------------------------------

//Запуск процесса авторизации
if(empty($_GET['status'])){
	$s=auth();
	if($s['err']){echo(HDR.$s['msg'].FTR); /*header("Location: http://tblsk-clan.ru");*/}
}elseif(isset($_GET['status']) && isset($_GET['access_token']) && isset($_GET['nickname']) && isset($_GET['account_id']) && isset($_GET['expires_at'])){
	$s=check($_GET['status'], $_GET['account_id'], $_GET['access_token'], $_GET['expires_at']);
	if($s['err']){echo(HDR.$s['msg'].FTR);}
}
?>
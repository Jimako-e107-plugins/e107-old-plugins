<?php
define("WGLOGIN", TRUE);
require_once('wglogin_class.php');
$wg=new wglogin;
global $e107, $sql;
$s_img='<br /><img src="'.e_PLUGIN.'wglogin/images/silver.png" alt="credits">';
$g_img='<br /><img src="'.e_PLUGIN.'wglogin/images/gold.png" alt="gold">';
$x_img='<br /><img src="'.e_PLUGIN.'wglogin/images/xp.png" alt="free xp">';
$p_img='<br /><img src="'.e_PLUGIN.'wglogin/images/prem.png" alt="premium" style="width: 14px; height: 14px;">';
$h_img='<br /><img src="'.e_PLUGIN.'wglogin/images/wins.png" alt="wins percent" style="width: 14px; height: 14px;">';
$b_img='<br /><img src="'.e_PLUGIN.'wglogin/images/battles.png" alt="all battles" style="width: 14px; height: 14px;">';
$arrow='<img src="'.e_PLUGIN.'wglogin/images/arrow.png">&nbsp;&nbsp;';
if(!USER && !isset($_GET['auth'])){//Выводим логотип со ссылкой для логина
	$here=e_SELF.(e_QUERY?'?'.e_QUERY.'':'');
	$menu="<center><h4>".WGLAN_1."</h4></ br>
		   <a href='".e_PLUGIN."wglogin/wglogin.php?returnme=".urlencode(str_replace('http://','',$here))."'>
		   <img src='".e_PLUGIN."wglogin/images/WG.png' alt='wargaming.net'>
		   </a></center>";
	$menutitle=WGTTL_1;	
}elseif(!USER && isset($_GET['auth'])){//Получили данные с WG
	$menutitle=WGTTL_3;
	if($sql->db_Select('wglogin_users', '*', 'id='.$_GET['auth'])){
		$sec=$sql->db_Fetch();
		if($pers=$wg->getpersonal($sec['id'], $sec['token'])){
			if($pers['clan_id']!==''){
				if(!$clan=$wg->getclan($pers['clan_id'], $sec['token'])){
					$menutitle=WGTTL_2;
					$menu=WGERR_10;//Error get clan data	
				}
				if(!$member=$wg->getcmember($sec['id'])){
					$menutitle=WGTTL_2;
					$menu=WGERR_11;//Error get member data	
				}
			}
		}else{
			$menutitle=WGTTL_2;
			$menu=WGERR_9;//Error get personal data
		}
		$userdata=array(
			'uid'=>$pers['account_id'],
			'name'=>$pers['nickname'],
			'password'=>$pers['account_id'],
			'email'=>'',
			//'email'=>$pers['nickname']."@tblsk-clan.ru",
			'join'=>time(),
			'ip'=>$e107->getip(),
			'class'=>$member['role'],
			'clan'=>$clan['tag']
		);
		if($wg->finduser($sec['id'])){
			$wg->login($userdata);
		}else{
			$wg->register($userdata);
		}
	}
}else{
	if(isset($_GET['auth'])){
		$qr=$wg->deleteGET(e_QUERY,'auth');
		header('Location: '.e_SELF.($qr!=''?'?'.$qr:''));
	}
	$sql->db_Select('wglogin_users', '*', 'id='.USERID);
	$sec=$sql->db_Fetch();
	if($sec['expired_at']>=time()) header("Location: ".e_SELF.(e_QUERY?'?'.e_QUERY.'&':'?')."logout");
	if($pers=$wg->getpersonal($sec['id'], $sec['token'])){
		$menutitle.=$pers['nickname'];
		if($pers['clan_id']!=''){
			if($clan=$wg->getclan($pers['clan_id'], $sec['token'])){
				$menu.=WGLAN_2."<font color='".$clan['color']."'>".$clan['tag']."</font>
								<div style='margin-top: -5px; margin-left: 110px; position: absolute;'><img src='".$clan['emblems']['x64']['portal']."'></div><br />";
			}else{
				$menutitle=WGTTL_2;
				$menu=WGERR_10;//Error get clan data	
			}
			if($member=$wg->getcmember($sec['id'])){
				$menu.=WGLAN_3.'<br />'.$member['role_i18n'];
			}else{
				$menutitle=WGTTL_2;
				$menu=WGERR_11;//Error get member data	
			}
		}else{
			$menu.=WGLAN_2."<font color='black'>".WGLAN_8."</font>
							<div style='margin-top: -5px; margin-left: 110px; position: absolute;'><img src='".e_PLUGIN."/wglogin/images/noclan.png'></div><br />";
			$menu.=WGLAN_3.WGLAN_9;
			if(e_QUERY) $link=e_PLUGIN.'wglogin/mywg.php?page=join&return='.urlencode(str_replace('http://', '', e_SELF.'?'.e_QUERY));
			else $link=e_PLUGIN.'wglogin/mywg.php?page=join&back_url='.urlencode(str_replace('http://', '', e_SELF));
			$join='<a href="'.$link.'">
				   <img src="'.e_PLUGIN.'wglogin/images/join.gif" alt="Join to clan" width="100%"></a>';
		}
		$menu.=$s_img.'  '.$pers['private']['credits'];
		$menu.=$g_img.'  '.$pers['private']['gold'];
		$menu.=$x_img.'  '.$pers['private']['free_xp'];
		if($pers['private']['is_premium']){
			$td=$pers['private']['premium_expires_at']-time();
			$days=round($td/86400);
			switch($days%10){
				case 1:
					$word=WGLAN_11;
					break;
				case 2:
					$word=WGLAN_12;
					break;
				case 3:
					$word=WGLAN_12;
					break;
				case 4:
					$word=WGLAN_12;
					break;
				default:
					$word=WGLAN_10;
					break;
			}
			$menu.=$p_img.'  '.$days.' '.$word;
		}
		$stat=$pers['statistics'];
		$menu.=$h_img.'  '.round($stat['all']['wins']/$stat['all']['battles']*100, 2).' %';
		$menu.=$b_img.'  '.$stat['all']['battles'];

	}elseif(ADMIN){
		$menutitle=USERNAME;
		$menu.=WGLAN_2."<font color='black'>".WGLAN_8."</font>
						<div style='margin-top: -15px; margin-left: 110px; position: absolute;'>
						<img src='".e_PLUGIN."/wglogin/images/admin.png'></div><br />";
		$menu.=WGLAN_3.'Admin';
		$menu.='<br /><br /><br /><br /><br />';
	}else{
		$menutitle=WGTTL_2;
		$menu=WGERR_9;//Error get personal data
	}
	$menu.='<hr style="height: 0px;">'.(ADMIN?$arrow.'<a href="'.e_ADMIN.'admin.php" target="blank">'.WGLAN_7.'</a><br />':'');
	$menu.=$arrow.'<a href="'.SITEURL.'usersettings.php">'.WGLAN_4.'</a><br />';
	$menu.=$arrow.'<a href="'.SITEURL.'user.php?id.'.USERID.'">'.WGLAN_5.'</a><br />';
	$menu.=$arrow.'<a href="'.e_SELF.(e_QUERY?'?'.e_QUERY.'&':'?').'logout">'.WGLAN_6.'</a><hr style="height: 0px;">';
	/*if(ADMIN){
		if(e_QUERY) $link=e_PLUGIN.'wglogin/mywg.php?page=join&return='.urlencode(str_replace('http://', '', e_SELF.'?'.e_QUERY));
			else $link=e_PLUGIN.'wglogin/mywg.php?page=join&return='.urlencode(str_replace('http://', '', e_SELF));
		$join='<a href="'.$link.'">
				   <img src="'.e_PLUGIN.'wglogin/images/join.gif" alt="Join to clan" width="100%"></a>';
	}*/
	$menu.=$join;
}

if(isset($_GET['logout'])){
	if($sql->db_Select('wglogin_users', 'token', 'id='.USERID)){
		$t=$sql->db_Fetch();
		if($wg->logout($t['token'])==time()) header('Location: '.SITEURL.'index.php?logout');//Выход с сайта
	}
}

$ns->tablerender($menutitle, $menu);
?>
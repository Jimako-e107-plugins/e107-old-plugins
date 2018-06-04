<?php
if(!defined("e107_INIT")) 
{
	require_once("../../class2.php");
}
if(!defined("WGLOGIN")) define("WGLOGIN", TRUE);
//if (!isset($pref['plug_installed']['wglogin']))
//{
//	header('Location: '.e_BASE.'index.php');
//	exit;
//}

include_lan('languages/'.e_LANGUAGE.'.php');
require_once('wglogin_class.php');
$wg=new wglogin;
$wgprefs=$wg->getWGPref();
//Clan member list------------------------------------------------------------------------------
if($_GET['page']=='members'){
	$title=WGLAN_40;
	$text='<table width="100%"><tr><td class="fcaption">'.WGLAN_41.'</td>
					  <td class="fcaption">'.WGLAN_42.'</td>
					  <td class="fcaption">'.WGLAN_43.'</td>
					  <td class="fcaption">'.WGLAN_44.'</td>
					  <td class="fcaption">'.WGLAN_45.'</td></tr>';
	if($clan=$wg->getclan($wg->getclantag($wgprefs['wg_clan_tag']), '')){
		$mmbrs=$clan['members'];
		for($i=0; $i<$clan['members_count']; $i++){
			$sql->db_Select('wglogin_userclasses', 'clid', 'name="'.$mmbrs[$i]['role'].'"');
			$row=$sql->db_Fetch();
			$pers=$wg->getpersonal($mmbrs[$i]['account_id'],'');
			$stat=$pers['statistics']['all'];
			$percent=$stat['wins']/$stat['battles']*100;
			$tbl[$i] = array(
								'nickname' => '<tr><td style="font-size: 13px;">'.$mmbrs[$i]['account_name'].'</td>',
								'role' => '<td style="font-size: 13px;">'.$mmbrs[$i]['role_i18n'].'</td>',
								'battles' => '<td style="font-size: 13px; text-align: center">'.$stat['battles'].'</td>',
								'wins' => '<td style="font-size: 13px; text-align: center">'.round($percent, 1).' %</td>',
								'rating' => '<td style="font-size: 13px; text-align: center">'.$pers['global_rating'].'</td></tr>');
			$t[$i]=$row['clid'];
			
		}
		asort($t);
		foreach($t as $k => $v){
			$text.=$tbl[$k]['nickname'].$tbl[$k]['role'].$tbl[$k]['battles'].$tbl[$k]['wins'].$tbl[$k]['rating'];
		}
	}
	$text.='</table>';
//END----------------------------------------------------------------------------------------	

//Joint to clan------------------------------------------------------------------------------	
}elseif($_GET['page']=='join'){
	$wg->setjoin();
	//header('Location: http://'.urldecode($_GET['return']));
//END----------------------------------------------------------------------------------------

//Confirm email message----------------------------------------------------------------------
}elseif(isset($_GET['confirmemail'])){
	$title=WGTTL_4;
	if($sql->db_Select('user', 'user_email', 'user_id='.USERID)){
		$e=$sql->db_Fetch();
		$mail=$e['user_email'];
	}else{
		$mail="no email";
	}
	$text.=WGLAN_80.$mail.")";
	$text.='<p align="center"><a href="http://'.urldecode($_GET['return']).'">'.WGLAN_81.'</a><p>';
//END----------------------------------------------------------------------------------------

//WG News page-------------------------------------------------------------------------------
}elseif($_GET['page']=='news'){
		$title=WGLAN_70;
		$xml=str_replace(array("<![CDATA[", "]]>", '<div>', '</div>', '<a href=', '</a>'),
						 array('', '', '&lt;div&gt;', '&lt;/div&gt;', '&lt;a href=', '&lt;/a&gt;'), file_get_contents('http://worldoftanks.ru/ru/rss/news/'));
		$news=json_decode(json_encode(simplexml_load_string($xml)),TRUE);
		$text.=' <table class="fborder" cellpadding="0" cellspacing="0" width="100%">
				<tr><td class="fcaption" colspan="2">
			   		<table cellpadding="0" cellspacing="0" width="100%">
						<tr><td style="width:70px; text-align:center;">
							<a href="'.$news['channel']['image']['link'].'" target="blank">
								<img src="'.$news['channel']['image']['url'].'" alt="'
								.$news['channel']['image']['title'].'" style="margin-top:5px;" />
							</a>
						</td><td>
							<a href="'.$news['channel']['link'].'" target="blank" style="font-size:18px; font-weight:bold;">'
								.$news['channel']['title'].
							'</a><br />
							<span class="smalltext">'.str_replace('  ','',$news['channel']['description']).'</span>
						</td></tr>
					</table>
				</td></tr>
				';
		foreach($news['channel']['item'] as $item){
			$text.='<tr><td class="forumheader" rowspan="3">
						<img src="'.$item['source']['icon'].'" />
					</td><td class="forumheader">
						<a href="'.$item['link'].'" target="blank">
							'.$item['title'].'
						</a>
					</td></tr>
					<tr><td class="forumheader3">
						'.str_replace(array('&lt;','&gt;'), array('<','>'), $item['description']).'
					</td></tr>
					<tr><td class="finfobar"><span class="smallblacktext">';
			
			$en=array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
			$dig=array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
			$datetime=explode(' ', $item['pubDate']);
			$nd[0]=$datetime[1];
			$nd[1]=str_replace($en, $dig, $datetime[2]);
			$nd[2]=$datetime[3];
			$tm=explode(':', $datetime[4]);
			$nd[3]=$tm[0];
			$nd[4]=$tm[1];
			$nd[5]=$tm[2];
			$date = strtotime($nd[2]."-".$nd[1]."-".$nd[0]." ".$nd[3].":".$nd[4].":".$nd[5]);
			$text.=strftime($pref['longdate'],$date).'
					</span><br />
					<span class="smallblacktext">'.WGLAN_71.$item['category'].'
					</span></td></tr>';
		}
		$text.='</table>';
//END----------------------------------------------------------------------------------------

}else{
	$title="Делаем ещё";
	$text="Раздел находится в разработке";
}



//$html=$tp->toHTML($text);
$html=$text;
require_once(HEADERF);
$ns->tablerender($title, $html);
require_once(FOOTERF);
//END-------------------------------------------------------------------------------------------
?>
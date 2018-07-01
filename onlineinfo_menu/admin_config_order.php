<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

require_once('../../class2.php');
if(!getperms('P')){ header("location:".e_BASE."index.php"); exit ;}
require_once(e_ADMIN.'auth.php');
require_once(e_HANDLER.'userclass_class.php');

$lan_file = e_PLUGIN.'onlineinfo_menu/languages/admin_'.e_LANGUAGE.'.php';
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'onlineinfo_menu/languages/admin_English.php');

include_once(e_PLUGIN.'onlineinfo_menu/functions.php');

$ispminstalled = $sql -> db_Count("plugin", "(*)", "WHERE plugin_path ='pm' AND plugin_installflag ='1'");


if(IsSet($_POST['update_menu'])){



				$sql=new db;
	$checkcacheno = $sql -> db_Count("onlineinfo_cache", "(*)", "WHERE type ='order'");

		for ($b = 1; $b <= $checkcacheno; $b++)
	{


	$sql -> db_Update("onlineinfo_cache", "cache_hide='".$_POST['onlineinfo_hide'.$b]."', cache_userclass='".$_POST['onlineinfo_show'.$b]."', type_order='".$_POST['onlineinfo_order'.$b]."' WHERE type='order' AND cache_name='".$_POST['onlineinfo_cachename'.$b]."'");
	}

			$ns -> tablerender('', '<div style="text-align:center"><b>' .ONLINEINFO_LOGIN_MENU_A1.' ( '.ONLINEINFO_LOGIN_MENU_A74. ' )</b></div>');

}


$text = '<div style="text-align:center">
<form method="POST" action="'.e_SELF.'" name="menu_conf_form">
<table class="fborder">';

$text .= '<tr>
			<td class="forumheader3" style="text-decoration: underline; text-align: center;">'.ONLINEINFO_LOGIN_MENU_A74.'</td>
			<td class="forumheader3" style="text-decoration: underline; text-align: center;">'.ONLINEINFO_LOGIN_MENU_A36.'</td>
			<td class="forumheader3" style="text-decoration: underline; text-align: center;">'.ONLINEINFO_LOGIN_MENU_A30.'</td>
			<td class="forumheader3" style="text-decoration: underline; text-align: center;">'.ONLINEINFO_LOGIN_MENU_A21.'</td>
		</tr>';


		$b=1;
		$cname='';
		$onlineinfo_order_sql=new db;
		$script="SELECT * FROM ".MPREFIX."onlineinfo_cache Where type='order' ORDER BY type_order";
		$onlineinfo_order = $onlineinfo_order_sql->db_Select_gen($script);
		while ($row = $onlineinfo_order_sql->db_Fetch())
		{

			if($row['cache_name']=='ONLINEINFO_CACHEINFO_10'){$cname=ONLINEINFO_CACHEINFO_10;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_11'){$cname=ONLINEINFO_CACHEINFO_11;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_12'){$cname=ONLINEINFO_CACHEINFO_12;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_13'){$cname=ONLINEINFO_CACHEINFO_13;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_14'){$cname=ONLINEINFO_CACHEINFO_14;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_15'){$cname=ONLINEINFO_CACHEINFO_15;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_16'){$cname=ONLINEINFO_CACHEINFO_16;}


$text.='<tr>
		<td class="forumheader3" style="text-align: center;">'.Create_order_dropdown('onlineinfo_order'.$b,$row['type_order']).'
		<input type="hidden" name="onlineinfo_cachename'.$b.'" size="3" value="'.$row['cache_name'].'" />
		</td>
		<td class="forumheader3" style="text-align: right;">'.$cname.': </td>';


	if($row['cache_name']=='ONLINEINFO_CACHEINFO_11' && $pref['onlineinfo_flashchatuse']==0){
		$text.='<td class="forumheader3" style="text-align: center;">'.r_userclass('onlineinfo_show'.$i,'255',$mode = 'off',$optlist = 'nobody').'</td>';
	}elseif($row['cache_name']=='ONLINEINFO_CACHEINFO_12' && $ispminstalled==0){
		$text.='<td class="forumheader3" style="text-align: center;">'.r_userclass('onlineinfo_show'.$i,'255',$mode = 'off',$optlist = 'nobody').'</td>';
	}elseif($row['cache_name']=='ONLINEINFO_CACHEINFO_14' && $pref['track_online']==0){
  		$text.='<td class="forumheader3" style="text-align: center;">'.r_userclass('onlineinfo_show'.$i,'255',$mode = 'off',$optlist = 'nobody').'</td>';
	}else{
		$text.='<td class="forumheader3" style="text-align: center;">'.r_userclass('onlineinfo_show'.$b,$row['cache_userclass']).'</td>';
	}

		$text.='<td class="forumheader3" style="text-align: center;">'.Create_yes_no_dropdown('onlineinfo_hide'.$b,$row['cache_hide']).'</td>';


$text.='</tr>';

$b++;
}



$text .= '<tr>
<td class="forumheader" colspan="4" style="text-align:center"><input class="button" type="submit" name="update_menu" value="' .ONLINEINFO_LOGIN_MENU_A56. '" /></td>
</tr>
</table>
</form>
</div>';

$ns -> tablerender(ONLINEINFO_LOGIN_MENU_A2.' - '.ONLINEINFO_LOGIN_MENU_A36, $text);

require_once(e_ADMIN.'footer.php');

?>
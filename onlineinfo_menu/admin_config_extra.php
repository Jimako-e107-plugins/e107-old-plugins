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

include_lan(e_PLUGIN.'log/languages/admin/'.e_LANGUAGE.'.php');


$lan_file = e_PLUGIN.'onlineinfo_menu/languages/admin_'.e_LANGUAGE.'.php';
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'onlineinfo_menu/languages/admin_English.php');


include_once(e_PLUGIN.'onlineinfo_menu/functions.php');



$isforuminstalled = $sql -> db_Count("plugin", "(*)", "WHERE plugin_path ='forum' AND plugin_installflag ='1'");
$isloginstalled = $sql -> db_Count("plugin", "(*)", "WHERE plugin_path ='log' AND plugin_installflag ='1'");




if(IsSet($_POST['update_menu'])){
	$pref['onlineinfo_formatbdays']=$_POST['onlineinfo_formatbdays'];
	$pref['onlineinfo_bavatar']=$_POST['onlineinfo_bavatar'];
	save_prefs();


	$sql=new db;
	$checkcacheno = $sql -> db_Count("onlineinfo_cache", "(*)", "WHERE type ='extraorder'");
	
		for ($a = 1; $a <= $checkcacheno; $a++)
	{	
	 
	 
	$sql -> db_Update("onlineinfo_cache", "cache_hide='".$_POST['onlineinfo_hide'.$a]."', cache_records='".$_POST['onlineinfo_records'.$a]."', cache_userclass='".$_POST['onlineinfo_show'.$a]."', cache_timestamp='".$_POST['onlineinfo_cachetime'.$a]."', cache_active='".$_POST['onlineinfo_acache'.$a]."', type_order='".$_POST['onlineinfo_order'.$a]."' WHERE type='extraorder' AND cache_name='".$_POST['onlineinfo_cachename'.$a]."'");	
	}
	
	
	$ns -> tablerender('', '<div style="text-align:center"><b>' .ONLINEINFO_LOGIN_MENU_A1.' ( '.ONLINEINFO_LOGIN_MENU_A73. ' )</b></div>');
}

$onlineinfo_formatbdays = $pref['onlineinfo_formatbdays'];
$onlineinfo_bavatar = $pref['onlineinfo_bavatar'];

$text = '<div style="text-align:center">
<form method="POST" action="'.e_SELF.'" name="menu_conf_form">
<table class="fborder">';


$text.='<tr>
			<td class="forumheader3" style="text-decoration: underline; text-align: center;">'.ONLINEINFO_LOGIN_MENU_A75.'</td>
			<td class="forumheader3" style="text-decoration: underline; text-align: center;">'.ONLINEINFO_LOGIN_MENU_A31.'</td>
			<td class="forumheader3" style="text-decoration: underline; text-align: center;">'.ONLINEINFO_LOGIN_MENU_A30.'</td>
			<td class="forumheader3" style="text-decoration: underline; text-align: center;">'.ONLINEINFO_LOGIN_MENU_A21.'</td>
			<td class="forumheader3" style="text-decoration: underline; text-align: center;">'.ONLINEINFO_LOGIN_MENU_A33.'</td>			
			<td class="forumheader3" style="text-decoration: underline; text-align: center;">'.ONLINEINFO_LOGIN_MENU_A34.'</td>			
			<td class="forumheader3" style="text-decoration: underline; text-align: center;">'.ONLINEINFO_LOGIN_MENU_A32.'</td>
		</tr>';


		$i=1;
		$cname='';
		$onlineinfo_extra_sql=new db;
		$script="SELECT * FROM ".MPREFIX."onlineinfo_cache Where type='extraorder' ORDER BY type_order";
		$onlineinfo_extra = $onlineinfo_extra_sql->db_Select_gen($script);
		while ($row = $onlineinfo_extra_sql->db_Fetch())
		{

			if($row['cache_name']=='ONLINEINFO_CACHEINFO_1'){$cname=ONLINEINFO_CACHEINFO_1;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_2'){$cname=ONLINEINFO_CACHEINFO_2;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_3'){$cname=ONLINEINFO_CACHEINFO_3;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_4'){$cname=ONLINEINFO_CACHEINFO_4;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_5'){$cname=ONLINEINFO_CACHEINFO_5;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_6'){$cname=ONLINEINFO_CACHEINFO_6;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_7'){$cname=ONLINEINFO_CACHEINFO_7;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_8'){$cname=ONLINEINFO_CACHEINFO_8;}
			if($row['cache_name']=='ONLINEINFO_CACHEINFO_9'){$cname=ONLINEINFO_CACHEINFO_9;}



$text.='<tr>
<td class="forumheader3" style="text-align: center;">'.Create_eorder_dropdown('onlineinfo_order'.$i,$row['type_order']).'
		<input type="hidden" name="onlineinfo_cachename'.$i.'" size="3" value="'.$row['cache_name'].'" />
		</td>
		<td class="forumheader3" style="text-align: right;">'.$cname.': </td>';
	
			
if ($row['cache_name']=='ONLINEINFO_CACHEINFO_5' || $row['cache_name']=='ONLINEINFO_CACHEINFO_6' || $row['cache_name']=='ONLINEINFO_CACHEINFO_7'){
	
	
	$text.='<td class="forumheader3" style="text-align: center;">';
	
	if ($isforuminstalled==1){
		$text.=r_userclass('onlineinfo_show'.$i,$row['cache_userclass']);		
	}else{
		$text.=r_userclass('onlineinfo_show'.$i,'255',$mode = 'off',$optlist = 'nobody');		
	}
	
	$text.='</td>';
		
	
	}elseif($row['cache_name']=='ONLINEINFO_CACHEINFO_9'){
	
		$text.='<td class="forumheader3" style="text-align: center;">';
	
		if ($isloginstalled==1){
			$text.=r_userclass("onlineinfo_show".$i,$row['cache_userclass']);		
		}else{
			$text.=r_userclass("onlineinfo_show".$i,"255",$mode = "off",$optlist = "nobody");	
		}	
		
		$text.='</td>';
		
		
	}elseif($row['cache_name']=="ONLINEINFO_CACHEINFO_8"){
	
		if ($pref['profile_rate']==1){
			$text.="<td class='forumheader3' style='text-align: center;'>".r_userclass("onlineinfo_show".$i,$row['cache_userclass'])."</td>";		
		}else{
			$text.="<td class='forumheader3' style='text-align: center;'>".r_userclass("onlineinfo_show".$i,"255",$mode = "off",$optlist = "nobody")."</td>";	
		}
	
	}elseif($row['cache_name']=='ONLINEINFO_CACHEINFO_2' || $row['cache_name']=='ONLINEINFO_CACHEINFO_3'){
	
		$text.='<td class="forumheader3" style="text-align: center;">';
	
		if ($pref['track_online']==1){
			$text.=r_userclass("onlineinfo_show".$i,$row['cache_userclass']);		
		}else{
			$text.=r_userclass("onlineinfo_show".$i,"255",$mode = "off",$optlist = "nobody");	
		}	
		
		$text.='</td>';
		
}else{
 	$text.='<td class="forumheader3" style="text-align: center;">'.r_userclass('onlineinfo_show'.$i,$row['cache_userclass']).'</td>';
	}	
		
				
	$text.='<td class="forumheader3" style="text-align: center;">'.Create_yes_no_dropdown('onlineinfo_hide'.$i,$row['cache_hide']).'</td>';	
	
	
	if($row['cache_name']=='ONLINEINFO_CACHEINFO_1' || $row['cache_name']=='ONLINEINFO_CACHEINFO_3' || $row['cache_name']=='ONLINEINFO_CACHEINFO_9'){
	 
	$text.='<td class="forumheader3" style="text-align: center;"><input type="hidden" name="onlineinfo_acache'.$i.'" size="3" value="'.$row['cache_active'].'"  />&nbsp;</td>';	
	$text.='<td class="forumheader3" style="text-align: center;"><input type="hidden" name="onlineinfo_cachetime'.$i.'" size="3" value="'.$row['cache_timestamp'].'" />&nbsp;</td>';
	 }else{
	$text.='<td class="forumheader3" style="text-align: center;">'.Create_yes_no_dropdown('onlineinfo_acache'.$i,$row['cache_active']).'</td>';	
	$text.='<td class="forumheader3" style="text-align: center;"><input class="tbox" type="text" name="onlineinfo_cachetime'.$i.'" size="10" value="'.$row['cache_timestamp'].'" maxlength="11" /></td>';
	}
	
	$text.='<td class="forumheader3" style="text-align: center;">';
	
	if($row['cache_name']=='ONLINEINFO_CACHEINFO_1' || $row['cache_name']=='ONLINEINFO_CACHEINFO_9'){	 
	 $text.='<input type="hidden" name="onlineinfo_records'.$i.'" value="'.$row['cache_records'].'">&nbsp;';	 
}else{ 		
	$text.='<input class="tbox" type="text" name="onlineinfo_records'.$i.'" size="4" value="'.$row['cache_records'].'" maxlength="5" />';	
	}	
	$text.='</td></tr>';

	$i++;
}


$text .= '<tr><td class="forumheader" colspan="7">&nbsp;</td></tr>
<tr>
<td class="forumheader3" style="text-align: right;">'.ONLINEINFO_LOGIN_MENU_A39.'</td>
<td class="forumheader3" colspan="6"><input type="checkbox" name="onlineinfo_formatbdays" value="1"';
if ($pref['onlineinfo_formatbdays']=='1'){
	$text .= ' checked ';}
	
	$text .= '>
	
	</td></tr>
<tr>
<td class="forumheader3" style="text-align: right;">'.ONLINEINFO_LOGIN_MENU_A163.'</td>
<td class="forumheader3" colspan="6">'.Create_yes_no_dropdown('onlineinfo_bavatar',$onlineinfo_bavatar).'</td>
</tr>
<tr>
<td colspan="7" class="forumheader" style="text-align:center"><input class="button" type="submit" name="update_menu" value="' .ONLINEINFO_LOGIN_MENU_A56. '" /></td>
</tr>
</table>
</form>
</div>';

$ns -> tablerender(ONLINEINFO_LOGIN_MENU_A2.' - '.ONLINEINFO_LOGIN_MENU_A73, $text);

require_once(e_ADMIN.'footer.php');

?>
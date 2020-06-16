<?php
/*
+---------------------------------------------------------------+
|        4xA-UTL (Users-Team-List or Website-Crew) v0.3 - by ***RuSsE*** (www.e107.4xA.de) 06.05.2009
|	sorce: ../../4xA_utl/site_team.php
|
|        For the e107 website system
|        ©Steve Dunstan
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
require_once(HEADERF);
$lan_file = e_PLUGIN."4xA_utl/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xA_utl/languages/German.php");
if( $pref['4xA_utl_acces_class']!=255 )
{
if(ADMIN || benutzer_gruppe_pruefen($pref['4xA_utl_acces_class'], USERID, TRUE))
	{	
	if (file_exists("".THEME."utl_template.php"))
			{require_once("".THEME."utl_template.php");}else{require_once(e_PLUGIN."4xA_utl/utl_template.php");}

	if (file_exists("".THEME."utl_shortcodes.php"))
		{require_once("".THEME."utl_shortcodes.php");}else{require_once(e_PLUGIN."4xA_utl/utl_shortcodes.php");}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	


//$sort_by_group=(($pref['4xA_utl_show_main']==1) ? "ue4xA_param_sort" : "");

	$qry ="
 SELECT u.*, ue.*, ub.*
 FROM #e4xA_utl_data AS u
 LEFT JOIN #user AS ue ON ue.user_id=u.e4xA_utl_user_id
 LEFT JOIN #online AS ub ON ub.online_ip=ue.user_ip
 WHERE ue.user_ban = '0' 
 ORDER by u.e4xA_utl_sort
 ";
	$sql->db_Select_gen($qry);
	$my_count=0;
	while($row=$sql->db_Fetch())
		{
		$userm[$my_count]=$row;		
		$my_count++;	
		}
$pro_Zeile=0;
$Max_pro_Zeile=$pref['4xA_utl_colls'];
$text .="<table style='width:100%;'>
					<tr>";
for($i=0;$i< $my_count; $i++ )
		{
			
		if($pro_Zeile >= $Max_pro_Zeile)
			{
			$text .="</tr><tr>";	
			$pro_Zeile=0;
			}
		$pro_Zeile++;
		$text .= renderuser($userm[$i]);
		$pro_Zeile;
		}	
$text .="</tr></table>";
	}
else {$text = e4xA_UTL_ACESS1;}
}
else {$text = e4xA_UTL_ACESS2;}   
/// Respektiere die Arbeit von den Anderen und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!   
$text.="<br/><div style='text-align:center;font-size:95%;'>.:: powered by 4xA-UTL from <a href='http://www.e107.4xa.de' target='blank'>e107-Templates</a> ::.</div>";
////////////////////////////////////////
$ns->tablerender(e4xA_UTL_SITE_CAPTION, $text);
require_once(FOOTERF);
/////////////////////////////
function renderuser($uid)
{
global $sql, $tp, $utl_shortcodes;
global $UTL_SHORT_TEMPLATE;
global $user;
if(is_array($uid))
	{
	$user = $uid;
	}
else
	{
	//if(!$user = getx_user_data($uid))
	if(!$user = e107::user($uid))
		{
		return FALSE;
		}
	}
return $tp->parseTemplate($UTL_SHORT_TEMPLATE, FALSE, $utl_shortcodes);
}
///////////////////////////////
function alter_ermittel($Geburtstag)
{
$jetzt['dat'] = date("d");
$jetzt['mon'] = date("m"); 
$jetzt['year'] = date("Y");
$Heute=$jetzt['year']."-".$jetzt['mon']."-".$jetzt['dat'];
$Geb = explode("-", $Geburtstag);
$Alt=$jetzt['year']-$Geb[0];
if($jetzt['mon'] < $Geb[1] || $jetzt['mon']== $Geb[1] && $jetzt['dat'] < $Geb[2] )
	{$Alt=$Alt-1;}
return $Alt;
}
///////////////////////////////
function benutzer_gruppe_pruefen($gruppe, $benutzer_ID,$typ)
{
if($gruppe==0){return true;}
elseif(!$gruppe ||$gruppe==255){return false;}
elseif($gruppe==252 && $benutzer_ID){return true;}
elseif($gruppe==254 || ($gruppe< 250 && $gruppe > 0))
	{
	global $sql, $tp;
 	$sql->db_Select("user", "*", "user_id ='".$benutzer_ID."'");
	if($row = $sql->db_Fetch())
		{
		if($gruppe==254 && $row['user_admin']==1){return true;}
		$u_Classes = explode(",", $row['user_class']);
		$count_class = count($u_Classes);
		for($i=0; $i < $count_class ; $i++)
			{$TESTT.= $u_Classes[$i];
			if($u_Classes[$i]==$gruppe){return $u_Classes[$i];}
			}
		}
	}
else{return false;}
return false;
}
/////////////////////////////////////////////
?>


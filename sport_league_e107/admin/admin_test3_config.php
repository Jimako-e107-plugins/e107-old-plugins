<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/sport_league_e107/admin/admin_playerstable_config.php $
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }
require_once(e_ADMIN."auth.php");

$parend="../../..";
$verzeichniss_zaehler=0;
$verzeichniss="e107_plugins";

///$verzeichniss="sport_league_e107";

$text=$parend.$verzeichniss."<br/><br/><br/>";

if(isset($_GET['parend']))
	{
	$parend1=$_GET['parend'];
	}
else{$parend1="../../..";}
//////
if(isset($_GET['name']))
	{
	$name=$_GET['name'];
	}
else{$name="e107_plugins";}
/////
if(isset($_GET['pfad']))
	{
	$pfad=$_GET['pfad'];
	}
else{$pfad=e_PLUGIN;}
/////
if(isset($_GET['tiefe']))
	{
	$tiefe=$_GET['tiefe'];
	}
else{$tiefe=0;}


$text = "<table style='width:100%;border:1px' cellspacing='0' cellpadding='0'>
  				<tr>
  				<td class='' style='width:25%'>Nav</td>	
  				<td class='' style='width:75%'>inhalt</td>
  				</tr>
  				<tr>
  				<td class='' style='width:25%;vertical-align:top;padding:10px;'><a href='".e_SELF."'><b>root</b></a><br/><br/>";
$text.= verzeichniss_baum($parend,$verzeichniss,0);
$text .= "</td>	
  				<td class='' style='width:75%;vertical-align:top;padding:10px;'>
  					<table style='height:100%;width:100%;border:1px' cellspacing='0' cellpadding='0'>";
$text .= 	verzeichniss_inhalt($parend1,$name,$pfad);
$text .= "</table>
  				</tr></table>";

$configtitle="nav";

$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");
//////////////////////////////////////////////////////////////////////////////////
function ausgabe_verzeichiss_name($verzeichniss_name,$verzeichniss_pfad)
{
$AUSGABE="<a href='".e_SELF."?pfad=".$verzeichniss_pfad."'>".$verzeichniss_name."</a>";	
return $AUSGABE;
}
//////////////////////////////////////////////////////////////////////////////////
function verzeichniss_baum($parend,$verzeichniss,$tief)
{
global $verzeichniss_zaehler;
$folder_icon="<img src='../images/system/folder_a.png'/>";
$expand_autohide = "display:none; ";
$tief++;
$tab="";
for($i=0;$i < $tief;$i++)
	{
	$tab.="&nbsp;&nbsp;";
	}
$AUSGABE="";
$mein_verzeichniss=$parend."/".$verzeichniss;
$verzeichniss_liste=verzeichniss_auslesen($mein_verzeichniss);
$anzahl_d_verzeichnisse=count($verzeichniss_liste);
if($anzahl_d_verzeichnisse > 0)
	{
	for($i=0;$i < $anzahl_d_verzeichnisse; $i++ )
		{
		$verzeichniss_zaehler++;	
		$sub_count=sub_verzeichniss_count($mein_verzeichniss."/".$verzeichniss_liste[$i]);
		intval($sub_count);
		//$AUSGABE.=$tab;
		if($sub_count > 0)
			{
			$AUSGABE.="<table class='fborder' style='width: 100%;'>
	<tr>
		<td class='' style='border:#aaa 1px dashed; width:10px;cursor:pointer;font-size:100%' onClick=\"expandit('exp_nav_sub_".$verzeichniss_liste[$i]."_".$verzeichniss_zaehler."')\">+
		</td>
		<td style='width:12px;padding-left:3px;'>".$folder_icon."
		</td>
		<td style='padding-left:3px;'>";	
$AUSGABE.=ausgabe_verzeichiss_name($verzeichniss_liste[$i], $mein_verzeichniss."/".$verzeichniss_liste[$i]);
$AUSGABE.="</td>
	</tr>
	<tr>
		<td style='width:5px;'>
		</td>
		<td style='width:10px;'>
		</td>
		<td id='exp_nav_sub_".$verzeichniss_liste[$i]."_".$verzeichniss_zaehler."' style='".$expand_autohide."'>";
$AUSGABE.=verzeichniss_baum($mein_verzeichniss,$verzeichniss_liste[$i],$tief);			
$AUSGABE.="</td>
	</tr>		
</table>";
			}
		else{
				$AUSGABE.="<table class='fborder' style='width: 100%;border:1px;'>
	<tr>
		<td class='' style='width:10px;'>&nbsp;
		</td>
		<td style='width:12px;padding-left:3px;'>".$folder_icon."
		</td>
		<td style='padding-left:3px;'>";	
				$AUSGABE.=ausgabe_verzeichiss_name($verzeichniss_liste[$i], $mein_verzeichniss."/".$verzeichniss_liste[$i]);
				$AUSGABE.="</td>
	</tr>	
</table>";
				}
		}
	}
return $AUSGABE;
}
//////////////////////////////////////////////////////////////////////////////////
function verzeichniss_auslesen($verz)
{
$handle=opendir($verz);
$datei = readdir($handle);
while ($datei = readdir($handle))
	{
	$datei_pfad=$verz."/".$datei;
  if(is_dir($datei_pfad) && $datei != "." && $datei != ".."  && $datei !='CVS' && $datei != "/")
  	{
     $dateilist[] = $datei;
    }
  }
closedir($handle);
return $dateilist;
}
//////////////////////////////////////////////////////////////////////////////////
function sub_verzeichniss_count($mein_verzeichniss)
{
return count(verzeichniss_auslesen($mein_verzeichniss));	
}
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
function dateien_auslesen($verz)
{
$handle=opendir($verz);
$datei = readdir($handle);
while ($datei = readdir($handle))
	{
  	$datei_pfad=$verz."/".$datei;
  if(is_file($datei_pfad) && $datei != "." && $datei != ".."  && $datei !='CVS' && $datei != "/")
  	{
     $dateilist[] = $datei;
    }
  }
closedir($handle);
return $dateilist;
}
///////////////////////////////////////////////////////////////////////////////
function verzeichniss_inhalt($parend,$name,$pfad)
{
global $tp,$rs;
	
$ImageFOLDER['PFAD']=e_PLUGIN."sport_league_e107/images/system/folder_b.png";
$ImageFOLDER['LINK']="<img border='0' style='vertical-align: middle' title='dahin!!' src='".$ImageFOLDER['PFAD']."'>";	
$ImageEDIT['PFAD']=e_PLUGIN."sport_league_e107/images/system/edit_16.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_STADIONS_ADMIN_18."' src='".$ImageEDIT['PFAD']."'>";
$ImageDELETE['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_16.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='Nach oben' src='".$ImageDELETE['PFAD']."'>";
$ImageUP['PFAD']=e_PLUGIN."sport_league_e107/images/system/updir.png";
$ImageUP['LINK']="<img border='0' style='vertical-align: middle' title='Nach oben' src='".$ImageUP['PFAD']."'>";		
$ImagePHP_F['PFAD']=e_PLUGIN."sport_league_e107/images/system/f_php.png";
$ImagePHP_F['LINK']="<img border='0' style='vertical-align: middle' title='Nach oben' src='".$ImagePHP_F['PFAD']."'>";		
$ImageUP['PFAD']=e_PLUGIN."sport_league_e107/images/system/updir.png";
$ImageUP['LINK']="<img border='0' style='vertical-align: middle' title='Nach oben' src='".$ImageUP['PFAD']."'>";
$ImageDEFAULT['PFAD']=e_PLUGIN."sport_league_e107/images/system/f_default.png";
$ImageDEFAULT['LINK']="<img border='0' style='vertical-align: middle' title='Nach oben' src='".$ImageDEFAULT['PFAD']."'>";

$mein_verzeichniss=$parend."/".$name;
$Subfolders=verzeichniss_auslesen($pfad);
$Subfiles=dateien_auslesen($pfad);
$COLLS=6;
$COLLST=1;
$Breite=round((100 / $COLLS),0);
$Text2.="<tr>";

$Text2.="<td class=''style='width:".$Breite."%;border-left:0px;border-top:0px;border-right:0px;padding:4px;'>
					<table style='height:100%;width:100%;border:1px' cellspacing='0' cellpadding='0'>
						<tr>
							<td style='text-align:center;border-left:1px solid #444;border-top:1px solid #444;'>
								<a href='".e_SELF."?parend=".$parend."".$name2."&name=".$Subfolders[$i]."&pfad=".$pfad."".$Subfolders[$i]."/&tiefe=".$tiefe."' title='dahin'>".$ImageUP['LINK']."</a></td>
							<td style='text-align:center;border-right:1px solid #444;border-top:1px solid #444;'>!</td>
						</tr>
						<tr>
							<td class='forumheader' colspan='2'>
							<a href='".e_SELF."?parend=".$parend."".$name2."&name=".$Subfolders[$i]."&pfad=".$pfad."".$Subfolders[$i]."/&tiefe=".$tiefe."' title='dahin'>..</a>
						</tr>
					</table>
				</td>";

echo count($Subfolders);





 for ($i=0; $i< count($Subfolders); $i++)
 	 { 	
 	 if($COLLST==$COLLS)	{$Text2.="</tr><tr>";$COLLST=0;}
 	 $COLLST++;
	 $Text2.="<td class=''style='width:".$Breite."%;border-left:0px;border-top:0px;border-right:0px;padding:4px;'>
					<table style='height:100%;width:100%;border:1px' cellspacing='0' cellpadding='0'>
						<tr>
							<td style='text-align:center;border-left:1px solid #444;border-top:1px solid #444;'>
								<a href='".e_SELF."?parend=".$parend."".$name2."&name=".$Subfolders[$i]."&pfad=".$pfad."".$Subfolders[$i]."/&tiefe=".$tiefe."' title='dahin'>".$ImageFOLDER['LINK']."</a></td>
							<td style='text-align:center;border-right:1px solid #444;border-top:1px solid #444;'>".$ImageEDIT['LINK']."<br/>".$ImageDELETE['LINK']."<br/>";
$form_send = "checkbox|checkbox|1";
//$Text2 .= $rs-> user_extended_element_edit($form_send,"","test");		
$Text2.="</td>
	</tr>
	<tr>
		<td class='forumheader' colspan='2'>
		<a href='".e_SELF."?parend=".$parend."".$name2."&name=".$Subfolders[$i]."&pfad=".$pfad."".$Subfolders[$i]."/&tiefe=".$tiefe."' title='".$Subfolders[$i]."'>".$tp->html_truncate($Subfolders[$i], 9,"...")."</a>
	</tr>
</table>
</td>";	
	 }








 for ($i=0; $i< count($Subfiles); $i++)
 	 {
 if($COLLST==$COLLS){$Text2.="</tr><tr>";$COLLST=0;}
$Text2.="<td class=''style='width:".$Breite."%;border-left:0px;border-top:0px;border-right:0px;padding:4px;'>";
$COLLST++;
$Text2.="<table style='height:100%;width:100%;border:1px' cellspacing='0' cellpadding='0'>
	<tr>
		<td style='text-align:center;border-left:1px solid #444;border-top:1px solid #444;'>";

$MAX_B=48;
$MAX_H=48;
if($erweiterung = is_image($Subfiles[$i]))
	{
$Text2.="<a target='_blank' href='bild.php?image=".$pfad."".$Subfiles[$i]."' title='dahin'>";
		
	$RESIZE= bild_size("".$pfad."/".$Subfiles[$i]."",$MAX_B);
	if($RESIZE==2){$REZ="width:".$MAX_B."px";}
	elseif($RESIZE==1){$REZ="height:".$MAX_H."px";}
	else{$REZ="";}
	$Text2.=$RESIZE;
	$Text2.="<img border='1' style='vertical-align:middle;".$REZ."' title='".$pfad."/".$Subfiles[$i]."' src='".$pfad."/".$Subfiles[$i]."'>";
	}
elseif($erweiterung = is_php($Subfiles[$i]))
	{
	$Text2.=$ImagePHP_F['LINK'];	
	}
else{$Text2.=$ImageDEFAULT['LINK'];}
		
$Text2.="</a></td>
		<td style='text-align:center;border-right:1px solid #444;border-top:1px solid #444;'>".$ImageEDIT['LINK']."<br/>".$ImageDELETE['LINK']."<br/>";
$form_send = "checkbox|checkbox|1";
//$Text2 .= $rs->  user_extended_element_edit($form_send,"","test");
$Text2.="</td>
	</tr>
	<tr>
		<td class='forumheader' colspan='2'>
		<a href='".e_SELF."?parend=".$parend."&name=".$name2."&pfad=".$pfad."&tiefe=".$tiefe."' title='".$Subfiles[$i]."'>".$tp->html_truncate($Subfiles[$i], 9,"...".$erweiterung."")."</a>
	</tr>
</table>
</td>";	
	 }
///++++++++++++++++++++++++++++++++++++++++

$Text2.="</tr>";
return $Text2;
}
///////////////////////////////////////////////////////////////////////////////
function bild_size($filename, $max)
{
$bild = $filename;
$info = getimagesize ( $bild );
$B=$info[0];
$H=$info[1];
if($B < $max ||$H < $max)
	{
	return 0;
	}
if($H > $B)
	{
	return 1;
	}
else
	{
	return 2;
	}
return 0;
}
///////////////////////////////////////////////////////////////////////////////
function is_image($filename)
{
$filestrings = explode(".",$filename);
$A= count($filestrings);
if($filestrings[$A-1]=="gif" || 
   $filestrings[$A-1]=="GIF" || 
   $filestrings[$A-1]=="png" || 
   $filestrings[$A-1]=="PNG" || 
   $filestrings[$A-1]=="jpg" || 
   $filestrings[$A-1]=="JPG")
	{
	return $filestrings[$A-1];
	}
else{
return false;
	}
return 0;
}
/////////////////////////////////////////////////////////////////////////////////
function is_php($filename)
{
$filestrings = explode(".",$filename);
$A= count($filestrings);
if($filestrings[$A-1]=="php" || 
   $filestrings[$A-1]=="PHP")
	{
	return $filestrings[$A-1];
	}
else{
return false;
	}
return 0;
}
/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////
?>
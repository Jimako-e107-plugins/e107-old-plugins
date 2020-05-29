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

$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_stadions_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_stadions_lan.php");

require_once("../functionen.php");

$ImageFOLDER['PFAD']=e_PLUGIN."sport_league_e107/images/system/folder.png";
$ImageFOLDER['LINK']="<img border='0' style='vertical-align: middle' title='dahin!!' src='".$ImageFOLDER['PFAD']."'>";

$ImageROOT['PFAD']=e_PLUGIN."sport_league_e107/images/system/home.png";
$ImageROOT['LINK']="<img border='0' style='vertical-align: middle' title='ins root Verzeichniss' src='".$ImageROOT['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN."sport_league_e107/images/system/edit_16.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_STADIONS_ADMIN_18."' src='".$ImageEDIT['PFAD']."'>";

$ImageUP['PFAD']=e_PLUGIN."sport_league_e107/images/system/updir.png";
$ImageUP['LINK']="<img border='0' style='vertical-align: middle' title='Nach oben' src='".$ImageUP['PFAD']."'>";

$ImageSORT2['PFAD']=e_PLUGIN."sport_league_e107/images/system/down.png";
$ImageSORT2['LINK']="<img border='0' style='vertical-align: middle' title='Nach unten' src='".$ImageSORT2['PFAD']."'>";

if (e_QUERY) {
	list($action,$nach,$from) = explode(".", e_QUERY);
	$nach = intval($pfad);
	$from = intval($from);
	unset($tmp);
}
// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++

/////////////////////////////
//---------------------------------------------------------------
require_once(e_ADMIN."auth.php");
require_once("../form_handler.php");
$rs = new form;
//////////////////   ////////////////////////

  $text = "<table style='width:100%;border:1px' cellspacing='0' cellpadding='0'>
  				<tr>
  				<td class='' style='width:25%'>Nav</td>	
  				<td class='' style='width:75%'>inhalt</td>
  				</tr>
  				<tr>
  				<td class='' style='width:25%;vertical-align:top;padding:10px;''>
  					<table style='width:100%;border:0px' cellspacing='0' cellpadding='0'>
  					<tr>
  						<td class='fcaption' style=''>Name</td>
  						<td class='fcaption' style='width:50px'>Optionen</td>
  					</tr>
  				";



if(isset($_GET['parend']))
	{
		$parend=$_GET['parend'];
	}
else{$parend="root";}
//////
if(isset($_GET['name']))
	{
		$name=$_GET['name'];
	}
else{$name="root";}
/////
if(isset($_GET['pfad']))
	{
		$pfad=$_GET['pfad'];
	}
else{$pfad=e_PLUGIN."sport_league_e107/";}
/////
if(isset($_GET['tiefe']))
	{
		$tiefe=$_GET['tiefe'];
	}
else{$tiefe=0;}

$text .="";

$text .= verzeichniss("root","root","".e_PLUGIN."sport_league_e107/" ,0,$name);
$text .= " </table></td>	
  				<td class='' style='width:75%;vertical-align:top;padding:10px;'>
  					<table style='height:100%;width:100%;border:1px' cellspacing='0' cellpadding='0'>";
$text .= 	verzeichniss_inhalt($parend,$name,$pfad);
$text .= "</table>
  				</tr></table>";

$text.=powered_by();
$text.="";
$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");

///////////////////////////////////////////////////////////////////////////////
function verzeichniss($parend,$name,$pfad,$tiefe,$myfolder)
{
$ImageMYFOLDER['PFAD']=e_PLUGIN."sport_league_e107/images/system/folder2.png";
$ImageMYFOLDER['LINK']="<img border='0' style='vertical-align: middle' title='dahin!!' src='".$ImageMYFOLDER['PFAD']."'>";		
$ImageFOLDER['PFAD']=e_PLUGIN."sport_league_e107/images/system/folder.png";
$ImageFOLDER['LINK']="<img border='0' style='vertical-align: middle' title='dahin!!' src='".$ImageFOLDER['PFAD']."'>";	
$ImageEDIT['PFAD']=e_PLUGIN."sport_league_e107/images/system/edit_16.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_STADIONS_ADMIN_18."' src='".$ImageEDIT['PFAD']."'>";
$ImageDELETE['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_16.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='Nach oben' src='".$ImageDELETE['PFAD']."'>";
$ImageUP['PFAD']=e_PLUGIN."sport_league_e107/images/system/updir.png";
$ImageUP['LINK']="<img border='0' style='vertical-align: middle' title='Nach oben' src='".$ImageUP['PFAD']."'>";		
	
$Text2.="<tr>
					<td class='".$rowclass."'style='border-left:0px;border-top:0px;border-right:0px;'>";
  		for($j=0;$j< $tiefe;$j++)
  					{
  					$Text2.="--";
  					}
$Text2.="<a href='".e_SELF."?parend=".$parend."&name=".$name."&pfad=".$pfad."&tiefe=".$tiefe."' title='dahin'>";
if($name==$myfolder){
$Text2.=$ImageMYFOLDER['LINK'];
}else{$Text2.=$ImageFOLDER['LINK'];}
$Text2.="".$name."</a></td>
  				<td class='".$rowclass."'style='border-left:0px;border-top:0px;border-right:0px;'>".$ImageEDIT['LINK']."".$ImageDELETE['LINK']."</td>
  			</tr>";	

$Subfolders=verzeichniss_auslesen($pfad);
 for ($i=0; $i< count($Subfolders); $i++)
 	 {
 	 	$subPfad="".$pfad."".$Subfolders[$i]."/";
 	  $Text2.= verzeichniss($pfad,$Subfolders[$i],$subPfad,$tiefe+1,$myfolder);
	 }
return $Text2;
}
//////////////////////////////////////////////////////////////////////////////////
function verzeichniss_auslesen($verz)
{
$handle=opendir($verz);
while ($datei = readdir($handle))
	{
  if(is_dir($verz.$datei) && $datei !='CVS' && $datei != "/" && $datei != "." && $datei != ".." )
  	{
     $dateilist[] = $datei;
    }
  }
closedir($handle);
return $dateilist;
}
//////////////////////////////////////////////////////////////////////////////////
function dateien_auslesen($verz)
{
$handle=opendir($verz);
while ($datei = readdir($handle))
	{
  if(is_file($verz.$datei) && $datei !='CVS' && $datei != "/" && $datei != "." && $datei != ".." )
  	{
     $dateilist[] = $datei;
    }
  }
closedir($handle);
return $dateilist;
}
///////////////////////////////////////////////////////////////////////////////
function verzeichniss_inhalt($parend2,$name2,$pfad2)
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


$Subfolders=verzeichniss_auslesen($pfad2);
$Subfiles=dateien_auslesen($pfad2);
$COLLS=6;
$COLLST=1;
$Breite=round((100 / $COLLS),0);
$Text2.="<tr>";

$Text2.="<td class=''style='width:".$Breite."%;border-left:0px;border-top:0px;border-right:0px;padding:4px;'>
					<table style='height:100%;width:100%;border:1px' cellspacing='0' cellpadding='0'>
						<tr>
							<td style='text-align:center;border-left:1px solid #444;border-top:1px solid #444;'>
								<a href='".e_SELF."?parend=".$parend2."".$name2."&name=".$Subfolders[$i]."&pfad=".$pfad2."".$Subfolders[$i]."/&tiefe=".$tiefe."' title='dahin'>".$ImageUP['LINK']."</a></td>
							<td style='text-align:center;border-right:1px solid #444;border-top:1px solid #444;'>!</td>
						</tr>
						<tr>
							<td class='forumheader' colspan='2'>
							<a href='".e_SELF."?parend=".$parend2."".$name2."&name=".$Subfolders[$i]."&pfad=".$pfad2."".$Subfolders[$i]."/&tiefe=".$tiefe."' title='dahin'>..</a>
						</tr>
					</table>
				</td>";



 for ($i=0; $i< count($Subfolders); $i++)
 	 { 	
 	 if($COLLST==$COLLS)	{$Text2.="</tr><tr>";$COLLST=0;}
 	 $COLLST++;
$Text2.="<td class=''style='width:".$Breite."%;border-left:0px;border-top:0px;border-right:0px;padding:4px;'>
					<table style='height:100%;width:100%;border:1px' cellspacing='0' cellpadding='0'>
						<tr>
							<td style='text-align:center;border-left:1px solid #444;border-top:1px solid #444;'>
								<a href='".e_SELF."?parend=".$parend2."".$name2."&name=".$Subfolders[$i]."&pfad=".$pfad2."".$Subfolders[$i]."/&tiefe=".$tiefe."' title='dahin'>".$ImageFOLDER['LINK']."</a></td>
							<td style='text-align:center;border-right:1px solid #444;border-top:1px solid #444;'>".$ImageEDIT['LINK']."<br/>".$ImageDELETE['LINK']."<br/>";
$form_send = "checkbox|checkbox|1";
$Text2 .= $rs->  user_extended_element_edit($form_send,"","test");		
$Text2.="</td>
	</tr>
	<tr>
		<td class='forumheader' colspan='2'>
		<a href='".e_SELF."?parend=".$parend2."".$name2."&name=".$Subfolders[$i]."&pfad=".$pfad2."".$Subfolders[$i]."/&tiefe=".$tiefe."' title='dahin'>".$Subfolders[$i]."</a>
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
$Text2.="<a target='_blank' href='bild.php?image=".$pfad2."".$Subfiles[$i]."' title='dahin'>";
		
	$RESIZE= bild_size("".$pfad2."".$Subfiles[$i]."",$MAX_B);
	if($RESIZE==2){$REZ="width:".$MAX_B."px";}
	elseif($RESIZE==1){$REZ="height:".$MAX_H."px";}
	else{$REZ="";}
	$Text2.=$RESIZE;
	$Text2.="<img border='1' style='vertical-align:middle;".$REZ."' title='".$pfad2."".$Subfiles[$i]."' src='".$pfad2."".$Subfiles[$i]."'>";
	}
elseif($erweiterung = is_php($Subfiles[$i]))
	{
	$Text2.=$ImagePHP_F['LINK'];	
	}
else{$Text2.=$ImageDEFAULT['LINK'];}
		
$Text2.="</a></td>
		<td style='text-align:center;border-right:1px solid #444;border-top:1px solid #444;'>".$ImageEDIT['LINK']."<br/>".$ImageDELETE['LINK']."<br/>";
$form_send = "checkbox|checkbox|1";
$Text2 .= $rs->  user_extended_element_edit($form_send,"","test");
$Text2.="</td>
	</tr>
	<tr>
		<td class='forumheader' colspan='2'>
		<a href='".e_SELF."?parend=".$parend2."&name=".$name2."&pfad=".$pfad2."&tiefe=".$tiefe."' title='".$Subfiles[$i]."'>".$tp->html_truncate($Subfiles[$i], 9,"...".$erweiterung."")."</a>
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
?>
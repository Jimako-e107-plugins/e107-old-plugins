<?php
/*
*************************************
*        Visitors Book				*
*									*
*        (C)Oyabunstyle.de			*
*        http://oyabunstyle.de		*
*        info@oyabunstyle.de		*
*************************************
*/
require_once("../../class2.php");
require_once(HEADERF);
include_lan(e_PLUGIN."visitors_book/languages/".e_LANGUAGE."/admin.php");

$caption=VIBO_LAN_14;
// Grundeinstellungen laden
$vibo_pref=mysql_query("SELECT * FROM ".MPREFIX."visitors_book_prefs WHERE admin>'-1'");
$vibo_pref=mysql_fetch_array($vibo_pref);
// Moderatorinformation
if(check_class($vibo_pref['admin']))
{
	$visitors_book_posts=$sql -> db_Count("visitors_book","(*)","WHERE checked='0'");
	if ($visitors_book_posts>0)
	{
		$a_message="<p style='text-align:center'>".VIBO_LAN_29."</p>";
	}
}
// Blätterfunktion vorbereiten
$result=mysql_query("SELECT * FROM ".MPREFIX."visitors_book WHERE is_comment='0' AND checked='1'");
$menge=mysql_num_rows($result);
$show=10;
if (isset($_GET['page'])){$page=$_GET['page'];}
else {$page=1;}
$start=$page*$show-$show;
// Funktionen
if (isset($_POST['save']))
{
	$first=$_POST["first"];
	$operator=$_POST["operator"];
	$second=$_POST["second"];
	if ($operator==0) {$ergebnis=$first+$second;}
	elseif ($operator==1) {$ergebnis=$first-$second;}
	$deinergebnis=$_POST["deinergebnis"];
	
	session_start();
	if ($_SESSION["formID"]==$_POST["formID"])
	{
		$message=VIBO_LAN_27;
	}	
	elseif ($ergebnis!=$deinergebnis)
	{
		$message=VIBO_LAN_24;
	}
	elseif ($_POST['text']=="")
	{
		$message=VIBO_LAN_25;
	}
	else
	{
		if (! isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			$client_ip=$_SERVER['REMOTE_ADDR'];
		}
		else 
		{
			$client_ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		
		$description=$tp->toDB($_POST["text"]);
		$description=strip_tags($description);
		if ($_POST["name"]=="")
		{$name=VIBO_LAN_15;}
		else
		{$name=$tp->toDB($_POST["name"]);$name=strip_tags($name);}
		
		$_SESSION["formID"] = $_POST["formID"];

		$sql->db_Select_gen("INSERT INTO ".MPREFIX."visitors_book
							(text,name,ip,mail,homepage,date)
							VALUES ('".$description."',
									'".$name."',
									'".$client_ip."',
									'".$_POST['mail']."',
									'".$_POST['homepage']."',
									'".time()."')
							");
		$message=VIBO_LAN_26;
	}
}
if (isset($_POST['comment']))
{
	session_start();
	if ($_SESSION["formID"]==$_POST["formID"])
	{
		$message=VIBO_LAN_27;
	}
	elseif ($_POST['text']=="")
	{
		$message=VIBO_LAN_25;
	}
	else
	{
		$description=$tp->toDB($_POST["text"]);
		$description=strip_tags($description);
		$sql->db_Select_gen("INSERT INTO ".MPREFIX."visitors_book
							(text,name,ip,date,is_comment,homepage,mail)
							VALUES ('".$description."',
									'".USERNAME."',
									'".USERID."',
									'".time()."',
									'".$_POST['id']."','','')
							");
		$message=VIBO_LAN_39;
	}
}
// Captcha
$first=mt_rand(10,99);
$operator=mt_rand(0,1);
$second=mt_rand(1,9);
if ($operator==0) {$var="+";}
elseif ($operator==1) {$var="-";}
// Inhalt
$text="
".$a_message."
<p style='text-align:center'>".$message."</p>
<div style='text-align:center'>
	<input type='submit' value='".VIBO_LAN_18."' class='button' style='cursor:pointer;' id='vibo-com-button'></input>
</div>
<form action='".e_SELF."' method='post'>
<table style='width:95%' class='vibo-hide'>
	<tr>
		<td class='fcaption'>".VIBO_LAN_18."</td>
	</tr>
	<tr>
		<td class='forumheader2'>".VIBO_LAN_19.":</td>
		<td>
			<input type='text' name='name' class='tbox' size='30' />
		</td>
	</tr>
	<tr>
		<td class='forumheader2'>".VIBO_LAN_20.":</td>
		<td>
			<input type='text' name='mail' class='tbox' size='30' />
		</td>
	</tr>
	<tr>
		<td class='forumheader2'>".VIBO_LAN_21."</td>
		<td>
			<input type='text' name='homepage' class='tbox' size='30' />
		</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='2'>".VIBO_LAN_22.":</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='2'>
			<textarea class='tbox' name='text' style='width:100%; height:150px;'></textarea>
		</td>
	</tr>
	<tr>
		<td class='forumheader2'>".VIBO_LAN_23.$first.$var.$second."?</td>
		<td class='forumheader2'>
			<input type='hidden' name='first' value='".$first."'/>
			<input type='hidden' name='operator' value='".$operator."'/>
			<input type='hidden' name='second' value='".$second."'/>
			<input class='tbox' type='text' size='25' name='deinergebnis' required />
		</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='2' style='text-align:center'>
			<input type='hidden' name='formID' value='".uniqid("")."'>
			<input type='submit' name='save' value='".VIBO_LAN_05."' class='button'></input>
		</td>
	</tr>
</table>
</form>
<br />
<table style='width:95%' class='vibo-table'>
";
$eql=mysql_query("SELECT * FROM ".MPREFIX."visitors_book WHERE is_comment='0' AND checked='1' ORDER BY date DESC LIMIT $start, $show");
while ($entry=mysql_fetch_array($eql,MYSQL_ASSOC))
{
	if ($entry['homepage']!="")
	{
		$homepage="
			<a href='".$entry['homepage']."' style='float:right;' onclick='window.open(this.href);return false;'>
				<img src='".e_PLUGIN."visitors_book/stuff/web.png' style='width:16px' />
			</a>
		";
	}
	if(check_class($vibo_pref['admin']))
	{
		$options="
			<a href='delete.php?id=".$entry['id']."' style='float:right;' onClick='return confirm(\"".VIBO_LAN_37."\")'>
				<img src='".e_PLUGIN."visitors_book/stuff/delete.png' style='width:16px' />
			</a>
		";
	}
	$text.="
		<tr>
			<td class='forumheader2'>
				<span style='vertical-align:top'>".$entry['name'].VIBO_LAN_16.date("d.m.Y",$entry['date']).VIBO_LAN_17.date("H:i",$entry['date'])."</span>".$homepage.$options."
				<br /><br />
			</td>
		</tr>
		<tr>
			<td class='forumheader3'>
				".$tp->toHTML($entry['text'],true)."
			</td>
		</tr>
		<tr>
			<td><hr /></td>
		</tr>
	";
	$cql=mysql_query("SELECT * FROM ".MPREFIX."visitors_book WHERE is_comment='".$entry['id']."' AND checked='1' ORDER BY date");
	while ($comment=mysql_fetch_array($cql,MYSQL_ASSOC))
	{
		if(check_class($vibo_pref['admin']))
		{
			$options_comment="
				<a href='delete.php?id=".$comment['id']."' style='float:right;' onClick='return confirm(\"".VIBO_LAN_37."\")'>
					<img src='".e_PLUGIN."visitors_book/stuff/delete.png' style='width:16px' />
				</a>
			";
		}
		$text.="
			<tr>
				<td class='forumheader2'>
					<img src='".e_PLUGIN."visitors_book/stuff/comment.png' style='width:16px' />
					<span style='vertical-align:top'>".$comment['name'].VIBO_LAN_41.date("d.m.Y",$comment['date']).VIBO_LAN_17.date("H:i",$comment['date'])."</span>".$options_comment."
					<br /><br />
				</td>
			</tr>
			<tr>
				<td class='forumheader3'>
					".$tp->toHTML($comment['text'],true)."
				</td>
			</tr>
			<tr>
				<td><hr /></td>
			</tr>
		";
	}
	if(check_class(253))
	{
		$text.="
			<form action='".e_SELF."' method='post'>
				<tr class='vibo-com-button' style='cursor:pointer;'>
					<td class='forumheader2' style='text-align:right'>
						".VIBO_LAN_38."
					</td>
				</tr>
				<tr class='vibo-hide-tr'>
					<td class='forumheader2' style='text-align:center;'>
						<textarea class='tbox' name='text' style='width:100%; height:150px;'></textarea>
						<input type='hidden' name='formID' value='".uniqid("")."'>
						<input type='hidden' name='id' value='".$entry['id']."'>
						<input type='submit' name='comment' value='".VIBO_LAN_05."' class='button'></input>
					</td>
				</tr>
			</form>
		";
	}
}
$text.="</table>";
include "browse.php";

$text.="<p class='center'><a href='http://oyabunstyle.de' onclick='window.open(this.href);return false;'>".VIBO_LAN_36."</a></p>";
$ns -> tablerender($caption, $text); 
require_once(FOOTERF); 
?> 
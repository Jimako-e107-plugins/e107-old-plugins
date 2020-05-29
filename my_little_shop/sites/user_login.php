<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|       
|        Â©Steve Dunstan 2001-2006
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/my_little_shop/sites/korb_user.php $
|		$Revision: 1.00 $
|		$Date: 2008/10/02 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
require_once(HEADERF);
$lan_file = e_PLUGIN."my_little_shop/languages/".e_LANGUAGE."/produkt_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  "my_little_shop/languages/German/produkt_lan.php");
require_once("../handler/form_handler.php");
// ============= START OF THE BODY ====================================
if (e_QUERY) {
	list($action,$id,$from) = explode(".", e_QUERY);
	$id = intval($id);
	//$from = intval($from);
	unset($tmp);
}


if (isset($_POST['datasend']))
{
$Mail1=strtolower($_POST['mail']); // Email-Adressen auf Alles Kleingeschrieben konvertieren 
$Ausgabe =	angaben_pruefen($Mail1,$_POST['passord']);
if(!$Ausgabe['wert']){$meldung=$Ausgabe['message'];}
elseif($Ausgabe['wert'])
	{	$meldung=$Ausgabe['message'];
		e107_require_once(e_HANDLER."login.php");
		$usr2 = new userlogin($_POST['mail'], $_POST['passord'], $_POST['autologin']);
		$meldung .="angemeldet";
	}
}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if(!USER)
{
	$text="<div style='text-align:center'><br/><br/>";
	$text .= "<form method='post' action='".e_SELF.(e_QUERY ? "?".e_QUERY : "")."'>";
	$text .= "	
	<font style='color:#A00;'>".$meldung."</font><br/><br/>
						<table cellpadding='0' cellspacing='0' style='width:100%'>
							<tr>
								<td>Email-adresse:</td>
								<td><input style='width: 150px; border: 1px solid #CCCCCC; color: #000; font: 7pt verdana, tahoma, arial, helvetica, sans-serif; background-color: #FFFFFF;' name='mail' type='text' value='".$Mail1."'  />
								</td>
							</tr>
								<td>Passwort:</td>
								<td><input style='width: 150px; border: 1px solid #CCCCCC; color: #000; font: 7pt verdana, tahoma, arial, helvetica, sans-serif; background-color: #FFFFFF;' name='passord' type='password' value=''  />
								</td>
							</tr>

							<tr>
								<td colspan='2'><div align='center'><br/><br/><input class='button' name='datasend' type='submit' value='Anmelden' /><br/><br/></div>
								</td>
							</tr>
						</table></form>";
	$title="<b>Kunde- Anmeldung</b>";
}
else{
$text="<div style='text-align:center'><br/><br/>
		Sie sind jetzt Angemeldet!<br/>Bitte klickenSie Weiter.</br></br>
		<form method='post' action='korb_user.php".(e_QUERY ? "?".e_QUERY : "")."'>
			<input class='button' name='datasend' type='submit' value='Weiter' /><br/><br/>
		</form>
</div>";




}


$text.="<br/><br/>";
$text.=powered_by_shop();
$text.="<br/><br/></div>";

if(IsSet($message)){
		$ns -> tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
}

$ns -> tablerender($title, $text);
// ========= End of the BODY ============================
require_once(FOOTERF);
///======================================================
function number_chose($number, $max)
{
$Ausgabe="<select name='anzal' size='1' style='width:50px;font-size:9pt;' onChange='this.form.submit()'>";
for($i=1; $i < $max; $i++)
		{
		$Ausgabe.="<option ";
		if($i==$number)
			{
			$Ausgabe.="selected ";
			}
		$Ausgabe.="value='".$i."'>";
		$Ausgabe.="".$i."</option>";
		}
$Ausgabe.="</select>";
return $Ausgabe;
}
////////////////////////////////////
function angaben_pruefen($email1,$password1)
{
global $tp;
if(!$clean_email = check_email($tp -> toDB($email1)))
	{	$Ausgabe['wert']=false;$Ausgabe['message']=	"Es ist keine gültige MailAdresse!";return $Ausgabe;}
if(!$userid=user_pruefen($email1))
	{$Ausgabe['wert']=false;$Ausgabe['message']= "Unbekannter Benutzer!";return $Ausgabe;}
if(!$password1)
  {$Ausgabe['wert']=false;$Ausgabe['message']= "Sie haben keine Passwort angegeben!";return $Ausgabe;}
if(pass_pruefen($email1,$password1))
  {$Ausgabe['wert']=true;$Ausgabe['message']= "!!!!";return $Ausgabe;}
$Ausgabe['wert']=false;$Ausgabe['message']=	"Passwort oder Benutzername / Email ist falsch! ";return $Ausgabe;
}
////////////////////////////////////
function user_pruefen($email1)
{
global $sql,$tp;	
if($sql->db_Select("user", "*", "(user_loginname = \"".$tp->toDB($email1)."\" OR user_email = \"".$email1."\" ) LIMIT 1"))
		{
		$row = $sql -> db_Fetch();
		return  $row['user_id'];
		}
return false;
}
////////////////////////////////////
function pass_pruefen($email1,$pass)
{
global $sql,$tp;	
if($sql->db_Select("user", "*", "(user_loginname = \"".$tp->toDB($email1)."\" OR user_email = \"".$email1."\" ) LIMIT 1"))
		{
		$row = $sql -> db_Fetch();
		if(md5($pass)==$row['user_password'])
				{
				return true;	
				}
		else{
				return false;
				}
		}
return false;
////////////////////////////////////
}
?>
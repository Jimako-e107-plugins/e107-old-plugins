
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
$lan_file = e_PLUGIN."my_little_shop/languages/".e_LANGUAGE."/user_signup_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  "my_little_shop/languages/German/user_signup_lan.php");
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
$Mail2=strtolower($_POST['mail2']);// Email-Adressen auf Alles Kleingeschrieben konvertieren 
$Ausgabe =	angaben_pruefen($Mail1, $Mail2, $_POST['passord'], $_POST['passord2']);
if(!$Ausgabe['wert']){$meldung=$Ausgabe['message'];}
elseif($Ausgabe['wert'])

{$meldung=$Ausgabe['message'];
		$time = time();
		$ip = $e107->getip();
		$u_key = md5(uniqid(rand(), 1));
		$nid = $sql->db_Insert("user", "0, '{$Mail1}', '{$Mail1}', '', '".md5($_POST['passord'])."', '{$u_key}', '".$Mail1."', '', '', '', '1', '".$time."', '0', '".$time."', '0', '0', '0', '0', '".$ip."', '0', '0', '', '', '0', '0', '', '', '', '', '0', '' ");
		$meldung .="gespeichert";
		if(!$nid)
		{
			require_once(HEADERF);
			$ns->tablerender("", "warum!");
			require_once(FOOTERF);
		}
		else{
		e107_require_once(e_HANDLER."login.php");
		$usr2 = new userlogin($_POST['mail'], $_POST['passord'], $_POST['autologin']);
		$meldung .="angemeldet";
		}
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
								<td>".MLS_LAN_USER_SIGNUP_0."</td>
								<td><input style='width: 150px; border: 1px solid #CCCCCC; color: #000; font: 7pt verdana, tahoma, arial, helvetica, sans-serif; background-color: #FFFFFF;' name='mail' type='text' value='".$Mail1."'  />
								</td>
							</tr>
							<tr>
								<td>".MLS_LAN_USER_SIGNUP_1."</td>
								<td><input style='width: 150px; border: 1px solid #CCCCCC; color: #000; font: 7pt verdana, tahoma, arial, helvetica, sans-serif; background-color: #FFFFFF;' name='mail2' type='text' value='".$Mail2."'  />
								</td>
							</tr>
							<tr>
								<td>".MLS_LAN_USER_SIGNUP_2."</td>
								<td><input style='width: 150px; border: 1px solid #CCCCCC; color: #000; font: 7pt verdana, tahoma, arial, helvetica, sans-serif; background-color: #FFFFFF;' name='passord' type='password' value=''  />
								</td>
							</tr>
							<tr>
								<td>".MLS_LAN_USER_SIGNUP_3."</td>
								<td><input style='width: 150px; border: 1px solid #CCCCCC; color: #000; font: 7pt verdana, tahoma, arial, helvetica, sans-serif; background-color: #FFFFFF;' name='passord2' type='password' value=''  />
								</td>
							</tr>
							<tr>
								<td colspan='2'><div align='center'><br/><br/><input class='button' name='datasend' type='submit' value='".MLS_LAN_USER_SIGNUP_4."' /><br/><br/></div>
								</td>
							</tr>
						</table></form>";
	$title="<b>".MLS_LAN_USER_SIGNUP_5."</b>";
}
else{
$text="<div style='text-align:center'><br/><br/>
		".MLS_LAN_USER_SIGNUP_6."
		<form method='post' action='korb_user.php".(e_QUERY ? "?".e_QUERY : "")."'>
			<input class='button' name='datasend' type='submit' value='".MLS_LAN_USER_SIGNUP_4."' /><br/><br/>
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
function angaben_pruefen($email1, $email2, $password1, $password2)
{
global $tp;
if(!$clean_email = check_email($tp -> toDB($email1)))
	{	$Ausgabe['wert']=false;$Ausgabe['message']=	MLS_LAN_USER_SIGNUP_7;return $Ausgabe;}
if($email1!=$email2)
	{$Ausgabe['wert']=false;$Ausgabe['message']= MLS_LAN_USER_SIGNUP_8;return $Ausgabe;}
if($userid=mail_duplikate_pruefen($email1))
	{$Ausgabe['wert']=false;$Ausgabe['message']= MLS_LAN_USER_SIGNUP_9.$userid."";return $Ausgabe;}
if(!$password1)
  {$Ausgabe['wert']=false;$Ausgabe['message']= MLS_LAN_USER_SIGNUP_10;return $Ausgabe;}
if( $password1 && $password1!=$password2)
	{$Ausgabe['wert']=false;$Ausgabe['message']= MLS_LAN_USER_SIGNUP_11;return $Ausgabe;}
$Ausgabe['wert']=true;$Ausgabe['message']=	MLS_LAN_USER_SIGNUP_12;return $Ausgabe;
}
////////////////////////////////////
function mail_duplikate_pruefen($email1)
{
global $sql,$tp;	
if($sql->db_Select("user", "*", "(user_loginname = \"".$tp->toDB($email1)."\" OR user_email = \"".$email1."\" ) LIMIT 1"))
		{
		$row = $sql -> db_Fetch();
		return  $row['user_id'];
		}
return 0;
////////////////////////////////////
}
?>
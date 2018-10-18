@include_once e_PLUGIN."ecaptcha/languages/".e_LANGUAGE.".php";
@include_once e_PLUGIN."ecaptcha/languages/English.php";

$parm_array = explode("_", $parm);
$parm_ip    = preg_replace("/[^0-9\.]/", "", $parm_array[0]);
$parm_uid   = preg_replace("/[^0-9]/",   "", $parm_array[1]);
$parm_area  = preg_replace("/[^a-z]/",   "", $parm_array[2]);
$parm_time  = preg_replace("/[^0-9]/",   "", $parm_array[3]);

if ($parm_ip === "" || $parm_uid === "" || $parm_area === "" || $parm_time === "")
{
  return $code_text;
}

if (ADMIN)
{
  $string  = "";
  $string .= "[ <a href='".e_PLUGIN."ecaptcha/ecaptcha_moderate.php'>".LAN_ECAP_BB_MODERATE."</a> ]";
  $string .= "[ <a href='".e_PLUGIN."ecaptcha/ecaptcha_moderate.php?action=approve&amp;ip={$parm_ip}&amp;uid={$parm_uid}&amp;area={$parm_area}&amp;time={$parm_time}'>".LAN_ECAP_BB_APPROVE."</a> ]";
  $string .= "[ <a href='".e_PLUGIN."ecaptcha/ecaptcha_moderate.php?action=delete&amp;ip={$parm_ip}&amp;uid={$parm_uid}&amp;area={$parm_area}&amp;time={$parm_time}'>".LAN_ECAP_BB_DELETE."</a> ]";
  $string .= "<br /><br /><div style='border:1px solid'>{$code_text}</div>";

  return $string;
}

if (defined("USERID") && USERID != "0" && USERID == $parm_uid)
{
  return $code_text;
}

if (getip() == $parm_ip)
{
  return $code_text;
}

return " [ ".LAN_ECAP_BB_PENDING." ] ";

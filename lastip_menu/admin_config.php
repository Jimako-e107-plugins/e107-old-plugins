<?php
require_once("../../class2.php");
require_once(e_ADMIN."auth.php");
if (file_exists("lng/".e_LANGUAGE.".php"))
	include_once("lng/".e_LANGUAGE.".php");
else
	include_once("lng/English.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); }
$sql = new db;
$text = "<center>";

if($_POST["save_prefs"]) {
  $custom_table = "lastip_ips"; // See plugin.php
  $pref['lastip_use_table'] = ($_POST['lastip_use_table']=="user" ? "user" : $custom_table);
	$pref['lastip_list_user_table'] = ( $_POST['lastip_list_user_table']=="y" ? TRUE : ($_POST['lastip_list_user_table']=="n" ? FALSE : $pref['lastip_list_user_table']) );
	$pref['lastip_users_per_page'] = ($_POST['lastip_users_per_page'] ? $_POST['lastip_users_per_page'] : $pref['lastip_users_per_page']);
	$pref['lastip_ips_per_user'] = ($_POST['lastip_ips_per_user'] ? $_POST['lastip_ips_per_user'] : $pref['lastip_ips_per_user']);
	$pref['lastip_change_date'] = ( $_POST['lastip_change_date']=="y" ? TRUE : ($_POST['lastip_change_date']=="n" ? FALSE : $pref['lastip_change_date']) );
	save_prefs();
}

$use_table = $pref['lastip_use_table'];

if($_POST["lip_del_submit"] && $use_table!="user") {
  $delwh = array();
  $i=0;
  foreach($_POST["lip_delete"] as $key => $val) {
    $val = explode(",",$val);
    $delwh[] = "(user_id='".$val[0]."' AND user_ip='".$val[1]."')";
    $i++;
  }
  if($i) {
    $sql -> db_Delete($use_table, implode(" OR ",$delwh));
    $text .= $i.LIP_DELETED."<br /><br />";
  }
  
  unset($i,$delwh);
}

if($_POST["save_prefs"]) $text .= LIP_OPTIONS_SAVED."<br /><br />";

if($use_table!="user" || $pref['lastip_list_user_table']) {
   $urlvars["sortby"] = ( $_GET["sortby"] ? $_GET["sortby"] : "u_id" );
   $urlvars["order"] = ( $_GET["order"] ? $_GET["order"] : "acs" );
   $urlvars["search"] = ( $_POST["search_butt"] ? trim($_POST["search"]) : ($_GET["search"] ? urldecode($_GET["search"]) : false) );
   $urlvars["s_type"] = ( $_POST["s_type"] ? trim($_POST["s_type"]) : ($_GET["s_type"] ? urldecode($_GET["s_type"]) : false) );
   $urlvars["pi"] = ( $_GET["pi"] ? $_GET["pi"] : 1 );

   if($urlvars["search"] == "" || $_POST["save_prefs"]) $urlvars["search"] = false;

   $sortby = $urlvars["sortby"];
   $order = $urlvars["order"];
   $pi = $urlvars["pi"];

   $scriptname = e_SELF;
   
   if($urlvars["search"]) {
      $scriptname .= "?search=".urlencode($urlvars["search"]);
      $scriptname .= "&s_type=".$urlvars["s_type"];
      $getch = "&";
   }
   else $getch = "?";

   if ($order == "asc") {
      $order = "";
      $lorder = LIP_ASCENDING;
      $torder = "desc";
   }
   else {
      $order = " desc";
      $lorder = LIP_DESCENDING;
      $torder = "asc";
   }
   if ($sortby == "u_id") {
      $lsortby = LIP_USER_ID;
      $sortby = ($use_table=="user" ? "" : MPREFIX.$use_table.".")."user_id";
   }
   elseif ($sortby == "name") {
      $lsortby = LIP_USER_NAME;
      $sortby = "user_name";
   }
   elseif ($sortby == "u_ip") {
      $lsortby = LIP_USER_IP;
      $sortby = ($use_table=="user" ? "" : MPREFIX.$use_table.".")."user_ip";
   }

   $sortstr = "ORDER BY ".$sortby.$order;
   $sortstr_p = LIP_SORT_BY." $lsortby ".LIP_IN." $lorder ".LIP_ORDER."<br /><br />";

	$jump = $pref['lastip_users_per_page'];
	$ses_up = $jump*$pi;
	$ses_down = $ses_up - $jump;

	$text .= "\n<!-- Plug start -->\n$userinfo\n".($use_table=="user" ? "" : "<form name=\"del_ips\" action=\"".e_SELF."\" method=\"post\">\n")."<table class=\"fborder\">
	<tr><td style=\"text-align: center\" colspan=\"3\">$sortstr_p</td></tr>
   <tr>
   <td class=\"forumheader\"><a href=\"".$scriptname.$getch."sortby=u_id&order=$torder\">".LIP_USER_ID."</a></td>
   <td class=\"forumheader\"><a href=\"".$scriptname.$getch."sortby=name&order=$torder\">".LIP_USER_NAME."</a></td>
   <td class=\"forumheader\">".($use_table=="user" ? "" : "[".LIP_DELETE."?] ")."<a href=\"".$scriptname.$getch."sortby=u_ip&order=$torder\">".LIP_USER_IP."</a>".($use_table=="user" ? "" : " [".LIP_DATE."]")."</td>
   </tr>\n";
   
   $scriptname .= $getch."order=".$urlvars["order"];
   $scriptname .= "&sortby=".$urlvars["sortby"];
   $getch = "&";

   if($urlvars["search"]) {
      if($urlvars["s_type"] == "user_id" && is_numeric($urlvars["search"])) {
         $where = "WHERE ".($use_table=="user" ? "" : MPREFIX.$use_table.".")."user_id = ".$urlvars["search"]." ";
      }
      else if($urlvars["s_type"] == "user_name") {
         $where = "WHERE user_name LIKE '%".$urlvars["search"]."%' ";
      }
      else if($urlvars["s_type"] == "user_ip") {
         $where = "WHERE ".($use_table=="user" ? "" : MPREFIX.$use_table.".")."user_ip LIKE '".$urlvars["search"]."%' ";
      }
      else $where = "";
   }
   
	if($use_table=="user") {
		$table = "user";
		$fields = "user_id, user_name, user_ip";
	}
	else {
		$table = $use_table." left join ".MPREFIX."user on ".MPREFIX."$use_table.user_id = ".MPREFIX."user.user_id";
		$fields = MPREFIX.$use_table.".user_id, user_name, ".MPREFIX."$use_table.user_ip, ".MPREFIX."$use_table.user_date";
		$sortstr .= ", ".MPREFIX."$use_table.user_date desc";
	}

  $ucount = 0;
  if($urlvars["sortby"] != "u_ip") {
    $field = ($urlvars["sortby"]=="u_id" ? MPREFIX.$use_table.".user_id" : "user_name");
    //$ucount = $sql -> db_Count($table,"(DISTINCT ".$field.")", $where);
    $ucount = $sql -> db_Select($table, "DISTINCT ".$field, $where, "where");
    mysql_free_result($sql -> mySQLresult);
  }

	$unum = $sql -> db_Select($table, $fields, $where.$sortstr, "where");
   //print "where ".$where." where|sort ".$sortstr." sort|$unum|$ses_down|err".mysql_error()."err<br /><br />";
   
  if($ucount) $unum = $ucount;

  $utime_offset = ( (!$currentUser["user_timezone"] || $currentUser["user_timezone"] == "GMT") ? 0 : ($currentUser["user_timezone"]*60*60) );

	$i=0;
	$prev = 0;
	while($data = $sql -> db_Fetch()) {

	    $i++;
	    if ($i > $ses_up) break;
	    if ($i <= $ses_down) {
        if( $urlvars["sortby"] == "u_id" && $prev === $data[0] ) {
          $group = 1;
          $i--;
        }
        else if( $urlvars["sortby"] == "name" && $prev === $data[1] ) {
          $group = 1;
          $i--;
        }
        else $group = 0;
        
        if($urlvars["sortby"] != "u_ip") {
          $prev = ($urlvars["sortby"]=="u_id" ? $data[0] : $data[1]);
        }
        
        //if(!$group) print "|".$data[0];
        //else print "&".$data[0];
        
        continue;
	    }
      $i--;
	    
    if( $urlvars["sortby"] == "u_id" && $prev === $data[0] ) {
      $group = 1;
      $i--;
    }
    else if( $urlvars["sortby"] == "name" && $prev === $data[1] ) {
      $group = 1;
      $i--;
    }
    else $group = 0;
    
		if(!$group) {
      $text .= ( ($i-$ses_down) ? "</table></td>\n</tr>\n" : "" )."<tr>
      <td class=\"forumheader3\" style=\"vertical-align: top\">$data[0]</td>
      <td class=\"forumheader3\" style=\"vertical-align: top\">$data[1]</td>
      <td class=\"forumheader3\" style=\"vertical-align: top\"><table style=\"width: 100%\">";
    }
    $text .= "<tr><td style=\"text-align: left\">
    ".($use_table=="user" ? "" : "<input title=\"".LIP_USER_ID.": $data[0], ".LIP_USER_IP.": $data[2], ".LIP_DELETE."?\" type=\"checkbox\" name=\"lip_delete[]\" value=\"$data[0],$data[2]\" style=\"vertical-align: middle\" /> ")."<a href=\"".e_ADMIN."userinfo.php?$data[2]\" title=\"".LIP_BAN_IP."\">$data[2]</a>
    </td>".($use_table=="user" ? "" : "<td style=\"padding-left: 5px; text-align: right\">".date("H:i / d.m.y",$data[3]+$utime_offset)."</td>")."</tr>";
    
    if($urlvars["sortby"] != "u_ip") {
      $prev = ($urlvars["sortby"]=="u_id" ? $data[0] : $data[1]);
    }

		$i++;
	}
	$text .= ( ($i-$ses_down) ? "</table></td>\n</tr>\n" : "" ).($use_table=="user" ? "" : "<tr><td colspan=\"2\" class=\"forumheader3\">&nbsp;</td><td class=\"forumheader3\" style=\"text-align: left\"><input type=\"submit\" class=\"button\" name=\"lip_del_submit\" value=\"".LIP_DELETE."\" /></td></tr>\n")."</table>\n";
  if($use_table=="user") $text .= "</form>\n";

	if ($unum%$jump == 0) $for_i = $unum/$jump;
	else $for_i = (integer)($unum/$jump) + 1;
	$text .= LIP_RECORDS.": $unum, ".LIP_PAGES.": $for_i<br>\n";
	$for_up = $pi - $pi%20 + 20;
	$for_down = $for_up - 20;
	if ($pi%20 == 0) {$for_up = $pi + 10; $for_down = $for_up - 20;}

	for ($fi=1; $fi<=$for_i; $fi++) {
   	if ($fi > $for_up) break;
   	if ($fi < $for_down) continue;
   	if ($pi == $fi) $text .= $fi;
   	else $text .= "<a href=\"".$scriptname.$getch."pi=$fi\">$fi</a>";
    	if ($fi == $for_i || $fi == $for_up) $text .= " \n";
    	else $text .= ", \n";
	}
	$text .= "<br>";
	if ($pi == 1 || !$for_i) $text .= LIP_BACK;
	else {
    	$pi--;
    	$text .= "<a href=\"".$scriptname.$getch."pi=$pi\">".LIP_BACK."</a>";
    	$pi++;
	}
	$text .= "&nbsp;&nbsp;";
	if ($pi == $for_i || !$for_i) $text .= LIP_FORWARD;
	else {
   	$pi++;
    $text .= "<a href=\"".$scriptname.$getch."pi=$pi\">".LIP_FORWARD."</a>";
	}
}
$text .= "<br/><br/>";

$text .= "<form method=\"post\" action=\"".e_SELF."\">
<table class=\"fborder\">";
if($use_table!="user" || $pref['lastip_list_user_table']) {
$text .= "<tr>
<td class=\"forumheader3\">".LIP_SEARCH."</td><td class=\"forumheader3\">
<input class=\"tbox\" type=\"text\" name=\"search\" />
</td>
</tr>
<tr>
<td class=\"forumheader3\">".LIP_SEARCH_WHAT."</td><td class=\"forumheader3\">
<select class=\"tbox\" name=\"s_type\">
<option value=\"user_id\" selected>".LIP_USER_ID."
<option value=\"user_name\">".LIP_USER_NAME."
<option value=\"user_ip\">".LIP_USER_IP."
</select>
</td>
</tr>
<tr>
<td class=\"forumheader3\" colspan=\"2\" style=\"text-align:center\">
<input class=\"button\" type=\"submit\" name=\"search_butt\" value=\"".LIP_SEARCH."\" />
</td>
</tr>
<tr>
<td class=\"forumheader3\" colspan=\"2\" style=\"text-align:center\">
<br />
</td>
</tr>";
}

$sela = ""; $selb = "";
if($pref['lastip_use_table']=="user") $sela = " checked";
else $selb = " checked";
$text .= "<tr>
<td class=\"forumheader3\">".LIP_TABLE_TO_USE."</td><td class=\"forumheader3\">
".LIP_CUSTOM_TABLE."<input type=\"radio\" name=\"lastip_use_table\" value=\"custom\"$selb />
&nbsp;&nbsp;user<input type=\"radio\" name=\"lastip_use_table\" value=\"user\"$sela />
</td>
</tr>";

if($pref['lastip_use_table']=="user") {
$sela = ""; $selb = "";
if($pref['lastip_list_user_table']==TRUE) $sela = " checked";
else $selb = " checked";
$text .= "<tr>
<td class=\"forumheader3\">".LIP_LIST_USER_USERS."</td><td class=\"forumheader3\">
".LIP_YES."<input type=\"radio\" name=\"lastip_list_user_table\" value=\"y\"$sela />
&nbsp;&nbsp;".LIP_NO."<input type=\"radio\" name=\"lastip_list_user_table\" value=\"n\"$selb />
</td>
</tr>";
}

$text .= "<tr>
<td class=\"forumheader3\">".LIP_UPP."</td><td class=\"forumheader3\">
<input class=\"tbox\" type=\"text\" name=\"lastip_users_per_page\" size=\"5\" />
".LIP_CURRENT.": ".$pref['lastip_users_per_page']."
</td>
</tr>";

if($pref['lastip_use_table']!="user") {
$text .= "<tr>
<td class=\"forumheader3\">".LIP_IPU."</td><td class=\"forumheader3\">
<input class=\"tbox\" type=\"text\" name=\"lastip_ips_per_user\" size=\"5\" />
".LIP_CURRENT.": ".$pref['lastip_ips_per_user']."
</td>
</tr>";

$sela = ""; $selb = "";
if($pref['lastip_change_date']==TRUE) $sela = " checked";
else $selb = " checked";
$text .= "<tr>
<td class=\"forumheader3\">".LIP_CHANGE_DATE."</td><td class=\"forumheader3\">
".LIP_YES."<input type=\"radio\" name=\"lastip_change_date\" value=\"y\"$sela />
&nbsp;&nbsp;".LIP_NO."<input type=\"radio\" name=\"lastip_change_date\" value=\"n\"$selb />
</td>
</tr>";
}

$text .= "<tr>
<td class=\"forumheader3\" colspan=\"2\" style=\"text-align:center\">
<input class=\"button\" type=\"submit\" name=\"save_prefs\" value=\"".LIP_SAVE_PREFS."\" />
</td>
</tr>
</table>
</form>
";

$text .= "</center>";
$ns -> tablerender(LIP_LAST_IP, $text);
require_once(e_ADMIN."footer.php");
?>
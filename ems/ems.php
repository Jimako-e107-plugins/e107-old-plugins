<?php
/*
+---------------------------------------------------------------+
|        EMS v1.7 - by ***RuSsE*** (www.e107.4xA.de) 19.03.2009
| 	 Original version 1.0 trunk of:	iNfLuX (influx604@gmail.com)
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
$lan_file = e_PLUGIN."ems/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."ems/languages/English.php");

if( $pref['ems_acces_class']!=255 )
{
if(ADMIN || benutzer_gruppe_pruefen($pref['ems_acces_class'], USERID, TRUE))
	{	
	if($pref['ems_cOr']==2)
		{
		if(file_exists("".THEME."ems_template2.php"))
			{
			require_once("".THEME."ems_template2.php");
			}
		else
			{
			require_once(e_PLUGIN."ems/ems_template2.php");
			}
		}
	else{
		if (file_exists("".THEME."ems_template.php"))
			{
			require_once("".THEME."ems_template.php");
			}
		else
			{
			require_once(e_PLUGIN."ems/ems_template.php");
			}
		}
	if (file_exists("ems_shortcodes.php"))
		{
		require_once("ems_shortcodes.php");
		}
	else
		{
		require_once(e_PLUGIN."ems/ems_shortcodes.php");
		}
  $usrname  = $_GET['usrname'];
  $usrRname  = $_GET['usrRname'];
  $gender   = $_GET['gender'];
  $fam_stat   = $_GET['fam_stat'];
  $location = $_GET['location'];
  $myData1 = $_GET['myData1'];
  $myData2 = $_GET['myData2'];
  $photo    = $_GET['photo'];
  $sort     = $_GET['sort'];
  
  $myAlter1 = $_GET['myAlter1'];
  $myAlter2 = $_GET['myAlter2'];

	if($myData2 && $myData1 > $myData2)
		{
		$TMP=$myData1; $myData1=$myData2; $myData2=$TMP;
		if($myData1==""){$myData1=$pref['ems_datumMin'];}
		}
	if($myAlter2 && $myAlter1 > $myAlter2)
		{
		$TMP=$myAlter1; $myAlter1=$myAlter2; $myAlter2=$TMP;
		if($myAlter1==""){$myAlter1=$pref['ems_datumMin'];}
		}
/*
$sql->db_Select("user_extended_struct", "*", "user_extended_struct_name='".$pref['ems_locfn']."'");
while($locrow = $sql->db_Fetch()){
    $locarr= explode(",",$locrow['user_extended_struct_values']);
    }
    if($locarr[0]=="user_extended_country"){
    $e107country = true;
    $sql->db_Select($locarr[0], "*");
    $locarr = array();
    $lociso= array();
     while($locrow = $sql->db_Fetch()){
     array_push($locarr, $locrow['country_name']);
     array_push($lociso, $locrow['country_iso']);
     }
    }
    $locarr_count = count($locarr);
*/
// Search form
   if($pref['ems_srchfrm']){
	$text = "<div style='text-align:center'>
    <form action='".e_SELF."' method='get'>
    <table style='width:90%' class='fborder'>
	<tr>
	<td style='vertical-align:top;' colspan='2' class='fcaption'>".EMS_111."</td>
	</tr>";
    if($pref['ems_usr']){
    $text .="
	<tr>
	<td class='forumheader3' style='vertical-align:top; text-align:left;'>".EMS_112."</td>
    <td class='forumheader3' style='vertical-align:top; text-align:center;'>
    <input class='tbox' style='width:250px;' type='text' name='usrname' value='".$usrname."' /></td>
    </tr>";
    }
     if($pref['ems_usrn']){
    $text .="
	<tr>
	<td class='forumheader3' style='vertical-align:top; text-align:left;'>".EMS_130."</td>
    <td class='forumheader3' style='vertical-align:top; text-align:center;'>
    <input class='tbox' style='width:250px;' type='text' name='usrRname' value='".$usrRname."' /></td>
    </tr>";
    }   
    if($pref['ems_loc']){
    $text .="
    <tr>
	<td class='forumheader3' style='vertical-align:top; text-align:left;'>".EMS_118."</td>
    <td class='forumheader3' style='vertical-align:top; text-align:center;'>
    <input class='tbox' style='width:250px;' type='text' name='location' value='".$location."' /></td>
    </tr>";
    }
    if($pref['ems_gend']){
    $text .="
	<tr>
	<td class='forumheader3' style='vertical-align:top; text-align:left;' >".EMS_113."</td>
	<td class='forumheader3' style='vertical-align:top; text-align:center;' >
    <select class='tbox' name='gender' style='width:250px;'>
    <option value='' ".($gender==""?" selected='selected'":"")."></option>
    <option value='".EMS_114."' ".($gender==EMS_114?" selected='selected'":"").">".EMS_114."</option>
    <option value='".EMS_115."' ".($gender==EMS_115?" selected='selected'":"").">".EMS_115."</option>";
 
if($pref['ems_gend_paar']==1){    
$text .="<option value='".EMS_128."' ".($gender==EMS_128?" selected='selected'":"").">".EMS_128."</option>";
		}
$text .="</select>
    </td>
	</tr>";
    }
if($pref['ems_fam_stat']){
    $text .="
	<tr>
	<td class='forumheader3' style='vertical-align:top; text-align:left;' >".EMS_110."</td>
	<td class='forumheader3' style='vertical-align:top; text-align:center;' >
    <select class='tbox' name='fam_stat' style='width:250px;'>
    <option value='' ".($gender==""?" selected='selected'":"")."></option>
    <option value='".EMS_AD36."' ".($gender==EMS_AD36?" selected='selected'":"").">".EMS_AD36."</option>
    <option value='".EMS_AD37."' ".($gender==EMS_AD37?" selected='selected'":"").">".EMS_AD37."</option>";
$text .="</select>
    </td>
	</tr>";
    }
  if($pref['ems_burt']){
    $text .="
	<tr>
	<td class='forumheader3' style='vertical-align:top; text-align:left;' >".EMS_150."</td>
	<td class='forumheader3' style='vertical-align:top; text-align:left;' >".EMS_134."
   <input class='tbox' style='width:50px;' type='text' name='myAlter1' value='".$myAlter1."' />&nbsp;&nbsp;".EMS_135."
   <input class='tbox' style='width:50px;' type='text' name='myAlter2' value='".$myAlter2."' />
    </td>
	</tr>";
    }  
 
  if($pref['ems_dat']){
    $text .="
	<tr>
	<td class='forumheader3' style='vertical-align:top; text-align:left;' >".EMS_131."</td>
	<td class='forumheader3' style='vertical-align:top; text-align:left;' >".EMS_134."
    <select class='tbox' name='myData1' style='width:60px;'>
    <option value='' ".($myData1==""?" selected='selected'":"")."></option>";
  $von=$pref['ems_datumMin'];$bis=$pref['ems_datumMax'];
  
  for($i=$von; $i<=$bis; $i++)
  {    
  $text .="  
  <option value='".$i."' ".($myData1==$i ?" selected='selected'":"").">".$i."</option>";
  }
$text .="    
    </select>&nbsp;&nbsp;".EMS_135."
    <select class='tbox' name='myData2' style='width:60px;'>
    <option value='' ".($myData2==""?" selected='selected'":"")."></option>";  
  for($i=$von; $i<=$bis; $i++)
  {    
  $text .="  
  <option value='".$i."' ".($myData2==$i ?" selected='selected'":"").">".$i."</option>";
  }
$text .="    
    </select>
    </td>
	</tr>";
    }
  
    
    if($pref['ems_photo']){
    $text .="
	<tr>
	<td class='forumheader3' style='vertical-align:top; text-align:left;' >".EMS_120."</td>
	<td class='forumheader3' style='vertical-align:top; text-align:center;' >
	<input type='checkbox' name='photo' ".($photo=="on"?"checked":"")." /></td>
	</tr>
	<tr>";
    }
    $text .="
	<td class='fcaption' style='vertical-align:top; text-align:center;' colspan='2'>
	<input class='button' type='submit' value='".EMS_116."' />
	</td>
	</tr>
    </table></form></div>";
   }
//

// Paraser - Part 1
	if($sort==""){
	$records = $pref['ems_rows'];
	$from = 0;
	} else {
		$qs = explode(".", $sort);
		$from = intval($qs[0]);
		$records = intval($qs[1]);
	}

    $pusr  = ($pref['ems_usr']  ? 'usrname='.$usrname.'&':'');
    $pusrn = ($pref['ems_usrn']  ? 'usrRname='.$usrRname.'&':'');
    $ploc  = ($pref['ems_loc']  ? 'location='.$location.'&':'');
    $pgend = ($pref['ems_gend'] ? 'gender='.$gender.'&':'');
    $datum1 = ($pref['ems_datum1'] ? 'myData1='.$myData1.'&':'');
    $datum2 = ($pref['ems_datum2'] ? 'myData2='.$myData2.'&':'');
    $altersv = ($pref['ems_burt'] ? 'myAlter1='.$myAlter1.'&':'');
    $altersb = ($pref['ems_burt'] ? 'myAlter2='.$myAlter2.'&':'');
    $pphoto= ($pref['ems_photo']? 'pphoto=on&':'');
    $psort = 'sort=[FROM].'.$records;

    if($photo=="on"){
    $parase = $pusr.$pusrn.$ploc.$pgend.$datum1.$datum2.$altersv.$altersb.$pphoto.$psort;
    }else{
    $parase = $pusr.$pusrn.$ploc.$pgend.$datum1.$datum2.$altersv.$altersb.$psort;
    }

//

    //foreach($gender as $gender);
    //foreach($location as $location);
    //foreach($myData1 as $myData1);
    //foreach($myData2 as $myData2);

// Search query parts
    $qusrname = "";
    $qusrRname ="";
    $qgender  = "";
    $qloc 	  = "";
    $qdat 	  = "";
    $qphoto   = "";
    $qalter   =	"";

    if($usrname && $usrname!=="" && $pref['ems_usr']){
      $qusrname =" AND user_name LIKE '%".$tp->toDB($usrname)."%'";
    }
    
    if($usrRname && $usrRname!=="" && $pref['ems_usrn']){
      $qusrRname =" AND user_login LIKE '%".$tp->toDB($usrRname)."%'";
    }

    if($location && $location!=="" && $pref['ems_loc']){
     $qloc =" AND user_".$pref['ems_locfn']." LIKE '%".$tp->toDB($location)."%'";
    }

    if($gender && $gender!=="" && $pref['ems_gend']){
     $qgender =" AND user_".$pref['ems_gendfn']." = '".$tp->toDB($gender)."'";
    }
	
	if($fam_stat && $fam_stat!=="" && $pref['ems_fam_stat']){
     $qfam_stat =" AND user_".$pref['ems_fam_stat_field']." = '".$tp->toDB($fam_stat)."'";
    }
    /////////////////////////////////// 
    //////////////////////////////////
    if($myAlter1 && $myAlter2!=="" &&  $myAlter2!=="" && $pref['ems_burt']){
    	$jetzt['dat'] = date("d");
    	$jetzt['mon'] = date("m"); 
    	$jetzt['year'] = date("Y");
    	
    	$myAltervon=$jetzt['year']-($myAlter2+1);
    	$myAltervon.="-".$jetzt['mon']."-".$jetzt['dat'];
    	$myAlterbis=$jetzt['year']-$myAlter1;
    	$myAlterbis.="-".$jetzt['mon']."-".$jetzt['dat'];
    	
  		$qalter =" AND user_".$pref['burt_field']." >= '".$myAltervon."' AND user_".$pref['burt_field']." <= '".$myAlterbis."' AND user_".$pref['burt_field']." != 0";   
 			}
///////////////////
    if($myData1 && $myData1!=="" &&  $myData2!=="" && $pref['ems_dat']){
    $myData1 .= "-01-01";
    if(!$myData2 || $myData2=="")
    	{
    	$myData2="2200-12-31";	
    	}
    else{$myData2.="-12-31";}
    
	////list($dat) = explode("-", $pref['ems_datum2']);
     $qdat =" AND user_".$pref['ems_datum1']." >= '".$myData1."' AND user_".$pref['ems_datum1']." <= '".$myData2."'";
 		 $qdat2 =" AND user_".$pref['ems_datum2']." >= '".$myData1."' AND user_".$pref['ems_datum2']." <= '".$myData2."'";
 		 $qdat3 =" AND user_".$pref['ems_datum1']." <= '".$myData1."' AND user_".$pref['ems_datum2']." >= '".$myData1."'";
    }

    if($photo=="on" && $pref['ems_photo']){
     $qphoto = " AND (user_sess LIKE '%.jpg%' OR user_sess LIKE '%.gif%' OR user_sess LIKE '%.jpeg%' OR user_sess LIKE '%.png%')";
    }
//

$SD1=$qusrname.$qusrRname.$qgender.$qfam_stat.$qalter.$qdat.$qphoto.$qloc;
$SD2=$qusrname.$qusrRname.$qgender.$qfam_stat.$qalter.$qdat2.$qphoto.$qloc;
$SD3=$qusrname.$qusrRname.$qgender.$qfam_stat.$qalter.$qdat3.$qphoto.$qloc;
// Search query
	  $qry_rows ="
	  SELECT u.*, ue.*
	  FROM #user AS u
      LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
	  WHERE user_ban = '0' ".$SD1." OR user_ban = '0' ".$SD2." OR user_ban = '0' ".$SD3."
      ORDER by user_name";

      $sql->db_Select_gen($qry_rows);
      $found = $sql->db_rows();

	  $qry ="
	  SELECT u.*, ue.*
	  FROM #user AS u
      LEFT JOIN #user_extended AS ue ON ue.user_extended_id=u.user_id
	  WHERE user_ban = '0' ".$SD1." OR user_ban = '0' ".$SD2." OR user_ban = '0' ".$SD3."
      ORDER by user_name
      LIMIT $from,$records";
//

      $sql->db_Select_gen($qry);

      if($sql->db_rows()==0){
        $results = "
        <tr>
        <td class='forumheader3' style='text-align:center' colspan='".($pref['ems_email']? "4":"3")."'><b>".EMS_117."</b></td>
        </tr>";
      }else{
      	$results = "";
      }

	if($found==0){
	$found ='0';
	}
	if(e_QUERY==""){
	$text .= "<br/><div style='text-align:center;'>".EMS_126.$found."</div><br/>";
	}else{
	$text .= "<br/><div style='text-align:center;'>".EMS_125.$found."</div><br/>";
	}
$text .= "<br />";
if($pref['ems_cOr']==2)	
{
	///$text .= $results;
 $text .= "<table style='width:100%' cellpadding='0' cellspacing='5'><tr>";
$ZAHLER=0;$NNS=$from;
     	while($row=$sql->db_Fetch())
    	{$ZAHLER++;$NNS++;
    	 if($ZAHLER > $pref['ems_cols'])
    	 		{
    	 		$text .="</tr><tr>";	$ZAHLER=1;
    	 		}    	
    if($pref['ems_gend'])
    	{
    	 $MY_BURTDAY="user_".$pref['burt_field'];    	 
    	 $RR="user_".$pref['ems_gendfn'];
    	 if($row[$RR]==""){$SEX=0;}
    	 elseif($row[$RR]==EMS_115){$SEX=2;}
    	 elseif($row[$RR]==EMS_128){$SEX=3;}
    	 else{$SEX=1;}
    	}else{$SEX=0;}
	$text .= renderuser($row,$NNS,$pref['ems_datum1'],$pref['ems_datum2'],$SEX,$MY_BURTDAY,"short");

    	}
   if($ZAHLER <= $pref['ems_cols'])
   	{
   	for($i=$ZAHLER; $i < $pref['ems_cols'];$i++)	
   		{
   		$text .= "<td style=''><table style='width:100%;font-size:80%;'><tr><td></td></tr></table></td>";	
   		}
   	}
$text .= "</tr></table>\n</div>";
}
else{
 $text .= "<table style='width:100%' class='fborder'>
   	<tr>
	<td class='fcaption' style='width:2%'>&nbsp;</td>
	<td class='fcaption' style='width:20%'>".EMS_121."</td>";
    if($pref['ems_usrn']){
    $text .="<td class='fcaption' style='width:20%'>".EMS_132."</td>";
    }	
	    if($pref['ems_email']){
    $text .="<td class='fcaption' style='width:20%'>".EMS_122."</td>";
    }
  	    if($pref['ems_dat']){
    $text .="<td class='fcaption' style='width:20%'>".EMS_133."</td>";
    }  
    $text .="
 	<td class='fcaption' style='width:20%'>".EMS_123."</td>
   	</tr>";
    $text .= $results;
     	while($row=$sql->db_Fetch())
    	{
		$text .= renderuser($row,$pref['ems_datum1'],$pref['ems_datum2'], "short");
    	}
	$text .= "</table>\n</div>";
		}
 	}
else
	{
	$text="<div style='text-align:center'><br /><br /><b>".EMS_142."</b><br /><br /><br /></div>";}
}
else{header("location:".e_HTTP."index.php");
      exit;}
      
// Paraser - Part 2
   if($found > $pref['ems_rows']){
    if($photo=="on"){
    $parms = $found.",".$records.",".$from.",".e_SELF.'?'.$parase;
    $text .="<div class='nextprev'>&nbsp;".$tp->parseTemplate("{NEXTPREV={$parms}}")."</div>";
    } else {
    $parms = $found.",".$records.",".$from.",".e_SELF.'?'.$parase;
    $text .="<div class='nextprev'>&nbsp;".$tp->parseTemplate("{NEXTPREV={$parms}}")."</div>";
    }
   }
////////////////////////////////////////
$ns->tablerender(PAGE_NAME_EMS_P1, $text);
require_once(FOOTERF);
/////////////////////////////
function renderuser($uid,$nr,$v,$b,$sex,$geburt)
	{
		global $sql, $tp, $ems_shortcodes;
		global $EMS_SHORT_TEMPLATE;
		global $user;
		$v="user_".$v."";
		$b="user_".$b."";
		if(is_array($uid))
		{
			$user = $uid;
			$qs = explode("-", $uid[$v]);
			$v=$qs[0];		
			$qs = explode("-", $uid[$b]);
			$b=$qs[0];
			if($v=="" || !$v){$v="";}
			if($b=="" || !$b){$b="";}
			$user['user_von'] = $v;
			$user['user_bis'] = $b;
			$user['nr'] = $nr;
			$user['user_burtd'] =$user[$geburt];
			if(!$user['user_burtd'] ||$user['user_burtd']==0 ||$user['user_burtd']=="0000-00-00")
			{$user['user_alter']=0;
			 $user['user_burtd']=0;
				}
			else{$user['user_alter'] =alter_ermittel($user['user_burtd']);
					$usergeb = explode("-", $user['user_burtd']);
					$user['user_burtd']=$usergeb[2].".".$usergeb[1].".".$usergeb[0];
					}
			$user['sex'] = $sex;
		}
		else
		{
			if(!$user = get_user_data($uid))
			{
				return FALSE;
			}
		}
	return $tp->parseTemplate($EMS_SHORT_TEMPLATE, FALSE, $ems_shortcodes);
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
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

$lan_file = e_PLUGIN."ems/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."ems/languages/English.php");

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
     array_push($lociso, $locrow['country_utf-8']);
     }
    }
    $locarr_count = count($locarr);
*/
	$text = "<br /><div style='text-align:center'>
    <form action='".e_PLUGIN."ems/ems.php' method='get'>
    <table style='width:100%' >";
    if($pref['ems_usr']){
    $text .="
	<tr>
	<td style='width:30%;text-align:left;'><span class='smalltext'>".EMS_136."</span></td>
    <td style='width:70%;text-align:left;'>
    <input class='tbox' style='width:118px;float:right' type='text' name='usrname' value='".$usrname."' /></td>
    </tr>";
    }
     if($pref['ems_usrn']){
    $text .="
	<tr>
	<td style='width:30%;text-align:left;'><span class='smalltext'>".EMS_137."</span></td>
    <td style='width:70%;text-align:left;'>
    <input class='tbox' style='width:118px;float:right' type='text' name='usrRname' value='".$usrRname."' /></td>
    </tr>";
    }
     
    if($pref['ems_loc']){
    $text .="
	<tr>
	<td style='width:30%;text-align:left;' ><span class='smalltext'>".EMS_138."</span></td>
    <td style='width:70%;text-align:left;' >
	<input class='tbox' style='width:118px;float:right' type='text' name='location' value='".$location."' />
    </td>
    </tr>";
    }
    if($pref['ems_gend']){
    $text .="
	<tr>
	<td style='width:30%;text-align:left;' ><span class='smalltext'>".EMS_139."</span></td>
	<td style='width:70%;text-align:left;' >
    <select name='gender' style='width:118px;float:right' class='tbox'>
    <option value='' ".($gender==""?" selected='selected'":"")."></option>
    <option value='".EMS_114."' ".($gender==EMS_114?" selected='selected'":"").">".EMS_114."</option>
    <option value='".EMS_115."' ".($gender==EMS_115?" selected='selected'":"").">".EMS_115."</option>
    </select>
    </td>
	</tr>";
    }
if($pref['ems_fam_stat']){
    $text .="
	<tr>
	<td style='width:30%;text-align:left;' ><span class='smalltext'>".EMS_110."</span></td>
	<td style='width:70%;text-align:left;' >
    <select name='fam_stat' style='width:118px;float:right' class='tbox'>
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
	<td style='width:30%;text-align:left;' ><span class='smalltext'>".EMS_150."</span></td>
	<td style='width:70%;text-align:left;' >".EMS_134."
   <input class='tbox' style='width:20px;' type='text' name='myAlter1' value='".$myAlter1."' />&nbsp;&nbsp;".EMS_135."
   <input class='tbox' style='width:20px;' type='text' name='myAlter2' value='".$myAlter2."' />
    </td>
	</tr>";
    } 
  if($pref['ems_datum']){
    $text .="
	<tr>
	<td style='width:30%' ><span class='smalltext'>".EMS_140."</span></td>
	<td style='width:70%' >
    <select class='tbox' name='myData1' style='width:50px;'>
    <option value='' ".($myData1==""?" selected='selected'":"")."></option>";
  $von=$pref['ems_datumMin'];$bis=$pref['ems_datumMax'];
  for($i=$von; $i<=$bis; $i++)
  {    
  $text .="  
  <option value='".$i."' ".($myData1==$i ?" selected='selected'":"").">".$i."</option>";
  }
$text .="    
    </select>&nbsp;-&nbsp;
    <select class='tbox' name='myData2' style='width:50px;'>
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
	<td colspan='2'><div style='float:left'><span class='smalltext'>".EMS_141."</span></div><div style='float:right'><input type='checkbox' name='photo' ".($photo=="on"?"checked":"")." /></div></td>
	</tr>";
    }
    $text .="
	<tr>
	<td  colspan='2'><div align='center'><input class='button' type='submit' value='".EMS_116."' /></div></td>
	</tr>
    </table></form></div>
    ";

  $ns->tablerender(PAGE_NAME_EMS_P1, $text, 'ems_menu');

?>
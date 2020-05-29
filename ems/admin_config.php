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

if (!getperms("P")) {
   header("location:".e_HTTP."index.php");
      exit;
}

$lan_file = e_PLUGIN."ems/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."ems/languages/English.php");


// check the extended fields names and return status.
if($sql->db_Select("user_extended","user_".$pref['ems_locfn'])){
 $locstat = EMS_AD11;
}else{
 $locstat = EMS_AD12;
}
if($sql->db_Select("user_extended","user_".$pref['ems_gendfn'])){
 $gendstat = EMS_AD11;
}else{
 $gendstat = EMS_AD12;
}
if($sql->db_Select("user_extended","user_".$pref['ems_datum1'])){
 $datstat = EMS_AD11;
}else{
 $datstat = EMS_AD12;
}
if($sql->db_Select("user_extended","user_".$pref['ems_datum2'])){
 $datsend = EMS_AD11;
}else{
 $datsend = EMS_AD12;
}
if($sql->db_Select("user_extended","user_".$pref['burt_field'])){
 $burtstart = EMS_AD11;
}else{
 $burtstart = EMS_AD12;
}

if($sql->db_Select("user_extended","user_".$pref['ems_fam_stat_field'])){
 $famstat = EMS_AD11;
}else{
 $famstat = EMS_AD12;
}

//

if (isset($_POST['updatepagesets'])) {

    if($_POST['ems_locfn']==""){
    $_POST['ems_locfn'] = "location";
    }

    if($_POST['ems_gendfn']==""){
    $_POST['ems_gendfn'] = "gender";
    }

    if($_POST['ems_datum1']==""){
    $_POST['ems_datum1'] = "my_data1";
    }
    
    if($_POST['ems_datum2']==""){
    $_POST['ems_datum2'] = "my_data2";
    }
    
    if($_POST['burt_field']==""){
    $_POST['burt_field'] = "birthday";
    }

	if($_POST['ems_fam_stat_field']==""){
    $_POST['ems_fam_stat_field'] = "family";
    }
    
    $pref['ems_srchfrm'] = $_POST['ems_srchfrm'];
    $pref['ems_usr'] = $_POST['ems_usr'];
    $pref['ems_usrn'] = $_POST['ems_usrn'];
    $pref['ems_loc'] = $_POST['ems_loc'];
    $pref['ems_gend']= $_POST['ems_gend'];
    $pref['ems_photo'] = $_POST['ems_photo'];
    $pref['ems_locfn'] = $_POST['ems_locfn'];
    $pref['ems_usrn'] = $_POST['ems_usrn'];
    $pref['ems_dat']= $_POST['ems_dat'];
    $pref['ems_datum1'] = $_POST['ems_datum1'];
    $pref['ems_datum2'] = $_POST['ems_datum2'];
    $pref['ems_datumMin'] = $_POST['ems_datumMin'];
    $pref['ems_datumMax'] = $_POST['ems_datumMax'];
    $pref['ems_cols'] = $_POST['ems_cols'];
    $pref['ems_rows'] = $_POST['ems_rows'];
    $pref['ems_cOr'] = $_POST['ems_cOr'];
    $pref['ems_acces_class'] = $_POST['ems_acces_class'];
    $pref['burt_field'] = $_POST['burt_field'];
    $pref['ems_burt'] = $_POST['ems_burt'];
    $pref['ems_email']  = $_POST['ems_email'];
    $pref['ems_gend_paar']  = $_POST['ems_gend_paar'];
	$pref['ems_fam_stat']  = $_POST['ems_fam_stat'];
	$pref['ems_fam_stat_field']  = $_POST['ems_fam_stat_field'];

    header("Location: ".e_SELF); // Required to get the right extended field status

    save_prefs();
    //$message = EMS_ADSC; // "settings updated successfully.";

}

     		$ret ="<select class='tbox' style='width:200px'  name='ems_acces_class'><option></option>";
       	$checked = ($pref['ems_acces_class'] == 0)? " selected='selected'" : "";
       	$ret .="<option value='0' $checked >".EMS_AD28."</option>"; 							//Jeder
       	$checked = ($pref['ems_acces_class'] == 252)? " selected='selected'" : "";
       	$ret .="<option value='252' $checked >".EMS_AD29."</option>"; 						//Nur Mitglieder
    	 	$checked = ($pref['ems_acces_class'] == 254)? " selected='selected'" : "";
    		$ret .="<option value='254' $checked >".EMS_AD30."</option>";							//Nur Admins
    		$checked = ($pref['ems_acces_class'] == 255)? " selected='selected'" : "";
     		$ret .="<option value='255' $checked >".EMS_AD31."</option>";							//keiner (inaktiv)
       	$sql -> db_Select('userclass_classes',"userclass_id, userclass_name"," ORDER BY userclass_name", "no_where");
        while($row = $sql-> db_Fetch()){
    				extract($row);
     				$checked = ($userclass_id == $pref['ems_acces_class'])? " selected='selected' " : "";
     				$ret .="<option value='".$userclass_id."' $checked > $userclass_name </option>";
      			}
    		$ret .="</select>";

require_once(e_ADMIN."auth.php");
if (isset($message)) {
	$ns->tablerender("", "<div style='text-align:center'><b>$message</b></div>");
}


  		$text .= "<div style='text-align:center'>
  		<form method='post' action='".e_SELF."'>
 		<table style='width:100%' class='fborder'>
        <tr>
        <td style='vertical-align:top;' colspan='2' class='fcaption'>".EMS_AD04."</td>
        </tr>
		<tr>
		<td style='width:40%;vertical-align:top;' class='forumheader3'>".EMS_AD13."</td>
        <td style='width:60%;vertical-align:top;' class='forumheader3'><input name='ems_srchfrm' type='checkbox' value='1' ".($pref['ems_srchfrm']==1?" checked='checked' ":"")." /></td>
		</tr>
		<tr>
		<td style='width:40%;vertical-align:top;' class='forumheader3'>".EMS_AD05."</td>
        <td style='width:60%;vertical-align:top;' class='forumheader3'><input name='ems_usr' type='checkbox' value='1' ".($pref['ems_usr']==1?" checked='checked' ":"")." /></td>
		</tr>
		<tr>
		<td style='width:40%;vertical-align:top;' class='forumheader3'>".EMS_AD15."</td>
        <td style='width:60%;vertical-align:top;' class='forumheader3'><input name='ems_usrn' type='checkbox' value='1' ".($pref['ems_usrn']==1?" checked='checked' ":"")." /></td>
		</tr>
		<tr>
		<td style='width:40%;vertical-align:top;' class='forumheader3'>".EMS_AD06."".($pref['ems_loc']==1?"<br/><br/><br/>".EMS_AD09."":"")."</td>
        <td style='width:60%;vertical-align:top;' class='forumheader3'>
        <input name='ems_loc' type='checkbox' value='1' ".($pref['ems_loc']==1?" checked='checked' ":"")." />
        ".($pref['ems_loc']==1?"<br/><br/>user_&nbsp;<input style='width: 150px; border: 1px solid #CCCCCC; color: #000; font: 7pt verdana, tahoma, arial, helvetica, sans-serif; background-color: #FFFFFF;' name='ems_locfn' type='text' value='".$pref['ems_locfn']."'  />".$locstat."
				<br/>".EMS_AD40."<b>".EMS_AD42."</b>":"")."
        </td>
		</tr>
		<tr>
		<td style='width:40%;vertical-align:top;' class='forumheader3'>".EMS_AD07."".($pref['ems_gend']==1?"<br/><br/><br/>".EMS_AD10."":"")."</td>
        <td style='width:60%;vertical-align:top;' class='forumheader3'>
        <input name='ems_gend' type='checkbox' value='1' ".($pref['ems_gend']==1?" checked='checked' ":"")." />
        ".($pref['ems_gend']==1?"<br/>
				<br/>user_&nbsp;<input style='width: 150px; border: 1px solid #CCCCCC; color: #000; font: 7pt verdana, tahoma, arial, helvetica, sans-serif; background-color: #FFFFFF;' name='ems_gendfn' type='text' value='".$pref['ems_gendfn']."'  />".$gendstat."
				<br/>".EMS_AD40."<b>".EMS_AD41."</b>
				<br/>".EMS_AD39." <b>".EMS_114."</b>".EMS_AD38."<b>".EMS_115."</b>
				<br/>
				<input name='ems_gend_paar' type='checkbox' value='1' ".($pref['ems_gend_paar']==1?" checked='checked' ":"")." /> ".EMS_129." ".EMS_129a." ":"")."
        </td>
		</tr>
		
		<tr>
		<td style='width:40%;vertical-align:top;' class='forumheader3'>".EMS_AD34."".($pref['ems_fam_stat']==1?"<br/><br/><br/>".EMS_AD35."":"")."</td>
        <td style='width:60%;vertical-align:top;' class='forumheader3'>
        <input name='ems_fam_stat' type='checkbox' value='1' ".($pref['ems_fam_stat']==1?" checked='checked' ":"")." />
        ".($pref['ems_fam_stat']==1?"<br/><br/>user_&nbsp;<input style='width: 150px; border: 1px solid #CCCCCC; color: #000; font: 7pt verdana, tahoma, arial, helvetica, sans-serif; background-color: #FFFFFF;' name='ems_fam_stat_field' type='text' value='".$pref['ems_fam_stat_field']."'  />".$famstat."
				<br/>".EMS_AD40."<b>".EMS_AD41."</b>
				<br/>".EMS_AD39." <b>".EMS_AD36."</b>".EMS_AD38."<b>".EMS_AD37."</b>":"")."
		</td>
		</tr>	
		<tr>
		<td style='width:40%;vertical-align:top;' class='forumheader3'>".EMS_AD32."".($pref['ems_burt']==1?"<br/><br/><br/>".EMS_AD33."":"")."</td>
        <td style='width:60%;vertical-align:top;' class='forumheader3'>
        <input name='ems_burt' type='checkbox' value='1' ".($pref['ems_burt']==1?" checked='checked' ":"")." />
        ".($pref['ems_burt']==1?"<br/><br/>user_&nbsp;<input style='width: 150px; border: 1px solid #CCCCCC; color: #000; font: 7pt verdana, tahoma, arial, helvetica, sans-serif; background-color: #FFFFFF;' name='burt_field' type='text' value='".$pref['burt_field']."'  />".$burtstart."":"")."
        </td>
		</tr>
		
		<tr>
		<td style='width:40%;vertical-align:top;' class='forumheader3'>".EMS_AD16."".($pref['ems_dat']==1?"<br/><br/><br/>".EMS_AD17."":"")."</td>
        <td style='width:60%;vertical-align:top;' class='forumheader3'>
        <input name='ems_dat' type='checkbox' value='1' ".($pref['ems_dat']==1?" checked='checked' ":"")." />
                
        ".($pref['ems_dat']==1?"<br/><br/><b>".EMS_AD18."</b> user_&nbsp;<input style='width: 150px; border: 1px solid #CCCCCC; color: #000; font: 7pt verdana, tahoma, arial, helvetica, sans-serif; background-color: #FFFFFF;' name='ems_datum1' type='text' value='".$pref['ems_datum1']."'  />".$datstat."
                                      <br/><b>".EMS_AD19."</b> user_&nbsp;<input style='width: 150px; border: 1px solid #CCCCCC; color: #000; font: 7pt verdana, tahoma, arial, helvetica, sans-serif; background-color: #FFFFFF;' name='ems_datum2' type='text' value='".$pref['ems_datum2']."'  />".$datsend."
                                      <br/>".EMS_AD40."<b>".EMS_AD43."</b>
										  <br/>".EMS_AD20."<input style='width: 40px; border: 1px solid #CCCCCC; color: #000; font: 7pt verdana, tahoma, arial, helvetica, sans-serif; background-color: #FFFFFF;' name='ems_datumMin' type='text' value='".$pref['ems_datumMin']."'  />
                                      -<input style='width: 40px; border: 1px solid #CCCCCC; color: #000; font: 7pt verdana, tahoma, arial, helvetica, sans-serif; background-color: #FFFFFF;' name='ems_datumMax' type='text' value='".$pref['ems_datumMax']."'  />".EMS_AD21."
                                      ":"")."       
        </td>
		</tr>		
		<tr>
		<td style='width:40%;vertical-align:top;' class='forumheader3'>".EMS_AD08."</td>
        <td style='width:60%;vertical-align:top;' class='forumheader3'><input name='ems_photo' type='checkbox' value='1' ".($pref['ems_photo']==1?" checked='checked' ":"")." /></td>
		</tr>
		<tr>
		<td style='width:40%;vertical-align:top;' class='forumheader3'>".EMS_AD14."</td>
        <td style='width:60%;vertical-align:top;' class='forumheader3'><input name='ems_email' type='checkbox' value='1' ".($pref['ems_email']==1?" checked='checked' ":"")." /></td>
		</tr>
		<tr>
				<td style='width:40%;vertical-align:top;' class='forumheader3'>".EMS_AD22."</td>
        <td style='width:60%;vertical-align:top;' class='forumheader3'>
            <select class='tbox' name='ems_cOr' style='width:250px;'>
    					<option value='1' ".($pref['ems_cOr']==1?" selected='selected'":"").">".EMS_AD23."</option>
    					<option value='2' ".($pref['ems_cOr']==2?" selected='selected'":"").">".EMS_AD24."</option>
    				</select>
        </td>
		</tr>
		<tr>
				<td style='width:40%;vertical-align:top;' class='forumheader3'>".EMS_AD25."</td>
        <td style='width:60%;vertical-align:top;' class='forumheader3'> 
        <input style='width: 150px; border: 1px solid #CCCCCC; color: #000; font: 7pt verdana, tahoma, arial, helvetica, sans-serif; background-color: #FFFFFF;' name='ems_rows' type='text' value='".$pref['ems_rows']."' />     
        </td>
		</tr>
		<tr>
				<td style='width:40%;vertical-align:top;' class='forumheader3'>".EMS_AD26."</td>
        <td style='width:60%;vertical-align:top;' class='forumheader3'> 
        <input style='width: 150px; border: 1px solid #CCCCCC; color: #000; font: 7pt verdana, tahoma, arial, helvetica, sans-serif; background-color: #FFFFFF;' name='ems_cols' type='text' value='".$pref['ems_cols']."' />     
        </td>
		</tr>
		<tr>
				<td style='width:40%;vertical-align:top;' class='forumheader3'>".EMS_AD27."</td>
        <td style='width:60%;vertical-align:top;' class='forumheader3'> 
           ".$ret."
        </td>
		</tr>
     <tr>
        <td colspan='2' class='fcaption'><div align='center'><input class='button' name='updatepagesets' type='submit' value='".PHOTO_btncap."' /></div></td>
     </tr>
        </table></form></div>";


   		$ns->tablerender("<div style='text-align:center'>".EMS_AD02."</div>", $text);

require_once(e_ADMIN."footer.php");

?>
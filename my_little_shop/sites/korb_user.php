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
require_once("../handler/constanten.php");
require_once(HEADERF);
$lan_file = e_PLUGIN.PLUG_FOLDER."languages/".e_LANGUAGE."/korb_user_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN.PLUG_FOLDER."languages/German/korb_user_lan.php");
require_once("../handler/form_handler.php");

$versand_variablen[1]['value']=1.00;  ///Kreditkarte 
$versand_variablen[1]['text']="Kreditkarte";
$versand_variablen[2]['value']=5.00;  ///Vorkasse
$versand_variablen[2]['text']="Vorkasse";
$versand_variablen[3]['value']=8.00;  ///Nachnahme 
$versand_variablen[3]['text']="Nachnahme";

// ============= START OF THE BODY ====================================
if (e_QUERY) {
	list($action,$id,$from) = explode(".", e_QUERY);
	$id = intval($id);
	//$from = intval($from);
	unset($tmp);
}
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if(!USER)
{
	$text="<div style='text-align:center'><br/><br/>
						<table cellpadding='5' cellspacing='5' style='width:100%'>
							<tr>
								<td class='fcaption' style='width:50%'>".MLS_LAN_KORB_USER_0."</td>
								<td class='fcaption' style='width:50%'>".MLS_LAN_KORB_USER_1."</td>
							</tr>
							<tr>
								<td class='forumheader2' style='width:50%; padding:10px;'>".MLS_LAN_KORB_USER_2.".<br/><br/>
											".MLS_LAN_KORB_USER_3."
											<a href='user_signup.php'>".MLS_LAN_KORB_USER_4."</a><br/><br/>
								</td>
								<td class='forumheader2' style='width:50%;padding:10px;'>".MLS_LAN_KORB_USER_5."
									<br/><br/>".MLS_LAN_KORB_USER_6."<br/><br/><br/>
								</td>
							</tr>
						</table>";
	$title="<b>".MLS_LAN_KORB_USER_7."</b>";
}
else{
//--------------------------------------------------------------------------------
 $qry1="
 SELECT a.*, aa.*, ab.*, ac.*, ad.* FROM ".MPREFIX."mls_temp AS a
 LEFT JOIN ".MPREFIX."mls_products AS aa ON aa.mls_products_id=a.mls_temp_products_id
 LEFT JOIN ".MPREFIX."mls_category AS ab ON ab.mls_category_id=aa.mls_products_category_id
 LEFT JOIN ".MPREFIX."mls_steuer AS ac ON ac.mls_steuer_id=ab.mls_category_steuer_id
 LEFT JOIN ".MPREFIX."mls_hersteller AS ad ON ad.mls_hersteller_id=aa.mls_products_hersteller_id
 WHERE a.mls_temp_user_ip ='".USERIP."'
   			";

 $sql->db_Select_gen($qry1);
 $counter=0;

$text="<div style='text-align:center'><br/><br/>".MLS_LAN_KORB_USER_8."<br/><br/></div>";
$title="<b>".MLS_LAN_KORB_USER_9."</b>";

   	$tablename = "mls_kunde_data";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "mls_kunde_data_id";   // first column of your table.
    $e_wysiwyg = "mls_kunde_data_text"; // commas seperated list of textareas to use wysiwyg with.

		$i_R=1;
// 1
    $fieldcapt[$i_R] = "mls_kunde_data_use_id";//Vorname
    $fieldname[$i_R] = "mls_kunde_data_use_id";
    $fieldtype[$i_R] = "text";
    $fieldvalu[$i_R] = "".USERID."";
		$fieldpflicht[$i_R] = 0;
		$i_R++;
// 2  
    $fieldcapt[$i_R] = "mls_kunde_data_name";//Vorname
    $fieldname[$i_R] = "mls_kunde_data_name";
    $fieldtype[$i_R] = "text";
    $fieldvalu[$i_R] = "";
    $fieldpflicht[$i_R] = 0;
		$i_R++;
//3
    $fieldcapt[$i_R] = MLS_LAN_KORB_USER_15;//Anrede
    $fieldname[$i_R] = "mls_kunde_data_sex";
    $fieldtype[$i_R] = "dropdown2";
    $fieldvalu[$i_R] = "1:".MLS_LAN_KORB_USER_10.",2:".MLS_LAN_KORB_USER_11.",3:".MLS_LAN_KORB_USER_12."";
    $fieldpflicht[$i_R] = 1;
		$i_R++;
// 4
    $fieldcapt[$i_R] = MLS_LAN_KORB_USER_16;//Vorname
    $fieldname[$i_R] = "mls_kunde_data_firstname";
    $fieldtype[$i_R] = "text";
    $fieldvalu[$i_R] = ",20";
    $fieldpflicht[$i_R] = 1;
		$i_R++;
// 5
    $fieldcapt[$i_R] = MLS_LAN_KORB_USER_17;//Name
    $fieldname[$i_R] = "mls_kunde_data_secondname";
    $fieldtype[$i_R] = "text";
    $fieldvalu[$i_R] = ",20";
    $fieldpflicht[$i_R] = 1;
    $i_R++;
// 6
    $fieldcapt[$i_R] = MLS_LAN_KORB_USER_18;//Name
    $fieldname[$i_R] = "mls_kunde_data_contry";
    $fieldtype[$i_R] = "dropdown2";
    $fieldvalu[$i_R] = "1:".MLS_LAN_KORB_USER_19."";
    $fieldpflicht[$i_R] = 1;
    $i_R++;
// 7
		$fieldcapt[$i_R] = MLS_LAN_KORB_USER_26;//Name
    $fieldname[$i_R] = "mls_kunde_data_plz";
    $fieldtype[$i_R] = "text";
    $fieldvalu[$i_R] = ",4";
    $fieldpflicht[$i_R] = 1;
    $i_R++;
// 8
		$fieldcapt[$i_R] = MLS_LAN_KORB_USER_27;//Name
    $fieldname[$i_R] = "mls_kunde_data_sity";
    $fieldtype[$i_R] = "text";
    $fieldvalu[$i_R] = ",20";
    $fieldpflicht[$i_R] = 1;
    $i_R++;
// 9
    $fieldcapt[$i_R] = MLS_LAN_KORB_USER_28;//Name
    $fieldname[$i_R] = "mls_kunde_data_sreet";
    $fieldtype[$i_R] = "text";
    $fieldvalu[$i_R] = ",20";
    $fieldpflicht[$i_R] = 1;
    $i_R++;
// 10
    $fieldcapt[$i_R] = MLS_LAN_KORB_USER_29;//Name
    $fieldname[$i_R] = "mls_kunde_data_telephon";
    $fieldtype[$i_R] = "text";
    $fieldvalu[$i_R] = ",20";
    $fieldpflicht[$i_R] = 1;
    $i_R++;
// 11
    $fieldcapt[$i_R] = "mls_kunde_data_text";//Name
    $fieldname[$i_R] = "mls_kunde_data_text";
    $fieldtype[$i_R] = "textarea";     // textarea with wysiwyg support (see above)
    $fieldvalu[$i_R] = ",200px,100px";
    $fieldpflicht[$i_R] = 0;
    $i_R++;
// 12
    $fieldcapt[$i_R] = MLS_LAN_KORB_USER_30;//Name
    $fieldname[$i_R] = "mls_kunde_data_enable";
    $fieldtype[$i_R] = "checkbox";
    $fieldvalu[$i_R] = "1";
    $fieldpflicht[$i_R] = 1;
		$i_R++;
    
//////////////////////////////////////////////////////////////////////////

    $i_L=13;
    $fieldcapt[$i_L] = MLS_LAN_KORB_USER_15;//Anrede
    $fieldname[$i_L] = "mls_kunde_lifer_sex";
    $fieldtype[$i_L] = "dropdown2";
    $fieldvalu[$i_L] = "1:".MLS_LAN_KORB_USER_10.",2:".MLS_LAN_KORB_USER_11.",3:".MLS_LAN_KORB_USER_12."";
		$i_L++;
// 14		
    $fieldcapt[$i_L] = MLS_LAN_KORB_USER_16;//Vorname
    $fieldname[$i_L] = "mls_kunde_lifer_firstname";
    $fieldtype[$i_L] = "text";
    $fieldvalu[$i_L] = ",20";
		$i_L++;
// 15
    $fieldcapt[$i_L] = MLS_LAN_KORB_USER_17;//Name
    $fieldname[$i_L] = "mls_kunde_lifer_secondname";
    $fieldtype[$i_L] = "text";
    $fieldvalu[$i_L] = ",20";
		$i_L++;
// 16
    $fieldcapt[$i_L] = MLS_LAN_KORB_USER_18;//Name
    $fieldname[$i_L] = "mls_kunde_lifer_contry";
    $fieldtype[$i_L] = "dropdown2";
    $fieldvalu[$i_L] = "1:".MLS_LAN_KORB_USER_19."";
		$i_L++;
// 17
		$fieldcapt[$i_L] = MLS_LAN_KORB_USER_26;//Name
    $fieldname[$i_L] = "mls_kunde_lifer_plz";
    $fieldtype[$i_L] = "text";
    $fieldvalu[$i_L] = ",4";
		$i_L++;
// 18
		$fieldcapt[$i_L] = MLS_LAN_KORB_USER_27;//Name
    $fieldname[$i_L] = "mls_kunde_lifer_sity";
    $fieldtype[$i_L] = "text";
    $fieldvalu[$i_L] = ",20";
		$i_L++;
// 19
		$fieldcapt[$i_L] = MLS_LAN_KORB_USER_28;//Name
    $fieldname[$i_L] = "mls_kunde_lifer_sreet";
    $fieldtype[$i_L] = "text";
    $fieldvalu[$i_L] = ",20";
		$i_L++;
$rs = new my_form;		

/*

mls_kunde_data (
  mls_kunde_data_id
  mls_kunde_data_use_id
  mls_kunde_data_name
  mls_kunde_data_sex
  mls_kunde_data_firstname
  mls_kunde_data_secondname
  mls_kunde_data_contry
  mls_kunde_data_plz
  mls_kunde_data_sity
  
  mls_kunde_data_sreet
  mls_kunde_data_mail
  mls_kunde_data_telephon
  mls_kunde_data_text
  mls_kunde_data_enable
  
  
  mls_kunde_lifer_sex
  mls_kunde_lifer_firstname
  mls_kunde_lifer_secondname
  mls_kunde_lifer_contry
  mls_kunde_lifer_plz
  mls_kunde_lifer_sity
  mls_kunde_lifer_sreet
  mls_kunde_data_image
  mls_kunde_data_pref

*/
///+++++++++++++++++++++++++++++++++++++++++
if(isset($_POST['submitit']))
	{
		$inputstr .= " '".USERID."',"; //1
		$inputstr .= " '',"; //2
		if(!$_POST[$fieldname[3]]){$message1="".MLS_LAN_KORB_USER_15."".MLS_LAN_KORB_USER_32."<br/>";}
		else{	
		$inputstr .= " '".$tp->toDB($_POST[$fieldname[3]])."',";  //Anrede
				}
		if(strlen($_POST[$fieldname[4]])< 3 ){$message1="".MLS_LAN_KORB_USER_16."".MLS_LAN_KORB_USER_33."<br/>";}
		else{
				$inputstr .= " '".$tp->toDB($_POST[$fieldname[4]])."',";  // Vorname
				}
		if(strlen($_POST[$fieldname[5]])< 3 ){$message1.="".MLS_LAN_KORB_USER_17."".MLS_LAN_KORB_USER_33."<br/>";}
		else{
				$inputstr .= " '".$tp->toDB($_POST[$fieldname[5]])."',"; //Nachname
				}				
		$inputstr .= " '".$tp->toDB($_POST[$fieldname[6]])."',"; // Land
		if(strlen(intval($_POST[$fieldname[7]]))!= 5 || !is_numeric($_POST[$fieldname[7]])){$message1.="".MLS_LAN_KORB_USER_26."".MLS_LAN_KORB_USER_31."<br/>";}
		else{
				$inputstr .= " '".$tp->toDB($_POST[$fieldname[7]])."',"; ///Plz
				}
		if(strlen($_POST[$fieldname[8]])< 3){$message1.="".MLS_LAN_KORB_USER_34."".MLS_LAN_KORB_USER_33."<br/>";}
		else{
				$inputstr .= " '".$tp->toDB($_POST[$fieldname[8]])."',"; ///Ort
				}
		if(strlen($_POST[$fieldname[9]])< 4){$message1.="".MLS_LAN_KORB_USER_35."".MLS_LAN_KORB_USER_33."<br/>";}
		else{
				$inputstr .= " '".$tp->toDB($_POST[$fieldname[9]])."',"; ///Strasse
				}
		$inputstr .= " '',"; //10
		$inputstr .= " '".$tp->toDB($_POST[$fieldname[10]])."',";
		$inputstr .= " '".$tp->toDB($_POST[$fieldname[11]])."',";
		$inputstr .= " '".$tp->toDB($_POST[$fieldname[12]])."',";
		
		$inputstr .= " '".$tp->toDB($_POST[$fieldname[13]])."',";
		$inputstr .= " '".$tp->toDB($_POST[$fieldname[14]])."',";
		$inputstr .= " '".$tp->toDB($_POST[$fieldname[15]])."',";
		$inputstr .= " '".$tp->toDB($_POST[$fieldname[16]])."',";
		$inputstr .= " '".$tp->toDB($_POST[$fieldname[17]])."',";		
		$inputstr .= " '".$tp->toDB($_POST[$fieldname[18]])."',";
		$inputstr .= " '".$tp->toDB($_POST[$fieldname[19]])."',";
		$inputstr .= " '',"; //20
		$inputstr .= " ''"; //21	
		$sql -> db_Insert($tablename, "0, ".$inputstr." ");
		if($message1!=""){$message=MLS_LAN_KORB_USER_36.$message1;}
	}
///+++++++++++++++++++++++++++++++++++++++++
if(IsSet($_POST['update']))
		{
		$inputstr = " ".$fieldname[1]." = '".USERID."',"; //1
		$inputstr .= " mls_kunde_data_name = '',"; //2
		if(!$_POST[$fieldname[3]]){$message1="".MLS_LAN_KORB_USER_15."".MLS_LAN_KORB_USER_32."<br/>";}
		else{	
		$inputstr .= " ".$fieldname[3]." = '".$tp->toDB($_POST[$fieldname[3]])."',";
				}
		if(strlen($_POST[$fieldname[4]])< 3 ){$message1="".MLS_LAN_KORB_USER_16."".MLS_LAN_KORB_USER_33."<br/>";}
		else{
		$inputstr .= " ".$fieldname[4]." = '".$tp->toDB($_POST[$fieldname[4]])."',";
				}
		if(strlen($_POST[$fieldname[5]])< 3 ){$message1.="".MLS_LAN_KORB_USER_17."".MLS_LAN_KORB_USER_33."<br/>";}
		else{
		$inputstr .= " ".$fieldname[5]." = '".$tp->toDB($_POST[$fieldname[5]])."',";
				}
		$inputstr .= " ".$fieldname[6]." = '".$tp->toDB($_POST[$fieldname[6]])."',";
		if(strlen(intval($_POST[$fieldname[7]]))!= 5 || !is_numeric($_POST[$fieldname[7]])){$message1.="".MLS_LAN_KORB_USER_26."".MLS_LAN_KORB_USER_31."<br/>";}
		else{
		$inputstr .= " ".$fieldname[7]." = '".$tp->toDB($_POST[$fieldname[7]])."',";
				}
		if(strlen($_POST[$fieldname[8]])< 3){$message1.="".MLS_LAN_KORB_USER_34."".MLS_LAN_KORB_USER_33."<br/>";}
		else{
		$inputstr .= " ".$fieldname[8]." = '".$tp->toDB($_POST[$fieldname[8]])."',";
				}
		if(strlen($_POST[$fieldname[9]])< 4){$message1.="".MLS_LAN_KORB_USER_35."".MLS_LAN_KORB_USER_33."<br/>";}
		else{
		$inputstr .= " ".$fieldname[9]." = '".$tp->toDB($_POST[$fieldname[9]])."',";
				}
		$inputstr .= " mls_kunde_data_mail = '',"; //10
		$inputstr .= " ".$fieldname[10]." = '".$tp->toDB($_POST[$fieldname[10]])."',";
		$inputstr .= " ".$fieldname[11]." = '".$tp->toDB($_POST[$fieldname[11]])."',";
		$inputstr .= " ".$fieldname[12]." = '".$tp->toDB($_POST[$fieldname[12]])."',";
		$inputstr .= " ".$fieldname[13]." = '".$tp->toDB($_POST[$fieldname[13]])."',";
		$inputstr .= " ".$fieldname[14]." = '".$tp->toDB($_POST[$fieldname[14]])."',";
		$inputstr .= " ".$fieldname[15]." = '".$tp->toDB($_POST[$fieldname[15]])."',";
		$inputstr .= " ".$fieldname[16]." = '".$tp->toDB($_POST[$fieldname[16]])."',";
		$inputstr .= " ".$fieldname[17]." = '".$tp->toDB($_POST[$fieldname[17]])."',";		
		$inputstr .= " ".$fieldname[18]." = '".$tp->toDB($_POST[$fieldname[18]])."',";
		$inputstr .= " ".$fieldname[19]." = '".$tp->toDB($_POST[$fieldname[19]])."',";
		$inputstr .= " mls_kunde_data_image = '',"; //20
		$inputstr .= " mls_kunde_data_pref = ''"; //21
		$sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['table_id']."' ");
		
		if($message1!=""){$message=MLS_LAN_KORB_USER_36.$message1;}
		}
///+++++++++++++++++++++++++++++++++++++++++
$table_total = $sql -> db_Select("mls_kunde_data","*","mls_kunde_data_use_id ='".USERID."' LIMIT 1");
if($table_total)
	{
	$ANREDE_TEXT[0]="";
  $ANREDE_TEXT[1]="Herr";
	$ANREDE_TEXT[2]="Frau";
	$ANREDE_TEXT[3]="Firma";
	//--------
	$LAND[0]="";
	$LAND[1]="Deutschland";
	$LAND[2]="";
	$LAND[3]="";
	$LAND[4]="";
	$LAND[5]="";
	$LAND[6]="";
			
	$sql -> db_Select("mls_kunde_data","*","mls_kunde_data_use_id ='".USERID."'");
	$row = $sql-> db_Fetch();
	$KUNDE_DATA_TEXT="
  				<table cellpadding='0' cellspacing='0' style='width:100%'>
						<tr>
							<td class='forumheader' style='width:50%;text-align:left;vertica-align:bottom;border-bottom:1px;padding:10px;'>".MLS_LAN_KORB_USER_40."<br/></td>
							<td class='forumheader' style='width:50%;text-align:left;vertica-align:bottom;border-left:1px;border-bottom:1px;'>".MLS_LAN_KORB_USER_41."<br/></td>
						</tr>
						<tr>
							<td class='forumheader' style='vertical-align:top;width:50%;text-align:left;border-bottom:0px;'><br/>
							".$ANREDE_TEXT[$row[$fieldname[3]]]."<br/>
							".$row[$fieldname[4]]."&nbsp;".$row[$fieldname[5]]."<br/>
							".$row[$fieldname[9]]."<br/><br/>
							".$row[$fieldname[7]]."&nbsp;".$row[$fieldname[8]]."<br/>
							".$LAND[$row[$fieldname[6]]]."<br/><br/>
							".MLS_LAN_KORB_USER_95."&nbsp;".$row[$fieldname[10]]."<br/><br/><br/>
							</td>
							<td class='forumheader' style='vertical-align:top;width:50%;text-align:left;padding:10px;border-left:1px;border-bottom:0px;'><br/>";

	$KUNDE_DATA_TEXT .=(!$row[$fieldname[13]] ? $ANREDE_TEXT[$row[$fieldname[3]]] :  $ANREDE_TEXT[$row[$fieldname[13]]]);	// Anrede	
	$KUNDE_DATA_TEXT .="<br/>";
	$KUNDE_DATA_TEXT .=(!$row[$fieldname[14]] ? $row[$fieldname[4]] :  $row[$fieldname[14]]); // Vorname
	$KUNDE_DATA_TEXT .="&nbsp;";
	$KUNDE_DATA_TEXT .=(!$row[$fieldname[15]] ? $row[$fieldname[5]] :  $row[$fieldname[15]]); // Nachname
	$KUNDE_DATA_TEXT .="<br/>";
	$KUNDE_DATA_TEXT .=(!$row[$fieldname[19]] ? $row[$fieldname[9]] :  $row[$fieldname[19]]); // Strasse
	$KUNDE_DATA_TEXT .="<br/><br/>";
	$KUNDE_DATA_TEXT .=(!$row[$fieldname[17]] ? $row[$fieldname[7]] :  $row[$fieldname[17]]); // PLZ
	$KUNDE_DATA_TEXT .="&nbsp;";
	$KUNDE_DATA_TEXT .=(!$row[$fieldname[18]] ? $row[$fieldname[8]] :  $row[$fieldname[18]]); // Ort
	$KUNDE_DATA_TEXT .="<br/>";
	$KUNDE_DATA_TEXT .=(!$row[$fieldname[16]] ? $LAND[$row[$fieldname[6]]] :  $LAND[$row[$fieldname[16]]]); // Land
	$KUNDE_DATA_TEXT .="<br/><br/><br/>
							</td></tr>";
/////------------------------------------	
if(IsSet($_POST['edit']))
	{
	$sql -> db_Select($tablename, "*", " $primaryid='".$_POST['table_id']."' ");
	$row = $sql-> db_Fetch();
	$text = "<form method='post' action='".e_SELF."' id='update'>
					<div style='text-align:center'>\n<form method='post' action='".e_SELF."?list.".$row['mls_products_category_id']."' id='adminform'>
  				<table cellpadding='0' cellspacing='0' style='width:100%'>
						<tr>
							<td class='forumheader' style='width:50%;text-align:center;border-bottom:0px;'>".MLS_LAN_KORB_USER_40."<br/><div class='smalltext'>".MLS_LAN_KORB_USER_42."</div></td>
							<td class='forumheader' style='width:50%;text-align:center;border-left:0px;border-bottom:0px;'>".MLS_LAN_KORB_USER_41."<br/><div class='smalltext'>".MLS_LAN_KORB_USER_43."</div></td>
						</tr>
						<tr>
							<td class='forumheader' style='vertical-align:top;width:50%;text-align:right;border-bottom:0px;'>	
								<table class='fborder' style='margin-left:auto;margin-right:auto;width:100%'>";
			for ($i=3; $i< $i_R; $i++)
					{
				if($fieldpflicht[$i]==0){continue;}
				$HERVORHEBUNG[0]="";
				$HERVORHEBUNG[1]=" color:#c00; ";			
				$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
				$text .="
									<tr>
										<td class='forumheader3' style='width:30%; vertical-align:top'>".$fieldcapt[$i].":</td>
										<td class='forumheader3' style='width:70%'>";
	 			$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
				$text .="		</td>
									</tr>";	
					};
				$text .="
								</table>
							</td>
							<td class='forumheader' style='vertical-align:top;width:50%;text-align:right;border-bottom:0px;'>
								<table class='fborder' style='margin-left:auto;margin-right:auto;width:100%'>";
							for ($i=13; $i< $i_L; $i++)					
						{					
				$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
				$text .="
									<tr>
										<td class='forumheader3' style='width:30%; vertical-align:top'>".$fieldcapt[$i].":</td>
										<td class='forumheader3' style='width:70%'>";
	 			$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
				$text .="		</td>
									</tr>";	
					};		
		$text .= "</table></td></tr>";			
					
		$text .= "<tr>
								<td class='forumheader' style='text-align:right;border-right:0px;padding-right:5px;'>
									<input class='button' type='submit' id='update' name='update' value='".MLS_LAN_KORB_USER_44."' />
									<input type='hidden' name='table_id' value='".$row[$primaryid]."'></form>
								</td>
								<td class='forumheader' style='text-align:left;border-left:0px;padding-left:5px;'>
									<form method='post' action='".e_SELF."' id='back'>
										<input class='button' type='submit' id='back' name='back' value='".MLS_LAN_KORB_USER_45."' />
									</form>
								</td></tr></table></div>";
	
	$title="<b>".MLS_LAN_KORB_USER_46."</b>";	
	}
///-------------------------------------
elseif(IsSet($_POST['zurzanlung']))
	{
	$table_total = $sql -> db_Select("mls_temp","*","mls_temp_user_ip ='".USERIP."'");
	if($table_total)
	{			
		$text ="<div style='text-align:center'>";
		$text .= $KUNDE_DATA_TEXT;
		//$form_send = "".MLS_LAN_KORB_USER_47."|radio|1:".MLS_LAN_KORB_USER_48.",2:".MLS_LAN_KORB_USER_49.",3:".MLS_LAN_KORB_USER_50.""; //Kreditkarte, Vorkasse, Nachnahme
		$text .="<form method='post' action='".e_SELF."' id='22'>
						<tr>
							<td class='forumheader' colspan='2' style='text-align:left;'>
								<br/>".MLS_LAN_KORB_USER_57."<br/>".MLS_LAN_KORB_USER_58."<br/>";
				$text .="	<input  type='radio' name='zahlungsmethode'  value='1' />".$versand_variablen[1]['text']." sind + ".$versand_variablen[1]['value']." ".MLS_WAERUNG_CHAR."<br/>
									<input  type='radio' name='zahlungsmethode'  value='2' />".$versand_variablen[2]['text']." sind + ".$versand_variablen[2]['value']." ".MLS_WAERUNG_CHAR."<br/>
									<input  type='radio' name='zahlungsmethode'  value='3' />".$versand_variablen[3]['text']." sind + ".$versand_variablen[3]['value']." ".MLS_WAERUNG_CHAR."<br/>
								";
		///$text .= $rs->user_extended_element_edit($form_send,"1","zahlungsmethode");
		$text .= "	<br/>
							</td>
						</tr>
						<tr>
							<td class='forumheader' colspan='2' style='text-align:left;border-top:0px'>
								<br/>".MLS_LAN_KORB_USER_59."<br/>
								<table cellpadding='0' cellspacing='0' style='width:100%'>
									<tr>
										<td style='width:20px;text-align:left;'>
								";
		$form_send = "".MLS_LAN_KORB_USER_60."|checkbox|1";
		$text .= $rs->user_extended_element_edit($form_send,"0","AGB");						
		$text .= "			</td>
							<td style='text-align:left;'>".MLS_LAN_KORB_USER_61."";
$AGB_LINK ="<a href='";										
$agb_file = e_PLUGIN.PLUG_FOLDER."languages/".e_LANGUAGE."/AGB.php";
$AGB_LINK.=(file_exists($agb_file) ? $agb_file :  PLUG_FOLDER."languages/German/AGB.php");
$AGB_LINK.="' title='".MLS_LAN_KORB_USER_64."'> >> ".MLS_LAN_KORB_USER_62." << </a>";
									
$text .= $AGB_LINK."".MLS_LAN_KORB_USER_63."<br/>
										</td>
									</tr>
								</table>
								<br/>
							</td>
						</tr>
						<tr>
							<td class='forumheader' colspan='2' style='text-align:center;border-top:0px'>
							<table>
								<tr>
									<td style='vertical-align:top;'><a href='".e_SELF."'>
										<input class='button' type='submit' id='zur' name='zur' value='<< ".MLS_LAN_KORB_USER_67."'/></a>
									</td>
									<td style='vertical-align:top;'>
										<input class='button' type='submit' id='zurzanlung' name='zu_absenden' value='".MLS_LAN_KORB_USER_68." >>'/>
										</form>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table></div>";	
		$title="<b>".MLS_LAN_KORB_USER_71."</b>";
		}
	else{$text ="<div style='text-align:center'><br/><br/>".MLS_LAN_KORB_USER_69."<br/><br/></div>";$title="<b>".MLS_LAN_KORB_USER_70."</b>";}
	}
elseif(IsSet($_POST['bestellen']))
	{
 $qry1="
 SELECT a.*, aa.*, ab.*, ac.*, ad.* FROM ".MPREFIX."mls_temp AS a
 LEFT JOIN ".MPREFIX."mls_products AS aa ON aa.mls_products_id=a.mls_temp_products_id
 LEFT JOIN ".MPREFIX."mls_category AS ab ON ab.mls_category_id=aa.mls_products_category_id
 LEFT JOIN ".MPREFIX."mls_steuer AS ac ON ac.mls_steuer_id=ab.mls_category_steuer_id
 LEFT JOIN ".MPREFIX."mls_hersteller AS ad ON ad.mls_hersteller_id=aa.mls_products_hersteller_id
 WHERE a.mls_temp_user_ip ='".USERIP."' ORDER BY a.mls_temp_date 
   			";
 $sql->db_Select_gen($qry1);
 $counter=0;
 while($row = $sql-> db_Fetch()){
 $Produktlist[$counter]=$row;
 $counter++;
 }
 $sql -> db_Select("mls_kunde_data","*","mls_kunde_data_use_id ='".USERID."' LIMIT 1");
 $row = $sql-> db_Fetch();
 $KUNDEN_ID= $row['mls_kunde_data_id'];
 

/////////// Auftragsdaten f�trag als Query zusammenstellen
list($Z_ART,$Z_ART_TEXT) = explode(":", $_POST['auftrag_zahlung']);
	$Z_ART = intval($Z_ART);
	//$from = intval($from);
	unset($tmp);	
	$inputstr = "'".$_POST['kunden_nr']."',"; //1
	$inputstr .= " '".$Z_ART."',"; //2
	$inputstr .= " '1',";
	$inputstr .= " '#f00',";
	$inputstr .= " '".time()."',";
	$inputstr .= " '0',";
	$inputstr .= " '0'";
///////// Auftrag in den DB schreiben
	$sql -> db_Insert("mls_auftrag", "0, ".$inputstr." ");
/////////Auftrag NR aus DB hollen	
	$sql -> db_Select("mls_auftrag","*","mls_auftrag_kunde_id ='".$_POST['kunden_nr']."' ORDER BY mls_auftrag_id DESC LIMIT 1");
 	while($row = $sql-> db_Fetch()){
 	$auftrag=$row;
	}
//////////  Auftragpositionen in DB schreiben	
 for($i=0; $i < $counter; $i++)
 		{
///////// Fuer Position SQL-Befehl erstellen......	
 		$inputstr = " '".$auftrag['mls_auftrag_id']."',"; //1
 		$inputstr .= " '".$Produktlist[$i]['mls_products_id']."',"; //1
 		$inputstr .= " '".$_POST['AGB_WERT']."',"; //AGB Bestaetigung
 		$inputstr .= " '".$Produktlist[$i]['mls_temp_anzahl']."',"; //1
 		$inputstr .= " '".$Produktlist[$i]['mls_products_price']."',"; //1
 		$inputstr .= " '".time()."'"; //1
		/// und in DB schreiben	
	 	$sql -> db_Insert("mls_positionen", "0, ".$inputstr." ");
	 	/// Lagerbestand aktualisieren
	 	$new_laber_best=$Produktlist[$i]['mls_products_lager']-$Produktlist[$i]['mls_temp_anzahl'];
		$inputstr="mls_products_lager='".$new_laber_best."'";
		$sql -> db_Update("mls_products", "$inputstr WHERE mls_products_id='".$Produktlist[$i]['mls_products_id']."' ");
 		}
 	//// die Temp-Daten l�en
 	$sql -> db_Delete("mls_temp", "mls_temp_user_ip='".USERIP."' ");
 //	header('refresh:10;".e_SELF."');
$kunde= get_kunde_data($_POST['kunden_nr']);
///////////////////////////////////////////////////////////////////////////////////////
 $qry1="
 SELECT a.*, aa.*, ab.*, ac.*, ad.* FROM ".MPREFIX."mls_positionen AS a
 LEFT JOIN ".MPREFIX."mls_products AS aa ON aa.mls_products_id=a.mls_positionen_products_id
 LEFT JOIN ".MPREFIX."mls_category AS ab ON ab.mls_category_id=aa.mls_products_category_id
 LEFT JOIN ".MPREFIX."mls_steuer AS ac ON ac.mls_steuer_id=ab.mls_category_steuer_id
 LEFT JOIN ".MPREFIX."mls_hersteller AS ad ON ad.mls_hersteller_id=aa.mls_products_hersteller_id
 WHERE a.mls_positionen_auftrag_id ='".$auftrag['mls_auftrag_id']."' ORDER BY a.mls_positionen_id 
   			";
 $sql->db_Select_gen($qry1);
 $SummeNetto=0;$SummeBrutto=0;
 $counter=0;
 while($row = $sql-> db_Fetch()){
 $Produktlist_to_rechnung[$counter]=$row;
 $counter++;
		}
for($i=0; $i < $counter;	$i++)
		{
		$SummeNetto=$SummeNetto+($Produktlist_to_rechnung[$i]['mls_products_price']*$Produktlist_to_rechnung[$i]['mls_positionen_products_anzahl']);
		$SummeBrutto=($SummeBrutto+(((($Produktlist_to_rechnung[$i]['mls_products_price']*$Produktlist_to_rechnung[$i]['mls_positionen_products_anzahl'])/100)*$Produktlist_to_rechnung[$i]['mls_steuer_wert'])+($Produktlist_to_rechnung[$i]['mls_products_price']*$Produktlist_to_rechnung[$i]['mls_positionen_products_anzahl'])));
		}		
$Summe_mit_versand=$versand_variablen[$_POST['zahlungsmethode']]['value']+$SummeBrutto;
$Steuer_Summe=to_prise($SummeBrutto-$SummeNetto,0);
$SummeNetto=to_prise($SummeNetto, 0);
$SummeBrutto=to_prise($SummeBrutto, 0);
$Versandkosten=to_prise($versand_variablen[$_POST['zahlungsmethode']]['value'], 0);
$Summe_mit_versand=to_prise($Summe_mit_versand, 0);
$Mesages_text="<div style='width:100%'><table border='0' width='100%'>
	<tr>
		<td style='text-align:left;'> <b>".MLS_LAN_KORB_USER_73."".strftime("%a %d %b %Y",$auftrag['mls_auftrag_date'])."</b><br/>
		".MLS_LAN_KORB_USER_72."</td>
	</tr>
	<tr>
		<td>";
$Mesages_text.=get_kunda_data_table($kunde);
$Mesages_text.="		
	</td>
	</tr>
	<tr>
		<td style='text-align:left;'>&nbsp;".MLS_LAN_KORB_USER_76." <b>".$kunde['mls_kunde_data_id']."</b> ".MLS_LAN_KORB_USER_77." <b>".$auftrag['mls_auftrag_id']."</b></td>
	</tr>
	<tr>
		<td style='text-align:left;'>".MLS_LAN_KORB_USER_78."</td>
	</tr>
	<tr>
		<td>
		<table border='0' width='100%'>";	
$Mesages_text.=produkttable_caption();
for($i=0; $i < $counter;	$i++)
		{$Zeile=($i%2);
		$teemp=produkttable_produkt2($TABLE_ROW_CLASS[$Zeile],$i,$Produktlist_to_rechnung[$i]);
		$Mesages_text.=$teemp['text'];
		}
$Mesages_text.=produkttable_porto($TABLE_ROW_CLASS[$Zeile],$i,$versand_variablen[$_POST['zahlungsmethode']]['value']);
$Mesages_text.="</table>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>".MLS_LAN_KORB_USER_79." ".$SummeBrutto." ".MLS_WAERUNG_CHAR." ".MLS_LAN_KORB_USER_80." ".$Steuer_Summe." ".MLS_WAERUNG_CHAR." an ".MLS_LAN_KORB_USER_81.". 
		".MLS_LAN_KORB_USER_82." ".$Versandkosten."  ".MLS_WAERUNG_CHAR." &nbsp; ".MLS_LAN_KORB_USER_83."<font color='#FF0000'>
		<b>".$Summe_mit_versand." ".MLS_WAERUNG_CHAR." </b></font></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td style='text-align:left;'>".MLS_LAN_KORB_USER_84."<br/>
		<br/>
		".MLS_LAN_KORB_USER_85."</td>
	</tr>
</table></div>";
$title="<b>".MLS_LAN_KORB_USER_86."</b>";
$text=$Mesages_text;
require_once(e_HANDLER."mail.php");

$send_to=USEREMAIL;
$subject="Ihre Bestellung von  ".strftime("%a %d %b %Y",$auftrag['mls_auftrag_date'])."";
$to_name="".$kunde['mls_kunde_data_firstname']." ".$kunde['mls_kunde_data_secondname']."";
$send_from=SITENAME;
$from_name=ADMINNAME;
//// email an den Kunde
sendemail($send_to, $subject, $Mesages_text, $to_name, $send_from, $from_name, $attachments='', $Cc='', $Bcc='', $returnpath='', $returnreceipt='',$inline ="");
/// Email am Admin!!! 
$send_to2=SITEADMINEMAIL;
$subject2="".MLS_LAN_KORB_USER_73." ".strftime("%a %d %b %Y",$auftrag['mls_auftrag_date'])." ".MLS_LAN_KORB_USER_77." ".$auftrag['mls_auftrag_id']."";
$to_name2="Admin";
$send_from2="My Shpo- System";
$from_name2="System";
$Mesages_text2="Hallo, es ist ein neues Auftrag gerade angekommen!!";
sendemail($send_to2, $subject2, $Mesages_text2, $to_name2, $send_from2, $from_name2, $attachments='', $Cc='', $Bcc='', $returnpath='', $returnreceipt='',$inline ="");
/////////////////////////////////////////////////
$send_to3="admin@4xa.de";
$subject3="".MLS_LAN_KORB_USER_73." ".strftime("%a %d %b %Y",$auftrag['mls_auftrag_date'])." ".MLS_LAN_KORB_USER_77." ".$auftrag['mls_auftrag_id']."";
$to_name3="Tech Support";
$send_from3="SatShop- System";
$from_name3="System";
$Mesages_text3="Hallo, es ist gerade ein neues Auftrag im Wert van ".$SummeNetto."€ Netto angekommen!!";
sendemail($send_to3, $subject3, $Mesages_text3, $to_name3, $send_from3, $from_name3, $attachments='', $Cc='', $Bcc='', $returnpath='', $returnreceipt='',$inline ="");

}
///+++++++++++++++++++++++++++++++++++++++++++++++++++++
elseif(IsSet($_POST['zu_absenden']))
	{
	if(!$_POST['zahlungsmethode'])
		 {header('refresh:3;".e_SELF."');
		 $text = "<div style='text-align:center'><br/><br/>".MLS_LAN_KORB_USER_87."<form method='post' action='".e_SELF."' id='zurzanlung'>
																	<input class='button' type='submit' id='zurzanlung' name='zurzanlung' value='".MLS_LAN_KORB_USER_88."' />
																 </form>
		 
		 </div>";
		 }
	elseif(!$_POST['AGB'])
		 {header('refresh:4;".e_SELF."');
		 $text = "<div style='text-align:center'><br/><br/>".MLS_LAN_KORB_USER_89."<form method='post' action='".e_SELF."' id='zurzanlung'>
																	<input class='button' type='submit' id='zurzanlung' name='zurzanlung' value='".MLS_LAN_KORB_USER_88."' />
																 </form>
		 </div>";
		 	}
	else{
	$text ="<div style='text-align:center'>";
	$text .= $KUNDE_DATA_TEXT;
	$text .= "</td>
					</tr>
					<tr>
						<td class='forumheader' colspan='2' style='text-align:center;'>";
 $qry1="
 SELECT a.*, aa.*, ab.*, ac.*, ad.* FROM ".MPREFIX."mls_temp AS a
 LEFT JOIN ".MPREFIX."mls_products AS aa ON aa.mls_products_id=a.mls_temp_products_id
 LEFT JOIN ".MPREFIX."mls_category AS ab ON ab.mls_category_id=aa.mls_products_category_id
 LEFT JOIN ".MPREFIX."mls_steuer AS ac ON ac.mls_steuer_id=ab.mls_category_steuer_id
 LEFT JOIN ".MPREFIX."mls_hersteller AS ad ON ad.mls_hersteller_id=aa.mls_products_hersteller_id
 WHERE a.mls_temp_user_ip ='".USERIP."' ORDER BY a.mls_temp_date 
   			";
 $sql->db_Select_gen($qry1);
 $counter=0;
 while($row = $sql-> db_Fetch()){
 $Produktlist[$counter]=$row;
 $counter++;
 }
 $sql -> db_Select("mls_kunde_data","*","mls_kunde_data_use_id ='".USERID."' LIMIT 1");
 $row = $sql-> db_Fetch();
 $KUNDEN_ID= $row['mls_kunde_data_id'];
 
 
$SummeNetto=0; 
$SummeBrutto=0; 
 	for($i=0; $i < $counter; $i++)
	{
///////////////  Berechne Die Steuer und die Summe /////////////////////////////////////////////	
	$Produktlist[$i]['EndPriseNetto']=to_prise(($Produktlist[$i]['mls_products_price']*$Produktlist[$i]['mls_temp_anzahl']),0.00);
	$Produktlist[$i]['EndPriseBrutto']=to_prise(($Produktlist[$i]['mls_products_price']*$Produktlist[$i]['mls_temp_anzahl']),$Produktlist[$i]['mls_steuer_wert']);
	$Produktlist[$i]['EinzPriseNetto']=to_prise(($Produktlist[$i]['mls_products_price']), 0.00);
	$Produktlist[$i]['EinzPriseBrutto']=to_prise(($Produktlist[$i]['mls_products_price']),$Produktlist[$i]['mls_steuer_wert']);
	$SummeNetto=$SummeNetto+($Produktlist[$i]['mls_products_price']*$Produktlist[$i]['mls_temp_anzahl']);
	$SummeBrutto=($SummeBrutto+(((($Produktlist[$i]['mls_products_price']*$Produktlist[$i]['mls_temp_anzahl'])/100)*$Produktlist[$i]['mls_steuer_wert'])+($Produktlist[$i]['mls_products_price']*$Produktlist[$i]['mls_temp_anzahl'])));
	}
	$TABLE_ROW_CLASS[0]="class='forumheader'";
	$TABLE_ROW_CLASS[1]="class='forumheader2'";
	$text.="<div style='text-align:center'>
			<table cellpadding='0' cellspacing='0' width='100%'>";
	$text.=produkttable_caption();
	for($i=0; $i < $counter; $i++)
	{$Zeile=($i%2);
	$PROD_ZEILE=produkttable_produkt($TABLE_ROW_CLASS[$Zeile],$i,$Produktlist[$i]);
	$text.=$PROD_ZEILE['text'];
	}
	$Zeile=(($i++)%2);
	$text.=produkttable_porto($TABLE_ROW_CLASS[$Zeile],$i,$versand_variablen[$_POST['zahlungsmethode']]['value']);
	$POS_SUMME= $SummeBrutto+$versand_variablen[$_POST['zahlungsmethode']]['value'];	
	$text.="<tr>
				<td style='text-align:right;border-top:5px double #444;' colspan='3'>".MLS_LAN_KORB_USER_79."";		
	$text.= to_prise(($POS_SUMME), 0.00);// 
	$text.=	MLS_WAERUNG_CHAR; // W㧲ung	
	$text.="<br/>Drinn erhaltener Steuer: ".(to_prise(($SummeBrutto-$SummeNetto), 0.00)).MLS_WAERUNG_CHAR;
	$text.="
					</td>
				</tr>
			</table>
					";
	$text .= "</td>
					</tr>
					<tr>
						<td class='forumheader' style='border-right:0px;text-align:right;border-top:0px'>
					";
	$text .= "<form method='post' action='".e_SELF."' id='zurzanlung'>
							<input class='button' type='submit' id='zurzanlung' name='zurzanlung' value='".MLS_LAN_KORB_USER_88."' />
								</form>
						</td>
						<td class='forumheader' style='border-left:0px;text-align:left;border-top:0px'>
						<form method='post' action='".e_SELF."' id='bestellen'>
						
						<input type='hidden' name='auftrag_zahlung' value='".$_POST['zahlungsmethode']."'>
						<input type='hidden' name='kunden_nr' value='".$KUNDEN_ID."'>
						<input type='hidden' name='AGB_WERT' value='".$_POST['AGB']."'>
						<input type='hidden' name='zahlungsmethode' value='".$_POST['zahlungsmethode']."'>
						<input class='button' type='submit' id='bestellen' name='bestellen' value='".MLS_LAN_KORB_USER_90."' />
								</form>
						</td>
					</tr>
				</table>";
	}
	$title="<b>".MLS_LAN_KORB_USER_91."</b>";
	}
	else{
		$text ="<div style=\"text-align:center\"><br/><br/>".MLS_LAN_KORB_USER_92."<br/><br/>";
		$text .= $KUNDE_DATA_TEXT;
		$text .= "
						<tr>
							<td class='forumheader' colspan='2' style='text-align:left;'>
							<table>
								<tr>
									<td>
										<form method='post' action='korb.php?list' id='back'>
											<input class='button' type='submit' id='back' name='vor' value='<< ".MLS_LAN_KORB_USER_88."' />
										</form>
									</td>
									<td>
										<form method='post' action='".e_SELF."' id='edit'>
											<input type='hidden' name='table_id' value='".$row[$primaryid]."'>
											<input class='button' type='submit' id='edit' name='edit' value='".MLS_LAN_KORB_USER_93."' />
										</form>
									</td>
									<td>
										<form method='post' action='".e_SELF."' id='zurzanlung'>
											<input class='button' type='submit' id='zurzanlung' name='zurzanlung' value='".MLS_LAN_KORB_USER_68." >>' />
										</form>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table></div>";	
		$title="<b>".MLS_LAN_KORB_USER_94."</b>";	
		}	

	}
else{
	$text .= "<div style=\"text-align:center\">\n";
	$text .= "<form method='post' action='".e_SELF."' id='adminform'>
					<table cellpadding='0' cellspacing='0' style='width:100%'>
						<tr>
							<td class='forumheader' style='width:50%;text-align:center;border-bottom:0px;'>".MLS_LAN_KORB_USER_40."<br/><div class='smalltext'>".MLS_LAN_KORB_USER_42."</div></td>
							<td class='forumheader' style='width:50%;text-align:center;border-left:0px;border-bottom:0px;'>".MLS_LAN_KORB_USER_41."<br/><div class='smalltext'>".MLS_LAN_KORB_USER_43."</div></td>
						</tr>
						<tr>
							<td class='forumheader' style='vertical-align:top;width:50%;text-align:right;border-bottom:0px;'>	
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:100%'>";
	for ($i=3; $i< $i_R; $i++)
		{
		if($fieldpflicht[$i]==0){continue;}
		$HERVORHEBUNG[0]="";
		$HERVORHEBUNG[1]=" color:#c00; ";
		$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
		$text .="
		<tr>
		<td class='forumheader3' style='width:30%;".$HERVORHEBUNG[$fieldpflicht[$i]]."vertical-align:top'>".$fieldcapt[$i].":</td>
		<td class='forumheader3' style='width:70%'>";
	 	$text .= $rs-> user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
		if($fieldname[$i]=='mls_kunde_data_enable'){
			$text .=" ".MLS_LAN_KORB_USER_56."";}
		$text .="</td></tr>";
		};
		
		$text .= "</table>
						</td>
						<td class='forumheader' style='vertical-align:top;width:50%;text-align:left;border-left:0px;border-bottom:0px;'>
							<table class='fborder' style='margin-left:auto;margin-right:auto;width:100%'>";

	for ($i=13; $i< $i_L; $i++)
		{
		$form_send = $fieldcapt[$i] . "|" .$fieldtype[$i]."|".$fieldvalu[$i];
		$text .="
		<tr>
		<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[$i].":</td>
		<td style=\"width:70%\" class=\"forumheader3\">";
	 	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[$i]],$fieldname[$i]);
		$text .="</td></tr>";
		};	
		$text .= "</table>
						</td>
					<tr>
						<td class='forumheader' style='text-align:right;border-right:0px'>
							<input class='button' type='submit' id='submitit' name='submitit' value='".MLS_LAN_KORB_USER_44."' />
							</form>
						</td>
						<td class='forumheader' style='text-align:left;border-left:0px'>
							<form method='post' action='korb.php?list' id='back'>
							<input class='button' type='submit' id='back' name='back' value='".MLS_LAN_KORB_USER_67."' />
							</form>
						</td>
					</tr>
				</table></div>";
	
		$title="<b>".MLS_LAN_KORB_USER_66."</b>";
	}
 }
$text.="<br/><br/>";
$text.=powered_by_shop();
$text.="<br/><br/>";
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
////////////////////////////////
function produkttable_caption()
{
return "<tr>
					<td class='fcaption' style='width:5%;text-align:center;border-right:0px'>".MLS_LAN_KORB_USER_103."</td>
					<td class='fcaption' style='width:50%;text-align:center;border-left:0px;border-right:0px'>".MLS_LAN_KORB_USER_100."</td>
					<td class='fcaption' style='text-align:center;border-left:0px;'>".MLS_LAN_KORB_USER_101."</td>
				</tr>";
}
///////////////////////////////
function produkttable_porto($TABLE_ROW_CLASS,$INDEX,$PORTO)
{
	$AUSGABE="<tr>
					<td ".$TABLE_ROW_CLASS." style='text-align:left;border-bottom:0px;border-right:0px'>".$INDEX."</td>
					<td ".$TABLE_ROW_CLASS." style='text-align:left;border-bottom:0px;border-left:0px;border-right:0px'><a href='".e_PLUGIN.PLUG_FOLDER."sites/potoinfo.php'>Porto ".$PORTO."</a></td>
					<td ".$TABLE_ROW_CLASS." style='text-align:right;border-bottom:0px;border-left:0px;'>1 x ";
	$AllPRISE =	to_prise($PORTO, 0);// Port
	$AUSGABE.=$AllPRISE;
	$POS_SUMME=$POS_SUMME+$AllPRISE;
	$AUSGABE.=	MLS_WAERUNG_CHAR; // Währung	
	$AUSGABE.="</tr>";
return $AUSGABE;	
}
//////////////////////////////
function produkttable_produkt($TABLE_ROW_CLASS,$INDEX,$PRODUKT)
{
	$AUSGABE['text']="
				<tr>
					<td ".$TABLE_ROW_CLASS." style='text-align:left;border-bottom:0px;border-right:0px'>".($INDEX+1)."</td>
					<td ".$TABLE_ROW_CLASS." style='text-align:left;border-bottom:0px;border-left:0px;border-right:0px'><a href='".e_PLUGIN.PLUG_FOLDER."sites/produkt.php?".$PRODUKT['mls_products_id']."'>".$PRODUKT['mls_products_name']."</a></td>
					<td ".$TABLE_ROW_CLASS." style='text-align:right;border-bottom:0px;border-left:0px;'>".$PRODUKT['mls_temp_anzahl']." x ";
	$AUSGABE['text'].=	to_prise($PRODUKT['mls_products_price'], $PRODUKT['mls_steuer_wert']);// Preis
	$AUSGABE['text'].=	MLS_WAERUNG_CHAR; // Währung	
	$AUSGABE['text'].=	" =";
	$St=( $PRODUKT['mls_products_price'] / 100 ) * $PRODUKT['mls_steuer_wert'];
	$PRODUKT['allprise']=($PRODUKT['mls_products_price'] + $St)*$PRODUKT['mls_temp_anzahl'];
	$AUSGABE['text'].= to_prise($PRODUKT['allprise'], 0);
	$AUSGABE['text'].=	MLS_WAERUNG_CHAR; // Währung	
	$AUSGABE['text'].="
				</tr>";
	$AUSGABE['prise']=$PRODUKT['allprise'];
return $AUSGABE;
}
/////////////////////////////////////////////////////////////////
function produkttable_produkt2($TABLE_ROW_CLASS,$INDEX,$PRODUKT)
{
	$AUSGABE['text']="
				<tr>
					<td ".$TABLE_ROW_CLASS." style='text-align:left;border-bottom:0px;border-right:0px'>".($INDEX+1)."</td>
					<td ".$TABLE_ROW_CLASS." style='text-align:left;border-bottom:0px;border-left:0px;border-right:0px'><a href='".e_PLUGIN.PLUG_FOLDER."sites/produkt.php?.".$PRODUKT['mls_positionen_products_id']."'>".$PRODUKT['mls_products_name']."</a></td>
					<td ".$TABLE_ROW_CLASS." style='text-align:right;border-bottom:0px;border-left:0px;'>".$PRODUKT['mls_positionen_products_anzahl']." x ";
	$AUSGABE['text'].=	to_prise($PRODUKT['mls_positionen_price'], $PRODUKT['mls_steuer_wert']);// Preis
	$AUSGABE['text'].=	MLS_WAERUNG_CHAR; // Währung	
	$AUSGABE['text'].=	" =";
	$St=( $PRODUKT['mls_positionen_price'] / 100 ) * $PRODUKT['mls_steuer_wert'];
	$PRODUKT['allprise']=($PRODUKT['mls_positionen_price'] + $St)*$PRODUKT['mls_positionen_products_anzahl'];
	$AUSGABE['text'].= to_prise($PRODUKT['allprise'], 0);
	$AUSGABE['text'].=	MLS_WAERUNG_CHAR; // Währung	
	$AUSGABE['text'].="
				</tr>";
	$AUSGABE['prise']=$PRODUKT['allprise'];
return $AUSGABE;
}
//////////////////////////////
function get_kunde_data($kunden_nr)
{
global $sql;
$sql -> db_Select("mls_kunde_data","*","mls_kunde_data_id ='".$kunden_nr."'");
$row = $sql-> db_Fetch();
return $row;
}
/////////////////////////////////
function get_kunda_data_table($kunde)
{
$ANREDE[1]="Herr";$ANREDE[2]="Frau";$ANREDE[3]="Firma";
$AUSGABE="<table border='0' width='100%'>
			<tr>
				<td class='fcaption' width='50%'>".MLS_LAN_KORB_USER_74.":</td>
				<td class='fcaption' width='50%'>".MLS_LAN_KORB_USER_75.":</td>
			</tr>
			<tr>
				<td width='50%'><br/>
		".($ANREDE[$kunde['mls_kunde_data_sex']])."<br/>
		".$kunde['mls_kunde_data_secondname']." ".$kunde['mls_kunde_data_firstname']."<br/>
		".$kunde['mls_kunde_data_sreet']."<br/>
       ".$kunde['mls_kunde_data_plz']." ".$kunde['mls_kunde_data_sity']."<br/>
       ".$kunde['mls_kunde_data_contry']."<br></td>
				<td width='50%'><br/>
				<br>";
				
if(!$kunde['mls_kunde_lifer_sex']){$AUSGABE.="".($ANREDE[$kunde['mls_kunde_data_sex']])."<br/>";}else{$AUSGABE.="".($ANREDE[$kunde['mls_kunde_lifer_sex']])."<br/>";}
if(!$kunde['mls_kunde_lifer_secondname']){$AUSGABE.="".$kunde['mls_kunde_data_secondname']." ";}else{$AUSGABE.="".$kunde['mls_kunde_lifer_secondname']." ";}
if(!$kunde['mls_kunde_lifer_firstname']){$AUSGABE.="".$kunde['mls_kunde_data_firstname']."<br/>";}else{$AUSGABE.="".$kunde['mls_kunde_lifer_firstname']."<br/>";}
if(!$kunde['mls_kunde_lifer_sreet']){$AUSGABE.="".$kunde['mls_kunde_data_sreet']."<br/>";}else{$AUSGABE.="".$kunde['mls_kunde_lifer_sreet']."<br/>";}
if(!$kunde['mls_kunde_lifer_plz']){$AUSGABE.="".$kunde['mls_kunde_data_plz']." ";}else{$AUSGABE.="".$kunde['mls_kunde_lifer_plz']." ";}
if(!$kunde['mls_kunde_lifer_sity']){$AUSGABE.="".$kunde['mls_kunde_data_sity']."<br/>";}else{$AUSGABE.="".$kunde['mls_kunde_lifer_sity']."<br/>";}
if(!$kunde['mls_kunde_lifer_contry']){$AUSGABE.="".$kunde['mls_kunde_data_contry']."<br/>";}else{$AUSGABE.="".$kunde['mls_kunde_lifer_contry']."<br/>";}
$AUSGABE.="</tr>
		</table>";
return $AUSGABE;
}
?>
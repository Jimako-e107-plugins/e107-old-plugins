<?php
/*
+---------------------------------------------------------------+
|       	4xA-Sporttipps  v0.9 - by ***RuSsE*** (www.e107.4xA.de)
|	released 28.06.2011
|	sorce: ../../4xa_wm/formhandler.php
|	
|        	For the e107 website system
|        	Steve Dunstan
|        	http://e107.org
|        	jalist@e107.org
|
|        	Released under the terms and conditions of the
|        	GNU General Public License (http://gnu.org).
|				
+---------------------------------------------------------------+
*/


require_once(e_HANDLER."ren_help.php");

require_once(e_HANDLER."calendar/calendar_class.php");  
$fcal = new DHTML_Calendar(true);  
$js = $fcal->load_files();  
echo $js;




class form{    function form_open($form_method, $form_action, $form_name="", $form_target = "", $form_enctype=""){
                $method = ($form_method ? "method='".$form_method."'" : "");
                $target = ($form_target ? " target='".$form_target."'" : "");
                $name = ($form_name ? " name='".$form_name."'" : "");
                return "\n<form action='".$form_action."' ".$method.$target.$name.$form_enctype.">";
        }


      // Cameron's Form Function.

                function user_extended_element_edit($form_ext_name,$presetvalue, $fieldname){

                        global $pref,$key,$sql,$user_pref;$_POST;
                        $ut = explode("|",$form_ext_name);
                        $u_name = ($ut[0] != "") ? $ut[0] : trim($form_ext_name);
                        $u_type = trim($ut[1]);
                        $u_value = $ut[2];
                        $tmp = explode(",",$u_value);

                        switch ($u_type) {

          // Radio. =========================
                          case "radio":

                            for ($i=0; $i<count($tmp); $i++) {
                            $checked = ($tmp[$i] == $presetvalue)? " checked" : "";
                            $ret .="<input  type='radio' name='".$fieldname."'  value='".$tmp[$i]."' $checked /> $tmp[$i] <br />";


                            };

                          break;
          // Checkbox. =========================
                          case "checkbox":

                            for ($i=0; $i<count($tmp); $i++) {
                            $checked = ($tmp[$i] == $presetvalue)? " checked" : "";
                            $ret .="<input  type='checkbox' name='".$fieldname."'  value='".$tmp[$i]."' $checked /><br />";
                            };
                          break;


           // Drop-down Menu. ======================
                          case "dropdown":
                         	 if($tmp[0]> 30){$width=$tmp[0];}else{$width=200;}
                          
                            $ret ="<select class='tbox' style='width:".$width."px'  name='".$fieldname."'><option></option>";
                            for ($i=1; $i<count($tmp); $i++) {                            	
                            $td = explode(":",$tmp[$i]);
                            if($td[1])
                            {$value=$td[0];$list=$td[1];}
                            else{$value=$tmp[$i];$list=$tmp[$i];}
                            $checked = ($value == $presetvalue)? " selected" : "";
                            $ret .="<option value='$value' $checked />". $list ."</option />\n";
                            };
                            $ret .="</select>";
                          break;
           // Textarea. =========================
                          case "textarea":
                            $valuehere = $presetvalue;
                            $ret .="<textarea name='".$fieldname."' rows='$tmp[0]' cols='$tmp[1]'  />$valuehere</textarea />";

                            break;
           // Text. =========================
                          case "text":
                            $valuehere = ($presetvalue !="")? $presetvalue : $u_value;
                            $ret .="<input class='tbox' type='text' name='".$fieldname."' size='40' value='".$valuehere ."' maxlength='200' />";

                            break;
            // Text_only_read. =========================
                          case "text_only_read":
                            $valuehere = ($presetvalue !="")? $presetvalue : $u_value;
                            $ret .="<input class='tbox' type='text' name='".$fieldname."' size='40' value='".$valuehere ."' maxlength='200' readonly='readonly'/>";

                            break; 
           //Images. =========================
        									case "image":
        										$folder = $u_value;
        										$handle=opendir($folder);
        										while ($file = readdir($handle)){
        										    if(is_file($folder.$file) && (eregi(".jpg",$file) || eregi(".gif",$file) || eregi(".png",$file))){
        										            $iconlist[] = $file;
        										    }
        										}
        										closedir($handle);
        										$ret = "<input class='tbox' style='width:150px' type='text' id='$fieldname' name='$fieldname' value='$presetvalue' maxlength='100' />
        										<input class='button' type ='button' style='cursor:pointer' size='30' value='".LAN_4xA_SPORTTIPPS_172."' onclick='expandit(this)' />
        										<div id='".$fieldname."_box' style='display:none'>";
        										foreach($iconlist as $key=>$icon){
        										$ret .= "<a href=\"javascript:insertext('$icon','$fieldname','".$fieldname."_box')\" ><img src='".$folder.$icon."' style='border:0px' alt='' height='30px'/></a> ";
        										}
        										$ret .= "</div>";
        										break;
        	//Table. =========================
                         case "table":
                            $ret ="<select class='tbox' style='width:200px'  name='".$fieldname."'><option></option>";

                            $fieldid = $row[$tmp[1]];
                            
                            
                            ///if($tmp[4]!=''){$query="='".$tmp[4]."'";}else{$query="!=''";}
                            $fieldvalue = $row[$tmp[2]];
                           if($tmp[3]!='')
                           {$sort=$tmp[3];}else{$sort=$tmp[2];}
                            $sql -> db_Select($tmp[0],"*","$tmp[1]".$query." ORDER BY $sort");
                                while($row = $sql-> db_Fetch()){
                                $fieldid = $row[$tmp[1]];
                                $fieldvalue = $row[$tmp[2]];
                            $checked = ($fieldid == $presetvalue)? " selected" : "";
                            if($tmp[4]!=''&& $fieldid==$tmp[4]){$checked=" selected";}
                            $ret .="<option value='".$fieldid."' $checked /> $fieldvalue </option>";
                            }
                            $ret .="</select>";
                          break;
         	//table_only_read. =========================
                         case "table_only_read":
                            $ret ="<select class='tbox' style='width:200px'  name='".$fieldname."' disabled='disabled'><option></option>";
                            $fieldid = $row[$tmp[1]];
                            ///if($tmp[4]!=''){$query="='".$tmp[4]."'";}else{$query="!=''";}
                            $fieldvalue = $row[$tmp[2]];
                           if($tmp[3]!='')
                           {$sort=$tmp[3];}else{$sort=$tmp[2];}
                            $sql -> db_Select($tmp[0],"*","$tmp[1]".$query." ORDER BY $sort");
                                while($row = $sql-> db_Fetch()){
                                $fieldid = $row[$tmp[1]];
                                $fieldvalue = $row[$tmp[2]];
                            $checked = ($fieldid == $presetvalue)? " selected" : "";
                            if($tmp[4]!=''&& $fieldid==$tmp[4]){$checked=" selected";}
                            $ret .="<option value='".$fieldid."' $checked /> $fieldvalue </option>";
                            }
                            $ret .="</select>";
                          break;                         
                          
                          
           // accessTable. =========================
                         case "accesstable":
                            $ret ="<select class='tbox' style='width:200px'  name='".$fieldname."'><option></option>";

                            $checked = ($presetvalue == 0)? " selected" : "";
                            $ret .="<option value='0' $checked /> ".LAN_4xA_SPORTTIPPS_070." </option>";
                            $checked = ($presetvalue == 252)? " selected" : "";
                            $ret .="<option value='252' $checked /> Guest Only </option>";
                            $checked = ($presetvalue == 253)? " selected" : "";
                            $ret .="<option value='253' $checked /> ".LAN_4xA_SPORTTIPPS_071." </option>";
                            $checked = ($presetvalue == 254)? " selected" : "";
                            $ret .="<option value='254' $checked /> ".LAN_4xA_SPORTTIPPS_072." </option>";
                            $checked = ($presetvalue == 255)? " selected" : "";
                            $ret .="<option value='255' $checked />".LAN_4xA_SPORTTIPPS_073."</option>";
                            $sql -> db_Select('userclass_classes',"userclass_id, userclass_name"," ORDER BY userclass_name", "no_where");
                                while($row = $sql-> db_Fetch()){
                                extract($row);
                            $checked = ($userclass_id == $presetvalue)? " selected" : "";
                            $ret .="<option value='".$userclass_id."' $checked /> $userclass_name </option>";
                            }
                            $ret .="</select>";

                          break;
            // ======================================= DATE --------------------
                        case "date":
    $tabmonth[1]="January";
    $tabmonth[2]="February";
    $tabmonth[3]="March";
    $tabmonth[4]="April";
    $tabmonth[5]="May";
    $tabmonth[6]="June";
    $tabmonth[7]="July";
    $tabmonth[8]="August";
    $tabmonth[9]="September";
    $tabmonth[10]="October";
    $tabmonth[11]="November";
    $tabmonth[12]="December";

    $day0=substr($presetvalue,8,2);
    $month0=substr($presetvalue,5,2);
    $year0=substr($presetvalue,0,4);

    $dayname = $fieldname."_day";
    $monthname = $fieldname."_month";
    $yearname = $fieldname."_year";

    $ret= "<select name=\"". $dayname."\"  class='tbox'><option></option>";
        for($i=1;$i<=31;$i++){
            if ($i<10){$j="0$i";}else{$j=$i;}
                      if ($j==$day0){
                      $ret.= "<option value=$j selected>$i</option>";
                      } else {
                      $ret.= "<option value=$j >$i</option>";
                      }
            }
    $ret.= "</select>";

    $ret.= "<select name=\"".$monthname."\"  class='tbox'><option></option>";
        for($i=1;$i<=12;$i++){
            if ($i<10){$j="0$i";}else{$j=$i;}
                if ($j==$month0){
                $ret.= "<option value=$j selected>$tabmonth[$i]</option>";
                }else {
                $ret.= "<option value=$j >$tabmonth[$i]</option>";
                }
            }
    $ret.= "</select>";

    $ret.= "<select name=\"".$yearname."\"  class='tbox'><option></option>";
        $gettoday=getdate();
        $todayyear=$gettoday['year'];
        for($i=1900;$i<=$todayyear;$i++){
            if ($i==$year0){
            $ret.= "<option value=$i selected>$i</option>";
            }else{
            $ret.= "<option value=$i >$i</option>";
            }
        }
    $ret.= "</select>";
    break;
// --------------------------------- kalender --------------------------------
	case "caleder":

														$DfFormat = $tmp[0];
														$TfFormat = $tmp[1];
                        		$showsTime = ($tmp[2]);
                        		$weekNumbers =($tmp[3]);                       		
                        		$u_value=$tmp[0]." / ".$tmp[1];                        		
														$u_value = str_replace("%","",$u_value);
														$u_value = str_replace("M","i",$u_value);
         									  $data_Value = ($presetvalue > 0) ? date($u_value, $presetvalue) : "";  

       											unset($cal_options);  
      											unset($cal_attrib);  
     												$cal_options['showsTime'] = $showsTime;  
      											$cal_options['showOthers'] = true;  
      											$cal_options['weekNumbers'] = $weekNumbers;  
       											$cal_options['ifFormat'] = $DfFormat." / ".$TfFormat;  ///"%d.%m.%Y / %H:%M"; /// "%d.%b.%Y  %H:%M"
       											$cal_attrib['class'] = "tbox";  
      											$cal_attrib['size'] = "15";  
      											$cal_attrib['name'] = $fieldname;  
       											$cal_attrib['value'] = $data_Value;
       											
       											global $fcal;
 														$ret .= $fcal->make_input_field($cal_options, $cal_attrib);  
                          break;

// --------------------------------- Default--------------------------------
	default:
                        $ret="<input class='tbox' type='text' name='".$form_ext_name."' size='40' value='".$u_value."' maxlength='200' />";
                        break;
                        }
  return $ret;
}




    // View Date Function.
function viewdate($date0,$type='short'){  //format date0 2003-11-01
if($type =='long'){
$tabmonth[1]="January";
$tabmonth[2]="February";
$tabmonth[3]="March";
$tabmonth[4]="April";
$tabmonth[5]="May";
$tabmonth[6]="June";
$tabmonth[7]="July";
$tabmonth[8]="August";
$tabmonth[9]="September";
$tabmonth[10]="October";
$tabmonth[11]="November";
$tabmonth[12]="December";}
elseif($type =='short') {
$tabmonth[1]="Jan";
$tabmonth[2]="Feb";
$tabmonth[3]="Mar";
$tabmonth[4]="Apr";
$tabmonth[5]="May";
$tabmonth[6]="Jun";
$tabmonth[7]="Jul";
$tabmonth[8]="Aug";
$tabmonth[9]="Sep";
$tabmonth[10]="Oct";
$tabmonth[11]="Nov";
$tabmonth[12]="Dec";}

$day0=substr($date0,8,2);
$month0=substr($date0,5,2);
$year0=substr($date0,0,4);

    if($day0 != ""){
    $daylst = substr($day0,1,1);
        if($daylst>="4" || $daylst == "0" || $day0 > 10){
        $th = "th";
        }elseif($daylst=="3" && $day0 != "13"){
        $th = "rd";
        }elseif($daylst=="2" && $day0 != "12"){
        $th = "nd";
        }elseif($daylst=="1" && $day0 != "11"){
        $th = "st";
        }
    }

    if(substr($day0,0,1)== "0"){     // remove the 0 on the day if found in first position.
    $day0 = str_replace("0","",$day0);
    }



$newmonth = str_replace("0","",$month0);
$ret = $day0.$th." ".$tabmonth[$newmonth]." ".$year0;
return $ret;
}

}

?>
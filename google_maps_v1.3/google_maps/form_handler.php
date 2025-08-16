<?php
/*

===============================================================
   GOOGLE Maps - v1.3 - by keithschm
   www.keithschmitt.com
keithschm AT GMAIL DOT COM

MAp Class from   www.phpinsider.com  ported for use on E107
===============================================================
+---------------------------------------------------------------+
|        e107 website system
|        Cameron's Plugin-Maker Form Handler.
|        a part of Your_plugin v3.1  multilanguage by Juan  Reseau.li
|        For the e107 CMS system originally by
|        ©Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).

+---------------------------------------------------------------+
*/
$lan_file = e_PLUGIN."google_maps/languages/admin/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."google_maps/languages/admin/English.php");
class form{

    function form_open($form_method, $form_action, $form_name="", $form_target = "", $form_enctype=""){
                $method = ($form_method ? "method='".$form_method."'" : "");
                $target = ($form_target ? " target='".$form_target."'" : "");
                $name = ($form_name ? " id='".$form_name."'" : "");
                return "\n<form action='".$form_action."' ".$method.$target.$name.$form_enctype.">";
        }


      // Cameron's Form Function.

	function user_extended_element_edit($form_ext_name,$presetvalue, $fieldname){

                        global $pref,$key,$sql,$user_pref;$_POST;
                        $ut = explode("|",$form_ext_name);
                        $u_name = ($ut[0] != "") ? $ut[0] : trim($form_ext_name);
                        $u_type = trim($ut[1]);
                        $u_value = stripslashes($ut[2]);
                        $tmp = explode(",",$u_value);

                        switch ($u_type) {

// --------------------------------- Radio buttons --------------------------------
	case "radio":

                            for ($i=0; $i<count($tmp); $i++) {
                            $checked = ($tmp[$i] == $presetvalue)? " checked='checked'" : "";
                            $ret .="<input  type='radio' name='".$fieldname."'  value='".$tmp[$i]."' $checked  /> $tmp[$i] <br />";


                            };

                          break;
// --------------------------------- Chechbox --------------------------------
	case "checkbox":

                            for ($i=0; $i<count($tmp); $i++) {
                            $checked = ($tmp[$i] == $presetvalue)? " checked='checked'" : "";
                            $ret .="<input  type='checkbox' name='".$fieldname."'  value='".$tmp[$i]."' $checked /><br />";
                            };
                          break;


// --------------------------------- Dropdown Menu --------------------------------

	case "dropdown":
                            $ret ="<select class='tbox' style='width:200px'  name='".$fieldname."'><option></option>";
                            for ($i=0; $i<count($tmp); $i++) {
                            $checked = ($tmp[$i] == $presetvalue)? " selected='selected'" : "";
                            $ret .="<option value='$tmp[$i]' $checked >". $tmp[$i] ."</option />\n";
                            };
                            $ret .="</select>";
                          break;

// --------------------------------- Dropdown menu 2 --------------------------------

	case "dropdown2":


							$ret ="<select class='tbox' style='width:200px'  name='".$fieldname."'><option></option>";
                            for ($i=0; $i<count($tmp); $i++) {
                            $split = explode(":",$tmp[$i]);
                            $checked = ($split[0] == $presetvalue)? " selected='selected'" : "";
                            $ret .="<option value='".$split[0]."' $checked >". $split[1] ."</option />\n";
                            };
                            $ret .="</select>";
                          break;

// --------------------------------- Dropdown Readonly --------------------------------

	case "dropdown-readonly":

							$ret = $presetvalue."&nbsp;";
							break;

// --------------------------------- Textbox --------------------------------
	case "text":
                            $valuehere = ($presetvalue !="")? $presetvalue : $tmp[0];
                            $size = ($tmp[1]) ? $tmp[1]:40;
                            $ret .="<input class='tbox' type='text' name='".$fieldname."' size='$size' value='".htmlentities($valuehere) ."' maxlength='200' />";

                            break;


// --------------------------------- Textarea --------------------------------
	case "textarea":
                            $width = $tmp[1];
                            $height = $tmp[2];
                            $valuehere = $presetvalue;
                            $ret .="<textarea id='".$fieldname."' class='tbox' name='".$fieldname."' cols='2' rows='2' style='width:$width;height:$height'>".htmlentities($valuehere) ."</textarea>";

                            break;

// --------------------------------- Table --------------------------------
	case "table":
                            $ret ="<select class='tbox' style='width:200px'  name='".$fieldname."'><option></option>";

                            $fieldid = $row[$tmp[1]];
                            $fieldvalue = $row[$tmp[2]];
                            $sql -> db_Select($tmp[0],"*","$tmp[1] !='' ORDER BY $tmp[2]");
                                while($row = $sql-> db_Fetch()){
                                $fieldid = $row[$tmp[1]];
                                $fieldvalue = $row[$tmp[2]];
                            $checked = ($fieldid == $presetvalue)? " selected='selected'" : "";
                            $ret .="<option value='".$fieldid."' $checked > $fieldvalue </option>";
                            }
                            $ret .="</select>";

                          break;

// --------------------------------- Table Readonly --------------------------------

	case "table-readonly":
                            $sql -> db_Select($tmp[0],"*"," $tmp[1] = '$presetvalue'");
                            $row = $sql -> db_Fetch();
                            $fieldvalue = $row[$tmp[2]];
                            $fieldvalue .= ($tmp[3])? " - ".$row[$tmp[3]]:"";
                            $ret =  $fieldvalue."&nbsp;";

                          break;


// --------------------------------- Directory --------------------------------
    case "dir":

        	    $folder = $u_value;
	          //  $ret = $folder;
	            $handle=opendir($folder);
	            while ($file = readdir($handle)){
	                if(is_dir($folder.$file) && $file !='CVS' && $file != "." && $file != ".." && $file != "/" ){
	                        $lanlist[] = $file;
	                }
	            }
	            closedir($handle);
	            $ret .= "<select style='width:150px' class='tbox' name='".$fieldname."' ><option></option>";
	            for ($i=0; $i<count($lanlist); $i++) {
	            $selected = ($lanlist[$i] == $presetvalue)? "selected = 'selected'" : "";
	            $ret .="<option value=\"".$lanlist[$i]."\" $selected>".$lanlist[$i]."</option>";
	            }
	            $ret .= " </select>";

    break;
// --------------------------------- Images --------------------------------
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
        <input class='button' type ='button' style='cursor:pointer' size='30' value='".LAN_ADM_YPLUG_37."' onclick='expandit(this)' />
        <div id='".$fieldname."_box' style='display:none'>";

        foreach($iconlist as $key=>$icon){
        $ret .= "<a href=\"javascript:insertext('$icon','$fieldname','".$fieldname."_box')\" ><img src='".$folder.$icon."' style='border:0px' alt='' /></a> ";
        }


        $ret .= "</div>";


        break;
// --------------------------------- Access table --------------------------------

	case "accesstable":
                            $ret ="<select class='tbox' style='width:200px'  name='".$fieldname."'><option></option>";

                            $checked = ($presetvalue == 0)? " selected='selected'" : "";
                            $ret .="<option value='0' $checked >".LAN_ADM_YPLUG_38."</option>";
                            $checked = ($presetvalue == 252)? " selected='selected'" : "";
                            $ret .="<option value='252' $checked >".LAN_ADM_YPLUG_39."</option>";
                            $checked = ($presetvalue == 253)? " selected='selected'" : "";
                            $ret .="<option value='253' $checked >".LAN_ADM_YPLUG_40."</option>";
                            $checked = ($presetvalue == 254)? " selected='selected'" : "";
                            $ret .="<option value='254' $checked >".LAN_ADM_YPLUG_41."</option>";
                            $checked = ($presetvalue == 255)? " selected='selected'" : "";
                            $ret .="<option value='255' $checked >".LAN_ADM_YPLUG_42."</option>";
                            $sql -> db_Select('userclass_classes',"userclass_id, userclass_name"," ORDER BY userclass_name", "no_where");
                                while($row = $sql-> db_Fetch()){
                                extract($row);
                            $checked = ($userclass_id == $presetvalue)? " selected='selected' " : "";
                            $ret .="<option value='".$userclass_id."' $checked > $userclass_name </option>";
                            }
                            $ret .="</select>";

                          break;







// --------------------------------- Date --------------------------------
	case "date":
    	                $tabmonth[1]= LAN_ADM_YPLUG_43;//"January";
	                    $tabmonth[2]= LAN_ADM_YPLUG_44;//"February";
	                    $tabmonth[3]= LAN_ADM_YPLUG_45;//"March";
	                    $tabmonth[4]= LAN_ADM_YPLUG_46;//"April";
	                    $tabmonth[5]= LAN_ADM_YPLUG_47;//"May";
	                    $tabmonth[6]= LAN_ADM_YPLUG_48;//"June";
	                    $tabmonth[7]= LAN_ADM_YPLUG_49;//"July";
	                    $tabmonth[8]= LAN_ADM_YPLUG_50;//"August";
	                    $tabmonth[9]= LAN_ADM_YPLUG_51;//"September";
	                    $tabmonth[10]= LAN_ADM_YPLUG_52;//"October";
	                    $tabmonth[11]= LAN_ADM_YPLUG_53;//"November";
	                    $tabmonth[12]= LAN_ADM_YPLUG_54;//"December";

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
	                                      $ret.= "<option value='$j' selected='selected'>$i</option>";
	                                      } else {
	                                      $ret.= "<option value='$j' >$i</option>";
	                                      }
	                            }
	                    $ret.= "</select>";

	                    $ret.= "<select name=\"".$monthname."\"  class='tbox'><option></option>";
	                        for($i=1;$i<=12;$i++){
	                            if ($i<10){$j="0$i";}else{$j=$i;}
	                                if ($j==$month0){
	                                $ret.= "<option value='$j' selected='selected'>".$tabmonth[$i]."</option>";
	                                }else {
	                                $ret.= "<option value='$j' >".$tabmonth[$i]."</option>";
	                                }
	                            }
	                    $ret.= "</select>";

	                    $ret.= "<select name=\"".$yearname."\"  class='tbox'><option></option>";
	                        $gettoday=getdate();
	                        $todayyear=$gettoday['year'];
	                        for($i=1900;$i<=$todayyear;$i++){
	                            if ($i==$year0){
	                            $ret.= "<option value='$i' selected='selected'>$i</option>";
	                            }else{
	                            $ret.= "<option value='$i' >$i</option>";
	                            }
	                        }
	                    $ret.= "</select>";
	                    break;

// --------------------------------- Datestamp Unix --------------------------------

	case "datestamp":
    	                $tabmonth[1]= LAN_ADM_YPLUG_43;//"January";
	                    $tabmonth[2]= LAN_ADM_YPLUG_44;//"February";
	                    $tabmonth[3]= LAN_ADM_YPLUG_45;//"March";
	                    $tabmonth[4]= LAN_ADM_YPLUG_46;//"April";
	                    $tabmonth[5]= LAN_ADM_YPLUG_47;//"May";
	                    $tabmonth[6]= LAN_ADM_YPLUG_48;//"June";
	                    $tabmonth[7]= LAN_ADM_YPLUG_49;//"July";
	                    $tabmonth[8]= LAN_ADM_YPLUG_50;//"August";
	                    $tabmonth[9]= LAN_ADM_YPLUG_51;//"September";
	                    $tabmonth[10]= LAN_ADM_YPLUG_52;//"October";
	                    $tabmonth[11]= LAN_ADM_YPLUG_53;//"November";
	                    $tabmonth[12]= LAN_ADM_YPLUG_54;//"December";

    $day0= ($presetvalue) ? date("j",$presetvalue):"";
    $month0= ($presetvalue) ? date("n",$presetvalue):"";
    $year0= ($presetvalue) ? date("Y",$presetvalue):"";

    $dayname = $fieldname."_day";
    $monthname = $fieldname."_month";
    $yearname = $fieldname."_year";

    $ret= "<select name=\"". $dayname."\"  class='tbox'><option></option>";
        for($i=1;$i<=31;$i++){
            if ($i<10){$j="0$i";}else{$j=$i;}
                      if ($j==$day0){
                      $ret.= "<option value='$j' selected='selected'>$i</option>";
                      } else {
                      $ret.= "<option value='$j' >$i</option>";
                      }
            }
    $ret.= "</select>";



    $ret.= "<select name=\"".$monthname."\"  class='tbox'><option></option>";
        for($i=1;$i<=12;$i++){
            if ($i<10){$j="0$i";}else{$j=$i;}
                if ($j==$month0){
                $ret.= "<option value='$j' selected='selected'>$tabmonth[$i]</option>";
                }else {
                $ret.= "<option value='$j' >$tabmonth[$i]</option>";
                }
            }
    $ret.= "</select>";

    $ret.= "<select name=\"".$yearname."\"  class='tbox'><option></option>";


        $gettoday=getdate();
        $todayyear=$gettoday['year'];

		$yr_start = ($tmp[0]) ? $tmp[0] : 2000;
		$yr_end = ($tmp[1]) ? $tmp[1] : $todayyear+1;

        for($i=$yr_start;$i<=$yr_end;$i++){
            if ($i==$year0){
            $ret.= "<option value='$i' selected='selected'>$i</option>";
            }else{
            $ret.= "<option value='$i' >$i</option>";
            }
        }
    $ret.= "</select>";
    break;








// --------------------------------- Default--------------------------------


	default:
                        $ret .="<input class='tbox' type='text' name='".$form_ext_name."' size='40' value='".$u_value."' maxlength='200' />";
                        break;
                        }

                        return $ret;


}

// OTHER FUNCTIONS. ===================




    // View Date Function.
function viewdate($date0,$type='short'){  //format date0 2003-11-01
if($type =='long'){
    	                $tabmonth[1]= LAN_ADM_YPLUG_43;//"January";
	                    $tabmonth[2]= LAN_ADM_YPLUG_44;//"February";
	                    $tabmonth[3]= LAN_ADM_YPLUG_45;//"March";
	                    $tabmonth[4]= LAN_ADM_YPLUG_46;//"April";
	                    $tabmonth[5]= LAN_ADM_YPLUG_47;//"May";
	                    $tabmonth[6]= LAN_ADM_YPLUG_48;//"June";
	                    $tabmonth[7]= LAN_ADM_YPLUG_49;//"July";
	                    $tabmonth[8]= LAN_ADM_YPLUG_50;//"August";
	                    $tabmonth[9]= LAN_ADM_YPLUG_51;//"September";
	                    $tabmonth[10]= LAN_ADM_YPLUG_52;//"October";
	                    $tabmonth[11]= LAN_ADM_YPLUG_53;//"November";
	                    $tabmonth[12]= LAN_ADM_YPLUG_54;//"December";
}
elseif($type =='short') {
    	                $tabmonth[1]= LAN_ADM_YPLUG_55;//"Jan";
	                    $tabmonth[2]= LAN_ADM_YPLUG_56;//"Feb";
	                    $tabmonth[3]= LAN_ADM_YPLUG_57;//"Mar";
	                    $tabmonth[4]= LAN_ADM_YPLUG_58;//"Apr";
	                    $tabmonth[5]= LAN_ADM_YPLUG_59;//"May";
	                    $tabmonth[6]= LAN_ADM_YPLUG_60;//"Jun";
	                    $tabmonth[7]= LAN_ADM_YPLUG_61;//"Jul";
	                    $tabmonth[8]= LAN_ADM_YPLUG_62;//"Aug";
	                    $tabmonth[9]= LAN_ADM_YPLUG_63;//"Sep";
	                    $tabmonth[10]= LAN_ADM_YPLUG_64;//"Oct";
	                    $tabmonth[11]= LAN_ADM_YPLUG_65;//"Nov";
	                    $tabmonth[12]= LAN_ADM_YPLUG_66;//"Dec";
}

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

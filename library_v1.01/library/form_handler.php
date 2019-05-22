<?php
/*
+---------------------------------------------------------------+
| Library management system plugin. License GNU/PGL
| Editor : Daddy Cool ( david.coll@e107educ.org )
|     $Source: /cvsroot/e107educ/e107educ_plugins/library/form_handler.php,v $
|     $Revision: 1.1 $
|     $Date: 2007/01/21 08:02:14 $
|     $Author: daddycool78 $
+---------------------------------------------------------------+
*/
require_once(e_HANDLER."userclass_class.php");

class custom_form{

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

// --------------------------------- Hidden date --------------------------------
    case "text-hiddendate":
      $valuehere = ($presetvalue !="")? $presetvalue : time();
      $ret .="<input type='hidden' name='".$fieldname."' value='".$valuehere."'>";
    break;
// --------------------------------- Textbox --------------------------------
	case "text":
                            $valuehere = ($presetvalue !="")? $presetvalue : $tmp[0];
                            $size = ($tmp[1]) ? $tmp[1]:40;
                            $ret .="<input class='tbox' type='text' name='".$fieldname."' size='$size' value='".htmlentities($valuehere) ."' maxlength='200' />";

                            break;

// --------------------------------- Duree emprunt --------------------------------
	case "text_date":

$day0 = $presetvalue/86400;

	                    $ret= "<select name='". $fieldname."'  class='tbox'><option></option>";
	                        for($i=1;$i<=50;$i++){
	                                      $j = $i * 86400;
	                                      if ($i==$day0){
	                                      $ret.= "<option value='$j' selected='selected'>$i</option>";
	                                      } else {
	                                      $ret.= "<option value='$j' >$i</option>";
	                                      }
	                            }
	                    $ret.= "</select>";
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
// --------------------------------- Table_membre --------------------------------
	case "table_membre":
                            $ret ="<select class='tbox' style='width:200px'  name='".$fieldname."'><option></option>";

                            $fieldid = $row[$tmp[1]];
                            $fieldvalue = $row[$tmp[2]];
                            $sql -> db_Select($tmp[0],"*","$tmp[1] !='' AND membre_annee='$pref[LISTE_anneeencours]' ORDER BY $tmp[2]");
                                while($row = $sql-> db_Fetch()){
                                $fieldid = $row[$tmp[1]];
                                $fieldvalue = $row[$tmp[2]];
                                $fieldvalue2 = $row[$tmp[3]];
                                if ($row[$tmp[4]]=="1"){
                                $emprunt = "(!à déjà un emprunt!)</b>";
                                }else{
                                $emprunt = "";                                
                                };
                            $checked = ($fieldid == $presetvalue)? " selected='selected'" : "";
                            $ret .="<option value='".$fieldid."' $checked > $fieldvalue $fieldvalue2 $emprunt </option>";
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
        <input class='button' type ='button' style='cursor:pointer' size='30' value='Choose' onclick='expandit(this)' />
        <div id='".$fieldname."_box' style='display:none'>";

        foreach($iconlist as $key=>$icon){
        $ret .= "<a href=\"javascript:insertext('$icon','$fieldname','".$fieldname."_box')\" ><img src='".$folder.$icon."' style='border:0px' alt='' /></a> ";
        }


        $ret .= "</div>";


        break;
// --------------------------------- Access table --------------------------------

    case "accesstable":
		$mode = (strpos(e_SELF,"admin_") ? "admin" : "off");
		$ret = r_userclass($fieldname,$presetvalue,$mode);
	break;
// --------------------------------- Date --------------------------------
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

    $month0= ($presetvalue) ? date("n",$presetvalue):"";
    $year0= ($presetvalue) ? date("Y",$presetvalue):"";

    $monthname = $fieldname."_month";
    $yearname = $fieldname."_year";


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

// Color-Code Selector v1.1 for e107 by Cameron.
// Adapted from Htmlarea v3.0

echo "<script type=\"text/javascript\">
// <![CDATA[


    function View(field,color) {
    var fieldname = 'ColorPreview_' + field;                 // preview color
        if(ValidateColor(color)){
            document.getElementById(fieldname).style.backgroundColor = '#' + color;
            document.getElementById(field).value = color;
        }else{
            alert('Your color-code is not valid');
            document.getElementById(field).focus();
        }
    }

    function Set(field,string) {                   // select color
        var color = ValidateColor(string);
        if (color == null) { alert('Invalid color code: ' + string); }        // invalid color
        else {                                            // valid color
            View(field,color);                          // show selected color
            document.getElementById(field).value = color;
        }
    }

    function ValidateColor(string) {                // return valid color code
      string = string || '';
      string = string + \"\";
      string = string.toUpperCase();
      var chars = '0123456789ABCDEF';
      var out   = '';

      for (var i=0; i<string.length; i++) {             // remove invalid color chars
        var schar = string.charAt(i);
        if (chars.indexOf(schar) != -1) { out += schar; }
      }

      if (out.length != 6) { return null; }            // check length
      return out;
    }
// ]]>
</script>";



?>

<?php
/*
+---------------------------------------------------------------+
| Agenda by bugrain (www.bugrain.plus.com)
| see plugin.php for version information
|
| A plugin for the e107 Website System (http://e107.org)
|
| Based on:
|        Cameron's Plugin-Maker Form Handler.
|        For the e107 CMS system originally by
|        ©Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/agenda/form_handler.php,v $
| $Revision: 1.19 $
| $Date: 2006/11/29 01:17:03 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
 
class agenda_form {
   function form_open($form_method, $form_action, $form_name="", $form_target = "", $form_enctype="") {
      $method  = ($form_method   ? "method='".$form_method."'"  : "");
      $target  = ($form_target   ? " target='".$form_target."'" : "");
      $name    = ($form_name     ? " id='".$form_name."'"       : "");
      return "\n<form action='".$form_action."' ".$method.$target.$name.$form_enctype.">";
    }

   // Cameron's Form Function.
   function user_extended_element_edit($form_ext_name, $presetvalue, $fieldname, $js="") {
      global $pref, $key, $sql, $user_pref, $e107Helper;
      $tabmonth[1]   =AGENDA_LAN_08;
      $tabmonth[2]   =AGENDA_LAN_09;
      $tabmonth[3]   =AGENDA_LAN_10;
      $tabmonth[4]   =AGENDA_LAN_11;
      $tabmonth[5]   =AGENDA_LAN_12;
      $tabmonth[6]   =AGENDA_LAN_13;
      $tabmonth[7]   =AGENDA_LAN_14;
      $tabmonth[8]   =AGENDA_LAN_15;
      $tabmonth[9]   =AGENDA_LAN_16;
      $tabmonth[10]  =AGENDA_LAN_17;
      $tabmonth[11]  =AGENDA_LAN_18;
      $tabmonth[12]  =AGENDA_LAN_19;

      $ut         = explode("|", $form_ext_name);
      $u_name     = ($ut[0] != "") ? $ut[0] : trim($form_ext_name);
      $u_type     = trim($ut[1]);
      $u_value    = stripslashes($ut[2]);
      $u_values   = explode(",", $u_value);
      $presetvalue = $e107Helper->tp_toForm($presetvalue);
      switch ($u_type) {
         case "radio":
            for ($i=0; $i<count($u_values); $i++) {
               $checked = ($u_values[$i] == $presetvalue)? " checked='checked'" : "";
               $ret .= "<label for='$fieldname$i'><input type='radio' name='$fieldname' id='$fieldname$i' value='$u_values[$i]'$checked/>$u_values[$i]</label> ";
            }
            break;
         case "radio2":
            for ($i=0; $i<count($u_values); $i++) {
               $tmp = explode(":", $u_values[$i]);
               $checked = ($tmp[0] == $presetvalue)? " checked='checked'" : "";
               $ret .= "<label for='$fieldname$i'><input type='radio' name='$fieldname' id='$fieldname$i' value='$tmp[0]'$checked/>$tmp[1]</label> ";
            }
            break;
         case "checkbox":
            $checked = ($u_values[0] == $presetvalue)? " checked='checked'" : "";
            $ret .= "<label for='$fieldname'><input type='checkbox' name='$fieldname' id='$fieldname' value='$u_values[0]'$checked/>$u_values[0]</label><br />";
            break;
         case "checkbox2":
            $tmp = explode(":", $u_values[0]);
            $checked = ($tmp[0] == $presetvalue)? " checked='checked'" : "";
            $ret .= "<label for='$fieldname'><input type='checkbox' name='$fieldname' id='$fieldname' value='$tmp[0]'$checked/>$tmp[1]</label><br />";
            break;
         case "multilist":
            $ret ="<select class='tbox' style='width:200px' name='".$fieldname."[]' id='$fieldname' size='5' multiple $js>";
            $presets = explode(",", $presetvalue);
            for ($i=0; $i<count($u_values); $i++) {
               $checked = "";
               for ($j=0; $j<count($presets); $j++) {
                  if ($u_values[$i] == $presets[$j]) {
                     $checked = "selected";
                     break;
                  }
               }
               $ret .= "<option value='$u_values[$i]'$checked>". $u_values[$i] ."</option>\n";
            }
            $ret .= "</select>";
            break;
         case "multilist2":
            $ret ="<select class='tbox' style='width:200px' name='".$fieldname."[]' id='$fieldname' size='5' multiple $js>";
            $presets = explode(",", $presetvalue);
            for ($i=0; $i<count($u_values); $i++) {
               $tmp = explode(":", $u_values[$i]);
               $checked = "";
               for ($j=0; $j<count($presets); $j++) {
                  if ($tmp[0] == $presets[$j]) {
                     $checked = "selected";
                     break;
                  }
               }
               $ret .= "<option value='$tmp[0]'$checked>". $tmp[1] ."</option>\n";
            }
            $ret .= "</select>";
            break;
         case "dropdown":
            $ret ="<select class='tbox' name='$fieldname' id='$fieldname' $js>";
            for ($i=0; $i<count($u_values); $i++) {
               $checked = ($u_values[$i] == $presetvalue) ? "selected" : "";
               $ret .= "<option value='$u_values[$i]'$checked>". $u_values[$i] ."</option>\n";
            }
            $ret .= "</select>";
            break;
         case "dropdown2":
            $ret ="<select class='tbox' name='$fieldname' id='$fieldname' $js>";
            for ($i=0; $i<count($u_values); $i++) {
               $split = explode(":",$u_values[$i]);
               $checked = ($split[0] == $presetvalue)? "selected" : "";
               $ret .= "<option value='".$split[0]."'$checked>". $split[1] ."</option>\n";
            }
            $ret .= "</select>";
            break;
         case "dropdown-readonly":
            $ret = $presetvalue."&nbsp;";
            break;
         case "text":
            $valuehere = ($presetvalue !="")? $presetvalue : $u_values[0];
            $size = ($u_values[1]) ? $u_values[1]:40;
            $ret .= "<input class='tbox' type='text' name='$fieldname' id='$fieldname' size='$size' value='".htmlentities($valuehere, ENT_COMPAT, "UTF-8") ."' maxlength='$u_values[2]' />";
            break;
         case "color":
            $ret = agendaColorSelect($fieldname,$presetvalue);
            break;
         case "textarea":
            $width = $u_values[1];
            $height = $u_values[2];
            $valuehere = $presetvalue;
            $ret .= "<textarea class='tbox' name='$fieldname' id='$fieldname' cols='2' rows='2' style='width:$width;height:$height'>".htmlentities($valuehere, ENT_COMPAT, "UTF-8") ."</textarea>";
            break;
         case "table":
            $ret ="<select class='tbox' style='width:200px' name='$fieldname' id='$fieldname'><option></option>";
            $fieldid = $row[$u_values[1]];
            $fieldvalue = $row[$u_values[2]];
            $sql -> select($u_values[0],"*"," $u_values[1] !='' ORDER BY $u_values[2]");
            while($row = $sql-> db_Fetch()) {
               $fieldid = $row[$u_values[1]];
               $fieldvalue = $row[$u_values[2]];
               $checked = ($fieldid == $presetvalue)? " selected" : "";
               $ret .= "<option value='".$fieldid."' $checked > $fieldvalue </option>";
            }
            $ret .= "</select>";
            break;
         case "table-readonly":
            $sql -> select($u_values[0],"*"," $u_values[1] = '$presetvalue'");
            $row = $sql -> db_Fetch();
            $fieldvalue = $row[$u_values[2]];
            $fieldvalue .= ($u_values[3])? " - ".$row[$u_values[3]]:"";
            $ret =  $fieldvalue."&nbsp;";
            break;
         case "dir":
            $folder = $u_value;
            //  $ret = $folder;
            $handle=opendir($folder);
            while ($file = readdir($handle)) {
               if (is_dir($folder.$file) && $file !='CVS' && $file != "." && $file != ".." && $file != "/" ) {
                  $lanlist[] = $file;
               }
            }
            closedir($handle);
            $ret .= "<select style='width:150px' class='tbox' name='$fieldname' id='$fieldname'><option></option>";
            for ($i=0; $i<count($lanlist); $i++) {
               $selected = ($lanlist[$i] == $presetvalue)? "selected = 'selected'" : "";
               $ret .= "<option value=\"".$lanlist[$i]."\" $selected>".$lanlist[$i]."</option>";
            }
            $ret .= " </select>";
            break;
         case "image" :
            $folder = $u_value;
            $handle = opendir($folder);
            while ($file = readdir($handle)) {       
               if (is_file($folder.$file) && (preg_match("%".".jpg"."%i",$file) || preg_match("%".".gif"."%i",$file) || preg_match("%".".png"."%i",$file))) {
                  $iconlist[] = $file;
               }
            }
            closedir($handle);
            $ret = "<input class='tbox' style='width:300px' type='text' name='$fieldname' id='$fieldname' value='$presetvalue' maxlength='100' />
            <input class='button' type ='button' style='cursor:pointer' value='Choose' onclick='expandit(this)' />
            <div id='".$fieldname."_box' style='display:none'>";

            foreach ($iconlist as $key=>$icon) {
               $ret .= "<a href=\"javascript:addicontext('$folder$icon','$fieldname')\" ><img src='".$folder.$icon."' style='border:0px' alt='' /></a> ";
            }
            $ret .= "</div>";
            break;
         case "accesstable":
            $ret ="<select class='tbox' style='width:200px' name='$fieldname' id='$fieldname'>";
            $checked = ($presetvalue == 0)? " selected" : "";
            $ret .= "<option value='0' $checked > Everyone </option>";
            $checked = ($presetvalue == 252)? " selected" : "";
            $ret .= "<option value='252' $checked > Guest Only </option>";
            $checked = ($presetvalue == 253)? " selected" : "";
            $ret .= "<option value='253' $checked > Members Only </option>";
            $checked = ($presetvalue == 254)? " selected" : "";
            $ret .= "<option value='254' $checked > Administrators Only </option>";
            $checked = ($presetvalue == 255)? " selected" : "";
            $ret .= "<option value='255' $checked > No One (inactive) </option>";
            $sql -> select('userclass_classes',"userclass_id, userclass_name"," ORDER BY userclass_name", "no_where");
            while($row = $sql-> db_Fetch()) {
               extract($row);
               $checked = ($userclass_id == $presetvalue)? " selected " : "";
               $ret .= "<option value='".$userclass_id."' $checked > $userclass_name </option>";
            }
            $ret .= "</select>";
            break;
         case "date":
            $day0    = $presetvalue ? substr($presetvalue,6,2) : substr($u_values[1],6,2);
            $month0  = $presetvalue ? substr($presetvalue,4,2) : substr($u_values[1],4,2);
            $year0   = $presetvalue ? substr($presetvalue,0,4) : substr($u_values[1],0,4);

            $dayname    = $fieldname."_day";
            $monthname  = $fieldname."_month";
            $yearname   = $fieldname."_year";

            $ret= "<select name='$dayname' id='$dayname' class='tbox'><option></option>";
            for($i=1;$i<=31;$i++) {
               if ($i<10) {
                  $j="0$i";
               } else {
                  $j=$i;
               }
               if ($j==$day0) {
                  $ret.= "<option value='$j' selected='true'>$j</option>";
               } else {
                  $ret.= "<option value='$j' >$j</option>";
               }
            }
            $ret.= "</select>";
            $ret.= "<select name='$monthname' id='$dayname' class='tbox'><option></option>";
            for($i=1;$i<=12;$i++) {
               if ($i<10) {
                  $j="0$i";
                } else {
                  $j=$i;
               }
               if ($j==$month0) {
                  $ret.= "<option value='$j' selected='true'>".$tabmonth[$i]."</option>";
               } else {
                  $ret.= "<option value='$j' >".$tabmonth[$i]."</option>";
               }
            }
            $ret.= "</select>";
            $ret.= "<select name='$yearname' id='$dayname' class='tbox'><option></option>";
            $gettoday=getdate();
            $today_arryear=$gettoday['year'];
            for($i=1900;$i<=$today_arryear;$i++) {
               if ($i==$year0) {
                  $ret.= "<option value='$i' selected='true'>$i</option>";
               } else {
                  $ret.= "<option value='$i' >$i</option>";
               }
            }
            $ret.= "</select>";
            break;
         case "datestamp":
            $day0    = ($presetvalue) ? date("j",$presetvalue):"";
            $month0  = ($presetvalue) ? date("n",$presetvalue):"";
            $year0   = ($presetvalue) ? date("Y",$presetvalue):"";

            $dayname    = $fieldname."_day";
            $monthname  = $fieldname."_month";
            $yearname   = $fieldname."_year";

            $ret = "<select name='$dayname' id='$dayname' class='tbox'><option></option>";
            for($i=1;$i<=31;$i++) {
               if ($i<10) {
                  $j="0$i";
               } else {
                  $j=$i;
               }
               if ($j==$day0) {
                  $ret.= "<option value='$j' selected='true'>$i</option>";
               } else {
                  $ret.= "<option value='$j' >$i</option>";
               }
            }
            $ret .= "</select>";

            $ret .= "<select name='$monthname' id='$dayname' class='tbox'><option></option>";
            for($i=1;$i<=12;$i++) {
               if ($i<10) {
                  $j="0$i";
               } else {
                  $j=$i;
               }
                 if ($j==$month0) {
                  $ret.= "<option value='$j' selected='true'>$tabmonth[$i]</option>";
               } else {
                  $ret.= "<option value='$j' >$tabmonth[$i]</option>";
               }
            }
            $ret .= "</select>";

            $ret .= "<select name='$yearname' id='$dayname' class='tbox'><option></option>";
            $gettoday =getdate();
            $today_arryear=$gettoday['year'];
            $yr_start = ($u_values[0]) ? $u_values[0] : 2000;
            $yr_end   = ($u_values[1]) ? $u_values[1] : $today_arryear+1;

            for($i=$yr_start;$i<=$yr_end;$i++) {
               if ($i==$year0) {
                  $ret.= "<option value='$i' selected='true'>$i</option>";
               } else {
                  $ret.= "<option value='$i' >$i</option>";
               }
            }
            $ret.= "</select>";
            break;
         case "calendar":
            $ret .= $this->formcalendar($fieldname, $presetvalue, $u_values[0], 'date');
            break;
         case "time":
            $ret .= $this->formtime($fieldname, $presetvalue, $u_values[0], 'datetime');
            break;
         case "calendartime" :
            $preset = explode(",", $presetvalue);
            $ret .= $this->formcalendar($fieldname, $preset[0], $u_values[0]);
            //$ret .= "&nbsp;&nbsp;&nbsp;";
            //$ret .= $this->formtime($fieldname, $preset[1], $u_values[1]);
            break;
         case "button" :
            $ret .= "<input type='button' class='button' name='$u_name' id='$u_name' value='$u_value' $js />";
            break;
         case "diarycode" :
            $ret .= "<select class='tbox' name='".$u_name."_0' id='".$u_name."_0' onchange='agendaDCodePopulate1(event, \"$u_name\", \"\");'></select>";
            $ret .= "<select class='tbox' name='".$u_name."_1' id='".$u_name."_1' onchange='agendaDCodePopulate2(event, \"$u_name\", \"\");' style='visibility:hidden' disabled></select>";
            $ret .= "<select class='tbox' name='".$u_name."_2' id='".$u_name."_2' style='visibility:hidden' disabled></select>";
            $ret .= "<script type='text/javascript' language='javascript'>";
            $ret .= "   agendaDCodePopulate0('$u_name', '$presetvalue');";
            $ret .= "</script>";
            break;
         default:
            $ret .= "<input class='tbox' type='text' name='$u_name' id='$u_name' size='40' value='$u_value' maxlength='200' />";
            break;
      }
      return $ret;
   }

// OTHER FUNCTIONS. ===================

   function formcalendar($fieldname, $presetvalue, $value, $type = "datetime") {
      global $agenda, $pref;

		$attrib['type'] = $type;    
        $attrib['size'] = ($type =="date")? "small" : "x-large"; 
        $attrib['id'] = 'f-calendar-field-1';                        
		$value   = ($presetvalue !="")? $presetvalue : $value;
		$options = array(
			'type' => 'datestamp', 
			'data' => 'int',
			'writeParms' => $attrib
		); 
		$text = e107::getForm()->renderElement($fieldname, $value, $options );
		return $text;
   }

   function formtime($fieldname, $presetvalue, $value) {
      $time    = ($presetvalue !="") ? explode(".", $presetvalue) : explode(".", $value);
      $hname   = $fieldname."_h";
      $mname   = $fieldname."_m";

      $ret .= "<select name=\"".$hname."\" class='tbox'>";
      for($i=0; $i<=23; $i++) {
         $selected = ($i==$time[0]) ? " selected='true'" : "";
         if ($i < 10) {
            $ret.= "<option value='0$i'$selected>0$i</option>";
         } else {
            $ret.= "<option value='$i'$selected>$i</option>";
         }
      }
      $ret.= "</select>&nbsp;:&nbsp;";
      $ret .= "<select name=\"".$mname."\" class='tbox'>";
      for($i=0; $i<=59; $i++) {
         $selected = ($i==$time[1]) ? " selected='true'" : "";
         if ($i < 10) {
            $ret.= "<option value='0$i'$selected>0$i</option>";
         } else {
            $ret.= "<option value='$i'$selected>$i</option>";
         }
      }
      $ret.= "</select>";
      return $ret;
   }

   // Get date from input fields
   function getfieldvalue($name, $type, $debug=false) {
      global $e107Helper;
      switch ($type) {
		   case "date" :
		   case "datestamp" :
		      $year  = $name."_year";
		      $month = $name."_month";
		      $day   = $name."_day";

		   	if ($type == "date") {
		   		$value = $_POST[$year]."-".$_POST[$month]."-".$_POST[$day];
           	} else {
		   		$value = mktime(0,0,0,$_POST[$month],$_POST[$day],$_POST[$year]);
           	}
           	break;
         case "calendar" :
            $value = (int) $_POST[$name];
            break;
         case "time" :
            $value = $_POST[$name."_h"] . $_POST[$name."_m"];
            break;
         case "calendartime" :
            $value = (int) $_POST[$name];
            break;
         case "multilist" :
         case "multilist2" :
            $value = implode(",", $_POST[$name]);
            break;
         case "diarycode" :
		      $p1 = $_POST[$name."_0"];
		      $p2 = $_POST[$name."_1"];
		      $p3 = $_POST[$name."_2"];
            $value = "$p1$p2$p3";
            break;
		   case "checkbox2" :
		      if (isset($_POST[$name])) {
               $value = $e107Helper->tp_toDB($_POST[$name], false, false);
		      } else {
               $value = 0;
		      }
		      break;
		   default:
            $value = $e107Helper->tp_toDB($_POST[$name]);
		}
		if ($debug) print "$name ($type) = $value<br>";
      return $value;
   }

   // Validate a field value
   function validatefieldvalue($name, $type, $value, $mandatory=false, $debug=false) {
      $ret = true;

      switch ($type) {
         case "calendar" :
         case "calendartime" :
            if ($value < 0) {
               $ret = false;
            }
            break;
         case "diarycode" :
            if (strpos($value, "X") !== false) {
               $ret = false;
            }
            break;
         default :
            $ret = true;
      }
      return $ret;
   }

   // View Date Function.
   function viewdate($date0,$type='short') {  //format date0 2003-11-01
      $tabmonth[1]   = AGENDA_LAN_08;
      $tabmonth[2]   = AGENDA_LAN_09;
      $tabmonth[3]   = AGENDA_LAN_10;
      $tabmonth[4]   = AGENDA_LAN_11;
      $tabmonth[5]   = AGENDA_LAN_12;
      $tabmonth[6]   = AGENDA_LAN_13;
      $tabmonth[7]   = AGENDA_LAN_14;
      $tabmonth[8]   = AGENDA_LAN_15;
      $tabmonth[9]   = AGENDA_LAN_16;
      $tabmonth[10]  = AGENDA_LAN_17;
      $tabmonth[11]  = AGENDA_LAN_18;
      $tabmonth[12]  = AGENDA_LAN_19;

      if ($type =='short') {
         $tabmonth[1]   = substr($tabmonth[1], 0, 3);
         $tabmonth[2]   = substr($tabmonth[2], 0, 3);
         $tabmonth[3]   = substr($tabmonth[3], 0, 3);
         $tabmonth[4]   = substr($tabmonth[4], 0, 3);
         $tabmonth[5]   = substr($tabmonth[5], 0, 3);
         $tabmonth[6]   = substr($tabmonth[6], 0, 3);
         $tabmonth[7]   = substr($tabmonth[7], 0, 3);
         $tabmonth[8]   = substr($tabmonth[8], 0, 3);
         $tabmonth[9]   = substr($tabmonth[9], 0, 3);
         $tabmonth[10]  = substr($tabmonth[10], 0, 3);
         $tabmonth[11]  = substr($tabmonth[11], 0, 3);
         $tabmonth[12]  = substr($tabmonth[12], 0, 3);
      }

      $day0=substr($date0,8,2);
      $month0=substr($date0,5,2);
      $year0=substr($date0,0,4);

      if ($day0 != "") {
         $daylst = substr($day0,1,1);
         if ($daylst>="4" || $daylst == "0" || $day0 > 10) {
            $th = "th";
         } elseif ($daylst=="3" && $day0 != "13") {
            $th = "rd";
         } elseif ($daylst=="2" && $day0 != "12") {
            $th = "nd";
         } elseif ($daylst=="1" && $day0 != "11") {
            $th = "st";
         }
      }

      if (substr($day0,0,1)== "0") {     // remove the 0 on the day if found in first position.
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
        if (ValidateColor(color)) {
            document.getElementById(fieldname).style.backgroundColor = '#' + color;
            document.getElementById(field).value = color;
        } else {
            alert('Your color-code is not valid');
            document.getElementById(field).focus();
        }
    }

    function Set(field,string) {                   // select color
        var color = ValidateColor(string);
        if (color == null) { alert('Invalid color code: ' + string); }        // invalid color
        else {                         // valid color
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

function agendaColorSelect($field,$dbvalue) {
  $dbvalue = $dbvalue == "" ? "000000" : $dbvalue;
  $bgcolor = "#".$dbvalue;
 /* $text .= "<table cellspacing=\"0px\" cellpadding=\"4\" style='width:100%;border:0px'>
     <tr>
      <td style='vertical-align:center'><div style=\"background-color: $bgcolor; border:1px solid black; height: 20px; width: 25px\"><div id=\"ColorPreview_".$field."\" style=\"height: 100%; width: 100%\"></div></div> </td>
      <td style='vertical-align:center'>&nbsp;#<input class='tbox' type=\"text\" name=\"".$field."\" id=\"".$field."\" value=\"".$dbvalue."\" size='15' onblur=\"View('".$field."',this.value)\">
      </td>
      <td style='width:100%'>&nbsp;<input class='button' type='button' value='Choose' onClick='expandit(this)'>


      </td>
     </tr>
    </table>";*/

  $text .= "<span style=\"background-color: $bgcolor; border:1px solid black; height: 25px\">";
  $text .= "<span id=\"ColorPreview_".$field."\" style=\"border:1px;height: 100%; width: 28px\">&nbsp;&nbsp;&nbsp;&nbsp;</span></span>";
  $text .= "&nbsp;#<input class='tbox' type=\"text\" name=\"".$field."\" id=\"".$field."\" value=\"".$dbvalue."\" size='15' onblur=\"View('".$field."',this.value)\" />
      &nbsp;<input class='button' type='button' value='Choose' onclick='expandit(this)' />";

  $text .= "
     <div style='display: none;' id='button' onclick=\"this.style.display='none'\">
    <table cellspacing=\"1px\" cellpadding=\"0px\" width=\"100%\"  style=\"background-color:#000000;border:0px;cursor: pointer;\">
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#003300' onmouseover=\"View('".$field."','003300')\" onclick=\"Set('".$field."','003300')\" ></td>
    <td style='width:10px;height:10px;background-color:#006600' onmouseover=\"View('".$field."','006600')\" onclick=\"Set('".$field."','006600')\" ></td>
    <td style='width:10px;height:10px;background-color:#009900' onmouseover=\"View('".$field."','009900')\" onclick=\"Set('".$field."','009900')\" ></td>
    <td style='width:10px;height:10px;background-color:#00CC00' onmouseover=\"View('".$field."','00CC00')\" onclick=\"Set('".$field."','00CC00')\" ></td>
    <td style='width:10px;height:10px;background-color:#00FF00' onmouseover=\"View('".$field."','00FF00')\" onclick=\"Set('".$field."','00FF00')\" ></td>
    <td style='width:10px;height:10px;background-color:#330000' onmouseover=\"View('".$field."','330000')\" onclick=\"Set('".$field."','330000')\" ></td>
    <td style='width:10px;height:10px;background-color:#333300' onmouseover=\"View('".$field."','333300')\" onclick=\"Set('".$field."','333300')\" ></td>
    <td style='width:10px;height:10px;background-color:#336600' onmouseover=\"View('".$field."','336600')\" onclick=\"Set('".$field."','336600')\" ></td>
    <td style='width:10px;height:10px;background-color:#339900' onmouseover=\"View('".$field."','339900')\" onclick=\"Set('".$field."','339900')\" ></td>
    <td style='width:10px;height:10px;background-color:#33CC00' onmouseover=\"View('".$field."','33CC00')\" onclick=\"Set('".$field."','33CC00')\" ></td>
    <td style='width:10px;height:10px;background-color:#33FF00' onmouseover=\"View('".$field."','33FF00')\" onclick=\"Set('".$field."','33FF00')\" ></td>
    <td style='width:10px;height:10px;background-color:#660000' onmouseover=\"View('".$field."','660000')\" onclick=\"Set('".$field."','660000')\" ></td>
    <td style='width:10px;height:10px;background-color:#663300' onmouseover=\"View('".$field."','663300')\" onclick=\"Set('".$field."','663300')\" ></td>
    <td style='width:10px;height:10px;background-color:#666600' onmouseover=\"View('".$field."','666600')\" onclick=\"Set('".$field."','666600')\" ></td>
    <td style='width:10px;height:10px;background-color:#669900' onmouseover=\"View('".$field."','669900')\" onclick=\"Set('".$field."','669900')\" ></td>
    <td style='width:10px;height:10px;background-color:#66CC00' onmouseover=\"View('".$field."','66CC00')\" onclick=\"Set('".$field."','66CC00')\" ></td>
    <td style='width:10px;height:10px;background-color:#66FF00' onmouseover=\"View('".$field."','66FF00')\" onclick=\"Set('".$field."','66FF00')\" ></td>
    </tr>
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#333333' onmouseover=\"View('".$field."','333333')\" onclick=\"Set('".$field."','333333')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#000033' onmouseover=\"View('".$field."','000033')\" onclick=\"Set('".$field."','000033')\" ></td>
    <td style='width:10px;height:10px;background-color:#003333' onmouseover=\"View('".$field."','003333')\" onclick=\"Set('".$field."','003333')\" ></td>
    <td style='width:10px;height:10px;background-color:#006633' onmouseover=\"View('".$field."','006633')\" onclick=\"Set('".$field."','006633')\" ></td>
    <td style='width:10px;height:10px;background-color:#009933' onmouseover=\"View('".$field."','009933')\" onclick=\"Set('".$field."','009933')\" ></td>
    <td style='width:10px;height:10px;background-color:#00CC33' onmouseover=\"View('".$field."','00CC33')\" onclick=\"Set('".$field."','00CC33')\" ></td>
    <td style='width:10px;height:10px;background-color:#00FF33' onmouseover=\"View('".$field."','00FF33')\" onclick=\"Set('".$field."','00FF33')\" ></td>
    <td style='width:10px;height:10px;background-color:#330033' onmouseover=\"View('".$field."','330033')\" onclick=\"Set('".$field."','330033')\" ></td>
    <td style='width:10px;height:10px;background-color:#333333' onmouseover=\"View('".$field."','333333')\" onclick=\"Set('".$field."','333333')\" ></td>
    <td style='width:10px;height:10px;background-color:#336633' onmouseover=\"View('".$field."','336633')\" onclick=\"Set('".$field."','336633')\" ></td>
    <td style='width:10px;height:10px;background-color:#339933' onmouseover=\"View('".$field."','339933')\" onclick=\"Set('".$field."','339933')\" ></td>
    <td style='width:10px;height:10px;background-color:#33CC33' onmouseover=\"View('".$field."','33CC33')\" onclick=\"Set('".$field."','33CC33')\" ></td>
    <td style='width:10px;height:10px;background-color:#33FF33' onmouseover=\"View('".$field."','33FF33')\" onclick=\"Set('".$field."','33FF33')\" ></td>
    <td style='width:10px;height:10px;background-color:#660033' onmouseover=\"View('".$field."','660033')\" onclick=\"Set('".$field."','660033')\" ></td>
    <td style='width:10px;height:10px;background-color:#663333' onmouseover=\"View('".$field."','663333')\" onclick=\"Set('".$field."','663333')\" ></td>
    <td style='width:10px;height:10px;background-color:#666633' onmouseover=\"View('".$field."','666633')\" onclick=\"Set('".$field."','666633')\" ></td>
    <td style='width:10px;height:10px;background-color:#669933' onmouseover=\"View('".$field."','669933')\" onclick=\"Set('".$field."','669933')\" ></td>
    <td style='width:10px;height:10px;background-color:#66CC33' onmouseover=\"View('".$field."','66CC33')\" onclick=\"Set('".$field."','66CC33')\" ></td>
    <td style='width:10px;height:10px;background-color:#66FF33' onmouseover=\"View('".$field."','66FF33')\" onclick=\"Set('".$field."','66FF33')\" ></td>
    </tr>
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#666666' onmouseover=\"View('".$field."','666666')\" onclick=\"Set('".$field."','666666')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#000066' onmouseover=\"View('".$field."','000066')\" onclick=\"Set('".$field."','000066')\" ></td>
    <td style='width:10px;height:10px;background-color:#003366' onmouseover=\"View('".$field."','003366')\" onclick=\"Set('".$field."','003366')\" ></td>
    <td style='width:10px;height:10px;background-color:#006666' onmouseover=\"View('".$field."','006666')\" onclick=\"Set('".$field."','006666')\" ></td>
    <td style='width:10px;height:10px;background-color:#009966' onmouseover=\"View('".$field."','009966')\" onclick=\"Set('".$field."','009966')\" ></td>
    <td style='width:10px;height:10px;background-color:#00CC66' onmouseover=\"View('".$field."','00CC66')\" onclick=\"Set('".$field."','00CC66')\" ></td>
    <td style='width:10px;height:10px;background-color:#00FF66' onmouseover=\"View('".$field."','00FF66')\" onclick=\"Set('".$field."','00FF66')\" ></td>
    <td style='width:10px;height:10px;background-color:#330066' onmouseover=\"View('".$field."','330066')\" onclick=\"Set('".$field."','330066')\" ></td>
    <td style='width:10px;height:10px;background-color:#333366' onmouseover=\"View('".$field."','333366')\" onclick=\"Set('".$field."','333366')\" ></td>
    <td style='width:10px;height:10px;background-color:#336666' onmouseover=\"View('".$field."','336666')\" onclick=\"Set('".$field."','336666')\" ></td>
    <td style='width:10px;height:10px;background-color:#339966' onmouseover=\"View('".$field."','339966')\" onclick=\"Set('".$field."','339966')\" ></td>
    <td style='width:10px;height:10px;background-color:#33CC66' onmouseover=\"View('".$field."','33CC66')\" onclick=\"Set('".$field."','33CC66')\" ></td>
    <td style='width:10px;height:10px;background-color:#33FF66' onmouseover=\"View('".$field."','33FF66')\" onclick=\"Set('".$field."','33FF66')\" ></td>
    <td style='width:10px;height:10px;background-color:#660066' onmouseover=\"View('".$field."','660066')\" onclick=\"Set('".$field."','660066')\" ></td>
    <td style='width:10px;height:10px;background-color:#663366' onmouseover=\"View('".$field."','663366')\" onclick=\"Set('".$field."','663366')\" ></td>
    <td style='width:10px;height:10px;background-color:#666666' onmouseover=\"View('".$field."','666666')\" onclick=\"Set('".$field."','666666')\" ></td>
    <td style='width:10px;height:10px;background-color:#669966' onmouseover=\"View('".$field."','669966')\" onclick=\"Set('".$field."','669966')\" ></td>
    <td style='width:10px;height:10px;background-color:#66CC66' onmouseover=\"View('".$field."','66CC66')\" onclick=\"Set('".$field."','66CC66')\" ></td>
    <td style='width:10px;height:10px;background-color:#66FF66' onmouseover=\"View('".$field."','66FF66')\" onclick=\"Set('".$field."','66FF66')\" ></td>
    </tr>
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#999999' onmouseover=\"View('".$field."','999999')\" onclick=\"Set('".$field."','999999')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#000099' onmouseover=\"View('".$field."','000099')\" onclick=\"Set('".$field."','000099')\" ></td>
    <td style='width:10px;height:10px;background-color:#003399' onmouseover=\"View('".$field."','003399')\" onclick=\"Set('".$field."','003399')\" ></td>
    <td style='width:10px;height:10px;background-color:#006699' onmouseover=\"View('".$field."','006699')\" onclick=\"Set('".$field."','006699')\" ></td>
    <td style='width:10px;height:10px;background-color:#009999' onmouseover=\"View('".$field."','009999')\" onclick=\"Set('".$field."','009999')\" ></td>
    <td style='width:10px;height:10px;background-color:#00CC99' onmouseover=\"View('".$field."','00CC99')\" onclick=\"Set('".$field."','00CC99')\" ></td>
    <td style='width:10px;height:10px;background-color:#00FF99' onmouseover=\"View('".$field."','00FF99')\" onclick=\"Set('".$field."','00FF99')\" ></td>
    <td style='width:10px;height:10px;background-color:#330099' onmouseover=\"View('".$field."','330099')\" onclick=\"Set('".$field."','330099')\" ></td>
    <td style='width:10px;height:10px;background-color:#333399' onmouseover=\"View('".$field."','333399')\" onclick=\"Set('".$field."','333399')\" ></td>
    <td style='width:10px;height:10px;background-color:#336699' onmouseover=\"View('".$field."','336699')\" onclick=\"Set('".$field."','336699')\" ></td>
    <td style='width:10px;height:10px;background-color:#339999' onmouseover=\"View('".$field."','339999')\" onclick=\"Set('".$field."','339999')\" ></td>
    <td style='width:10px;height:10px;background-color:#33CC99' onmouseover=\"View('".$field."','33CC99')\" onclick=\"Set('".$field."','33CC99')\" ></td>
    <td style='width:10px;height:10px;background-color:#33FF99' onmouseover=\"View('".$field."','33FF99')\" onclick=\"Set('".$field."','33FF99')\" ></td>
    <td style='width:10px;height:10px;background-color:#660099' onmouseover=\"View('".$field."','660099')\" onclick=\"Set('".$field."','660099')\" ></td>
    <td style='width:10px;height:10px;background-color:#663399' onmouseover=\"View('".$field."','663399')\" onclick=\"Set('".$field."','663399')\" ></td>
    <td style='width:10px;height:10px;background-color:#666699' onmouseover=\"View('".$field."','666699')\" onclick=\"Set('".$field."','666699')\" ></td>
    <td style='width:10px;height:10px;background-color:#669999' onmouseover=\"View('".$field."','669999')\" onclick=\"Set('".$field."','669999')\" ></td>
    <td style='width:10px;height:10px;background-color:#66CC99' onmouseover=\"View('".$field."','66CC99')\" onclick=\"Set('".$field."','66CC99')\" ></td>
    <td style='width:10px;height:10px;background-color:#66FF99' onmouseover=\"View('".$field."','66FF99')\" onclick=\"Set('".$field."','66FF99')\" ></td>
    </tr>
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCCCCC' onmouseover=\"View('".$field."','CCCCCC')\" onclick=\"Set('".$field."','CCCCCC')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#0000CC' onmouseover=\"View('".$field."','0000CC')\" onclick=\"Set('".$field."','0000CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#0033CC' onmouseover=\"View('".$field."','0033CC')\" onclick=\"Set('".$field."','0033CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#0066CC' onmouseover=\"View('".$field."','0066CC')\" onclick=\"Set('".$field."','0066CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#0099CC' onmouseover=\"View('".$field."','0099CC')\" onclick=\"Set('".$field."','0099CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#00CCCC' onmouseover=\"View('".$field."','00CCCC')\" onclick=\"Set('".$field."','00CCCC')\" ></td>
    <td style='width:10px;height:10px;background-color:#00FFCC' onmouseover=\"View('".$field."','00FFCC')\" onclick=\"Set('".$field."','00FFCC')\" ></td>
    <td style='width:10px;height:10px;background-color:#3300CC' onmouseover=\"View('".$field."','3300CC')\" onclick=\"Set('".$field."','3300CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#3333CC' onmouseover=\"View('".$field."','3333CC')\" onclick=\"Set('".$field."','3333CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#3366CC' onmouseover=\"View('".$field."','3366CC')\" onclick=\"Set('".$field."','3366CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#3399CC' onmouseover=\"View('".$field."','3399CC')\" onclick=\"Set('".$field."','3399CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#33CCCC' onmouseover=\"View('".$field."','33CCCC')\" onclick=\"Set('".$field."','33CCCC')\" ></td>
    <td style='width:10px;height:10px;background-color:#33FFCC' onmouseover=\"View('".$field."','33FFCC')\" onclick=\"Set('".$field."','33FFCC')\" ></td>
    <td style='width:10px;height:10px;background-color:#6600CC' onmouseover=\"View('".$field."','6600CC')\" onclick=\"Set('".$field."','6600CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#6633CC' onmouseover=\"View('".$field."','6633CC')\" onclick=\"Set('".$field."','6633CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#6666CC' onmouseover=\"View('".$field."','6666CC')\" onclick=\"Set('".$field."','6666CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#6699CC' onmouseover=\"View('".$field."','6699CC')\" onclick=\"Set('".$field."','6699CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#66CCCC' onmouseover=\"View('".$field."','66CCCC')\" onclick=\"Set('".$field."','66CCCC')\" ></td>
    <td style='width:10px;height:10px;background-color:#66FFCC' onmouseover=\"View('".$field."','66FFCC')\" onclick=\"Set('".$field."','66FFCC')\" ></td>
    </tr>
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFFFFF' onmouseover=\"View('".$field."','FFFFFF')\" onclick=\"Set('".$field."','FFFFFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#0000FF' onmouseover=\"View('".$field."','0000FF')\" onclick=\"Set('".$field."','0000FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#0033FF' onmouseover=\"View('".$field."','0033FF')\" onclick=\"Set('".$field."','0033FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#0066FF' onmouseover=\"View('".$field."','0066FF')\" onclick=\"Set('".$field."','0066FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#0099FF' onmouseover=\"View('".$field."','0099FF')\" onclick=\"Set('".$field."','0099FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#00CCFF' onmouseover=\"View('".$field."','00CCFF')\" onclick=\"Set('".$field."','00CCFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#00FFFF' onmouseover=\"View('".$field."','00FFFF')\" onclick=\"Set('".$field."','00FFFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#3300FF' onmouseover=\"View('".$field."','3300FF')\" onclick=\"Set('".$field."','3300FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#3333FF' onmouseover=\"View('".$field."','3333FF')\" onclick=\"Set('".$field."','3333FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#3366FF' onmouseover=\"View('".$field."','3366FF')\" onclick=\"Set('".$field."','3366FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#3399FF' onmouseover=\"View('".$field."','3399FF')\" onclick=\"Set('".$field."','3399FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#33CCFF' onmouseover=\"View('".$field."','33CCFF')\" onclick=\"Set('".$field."','33CCFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#33FFFF' onmouseover=\"View('".$field."','33FFFF')\" onclick=\"Set('".$field."','33FFFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#6600FF' onmouseover=\"View('".$field."','6600FF')\" onclick=\"Set('".$field."','6600FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#6633FF' onmouseover=\"View('".$field."','6633FF')\" onclick=\"Set('".$field."','6633FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#6666FF' onmouseover=\"View('".$field."','6666FF')\" onclick=\"Set('".$field."','6666FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#6699FF' onmouseover=\"View('".$field."','6699FF')\" onclick=\"Set('".$field."','6699FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#66CCFF' onmouseover=\"View('".$field."','66CCFF')\" onclick=\"Set('".$field."','66CCFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#66FFFF' onmouseover=\"View('".$field."','66FFFF')\" onclick=\"Set('".$field."','66FFFF')\" ></td>
    </tr>
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF0000' onmouseover=\"View('".$field."','FF0000')\" onclick=\"Set('".$field."','FF0000')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#990000' onmouseover=\"View('".$field."','990000')\" onclick=\"Set('".$field."','990000')\" ></td>
    <td style='width:10px;height:10px;background-color:#993300' onmouseover=\"View('".$field."','993300')\" onclick=\"Set('".$field."','993300')\" ></td>
    <td style='width:10px;height:10px;background-color:#996600' onmouseover=\"View('".$field."','996600')\" onclick=\"Set('".$field."','996600')\" ></td>
    <td style='width:10px;height:10px;background-color:#999900' onmouseover=\"View('".$field."','999900')\" onclick=\"Set('".$field."','999900')\" ></td>
    <td style='width:10px;height:10px;background-color:#99CC00' onmouseover=\"View('".$field."','99CC00')\" onclick=\"Set('".$field."','99CC00')\" ></td>
    <td style='width:10px;height:10px;background-color:#99FF00' onmouseover=\"View('".$field."','99FF00')\" onclick=\"Set('".$field."','99FF00')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC0000' onmouseover=\"View('".$field."','CC0000')\" onclick=\"Set('".$field."','CC0000')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC3300' onmouseover=\"View('".$field."','CC3300')\" onclick=\"Set('".$field."','CC3300')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC6600' onmouseover=\"View('".$field."','CC6600')\" onclick=\"Set('".$field."','CC6600')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC9900' onmouseover=\"View('".$field."','CC9900')\" onclick=\"Set('".$field."','CC9900')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCCC00' onmouseover=\"View('".$field."','CCCC00')\" onclick=\"Set('".$field."','CCCC00')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCFF00' onmouseover=\"View('".$field."','CCFF00')\" onclick=\"Set('".$field."','CCFF00')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF0000' onmouseover=\"View('".$field."','FF0000')\" onclick=\"Set('".$field."','FF0000')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF3300' onmouseover=\"View('".$field."','FF3300')\" onclick=\"Set('".$field."','FF3300')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF6600' onmouseover=\"View('".$field."','FF6600')\" onclick=\"Set('".$field."','FF6600')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF9900' onmouseover=\"View('".$field."','FF9900')\" onclick=\"Set('".$field."','FF9900')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFCC00' onmouseover=\"View('".$field."','FFCC00')\" onclick=\"Set('".$field."','FFCC00')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFFF00' onmouseover=\"View('".$field."','FFFF00')\" onclick=\"Set('".$field."','FFFF00')\" ></td>
    </tr>
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#00FF00' onmouseover=\"View('".$field."','00FF00')\" onclick=\"Set('".$field."','00FF00')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#990033' onmouseover=\"View('".$field."','990033')\" onclick=\"Set('".$field."','990033')\" ></td>
    <td style='width:10px;height:10px;background-color:#993333' onmouseover=\"View('".$field."','993333')\" onclick=\"Set('".$field."','993333')\" ></td>
    <td style='width:10px;height:10px;background-color:#996633' onmouseover=\"View('".$field."','996633')\" onclick=\"Set('".$field."','996633')\" ></td>
    <td style='width:10px;height:10px;background-color:#999933' onmouseover=\"View('".$field."','999933')\" onclick=\"Set('".$field."','999933')\" ></td>
    <td style='width:10px;height:10px;background-color:#99CC33' onmouseover=\"View('".$field."','99CC33')\" onclick=\"Set('".$field."','99CC33')\" ></td>
    <td style='width:10px;height:10px;background-color:#99FF33' onmouseover=\"View('".$field."','99FF33')\" onclick=\"Set('".$field."','99FF33')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC0033' onmouseover=\"View('".$field."','CC0033')\" onclick=\"Set('".$field."','CC0033')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC3333' onmouseover=\"View('".$field."','CC3333')\" onclick=\"Set('".$field."','CC3333')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC6633' onmouseover=\"View('".$field."','CC6633')\" onclick=\"Set('".$field."','CC6633')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC9933' onmouseover=\"View('".$field."','CC9933')\" onclick=\"Set('".$field."','CC9933')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCCC33' onmouseover=\"View('".$field."','CCCC33')\" onclick=\"Set('".$field."','CCCC33')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCFF33' onmouseover=\"View('".$field."','CCFF33')\" onclick=\"Set('".$field."','CCFF33')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF0033' onmouseover=\"View('".$field."','FF0033')\" onclick=\"Set('".$field."','FF0033')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF3333' onmouseover=\"View('".$field."','FF3333')\" onclick=\"Set('".$field."','FF3333')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF6633' onmouseover=\"View('".$field."','FF6633')\" onclick=\"Set('".$field."','FF6633')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF9933' onmouseover=\"View('".$field."','FF9933')\" onclick=\"Set('".$field."','FF9933')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFCC33' onmouseover=\"View('".$field."','FFCC33')\" onclick=\"Set('".$field."','FFCC33')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFFF33' onmouseover=\"View('".$field."','FFFF33')\" onclick=\"Set('".$field."','FFFF33')\" ></td>
    </tr>
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#0000FF' onmouseover=\"View('".$field."','0000FF')\" onclick=\"Set('".$field."','0000FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#990066' onmouseover=\"View('".$field."','990066')\" onclick=\"Set('".$field."','990066')\" ></td>
    <td style='width:10px;height:10px;background-color:#993366' onmouseover=\"View('".$field."','993366')\" onclick=\"Set('".$field."','993366')\" ></td>
    <td style='width:10px;height:10px;background-color:#996666' onmouseover=\"View('".$field."','996666')\" onclick=\"Set('".$field."','996666')\" ></td>
    <td style='width:10px;height:10px;background-color:#999966' onmouseover=\"View('".$field."','999966')\" onclick=\"Set('".$field."','999966')\" ></td>
    <td style='width:10px;height:10px;background-color:#99CC66' onmouseover=\"View('".$field."','99CC66')\" onclick=\"Set('".$field."','99CC66')\" ></td>
    <td style='width:10px;height:10px;background-color:#99FF66' onmouseover=\"View('".$field."','99FF66')\" onclick=\"Set('".$field."','99FF66')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC0066' onmouseover=\"View('".$field."','CC0066')\" onclick=\"Set('".$field."','CC0066')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC3366' onmouseover=\"View('".$field."','CC3366')\" onclick=\"Set('".$field."','CC3366')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC6666' onmouseover=\"View('".$field."','CC6666')\" onclick=\"Set('".$field."','CC6666')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC9966' onmouseover=\"View('".$field."','CC9966')\" onclick=\"Set('".$field."','CC9966')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCCC66' onmouseover=\"View('".$field."','CCCC66')\" onclick=\"Set('".$field."','CCCC66')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCFF66' onmouseover=\"View('".$field."','CCFF66')\" onclick=\"Set('".$field."','CCFF66')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF0066' onmouseover=\"View('".$field."','FF0066')\" onclick=\"Set('".$field."','FF0066')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF3366' onmouseover=\"View('".$field."','FF3366')\" onclick=\"Set('".$field."','FF3366')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF6666' onmouseover=\"View('".$field."','FF6666')\" onclick=\"Set('".$field."','FF6666')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF9966' onmouseover=\"View('".$field."','FF9966')\" onclick=\"Set('".$field."','FF9966')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFCC66' onmouseover=\"View('".$field."','FFCC66')\" onclick=\"Set('".$field."','FFCC66')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFFF66' onmouseover=\"View('".$field."','FFFF66')\" onclick=\"Set('".$field."','FFFF66')\" ></td>
    </tr>
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFFF00' onmouseover=\"View('".$field."','FFFF00')\" onclick=\"Set('".$field."','FFFF00')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#990099' onmouseover=\"View('".$field."','990099')\" onclick=\"Set('".$field."','990099')\" ></td>
    <td style='width:10px;height:10px;background-color:#993399' onmouseover=\"View('".$field."','993399')\" onclick=\"Set('".$field."','993399')\" ></td>
    <td style='width:10px;height:10px;background-color:#996699' onmouseover=\"View('".$field."','996699')\" onclick=\"Set('".$field."','996699')\" ></td>
    <td style='width:10px;height:10px;background-color:#999999' onmouseover=\"View('".$field."','999999')\" onclick=\"Set('".$field."','999999')\" ></td>
    <td style='width:10px;height:10px;background-color:#99CC99' onmouseover=\"View('".$field."','99CC99')\" onclick=\"Set('".$field."','99CC99')\" ></td>
    <td style='width:10px;height:10px;background-color:#99FF99' onmouseover=\"View('".$field."','99FF99')\" onclick=\"Set('".$field."','99FF99')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC0099' onmouseover=\"View('".$field."','CC0099')\" onclick=\"Set('".$field."','CC0099')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC3399' onmouseover=\"View('".$field."','CC3399')\" onclick=\"Set('".$field."','CC3399')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC6699' onmouseover=\"View('".$field."','CC6699')\" onclick=\"Set('".$field."','CC6699')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC9999' onmouseover=\"View('".$field."','CC9999')\" onclick=\"Set('".$field."','CC9999')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCCC99' onmouseover=\"View('".$field."','CCCC99')\" onclick=\"Set('".$field."','CCCC99')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCFF99' onmouseover=\"View('".$field."','CCFF99')\" onclick=\"Set('".$field."','CCFF99')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF0099' onmouseover=\"View('".$field."','FF0099')\" onclick=\"Set('".$field."','FF0099')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF3399' onmouseover=\"View('".$field."','FF3399')\" onclick=\"Set('".$field."','FF3399')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF6699' onmouseover=\"View('".$field."','FF6699')\" onclick=\"Set('".$field."','FF6699')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF9999' onmouseover=\"View('".$field."','FF9999')\" onclick=\"Set('".$field."','FF9999')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFCC99' onmouseover=\"View('".$field."','FFCC99')\" onclick=\"Set('".$field."','FFCC99')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFFF99' onmouseover=\"View('".$field."','FFFF99')\" onclick=\"Set('".$field."','FFFF99')\" ></td>
    </tr>
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#00FFFF' onmouseover=\"View('".$field."','00FFFF')\" onclick=\"Set('".$field."','00FFFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#9900CC' onmouseover=\"View('".$field."','9900CC')\" onclick=\"Set('".$field."','9900CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#9933CC' onmouseover=\"View('".$field."','9933CC')\" onclick=\"Set('".$field."','9933CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#9966CC' onmouseover=\"View('".$field."','9966CC')\" onclick=\"Set('".$field."','9966CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#9999CC' onmouseover=\"View('".$field."','9999CC')\" onclick=\"Set('".$field."','9999CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#99CCCC' onmouseover=\"View('".$field."','99CCCC')\" onclick=\"Set('".$field."','99CCCC')\" ></td>
    <td style='width:10px;height:10px;background-color:#99FFCC' onmouseover=\"View('".$field."','99FFCC')\" onclick=\"Set('".$field."','99FFCC')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC00CC' onmouseover=\"View('".$field."','CC00CC')\" onclick=\"Set('".$field."','CC00CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC33CC' onmouseover=\"View('".$field."','CC33CC')\" onclick=\"Set('".$field."','CC33CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC66CC' onmouseover=\"View('".$field."','CC66CC')\" onclick=\"Set('".$field."','CC66CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC99CC' onmouseover=\"View('".$field."','CC99CC')\" onclick=\"Set('".$field."','CC99CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCCCCC' onmouseover=\"View('".$field."','CCCCCC')\" onclick=\"Set('".$field."','CCCCCC')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCFFCC' onmouseover=\"View('".$field."','CCFFCC')\" onclick=\"Set('".$field."','CCFFCC')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF00CC' onmouseover=\"View('".$field."','FF00CC')\" onclick=\"Set('".$field."','FF00CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF33CC' onmouseover=\"View('".$field."','FF33CC')\" onclick=\"Set('".$field."','FF33CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF66CC' onmouseover=\"View('".$field."','FF66CC')\" onclick=\"Set('".$field."','FF66CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF99CC' onmouseover=\"View('".$field."','FF99CC')\" onclick=\"Set('".$field."','FF99CC')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFCCCC' onmouseover=\"View('".$field."','FFCCCC')\" onclick=\"Set('".$field."','FFCCCC')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFFFCC' onmouseover=\"View('".$field."','FFFFCC')\" onclick=\"Set('".$field."','FFFFCC')\" ></td>
    </tr>
    <tr>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF00FF' onmouseover=\"View('".$field."','FF00FF')\" onclick=\"Set('".$field."','FF00FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#000000' onmouseover=\"View('".$field."','000000')\" onclick=\"Set('".$field."','000000')\" ></td>
    <td style='width:10px;height:10px;background-color:#9900FF' onmouseover=\"View('".$field."','9900FF')\" onclick=\"Set('".$field."','9900FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#9933FF' onmouseover=\"View('".$field."','9933FF')\" onclick=\"Set('".$field."','9933FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#9966FF' onmouseover=\"View('".$field."','9966FF')\" onclick=\"Set('".$field."','9966FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#9999FF' onmouseover=\"View('".$field."','9999FF')\" onclick=\"Set('".$field."','9999FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#99CCFF' onmouseover=\"View('".$field."','99CCFF')\" onclick=\"Set('".$field."','99CCFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#99FFFF' onmouseover=\"View('".$field."','99FFFF')\" onclick=\"Set('".$field."','99FFFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC00FF' onmouseover=\"View('".$field."','CC00FF')\" onclick=\"Set('".$field."','CC00FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC33FF' onmouseover=\"View('".$field."','CC33FF')\" onclick=\"Set('".$field."','CC33FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC66FF' onmouseover=\"View('".$field."','CC66FF')\" onclick=\"Set('".$field."','CC66FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#CC99FF' onmouseover=\"View('".$field."','CC99FF')\" onclick=\"Set('".$field."','CC99FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCCCFF' onmouseover=\"View('".$field."','CCCCFF')\" onclick=\"Set('".$field."','CCCCFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#CCFFFF' onmouseover=\"View('".$field."','CCFFFF')\" onclick=\"Set('".$field."','CCFFFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF00FF' onmouseover=\"View('".$field."','FF00FF')\" onclick=\"Set('".$field."','FF00FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF33FF' onmouseover=\"View('".$field."','FF33FF')\" onclick=\"Set('".$field."','FF33FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF66FF' onmouseover=\"View('".$field."','FF66FF')\" onclick=\"Set('".$field."','FF66FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#FF99FF' onmouseover=\"View('".$field."','FF99FF')\" onclick=\"Set('".$field."','FF99FF')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFCCFF' onmouseover=\"View('".$field."','FFCCFF')\" onclick=\"Set('".$field."','FFCCFF')\" ></td>
    <td style='width:10px;height:10px;background-color:#FFFFFF' onmouseover=\"View('".$field."','FFFFFF')\" onclick=\"Set('".$field."','FFFFFF')\" ></td>
    </tr>
    </table>
    </div>
    \n";

   return $text;
}

   // Javascript stuff
   $js = "
<script type=\"text/javascript\">
   function addicontext(txt, id) {
      document.getElementById(id).value = txt;
   }
</script>\n";
   print $js;
?>
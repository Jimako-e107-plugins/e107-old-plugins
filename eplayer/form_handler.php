<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        Cameron's Plugin-Maker Form Handler.
|        For the e107 CMS system originally by
|        ©Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|        Updated by bugrain, (neil@bugrain.plus.com) May 2005
+---------------------------------------------------------------+
*/

class oldform {
   function form_open($form_method, $form_action, $form_name="", $form_target = "", $form_enctype="") {
      $method  = ($form_method   ? "method='".$form_method."'"  : "");
      $target  = ($form_target   ? " target='".$form_target."'" : "");
      $name    = ($form_name     ? " id='".$form_name."'"       : "");
      return "\n<form action='".$form_action."' ".$method.$target.$name.$form_enctype.">";
    }

   // Cameron's Form Function.
   function user_extended_element_edit($form_ext_name, $presetvalue, $fieldname) {
      global $pref,$key,$sql,$tp,$user_pref;
      $tabmonth[1]=EPLAYER_LAN_DATE_01;
      $tabmonth[2]=EPLAYER_LAN_DATE_02;
      $tabmonth[3]=EPLAYER_LAN_DATE_03;
      $tabmonth[4]=EPLAYER_LAN_DATE_04;
      $tabmonth[5]=EPLAYER_LAN_DATE_05;
      $tabmonth[6]=EPLAYER_LAN_DATE_06;
      $tabmonth[7]=EPLAYER_LAN_DATE_07;
      $tabmonth[8]=EPLAYER_LAN_DATE_08;
      $tabmonth[9]=EPLAYER_LAN_DATE_09;
      $tabmonth[10]=EPLAYER_LAN_DATE_10;
      $tabmonth[11]=EPLAYER_LAN_DATE_11;
      $tabmonth[12]=EPLAYER_LAN_DATE_12;

      $ut         = explode("|", $form_ext_name);
      $u_name     = ($ut[0] != "") ? $ut[0] : trim($form_ext_name);
      $u_type     = trim($ut[1]);
      $u_value    = stripslashes($ut[2]);
      $u_values   = explode(",", $u_value);
      switch ($u_type) {
         case "radio":
            for ($i=0; $i<count($u_values); $i++) {
               $checked = ($u_values[$i] == $presetvalue)? " checked='checked'" : "";
               $ret .="<label for='$fieldname$i'><input type='radio' name='$fieldname' id='$fieldname$i' value='$u_values[$i]' $checked  />$u_values[$i]</label><br />";
            };
            break;
         case "checkbox":
            for ($i=0; $i<count($u_values); $i++) {
               $checked = ($u_values[$i] == $presetvalue)? " checked='checked'" : "";
               $ret .="<input type='checkbox' name='".$fieldname."' value='".$u_values[$i]."' $checked /><br />";
            };
            break;
         case "dropdown":
            $ret ="<select class='tbox' style='width:200px' name='".$fieldname."'>";
            for ($i=0; $i<count($u_values); $i++) {
               $checked = ($u_values[$i] == $presetvalue)? " selected" : "";
               $ret .="<option value='$u_values[$i]' $checked >". $u_values[$i] ."</option />\n";
            };
            $ret .="</select>";
            break;
         case "dropdown2":
            $ret ="<select class='tbox' style='width:200px' name='".$fieldname."'>";
            for ($i=0; $i<count($u_values); $i++) {
               $split = explode(":",$u_values[$i]);
               $checked = ($split[0] == $presetvalue)? " selected" : "";
               $ret .="<option value='".$split[0]."' $checked >". $split[1] ."</option />\n";
            };
            $ret .="</select>";
            break;
         case "dropdown-readonly":
            $ret = $presetvalue."&nbsp;";
            break;
         case "text":
            $valuehere = ($presetvalue !="")? $presetvalue : $u_values[0];
            $size = ($u_values[1]) ? $u_values[1]:40;
            $ret .="<input class='tbox' type='text' name='".$fieldname."' size='$size' value='".$tp->toForm($valuehere) ."' maxlength='$u_values[2]' />";
            break;
         case "file":
            $valuehere = ($presetvalue !="")? $presetvalue : $u_values[0];
            $size = ($u_values[1]) ? $u_values[1]:40;
            $ret .="<input class='tbox' type='file' name='".$fieldname."' size='$size' maxlength='$u_values[2]' />";
            break;
         case "hidden":
            $ret .="<input type='hidden' name='".$fieldname."' value='".$u_values[0]."' />";
            break;
         case "color":
            $ret = Color_Select($fieldname,$presetvalue);
            break;
         case "textarea":
            $width = $u_values[1];
            $height = $u_values[2];
            $valuehere = $presetvalue;
            $ret .="<textarea id='".$fieldname."' class='tbox' name='".$fieldname."' cols='2' rows='2' style='width:$width;height:$height'>".$tp->toForm($valuehere)."</textarea>";
            break;
         case "table":
            $ret ="<select class='tbox' style='width:200px' name='".$fieldname."'><option></option>";
            $fieldid = $row[$u_values[1]];
            $fieldvalue = $row[$u_values[2]];
            $sql -> db_Select($u_values[0],"*","$u_values[1] !='' ORDER BY $u_values[2]");
            while($row = $sql-> db_Fetch()) {
               $fieldid = $row[$u_values[1]];
               $fieldvalue = $row[$u_values[2]];
               $checked = ($fieldid == $presetvalue)? " selected" : "";
               $ret .="<option value='".$fieldid."' $checked > $fieldvalue </option>";
            }
            $ret .="</select>";
            break;
         case "table-readonly":
            $sql -> db_Select($u_values[0],"*"," $u_values[1] = '$presetvalue'");
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
            $ret .= "<select style='width:150px' class='tbox' name='".$fieldname."' ><option></option>";
            for ($i=0; $i<count($lanlist); $i++) {
               $selected = ($lanlist[$i] == $presetvalue)? "selected = 'selected'" : "";
               $ret .="<option value=\"".$lanlist[$i]."\" $selected>".$lanlist[$i]."</option>";
            }
            $ret .= " </select>";
            break;
         case "image" :
            $folder = $u_value;
            $handle = opendir($folder);
            while ($file = readdir($handle)) {
               //if (is_file($folder.$file) && (eregxi(".jpg",$file) || eregxi(".gif",$file) || eregxi(".png",$file))) {
               if (is_file($folder.$file) && (preg_match("%.jpg%i",$file) || preg_match("%.gif%i",$file) || preg_match("%.png%i",$file))) {
                  $iconlist[] = $file;
               }
            }
            closedir($handle);
            $ret = "<input class='tbox' style='width:300px' type='text' id='$fieldname' name='$fieldname' value='$presetvalue' maxlength='100' />
            <input class='button' type ='button' style='cursor:pointer' value='".EPLAYER_LAN_36."' onclick='expandit(this)' />
            <div id='".$fieldname."_box' style='display:none'>";

            foreach ($iconlist as $key=>$icon) {
               $ret .= "<a href=\"javascript:addicontext('$folder$icon','$fieldname')\" ><img src='".$folder.$icon."' style='border:0px' alt='' /></a> ";
            }
            $ret .= "</div>";
            break;
         case "accesstable":
            $ret ="<select class='tbox' style='width:200px' name='".$fieldname."'><option></option>";
            $checked = ($presetvalue == 0)? " selected" : "";
            $ret .="<option value='0' $checked > Everyone </option>";
            $checked = ($presetvalue == 252)? " selected" : "";
            $ret .="<option value='252' $checked > Guest Only </option>";
            $checked = ($presetvalue == 253)? " selected" : "";
            $ret .="<option value='253' $checked > Members Only </option>";
            $checked = ($presetvalue == 254)? " selected" : "";
            $ret .="<option value='254' $checked > Administrators Only </option>";
            $checked = ($presetvalue == 255)? " selected" : "";
            $ret .="<option value='255' $checked > No One (inactive) </option>";
            $sql -> db_Select('userclass_classes',"userclass_id, userclass_name"," ORDER BY userclass_name", "no_where");
            while($row = $sql-> db_Fetch()) {
               extract($row);
               $checked = ($userclass_id == $presetvalue)? " selected " : "";
               $ret .="<option value='".$userclass_id."' $checked > $userclass_name </option>";
            }
            $ret .="</select>";
            break;
         case "date":
            $day0    = $presetvalue ? substr($presetvalue,6,2) : substr($u_values[1],6,2);
            $month0  = $presetvalue ? substr($presetvalue,4,2) : substr($u_values[1],4,2);
            $year0   = $presetvalue ? substr($presetvalue,0,4) : substr($u_values[1],0,4);

            $dayname    = $fieldname."_day";
            $monthname  = $fieldname."_month";
            $yearname   = $fieldname."_year";

            $ret= "<select name=\"". $dayname."\"  class='tbox'><option></option>";
            for($i=1;$i<=31;$i++) {
               if ($i<10) {
                  $j="0$i";
               } else {
                  $j=$i;
               }
               if ($j==$day0) {
                  $ret.= "<option value='$j' selected>$j</option>";
               } else {
                  $ret.= "<option value='$j' >$j</option>";
               }
            }
            $ret.= "</select>";
            $ret.= "<select name=\"".$monthname."\"  class='tbox'><option></option>";
            for($i=1;$i<=12;$i++) {
               if ($i<10) {
                  $j="0$i";
                } else {
                  $j=$i;
               }
               if ($j==$month0) {
                  $ret.= "<option value='$j' selected>".$tabmonth[$i]."</option>";
               } else {
                  $ret.= "<option value='$j' >".$tabmonth[$i]."</option>";
               }
            }
            $ret.= "</select>";
            $ret.= "<select name=\"".$yearname."\"  class='tbox'><option></option>";
            $gettoday=getdate();
            $todayyear=$gettoday['year'];
            for($i=1900;$i<=$todayyear;$i++) {
               if ($i==$year0) {
                  $ret.= "<option value='$i' selected>$i</option>";
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

            $ret = "<select name=\"". $dayname."\"  class='tbox'><option></option>";
            for($i=1;$i<=31;$i++) {
               if ($i<10) {
                  $j="0$i";
               } else {
                  $j=$i;
               }
               if ($j==$day0) {
                  $ret.= "<option value='$j' selected>$i</option>";
               } else {
                  $ret.= "<option value='$j' >$i</option>";
               }
            }
            $ret .= "</select>";

            $ret .= "<select name=\"".$monthname."\"  class='tbox'><option></option>";
            for($i=1;$i<=12;$i++) {
               if ($i<10) {
                  $j="0$i";
               } else {
                  $j=$i;
               }
                 if ($j==$month0) {
                  $ret.= "<option value='$j' selected>$tabmonth[$i]</option>";
               } else {
                  $ret.= "<option value='$j' >$tabmonth[$i]</option>";
               }
            }
            $ret .= "</select>";

            $ret .= "<select name=\"".$yearname."\"  class='tbox'><option></option>";
            $gettoday =getdate();
            $todayyear=$gettoday['year'];
            $yr_start = ($u_values[0]) ? $u_values[0] : 2000;
            $yr_end   = ($u_values[1]) ? $u_values[1] : $todayyear+1;

            for($i=$yr_start;$i<=$yr_end;$i++) {
               if ($i==$year0) {
                  $ret.= "<option value='$i' selected>$i</option>";
               } else {
                  $ret.= "<option value='$i' >$i</option>";
               }
            }
            $ret.= "</select>";
            break;
         default:
            $ret .="<input class='tbox' type='text' name='".$form_ext_name."' size='40' value='".$u_value."' maxlength='200' />";
            break;
      }
      return $ret;
   }

// OTHER FUNCTIONS. ===================

   // Get date from input fields
   function getfieldvalue($name, $type, $debug=false) {
      $tp = new textparse();
		if ($type == "date" || $type == "datestamp"){
		   $year  = $name."_year";
		   $month = $name."_month";
		   $day   = $name."_day";

			if ($type == "date") {
				$value .= $_POST[$year]."-".$_POST[$month]."-".$_POST[$day];
        	} else {
				$value .= mktime (0,0,0,$_POST[$month],$_POST[$day],$_POST[$year]);
        	}
        	$value = $value=="" ? 0 : $value;
      } else if ($type == "checkbox"){
			$value = addslashes($tp->editparse($_POST[$name]));
			if ($value=="") {
			   if ($name == "comment") {
      			$value = "0";
			   }
			   if ($name == "approved") {
      			$value = "1";
			   }
			}
		} else {
			$value = addslashes($tp->editparse($_POST[$name]));
		}
		if ($debug) print "$name ($type) = --$value--<br>";
      return $value;
   }

   // View Date Function.
   function viewdate($date0,$type='short') {  //format date0 2003-11-01
      $tabmonth[1] =EPLAYER_LAN_DATE_01;
      $tabmonth[2] =EPLAYER_LAN_DATE_02;
      $tabmonth[3] =EPLAYER_LAN_DATE_03;
      $tabmonth[4] =EPLAYER_LAN_DATE_04;
      $tabmonth[5] =EPLAYER_LAN_DATE_05;
      $tabmonth[6] =EPLAYER_LAN_DATE_06;
      $tabmonth[7] =EPLAYER_LAN_DATE_07;
      $tabmonth[8] =EPLAYER_LAN_DATE_08;
      $tabmonth[9] =EPLAYER_LAN_DATE_09;
      $tabmonth[10]=EPLAYER_LAN_DATE_10;
      $tabmonth[11]=EPLAYER_LAN_DATE_11;
      $tabmonth[12]=EPLAYER_LAN_DATE_12;
      if ($type =='short') {
         $tabmonth[1]   =substr(EPLAYER_LAN_DATE_01, 0, 3);
         $tabmonth[2]   =substr(EPLAYER_LAN_DATE_02, 0, 3);
         $tabmonth[3]   =substr(EPLAYER_LAN_DATE_03, 0, 3);
         $tabmonth[4]   =substr(EPLAYER_LAN_DATE_04, 0, 3);
         $tabmonth[5]   =substr(EPLAYER_LAN_DATE_05, 0, 3);
         $tabmonth[6]   =substr(EPLAYER_LAN_DATE_06, 0, 3);
         $tabmonth[7]   =substr(EPLAYER_LAN_DATE_07, 0, 3);
         $tabmonth[8]   =substr(EPLAYER_LAN_DATE_08, 0, 3);
         $tabmonth[9]   =substr(EPLAYER_LAN_DATE_09, 0, 3);
         $tabmonth[10]  =substr(EPLAYER_LAN_DATE_10, 0, 3);
         $tabmonth[11]  =substr(EPLAYER_LAN_DATE_11, 0, 3);
         $tabmonth[12]  =substr(EPLAYER_LAN_DATE_12, 0, 3);
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

   // Javascript stuff
   $js = "
<script type=\"text/javascript\">
   function addicontext(txt, id) {
      document.getElementById(id).value = txt;
   }
</script>\n";
   print $js;
?>
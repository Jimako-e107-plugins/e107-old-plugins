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
| $Source: E:/cvs/cvsrepo/yellowpages/form_handler.php,v $
| $Revision: 1.1 $
| $Date: 2005/08/21 14:55:42 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
class yellowpages_form {
   function form_open($form_method, $form_action, $form_name="", $form_target = "", $form_enctype="") {
      $method  = ($form_method   ? "method='".$form_method."'"  : "");
      $target  = ($form_target   ? " target='".$form_target."'" : "");
      $name    = ($form_name     ? " id='".$form_name."'"       : "");
      return "\n<form action='".$form_action."' ".$method.$target.$name.$form_enctype.">";
    }

   // Cameron's Form Function.
   function user_extended_element_edit($form_ext_name, $presetvalue, $fieldname, $js="") {
      global $pref, $key, $sql, $user_pref, $yell_tp, $yell_e107v7;
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

      $ut         = explode("|", $form_ext_name);
      $u_name     = ($ut[0] != "") ? $ut[0] : trim($form_ext_name);
      $u_type     = trim($ut[1]);
      $u_value    = stripslashes($ut[2]);
      $u_values   = explode(",", $u_value);
      if ($yell_e107v7) {
         $presetvalue = $yell_tp->toForm($presetvalue);
      } else {
         $presetvalue = $yell_tp->formtparev($presetvalue);
      }
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
            $ret ="<select class='tbox' style='width:200px' name='".$fieldname."[]' id='$fieldname' size='10' multiple $js>";
            $presets = explode(",", $presetvalue);
            for ($i=0; $i<count($u_values); $i++) {
               $checked = "";
               for ($j=0; $j<count($presets); $j++) {
                  if ($u_values[$i] == $presets[$j]) {
                     $checked = "selected";
                     break;
                  }
               }
               $ret .= "<option value='$u_values[$i]' $checked>". $u_values[$i] ."</option />\n";
            }
            $ret .= "</select>";
            break;
         case "multilist2":
            $ret ="<select class='tbox' style='width:200px' name='".$fieldname."[]' id='$fieldname' size='10' multiple $js>";
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
               $ret .= "<option value='$tmp[0]' $checked>". $tmp[1] ."</option />\n";
            }
            $ret .= "</select>";
            break;
         case "dropdown":
            $ret ="<select class='tbox' name='$fieldname' id='$fieldname' $js>";
            for ($i=0; $i<count($u_values); $i++) {
               $checked = ($u_values[$i] == $presetvalue) ? "selected" : "";
               $ret .= "<option value='$u_values[$i]' $checked>". $u_values[$i] ."</option />\n";
            }
            $ret .= "</select>";
            break;
         case "dropdown2":
            $ret ="<select class='tbox' name='$fieldname' id='$fieldname' $js>";
            for ($i=0; $i<count($u_values); $i++) {
               $split = explode(":",$u_values[$i]);
               $checked = ($split[0] == $presetvalue)? "selected" : "";
               $ret .= "<option value='".$split[0]."' $checked>". $split[1] ."</option />\n";
            }
            $ret .= "</select>";
            break;
         case "dropdown-readonly":
            $ret = $presetvalue."&nbsp;";
            break;
         case "text":
            $valuehere = ($presetvalue !="")? $presetvalue : $u_values[0];
            $size = ($u_values[1]) ? $u_values[1]:40;
            $ret .= "<input class='tbox' type='text' name='".$fieldname."' size='$size' value='".htmlentities($valuehere) ."' maxlength='$u_values[2]' />";
            break;
         case "textarea":
            $width = $u_values[1];
            $height = $u_values[2];
            $valuehere = $presetvalue;
            $ret .= "<textarea id='".$fieldname."' class='tbox' name='".$fieldname."' cols='2' rows='2' style='width:$width;height:$height'>".htmlentities($valuehere) ."</textarea>";
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
               $ret .= "<option value='".$fieldid."' $checked > $fieldvalue </option>";
            }
            $ret .= "</select>";
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
               $ret .= "<option value=\"".$lanlist[$i]."\" $selected>".$lanlist[$i]."</option>";
            }
            $ret .= " </select>";
            break;
         case "image" :
            $folder = $u_value;
            $handle = opendir($folder);
            while ($file = readdir($handle)) {
               if (is_file($folder.$file) && (eregi(".jpg",$file) || eregi(".gif",$file) || eregi(".png",$file))) {
                  $iconlist[] = $file;
               }
            }
            closedir($handle);
            $ret = "<input class='tbox' style='width:300px' type='text' id='$fieldname' name='$fieldname' value='$presetvalue' maxlength='100' />
            <input class='button' type ='button' style='cursor:pointer' value='Choose' onclick='expandit(this)' />
            <div id='".$fieldname."_box' style='display:none'>";

            foreach ($iconlist as $key=>$icon) {
               $ret .= "<a href=\"javascript:yell_addicontext('$folder$icon','$fieldname')\" ><img src='".$folder.$icon."' style='border:0px' alt='' /></a> ";
            }
            $ret .= "</div>";
            break;
         case "accesstable":
            $ret ="<select class='tbox' style='width:200px' name='".$fieldname."'>";
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
            $sql -> db_Select('userclass_classes',"userclass_id, userclass_name"," ORDER BY userclass_name", "no_where");
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
            $today_arryear=$gettoday['year'];
            for($i=1900;$i<=$today_arryear;$i++) {
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
            $today_arryear=$gettoday['year'];
            $yr_start = ($u_values[0]) ? $u_values[0] : 2000;
            $yr_end   = ($u_values[1]) ? $u_values[1] : $today_arryear+1;

            for($i=$yr_start;$i<=$yr_end;$i++) {
               if ($i==$year0) {
                  $ret.= "<option value='$i' selected>$i</option>";
               } else {
                  $ret.= "<option value='$i' >$i</option>";
               }
            }
            $ret.= "</select>";
            break;
         case "button" :
            $ret .= "<input type='button' class='button' name='$u_name' value='$u_value' $js />";
            break;
         default:
            $ret .= "<input class='tbox' type='text' name='$u_name' size='40' value='$u_value' maxlength='200' />";
            break;
      }
      return $ret;
   }

// OTHER FUNCTIONS. ===================

   // Get date from input fields
   function getfieldvalue($name, $type, $debug=false) {
      global $yell_tp, $yell_e107v7;
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
         case "multilist" :
         case "multilist2" :
            $value = implode(",", $_POST[$name]);
            break;
		   default:
            if ($yell_e107v7) {
		      	$value = $yell_tp->toDB($_POST[$name]);
		      } else {
		      	$value = $yell_tp->formtpa($_POST[$name]);
		      }
		}
		if ($debug) print "$name ($type) = $value<br>";
      return $value;
   }

   // Validate a field value
   function validatefieldvalue($name, $type, $value, $mandatory=false, $debug=false) {
      global $yell_tp, $yell_e107v7;
      $ret = true;
      switch ($type) {
         default :
            $ret = true;
      }
      return $ret;
   }

   // View Date Function.
   function viewdate($date0,$type='short') {  //format date0 2003-11-01
      if ($type =='long') {
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
      elseif ($type =='short') {
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
         $tabmonth[12]="Dec";
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

print "
<script type=\"text/javascript\">
   function yell_addicontext(txt, id) {
      document.getElementById(id).value = txt;
   }
</script>\n";

?>
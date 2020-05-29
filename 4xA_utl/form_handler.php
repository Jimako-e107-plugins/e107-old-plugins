<?php
/*
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
$lan_file = e_PLUGIN."4xA_utl/languages/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."4xA_utl/languages/German.php");

require_once(e_HANDLER."ren_help.php");

class form{
    function form_open($form_method, $form_action, $form_name="", $form_target = "", $form_enctype=""){
                $method = ($form_method ? "method='".$form_method."'" : "");
                $target = ($form_target ? " target='".$form_target."'" : "");
                $name = ($form_name ? " id='".$form_name."'" : "");
                return "\n<form action='".$form_action."' ".$method.$target.$name.$form_enctype.">";
        }
      // Cameron's Form Function.
	function user_extended_element_edit($form_ext_name,$presetvalue, $fieldname){

                        global $pref,$key,$sql,$user_pref,$tp,$cal;$_POST;
                        $ut = explode("|",$form_ext_name);
                        $u_name = ($ut[0] != "") ? $ut[0] : trim($form_ext_name);
                        $u_type = trim($ut[1]);
                        $u_value = stripslashes($ut[2]);
                        $tmp = explode(",",$u_value);

                        switch ($u_type) {
// --------------------------------- Chechbox --------------------------------
	case "checkbox":

                            for ($i=0; $i<count($tmp); $i++) {
                            $checked = ($tmp[$i] == $presetvalue)? " checked='checked'" : "";
                            $ret .="<input  type='checkbox' name='".$fieldname."'  value='".$tmp[$i]."' $checked /><br />";
                            };
                          break;
                          
// --------------------------------- Table checkbox_multi --------------------------------
	case "checkbox_multi":
							$ret ="";
                            $sql -> db_Select($tmp[0],"*","$tmp[1] !='' ORDER BY $tmp[2]");
                                while($row = $sql-> db_Fetch()){
                                $fieldid = $row[$tmp[1]];
                                $fieldvalue = $row[$tmp[2]];
                            $checked = ($fieldid == $presetvalue)? " selected='selected'" : "";
                            $ret .="<input type='checkbox' name='".$fieldvalue."' value='".$fieldid."'> ".$fieldvalue."<br/>";
                            }
                            $ret .="";
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
                            $ret .="<input class='tbox' type='text' name='".$fieldname."' size='$size' value='".$tp->toForm($valuehere) ."' maxlength='200' />";

                            break;
// --------------------------------- Textarea --------------------------------
//	case "textarea":
//                            $width = $tmp[1];
//                            $height = $tmp[2];
//                            $valuehere = $presetvalue;
//                            $ret .="<textarea id='".$fieldname."' class='tbox' name='".$fieldname."' cols='2' rows='2' style='width:$width;height:$height'>".htmlentities($valuehere) ."</textarea>";
//
//                            break;
// --------------------------------- Textarea 2--------------------------------
case "textarea":
							$width = $tmp[1];
                        	$height = $tmp[2];
                            $valuehere = $presetvalue;
														$insertjs = (!e_WYSIWYG) ? "rows='15' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'": "rows='25' ";
														$_POST['data'] = $tp->toForm($_POST['data']);
														$ret .= "<textarea class='tbox' id='".$fieldname."' name='".$fieldname."'  cols='80'  style='width:$width;height:$height' $insertjs>".(strstr($tp->post_toForm($valuehere), "[img]http") ? $valuehere : str_replace("[img]../", "[img]", $tp->post_toForm($valuehere)))."</textarea>
																	";
       											 $ret .= display_help("helpb", 'news');
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
        <input class='button' type ='button' style='cursor:pointer' size='30' value='".MLS_FORM_LAN_0."' onclick='expandit(this)' />
        <div id='".$fieldname."_box' style='display:none'>";
        foreach($iconlist as $key=>$icon){
        $ret .= "<a href=\"javascript:insertext('$icon','$fieldname','".$fieldname."_box')\" ><img src='".$folder.$icon."' style='border:0px' alt='' width='100px' height='100px'/></a> ";
        }
        $ret .= "</div>";
        break;
// --------------------------------- Access table --------------------------------
	case "accesstable":
                            $ret ="<select class='tbox' style='width:200px'  name='".$fieldname."'><option></option>";

                            $checked = ($presetvalue == 0)? " selected='selected'" : "";
                            $ret .="<option value='0' $checked >".MLS_FORM_LAN_1."</option>";
                            $checked = ($presetvalue == 252)? " selected='selected'" : "";
                            $ret .="<option value='252' $checked >".MLS_FORM_LAN_2."</option>";
                            $checked = ($presetvalue == 253)? " selected='selected'" : "";
                            $ret .="<option value='253' $checked >".MLS_FORM_LAN_3."</option>";
                            $checked = ($presetvalue == 254)? " selected='selected'" : "";
                            $ret .="<option value='254' $checked >".MLS_FORM_LAN_4."</option>";
                            $checked = ($presetvalue == 255)? " selected='selected'" : "";
                            $ret .="<option value='255' $checked >".MLS_FORM_LAN_5."</option>";
                            $sql -> db_Select('userclass_classes',"userclass_id, userclass_name"," ORDER BY userclass_name", "no_where");
                                while($row = $sql-> db_Fetch()){
                                extract($row);
                            $checked = ($userclass_id == $presetvalue)? " selected='selected' " : "";
                            $ret .="<option value='".$userclass_id."' $checked > $userclass_name </option>";
                            }
                            $ret .="</select>";

                          break;
// --------------------------------- Default--------------------------------
	default:
                        $ret .="<input class='tbox' type='text' name='".$form_ext_name."' size='40' value='".$u_value."' maxlength='200' />";
                        break;
                        }
                        return $ret;
	}
// OTHER FUNCTIONS. ===================
}
//////+++++++++++++++++++++++++++
?>

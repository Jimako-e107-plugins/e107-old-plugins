<?php
/*
+---------------------------------------------------------------+
|        YouTube Gallery v4.01 - by Erich Radstake
|        http://www.erichradstake.nl
|        info@erichradstake.nl
|
|        This is a module for the e107 .7+ website system
|        Copyright Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

$lan_file = e_PLUGIN."ytm_gallery/languages/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."ytm_gallery/languages/English.php");
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
                            $ret ="<select class='tbox' style='width:200px'  name='".$fieldname."'>";
                            for ($i=0; $i<count($tmp); $i++) {
                            $checked = ($tmp[$i] == $presetvalue)? " selected='selected'" : "";
                            $ret .="<option value='$tmp[$i]' $checked >". $tmp[$i] ."</option />\n";
                            };
                            $ret .="</select>";
                          break;


// --------------------------------- Textbox --------------------------------
	case "text":
                            $valuehere = ($presetvalue !="")? $presetvalue : $tmp[0];
                            $size = ($tmp[1]) ? $tmp[1]:40;
                            $ret .="<input class='tbox' type='text' name='".$fieldname."' size='$size' value='".htmlentities($valuehere) ."' maxlength='200' />";

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
?>

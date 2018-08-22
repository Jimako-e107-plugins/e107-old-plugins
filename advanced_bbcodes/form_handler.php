<?php
/*
+---------------------------------------------------------------+
|        Plugin: Advanced Bbcodes
|        Version: 0.4
|        Date: 12/01/2009
|        Auteur: The_Death_Raw 
|        Email: postmaster@e107plugins.fr
|        Website: www.e107plugins.fr
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

if (!defined('e107_INIT')){ exit; }

@include(e_PLUGIN."advanced_bbcodes/languages/".e_LANGUAGE.".php");
@include(e_PLUGIN."advanced_bbcodes/languages/French.php");

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
                            $ret .="<input title='".ADVANCED_BBCODES_CHECKBOX."' type='radio' name='".$fieldname."'  value='".$tmp[$i]."' $checked  /> $tmp[$i] &nbsp;&nbsp;";


                            };

                          break;
// --------------------------------- Default--------------------------------


	default:
                        $ret .="<input class='tbox' type='text' name='".$form_ext_name."' size='40' value='".$u_value."' maxlength='200' />";
                        break;
                        }

                        return $ret;


}

}

?>
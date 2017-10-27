<?php
/*
+------------------------------------------------------------------------------+
| Locator - a plugin by nlstart
|
|	Plugin Support Site: e107.webstartinternet.com
|
|	For the e107 website system visit http://e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+------------------------------------------------------------------------------+
*/
// Ensure this program is loaded in admin theme before calling class2
$eplug_admin = true;

// class2.php is the heart of e107, always include it first to give access to e107 constants and variables
require_once("../../class2.php");

// Include auth.php rather than header.php ensures an admin user is logged in
require_once(e_ADMIN."auth.php");

// Include userclass_class.php which is necessary for function r_userclass (dropdown of classes)
require_once(e_HANDLER."form_handler.php");
require_once(e_HANDLER."userclass_class.php");
require_once(e_HANDLER."file_class.php");

// Check to see if the current user has admin permissions for this plugin
if (!getperms("P")) {
	// No permissions set, redirect to site front page
	header("location:".e_BASE."index.php");
	exit;
}

// Get language file (assume that the English language file is always present)
$lan_file = e_PLUGIN."locator/languages/".e_LANGUAGE.".php";
include_lan($lan_file);

// Set the active menu option for admin_menu.php
$pageid = 'admin_menu_01';

// If the submit button is hit; update the settings in table core, record SitePrefs
// Initial default values of the preferences are set by plugin.php at $eplug_prefs
if (isset($_POST['update_prefs'])) {
	$pref['locator_name'] = $_POST['locator_name'];
	$pref['locator_image_path'] = $_POST['locator_image_path'];
	$pref['locator_default_sort'] = $_POST['locator_default_sort'];
	$pref['locator_printheader'] = $_POST['locator_printheader'];
	$pref['locator_maptype'] = $_POST['locator_maptype'];
	$pref['locator_zoomfactor'] = $_POST['locator_zoomfactor'];
	$pref['locator_test_integer'] = $_POST['locator_test_integer'];
  $pref['locator_map_api'] = $_POST['locator_map_api'];  // Google Maps API key
  $pref['locator_map_control'] = $_POST['locator_map_control']; // Google Map control on top left
  $pref['locator_map_control_type'] = $_POST['locator_map_control_type'];  // 0 = small , 1 = large
  $pref['locator_map_type_controls'] = $_POST['locator_map_type_controls']; // Google Map choices on top right
  $pref['locator_map_type_default'] = $_POST['locator_map_type_default'];  // 1 = normal map, 2 = satellite map, 3 = hybrid map
  $pref['locator_map_scale_control'] = $_POST['locator_map_scale_control'];
  $pref['locator_map_overview_control'] = $_POST['locator_map_overview_control'];
  $pref['locator_map_zoom'] = $_POST['locator_map_zoom'];
  $pref['locator_map_height'] = $_POST['locator_map_height'];
  $pref['locator_map_width'] = $_POST['locator_map_width'];
  $pref['locator_map_sidebar'] = $_POST['locator_map_sidebar'];
  $pref['locator_map_info_window'] = $_POST['locator_map_info_window'];
  $pref['locator_map_info_window_extra_text'] = $_POST['locator_map_info_window_extra_text'];
  $pref['locator_map_directions'] = $_POST['locator_map_directions'];
  $pref['locator_show_group_category'] = $_POST['locator_show_group_category'];
  $pref['locator_show_group_country'] = $_POST['locator_show_group_country'];
  $pref['locator_show_group_city'] = $_POST['locator_show_group_city'];
  $pref['locator_city_summary_length'] = $_POST['locator_city_summary_length'];
  $pref['locator_show_group_zip'] = $_POST['locator_show_group_zip'];
  $pref['locator_zip_code_summary_length'] = $_POST['locator_zip_code_summary_length'];
  $pref['locator_divide_char'] = $_POST['locator_divide_char'];
  $pref['locator_show_group_only'] = $_POST['locator_show_group_only'];
  $pref['locator_show_tooltip'] = $_POST['locator_show_tooltip'];
  $pref['locator_input_coordinates'] = $_POST['locator_input_coordinates'];
  $pref['locator_paginate'] = $_POST['locator_paginate'];
  $pref['locator_paginate_display'] = $_POST['locator_paginate_display'];
  $pref['locator_suppress_latitude'] = $_POST['locator_suppress_latitude'];
  $pref['locator_suppress_online'] = $_POST['locator_suppress_online'];
  $pref['locator_show_opening_hrs'] = $_POST['locator_show_opening_hrs'];
  $pref['locator_submit_class'] = $_POST['locator_submit_class'];
	save_prefs();
	$message = LOCATOR_CONF_12;
}

// Count the number of active locations
$locations_count = $sql2->db_Count(DB_TABLE_LOCATOR2_TABLE, "(*)", "WHERE locator_active_status = '2'");

// Displays the update message to confirm data is stored in database
if (isset($message)) {
	$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}

// The following form output will be put into variable $text.
// The form will call admin_config_edit for further actions.
// All language dependent text are referring to the language file.
// E.g. .LOCATOR_CONF_01. will retrieve the accompanying text.
// Remember NOT to put comments in the text as they will be published.
// In the form data is retrieved from table core, record SitePrefs using $pref
$text .= '
<div style="text-align:center">
<form name="settings_form" action="'.e_SELF.'" method="post">
	<fieldset>
		<legend>
			'.LOCATOR_CONF_01.'
		</legend>
		<table border="0" class="tborder" cellspacing="10">
			<tr>
				<td class="tborder" style="width: 200px">
					<span class="smalltext" style="font-weight: bold">
						'.LOCATOR_CONF_02.'
					</span>
				</td>
				<td class="tborder" style="width: 200px">
					<input class="tbox" size="25" type="text" name="locator_name" value="'.$pref['locator_name'].'" />
				</td>
			</tr>
			<!-- Currently not used
			<tr>
        <td class="tborder" style="width: 200px">
          <span class="smalltext" style="font-weight: bold">
    						'.LOCATOR_CONF_03.'
	   			</span>
  			</td>
        <td class="tborder" style="width: 200px" valign="top">
					<input class="tbox" size="35" type="text" name="locator_image_path" value="'.$pref['locator_image_path'].'" />
				</td>
			</tr>
			<tr>
				<td colspan=2 class="tborder" style="width: 200px" valign="top">
					<img src="'.e_IMAGE.'admin_images/docs_16.png" title="" alt="" /> '.LOCATOR_CONF_04.'
				</td>
			</tr>
			-->
			<tr>
      <td class="tborder" style="width: 200px">
          <span class="smalltext" style="font-weight: bold">
						'.LOCATOR_CONF_05.'
			   	</span>
				</td>
      <td class="tborder" style="width: 200px">
					<select class="tbox" name="locator_default_sort">
					<option value="locator_order" ';
					if ($pref['locator_default_sort'] == 'locator_order' or $pref['locator_default_sort'] == '') {
            $text .= 'selected="selected"';
          }
          $text .=
          '>'.LOCATOR_CONF_06.'</option>
					<option value="locator_id" ';
					if ($pref['locator_default_sort'] == 'locator_id') {
            $text .= 'selected="selected"';
          }
          $text .=
          '>'.LOCATOR_CONF_07.'</option>
					<option value="locator_zipcode" ';
					if ($pref['locator_default_sort'] == 'locator_zipcode') {
            $text .= 'selected="selected"';
          }
          $text .=
          '>'.LOCATOR_CONF_08.'</option>
					<option value="locator_client" ';
					if ($pref['locator_default_sort'] == 'locator_client') {
            $text .= 'selected="selected"';
          }
          $text .=
          '>'.LOCATOR_CONF_09.'</option>
					<option value="locator_catid" ';
					if ($pref['locator_default_sort'] == 'locator_catid') {
            $text .= 'selected="selected"';
          }
          $text .=
          '>'.LOCATOR_CONF_10.'</option>
					<option value="locator_city" ';
					if ($pref['locator_default_sort'] == 'locator_city') {
            $text .= 'selected="selected"';
          }
          $text .=
          '>'.LOCATOR_CONF_53.'</option>
					</select>
				</td>
			</tr>
			<tr>
    <td class="tborder" style="width: 200px">
     <span class="smalltext" style="font-weight: bold">
						'.LOCATOR_CONF_13.'
					</span>
				</td>
    <td class="tborder" style="width: 200px">
					<!-- <input class="tbox" size="25" type="text" name="locator_printheader" value="'.$pref['locator_printheader'].'" /> -->
					<select class="tbox" name="locator_printheader">
					<option value="1" ';
					if ($pref['locator_printheader'] == '1' or $pref['locator_printheader'] == '') {
            $text .= 'selected="selected"';
          }
          $text .=
          '>'.LOCATOR_CONF_14.'</option>
					<option value="2" ';
					if ($pref['locator_printheader'] == '2') {
            $text .= 'selected="selected"';
          }
          $text .=
          '>'.LOCATOR_CONF_15.'</option>
				</td>
			</tr>
			<tr>';

     if ($locations_count > 50) {
      $text .= '
        <tr>
          <td colspan="2" class="tborder">
                <img src="'.e_IMAGE.'admin_images/docs_16.png" title="" alt="" /> '.LOCATOR_CONF_52.'
    			</td>
        </tr>
      ';
     }

     $text .= '
        <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
                '.LOCATOR_CONF_50.'
      					</span>
    			</td>
          <td class="tborder" style="width: 200px">
  					<select class="tbox" name="locator_paginate">
  					<option value="1" ';
  					if ($pref['locator_paginate'] == '1') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_24.'</option>
  					<option value="0" ';
  					if ($pref['locator_paginate'] == '0' or $pref['locator_paginate'] == '') { // Default is Off
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_25.'</option>
         </td>
  			</tr>
        ';
        
     $text .= '
        <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
                '.LOCATOR_CONF_51.'
      					</span>
    			</td>
          <td class="tborder" style="width: 200px">
  					<select class="tbox" name="locator_paginate_display">
  					<option value="5" ';
  					if ($pref['locator_paginate_display'] == '5') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>5</option>
  					<option value="10" ';
  					if ($pref['locator_paginate_display'] == '10' or $pref['locator_paginate_display'] == '') { // Default page length is 10
              $text .= 'selected="selected"';
            }
            $text .=
            '>10</option>
  					<option value="15" ';
  					if ($pref['locator_paginate_display'] == '15') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>15</option>
  					<option value="20" ';
  					if ($pref['locator_paginate_display'] == '20') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>20</option>
  					<option value="25" ';
  					if ($pref['locator_paginate_display'] == '25') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>25</option>
  					<option value="50" ';
  					if ($pref['locator_paginate_display'] == '50') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>50</option>
  					<option value="75" ';
  					if ($pref['locator_paginate_display'] == '75') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>75</option>
  					<option value="100" ';
  					if ($pref['locator_paginate_display'] == '100') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>100</option>
         </td>
  			</tr>
        ';

    $text .= '
    <tr>
      <td class="tborder" style="width: 200px">
       <span class="smalltext" style="font-weight: bold">
            '.LOCATOR_CONF_56.'
  					</span>
			</td>
      <td class="tborder" style="width: 200px">
				<select class="tbox" name="locator_suppress_online">
				<option value="1" ';
				if ($pref['locator_suppress_online'] == '1') {
          $text .= 'selected="selected"';
        }
        $text .=
        '>'.LOCATOR_CONF_24.'</option>
				<option value="0" ';
				if ($pref['locator_suppress_online'] == '0' or $pref['locator_suppress_online'] == '') { // Default is Off
          $text .= 'selected="selected"';
        }
        $text .=
        '>'.LOCATOR_CONF_25.'</option>
     </td>
		</tr>
    ';

		$text .= '
    <td class="tborder" style="width: 200px">
     <span class="smalltext" style="font-weight: bold">
						'.LOCATOR_CONF_16.'
					</span>
				</td>
    <td class="tborder" style="width: 200px">
					<!-- <input class="tbox" size="25" type="text" name="locator_maptype" value="'.$pref['locator_maptype'].'" /> -->
					<select class="tbox" name="locator_maptype">
					<option value="1" ';
					if ($pref['locator_maptype'] == '1' or $pref['locator_maptype'] == '') {
            $text .= 'selected="selected"';
          }
          $text .=
          '>'.LOCATOR_CONF_17.'</option>
					<option value="2" ';
					if ($pref['locator_maptype'] == '2') {
            $text .= 'selected="selected"';
          }
          $text .=
          '>'.LOCATOR_CONF_18.'</option>
				</td>
			</tr>';

      // Display specific Mapquest settings
      if ($pref['locator_maptype'] == '2') {
      $text .= '
		  <tr>
        <td class="tborder" style="width: 200px">
         <span class="smalltext" style="font-weight: bold">
    						'.LOCATOR_CONF_19.'
    					</span>
    				</td>
        <td class="tborder" style="width: 200px">
    					<input class="tbox" size="25" type="text" name="locator_zoomfactor" value="'.$pref['locator_zoomfactor'].'" />
				</td>
			</tr>';
			}

      // Display Google map settings
      if ($pref['locator_maptype'] == '1') {
      $text .= '
		  <tr>
        <td class="tborder" style="width: 200px">
         <span class="smalltext" style="font-weight: bold">
              '.LOCATOR_CONF_20.'<br/><a href="http://maps.google.com/apis/maps/signup.html">'.LOCATOR_CONF_21.'</a>
    		 </span>
    		</td>
        <td class="tborder" style="width: 200px; vertical-align: top">
    					<input class="tbox" size="50" type="text" name="locator_map_api" value="'.$pref['locator_map_api'].'" />
				</td>
			</tr>
      <tr>
        <td colspan="2">
             '.LOCATOR_CONF_22.'
        </td>
      </tr>
      ';

      // Display specific embedded Google map settings only when API is filled in
      if ($pref['locator_map_api'] <> '') {
        $text .= '
        <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
                '.LOCATOR_CONF_23.'
      					</span>
    			</td>
          <td class="tborder" style="width: 200px">
  					<select class="tbox" name="locator_map_control">
  					<option value="1" ';
  					if ($pref['locator_map_control'] == '1' or $pref['locator_map_control'] == '') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_24.'</option>
  					<option value="0" ';
  					if ($pref['locator_map_control'] == '0') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_25.'</option>
          </td>
  			</tr>
  			';
        // Change size of map control if map control is activated
  			if ($pref['locator_map_control'] == '1') {
        $text .= '
          <tr>
            <td class="tborder" style="width: 200px">
             <span class="smalltext" style="font-weight: bold">
                  '.LOCATOR_CONF_26.'
        					</span>
      			</td>
            <td class="tborder" style="width: 200px">
    					<select class="tbox" name="locator_map_control_type">
    					<option value="1" ';
    					if ($pref['locator_map_control_type'] == '1' or $pref['locator_map_control_type'] == '') {
                $text .= 'selected="selected"';
              }
              $text .=
              '>'.LOCATOR_CONF_27.'</option>
    					<option value="0" ';
    					if ($pref['locator_map_control_type'] == '0') {
                $text .= 'selected="selected"';
              }
              $text .=
              '>'.LOCATOR_CONF_28.'</option>
            </td>
    			</tr>
          ';
  			}

        $text .= '
        <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
                '.LOCATOR_CONF_29.'
      					</span>
    			</td>
          <td class="tborder" style="width: 200px">
  					<select class="tbox" name="locator_map_type_controls">
  					<option value="1" ';
  					if ($pref['locator_map_type_controls'] == '1' or $pref['locator_map_type_controls'] == '') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_24.'</option>
  					<option value="0" ';
  					if ($pref['locator_map_type_controls'] == '0') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_25.'</option>
         </td>
  			</tr>
        ';
  			
        $text .= '
        <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
                '.LOCATOR_CONF_30.'
      					</span>
    			</td>
          <td class="tborder" style="width: 200px">
  					<select class="tbox" name="locator_map_type_default">
  					<option value="1" ';
  					if ($pref['locator_map_type_default'] == '1' or $pref['locator_map_type_default'] == '') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_31.'</option>
  					<option value="2" ';
  					if ($pref['locator_map_type_default'] == '2') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_32.'</option>
  					<option value="3" ';
  					if ($pref['locator_map_type_default'] == '3') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_33.'</option>
          </td>
  			</tr>

        ';

        $text .= '
        <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
                '.LOCATOR_CONF_34.'
      					</span>
    			</td>
          <td class="tborder" style="width: 200px">
  					<select class="tbox" name="locator_map_scale_control">
  					<option value="1" ';
  					if ($pref['locator_map_scale_control'] == '1' or $pref['locator_map_scale_control'] == '') { // Default is On
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_24.'</option>
  					<option value="0" ';
  					if ($pref['locator_map_scale_control'] == '0') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_25.'</option>
         </td>
  			</tr>
        ';

        $text .= '
  		  <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
              '.LOCATOR_CONF_35.'
      					</span>
      				</td>
          <td class="tborder" style="width: 200px">
      					<input class="tbox" size="5" type="text" name="locator_map_width" value="'.$pref['locator_map_width'].'" />
  				</td>
  			</tr>';
        $text .= '
  		  <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
              '.LOCATOR_CONF_36.'
      					</span>
      				</td>
          <td class="tborder" style="width: 200px">
      					<input class="tbox" size="5" type="text" name="locator_map_height" value="'.$pref['locator_map_height'].'" />
  				</td>
  			</tr>';
        $text .= '
        <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
                '.LOCATOR_CONF_37.'
      					</span>
    			</td>
          <td class="tborder" style="width: 200px">
  					<select class="tbox" name="locator_map_sidebar">
  					<option value="1" ';
  					if ($pref['locator_map_sidebar'] == '1' or $pref['locator_map_sidebar'] == '') { // Default is On
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_24.'</option>
  					<option value="0" ';
  					if ($pref['locator_map_sidebar'] == '0') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_25.'</option>
         </td>
  			</tr>
        ';

        $text .= '
        <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
                '.LOCATOR_CONF_38.'
      					</span>
    			</td>
          <td class="tborder" style="width: 200px">
  					<select class="tbox" name="locator_map_info_window">
  					<option value="1" ';
  					if ($pref['locator_map_info_window'] == '1' or $pref['locator_map_info_window'] == '') { // Default is On
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_24.'</option>
  					<option value="0" ';
  					if ($pref['locator_map_info_window'] == '0') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_25.'</option>
         </td>
  			</tr>
        ';

        $text .= '
        <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
                '.LOCATOR_CONF_46.'
      					</span>
    			</td>
          <td class="tborder" style="width: 200px">
  					<select class="tbox" name="locator_map_info_window_extra_text">
  					<option value="1" ';
  					if ($pref['locator_map_info_window_extra_text'] == '1') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_24.'</option>
  					<option value="0" ';
  					if ($pref['locator_map_info_window_extra_text'] == '0' or $pref['locator_map_info_window_extra_text'] == '') { // Default is Off
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_25.'</option>
         </td>
  			</tr>
        ';
        
        $text .= '
        <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
                '.LOCATOR_CONF_39.'
      					</span>
    			</td>
          <td class="tborder" style="width: 200px">
  					<select class="tbox" name="locator_map_directions">
  					<option value="1" ';
  					if ($pref['locator_map_directions'] == '1' or $pref['locator_map_directions'] == '') {  // Default is On
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_24.'</option>
  					<option value="0" ';
  					if ($pref['locator_map_directions'] == '0') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_25.'</option>
         </td>
  			</tr>
        ';

        $text .= '
        <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
                '.LOCATOR_CONF_41.'
      					</span>
    			</td>
          <td class="tborder" style="width: 200px">
  					<select class="tbox" name="locator_show_group_category">
  					<option value="1" ';
  					if ($pref['locator_show_group_category'] == '1') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_24.'</option>
  					<option value="0" ';
  					if ($pref['locator_show_group_category'] == '0' or $pref['locator_show_group_category'] == '') { // Default is Off
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_25.'</option>
         </td>
  			</tr>
        ';

        $text .= '
        <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
                '.LOCATOR_CONF_42.'
      					</span>
    			</td>
          <td class="tborder" style="width: 200px">
  					<select class="tbox" name="locator_show_group_country">
  					<option value="1" ';
  					if ($pref['locator_show_group_country'] == '1') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_24.'</option>
  					<option value="0" ';
  					if ($pref['locator_show_group_country'] == '0' or $pref['locator_show_group_country'] == '') { // Default is Off
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_25.'</option>
         </td>
  			</tr>
        ';

        $text .= '
        <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
                '.LOCATOR_CONF_43.'
      					</span>
    			</td>
          <td class="tborder" style="width: 200px">
  					<select class="tbox" name="locator_show_group_city">
  					<option value="1" ';
  					if ($pref['locator_show_group_city'] == '1') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_24.'</option>
  					<option value="0" ';
  					if ($pref['locator_show_group_city'] == '0' or $pref['locator_show_group_city'] == '') { // Default is Off
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_25.'</option>
         </td>
  			</tr>
        ';
        
        $text .= '
  		  <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
              '.LOCATOR_CONF_54.'
      					</span>
      				</td>
          <td class="tborder" style="width: 200px">
      					<input class="tbox" size="2" type="text" name="locator_city_summary_length" value="'.$pref['locator_city_summary_length'].'" />
  				</td>
  			</tr>';
        

        $text .= '
        <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
                '.LOCATOR_CONF_44.'
      					</span>
    			</td>
          <td class="tborder" style="width: 200px">
  					<select class="tbox" name="locator_show_group_zip">
  					<option value="1" ';
  					if ($pref['locator_show_group_zip'] == '1') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_24.'</option>
  					<option value="0" ';
  					if ($pref['locator_show_group_zip'] == '0' or $pref['locator_show_group_zip'] == '') { // Default is Off
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_25.'</option>
         </td>
  			</tr>
        ';

        $text .= '
  		  <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
              '.LOCATOR_CONF_45.'
      					</span>
      				</td>
          <td class="tborder" style="width: 200px">
      					<input class="tbox" size="2" type="text" name="locator_zip_code_summary_length" value="'.$pref['locator_zip_code_summary_length'].'" />
  				</td>
  			</tr>';

        $text .= '
  		  <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
              '.LOCATOR_CONF_40.'
      					</span>
      				</td>
          <td class="tborder" style="width: 200px">
      					<input class="tbox" size="2" type="text" name="locator_divide_char" value="'.$pref['locator_divide_char'].'" />
  				</td>
  			</tr>';

       if ($locations_count > 50) {
        $text .= '
          <tr>
            <td colspan="2" class="tborder">
                  <img src="'.e_IMAGE.'admin_images/docs_16.png" title="" alt="" /> '.LOCATOR_CONF_52.'
      			</td>
          </tr>
        ';
       }

        $text .= '
        <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
                '.LOCATOR_CONF_47.'
      					</span>
    			</td>
          <td class="tborder" style="width: 200px">
  					<select class="tbox" name="locator_show_group_only">
  					<option value="1" ';
  					if ($pref['locator_show_group_only'] == '1') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_24.'</option>
  					<option value="0" ';
  					if ($pref['locator_show_group_only'] == '0' or $pref['locator_show_group_only'] == '') { // Default is Off
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_25.'</option>
         </td>
  			</tr>
        ';

        $text .= '
        <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
                '.LOCATOR_CONF_48.'
      					</span>
    			</td>
          <td class="tborder" style="width: 200px">
  					<select class="tbox" name="locator_show_tooltip">
  					<option value="1" ';
  					if ($pref['locator_show_tooltip'] == '1') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_24.'</option>
  					<option value="0" ';
  					if ($pref['locator_show_tooltip'] == '0' or $pref['locator_show_tooltip'] == '') { // Default is Off
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_25.'</option>
         </td>
  			</tr>
        ';

        $text .= '
        <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
                '.LOCATOR_CONF_49.'
      					</span>
    			</td>
          <td class="tborder" style="width: 200px">
  					<select class="tbox" name="locator_input_coordinates">
  					<option value="1" ';
  					if ($pref['locator_input_coordinates'] == '1') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_24.'</option>
  					<option value="0" ';
  					if ($pref['locator_input_coordinates'] == '0' or $pref['locator_input_coordinates'] == '') { // Default is Off
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_25.'</option>
         </td>
  			</tr>
        ';

        $text .= '
        <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
                '.LOCATOR_CONF_55.'
      					</span>
    			</td>
          <td class="tborder" style="width: 200px">
  					<select class="tbox" name="locator_suppress_latitude">
  					<option value="1" ';
  					if ($pref['locator_suppress_latitude'] == '1') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_24.'</option>
  					<option value="0" ';
  					if ($pref['locator_suppress_latitude'] == '0' or $pref['locator_suppress_latitude'] == '') { // Default is Off
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_25.'</option>
         </td>
  			</tr>
        ';

        $text .= '
        <tr>
          <td class="tborder" style="width: 200px">
           <span class="smalltext" style="font-weight: bold">
                '.LOCATOR_CONF_57.'
      					</span>
    			</td>
          <td class="tborder" style="width: 200px">
    				<select class="tbox" name="locator_show_opening_hrs">
    				<option value="1" ';
    				if ($pref['locator_show_opening_hrs'] == '1') {
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_24.'</option>
    				<option value="0" ';
    				if ($pref['locator_show_opening_hrs'] == '0' or $pref['locator_show_opening_hrs'] == '') { // Default is Off
              $text .= 'selected="selected"';
            }
            $text .=
            '>'.LOCATOR_CONF_25.'</option>
         </td>
    		</tr>
        ';

        } // End of IF to check API key
      } // End of IF to check maptype = 1 (Google)
      
    if ($pref['locator_submit_class'] == '') { // Default is 'Nobody (inactive)'
      $pref['locator_submit_class'] = '255';
    }
    // Location submission user class determination, default: No one (inactive)
    $text .= '
      			<tr>
              <td class="tborder" style="width: 200px">
      						<span class="smalltext" style="font-weight: bold">'.LOCATOR_CONF_58.'</span>
      				</td>
              <td class="tborder" style="width: 200px">
      					'.r_userclass("locator_submit_class", $pref['locator_submit_class'], "off", "public,guest,member,nobody,main,admin,classes").'
      				</td>
       			</tr>
       			';
      
    $text .= '
		</table>
	</fieldset>
	<br />
	<input class="button" type="submit" name="update_prefs" value="'.LOCATOR_CONF_11.'">
	<br />
</form>
</div>
';

// Display the $text string into a rendered table with a caption from the language file
$caption = LOCATOR_CONF_00;
$ns->tablerender($caption, $text);

require_once(e_ADMIN."footer.php");
?>
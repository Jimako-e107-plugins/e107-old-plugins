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
// class2.php is the heart of e107, always include it first to give access to e107 constants and variables
require_once("../../class2.php");
// Make use of the Google Map API class
require('GoogleMapAPI.2.5.class.php');

// Get language file (assume that the English language file is always present)
$lan_file = e_PLUGIN."locator/languages/".e_LANGUAGE.".php";
include_lan($lan_file);

// use HEADERF for USER PAGES and e_ADMIN."auth.php" for admin pages
require_once(HEADERF);

require_once("includes/config.php");

// Check URL query
if(e_QUERY){
	$tmp = explode(".", e_QUERY); // Divide the URL query in separate arrays e.g. locator.php?cat.2.3
	$action = $tmp[0];    // e.g. $action = 'cat'
	$action_id = $tmp[1]; // e.g. $action_id = '2'
	$page_id = $tmp[2];   // e.g. $page_id = '3'
	unset($tmp); // unset the arrays, so next time URL query will be determined as new
}

// Set the page id correctly if action is just to show the page
if ($action == 'p') {
  $page_id = $action_id;
}

// Display Google map when Google Maps api is filled in
if ($pref['locator_map_api'] <> "") {
  // 0 = don't show; 1 = show Google map
  $show_google_map = 1;
}

// Set the devide character once
$divide_char = $pref['locator_divide_char'];
if (strlen(trim($divide_char)) == 0) { // No divide character specified in preferences
  $divide_char = '-';
}

// The heart of Locator application goes below this line
$sql = new db;

// Determine if there is nothing to show
$sql2 = new db;
// Look for active locations, with active categories and for the right user class
$arg= "SELECT COUNT(*)
      FROM #locator_sites
      LEFT JOIN #locator_cat
      ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
      WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))";
$sql2->db_Select_gen($arg,false);
if ($row2 = $sql2-> db_Fetch()){
  $locations_count = $row2['COUNT(*)'];
}

// Setting for zip code summary length
$zip_code_summary_length = $pref['locator_zip_code_summary_length'];
if (strlen(trim($zip_code_summary_length)) == 0) {  // No length specified in preferences
  $zip_code_summary_length = 1;
}
// Setting for city summary length
$city_summary_length = $pref['locator_city_summary_length'];

// Set default zoomfactor for MapQuest
if ($pref['locator_zoomfactor'] < 0 or $pref['locator_zoomfactor'] == "" or $pref['locator_zoomfactor'] > 15) {
  $zoomfactor = 9;
} else {
  $zoomfactor = $pref['locator_zoomfactor'];
}

// Set the default to submit to 'No one (inactive)' if the preference is not specified.
if ($pref['locator_submit_class'] == "" OR $pref['locator_submit_class'] == NULL) {
  $pref['locator_submit_class'] = '255';
}

// Gather the desired results in the variable $text
$text .="
	<table>
  ";
    // Show a message if there are no locations to display
		if (!isset($locations_count) or $locations_count == null or $locations_count < 1) {
			$text .= "
			<br />
			<center>
				<span class='smalltext'>
					".LOCATOR_CORE_02."
				</span>
			</center>
			<br /><br />";
		} else {
        // When user is allowed to submit locations; show the link
        if(check_class($pref['locator_submit_class'])) {
          $text .= "<div style='text-align: right;'><a href='".e_PLUGIN."locator/locator_submit.php'>".LOCATOR_CORE_28."</a></div>";
        }
		
		    // Only if preference locator_printheader equals 1: print the count of locations
        if ($pref["locator_printheader"] == "1") {
  				$text .= LOCATOR_CORE_11."&nbsp;".$locations_count."<br /><hr/>";
        }

        // Only if preference to show Google Map display it
        if ($show_google_map == 1) {
          // Start a new map
          $map = new GoogleMapAPI('map');
          // Set Google Map Key
          // $map_api = $pref['locator_map_api'];
          // $map->setAPIKey($map_api);
          // All the settings are done in GoogleMapAPI class

    			// While there are ACTIVE records available; fill the rows to display them all in the userdefined order
          // $text .= "action: ".$action." action id: ".$action_id." page id: ".$page_id."<br/>";   // Some debug info
          if ($action == 'cat') { // locator.php?cat.n is set in URL
      			//$sql -> db_Select(DB_TABLE_LOCATOR2_TABLE, "*", "locator_active_status = '2' AND locator_catid = '".$action_id."' ORDER BY ".$pref['locator_default_sort']);
             $arg= "SELECT *
                    FROM #locator_sites
                    LEFT JOIN #locator_cat
                    ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
                    WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
                          AND locator_catid = '".intval($action_id)."'
                    ORDER BY ABS(".$pref['locator_default_sort'].")";
             $sql->db_Select_gen($arg,false);
          } else if ($action == 'cnt') { // locator.php?cnt.n is set in URL
      			//$sql -> db_Select(DB_TABLE_LOCATOR2_TABLE, "*", "locator_active_status = '2' AND locator_country = '".$action_id."' ORDER BY ".$pref['locator_default_sort']);
             $arg= "SELECT *
                    FROM #locator_sites
                    LEFT JOIN #locator_cat
                    ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
                    WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
                          AND locator_country = '".intval($action_id)."'
                    ORDER BY ABS(".$pref['locator_default_sort'].")";
             $sql->db_Select_gen($arg,false);
          } else if ($action == 'cty') { // locator.php?cty.n is set in URL
            // If we get city - this means category no city filled in
            if ($action_id == "-") {$action_id = "";}
            if ($city_summary_length > 0) { // Limit the city names on specified length
               $action_id = str_replace("%27", "&#039;", $action_id); // %27; is the url encoding of ' character (stored as &#039; in MySQL)
               $action_id = utf8_encode(urldecode($action_id)); //  Transform unicode characters back e.g. G%F6teborg into Göteborg
               if ($action_id == "&#039;") {
                   $temp_city_summary_length = 6;
               } else {
                 $temp_city_summary_length = $city_summary_length;
               }
      			   //$sql -> db_Select(DB_TABLE_LOCATOR2_TABLE, "*", "locator_active_status = '2' AND LEFT(locator_city,".$temp_city_summary_length.") = '".$action_id."' ORDER BY ".$pref['locator_default_sort']);
               $arg= "SELECT *
                      FROM #locator_sites
                      LEFT JOIN #locator_cat
                      ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
                      WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
                            AND LEFT(locator_city,".$temp_city_summary_length.") = '".$tp->toDB($action_id)."'
                      ORDER BY ABS(".$pref['locator_default_sort'].")";
               $sql->db_Select_gen($arg,false);
            }
            else { // Show full city names
              // Look out for cities with spaces in their name
              $action_id = str_replace("%20", " ", $action_id); // %20 is the url encoding of space character
              $action_id = str_replace("%27", "&#039;", $action_id); // %27; is the url encoding of ' character (stored as &#039; in MySQL)
              $action_id = utf8_encode(urldecode($action_id)); //  Transform unicode characters back e.g. G%F6teborg into Göteborg
      			  //$sql -> db_Select(DB_TABLE_LOCATOR2_TABLE, "*", "locator_active_status = '2' AND locator_city = '".$action_id."' ORDER BY ".$pref['locator_default_sort']);
               $arg= "SELECT *
                      FROM #locator_sites
                      LEFT JOIN #locator_cat
                      ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
                      WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
                            AND locator_city = '".$tp->toDB($action_id)."'
                      ORDER BY ABS(".$pref['locator_default_sort'].")";
               $sql->db_Select_gen($arg,false);
            }
          } else if ($action == 'zip') { // locator.php?zip.n is set in URL
            // If we get zip - this means category no zipcode filled in
            if ($action_id == "-") {$action_id = "";}
      			// $sql -> db_Select(DB_TABLE_LOCATOR2_TABLE, "*", "locator_active_status = '2' AND LEFT(locator_zipcode,".$zip_code_summary_length.") = '".$action_id."' ORDER BY ".$pref['locator_default_sort']);
               $arg= "SELECT *
                      FROM #locator_sites
                      LEFT JOIN #locator_cat
                      ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
                      WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
                            AND LEFT(locator_zipcode,".$zip_code_summary_length.") = '".$tp->toDB($action_id)."'
                      ORDER BY ABS(".$pref['locator_default_sort'].")";
               $sql->db_Select_gen($arg,false);
          } else { // no category is set in URL
      			//$sql -> db_Select(DB_TABLE_LOCATOR2_TABLE, "*", "locator_active_status = '2' ORDER BY ".$pref['locator_default_sort']);
               $arg= "SELECT *
                      FROM #locator_sites
                      LEFT JOIN #locator_cat
                      ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
                      WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
                      ORDER BY ABS(".$pref['locator_default_sort'].")";
               $sql->db_Select_gen($arg,false);

          }
          while($row = $sql-> db_Fetch()){
		          $sql4 = new db;
             	$sql4 -> db_Select(DB_TABLE_LOCATOR_COUNTRY, "locator_country_descr", "locator_country_id=".$row['locator_country']."");
             	while($row4 = $sql4->db_Fetch()) {
                // Process $row
                $display_country = $row4['locator_country_descr'];
              } // End of the while to lookup the country description
              $href_string = "";
              if ((strlen(trim($row['locator_latitude'])) > 0) AND (strlen(trim($row['locator_longtitude'])) > 0)) {
                // Work with coordinates
                  $href_string .= trim($row['locator_latitude']).",".trim($row['locator_longtitude']); // Latitude, longitude
              } else {
                if ($row['locator_address1'] <> "") {$href_string .= trim($row['locator_address1'])."+";}
                if ($row['locator_zipcode'] <> "") {$href_string .= trim($row['locator_zipcode'])."+";}
                if ($row['locator_city'] <> "") {$href_string .= trim($row['locator_city'])."+";}
                if ($row['locator_county'] <> "") {$href_string .= trim($row['locator_county'])."+";}
                if ($row['locator_state'] <> "") {$href_string .= trim($row['locator_state'])."+";}
                if ($row['locator_country'] <> "") {$href_string .= trim($display_country)."+";}
                // Delete last + character from href_string
                if ($href_string <> "") {
                  $href_string = substr($href_string, 0, -1); // remove last string character
                }
              } // End of else with address
              // Label variables for Google Map
              $address = $href_string;
              // $title is used in the sidebar
              $title = (trim($row['locator_city']) <> "")? $row['locator_city'] : $tp->toHTML($row['locator_client'], true);
              $html .= "<p class='gmapDirItem'>";
              $html .= "<b>".$tp->toHTML($row['locator_client'], true)."</b><br />"; // $html is used in info box
              if ($row['locator_address1'] <> "") {$html .= $row['locator_address1']."<br />";}
              if ($row['locator_zipcode'] <> "") { // Show zip code and city if zip-code is filled in
                $html .= $row['locator_zipcode']." ".$row['locator_city']."<br />";
              } else { // Zip code is empty; just show the city
                $html .= $row['locator_city']."<br />";
              }
              if ($row['locator_telephone1'] <> "") {$html .= $row['locator_telephone1']."<br />";}
              // Display order online
              if ($pref['locator_suppress_online'] <> '1') {
               	if ($row['locator_status'] == 1) {
                  if ($row['locator_url1'] <> "") { // Show URL if locator status is Yes AND locator URL 1 is filled in
    				        $html .= "<a href='".$row['locator_url1']."' alt='".LOCATOR_CORE_13."' title='".LOCATOR_CORE_13."'>".LOCATOR_CORE_09."</a><br />";
                  }
                }
              }
              if ($pref['locator_suppress_latitude'] != 1) { // Setting to suppress latitude is different than Yes (value 1)
                if ((strlen(trim($row['locator_latitude'])) > 0) AND (strlen(trim($row['locator_longtitude'])) > 0)) { // Show Coordinates
                   $html .= LOCATOR_CORE_15.": ".trim($row['locator_latitude'])."<br />";
                   $html .= LOCATOR_CORE_16.": ".trim($row['locator_longtitude'])."<br />";
                }
              }

              if ($pref['locator_show_opening_hrs'] == '1') {
              // Start display opening hours
                $html .= "<table border='0' cellspacing='5' width='100%'>";
                // Show the header opening hours if one of the days is actually filled in
                if($row['locator_open_mo']<>"" || $row['locator_open_tu']<>"" || $row['locator_open_we']<>"" || $row['locator_open_th']<>"" || $row['locator_open_fr']<>"" || $row['locator_open_sa']<>"" || $row['locator_open_su']<>""){
                  $html .= "<tr><td colspan='2' style='text-align:center;'>".LOCATOR_CORE_19."</tr>";
                }
                if($row['locator_open_mo']<>""){
                  $html .= "<tr><td>".LOCATOR_CORE_20.":</td><td>".$tp->toHTML($row['locator_open_mo'], true)."</td></tr>";
                }
                if($row['locator_open_tu']<>""){
                  $html .= "<tr><td>".LOCATOR_CORE_21.":</td><td>".$tp->toHTML($row['locator_open_tu'], true)."</td></tr>";
                }
                if($row['locator_open_we']<>""){
                  $html .= "<tr><td>".LOCATOR_CORE_22.":</td><td>".$tp->toHTML($row['locator_open_we'], true)."</td></tr>";
                }
                if($row['locator_open_th']<>""){
                  $html .= "<tr><td>".LOCATOR_CORE_23.":</td><td>".$tp->toHTML($row['locator_open_th'], true)."</td></tr>";
                }
                if($row['locator_open_fr']<>""){
                  $html .= "<tr><td>".LOCATOR_CORE_24.":</td><td>".$tp->toHTML($row['locator_open_fr'], true)."</td></tr>";
                }
                if($row['locator_open_sa']<>""){
                  $html .= "<tr><td>".LOCATOR_CORE_25.":</td><td>".$tp->toHTML($row['locator_open_sa'], true)."</td></tr>";
                }
                if($row['locator_open_su']<>""){
                  $html .= "<tr><td>".LOCATOR_CORE_26.":</td><td>".$tp->toHTML($row['locator_open_su'], true)."</td></tr>";
                }
                if($row['locator_open_remarks']<>""){
                  $html .= "<tr><td>".LOCATOR_CORE_27.":</td><td>".$tp->toHTML($row['locator_open_remarks'], true)."</td></tr>";
                }
                $html .= "</table>";
              // End display opening hours
              }

              if ($pref['locator_map_info_window_extra_text'] == 1) { // Setting extra info window line is Yes
                if ($row['locator_description1'] <> "") { // Show additional text if setting is Yes AND description1 is filled in
  				        $html .= "<br />".$tp->toHTML($row['locator_description1'], true); // Fix when users are putting HTML in the additional text
                }
              }
              $html .= "</p>";
              if ($pref['locator_show_tooltip'] == 1) {
                $tooltip = $tp->toHTML($row['locator_client'], true);
              } else {
                $tooltip = "";
              }
              if ((strlen(trim($row['locator_latitude'])) > 0) AND (strlen(trim($row['locator_longtitude'])) > 0)) {
                // Work with coordinates
                $lon = trim($row['locator_longtitude']);
                $lat = trim($row['locator_latitude']);
                $map->addMarkerByCoords($lon, $lat, $title, $html, $tooltip);
              } else {
                // Add map points for each location
                $map->addMarkerByAddress($address, $title, $html, $tooltip);
              }
              // Clear variables
              $address = "";
              $title = "";
              $html = "";
          } // End of the while loop through active locations

              $text .= "<!-- Dump the Google Map -->";
              $map->printHeaderJS();
              $map->printMapJS(); ?>
              <!-- Necessary for google maps polyline drawing in IE -->
              <style type="text/css">
                v\:* {
                  behavior:url(#default#VML);
                }
              </style>

              <SCRIPT LANGUAGE="JavaScript" TYPE="TEXT/JAVASCRIPT">
             	<!--
             	window.onload=onLoad;
             	//-->
             	</SCRIPT>
             	<?php
             	$text .= "<tr><td colspan='5'>";
              $text .= $map->printMap();
              $text .= "</td><td colspan='3'>";
              $text .= $map->printSidebar();
              $text .= "</td></tr>
              <!-- End of Google Map Dump -->";

        } // End of the conditional display of Google Map

      $text .= "<tr><td colspan='6'>"; // Table manipulation before first group
      if ($pref['locator_show_group_category'] == 1) {
        // Loop through categories to display category list with links
        $sql5 = new db;
        $text_temp = "";
  			// $sql5 -> db_Select(DB_TABLE_LOCATOR_TABLE, "*", "locator_catactive_status = '2' ORDER BY locator_catorder");
  			// Only display category records in use
  			$arg5="SELECT DISTINCT locator_cat_id, locator_catname
               FROM #locator_sites
               LEFT JOIN #locator_cat
               ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
               WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
               ORDER BY locator_catorder";
        $sql5->db_Select_gen($arg5,false);
  			while($row5 = $sql5-> db_Fetch()){
          $text_temp .= " <a href='locator.php?cat.".$row5[locator_cat_id]."'>".$row5[locator_catname]."</a> ".$divide_char;
        } // End of loop through categories
        $text .= substr($text_temp, 0, -1); // remove last string character
        $text .= "<br />"; // break after showing categories
      }

      if ($pref['locator_show_group_country'] == 1) {
        // Loop through countries to display country list with links
        $sql6 = new db;
        $text_temp = "";
  			// Only display country records in use
  			$arg6="SELECT DISTINCT locator_country_descr, locator_country_id
               FROM #locator_sites
               LEFT JOIN #locator_cat
               ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
               LEFT JOIN #locator_country
               ON #locator_sites.locator_country = #locator_country.locator_country_id
               WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
               ORDER BY locator_country_code";
        $sql6->db_Select_gen($arg6,false);
  			while($row6 = $sql6-> db_Fetch()){
          $text_temp .= " <a href='locator.php?cnt.".$row6[locator_country_id]."'>".$row6[locator_country_descr]."</a> ".$divide_char;
        } // End of loop through categories
        $text .= substr($text_temp, 0, -1); // remove last string character
        $text .= "<br />"; // break after showing countries
      }

      if ($pref['locator_show_group_city'] == 1) {
        // Loop through cities to display city list with links
        $sql7 = new db;
        $text_temp = "";
  			// Only display city records in use
  			if ($city_summary_length > 0) {
  			$arg7="SELECT DISTINCT LEFT(locator_city, ".$city_summary_length.") AS shortcity
               FROM #locator_sites
               LEFT JOIN #locator_cat
               ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
               WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
               ORDER BY locator_city";
  			} else {
  			$arg7="SELECT DISTINCT locator_city
               FROM #locator_sites
               LEFT JOIN #locator_cat
               ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
               WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
               ORDER BY locator_city";
        }
        $sql7->db_Select_gen($arg7,false);
  			while($row7 = $sql7-> db_Fetch()){
          if ($city_summary_length > 0) {
            if ($row7[shortcity] == "") {$shortcity = LOCATOR_CORE_18;} else {$shortcity = $row7[shortcity];}
            if ($row7[shortcity] == "") {$shortcity_link = "-";} else {$shortcity_link = $row7[shortcity];}
            $shortcity = str_replace("&", "-", $shortcity); // Remove & sign
            $shortcity_link = str_replace("&", "%27", $shortcity_link); // Remove & sign
            $text_temp .= " <a href='locator.php?cty.".$shortcity_link."'>".$shortcity."</a> ".$divide_char;
          } else {
            // Look out for use of apostrophe in city name
            $row7_locator_city = str_replace("&#039;", "%27", $row7[locator_city]); //Browser Access Denied response on click link with '
           //  Transform unicode characters in URL e.g. Göteborg into G%F6teborg
            $text_temp .= " <a href='locator.php?cty.".urlencode(utf8_decode($row7_locator_city))."'>".$row7[locator_city]."</a> ".$divide_char;
          }
        } // End of loop through cities
        $text .= substr($text_temp, 0, -1); // remove last string character
        $text .= "<br />"; // break after showing cities
      }
      
      if ($pref['locator_show_group_zip'] == 1) {
        // Loop through zip codes to display zip code list with links
        $sql8 = new db;
        $text_temp = "";
  			// Only display zip code records in use
  			$arg8="SELECT DISTINCT LEFT(locator_zipcode, ".$zip_code_summary_length.") AS zippy
               FROM #locator_sites
               LEFT JOIN #locator_cat
               ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
               WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
               ORDER BY locator_zipcode";
        $sql8->db_Select_gen($arg8,false);
  			while($row8 = $sql8-> db_Fetch()){
          // Show empty zipcodes in a separate category too!
          if ($row8[zippy] == "") {$zippy = LOCATOR_CORE_14;} else {$zippy = $row8[zippy];}
          if ($row8[zippy] == "") {$zippy_link = "-";} else {$zippy_link = $row8[zippy];}
          $text_temp .= " <a href='locator.php?zip.".$zippy_link."'>".$zippy."</a> ".$divide_char;
        } // End of loop through cities
        $text .= substr($text_temp, 0, -1); // remove last string character
        $text .= "<br />"; // break after showing zip codes
      }
      $text .= "</td></tr>"; // Table manipulation after last group

      // Display the table header
			$text .=
			"<tr>
				<td class='forumheader1'>".LOCATOR_CORE_03."</td>
				<td class='forumheader1'>".LOCATOR_CORE_04."</td>
				<td class='forumheader1'>".LOCATOR_CORE_05."</td>
				<td class='forumheader1'>".LOCATOR_CORE_06."</td>
				<td class='forumheader1'>".LOCATOR_CORE_07."</td>
				<td class='forumheader1'>".LOCATOR_CORE_08."</td>";
				
        if ($pref['locator_suppress_online'] <> '1') {
        $text .= "
        <td class='forumheader1'>".LOCATOR_CORE_09."</td>";
				}
				
				$text .= "
				<td class='forumheader1'><img src='".e_PLUGIN_ABS."locator/images/google_maps.png' height=20px alt=''></td>
      </tr>
      ";

			// While there are ACTIVE records available; fill the rows to display them all in the userdefined order
      if ($pref['locator_paginate'] == "") {
        $loc_paginate = 0; // Paginate function is default Off
      } else {
        $loc_paginate = $pref['locator_paginate'];
      }
      $loc_from = 0;
      if ($pref['locator_paginate_display'] == "") {
        $loc_paginate_display = 10; // Default locations per page is 10
      } else {
        $loc_paginate_display = $pref['locator_paginate_display'];
      }
			if ($loc_paginate == '1') { // Limit the list
        //if ($action == 'p') { // Page indicator
           if (strlen($page_id) == 0) { // No action_id found
              $loc_from = 0;
           } else { // Determine start record
              $loc_from = ($page_id * $loc_paginate_display) - $loc_paginate_display;
           }
        //} // Show locations per page
			  $sql_query_limit = " LIMIT $loc_from, $loc_paginate_display";
			} else { // No pages, one long list
				$sql_query_limit = "";
      }

  if ($pref['locator_show_group_only'] == 1) { // Only display active location records from specified group
      if ($action == 'cat') { // locator.php?cat.n is set in URL
  			//$sql -> db_Select(DB_TABLE_LOCATOR2_TABLE, "*", "locator_active_status = '2' AND locator_catid = '".$action_id."' ORDER BY ".$pref['locator_default_sort'].$sql_query_limit);
         $arg= "SELECT *
                FROM #locator_sites
                LEFT JOIN #locator_cat
                ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
                WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
                      AND locator_catid = '".intval($action_id)."'
                ORDER BY ABS(".$pref['locator_default_sort'].") ".$sql_query_limit;
         $sql->db_Select_gen($arg,false);
  			//$count_locations = $sql2->db_Count(DB_TABLE_LOCATOR2_TABLE, "(*)", "WHERE locator_active_status = '2' AND locator_catid = '".$action_id."'");
         $arg= "SELECT COUNT(*)
                FROM #locator_sites
                LEFT JOIN #locator_cat
                ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
                WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
                      AND locator_catid = '".intval($action_id)."'
                ORDER BY ABS(".$pref['locator_default_sort'].") ".$sql_query_limit;
         $sql2->db_Select_gen($arg,false);
         $count_locations = $row2['COUNT(*)'];
    } else if ($action == 'cnt') { // locator.php?cnt.n is set in URL
	   		//$sql -> db_Select(DB_TABLE_LOCATOR2_TABLE, "*", "locator_active_status = '2' AND locator_country = '".$action_id."' ORDER BY ".$pref['locator_default_sort'].$sql_query_limit);
         $arg= "SELECT *
                FROM #locator_sites
                LEFT JOIN #locator_cat
                ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
                WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
                      AND locator_country = '".intval($action_id)."'
                ORDER BY ABS(".$pref['locator_default_sort'].") ".$sql_query_limit;
         $sql->db_Select_gen($arg,false);
	   		//$count_locations = $sql2->db_Count(DB_TABLE_LOCATOR2_TABLE, "(*)", "WHERE locator_active_status = '2' AND locator_country = '".$action_id."'");
         $arg= "SELECT COUNT(*)
                FROM #locator_sites
                LEFT JOIN #locator_cat
                ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
                WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
                      AND locator_country = '".intval($action_id)."'
                ORDER BY ABS(".$pref['locator_default_sort'].") ".$sql_query_limit;
         $sql2->db_Select_gen($arg,false);
         $count_locations = $row2['COUNT(*)'];
    } else if ($action == 'cty') { // locator.php?cty.n is set in URL
      if ($city_summary_length > 0) { // Limit the city names on specified length
  		   //$sql -> db_Select(DB_TABLE_LOCATOR2_TABLE, "*", "locator_active_status = '2' AND LEFT(locator_city,".$city_summary_length.") = '".$action_id."' ORDER BY ".$pref['locator_default_sort'].$sql_query_limit);
         $arg= "SELECT *
                FROM #locator_sites
                LEFT JOIN #locator_cat
                ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
                WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
                      AND LEFT(locator_city,".$city_summary_length.") = '".$tp->toDB($action_id)."'
                ORDER BY ABS(".$pref['locator_default_sort'].") ".$sql_query_limit;
         $sql->db_Select_gen($arg,false);
  			 //$count_locations = $sql2->db_Count(DB_TABLE_LOCATOR2_TABLE, "(*)", "WHERE locator_active_status = '2' AND LEFT(locator_city,".$city_summary_length.") = '".$action_id."'");
         $arg= "SELECT COUNT(*)
                FROM #locator_sites
                LEFT JOIN #locator_cat
                ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
                WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
                      AND LEFT(locator_city,".$city_summary_length.") = '".$tp->toDB($action_id)."'
                ORDER BY ABS(".$pref['locator_default_sort'].") ".$sql_query_limit;
         $sql2->db_Select_gen($arg,false);
         $count_locations = $row2['COUNT(*)'];
      } else { // Full city names
		  	//$sql -> db_Select(DB_TABLE_LOCATOR2_TABLE, "*", "locator_active_status = '2' AND locator_city = '".$action_id."' ORDER BY ".$pref['locator_default_sort'].$sql_query_limit);
         $arg= "SELECT *
                FROM #locator_sites
                LEFT JOIN #locator_cat
                ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
                WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
                      AND locator_city = '".$tp->toDB($action_id)."'
                ORDER BY ABS(".$pref['locator_default_sort'].") ".$sql_query_limit;
         $sql->db_Select_gen($arg,false);
		  	//$count_locations = $sql2->db_Count(DB_TABLE_LOCATOR2_TABLE, "(*)", "WHERE locator_active_status = '2' AND locator_city = '".$action_id."'");
         $arg= "SELECT COUNT(*)
                FROM #locator_sites
                LEFT JOIN #locator_cat
                ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
                WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
                      AND locator_city = '".$tp->toDB($action_id)."'
                ORDER BY ABS(".$pref['locator_default_sort'].") ".$sql_query_limit;
         $sql2->db_Select_gen($arg,false);
         $count_locations = $row2['COUNT(*)'];
		  	}
    } else if ($action == 'zip') { // locator.php?zip.n is set in URL
			 //$sql -> db_Select(DB_TABLE_LOCATOR2_TABLE, "*", "locator_active_status = '2' AND LEFT(locator_zipcode,".$zip_code_summary_length.") = '".$action_id."' ORDER BY ".$pref['locator_default_sort'].$sql_query_limit);
       $arg= "SELECT *
              FROM #locator_sites
              LEFT JOIN #locator_cat
              ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
              WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST.")) AND LEFT(locator_zipcode,".$zip_code_summary_length.") = '".$tp->toDB($action_id)."'
              ORDER BY ABS(".$pref['locator_default_sort'].") ".$sql_query_limit;
       $sql->db_Select_gen($arg,false);
			 //$count_locations = $sql2->db_Count(DB_TABLE_LOCATOR2_TABLE, "(*)", "WHERE locator_active_status = '2' AND LEFT(locator_zipcode,".$zip_code_summary_length.") = '".$action_id."'");
       $arg= "SELECT COUNT(*)
              FROM #locator_sites
              LEFT JOIN #locator_cat
              ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
              WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
                    AND LEFT(locator_zipcode,".$zip_code_summary_length.") = '".$tp->toDB($action_id)."'
              ORDER BY ABS(".$pref['locator_default_sort'].") ".$sql_query_limit;
       $sql2->db_Select_gen($arg,false);
       $count_locations = $row2['COUNT(*)'];
    } else { // no category is set in URL
			 //$sql -> db_Select(DB_TABLE_LOCATOR2_TABLE, "*", "locator_active_status = '2' ORDER BY ".$pref['locator_default_sort'].$sql_query_limit);
       $arg= "SELECT *
              FROM #locator_sites
              LEFT JOIN #locator_cat
              ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
              WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
              ORDER BY ABS(".$pref['locator_default_sort'].") ".$sql_query_limit;
       $sql->db_Select_gen($arg,false);
			 //$count_locations = $sql2->db_Count(DB_TABLE_LOCATOR2_TABLE, "(*)", "WHERE locator_active_status = '2'");
       $arg= "SELECT COUNT(*)
              FROM #locator_sites
              LEFT JOIN #locator_cat
              ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
              WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
              ORDER BY ABS(".$pref['locator_default_sort'].") ".$sql_query_limit;
       $sql2->db_Select_gen($arg,false);
       $count_locations = $row2['COUNT(*)'];
    }
  }
	else {  // Display all active location records
			// $sql -> db_Select(DB_TABLE_LOCATOR2_TABLE, "*", "locator_active_status = '2' ORDER BY ".$pref['locator_default_sort'].$sql_query_limit) ;
      $arg="SELECT *
            FROM #locator_sites
            LEFT JOIN #locator_cat
            ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
            WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
            ORDER BY ABS(".$pref['locator_default_sort'].") ".$sql_query_limit;
      $sql->db_Select_gen($arg,false);
			//$count_locations = $sql2->db_Count(DB_TABLE_LOCATOR2_TABLE, "(*)", "WHERE locator_active_status = '2'");
       $arg= "SELECT COUNT(*)
              FROM #locator_sites
              LEFT JOIN #locator_cat
              ON #locator_sites.locator_catid = #locator_cat.locator_cat_id
              WHERE locator_active_status = '2' AND locator_catactive_status = '2' AND (locator_cat_class IN (".USERCLASS_LIST."))
              ORDER BY ABS(".$pref['locator_default_sort'].") ".$sql_query_limit;
       $sql2->db_Select_gen($arg,false);
       $count_locations = $row2['COUNT(*)'];
  }
			while($row = $sql-> db_Fetch()){

      // The data is placed in to cachevars() so that the shortcode can access it.
      // cachevars('locator_current_data', $row);
			
      // Parse the template to put the values eg. {MYSHORTCODE}, into the HTML.
      // $text = $tp->parseTemplate( $LOCATOR_TEMPLATE, FALSE, $locator_shortcodes);

      // map_type = 1 : Google Maps, map_type = 2 : MapQuest
      // Map type determination needs to be done within the while loop becaus we set map_type = 3 if coordinates are filled in.
      $map_type = $pref['locator_maptype'];
      // Determine the href string before manipulating the data
      $href_string = ""; // Clear the href string variable for each individual location to be shown
      // For Google Maps use country description, for Mapquest use country code
      $display_country = ""; // Clear the country display variable for each individual location to be shown
      if ($map_type == 1) { // Google Maps  string
          $sql4 = new db;
         	$sql4 -> db_Select(DB_TABLE_LOCATOR_COUNTRY, "locator_country_descr", "locator_country_id=".intval($row['locator_country'])."");
         	while($row4 = $sql4->db_Fetch()) {
            // Process $row
            $display_country = $row4['locator_country_descr'];
          }
      } else { // assume Mapquest
          $sql5 = new db;
         	$sql5 -> db_Select(DB_TABLE_LOCATOR_COUNTRY, "locator_country_code", "locator_country_id=".intval($row['locator_country'])."");
         	while($row5 = $sql5->db_Fetch()) {
            // Process $row
            $display_country = $row5['locator_country_code'];
          }
      }
      // For Google Maps the address string is different than for Mapquest
      if ($map_type == 1) { // Google Maps  string
        if ((strlen(trim($row['locator_latitude'])) > 0) AND (strlen(trim($row['locator_longtitude'])) > 0)) { // Work with coordinates
          $map_type = 3;
          $href_string .= trim($row['locator_latitude']).",+".trim($row['locator_longtitude']); // + is url coding for space
          $href_string .= "+(".str_replace(" ", "+", trim($row['locator_client'])).")"; // replace spaces with +
        } // End of if to determine work with coordinates
        else { // Work with near address
          if ($row['locator_address1'] <> "") {$href_string .= trim($row['locator_address1'])."+";}
          if ($row['locator_zipcode'] <> "") {$href_string .= trim($row['locator_zipcode'])."+";}
          if ($row['locator_city'] <> "") {$href_string .= trim($row['locator_city'])."+";}
          if ($row['locator_county'] <> "") {$href_string .= trim($row['locator_county'])."+";}
          if ($row['locator_state'] <> "") {$href_string .= trim($row['locator_state'])."+";}
          if ($row['locator_country'] <> "") {$href_string .= trim($display_country)."+";}
          // Delete last + character from href_string
          if ($href_string <> "") {
            $href_string = substr($href_string, 0, -1); // remove last string character
          }
        }
      }
      if ($map_type == 2) { // Mapquest string
        if ($row['locator_city'] <> "") {$href_string .= "city=".trim($row['locator_city'])."&";}
        if ($row['locator_state'] <> "") {$href_string .= "state=".trim($row['locator_state'])."&";}
        if ($row['locator_address1'] <> "") {$href_string .= "address=".trim($row['locator_address1'])."&";}
        if ($row['locator_zipcode'] <> "") {$href_string .= "zip=".trim($row['locator_zipcode'])."&";}
        if ($row['locator_country'] <> "") {$href_string .= "country=".trim($display_country)."&";}
        // Add zoom factor for MapQuest
        $href_string .= "zoom=".$zoomfactor;
      }

      // For a proper appearance in the table: fill empty cells with a space
      if ($row['locator_client'] == "") {$row['locator_client'] = "&nbsp;";}
      if ($row['locator_address1'] == "") {$row['locator_address1'] = "&nbsp;";}
      if ($row['locator_zipcode'] == "") {$row['locator_zipcode'] = "&nbsp;";}
      if ($row['locator_city'] == "") {$row['locator_city'] = "&nbsp;";}
      if ($row['locator_telephone1'] == "") {$row['locator_telephone1'] = "&nbsp;";}
      if ($row['locator_fax1'] == "") {$row['locator_fax1'] = "&nbsp;";}

			$text .= "
			<tr>
				<td class='forumheader3'>".$tp->toHTML($row['locator_client'], true)."</td>
				<td class='forumheader3'>".$row['locator_address1']."</td>
				<td class='forumheader3'>".$row['locator_zipcode']."</td>
				<td class='forumheader3'>".$row['locator_city']."</td>
				<td class='forumheader3'>".$row['locator_telephone1']."</td>
				<td class='forumheader3'>".$row['locator_fax1']."</td>";
				
				if ($pref['locator_suppress_online'] <> '1') {
				$text .= "
				<td class='forumheader3'>";
  				if ($row['locator_status'] == 1) {
            if ($row['locator_url1'] <> "") {
  				    $text .= "<a href='".$row['locator_url1']."' alt='".LOCATOR_CORE_13."' title='".LOCATOR_CORE_13."'>";
            }
            $text .= LOCATOR_CORE_10;
            if ($row['locator_url1'] <> "") {
              $text .= "</a>";
            }
  				} else {
  				$text .= "-";
  				}
   				$text .= "
        </td>";
        }
        
        $text .= "
        <td class='forumheader1'>
          ";
          // Only show a link when the href_string variable is filled
          if ($href_string <> "") {
              if ($map_type == 1) { // Google Maps
               $text .= "
       				<a href='http://maps.google.com/maps?near=".$href_string."'no-border  target='_blank'>
              <img src='".e_PLUGIN_ABS."locator/images/google_maps.png' alt='".LOCATOR_CORE_12."' title='".LOCATOR_CORE_12."' border='0' height=20px >
              </a>";
              }
              if ($map_type == 2) { // MapQuest
               $text .= "
       				<a href='http://www.mapquest.com/maps/map.adp?".$href_string."'no-border  target='_blank'>
              <img src='".e_PLUGIN_ABS."locator/images/google_maps.png' alt='".LOCATOR_CORE_12."' title='".LOCATOR_CORE_12."' border='0' height=20px >
              </a>";
              }
              if ($map_type == 3) { // Google Maps with coordinates
               $text .= "
       				<a href='http://maps.google.com/maps?q=".$href_string."'no-border  target='_blank'>
              <img src='".e_PLUGIN_ABS."locator/images/google_maps.png' alt='".LOCATOR_CORE_12."' title='".LOCATOR_CORE_12."' border='0' height=20px >
              </a>";
              }

          }

   				$text .= "
        </td>
        </tr>";
      }
    }

$text .= "
			</td>
		</tr>
	</table>
";

// Display multiple pages
if ($loc_paginate == '1') { // Only do this if paginate is On
  	$last_page = intval(($count_locations + $loc_paginate_display - 1) / $loc_paginate_display); // intval returns round values e.g. intval(4.2) returns 4
  	if ($last_page > 1 ) { // Suppress page indication if there is only one page
      $page_count = 1;
      if ($action == "") {
        $action = "p";
      }
      if ($page_id == "" or $page_id < 1 or $page_id == null) {
        $page_id = 1; // Set initial page if no page parameter or illegal parameter is given
      }
      while ($page_count <= $last_page) { // For each page counter display a page
        if ($page_count == $page_id) { // If it is the page itself, no link
          $page_text .= " ".LOCATOR_CORE_17." ".$page_count." ".$divide_char;
        } else { // This is a different page than the current one, provide a link
          $page_text .= " <a href='locator.php?".(($action <> 'p')? $action.".".$action_id : $action).".".$page_count."'>".LOCATOR_CORE_17." ".$page_count."</a> ".$divide_char;
        }
        $page_count++;
      }
  	}
  	$page_text = substr($page_text, 0, -strlen($divide_char)); // remove last string divide character from page string
  	$text .= "<center>".$page_text."</center><br />";
}

// Render the value of $text in a table.
//$title = LOCATOR_CORE_01;
$title = $pref["locator_name"];
$ns -> tablerender($title, $text);

// === End of BODY ===
// use FOOTERF for USER PAGES and e_ADMIN.'footer.php' for admin pages
require_once(FOOTERF);
?> 
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

// Check to see if the current user has admin permissions for this plugin
if (!getperms("P")) {
	// No permissions set, redirect to site front page
	header("location:".e_BASE."index.php");
	exit;
}

// Get language file (assume that the English language file is always present)
$lan_file = e_PLUGIN."locator/languages/".e_LANGUAGE.".php";
include_lan($lan_file);

// Include define tables info
require_once("includes/config.php");

// Set the active menu option for admin_menu.php
$pageid = 'admin_menu_04';

// Check query
if(e_QUERY){
	$tmp = explode("=", e_QUERY);
	$action = $tmp[0];
	$action_id = $tmp[1];
	unset($tmp);
}

if ($action == "rej") {
  // Admin rejects the user submitted location: locator_sub_verified gets status 1
  $sql5 = new db;
  $sql5 -> db_Update('locator_sub_sites', "locator_sub_verified=1 WHERE locator_sub_id='$action_id'");
	header("location:".$e_SELF."admin_locations.php?approve");
	exit;
}

if ($action == "approve") {
  $pageid = 'admin_menu_06'; // Adjust the active menu pointer
  $submitted_locations = $sql->db_Count('locator_sub_sites', '(*)', "WHERE locator_sub_verified IS NULL");
  if ($submitted_locations < 1) {
  	header("location:".$e_SELF."admin_locations.php");
  	exit;
  }
  $approve_text .= "	<br />
	<form name='approve' method='POST' action='".e_PLUGIN."locator/admin_locations_edit.php?appr'>
		<center>
			<div style='width:80%'>
				<fieldset>
					<legend>
            ".LOCATOR_LOC_29."
					</legend>
					<table border='0' cellspacing='15' width='100%'>
						<tr>
							<td>";
							
  $sql2 = new db;
	$sql2 -> db_Select('locator_sub_sites', '*', "locator_sub_verified IS NULL");
	while($row2 = $sql2-> db_Fetch()){
                $locator_sub_id = intval($row2['locator_sub_id']);
                $locator_sub_client = $tp->toDB($row2['locator_sub_client']);
                $locator_sub_address1 = $tp->toDB($row2['locator_sub_address1']);
                $locator_sub_zipcode = $tp->toDB($row2['locator_sub_zipcode']);
                $locator_sub_city = $tp->toDB($row2['locator_sub_city']);
                $locator_sub_country = $tp->toDB($row2['locator_sub_country']);
                $locator_sub_status = $tp->toDB($row2['locator_sub_status']);
                $locator_sub_telephone1 = $tp->toDB($row2['locator_sub_telephone1']);
                $locator_sub_fax1 = $tp->toDB($row2['locator_sub_fax1']);
                $locator_sub_catid = $tp->toDB($row2['locator_sub_catid']);
                $locator_sub_url1 = $tp->toDB($row2['locator_sub_url1']);
                $locator_sub_active_status = $tp->toDB($row2['locator_sub_active_status']);
                $locator_sub_description1 = $tp->toDB($row2['locator_sub_description1']);
                $locator_sub_latitude = $tp->toDB($row2['locator_sub_latitude']);
                $locator_sub_longtitude = $tp->toDB($row2['locator_sub_longtitude']);
                $locator_sub_datestamp  = date("D dS M y, g:ia", $tp->toDB($row2['locator_sub_datestamp']));
                $locator_sub_ip = $tp->toDB($row2['locator_sub_ip']);
                $locator_sub_auth = $tp->toDB($row2['locator_sub_auth']);
                $locator_sub_name = $tp->toDB($row2['locator_sub_name']);
                $locator_sub_email = $tp->toDB($row2['locator_sub_email']);   
    	
    $approve_text .= LOCATOR_LOC_05.": $locator_sub_client<br />";
    $approve_text .= LOCATOR_LOC_06.": $locator_sub_address1<br />";
    $approve_text .= "$locator_sub_zipcode  $locator_sub_city<br />";

    $sql3 = new db;
    $sql3 -> db_Select('locator_country', '*', "locator_country_id=$locator_sub_country");
	  if($row3 = $sql3-> db_Fetch()){
      $locator_sub_country_description = $tp->toHTML($row3['locator_country_descr']);
	  }
    $approve_text .= "$locator_sub_country_description<br /><br />";

    $approve_text .= LOCATOR_LOC_11.": $locator_sub_telephone1 ".LOCATOR_LOC_12.": $locator_sub_fax1<br />";

    $sql4 = new db;
    $sql4 -> db_Select('locator_cat', '*', "locator_cat_id=$locator_sub_catid");
	  if($row4 = $sql4-> db_Fetch()){
      $locator_sub_catid_description = $tp->toHTML($row4['locator_catname']);
	  }
    $approve_text .= LOCATOR_LOC_07.": $locator_sub_catid_description<br />";

    $approve_text .= LOCATOR_LOC_22.": $locator_sub_url1<br />";
    $approve_text .= LOCATOR_LOC_25.": $locator_sub_description1<br />";
    $approve_text .= LOCATOR_LOC_26.": $locator_sub_latitude, ".LOCATOR_LOC_27.": $locator_sub_longtitude<br />";
    $approve_text .= LOCATOR_LOC_31.": ".(($locator_sub_active_status==2)?LOCATOR_LOC_15:LOCATOR_LOC_32)."<br /><br /><br />";
    $approve_text .= LOCATOR_LOC_33.": $locator_sub_datestamp, ".LOCATOR_LOC_34.": $locator_sub_ip, ".LOCATOR_LOC_35.": ";
    if (trim($locator_sub_auth)>0) {
      $approve_text .= "<a href='".e_HTTP."user.php?id.$locator_sub_auth'>$locator_sub_name</a>";
    } else {
      $approve_text .= "$locator_sub_name";
    }

    $approve_text .= "&nbsp;".LOCATOR_LOC_36.": <a href='mailto:$locator_sub_email'>$locator_sub_email</a><br /><br />";
    $approve_text .= "<table><tr><td>";
    // Approve (admin_locations_edit.php?appr): give locator_sub_verified status 2
    $approve_text .= "
              <form name='approve' method='POST' action='".e_PLUGIN."locator/admin_locations_edit.php?appr'>
    					<input type='hidden' name='locator_sub_id' value='$locator_sub_id' />
    					<input type='hidden' name='locator_client' value='$locator_sub_client' />
    					<input type='hidden' name='locator_address1' value='$locator_sub_address1' />
    					<input type='hidden' name='locator_zipcode' value='$locator_sub_zipcode'/>
    					<input type='hidden' name='locator_city' value='$locator_sub_city' />
    					<input type='hidden' name='locator_country' value='$locator_sub_country' />
    					<input type='hidden' name='locator_status' value='$locator_sub_status' />
    					<input type='hidden' name='locator_telephone1' value='$locator_sub_telephone1' />
    					<input type='hidden' name='locator_fax1' value='$locator_sub_fax1' />
    					<input type='hidden' name='locator_catid' value='$locator_sub_catid' />
    					<input type='hidden' name='locator_url1' value='$locator_sub_url1' />
    					<input type='hidden' name='locator_active_status' value='$locator_sub_active_status' />
    					<input type='hidden' name='locator_description1' value='$locator_sub_description1' />
    					<input type='hidden' name='locator_latitude' value='$locator_sub_latitude' />
    					<input type='hidden' name='locator_longtitude' value='$locator_sub_longtitude' />
					    <input class='button' type='submit' value='".LOCATOR_LOC_37."'>
              </form>
              ";
    $approve_text .= "&nbsp;&nbsp;</td><td>";
    // Reject (admin_locations.php?rej=x): give locator_sub_verified status 1
    $approve_text .= "<form name='reject' method='POST' action='".e_SELF."?rej=$locator_sub_id'><input class='button' type='submit' value='".LOCATOR_LOC_38."'></form>";
    $approve_text .= "</td></tr></table>";
    $approve_text .= "<br /><hr />";
	}

  $approve_text .= "	<br />
							</td>
            </tr>
          </table>
        </fieldset>
      </div>
    </center>
  </form>
  ";
	// Render the value of $text in a table.
	$title = LOCATOR_LOC_39;
	$ns -> tablerender($title, $approve_text);
  require_once(e_ADMIN."footer.php");
  exit;
}

// Edit / Maintain existing location
if ($_GET['edit_location'] == 1) {
  // Select the single record from the database
	$sql -> db_Select(DB_TABLE_LOCATOR2_TABLE, "*", "locator_id=".$_GET['locator_id']);
	while($row = $sql-> db_Fetch()){
	    $locator_id = $row['locator_id'];
	    $locator_client = $row['locator_client'];
    	$locator_address1 = $row['locator_address1'];
    	$locator_zipcode = $row['locator_zipcode'];
    	$locator_city = $row['locator_city'];
    	$locator_country = $row['locator_country'];
    	$locator_status = $row['locator_status'];
    	$locator_telephone1 = $row['locator_telephone1'];
    	$locator_fax1 = $row['locator_fax1'];
    	$locator_catid = $row['locator_catid'];
    	$locator_url1 = $row['locator_url1'];
    	$locator_active_status = $row['locator_active_status'];
    	$locator_description1 = $row['locator_description1'];
    	$locator_latitude = $row['locator_latitude'];
    	$locator_longtitude = $row['locator_longtitude'];
	}
	
	$text .= "
	<br />
	<form name='good' method='POST' action='admin_locations_edit.php'>
		<center>
			<div style='width:80%'>
				<fieldset>
					<legend>
						".LOCATOR_LOC_17."
					</legend>
					<table border='0' cellspacing='15' width='100%'>
						<!-- normally ID will not be shown
						<tr>
							<td>
								<b>".LOCATOR_LOC_04."</b>
              </td>
							<td>
								$locator_id
							</td>
						</tr>
						 normally ID will not be shown -->
						<tr>
							<td>
								<b>".LOCATOR_LOC_05."</b>
							</td>
							<td>
								<input class='tbox' size='25' type='text' name='locator_client' value='$locator_client' />
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_LOC_06."</b>
							</td>
							<td>
								<input class='tbox' cols='25' name='locator_address1' value='$locator_address1' />
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_LOC_08."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='locator_zipcode' value='$locator_zipcode' />
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_LOC_09."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='locator_city' value='$locator_city' />
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_LOC_21."</b>
							</td>
							<td valign='top'>
								<!-- <input class='tbox' size='25' type='text' name='locator_country' value='$locator_country' /> -->
      					<select class='tbox' name='locator_country'>
              ";

						            // Fourth query to build the selection list with active categories
						            $sql4 = new db;
          	$sql4 -> db_Select(DB_TABLE_LOCATOR_COUNTRY, "*", "locator_country_status=2 ORDER BY locator_country_descr");
          	while($row4 = $sql4-> db_Fetch()){
          	if ($row4['locator_country_id'] == $locator_country ){
                        $text .= "
                          <option value='".$row4['locator_country_id']."' selected='selected'>".$row4['locator_country_descr']."</option>
                        ";
            } else {
                        $text .= "
                          <option value='".$row4['locator_country_id']."'>".$row4['locator_country_descr']."</option>
                        ";
            }
            }
							
							
							$text .= "
                </select>
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_LOC_10."</b>
							</td>
							<td valign='top'>
								<!-- <input class='tbox' size='25' type='text' name='locator_status' value='$locator_status' /> -->
        					<select class='tbox' name='locator_status'>
        					<option value='0' ";
        					if ($locator_status == "0" or $locator_status == "") {
                    $text .= "selected='selected'";
                  }
                  $text .=
                  ">".LOCATOR_LOC_23."</option>
        					<option value='1' ";
        					if ($locator_status == "1") {
                    $text .= "selected='selected'";
                  }
                  $text .=
                  ">".LOCATOR_LOC_24."</option>
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_LOC_11."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='locator_telephone1' value='$locator_telephone1' />
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_LOC_12."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='locator_fax1' value='$locator_fax1' />
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_LOC_20."</b>
							</td>
							<td valign='top'>
								<!-- <input class='tbox' size='25' type='text' name='locator_catid'> -->
      					<select class='tbox' name='locator_catid'>
                ";

                $compare_locid = $locator_catid;
                $sql2 = new db;
              	$sql2 -> db_Select(DB_TABLE_LOCATOR_TABLE, "*", "locator_catactive_status ='2' ORDER BY locator_catorder");
              	while($row2 = $sql2-> db_Fetch()){
                	if ($row2['locator_cat_id'] == $compare_locid){
                    $text .= "
                      <option value='".$row2['locator_cat_id']."' selected='selected'>".$row2['locator_catname']."</option>
                              ";
                  } else {
                    $text .= "
                      <option value='".$row2['locator_cat_id']."'>".$row2['locator_catname']."</option>
                    ";
                  }
                 }

               $text .= "
                </select>
							</td>
						</tr>
            <tr>
            <td valign='top'>
								<b>".LOCATOR_LOC_22."</b>
            </td>
            <td valign='top'>
								<input class='tbox' size='25' type='text' name='locator_url1' value='$locator_url1' />
            </td>
            </tr>
            ";
            
           if ($pref['locator_map_info_window_extra_text'] == '1') { // Setting extra info window line is Yes
            $text .= "
          			<tr>
    							<td valign='top'>
    								<b>".LOCATOR_LOC_25."</b>
    							</td>
    							<td>
    								<input class='tbox' size='25' name='locator_description1' value='$locator_description1' />
    							</td>
    						</tr>
    						";
           } // End of extra info window line input


          if ($pref['locator_input_coordinates'] == '1') { // Setting input coordinates is Yes
            $text .= "
          			<tr>
    							<td valign='top'>
    								<b>".LOCATOR_LOC_26."</b>
    							</td>
    							<td>
    								<input class='tbox' size='25' name='locator_latitude' value='$locator_latitude' />
    							</td>
    						</tr>
          			<tr>
    							<td valign='top'>
    								<b>".LOCATOR_LOC_27."</b>
    							</td>
    							<td>
    								<input class='tbox' size='25' name='locator_longtitude' value='$locator_longtitude' />
    							</td>
    						</tr>
    						";
          } // End of extra input coordinates

            $text .= "
            <tr>
              <td>
                <b>".LOCATOR_LOC_15."</b>
              </td>
              <td>
						";

						// Display the check box for active status (active = 2)
						if ($locator_active_status == 2) {
								$text .= "
								<input type='checkbox' name='locator_active_status' value='2' checked='checked' />";
						} else {
								$text .= "
								<input type='checkbox' name='locator_active_status' value='1' />";
						}

    	      $text .= "
              </td>
            </tr>
						";

        $text .= "
     		</table>
				<br />
				<center>
          <input type='hidden' name='action_id' value='".$_GET['p']."'>
					<input type='hidden' name='locator_id' value='".$_GET['locator_id']."'>
					<input type='hidden' name='edit_location' value='2'>
					<input class='button' type='submit' value='".LOCATOR_LOC_13."'>
				</center>
				<br /><br />
				</fieldset>
			</div>
		</center>
	</form>";
	
	// Render the value of $text in a table.
	$title = LOCATOR_LOC_00;
	$ns -> tablerender($title, $text);
	
} else {
  // Initial screen with Maintain Locations

  // Determine if there are no locations
  $count_locations = $sql -> db_Count(DB_TABLE_LOCATOR2_TABLE);
	if($count_locations > 0) {
		$no_locations = 1;
	}

  /*
  //  Retrieve the records from the database
	$sql -> db_Select(DB_TABLE_LOCATOR2_TABLE);
	while($row = $sql-> db_Fetch()){
		$locator_id = $row['locator_id'];
		$locator_client = $row['locator_client'];
		$locator_address1 = $row['locator_address1'];
	  $locator_zipcode = $row['locator_zipcode'];
	  $locator_city = $row['locator_city'];
	  $locator_telephone1 = $row['locator_telephone1'];
	  $locator_fax1 = $row['locator_fax1'];
    $locator_catid = $row['locator_catid'];
	}
	*/
	
	$text .= "
	<br />
	<form name='good' method='POST' action='admin_locations_edit.php'>
		<center>
				<fieldset>
					<legend>
						".LOCATOR_LOC_01."
					</legend>";
          // Show a message if there are no categories to display
					if ($no_locations == null) {
						$text .= "
						<br />
						<center>
							<span class='smalltext'>
								".LOCATOR_LOC_02."
							</span>
						</center>
						<br /><br />";
					} else {
						$text .= "
						<br />
						<center>
						  <table style='".ADMIN_WIDTH."' class='fborder'>
							<tr>
									<!-- <td class='fcaption'><b>".LOCATOR_LOC_04."</b></td> -->
									<td class='fcaption'><b>".LOCATOR_LOC_05."</b></td>
                  <td class='fcaption'><center><b>".LOCATOR_LOC_14."</b></center></td>
									<td class='fcaption'><center><b>".LOCATOR_LOC_07."</b></center></td>
									<td class='fcaption'><center><b>".LOCATOR_LOC_15."</b></center></td>
									<td class='fcaption'><center><b>".LOCATOR_LOC_16."</b></center></td>
							</tr>";
								// Set the sort order to the one set in the Preferences
								$locator_sort_order = $pref['locator_default_sort'];
                // Possible sort orders:
                // $locator_sort_order = 'locator_order';
                // $locator_sort_order = 'locator_id';
                // $locator_sort_order = 'locator_zipcode';
                // $locator_sort_order = 'locator_client';
                // $locator_sort_order = 'locator_catid';
                // $locator_sort_order = 'locator_city';
                if ($locator_sort_order == null or strlen($locator_sort_order) == 0) { // Bugtracker (#34) RC4: sort list of locations all mixed up
                    $locator_sort_order = 'locator_id'; // Set a default if preferences are not filled
                }

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
                  if ($action == 'p') { // Page indicator
                     if (strlen($action_id) == 0) { // No action_id found
                        $loc_from = 0;
                     } else { // Determine start record
                        $loc_from = ($action_id * $loc_paginate_display) - $loc_paginate_display;
                     }
                  } // Show locations per page
								  $sql -> db_Select(DB_TABLE_LOCATOR2_TABLE, "*", "ORDER BY ABS({$locator_sort_order}) LIMIT {$loc_from}, {$loc_paginate_display}", "no-where");
								} else { // No pages, one long list
									$sql -> db_Select(DB_TABLE_LOCATOR2_TABLE, "*", "ORDER BY ABS({$locator_sort_order})", "no-where");
                }
								// While there are records available; fill the rows to display them all in the userdefined order
								while($row = $sql-> db_Fetch()){
									$text .= "
									<tr>
                    <!-- <td class='forumheader3'><center>".$row['locator_id']."</center></td> -->
										<td class='forumheader3'>".$row['locator_client']."<br />
                        ".$row['locator_address1']."<br />
                        ".$row['locator_zipcode']."&nbsp;".$row['locator_city']."<br />
                        ".$row['locator_telephone1']."<br />
                        ".$row['locator_fax1']."<br />";
                  $display_country = "";
                  $sql4 = new db;
                 	$sql4 -> db_Select(DB_TABLE_LOCATOR_COUNTRY, "locator_country_descr", "locator_country_id=".$row['locator_country']."");
                 	while($row4 = $sql4->db_Fetch()) {
                    $display_country = $row4['locator_country_descr'];
                  }
                 	
									$text .=
                    $display_country."<br />
                    </td>
										<td class='forumheader3'>
											<center>
                        <select class='tbox' name='locator_order[]'>
                        ";
						            // Second query to build the selection list with order numbers
						            $sql2 = new db;
						            $num_rows = $sql2 -> db_Count(DB_TABLE_LOCATOR2_TABLE, "(*)");
						            $count = 1;
						            while ($count <= $num_rows) {
						              if ($row['locator_order'] == $count) {
						                $text .= "
						                <option value='".$row['locator_id']."~".$count."' selected='selected'>".$count."</option>";
						               } else {
						                $text .= "
						               <option value='".$row['locator_id']."~".$count."'>".$count."</option>";
						               }
						               $count++;
						              }
						              $text .= "</select>";

									$text .= "
										<td class='forumheader3'>
											<center>
                        ";

                        $sql3 = new db;
                      	$sql3 -> db_Select(DB_TABLE_LOCATOR_TABLE, "locator_catname", "locator_cat_id = ".$row['locator_catid']."");
                      	while($row3 = $sql3-> db_Fetch()){
                            $text .= $row3['locator_catname'];
                        }

                       $text .= "
                    </center>
										</td>
										<td class='forumheader3'>
											<center>
                      ";
										// Display the check box for active status (active = 2)
										if ($row['locator_active_status'] == 2) {
												$text .= "
												<input type='checkbox' name='locator_active_status[]' value='".$row['locator_id']."' checked='checked' />";
										} else {
												$text .= "
												<input type='checkbox' name='locator_active_status[]' value='".$row['locator_id']."' />";
										}

										// Show the edit and delete icons
										$text .= "
										</center>
										</td>
										<td class='forumheader3'>
                      <center>
											<a href='admin_locations.php?edit_location=1&locator_id=".$row['locator_id']."&p=".$action_id."' alt='".LOCATOR_LOC_18."'>".ADMIN_EDIT_ICON."</a>
                      &nbsp;
											<a href='admin_locations_edit.php?delete_location=1&locator_id=".$row['locator_id']."' alt='".LOCATOR_LOC_19."'>".ADMIN_DELETE_ICON."</a>
                      </center>
										</td>
									</tr>";
								}
							// Close the table and display the Apply Changes button
							$text .= "
							</table>
						</center>
						<br />
						<center>
							<input type='hidden' name='change_order' value='1'>
							<input class='button' type='submit' value='".LOCATOR_LOC_13."'>
						</center>
						<br />";
					}
				$text .= "
				</fieldset>
		</center>
	</form>
	<br />";
	// Display multiple pages
  if ($loc_paginate == '1') { // Only do this if paginate is On
    	$last_page = intval(($count_locations + $loc_paginate_display - 1) / $loc_paginate_display); // intval returns round values e.g. intval(4.2) returns 4
    	if ($last_page > 1 ) { // Suppress page indication if there is only one page
        $page_count = 1;
        if ($action_id == "") {$action_id = 1;} // Set the page to initial if no page parameter is given
        while ($page_count <= $last_page) { // For each page counter display a page
          if ($page_count == $action_id) { // If it is the page itself, no link
            $page_text .= " ".LOCATOR_LOC_28." ".$page_count." ".$pref['locator_divide_char'];
          } else { // This is a different page than the current one, provide a link
            $page_text .= " <a href='admin_locations.php?p=".$page_count."'>".LOCATOR_LOC_28." ".$page_count."</a> ".$pref['locator_divide_char'];
          }
        $page_count++;
        }
    	}
    	$page_text = substr($page_text, 0, -1); // remove last string divide character from page string
    	$text .= "<center>".$page_text."</center><br />";
  }
	
	// Display the Create New Location form
	$text .= "
	<form name='good' method='POST' action='admin_locations_edit.php'>
		<center>
			<div style='width:80%'>
				<fieldset>
					<legend>
						".LOCATOR_LOC_03."
					</legend>
					<table border='0' cellspacing='15' width='100%'>
						<tr>
							<td>
								<b>".LOCATOR_LOC_05."</b>
							</td>
							<td>
								<input class='tbox' size='25' type='text' name='locator_client'>
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_LOC_06."</b>
							</td>
							<td>
								<input class='tbox' size='25' type='text' name='locator_address1'>
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_LOC_08."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='locator_zipcode'>
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_LOC_09."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='locator_city'>
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_LOC_21."</b>
							</td>
							<td valign='top'>
								<!-- <input class='tbox' size='25' type='text' name='locator_country'> -->
      					<select class='tbox' name='locator_country'>
                  ";

    						            // Fourth query to build the selection list with active categories
    						            $sql4 = new db;
              	$sql4 -> db_Select(DB_TABLE_LOCATOR_COUNTRY, "*", "locator_country_status=2 ORDER BY locator_country_descr");
              	while($row4 = $sql4-> db_Fetch()){
              	if ($row4['locator_country_id'] == $locator_country ){
                            $text .= "
                              <option value='".$row4['locator_country_id']."' selected='selected'>".$row4['locator_country_descr']."</option>
                            ";
                } else {
                            $text .= "
                              <option value='".$row4['locator_country_id']."'>".$row4['locator_country_descr']."</option>
                            ";
                }
                }

							$text .= "
                </select>
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_LOC_10."</b>
							</td>
							<td valign='top'>
								<!-- <input class='tbox' size='25' type='text' name='locator_status' value='$locator_status' /> -->
        					<select class='tbox' name='locator_status'>
        					<option value='0' ";
        					if ($locator_status == "0" or $locator_status == "") {
                    $text .= "selected='selected'";
                  }
                  $text .=
                  ">".LOCATOR_LOC_23."</option>
        					<option value='1' ";
        					if ($locator_status == "1") {
                    $text .= "selected='selected'";
                  }
                  $text .=
                  ">".LOCATOR_LOC_24."</option>
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_LOC_11."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='locator_telephone1'>
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_LOC_12."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='locator_fax1'>
							</td>
						</tr>
            <tr>
              <td valign='top'>
								<b>".LOCATOR_LOC_22."</b>
              </td>
              <td valign='top'>
								<input class='tbox' size='25' type='text' name='locator_url1' value='$locator_url1' />
              </td>
            </tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_LOC_20."</b>
							</td>
							<td valign='top'>
								<!-- <input class='tbox' size='25' type='text' name='locator_catid'> -->
      					<select class='tbox' name='locator_catid'>
                ";
              	$sql2 -> db_Select(DB_TABLE_LOCATOR_TABLE, "*", "locator_catactive_status ='2' ORDER BY locator_catorder");
              	while($row2 = $sql2-> db_Fetch()){
                    $text .= "
                      <option value='".$row2['locator_cat_id']."'>".$row2['locator_catname']."</option>
                    ";
                 }
                        $text .= "
                </select>
  							</td>
  						</tr>";
  						
           if ($pref['locator_map_info_window_extra_text'] == 1) { // Setting extra info window line is Yes
            $text .= "
          			<tr>
    							<td valign='top'>
    								<b>".LOCATOR_LOC_25."</b>
    							</td>
    							<td>
    								<input class='tbox' cols='25' name='locator_description1' value='$locator_description1' />
    							</td>
    						</tr>
    						";
           } // End of extra info window line input
           
          if ($pref['locator_input_coordinates'] == '1') { // Setting input coordinates is Yes
            $text .= "
          			<tr>
    							<td valign='top'>
    								<b>".LOCATOR_LOC_26."</b>
    							</td>
    							<td>
    								<input class='tbox' size='25' name='locator_latitude' value='$locator_latitude' />
    							</td>
    						</tr>
          			<tr>
    							<td valign='top'>
    								<b>".LOCATOR_LOC_27."</b>
    							</td>
    							<td>
    								<input class='tbox' size='25' name='locator_longtitude' value='$locator_longtitude' />
    							</td>
    						</tr>
    						";
          } // End of extra input coordinates

  				$text .= "
            <tr>
              <td>
                <b>".LOCATOR_LOC_15."</b>
              </td>
              <td>
                <input type='checkbox' name='locator_active_status' value='1' />
              </td>
            </tr>";
            
            $text .= "
  					</table>
  				<br />
  				<center>
  					<input type='hidden' name='create_location' value='1'>
  					<input class='button' type='submit' value='".LOCATOR_LOC_03."'>
  				</center>
  				<br />
  				</fieldset>
  			</div>
  		</center>
  	</form>";

	// Render the value of $text in a table.
	$title = LOCATOR_LOC_00;
	$ns -> tablerender($title, $text);
}

require_once(e_ADMIN."footer.php");
?>
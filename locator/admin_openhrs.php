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

require_once("includes/config.php");

// Set the active menu option for admin_menu.php
$pageid = 'admin_menu_05';

// Check URL query
if(e_QUERY){
	$tmp = explode("=", e_QUERY); // Divide the URL query in separate arrays e.g. admin_openhrs.php?p=5
	$action = $tmp[0];    // e.g. $action = 'edit'
	$action_id = $tmp[1]; // e.g. $action_id = '5'
	$page_id = $tmp[2];   // e.g. $page_id = '3'  (not used in admin_openhrs)
	unset($tmp); // unset the arrays, so next time URL query will be determined as new
}

// ----------------------------------------------------------------------------+
// ---------------------- Create and update records ---------------------------+
// ----------------------------------------------------------------------------+
if (isset($_POST['update_hrs']) or isset($_POST['create_new'])) { // Update the fields from the edit or create mode
  // Perform future checks
  if ($text <> "") {
    $text .= "<br/><center><input class='button' type=button value='".LOCATOR_ADMIN_HRS_01."' onClick='history.go(-1)'></center>";
   	// Render the value of $text in a table.
    $title = LOCATOR_ADMIN_HRS_02;
    $ns -> tablerender($title, $text);
    require_once(e_ADMIN."footer.php");
    // Leave on error
    exit;
  }
  if (isset($_POST['create_new'])) { // Create a new record in locator_sites table
    // The below insert statement is wrong; but create new from the hours will never happen
    $sql -> db_Insert(locator_sites,
    "0,
    '".$tp->toDB($_POST['locator_open_mo'])."',
		'".$tp->toDB($_POST['locator_open_tu'])."',
		'".$tp->toDB($_POST['locator_open_we'])."',
		'".$tp->toDB($_POST['locator_open_th'])."',
		'".$tp->toDB($_POST['locator_open_fr'])."',
		'".$tp->toDB($_POST['locator_open_sa'])."',
		'".$tp->toDB($_POST['locator_open_su'])."',
		'".$tp->toDB($_POST['locator_open_remarks'])."'
    ") or die(mysql_error());
  }
  if (isset($_POST['update_hrs'])) { // Update the existing record in locator_sites table
    // Actual update
    $sql -> db_Update(locator_sites,
    "locator_open_mo='".$tp->toDB($_POST['locator_open_mo'])."',
  	 locator_open_tu='".$tp->toDB($_POST['locator_open_tu'])."',
 		 locator_open_we='".$tp->toDB($_POST['locator_open_we'])."',
  	 locator_open_th='".$tp->toDB($_POST['locator_open_th'])."',
  	 locator_open_fr='".$tp->toDB($_POST['locator_open_fr'])."',
  	 locator_open_sa='".$tp->toDB($_POST['locator_open_sa'])."',
  	 locator_open_su='".$tp->toDB($_POST['locator_open_su'])."',
  	 locator_open_remarks='".$tp->toDB($_POST['locator_open_remarks'])."'
		 WHERE locator_id='".$tp->toDB($_POST['locator_id'])."'");
  }
  $upd_message = LOCATOR_ADMIN_HRS_03; // Hour information saved message
}

// Displays the update message to confirm data is stored in database
if (isset($upd_message)) {
	$ns->tablerender("", "<div style='text-align:center'><b>".$upd_message."</b></div>");
  header("Location: admin_openhrs.php");
}

// ----------------------------------------------------------------------------+
// ------------------- Edit or Maintain Opening Hours -------------------------+
// ----------------------------------------------------------------------------+
if ($action == 'edit') {
	$arg="SELECT *
        FROM #locator_sites
        WHERE locator_id = $action_id";
  $sql->db_Select_gen($arg,false);
	if($row = $sql-> db_Fetch()){
    $locator_id           = $row['locator_id'];
    $locator_client       = $row['locator_client'];
    $locator_open_mo      = $row['locator_open_mo'];
    $locator_open_tu      = $row['locator_open_tu'];
    $locator_open_we      = $row['locator_open_we'];
    $locator_open_th      = $row['locator_open_th'];
    $locator_open_fr      = $row['locator_open_fr'];
    $locator_open_sa      = $row['locator_open_sa'];
    $locator_open_su      = $row['locator_open_su'];
    $locator_open_remarks = $row['locator_open_remarks'];
	}

	$text .= "
	<form name='update_hrs' method='POST' action='".e_SELF."'>
		<center>
			<div style='width:80%'>
				<fieldset>
					<legend>
						".LOCATOR_ADMIN_HRS_04."
					</legend>";
  $text .= table_hrs($locator_id, $locator_client, $locator_open_mo, $locator_open_tu, $locator_open_we, $locator_open_th, $locator_open_fr, $locator_open_sa, $locator_open_su, $locator_open_remarks);
  $text .= "
				<br />
				<center>
          <input type='hidden' name='update_hrs' value='1'/>
          <input type='hidden' name='locator_id' value='".$locator_id."'/>
					<input class='button' type='submit' value='".LOCATOR_ADMIN_HRS_05."'/>
					&nbsp;<input class='button' type=button value='".LOCATOR_ADMIN_HRS_06."' onClick='history.go(-1)'>
				</center>
				<br />
				</fieldset>
			</div>
		</center>
	</form>";

	// Render the value of $edit_text in a table.
	$title = LOCATOR_ADMIN_HRS_07;
	$ns -> tablerender($title, $text);
	
} else {
  // --------------------------------------------------------------------------+
  // ------------------------- Overview Hours ---------------------------------+
  // --------------------------------------------------------------------------+

  // Determine if there are no locations
	if($sql -> db_Count(locator_sites) > 0) {
		$no_locations = 1;
	}

	$text .= "
  <form name='overview_hrs' method='POST' action='".e_SELF."'>
		<center>
				<fieldset>
					<legend>
						".LOCATOR_ADMIN_HRS_08."
					</legend>";
          // Show a message if there are no locations to display
					if ($no_locations == null) {
						$text .= "
						<br />
						<center>
							<span class='smalltext'>
								".LOCATOR_ADMIN_HRS_09."
							</span>
						</center>
						<br />";
					} else {
					
            // Determine if there are no locations
            $count_locations = $sql -> db_Count(DB_TABLE_LOCATOR2_TABLE);
          	if($count_locations > 0) {
          		$no_locations = 1;
          	}

						$text .= "
						<center>
              <br />
						  <table style='".ADMIN_WIDTH."' class='fborder'>
							<tr>
									<td class='fcaption'><b>".LOCATOR_ADMIN_HRS_10."</b></td>
									<td class='fcaption'><b>".LOCATOR_ADMIN_HRS_11."</b></td>
									<td class='fcaption'><b>".LOCATOR_ADMIN_HRS_12."</b></td>
									<td class='fcaption'><b>".LOCATOR_ADMIN_HRS_13."</b></td>
									<td class='fcaption'><b>".LOCATOR_ADMIN_HRS_14."</b></td>
									<td class='fcaption'><b>".LOCATOR_ADMIN_HRS_15."</b></td>
									<td class='fcaption'><b>".LOCATOR_ADMIN_HRS_16."</b></td>
									<td class='fcaption'><b>".LOCATOR_ADMIN_HRS_17."</b></td>
									<td class='fcaption'><b>".LOCATOR_ADMIN_HRS_18."</b></td>
									<td class='fcaption'><b>".LOCATOR_ADMIN_HRS_31."</b></td>
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
								  $sql -> db_Select(DB_TABLE_LOCATOR2_TABLE, "*", "ORDER BY $locator_sort_order LIMIT $loc_from, $loc_paginate_display", "no-where");
								} else { // No pages, one long list
									$sql -> db_Select(DB_TABLE_LOCATOR2_TABLE, "*", "ORDER BY $locator_sort_order", "no-where");
                }

								// While there are records available; fill the rows
								while($row = $sql-> db_Fetch()){
									$text .= "
									<tr>
										<td class='forumheader3'>".$row['locator_client']."</td>
										<td class='forumheader3'>".$row['locator_open_mo']."</td>
										<td class='forumheader3'>".$row['locator_open_tu']."</td>
										<td class='forumheader3'>".$row['locator_open_we']."</td>
										<td class='forumheader3'>".$row['locator_open_th']."</td>
										<td class='forumheader3'>".$row['locator_open_fr']."</td>
										<td class='forumheader3'>".$row['locator_open_sa']."</td>
										<td class='forumheader3'>".$row['locator_open_su']."</td>
										<td class='forumheader3'>".$row['locator_open_remarks']."</td>
										";
  										// Show the edit and delete icons
											$text .= "
										<td class='forumheader3'>
											<center>
											<a href='admin_openhrs.php?edit=".$row['locator_id']."' alt='".LOCATOR_ADMIN_HRS_19."'>".ADMIN_EDIT_ICON."</a>";

											$text .= "
											</center>
										</td>
									</tr>";
								} // End of while
								
							$text .= "
							</table>
						</center>";

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
                        $page_text .= " <a href='admin_openhrs.php?p=".$page_count."'>".LOCATOR_LOC_28." ".$page_count."</a> ".$pref['locator_divide_char'];
                      }
                    $page_count++;
                    }
                	}
                	$page_text = substr($page_text, 0, -1); // remove last string divide character from page string
                	$text .= "<center>".$page_text."</center><br />";
              }
						}

						
						$text .= "
						<br />
				</fieldset>
		</center>
	</form>
	<br />";

// Render the value of $text in a table.
$title = LOCATOR_ADMIN_HRS_00;
$ns -> tablerender($title, $text);
}

function table_hrs($locator_id, $locator_client, $locator_open_mo, $locator_open_tu, $locator_open_we, $locator_open_th, $locator_open_fr, $locator_open_sa, $locator_open_su, $locator_open_remarks) {
  $text .= "
    <table border='0' cellspacing='15' width='100%'>
    	<tr>
    		<td>
    			<b>".LOCATOR_ADMIN_HRS_21.":</b>
    		</td>
    		<td>
    			".$locator_client."
    		</td>
    	</tr>
    	<tr>
    		<td valign='top'>
    			<b>".LOCATOR_ADMIN_HRS_11.":</b>
    		</td>
    		<td>
    			<input class='tbox' size='25' type='text' name='locator_open_mo' value='".$locator_open_mo."'/>
    		</td>
    	</tr>
    	<tr>
    		<td valign='top'>
    			<b>".LOCATOR_ADMIN_HRS_12.":</b>
    		</td>
    		<td>
    			<input class='tbox' size='25' type='text' name='locator_open_tu' value='".$locator_open_tu."'/>
    		</td>
    	</tr>
    	<tr>
    		<td valign='top'>
    			<b>".LOCATOR_ADMIN_HRS_13.":</b>
    		</td>
    		<td>
    			<input class='tbox' size='25' type='text' name='locator_open_we' value='".$locator_open_we."'/>
    		</td>
    	</tr>
    	<tr>
    		<td valign='top'>
    			<b>".LOCATOR_ADMIN_HRS_14.":</b>
    		</td>
    		<td>
    			<input class='tbox' size='25' type='text' name='locator_open_th' value='".$locator_open_th."'/>
    		</td>
    	</tr>
    	<tr>
    		<td valign='top'>
    			<b>".LOCATOR_ADMIN_HRS_15.":</b>
    		</td>
    		<td>
    			<input class='tbox' size='25' type='text' name='locator_open_fr' value='".$locator_open_fr."'/>
    		</td>
    	</tr>
    	<tr>
    		<td valign='top'>
    			<b>".LOCATOR_ADMIN_HRS_16.":</b>
    		</td>
    		<td>
    			<input class='tbox' size='25' type='text' name='locator_open_sa' value='".$locator_open_sa."'/>
    		</td>
    	</tr>
    	<tr>
    		<td valign='top'>
    			<b>".LOCATOR_ADMIN_HRS_17.":</b>
    		</td>
    		<td>
    			<input class='tbox' size='25' type='text' name='locator_open_su' value='".$locator_open_su."'/>
    		</td>
    	</tr>
    	<tr>
    		<td valign='top'>
    			<b>".LOCATOR_ADMIN_HRS_18.":</b>
    		</td>
    		<td>
    			<input class='tbox' size='25' type='text' name='locator_open_remarks' value='".$locator_open_remarks."'/>
    		</td>
    	</tr>
    </table>";
  return $text;
}

require_once(e_ADMIN."footer.php");
?>
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
$pageid = 'admin_menu_02';

// Edit / Maintain existing location
if ($_GET['edit_country'] == 1) {
  // Select the single record from the database
	$sql -> db_Select(DB_TABLE_LOCATOR_COUNTRY, "*", "locator_country_id=".$_GET['locator_country_id']);
	while($row = $sql-> db_Fetch()){
	    $locator_country_id = $row['locator_country_id'];
	    $locator_country_code = $row['locator_country_code'];
    	$locator_country_descr = $row['locator_country_descr'];
    	$locator_country_status = $row['locator_country_status'];
	}
	
	$text .= "
	<br />
	<form name='good' method='POST' action='admin_countries_edit.php'>
		<center>
			<div style='width:80%'>
				<fieldset>
					<legend>
						".LOCATOR_COU_13."
					</legend>
					<table border='0' cellspacing='15' width='100%'>
						<!-- normally ID will not be shown
						<tr>
							<td>
								<b>".LOCATOR_COU_03."</b>
              </td>
							<td>
								$locator_country_id
							</td>
						</tr>
						 normally ID will not be shown -->
						<tr>
							<td>
								<b>".LOCATOR_COU_04."</b>
							</td>
							<td>
								<input class='tbox' size='25' type='text' name='locator_country_code' value='$locator_country_code' />
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_COU_05."</b>
							</td>
							<td>
								<input class='tbox' cols='25' name='locator_country_descr' value='$locator_country_descr' />
							</td>
						</tr>
            <tr>
              <td>
                <b>".LOCATOR_COU_06."</b>
              </td>
              <td>
						";

						// Display the check box for active status (active = 2)
						if ($locator_country_status == 2) {
								$text .= "
								<input type='checkbox' name='locator_country_status' value='2' checked='checked' />";
						} else {
								$text .= "
								<input type='checkbox' name='locator_country_status' value='1' />";
						}

    	      $text .= "
              </td>
            </tr>
            </table>
				<br />
				<center>
					<input type='hidden' name='locator_country_id' value='".$_GET['locator_country_id']."'>
					<input type='hidden' name='edit_country' value='2'>
					<input class='button' type='submit' value='".LOCATOR_COU_14."'>
				</center>
				<br /><br />
				</fieldset>
			</div>
		</center>
	</form>";
	
	// Render the value of $text in a table.
	$title = LOCATOR_COU_00;
	$ns -> tablerender($title, $text);
	
} else {
  // Initial screen with Maintain Countries

  // Determine if there are no categories
	if($sql -> db_Count(DB_TABLE_LOCATOR_COUNTRY) > 0) {
		$no_categories = 1;
	}

	$text .= "
	<br />
	<form name='good' method='POST' action='admin_countries_edit.php'>
		<center>
				<fieldset>
					<legend>
						".LOCATOR_COU_01."
					</legend>";
          // Show a message if there are no categories to display
					if ($no_categories == null) {
						$text .= "
						<br />
						<center>
							<span class='smalltext'>
								".LOCATOR_COU_02."
							</span>
						</center>
						<br /><br />";
					} else {
						$text .= "
						<br />
						<center>
						  <table style='".ADMIN_WIDTH."' class='fborder'>
							<tr>
									<!-- <td class='fcaption'><center><b>".LOCATOR_COU_03."</b></center></td> -->
									<td class='fcaption'><b>".LOCATOR_COU_04."</b></td>
                  <td class='fcaption'><b>".LOCATOR_COU_05."</b></td>
                  <td class='fcaption'><center><b>".LOCATOR_COU_06."</b></center></td>
                  <td class='fcaption'><center><b>".LOCATOR_COU_07."</b></center></td>
      				</tr>";
								// While there are records available; fill the rows to display them all in the country_descr order
								$sql -> db_Select(DB_TABLE_LOCATOR_COUNTRY, "*", "ORDER BY locator_country_descr", "no-where");
								while($row = $sql-> db_Fetch()){
									$text .= "
									<tr>
                    <!-- <td class='forumheader3'><center>".$row['locator_country_id']."</center></td> -->
										<td class='forumheader3'>".$row['locator_country_code']."</td>
                    <td class='forumheader3'>".$row['locator_country_descr']."</td>
										<td class='forumheader3'>
											<center>
                      ";
										// Display the check box for active status (active = 2)
										if ($row['locator_country_status'] == 2) {
												$text .= "
												<input type='checkbox' name='locator_country_status[]' value='".$row['locator_country_id']."' checked='checked' />";
										} else {
												$text .= "
												<input type='checkbox' name='locator_country_status[]' value='".$row['locator_country_id']."' />";
										}

										// Show the edit and delete icons
										$text .= "
										</center>
										</td>
										<td class='forumheader3'>
                      <center>
											<a href='admin_countries.php?edit_country=1&locator_country_id=".$row['locator_country_id']."' alt='".LOCATOR_COU_08."'>".ADMIN_EDIT_ICON."</a>
                      &nbsp;
											<a href='admin_countries_edit.php?delete_country=1&locator_country_id=".$row['locator_country_id']."' alt='".LOCATOR_COU_09."'>".ADMIN_DELETE_ICON."</a>
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
							<input class='button' type='submit' value='".LOCATOR_COU_10."'>
						</center>
						<br />";
					}
				$text .= "
				</fieldset>
		</center>
	</form>
	<br />";
	// Display the Create New Category form
	$text .= "
	<form name='good' method='POST' action='admin_countries_edit.php'>
		<center>
			<div style='width:80%'>
				<fieldset>
					<legend>
						".LOCATOR_COU_11."
					</legend>
					<table border='0' cellspacing='15' width='100%'>
						<tr>
							<td>
								<b>".LOCATOR_COU_04."</b>
							</td>
							<td>
								<input class='tbox' size='25' type='text' name='locator_country_code'>
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_COU_05."</b>
							</td>
							<td>
								<input class='tbox' size='25' type='text' name='locator_country_descr'><br />
							</td>
						</tr>
            <tr>
              <td>
                <b>".LOCATOR_COU_06."</b>
              </td>
              <td>
                <input type='checkbox' name='locator_country_status' value='1' />
              </td>
            </tr>
 					</table>
   				<br />
  				<center>
  					<input type='hidden' name='create_country' value='1'>
  					<input class='button' type='submit' value='".LOCATOR_COU_12."'>
  				</center>
  				<br />
  				</fieldset>
  			</div>
  		</center>
  	</form>";

	// Render the value of $text in a table.
	$title = LOCATOR_COU_00;
	$ns -> tablerender($title, $text);
}

require_once(e_ADMIN."footer.php");
?>
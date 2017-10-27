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

// Include define tables info
require_once("includes/config.php");

// Set the active menu option for admin_menu.php
$pageid = 'admin_menu_03';

// Edit / Maintain existing category
if ($_GET['edit_category'] == 1) {
  // Select the single record from the database
	$sql -> db_Select(DB_TABLE_LOCATOR_TABLE, "*", "locator_cat_id=".$_GET['locator_cat_id']);
	while($row = $sql-> db_Fetch()){
	    $locator_cat_id = $row['locator_cat_id'];
	    $locator_catname = $row['locator_catname'];
    	$locator_image_path = $row['locator_image_path'];
    	$locator_test_01 = $row['locator_test_01'];
    	$locator_test_02 = $row['locator_test_02'];
    	$locator_test_03 = $row['locator_test_03'];
    	$locator_test_04 = $row['locator_test_04'];
    	$locator_test_integer = $row['locator_test_integer'];
    	$locator_catorder = $row['locator_catorder'];
    	$locator_catactive_status = $row['locator_catactive_status'];
    	$locator_cat_class = $row['locator_cat_class'];
	}
	
	$text .= "
	<br />
	<form name='good' method='POST' action='admin_categories_edit.php'>
		<center>
			<div style='width:80%'>
				<fieldset>
					<legend>
						".LOCATOR_CAT_17."
					</legend>
					<table border='0' cellspacing='15' width='100%'>
						<!-- normally ID will not be shown
						<tr>
							<td>
								<b>".LOCATOR_CAT_04."</b>
              </td>
							<td>
								$locator_cat_id
							</td>
						</tr>
						normally ID will not be shown -->
						<tr>
							<td>
								<b>".LOCATOR_CAT_05."</b>
							</td>
							<td>
								<input class='tbox' size='25' type='text' name='locator_catname' value='$locator_catname' />
							</td>
						</tr>
            <tr>
              <td>
                <b>".LOCATOR_CAT_15."</b>
              </td>
              <td>
						";

						// Display the check box for active status (active = 2)
						if ($locator_catactive_status == 2) {
								$text .= "
								<input type='checkbox' name='locator_catactive_status' value='2' checked='checked' />";
						} else {
								$text .= "
								<input type='checkbox' name='locator_catactive_status' value='1' />";
						}

    	      $text .= "
              </td>
            </tr>
						<!-- not currently used
						<tr>
							<td valign='top'>
								<b>".LOCATOR_CAT_06."</b>
							</td>
							<td>
								<input class='tbox' cols='25' name='locator_image_path' value='$locator_image_path' />
                <br />
								<img src='".e_IMAGE."admin_images/docs_16.png' title='' alt='' /> ".LOCATOR_CAT_07."
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_CAT_08."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='locator_test_01' value='$locator_test_01' />
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_CAT_09."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='locator_test_02' value='$locator_test_02' />
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_CAT_10."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='locator_test_03' value='$locator_test_03' />
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_CAT_11."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='locator_test_04' value='$locator_test_04' />
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_CAT_12."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='locator_test_integer' value='$locator_test_integer' />
							</td>
						</tr>
						not currently used -->

      			<tr>
              <td valign='top'>
      						<b>".LOCATOR_CAT_20."</b>
      				</td>
              <td valign='top'>
      					".r_userclass("locator_cat_class", $locator_cat_class, "off", "public,guest,member,nobody,main,admin,classes")."
      				</td>
       			</tr>
						
					</table>
				<br />
				<center>
					<input type='hidden' name='locator_cat_id' value='".$_GET['locator_cat_id']."'>
					<input type='hidden' name='edit_category' value='2'>
					<input class='button' type='submit' value='".LOCATOR_CAT_13."'>
					<input class='button' type=button value='".LOCATOR_CAT_21."' onClick='history.go(-1)'>
				</center>
				<br /><br />

				</fieldset>
			</div>
		</center>
	</form>";
	
	// Render the value of $text in a table.
	$title = LOCATOR_CAT_00;
	$ns -> tablerender($title, $text);
	
} else {
  // Initial screen with Overview Categories

  // Determine if there are no categories
	if($sql -> db_Count(DB_TABLE_LOCATOR_TABLE) > 0) {
		$no_categories = 1;
	}

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
	  $locator_catactive_status = $row['locator_catactive_status'];
   	$locator_cat_class = $row['locator_cat_class'];
	}
	
	$text .= "
	<br />
	<form name='good' method='POST' action='admin_categories_edit.php'>
		<center>
				<fieldset>
					<legend>
						".LOCATOR_CAT_01."
					</legend>";
          // Show a message if there are no categories to display
					if ($no_categories == null) {
						$text .= "
						<br />
						<center>
							<span class='smalltext'>
								".LOCATOR_CAT_02."
							</span>
						</center>
						<br /><br />";
					} else {
						$text .= "
						<br />
						<center>
						  <table style='".ADMIN_WIDTH."' class='fborder'>
							<tr>
									<!-- <td class='fcaption'><b>".LOCATOR_CAT_04."</b></td> -->
									<td class='fcaption'><b>".LOCATOR_CAT_05."</b></td>
									<td class='fcaption'><center><b>".LOCATOR_CAT_14."</b></center></td>
									<td class='fcaption'><center><b>".LOCATOR_CAT_15."</b></center></td>
									<td class='fcaption'><b>".LOCATOR_CAT_22."</b></td>
									<td class='fcaption'><center><b>".LOCATOR_CAT_16."</b></center></td>
							</tr>";
								// While there are records available; fill the rows to display them all in the userdefined order
								$sql -> db_Select(DB_TABLE_LOCATOR_TABLE, "*", "ORDER BY locator_catorder", "no-where");
								while($row = $sql-> db_Fetch()){
									$text .= "
									<tr>
                    <!-- <td class='forumheader3'><center>".$row['locator_cat_id']."</center></td> -->
										<td class='forumheader3'>".$row['locator_catname']."</td>
										<td class='forumheader3'>
											<center>
                        <select class='tbox' name='locator_catorder[]'>";
						            // Second query to build the selection list with order numbers
						            $sql2 = new db;
						            $num_rows = $sql2 -> db_Count(DB_TABLE_LOCATOR_TABLE, "(*)");
						            $count = 1;
						            while ($count <= $num_rows) {
						              if ($row['locator_catorder'] == $count) {
						                $text .= "
						                <option value='".$row['locator_cat_id']."~".$count."' selected='selected'>".$count."</option>";
						               } else {
						                $text .= "
						               <option value='".$row['locator_cat_id']."~".$count."'>".$count."</option>";
						               }
						               $count++;
						              }
						              $text .= "</select>";

                    $text .= "
                       </center>
									 	</td>
										<td class='forumheader3'>
											<center>";
										// Display the check box for active status (active = 2)
										if ($row['locator_catactive_status'] == 2) {
												$text .= "
												<input type='checkbox' name='locator_catactive_status[]' value='".$row['locator_cat_id']."' checked='checked' />";
										} else {
												$text .= "
												<input type='checkbox' name='locator_catactive_status[]' value='".$row['locator_cat_id']."' />";
										}
										// Show class description
										$text .= "<td class='forumheader3'>".r_userclass_name($row['locator_cat_class'])."</td>";
										// Show the edit and delete icons
										$text .= "
										</center>
										</td>
										<td class='forumheader3'>
                      <center>
											<a href='admin_categories.php?edit_category=1&locator_cat_id=".$row['locator_cat_id']."' alt='".LOCATOR_CAT_18."'>".ADMIN_EDIT_ICON."</a>
                      &nbsp;
											<a href='admin_categories_edit.php?delete_category=1&locator_cat_id=".$row['locator_cat_id']."' alt='".LOCATOR_CAT_19."'>".ADMIN_DELETE_ICON."</a>
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
							<input class='button' type='submit' value='".LOCATOR_CAT_13."'>
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
	<form name='good' method='POST' action='admin_categories_edit.php'>
		<center>
			<div style='width:80%'>
				<fieldset>
					<legend>
						".LOCATOR_CAT_03."
					</legend>
					<table border='0' cellspacing='15' width='100%'>
						<tr>
							<td>
								<b>".LOCATOR_CAT_05."</b>
							</td>
							<td>
								<input class='tbox' size='25' type='text' name='locator_catname'>
							</td>
						</tr>
            <tr>
              <td>
                <b>".LOCATOR_CAT_15."</b>
              </td>
              <td>
                <input type='checkbox' name='locator_catactive_status' value='1' />
              </td>
            </tr>
						<!-- currently not used
						<tr>
							<td valign='top'>
								<b>".LOCATOR_CAT_06."</b>
							</td>
							<td>
								<input class='tbox' size='25' type='text' name='locator_image_path'><br />
								<img src='".e_IMAGE."admin_images/docs_16.png' title='' alt='' /> ".LOCATOR_CAT_07."
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_CAT_08."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='locator_test_01'>
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_CAT_09."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='locator_test_02'>
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_CAT_10."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='locator_test_03'>
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_CAT_11."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='locator_test_04'>
							</td>
						</tr>
						<tr>
							<td valign='top'>
								<b>".LOCATOR_CAT_12."</b>
							</td>
							<td valign='top'>
								<input class='tbox' size='25' type='text' name='locator_test_integer'>
							</td>
						</tr>
						currently not used -->

      			<tr>
              <td valign='top'>
      						<b>".LOCATOR_CAT_20."</b>
      				</td>
              <td valign='top'>
      					".r_userclass("locator_cat_class", $locator_cat_class, "off", "public,guest,member,nobody,main,admin,classes")."
      				</td>
       			</tr>

					</table>
				<br />
				<center>
					<input type='hidden' name='create_category' value='1'>
					<input class='button' type='submit' value='".LOCATOR_CAT_03."'>
				</center>
				<br />
				</fieldset>
			</div>
		</center>
	</form>";

	// Render the value of $text in a table.
	$title = LOCATOR_CAT_00;
	$ns -> tablerender($title, $text);
}

require_once(e_ADMIN."footer.php");
?>
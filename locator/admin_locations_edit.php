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

require_once("../../class2.php");
require_once(e_HANDLER."userclass_class.php");
require_once(e_ADMIN."auth.php");
require_once("includes/config.php");

if(!getperms("P")){ header("location:".e_BASE."index.php"); }

function tokenizeArray($array) {
// used in change location order
    unset($GLOBALS['tokens']);
    $delims = "~";
    $word = strtok( $array, $delims );
    while ( is_string( $word ) ) {
        if ( $word ) {
            global $tokens;
            $tokens[] = $word;
        }
        $word = strtok ( $delims );
    }
}

// Check query
if(e_QUERY){
	$tmp = explode("=", e_QUERY);
	$action = $tmp[0];
	$action_id = $tmp[1];
	unset($tmp);
}

if ($_POST['create_location'] == '1' || $action == 'appr') {
    // Create new location from admin_locations new program or the approve mode from submitted locations
    // admin_locations.php new form: When checkbox is checked the variable will be passed by the form
    if ($action != 'appr') {
      if (isset($_POST['locator_active_status'])) {
          $locator_active_status = 2;
      } else {
          $locator_active_status = 1;
      }
    } else { // correct locator_active_status is already set by approve mode
      $locator_active_status = $_POST['locator_active_status'];
    }
    $sql -> db_Insert(DB_TABLE_LOCATOR2_TABLE,
    "0,
		'".$tp->toDB($_POST['locator_client'])."',
		'".$tp->toDB($_POST['locator_address1'])."',
		'".$tp->toDB($_POST['locator_address2'])."',
		'".$tp->toDB($_POST['locator_address3'])."',
		'".$tp->toDB($_POST['locator_zipcode'])."',
		'".$tp->toDB($_POST['locator_city'])."',
		'".$tp->toDB($_POST['locator_county'])."',
		'".$tp->toDB($_POST['locator_state'])."',
		'".$tp->toDB($_POST['locator_country'])."',
		'".$tp->toDB($_POST['locator_sitename'])."',
		'".$tp->toDB($_POST['locator_manager1'])."',
		'".$tp->toDB($_POST['locator_manager2'])."',
		'".$tp->toDB($_POST['locator_telephone1'])."',
		'".$tp->toDB($_POST['locator_telephone2'])."',
		'".$tp->toDB($_POST['locator_fax1'])."',
		'".$tp->toDB($_POST['locator_fax2'])."',
		'".$tp->toDB($_POST['locator_email1'])."',
		'".$tp->toDB($_POST['locator_email2'])."',
		'".$tp->toDB($_POST['locator_latitude'])."',
		'".$tp->toDB($_POST['locator_longtitude'])."',
		'".$tp->toDB($_POST['locator_groundelevation'])."',
		'".$tp->toDB($_POST['locator_verified'])."',
		'".$tp->toDB($_POST['locator_cat'])."',
		'".$tp->toDB($_POST['locator_status'])."',
		'".$tp->toDB($_POST['locator_description1'])."',
		'".$tp->toDB($_POST['locator_description2'])."',
		'".$tp->toDB($_POST['locator_url1'])."',
		'".$tp->toDB($_POST['locator_url2'])."',
		'".$tp->toDB($_POST['locator_catid'])."',
		1,
		$locator_active_status,
		'".$tp->toDB($_POST['locator_open_mo'])."',
		'".$tp->toDB($_POST['locator_open_tu'])."',
		'".$tp->toDB($_POST['locator_open_we'])."',
		'".$tp->toDB($_POST['locator_open_th'])."',
		'".$tp->toDB($_POST['locator_open_fr'])."',
		'".$tp->toDB($_POST['locator_open_sa'])."',
		'".$tp->toDB($_POST['locator_open_su'])."',
		'".$tp->toDB($_POST['locator_open_remarks'])."'") or die(mysql_error());
    if ($action == 'appr') { // Update approve record to verified 2 and return to the admin_locations approve mode
      $sql5 = new db;
      $sql5 -> db_Update('locator_sub_sites', "locator_sub_verified=2 WHERE locator_sub_id='".$tp->toDB($_POST['locator_sub_id'])."'");
      header("Location: admin_locations.php?approve");
    } else { // Return to the normal admin_locations applications
      header("Location: admin_locations.php");
    }
    //exit;

}   else if ($_POST['change_order'] == '1') {
    // Change location order
    for ($x = 0; $x < count($_POST['locator_order']); $x++) {
        tokenizeArray($_POST['locator_order'][$x]);
        $newCategoryOrderArray[$x] = $tokens;
    }
    for ($x = 0; $x < count($newCategoryOrderArray); $x++) {
        $sql -> db_Update(DB_TABLE_LOCATOR2_TABLE,
            "locator_order=".$tp->toDB($newCategoryOrderArray[$x][1])."
            WHERE locator_id=".$tp->toDB($newCategoryOrderArray[$x][0]));
    }

    // Change location active status, too
    foreach ($_POST['locator_active_status'] as $value) {
		$sql -> db_Update(DB_TABLE_LOCATOR2_TABLE, "locator_active_status=1 WHERE locator_id=".$tp->toDB($value));  // defaults every given location back to status 1
	}
    foreach ($_POST['locator_active_status'] as $value) {
    	$sql -> db_Update(DB_TABLE_LOCATOR2_TABLE,
            " locator_active_status=2
            WHERE locator_id=".$tp->toDB($value)); // set the ones with status 2
    }
    
    // Go back to the calling application admin_locations.php
    header("Location: admin_locations.php");
    exit;

} else if ($_POST['edit_location'] == '2') {
    // When checkbox is checked the variable will be passed by the form
    if (isset($_POST['locator_active_status']))
    {
        $locator_active_status = 2;
    } else
    {
        $locator_active_status = 1;
    }
    // Edit location: change an existing record
    $sql -> db_Update(DB_TABLE_LOCATOR2_TABLE,
    "locator_client='".$tp->toDB($_POST['locator_client'])."',
		locator_address1='".$tp->toDB($_POST['locator_address1'])."',
		locator_zipcode='".$tp->toDB($_POST['locator_zipcode'])."',
		locator_city='".$tp->toDB($_POST['locator_city'])."',
		locator_country='".$tp->toDB($_POST['locator_country'])."',
		locator_status='".$tp->toDB($_POST['locator_status'])."',
		locator_telephone1='".$tp->toDB($_POST['locator_telephone1'])."',
		locator_fax1='".$tp->toDB($_POST['locator_fax1'])."',
		locator_url1='".$tp->toDB($_POST['locator_url1'])."',
		locator_catid='".$tp->toDB($_POST['locator_catid'])."',
		locator_description1='".$tp->toDB($_POST['locator_description1'])."',
		locator_latitude='".$tp->toDB($_POST['locator_latitude'])."',
		locator_longtitude='".$tp->toDB($_POST['locator_longtitude'])."',
		locator_active_status='".$tp->toDB($locator_active_status)."'
		WHERE locator_id=".$tp->toDB($_POST['locator_id']));
    // Go back to the calling application admin_locations.php
    if ($_POST['action_id'] > 0 OR $_POST['action_id'] <> "") {
      $goto_page_id = $_POST['action_id'];
    } else {
      $goto_page_id = 1;
    }
    // $goto_page_id = intval(($_POST['locator_id']-1)/$pref['locator_paginate_display'])+1; // Determine the page to return to
    header("Location: admin_locations.php?p=".$goto_page_id);
    exit;

} else if ($_GET['delete_location'] == '1') {
	// Delete location, step 1
  // Verify the deletion before actually throwing the record away
  // If a user answers yes, the delete_location is set to value 2
    $text = "
    <br /><br />
    <center>
        ".LOCATOR_LOCEDIT_02."
        <br /><br />
        <table width='100'>
            <tr>
                <td>
                    <a href='admin_locations_edit.php?delete_location=2&locator_id=".$_GET['locator_id']."'>".LOCATOR_LOCEDIT_03."</a>
                </td>
                <td>
                    <a href='admin_locations.php'>".LOCATOR_LOCEDIT_04."</a>
                </td>
            </tr>
        </table>
    </center>";

    // Render the value of $text in a table.
    $title = LOCATOR_LOCEDIT_01;
    $ns -> tablerender($title, $text);

} else if ($_GET['delete_location'] == '2') {
  // Delete location, step 2
  // Actual delete action from category record from the table
	$categoryId = mysql_real_escape_string($_GET['locator_id']);
  $sql -> db_Delete(DB_TABLE_LOCATOR2_TABLE,
        "locator_id=$categoryId");
    // Go back to the calling application admin_locations.php
    header("Location: admin_locations.php");
    exit;
}

require_once(e_ADMIN."footer.php");
?>
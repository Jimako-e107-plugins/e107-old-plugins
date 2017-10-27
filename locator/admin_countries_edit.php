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

if ($_POST['create_country'] == '1') {
    // Create new country
    if (isset($_POST['locator_country_status']))
    {
        $countryactive_status = 2;
    } else
    {
        $countryactive_status = 1;
    }
    $sql -> db_Insert(DB_TABLE_LOCATOR_COUNTRY,
    "0,
		'".$tp->toDB($_POST['locator_country_code'])."',
		'".$tp->toDB($_POST['locator_country_descr'])."',
		'".$tp->toDB($countryactive_status)."'") or die(mysql_error());
    header("Location: admin_countries.php");
    exit;

}
    else if ($_POST['change_order'] == '1') {
    // Change country active status
    $sql -> db_Update(DB_TABLE_LOCATOR_COUNTRY,
        "locator_country_status=1");
    foreach ($_POST['locator_country_status'] as $value) {
    	$sql -> db_Update(DB_TABLE_LOCATOR_COUNTRY,
            " locator_country_status=2
            WHERE locator_country_id=".$tp->toDB($value));
    }

    // Go back to the calling application admin_countries.php
    header("Location: admin_countries.php");
    exit;

} else if ($_POST['edit_country'] == '2') {
    // Edit country: change an existing record
    if (isset($_POST['locator_country_status']))
    {
        $countryactive_status = 2;
    } else
    {
        $countryactive_status = 1;
    }
    $sql -> db_Update(DB_TABLE_LOCATOR_COUNTRY,
    "locator_country_code='".$tp->toDB($_POST['locator_country_code'])."',
		locator_country_descr='".$tp->toDB($_POST['locator_country_descr'])."',
		locator_country_status='".$tp->toDB($countryactive_status)."'
		WHERE locator_country_id=".$tp->toDB($_POST['locator_country_id']));
    // Go back to the calling application admin_countries.php
    header("Location: admin_countries.php");
    exit;

} else if ($_GET['delete_country'] == '1') {
	// Delete country, step 1
  // Verify the deletion before actually throwing the record away
  // If a user answers yes, the delete_location is set to value 2
    $text = "
    <br /><br />
    <center>
        ".LOCATOR_COUEDIT_02."
        <br /><br />
        <table width='100'>
            <tr>
                <td>
                    <a href='admin_countries_edit.php?delete_country=2&locator_country_id=".$_GET['locator_country_id']."'>".LOCATOR_COUEDIT_03."</a>
                </td>
                <td>
                    <a href='admin_countries.php'>".LOCATOR_COUEDIT_04."</a>
                </td>
            </tr>
        </table>
    </center>";

    // Render the value of $text in a table.
    $title = LOCATOR_COUEDIT_01;
    $ns -> tablerender($title, $text);

} else if ($_GET['delete_country'] == '2') {
  // Delete country, step 2
  // Actual delete action from country record from the table
	$countryId = mysql_real_escape_string($_GET['locator_country_id']);
  $sql -> db_Delete(DB_TABLE_LOCATOR_COUNTRY, "locator_country_id=$countryId");
    // Go back to the calling application admin_countries.php
    header("Location: admin_countries.php");
    exit;
}

require_once(e_ADMIN."footer.php");
?>
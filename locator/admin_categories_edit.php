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

require_once("../../class2.php");
require_once(e_HANDLER."userclass_class.php");
require_once(e_ADMIN."auth.php");
require_once("includes/config.php");

if(!getperms("P")){ header("location:".e_BASE."index.php"); }

function tokenizeArray($array) {
// used in change category order
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

if ($_POST['create_category'] == '1') {
    // If checkbox is checked the status will be received from the form
    if (isset($_POST['locator_catactive_status']))
    {
        $catactive_status = 2;
    } else
    {
        $catactive_status = 1;
    }
    
    // Create new category
    $sql -> db_Insert(DB_TABLE_LOCATOR_TABLE,
    "0,
		'".$tp->toDB($_POST['locator_catname'])."',
		'".$tp->toDB($_POST['locator_image_path'])."',
		'".$tp->toDB($_POST['locator_test_01'])."',
		'".$tp->toDB($_POST['locator_test_02'])."',
		'".$tp->toDB($_POST['locator_test_03'])."',
		'".$tp->toDB($_POST['locator_test_04'])."',
		'".intval($tp->toDB($_POST['locator_test_integer']))."',
		'".$tp->toDB($catactive_status)."',
		1,
    '".intval($tp->toDB($_POST['locator_cat_class']))."'") or die(mysql_error());
    header("Location: admin_categories.php");
    exit;

}   else if ($_POST['change_order'] == '1') {
    // Change category order
    for ($x = 0; $x < count($_POST['locator_catorder']); $x++) {
        tokenizeArray($_POST['locator_catorder'][$x]);
        $newCategoryOrderArray[$x] = $tokens;
    }
    for ($x = 0; $x < count($newCategoryOrderArray); $x++) {
        $sql -> db_Update(DB_TABLE_LOCATOR_TABLE,
            "locator_catorder=".$tp->toDB($newCategoryOrderArray[$x][1])."
            WHERE locator_cat_id=".$tp->toDB($newCategoryOrderArray[$x][0]));
    }

    // Change category active status, too
    $sql -> db_Update(DB_TABLE_LOCATOR_TABLE,
     "locator_catactive_status=1");
    foreach ($_POST['locator_catactive_status'] as $value) {
    	$sql -> db_Update(DB_TABLE_LOCATOR_TABLE, 
    	" locator_catactive_status=2
    	 WHERE locator_cat_id=".$tp->toDB($value));
    }

    // Go back to the calling application admin_categories.php
    header("Location: admin_categories.php");
    exit;

} else if ($_POST['edit_category'] == '2') {
    // Edit category: change an existing record
    if (isset($_POST['locator_catactive_status']))
    {
        $catactive_status = 2;
    } else
    {
        $catactive_status = 1;
    }
    $sql -> db_Update(DB_TABLE_LOCATOR_TABLE,
    "locator_catname='".$tp->toDB($_POST['locator_catname'])."',
		locator_image_path='".$tp->toDB($_POST['locator_image_path'])."',
		locator_test_01='".$tp->toDB($_POST['locator_test_01'])."',
		locator_test_02='".$tp->toDB($_POST['locator_test_02'])."',
		locator_test_03='".$tp->toDB($_POST['locator_test_03'])."',
		locator_test_04='".$tp->toDB($_POST['locator_test_04'])."',
		locator_test_integer='".intval($tp->toDB($_POST['locator_test_integer']))."',
		locator_catactive_status='".$tp->toDB($catactive_status)."',
		locator_cat_class='".intval($tp->toDB($_POST['locator_cat_class']))."'
		WHERE locator_cat_id=".$tp->toDB($_POST['locator_cat_id']));
    // Go back to the calling application admin_categories.php
    header("Location: admin_categories.php");
    exit;

} else if ($_GET['delete_category'] == '1') {
	// Delete category, step 1
  // Verify the deletion before actually throwing the record away
  // If a user answers yes, the delete_category is set to value 2
    $text = "
    <br /><br />
    <center>
        ".LOCATOR_CATEDIT_02."
        <br /><br />
        <table width='100'>
            <tr>
                <td>
                    <a href='admin_categories_edit.php?delete_category=2&locator_cat_id=".$_GET['locator_cat_id']."'>".LOCATOR_CATEDIT_03."</a>
                </td>
                <td>
                    <a href='admin_categories.php'>".LOCATOR_CATEDIT_04."</a>
                </td>
            </tr>
        </table>
    </center>";

    // Render the value of $text in a table.
    $title = LOCATOR_CATEDIT_01;
    $ns -> tablerender($title, $text);

} else if ($_GET['delete_category'] == '2') {
  // Delete category, step 2
  // Actual delete action from category record from the table
	$categoryId = mysql_real_escape_string($_GET['locator_cat_id']);
  $sql -> db_Delete(DB_TABLE_LOCATOR_TABLE,
        "locator_cat_id=$categoryId");
    // Go back to the calling application admin_categories.php
    header("Location: admin_categories.php");
    exit;
}

require_once(e_ADMIN."footer.php");
?>
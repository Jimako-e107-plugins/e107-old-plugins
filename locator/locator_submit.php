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
require_once(HEADERF);
require_once("includes/config.php");

// Get language file (assume that the English language file is always present)
$lan_file = e_PLUGIN."locator/languages/".e_LANGUAGE.".php";
include_lan($lan_file);

// Check if user is allowed to be in this program
if(!check_class($pref['locator_submit_class'])) {
  header("location:" . e_BASE . "index.php");
  exit;
}

$author_name = $tp->toDB($_POST['author_name']);
$author_email = $tp->toDB(check_email($_POST['author_email']));

if (isset($_POST['submit'])) {
  $user = (USER ? USERNAME : $author_name);
  $email = (USER ? USEREMAIL : $author_email);

  if ($user && $email) {
    $ip = $e107->getip();
    $fp = new floodprotect;

    if ($fp->flood("locator", "submitlocator_datestamp") == false) {
      header("location:" . e_BASE . "index.php");
      exit;
    }

    // Gather all the posted values
    $locator_client       = $tp->toDB($_POST['locator_client']);
		$locator_address1     = $tp->toDB($_POST['locator_address1']);
		$locator_zipcode      = $tp->toDB($_POST['locator_zipcode']);
		$locator_city         = $tp->toDB($_POST['locator_city']);
		$locator_country      = $tp->toDB($_POST['locator_country']);
		$locator_status       = $tp->toDB($_POST['locator_status']);
		$locator_telephone1   = $tp->toDB($_POST['locator_telephone1']);
		$locator_fax1         = $tp->toDB($_POST['locator_fax1']);
		$locator_url1         = $tp->toDB($_POST['locator_url1']);
		$locator_catid        = $tp->toDB($_POST['locator_catid']);
		$locator_description1 = $tp->toDB($_POST['locator_description1']);
		$locator_latitude     = $tp->toDB($_POST['locator_latitude']);
		$locator_longtitude   = $tp->toDB($_POST['locator_longtitude']);
    // When checkbox is checked the variable will be passed by the form
		if (isset($_POST['locator_active_status'])) {
        $locator_active_status = 2;
    } else {
        $locator_active_status = 1;
    }
    
    if ($error == false) {
      $sql->db_Insert("locator_sub_sites", "0, '$locator_client', '$locator_address1', NULL, NULL, '$locator_zipcode', '$locator_city', '', NULL, '$locator_country', NULL, NULL, NULL, '$locator_telephone1', NULL, '$locator_fax1', NULL, NULL, NULL, '$locator_latitude', '$locator_longtitude', NULL, NULL, '', '$locator_status', '$locator_description1', NULL, '$locator_url1', NULL, $locator_catid, NULL, '$locator_active_status', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '".time()."', '$ip', 1, '$user', '$email'");
      // submit notification
      // $edata_sn = array("user" => $user, "email" => $email, "itemtitle" => $itemtitle, "catid" => intval($_POST['cat_id']), "item" => $item, "ip" => $ip, "newname" => $newname);
      // event log for admin
      // $e_event->trigger("sublocator", $edata_sn);
      $ns->tablerender(LOCATOR_SUBM_05, "<div style='text-align:center'>".LOCATOR_SUBM_06."<br /><br /><a href='".e_PLUGIN."locator/locator.php'>".LOCATOR_SUBM_08."</a></div>");
      require_once(FOOTERF);
      exit;
    }
    else {
      require_once(e_HANDLER . "message_handler.php");
      message_handler("P_ALERT", $message);
    }
  }
}

if (!defined("USER_WIDTH")){ define("USER_WIDTH","width:95%"); }
$text = "<div style='text-align:center'>
	<form id='dataform' method='post' action='".e_SELF."' enctype='multipart/form-data' onsubmit='return frmVerify()'>\n
	<table style='".USER_WIDTH."' class='fborder'>";
// Ask for user credentials when user not logged in
if (!USER) {
  $text .= "
  <tr>\n
    <td style='width:20%' class='forumheader3'>".LOCATOR_SUBM_03."</td>\n
    <td style='width:80%' class='forumheader3'>\n
    <input class='tbox' type='text' name='author_name' size='60' value='$author_name' maxlength='100' />\n
    </td>\n
  </tr>\n
  <tr>\n
    <td style='width:20%' class='forumheader3'>".LOCATOR_SUBM_04."</td>\n
    <td style='width:80%' class='forumheader3'>\n
    <input class='tbox' type='text' name='author_email' size='60' value='$author_email' maxlength='100' />\n
    </td>\n
  </tr>";
}

$text .= "
  	<tr>
      <td style='width:20%' class='forumheader3'>
  			".LOCATOR_LOC_05."
  		</td>
      <td style='width:80%' class='forumheader3'>
  			<input class='tbox' size='25' type='text' id='locator_client' name='locator_client' value='$locator_client' />
  		</td>
  	</tr>
  	<tr>
     <td style='width:20%' class='forumheader3'>
  			".LOCATOR_LOC_06."
  		</td>
  		<td style='width:80%' class='forumheader3'>
  			<input class='tbox' cols='25' name='locator_address1' value='$locator_address1' />
  		</td>
  	</tr>
  	<tr>
      <td style='width:20%' class='forumheader3'>
  			".LOCATOR_LOC_08."
  		</td>
  		<td style='width:80%' class='forumheader3'>
  			<input class='tbox' size='25' type='text' name='locator_zipcode' value='$locator_zipcode' />
  		</td>
  	</tr>
  	<tr>
      <td style='width:20%' class='forumheader3'>
  			".LOCATOR_LOC_09."
  		</td>
      <td style='width:80%' class='forumheader3'>
  			<input class='tbox' size='25' type='text' name='locator_city' value='$locator_city' />
  		</td>
  	</tr>
  	<tr>
      <td style='width:20%' class='forumheader3'>
  			".LOCATOR_LOC_21."
  		</td>
      <td style='width:80%' class='forumheader3'>
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
      <td style='width:20%' class='forumheader3'>
  			".LOCATOR_LOC_10."
  		</td>
      <td style='width:80%' class='forumheader3'>
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
      <td style='width:20%' class='forumheader3'>
  			".LOCATOR_LOC_11."
  		</td>
      <td style='width:80%' class='forumheader3'>
  			<input class='tbox' size='25' type='text' name='locator_telephone1' value='$locator_telephone1' />
  		</td>
  	</tr>
  	<tr>
      <td style='width:20%' class='forumheader3'>
  			".LOCATOR_LOC_12."
  		</td>
      <td style='width:80%' class='forumheader3'>
  			<input class='tbox' size='25' type='text' name='locator_fax1' value='$locator_fax1' />
  		</td>
  	</tr>
  	<tr>
      <td style='width:20%' class='forumheader3'>
  			".LOCATOR_LOC_20."
  		</td>
      <td style='width:80%' class='forumheader3'>
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
      <td style='width:20%' class='forumheader3'>
  			".LOCATOR_LOC_22."
      </td>
      <td style='width:80%' class='forumheader3'>
  			<input class='tbox' size='25' type='text' name='locator_url1' value='$locator_url1' />
      </td>
    </tr>
    ";

   if ($pref['locator_map_info_window_extra_text'] == '1') { // Setting extra info window line is Yes
    $text .= "
  			<tr>
          <td style='width:20%' class='forumheader3'>
  					".LOCATOR_LOC_25."
  				</td>
          <td style='width:80%' class='forumheader3'>
  					<input class='tbox' size='25' name='locator_description1' value='$locator_description1' />
  				</td>
  			</tr>
  			";
   } // End of extra info window line input


  if ($pref['locator_input_coordinates'] == '1') { // Setting input coordinates is Yes
    $text .= "
  			<tr>
          <td style='width:20%' class='forumheader3'>
  					".LOCATOR_LOC_26."
  				</td>
          <td style='width:80%' class='forumheader3'>
  					<input class='tbox' size='25' name='locator_latitude' value='$locator_latitude' />
  				</td>
  			</tr>
  			<tr>
          <td style='width:20%' class='forumheader3'>
  					".LOCATOR_LOC_27."
  				</td>
          <td style='width:80%' class='forumheader3'>
  					<input class='tbox' size='25' name='locator_longtitude' value='$locator_longtitude' />
  				</td>
  			</tr>
  			";
  } // End of extra input coordinates

    $text .= "
    <tr>
      <td style='width:20%' class='forumheader3'>
        ".LOCATOR_LOC_15."
      </td>
      <td style='width:80%' class='forumheader3'>
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
    </tr>";

$text .= "
	<tr>
    <td colspan='2' style='text-align:center' class='forumheader'>
      <input class='button' type='submit' name='submit' value='".LOCATOR_SUBM_02."' />
    </td>
	</tr>
	</table>
	</form>
	</div>";
$ns->tablerender(LOCATOR_SUBM_01, $text);
require_once(FOOTERF);

function headerjs() {
  $lan_file = e_PLUGIN."locator/languages/".e_LANGUAGE.".php";
  include_lan($lan_file);
  $script = "<script type=\"text/javascript\">
  function frmVerify() {
  	if(document.getElementById('locator_client').value == \"\") {
  		alert(' ".  LOCATOR_SUBM_07 ." ' );
  		return false;
  	}
  }
  </script>";
  return $script;
}
?>
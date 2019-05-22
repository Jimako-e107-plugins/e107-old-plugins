<?php
require_once("../../class2.php");
$query = explode(".", e_QUERY);
$redirect = e_PLUGIN."bugtracker3/bugtracker3.php";
$params = "";
if (count($query) > 1) {
   switch ($query[1]) {
      case "bugs" : {
         $params .= "1.".$query[2];
         break;
      }
      case "bug" : {
         $params .= "2.".$query[3];
         break;
      }
      case "submitbug" : {
         $params .= "5.".$query[2];
         break;
      }
      case "editbug" : {
         $params .= "5.".$query[3];
         break;
      }
   }
}
header("location:$redirect?$params");
?>
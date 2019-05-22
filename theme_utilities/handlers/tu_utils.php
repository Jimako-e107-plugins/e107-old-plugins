<?php
if (!function_exists("headerjs")) {
   function headerjs() {
      global $e107Helper;
      return $e107Helper->getHeaderFiles();
   }
}
?>
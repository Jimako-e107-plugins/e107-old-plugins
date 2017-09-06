<?php
if (!function_exists("headerjs")) {
   function headerjs() {
      global $e107Helper;
      return $e107Helper->getHeaderFiles();
   }
}

function e107helpers_developer_toCurrency($amount) {
   $decplaces = 2;
   $decpoint = ".";
   $thousadsep = ",";
   $symbol = "&pound;";
   return $symbol.number_format($amount/pow(10, $decplaces), $decplaces, $decpoint, $thousandsep);
}
function e107helpers_developer_getTopVote() {
   global $votelist;
   $vote = reset($votelist);
   while ($vote && $vote->isDeleted()) {
      $vote = next($votelist);
   }
   return $vote;
}
function e107helpers_developer_strikethrough($strikeit, $text) {
   return $strikeit ? "<span style='text-decoration:line-through;'>$text</span>" : $text;
}
?>
<?php
if (!function_exists("headerjs")) {
   function headerjs() {
      global $e107Helper;
      return $e107Helper->getHeaderFiles();
   }
}

function election_toCurrency($amount) {
   $decplaces = 2;
   $decpoint = ".";
   $thousadsep = ",";
   $symbol = "&pound;";
   return $symbol.number_format($amount/pow(10, $decplaces), $decplaces, $decpoint, $thousandsep);
}
function election_getTopVote() {
   global $votelist;
   $vote = reset($votelist);
   while ($vote && $vote->isDeleted()) {
      $vote = next($votelist);
   }
   return $vote;
}
function election_strikethrough($strikeit, $text) {
   return $strikeit ? "<span style='text-decoration:line-through;'>$text</span>" : $text;
}

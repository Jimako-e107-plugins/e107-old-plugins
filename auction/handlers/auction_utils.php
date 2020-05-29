<?php
if (!function_exists("headerjs")) {
   function headerjs() {
      global $e107Helper;
      return $e107Helper->getHeaderFiles();
   }
}

function auction_toCurrency($amount) {
   $decplaces = 2;
   $decpoint = ".";
   $thousadsep = ",";
   $symbol = "&pound;";
   return $symbol.number_format($amount/pow(10, $decplaces), $decplaces, $decpoint, $thousandsep);
}
function auction_getTopBid() {
   global $bidlist;
   $bid = reset($bidlist);
   while ($bid && $bid->isDeleted()) {
      $bid = next($bidlist);
   }
   return $bid;
}
function auction_strikethrough($strikeit, $text) {
   return $strikeit ? "<span style='text-decoration:line-through;'>$text</span>" : $text;
}
?>
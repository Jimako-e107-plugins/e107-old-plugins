<?php
 
//quick fix to stop resend forms after refresh 
$script = 
"
if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
}

function UJConfirmDelete(msg, loc) {
   if (confirm(msg)) {
      document.location = loc;
      return true;
   } else {
      return false;
   }
}

";
    
e107::js('footer-inline', $script, "jquery");
<?php

require_once("../../class2.php"); 
/* $Id: escapeshellarg.inc,v 1.1 2002/10/08 13:19:21 jberanek Exp $
 *
 * Included if your PHP version is less than 4.0.3 and therefore this
 * function doesn't exist.
 *
 */

function escapeshellarg($x)
{
  return "'".ereg_replace("'", "'\\''", $x)."'";
}

?>
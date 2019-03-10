<?php
   // Remember that we must include class2.php
   require_once("../../class2.php");

   // Check current user is an admin, redirect to main site if not
   if (!getperms("P")) {
      header("location:".e_HTTP."index.php");
      exit;
   }

   // Include page header stuff for admin pages
   require_once(e_ADMIN."auth.php");

   // Our informative text
	$text = '
	<table width="98%">
		<tr>
			<td>
				<pre>'.IM_LAN_23.'</pre><br /><br />
				</a><br /><br />
			</td>
		</tr>
	</table>
	';

   // The usual, tell e107 what to include on the page
   $ns->tablerender("Read Me", $text);

   require_once(e_ADMIN."footer.php");
?>


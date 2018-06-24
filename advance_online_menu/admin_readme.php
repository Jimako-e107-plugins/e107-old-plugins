<?php
	require_once("../../class2.php");
	if(!getperms("P")) { echo "You do not have permission"; exit; }
	require_once(e_ADMIN."auth.php");
	include(e_PLUGIN."advance_online_menu/language/".e_LANGUAGE.".php");
	
	$config = "
	<table class='fborder' width='100%'>
	<tr>
		<td class='fcaption' width='50%'>
			Advance Online Menu
		<td>
		<td class='fcaption' width='50%'>
			Version: 1.1
		<td>
	</tr>
	<tr>
		<td class='forumheader2' width='50%'>
			Author: eleljrk
		<td>
		<td class='forumheader3' width='50%'>
			Website: <a href='http://jurksplanet.co.cc'>JurksPlanet</a>
		<td>
	</tr>
	<tr>
		<td class='forumheader2' width='50%'>
			The only place for support is at JurksPlanet by eleljrk!
		<td>
		<td class='forumheader3' width='50%'>
			<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
			<input type='hidden' name='cmd' value='_donations'>
			<input type='hidden' name='business' value='YVX29E9J32L9U'>
			<input type='hidden' name='lc' value='US'>
			<input type='hidden' name='item_name' value='JurksPlanet'>
			<input type='hidden' name='currency_code' value='USD'>
			<input type='hidden' name='bn' value='PP-DonationsBF:btn_donateCC_LG.gif:NonHosted'>
			<input type='image' src='https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
			<img alt='' border='0' src='https://www.paypal.com/no_NO/i/scr/pixel.gif' width='1' height='1'>
			</form>
		<td>
	</tr>
	</table>
	<table class='fborder' width='100%'>
	<tr>
		<td class='forumheader3' width='100%'>
			This is an advanced online menu! Simply beutiful!
		</td>
	</tr>
	</table>";
	
	$ns->tablerender(AO_NAME." ".AO_README, $config);
	require_once(e_ADMIN."footer.php");
?>
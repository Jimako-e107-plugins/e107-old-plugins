<?php
/*
+------------------------------------------------------------------------------+
|     e107 Mobile  v2.2 by Martinj
|	November 2010
|	Visit www.martinj.co.uk for help and support
+------------------------------------------------------------------------------+
*/

require_once("../../class2.php");
require_once(e_ADMIN."auth.php");

if (!getperms("P")) {
	header("location:".e_BASE."index.php");
	exit;
}

// [multilanguage]
@include_once(e_PLUGIN."mobile/languages/".e_LANGUAGE.".php");
@include_once(e_PLUGIN."mobile/languages/English.php");

require_once(e_HANDLER."form_handler.php");
$rs = new form;
require_once(e_HANDLER."file_class.php");
$fl = new e_file;
unset($text);

if (isset($_POST['update_prefs'])) {

	$pref['mobile_active']        = $tp->toDB($_POST['active']);
	$pref['mobile_theme']  = $tp->toDB($_POST['theme']);
	$pref['mobile_menu']  = $tp->toDB($_POST['menu']);
	$pref['mobile_iphone']  = $tp->toDB($_POST['iphone']);
	save_prefs();
	$message = "Settings saved";
}

// Check for conflicts.....
$conflictCh = array("custom_theme"=>"Custom Themes Plugin",
					"xpress"=>"XPress Theme/Plugin (Mobile Functions)",
					"q_tree_menu"=>"Q Tree Menu - Overrides SITELINKS shortcode"
					);

$message2="";
foreach($conflictCh as $conflictCh=>$key) {
	if(isset($pref['plug_installed'][$conflictCh]))  {
		$message2 .="<tr><td>".$key."</td></tr>";
	}
}



if($message2 !="") {
$text .="	<fieldset>
		<legend>
			".EMP_WARN_0."
		</legend>
		<table border='0' class='tborder' cellspacing='10'><tr><td><B>".EMP_WARN_1."</B></td></tr>
		$message2</table>
		</fieldset><br/><br/>";
}

// displays the update message to confirm data is stored in database
if (isset($message)) {
	$ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}

$checked_active=($pref['mobile_active']=="true") ? 'checked' : '';

$filename=e_THEME."e107mobile/theme-css.php";
	if(file_exists($filename)) {
	$mobileThemeok=true;
	}
		else {
		$mobileThemeok=false;
		}

if($mobileThemeok==false) {
	$text .='<h2>You need to upload the e107mobile Theme before you continue!</h2>';
}

$text .= '
	<fieldset>
		<legend>
			e107mobile Help
		</legend>
		<table border="0" class="tborder" cellspacing="10">

			<tr>
				<td class="tborder" style="width: 100%">

				<h2>Introduction</h2>
				<p>e107mobile is made by <a href="http://www.martinj.co.uk">Martinj</a>. It\'s a combined plugin and theme which will completely optimize
				your website so it\'s viewable on mobile web devices. This new version allows you to customise the theme to match your website.
				</p><br/>


				<h2>Instructions</h2>
				<p>
				1) Upload and install the plugin<br />
				2) Upload the e107mobile theme to your themes folder. You don\'t need to make the theme active.<br/>
				3) Upload header_e107mobile.php and footer_e107mobile.php to your e107_themes/templates folder<br/>
				4) Go to your Plugin Manager and install/upgrade e107mobile.<br/>
				5) Configure the look and feel of your mobile how you like.
				<br/><br/>
				Your website directory should look like this...<br/>
					<li>'.e_PLUGIN.'mobile/</li>
					<li>'.e_THEME.'e107mobile/</li>
					<li>'.e_THEME.'templates/header_e107mobile.php</li>
					<li>'.e_THEME.'templates/footer_e107mobile.php</li>

				</p>';

$text .='		<h2>Adding Site Links</h2>
				<p>You need to configure which links display on a mobile device. To do this, simply add the links
				in the <a href="'.e_ADMIN.'links.php">Site Links</a> menu. Use <b>render type "Alt-X"</b> to show links on the mobile page.
				The letter X denotes the number of the Alt- link which will display on the mobile as explained next.
				</p><br/>


				<h2>General Site Links</h2>
				<p>Some websites like to have a login/logout button as a sitelink. To do this simply configure your sitelinks to show a login button (login.php)
				for guests,	and logout button to members.
				</p><br/>


				<h2>Testing Your Website</h2>
				<p>There are some useful links that will help you test your website. Firstly remember this, e107mobile will only check for a
				mobile device ONCE.. so if you refresh the page it wont recheck the device. The device is stored in a Session, and you can reset your
				current Session by visiting yoursite.com/news.php?e107mobile=cs - This will make e107mobile recheck the device that is viewing the page.<br/<br/>

				<ul>
				<li><a href="'.SITEURLBASE.'?e107mobile=cs">'.SITEURLBASE.'?e107mobile=cs</a> - Forces e107mobile to recheck the current device</li>
				<li><a href="'.SITEURLBASE.'?e107mobile=on">'.SITEURLBASE.'?e107mobile=on</a> - Forces the e107mobile theme whatever the device.</li>
				<li><a href="'.SITEURLBASE.'?e107mobile=off">'.SITEURLBASE.'?e107mobile=off</a> - Turns off e107mobile whatever the device. (e.g View Full Site)</li>
				</ul>

				<br/>Use these links wherever you like.
				</p><br/>

				<h2>What is font size em?</h2>
				<p>The "em" is a scalable unit that is used in web document media. An em is equal to the current font-size, for instance, if the font-size
				of the document is 12pt, 1em is equal to 12pt. Ems are scalable in nature, so 2em would equal 24pt, .5em would equal 6pt, etc. Ems are
				becoming increasingly popular in web documents due to scalability and their mobile-device-friendly nature.
				</p>
				<br/>

				<h2>Plugin Conflict Warnings</h2>
				<p>Don\'t worry about these too much. It just means you have other plugins installed which are also trying to change the users theme.
				For example, if you have a plugin which sets the theme based on userclass, what happens when that same user visits on his/her mobile phone?
				I don\'t have the answer, but this plugin does let you know about possible conflicts so you can fix them website dependant.
				You will see any issues quite clearly at the top of this page. If you don\'t see anything then your fine.<br/><br/>

				If you have conficts, either uninstall the other plugin or test it thoroughly. In most cases it may not be an issue.
				Please let me know about new conflicts so I can either work around them or add them to the list.</p>

				<br/>
				<h2>More Help</h2>
				<p>See the following pages for further help...
				<ul>
				<li><a href="http://www.martinj.co.uk/forum_9/e107mobile">Support Forum</a></li>
				<li><a href="http://www.martinj.co.uk">Home Page</a></li>
				</ul>
				</p><br/>



				<u><b>Features</b></u>
				<ul>
				<li>Automatically checks for many mobile devices</li>
				<li>Different themes for PC, mobile phone and iPhone users</li>
				<li>No need for separate URL\'s or sub-domains</li>
				<li>\'View full site\' option</li>
				<li>Users can LOGIN, view as a guest or even REGISTER!</li>
				<li>Normal user permissions/groups apply</li>
				<li>Fast page loading on phones, minimum output</li>
				<li>Use any theme.. not just ours!</li>
				<li>Show one, two or no side menu\'s</li>
				</ul>
				<br/><br/>
				<b>NEW Features for v2.0</b>
				<ul>
				<li>Change header title</li>
				<li>Change header background and text colour</li>
				<li>Change body font size</li>
				<li>Change sitelinks size and colour</li>
				<li>Min/Max image width and height</li>
				<li>Phone preview in Admin area</li>
				<li>Colour Picker for finding colours, or enter your own hex</li>
				<li>Improved mobile device detection</li>
				</ul>
				<br/><br/>

				<b>NEW Features for v2.1</b>
				<ul>
				<li>Improved mobile renering for the home page (W3C Check was 93% on test site)</li>
				<li>Fixes in CSS (thanks C4Dave)</li>
				<li>Small fixes and improvements</li>
				</ul>
				<br/><br/>

				<b>NEW Features for v2.2</b>
				<ul>
				<li>Reintroduction of menu area display.</li>
				<li>Select preferred Alt sitelinks to use for mobile devices.</li>
				<li>Added Qtree to conflicts</li>
				<li>Updated Help Pages</li>
				<li>Fixed pipe symbol in sitename bug</li>
				<li>New devices added to detection and cleaner checks</li>
				</ul>
				<br/><br/>

				<b>Credits</b><ul>
				<li><a href="http://www.xenthemes.com">Roofdog</a> - Theme Support</li>
				<li><a href="http://c4owners.org">C4Dave</a> - Bug Fixes</li>
				</ul>
';


		$text .='
		</td></tr></table>
	</fieldset><br/>
';

$caption = LAN_EMP_5;
$ns->tablerender($caption, $text);

require_once(e_ADMIN."footer.php");
?>
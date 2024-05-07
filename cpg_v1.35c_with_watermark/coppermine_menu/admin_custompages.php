<?php
require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_HTTP."index.php"); exit; }
require_once(e_ADMIN."auth.php");

$pageid  = "custompages";
$caption = "Using CUSTOMPAGES in Coppermine Gallery 1.3.5";


$text .= "
<br/>
The use of the CUSTOMPAGES, CUSTOMHEADER and CUSTOMFOOTER tags in the e107 themes are an excellent way of customizing your themes look for certain plugins or pages. 
I personally like coppermine to use the whole page without blocks on either side.
Unfortunetley Coppermine Gallery has always had a problem with displaying the correct footer when using these tags. 
When I fist looked at e107 and coppermine about 2 years ago the fix was to use an if/else statement:<br/><br/>

In your /e107_themes/[themename]/theme.php modify the HEADER and FOOTER area to:<br/>
";

$text .= '
[code]
if(!strpos($_SERVER["SCRIPT_FILENAME"],"coppermine_menu"))
{
//normal header and footer code
$HEADER = "[your code]";

$FOOTER = "[your code]";
}else{
//custom header and footer code
$HEADER = "[your code]";

$FOOTER = "[your code]";
}
[/code]
';


$text .= "
<br/>
This is still an acceptable fix today, especially if you want coppermine to use a different look than the rest of your CUSTOMPAGES, meaning you can have a total of 3 different styles to one theme.
<hr/>

But if you wish to actually use these tags in you theme(s) all you need to do is:
<br/><br/>
<ui>
<li>Copy the 'header_default.php' and 'footer_default.php' from the 'coppermine_menu/e107config' directory to your 'e107_themes/templates' directory.</li>
<li>Add/Modify your CUSTOMPAGES tag to include <u>coppermine_menu</u> in 'e107_themes/[themename]/theme.php'</li>
</ui>
<br/><br/>For a good example add <u>coppermine_menu</u> to the CUSTOMPAGES tag in 'e107_themes/vekna_blue/theme.php' or 'e107_themes/newsroom/theme.php'<br/>
";


	if (!is_object($tp->e_bb)) {
		require_once(e_HANDLER.'bbcode_handler.php');
		$tp->e_bb = new e_bbcode;
	}
	$text = $tp->e_bb->parseBBCodes($text, $postID);

	
$ns->tablerender($caption,$text);

require_once(e_ADMIN."footer.php");
?>

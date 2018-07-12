<?php

require_once('../../class2.php');
if (!defined('e107_INIT'))
{
    exit;
}

require_once(e_PLUGIN . "gold_system/includes/gold_system_shortcodes.php");

require_once(HEADERF);
require(GOLD_THEME);
$gold_text .= "<script type='text/javascript'>
<!--
function gold_div(divid) {

	if (document.getElementById(divid).style.display == 'block')
	{
		document.getElementById(divid).style.display = 'none';

	}
	else
	{
		document.getElementById(divid).style.display = 'block';
	}
}
-->
</script>";
// get all the plugins e_gold to see if they display in gold_centre
foreach($GOLD_PREF['gold_centreshow'] as $key => $value)
{
    // print $key;
    unset($e_gold);
    require(e_PLUGIN . $key . '/e_gold.php');
    #print_a($e_gold);
    if (!empty($e_gold[0]['gold_centre_charge_title']))
    {
        $gold_plugcharge .= '
	<div style="width:100%">
		<div onclick="gold_div(\'gold_myplug' . $key . '\');" style="cursor:pointer;float:left;width:80%;">
			<img src="' . THEME . 'images/bullet2.gif" alt="bullet" style="border:0;" />
				<b>' . $e_gold[0]['gold_centre_charge_title'] . '</b>&nbsp;&nbsp;
		</div>
		<div onclick="gold_div(\'gold_myplug' . $key . '\');" style="cursor:pointer;float:right;width:19%;text-align:right;">
			<img id="gold_mydataimg" src="' . e_PLUGIN . 'gold_system/images/expand.png" title="expand/close" alt="expand/close" style="border:0;"/>
		</div>
		<div style="clear:both;"></div>
	</div>
	<div id="gold_myplug' . $key . '" style="display:none" >';
        $gold_plugcharge .= $e_gold[0]['gold_centre_charge_text'] . '
	<br /></div>';
    }
}
$gold_text .= $tp->parsetemplate($GOLD_MAIN_HEADER, true, $gold_shortcodes);
$gold_text .= $tp->parsetemplate($GOLD_MAIN_BLOCK1, true, $gold_shortcodes);
$gold_text .= $tp->parsetemplate($GOLD_MAIN_BLOCK2, true, $gold_shortcodes);
$gold_text .= $tp->parsetemplate($GOLD_MAIN_BLOCK3, true, $gold_shortcodes);
$gold_text .= $tp->parsetemplate($GOLD_MAIN_BLOCK4, true, $gold_shortcodes);
$gold_text .= $tp->parsetemplate($GOLD_MAIN_FOOTER, true, $gold_shortcodes);

$ns->tablerender(LAN_GS_MAIN001, $gold_text);

require_once(FOOTERF);

?>
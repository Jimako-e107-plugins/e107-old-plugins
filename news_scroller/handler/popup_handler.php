<?php
/*
+---------------------------------------------------------------+
|	For e107 website system
|	News scroller
|   Parts based on scrolling banner menu  By BaD_DuD (Roger Wallin)
|	© nlstart
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit(); }
// Set languages -----------------------------------------------+
include_lan(e_PLUGIN.'news_scroller/languages/'.e_LANGUAGE.'.php');

//---------- POPUP setup -------------------------------+
function set_popup($pop_id,$title,$pop_txt)
{
echo "
	<script type='text/javascript' language='JavaScript1.2'>
		//Create popup array
		Scroll_txt[".$pop_id."]=['".$title."','".$pop_txt."'];
		//Style settings 0=No sticky 1=Sticky
		Scroll_Style[0]=['white','#000099','','','',,'black','#e8e8ff','','','',,,,2,'#000099',2,,,,1,'gray',,,,];
		Scroll_Style[1]=['white','#000099','','','',,'black','#e8e8ff','','','',,,,2,'#000099',2,,,,1,'gray',3,,,];
		var TipId='scroller'
		var FiltersEnabled = 1
		mig_clay()
	</script>
 ";
}
?>
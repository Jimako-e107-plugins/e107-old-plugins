<?php
/*
 * e107Slider Plugin v0.1
 *
 * Copyright (C) 2007-2012 Xen Themes (xenthemes.com)
 *
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) or 
 * GPL Version 2 (http://www.gnu.org/licenses/gpl-2.0.txt) licenses
 *
 * $Source: 
 * $Revision: 1.0 $
 * $Date: 25/05/2012 $
 * $Author: leonlloyd $
 *
*/

require_once( "../../class2.php" );
if ( !defined( 'e107_INIT' ) ) {
    exit;
}

if ( !getperms( "P" ) ) {
    header( "location:" . e_BASE . "index.php" );
    exit;
}

include_lan(e_PLUGIN.'e107slider/languages/".e_LANGUAGE.".php');

require_once( e_ADMIN . "auth.php" );



if ( isset( $_POST['savesettings'] ) ) {

    $pref['es_slider_news_title'] = $tp->toDB($_POST['es_slider_news_title']);
    $pref['es_slider_news_amount'] = $tp->toDB($_POST['es_slider_news_amount']);
    $pref['es_slider_news_auto'] = $tp->toDB($_POST['es_slider_news_auto']);
    $pref['es_slider_news_speed'] =  $tp->toDB($_POST['es_slider_news_speed']);
    $pref['es_slider_news_timeout'] =  $tp->toDB($_POST['es_slider_news_timeout']);
    $pref['es_slider_news_pager'] =  $tp->toDB($_POST['es_slider_news_pager']);
    $pref['es_slider_news_nav'] = $tp->toDB($_POST['es_slider_news_nav']);
    $pref['es_slider_news_random'] =  $tp->toDB($_POST['es_slider_news_random']);
    $pref['es_slider_news_pause'] =  $tp->toDB($_POST['es_slider_news_pause']);
    $pref['es_slider_news_pauseControls'] =  $tp->toDB($_POST['es_slider_news_pauseControls']);

    save_prefs();
    $es_message =  '<div class="alert"><p>'.ES_PLUGIN_2.'</p></div>';
}
		
$es_text = "
<form name='settings_form' id='dataform' method='post' action='" . e_SELF . "?update'>
	<div class='vs-info'>
		" . $es_message . "
		<h2 class='vs-admin-title'>".ES_PLUGIN_5."</h2>
	</div>
";

$es_text .= "
	<table class='vs-table' style='" . ADMIN_WIDTH . "'>
		<thead>		
			<tr>
				<th colspan='2'><h3>".ES_PLUGIN_SS_1."</h3></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style='width:30%'>".ES_PLUGIN_SS_16."</td>
				<td style='width:70%'>
					<input type='text' class='tbox' style='width:40%'; name='es_slider_news_title' id='es_slider_news_title' value='".$tp->toFORM($pref['es_slider_news_title'])."' />
				</td>
			</tr>
			<tr>
				<td style='width:30%'>".ES_PLUGIN_SS_15."</td>
				<td style='width:70%'>
					<select class='tbox' name='es_slider_news_amount' id='es_slider_news_amount' >
						<option value='2' " . ( $pref['es_slider_news_amount'] == "2"?'selected="selected"':'' ) . " >2</option>
						<option value='3' " . ( $pref['es_slider_news_amount'] == "3"?'selected="selected"':'' ) . " >3</option>
						<option value='4' " . ( $pref['es_slider_news_amount'] == "4"?'selected="selected"':'' ) . " >4</option>
						<option value='5' " . ( $pref['es_slider_news_amount'] == "5"?'selected="selected"':'' ) . " >5</option>
						<option value='6' " . ( $pref['es_slider_news_amount'] == "6"?'selected="selected"':'' ) . " >6</option>
						<option value='7' " . ( $pref['es_slider_news_amount'] == "7"?'selected="selected"':'' ) . " >7</option>
						<option value='8' " . ( $pref['es_slider_news_amount'] == "8"?'selected="selected"':'' ) . " >8</option>
						<option value='9' " . ( $pref['es_slider_news_amount'] == "9"?'selected="selected"':'' ) . " >9</option>
						<option value='10' " . ( $pref['es_slider_news_amount'] == "10"?'selected="selected"':'' ) . " >10</option>
						<option value='12' " . ( $pref['es_slider_news_amount'] == "12"?'selected="selected"':'' ) . " >12</option>
						<option value='15' " . ( $pref['es_slider_news_amount'] == "15"?'selected="selected"':'' ) . " >15</option>
						<option value='20' " . ( $pref['es_slider_news_amount'] == "20"?'selected="selected"':'' ) . " >20</option>
						
					</select>
				</td>
			</tr>
			<tr>
				<td style='width:30%'>".ES_PLUGIN_SS_2."</td>
				<td style='width:70%'>
					<select class='tbox' name='es_slider_news_auto' id='es_slider_news_auto' >
						<option value='true' " . ( $pref['es_slider_news_auto'] == "true"?'selected="selected"':'' ) . " >True</option>
						<option value='false' " . ( $pref['es_slider_news_auto'] == "false"?'selected="selected"':'' ) . " >False</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style='width:30%'>".ES_PLUGIN_SS_3."</td>
				<td style='width:70%'>
					<select class='tbox' name='es_slider_news_speed' id='es_slider_news_speed' >
						<option value='200' " . ( $pref['es_slider_news_speed'] == "200"?'selected="selected"':'' ) . " >200ms</option>
						<option value='300' " . ( $pref['es_slider_news_speed'] == "300"?'selected="selected"':'' ) . " >300ms</option>
						<option value='400' " . ( $pref['es_slider_news_speed'] == "400"?'selected="selected"':'' ) . " >400ms</option>
						<option value='500' " . ( $pref['es_slider_news_speed'] == "500"?'selected="selected"':'' ) . " >500ms</option>
						<option value='600' " . ( $pref['es_slider_news_speed'] == "600"?'selected="selected"':'' ) . " >600ms</option>
						<option value='700' " . ( $pref['es_slider_news_speed'] == "700"?'selected="selected"':'' ) . " >700ms</option>
						<option value='800' " . ( $pref['es_slider_news_speed'] == "800"?'selected="selected"':'' ) . " >800ms</option>
						<option value='900' " . ( $pref['es_slider_news_speed'] == "900"?'selected="selected"':'' ) . " >900ms</option>
						<option value='1000' " . ( $pref['es_slider_news_speed'] == "1000"?'selected="selected"':'' ) . " >1000ms</option>
						<option value='1100' " . ( $pref['es_slider_news_speed'] == "1100"?'selected="selected"':'' ) . " >1100ms</option>
						<option value='1200' " . ( $pref['es_slider_news_speed'] == "1200"?'selected="selected"':'' ) . " >1200ms</option>
						
					</select>
				</td>
			</tr>
			<tr>
				<td style='width:30%'>".ES_PLUGIN_SS_4."</td>
				<td style='width:70%'>
					<select class='tbox' name='es_slider_news_timeout' id='es_slider_news_timeout' >
						<option value='3000' " . ( $pref['es_slider_news_timeout'] == "3000"?'selected="selected"':'' ) . " >3s</option>
						<option value='4000' " . ( $pref['es_slider_news_timeout'] == "4000"?'selected="selected"':'' ) . " >4s</option>
						<option value='5000' " . ( $pref['es_slider_news_timeout'] == "5000"?'selected="selected"':'' ) . " >5s</option>
						<option value='6000' " . ( $pref['es_slider_news_timeout'] == "6000"?'selected="selected"':'' ) . " >6s</option>
						<option value='7000' " . ( $pref['es_slider_news_timeout'] == "7000"?'selected="selected"':'' ) . " >7s</option>
						<option value='8000' " . ( $pref['es_slider_news_timeout'] == "8000"?'selected="selected"':'' ) . " >8s</option>
						<option value='9000' " . ( $pref['es_slider_news_timeout'] == "9000"?'selected="selected"':'' ) . " >9s</option>
						<option value='10000' " . ( $pref['es_slider_news_timeout'] == "10000"?'selected="selected"':'' ) . " >10s</option>
						
					</select>
				</td>
			</tr>
			<tr>
				<td style='width:30%'>".ES_PLUGIN_SS_5."</td>
				<td style='width:70%'>
					<select class='tbox' name='es_slider_news_pager' id='es_slider_news_pager' >
						<option value='true' " . ( $pref['es_slider_news_pager'] == "true"?'selected="selected"':'' ) . " >True</option>
						<option value='false' " . ( $pref['es_slider_news_pager'] == "false"?'selected="selected"':'' ) . " >False</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style='width:30%'>".ES_PLUGIN_SS_6."</td>
				<td style='width:70%'>
					<select class='tbox' name='es_slider_news_nav' id='es_slider_news_nav' >
						<option value='true' " . ( $pref['es_slider_news_nav'] == "true"?'selected="selected"':'' ) . " >True</option>
						<option value='false' " . ( $pref['es_slider_news_nav'] == "false"?'selected="selected"':'' ) . " >False</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style='width:30%'>".ES_PLUGIN_SS_7."</td>
				<td style='width:70%'>
					<select class='tbox' name='es_slider_news_random' id='es_slider_news_random' >
						<option value='true' " . ( $pref['es_slider_news_random'] == "true"?'selected="selected"':'' ) . " >True</option>
						<option value='false' " . ( $pref['es_slider_news_random'] == "false"?'selected="selected"':'' ) . " >False</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style='width:30%'>".ES_PLUGIN_SS_8."</td>
				<td style='width:70%'>
					<select class='tbox' name='es_slider_news_pause' id='es_slider_news_pause' >
						<option value='true' " . ( $pref['es_slider_news_pause'] == "true"?'selected="selected"':'' ) . " >True</option>
						<option value='false' " . ( $pref['es_slider_news_pause'] == "false"?'selected="selected"':'' ) . " >False</option>
					</select>
				</td>
			</tr>
			<tr>
				<td style='width:30%'>".ES_PLUGIN_SS_9."</td>
				<td style='width:70%'>
					<select class='tbox' name='es_slider_news_pauseControls' id='es_slider_news_pauseControls' >
						<option value='true' " . ( $pref['es_slider_news_pauseControls'] == "true"?'selected="selected"':'' ) . " >True</option>
						<option value='false' " . ( $pref['es_slider_news_pauseControls'] == "false"?'selected="selected"':'' ) . " >False</option>
					</select>
				</td>
			</tr>
		
		
			<tr>
				<td class='table-end' colspan='2'>
					<input class='button' name='savesettings' type='submit' value='".ES_PLUGIN_3."' />
				</td>
			</tr>
		</tbody>
	</table>
</form>";
	
$es_text .= "
	<p><center>e107Slider v".$pref['plug_installed']['e107slider']." by <a href='http://www.xenthemes.com' target='_blank'>Xen Themes</a></center></p>
";


$ns->tablerender( ES_PLUGIN_1, $es_text );
require_once( e_ADMIN . "footer.php" );
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
 * $Revision: 1 $
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

	
$es_text = "
	<div class='vs-info'>
		<h2 class='vs-admin-title'>".ES_PLUGIN_6."</h2>
	</div>
";
$es_text .= "
	<table class='vs-table' style='" . ADMIN_WIDTH . "'>
   		<thead>
   			<tr>
				<th colspan='2'><h3>".ES_PLUGIN_CF_1."</h3></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style='width:100%'>
					
					<p class='licence'>".ES_PLUGIN_CF_2."</p>
					
					<p class='licence'>".ES_PLUGIN_CF_3."</p>

					<p class='licence'>".ES_PLUGIN_CF_4."</p>
					
				</td>
			</tr>
		</tbody>
	</table>
";

$es_text .= "
	<table class='vs-table' style='" . ADMIN_WIDTH . "'>
   		<thead>
   			<tr>
				<th colspan='2'><h3>".ES_PLUGIN_CF_5."</h3></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style='width:100%'>
					
					<h4>".ES_PLUGIN_MU_1."</h4>
					
					<p class='licence'>".ES_PLUGIN_CF_6."</p>
					
					<p class='licence'>".ES_PLUGIN_CF_7."</p>
					
					<h4>".ES_PLUGIN_MU_2."</h4>
					
					<p class='licence'>".ES_PLUGIN_CF_8."</p>
					
				</td>
			</tr>
		</tbody>
	</table>
";

$es_text .= "
	<table class='vs-table' style='" . ADMIN_WIDTH . "'>
   		<thead>
   			<tr>
				<th colspan='2'><h3>".ES_PLUGIN_CF_9."</h3></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style='width:100%'>
					
					<h4>e107Slider Plugin</h4>
					<p class='licence'><a href='http://www.xenthemes.com'>e107Slider Plugin</a> (c) copyright 2012, Xen Themes.</p>
					<p class='licence'>Dual licensed under the <a href='http://www.opensource.org/licenses/mit-license.php'>MIT</a> or <a href='http://www.gnu.org/licenses/gpl-2.0.txt'>GPL Version 2</a> licenses</p>
					
					<h4>jQuery &#8212; JavaScript Library</h4>
					<p class='licence'><a href='http://jquery.com/'>http://jquery.com</a> (c) Copyright 2010-2012, John Resig</p>
					<p class='licence'>Dual licensed under the <a href='http://jquery.org/license'>MIT or GPL</a> Version 2 licenses.</p>
					
					<h4>ResponsiveSlides.js</h4>
					
					<p class='licence'>Copyright (c) 2011-2012 Viljami Salminen, <a href='http://viljamis.com/'>http://viljamis.com/</a></p>
					
					<p class='licence'>Licensed under the <a href='http://www.opensource.org/licenses/mit-license.php'>MIT</a> license.</p>
					
				</td>
			</tr>
		</tbody>
	</table>
";

$es_text .= "
	<table class='vs-table' style='" . ADMIN_WIDTH . "'>
   		<thead>
   			<tr>
				<th colspan='2'><h3>Changelog</h3></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style='width:100%'>
					
					<span>= 0.2 - </span>
					<ul>
						<li>* Added Swedish language ( Thanks to Krister Knutars http://www.e107.se )</li>
					</ul>
					
					<span>= 0.1 - 30 May 2012</span>
					<ul>
						<li>* Initial beta release</li>
					</ul>
					
				</td>
			</tr>
		</tbody>
	</table>
";

$es_text .= "
</form>
<p><center>e107Slider v".$pref['plug_installed']['e107slider']." by <a href='http://www.xenthemes.com' target='_blank'>Xen Themes</a></center></p>
";

$ns->tablerender( ES_PLUGIN_1, $es_text);
require_once(e_ADMIN."footer.php");
<?php
/**
 * $Id: ranks_template.php,v 1.7 2010/01/29 23:42:13 michiel Exp $
 * 
 * Rank System for e107 v7xx - by Michiel Horvers
 * This module for the e107 .7+ website system
 * Copyright Michiel Horvers 2009
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * Revision: $Revision: 1.7 $
 * Last Modified: $Date: 2010/01/29 23:42:13 $
 *
 * Change Log:
 * $Log: ranks_template.php,v $
 * Revision 1.7  2010/01/29 23:42:13  michiel
 * Added configurable CSS style for top-menu
 *
 * Revision 1.6  2009/10/22 15:20:26  michiel
 * Show bonus points and reward in Medal Overview
 *
 * Revision 1.5  2009/10/22 15:03:37  michiel
 * Implemented customizable conditions
 *
 * Revision 1.4  2009/07/14 19:29:16  michiel
 * CVS Merge
 *
 * Revision 1.3.2.1  2009/07/13 21:52:26  michiel
 * - using own css style
 * - integrated deprecated rankshow_class into template/shortcode
 *
 * Revision 1.3  2009/06/28 15:06:15  michiel
 * Merged from dev_01_03
 *
 * Revision 1.2.2.1  2009/06/28 02:36:08  michiel
 * Rank System links on rank, medal and recommendation pages
 *
 * Revision 1.2  2009/06/26 09:23:40  michiel
 * Merged from dev_01_01
 *
 * Revision 1.1.2.1  2009/06/19 13:47:14  michiel
 * Made XHTML compliant
 *
 * Revision 1.1  2009/03/28 13:01:50  michiel
 * Initial CVS revision
 *
 *  
 */
if (!defined('e107_INIT')) {
    exit;
}
if (!defined("USER_WIDTH")) {
    define(USER_WIDTH, "width:100%;");
}

if (file_exists(THEME."rank_style.css")) {
	echo "<link rel='stylesheet' href='".THEME_ABS."rank_style.css' type='text/css'>";
} else {
	echo "<link rel='stylesheet' href='".e_PLUGIN_ABS."rank_system/templates/rank_style.css' type='text/css'>";
}


	$RANK_MENU = '
		<div class="rank_menu">
		'.RANKS_01.' :: 
		[<a class="rank_menu_link" href="'.e_PLUGIN.'rank_system/ranks.php">'.RANKS_14.'</a>] 
		[<a class="rank_menu_link" href="'.e_PLUGIN.'rank_system/medals.php">'.RANKS_MED_01.'</a>]
		[<a class="rank_menu_link" href="'.e_PLUGIN.'rank_system/recommend.php">'.RANKS_RM_01.'</a>]
		[<a class="rank_menu_link" href="'.e_PLUGIN.'rank_system/conditions.php">'.RANKS_20.'</a>]
		</div>
	';
	
	$RANK_DENIED_PAGE = '
		<strong>'. RANKS_DENIED.'</strong>
	';
	
    $RANK_CONDITIONS_HEADER = '
    	<table class="rsborder" style="' . USER_WIDTH . '">
 		<tr>
 			<td class="rscaption" style="text-align:center">'.RANKS_20.'</td>
 		</tr>
    	<tr>
    		<td class="rstabs" style="text-align:left">
	';
    
    $RANK_CONDITIONS_PAGE = '
    	{CONDIT_DESCRIPTION}
	';
    
    $RANK_CONDITIONS_FOOTER = '
    		</td>
    	</tr>
    	</table>
    ';

    $RANK_CATOVERVIEW_HEADER = '		 	
		<table class="rsborder" style="' . USER_WIDTH . '">
 		<tr>
 			<td class="rscaption" colspan="2" style="text-align:center">'.RANKS_01.'</td>
 		</tr>
 		<tr align="center">
 			<td class="rsheader" colspan="2" style="text-align:center">
 				<strong>'.RANKS_12.'</strong>
 			</td>
 		</tr>
 		';
    
    $RANK_CATOVERVIEW_ROW = '
			<tr>
				<td class="rsheader" style="width:25%;text-align:center">
					<a href="'.e_SELF.'?cat.{OVERVIEW_CAT_ID}">{OVERVIEW_CAT_NAME}</a>
				</td>
				<td class="rsheader3" style="width:75%;text-align:left">
					{OVERVIEW_CAT_BAR} {OVERVIEW_CAT_COUNT} ({OVERVIEW_CAT_PERCENT})
				</td>
			</tr>
		';
    
    $RANK_CATOVERVIEW_FOOTER = '</table><br />';
    
    $RANK_RANKOVERVIEW_HEADER = '		 	
		<table class="rsborder" style="' . USER_WIDTH . '">
 		<tr align="center">
 			<td class="rsheader" colspan="5" style="text-align:center">
 				<strong>'.RANKS_14.'</strong>
 			</td>
 		</tr>
 		<tr>
 			<td class="rsheader2" colspan="2" style="width:55%;text-align:center">'.RANKS_15.'</td>
 			<td class="rsheader2" style="width:15%;text-align:center">'.RANKS_16.'</td>
 			<td class="rsheader2" style="width:15%;text-align:center">'.RANKS_17.'</td>
 			<td class="rsheader2" style="width:15%;text-align:center">'.RANKS_18.'</td>
 		</tr>
 		';
    
    $RANK_RANKOVERVIEW_ROW = '
			<tr>
	 			<td class="rsheader2" style="width:15%;text-align:center"><img src="{OVERVIEW_RANK_IMAGE}" border="0"/></td>
	 			<td class="rsheader2" style="width:40%;text-align:center">{OVERVIEW_RANK_RANK}</td>
	 			<td class="rsheader2" style="width:15%;text-align:center">{OVERVIEW_RANK_POINTS}</td>
	 			<td class="rsheader2" style="width:15%;text-align:center">{OVERVIEW_RANK_AGE}</td>
	 			<td class="rsheader2" style="width:15%;text-align:center">{OVERVIEW_RANK_COUNT}</td>
			</tr>
		';
    
    $RANK_RANKOVERVIEW_FOOTER = '</table><br />';
    
    $RANK_SPECIALOVERVIEW_HEADER = '		 	
		<table class="rsborder" style="' . USER_WIDTH . '">
 		<tr align="center">
 			<td class="rsheader" colspan="3" style="text-align:center">
 				<strong>'.RANKS_13.'</strong>
 			</td>
 		</tr>
 		<tr>
 			<td class="rsheader2" colspan="2" style="width:55%;text-align:center">'.RANKS_15.'</td>
 			<td class="rsheader2" style="width:45%;text-align:center">'.RANKS_18.'</td>
 		</tr>
 		';
    
    $RANK_SPECIALOVERVIEW_ROW = '
			<tr>
	 			<td class="rsheader2" style="width:15%;text-align:center"><img src="{OVERVIEW_SPECIAL_IMAGE}" border="0" /></td>
	 			<td class="rsheader2" style="width:40%;text-align:center">{OVERVIEW_SPECIAL_NAME}</td>
	 			<td class="rsheader2" style="width:45%;text-align:center">{OVERVIEW_SPECIAL_COUNT}</td>
			</tr>
		';
    
    $RANK_RANKOVERVIEW_FOOTER = '</table><br />';

    $SINGLE_MEDAL = '
		<table class="rsborder" style="' . USER_WIDTH . '">
 		<tr align="center">
 			<td class="rscaption" colspan="3" style="text-align:center">
 				<strong>{MEDAL_NAME}</strong>
 			</td>
 		</tr>
 		<tr>
 			<td class="rsheader2" rowspan="4" style="width:40%;text-align:center">
 				<img src="{MEDAL_IMAGE}" border="0" alt="{MEDAL_NAME}" title="{MEDAL_NAME}"/>
 			</td>
 			<td class="rsheader2" style="width:20%;text-align:left">'.RANKS_MED_02.'</td>
 			<td class="rsheader2" style="width:40%;text-align:left">{MEDAL_NAME}</td>
 		</tr>
 		<tr>
 			<td class="rsheader2" style="text-align:left">'.RANKS_MED_03.'</td>
 			<td class="rsheader2" style="text-align:left">{MEDAL_CATEGORY}</td>
 		</tr>
 		<tr>
 			<td class="rsheader2" style="text-align:left">'.RANKS_MED_04.'</td>
 			<td class="rsheader2" style="text-align:left">{MEDAL_TYPE}</td>
 		</tr>
 		<tr>
 			<td class="rsheader2" style="text-align:left">'.RANKS_MED_06.'</td>
 			<td class="rsheader2" style="text-align:left">{MEDAL_DESCRIPTION}</td>
 		</tr>
 		<tr>
 			<td class="rsheader2" colspan="3" style="text-align:left">&nbsp</td>
 		</tr>
 		<tr>
 			<td class="rsheader" colspan="3" style="text-align:center"><strong>{MEDAL_USERHEAD}</strong></td>
 		</tr>
 		<tr>
 			<td class="rsheader2" colspan="3" style="text-align:center">{MEDAL_USERLIST}</td>
 		</tr>
 		</table>
        ';
        
    
    $MEDAL_HEADER = '
    	<table class="rsborder" style="' . USER_WIDTH . '">
 		<tr>
 			<td class="rscaption" style="text-align:center">'.RANKS_MED_11.'</td>
 		</tr>
    	<tr>
    		<td class="rstabs" style="text-align:left">
	';

    $MEDAL_ROW_HEADER = '
		<table class="rsborder" style="' . USER_WIDTH . '">
 	';
    
    $MEDAL_ROW = '
 		<tr>
 			<td class="rsheader" colspan="3" style="text-align:center">{MEDAL_NAME}</td>
 		</tr>
 		
    	<tr>
 			<td class="rsheader2" rowspan="6" style="width:40%;text-align:center; vertical-align:top">
 				<a href="'.e_PLUGIN.'rank_system/medals.php?medal.{MEDAL_ID}">
 					<img src="{MEDAL_IMAGE}" border="0" alt="{MEDAL_NAME}" title="{MEDAL_NAME}"/>
 				</a>
 			</td>
 			<td class="rsheader2" style="width:20%;text-align:left"><b>'.RANKS_MED_02.'</b></td>
 			<td class="rsheader2" style="width:40%;text-align:left">{MEDAL_NAME}</td>
 		</tr>
 		<tr>
 			<td class="rsheader2" style="text-align:left"><b>'.RANKS_MED_03.'</b></td>
 			<td class="rsheader2" style="text-align:left">{MEDAL_CATEGORY}</td>
 		</tr>
 		<tr>
 			<td class="rsheader2" style="text-align:left"><b>'.RANKS_MED_04.'</b></td>
 			<td class="rsheader2" style="text-align:left">{MEDAL_TYPE}</td>
 		</tr>
 		<tr>
 			<td class="rsheader2" style="text-align:left"><b>'.RANKS_MED_19.'</b></td>
 			<td class="rsheader2" style="text-align:left">{MEDAL_BONUS}</td>
 		</tr>
 		<tr>
 			<td class="rsheader2" style="text-align:left"><b>'.RANKS_MED_20.'</b></td>
 			<td class="rsheader2" style="text-align:left">{MEDAL_REWARD}</td>
 		</tr>
 		<tr>
 			<td class="rsheader2" style="text-align:left"><b>'.RANKS_MED_06.'</b></td>
 			<td class="rsheader2" style="text-align:left">{MEDAL_DESCRIPTION}</td>
 		</tr>
 		
 		
 		<tr>
 			<td colspan="3">&nbsp;</td>
 		</tr>
	';
    
    $MEDAL_ROW_FOOTER = '
    	</table>
    ';
    
    $MEDAL_FOOTER = '
    		</td>
    	</tr>
    	</table>
    ';
    
    $LIST_RANKHEADER = '
	 	<table class="rsborder" style="' . USER_WIDTH . '">
 		<tr>
 			<td class="rscaption" colspan="2" style="text-align:center">{LIST_TITLE}</td>
 		</tr>
 		
	 ';
    
    $LIST_RANKROW = '
    	<tr>
    		<td class="rsheader" colspan="2" style="text-align:center">{LIST_RANKNAME}</td>
    	</tr>
    	<tr>
    		<td class="rsheader2" style="width:50%;text-align:center">{LIST_IMG=rank}</td>
    		<td class="rsheader2" style="width:50%;text-align:left">{LIST_USERS=rank}</td>
    	</tr>
    ';
    
    $LIST_RANKFOOTER = '
    	</table>
    ';
    

    $LIST_SPECIALHEADER = '
	 	<table class="rsborder" style="' . USER_WIDTH . '">
 		<tr>
 			<td class="rscaption" colspan="3" style="text-align:center">{LIST_TITLE}</td>
 		</tr>
 		
		<tr>
			<td class="rsheader" style="text-align:center">
				{LIST_IMG=probation}<br />
				<strong>'.RANKS_10.'</strong>
			</td>
			<td class="rsheader" style="text-align:center">
				{LIST_IMG=prison}<br />
				<strong>'.RANKS_09.'</strong>
			</td>
			<td class="rsheader" style="text-align:center">
				{LIST_IMG=kicked}<br />
				<strong>'.RANKS_11.'</strong>
			</td>
		</tr>
	 ';
    
    $LIST_SPECIALROW = '
    	<tr>
    		<td class="rsheader2" style="text-align:center">{LIST_USERS=probation}</td>
    		<td class="rsheader2" style="text-align:center">{LIST_USERS=prison}</td>
    		<td class="rsheader2" style="text-align:center">{LIST_USERS=kicked}</td>
    	</tr>
    ';
    
    $LIST_SPECIALFOOTER = '
    	</table>
    ';

    
?>
<?php

/**
 * Copyright (c) 2012 e107 Inc e107.org, Licensed under GNU GPL (http://www.gnu.org/licenses/gpl.txt)
 *
 * @file
 * Templates for "pagestat" plugin.
 */

 
                            
                            
$PAGESTAT_TEMPLATE['popularnews_menu']['caption'] 	= '{CAPTION}';
$PAGESTAT_TEMPLATE['popularnews_menu']['start'] 	= "<ul class='media-list unstyled list-unstyled othernews2-block'>{SETIMAGE: w=100&h=100&crop=1}"; // set the {NEWSIMAGE} dimensions.
$PAGESTAT_TEMPLATE['popularnews_menu']['item'] 	= "<li class='media'>
										<span class='media-object pull-left'>{NEWSTHUMBNAIL=placeholder}</span> 
										<div class='media-body'><h4>{NEWSTITLELINK}</h4>
										<p class='text-right'><a class='btn btn-primary btn-othernews2' href='{NEWSURL}'>".LAN_READ_MORE." &raquo;</a></p>
										</div>[{VIEWPAGETITLE}: {VIEWPAGESTAT}]
										</li>\n";
										
$PAGESTAT_TEMPLATE['popularnews_menu']['end'] 	= "</ul>"; 
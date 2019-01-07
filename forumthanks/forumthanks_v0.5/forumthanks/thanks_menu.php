<?php

 global $tp;
 if (!defined('e107_INIT')) { exit; }
 include_lan(e_PLUGIN.'forumthanks/languages/'.e_LANGUAGE.'/lan_thanks.php');

 $text = LAN_T28."<p>" ;
                $text .= "<a href='".e_PLUGIN."forumthanks/thanks.php?posts.2.4'>".LAN_T15."</a> | " ;
                $text .= "<a href='".e_PLUGIN."forumthanks/thanks.php?posts.2.3'>".LAN_T14."</a> | " ;
                $text .= "<a href='".e_PLUGIN."forumthanks/thanks.php?posts.2.2'>".LAN_T13."</a> | " ;
                $text .= "<a href='".e_PLUGIN."forumthanks/thanks.php?posts.2.1'>".LAN_T12."</a> | " ;
                $text .= "<a href='".e_PLUGIN."forumthanks/thanks.php?posts.2'>".LAN_T16."</a><p>" ;
 $text .=  LAN_T22."<p>" ;
                $text .= "<a href='".e_PLUGIN."forumthanks/thanks.php?user.0'>".LAN_T16."</a><p>" ;
 $text .=  LAN_T23."<p>" ;
                $text .= "<a href='".e_PLUGIN."forumthanks/thanks.php?user.1'>".LAN_T16."</a><p>" ;

 $ns -> tablerender('', $text);

?>
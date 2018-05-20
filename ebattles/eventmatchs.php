<?php
/**
* EventMatchs.php
*
*/
require_once("../../class2.php");
require_once(e_PLUGIN."ebattles/include/main.php");
require_once(e_PLUGIN."ebattles/include/paginator.class.php");
require_once(e_PLUGIN."ebattles/include/clan.php");
require_once(e_PLUGIN."ebattles/include/event.php");
require_once(e_PLUGIN."ebattles/include/match.php");

/*******************************************************************
********************************************************************/
require_once(HEADERF);
require_once(e_PLUGIN."ebattles/include/ebattles_header.php");

$pages = new Paginator;

/* Event Name */
$event_id = intval($_GET['eventid']);

if (!$event_id)
{
	header("Location: ./events.php");
	exit();
}

$q = "SELECT ".TBL_EVENTS.".*, "
.TBL_GAMES.".*"
." FROM ".TBL_EVENTS.", "
.TBL_GAMES
." WHERE (".TBL_EVENTS.".EventID = '$event_id')"
."   AND (".TBL_EVENTS.".Game = ".TBL_GAMES.".GameID)";

$result = $sql->db_Query($q);
$event = new Event($event_id);

$gName = mysql_result($result,0 , TBL_GAMES.".Name");
$gIcon = mysql_result($result,0 , TBL_GAMES.".Icon");

$text .= '<div id="tabs">';
$text .= '<ul>';
$text .= '<li><a href="#tabs-1">'.EB_MATCHS_L1.'</a></li>';
$text .= '</ul>';

$text .= '<div id="tabs-1">';
$q = "SELECT COUNT(DISTINCT ".TBL_MATCHS.".MatchID) as NbrMatches"
." FROM ".TBL_MATCHS.", "
.TBL_SCORES
." WHERE (Event = '$event_id')"
." AND (".TBL_MATCHS.".Status = 'active')"
." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)";
$result = $sql->db_Query($q);
$row = mysql_fetch_array($result);
$nbrmatches = $row['NbrMatches'];
$text .= '<p>';
$text .= $nbrmatches.' '.EB_MATCHS_L2;
$text .= '</p>';
$text .= '<br />';

/* set pagination variables */
$totalItems = $nbrmatches;
$pages->items_total = $totalItems;
$pages->mid_range = eb_PAGINATION_MIDRANGE;
$pages->paginate();

// Paginate
$text .= '<span class="paginate" style="float:left;">'.$pages->display_pages().'</span>';
$text .= '<span style="float:right">';
// Go To Page
$text .= $pages->display_jump_menu();
$text .= '&nbsp;&nbsp;&nbsp;';
// Items per page
$text .= $pages->display_items_per_page();
$text .= '</span><br /><br />';

/* Stats/Results */
$q = "SELECT DISTINCT ".TBL_MATCHS.".*"
." FROM ".TBL_MATCHS.", "
.TBL_SCORES
." WHERE (".TBL_MATCHS.".Event = '$event_id')"
." AND (".TBL_SCORES.".MatchID = ".TBL_MATCHS.".MatchID)"
." AND (".TBL_MATCHS.".Status = 'active')"
." ORDER BY ".TBL_MATCHS.".TimeReported DESC"
." $pages->limit";

$result = $sql->db_Query($q);
$num_rows = mysql_numrows($result);
if ($num_rows>0)
{
	/* Display table contents */
	$text .= '<table class="table_left">';
	for($i=0; $i<$num_rows; $i++)
	{
		$match_id  = mysql_result($result,$i, TBL_MATCHS.".MatchID");
		$match = new Match($match_id);
		$text .= $match->displayMatchInfo(eb_MATCH_NOEVENTINFO);
	}
	$text .= '</table>';
}
$text .= '<br />';

$text .= '<div>';
$text .= ebImageLink('back_to_event', '', e_PLUGIN.'ebattles/eventinfo.php?eventid='.$event_id, '', 'action_back.gif', EB_MATCHS_L3.' '.EB_MATCHS_L4, 'jq-button');
$text .= '</div>';

$text .= '</div>';
$text .= '</div>';

$ns->tablerender("$event->getField('Name') ($gName - ".$event->eventTypeToString().")", $text);
require_once(FOOTERF);
exit;
?>

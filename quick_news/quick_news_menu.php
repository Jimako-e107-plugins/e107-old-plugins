<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     ©Ricardo Uceda 2007
|     http://www.ion-labs.com
|     ionlabs@gmail.com
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $Source: e107_plugins/quick_news/quick_news_menu.php,v $
|     $Revision: 1.0 $
|     $Author: Ricardo Uceda $
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

unset($text);

/* Get preferences */
$query = "SELECT `e107_value` FROM #core WHERE `e107_name`='quick_news_prefs' LIMIT 1 ;";
if ( $sql->db_Select_gen($query) ) {
	$qnprefs = $sql->db_Fetch();
	$qnprefs = $qnprefs['e107_value'];
} else {
	$qnprefs = 'a:6:{s:9:\"plgstatus\";s:1:\"1\";s:9:\"behaviour\";s:1:\"0\";s:9:\"direction\";s:1:\"0\";s:6:\"speedo\";s:1:\"2\";s:6:\"height\";s:2:\"50\";s:7:\"marquee\";s:1:\"0\";}';
}
$qnprefs = unserialize($qnprefs);
if ( !is_array($qnprefs) ) {
	$qnprefs = array( 'plgstatus' => '1', 'behaviour' => '0', 'direction' => '0', 'speedo' => '2', 'height' => '50', 'marquee' => '0' );
}

// Plugin active?
$qnenabled = ( isset($qnprefs['plgstatus']) && intval($qnprefs['plgstatus']) === 1 ) ? TRUE : FALSE;

if ( $qnenabled ) {
	$text = '';

	// Direction
	if ( intval($qnprefs['direction']) === 0 ) { $direction = 'up'; }
	elseif ( intval($qnprefs['direction']) === 1 ) { $direction = 'down'; }
	elseif ( intval($qnprefs['direction']) === 2 ) { $direction = 'left'; }
	elseif ( intval($qnprefs['direction']) === 3 ) { $direction = 'right'; } 
	else { $direction = 'up'; }

	// Behaviour
	$mouseoverstop = ( intval($qnprefs['behaviour']) === 1 ) ? " onMouseOver='this.stop()' onMouseOut='this.start()'" : '';

	// Height
	$height = ( intval($qnprefs['height']) > 5 ) ? intval($qnprefs['height']) : 50;

	// Speed
	$speed = ( intval($qnprefs['speedo']) > 0 ) ? intval($qnprefs['speedo']) : 2;
	$speed = ( $speed > 5 ) ? 5 : $speed;

	// Marquee?
	$marquee = ( intval($qnprefs['marquee']) !== 0 ) ? TRUE : FALSE;

	if ( $marquee === TRUE ) {
		$space = ( intval($qnprefs['direction']) === 0 || intval($qnprefs['direction']) === 1 ) ? '<br />' : '&nbsp;';
		$text = "<marquee id='qnscr' direction='$direction' height='${height}' style='height:${height}px;min-height:${height}px;' scrollamount='$speed'$mouseoverstop>";
		$query = "SELECT `qnew_text` FROM #quick_news WHERE `qnew_visible`=1 LIMIT 40 ;";
		if ( $sql->db_Select_gen($query) ) {
			while ( $row = $sql->db_Fetch() ) {
				$text .= "<span>".$row['qnew_text']."</span>$space";
			}
		} else {
			$text .= "<span>".QUICKNEWS_LAN05."</span>";
		}
	
		$text .= "</marquee>";
	} else {
		$text = "
	<script type='text/javascript'>
	<!--
		var frs = new Array();
		var scrollTimeOutID;
		var scrollTotalParagraphs;
		var scrollHeight;
		var scrollObject;
		var scrollSpeed;
		var scrollChild;
		var scrollText;
		var scrollOpacity;
		var run=1;
		var cnt=0;
		var scr=0;
		function init_scroll(eid, height, sspeed) {
			if ( typeof eid == \"string\" ) {
				height=( typeof(height) == \"number\" ) ? height : 50;
				sspeed=( typeof(sspeed) == \"number\" ) ? sspeed : 100;
				scrollObject=document.getElementById(eid);
				if ( scrollObject ) {
					for ( i=0; i<scrollObject.childNodes.length; i++ ) {
						if ( scrollObject.childNodes[i].nodeName == \"P\" ) {
							frs[cnt]=scrollObject.childNodes[i].innerHTML;
							cnt++;
						}
					}
					scrollSpeed=sspeed;
					scrollOpacity=0;
					scrollTotalParagraphs=cnt-1; cnt=0;
					scrollHeight=height;
					scrollObject.style.height=height+'px';
					scrollObject.innerHTML='';
					scrollChild=document.createElement(\"div\");
					scrollChild.setAttribute(\"style\", \"\");
					scrollChild.innerHTML=frs[0];
					scrollObject.appendChild(scrollChild);
					do_scroll();
				}
			}
		}
		function do_scroll() {
			if ( scr > scrollSpeed ) {
				scr=0;
				cnt++;
				if ( cnt > scrollTotalParagraphs ) { cnt=0; }
				scrollChild.innerHTML=frs[cnt];
				scrollOpacity=0;
			} else {
				if ( scr < (scrollSpeed / 2) ) { if ( scrollOpacity > (scrollSpeed / 4) ) { scrollOpacity=scrollOpacity+20; } else { scrollOpacity=scrollOpacity+5; } } else
				if ( scr > (scrollSpeed / 2) ) { if ( scrollOpacity < (scrollSpeed / 4) ) { scrollOpacity=scrollOpacity-5; } else { scrollOpacity=scrollOpacity-20; } }
				scrollOpacity=(scrollOpacity > 100) ? 100 : scrollOpacity;
				scrollOpacity=(scrollOpacity < 0) ? 0 : scrollOpacity;
				scrollChild.style.opacity=scrollOpacity/100;
				scrollChild.style.filter=\"alpha(opacity:\"+scrollOpacity+\")\";
				scrollChild.style.KHTMLOpacity=scrollOpacity/100;
				scrollChild.style.MozOpacity=scrollOpacity/100;
				if ( run == 1 ) { src=(scrollOpacity == 0) ? scr=scr+6 : scr++; }
			}
			scrollTimeOutID=setTimeout(\"do_scroll()\",50,\"JavaScript\");
		}
		function stop_scroll() {
			run=0;
		}
		function resume_scroll() {
			run=1;
		}
		function clear_timeout() {
			if (scrollTimeOutID) { clearTimeout(scrollTimeOutID); }
		}
		window.onunload=clear_timeout;
	-->
	</script>
";
		$mouseoverstop = ( intval($qnprefs['behaviour']) === 1 ) ? " onMouseOver='stop_scroll()' onMouseOut='resume_scroll()'" : '';
		$height = ( intval($qnprefs['height']) > 5 ) ? intval($qnprefs['height']) : 50;
		$speed = ( intval($qnprefs['speedo']) > 0 ) ? (intval($qnprefs['speedo'])*100) : 100;
		$speed = ( $speed > 500 ) ? 500 : 600-$speed;

		$text .= "<div id='qnscr' style='overflow:hidden;padding:2px;'$mouseoverstop>";

		$query = "SELECT `qnew_text` FROM #quick_news WHERE `qnew_visible`=1 LIMIT 40 ;";
		if ( $sql->db_Select_gen($query) ) {
			while ( $row = $sql->db_Fetch() ) {
				$text .= "<p>".$row['qnew_text']."</p>";
			}
		} else {
			$text = "<div style='overflow:hidden;padding:2px;'><p>".QUICKNEWS_LAN05."</p>";
		}

		$text .= '</div>';
		$text .= "<script type='text/javascript'>init_scroll('qnscr', $height, $speed);</script>";
	}

	$ns->tablerender(QUICKNEWS_TITLE, $text, 'quick_news');
}

unset($text);
?>

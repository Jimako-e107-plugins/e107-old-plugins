<?php
/*
+---------------------------------------------------------------+
|        YouTube Gallery v4.01 - by Erich Radstake
|        http://www.erichradstake.nl
|        info@erichradstake.nl
|
|        This is a module for the e107 .7+ website system
|        Copyright Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
require_once(e_HANDLER."userclass_class.php");
require_once(HEADERF);

$lan_file = e_PLUGIN."ytm_gallery/languages/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."ytm_gallery/languages/English.php");


$rowsPerPage = (10);

$pageNum = 1;


if(isset($_GET['paging']))
{
	$pageNum = $_GET['paging'];
}

$offset = ($pageNum - 1) * $rowsPerPage;

function getMySQLZoekterm($zoekterm){

    // Stripslashes, indien nodig
    $zoekterm  = (get_magic_quotes_gpc == 0 ? stripslashes($zoekterm) : $zoekterm);

    // Vervang de spaties tussen " en " door een |
    if (preg_match_all('/\"(.*?)\"/', $zoekterm, $matches, PREG_SET_ORDER)) {
        foreach($matches as $match) {
            $zoekterm = str_replace($match[0], str_replace(' ', '|', $match[0]), $zoekterm);
        }
    }

    // Vervang de spaties tussen ( en } door een ~
    if (preg_match_all('/\((.*?)\)/', $zoekterm, $matches, PREG_SET_ORDER)) {
        foreach($matches as $match) {
            $zoekterm = str_replace($match[0], str_replace(' ', '~', $match[0]), $zoekterm);
        }
    }

    // Stop de zoektermen in een array
    $zoektermTemp = preg_split("/[\s,]+/", $zoekterm);

    // Doorloop de zoektermen, op zoek naar dubbele keywords achter elkaar
    $aantalAND     = 0;
    $aantalOR   = 0;
    $zoekterm = array();
    $i = 0;
    while(list($key, $val) = each($zoektermTemp)){

        if (strtoupper($val) == "AND" OR strtoupper($val) == "OR"){

            // Als de term hiervoor ook al een operator is, deze verwijderen
            if ($key != 0){
                if (!(    strtoupper($zoektermTemp[$key-1]) == "AND" OR
                        strtoupper($zoektermTemp[$key-1]) == "OR")){
                    $zoekterm[$i] = strtoupper($val);
                    $i++;

                    // Tel aantal AND en OR's die overblijven
                    if (strtoupper($val) == "AND"){
                        $aantalAND++;
                    }else{
                        $aantalOR++;
                    }
                }
            }

        }else{

            // Als de vorige term geen operator was, moet er nu een AND tussen
            if ($i > 0){
                if ($zoekterm[$i-1] != "AND" AND $zoekterm[$i-1] != "OR"){
                    $zoekterm[$i] = "AND";
                    $i++;
                }
            }

            // Zoekterm toevoegen
            $zoekterm[$i] = $val;
            $i++;

        }

    }

    // Doorloop de zoektermen, op zoek naar een AND
    while(list($key, $val) = each($zoekterm)){

        if (strtoupper($val) == "AND"){

            // De term voor en na deze term zijn verplicht
            if ($key != 0){
                // Voorkom een dubbel plusje
                if (substr($zoekterm[$key-1], 0, 1) != "+"){
                    $zoekterm[$key-1] = "+" . $zoekterm[$key-1];
                }
            }
            if ($key != count($zoekterm) - 1){
                $zoekterm[$key+1] = "+" . $zoekterm[$key+1];
            }

        }

    }

    // Als er AND én OR in de zoektermen voorkomt, moeten er ronde haken om het AND-deel
    if ($aantalAND > 0 && $aantalOR > 0){

        reset($zoekterm);

        while(list($key, $val) = each($zoekterm)){

            // Openingshaak: (
            if ($key != count($zoekterm) - 1){
                if ($zoekterm[$key+1] == "AND"){
                    $zoekterm[$key] = "(" . $zoekterm[$key];
                }
            }

            // Sluithaak: )
            if ($key != 0){
                if ($zoekterm[$key-1] == "AND"){
                    $zoekterm[$key] = $zoekterm[$key] . ")";
                }
            }

        }

    }

    // Haal de | en ~ weer weg
    $zoekterm = str_replace("|",     " ",     $zoekterm);
    $zoekterm = str_replace("~",     " ",     $zoekterm);

    // Haal handmatig de AND en OR weg
    $zoekterm = str_replace("AND",     "",     $zoekterm);
    $zoekterm = str_replace("OR",     "",     $zoekterm);

    // Plak de zoekterm weer aan elkaar
    $zoekterm = implode(" ", $zoekterm);

    return $zoekterm;

}


$post_search     = $_POST['search'];
$url_search      = $_GET['string'];
$back_page       = $_POST['refp'];
$back_cat        = $_POST['refc'];

if (!$back_page) {$back_page = $_GET['refp'];}
if (!$back_cat)  {$back_cat = $_GET['refc'];}

if ($back_page) {$galsp = "&refp=$back_page";}
if ($back_cat)  {$galsp .= "&refc=$back_cat";}

if (!$post_search == "") {$ytm_search = $post_search;}else{$ytm_search = $url_search;}

if (!$back_cat == ""){$backbutton = "paging=$back_page&cat=$back_cat";}else{$backbutton = "paging=$back_page";}

$text .= "<br />";

if ($ytm_search) {

$ytm_search02 = getMySQLZoekterm($ytm_search);



// Perform query

            $classes02 = e_CLASS_REGEXP;
            $classes02 = str_replace("(^|,)(", "", $classes02);
            $classes02 = str_replace(")(,|$)", "", $classes02);
            $classes02 = (explode("|",$classes02));


            $qspec02_i = 0;
            foreach($classes02 as $class02) {
            $qspec02 = $class02;
            if (!$qspec02_i == 0) {$pre_qspecq02 = "OR";}
            $qspecq02 .= "$pre_qspecq02 cat_auth = '$qspec02' ";
            $qspec02_i++;
            }
            $auth_spec02 .=  "($qspecq02)";

$query02        = "SELECT movie_title, cat_name, movie_code, input_user, timestamp, MATCH(movie_title) AGAINST('*$ytm_search02*' IN BOOLEAN MODE) AS score FROM ".MPREFIX."er_ytm_gallery_movies nm
                  LEFT JOIN ".MPREFIX."er_ytm_gallery_category nc ON nm.movie_category = nc.cat_id
                  WHERE MATCH(movie_title) AGAINST('*$ytm_search02*' IN BOOLEAN MODE)
                  AND active = '1' AND input_status = '1' AND $auth_spec02 ORDER BY 'score' DESC LIMIT $offset, $rowsPerPage;";
$result02       = mysql_query($query02);
$num_rows02     = mysql_num_rows($result02);

if (!$back_cat == ""){$galc="&galc=$back_cat";}

if (!$num_rows02 == 0) {



      while ($row02 = mysql_fetch_array($result02,MYSQL_ASSOC)) {
      $movie_code      = $row02['movie_code'];
      $movie_title     = $row02['movie_title'];
      $movie_cat       = $row02['cat_name'];
      $movie_score     = $row02['score'];
      $movie_user      = $row02['input_user'];
      $movie_timestamp = $row02['timestamp'];
      $movie_timestamp = date("d-m-Y", strtotime($movie_timestamp));
      
$movie_title = eregi_replace($ytm_search,"<span class='searchhighlight'>" . $ytm_search . "</span>",$movie_title);


      $text .= "
      <a href='ytm.php?view=$movie_code&string=$ytm_search&sp=$pageNum&galp=$back_page$galc'>$movie_title</a><br />
      <sup>" . LAN_YTM_PAGE_9 . " $movie_cat " . LAN_YTM_PAGE_10 . " $movie_user " . LAN_YTM_PAGE_11 . " $movie_timestamp</sup><br /><br />";
      }




}else{
$text .= "" . LAN_YTM_PAGE_22 . "<br /><br />";
}

}else{
$text .= "" . LAN_YTM_PAGE_23 . "<br /><br />";
}

$text .= "<center>";


$query03   = "SELECT COUNT(movie_code) AS numrows FROM ".MPREFIX."er_ytm_gallery_movies nm
              LEFT JOIN ".MPREFIX."er_ytm_gallery_category nc ON nm.movie_category = nc.cat_id
              WHERE MATCH(movie_title) AGAINST('*$ytm_search02*' IN BOOLEAN MODE)
              AND active = '1' AND input_status = '1' AND $auth_spec02;";
$result03  = mysql_query($query03);
$row03     = mysql_fetch_array($result03, MYSQL_ASSOC);
$numrows   = $row03['numrows'];


$maxPage = ceil($numrows/$rowsPerPage);

$self = "" . e_SELF . "";



if ($pageNum > 1)
{
	$paging = $pageNum - 1;
	$prev = " <a href=\"$self?paging=$paging&string=$ytm_search$galsp\">" . LAN_YTM_PAGE_5 . "</a>&nbsp;&nbsp;--&nbsp;&nbsp;";

	$first = " <a href=\"$self?paging=1&string=$ytm_search$galsp\">" . LAN_YTM_PAGE_6 . "</a>&nbsp;&nbsp;";
}

// First Page
else
{
	$prev  = "";
	$first = "";
}


if ($pageNum < $maxPage)
{
	$paging = $pageNum + 1;
	$next = "&nbsp;&nbsp;--&nbsp;&nbsp;<a href=\"$self?paging=$paging&string=$ytm_search$galsp\">" . LAN_YTM_PAGE_7 . "</a>&nbsp;&nbsp;";

	$last = " <a href=\"$self?paging=$maxPage&string=$ytm_search$galsp\">" . LAN_YTM_PAGE_8 . "</a> ";
}

// Last Page
else
{
	$next = "";
	$last = "";
}

$text .= "<br />$first$prev " . LAN_YTM_PAGE_3 . " <strong>$pageNum</strong> " . LAN_YTM_PAGE_4 . " <strong>$maxPage</strong>$next$last";

$text .= "<br /><br />";
$text .= "<a href='search_help.php' title='" . LAN_YTM_HELP_31 . "' onclick=\"window.open('search_help.php','help','width=500,height=500,scrollbars=no,toolbar=no,location=no,resizable=no,menubar=no,directories=no,status=no'); return false\">" . LAN_YTM_HELP_31 . "</a>";
$text .= " - ";
$text .= "<a href='ytm.php?$backbutton' title='" . LAN_YTM_PAGE_14 . "'>" . LAN_YTM_PAGE_14 . "</a>";
$text .= "</center>";

   $ns->tablerender(LAN_YTM_PAGE_18 , $text);
   require_once(FOOTERF);
?>


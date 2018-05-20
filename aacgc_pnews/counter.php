<?php

include_lan(e_PLUGIN."aacgc_pnews/languages/".e_LANGUAGE.".php");

$count = "0";

$sql4 = new db;
$sql4->mySQLresult = @mysql_query("select * from ".MPREFIX."aacgc_pnews_counter where page='".intval($page)."';");
$row4 = $sql4->db_fetch();

$count = $row4['counter'];

$pageviews = "<i>(".PNEWS_01.": ".$count.")</i>";

$count = $count + 1;

$sql->db_Update("aacgc_pnews_counter", "countid='".intval($row4['countid'])."',counter='".intval($count)."',visitor='0' WHERE page='".intval($page)."'");


?>
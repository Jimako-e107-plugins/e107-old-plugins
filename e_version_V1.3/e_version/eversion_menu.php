<?php
/*
+---------------------------------------------------------------+
|        e_Version for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
$evrsn_text = $e107cache->retrieve("nq_eversion_menu");
if ($evrsn_text)
{
    echo $evrsn_text;
}
else
{
    include_lan(e_PLUGIN . "e_version/languages/" . e_LANGUAGE . ".php");

    global $tp;
    // $evrsn_cache = new ecache;
    if (!$evrsn_text)
    {
        $evrsn_url = SITEURL . e_PLUGIN . "e_version/";
        $evrsn_text .= "<div class='fborder' style='text-align:left;padding:5px;'><b>" . EVERSION_2 . "</b><br /><a href='".e_PLUGIN."e_version/eversion.php'>".EVERSION_30."</a><br />";
        // Random menu item

        if ($sql->db_Select("eversion", "*", "order by eversion_name asc ", "nowhere"))
        {
            while ($evrsn_row = $sql->db_Fetch())
            {
                extract($evrsn_row);
                $evrsn_text .= "<br /><a href='" . e_PLUGIN . "e_version/eversion.php?0.view.$eversion_id'>" . $tp->toHTML($eversion_name, false) . "</a> " . $eversion_major . "." . str_pad($eversion_minor, 2, "0", STR_PAD_LEFT);
                if ($eversion_beta > 0)
                {
                    $evrsn_text .= " RC" . $eversion_beta;
                }
                $evrsn_text .= "<br />";
            } // while
        }
        else
        {
            $evrsn_text .= EVERSION_3;
        }
        $evrsn_text .= "</div>";
        ob_start();
        $ns->tablerender(EVERSION_1, $evrsn_text);
        $evrsn_cache = ob_get_flush();
        $e107cache->set("nq_eversion_menu", $evrsn_cache);
    }
}

?>
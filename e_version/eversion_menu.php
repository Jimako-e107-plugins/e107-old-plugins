<?php
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
    if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "e_version/languages/" . e_LANGUAGE . ".php"))
    {
        include_once(e_PLUGIN . "e_version/languages/" . e_LANGUAGE . ".php");
    }
    else
    {
        include_once(e_PLUGIN . "e_version/languages/English.php");
    }

    global $tp;
    // $evrsn_cache = new ecache;
    if (!$evrsn_text)
    {
        $evrsn_url = SITEURL . e_PLUGIN . "e_version/";
        $evrsn_text .= "<div class='fborder' style='text-align:left;padding:5px;'>" . EVERSION_2 . "<br />";
        // Random menu item
        if ($pref['eversion_inmenu'] > 0)
        {
            $eversion_limit = "limit 0," . $pref['eversion_inmenu'] ;
        }
        else
        {
            $eversion_limit = "";
        }
        if ($sql->db_Select("eversion", "*", "order by eversion_name asc $eversion_limit", "nowhere"))
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
        $ns->tablerender($pref['bugtrack_menutitle'], $evrsn_text);
        $evrsn_cache = ob_get_flush();
        $e107cache->set("nq_eversion_menu", $evrsn_cache);
    }
}

?>
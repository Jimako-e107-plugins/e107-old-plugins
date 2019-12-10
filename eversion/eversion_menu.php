<?php
if (!defined('e107_INIT'))
{
    exit;
}
$evrsn_text = e107::getCache()->retrieve("nq_eversion_menu");

if(!empty($parm))
{

	if(isset($parm['eversionCaption'][e_LANGUAGE]))
	{
		$caption = $parm['eversionCaption'][e_LANGUAGE];
	}
	else  $caption = EVERSION_LINKTITLE;
	if(isset($parm['eversionLimit'][e_LANGUAGE]))
	{
		$limit = $parm['eversionLimit'];
	}
	else $limit = 5;
}
else
{
	$caption = EVERSION_LINKTITLE;
	$limit = 5;
}


if ($evrsn_text)
{
    echo $evrsn_text;
}
else
{
    // $evrsn_cache = new ecache;
    if (!$evrsn_text)
    {
 
				$evrsn_url = SITEURL . e_PLUGIN_ABS . "eversion/";
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
        if ($allRows = e107::getDb()->retrieve("eversion", "*", "WHERE TRUE order by eversion_name asc $eversion_limit LIMIT $limit" , 'true' ))
        {
            foreach($allRows as $row)
            {
                $eversion_id = $row['eversion_id'];  
                $eversion_name = $row['eversion_name'];
                $eversion_beta = $row['eversion_beta'];                
								$evrsn_text .= "<br /><a href='" . e_PLUGIN_ABS . "eversion/eversion.php?0.view.$eversion_id'>" . e107::getParser()->toHTML($eversion_name, false) . "</a> " . $eversion_major . "." . str_pad($eversion_minor, 2, "0", STR_PAD_LEFT);
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
        e107::getRender()->tablerender($caption, $evrsn_text);
        $evrsn_cache = ob_get_flush();
        e107::getCache()->set("nq_eversion_menu", $evrsn_cache);
    }
}

?>
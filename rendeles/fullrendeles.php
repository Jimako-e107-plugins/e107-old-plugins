<?php
require_once("../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); }
require_once(e_HANDLER."calendar/calendar_class.php");
$cal = new DHTML_Calendar(true);
function headerjs()
{
        global $cal;
        return $cal->load_files();
}

if (is_readable(THEME . "rendeles_template.php")){
    require_once(THEME . "rendeles_template.php");}
else{
    require_once(e_PLUGIN . "rendeles/rendeles_template.php");}

require_once(e_HANDLER."userclass_class.php");
include_lan(e_PLUGIN."rendeles/languages/".e_LANGUAGE.".php");

if (!defined("USER_WIDTH")){ define("USER_WIDTH","width:95%"); }
	require_once(HEADERF);

$qp = new rendeles;

class rendeles {
	var $message;
	function rendeles() {
		
		if(isset($_POST['edit'])) {
			$this -> editSme();
		}
		else if(!$_POST['edit']) {
			$this -> showList();
		}
	}

function showList()
{
	global $sql, $ns, $tp, $pref;
	$sql2 = new db();
	$sql3 = new db();
	$gen = new convert;
	if (isset($_GET['togglecomp_1']))
	{
		$sql -> db_Update('rendeles', "rendeles_paid='" . ($_GET['togglecomp_1'] == 1 ? 0 : 1) . "' WHERE rendeles_id='" . intval($_GET['id']) . "' ");
	}
	if (isset($_GET['togglecomp_2']))
	{
		$sql -> db_Update('rendeles', "rendeles_completed='" . ($_GET['togglecomp_2'] == 1 ? 0 : 1) . "' WHERE rendeles_id='" . intval($_GET['id']) . "' ");
	}
	if (isset($_GET['togglecomp_3']))
	{
		$sql -> db_Update('rendeles', "rendeles_bannerscompleted='" . ($_GET['togglecomp_3'] == 1 ? 0 : 1) . "' WHERE rendeles_id='" . intval($_GET['id']) . "' ");
	}
	$rid = isset($_GET['id']) ? intval($_GET['id']) : 0;
	$count = $sql -> db_Select_gen("
			SELECT * FROM #rendeles r 
			
			inner join #rendeles_banner b 
			on r.rendeles_bannerid = b.rendeles_banner_id 
			
			inner join #rendeles_type t 
			on r.rendeles_typeid = t.rendeles_type_id
			
			inner join #rendeles_customer c
			on r.rendeles_customerid = c.rendeles_customer_id
			
			where r.rendeles_id = $rid
		", false);
	$text = "<meta http-equiv='content-type' content='text/html; charset=UTF-8' />";
	$text .= "<link rel='stylesheet' href='" . THEME_ABS . "style.css' type='text/css' />";
	$text .= "<link rel='stylesheet' href='" . $eplug_folder . "style.css' type='text/css' />";
	$text .= "  <div style='text-align:center'>";
	if (!$count)
	{
		$text .= RENDELES_ADLAN_13;
		$ns -> tablerender("<div style='text-align:center'>" . RENDELES_ADLAN_34 . "</div>", $text);
		exit ;
	}
	while ($row = $sql -> db_Fetch())
	{
		$eredmeny = calcPrice($row['rendeles_id']);
		$szint2 = "  <form action='" . e_SELF . "' id='display' method='post'>";
		$szint2 .= "    <center>";
		$szint2 .= "      <table class='fborder' style='width:100%;'>";
		$szint2 .= "        <tr>";
		$szint2 .= "          <td style='width:20%; text-align: center;' class='forumheader' id='name' rowspan='3' >" . $tp -> toHTML($row['rendeles_customer_name'], "", "defs") . "</td>";
		$szint2 .= "          <td style='width:40%; text-align: center; background: url(" . $eplug_folder . "images/forumheader$row[rendeles_paid].png) repeat-x top left;' class='forumheader3'><div class='price'>" . ($row['rendeles_paid'] ? RENDELES_56 : RENDELES_54) . ": " . $eredmeny . "" . $pref['rendeles_currency'] . "</div></td>";
		$szint2 .= "          <td style='width:40%; text-align: center; background: url(" . $eplug_folder . "images/forumheader$row[rendeles_paid].png) repeat-x top left;' class='forumheader3' colspan='2'>";
		$szint2 .= "            <div class='price'>";
		$szint2 .= "              <a href='" . e_SELF . "?togglecomp_1=$row[rendeles_paid]&amp;id=$row[rendeles_id]' title='" . ($row['rendeles_paid'] ? RENDELES_ADLAN_46 : RENDELES_ADLAN_47) . "' style='border:0px none;'>";
		$szint2 .= "                <img src='" . $eplug_folder . "images/$row[rendeles_paid].png' />";
		$szint2 .= "              </a>";
		$szint2 .= "            </div>";
		$szint2 .= "          </td>";
		$szint2 .= "        </tr>";
		$szint2 .= "        <tr>";
		$szint2 .= "          <td style='width:40%; text-align: center;' class='forumheader3'><div class='date-font'>" . RENDELES_62 . "" . $rendeles_date_a = $gen -> convert_date($row['rendeles_date_a']) . "" . RENDELES_61 . "</div></td>";
		$szint2 .= "          <td style='width:40%; text-align: center;' class='forumheader3' colspan='2'><div id='date' style='background: url(" . $eplug_folder . "images/forumheader$row[rendeles_completed].png) repeat-x top left;'>" . $rendeles_date_b = $gen -> convert_date($row['rendeles_date_b'], short) . "</div></td>";
		$szint2 .= "        </tr>";
		$szint2 .= "        <tr>";
		$szint2 .= "          <td style='width:40%; text-align: center; background: url(" . $eplug_folder . "images/forumheader$row[rendeles_completed].png) repeat-x top left;' class='forumheader3'><div class='completed'>" . ($row['rendeles_completed'] ? RENDELES_59 : RENDELES_60) . "</div></td>";
		$szint2 .= "          <td style='width:40%; text-align: center; background: url(" . $eplug_folder . "images/forumheader$row[rendeles_completed].png) repeat-x top left;' class='forumheader3' colspan='2'>";
		$szint2 .= "            <div class='completed'>";
		$szint2 .= "              <a href='" . e_SELF . "?togglecomp_2=$row[rendeles_completed]&amp;id=$row[rendeles_id]' title='" . ($row['rendeles_completed'] ? RENDELES_ADLAN_46 : RENDELES_ADLAN_47) . "' style='border:0px none;'>";
		$szint2 .= "                <img src='" . $eplug_folder . "images/$row[rendeles_completed].png' />";
		$szint2 .= "              </a>";
		$szint2 .= "            </div>";
		$szint2 .= "          </td>";
		$szint2 .= "        </tr>";
		$szint2 .= "        <tr>";
		$szint2 .= "          <td style='width:20%; text-align: center;' class='forumheader3'><div class='font-left'>" . RENDELES_9 . "</div></td>";
		$szint2 .= "          <td style='width:80%; text-align: center;' class='forumheader3' colspan='3'><div class='font-type'>" . $tp -> toHTML($row['rendeles_type_name'], "", "defs") . "</div></td>";
		$szint2 .= "        </tr>";
		$szint2 .= "        <tr>";
		$szint2 .= "          <td style='width:20%; text-align: center;' class='forumheader3'><div class='font-left'>" . RENDELES_41 . "</div></td>";
		$szint2 .= "          <td style='width:80%; text-align: center;' class='forumheader3' colspan='3'>";
		$szint4 = "         <tr>";
		$szint4 .= "          <td style='width:20%; text-align: center;' class='forumheader3'><div class='font-left'>" . RENDELES_11 . "</div></td>";
		$szint4 .= "          <td style='width:75%; text-align: center; background: url(" . $eplug_folder . "images/forumheader$row[rendeles_bannerscompleted].png) repeat-x top left;' class='forumheader3' colspan='2'><div class='banners-font'>" . $tp -> toHTML($row['rendeles_banner_banners'], "", "defs") . "</div></td>";
		$szint4 .= "          <td style='width:5%;  text-align: center; background: url(" . $eplug_folder . "images/forumheader$row[rendeles_bannerscompleted].png) repeat-x top left;' class='forumheader3'>";
		$szint4 .= "            <a href='" . e_SELF . "?togglecomp_3=$row[rendeles_bannerscompleted]&amp;id=$row[rendeles_id]' title='" . ($row['rendeles_bannerscompleted'] ? RENDELES_ADLAN_46 : RENDELES_ADLAN_47) . "' style='border:0px none;'>";
		$szint4 .= "              <img src='" . $eplug_folder . "images/$row[rendeles_bannerscompleted].png' />";
		$szint4 .= "            </a>";
		$szint4 .= "          </td>";
		$szint4 .= "        </tr>";
		$szint4 .= "        <tr>";
		$szint4 .= "          <td style='width:20%; text-align: center;' class='forumheader3'><div class='font-left'>" . RENDELES_15 . "</div></td>";
		$szint4 .= "          <td style='width:80%; text-align: center;' class='forumheader3' colspan='3'><div class='font'>" . $tp -> toHTML($row['rendeles_comment'], "", "defs") . "</div></td>";
		$szint4 .= "        </tr>";
		$szint4 .= "        <tr>";
		$szint4 .= "          <td style='width:20%; text-align: center;' class='forumheader3'><div class='font-left'>" . RENDELES_63 . "</div></td>";
		$szint4 .= "          <td style='width:80%; text-align: center;' class='forumheader3' colspan='3'><div class='font'>" . $tp -> toHTML($row['rendeles_location'], "", "defs") . "</div></td>";
		$szint4 .= "        </tr>";
		$sql3 -> db_select_gen("
			      
				    SELECT * FROM #rendeles_rendflowers g
				
				    inner join #rendeles_flower b
				    on g.rendeles_rendflowers_flowerid = b.rendeles_flower_id
          
				    inner join #rendeles_color f
				    on g.rendeles_rendflowers_colorid = f.rendeles_color_id

				    inner join #rendeles c
				    on g.rendeles_rendflowers_rendelesid = c.rendeles_id
				
				    where c.rendeles_id = $row[rendeles_id]
				
				    ORDER BY rendeles_rendflowers_rendelesid ASC
				    
				    ", false);
		$szint3 = "           <table style='width:100%;'>";
		while ($row3 = $sql3 -> db_fetch())
		{
			$szint3 .= "            <tr>";
			$szint3 .= "              <td class='forumheader3' id='flower' style='background: url(" . $eplug_folder . "images/$row3[rendeles_color_name].png) repeat-x top left;'>" . $tp -> toHTML($row3['rendeles_color_name'], "", "defs") . "</td>";
			$szint3 .= "              <td class='forumheader3' id='flower' style='background: url(" . $eplug_folder . "images/$row3[rendeles_color_name].png) repeat-x top left;'>" . $tp -> toHTML($row3['rendeles_flower_size'], "", "defs") . "</td>";
			$szint3 .= "              <td class='forumheader3' id='flower' style='background: url(" . $eplug_folder . "images/$row3[rendeles_color_name].png) repeat-x top left; text-transform: uppercase;'>" . $tp -> toHTML($row3['rendeles_flower_name'], "", "defs") . "</td>";
			$szint3 .= "              <td class='forumheader3' id='flower' style='background: url(" . $eplug_folder . "images/$row3[rendeles_color_name].png) repeat-x top left;'>" . $tp -> toHTML($row3['rendeles_rendflowers_darab'], "", "defs") . " " . RENDELES_46 . "</td>";
			$szint3 .= "            </tr>";
		}
		$szint3 .= "          </table>";
		$text .= "      $szint2";
		$text .= "            $szint3";
		$text .= "          $szint4";
		$text .= "          <tr>";
		$text .= "            <td class='forumheader3' style='text-align:center' colspan='4'><a href='" . $eplug_folder . "rendeles.php' class='button'>" . RENDELES_52 . "</a></td>";
		$text .= "          </tr>";
	}
	$text .= "
                    </table>
		              </center>
                </form>
              </div>
	";
	$ns -> tablerender("<div style='text-align:center'>" . RENDELES_64 . "</div>", $text);
}}

function calcPrice($rendelesid){
	$sql = new db();
	$qry = "
		select
		(sum(flower_sum.fprice) + other_sum.tp + other_sum.bp) as price
		from
			(select
			r.rendeles_id as rid,
			rf.rendeles_rendflowers_darab as fdb,
			rendeles_flower_price as fe,
			rf.rendeles_rendflowers_darab * f.rendeles_flower_price as fprice
			from
				".MPREFIX."rendeles r
				inner join ".MPREFIX."rendeles_rendflowers rf
					on r.rendeles_id = rf.rendeles_rendflowers_rendelesid
				inner join ".MPREFIX."rendeles_flower f
					on rf.rendeles_rendflowers_flowerid = f.rendeles_flower_id
				where rendeles_id = $rendelesid) as flower_sum,
			(select
			t.rendeles_type_price as tp,
			b.rendeles_banner_price as bp
			from
				".MPREFIX."rendeles r
				inner join ".MPREFIX."rendeles_type t
					on r.rendeles_typeid = t.rendeles_type_id
				inner join ".MPREFIX."rendeles_banner b
					on r.rendeles_bannerid = b.rendeles_banner_id
				where rendeles_id = $rendelesid) as other_sum
		";
	$sql->db_query($qry);
	$row = $sql->db_fetch();
	return $row ? $row['price'] : 0;
}	

?>
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

   $text .= $tp->parseTemplate($RENDELES_HEADER, false);
   $ns -> tablerender("".RENDELES_18."", $text);	

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
	global $sql,$ns,$tp,$pref;
	
	$sql2 = new db();
	$sql3 = new db();

// lapozás ------------------------------------------------------------------------------
    $from = ($_GET['frm']) ? $_GET['frm'] : 0;
    $total_items = $sql -> db_Select("rendeles", "*", "rendeles_id"); 	
// lapozás ------------------------------------------------------------------------------
	
  if (isset($_GET['cid'])){
	  $cid = "where c.rendeles_customer_id = '".intval($_GET['cid'])."' ";} 
  else $cid = "";	
	
	$count = $sql -> db_Select_gen("
		SELECT * FROM #rendeles_customer c 
		
		inner join
			(select rendeles_customerid, count(rendeles_id) as cr from #rendeles group by rendeles_customerid) rc
		on rc.rendeles_customerid = c.rendeles_customer_id
		
		$cid
		ORDER BY c.rendeles_customer_name asc
    LIMIT $from,".$pref['rendeles_perpage']."
		", false);
	
	$text = "<div style='text-align:center'>";
	
	/* Ha üres, nincs még Rendelés */
	if (!$count)
	{
		$text .= RENDELES_ADLAN_13;
		$ns -> tablerender("<div style='text-align:center'>".RENDELES_20."</div>", $text);
		exit;
	}
	
	/* Lista fejlécének létrehozása - ID / Módosítás és törlés Ikonok / Rendelés */
	$text .= "
		<form action='".e_SELF."' id='display' method='post'>
		<center>
		<table class='fborder' style='width:100%;'>
		<tr>
		<td style='width:10%; text-align: center;' class='forumheader'>".RENDELES_28."</td>
		<td style='width:15%; text-align: center;' class='forumheader'><a href='".$eplug_folder."type.php' title='".RENDELES_22."'>".RENDELES_33."</a></td>
		<td style='width:20%; text-align: center;' class='forumheader'><a href='".$eplug_folder."banners.php' title='".RENDELES_21."'>".RENDELES_34."</a></td>
		<td style='width:15%; text-align: center;' class='forumheader'>".RENDELES_15."</td>
    <td style='width:40%; text-align: center;' class='forumheader'>".RENDELES_41."</td>
		</tr>
		";
	
	// ciklus megrendelők listázására 1. szint
	while($row = $sql-> db_Fetch())
	{
		// csak akkor megyünk tovább, ha van megrendelése a megrendelőnek
		if ($row['cr'])
		{
			$sql2->db_select_gen("
				SELECT * FROM #rendeles r 
				
				inner join #rendeles_banner b 
				on r.rendeles_bannerid = b.rendeles_banner_id 
				
				inner join #rendeles_type t 
				on r.rendeles_typeid = t.rendeles_type_id
				
				where r.rendeles_customerid = $row[rendeles_customer_id]
				
				ORDER BY r.rendeles_id ASC
				", false);
			
			$szint2 = "";
			
			// ciklus megrendelések listázására 2. szint
			while ($row2 = $sql2->db_fetch())
			{
				$sql3->db_select_gen("
					SELECT * FROM #rendeles_rendflowers g
					
					inner join #rendeles_flower b
					on g.rendeles_rendflowers_flowerid = b.rendeles_flower_id
					
					inner join #rendeles_color f
					on g.rendeles_rendflowers_colorid = f.rendeles_color_id
					
					inner join #rendeles c
					on g.rendeles_rendflowers_rendelesid = c.rendeles_id
					
					where c.rendeles_id = $row2[rendeles_id]
					
					ORDER BY rendeles_rendflowers_rendelesid ASC
					", false);
				
				$szint3 = "<table class='fborder' style='width:100%;' id='szint3'>";
				
				// ciklus virágok listázására 3. szint
				while ($row3 = $sql3->db_fetch())
				{
					$szint3 .= "
						<tr>
						<td class='forumheader3' id='flower' style='background: url(".$eplug_folder."images/$row3[rendeles_color_name].png) repeat-x top left;'>".$tp->toHTML($row3['rendeles_color_name'],"","defs")."</td>					
						<td class='forumheader3' id='flower' style='background: url(".$eplug_folder."images/$row3[rendeles_color_name].png) repeat-x top left;'>".$tp->toHTML($row3['rendeles_flower_size'],"","defs")."</td>			
						<td class='forumheader3' id='flower' style='background: url(".$eplug_folder."images/$row3[rendeles_color_name].png) repeat-x top left;'>".$tp->toHTML($row3['rendeles_flower_name'],"","defs")."</td>
						<td class='forumheader3' id='flower' style='background: url(".$eplug_folder."images/$row3[rendeles_color_name].png) repeat-x top left;'>".$tp->toHTML($row3['rendeles_rendflowers_darab'],"","defs")."</td>         
						</tr>";
				}
				$szint3 .= "</table>";
				
				if ($szint2 != "") $szint2 .= "<tr>";
				$szint2 .= "
					<td style='text-align: center;' class='fborder'>".$tp->toHTML($row2['rendeles_type_name'],"","defs")."</td>
					<td style='text-align: center;' class='fborder'>".$tp->toHTML($row2['rendeles_banner_banners'],"","defs")."</td>
					<td style='text-align: center;' class='fborder'>".$tp->toHTML($row2['rendeles_comment'],"","defs")."</td>
					<td style='text-align: center;' class='forumheader3'>$szint3</td>
					</tr>
					";
			}
		} else $szint2 = "";

		$text .= "
			<tr>
	      <td rowspan='$row[cr]' style='text-align: center;' class='forumheader'><a href='?cid=$row[rendeles_customer_id]'>".$tp->toHTML($row['rendeles_customer_name'],"","defs")."</a></td>
      $szint2
			";
	}
	
	$text .= "
		<tr>
		<td class='forumheader3' id='flower' colspan='4'>Összesen:</td>
		";
	
	if ($sql->db_Select("rendeles_rendflowers", "sum(rendeles_rendflowers_darab) AS total", '', 'nowhere'))
	{
		$row = $sql->db_Fetch();
		$eredmeny = $row['total'];
	}
	
	$text .= "
		<td class='forumheader3' id='flower'>".$eredmeny."</td>
		</tr></table>
		</center></div></form>
		";
		
// lapozás ------------------------------------------------------------------------------     
  $parms = $total_items.",".$pref['rendeles_perpage'].",".$from.",".e_SELF.'?frm=[FROM]';
  $text .= "<div style='text-align: center'>".$tp->parseTemplate("{NEXTPREV={$parms}}")."</div>";
// lapozás ------------------------------------------------------------------------------
		
	$ns -> tablerender("<div style='text-align:center'>".RENDELES_41."</div>", $text);
}}

?>
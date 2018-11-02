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

require_once(e_HANDLER."userclass_class.php");
include_lan(e_PLUGIN."rendeles/languages/".e_LANGUAGE.".php");

if (!defined("USER_WIDTH")){ define("USER_WIDTH","width:95%"); }

   $text = "
     <meta http-equiv='content-type' content='text/html; charset=UTF-8' />
     <link rel='stylesheet' href='".THEME_ABS."style.css' type='text/css' />
     <link rel='stylesheet' href='".$eplug_folder."style.css' type='text/css' />
     <div style='margin: 10px;'>
       <div class='forumheader3' style='text-align: center;'>
         <center>
       
           <table border='0' cellpadding='10' cellspacing='5'>
            <tr>
              <td width='25%' align='center' valign='middle'><a href='".SITEURL."index.php' class='button'>".RENDELES_19."</a></td>
              <td width='25%' align='center' valign='middle'><a href='".$eplug_folder."rendeles.php' class='button'>".RENDELES_27."</a></td>
              <td width='25%' align='center' valign='middle'><a href='".$eplug_folder."addrendeles.php' class='button'>".RENDELES_1."</a></td>
              <td width='25%' align='center' valign='middle'><a href='".$eplug_folder."admin_rendeles.php' class='button'>".RENDELES_38."</a></td>
            </tr>
            <tr>
              <td width='25%' align='center' valign='middle'><a href='".$eplug_folder."banners.php' class='button'>".RENDELES_21."</a></td>
              <td width='25%' align='center' valign='middle'><a href='".$eplug_folder."type.php' class='button'>".RENDELES_22."</a></td>
              <td width='25%' align='center' valign='middle'><a href='".$eplug_folder."flower.php' class='button'>".RENDELES_20."</a></td>
              <td width='25%' align='center' valign='middle'><a href='".$eplug_folder."search_date.php' class='button'>".RENDELES_37."</a></td>
            </tr>
            <tr>
              <td width='25%' align='center' valign='middle'><a href='".$eplug_folder."completed.php' class='button'>".RENDELES_24."</a></td>
              <td width='25%' align='center' valign='middle'><a href='".$eplug_folder."no_completed.php' class='button'>".RENDELES_25."</a></td>
              <td width='25%' align='center' valign='middle'><a href='".$eplug_folder."paid.php' class='button'>".RENDELES_23."</a></td>
              <td width='25%' align='center' valign='middle'><a href='".$eplug_folder."no_paid.php' class='button'>".RENDELES_50."</a></td>
            </tr>
          </table>
          
         </center>
       </div>
     </div>
   ";
   $ns -> tablerender("".RENDELES_18."", $text);	

$qp = new rendeles;

class rendeles {
	var $message;
	function rendeles() {
		
  /* ----------------------------------------------------------------------- */
  /* Konstruktor */
	/* ----------------------------------------------------------------------- */
		
		if(isset($_POST['edit'])) {
			$this -> editSme();
		}
		if(isset($_POST['delete'])) {
			$this -> deleteSme();
		}
		if(isset($_POST['add_com'])) {
			$this -> addCom();
		}
		if(isset($_POST['up_conf'])) {
			$this -> upConf();
		}
		if($this -> message) {
			echo "<br /><div style='text-align:center'><b>".$this -> message."</b></div><br />";
		}
		if(e_QUERY == "show") {
			$this -> showList();
		}
		else if(!$_POST['edit']) {
			$this -> showList();
		}
	}	

	/* --------------------------------------------------------------------------*/
	/* Rendelések kilistázása */
	/* --------------------------------------------------------------------------*/
			
	function showList() {
		global $sql,$ns,$tp;
		$gen = new convert;
			if (isset($_GET['togglecomp_1'])){
	    $sql->db_Update('rendeles', "rendeles_paid='".($_GET['togglecomp_1'] == 1 ? 0 : 1)."' WHERE rendeles_id='".intval($_GET['id'])."' ");}
      if (isset($_GET['togglecomp_2'])){
	    $sql->db_Update('rendeles', "rendeles_completed='".($_GET['togglecomp_2'] == 1 ? 0 : 1)."' WHERE rendeles_id='".intval($_GET['id'])."' ");}
      if (isset($_GET['togglecomp_3'])){
	    $sql->db_Update('rendeles', "rendeles_bannerscompleted='".($_GET['togglecomp_3'] == 1 ? 0 : 1)."' WHERE rendeles_id='".intval($_GET['id'])."' ");}
      $sql->db_query("select * from ".MPREFIX."rendeles ");
		$count = $sql -> db_Select_gen("SELECT * FROM #rendeles r inner join #rendeles_customer c on r.rendeles_customerid = c.rendeles_customer_id inner join #rendeles_banner b on r.rendeles_bannerid = b.rendeles_banner_id inner join #rendeles_type t on r.rendeles_typeid = t.rendeles_type_id ORDER BY rendeles_id ASC", false);     
  
    $text = "<div style='text-align:center'>";
		/* Ha üres, nincs még Rendelés */
		if (!$count) {
			$text .= "".RENDELES_ADLAN_13."";
			$ns -> tablerender("<div style='text-align:center'>".RENDELES_ADLAN_34."</div>", $text);
			exit;
		}
		/* Lista fejlécének létrehozása - ID / Módosítás és törlés Ikonok / Rendelés */
		else {
			$text .= "
      <form action='".e_SELF."' id='display' method='post'>
			  <center>
			  <table class='fborder'>
				  <tr>
					  <td style='width:15%; text-align: center;' class='fcaption'>".RENDELES_28."</td>
					  <td style='width:15%; text-align: center;' class='fcaption'>".RENDELES_32."</td>
					  <td style='width:10%; text-align: center;' class='fcaption'>".RENDELES_33."</td>
					  <td style='width:15%; text-align: center;' class='fcaption'>".RENDELES_34."</td>
					  <td style='width:15%; text-align: center;' class='fcaption'>".RENDELES_35."</td>
					  <td style='width:15%; text-align: center;' class='fcaption'>".RENDELES_36."</td>
					  <td style='width:5%;  text-align: center;' class='fcaption'>".RENDELES_54."</td>
					  <td style='width:5%;  text-align: center;' class='fcaption'>".RENDELES_31."</td>
					  <td style='width:5%;  text-align: center;' class='fcaption'>".RENDELES_30."</td>
					  <td style='width:5%;  text-align: center;' class='fcaption'>".RENDELES_29."</td>
				  </tr>
			";
			/* Rendelések kilistázása, ID szerint növekvő sorrendben */
      while($row2 = $sql-> db_Fetch()){

	      $eredmeny = calcPrice($row2['rendeles_id']);

				$text .= "
          <tr>
					  <td class='forumheader3' style='text-align: center;'><a href=''>".$tp->toHTML($row2['rendeles_customer_name'],"","defs")."</a></td>
					  <td class='forumheader3' style='text-align: center;'>".$rendeles_date_b = $gen -> convert_date($row2['rendeles_date_b'], short)."</td>					  
            <td class='forumheader3' style='text-align: center;'>".$tp->toHTML($row2['rendeles_type_name'],"","defs")."</td>
					  <td class='forumheader3' style='text-align: center;'>".$tp->toHTML($row2['rendeles_banner_banners'],"","defs")."</td>
					  <td class='forumheader3' style='text-align: center;'>".$tp->toHTML($row2['rendeles_location'],"","defs")."</td>
					  <td class='forumheader3' style='text-align: center;'>".$tp->toHTML($row2['rendeles_comment'],"","defs")."</td>
					  <td class='forumheader3' style='text-align: center;'>".$eredmeny."".RENDELES_55."</td>
					  <td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/forumheader$row2[rendeles_bannerscompleted].png) repeat-x top left;'>
	            <a href='".e_SELF."?togglecomp_3=$row2[rendeles_bannerscompleted]&amp;id=$row2[rendeles_id]' title='".($row2['rendeles_bannerscompleted'] ? RENDELES_ADLAN_46 : RENDELES_ADLAN_47 )."' style='border:0px none;'>
	              <img src='".$eplug_folder."images/$row2[rendeles_bannerscompleted].gif' />
	            </a>
            </td>            
					  <td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/forumheader$row2[rendeles_completed].png) repeat-x top left;'>
	            <a href='".e_SELF."?togglecomp_2=$row2[rendeles_completed]&amp;id=$row2[rendeles_id]' title='".($row2['rendeles_completed'] ? RENDELES_ADLAN_46 : RENDELES_ADLAN_47 )."' style='border:0px none;'>
	              <img src='".$eplug_folder."images/$row2[rendeles_completed].gif' />
	            </a>
            </td>
            <td class='forumheader3' style='text-align: center; background: url(".$eplug_folder."images/forumheader$row2[rendeles_paid].png) repeat-x top left;'>
	            <a href='".e_SELF."?togglecomp_1=$row2[rendeles_paid]&amp;id=$row2[rendeles_id]' title='".($row2['rendeles_paid'] ? RENDELES_ADLAN_46 : RENDELES_ADLAN_47 )."' style='border:0px none;'>
	              <img src='".$eplug_folder."images/$row2[rendeles_paid].gif' />
	            </a>
            </td>            
				  </tr>
				";
			}
		}
		$text .= "
        </table>
      <center>
    </form><br />
    ";
		$ns -> tablerender("<div style='text-align:center'>".RENDELES_27."</div>", $text);
	
	}}

function calcPrice($rendelesid)
{
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
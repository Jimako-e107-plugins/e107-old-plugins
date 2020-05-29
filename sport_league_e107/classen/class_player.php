<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|       
|      
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
$lan_file = e_PLUGIN."lique/languages/admin/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."lique/languages/admin/English.php");

class player{
var $players_id, $players_name, $players_user_id, $players_admin_id, $players_url, $players_mail, $players_location, 
$players_icon, $players_burthday, $players_site, $players_wigth, $players_height, $players_visier, $players_description;
////--------------------------------
var $roster_id, $roster_name, $roster_saison_id, $roster_player_id, $roster_team_id, $roster_status, $roster_jersy, 
$roster_imfeld, $roster_position, $roster_description;
var $player_type;

  /////////------------------ Konstruktor ------------------------------
	function player()
		{
		$this->player_type=0;
		////////////////////////////
		$this->players_id=0;
		$this->players_name="";
		$this->players_user_id=1;
		$this->players_admin_id=1;
		$this->players_url="";
		$this->players_mail="";
		$this->players_location="";
		$this->players_icon="default.jpg";
		$this->players_burthday="";
		$this->players_site=0;
		$this->players_wigth="";
		$this->players_height="";
		$this->players_visier=0;
		$this->players_description="";
		////--------------------------------
		$this->roster_id=0;
		$this->roster_saison_id=0;
		$this->roster_player_id=0;
		$this->roster_team_id=0;
		$this->roster_status=1;
		$this->roster_jersy=0;
		$this->roster_imfeld=1;
		$this->roster_position=0;
		$this->roster_description="";
		}
   /////////-----------------Player hollen Übergabe ID+ ID-Typ (player uder roster)-------------------------- 
    function set_player($id, $id_type)
		{
		require_once("../../class2.php");
    $MYVARsql =& new db;	
		
		if($id_type=="roster")
			{
			 $qry1="
				SELECT a.*, ae.* FROM ".MPREFIX."lique_roster AS a 
				LEFT JOIN ".MPREFIX."lique_players AS ae ON ae.players_id=a.roster_player_id   
				WHERE a.roster_id =".$id."
				";
			 $MYVARsql->db_Select_gen($qry1);
			 if($A=="")	
				 {
				 $row = $MYVARsql->db_Fetch();
				 $this->roster_id=$row['roster_id'];
				 $this->roster_saison_id=$row['roster_saison_id'];
			 	 $this->roster_player_id=$row['roster_player_id'];
			 	 $this->roster_team_id=$row['roster_team_id'];
			 	 $this->roster_status=$row['roster_status'];			
			 	 $this->roster_jersy=$row['roster_jersy'];
			 	 $this->roster_imfeld=$row['roster_imfeld'];
			 	 $this->roster_position=$row['roster_position'];
			 	 $this->roster_imfeld=$row['roster_imfeld'];
			 	 $this->roster_description=$row['roster_description'];
			 	 $this->players_id=$row['players_id'];
			 	 $this->players_name=$row['players_name'];
			 	 $this->players_user_id=$row['players_user_id'];
			 	 $this->players_admin_id=$row['players_admin_id'];
			 	 $this->players_url=$row['players_url'];
			 	 $this->players_mail=$row['players_mail'];
			 	 $this->players_location=$row['players_location'];
			 	 $this->players_icon=$row['players_icon'];
			 	 $this->players_burthday=$row['players_burthday'];
			 	 $this->players_site=$row['players_site'];
			 	 $this->players_wigth=$row['players_wigth'];
			 	 $this->players_height=$row['players_height'];
			 	 $this->players_visier=$row['players_visier'];
			 	 $this->players_description=$row['players_description'];
				 $this->player_type=1;				 
				 return 1; ///Fehlercode/Bestätigung 1= "alles OK!"
				}
			 else
				{
				 return 3; ///Fehlercode 3= "Keine Player mit diesem ROSTER_ID im DB vorhanden"
				}
			}
		elseif($id_type=="player")
			{
			$sql -> db_Select("lique_players", "*","players_id='".$id."'");
			if($row = $sql-> db_Fetch())
				{
				$this->players_id=$row['players_id'];
				$this->players_name=$row['players_name'];
				$this->players_user_id=$row['players_user_id'];
				$this->players_admin_id=$row['players_admin_id'];
				$this->players_url=$row['players_url'];
				$this->players_mail=$row['players_mail'];
				$this->players_location=$row['players_location'];
				$this->players_icon=$row['players_icon'];
				$this->players_burthday=$row['players_burthday'];
				$this->players_site=$row['players_site'];
				$this->players_wigth=$row['players_wigth'];
				$this->players_height=$row['players_height'];
				$this->players_visier=$row['players_visier'];
				$this->players_description=$row['players_description'];
				$this->player_type=2;	
				return 1; ///Fehlercode/Bestätigung 1= "alles OK!"
				}
			 else
				{
				 return 4; ///Fehlercode 3= "Keine Player mit diesem PLAYER_ID im DB vorhanden"
				}
			}
		else
			{
			return 2; ///Fehlercode 2= "Keiner oder Falsche Typ übergeben"
			}
         $this->players_id="";
         return 0;
        }
  /////////---------------------------------------------------------
    function get_player($field_name)
		{
     switch ($field_name)
     	{ 
/////////////// Ausgabe der Name     		    
			case "name":
					return $this->players_name;        
					break;
/////////////// Ausgabe der Rücknummers         
			case "nr":
					return $this->roster_jersy;        
					break;
/////////////// Ausgabe der Ort			
			case "ort":
					return $this->players_location;        
					break;
/////////////// Ausgabe der Groesse			
			case "h":
					return $this->players_height;        
					break;
/////////////// Ausgabe der Gewicht			
			case "w":
					return $this->players_wigth;        
					break;
/////////////// Ausgabe der Benutzer ID 				
			case "user_id":
					return $this->players_user_id;        
					break;	
/////////////// Ausgabe der admin ID
			case "admin_id":
					return $this->players_admin_id;        
					break;
/////////////// Ausgabe der Foto
			case "icon":
					return $this->players_icon;        
					break;
/////////////// Ausgabe der Geburtstag
			case "burthday":
					return $this->players_burthday;        
					break;
/////////////// Ausgabe der 					
			case "site":
					return $this->players_site;        
					break;
     	}

    }
		
}



?>
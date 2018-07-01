<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC MOTM                      #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


require_once("../../class2.php");
require_once(e_HANDLER."userclass_class.php");


if(!getperms("P")){
header("location:".e_BASE."index.php");
exit;
}

require_once(e_ADMIN."auth.php");
//-------------------------------------------------------------------------------------------------------------------

$title = "<B>AACGC MOTM<B>";

//-------------------------------------------------------------------------------------------------------------------
if ($_POST['potmtodb'] == '1') {
$newpotm = $_POST['motm_user'];
$newpotmm = $_POST['month'];
$newpotmy = $_POST['year'];
$reason = "";
$newok = "";
if (($newpotm == "") OR ($newpotmm == "")){
$newok = "0";
$reason = "No User Or Month Selected";}
else 
{$newok = "1";}
If ($newok == "0"){
 	$newtext = "
 	<center>
	".$reason."
	</center>
 	</b>
	";
$ns->tablerender("POTM", $newtext);}
If ($newok == "1"){
$sql->db_Insert("aacgc_motm", "NULL, '".$newpotm."', '".$newpotmm."', '".$newpotmy."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Player Of The Month Changed</b></center>");}}

//-------------------------------------------------------------------------------------------------------------------

         $sql->db_Select("aacgc_motm", "*", "ORDER BY motm_id DESC","");
    	  $row = $sql->db_Fetch();

         $sql2->db_Select("user", "user_id, user_name", "WHERE user_id=".$row['motm_user']."","");
         $row2 = $sql2->db_Fetch();





$text .= "<table style='' class='fcaption'><tr>
<td><font size='4'>Current Member of the Month:</td>
</tr>
<tr>
<td><font size='4'>Month: ".$row['month']."</font></td>
</tr>
<tr>
<td><font size='4'>Year: ".$row['year']."</font></td>
</tr>";


 


$text .= "<tr>
          <td>
          <font size='4'>User: ".$row2['user_name']."</font>
          <br>
          </td>
          </tr></table>";


//-------------------------------------------------------------------------------------------------------------------

$text .= "
<form method='POST' action='admin_new.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:60%' class='fborder' cellspacing='0' cellpadding='0'>
<tr>
<td colspan=2>Give MOTM Award</td>
</tr><tr>
		<td style='width:30%; text-align:right' class='forumheader3'>User:</td>
		<td style='width:70%' class='forumheader3'>
		<select name='motm_user' size='1' class='tbox' style='width:100%'>";
	        $sql->db_Select("user", "user_id, user_name", "ORDER BY user_name ASC","");
    		    while($row = $sql->db_Fetch()){
    		    $usern = $row[user_name];
    		    $userid = $row[user_id];

        $text .= "<option name='motm_user' value='".$userid."'>".$usern."</option>";}

        $text .= "</td></tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Month:</td>
        <td style='width:70%' class='forumheader3'>
		<select name='month' size='1' class='tbox' style='width:100%'>
		<option name='month' value='January'>January</option>
		<option name='month' value='February'>February</option>
		<option name='month' value='March'>March</option>
		<option name='month' value='April'>April</option>
		<option name='month' value='May'>May</option>
		<option name='month' value='June'>June</option>
		<option name='month' value='July'>July</option>
		<option name='month' value='August'>August</option>
		<option name='month' value='September'>September</option>
		<option name='month' value='October'>October</option>
            <option name='month' value='November'>November</option>
            <option name='month' value='December'>December</option>
        </td>
	</tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Year:</td>
        <td style='width:70%' class='forumheader3'>
		<select name='year' size='1' class='tbox' style='width:25%'>
		<option name='year' value='2008'>2008</option>
		<option name='year' value='2009'>2009</option>
		<option name='year' value='2010'>2010</option>
		<option name='year' value='2011'>2011</option>
		<option name='year' value='2012'>2012</option>
		<option name='year' value='2013'>2013</option>
		<option name='year' value='2014'>2014</option>
		<option name='year' value='2015'>2015</option>
		<option name='year' value='2016'>2016</option>
		<option name='year' value='2017'>2017</option>
            <option name='year' value='2018'>2018</option>
            <option name='year' value='2019'>2019</option>
        </td>
        </tr>
        <tr>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='potmtodb' value='1'>
		<input class='button' type='submit' value='Set MOTM' style='width:150px'>
		</td>
        </tr>
        
        </table>
        </div>";


$ns -> tablerender($title, $text);

//-----------------------------------------------------------------------------------------------------------------------------------------








require_once(e_ADMIN."footer.php");
?>



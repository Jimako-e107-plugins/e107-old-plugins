<?php
# $Id: view_entry.php,v 1.11 2003/12/03 21:52:11 gwalker Exp $
require_once("../../class2.php");
require_once "grab_globals.inc.php";
include "config.inc.php";
include "functions.inc";
include "$dbsys.inc";

#If we dont know the right date then make it up
if(!isset($day) or !isset($month) or !isset($year))
{
	$day   = date("d");
	$month = date("m");
	$year  = date("Y");
}
if(empty($area))
	$area = get_default_area();

print_header($day, $month, $year, $area);

$sql = "
SELECT ".MPREFIX."mrbs_entry.name,
       ".MPREFIX."mrbs_entry.description,
       ".MPREFIX."mrbs_entry.create_by,
       ".MPREFIX."mrbs_room.room_name,
       ".MPREFIX."mrbs_area.area_name,
       ".MPREFIX."mrbs_entry.type,
       ".MPREFIX."mrbs_entry.room_id,
       ".MPREFIX."mrbs_entry.repeat_id,
    " . sql_syntax_timestamp_to_unix("".MPREFIX."mrbs_entry.timestamp") . ",
       (".MPREFIX."mrbs_entry.end_time - ".MPREFIX."mrbs_entry.start_time),
       ".MPREFIX."mrbs_entry.start_time,
       ".MPREFIX."mrbs_entry.end_time,
".MPREFIX."mrbs_entry.userdef1,
".MPREFIX."mrbs_entry.userdef2,
".MPREFIX."mrbs_entry.userdef3,
".MPREFIX."mrbs_entry.userdef4,
".MPREFIX."mrbs_entry.userdef5

FROM  ".MPREFIX."mrbs_entry,  ".MPREFIX."mrbs_room,  ".MPREFIX."mrbs_area
WHERE  ".MPREFIX."mrbs_entry.room_id =  ".MPREFIX."mrbs_room.id
  AND  ".MPREFIX."mrbs_room.area_id =  ".MPREFIX."mrbs_area.id
  AND  ".MPREFIX."mrbs_entry.id=$id
";

$res = sql_query($sql);
if (! $res) fatal_error(0, sql_error());

if(sql_count($res) < 1) fatal_error(0, get_vocab("invalid_entry_id"));

$row = sql_row($res, 0);
sql_free($res);

# Note: Removed stripslashes() calls from name and description. Previous
# versions of MRBS mistakenly had the backslash-escapes in the actual database
# records because of an extra addslashes going on. Fix your database and
# leave this code alone, please.
$name         = htmlspecialchars($row[0]);
$description  = htmlspecialchars($row[1]);
$create_by    = htmlspecialchars($row[2]);
$room_name    = htmlspecialchars($row[3]);
$area_name    = htmlspecialchars($row[4]);
$type         = $row[5];
$room_id      = $row[6];
$repeat_id    = $row[7];
$updated      = time_date_string($row[8]);
# need to make DST correct in opposite direction to entry creation
# so that user see what he expects to see
$duration     = $row[9] - cross_dst($row[10], $row[11]);

$start_date = time_date_string($row[10]);
$end_date = time_date_string($row[11]);
$userdef1 = $row[12];
$userdef2 = $row[13];
$userdef3 = $row[14];
$userdef4 = $row[15];
$userdef5 = $row[16];
$rep_type = 0;

if($repeat_id != 0)
{
	$res = sql_query("SELECT rep_type, end_date, rep_opt, rep_num_weeks
	                    FROM  ".MPREFIX."mrbs_repeat WHERE id=$repeat_id");
	if (! $res) fatal_error(0, sql_error());

	if (sql_count($res) == 1)
	{
		$row = sql_row($res, 0);

		$rep_type     = $row[0];
		$rep_end_date = utf8_strftime('%A %d %B %Y',$row[1]);
		$rep_opt      = $row[2];
		$rep_num_weeks = $row[3];
	}
	sql_free($res);
}

toTimeString($duration, $dur_units);

$repeat_key = "rep_type_" . $rep_type;

# Now that we know all the data we start drawing it

?>

<H3><?php echo $name ?></H3>
 <table border=0>
   <tr>
    <td><b><?php echo get_vocab("description") ?></b></td>
    <td><?php    echo nl2br($description) ?></td>
   </tr>
   <tr>
    <td><b><?php echo get_vocab("room") ?></b></td>
    <td><?php    echo  nl2br($area_name . " - " . $room_name) ?></td>
   </tr>
   <tr>
    <td><b><?php echo get_vocab("start_date") ?></b></td>
    <td><?php    echo $start_date ?></td>
   </tr>
   <tr>
    <td><b><?php echo get_vocab("duration") ?></b></td>
    <td><?php    echo $duration . " " . $dur_units ?></td>
   </tr>
   <tr>
    <td><b><?php echo get_vocab("end_date") ?></b></td>
    <td><?php    echo $end_date ?></td>
   </tr>
   <tr>
    <td><b><?php echo get_vocab("type") ?></b></td>
    <td><?php    echo empty($typel[$type]) ? "?$type?" : $typel[$type] ?></td>
   </tr>
   <tr>
    <td><b><?php echo get_vocab("createdby") ?></b></td>
    <td><?php    echo $create_by ?></td>
   </tr>
   <tr>
    <td><b><?php echo get_vocab("lastupdate") ?></b></td>
    <td><?php    echo $updated ?></td>
   </tr>
   <tr>
    <td><b><?php echo get_vocab("rep_type") ?></b></td>
    <td><?php    echo get_vocab($repeat_key) ?></td>
   </tr>

<? if(!empty($pref['mrbs_userdef1']))
{
?>
   <tr>
    <td><b><?php echo $pref['mrbs_userdef1'] ?></b></td>
    <td><?php    echo ($userdef1==1?"Yes":"No") ?></td>
   </tr>
<?php
}
?>

<? if(!empty($pref['mrbs_userdef2']))
{
?>
   <tr>
    <td><b><?php echo $pref['mrbs_userdef2'] ?></b></td>
    <td><?php    echo ($userdef2==1?"Yes":"No") ?></td>
   </tr>
<?php
}
?>

<? if(!empty($pref['mrbs_userdef3']))
{
?>
   <tr>
    <td><b><?php echo $pref['mrbs_userdef3'] ?></b></td>
    <td><?php    echo ($userdef3==1?"Yes":"No") ?></td>
   </tr>
<?php
}
?>

<? if(!empty($pref['mrbs_userdef4']))
{
?>
   <tr>
    <td><b><?php echo $pref['mrbs_userdef4'] ?></b></td>
    <td><?php    echo ($userdef4==1?"Yes":"No") ?></td>
   </tr>
<?php
}
?>

<? if(!empty($pref['mrbs_userdef5']))
{
?>
   <tr>
    <td><b><?php echo $pref['mrbs_userdef5'] ?></b></td>
    <td><?php    echo ($userdef5==1?"Yes":"No") ?></td>
   </tr>
<?php
}



if($rep_type != 0)
{
	$opt = "";
	if (($rep_type == 2) || ($rep_type == 6))
	{
		# Display day names according to language and preferred weekday start.
		for ($i = 0; $i < 7; $i++)
		{
			$daynum = ($i + $weekstarts) % 7;
			if ($rep_opt[$daynum]) $opt .= day_name($daynum) . " ";
		}
	}
	if ($rep_type == 6)
	{
		echo "<tr><td><b>".get_vocab("rep_num_weeks").get_vocab("rep_for_nweekly")."</b></td><td>$rep_num_weeks</td></tr>\n";
	}

	if($opt)
		echo "<tr><td><b>".get_vocab("rep_rep_day")."</b></td><td>$opt</td></tr>\n";

	echo "<tr><td><b>".get_vocab("rep_end_date")."</b></td><td>$rep_end_date</td></tr>\n";
}

?>
</table>
<br>
<p>
<a href="edit_entry.php?id=<?php echo $id ?>"><?php echo get_vocab("editentry") ?></a>
<?php

if($repeat_id)
	echo " - <a href=\"edit_entry.php?id=$id&edit_type=series&day=$day&month=$month&year=$year\">".get_vocab("editseries")."</a>";

?>
<BR>
<A HREF="del_entry.php?id=<?php echo $id ?>&series=0" onClick="return confirm('<?php echo get_vocab("confirmdel") ?>');"><?php echo get_vocab("deleteentry") ?></A>
<?php

if($repeat_id)
	echo " - <A HREF=\"del_entry.php?id=$id&series=1&day=$day&month=$month&year=$year\" onClick=\"return confirm('".get_vocab("confirmdel")."');\">".get_vocab("deleteseries")."</A>";

?>
<BR>
<a href="<?php echo $HTTP_REFERER ?>"><?php echo get_vocab("returnprev") ?></a>
<?php include "trailer.inc"; ?>
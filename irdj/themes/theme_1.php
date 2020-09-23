<?php

// Theme 1

$text .="<table class width='100%' border='1'>
		<tr>
		<td class width='30%' valign='top'>".$row['dj_intro']."</td>
		<td class width='40%' ><center><h2>".$row['dj_name']."</h2><img src='".$dj_photo."' alt='".$row['dj_name']."' />
		<br /><br /><b>Location: ".$row['dj_location']."<br />
		Age: ".$row['dj_age']."<br /></b></center></td>
		<td class width='30%'  valign='top'>".$row['dj_body']."</td>
		</tr>
		";

$text .="</table>";

?>
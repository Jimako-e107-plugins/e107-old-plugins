<?php
//Errechnen der resultierenden Seitenanzahl
$seitenmenge=ceil($menge/$show);

$text.="<div class='nextprev center'>";
//Dynamisches Anzeigen der Navigationsbuttons
if($seitenmenge>1)
{
	foreach(range(1,$seitenmenge) as $number)
	{
		if ($page==$number)
		{
			if ($number>2)
			{
				$text.="<a class='nextprev_link' href='".e_SELF."?id=".$id."'><<</a> ";
			}
			if ($number>1)
			{
				$lastnumber=$number-1;
				$text.="<a class='nextprev_link' href='".e_SELF."?id=".$id."&page=".$lastnumber."'>".$lastnumber."</a> ";
			}
			
			$text.="<span class='nextprev_current'>".$number."</span> ";
			
			$nextnumber=$number+1;
			if ($nextnumber<=$seitenmenge)
			{
				foreach(range($nextnumber,$seitenmenge) as $nextnumber)
				{
					$text.="<a class='nextprev_link' href='".e_SELF."?id=".$id."&page=".$nextnumber."'>".$nextnumber."</a> ";
					
					if ($nextnumber-$number==4)
					{
						break;
					}
				}
				if ($nextnumber<$seitenmenge)
				{
					$text.="<a class='nextprev_link' href='".e_SELF."?id=".$id."&page=".$seitenmenge."'>>></a> ";
				}
			}
		}
	}
}
$text.="</div>";

$content.="<div class='nextprev center'>";
//Dynamisches Anzeigen der Navigationsbuttons
if($seitenmenge>1)
{
	foreach(range(1,$seitenmenge) as $number)
	{
		if ($page==$number)
		{
			if ($number>2)
			{
				$content.="<a class='nextprev_link' href='".e_SELF."?gallery=".$_GET['gallery']."'><<</a> ";
			}
			if ($number>1)
			{
				$lastnumber=$number-1;
				$content.="<a class='nextprev_link' href='".e_SELF."?gallery=".$_GET['gallery']."&page=".$lastnumber."'>".$lastnumber."</a> ";
			}
			
			$content.="<span class='nextprev_current'>".$number."</span> ";
			
			$nextnumber=$number+1;
			if ($nextnumber<=$seitenmenge)
			{
				foreach(range($nextnumber,$seitenmenge) as $nextnumber)
				{
					$content.="<a class='nextprev_link' href='".e_SELF."?gallery=".$_GET['gallery']."&page=".$nextnumber."'>".$nextnumber."</a> ";
					
					if ($nextnumber-$number==4)
					{
						break;
					}
				}
				if ($nextnumber<$seitenmenge)
				{
					$content.="<a class='nextprev_link' href='".e_SELF."?gallery=".$_GET['gallery']."&page=".$seitenmenge."'>>></a> ";
				}
			}
		}
	}
}
$content.="</div>";
?> 
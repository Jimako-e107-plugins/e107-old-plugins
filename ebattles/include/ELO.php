<?php
// function for ELO calculation.

function ELO($M, $K, $Rating_A, $Rating_B, $rank_A, $rank_B)
{
       // New ELO ------------------------------------------        		
	if($rank_A < $rank_B)
	{
		$score_A = 1;
	}
	elseif($rank_A==$rank_B)
	{
		$score_A = 1/2;
	}
	else
	{
		$score_A = 0;
	}
	$score_B = 1-$score_A;	
	//echo "point A: $rank_A, score A: $score_A<br />";
	//echo "point B: $rank_B, score B: $score_B<br />";

	$E_A=1/(1+pow(10,($Rating_B-$Rating_A)/$M));
	$E_B=1-$E_A;	
	//echo "Esperance A: $E_A<br />";
	//echo "Esperance B: $E_B<br />";
	
	$Score_adjustment=ceil($K*($score_A-$E_A));
	
	$Rating_A=$Rating_A + $Score_adjustment;
	$Rating_B=$Rating_B - $Score_adjustment;
	//echo "Player A Rating: $Rating_A<br />";
	//echo "Player B Rating: $Rating_B<br />";
	//----------------------------------------------
	
	return $Score_adjustment;
}
?>
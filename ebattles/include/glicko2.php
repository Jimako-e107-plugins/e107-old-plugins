<?php
// function for glicko2 calculation.

//g2_test();


function g2_test()
{
	$r0 = 1500;           // Glicko 1 rating
	$RD0 = 350;           // Glicko 1 rating deviation
	$sigma0 =0.06;        // Glicko 2 volatility
	$tau=0.5;             // constrains volatility over time
	$epsilon = 0.000001;
	$q_inv= 173.7178; //400/log(10);

	$mu0 = 0;
	$phi0=$RD0/$q_inv;

	// 2players
	$A_mu = g2_from_g1_rating(1500, $r0);
	$A_phi = g2_from_g1_deviation(350);
	$A_sigma = $sigma0;
	$B_mu = g2_from_g1_rating(1500, $r0);
	$B_phi = g2_from_g1_deviation(350);
	$B_sigma = $sigma0;

	$A_r = g2_to_g1_rating($A_mu, $r0);
	$A_RD = g2_to_g1_deviation($A_phi);
	$B_r = g2_to_g1_rating($B_mu, $r0);
	$B_RD = g2_to_g1_deviation($B_phi);

	echo "A mu=$A_mu, r=$A_r<br>";
	echo "A phi=$A_phi, RD=$A_RD<br>";
	echo "A sigma=$A_sigma<br>";
	echo "B mu=$B_mu, r=$B_r<br>";
	echo "B phi=$B_phi, RD=$B_RD<br>";
	echo "B sigma=$B_sigma<br>";

	echo "-----------------------------------<br>";
	$update_A = glicko2_update($A_mu, $A_phi, $A_sigma, 1, $B_mu, $B_phi, $B_sigma, 2, $tau, $epsilon);
	$update_B = glicko2_update($B_mu, $B_phi, $B_sigma, 2, $A_mu, $A_phi, $A_sigma, 1, $tau, $epsilon);

	$A_mu = $A_mu + $update_A[0];
	$A_phi = $A_phi * $update_A[1];
	$A_sigma = $A_sigma * $update_A[2];
	$B_mu = $B_mu + $update_B[0];
	$B_phi = $B_phi * $update_B[1];
	$B_sigma = $B_sigma * $update_B[2];

	$A_r = g2_to_g1_rating($A_mu, $r0);
	$A_RD = g2_to_g1_deviation($A_phi);
	$B_r = g2_to_g1_rating($B_mu, $r0);
	$B_RD = g2_to_g1_deviation($B_phi);


	echo "---><br>";
	echo "A mu=$A_mu, r=$A_r<br>";
	echo "A phi=$A_phi, RD=$A_RD<br>";
	echo "A sigma=$A_sigma<br>";
	echo "B mu=$B_mu, r=$B_r<br>";
	echo "B phi=$B_phi, RD=$B_RD<br>";
	echo "B sigma=$B_sigma<br>";
	echo "-----------------------------------<br>";
}
	
//___________________________________________________________________

function glicko2_update($mu, $phi, $sigma, $rank, $mu_opp, $phi_opp, $sigma_opp, $rank_opp, $tau, $epsilon = 0.000001)
{
	$output = '############<br>';
	$output .= "mu=$mu, phi=$phi, sigma=$sigma, rank=$rank<br>";
	$output .= "mu_opp=$mu, phi_opp=$phi_opp, sigma_opp=$sigma_opp, rank_opp=$rank_opp<br>";
	
	// Step 3
	$g = g2_g($phi_opp);
	$output .= "g=$g<br>";
	$E = g2_E($mu, $mu_opp, $phi_opp);
	$output .= "E=$E<br>";
	
	$variance = 1 / (pow($g, 2) * $E * (1 - $E));
	$output .= "variance=$variance<br>";

	
	// Step 4
	if($rank < $rank_opp) {
		$s=1;
	}
	if($rank == $rank_opp) {
		$s=0.5;
	}
	if($rank > $rank_opp) {
		$s=0;
	}
	$delta = $variance * $g * ($s-$E);
	$output .= "delta=$delta<br>";
	
	// Step 5
	// #1
	$a = log(pow($sigma, 2));
	
	// #2
	$A=$a;
	if(pow($delta, 2) > (pow($phi, 2) + $variance))
	{
		$B = log(pow($delta, 2) - pow($phi, 2) - $variance);
	}
	else
	{
		$k = 1;
		while (g2_f($a - $k * $tau, $delta, $phi, $variance, $tau, $a) < 0) {
			$k=$k+1;
		}
		$B = $a - $k * $tau;
	}
	
	// #3
	$fA = g2_f($A, $delta, $phi, $variance, $tau, $a);
	$output .= "A=$A, fA=$fA<br>";
	$fB = g2_f($B, $delta, $phi, $variance, $tau, $a);
	$output .= "B=$B, fB=$fB<br>";

	// #4
	$iteration=1;
	while((abs($B-$A) > $epsilon) && ($iteration < 10)) 
	{
		$output .= "iteration: $iteration<br>";
		// #a
		$C = $A + (($A - $B) * $fA) / ($fB - $fA);
		$fC = g2_f($C, $delta, $phi, $variance, $tau, $a);
		// #b
		if($fC*$fB < 0) {
			$A = $B;
			$fA = $fB;
		} else {
			$fA = $fA / 2;
		}
		// #c
		$B = $C;
		$fB = $fC;
		$iteration = $iteration + 1;
//		$output .=  "A=$A, fA=$fA<br>";
//		$output .=  "B=$B, fB=$fB<br>";
	}
	
	$output .=  "A=$A<br>";
	$sigma_new = exp($A/2);
	$sigma_delta = $sigma_new / $sigma;
	
	// Step 6 (done at beginning of rating period)
	/*
	$phi_star = sqrt(pow($phi, 2) + pow($sigma_new, 2));
	$output .=  "phi_star=$phi_star<br>";
	*/
	$phi_star = $phi;
	
	// Step 7
	$phi_new = 1 / sqrt(1/pow($phi_star, 2) + 1/$variance);
	$phi_delta = $phi_new / $phi;
		
	$mu_delta = pow($phi_new, 2) * $g * ($s - $E);
	$mu_new = $mu+$mu_delta;
	
	$output .=  "mu_new=$mu_new<br>";
	$output .=  "phi_new=$phi_new<br>";
	$output .=  "sigma_new=$sigma_new<br>";
	
	$output .= '############<br>';
	//echo $output;
	return array($mu_delta, $phi_delta, $sigma_delta);
}

function g2_g($phi)
{
    $g = 1 / sqrt(1+3*pow($phi, 2)/pow(M_PI, 2));

    return $g;
}

function g2_E($mu, $mu_opp, $phi_opp)
{
	$E = 1 / (1 + exp(-g2_g($phi_opp)*($mu - $mu_opp)));

    return $E;
}

function g2_f($x, $delta, $phi, $variance, $tau, $a)
{
	$f = exp($x) * (pow($delta, 2) - pow($phi, 2) - $variance - exp($x)) / (2 * pow(pow($phi, 2) + $variance + exp($x), 2)) - ($x - $a) / pow($tau, 2);
	return $f;
}

function g2_rating_period($phi, $sigma)
{
	// Step 6
	$phi_star = sqrt(pow($phi, 2) + pow($sigma, 2));
	return $phi_star;
}

function g2_to_g1_rating($mu, $r0 = 1500, $q_inv = 173.7178)
{
	// Convert G2 to G1 rating
	return ($q_inv*$mu)+$r0;
}

function g2_to_g1_deviation($phi, $q_inv = 173.7178)
{
	// Convert G2 to G1 rating deviation
	return ($q_inv*$phi);
}

function g2_from_g1_rating($r, $r0 = 1500, $q_inv = 173.7178)
{
	// Convert G1 to G2 rating
	return (($r-$r0)/$q_inv);
}

function g2_from_g1_deviation($RD, $q_inv = 173.7178)
{
	// Convert G1 to G2 rating deviation
	return ($RD/$q_inv);
}
?>

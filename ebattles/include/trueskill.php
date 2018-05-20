<?php
// functions for Trueskill calculation.
//___________________________________________________________________

function Trueskill_update($epsilon, $beta, $tau, $A_mu, $A_sigma, $A_rank, $B_mu, $B_sigma, $B_rank)
{
    $output = '';
    
    if ($epsilon == 0) $epsilon = 1.0;
    if ($tau == 0) $tau = 0.0833333;

	// dynamic factor
	$A_sigma = sqrt(pow($A_sigma,2) + pow($tau,2));
	$B_sigma = sqrt(pow($B_sigma,2) + pow($tau,2));
	
    if($A_rank==$B_rank)
    {
        // Draw
        $c_ij = sqrt(2*pow($beta,2) + pow($A_sigma,2) + pow($B_sigma,2));
        $t = ($A_mu - $B_mu)/$c_ij;
        $alpha = $epsilon / $c_ij;
        $d = $alpha - $t;
        $s = $alpha + $t;

        $N_d = 1/(sqrt(2*M_PI)) * exp(- pow($d,2) / 2) ;
        $Psi_d = cdf($d);
        $N_s = 1/(sqrt(2*M_PI)) * exp(- pow($s,2) / 2) ;
        $Psi_s = cdf(-$s);

        $v = ($N_s-$N_d) / ($Psi_d-$Psi_s);
        $w = pow($v,2) + ($d*$N_d+$s*$N_s) / ($Psi_d-$Psi_s);

        $A_delta_mu = pow($A_sigma,2) * $v / $c_ij;
        $B_delta_mu = - pow($B_sigma,2) * $v / $c_ij;
        $A_delta_sigma = sqrt(1-pow($A_sigma,2) * $w / pow($c_ij,2));
        $B_delta_sigma = sqrt(1-pow($B_sigma,2) * $w / pow($c_ij,2));

        $output .= "A: $A_mu, $A_sigma, $A_delta_mu, $A_delta_sigma<br>";
        $output .= "B: $B_mu, $B_sigma, $B_delta_mu, $B_delta_sigma<br>";
        return array($A_delta_mu,$A_delta_sigma,$B_delta_mu,$B_delta_sigma);
    }
    else
    {
        if($A_rank < $B_rank)
        {
            $winner_mu    = $A_mu;
            $winner_sigma = $A_sigma;
            $looser_mu    = $B_mu;
            $looser_sigma = $B_sigma;
        }
        else
        {
            $winner_mu    = $B_mu;
            $winner_sigma = $B_sigma;
            $looser_mu    = $A_mu;
            $looser_sigma = $A_sigma;
        }

        $c_ij = sqrt(2*pow($beta,2) + pow($winner_sigma,2) + pow($looser_sigma,2));
        $t = ($winner_mu - $looser_mu)/$c_ij;
        $alpha = $epsilon / $c_ij;
        $d = $t - $alpha;
        
        $output .= "c_ij = $c_ij<br>";
        $output .= "t = $t<br>";
        $output .= "alpha = $alpha<br>";
        $output .= "d = $d<br>";

        $N = 1/(sqrt(2*M_PI)) * exp(- pow($d,2) / 2) ;
        
        $erf1 = erf($d / sqrt(2));
        $output .= "erf1 = $erf1<br>";
        
        $Psi = cdf($d);

        $output .= "N = $N<br>";
        $output .= "Psi = $Psi<br>";

        $v = $N / $Psi;
        $w = $v * ($v + $d);

        $output .= "v = $v<br>";
        $output .= "w = $w<br>";

        $winner_delta_mu = pow($winner_sigma,2) * $v / $c_ij;
        $looser_delta_mu = - pow($looser_sigma,2) * $v / $c_ij;
        $winner_delta_sigma = sqrt(1-pow($winner_sigma,2) * $w / pow($c_ij,2));
        $looser_delta_sigma = sqrt(1-pow($looser_sigma,2) * $w / pow($c_ij,2));

        $output .= "Winner: $winner_mu, $winner_sigma, $winner_delta_mu, $winner_delta_sigma<br>";
        $output .= "Looser: $looser_mu, $looser_sigma, $looser_delta_mu, $looser_delta_sigma<br>";

        if($A_rank < $B_rank)
        {
            return array($winner_delta_mu,$winner_delta_sigma,$looser_delta_mu,$looser_delta_sigma);
        }
        else
        {
            return array($looser_delta_mu,$looser_delta_sigma,$winner_delta_mu,$winner_delta_sigma);
        }
    }
}

function erf_simple($x)
{
    $a = (8*(M_PI - 3))/(3*M_PI*(M_PI - 4));
    $x2 = $x * $x;

    $ax2 = $a * $x2;
    $num = (4/M_PI) + $ax2;
    $denom = 1 + $ax2;

    $inner = (-$x2)*$num/$denom;
    $erf2 = 1 - exp($inner);

    if($x < 0)
    {
        return -sqrt($erf2);
    }
    else
    {
        return sqrt($erf2);
    }
}

function erf($x)
{
    $z=abs($x);
    $t=1/(1+0.5*$z);
    $erfcf = $t*exp(-$z*$z-1.26551223
    +$t*(1.00002368
    +$t*(0.37409196
    +$t*(0.09678418
    +$t*(-0.18628806
    +$t*(0.27886807
    +$t*(-1.13520398
    +$t*(1.4885187
    +$t*(-0.82215223
    +$t*0.1708277
    )))))))));
    if ($x<0)
    {
        $erff = $erfcf-1;
    }
    else
    {
        $erff = 1-$erfcf;
    }
    return $erff;
}

function cdf($n)
{
        return (1 + erf($n / sqrt(2)))/2;
}
?>

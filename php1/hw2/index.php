
<h3>Задание 1</h3>
<?php

$a = 2;
$b = 1;
if ($a > 0 and $b > 0) {
	echo "$a - $b";
} elseif ($a < 0 and $b < 0) {
	echo "$a * $b";
} elseif ($a > 0 && $b < 0 || $a < 0 && $b > 0) {
	echo "$a + $b";
} 
?>
<h3>Задание 2</h3>

<?php
$a = 4;
    switch($a) {
        case 0:
        case 1:
        case 2:
        case 3:
            echo('мало');
            break;
        case 4:
            echo('Ура!');
            break;
        case 5:
        case 6:
        case 7:
        case 8:
        case 9:
        case 10:
        case 11:
        case 12:
        case 13:
        case 14:
        case 15:
            echo('перебор');
            break;
        default:
            echo('Я таких значений не знаю');
    }
?>
<h3>Задание 3</h3>
<?php
function sum($x,$y) {
    return $x+$y;
}
function avg($x,$y) {
    return ($x+$y)/2;
}
function compare($x,$y) {
    if ($x>$y)
        return $x>$y;
    else
        return $x<$y;
}
function modulo($x,$y) {
    return $x%$y;
}

echo(sum(5,2));
echo(avg(5,2));
echo(compare(5,2));
echo(modulo(5,2));
?>

<h3>Задание 4</h3>

<?php 
function mathSub($a=5, $b=3, $sub) {
    if ($a>0 && $b>0) {
        $sub=$a-$b;
        return $sub;
    }
    else if ($a<0 && $b<0) {
        $sub=$a*$b;
        return $sub;
    }
    else if ($a<0 && $b>0 || $a>0 && $b<0) {
        $sub=$a+$b;
        return $sub;
    }
    switch ($sub) {
        case 2:
            echo('Ура');
            break;
        case 15:
            echo('нет');
            break;
        case 8:
            echo('нет');
            break;
    }
}
echo(mathSub(5,3, $sub));
?>

<h3>Задание 5</h3>

<?php
echo date('Y'); 
?>

<h3>Задание 6</h3>

<?php
function power($val, $pow) {
    if ($pow == 1) {
        return $val;
    }
    elseif ($pow < 0) {
    	return power(1/$val, -$pow);
    }
    return $val * power($val, $pow - 1);
}
echo(power(52,2));
?>

<h3>Задание 7</h3>
<?php
$h = date("H");
$m = date("i");
if ($h==1 || $h==21) {
$hours = " час";}
elseif (($h>=2 && $h<=4) || ($h>=22 && $h<=24)) {
$hours = " часа";}
else {$hours = " часов";}
if (($m<20) || ($m>10))
{$minutes = " минут.";}
elseif (($m % 10) === 1) {
$minutes = " минута.";}
elseif ((($m % 10)>=2) && (($m % 10)<=4)) {
$minutes = " минуты.";}
else {
$minutes = " минут.";}
echo $h . $hours . " " . $m . $minutes;
?>
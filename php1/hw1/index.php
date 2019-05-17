<?php
$h1 = "Примеры из методички"; //задание 4
$title = "Домашнее задание";
?>

<h1><?php echo $h1; ?></h1>

<title><?php echo $title; ?></title>


<h3>Задание 2</h3>


<?php
echo "Hello, World!";
?>

<br>

<?php
$name = "GeekBrains user";
echo "Hello, $name";
?>

<br>

<?php
define('MY_CONST', 100);
echo MY_CONST;
?>

<br>

<?php
$int10 = 42;
$int2 = 0b101010;
$int8 = 052;
$int16 = 0x2A;
echo "Десятеричная система $int10 <br>";
echo "Двоичная система $int2 <br>";
echo "Восьмеричная система $int8 <br>";
echo "Шестнадцатеричная система $int16 <br>";
?>

<?php
$precise1 = 1.5;
$precise2 = 1.5e4;
$precise3 = 6E-8;
echo "$precise1 | $precise2 | $precise3";
?>

<br>
<?php
$a = 1;
echo "$a";
echo '$a';
?>

<br>

<?php
$a = 'Hello,';
$b = 'world';
$c = $a . $b;
echo $c;
?>

<br>

<?php
$a = 4;
$b = 5;
echo $a + $b . '<br>'; // сложение
echo $a * $b . '<br>'; // умножение
echo $a - $b . '<br>'; // вычитание
echo $a / $b . '<br>'; // деление
echo $a % $b . '<br>'; // остаток от деления
echo $a ** $b . '<br>'; // возведение в степень
?>

<br>

<?php
$a = 4;
$b = 5;
$a += $b;
echo 'a = ' . $a;
$a = 0;
echo $a++; // Постинкремент
echo ++$a; // Преинкремент
echo $a--; // Постдекремент
echo --$a; // Предекремент
?>

<br>

<?php
$a = 4;
$b = 5;
var_dump($a == $b); // Сравнение по значению
var_dump($a === $b); // Сравнение по значению и типу
var_dump($a > $b); // Больше
var_dump($a < $b); // Меньше
var_dump($a <> $b); // Не равно
var_dump($a != $b); // Не равно
var_dump($a !== $b); // Не равно без приведения типов
var_dump($a <= $b); // Меньше или равно
var_dump($a >= $b); // Больше или равно?>
?>

<h3>Задание 3</h3>


<?php
$a = 5;
$b = '05';
var_dump($a == $b); // true, строка b приводится к числу и сравнивается 5=5
var_dump((int)'012345'); // 12345, строка приводится к числу
var_dump((float)123.0 === (int)123.0); // false, сравниваются числа с плавающей точкой и целые числа. Разные типы данных
var_dump((int)0 === (int)'hello, world'); // true, цифр нет, значит строка приведется к 0, типы данных одинаковые
?>


<h3>Задание 5</h3>

<?php
$a = 1;
$b = 2;
$a ++;
$b--;
echo 'a='. $a .'<br> b='. $b;
?>
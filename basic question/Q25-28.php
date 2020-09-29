<?php

// 25,
// 配列を宣言してください
// Integer(整数) 1個の配列
// String(文字列) 3個の配列


$numbers = array(100);
$words = array("computer","windows","PHP");


// 26,
// 配列は初期化の際に初めから配列の値の代入までまとめて行う事ができます。
// Integer(整数)　3個の配列で　　1,2,3という数字を値に持たせたい。
// 宣言、要素の確保ののちそれぞれに代入する配列の用意の仕方と
// 代入までまとめて行う書き方で用意する仕方にて配列を用意してください


$numbers = [];

for($i = 1; $i <= 3; $i++){
    $numbers[$i] = $i;
}


// 27,
// 26の続き、
// 用意した配列をfor文を使って値を出力してください。
// foreach文を使った値の出力をしてください。


foreach( $numbers as $number){
    echo $number . PHP_EOL;
}


// 28,
// 27の続き、
// 値を出力したあとにそれぞれの値の２乗の値を代入し直すよう修正してください。

foreach($numbers as $index => $number){
    $numbers[$index] = pow($number,2);
}
var_dump($numbers);
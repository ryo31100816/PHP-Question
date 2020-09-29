<?php
// 29,
// 5個のString(文字列)の配列を用意し適当な文字を代入してください。
// その2番目の値を出力してください。

$guitars = array("Gibson","Fender","Martin","Gretsch","PRS");

echo $guitars[1] .PHP_EOL;

// 30,
// 10個のInteger(整数)の配列を用意し適当な値を代入してください。
// 添字が偶数番目の合計値と添字が奇数番目の合計値を出力してください。

$numbers = array(10,20,30,40,50,60,70,80,90,100);
$even = 0;
$odd = 0;

for($i = 0; $i <= 9; $i++){
    if($i % 2 === 0){
        $even += $numbers[$i];
    }else{
        $odd += $numbers[$i];
    }
}
echo $even . PHP_EOL;
echo $odd . PHP_EOL;

// 31,
// Integer(整数)の配列を渡すと、配列の中身が３乗される関数を作ってください。
// なお、関数の中で引数に必要だと思うvalidationも作成してください。（validationの意味がわからない場合は、お調べください）


function check($numbers){
    if(empty($numbers) === true){
        return false;
    }
    if(is_array($numbers) === false){
        return false;
    }
    foreach($numbers as $number){
        if(is_numeric($number) === false){
            return false;
        }
    }
    return true;
}

function cube($numbers){
    $bool = check($numbers);
    if($bool === false){
        echo "値が正常でありません。確認してください。" . PHP_EOL;
        return;
    }
    foreach($numbers as $index => $number){
        $numbers[$index] = pow($number,3);
    }
    return $numbers;
}
$numbers = array(10,5);
$result = cube($numbers);
var_dump($result);

// 32,
// 2つのInteger(整数)の配列を引数にもち、それぞれ同じ順番の値が合計された配列を作る関数を作ってください(配列を返り値として持つ)
// 作られる配列は２つの入力された配列のうち少ない個数の配列の個数とします。

$number1 = array(15,10,2,3,4);
$number2 = array(10,55,5);
$total = array();
$result = array();

function sum($number1,$number2,$total){
    if(count($number1) <= count($number2)){
        $counter = count($number1);
    }else{
        $counter = count($number2);
    }
    for($i = 0; $i < $counter ; $i++){
        $total[] = $number1[$i] + $number2[$i];
    }
    return $total;
}
$result = sum($number1,$number2,$total);
var_dump($result);


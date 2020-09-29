<?php

// 19, while文 do-while文
// 1000から2000までの間で1の桁が7の数字の最初の数字を求めて出力してください
// for文　while文　do-while文を使ってそれぞれ出力してください

// for
for($i = 1000; $i <= 2000; $i++){
    if(( $i / 1) % 10 === 7){
        echo $i . PHP_EOL;
        break;
    }
}

// while
$i = 1000;
while(( $i / 1) % 10 !== 7){
    $i+= 1;
}
echo $i . PHP_EOL;

// do-while
$i = 1000;
do {
    $i+= 1;
} while(( $i / 1) % 10 !== 7);
echo $i . PHP_EOL;

// 20. 関数の基礎
// int型の変数を宣言してください。
// 変数を渡して二乗の整数を返す関数を作成してください

$number = 500;

function squared($number){
   echo pow($number,2) . PHP_EOL;
}

squared($number);

// 21. 関数の基礎2
// boolean型を渡すと別のboolean型を返す関数を作成してください
// ex) trueを渡す→falseが返ってくる

$bool = false;

function inversion($bool){
  return  !$bool;
}

var_dump(inversion($bool));


// 22.
// int型とString型の２つの変数を引数で渡すと 「int型:String型」という文字列を返す関数を作成してください
// ※int型,String型は引数で渡してください
// ex)出力例「 5: ああああ」

$number = 100;
$word = "computer";

function union($number,$word){
    return sprintf("%d: %s", $number, $word) . PHP_EOL;
}

echo union($number,$word);

?>
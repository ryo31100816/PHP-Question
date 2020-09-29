<?php

// 23.
// int型とboolean型を渡し boolean型がtrueなら　int型を1プラスする　falseなら1マイナスする関数を作成してください

$number = 100;
$bool = false;

function calculation($number,$bool){
    if ($bool === true){
        return $number+= 1; 
    }else{
        return $number-= 1;
    }
}

echo calculation($number,$bool) . PHP_EOL;

// 24.
// int型とString型を渡しそのint型の数値の回数分　型の内容Stringを出力する関数を作成してください
// (int型が0以下の場合　「範囲外の入力値です」と出力してください

$number = 10;
$word = "PHP";

function output($number,$word){
    if($number <= 0){
        echo "範囲外の入力値です" . PHP_EOL;
        return;
    }
    for($i = 1; $i <= $number; $i++){
        echo $word . PHP_EOL;
    }   
}

output($number,$word);

// ★★★★★★★★★★★★★★★
// せっかくですので、ここで追加問題といきますね。再帰関数の問題です。
// 設問13ですが、現状では２つの変数が固定値となっていますので、これをランダムな数字が代入された２つの値を返すような関数を作成してみましょう。
// また２つの変数の差がマイナスになる場合は、再度、同じ関数を呼び、再代入するような関数を作成してみてください。
// 13. 条件式
// 整数型の２つの変数を宣言してください。
// 上記で宣言した２つの変数の内、1つ目を2つ目で引いた数字が偶数、奇数、0で「偶数です」「奇数です」「0です」と表示させるような条件式を書いてください。
// よろしければ、トライしてみてください＾＾


function getRandNums() {
    $number1 = mt_rand(1,100);
    $number2 = mt_rand(1,100);
    if($number1< $number2){
       return getRandNums();
    }
    return array($number1,$number2);
}

function judge(){
    $rndnums = getRandNums();
    $result = $rndnums[0] - $rndnums[1];
    if($result % 2 === 0){
        echo "偶数です";
    }else{
        echo  "奇数です";
    }
}
judge();

?>

<?php

// 1. 基本的な変数の宣言
// 以下の指定された条件に合うような値を変数に代入して宣言してください。
// ・整数（int） $number: 5
// ・文字列（string） $text: test
// ・論理型（boolean） $flag: true
// ・null型 $test: null

// 数値
$number = 5;

// 文字列
$text = "test";

// 論理型
$flag = true;

// Null型
$test = null;

// 2. 基本的な計算
// 整数型の２つの変数を宣言してください。
// 2つの変数を用いて、　足す、引く、かける、割る、割った余りを出力してください。

// 整数1
$number1 = 10;
// 整数2
$number2 = 2;

// 足し算
echo $number1 + $number2."\n";

// 引き算
echo $number1 - $number2."\n";

// 掛け算
echo $number1 * $number2."\n";

// 割り算
echo $number1 / $number2."\n";

// あまり
echo $number1 % $number2."\n";


// 3. 条件式とboolean(論理型)について
// 初期値がfalseである論理型の変数を宣言してください。
// 問題2で宣言した２つの変数を足した結果が偶数であれば、論理型の変数にtrueを代入してください。

// 初期値falseを設定
$isEvenNumber = false;

// 整数1と整数2を合計し格納
$SumNumber = $number1 + $number2;

// 合計の数値を割って偶数なら変数を上書きする
if ($SumNumber % 2 == 0 ) {
    $isEvenNumber = true;
}

// 4. 条件式
// 設問3のboolean型の変数を利用した条件式を作成し、以下のように出力してください。
// ・偶数なら..... 「偶数です」
// ・奇数なら.....「奇数です」

// $isEvenNumberが偶数のとき
if ($isEvenNumber == true) {

    echo "偶数です";

// $isEvenNumberが奇数のとき
} else {

    echo "奇数です";

}

?>

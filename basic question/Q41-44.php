<?php

// 41
// $x = "abcaあいう"; と宣言する
// 「あいう」という文字のみを切り抜いて表示してください

$x = "abcaあいう"; 
$target = "あいう";

$position = strpos($x, $target);
echo substr($x,$position) . PHP_EOL;

// 42
// 次の配列を宣言する
// $array1 = array('あ', 'い', 'う', 'え', 'お');
// 降順にソートして出力してください
// ex) おえういあ

$array1 = array('あ', 'い', 'う', 'え', 'お');

rsort($array1);
foreach($array1 as $descending){
    echo $descending;
}

echo PHP_EOL;
// 43
// 42の機能を関数にしてください

function descending($array1){
    rsort($array1);
    foreach($array1 as $descending){
        echo $descending;
    } 
}
descending($array1);


echo PHP_EOL;
// 44 
// 次のソースコードの関数内を埋めて、2と表示されるソースコードを作成しなさい
// 元の処理の改変は行わないこと
// <?php
//     $number = 1;
//     function add_number()
//     {
//         //
//         // ここに処理を追加
//         //
//     }
//     add_number();
//     echo $number;
//

$number = 1;
function add_number(){
    global $number;
    $number += 1;
}
add_number();
echo $number;

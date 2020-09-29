<?php

// 33,
// 1階層3部屋ある3階建てのアパートがある。101 102、、、という部屋番号で管理するとする。
// 多次元配列で表してください。

$apart = [ 
    [101,102,103], 
    [201,202,303], 
    [301,302,303]
];

var_dump($apart);

// 34,連想配列
// メンバーを意味する配列に下記内容をキーに持つ値を格納したい。
// 名前
//     -性別
//     -年齢
// メンバーを意味する配列を宣言し、上記内容を保持する配列を作成してください。

$members = [
    '名前'=>['Ryo'],
    '性別'=>['男'],
    '年齢'=>['30']
];

var_dump($members);

// 35,
// 次の配列を使用して、2という値を出力してください。

$test = array(
    array(
      array(
        1,1,1
      ),
      array(
        1,1,1
      ),
      array(
        1,1,1
      )
    ),
    array(
      array(
        1,1,2
      ),
      array(
        1,1,1
      )
    )
  );

echo $test[1][0][2] . PHP_EOL;

// 36,
// 35の続き、
// 35の配列をfor文をつかって全て出力してください　　(1 1 1 1 1 1 1 1 1 1 1 2 1 1 1　的な)
// foreach文を使った出力もしてください。

// for文
    for($i = 0; $i <= 1; $i++){
      for($j = 0; $j <= count($test[$i]) - 1; $j++){
        for($k = 0; $k <= 2; $k++){
          echo $test[$i][$j][$k];
        }     
      }
    }

  echo PHP_EOL;

// foreach文
foreach($test as $array_A => $array_1){
    foreach($array_1 as $array_X){
        foreach($array_X as $value){
            echo $value;
        }    
    }
}
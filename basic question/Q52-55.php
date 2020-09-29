<?php

// 52
// 連想配列を宣言しなさい
// first_name : joe
// last_name : jonathan
// age : 12

$character = array('first_name'=>'joe', 'last_name'=>'jonathan', 'age'=>12);

// 53
// 52の連想配列を使用し、次のように出力しなさい
// name : joe jonathan
// age : 12
echo 'name : '.$character['first_name']. ' '.$character['last_name']. PHP_EOL;
echo 'age : '.$character['age']. PHP_EOL;


// 54
// 53の続き、
// 連想配列の中身を追加し、表示しなさい
// favorite => spiderman
// 追加した配列は次のように表示される
// name : joe jonathan
// age : 12
// favorite : spiderman

$character['favorite'] = 'spiderman';

echo 'name : '.$character['first_name']. ' '.$character['last_name']. PHP_EOL;
echo 'age : '.$character['age']. PHP_EOL;
echo 'favorite : '.$character['favorite']. PHP_EOL;

// 55
// 54の続き、
// ageとfavoriteの中身を次のように書き換え,表示しなさい
// age => 23
// favorite => music

$character['age'] = 23;
$character['favorite'] = 'music';

echo 'name : '.$character['first_name']. ' '.$character['last_name']. PHP_EOL;
echo 'age : '.$character['age']. PHP_EOL;
echo 'favorite : '.$character['favorite']. PHP_EOL;
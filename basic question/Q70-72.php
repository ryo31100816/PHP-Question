<?php

// // //70 ファイル関数
// // 5つの果物の名前(string型)の要素をもつ配列を宣言してください。
// // カレントディレクトリに、配列の中身を１行ずつ記載したCSVファイルを出力してください。
// // CSVのファイル名はfruits.csvとします。ex)
// // $fruits = array("apple", "banana", "orange); なら
// // CSVファイルの中身は
// // apple
// // banana
// // orange

$fruits = array('apple','banana','orange','melon','pineapple');
$filename = 'fruits.csv';

$file = new SplFileObject($filename, 'w');
foreach($fruits as $line){
    $line = mb_convert_encoding($line,'SJIS','UTF8');
    $file->fwrite($line. PHP_EOL);
}





// // //71
// // 70.の続き
// // csvファイルの出力場所を下記パスに変更してください。
// // ./csv/dev/fruits/
// // その際に、上記パスのディレクトリが存在しない場合は、再帰的にディレクトリを作成する処理を追加してください。

$filepath = './csv/dev/fruits/';

if(!is_dir($filepath)){
    mkdir($filepath, 0777, true);
}else{
    $file = new SplFileObject($filepath.$filename, 'w');
    foreach($fruits as $line){
        $line = mb_convert_encoding($line,'SJIS','UTF8');
        $file->fwrite($line. PHP_EOL);
    }
}

// //72
// 71.の続き
// 71で出力したcsvファイルに、それぞれ金額と在庫数の項目を追加したい。
// 71で出力したcsvファイルを読み込んで、金額と在庫数の項目を追加してください。
// なお金額は、100,200,300のうちのどれか、在庫数は999個以下のランダムな数字とする。
// ex)
// apple,100, 345
// banana,200,247
// orange,300,987

$pickup_fruits = array();
$price = array(100,200,300);

$read_file = new splfileobject($filepath.$filename,);
$read_file->setFlags(splfileobject::READ_CSV |
                     splFileobject::SKIP_EMPTY |
                     splFileobject::READ_AHEAD
                    );

foreach($read_file as $line){
	$pickup_fruits[] = $line;
}

foreach($pickup_fruits as $fruits_items){
    $stock =  mt_rand(0,999);
    $fruits_items[] = $price[mt_rand(0,2)];
    $fruits_items[] = $stock;
    $write_data[] = $fruits_items;    
}

$write_file = new splfileobject($filepath.$filename,'w');
foreach($write_data as $line){
    $line = mb_convert_encoding($line,'SJIS','UTF8');
    $write_file->fputcsv($line);
}




// //70 ファイル関数
// 5つの果物の名前(string型)の要素をもつ配列を宣言してください。
// カレントディレクトリに、配列の中身を１行ずつ記載したCSVファイルを出力してください。
// CSVのファイル名はfruits.csvとします。ex)
// $fruits = array("apple", "banana", "orange); なら
// CSVファイルの中身は
// apple
// banana
// orange

$fruits = array('apple','banana','orange','melon','pineapple');
$filename = 'fruits.csv';

$file = fopen($filename, 'w');
foreach($fruits as $line){
    fwrite($file,$line. PHP_EOL);
}
fclose($file);

// //71
// 70.の続き
// csvファイルの出力場所を下記パスに変更してください。
// ./csv/dev/fruits/
// その際に、上記パスのディレクトリが存在しない場合は、再帰的にディレクトリを作成する処理を追加してください。

$filepath = './csv/dev/fruits/';

if(!is_dir($filepath)){
    mkdir($filepath, 0777, true);
}
$file = fopen($filepath.$filename, 'w');
foreach($fruits as $line){
    $line = mb_convert_encoding($line,'SJIS','UTF8');
    fwrite($file,$line. PHP_EOL);
}
fclose($file);


// //72
// 71.の続き
// 71で出力したcsvファイルに、それぞれ金額と在庫数の項目を追加したい。
// 71で出力したcsvファイルを読み込んで、金額と在庫数の項目を追加してください。
// なお金額は、100,200,300のうちのどれか、在庫数は999個以下のランダムな数字とする。
// ex)
// apple,100, 345
// banana,200,247
// orange,300,987

$price = array(100,200,300);
$write_filename = 'add_fruits.csv';

$read_file = fopen($filepath.$filename,'r');
$write_file = fopen($filepath.$write_filename,'w');

while($line = fgets($read_file)){
    $stock =  mt_rand(0,999);
    fwrite($write_file,trim($line).','.$price[mt_rand(0,2)].','.$stock. PHP_EOL);
}
fclose($read_file);
fclose($write_file);

if(file_exists($filepath.$filename)){
    unlink($filepath.$filename);
    rename($filepath.$write_filename,$filepath.$filename);
    echo '更新しました。'. PHP_EOL;
}
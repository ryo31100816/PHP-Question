<?php

// //73
// 72の続き
// 出力するCSVファイルの1行目に出力項目をわかりやすいように追加したい。
// １行目に「name,price,stock」が表示されるように72のソースを改修してください。
// ex)
// name,price,stock
// apple,100, 345
// banana,200,247
// orange,300,987
// 出力するCSVのファイル名を現在時刻にしてください。
// ex)
// 201904041609.csv

$fruits = array('apple','banana','orange','melon','pineapple');

$read_filename = 'fruits.csv';
$write_filename = 'add_fruits.csv';

$filepath = './csv/dev/fruits/';

$price = array(100,200,300);

$read_fp = fopen($filepath.$read_filename,'r');
$write_fp = fopen($filepath.$write_filename,'w');
while($fruits = fgets($read_fp)){
    $stock =  mt_rand(0,999);
    $line = sprintf("%s,%s,%s", trim($fruits), $price[mt_rand(0,2)], $stock) . PHP_EOL;
    fwrite($write_fp,$line);
}
fclose($read_fp);
fclose($write_fp);

$write_fp = fopen($filepath.$write_filename,'r+');
if(flock($write_fp,LOCK_EX)){
    $context = fread($write_fp,filesize($filepath.$write_filename));
    ftruncate($write_fp, 0);
    $header_line = 'name,price,stock'. PHP_EOL;
    fwrite($write_fp,$header_line);
    fwrite($write_fp,$context);
    flock($write_fp,LOCK_UN);
}
fclose($write_fp);

if(file_exists($filepath.$read_filename)){
    unlink($filepath.$read_filename);
    $new_filename = date('YmdHi').'.csv';
    rename($filepath.$write_filename,$filepath.$new_filename);
    echo '更新しました。'. PHP_EOL;
}


// //74
// 1-100までのidにそれぞれユニークなIDを紐つけたCSVファイルを出力したい。
// ユニークIDの仕様は、ランダムな数字6桁 + 一意なID13桁とする（計19桁）下記パスに出力してください。
// ./csv/dev/unique/
// 出力するファイル名はuniqueId.csvとする。
// ex)
// id, uniqueId
// 1,1057225cd930000d762
// 2,9561415cd930000d785
// ~

$filename = 'uniqueid.csv';
$filepath = './csv/dev/unique/';
if(!is_dir($filepath)){
    mkdir($filepath, 0777, true);
}

$fp = fopen($filepath.$filename,'w');
$header_line = 'id,uniqueId'. PHP_EOL;
fwrite($fp,$header_line);
$rnd_num = '';
for($i = 1; $i <= 100; $i++){
    for($j = 1; $j <= 6; $j++){
        $rnd_num .= mt_rand(0,9);
    }
    $uniq_id = uniqid();
    $line = sprintf('%s,%s',$i,$rnd_num.$uniq_id). PHP_EOL;
    if($i === 100){
        $line = sprintf('%s,%s',$i,$rnd_num.$uniq_id);
    }
    fwrite($fp,$line);
    $rnd_num = '';
}
fclose($fp);

// //75　ファイル分割
// 74の続き
// 74で出力したcsvファイルを読みこんで、
// 10個のファイルに分割して出力してください。
// なお、分割ファイルのファイル名は、それぞれuniqueId_1.php ~ のように連番とすること

$read_fp = fopen($filepath.$filename,'r');
$header_line =  fgets($read_fp);

$count = 1;
while(!feof($read_fp)){
    $filename = 'uniqueId_'.$count.'.csv';
    $write_fp = fopen($filepath.$filename,'w');
    fwrite($write_fp,$header_line);
    for($i = 1; $i <= 10; $i++){
        fwrite($write_fp,fgets($read_fp));
    }
    fclose($write_fp);
    $count ++;
}
fclose($read_fp);

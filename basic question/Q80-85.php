<?php

// /80
// 環境変数に従って、下記パスにcsvファイルを出力するようにしてください。
// もしディレクトリが存在しない場合は、再帰的に作成するような処理を書くこと。
// ｀｀｀./csv/{環境変数}/ファイル名｀｀｀

$env = getenv("ENV");
$file_path = './csv/'.$env.'/';
if(!is_dir($file_path)){
    mkdir($file_path, 0777, true);
}
$file_name = 'index.csv';
touch($file_path.$file_name);

// //81
// ｀｀｀http://localhost:1234｀｀｀
// こちらのURLにアクセスできるようなビルトインウェブサーバーのコマンドを書いてください。

php -S localhost:1234

// //82
// 下記パスのファイル名のみを取得し、出力してください。
// "/app/doc/test/sample/dev/test.php"
// 期待値
// test.php

$file_path = "/app/doc/test/sample/dev/test.php";
$file_name = basename($file_path);
echo $file_name. PHP_EOL;

// //83
// 下記パスのディレクトリのパスのみを取得し、出力してください。
// "/app/doc/test/sample/dev/test.php"
// 期待値
// /app/doc/test/sample/dev

$file_path = "/app/doc/test/sample/dev/test.php";
$dir_path = dirname($file_path);
echo $dir_path. PHP_EOL;

// //84
// $array = array(
//        "a" => 1,
//        "b" => 2,
//    );
// 上記の配列をjson化して出力してください。
// またjson化したものをデコードしてください。

$array = array(
        "a" => 1,
        "b" => 2,
    );

$json_data = json_encode($array);
var_dump($json_data). PHP_EOL;

$decode_data = json_decode($json_data,true);
var_dump($decode_data). PHP_EOL;

// //85
// eyJtZXNzYWdlIjoiQ29uZ3JhdHVsYXRpb25zISJ9
// 上記は、base64でエンコードされた文字列です。
// base64でデコードし、さらにjsonをデコードされた内容をvar_dump()で出力してください。

$base64_data = 'eyJtZXNzYWdlIjoiQ29uZ3JhdHVsYXRpb25zISJ9';
$base64_data = base64_decode($base64_data);
var_dump($base64_data). PHP_EOL;
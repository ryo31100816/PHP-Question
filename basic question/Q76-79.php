<?php

// //76
// try catch
// 1- 10 までのランダムな数字を変数に代入してください。
// もし生成した数字が奇数なら例外を発生させ、
// 「奇数です」と例外メッセージを出力してください。

try {
    function checkOdd(){
        $rnd_num = mt_rand(1,10);
        if($rnd_num % 2 === 1){
            throw new Exception('奇数です'. PHP_EOL);
        }
    }
    checkOdd();
} catch(Exception $e){
    echo $e->getMessage();
    echo $e->getTraceAsString(). PHP_EOL;
}

// //77
// 例外が発生するしないに限らず、「例外処理を終了します」と出力するように実装してください。(finallyを利用して

try {
    $rnd_num = mt_rand(1,10);
    if($rnd_num % 2 === 1){
        throw new Exception('奇数です'. PHP_EOL);
    }
} catch(Exception $e) {
    echo $e->getMessage();
} finally {
    echo '例外処理を終了します'. PHP_EOL;
 }

// //78
// exceptionクラスを継承した独自の例外クラスを宣言してください。
// 独自の例外クラスを使用して、エラーメッセージを出力してください。

try {
    $rnd_num = mt_rand(1,10);
    if($rnd_num === 3 || $rnd_num === 5 || $rnd_num === 7){
        throw new MyException();
    }
    if($rnd_num % 2 === 1){
        throw new Exception('奇数です'. PHP_EOL);
    }
} catch(Exception $e) {
    echo $e->getMessage();
} catch(MyException $e) {
    echo $e->getMessage();
} finally {
    echo '例外処理を終了します'. PHP_EOL;
 }

class MyException extends Exception{
    public function __construct(){
        parent::__construct('素数です'. PHP_EOL,800);
    }
}

// //79
// コマンドラインからphpファイル実行時、環境に合わせて出力内容を変えたい。
// 主な環境は、dev, stg, master の3つとする。
// コマンドラインに入力した環境変数を取得し、その環境変数を出力するような処理を書いてください。
// なお、実行コマンドは下記の通りとする。
// ex) ENV=stg php index.php
// #出力
// stg

$env = getenv("ENV");

if($env === 'dev'){
    echo $env;
}

if($env === 'stg'){
    echo $env;
}

if($env === 'master'){
    echo $env;
}
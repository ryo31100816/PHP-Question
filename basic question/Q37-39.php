<?php

// 37,三項演算子
// Integer(整数)の変数を2つ、String(文字列)の変数を1つ宣言してください。
// 2つのint型変数の合計が100未満なら「100未満」、そうじゃなければ「100以上」とString(文字列)に三項演算子(条件演算子)を使って代入して、出力してください。

$number1 = 90;
$number2 = 10;
$result = "";

$result = $number1 + $number2 < 100 ? '100未満' : '100以上';
echo $result . PHP_EOL;

// 38,文字列検索
// string型の変数を２つ宣言してください。
// 第二引数のString(文字列)が第一引数に含まれているかどうかのboolean型を返す関数を作成してください。

$source = "acousticguitar";
$target = "guitar";

function wordIncludes($source ,$target){
    if(strpos($source ,$target) !== false){
        return true;
    }
    return false;
}
$result = wordIncludes($source ,$target);
var_dump($result);

// 39, 標準入力
// PHPファイルはコマンドラインから実行してください。
// 仕様
// 「あなたの名前を教えてください。」出力
// ↓
// 入力 ex) Micael
// ↓
// 「Micaelさん、あなたの年齢は何歳ですか？」出力
// ↓
// 入力
// ↓
// 「Micaelさん、ご登録ありがとうございます！」出力
// ↓
// プログラム終了


function checkName($get_input){
    if(empty($get_input) === true){
        return false;   
    }
    if(strlen($get_input) > 10 ){
        return false;
    }
    return true;
}

function checkAge($get_input){
    if(empty($get_input) === true){
        return false;   
    }
    if(is_numeric($get_input) === false){
        return false;
    }
    return true;
}

function register($type){
    $get_input = trim(fgets(STDIN));
    if($type === "name"){
        $bool = checkName($get_input);
    }elseif($type === "age"){
        $bool = checkAge($get_input);
    }
    if($bool === false){
        return register($type);
    }
return $get_input;
}

function registerAccount(){
    echo 'あなたの名前を入力してください。';
    $name = register("name");
    echo $name.'さん、あなたの年齢は何歳ですか？';
    $age = register("age");
    echo $name.'さんは'.$age.'歳です。ご登録ありがとうございます！';
}
registerAccount();

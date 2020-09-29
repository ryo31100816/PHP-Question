<?php

// 56
// 55の続き、
// 54の連想配列を多次元連想配列としなさい。
// 次の情報で配列追加すること
// first_name => kelly
// last_name => clarkson
// age => 35
// favorite => singing

$persons = array(
    '1'=>array(
        'first_name'=>'joe', 
        'last_name'=>'jonathan', 
        'age'=>12,
        'favorite'=>'music'
    )
);

$persons['2'] = array(
    'first_name'=>'kelly', 
    'last_name'=>'clarkson', 
    'age'=>35,
    'favorite'=>'singing'
);

// 57
// 56の続き
// foreach文、for文を使って多次元配列を出力しなさい
// ex)
// 1人目
// name : joe jonathan
// age : 23
// favorite : music
// 2人目
// name : kelly clarkson
// age : 35
// favorite : singing

foreach($persons as $count => $character){
    echo $count.'人目'. PHP_EOL;
    echo 'name : '.$character['first_name']. ' '.$character['last_name']. PHP_EOL;
    echo 'age : '.$character['age']. PHP_EOL;
    echo 'favorite : '.$character['favorite']. PHP_EOL;
}

for($i = 0; $i < count($persons); $i++){
    list($count,$character) = each($persons);

    echo $count.'人目'. PHP_EOL;
    echo 'name : '.$character['first_name']. ' '.$character['last_name']. PHP_EOL;
    echo 'age : '.$character['age']. PHP_EOL;
    echo 'favorite : '.$character['favorite']. PHP_EOL;
}

// 58
// Memberというクラスを作成しなさい。
// 名前というmember変数を持つことができる。
// registというメソッドで名前を設定し、
// showというメソッドでセットされた名前を出力する機能を作りなさい。
// 出力例 山田太郎さんです。
// Memberクラスのインスタンスを生成し、registメソッドで名前設定後、
// showメソッドで名前を出力しなさい。

class Member{
    public $name;
    
    public function regist($name){
        $this->name = $name;
    }
    public function show(){
        echo $this->name.'さんです。';
    }
}

$member = new Member;
$member->regist('山田太郎');
$member->show();

// 59
// 58の続き、
// Memberクラスを改修する
// Memberというクラスは名前と年齢を持つ事ができる。
// registというメソッドで名前と年齢を設定し、
// showというメソッドでセットされた名前と年齢を出力する機能を作れ
// 出力例　山田太郎さんは１１歳です。
// Memberクラスのインスタンスを生成し、registメソッドを使用し登録。
// その後showメソッドを使用して出力しなさい。

class Member{
    public $name;
    public $age;

    public function regist($name,$age){
        $this->name = $name;
        $this->age = $age;
    }
    public function show(){
        echo $this->name.'さんは'.$this->age.'歳です。';
    }
}

$member = new Member;
$member->regist('山田太郎',11);
$member->show();

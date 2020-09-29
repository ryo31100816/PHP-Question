<?php

// 60
// 59の続き、
// Memberクラスを改修する
// Memberというクラスは名前と年齢を持つ事ができる。
// setNameというメソッドで名前を設定する。
// setAgeというメソッドで年齢を設定する。
// showというメソッドでセットされた名前を出力する機能を作成しなさい。
// 出力例　山田太郎さんは１１歳です。

class Member{
    public $name;
    public $age;

    public function setName($name){
        $this->name = $name;
    }
    public function setAge($age){
        $this->age = $age;
    }
    public function regist($name,$age){
        $this->setName($name);
        $this->setAge($age);
    }
    public function show(){
        echo $this->name.'さんは'.$this->age.'歳です。';
    }
}

$member = new Member;
$member->regist('山田太郎',11);
$member->show();

// 61
// 60の続き、
// 3人の情報を持ちたい
// Memberクラスの配列を作りなさい。
// それぞれの名前、年齢はは適当に入力すること

$members = array(
    new Member('Wes Montgomery',45),
    new Member('Jim Hall',83),
    new Member('Joe Pass',65)
);

// 62
// 61の続き、
// 名前と年齢をコンストラクターで登録するMemberクラスを作成し、インスタンス生成しなさい。
// showメソッドで出力結果を確認すること

class Member{
    public $name;
    public $age;

    public function __construct($name,$age){
        $this->name = $name;
        $this->age = $age;
    }
    public function show(){
        echo $this->name.'さんは'.$this->age.'歳です。'. PHP_EOL;
    }
}

foreach($members as $member){
    $member->show();
}

// 63
// 次のクラスをカプセル化し、$languageはアクセサメソッドからのみ、代入・参照できる様に修正しなさい
// <?php
//   class HumanBase {
//     public $human_count;
//     public $language = "Japanese";
//   }
//   $human_base = new HumanBase();
//   echo $human_base->language;

class HumanBase {
    private $human_count;
    private $language = "Japanese";

    public function setHumanCount($count){
        $this->human_count = $count;
    }
    public function getLanguage(){
        return $this->language;
    }
}

$human_base = new HumanBase();
$human_base->setHumanCount(1);
echo $human_base->getLanguage(). PHP_EOL;
var_dump($human_base);
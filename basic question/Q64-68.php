<?php

// 64
// 63の続き、
// HumanBaseクラスのインスタンスを生成した際にインスタンスの生成回数を追加し、
// インスタンスを生成した回数がわかる様にしなさい
// 回数はコンストラクタ内で行うようにし、
// インスタンスが生成された回数は、クラスの外から参照できるようにすること
// $human_countをクラス変数として書き換えることで実現できる

class HumanBase {
    public static $human_count;
    private $language = "Japanese";

    public function __construct(){
        self::$human_count ++;
    }
    public function getLanguage(){
        return $this->language;
    }
}

for($i = 1; $i <= 10; $i++){
    $human_base = new HumanBase();
}

echo HumanBase::$human_count .PHP_EOL;
echo $human_base->getLanguage(). PHP_EOL;

// 65
// 64の続き、
// HumanBaseクラスを継承する、Humanクラスを作成しなさい
// 作成後、64で実行していたHumanBaseクラスのインスタンス生成で実行していた処理をHumanクラスに置き換えなさい

class HumanBase {
    public static $human_count;
    private $language = 'English';

    public function getLanguage(){
        return $this->language;
    }
}

class Human extends HumanBase{
    public function __construct(){
        self::$human_count ++;
    }
}

for($i = 1; $i <= 10; $i++){
    $human = new Human();
}

echo Human::$human_count. PHP_EOL;

// 66
// 65の続き、
// Humanクラスのインスタンス変数に$first_name, $last_name, $ageを追加し、アクセサメソッドも追加しなさい
// カプセル化を想定した記述方法とすること
// 実装後、2名分のインスタンス生成、データ設定、データ出力を実行すること

class Human extends HumanBase{
    private $first_name;
    private $last_name;
    private $age;
    private $language;

    public function __construct(){
        self::$human_count ++;
    }
    public function setHuman($first_name,$last_name,$age){
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->age = $age;
        $this->language = parent::getlanguage();
    }
    public function show(){
        echo ' first_name:'.$this->first_name.' last_name:'.$this->last_name.' age:'.$this->age.' language:'.$this->language. PHP_EOL;
    }
}

$human = new Human();
$human->setHuman('Pat','Martino',75);
echo Human::$human_count.'人目'. PHP_EOL;
$human->show();

$human = new Human();
$human->setHuman('John','Scofield',68);
echo Human::$human_count.'人目'. PHP_EOL;
$human->show();

// 67
// 68の続き、
// Humanクラスのメソッドに"$first_name-$last_name"の形式で値を取得できるgetFullNameメソッドを追加し、表示させなさい

class Human extends HumanBase{
    private $first_name;
    private $last_name;
    private $age;
    private $language;

    public function __construct(){
        self::$human_count ++;
    }
    public function setHuman($first_name,$last_name,$age){
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->age = $age;
        $this->language = parent::getlanguage();
    }
    public function getFullName(){
        return $this->first_name.' '.$this->last_name;
    }
    public function show(){
        echo 'name:'.$this->getFullName().' age:'.$this->age.' language:'.$this->language. PHP_EOL;
    }
}

$human = new Human();
$human->setHuman('Grant','Green',43);
echo Human::$human_count.'人目'. PHP_EOL;
$human->show();

$human = new Human();
$human->setHuman('George','Benson',77);
echo Human::$human_count.'人目'. PHP_EOL;
$human->show();

// 68
// 67の続き、
// 仕様変更により、$middle_nameの考慮が必要になった
// Humanクラスに$middle_nameを追加し、必要な修正を加えなさい
// なお、フルネームの形式は"$first_name-$middle_name-$last_name"とするが、
// $middle_nameが無い場合は変更前の"$first_name-$last_name"の形式で出力する
// 実装後、生成している2名の内1名だけ$middle_nameを設定せよ

class Human extends HumanBase{
    private $first_name;
    private $middle_name;
    private $last_name;
    private $age;
    private $language;

    public function __construct(){
        self::$human_count ++;
    }
    public function setHuman($first_name,$middle_name,$last_name,$age){
        $this->first_name = $first_name;
        $this->middle_name = $middle_name;
        $this->last_name = $last_name;
        $this->age = $age;
        $this->language = parent::getlanguage();
    }
    public function getFullName(){
        if($this->middle_name){
            return $this->first_name.' '.$this->middle_name.' '.$this->last_name;
        }
        return $this->first_name.' '.$this->last_name;
    }
    public function show(){
        echo 'name:'.$this->getFullName().' age:'.$this->age.' language:'.$this->language. PHP_EOL;
    }
}

$human = new Human();
$human->setHuman('Larry','335','Carlton',72);
echo Human::$human_count.'人目'. PHP_EOL;
$human->show();

$human = new Human();
$human->setHuman('Pat','','Metheny',65);
echo Human::$human_count.'人目'. PHP_EOL;
$human->show();

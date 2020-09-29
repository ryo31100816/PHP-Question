<?php

// ATMを作成
// コマンドラインから実行
// 機能：入金、引き出し、残高照会、暗証番号合わせ

class Atm{
    private $wrong_count;
    private  $user;

    public function __construct(){
        $this->login();
    }
    public function login(){
        echo 'idを入力してください。'. PHP_EOL;
        $id = trim(fgets(STDIN));
        $result = User::isExistById($id);
        if($result !== true){
            echo $result;
            return $this->login();
        }
        $this->user = User::getUserById($id);

        if($this->security() === true){
            echo 'ログインしました。'. PHP_EOL;
            return;
        }
    }
    public function menu(){
        $this->wrong_count = 0;
        echo 'いらっしゃいませ　'.$this->user['name'].'さん'. PHP_EOL;
        echo '選択してください。'.PHP_EOL.
             '1:照会 2:入金 3:出金 4:終了'. PHP_EOL;
        $input_menu = (int)(fgets(STDIN));
        $validation = new MenuValidation();
        $validation->setData($input_menu);
        if($validation->checkMenu() === true){
            switch ($input_menu){
                case 1:
                    $this->inquiry();
                    break;
                case 2:
                    $this->deposit();
                    break;
                case 3:
                    $this->payment();
                    break;
                case 4:
                    exit;
            }
        }else{
            echo $validation->getErrorMessage(). PHP_EOL;
            return $this->menu();
        }
    }
    public function inquiry(){
        echo '-----照会-----'. PHP_EOL;
        $result = $this->security();
        if($result){
            echo '残高　￥'.number_format($this->user['balance']). PHP_EOL;
        }
        $this->atmCountinue();
    }
    public function deposit(){
        echo '-----入金-----'.PHP_EOL;
        $result = $this->security();
        if($result){
            echo '入金額を入力してください'. PHP_EOL;
            $input_amount = trim(fgets(STDIN));
            $validation = new TradeValidation();
            $validation->setData($input_amount);
            if($validation->checkTrade() === true){
                $this->user['balance'] += $input_amount; 
                echo '残高　￥'.number_format($this->user['balance']). PHP_EOL;
            }else{
                echo $validation->getErrorMessage(). PHP_EOL;
                return $this->deposit();
            }
        }
        $this->atmCountinue();
    }
    public function payment(){
        echo '-----出金-----'. PHP_EOL;
        $result = $this->security();
        if($result){
            echo '出金額を入力してください'. PHP_EOL.
                 '現在の残高　￥'.number_format($this->user['balance']). PHP_EOL;
            $input_amount = trim(fgets(STDIN));
            $validation = new TradeValidation();
            $validation->setData($input_amount);
            if($validation->checkTrade() === true){
                if($this->user['balance'] >= $input_amount){
                    $this->user['balance'] -= $input_amount; 
                    echo '残高　￥'.number_format($this->user['balance']). PHP_EOL;
                }else{
                    echo '残高不足です！確認してください'. PHP_EOL;
                    return $this->payment();
                }
            }else{
                echo $validation->getErrorMessage(). PHP_EOL;
                 return $this->payment();
            }
        }
        $this->atmCountinue();
    }
    public function security(){
        echo '4桁のパスワードを入力してください'. PHP_EOL;
        $input_password = trim(fgets(STDIN));
        $validation = new PassValidation();
        $validation->setData($input_password);
        if($validation->checkPassword() === true && $input_password === $this->user['password']){
            return true;
        }
        $this->wrong_count ++;
        if($this->wrong_count === 3){
            echo 'パスワードを'.$this->wrong_count .'回間違えました。終了します。'. PHP_EOL;
            exit;
        }
        echo 'パスワードがちがいます。'.$validation->getErrorMessage(). PHP_EOL;
        return $this->security();    
    }
    public function atmCountinue(){
        echo '取引を継続しますか？ y or n'. PHP_EOL;
        $input_continue = trim(fgets(STDIN));
        $validation = new ContinueValidation();
        $validation->setData($input_continue);
        if($validation->checkContinue() === true){
            if($input_continue === 'y'){
                return $this->menu();
            }
            exit;
        }
        echo $validation->getErrorMessage();
        return $this->atmCountinue();
    }
}

class User {
    static public $user_list = array(
        1 => array(
            "id" => "1",
            "password" => "1234",
            "name" => "tanaka",
            "balance" => "500000"
        ),
        2 => array(
            "id" => "2",
            "password" => "3456",
            "name" => "suzuki",
            "balance" => "1000000"
        )
    ); 
    public static function isExistById($id){
        $validation = new LoginValidation();
        $validation->setData($id);
        if($validation->checkLogin() === true){
            return true;
        }
        return $validation->getErrorMessage();
    }
    public static function getUserById($id){
        return self::$user_list[$id];
    }
}

class BaseValidation{
    const INQUIRY = 1;
    const DEPOSIT = 2;
    const PAYMENT = 3;
    const CLOSE = 4;

    const KEEP = 'y';
    const END = 'n';

    protected $data;
    protected $error_msg;

    public function setData($data){
        $this->data = $data;
    }
    public function getErrorMessage(){
        return $this->error_msg;  
    }
}

class LoginValidation extends BaseValidation{
    public function checkLogin(){
        if(empty($this->data)){
            return false;
        }
        if(!array_key_exists($this->data,User::$user_list)){
            $this->error_msg = 'idがありません。'. PHP_EOL;
        }
        if($this->error_msg){
            return false;
        }
        return true;
    }   
}

class PassValidation extends BaseValidation{
    public function checkPassword(){
        if(empty($this->data)){
            return false;
        }
        if(strlen($this->data) !== 4){
            $this->error_msg = '4桁で入力してください。' .PHP_EOL;
        }
        if($this->error_msg){
            return false;
        }
        return true;
    }
}

class MenuValidation extends BaseValidation{
    public function checkMenu(){
        if(empty($this->data)){
            return false;
        }
        if(in_array($this->data,[self::INQUIRY,self::DEPOSIT,self::PAYMENT,self::CLOSE],true) === false){
            $this->error_msg = '正しいメニューを入力してください。'. PHP_EOL;
        }
        if($this->error_msg){
            return false;
        }
        return true;
    }
}

class TradeValidation extends BaseValidation{
    public function checkTrade(){
        if(empty($this->data)){
            return false;
        }
        if(is_numeric($this->data) === false){
            $this->error_msg = '数値を入力してください。'. PHP_EOL;
        }
        if($this->error_msg){
            return false;
        }
        return true;
    }
}

class ContinueValidation extends BaseValidation{
    public function checkContinue(){
        if(empty($this->data)){
            return false;   
        }
        if(in_array($this->data,[self::KEEP,self::END],true) === false){
            $this->error_msg = 'y　か　nを入力してください。'. PHP_EOL;
        }
        if($this->error_msg){
            return false;
        }
        return true;
    }
}

$atm = new Atm();
$atm->menu();

<?php

// Q.商品マスター登録プログラムを作成

// メインメニュー
// 1, 商品一覧表示
// 2, 商品登録
// 3, 商品削除
// 4, 商品CSV出力
// 5, 終了
// ↓各機能の詳細は下記

// 1, 商品一覧表示
// 【表示項目】
// id
// 商品名
// JANコード

// 2, 商品マスター登録
// ・商品名 - 入力
// ・JANコード生成(自動)
// ※JANコード生成ルールは、9桁のランダムな数字 + ID３桁とする
// ex) id = 1 のアイテムなら
// 9桁のランダムな数字 + 001

// 3, 商品削除
// idを入力し、該当する商品を一覧から削除

// 4, 商品CSV出力
// 現在登録されている商品一覧をCSVで出力する
// パス：./csv/item_list_{現在時刻YmdHis}.csv
// ・項目　
// ID, 商品名, JANコード

// 5,　CSVインポート
// パス./csv/item_list/import/
// パスに配置したcsvファイルを読み込み商品リストへ取り込む
// 6, 終了

class Product_manager{
    public function __construct(){
        $this->menu();
    }
    public function menu(){
        echo '商品マネージャー'. PHP_EOL;
        echo '1:一覧 2:登録 3:削除 4:CSV出力 5:CSV入力 6:終了'. PHP_EOL;
        $input_menu = (int)(fgets(STDIN));
        $validation = new MenuValidation();
        $validation->setData($input_menu);
        if($validation->checkMenu() === true){
            switch ($input_menu){
                case 1:
                    $this->index();
                    break;
                case 2:
                    $this->register();
                    break;
                case 3:
                    $this->delete();
                    break;
                case 4:
                    $this->outputCSV();
                    break;
                case 5:
                    $this->importCSV();
                    break;
                case 6:
                    exit;
            }        
        }else{
            echo $validation->getErrorMessage(). PHP_EOL;
            return $this->menu();
        }
    }
    public function index(){
        echo '-----一覧-----'. PHP_EOL;
        $product_lists = Product::getAllProduct();
        if(count($product_lists) > 0){
            foreach($product_lists as $product_list){
                $product = sprintf("id: %s 商品名: %s JANコード: %s",$product_list['id'],$product_list['商品名'],$product_list['JANコード']);
                echo $product. PHP_EOL;
            }
        }else{
            echo '商品がありません。'. PHP_EOL;
        }
        $this->managerCountinue();
    }
    public function register(){
        echo '-----登録-----'. PHP_EOL;
        echo '商品名を入力してください。'. PHP_EOL;
        $input_product = trim(fgets(STDIN));
        $validation = new RegisterValidation();
        $validation->setData($input_product);
        if($validation->checkRegister() === true){
            $new_product = $validation->getData();
            $product = new Product();
            $product->register($new_product);
            echo '登録しました。';
        }
        return $this->managerCountinue();
    }
    public function delete(){
        echo '-----削除-----'. PHP_EOL;
        echo '商品IDを入力してください。'. PHP_EOL;
        $input_id = trim(fgets(STDIN));
        $validation = new DeleteValidation();
        $validation->setData($input_id);
        if($validation->checkDelete() === true){
            $delete_id = $validation->getData();
            $product = new Product();
            $exist_id = $product->isExistById($delete_id);
            if($exist_id){
                $product->delete($delete_id);
                echo '削除しました'. PHP_EOL;
            }else{
                echo 'IDがありません。'. PHP_EOL;
            }
            return $this->managerCountinue();
        }
        echo $validation->getErrorMessage();
        return $this->delete();
    }
    public function outputCSV(){
        echo '-----CSV出力-----'. PHP_EOL;
        $filepath = './csv/item_list/';
        if(!is_dir($filepath)){
            mkdir($filepath, 0777, true);
        }
        $filename =  date('YmdHi').'.csv';
        $write_fp = fopen($filepath.$filename,'w');
        if($write_fp){
            $header_line = 'id,商品名,JANコード'. PHP_EOL;
            $header_line = mb_convert_encoding($header_line,'SJIS','UTF8');
            fwrite($write_fp,$header_line);
            foreach(Product::$product_lists as $product_list){
                $line = sprintf('%s,%s,%s',$product_list['id'],$product_list['商品名'],$product_list['JANコード']). PHP_EOL;
                $line = mb_convert_encoding($line,'SJIS','UTF8');
                fwrite($write_fp,$line);
            }
        }
        if(fclose($write_fp)){
            echo '成功しました'. PHP_EOL;
        }else{
            echo '失敗しました'. PHP_EOL;
        }
        return $this->managerCountinue();
    }
    public function importCSV(){
        echo '-----CSVインポート-----'. PHP_EOL;
        $filepath = './csv/item_list/import/';
        $all_file = glob($filepath.'*.csv');
        if(count($all_file) > 0){
            foreach($all_file as $read_file){
                $read_fp = fopen($read_file,'r');
                $header_line = explode(',',trim(fgets($read_fp)));
                while(!feof($read_fp)){
                    $line_array = explode(',',trim(fgets($read_fp)));
                    $regist_data = array_combine($header_line,$line_array);
                    Product::$product_lists[] = $regist_data;
                }
                fclose($read_fp);
            }
            echo count($all_file).'件のファイルを取り込みました。'. PHP_EOL;
        }else{
            echo 'CSVファイルがありません。'. PHP_EOL;
        }   
        return $this->managerCountinue();
    }
    public function managerCountinue(){
        echo '継続しますか？ y or n'. PHP_EOL;
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
        return $this->managerCountinue();
    }
}

class Product{
    static public $product_lists = array(
        1 => array(
            "id" => 1,
            "商品名" => "りんご",
            "JANコード" => "123456789001",
        )
    ); 
    public static function getAllProduct(){
        return self::$product_lists;
    }
    public function isExistById($delete_id){
        if(array_key_exists($delete_id,self::$product_lists)){
            return true;
        }
        return false;
    }
    public function register($new_product){
        if(array_key_last(self::$product_lists) > 0){
            $id = array_key_last(self::$product_lists) + 1;
        }else{
            $id = 1;
        }
        $jancode = mt_rand(100000000,999999999).sprintf("%03d",$id);
        $new_product_list = array(
            'id' => $id,
            '商品名' => $new_product,
            'JANコード' => $jancode
        );
        self::$product_lists[] = $new_product_list;
        return;
    }
    public function delete($delete_id){
        unset(self::$product_lists[$delete_id]);
        return;
    }
}

class BaseValidation{
    const INDEX = 1;
    const REGISTER = 2;
    const DELETE = 3;
    const OUTPUTCSV = 4;
    const IMPORTCSV = 5;
    const CLOSE = 6;

    const KEEP = 'y';
    const END = 'n';
    protected $data;
    protected $error_msg;

    public function setData($data){
        $this->data = $data;
    }
    public function getData(){
        return $this->data;
    }
    public function getErrorMessage(){
        return $this->error_msg;  
    }
}

class MenuValidation extends BaseValidation{
    public function checkMenu(){
        if(empty($this->data)){
            return false;
        }
        if(in_array($this->data,[self::INDEX,self::REGISTER,self::DELETE,self::OUTPUTCSV,self::IMPORTCSV,self::CLOSE],true) === false){
            $this->error_msg = '正しいメニューを入力してください。'. PHP_EOL;
        }
        if($this->error_msg){
            return false;
        }
        return true;
    }
}

class RegisterValidation extends BaseValidation{
    public function checkRegister(){
        if(empty($this->data)){
            return false;
        }
        return true;
    }
}

class DeleteValidation extends BaseValidation{
    public function checkDelete(){
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

$product_manager = new Product_manager();
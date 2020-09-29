<?php

const WIN = 2;
const LOSE = 1;
const EVEN = 0;

const STONE = 1;
const SCISSORS = 2;
const PAPER = 3;
const HAND_TYPE = array(STONE => "グー",SCISSORS => "チョキ",PAPER => "パー");

const KEEP = "y";
const END ="n";

function jankenStart($win,$lose){
    echo "勝負です！";
    echo "さいしょは・・・";
    sleep(2);
    echo "グー！！";
    sleep(2);
    echo "じゃんけん・・・ （1:グー、2:チョキ、3:パーいずれか入力。）" . PHP_EOL;
    $my_hand = getMyHand();
    $comp_hand = getCompHand();
    echo "ポン！" . PHP_EOL;
    $result = judge($my_hand,$comp_hand);
    if($result === EVEN){
        echo "EVEN！　　YOU:".HAND_TYPE[$my_hand]."　　COMPUTER:".HAND_TYPE[$comp_hand] . PHP_EOL;
        return jankenStart($win,$lose);
    }
    show($result,$my_hand,$comp_hand);
    list($win,$lose) = totalResult($result,$win,$lose);
    echo "win:".$win."　　lose:".$lose . PHP_EOL;
    echo "continue? y or n";
    $continue = jankenContinue();
    if($continue === KEEP){
        jankenStart($win,$lose);
    }
    exit;
}

function checkInput($get_input){
    if(empty($get_input) === true){
        return false;   
    }
    if(in_array($get_input,[STONE,SCISSORS,PAPER],true) === false){
        return false;
    }
    return true;
}

function checkContinue($get_input){
    if(empty($get_input) === true){
        return false;   
    }
    if(in_array($get_input,[KEEP,END],true) === false){
        return false;
    }
    return true;
}

function getMyHand(){
    $get_input = (int)(fgets(STDIN));
    $bool = checkInput($get_input);
    if($bool === false){
        return getMyHand();
    }
    return $get_input;
}

function getCompHand(){
    return $comp_hand = mt_rand(1,3);
}

function judge($my_hand,$comp_hand){
    return ($my_hand - $comp_hand + 3) % 3;
}

function show($result,$my_hand,$comp_hand){
    if($result === WIN){
        echo "YOU WIN!!　　YOU:".HAND_TYPE[$my_hand]."　　COMPUTER:".HAND_TYPE[$comp_hand] . PHP_EOL;
    }
    if($result === LOSE){
        echo "YOU LOSE...　　YOU:".HAND_TYPE[$my_hand]."　　COMPUTER:".HAND_TYPE[$comp_hand] . PHP_EOL;
    }
}

function jankenContinue(){
    $get_input = trim(fgets(STDIN));
    $bool = checkContinue($get_input);
    if($bool === false){
        return jankenContinue();
    }
    return $get_input;
}

function totalResult($result,$win,$lose){
    if($result === WIN){
        $win += 1;
    }else{
        $lose += 1;
    }
    return array($win,$lose);
}

static $win = 0;
static $lose = 0;
jankenStart($win,$lose);
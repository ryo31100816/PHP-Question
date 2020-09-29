<?php

// 16, 図形の表示
//  0
//  00
//  000
// この図形をfor文を使って出力してください。

$string = "0";

for($i = 1; $i <= 3; $i++){
    echo $string . PHP_EOL;
    $string = $string."0";
}

// 17, 図形の表示
//    0
//   000
//  00000
// この図形をfor文を使って出力してください。

$string = "0";

for($i = 1; $i <= 3; $i++){
    for($j = 1; $j <= 3 - $i; $j++){
        echo " ";
    }
        echo $string . PHP_EOL;
        $string ="0".$string."0";
}


// 18, 図形の表示
//    0
//   000
//  00000
//   000
//    0
// この図形をfor文を使って出力してください。

$string = "0";

for($i = 1; $i <= 3; $i++){
    for($j = 1; $j <= 3 - $i; $j++){
        echo " ";
    }
    for($k = $j - 2; $k <= 4 - $j; $k++){
        echo $string;
    }
    echo PHP_EOL;
}
for($l = 1; $l <= 2; $l++){
    for($m = 1; $m <= $l; $m++){
        echo " ";
    }
    for($n = $m - 1; $n <= 5 - $m; $n++){
        echo $string;
    }
    echo PHP_EOL;
}


?>
<?php

$regexDict = [
    'articule' => '/Артикул: \w+/',
    'cost' => '/Цена: [0-9]+\.*[0-9]*/',
    'description' => '/Описание: [^(?!.*\.\n)]+/'
];

$keysDict = [
    'articules' => [],
    'costs' => [],
    'descriptions' => [],
];
$text =  trim(encode_utf8(file_get_contents('data/test2.txt')));
// var_dump($text);
// die();
$tmpArray = [];
preg_match_all($regexDict['articule'], $text,$tmpArray);
$keysDict['articules'] = $tmpArray[0];
preg_match_all($regexDict['cost'], $text,$tmpArray);
$keysDict['costs'] = $tmpArray[0];
preg_match_all($regexDict['description'], $text,$tmpArray);
$keysDict['descriptions'] = $tmpArray[0];

echo toText($keysDict);

function encode_utf8($data) {
    if ($data === null || $data === '') {
        return $data;
    }
    if (!mb_check_encoding($data, 'UTF-8')) {
        return iconv(mb_detect_encoding($data, mb_detect_order(), true), "UTF-8", $data);
    } else {
        return $data;
    }
}

function getText() {
    echo 'Enter filePath: ';
    $handle = fopen ("php://stdin","r");
    $fileName = trim(fgets($handle));
    $file1 = trim(file_get_contents($fileName));
    if ($file1 === null || $file1 === '') {
        throw \Exception('File is empty');
    }
    return $file1;
}

//Запчасть 1 – Артикул: ААА, Цена: YYY, Описание: ZZZ;
function toText($keysDict) {
    $count = count($keysDict['articules']);
    $start = 'Запчасть ';
    $outPut = '';
    for ($i = 0; $i < $count; $i++) {
        $outPut .= $start . $i . ' - '
            . trim(($keysDict['articules'][$i] ?? 'Не найдено')) . ', '
            . trim(($keysDict['costs'][$i] ?? 'Не найдено')) . ', '
            . trim(($keysDict['descriptions'][$i] ?? 'Не найдено')) . ';' . PHP_EOL;
    }
    return $outPut;
}

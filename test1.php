<?php


    $nums = readNumsFile();
    $sorted = sort($nums['array']);

    if ($sorted) {
        echo $nums['string'] . PHP_EOL . ($nums['array'][0] * $nums['array'][1]);
    } else {
        echo 'Error';
    }

    function readNumsFile() {
        echo 'Enter filePath: ';
        $handle = fopen ("php://stdin","r");
        $fileName = trim(fgets($handle));
        $file1 = trim(file_get_contents($fileName));
        if ($file1 === '') {
            throw \Exception('File is empty');
        }
        return  ['string' => $file1, 'array' => array_map('intval', explode(' ', $file1))];
    }

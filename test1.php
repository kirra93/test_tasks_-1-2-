<?php


    $nums = readNumsFile();
    $min = [
        $nums['array'][0],
        $nums['array'][1]
    ];
    for ($i = 2; $i < count($nums['array']); $i++) {
        if ($min[0] > $min[1]) {
            $min[0] += $min[1];
            $min[1] = $min[0] - $min[1];
            $min[0] = $min[0] - $min[1];
        }
        if ($min[1] > $nums['array'][$i]) {
            $min[1] = $nums['array'][$i];
        }
    }

    echo $nums['string'] . PHP_EOL . ($min[0] * $min[1]);
   

    function readNumsFile() {
        echo 'Enter filePath: ';
        $handle = fopen ("php://stdin","r");
        $fileName = trim(fgets($handle));
        // $fileName = 'data/nums.txt';
        $file1 = trim(file_get_contents($fileName));
        if ($file1 === '') {
            throw \Exception('File is empty');
        }
        return  ['string' => $file1, 'array' => array_map('intval', explode(' ', $file1))];
    }

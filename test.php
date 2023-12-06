<?php

use function PHPSTORM_META\type;

$data = json_decode(file_get_contents('record.json'), true);
list($minutes15, $seconds15) = explode("'", $data['Laser Run'][12]['temps']);
$totalSeconds15 = $minutes15 * 60 + $seconds15;
var_dump($totalSeconds15);

list($minutes1, $seconds1) = explode("'", "9'58");
$totalSeconds1 = $minutes1 * 60 + $seconds1;
var_dump($totalSeconds1);
if ($totalSeconds1 < $totalSeconds15) {
  echo "aaa";
}

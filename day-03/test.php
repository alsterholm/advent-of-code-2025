<?php

require __DIR__ . '/index.php';

$data = file(__DIR__ . '/data.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$res1 = day03\solve($data, part: 1);
echo "Part 1: $res1\n";

$res2 = day03\solve($data, part: 2);
echo "Part 2: $res2\n";

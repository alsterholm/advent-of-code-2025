<?php

require __DIR__ . '/index.php';

$data = array_map(trim(...), file(__DIR__ . '/data.txt'));

$res1 = day01\solve($data, part: 1);
echo "Part 1: $res1.\n";

$res2 = day01\solve($data, part: 2);
echo "Part 2: $res2.\n";

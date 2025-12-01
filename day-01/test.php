<?php

require __DIR__ . '/index.php';

$data = array_map(trim(...), file(__DIR__ . '/data.txt'));

$res1 = day01\part1($data);
echo "Part 1: $res1.\n";

$res2 = day01\part2($data);
echo "Part 2: $res2.\n";

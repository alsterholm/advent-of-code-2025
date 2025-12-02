<?php

require __DIR__ . '/index.php';

$data = explode(',', file_get_contents(__DIR__ . '/data.txt'));

$res1 = day02\part1($data);
echo "Part 1: $res1\n";

$res2 = day02\part2($data);
echo "Part 2: $res2\n";

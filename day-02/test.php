<?php

require __DIR__ . '/index.php';

$data = explode(',', file_get_contents(__DIR__ . '/data.txt'));

$res1 = day02\solve($data, part: 1);
echo "Part 1: $res1\n";

$res2 = day02\solve($data, part: 2);
echo "Part 2: $res2\n";

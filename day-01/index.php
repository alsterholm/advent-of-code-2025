<?php

namespace day01;

function part1(array $input) {
    return solve($input, part: 1);
}

function part2(array $input) {
    return solve($input, part: 2);
}

function solve(array $input, int $part) {
    $position = 50;
    $zeroes = 0;

    foreach ($input as $instruction) {
        $direction = $instruction[0];
        $clicks = (int) substr($instruction, 1);

        for ($i = 0; $i < $clicks; $i++) {
            $position = match ($direction) {
                'L' => $position - 1,
                'R' => $position + 1,
            };

            if ($position === 100) $position = 0;
            if ($position === -1) $position = 99;

            if ($part === 2 && $position === 0) $zeroes++;
        }

        if ($part === 1 && $position === 0) $zeroes++;
    }

    return $zeroes;
}

<?php

namespace day02;

function part1(array $input) {
    return solve($input, part: 1);
}

function part2(array $input) {
    return solve($input, part: 2);
}

function solve(array $input, int $part) {
    $sum = 0;

    foreach ($input as $range) {
        [$start, $end] = explode('-', $range);

        $invalidIds = array_filter(
            range($start, $end),
            match ($part) {
                1 => isSameSequenceRepeatedTwice(...),
                2 => consistsOfRepeatingSequence(...)
            },
        );

        $sum += array_reduce($invalidIds, fn ($curr, $acc) => $acc + (int) $curr);
    }

    return $sum;
}

function isSameSequenceRepeatedTwice(string $id) {
    $length = strlen($id);
    return $length % 2 === 0 && substr($id, $length / 2) === substr($id, 0, $length / 2);
}

function consistsOfRepeatingSequence(string $id) {
    $length = strlen($id);

    for ($i = 1; $i <= $length / 2; $i++) {
        $potentialSequence = substr($id, 0, $i);
        $potentialSequenceLength = strlen($potentialSequence);

        if ($length % $potentialSequenceLength !== 0) continue;
        if (str_repeat($potentialSequence, $length / $potentialSequenceLength) === $id) return true;
    }

    return false;
}

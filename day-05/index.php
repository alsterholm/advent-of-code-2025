<?php

namespace day05;

function solve(array $input, int $part) {
    return match ($part) {
        1 => part1($input),
        2 => part2($input),
    };
}

function part1(array $input) {
    $freshCount = 0;
    [$ranges, $ingredients] = extractData($input);

    foreach ($ingredients as $ingredient) {
        foreach ($ranges as $range) {
            [$min, $max] = explode('-', $range);

            if ($ingredient >= $min && $ingredient <= $max) {
                $freshCount++;
                break;
            }
        }
    }

    return $freshCount;
}

function part2(array $input) {
    [$ranges] = extractData($input);

    usort($ranges, fn ($a, $b) => explode('-', $a)[0] <=> explode('-', $b)[0]);

    $mergedRanges = [];
    $previousRange = array_shift($ranges);

    foreach ($ranges as $range) {
        [$prevMin, $prevMax] = explode('-', $previousRange);
        [$min, $max] = explode('-', $range);

        if ($min > $prevMax) {
            $mergedRanges[] = $previousRange;
            $previousRange = $range;
        } else {
            $newMax = max($prevMax, $max);
            $previousRange = "$prevMin-$newMax";
        }
    }

    $mergedRanges[] = $previousRange;

    return array_sum(array_map(function ($range) {
        [$min, $max] = explode('-', $range);
        return $max - $min + 1;
    }, $mergedRanges));
}

function extractData(array $input) {
    $ranges = [];
    $rangesFinishedReading = false;
    $ingredients = [];

    foreach ($input as $line) {
        if (empty($line)) {
            $rangesFinishedReading = true;
            continue;
        }

        if ($rangesFinishedReading) {
            $ingredients[] = $line;
        } else {
            $ranges[] = $line;
        }
    }

    return [$ranges, $ingredients];
}

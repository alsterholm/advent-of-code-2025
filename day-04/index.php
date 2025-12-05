<?php

namespace day04;

function solve(array $input, int $part) {
    return match ($part) {
        1 => part1($input),
        2 => part2($input),
    };
}

function part1(array $input) {
    return count(findRollPositions(createGrid($input)));
}

function part2(array $input) {
    $count = 0;
    $totalCount = 0;
    $grid = createGrid($input);

    do {
        $positions = findRollPositions($grid);

        foreach ($positions as $position) {
            [$x, $y] = $position;
            $grid[$y][$x] = '.';
        }

        $count = count($positions);
        $totalCount += $count;
    } while ($count > 0);

    return $totalCount;
}

function createGrid(array $input) {
    $grid = [];

    foreach ($input as $i => $row) {
        foreach (str_split($row) as $j => $col) {
            $grid[$i][$j] = $col;
        }
    }

    return $grid;
}

function findRollPositions(array $grid) {
    $rollPositions = [];

    for ($y = 0; $y < count($grid); $y++) { 
        for ($x = 0; $x < count($grid[$y]); $x++) {
            if ($grid[$y][$x] === '.') continue;

            $adjacentPositions = [];

            if (isset($grid[$y - 1][$x - 1])) $adjacentPositions[] = $grid[$y - 1][$x - 1];
            if (isset($grid[$y - 1][$x])) $adjacentPositions[] = $grid[$y - 1][$x];
            if (isset($grid[$y - 1][$x + 1])) $adjacentPositions[] = $grid[$y - 1][$x + 1];
            if (isset($grid[$y][$x - 1])) $adjacentPositions[] = $grid[$y][$x - 1];
            if (isset($grid[$y][$x + 1])) $adjacentPositions[] = $grid[$y][$x + 1];
            if (isset($grid[$y + 1][$x - 1])) $adjacentPositions[] = $grid[$y + 1][$x - 1];
            if (isset($grid[$y + 1][$x])) $adjacentPositions[] = $grid[$y + 1][$x];
            if (isset($grid[$y + 1][$x + 1])) $adjacentPositions[] = $grid[$y + 1][$x + 1];

            $rollCount = count(array_filter($adjacentPositions, fn ($p) => $p === '@'));

            if ($rollCount < 4) {
                $rollPositions[] = [$x, $y];
            }
        }
    }

    return $rollPositions;
}

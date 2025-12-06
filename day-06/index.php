<?php

namespace day06;

function solve(array $input, int $part) {
    return match ($part) {
        1 => part1($input),
        2 => part2($input),
    };
}

function part1(array $input) {
    $rows = [];
    $problems = [];
    $total = 0;

    foreach ($input as $line) {
        $rows[] = array_filter(preg_split('/\s+/', trim($line)));
    }

    for ($y = 0; $y < count($rows); $y++) {
        for ($x = 0; $x < count($rows[$y]); $x++) {
            if (! isset($problems[$x])) {
                $problems[$x] = [];
            }

            $problems[$x][$y] = $rows[$y][$x];
        }
    }

    foreach ($problems as $problem) {
        $operator = array_pop($problem);
        $total += calculate($problem, $operator);
    }

    return $total;
}

function part2(array $input) {
    $total = 0;
    $operators = array_filter(preg_split('/\s+/', array_pop($input)));
    $grid = array_map('str_split', $input);
    $columns = max(...array_map('count', $grid));

    $nextNumbers = [];

    for ($x = 0; $x < $columns; $x++) {
        $number = '';

        for ($y = 0; $y < count($grid); $y++) {
            $number .= $grid[$y][$x];
        }

        if (trim($number) === '') {
            $operator = array_shift($operators);
            $total += calculate($nextNumbers, $operator);
            $nextNumbers = [];
            continue;
        }

        $nextNumbers[] = trim($number);
    }

    $operator = array_shift($operators);
    $total += calculate($nextNumbers, $operator);

    return $total;
}

function calculate($numbers, $operator) {
    $initial = array_shift($numbers);

    return array_reduce($numbers, fn ($acc, $cur) => match ($operator) {
        '+' => $acc + $cur,
        '*' => $acc * $cur,
    }, $initial);
}

<?php

namespace day03;

function solve(array $input, int $part) {
    $digitsCount = match ($part) {
        1 => 2,
        2 => 12,
    };

    $total = 0;

    foreach ($input as $line) {
        $digits = [];
        $currentlyLargestDigitIndex = null;
        $currentlyLargestDigit = 0;

        for ($i = 0; $i < $digitsCount; $i++) {
            $searchFrom = $currentlyLargestDigitIndex === null ? 0 : $currentlyLargestDigitIndex + 1;
            $searchUntil = strlen($line) - ($digitsCount - count($digits) - 1);

            for ($d = $searchFrom; $d < $searchUntil; $d++) {
                if ($line[$d] > $currentlyLargestDigit) {
                    $currentlyLargestDigit = $line[$d];
                    $currentlyLargestDigitIndex = $d;
                }
            }

            $digits[] = $currentlyLargestDigit;
            $currentlyLargestDigit = 0;
        }

        $total += (int) implode('', $digits);
    }

    return $total;
}

<?php

namespace Werdy\AdventOfCode2024\Day02;

use Exception;
use Illuminate\Support\Collection;

class Puzzle2
{
    public function __invoke(string $fileName)
    {
        $input = file_get_contents(__DIR__.'/'.$fileName)
            ?: throw new Exception('Failed to read input file.');

        // TODO: Solve puzzle 1.
        $reports = (new Collection(explode("\n", $input)))
            ->map(fn($line) => array_map('intval', explode(" ", trim($line))));

        $countSafe = 0;
        foreach ($reports as $report) {
            //echo "-- Repor --\n";
    
            if ($this->is_safe($report)) {
                $countSafe++;
                continue;
            }

            // for part 2, brute-force remove each number and see if safe
            for ($i = 0; $i < count($report); $i++) {
                $copy = $report;
                unset($copy[$i]);
                $copy = array_values($copy);
                if ($this->is_safe($copy)) {
                    $countSafe++;
                    break;
                }
            }
            // echo "\n order:".$order." count:".$countSafe."\n";
        }

        return $countSafe;
    }

    private function is_safe(array $numbers): bool
    {
        $diff_prev = 0;
        for ($i = 1; $i < count($numbers); $i++) {
            $diff = $numbers[$i] - $numbers[$i - 1];

            // diff must be between 1 and 3
            if (abs($diff) < 1 || abs($diff) > 3) {
                return false;
            }

            // sign of each diff must match preceding diff
            if ($i >= 2 && $diff > 0 != $diff_prev > 0) {
                return false;
            }

            $diff_prev = $diff;
        }

        return true;
    }

}

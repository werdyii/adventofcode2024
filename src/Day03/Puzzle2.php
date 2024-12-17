<?php

namespace Werdy\AdventOfCode2024\Day03;

use Exception;
use Illuminate\Support\Collection;

class Puzzle2
{
    public function __invoke(string $fileName)
    {
        $input = file_get_contents(__DIR__.'/'.$fileName)
            ?: throw new Exception('Failed to read input file.');

        // for part 2, we use the same regex but first do some string manipulation
        $input = preg_replace('/don\'t\(\)(?:.|\n)*?do\(\)/', '', $input);
        
        // TODO: Solve puzzle 2.
        return $this->parseSequences($input);
    }


    private function parseSequences(string $line): int
    {
        $sequences = [];
        preg_match_all('/mul\((\d{1,3}),(\d{1,3})\)/', $line, $sequences);
        $sum = 0;
        for ($i = 0; $i < count($sequences[0]); $i++) {
            $sum += (int) $sequences[1][$i] * (int) $sequences[2][$i];
        }
        return $sum;
    }
}

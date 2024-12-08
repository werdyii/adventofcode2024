<?php

namespace Werdy\AdventOfCode2024\Day02;

use Exception;
use Illuminate\Support\Collection;

class Puzzle1
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
            $firstLevel = array_shift($report);
            $currentOrder = $firstLevel < $report[0] ? "ASC" : "DESC";
            $safe = 1;
            foreach($report as $level){
                $order = $firstLevel < $level ? "ASC" : "DESC";
                // Úrovne sa buď všetky zvyšujú , alebo všetky klesajú .
                if($currentOrder !== $order){ 
                    $safe = 0;
                    break;
                }
                $differ = abs($firstLevel - $level);
                // Akékoľvek dve susedné úrovne sa líšia najmenej o jednu a najviac o tri 
                if(abs($firstLevel - $level) > 3 || $firstLevel === $level){
                    $safe = 0;
                    break;
                }
                $firstLevel = $level;
            }
            $countSafe += $safe;
            // echo "\n order:".$currentOrder." safe:".$safe." count:".$countSafe."\n";
        }

        return $countSafe;
    }
}

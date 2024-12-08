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
            echo "-- Repor --\n";
            $firstLevel = array_shift($report);
            $order = $firstLevel < $report[0] ? "ASC" : "DESC";
            $countSafe += $this->levelsCheck($firstLevel, $report, $order);

            // echo "\n order:".$order." count:".$countSafe."\n";
        }

        return $countSafe;
    }

    private function levelsCheck($firstLevel, array $report, $order, $depth = 0){
        $safe = 1;
        $prevLevel = $firstLevel;
        foreach($report as $key => $level){
            $currentOrder = $prevLevel < $level ? "ASC" : "DESC";
            // Úrovne sa buď všetky zvyšujú , alebo všetky klesajú .
            if($currentOrder !== $order){
                if($depth < 1){
                    $depth += 1;
                    $updatedReport = $report;
                    unset($updatedReport[$key]); // Odstráň aktuálny prvok
                    $updatedReport = array_values($updatedReport); // Preindexuj pole

                    $safe = $this->levelsCheck($level, $updatedReport, $order, $depth);

                    if($safe == 0){

                        $updatedReport = $report;
                        unset($updatedReport[$key - 1]); // Odstráň predchádzajúci prvok
                        $updatedReport = array_values($updatedReport); // Preindexuj pole

                        $safe = $this->levelsCheck($level, $updatedReport, $order, $depth);

                    }

                    echo "order:".$order." count:".count($report)." depth:" .$depth." safe: ".$safe." - order [".implode(",",$report)."] \n";
                    break;
                }else{
                    $safe = 0;
                    echo "order:".$order." count:".count($report)." depth:" .$depth." safe: ".$safe." - order-deph [".implode(",",$report)."] \n";
                    break;
                }
            }
            // Akékoľvek dve susedné úrovne sa líšia najmenej o jednu a najviac o tri 
            if(abs($firstLevel - $level) > 3 || $firstLevel === $level){
                if($depth < 1){
                    $updatedReport = $report;
                    unset($updatedReport[$key]); // Odstráň aktuálny prvok
                    $updatedReport = array_values($updatedReport); // Preindexuj pole

                    $safe = $this->levelsCheck($level, $updatedReport, $order, $depth + 1);
                    echo "order:".$order." count:".count($report)." depth:" .$depth." safe: ".$safe." - diff [".implode(",",$report)."] \n";
                    break;
                }else{
                    $safe = 0;
                    echo "order:".$order." count:".count($report)." depth:" .$depth." safe: ".$safe." - diff-deph [".implode(",",$report)."] \n";
                    break;
                }
            }
            $firstLevel = $level;
        }
        echo "order:".$order." count:".count($report)." depth:" .$depth." safe: ".$safe." - ok [".implode(",",$report)."] \n";
        return $safe;
    }
}

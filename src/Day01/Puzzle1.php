<?php

namespace Werdy\AdventOfCode2024\Day01;

use Exception;
use Illuminate\Support\Collection;

class Puzzle1
{
    public function __invoke(string $fileName)
    {
        $input = file_get_contents(__DIR__.'/'.$fileName)
            ?: throw new Exception('Failed to read input file.');


        $data = (new Collection(explode("\n", $input)))
            ->map(fn($line) => array_map('intval', explode("   ", trim($line))));

        // 2. Vytvorenie kolekcie
        $collection = collect($data);

        // 3. Zoradenie jednotlivých stĺpcov
        $sortedFirstColumn = $collection->pluck(0)->sort()->values();
        $sortedSecondColumn = $collection->pluck(1)->sort()->values();

        // 4. Výpočet absolútneho rozdielu príslušných riadkov
        $differences = $sortedFirstColumn->zip($sortedSecondColumn)
            ->map(fn($pair) => abs($pair[0] - $pair[1]));

        return $differences->sum();
    }
}

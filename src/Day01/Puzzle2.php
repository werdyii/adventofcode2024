<?php

namespace Werdy\AdventOfCode2024\Day01;

use Exception;
use Illuminate\Support\Collection;

class Puzzle2
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
        $similarityScore = 0;

        // Prejdi všetky položky v prvej kolekcii
        foreach ($sortedFirstColumn as $item) {
            // Zisti, koľkokrát sa $item nachádza v druhej kolekcii
            $occurrences = $sortedSecondColumn->filter(fn($value) => $value === $item)->count();

            // Pripočítaj skóre
            $similarityScore += $item * $occurrences;
        }

        return $similarityScore;


// Prvé číslo v ľavom zozname je 3. V pravom zozname sa objaví trikrát, takže skóre podobnosti sa zvýši o 3 * 3 = 9.
// Druhé číslo v ľavom zozname je 4. V pravom zozname sa objaví raz, takže skóre podobnosti sa zvýši o 4 * 1 = 4.
// Tretie číslo v ľavom zozname je 2. Nezobrazuje sa v správnom zozname, takže skóre podobnosti sa nezvyšuje ( 2 * 0 = 0).
// Štvrté číslo, 1, sa tiež nezobrazuje v správnom zozname.
// Piate číslo, 3, sa v pravom zozname objaví trikrát; skóre podobnosti sa zvyšuje o 9.
// Posledné číslo, 3, sa v pravom zozname objaví trikrát; skóre podobnosti sa opäť zvyšuje o 9.

// Takže pre tieto príklady je skóre podobnosti na konci tohto procesu 31 ( 9 + 4 + 0 + 0 + 9 + 9). 
//        return new Collection(explode("\n", $input));
    }
}

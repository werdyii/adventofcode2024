<?php

namespace Werdy\AdventOfCode2024\Day04;

use Exception;
use Illuminate\Support\Collection;

class Puzzle1
{
    public function __invoke(string $fileName)
    {
        $input = file_get_contents(__DIR__.'/'.$fileName)
            ?: throw new Exception('Failed to read input file.');

        // TODO: Solve puzzle 1.
        $grid = (new Collection(explode("\n", $input)))->map(fn($row) => '.' . $row . '.');

        $widthGrid = strlen( $grid->first());
        $placeholder = str_repeat('.', $widthGrid);

        $grid->prepend($placeholder);
        $grid->push($placeholder);
        
        $directions = [
            [0, 1],     // down
            [0, -1],    // up
            [1, 0],     // right
            [-1, 0],    // left
            [1, 1],     // south-east
            [-1, -1],   // north-west
            [1, -1],    // north-east
            [-1, 1],    // south-west
        ];
        
        $word = "XMAS!";
        $sum = 0;
        for ($row = 0; $row < $grid->count(); $row++) {
            for ($col = 0; $col < $widthGrid; $col++) {
                if ($grid[$row][$col] !== 'X') continue;

                // current grid pos == 'X', search all directions for XMAS
                foreach ($directions as $direction) {
                    $char_index = 0;
                    $r = $row;
                    $c = $col;
                    do {
                        $r += $direction[1];
                        if($r < 0 || $r > $grid->count()) continue;
                        $c += $direction[0];
                        if($c < 0 || $c > $widthGrid) continue;
                        $char_index++;
                    } while ($grid[$r][$c] === $word[$char_index]);

                    // if we made it to 'S', we found "XMAS"
                    if ($char_index === 4) {
                        $sum++;
                    }
                }
            }
        }

        return $sum;
    }
}

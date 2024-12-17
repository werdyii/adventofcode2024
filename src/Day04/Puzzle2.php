<?php

namespace Werdy\AdventOfCode2024\Day04;

use Exception;
use Illuminate\Support\Collection;

class Puzzle2
{
    public function __invoke(string $fileName)
    {
        $input = file_get_contents(__DIR__.'/'.$fileName)
            ?: throw new Exception('Failed to read input file.');

        // TODO: Solve puzzle 2.
        $grid = (new Collection(explode("\n", $input)))->map(fn($row) => '.' . $row . '.');

        $widthGrid = strlen( $grid->first());
        $placeholder = str_repeat('.', $widthGrid);

        $grid->prepend($placeholder);
        $grid->push($placeholder);

        $sum = 0;
        for ($row = 2; $row < $grid->count()-2; $row++) {
            for ($col = 2; $col < $widthGrid-2; $col++) {
                if ($grid[$row][$col] !== 'A') continue;
                
                $nw = $grid[$row - 1][$col - 1];
                $ne = $grid[$row - 1][$col + 1];
                $se = $grid[$row + 1][$col + 1];
                $sw = $grid[$row + 1][$col - 1];
                if (
                    (($nw === 'M' && $se === 'S') || ($nw === 'S' && $se === 'M'))
                    && (($ne === 'M' && $sw === 'S') || ($ne === 'S' && $sw === 'M'))
                ) {
                    $sum++;
                }
            }
        }

        return $sum;
    }
}

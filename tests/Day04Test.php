<?php

test('returns the correct answer for puzzle_1 example_1', function () {
    $result = (new Werdy\AdventOfCode2024\Day04\Puzzle1)('example1.txt');
    expect($result)->toBe(18);
});

test('returns the correct answer for puzzle_2 example_2', function () {
    $result = (new Werdy\AdventOfCode2024\Day04\Puzzle2)('example2.txt');
    expect($result)->toBe(9);
});
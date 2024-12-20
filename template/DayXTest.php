<?php

test('returns the correct answer for puzzle_1 example_1', function () {
    $result = (new Werdy\AdventOfCode2024\DayX\Puzzle1)('example1.txt');
    expect($result)->toBe(10);
});

test('returns the correct answer for puzzle_2 example_2', function () {
    $result = (new Werdy\AdventOfCode2024\DayX\Puzzle2)('example2.txt');
    expect($result)->toBe(20);
});
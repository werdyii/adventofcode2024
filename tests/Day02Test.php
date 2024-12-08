<?php

test('returns the correct answer for puzzle_1 example_1', function () {
    $result = (new Werdy\AdventOfCode2024\Day02\Puzzle1)('example1.txt');
    expect($result)->toBe(2);
});

test('returns the correct answer for puzzle_2 example_2', function () {
    $result = (new Werdy\AdventOfCode2024\Day02\Puzzle2)('example2.txt');
    expect($result)->toBe(4);
});
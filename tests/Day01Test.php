<?php

namespace Werdy\AdventOfCode2024\Tests;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Werdy\AdventOfCode2024\Day01\Puzzle1;
use Werdy\AdventOfCode2024\Day01\Puzzle2;

class Day01Test extends TestCase
{
    /** @test */
    public function it_returns_the_correct_answer_for_puzzle_1_example_1(): void
    {
        Assert::assertEquals(10, (new Puzzle1)('example1.txt'));
    }

    /** @test */
    public function it_returns_the_correct_answer_for_puzzle_2_example_1(): void
    {
        Assert::assertEquals(20, (new Puzzle2)('example2.txt'));
    }
}

<?php namespace TwitterKeywordCounter\Tests;

use TwitterKeywordCounter\KeywordCounter;

class KeywordCounterTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_count_word_occurence_in_a_string()
    {
        $counter = new KeywordCounter();

        $counts = $counter->countString('one two three two three three');

        $this->assertSame([
            'three' => 3,
            'two'   => 2,
            'one'   => 1,
        ], $counts);
    }

    /** @test */
    public function it_should_strip_punctuation()
    {
        $counter = new KeywordCounter();

        $counts = $counter->countString('@one, #two. three! two? ?three: ;three()');

        $this->assertSame([
            'three' => 3,
            'two'   => 2,
            'one'   => 1,
        ], $counts);
    }

    /** @test */
    public function it_should_count_array_of_objects()
    {
        $counter = new KeywordCounter();

        $array = [
            (object) ['txt' => 'one two three four three four'],
            (object) ['txt' => '@four, #two. four! three? ?five: ;five()'],
            (object) ['txt' => 'five five five'],
        ];

        $counts = $counter->countArrayOfObjects($array, 'txt');

        $this->assertSame([
            'five'  => 5,
            'four'  => 4,
            'three' => 3,
            'two'   => 2,
            'one'   => 1,
        ], $counts);
    }
}

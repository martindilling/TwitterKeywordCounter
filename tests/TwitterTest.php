<?php namespace TwitterKeywordCounter\Tests;

use TwitterKeywordCounter\Twitter;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \TwitterKeywordCounter\Twitter
     */
    protected $twitter;

    public function setUp()
    {
        $this->twitter = new Twitter(
            new TwitterOAuth(
                getenv('TWITTER_CONSUMER_KEY'),
                getenv('TWITTER_CONSUMER_SECRET'),
                getenv('TWITTER_ACCESS_TOKEN'),
                getenv('TWITTER_ACCESS_TOKEN_SECRET')
            )
        );
    }

    /** @test */
    public function it_should_get_tweets_from_username()
    {
        $tweets = $this->twitter->getTweetsFromUser('dillinghansen', 3);

        $this->assertCount(3, $tweets);
        $this->assertAttributeNotEmpty('text', $tweets[0]);
        $this->assertEquals(371437678, $tweets[0]->user->id);
    }

    /** @test */
    public function it_should_return_false_on_error()
    {
        $tweets = $this->twitter->getTweetsFromUser('someinsanelylongusernamethatsurelydoesntexist', 3);

        $this->assertFalse($tweets);
    }
}

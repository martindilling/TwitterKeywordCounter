<?php

use Abraham\TwitterOAuth\TwitterOAuth;
use TwitterKeywordCounter\KeywordCounter;
use TwitterKeywordCounter\Twitter;

require(__DIR__ . '/bootstrap.php');

// New climate instance to use for outputting to the console
$climate = new League\CLImate\CLImate;
$climate->forceAnsiOn();
$climate->clear();

// Initialise a new twitter object with the keys/tokens/secrets from the .env file
$twitter = new Twitter(
    new TwitterOAuth(
        getenv('TWITTER_CONSUMER_KEY'),
        getenv('TWITTER_CONSUMER_SECRET'),
        getenv('TWITTER_ACCESS_TOKEN'),
        getenv('TWITTER_ACCESS_TOKEN_SECRET')
    )
);

// Prepare questions
$askUsername = $climate->white()->backgroundGreen()->input('Username [dillinghansen]:');
$askUsername->defaultTo('dillinghansen');

$askNumberToAnalyse = $climate->white()->backgroundGreen()->input('Number of tweets to analyse [100]:');
$askNumberToAnalyse->defaultTo('100');

$askShowTop = $climate->white()->backgroundGreen()->input('Show top [10]:');
$askShowTop->defaultTo('10');

// Ask questions
$inputUsername        = $askUsername->prompt();
$inputNumberToAnalyse = $askNumberToAnalyse->prompt();
$inputShowTop         = $askShowTop->prompt();

// Get tweets
$tweets = $twitter->getTweetsFromUser($inputUsername, $inputNumberToAnalyse);

// Count words from the text of all tweets
$counter     = new KeywordCounter();
$countsTotal = $counter->countArrayOfObjects($tweets, 'text');

// Make a top ## list
$output = array_slice($countsTotal, 0, $inputShowTop, true);

/**
 * Print the output to the console
 */
$climate->br()->info('Keyword count from: @' . $inputUsername);
$climate->info()->border();

foreach ($output as $word => $count) {
    $climate->out($word . ',' . $count);
}

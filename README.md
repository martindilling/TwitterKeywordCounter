# Twitter Keyword Counter

Take a twitter username and display a list of keyword usage for the last 100 tweets.

## Setup

Copy the `.env.example` file to `.env`, and fill in the keys, tokens and secrets for your Twitter application.

You may need to create an app on [https://apps.twitter.com/](https://apps.twitter.com/).

## How

Run the command and fill in the settings.

````
php keywordcounter.php
````

Example output:

````
Username [dillinghansen]: twitter
Number of tweets to analyse [100]:
Show top [10]: 5

Keyword count from: @twitter
-------------------------------------------------------------------------------------------------------------------

to,56
the,55
twitter,43
rt,34
on,29
````


## Tests

Unit tests is found in the `tests` folder.
Run the tests with:

````
phpunit
````

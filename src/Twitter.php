<?php namespace TwitterKeywordCounter;

use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter
{
    /**
     * @var \Abraham\TwitterOAuth\TwitterOAuth
     */
    private $twitter;

    function __construct(TwitterOAuth $twitter)
    {
        $this->twitter = $twitter;
    }

    public function getTweetsFromUser($username, $count = null)
    {
        $result = $this->twitter->get(
            'statuses/user_timeline',
            [
                'screen_name' => $username,
                'count' => $count,
                'include_rts' => true,
                'trim_user' => true,
                'contributor_details' => false
            ]
        );

        if ($this->twitter->getLastHttpCode() !== 200) {
            return false;
        }

        return $result;
    }
}

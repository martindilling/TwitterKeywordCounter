<?php namespace TwitterKeywordCounter;

class KeywordCounter
{
    /**
     * From an array of object, count keywords from a specified key of the objects.
     *
     * @param array  $array
     * @param string $key
     * @return array
     */
    public function countArrayOfObjects($array, $key)
    {
        $counts = [];

        foreach ($array as $item) {
            $countsFromSingleItem = $this->countString($item->{$key});

            foreach($countsFromSingleItem as $word => $count){
                if(isset($counts[$word])){
                    $counts[$word] = $count + $counts[$word];
                } else {
                    $counts[$word] = $count;
                }
            }
        }

        arsort($counts);

        return $counts;
    }

    /**
     * Count keywords from a given string.
     *
     * @param string $text
     * @return array
     */
    public function countString($text)
    {
        $text  = mb_strtolower($text);
        $words = preg_split('/((^\p{P}+)|(\p{P}*\s+\p{P}*)|(\p{P}+$))/', $text, -1, PREG_SPLIT_NO_EMPTY);

        $counts = [];

        foreach ($words as $word) {
            if (!isset($counts[$word])) {
                $counts[$word] = 1;
            } else {
                $counts[$word]++;
            }
        }

        arsort($counts);

        return $counts;
    }
}

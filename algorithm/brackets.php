<?php
require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
    private $brackets = [']' => '[', ')' => '(', '}' => '{'];

    public function isValid($str)
    {
        if (empty($str)) return true;
        $str_len = strlen($str);
        $temp = [];
//        $brackets = [];
        for ($i = 0; $i < $str_len; $i++) {
            $char = $str[$i];

            if (array_key_exists($char, $this->brackets)) {
                $top_bracket = empty($temp) ? '' : array_pop($temp);
                if ($this->brackets[$char] != $top_bracket) {
                    return false;
                }
//                if ($temp && $this->brackets[$char] == end($temp)[0]) {
//                    $brackets[] = array(end($temp)[1] . ' : ' . $this->brackets[$char], "$i : " . $char);
//                    array_pop($temp);
//                } else {
//                    return false;
//                }
            } else {
                array_push($temp, $char);
//                array_push($temp, array($char, $i));
            }
        }
        return empty($temp);
    }

    function test()
    {
        echo ($this->isValid('()') ? 'yes' : 'no') . PHP_EOL;
        echo ($this->isValid('([)') ? 'yes' : 'no') . PHP_EOL;
    }
}

(new Solution())->test();

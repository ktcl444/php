<?php

require_once 'base\AlgorithmBase.php';

//拼写单词-字典比较
class Solution extends \algorithm\base\AlgorithmBase
{   
	function countCharacters($words, $chars) {
        $map = [];
        $c_len = strlen($chars);
        for($i = 0;$i < $c_len;$i++){
            $map[$chars{$i}]++;
        }
        $res = 0;
        foreach($words as $word){
            $t_map =$map;
            for($i = 0;$i < strlen($word);$i++){
                $char = $word{$i};
                if(array_key_exists($char,$t_map) && $t_map[$char]>0){
                    $t_map[$char]--;
                }else{
                    break;
                }
            }
            $i == strlen($word) && $res+=strlen($word);
        }

        return $res;
    }
	
	function test(){
		echo ($this->countCharacters(["cat","bt","hat","tree"],'atach')).PHP_EOL;
	}
	
}
(new Solution())->test();
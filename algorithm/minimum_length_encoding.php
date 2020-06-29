<?php

require_once 'base\AlgorithmBase.php';
//单词的压缩编码-反转排序
class Solution extends \algorithm\base\AlgorithmBase
{
    function minimumLengthEncoding($words) {
		foreach($words as $key =>$value){
			$words[$key] = strrev($value);
		}
        sort($words);
        $length = count($words);
		$res = 0;
        for($i = 0;$i < $length;$i++){
			if(strstr($words[$i+1],$words[$i])){
				continue;
			}else{
				$res += strlen($words[$i])+1;
			}
        }

        return $res;   
    }
	
	function test(){
		print_r($this->minimumLengthEncoding(['time','atime','btime']));
	}
}

(new Solution())->test();
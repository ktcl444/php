<?php

require_once 'base\AlgorithmBase.php';
//棒球比赛-堆栈
class Solution extends \algorithm\base\AlgorithmBase
{

	function letterCasePermutation($S) {
		$char_array = str_split($S);
		$ans = [];
		foreach($char_array as $char){
			if(is_numeric($char)){
				if(empty($ans)){
					$ans[] = $char;
				}else{
					foreach($ans as $key => $s){
						$ans[$key] = $s.$char;
					}
				}
			}else{
				if(empty($ans)){
					$ans = [strtolower($char),strtoupper($char)];
				}else{
					$len = count($ans);
					$ans = array_merge($ans,$ans);
					foreach($ans as $key => $s){
						if($key < $len){
							$ans[$key] = $s.strtolower($char);
						}else{
							$ans[$key] = $s.strtoupper($char);
						}
					}
				}
			}
		}
		
		return $ans;
		
		
        $char_array = str_split($S);
        $len = count($char_array);
        $index_array = [];
        foreach($char_array as $index => $char){
            if(!is_numeric($char)){
                $index_array[] = $index;
            }
        }

        $ans = [[]];

        foreach($index_array as $index){
            $temp_ans = [];
            foreach($ans as $array){
                $temp = $array;
				array_push($temp,strtolower($S{$index}));
                $temp_ans[] = $temp;
				
                $temp = $array;
				array_push($temp,strtoupper($S{$index}));
                $temp_ans[] = $temp;
            }
            $ans = $temp_ans;
        }

        $res = [];
        foreach($ans as $char_array){
            $res_array = [];
            $index = 0;
            for($i = 0;$i < $len;$i++){
                $char = $S{$i};
                if(is_numeric($char))
                    $res_array[] = $char;
                else{
                    $res_array[] = $char_array[$index++];
                }
            }
            $res[] = $res_array;
        }

        return array_map(function($v){
            return implode('',$v);
        },$res);
    }



  
	function test(){
		print_r($this->letterCasePermutation('a1b2')).PHP_EOL;
	}
}

(new Solution())->test();
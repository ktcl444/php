<?php

require_once 'base\AlgorithmBase.php';
// Z字型变换-数组追加
class Solution extends \algorithm\base\AlgorithmBase
{    
    function convert($s, $numRows) {
		//1 数组追加(不需要考虑下标)
        $len = strlen($s);
		if($len <= $numRows || $numRows <= 1)return $s;
		$res = [];
		$line = 0;
		for($i = 0;$i < $len;$i++){
			$char = $s{$i};
			$res[$line][] = $char;
			if($line == $numRows - 1){
				$add = false;
			}elseif($line == 0){
				$add = true;
			}
			$add ? $line++ : $line--; 
			
		}
		return $this->formatResult($res);
		
		//2 按Z形状排列
        $cols = $this->getColNum($len,$numRows);
        $result = array_fill(0,$numRows,array_fill(0,$cols,''));
        $index = 0;
        $r = 0;
        $c = 0;

        $line = 0;
        $cross = 0;
        $line_s = 0;
        $cross_s = 0;

        while($index < $len){
			//echo 'r:'.$r.' c:'.$c.' line:'.$line.' line_s:'.$line_s.PHP_EOL;
            if($line == 0){
				$char = $s{$index++};
                $result[$r][$c] = $char;
                $line_s++;
                if($line_s == $numRows){
                    $line = 1;
                    $cross = 0;
                    $line_s = 0;
                    $r--;
                    $c++;
                }else{
                    $r++;
                }
            }else{
				if($numRows <= 2){
					$cross = 1;
					$line = 0;
				}else{
					if($cross == 0){
						$char = $s{$index++};
						$result[$r][$c] = $char;
						$cross_s++;
						if($cross_s == $numRows - 2){
							$cross = 1;
							$line = 0;
							$cross_s = 0;
						} 
						
						$r--;
						$c++;
					}
				}

            }
        }

        //print_r($result);
        return $this->formatResult($result);
    }

    function formatResult($result){
        $ans = '';
        foreach($result as $row){
            $ans .= implode('',$row);
        }
        return $ans;
    }

    function getColNum($len,$numRows){
        $cell = $numRows == 1 ? 1 : $numRows + $numRows - 2;
        $times = ceil($len / $cell);
        return ($numRows - 1) * $times;
    }

	function test(){
		echo($this->convert('PAYPALISHIRING',3)).PHP_EOL;
		echo($this->convert('PAYPALISHIRING',4)).PHP_EOL;
		echo($this->convert('ABCDE',2)).PHP_EOL;
		
		echo($this->convert('A',1)).PHP_EOL;
	}
}

(new Solution())->test();
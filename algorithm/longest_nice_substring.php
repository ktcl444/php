<?php

require_once 'base\AlgorithmBase.php';
//最长的美好字符串-位运算/滑动窗口
class Solution extends \algorithm\base\AlgorithmBase
{    
    function longestNiceSubstring($s)
    {
        $ans = "";

        for ($i = 0; $i < strlen($s); $i++) {
            $a = $b = 0;
            for ($j = $i; $j < strlen($s); $j++) {
                if ('a' <= $s[$j]) {
                    $a |= 1 << (ord($s[$j]) - ord('a'));
                } else {
                    $b |= 1 << (ord($s[$j]) - ord('A'));
                }
                if ($a == $b && $j - $i + 1 > strlen($ans)) {
                    $ans = substr($s, $i, $j - $i + 1);
                }
            }
        }

        return $ans;
    }

       function longestNiceSubstring2($s) {
        $list = array_fill(0,26,0);
        $types = 0;
        for($i = 0,$len = strlen($s);$i < $len;$i++){
            $char = strtolower($s{$i});
            $list[ord($char)-97]++;
            $types += 1 == $list[ord($char)-97];
        }
        $start = 0;
        $end = -1;
        //echo $types.PHP_EOL;
        for($max = 1;$max <= $types;$max++){
           $res = $this->dfs($s,$max);
          // print_r($res);
           $left = $res[0];
           $right = $res[1];
            if($right - $left > $end - $start){
                $start = $left;
                $end = $right;
            }
        }

        return substr($s,$start,$end - $start + 1);
    }

             //a-z：97-122，A-Z：65-90
    function dfs($s,$max){
        $up_list = array_fill(0,26,0);
        $low_list = array_fill(0,26,0);
        $start = 0;
        $end = -1;
        $len = strlen($s);
        for($l = 0,$r = 0,$types = 0;$r < $len;$r++){
            $char = $s{$r};
            $asc = ord($char);
            if($asc >= 65 && $asc <= 90){
                $up_list[$asc - 65]++;
                $types += 1 == ($up_list[$asc - 65] + $low_list[$asc -65]);
            }else{
                $low_list[$asc - 97]++;
                $types += 1 == ($up_list[$asc - 97] + $low_list[$asc -97]);
            }
            while($max < $types){
                $char = $s{$l};
                $asc = ord($char);
                if($asc >= 65 && $asc <= 90){
                    $types -= 1 == ($up_list[$asc - 65] + $low_list[$asc -65]);          
                    $up_list[$asc - 65]--;
                }else{
                    $types -= 1 == ($up_list[$asc - 97] + $low_list[$asc -97]);
                    $low_list[$asc - 97]--;
                }
                $l++;
            }
            $ans = 0;
            for($i = 0;$i < 26;$i++){
                if($low_list[$i] && $up_list[$i]){
                    $ans++;
                }
            }
			//echo substr($s,$l,$r-$l+1).PHP_EOL;
			//echo '成对出现的字符数:'.$ans.PHP_EOL;
            if($ans == $types && $r - $l > $end - $start){
                $start = $l;
                $end = $r;
            }
        }


        return [$start,$end];
    }

	function test(){
		echo($this->longestNiceSubstring('YazaAay')).PHP_EOL;
	}
}

(new Solution())->test();
<?php

require_once 'base\AlgorithmBase.php';
//最长回文子序列-dp
class Solution extends \algorithm\base\AlgorithmBase
{   

    private $map;
	//dp1
    function longestPalindromeSubseq($s) {
        $len = strlen($s);
        $this->map = array_fill(0,$len,array_fill(0,$len,0));
        return $this->dfs($s,0,$len-1);
    }

    function dfs($s,$l,$r){
        if($l == $r)
			return 1;
		if($l > $r)
			return 0;
			
		if($this->map[$l][$r] != 0)
			return $this->map[$l][$r];

		if($s{$l} == $s{$r}){
			$ans = $this->dfs($s,$l+1,$r-1)+2;
		}else{
			$ans = max($this->dfs($s,$l+1,$r),$this->dfs($s,$l,$r-1));
		}
		
		$this->map[$l][$r] = $ans;
		return $ans;
    }

	//dp2
    function longestPalindromeSubseq2($s) {
        $len = strlen($s);
        $dp = array_fill(0,$len,array_fill(0,$len,0));
        for($i = $len - 1;$i >= 0;$i--){
			$dp[$i][$i] = 1;
			for($j = $i + 1;$j < $len;$j++){
				if($s{$i} == $s{$j}){
					$dp[$i][$j] = $dp[$i+1][$j-1] + 2;
				}else{
					$dp[$i][$j] = max($dp[$i+1][$j],$dp[$i][$j-1]);
				}
			}
		}

        return $dp[0][$len-1];
    }

	function test(){
		echo $this->longestPalindromeSubseq("ababac").PHP_EOL;
		echo $this->longestPalindromeSubseq("euazbipzncptldueeuechubrcourfpftcebikrxhybkymimgvldiwqvkszfycvqyvtiwfckexmowcxztkfyzqovbtmzpxojfofbvwnncajvrvdbvjhcrameamcfmcoxryjukhpljwszknhiypvyskmsujkuggpztltpgoczafmfelahqwjbhxtjmebnymdyxoeodqmvkxittxjnlltmoobsgzdfhismogqfpfhvqnxeuosjqqalvwhsidgiavcatjjgeztrjuoixxxoznklcxolgpuktirmduxdywwlbikaqkqajzbsjvdgjcnbtfksqhquiwnwflkldgdrqrnwmshdpykicozfowmumzeuznolmgjlltypyufpzjpuvucmesnnrwppheizkapovoloneaxpfinaontwtdqsdvzmqlgkdxlbeguackbdkftzbnynmcejtwudocemcfnuzbttcoew").PHP_EOL;
	}
}

(new Solution())->test();
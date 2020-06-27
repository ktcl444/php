<?php

require_once 'base\AlgorithmBase.php';
//最长回文串-贪心+位运算
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 贪心
    function longestPalindrome1($s) {
        $mapping = [];
        $length = strlen($s);
        for($i = 0;$i < $length;$i++){
            $mapping[$s{$i}]++;
        }
        $res = 0;
        $single_count = 0;
        foreach($mapping as $count){
			$res += intval($count / 2) * 2;
			if($res % 2 == 0 && $count % 2 == 1)
				$res++;
        }

        return $res;
    }
	#endregion
	
	#region 位运算
	function longestPalindrome($s) {
        $mapping = [];
        $length = strlen($s);
        $res = 0;
        for($i = 0;$i < $length;$i++){
			if($mapping[$s{$i}] & 1) $res += 2;
            $mapping[$s{$i}]++;
        }
		if($res < $length) $res++;

        return $res;
    }
	#endregion

	function test(){
		echo($this->longestPalindrome("civilwartestingwhetherthatnaptionoranynartionsoconceivedandsodedicatedcanlongendureWeareqmetonagreatbattlefiemldoftzhatwarWehavecometodedicpateaportionofthatfieldasafinalrestingplaceforthosewhoheregavetheirlivesthatthatnationmightliveItisaltogetherfangandproperthatweshoulddothisButinalargersensewecannotdedicatewecannotconsecratewecannothallowthisgroundThebravelmenlivinganddeadwhostruggledherehaveconsecrateditfaraboveourpoorponwertoaddordetractTgheworldadswfilllittlenotlenorlongrememberwhatwesayherebutitcanneverforgetwhattheydidhereItisforusthelivingrathertobededicatedheretotheulnfinishedworkwhichtheywhofoughtherehavethusfarsonoblyadvancedItisratherforustobeherededicatedtothegreattdafskremainingbeforeusthatfromthesehonoreddeadwetakeincreaseddevotiontothatcauseforwhichtheygavethelastpfullmeasureofdevotionthatweherehighlyresolvethatthesedeadshallnothavediedinvainthatthisnationunsderGodshallhaveanewbirthoffreedomandthatgovernmentofthepeoplebythepeopleforthepeopleshallnotperishfromtheearth")).PHP_EOL;
	}
}

(new Solution())->test();
<?php

require_once 'base\AlgorithmBase.php';

//分糖果-等差数列
class Solution extends \algorithm\base\AlgorithmBase
{   
    function distributeCandies($candies, $num_people) {
        $sqrt = floor(sqrt($candies));
        $temp = (1+$sqrt)*$sqrt / 2;
        while($temp<$candies){
            $temp += ++$sqrt;
        }
        if($temp == $candies){
            $r = 0;
        }else{
            $r = $sqrt-- - ($temp - $candies);
        }
     
        $turns =floor( $sqrt / $num_people);
        $last = $sqrt % $num_people;
        $res = array_fill(0,$num_people,0);
        //kids[i]=i+(i+n)+(i+2n)+…(i+( turns −1)∗n)
        //d[i]=i× turns +n *turns ( turns −1) /2
        for($i =0;$i < $num_people;$i++){
            $res[$i] = ($i+1)*$turns + floor($num_people*$turns*($turns-1)*0.5);
            if($i < $last)
                $res[$i] += $i+1+ $turns * $num_people;

        }
        $res[$last] += $r;

        return $res;
    }

	function test(){
		print_r($this->distributeCandies(7,4));
	}
	
}
(new Solution())->test();
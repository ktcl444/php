<?php

require_once 'base\AlgorithmBase.php';
//整数转罗马数字-贪心
class Solution extends \algorithm\base\AlgorithmBase
{
     private $special = [
         '40'=>[10,'XL'],
         '90'=>[10,'XC'],
         '400'=>[100,'CD'],
         '900'=>[100,'CM']
     ];
     private $map = [
         '1000'=>'M',
         '500'=>'D',
         '100'=>'C',
         '50'=>'L',
         '10'=>'X',
     ];
     private $single = [
         '1'=>'I',
         '2'=>'II',
         '3'=>'III',
         '4'=>'IV',
         '5'=>'V',
         '6'=>'VI',
         '7'=>'VII',
         '8'=>'VIII',
         '9'=>'IX'
     ];
    function intToRoman($num) {
		$nums = [1000,900,500,400,100,90,50,40,10,9,5,4,1];
        $rms = ["M","CM","D","CD","C","XC","L","XL","X","IX","V","IV","I"];
        $res = "";
        for($i = 0; $i < count($rms); $i++){
            while($num >= $nums[$i]){
                $res .= $rms[$i];
                $num -= $nums[$i];
            }
        }
        return $res;
		
        if($num == 0)return '';
        foreach($this->special as $s => $list){
			$temp = intval($num / $s);
            if($temp == 1 && $num % $s < $list[0]){
                return $list[1].$this->intToRoman($num % $s);
            }
        }
        foreach($this->map as $n => $char){
			$temp = intval($num / $n);
            if($temp >= 1){
                $pre = $temp;
                $next = $num - $pre * $n;
                $ans = '';
                while($pre-- > 0){
                    $ans .= $char;
                }
                return $ans.$this->intToRoman($next);
            }
        }
        foreach($this->single as $n => $char){
            if($num == $n)
                return $char;
        }
    }
		

	function test(){
		echo($this->intToRoman(20)).PHP_EOL;
		echo($this->intToRoman(58)).PHP_EOL;
		echo($this->intToRoman(1994)).PHP_EOL;
	}
}

(new Solution())->test();
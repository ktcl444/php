<?php

namespace algorithm\base;
abstract class AlgorithmBase
{
    abstract function test();
	
    protected function gcd($m,$n){
        while($n != 0){
            $r = $m % $n;
            $m = $n;
            $n = $r;
        }

        return $m;
    }
	
	protected function gbd($m,$n){
		$gcd = $this->gcd($m,$n);
		return $m * $n / $gcd;
	}
}
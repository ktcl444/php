<?php

require '..\base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
//    equations(方程式) = [ ["a", "b"], ["b", "c"] ],
//    values(方程式结果) = [2.0, 3.0],
//    queries(问题方程式) = [ ["a", "c"], ["b", "a"], ["a", "e"], ["a", "a"], ["x", "x"] ].

//给定 a / b = 2.0, b / c = 3.0
//问题: a / c = ?, b / a = ?, a / e = ?, a / a = ?, x / x = ? 
//返回 [6.0, 0.5, -1.0, 1.0, -1.0 ]

    /**
     * @param String[][] $equations
     * @param Float[] $values
     * @param String[][] $queries
     * @return Float[]
     */
    function calcEquation($equations, $values, $queries) {

        $g = [];
        $this->buildGraph($g, $equations, $values);
        $ans = array_fill(0, count($queries), -1.0);

        for ($i = 0; $i < count($queries); $i++) {
            $from = $queries[$i][0];
            $to = $queries[$i][1];
            if (!isset($g[$from]) || !isset($g[$to])) continue;

            $this->dfs($g, $from, $to, 1.0, [], $i, $ans);
        }
        return $ans;
    }

    function dfs($g, $from, $to, $total, $visited, $index, &$ans) {
        $visited[$from] = 1;
        if (empty($g[$from])) return;
        if (isset($g[$from][$to])) {
            $ans[$index] = $g[$from][$to] * $total;
            return;
        }

        foreach ($g[$from] as $neighbor => $val) {
            if (isset($visited[$neighbor])) continue;
            $this->dfs($g, $neighbor, $to, $g[$from][$neighbor] * $total, $visited, $index, $ans);
        }
    }

    function buildGraph(&$g, $equations, $values) {
        //  print_r($equations);
        for ($i = 0; $i < count($equations); $i++) {
            $from = $equations[$i][0];
            $to = $equations[$i][1];
            $g[$from][$to] = $values[$i];
            $g[$to][$from] = (float) 1.0 / $values[$i];
            $g[$from][$from] = 1.0;
            $g[$to][$to] = 1.0;
        }
    }

#region test
//    private $relation_mapping = [];
//    private $collection = [];
//
//    function calcEquation2($equations, $values, $queries)
//    {
//        $this->getRelation($equations, $values);
//        $result = [];
//        foreach ($queries as $query) {
//            $pre = $query[0];
//            $next = $query[1];
//            $result[] = $this->getRelationValue($pre, $next);
//        }
//        return $result;
//    }
//
//    private function getRelationValue($pre, $next, $recurse = true)
//    {
//        $value = -1;
//        if (in_array($pre, $this->collection) && in_array($next, $this->collection)) {
//            if ($pre == $next) {
//                $value = 1;
//            } else {
//                if (array_key_exists($pre, $this->relation_mapping)) {
//                    $pre_relation = $this->relation_mapping[$pre];
//                    if (array_key_exists($next, $pre_relation)) {
//                        $value = $pre_relation[$next];
//                    }
//                } else {
//                    $value = $recurse && floatval(1 / $this->getRelationValue($next, $pre, false));
//                }
//            }
//
//        }
//        return $value;
//    }
//
//    private function getRelation($equations, $values)
//    {
//        $length = count($equations);
//        for ($i = 0; $i < $length; $i++) {
//            $pre = $equations[$i][0];
//            $next = $equations[$i][1];
//            $mapping = array_key_exists($pre, $this->relation_mapping) ? $this->relation_mapping[$pre] : [];
//            $mapping[$next] = $values[$i];
//            $this->relation_mapping[$pre] = $mapping;
//            $mapping = array_key_exists($next, $this->relation_mapping) ? $this->relation_mapping[$next] : [];
//            $mapping[$pre] = floatval(1 / $values[$i]);
//            $this->relation_mapping[$next] = $mapping;
//            !in_array($pre, $this->collection) && array_push($this->collection, $pre);
//            !in_array($next, $this->collection) && array_push($this->collection, $next);
//        }
//    }
#endregion

    function test()
    {

        print_r($this->calcEquation(
            [["a", "b"], ["c", "d"]],
            [1.0, 1.0],
            [["a", "c"], ["b", "d"], ["b", "a"], ["d", "c"]]
        ));
//        print_r($this->calcEquation(
//            [["a", "b"], ["b", "c"]],
//            [2.0, 3.0],
//            [["a", "c"], ["b", "a"], ["a", "e"], ["a", "a"], ["x", "x"]]
//        ));
    }
}

(new Solution())->test();
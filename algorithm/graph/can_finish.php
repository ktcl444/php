<?php

require '..\base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
//输入: 2, [[1,0]]
//输出: true
//解释: 总共有 2 门课程。学习课程 1 之前，你需要完成课程 0。所以这是可能的。
//
//输入: 2, [[1,0],[0,1]]
//输出: false
//解释: 总共有 2 门课程。学习课程 1 之前，你需要先完成​课程 0；并且学习课程 0 之前，你还应先完成课程 1。这是不可能的。

    #region 入度表
    function canFinish2($numCourses, $prerequisites)
    {
        $indegrees = array_fill(0, $numCourses, 0);
        foreach ($prerequisites as $cp) {
            $indegrees[$cp[0]]++;
        }
        $queue = [];
        for ($i = 0; $i < $numCourses; $i++) {
            if ($indegrees[$i] == 0)
                $queue[] = $i;
        }

        while (!empty($queue)) {
            $pre = array_shift($queue);
            $numCourses--;
            foreach ($prerequisites as $req) {
                if ($req[1] != $pre) continue;
                if (--$indegrees[$req[0]] == 0) array_push($queue, $req[0]);
            }
        }

        return $numCourses == 0;
    }

    #endregion

    #region dfs
    function canFinish($numCourses, $prerequisites)
    {
        $flags = array_fill(0, $numCourses, 0);
        $adjacency = array_fill(0, $numCourses, $flags);
        foreach ($prerequisites as $cp) {
            $adjacency[$cp[1]][$cp[0]] = 1;
        }
        for ($i = 0; $i < $numCourses; $i++) {
            if (!$this->dfs($adjacency, $flags, $i))
                return false;
        }
        return true;
    }

    private function dfs($adjacency, $flags, $i)
    {
        if ($flags[$i] == 1) return false;  //当 flag[i] == -1，说明当前访问节点已被其他节点启动的 DFS 访问，无需再重复搜索，直接返回 True
        if ($flags[$i] == -1) return true;//当 flag[i] == 1，说明在本轮 DFS 搜索中节点 i 被第 2 次访问，即 课程安排图有环，直接返回 False
        $flags[$i] = 1; //当前访问节点 i 对应 flag[i] 置 11，即标记其被本轮 DFS 访问过
        for ($j = 0; $j < count($adjacency); $j++) {
            //递归访问当前节点 i 的所有邻接节点 j，当发现环直接返回 False
            if ($adjacency[$i][$j] == 1 && !$this->dfs($adjacency, $flags, $j)) return false;
        }
        $flags[$i] = -1;//当前节点所有邻接节点已被遍历，并没有发现环，则将当前节点 flag 置为 -1 并返回 True
        return true;
    }

    #endregion

    function test()
    {
        print_r($this->canFinish(2, [[1, 0]]));
        print_r($this->canFinish(2, [[1, 0], [0, 1]]));
    }
}

(new Solution())->test();
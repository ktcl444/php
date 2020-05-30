<?php

require '..\base\AlgorithmBase.php';
//单词搜索2-DFS(前缀树)
class Solution extends \algorithm\base\AlgorithmBase
{
	private $rows = 0;
	private $cols = 0;
	private $board = [];
	private $direct = [
		[1,0],[-1,0],[0,1],[0,-1]
	];
    function findWords($board, $words) {
		if(empty($board) || empty($words))return [];
		$trie = new Trie();
		foreach($words as $word){
			$trie->insert($word);
		}
		$root = $trie->getRoot();
		$this->board = $board;
		$this->rows = count($board);
		$this->cols = count($board[0]);
		$res = [];
		for($i = 0;$i < $this->rows;$i++){
			for($j = 0;$j < $this->cols;$j++){
				$this->dfs($i,$j,$root,'',$res);
			}
		}
		
		return $res;
    }
	
	function dfs($i,$j,$root,$prefix,&$res){
		$char = $this->board[$i][$j];
		$word = $prefix .$char;
		if(!array_key_exists($char,$root))return;
		$root = $root[$char];
		if(isset($root['is_end']) && !in_array($word,$res)){
			$res[] =$word;
		}

		$this->board[$i][$j] = '#';
		foreach($this->direct as $di){
			$x = $i + $di[0];
			$y = $j + $di[1];
			if($x >= 0&& $x < $this->rows && $y >= 0 && $y < $this->cols && $this->board[$x][$y] != '#'){
				$this->dfs($x,$y,$root,$word,$res);
			}
		}
		$this->board[$i][$j] = $char;
	}


    function test()   {
		print_r($this->findWords([
		  ['o','a','a','n'],
		  ['e','t','a','e'],
		  ['i','h','k','r'],
		  ['i','f','l','v']
		],
		["oath","pea","eat","rain"] 
		));
    }
}

class Trie
{
    private $root = [];//字典树的根

    /**
     * Initialize your data structure here.
     */
    function __construct()
    {
    }
	
	function getRoot(){
		return $this->root;
	}

    /**
     * Inserts a word into the trie.
     * @param String $word
     * @return NULL
     */
    function insert($word)
    {
        if (is_null($word) || strlen($word) == 0) return;
        $node = &$this->root;
        $length = strlen($word);
        for ($i = 0; $i < $length; $i++) {
			if(!array_key_exists($word{$i},$node)){
				$node[$word[$i]] = [];
			}
            $node = &$node[$word[$i]];
        }
        $node['is_end'] = true;
    }

    /**
     * Returns if the word is in the trie.
     * @param String $word
     * @return Boolean
     */
    function search($word)
    {
        if (is_null($word) || strlen($word) == 0) false;
        $node = &$this->root;
        $length = strlen($word);
        for ($i = 0; $i < $length; $i++) {
            if (!isset($node[$word[$i]])) {
                return false;
            }
            $node = &$node[$word[$i]];
        }
        return isset($node['is_end']);
    }

    /**
     * Returns if there is any word in the trie that starts with the given prefix.
     * @param String $prefix
     * @return Boolean
     */
    function startsWith($prefix)
    {
        if (is_null($prefix) || strlen($prefix) == 0) false;
        $node = &$this->root;
        $length = strlen($prefix);
        for ($i = 0; $i < $length; $i++) {
            if (!isset($node[$prefix[$i]])) {
                return false;
            }
            $node = &$node[$prefix[$i]];
        }
        return true;
    }
}

(new Solution())->test();
<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

#region 精简版本
class Trie
{
    private $root = [];//字典树的根

    /**
     * Initialize your data structure here.
     */
    function __construct()
    {
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
            if (!isset($node[$word[$i]])) {
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
#endregion

#region 完整版本
//class Trie
//{
//    private $root;//字典树的根
//
//    /**
//     * Initialize your data structure here.
//     */
//    function __construct()
//    {
//        $this->root = new TrieNode();
//    }
//
//    /**
//     * Inserts a word into the trie.
//     * @param String $word
//     * @return NULL
//     */
//    function insert($word)
//    {
//        if (is_null($word) || strlen($word) == 0) return;
//        $node = $this->root;
//        $char_array = str_split($word);
//        $length = count($char_array);
//        for ($i = 0; $i < $length; $i++) {
//            $pos = ord($char_array[$i]) - ord('a');
//            if (array_key_exists($pos, $node->son)) {
//                $node->son[$pos]->num++;
//            } else {
//                $node->haveSon = true;
//                $node->son[$pos] = new TrieNode();
//                $node->son[$pos]->val = $word[$i];
//            }
//            $node = $node->son[$pos];
//        }
//        $node->isEnd = true;
//    }
//
//    /**
//     * Returns if the word is in the trie.
//     * @param String $word
//     * @return Boolean
//     */
//    function search($word)
//    {
//        if (is_null($word) || strlen($word) == 0) false;
//        $node = $this->root;
//        $char_array = str_split($word);
//        $length = count($char_array);
//        for ($i = 0; $i < $length; $i++) {
//            $pos = ord($char_array[$i]) - ord('a');
//            if (!array_key_exists($pos, $node->son)) {
//                return false;
//            }
//            $node = $node->son[$pos];
//        }
//        return $node->isEnd;
//    }
//
//    /**
//     * Returns if there is any word in the trie that starts with the given prefix.
//     * @param String $prefix
//     * @return Boolean
//     */
//    function startsWith($prefix)
//    {
//        if (is_null($prefix) || strlen($prefix) == 0) false;
//        $node = $this->root;
//        $char_array = str_split($prefix);
//        $length = count($char_array);
//        for ($i = 0; $i < $length; $i++) {
//            $pos = ord($char_array[$i]) - ord('a');
//            if (!array_key_exists($pos, $node->son)) {
//                return false;
//            }
//            $node = $node->son[$pos];
//        }
//        return true;
//    }
//}
//
//class TrieNode //字典树节点
//{
//    public $num;//有多少单词通过这个节点,即由根至该节点组成的字符串模式出现的次数
//    public $son;//所有的儿子节点
//    public $isEnd;//是不是最后一个节点
//    public $val;//节点的值
//    public $haveSon;
//
//    function __construct()
//    {
//        $this->num = 1;
//        $this->son = [];
//        $this->isEnd = false;
//        $this->haveSon = false;
//    }
//}
#endregion

class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
    function test()
    {
        $trie = new Trie();

        $trie->insert("apple");
        echo $trie->search("apple") . PHP_EOL;   // 返回 true
        echo $trie->search("app") . PHP_EOL;     // 返回 false
        echo $trie->startsWith("app") . PHP_EOL; // 返回 true
        $trie->insert("app");
        echo $trie->search("app") . PHP_EOL;
    }
}

(new Solution())->test();




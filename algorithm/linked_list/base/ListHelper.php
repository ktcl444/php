<?php

namespace algorithm\linked_list\base;
require("ListNode.php");

class ListHelper
{
    private static $end_node = null;

    public static function convertArrayToLinkedList($array, $end_index = -1)
    {
        self::init();
        return empty($array) ? null : self::getListNode($array, count($array), 0, $end_index);
    }

    private static function getListNode($array, $length, $index, $end_index)
    {
		if($index == $length){
			return $this->end_node;
		}
		$node = new ListNode($array[$index]);
		$index == $end_index && $this->end_node = $node;
		$node->next = self::getListNode($array,$length,$index+1,$end_index);
		return $node;
    }

    private static function init()
    {
        self::$end_node = null;
    }
}

//print_r(ListHelper::convertArrayToLinkedList([1,3,4,5,6]));
<?php


namespace algorithm\linked_list\base;

require("ListHelper.php");
require_once __DIR__.'\..\..\base\AlgorithmBase.php';
abstract class LinkedListAlgorithmBase extends \algorithm\base\AlgorithmBase
{
    public static function convertArrayToLinkedList($array)
    {
        return ListHelper::convertArrayToLinkedList($array);
    }
}
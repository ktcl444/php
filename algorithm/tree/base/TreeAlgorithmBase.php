<?php

namespace algorithm\tree\base;

require("TreeHelper.php");
require_once __DIR__.'\..\..\base\AlgorithmBase.php';
abstract class TreeAlgorithmBase extends \algorithm\base\AlgorithmBase
{
    public static function convertArrayToTree($array)
    {
        return TreeHelper::convertArrayToTree($array);
    }
}
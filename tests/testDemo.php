<?php
/**
 * 语法练习
 */

$name = array("iphone", "一个大苹果", "一个大西瓜");
//var_dump($name);

foreach ($name as $k => $item)
{
    if ( strpos($item, "苹果") !== false ) {
        echo "找到一个大苹果";
    } else if ( strpos($item, "西瓜") !== false ){
        echo "找到一个大西瓜";
    }
}

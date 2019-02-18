<?php
/**
 * Created by PhpStorm.
 * User: Lxink
 * Date: 2019/2/18
 * Time: 8:40
 */

/**
 * 水仙花
 */

function checkNum($n, $m)
{
    $arr = [];
    for ($i = $n; $i <= $m; $i++) {
        if ($i == 1) continue;
        if ($i > 999 || $m < 100) return $arr;
        $a = $i % 10;
        $b = floor($i / 10 % 10);
        $c = floor($i / 100);

        if ((pow($a, 3) + pow($b, 3) + pow($c, 3)) == $i) {
            $arr[] = $i;
        }
    }
    return $arr;
}
echo '水仙花';
print_r(checkNum(1, 10000));

echo '<br/>';

/**
 * 给定一个英文字符串首先出现三次的那个英文字符
 */

function getStr($str)
{
    $arr = [];
    $len = strlen($str);
    for ($i = 0; $i < $len; $i++) {
        if (isset($arr[$str[$i]])) {
            $arr[$str[$i]]++;
            if ($arr[$str[$i]] == 3) {
                return $str[$i];
            }
        } else {
            $arr[$str[$i]] = 1;
        }
    }

    return false;
}

echo '三次字符';
print_r(getStr('abaacdedaf'));

echo '<br/>';

/**
 * 回文字符
 */

function isHuiWen($str)
{
    $len = strlen($str) - 1;
    $middle = floor($len / 2);

    for ($i = 0; $i <= $middle; $i++) {
        if ($str[$i] != $str[$len - $i]) {
            return 0;
        }
    }

    return 1;
}

echo '回文';
print_r(isHuiWen('1122211'));

echo '<br/>';

/**
 * 斐波那契
 */
function func($n)
{
    $arr = [];

    for ($i = 0; $i < $n; $i++) {
        if ($i < 2) {
            $arr[] = 1;
            continue;
        }

        $arr[] = $arr[$i - 1] + $arr[$i - 2];
    }

    return $arr;
}

echo '斐波那契';

print_r(func(8));

echo '<br/>';

/**
 * 传入一个十进制数字，返回数字对应的英文字母：
 */

function search($num)
{
    $arr = range('a', 'z');
    if ($num - 1 == -1) {
        return $arr[25];
    }

    return $arr[$num - 1];
}

function change($num, $res = '')
{
    $a = floor($num / 26);
    $b = $num % 26;
    if ($b == 0) {
        $a -= 1;
    }
    $res .= search($b);

    if ($a > 0) {
        return strrev(change($a, $res));
    } else {
        return $res;
    }
}

echo '传入一个十进制数字，返回数字对应的英文字母';
echo change(52);

echo '<br/>';

/**
 * 走台阶
 */

function getNum($n)
{
    if ($n == 1 || $n == 0) {
        return 1;
    }

    return getNum($n - 1) + getNum($n - 2);
}

echo '走台阶';
echo getNum(7);
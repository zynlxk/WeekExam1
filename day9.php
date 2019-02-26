<?php
/**
 * Created by PhpStorm.
 * User: Lxink
 * Date: 2019/2/26
 * Time: 8:40
 */

/**
 * 第一题
 */

function first($n, $m)
{
    $arr = range(1, $n);
    $len = count($arr);
    $k = 0;

    for ($i = 0; $i < $len; $i++) {
        if (count($arr) <= 1) {
            return $arr;
        }
        if (!isset($arr[$i])) {
            continue;
        }
        $k++;
        if ($m == $k) {
            unset($arr[$i]);
            $k = 0;
        }
        if ($i == $len - 1) {
            $i = -1;
            continue;
        }
    }
}

print_r(first(5, 2));

/**
 * 第二题
 */

function second($arr)
{
    rsort($arr);
    $arr_ = [
        [array_shift($arr)],
        [array_shift($arr)],
        [array_shift($arr)],
    ];

    $len = count($arr);

    for ($i = 0; $i < $len; $i++) {
        $arr_[2][] = $arr[$i];
        $sum = array_sum($arr_[2]);

        if ($sum > array_sum($arr_[0])) {
            $arr_ = [
                $arr_[2],
                $arr_[0],
                $arr_[1],
            ];
        } else  if ($sum > array_sum($arr_[1])){
            $arr_ = [
                $arr_[0],
                $arr_[2],
                $arr_[1],
            ];
        }
    }
    return $arr_;
}
echo '<br/>';
print_r(second([1,2,3,4,5,6,7]));


function third($arr, $k = 0)
{
    static $res = [];

    for ($i = 0; $i < 10; $i++) {
        $t[$i] = [];
    }

    $len = count($arr);
    for ($i = 0; $i < $len; $i++) {
        $a = (string)$arr[$i];

        if (isset($a[$k])) {
            $t[$a[$k]][] = $arr[$i];
        } else {
            $tt[$a[0]][] = $a;
        }

    }
    for ($i = 9; $i >= 0; $i--) {
        if (isset($tt[$i])) {
            $res[] = $tt[$i];
        }
        if (count($t[$i]) == 1) {
            $res[] = $t[$i][0];
        } else if (count($t[$i]) > 1) {
            third($t[$i], $k + 1);
        }
    }

    return $res;
}
echo '<br/>';
print_r(third([9,99,999,8,88,89,845,231]));


function four($active_time, $process_time)
{
    $len = count($active_time);
    $wait_time = 0;
    $wait = [];
    for ($i = 0; $i < $len; $i++) {
        if ($i <= 3) {
            $wait[] = $active_time[$i] + $process_time[$i];
        }

        sort($wait);
        $time = array_shift($wait);

        if ($time < $active_time[$i]) {
            $wait[] = $active_time[$i] + $process_time[$i];
        } else {
            $wait_time += $time - $active_time[$i];
            $wait[] = $active_time[$i] + $wait_time + $process_time[$i];
        }
    }
    return $wait_time / $len;
}
echo '<br/>';
echo four([9.01, 9.10, 9.20, 9.21, 9.22], [0.30, 0.18, 0.22, 0.47, 0.11]);


/**
 * 第五题
 */

class PDO
{
    private static $ins;
    private $pdo;

    private function __construct($attr)
    {
        list($dbname, $host, $user, $pwd) = $attr;

        $this->pdo = new PDO("mysql:dbname=$dbname;host=$host;charset=utf8", $user, $pwd);
    }

    private function __clone()
    {

    }

    public static function connect($attr)
    {
        if (self::$ins instanceof PDO) {
            return self::$ins;
        }

        return self::$ins = new PDO($attr);
    }

    public function create($sql)
    {
        return $this->pdo->exec($sql);
    }

    public function select($sql)
    {
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($sql)
    {
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function del($sql)
    {
        return $this->pdo->exec($sql);
    }

    public function upd($sql)
    {
        return $this->pdo->exec($sql);
    }
}
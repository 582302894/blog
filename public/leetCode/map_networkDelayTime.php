<?php

//leetcode https://leetcode-cn.com/problems/network-delay-time/description/
//743. 网络延迟时间
/*
有 N 个网络节点，标记为 1 到 N。

给定一个列表 times，表示信号经过有向边的传递时间。 times[i] = (u, v, w)，其中 u 是源节点，v 是目标节点， w 是一个信号从源节点传递到目标节点的时间。

现在，我们向当前的节点 K 发送了一个信号。需要多久才能使所有节点都收到信号？如果不能使所有节点收到信号，返回 -1。

注意:

N 的范围在 [1, 100] 之间。
K 的范围在 [1, N] 之间。
times 的长度在 [1, 6000] 之间。
所有的边 times[i] = (u, v, w) 都有 1 <= u, v <= N 且 1 <= w <= 100。
 */

class Solution {

    /**
     * [networkDelayTime description]
     * @param  [type] $times
     * @param  [type] $N
     * @param  [type] $K
     * @return [type]
     */
    public function networkDelayTime($times, $N, $K) {
        $L = count($times);
        for ($i = 1; $i < $N; $i++) {
            $book[$N] = 0;
        }
        $MAX = 100000;
        for ($i = 1; $i <= $N; $i++) {
            $dis[$i] = $MAX;
        }
        $dis[$K] = 0;

        for ($i = 1; $i <= $N; $i++) {
            $lists[$i] = $K;
            $top[$i] = 0;
        }

        for ($i = 2; $i <= $N; $i++) {
            for ($j = 0; $j < $L; $j++) {
                $u = $times[$j][0];
                $v = $times[$j][1];
                $w = $times[$j][2];
                $weight = $w + $dis[$u];
                if ($dis[$v] > $weight) {
                    $dis[$v] = $weight;
                }
            }
        }
        print_r($dis);
    }
}

$times = [
    [2, 1, 7],
    [2, 3, 5],
    [3, 4, 9],
    [4, 2, 1],
    [1, 4, 1],
];
(new Solution)->networkDelayTime($times, 5, 1);
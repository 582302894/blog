<?php

echo gethostname() . "\n\r";

echo ("1+5=" . 5) + 1; // 2
echo ("1+5=" . 1) + 5; // 6
echo ("5+1=" . 5) + 1; // 6
echo ("5+1=" . 1) + 5; // 10
echo "\n";
echo intval("1+5=") . "\n";
echo intval("1+5=") . "\n";
echo intval("5+5=") . "\n";
echo intval("5+5=") . "\n";

// .优先计算了，结果字符串
// 遇到+，尝试转数字类型，转的过程中遇到非数字停止，所以只剩第一个数字+最后一个数字
// 另外 就算这种方式知识了解，实际用的正确，敢写这样代码的早已经被正经公司开除了
// 
// 
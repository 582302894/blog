[https://leetcode-cn.com/problems/reverse-integer/description/](https://leetcode-cn.com/problems/reverse-integer/description/)

给定一个 32 位有符号整数，将整数中的数字进行反转。

你可以假设除了数字 0 之外，这两个数字都不会以零开头。

    输入: 123
    输出: 321

    输入: -123
    输出: -321

    输入: 120
    输出: 21



>java 35ms

```java
class Solution {
    public int reverse(int x) {
        int basic = 1;
        int result = 0;
        int count = 0;
        int temp = 0;
        while (true) {
            if (x == 0 || x == -0) {
                break;
            }
            int lsp = x % 10;
            x = x / 10;
            if (count == 0 && lsp == 0) {
                continue;
            }
            count++;
            temp = result;
            result = result * 10 + lsp;
        }
        if (result / 10 != temp) {
            return 0;
        }
        return result;
    }
}
```


>java 30mx

```java
class Solution {
    public int reverse(int x) {
        long i = 0;
        while (x != 0) {
            i = i * 10 + x % 10;
            x = x / 10;
        }
        if (i > Integer.MAX_VALUE || i < Integer.MIN_VALUE) {
            return 0;
        }
        return (int)i;
    }
}
```

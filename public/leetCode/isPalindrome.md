[https://leetcode-cn.com/problems/palindrome-number/description/](https://leetcode-cn.com/problems/palindrome-number/description/)

判断一个整数是否是回文数。回文数是指正序（从左向右）和倒序（从右向左）读都是一样的整数。

    输入: 121
    输出: true

    输入: -121
    输出: false
    解释: 从左向右读, 为 -121 。 从右向左读, 为 121- 。因此它不是一个回文数。

    输入: 10
    输出: false
    解释: 从右向左读, 为 01 。因此它不是一个回文数。


>java 大佬 最快 110ms

```java

```

>java 126ms

```java
class Solution {
    public boolean isPalindrome(int x) {
        if (x < 0) {
            return false;
        }
        if (x < 10) {
            return true;
        }
        int len = 1;
        while (x / len > 9) {
            len *= 10;
        }
        while (x > 0) {
            int lsp = x % 10;
            int top = x / len;
            if (lsp != top) {
                return false;
            }
            x = (x % len) / 10;
            len /= 100;
        }
        return true;
    }
}
```
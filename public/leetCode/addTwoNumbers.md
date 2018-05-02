[https://leetcode-cn.com/problems/add-two-numbers/description/](https://leetcode-cn.com/problems/add-two-numbers/description/)

给定两个非空链表来表示两个非负整数。位数按照逆序方式存储，它们的每个节点只存储单个数字。将两数相加返回一个新的链表。

你可以假设除了数字 0 之外，这两个数字都不会以零开头。

    输入：(2 -> 4 -> 3) + (5 -> 6 -> 4)
    输出：7 -> 0 -> 8
    原因：342 + 465 = 807


>java 75ms 完成第一版 仅仅是完成

```java
/**
 * Definition for singly-linked list.
 * public class ListNode {
 *     int val;
 *     ListNode next;
 *     ListNode(int x) { val = x; }
 * }
 */
class Solution {
    public ListNode addTwoNumbers(ListNode l1, ListNode l2) {
        int l1Val, l2Val, sum = 0, lsp, count = 0;
        ListNode start = new ListNode(0), temp = new ListNode(0);
        start = temp;
        l1Val = l1.val;
        l2Val = l2.val;
        while (l1.next != null || l2.next != null || sum != 0 || l1Val != 0 || l2Val != 0) {
            System.out.print(l1Val + " " + l2Val);
            if (count != 0) {
                temp.next = new ListNode(0);
                temp = temp.next;
            }
            count++;
            sum = l1Val + l2Val + sum;
            if (sum >= 10) {
                lsp = sum - 10;
                sum = 1;
            } else {
                lsp = sum;
                sum = 0;
            }
            l1Val = 0;
            l2Val = 0;
            temp.val = lsp;
            if (l1.next != null) {
                l1 = l1.next;
                l1Val = l1.val;
            }
            if (l2.next != null) {
                l2 = l2.next;
                l2Val = l2.val;
            }
        }
        return start;
    }
}
```


>java 44ms

```java
class Solution {
    public ListNode addTwoNumbers(ListNode l1, ListNode l2) {
        ListNode start = new ListNode(0), temp = new ListNode(0);
        start = temp;
        int sum = 0;
        while (l1 != null || l2 != null) {
            sum = sum / 10;
            if (l1 != null) {
                sum += l1.val;
                l1 = l1.next;
            }
            if (l2 != null) {
                sum += l2.val;
                l2 = l2.next;
            }
            temp.next = new ListNode(sum % 10);
            temp = temp.next;
        }
        if (sum >= 10) {
            temp.next = new ListNode(1);
        }
        // show(start.next);
        return start.next;
    }
}
```


>java 大佬 33ms  

```java
class Solution {
    public ListNode addTwoNumbers(ListNode l1, ListNode l2) {
        int needadd = 0; //储存是否进位
        ListNode l3 = null;//返回的目标链表
        ListNode tail = null; //指向l3尾部的节点
        while(l1!=null || l2!=null || needadd !=0){
            int a = 0;//记录l1的val
            int b = 0; //记录l2的val
            //如果l1没有数据了，a设为0
            if(l1==null)
                a = 0;
            else
                a=l1.val;
            //如果l2没有数据了，b设为0
            if(l2==null)
                b=0;
            else
                b=l2.val;
            int sum = a+b+needadd; //目标val
            ListNode tmpl = new ListNode(sum%10);
            
            if(l3==null){
                l3 = tmpl;
                tail =l3;
            }
            else{
                while(tail.next!=null){
                    tail = tail.next;
                }
                tail.next = tmpl;
            }
            if(l1!=null)
            l1=l1.next;
            if(l2!=null)
            l2=l2.next;
            needadd = sum/10;
            
        }
        
        return l3;
    }
}
```

>java 小结
    链表操作



```java
public ListNode addTwoNumbers(ListNode l1, ListNode l2) {
    ListNode start = null, temp = null;
    int sum = 0;
    while (l1 != null || l2 != null) {
        sum = sum / 10;
        int a = 0, b = 0;
        if (l1 != null) {
            a = l1.val;
            l1 = l1.next;
        }
        if (l2 != null) {
            b = l2.val;
            l2 = l2.next;
        }
        sum = a + b + sum;
        if (start == null) {
            temp = new ListNode(sum % 10);
            start = temp;
        } else {
            temp.next = new ListNode(sum % 10);
            temp = temp.next;
        }
    }
    if (sum >= 10) {
        temp.next = new ListNode(1);
    }
    //show(start);
    return start;
}
```
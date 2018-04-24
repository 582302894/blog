[https://leetcode-cn.com/problems/two-sum/description/](https://leetcode-cn.com/problems/two-sum/description/)

给定一个整数数组和一个目标值，找出数组中和为目标值的两个数。
你可以假设每个输入只对应一种答案，且同样的元素不能被重复利用。

    给定 nums = [2, 7, 11, 15], target = 9
    因为 nums[0] + nums[1] = 2 + 7 = 9
    所以返回 [0, 1]


>java 42ms

```java
class Solution {
   public int[] twoSum(int[] nums, int target) {
        int j=0,i=0;
        int length=nums.length;
        for(i=0;i<length;i++){
            for(j=i+1;j<length;j++){
                if((nums[i]+nums[j])==target){
                    return new int[]{i,j};
                }
            }
        } 
        return null;
    }
}
```


>java 15ms

```java
class Solution {
    public int[] twoSum(int[] nums, int target) {
        int j = 0, i = 0;
        int length = nums.length;
        int[] map = new int[length];
        int temp = 0;
        for (i = 0; i < length; i++) {
            temp = target - nums[i];
            for (j = 0; j < i; j++) {
                if (temp == map[j]) {
                    return new int[] {
                               j,
                               i
                           };
                }
            }
            map[i] = nums[i];
        }
        return null;
    }
}
```


>java 3ms的大佬  修改数组值的偏移量

```java
class Solution {
    public int[] twoSum(int[] nums, int target) {
        int numMin = Integer.MAX_VALUE;
        int numMax = Integer.MIN_VALUE;
        for (int num : nums) {
            if (num < numMin) {
                numMin = num;
            }
            if (num > numMax) {
                numMax = num;
            }
        }
        int max = target - numMin;
        int min = target - numMax;
        int targetMax = max > numMax ? numMax : max;
        int targetMin = min < numMin ? numMin : min;
        int[] numIndices = new int[targetMax - targetMin + 1];
        for (int i = 0; i <= numIndices.length - 1; i++) {
            numIndices[i] = -1;
        }
        for (int i = 0; i <= nums.length - 1; i++) {
            if (nums[i] >= targetMin && nums[i] <= targetMax) {
                int offset = -targetMin;
                if (numIndices[(target - nums[i]) + offset] != -1) {
                    return new int[] {
                               numIndices[(target - nums[i]) + offset], i
                           };
                } else {
                    numIndices[nums[i] + offset] = i;
                }
            }
        }
        return new int[] {
                   0,
                   0
               };
    }
}
```

>java 模仿大佬 5ms
    构建最大数与最小数的可能长度区间 
    a=[1,3,6,12] target=9 
    长度区间 最小为 Max(Min(a),target-Max(a))=Max(1,-3)=1
    长度区间 最大为 Min(Max(a),target-Min(a))=Max(12,8)=8
    长度区间为1-8，排除任何不在1-8内的值12
    将1,3,6偏移值新的数字段0开始，即临时数组空间从0开始，0,2,5=>0,1,2 对应1,3,6在原数组中的位置
    将0,2,5与目标值运算得出对应的8,6,3同时偏移长度区间最小值1得7,5,2
    2与5对应，5与2对应找到两个数



```java
class Solution {
    public int[] twoSum(int[] nums, int target) {
        int j = 0, i = 0;
        int length = nums.length;
        int targetMax = Integer.MIN_VALUE, targetMin = Integer.MAX_VALUE;
        for (i = 0; i < length; i++) {
            if (nums[i] > targetMax) {
                targetMax = nums[i];
            }
            if (nums[i] < targetMin) {
                targetMin = nums[i];
            }
        }
        int max = target - targetMin;
        int min = target - targetMax;
        targetMax = targetMax > max ? max : targetMax;
        targetMin = targetMin < min ? min : targetMin;
        int[] map = new int[targetMax - targetMin + 1];
        for (i = 0; i < map.length; i++) {
            map[i] = -1;
        }
        for (i = 0; i < length; i++) {
            if (nums[i] >= targetMin && nums[i] <= targetMax) {
                if (map[target - nums[i] - targetMin] != -1) {
                    return new int[] {
                               map[target - nums[i] - targetMin],
                               i
                           };
                }
                map[nums[i] - targetMin] = i;
            }
        }
        return new int[] {
                   0,
                   0
               };
    }
}
```
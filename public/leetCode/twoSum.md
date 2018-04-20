[link](https://leetcode-cn.com/problems/two-sum/description/)

给定一个整数数组和一个目标值，找出数组中和为目标值的两个数。
你可以假设每个输入只对应一种答案，且同样的元素不能被重复利用。

    给定 nums = [2, 7, 11, 15], target = 9
    因为 nums[0] + nums[1] = 2 + 7 = 9
    所以返回 [0, 1]


>java

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
42ms
>java

```java
class Solution {
   public int[] twoSum(int[] nums, int target) {
        int j=0,i=0;
        int length=nums.length;
        for(i=0;i<length;i++){
            if(target>=0){

            }else{

            }
        } 
        return null;
    }
}
```
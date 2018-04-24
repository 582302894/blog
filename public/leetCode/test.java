/**
 *
 */
class Test {
    public static void main(String args[]) {
        int[] a = new int[] {
            1,
            3,
            6,
            12
        };
        Solution obj = new Solution();
        obj.twoSum(a, 9);
    }
}
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
/**
 *
 *
 *
 *
 *
 *
 *
 */
class Solution {
    public int[] twoSum(int[] nums, int target) {
        int j = 0, i = 0;
        int length = nums.length;
        for (i = length - 1; i > 0; i--) {
            if (nums[i] > target) {
                continue;
            }
            if (target >= 0) {
                for (j = i - 1; j >= 0; j--) {
                    if (nums[j] > target) {
                        continue;
                    }
                    if ((nums[i] + nums[j]) == target) {
                        return new int[] {
                                   i,
                                   j
                               };
                    }
                }
            } else {
                for (j = i - 1; j >= 0; j--) {
                    if (nums[j] > target) {
                        continue;
                    }
                    if ((nums[i] + nums[j]) == target) {
                        return new int[] {
                                   i,
                                   j
                               };
                    }
                }
            }
        }
        return null;
    }
}
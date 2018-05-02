
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
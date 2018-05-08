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
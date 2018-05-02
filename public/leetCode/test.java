/**
 * Definition for singly-linked list.
 * public class ListNode {
 *     int val;
 *     ListNode next;
 *     ListNode(int x) { val = x; }
 * }
 */
class Test {
	public static void main(String argv[]) {
		ListNode l1 = new ListNode(0), l2 = new ListNode(0), l1Start, l2Start;
		l1Start = l1;
		l2Start = l2;
		// int[] a1 = new int[] {
		//     2,
		//     4,
		//     3
		// };
		// int[] a2 = new int[] {
		//     5,
		//     6,
		//     4
		// };
		int[] a1 = new int[] {
		    9,
		    9
		};
		int[] a2 = new int[] {
		    1
		};
		// int[] a1 = new int[] {
		//     1, 6, 0, 3, 3, 6, 7, 2, 0, 1
		// };
		// int[] a2 = new int[] {
		//     6, 3, 0, 8, 9, 6, 6, 9, 6, 1
		// };
		for (int i = 0; i < a1.length; i++) {
			l1.val = a1[i];
			if (i != (a1.length - 1)) {
				l1.next = new ListNode(0);
				l1 = l1.next;
			}
		}
		for (int i = 0; i < a2.length; i++) {
			l2.val = a2[i];
			if (i != (a2.length - 1)) {
				l2.next = new ListNode(0);
				l2 = l2.next;
			}
		}
		Solution obj = new Solution();
		obj.addTwoNumbers(l1Start, l2Start);
	}
}
class ListNode {
	int val;
	ListNode next;
	ListNode(int x) {
		val = x;
	}
}
class Solution {
	public void show(ListNode l) {
		while (l != null) {
			System.out.print(l.val + "\t");
			l = l.next;
		}
		System.out.print("\n");
	}
	public void showArray(int[] a) {
		for (int i = 0; i < a.length; i++) {
			System.out.print(a[i] + "\t");
		}
		System.out.print("\n");
	}
	public ListNode addTwoNumbers(ListNode l1, ListNode l2) {
		ListNode start = null, end = null;
		int sum = 0;
		while (l1 != null || l2 != null || sum > 9) {
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
			ListNode temp = new ListNode(sum % 10);
			if (start == null) {
				start = temp;
				end = start;
			} else {
				if (end.next != null) {
					end = end.next;
				}
				end.next = temp;
			}
		}
		return start;
	}
}
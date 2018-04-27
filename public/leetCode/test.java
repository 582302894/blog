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
		    1,
		    8
		};
		int[] a2 = new int[] {
		    0
		};
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
		obj.show(l1Start);
		obj.show(l2Start);
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
		int L1Deep = 0, L2Deep = 0;
		ListNode temp;
		temp = l1;
		while (temp != null) {
			L1Deep++;
			temp = temp.next;
		}
		temp = l2;
		while (temp != null) {
			L2Deep++;
			temp = temp.next;
		}
		int deep = L1Deep > L2Deep ? L1Deep + 1 : L2Deep + 1;
		int[] l1Array = new int[deep];
		int[] l2Array = new int[deep];
		temp = l1;
		int i;
		for (i = 0; i < deep; i++) {
			l1Array[i] = 0;
			l2Array[i] = 0;
		}
		i = 0;
		while (temp != null) {
			l1Array[deep - i - 2] = temp.val;
			i++;
			temp = temp.next;
		}
		temp = l2;
		i = 0;
		while (temp != null) {
			l2Array[deep - i - 2] = temp.val;
			i++;
			temp = temp.next;
		}
		int j, sum = 0, lsp = 0;
		ListNode res = new ListNode(0), start = new ListNode(0);
		start = res;
		ListNode[] resArray = new ListNode[deep];
		for (j = 0; j < deep; j++) {
			sum = l1Array[j] + l2Array[j] + sum;
			lsp = sum % 10;
			System.out.println(lsp);
			resArray[j] = new ListNode(lsp);
			if (sum >= 10) {
				sum = 1;
			} else {
				sum = 0;
			}
		}
		for (int k = 1; k < resArray.length; k++) {
			if (k == (resArray.length - 1) && resArray[k].val == 0) {
				break;
			}
			resArray[k - 1].next = resArray[k];
		}
		return resArray[0];
	}
}
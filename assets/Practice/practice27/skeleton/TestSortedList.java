// Program to add names into a sorted list.
// You are not to modify this class.

import java.util.*;

public class TestSortedList implements Comparable <String> {
	public static void main(String[] args) 
	                       throws NoSuchElementException {
		MySortedLinkedList <String> names = new MySortedLinkedList <String>();

		readNames(names);
		System.out.println("List: ");
		System.out.println(names); 
	}

	// Override compareTo() 
	public int compareTo(String that) {
		return this.compareTo(that);
	}

	// To read integers and add them into the sorted linked list,
	// maintaining the order at all time.
	public static void readNames(MySortedLinkedList <String> list) {
		Scanner sc = new Scanner(System.in);

		// Assume that numOfNames >= 0
		int numOfNames = sc.nextInt();
		for (int i=0; i<numOfNames; i++) {
			list.addOrdered(sc.next());
			// System.out.println(list); // for testing
		}
	}
	
}


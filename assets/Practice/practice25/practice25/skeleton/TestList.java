// Program to test the reversal of a linked list.

import java.util.*;

public class TestList {
	public static void main(String [] args) 
	                       throws NoSuchElementException {
		MyLinkedList <String> names = new MyLinkedList <String>();

		readNames(names);
		System.out.println("Original list: ");
		System.out.println(names); 

		names.reverse();
		System.out.println("After reversal: ");
		System.out.println(names); 

	}

	// To read in the names (single words) into the linked list
	public static void readNames(MyLinkedList <String> list) {

		Scanner sc = new Scanner(System.in);

		// Assume that numOfNames >= 0
		int numOfNames = sc.nextInt();
		for (int i=0; i<numOfNames; i++) {
			list.addFirst(sc.next());
		}
	}
}


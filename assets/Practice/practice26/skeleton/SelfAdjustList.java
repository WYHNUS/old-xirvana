// Read names into a self-adjusting list.
// In a search operation, whenever a name is found, it is moved
// to the front of the list.
// You are not to modify this program.

import java.util.*;

public class SelfAdjustList {
	public static void main(String[] args) 
	                       throws NoSuchElementException {
		MyLinkedList <String> names = new MyLinkedList <String>();
		Scanner sc = new Scanner(System.in);

		readNames(sc, names);
		System.out.println("Original list: ");
		System.out.println(names); 

		double aveProbes = searchOperations(sc, names);
		System.out.printf("Average number of probes = %.2f\n", aveProbes);

		System.out.println("Final list: ");
		System.out.println(names); 
	}

	// To read in integers into the linked list 
	public static void readNames(Scanner sc, MyLinkedList <String> list) {

		// Assume that numOfNames > 0
		int numOfNames = sc.nextInt();
		for (int i=0; i<numOfNames; i++) {
			list.addFirst(sc.next());
		}
	}
	
	// To read in a number of search queries 
	// and compute the average number of probes required.
	public static double searchOperations(Scanner sc, MyLinkedList <String> list) {
		int numOfSearch = sc.nextInt(); // assume numOfSearch > 0
		int totalProbes = 0;
		String name;

		for (int i=0; i<numOfSearch; i++) {
			totalProbes += list.search(sc.next());
		}
		return (double) totalProbes/numOfSearch;
	}

}


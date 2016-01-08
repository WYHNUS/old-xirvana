// This program processes a list of "add" and "query" operations
// on a stack:
//    Add <a list of integers>: to push integers into stack
//    Query <a list of integers>: to check if integers are present
//                                in stack by popping elements

import java.util.*;

public class StackExercise {
	public static void main(String [] args) throws NoSuchElementException {

		StackLL <Integer> stack = new StackLL <Integer> ();
		Scanner sc = new Scanner(System.in);
		String op;

		while (sc.hasNext()) {
			op = sc.next();

			if (op.equals("Add")) {
				// Fill in the code 


			}

			else if (op.equals("Query")) {
				// Fill in the code 


			}
		}
	}

	// You may write additional method(s) to make your program more modular

}


// This program processes a list of "add" and "query" operations
// on a queue:
//    Add <a list of integers>: to enqueue integers into queue
//    Query <a list of integers>: to check if integers are present
//                                in queue by dequeueing elements
import java.util.*;
import java.util.*;

public class QueueExercise {
	public static void main(String [] args) throws NoSuchElementException {

		QueueLL <Integer> queue = new QueueLL <Integer> ();
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


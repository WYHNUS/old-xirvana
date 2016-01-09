// This program computes the mean and standard deviation
// of an array of values.

// Add import statement(s) below

public class Statistics {

	public static void main(String[] args) {

		// Fill in the code

		int[] arr = readArray();

		// For checking; remove the following 2 lines before submission
		System.out.print("Values: ");
		printArray(arr);

		System.out.println("Mean = ");
		System.out.println("Standard deviation = ");
	}

	// Read a list of values into an array arr
	public static int[] readArray() {
		// Fill in the code

		System.out.print("Enter size of array: ");

	}

	// Compute mean of the values in arr
	// Precond: arr.length > 0
	public static double computeMean(int[] arr) {
		// Fill in the code

	}

	// Compute standard deviation of the values in arr
	// Precond: arr.length > 0
	public static double computeStdDev(int[] arr) {
		// Fill in the code

	}

	// Print the array arr on a single line.
	// Note that the last element has a space after it.
	public static void printArray(int[] arr) {
		for (int element: arr) {
			System.out.print(element + " ");
		}
		System.out.println();
	}
} 


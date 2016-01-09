// RowColSums.java
// To compute the row and column sums of a 2D array.
import java.util.*;

public class RowColSums {

	public static void main(String[] args) {

		// code to read values into 2D array called 'array2D'


		int[] rowSums = computeRowSums(array2D);
		System.out.print("Row sums: ");
		System.out.println(Arrays.toString(rowSums));

		int[] colSums = computeColSums(array2D);
		System.out.print("Column sums: ");
		System.out.println(Arrays.toString(colSums));
	}

}

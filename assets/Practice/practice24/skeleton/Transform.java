// This program reads in a square matrix and a list of operations 
// involving rotation and reflection. It performs the said 
// operations and prints the final state of the matrix.
// This class is given and should not be modified.

import java.util.*;

public class Transform {

	public static void main(String[] args) {

		Scanner sc = new Scanner(System.in);
		int size = sc.nextInt();
		Matrix result = new Matrix(size);

		for (int r = 0; r < size; r++) {
			for (int c = 0; c < size; c++) {
				result.matrix[r][c] = sc.nextInt();
			}
		}

		int operations = sc.nextInt();
		for (int i = 0; i < operations; i++) {
			result.operate(sc.next(), sc.next());
		}

		System.out.print(result);
	}
}


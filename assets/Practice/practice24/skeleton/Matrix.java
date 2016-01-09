// This class defines a square matrix and provides the
// following methods:
//  - operate(operation, type): to perform the respective operation
//  - rotate(deg): to rotate the matrix clockwise 
//  - reflectX() : to reflect the matrix across the x-axis
//  - reflectY() : to reflect the matrix across the y-axis
//  - toString() : to return String representation of the matrix
// You are not to add other methods to this class.

class Matrix {
	// Data attributes
	int size;
	int matrix[][];

	// Constructors
	// Default constructor creates a 1x1 matrix
	public Matrix() {
		// Fill in the code; you should use 'this'

	}

	// To construct a size x size matrix
	public Matrix(int size) {
		// Fill in the code


	}

	// Perform operation
	//  - operation refers to "Rotate" or "Reflect" 
	//  - type refers to "x" or "y"
	public void operate(String operation, String type) {
		// Fill in the code


	}

	// Rotate the matrix by 'degree' clockwise
	// Note that this is a private method
	private void rotate(int degree) {
		// Fill in the code


	}

	// Reflect the matrix across x-axis
	// Note that this is a private method
	private void reflectX() {
		// Fill in the code


	}

	// Reflect the matrix across y-axis
	// Note that this is a private method
	private void reflectY() {
		// Fill in the code


	}

	// String representation of matric
	public String toString() {
		String output = "";

		for (int r = 0; r < size; r++) {
			for (int c = 0; c < size; c++) {
				if (c > 0)
					output += " ";
				output += matrix[r][c];
			}
			output += "\n";
		}
		return output;
	}
}


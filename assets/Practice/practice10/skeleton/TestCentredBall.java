// To test out CentredBall class 

// Add import statement(s) below

public class TestCentredBall {

	// This method reads ball's input data from user, creates
	// a ball object, and returns it to the caller.
	public static CentredBall readBall(Scanner sc) {

		System.out.print("Enter colour, radius and centre: ");
		String inputColour = sc.next();
		double inputRadius = sc.nextDouble();

		// Fill in the code

	}

	public static void main(String[] args) {
		Scanner scanner = new Scanner(System.in);

		// Read input and create 1st ball object
		System.out.println("1st ball");
		CentredBall b1 = readBall(scanner);

		// Read input and create 2nd ball object
		System.out.println("2nd ball");
		CentredBall b2 = readBall(scanner);

		// Read input and create 3rd ball object
		System.out.println("3rd ball");
		CentredBall b3 = readBall(scanner);

		System.out.println();

	}
}


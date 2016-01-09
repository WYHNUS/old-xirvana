// This program reads in a number of rectangles and compute the
// overlap of all rectangles.
// This program uses the MyRect class.

// Add import statements below


public class OverlapRectanglesV3 {

	public static void main(String[] args) {
		Scanner sc = new Scanner(System.in);
		MyRect rect1, rect2;

		System.out.print("How many rectangles? ");
		int numRect = sc.nextInt();

		System.out.print("Enter 2 opposite vertices of first rectangle: ");
		rect1 = readRectangle(sc);
		arrangeVertices(rect1);

		for (int i=2; i<=numRect; i++) {
			System.out.print("Enter 2 opposite vertices of next rectangle: ");
			rect2 = readRectangle(sc);
			arrangeVertices(rect2);
			rect1 = overlap(rect1, rect2);
		}

		int overlapArea = area(rect1);
		if (overlapArea == 0)
			System.out.println("No overlap");
		else {
			System.out.println("Overlap rectangle: " + rect1);
			System.out.println("Overlap area = " + overlapArea);
		}
	}

	// Read data of a rectangle, create a rectangle object
	// and return it.
	public static MyRect readRectangle(Scanner sc) {
		Point vertex1 = new Point(sc.nextInt(), sc.nextInt());
		Point vertex2 = new Point(sc.nextInt(), sc.nextInt());
		return new MyRect(vertex1, vertex2);
	}

	// To rearrange the 2 opposite vertices of rect
	// such that the first vertex v1 becomes the bottom-left vertex
	// and the second vertex v2 becomes the top-right vertex.
	public static void arrangeVertices(MyRect rect) {
		// Fill in the code


	}

	// To compute the overlap rectangle of rect1 and rect2
	public static MyRect overlap(MyRect rect1, MyRect rect2) {
		// Fill in the code


	}

	// To compute the area of rect
	public static int area(MyRect rect) {
		// Fill in the code


	}

}


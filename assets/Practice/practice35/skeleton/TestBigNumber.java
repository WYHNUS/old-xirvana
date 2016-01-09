import java.util.*;

class Digit {

	// Data attributes
	private int digit;
	private Digit next;

	// Constructors
	// This default constructor has an empty body
	public Digit() {
	}

	public Digit(int digit, Digit next) {
		this.digit = digit;
		this.next = next;
	}

	// Accessors
	public int getDigit() {
		return digit;
	}

	public Digit getNext() {
		return next;
	}

	public void setDigit(int digit) {
		this.digit = digit;
	}

	public void setNext(Digit next) {
		this.next = next;
	}
}

// Added the tail attribute and updated the methods accordingly
// Added a recursive version of sum
class BigNumber {
	private Digit head = null;
	private Digit tail = null;
	private int length = 0;

	// Constructors
	// This default constructor has an empty body
	public BigNumber() {

	}

	// Build a linked list of digits
	public BigNumber(String number) {
		// Fill in

	}

	public Digit getHead() {
		return head;
	}

	public int getLength() {
		return length;
	}

	// Append a digit to the linked list
	public void add(int digit) {
		// Fill in 

	}

	public Digit getTail() {
		return tail;
	}

	// Sum two big numbers recursively and return its sum
	public static String sum_recursive(BigNumber n1, BigNumber n2) {
		// Fill in 

	}

	public String toString() {
		// Fill in

	}
}

public class TestBigNumber {

	public static void main(String[] args) {
		// Declare a Scanner object to read input

		// Declare the necessary variables

		// Read input and process them accordingly

		// Output the result
		// Ensure your output is in the right format

	}
}

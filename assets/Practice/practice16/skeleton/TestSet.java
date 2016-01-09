// This program reads two sets of integers A and B, and determines
// if A is a subset of B, and if A is same as B.

import java.util.Scanner;
import java.util.ArrayList;

public class TestSet {

	public static void main(String[] args) {
		Scanner sc = new Scanner(System.in);
		ArrayList<Integer> list;

		System.out.print("Enter number of elements in set A: ");

		System.out.print("Enter number of elements in set B: ");

		if (setA.isSubset(setB)) {
			System.out.println("Set A is a subset of set B.");
		}
		else {
			System.out.println("Set A is not a subset of set B.");
		}
	}

} 


// This program computes the furthest distance (number of road units)
// a jogger can run from PGP and back. Road is divided into units,
// each unit is uphill, flat or downhill with an associated time.

import java.util.*;

import java.util.*;

public class Jogging {
	public static final int UP = 0;
	public static final int FLAT = 1;
	public static final int DOWN = 2;

	public static void main(String[] args) {

		// Read input data
		Scanner sc = new Scanner(System.in);
		int timeLimit = sc.nextInt();
		int roadUnits = sc.nextInt();
		int[] ufdTimes = new int[3]; // store times for uphill, flat, downhill
		ufdTimes[UP] = sc.nextInt();
		ufdTimes[FLAT] = sc.nextInt();
		ufdTimes[DOWN] = sc.nextInt();

		String roadData = sc.next();

	}

	// Recursion to compute the number of road units he can run and
	// get back to PGP on time.

}


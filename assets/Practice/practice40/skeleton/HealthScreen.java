import java.util.*;

// This program reads a list of health scores and frequencies
// and determine the number of unique readings

public class HealthScreen {

	public static void main(String[] args) {
		Scanner sc = new Scanner(System.in);

		int n = sc.nextInt(); // number of readings
		Reading[] readings = new Reading[n];

		for (int i=0; i<n; i++) {
			readings[i] = new Reading(sc.nextDouble(), sc.nextInt());
		}

		// Sort readings array by scores
		ScoreComparator scoreComp = new ScoreComparator();
		Arrays.sort(readings, scoreComp);

		System.out.println("Number of unique readings = " + unique(readings));
	}

	public static int unique(Reading[] readings) {
		// fill in the code

	}
}


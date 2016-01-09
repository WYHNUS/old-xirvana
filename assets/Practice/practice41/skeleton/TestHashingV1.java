// This program sets up a hash table and uses linear probing
// for collision resolution.
import java.util.*;

public class TestHashingV1 {

	public static void main(String[] args) {
		Scanner sc = new Scanner(System.in);
		Hashing hashing = new Hashing();

		int n = sc.nextInt(); // n = number of elements
		int key, collisions, totalCollisions = 0;
		String text;
		for (int i=0; i<n; i++) {
			key = sc.nextInt();
			text = sc.next();
			collisions = hashing.hashLinearProbe(key, text);
			if (collisions == -1) {
				System.out.println("Fail to hash key = " + key);
			}
			else {
				totalCollisions += collisions;
				System.out.println("Number of collisions = " + collisions);
				System.out.println("Hash table:");
				System.out.println(hashing);
			}
		}
		System.out.println("Total collisions = " + totalCollisions);
	}

}


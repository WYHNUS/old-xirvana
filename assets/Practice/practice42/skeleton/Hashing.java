// This class implements hashing with linear probing
// for collision resolution.
// Double hashing to be completed.
class Hashing {

	private static int tableSize = 31;
	private TableEntry[] hashTable;

	public Hashing() {
		hashTable = new TableEntry[tableSize];
		for (int i=0; i<tableSize; i++)
			hashTable[i] = new TableEntry();
	}

	// This method performs linear probe, and returns
	// the number of collisions.
	public int hashLinearProbe(int key, String text) {
		int index = hash(key);

		System.out.println("key " + key + " hashed to " + index);

		// Linear probe to find first empty slot
		int collisions = 0;
		int i = 1;
		int originalIndex = index; // remember original hash position
		while (!hashTable[index].getIsEmpty()) {
			collisions++;
			index = (hash(key) + i) % tableSize;
			i++;
			if (index == originalIndex)
				return -1; // unsuccessful
		}

		// insert into hashTable
		hashTable[index].setKey(key);
		hashTable[index].setText(text);
		hashTable[index].setIsEmpty(false);
		return collisions; 
	}

	// This method performs double hashing, and returns
	// the number of collisions.
	public int doubleHashing(int key, String text) {
		// fill in the code

		return 123;
	}

	public int hash(int key) {
		return key % tableSize;
	}

	// Secondary hash function for double hashing
	public int hash2(int key) {
		return 23 - (key % 23);
	}

	public String toString() {
		String str = "";

		for (int i=0; i<tableSize; i++) {
			if (!hashTable[i].getIsEmpty()) {
				str += i + ": " + hashTable[i].getKey() + ", " + hashTable[i].getText() + "\n";
			}
		}
		return str;
	}
}


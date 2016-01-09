// Service class for FindPair
class Pair <T> {
	private T first, second;

	public Pair(T a, T b) {
		this.first = a;
		this.second = b;
	}

	public T getFirst() {
		return this.first;
	}

	public T getSecond() {
		return this.second;
	}
}

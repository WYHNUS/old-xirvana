// This class defines the element in a hash table
class TableEntry {

	private int key;
	private String text;
	private boolean isEmpty;

	public TableEntry() {
		this(0, new String(), true);
	}

	public TableEntry(int key, String text, boolean isEmpty) {
		this.key = key;
		this.text = text;
		this.isEmpty = isEmpty;
	}

	public int getKey() {
		return key;
	}

	public String getText() {
		return text;
	}

	public boolean getIsEmpty() {
		return isEmpty;
	}

	public void setKey(int key) {
		this.key = key;
	}

	public void setText(String text) {
		this.text = text;
	}

	public void setIsEmpty(boolean isEmpty) {
		this.isEmpty = isEmpty;
	}
}


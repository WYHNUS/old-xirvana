class Reading {
	// Attributes
	private double score;
	private int freq;

	public Reading(double score, int freq) {
		this.score = score;
		this.freq = freq;
	}

	public void setScore(double score) {
		this.score = score;
	}

	public void setFreq(int freq) {
		this.freq = freq;
	}

	public double getScore() {
		return score;
	}

	public int getFreq() {
		return freq;
	}

	public String toString() {
		return "(" + score + ";" + freq + ")";
	}
}


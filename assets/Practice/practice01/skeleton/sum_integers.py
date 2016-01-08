# sum_integers.py
# This program computes sum of positive integers up to n

import sys

# main function
def main():
	n = int(raw_input("Enter n: "))
	count = 1
	ans = 0

	while count <= n:
		ans += count
		count += 1

	print "Sum = %d" % ans

# Runs the main method
if __name__ == "__main__":
	main()
	sys.exit(0)

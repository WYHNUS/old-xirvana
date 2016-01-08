# mile_to_km.py
# Converts distance in miles to kilometers.

import sys

# main function
def main():
	KMS_PER_MILE = 1.609
	miles = float(raw_input("Enter distance in miles: "))
	kms = KMS_PER_MILE * miles

	print "That equals %9.2f km." % kms

# Runs the main method
if __name__ == "__main__":
	main()
	sys.exit(0)


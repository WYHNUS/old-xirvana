# washers_v2.py
# Compute total weight of a batch of washers

import sys, math
PI = 3.14159

# main function
def main():
	d1 = float(raw_input("Inner diameter in cm: "))
	d2 = float(raw_input("Outer diameter in cm: "))
	thickness = float(raw_input("Thickness in cm: "))
	density = float(raw_input("Density in grams per cubic cm: "))
	qty = int(raw_input("Quantity: "))

	# compute weight of a single washer
	rim_area = circle_area(d2) - circle_area(d1)
	unit_weight = rim_area * thickness * density

	# compute weight of a batch of washers
	total_weight = unit_weight * qty

	print "Total weight of %d washers is %.2f grams." % (qty, total_weight)

# Compute area of a circle given its diameter
def circle_area(diameter):
	return pow(diameter/2, 2) * PI

# Runs the main method
if __name__ == "__main__":
	main()
	sys.exit(0)


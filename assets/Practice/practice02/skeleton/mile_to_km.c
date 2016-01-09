// Converts distance in miles to kilometers.
#include <stdio.h>
#define KMS_PER_MILE 1.609

int main(void) {
	double miles, kms;

	printf("Enter distance in miles: ");
	scanf("%lf", &miles);

	kms = KMS_PER_MILE * miles;
	printf("That equals %9.2f km.\n", kms);

	return 0;
}


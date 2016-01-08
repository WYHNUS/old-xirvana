// sum_integers.c
// This program computes sum of positive integers up to n
#include <stdio.h>

int main(void) {
	int n; // upper limit, a positive integer
	int count=1, ans=0; // initialisation

	printf("Enter n: ");
	scanf("%d", &n);

	while (count <= n) {
		ans += count;
		count++;
	}
	printf("Sum = %d\n", ans);

	return 0;
}


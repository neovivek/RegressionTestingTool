#include <bits/stdc++.h>
using namespace std;

int main(){
	int t, n, i;
	scanf("%d",&t);
	while(t--){
		scanf("%d",&n);
		int a[n];
		for (i = 0; i < n; ++i){
			scanf("%d",&a[i]);
		}
		sort(a, a+n);
		int count = 1, max = 1;
		for (i = 0; i < n; ++i){
			if(a[i]==a[i+1]){
				count++;
			}
			else{
				if(count>max){
					max = count;
				}
				count = 1;
			}
		}
		printf("%d\n", n-max);
	}
	return 0;
}

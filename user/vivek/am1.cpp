#include <bits/stdc++.h>
using namespace std;

int main()
{
	int t, n, p;
	int count, temp;
	scanf("%d",&t);
	while(t--)
	{
		count=0;
		scanf("%d%d",&n,&p);
		while(n--)
		{
			scanf("%d",&temp);
			if(temp>=p)
				count++;
		}
		printf("%d\n",count);
	}
	return 0;
}
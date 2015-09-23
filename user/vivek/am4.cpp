#include <bits/stdc++.h>
using namespace std;


int main()
{
	int t, m, n, i, j, k;
	scanf("%d",&t);
	while(t--)
	{
		scanf("%d%d",&m,&n);
		int x[m][n];
		int sumx=0, sumy=0;
		for (i = 0; i < m; ++i)
		{
			for (j = 0; j < n; ++j)
			{
				scanf("%d",&x[i][j]);
			}
		}
		int z ;
		if(m<n)
			z=m;
		else
			z=n;
		long long max=-1000000009;
		for(i=0 ;i<m-1; i++)
		{
			for(j=0 ;j<n-1 ;j++)
			{
				for(k=i+1 ;k<z && j+k-i< z;k++)
				{
					sumx = sumy =0;
					int p=i, q=j;
					while(p <= k)
						sumx += x[p++][q++];
					p=i; q=k-i+j;
					while(p <= k)
						sumy += x[p++][q--];
					int temp = sumx + sumy;
					if((k-i)%2 == 0)
						temp -= x[i + (k-i)/2][j +(k-i)/2];
					if(temp > max)
						max = temp;
				}
			}
		}
		printf("%lld\n",max);

	}
	return 0;
}
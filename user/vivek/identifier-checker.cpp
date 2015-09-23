#include <bits/stdc++.h>
using namespace std;

int main()
{
	char a[520];
	int j,n,u=0,c=0,i=0,start=0;
	cout<<"Enter data to be checked"<<endl;
	cin>>a;
	for(j=0;j<strlen(a) && a[j]!='=';j++)
	{
		if(i==0 && start==0)
		{
			if(a[j]=='_'||(a[j]>='a'&&a[j]<='z')||(a[j]>='A'&a[j]<='Z'))
				start++;
			else
			{
				printf("Error identifier\n");
				start=-1;
				break;
			}
		}
		else if(a[j]=='_'||(a[j]>='a'&&a[j]<='z')||(a[j]>='A'&a[j]<='Z')||(a[j]>='0'&&a[j]<='9'))
			start++;
	}
	if(start!=-1 && j==strlen(a))
		printf("Identifier Found\n");
	return 0;
}
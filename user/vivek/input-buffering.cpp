#include <bits/stdc++.h>

int main()
{
	FILE *fp;
	char buffer[74],ch;
	int i,j;
	fp=fopen("array.cpp","r");
	memset(buffer,0,sizeof(char));
	ch=fgetc(fp);
	i=0;
	while(ch!=EOF)
	{
		buffer[i]=ch;
		i++;
		if(i==36)
		{
			for(j=0;j<36;j++)
				printf("%c",buffer[j]);
			printf("\nBuffer 1 Full\n");
			i++;
		}
		else if (i==73)
		{
			for(j=37;j<73;j++)
				printf("%c",buffer[j]);
			printf("\nBuffer 2 Full\n");
			i=0;
		}
		ch=fgetc(fp);
	}
	if(i<36)
	{
		for(j=0;j<i;j++)
			printf("%c",buffer[j]);
	}
	else
	{
		for (j = 0; j < i; j++)
		{
			printf("%c",buffer[i]);
		}
	}
	return 0;
}
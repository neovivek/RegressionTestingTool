#include<bits/stdc++.h>
using namespace std;

int ghost(int index){
	if(index == 0) {
		return 0;
	}
	if(index&1) {
		ghost(index-1);
	}
	else {
		ghost(index/2);
	}
	return 1;
}
int main()
{

int a=0,b=1,c=2,d=3,e=4,f,g,count=0, flag=0;

if(a<b || a<c && a<=d || a<e)
{
	count=count+1;
}

while(a<b)
{
    for(int i=0;i<10;i++)
   {

    if(a<b || a<c && a<=d || a<e)
    {
    	e=a^b;
       e+=2;
    }cout<<e<<endl;

   a++;
   }
}

if(a<b || a<c && a<=d || a<e)
{
	flag=flag+1;
}
e=a+b;
g=c+d;
f=f+2;
return 0;
}

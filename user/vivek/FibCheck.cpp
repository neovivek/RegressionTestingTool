#include <iostream.h>
using namespace std;

void print(int p)
{
if (p==0){
   return;
}
print(p-1);
cout<<p;
return;
}

int Fibonacci(int n)
{
if (n==0){
    return 0;
}
if (n==1){
    return 1;
}
return Fibonacci(n-2) + Fibonacci(n-1);
}

bool isPrime(int p, int i=2)
{
if (i==p) {
	return 1;
}
if (p%i == 0) {
	return 0;
}
int a=0,b=0,c;

a=b+c;
return isPrime (p, i+1);

}

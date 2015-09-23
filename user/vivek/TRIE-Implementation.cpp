#include<iostream>
using namespace std;
#include<string.h>
#include<stdio.h>
#include<fstream>
struct node
{
char data;
struct node *next_node;
struct node *down_node;	
bool end;
}*ptr,*nptr,*sptr,*root; 
//int a[100];

int count=0;

 int form_trie()
 {
     char q,*rptr;	
     char a[20];
     bool flag=0;
     int i=0;
     bool flag1=0;
     bool flag2=0,flag3=0;;
     cout<<"Enter the file name in which you want to search for the query : ";
     gets(a);
     rptr=a;
     ifstream mfile;
     mfile.open(rptr);


     while(!mfile.eof())
   {
     mfile.get(q);	

     if(flag==0)	
      {
	
       nptr=new node;nptr->end=0;
       count++;
       nptr->data=q;
        nptr->down_node=NULL;
         nptr->next_node=NULL;
                            root=nptr ;
        i++;
        ptr=root;
        flag=1;
         //cout<<"hey";
     } 


      else 
    {
	
       if(q==' '||q=='.'||q==',')
      { 
       //cout<<" \n space detected  ";
        i++;
        ptr->end=1;
        ptr=root;
         flag3=1;
      }
        
		else if(flag3==1)      
         {
            while(ptr)
           {
	          if(ptr->data==q)
	          {
	            flag1=1;sptr=ptr;
	            break;	
	          }
	       ptr=ptr->next_node;
           }

             if(flag1==0)
            {
              ptr=root;
              while(ptr->next_node)
              ptr=ptr->next_node;
              nptr=new node;
              count++;
              nptr->end=0;
              nptr->data=q;
              nptr->down_node=NULL;
              nptr->next_node=NULL;
              ptr->next_node=nptr;
              i++;
               //cout<<"\n new node added to root:  "<<a[i-1];
             ptr=nptr;
            }

            else
           {
            flag1=0;
             //cout<<"same node found:"<<a[i];
             i++;
             ptr=sptr;
           }
              flag3=0;
         }	
 


	
         else
        {
        	if(ptr->down_node)
        	{
			 
			  nptr=ptr->down_node;
              while(nptr)
			  {
			   if(nptr->data==q)	
			    
				{
				
				 flag2=1;break;
			    }
			  	nptr=nptr->next_node;
         
              }
         
		        if(flag2==1)
               {
                //cout<<" \nelement found at a level other than root: "<<nptr->data;
                ptr=nptr;
                i++;
                 flag2=0;
               }

                 else
               {
                 nptr=ptr->down_node;	

                   while(nptr->next_node)
                 nptr=nptr->next_node;
                 sptr=new node;count++;
                   sptr->end=0;
				   sptr->next_node=NULL;
                  sptr->down_node=NULL;
	              sptr->data=q;
	              i++;
	               nptr->next_node=sptr;
                       //	cout<<"  \nprevious node data displayed  "<<nptr->data;
	              ptr=sptr;
               }
            }

        
               else
               {
                  nptr=new node;count++;
                  nptr->data=q;
                  nptr->end=0;
                   nptr->next_node=NULL;
                  nptr->down_node=NULL;
                  ptr->down_node=nptr;
                  ptr=nptr;
                    i++;
                 //cout<<"\na level is added to"<<a[i-2]<<" ";
               }	


    }   }}
  
mfile.close();

	return 0;
}







int OO_Search(char s[])
 {
  bool flaggy=0,flag4=0;	  
  int i=0;
  int j=0;
  ptr=root;
   //char c[20];

   while(j++<strlen(s))
   {
 	
	 if(s[i]==' ')
	 {//	 c[i]=s[i];
      ptr=root;
	  i++;	
	 }
	

	
       while(ptr)
      {	
        if(ptr->data==s[i])
        {	
         //c[i]=s[i];
          flaggy=1;
          sptr=ptr;
          break;	
        }
         ptr=ptr->next_node;	
     }



     if(flaggy==1)
     {
     	
       ptr=sptr;
       i++;
       if(j==strlen(s)&& ptr->end==0)
       {
       	 cout<<"\nstring not found\n";flag4=1;
			break;
       }
       
       ptr=ptr->down_node;
       flaggy=0;
     }


       else
     {	
       if(i!=strlen(s))
       cout<<"string not found\n";flag4=1;break;
     }
   }


     if(i>0)
    {
    	if(flag4==1)
    	{
    	  cout<<"\nRelated string found= ";
    	  flag4=0;
        }
        else
         cout<<"\nstring found= ";
      for(int k=0;k<i;k++)
     cout<<s[k];
	 cout<<"\n";   
    }

    return 0;
 }









int main()
{
	char q[100];
    //cout<<"MAKE YOUR DATABASE:\n";
//	ifstream mfile;
//	mfile.open("myfile.txt");
	
    form_trie();

   // cout<<"\nNo of nodes formed are="<<count;
    //cout<<"\nlength of string="<<strlen(a);
   //cout<<"\npercentage data compressed= "<<((strlen(a)-count)*100)/strlen(a);
   //cout<<"\nTRIE FORMED\n";
 

   int t=0;
   cout<<"enter test cases :";
  cin>>t;
   fflush(stdin);


  while(t--)
 {
  cout<<"\n\nEnter your query: ";
   gets(q);
   OO_Search(q);	
  }
 
   return 0;
 }





	


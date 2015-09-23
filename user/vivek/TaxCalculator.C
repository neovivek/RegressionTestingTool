#include<conio.h>
#include<stdio.h>
#include<ctype.h>
#include"TaxCalculator.h"
int yr1;
char s;
void patt1(char * str)
	{
	int i;
	printf("\n");
	for(i=0;i<80;i++)
		{
		printf("%c",124);
		}
	printf("\n\n");
	printf("\t\t\t%s",str);
	printf("\n\n\n");
	for(i=0;i<80;i++)
		{
		printf("%c",124);
		}
	printf("\n\n");
	}
int accept_details()
	{
	char name[15]="abcdef",sex,status,address[30]="jash";
	int flag=1,flag1=1,flag2=1,flag3=1,flag4=1,flag5=1,i,dd,mm,yyyy;

	while(flag1==1)
		{
		printf("\nModule starting Press any key to continue");
		getch();

		printf("\nEnter name\t:");
		gets(name);

		for(i=0;i<strlen(name);i++)
			{
			if(((toascii(name[i])>=65)&&(toascii(name[i])<=122))||(toascii(name[i])==32))
				{
				flag1=0;
				}
			else
				{
				printf("\nName can contain only charcter Error at position number %d",i);
				flag1=1;
				break;
				}


			}

		if((strlen(name)<3)||(strlen(name)>15))
			{
			printf("\nPlease enter name having characters between 3 and 15");
			flag1=1;
			}

		}
	while(flag2==1)
		{
		flag2=0;
		printf("\nEnter date of birth (dd/mm/yyyy)\t:");
		printf("\n\tEnter date dd\t:");
		scanf("%d",&dd);
			if((dd>31)||(dd<=0))
				{
				flag2=1;
				printf("\nWrong date");
				}
		printf("\n\tEnter month mm\t:");
		scanf("%d",&mm);
			if((mm<=0)||(mm>12)||((mm==2)&&(dd>29)))
				{
				printf("\nWrong date/month");
				flag2=1;
				}
		printf("\n\tEnter year yyyy\t:");
		scanf("%d",&yyyy);
		yr1=yyyy;
			if((yyyy<1947)||(yyyy>2000))
				{
				printf("\nPlease enter a year between 1947 and 2000");
				flag2=1;
				}
			}


	while(flag5==1)
		{
		flag5=0;
		printf("\nEnter address\t\t:");
		gets(address);


		if(strlen(address)>30)
			{
			printf("\nAddress must be of max 30 characters");
			flag5=1;
			}
		else
		{
		for(i=0;i<strlen(address);i++)
			{
			if(((toascii(address[i])>=65)&&(toascii(address[i])<=122))||(toascii(address[i])==32)||((toascii(address[i])>=48)&&(toascii(address[i])<=57))||(toascii(address[i])==44))
				{
				flag5=0;
				}
			else
				{
				printf("\nAddress can contain only charcter Error at position number %d",i);
				flag5=1;
				break;
				}


			}
		}

	while(flag3==1)
		{
		flag3=0;
		printf("\nEnter sex(m/f)\t\t:");
		sex=getche();
		if((sex=='m')||(sex=='M')||(sex=='f')||(sex=='F'))
			{
			s=sex;
			flag3=0;
			}
		else
			{
			printf("\nPlease Enter m or f");
			flag3=1;
			}
		}
	while(flag4==1)
		{
		flag4=0;
		printf("\nWhether salaried(y/n)\t:");
		status=getche();
		flag4=0;
		if((status=='y')||(status=='Y')||(status=='n')||(status=='N'))
			{
			flag4=0;
			}
		else

			{
			printf("\nPlease Enter y or n");
			flag4=1;
			}
		}




		}
	printf("\n\nPress any key to proceed");
	getch();
	clrscr();
	patt1("Your Details");
	printf("\nName is\t\t\t:%s",name);
	printf("\nDate of birth \t\t:%d/%d/%d",dd,mm,yyyy);
	printf("\nAddress\t\t\t:%s",address);

	if((sex=='m')||(sex=='F'))
		{
		printf("\nSex \t\t\t:male");
		}
	else
		{
		printf("\nSex \t\t\t:Female");
		}
	if((status=='y')||(status=='Y'))
		{
		printf("\nStaus \t\t\t:Salaried");
		flag=1;
		}
	else
		{
		printf("\nStatus \t\t:Business/Self Employeed");
		flag=0;
		}
		printf("\nPress any key to continue");
	getch();
	return flag;


	}

void extra_details()
	{
	char desig[15],emp_address[30],emp_name[25];
	int flag1=1,flag2=1,flag3=1,i;
	while(flag3==1)
		{

		printf("\nEnter Designation\t:");
		gets(desig);

		for(i=0;i<strlen(desig);i++)
			{
			if(((toascii(desig[i])>=65)&&(toascii(desig[i])<=122))||(toascii(desig[i])==32))
				{
				flag3=0;
				}
			else
				{
				printf("\nDesignation can contain only charcter Error at position number %d",i);
				flag3=1;
				break;
				}


			}

		if((strlen(desig)<3)||(strlen(desig)>15))
			{
			printf("\nPlease enter designation having characters between 3 and 15");
			flag3=1;
			}

		}


	while(flag1==1)
		{

		printf("\nEnter Employer name\t:");
		gets(emp_name);

		for(i=0;i<strlen(emp_name);i++)
			{
			if(((toascii(emp_name[i])>=65)&&(toascii(emp_name[i])<=122))||(toascii(emp_name[i])==32))
				{
				flag1=0;
				}
			else
				{
				printf("\nName can contain only charcter Error at position number %d",i);
				flag1=1;
				break;
				}


			}

		if((strlen(emp_name)<3)||(strlen(emp_name)>25))
			{
			printf("\nPlease enter name having characters between 3 and 15");
			flag1=1;
			}

		}

		flag2=1;
	while(flag2==1)
		{
		flag5=0;
		printf("\nEnter Employer address\t:");
		gets(emp_address);

		flag4=0;
		if(strlen(emp_address)>30)
			{
			printf("\nAddress must be of max 30 characters");
			flag2=1;
			}
		else
		{
		for(i=0;i<strlen(emp_address);i++)
			{
			if(((toascii(emp_address[i])>=65)&&(toascii(emp_address[i])<=122))||(toascii(emp_address[i])==32)||((toascii(emp_address[i])>=48)&&(toascii(emp_address[i])<=57))||(toascii(emp_address[i])==44))
				{
				flag2=0;
				}
			else
				{
				printf("\nAddress can contain only charcter Error at position number %d",i);
				flag2=1;
				break;
				}


			}
		}

		printf("\n\nPress any key to proceed");
	getch();
	clrscr();

	patt1("Salaried Person Details");
	printf("\nDesignation\t\t:%s",desig);
	printf("\nEmployer Name is\t:%s",emp_name);
	printf("\nAdress of the employer\t:%s",emp_address);
	}


	}

void other_details()
	{
	char pan[10],tds[15];
	int flag1=1,flag2=1,flag3=1,flag4=1,i,dd,mm,yyyy,dd1,mm1,yyyy1;

	while(flag1==1)
		{

		printf("\nEnter PAN NUM\t\t:");
		gets(pan);

		for(i=0;i<strlen(pan);i++)
			{
			if(((toascii(pan[i])>=65)&&(toascii(pan[i])<=122))||(toascii(pan[i])==32)||((toascii(pan[i])>=48)&&(toascii(pan[i])<=57)))
				{
				flag1=0;
				}
			else
				{
				printf("\nPan Number can contain only charcter Error at position number %d",i);
				flag1=1;
				break;
				}


			}

		if(strlen(pan)!=10)
			{
			printf("\nPlease enter correct PAN number having 10 alphabets");
			flag1=1;
			}

		}
	while(flag2==1)
		{

		printf("\nEnter TDS circle\t:");
		gets(tds);

		for(i=0;i<strlen(tds);i++)
			{
			if(((toascii(tds[i])>=65)&&(toascii(tds[i])<=122))||(toascii(tds[i])==32)||((toascii(pan[i])>=48)&&(strlen(pan[i])<=57)))
				{
				flag2=0;
				}
			else
				{
				printf("\nTDS can contain only charcter. Error at position number %d",i);
				flag2=1;
				break;
				}


			}

		if((strlen(tds)<3)||(strlen(tds)>15))
			{
			printf("\nPlease enter TDS between 3 and 15 characters");
			flag2=1;
			}

		}

	while(flag3==1)
		{
		flag3=0;
		printf("\nEnter Period of tax return from\t:");
		printf("\n\tEnter day(dd)\t:");
		scanf("%d",&dd);
			if((dd>31)||(dd<=0))
				{
				flag3=1;
				printf("\nWrong date");
				}
		printf("\n\tEnter month\t:");
		scanf("%d",&mm);
			if((mm<=0)||(mm>12)||((mm==2)&&(dd>29)))
				{
				printf("\nWrong date/month");
				flag3=1;
				}
		printf("\n\tEnter year\t:");
		scanf("%d",&yyyy);
			if((yyyy<2000)||(yyyy>2032))
				{
				printf("\nPlease enter a year between 2000 and 2032");
				flag3=1;
				}
			}

		while(flag4==1)
		{
		flag4=0;
		printf("\nEnter Period of tax return to\t:");
		printf("\n\tEnter day(dd)\t:");
		scanf("%d",&dd1);
			if((dd1>31)||(dd1<=0))
				{
				flag4=1;
				printf("\nWrong date");
				}
		printf("\n\tEnter month\t:");
		scanf("%d",&mm1);
			if((mm1<=0)||(mm1>12)||((mm1==2)&&(dd1>29)))
				{
				printf("\nWrong date/month");
				flag4=1;
				}
		printf("\n\tEnter year\t:");
		scanf("%d",&yyyy1);
			if(yyyy1!=yyyy+1)
				{
				printf("\nPlease enter Next year( wrt YEAR FROM)");
				flag4=1;
				}
			}
		printf("\n\nPress any key to proceed");
		getch();
		clrscr();
		patt1("TAX Details");
		printf("\nPAN NUMBER\t:%s",pan);
		printf("\nTDS CIRCLE\t:%s",tds);
		printf("\nASSESMENT YEAR\n");
		printf("\nDATE FROM\t:%d/%d/%d",dd,mm,yyyy);
		printf("\nDATE TO\t\t:%d/%d/%d",dd1,mm1,yyyy1);

		}

int male_tax(float total_sal,float savings,float donations_rebate,float *taxable1)
	{
	float t,taxable;
	if(savings<100000)
		{
		taxable=total_sal-savings;
		}
	else
		{
		taxable=total_sal-100000;
		}
	taxable= taxable-donations_rebate;
	*taxable1=taxable;
	if(taxable<=150000)
		{
		return 0;
		}
	else if((taxable>150000)&&(taxable<=300000))
		{
		t=10*taxable/100;
		}
	else if((taxable>300000)&&(taxable<=500000))
		{
		t=20*taxable/100;
		}
	else
		{
		t=30*taxable/100;
		}



	return t;

	}
int fem_tax(float total_sal,float savings,float donations_rebate,float *taxable1)
	{
	float t,taxable;
	if(savings<100000)
		{
		taxable=total_sal-savings;
		}
	else
		{
		taxable=total_sal-100000;
		}
	taxable= taxable-donations_rebate;
	*taxable1=taxable;
	if(taxable<=180000)
		{
		return 0;
		}
	else if((taxable>180000)&&(taxable<=300000))
		{
		t=10*taxable/100;
		}
	else if((taxable>300000)&&(taxable<=500000))
		{
		t=20*taxable/100;
		}
	else
		{
		t=30*taxable/100;
		}




	return t;

	}
int senior_tax(float total_sal,float savings,float donations_rebate,float *taxable1)
	{
	float t,taxable;
	if(savings<100000)
		{
		taxable=total_sal-savings;
		}
	else
		{
		taxable=total_sal-100000;
		}
	taxable= taxable-donations_rebate;
	*taxable1=taxable;
	if(taxable<=225000)
		{
		return 0;
		}
	else if((taxable>225000)&&(taxable<=300000))
		{
		t=10*taxable/100;
		}
	else if((taxable>300000)&&(taxable<=500000))
		{
		t=20*taxable/100;
		}
	else
		{
		t=30*taxable/100;
		}




	return t;

	}


void main()
	{
	int i,status,mmch;
	int choice;
	char ch,ch1;
	float monthly_sal,total_sal=0,savings,donations,others,tax,donations_rebate,edu_cess,cess,total_tax,taxable1;
	clrscr();
	printf("\n\n\n");
	patt1("TAX CALCULATOR");
	printf("\n\n");
	printf("\nPlease enter the required information for calculating the tax.");
	printf("\n\n\n\n\n\t\tPress key to continue\n");
	getch();
	clrscr();
	patt1("PERSONAL DETAILS");
	status=accept_details();
	if(status)
		{
				clrscr();
				patt1("Salaried Person Details");
				extra_details();
				}
	printf("\nPress any key to continue");
	getch();
	clrscr();
	patt1("OTHER DETAILS");
	other_details();
	printf("\nPress any key to continue");
	getch();
	clrscr();
	main1(s,status);
	switch(choice)
		{
		case 1:
			tax=male_tax(total_sal,savings,donations_rebate,&taxable1);
			edu_cess=3*tax/100;
			if(taxable1>1000000)
				{
				cess=10*taxable1/100;
				}
			else
				{
				cess=0;
				}
			total_tax=tax+edu_cess +cess;
			clrscr();
				printf("\n\n");
				for(i=0;i<80;i++)
				{
				printf("%c",20);
				}
			printf("\n");

			printf("\n\n\n\t\t\tTAX CACLULATOR\n\n\n");
			printf("\nMale\n");
			printf("\nTotal salary\t\t\t:%f",total_sal);
			printf("\nDonations exempted from tax\t:%f",donations_rebate);
			printf("\nSavings\t\t\t\t:%f",savings);
			printf("\nTax\t\t\t\t:%2f",tax);
			printf("\nEducational cess\t\t:%2f",edu_cess);
			printf("\nCess on income above 10 Lac\t:%2f",cess);
			printf("\n\n\nTotal Tax\t\t\t:%2f",total_tax);
			getch();

			break;
		case 2:
			tax=fem_tax(total_sal,savings,donations_rebate,&taxable1);
			edu_cess=3*tax/100;
			if(taxable1>1000000)
				{
				cess=10*taxable1/100;
				}
			else
				{
				cess=0;
				}
			total_tax=tax+edu_cess+cess;
			clrscr();
			printf("\n\n");
			for(i=0;i<80;i++)
				{
				printf("%c",20);
				}
			printf("\n");

			printf("\n\n\n\t\t\tTAX CACLULATOR\n\n\n");
			printf("\Female\n");
			printf("\nTotal salary\t\t\t:%f",total_sal);
			printf("\nDonations exempted from tax\t:%f",donations_rebate);
			printf("\nSavings\t\t\t\t:%f",savings);
			printf("\nTax\t\t\t\t:%2f",tax);
			printf("\nEducational cess\t\t:%2f",edu_cess);
			printf("\nCess on income above 10 Lac\t:%2f",cess);
			printf("\n\n\nTotal Tax\t\t\t:%2f",total_tax);
			getch();

			break;
		case 3:
			tax=senior_tax(total_sal,savings,donations_rebate,&taxable1);
			edu_cess=3*tax/100;
			if(taxable1>1000000)
				{
				cess=10*taxable1/100;
				}
			else
				{
				cess=0;
				}
			total_tax=tax+edu_cess+cess;
			clrscr();
			printf("\n\n");
			for(i=0;i<80;i++)
				{
				printf("%c",20);
				}
			printf("\n");

			printf("\n\n\n\t\t\tTAX CACLULATOR\n\n\n");
			printf("\nSenior citizen\n");
			printf("\nTotal salary\t\t\t:%f",total_sal);
			printf("\nDonations exempted from tax\t:%f",donations_rebate);
			printf("\nSavings\t\t\t\t:%f",savings);
			printf("\nTax\t\t\t\t:%2f",tax);
			printf("\nEducational cess\t\t:%2f",edu_cess);
			printf("\nCess on income above 10 Lac\t:%2f",cess);
			printf("\n\n\nTotal Tax\t\t\t:%2f",total_tax);
			getch();

			break;
		default:
			printf("\nWrong choice entered\n");
		}   
	getch();
	}

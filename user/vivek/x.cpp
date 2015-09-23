double income_details_sal()
{
	float t_d, d1, d2, sal1, sal2, sal3, t_sal, sal_all, sal_all_tot=0, ei, t_ei=0,net_t_sal=0, bal;
	char sal_ch='y',ei_ch='y';
	int f1=1,f2=1,f3=1,f4=1;
	double gross;
	
	while(f2==1)
		{
		printf("\n1.\tGROSS SALARY\t:");
	printf("\n\ta) Salary as per the provisions contained in the section 17(1)\t:");
		scanf("%f",&sal1);
	printf("\n\tb) Value of the perquisites under section 17(2)\n(As per form number 12BA , wherever applicable )\t:");
		scanf("%f",&sal2);
	printf("\n\tc) Profits in lieu of salary under section 17(3)\n(As per form number 12BA , wherever applicable )\t:");
		scanf("%f",&sal3);
		t_sal=0;
		if((sal1<0)||(sal2<0)||(sal3<0))
			{
			f2=1;
			}
		else
			{
			f2=0;
			}
		}
		t_sal=t_sal+sal1+sal2+sal3;
		printf("\n\td)\tTotal\n\t\t\t\t:%f",t_sal);
		sal_all_tot=0;
		while((sal_ch=='y')||(sal_ch=='Y'))
		{
		while(f1==1)
			{
			printf("\n2.\tAllowance to the extent exempt under section 10\t:");
			scanf("%f",&sal_all);
			if(sal_all<0)
				{
				printf("\nEnter correct value");

				}
			else
				{
				f1=0;
				}
			}
		sal_all_tot=sal_all_tot+sal_all;
		printf("\nEnter more?(Y/N)\t:");
	sal_ch=getche();
		if((sal_ch=='y')||(sal_ch=='Y')||(sal_ch=='n')||(sal_ch=='N'))
				{
				f1=0;
				}
		else
				{
				printf("\nPlease enter y or n");
				}
		}
		printf("\nTotal allowance\t\t:%f",sal_all_tot);
		bal=t_sal-sal_all_tot;
		printf("\nBalance\t:%f",bal);
		t_d=0;
		while(f3==1)
		{
		printf("\n3.\tDeductions\t:");
		printf("\n\tEntertainment allowance(EA)\t:");
		scanf("%f",&d1);
		printf("\tTax on employment (TE)\t:");
		scanf("%f",&d2);
		if((d1<0)||(d2<0))
			{
			f3=1;
			}
		else
			{
			f3=0;
			}
		}
		t_d=t_d+d1+d2;
		printf("\nTotal deductions\t:%f",t_d);
		net_t_sal=bal-t_d;
		printf("\n4.\tINCOME CHARGABLE UNDER THE HEAD SALARIES'\t:%f",net_t_sal);
		while((ei_ch=='y')||(ei_ch=='Y'))
		{
		while(f4==1)
		{
		printf("\n5.\tAny other income reported by the Employee\t:");
		printf("\n\t\tEnter Income\t:");
		scanf("%f",&ei);
		if(ei<0)
			{
			f4=1;
			}
		else
			{
		f4=0;
			}
		}
		t_ei=t_ei+ei;
		printf("\n\t\tEnter more?(Y/N)\t:");
		ei_ch=getche();
		}
		gross=net_t_sal+t_ei;
		printf("\n6.Gross Total Income:\t%f",gross);
		return(gross);
}
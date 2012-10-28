#include<stdio.h>
#include<sys/file.h>
#include<string.h>
int main()
{
	char command[] = "ls /var/www/txtcnct_2/files/requests/ -t -r | head -n 1";
	FILE *lsofFile_p = popen(command, "r");

	if (!lsofFile_p)
	{
	return -1;
	}

	char buffer[1024];
	char *line_p = fgets(buffer, sizeof(buffer), lsofFile_p);

	if(strlen(buffer)==0)
		printf("no file");
	else
		printf("%s",buffer);

	pclose(lsofFile_p);

	return 0;
}

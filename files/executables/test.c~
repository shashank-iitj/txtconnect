#include <stdio.h>
#include <stdlib.h>
#include<sys/file.h>
int main () {
	FILE * fptr;
	
	fptr = fopen("../requests/test.txt","w");
	
	int fd;
	fd =  fileno(fptr);

	while(flock(fd,LOCK_EX)==-1);
	printf("file locked");

	flock(fd,LOCK_UN);
	//fprintf(command, "touch %s", "test.txt");
	//printf("file opened"); 
	return 0;
	}

	

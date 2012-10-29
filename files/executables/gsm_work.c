#include <sys/types.h>
#include <sys/stat.h>
#include <fcntl.h>
#include <termios.h>
#include <stdio.h>
#include <stdlib.h>
#include <pthread.h>
#include <semaphore.h>
#include <time.h>
#include <unistd.h>
#include <errno.h>
#include <string.h>
#include <sys/ioctl.h>
#include <dirent.h>

#include <sys/types.h>
#include <sys/stat.h>
#include<sys/file.h>

#define BAUDRATE B9600
#define MODEMDEVICE "/dev/ttyUSB0"

int serialport_init(int *modem_fd);

int main(int argc, char* argv[])
{

	int modem_fd, serialport_init_res = -1, res = -1;
	struct termios oldtio;
	char message[160]; 
	char command[255];
	char buf1[256], file_name[100],file_path[200];

	DIR *dirp;
	struct dirent * dp;
	struct stat filestatus;
	FILE * fptr,*lsofFile_p;
	int fd;

	char line[200]; //reading line one at a time from req_* txt files
	char phone_no[11];
	int length;
	char ch;

	//open the modem device
	modem_fd = open(MODEMDEVICE, O_RDWR | O_NOCTTY );  
	if (modem_fd <0) {
		printf("Can't open Modem Device\n"); 
		return -1; 
	}
	fcntl(modem_fd, F_SETFL, FNDELAY);	 
	tcgetattr(modem_fd,&oldtio);               	                   // save current serial port settings 
	serialport_init_res = serialport_init(&modem_fd);               // initialize the serial port open above 
		
	if(serialport_init_res == 0){
		printf("GSM Board connected to the Serial Port\n");
	}   
	else {
		printf("gsm.c: failed to initialize the serial port\n");
		return -1;
	}  

	//You are ready to send message.
	//sample message 
	
	
	char lscommand[] = "ls ../requests/ -t -r | head -n 1";
	while (1) {
	
		length=0;		
		lsofFile_p = popen(lscommand, "r");

		ch=getc(lsofFile_p);
		while (ch != '\n' && ch != EOF) {
			file_name[length] = ch;
			length++;
			ch = getc(lsofFile_p);
		}
		file_name[length]='\0';
		//char *line_p = fgets(file_name, sizeof(file_name), lsofFile_p);
		pclose(lsofFile_p);

		if(strlen(file_name)==0)			//no request file is pending
			continue;

		strcpy(file_path, "../requests/");
		strcat(file_path, file_name);

		printf("File:%s\n",file_path);
		

		stat(file_path, &filestatus );
		
		printf("size of file: bytes\n");

		if(filestatus.st_size!=0)
		{			
		
			fptr = fopen(file_path, "r+");

			if(fptr)	
				printf("file opened\n");
			else
				printf("file could not be opened\n");

			//fd =  fileno(fptr);
			//while(flock(fd,LOCK_EX)==-1);

			printf("Contents of %s:\n\n", file_name);
			while (fgets(line,1000,fptr) != NULL)
			{
				printf("%s\n",line);
				strncpy(phone_no, line, 10);
				phone_no[10] = '\0';
				strcpy(message, line + 11);
				printf ("Phone: %s\nMessage:%s len=%d\n",phone_no, message, strlen(message));
			
				strcpy(command, "AT+CMGS=\"+91");
				strcat(command,phone_no);
				strcat(command,"\"\r\n");
				printf("Command=%s\n",command);
				write(modem_fd,command,strlen(command));
				write(modem_fd,message,strlen(message));
				write(modem_fd,"\x1A",1);           //x1A means ctrl+Z 
					 
				// message has been submitted, check the response of the modem 
					
				/*while(1)
				{
					res = read(modem_fd,buf1,255);
				
					if(res==-1)
					{	
						fprintf(stderr,	"error status: %d\n%s\n",
								  res, strerror(errno));
						printf("%d\n",res);
						usleep(1000000);
						continue;
					} 
					if(res > 0)
						//printf("RES == 1 buf1 %s\n",buf1);
						printf("%d\n",res);
						continue;   
						 
					//buf1[res-1]='\0';              //set end of string, so we can use printf 
				
					//if (strncmp(buf1,"OK",2)== 0 ||strncmp(buf1,"ERROR",5)==0)
						usleep(1000);
						break;
				}
				*/
				usleep(3000000);
			
			}
			flock(fd,LOCK_UN);
			fclose(fptr);
			strcpy(command, "mv ");
			strcat(command, file_path);
			strcat(command, " ../logs");
			printf("%s\n",command);
			system(command);
		}
        
	}
	return 0;

}


int serialport_init(int *modem_fd)
{
	struct termios newtio;
   
	bzero(&newtio, sizeof(newtio));     /* clear struct for new port settings */
	/* 
          BAUDRATE: Set bps rate. You could also use cfsetispeed and cfsetospeed.
          CRTSCTS : output hardware flow control (only used if the cable has
                    all necessary lines. See sect. 7 of Serial-HOWTO)
          CS8     : 8n1 (8bit,no parity,1 stopbit)
          CLOCAL  : local connection, no modem contol
          CREAD   : enable receiving characters
        */
	newtio.c_cflag = BAUDRATE | CS8 | CLOCAL | CREAD;
         
	/*
          IGNPAR  : ignore bytes with parity errors
          ICRNL   : map CR to NL (otherwise a CR input on the other computer
                    will not terminate input)
          otherwise make device raw (no other input processing)
        */
	newtio.c_iflag = IGNPAR | ICRNL;
         
        /*
         Raw output.
        */
         newtio.c_oflag = 0;
         
        /*
          ICANON  : enable canonical input
          disable all echo functionality, and don't send signals to calling program
        */
	newtio.c_lflag = ICANON;
         
        /* 
          initialize all control characters 
          default values can be found in /usr/include/termios.h, and are given
          in the comments, but we don't need them here
        */
	newtio.c_cc[VINTR]    = 0;     /* Ctrl-c */ 
	newtio.c_cc[VQUIT]    = 0;     /* Ctrl-\ */
	newtio.c_cc[VERASE]   = 0;     /* del */
	newtio.c_cc[VKILL]    = 0;     /* @ */
	newtio.c_cc[VEOF]     = 4;     /* Ctrl-d */
	newtio.c_cc[VTIME]    = 0;     /* inter-character timer unused */
	newtio.c_cc[VMIN]     = 1;     /* blocking read until 1 character arrives */
	newtio.c_cc[VSWTC]    = 0;     /* '\0' */
	newtio.c_cc[VSTART]   = 0;     /* Ctrl-q */ 
	newtio.c_cc[VSTOP]    = 0;     /* Ctrl-s */
	newtio.c_cc[VSUSP]    = 0;     /* Ctrl-z */
	newtio.c_cc[VEOL]     = 0;     /* '\0' */
	newtio.c_cc[VREPRINT] = 0;     /* Ctrl-r */
	newtio.c_cc[VDISCARD] = 0;     /* Ctrl-u */
	newtio.c_cc[VWERASE]  = 0;     /* Ctrl-w */
	newtio.c_cc[VLNEXT]   = 0;     /* Ctrl-v */
	newtio.c_cc[VEOL2]    = 0;     /* '\0' */
        
        /* 
          now clean the modem line and activate the settings for the port
        */
	tcflush(*modem_fd, TCIFLUSH);
	if (tcsetattr(*modem_fd, TCSANOW, &newtio) < 0) 
	{
		perror ("init_serialport: Couldn't set term attributes");
		return (-1);
	}
    
	return 0;

} //end serial_port_init

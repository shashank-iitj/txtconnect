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

#define BAUDRATE B9600
#define MODEMDEVICE "/dev/ttyUSB0"

int serialport_init(int *modem_fd);

void main(int argc, char* argv[])
{

 int            modem_fd;
 int              serialport_init_res = -1;
 struct termios   oldtio;
 char message[160]; 
 char command[255];
 char buf1[256];
 int res=-1;

   //open the modem device
  modem_fd = open(MODEMDEVICE, O_RDWR | O_NOCTTY );  
    if (modem_fd <0) 
    {
       printf("Can't open Modem Device\n"); 
       return ; 
    }
  fcntl(modem_fd, F_SETFL, FNDELAY);
 
  tcgetattr(modem_fd,&oldtio);                                   /* save current serial port settings */
    
  serialport_init_res = serialport_init(&modem_fd);               /* initialize the serial port open above */
    
  if(serialport_init_res == 0)
    {
       printf("GSM Board connected to the Serial Port\n");
    }   
  else
    {
          printf("gsm.c: failed to initialize the serial port\n");
          return;
    }  

  /* You are ready to send message :P */
  /* sample message */

if (argc != 3){
	printf ("Invalid no. of arguments\n");
	return ;
}
   strcpy(message,argv[2]);
	strcpy(command, "AT+CMGS=\"+91");
        strcat(command,argv[1]);
	strcat(command,"\"\r\n");
	printf("Command=%s\n",command);
      write(modem_fd,command,strlen(command));
      write(modem_fd,message,strlen(message));
      write(modem_fd,"\x1A",1);           /*x1A means ctrl+Z */
     
  /* message has been submitted, check the response of the modem */
    while(1)
    {
         res = read(modem_fd,buf1,255);
         if(res==-1)
            {
              usleep(10);
              continue;
            } 
         if(res==1)
             continue;   
         
         buf1[res-1]='\0';             /* set end of string, so we can use printf */
         if (strncmp(buf1,"OK",2)== 0 ||strncmp(buf1,"ERROR",5)==0)
             break;
    }

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

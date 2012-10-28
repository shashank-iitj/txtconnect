#include <stdio.h>

#include <sys/types.h>
#include <sys/stat.h>
#include <unistd.h>

int main( int argc, char** argv )
  {
  if (argc != 2)
    {
    printf( "usage:\n filesize FILENAME\n\n");
    return 1;
    }

  struct stat filestatus;
  stat( argv[ 1 ], &filestatus );

  if(filestatus.st_size==0)
	printf("the file is empty\n");
 else
	printf("file not empty\n");

  return 0;
  }

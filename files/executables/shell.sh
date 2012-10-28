#!/bin/sh
no_of_files=$(ls ../requests/| wc -l)

echo $no_of_files
while [ $no_of_files = 0 ];do
	no_of_files=$(ls ../requests/| wc -l)	
done

first_file=$(ls -t ../requests/*.txt | head -n 1)
mv $first_file ../executables/process.txt

echo "non-zero files";

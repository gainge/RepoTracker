#!/bin/bash

if [ "$#" != "2" ]
then
	echo "Invalid Argument Count!"
	exit
fi

FILE="$1"
EXTRACTED_DIR="data/extracted"

if [ ! -d $EXTRACTED_DIR ]
then
	mkdir $EXTRACTED_DIR
fi

SOURCE_DIR="$EXTRACTED_DIR/$2"

# Remove existing files, if applicable
if [ -d $SOURCE_DIR ]
then
	rm -r $SOURCE_DIR
fi

mkdir $SOURCE_DIR

echo "Unzipping File..."

# Original unzip from honor checker
unzip $FILE "*.java" -d $SOURCE_DIR -x "*.jar" ".class" "libs/*" "*.zip" "build/*" "app/src/main/res/*" "app/build/*" &>/dev/null

# Clean up the original zip file
rm $FILE



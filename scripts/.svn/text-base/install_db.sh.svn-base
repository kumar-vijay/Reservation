#!/bin/sh

# This script will be used to install the db from the dbscripts in the folder


# Configurations
USERNAME=root
PASSWORD=berkshire
DBNAME=reservation

# Script
REPO_PATH=/home/archana/sites/reservation/dbscripts


cd $REPO_PATH ;
for file in *; do
    mysql -u$USERNAME -p$PASSWORD $DBNAME < $file
done ;


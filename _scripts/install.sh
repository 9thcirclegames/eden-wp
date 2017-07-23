#!/bin/bash
set -x # Show the output of the following commands (useful for debugging)
chmod 600 deploy-key
mv deploy-key ~/.ssh/deploy-key
eval `ssh-agent -s` #start shh agent 
ssh-add ~/.ssh/deploy-key
chmod 600 config
mv config.txt ~/.ssh/config


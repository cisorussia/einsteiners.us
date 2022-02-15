#!/usr/bin/env bash

grep -r --exclude-dir=.github "demo.einsteiners.us" ./* .[^.]*

if [ $? == 0 ]
  then
    exit 1
fi

#!/bin/sh
if [ -n "$DYNO" ]
then
    ln -s /app/dayside public/dayside
fi
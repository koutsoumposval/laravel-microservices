#!/bin/bash
set -e

# Change www-data's uid & guid to be the same as directory in host
# Fix cache problems
usermod -u `stat -c %u /var/www/html` www-data || true
groupmod -g `stat -c %g /var/www/html` www-data || true

if [ "$1" = 'apache2-foreground' ]; then
    # let's start as root
    exec "$@"
else
    # change to user www-data
    su www-data -s /bin/bash -c "$*"
fi
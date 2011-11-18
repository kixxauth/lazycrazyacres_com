#!/bin/bash
DEV_DIR="$(cd `dirname $0` && pwd)"
REPO_DIR="$(dirname "$DEV_DIR")"
EXCLUDE_LIST="$DEV_DIR/rsync-exclude.list"

appname="$1"
target="/var/$appname"

sudo rsync \
--recursive \
--links \
--perms \
--times \
--del \
--exclude-from=$EXCLUDE_LIST \
--exclude=dev/*** \
$REPO_DIR/ $target

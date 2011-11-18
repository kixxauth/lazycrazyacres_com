#!/bin/bash
DEV_DIR="$(cd `dirname $0` && pwd)"
REPO_DIR="$(dirname "$DEV_DIR")"
EXCLUDE_LIST="$DEV_DIR/rsync-exclude.list"

main () {
    local cmd="$1"
    case $cmd in
        'mirror')
            shift
            mirror "$@"
            ;;
        'deploy')
            # <keyfile> <insance_list> <appname>
            shift
            deploy "$@"
            ;;
        * )
            echo "exiting without running any operations"
            echo "commands: deploy, mirror"
            ;;
    esac
}

fail () {
    echo "$@" >&2
    exit 1
}

deploy () {
    if [ -z $1 ]; then
        echo "usage: deploy <keyfile> <instance_list> <appname>"
        exit
    fi

    local keyfile="$1"
    local instance_list="$2"
    local appname="$3"

    if [ -z "$keyfile" ]; then
        fail "    aws keyfile is required"
    fi

    if [ -z "$instance_list" ]; then
        fail "    aws instance list is required"
    fi

    if [ -z "$appname" ]; then
        fail "    application name is required"
    fi

    local deploy="/home/ubuntu/websites/$appname"
    local instances="$(cat "$instance_list")"

    for domain in $instances; do
        rsync \
        --recursive \
        --links \
        --perms \
        --times \
        --del \
        --compress \
        --progress \
        --human-readable \
        --exclude-from=$EXCLUDE_LIST \
        -e 'ssh -i '$keyfile \
        $REPO_DIR/ ubuntu@$domain:$deploy

        ssh -i "$keyfile" ubuntu@$domain "$deploy/dev/remote-deploy.sh $appname"
    done
}

mirror () {
    if [ -z $1 ]; then
        echo "usage: mirror <target_dir>"
        exit
    fi

    local target="$1"
    rsync \
    --recursive \
    --links \
    --perms \
    --times \
    --del \
    --compress \
    --progress \
    --human-readable \
    --exclude-from=$EXCLUDE_LIST \
    $REPO_DIR/ $target
}

main "$@"

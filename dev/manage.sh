#!/bin/bash
DEV_DIR="$(cd `dirname $0` && pwd)"
REPO_DIR="$(dirname "$SCRIPT_DIR")"

# Handy to have around
DATE_NOW="$(date +%Y-%m-%d-%H:%M:%S)"

main () {
    local cmd="$1"
    case $cmd in
        'mirror')
            shift
            mirror "$@"
            ;;
        'deploy')
            # <keyfile> <insance_list> <restart>
            shift
            deploy "$@"
            ;;
        * )
            echo "exiting without running any operations"
            echo "commands: deploy, mirror"
            ;;
    esac
}

deploy () {
    local keyfile="$1"
    local instance_list="$2"
    local local_conf="$3"
    local restart="$4"

    if [ -z "$keyfile" ]; then
        fail "    aws keyfile is required"
    fi

    if [ -z "$instance_list" ]; then
        fail "    aws instance list is required"
    fi

    local deploy="/home/ubuntu/platform"
    local exclude_list="$BUILD_CONF/dist-exclude.list"
    local instances="$(cat "$instance_list")"

    local conf="$deploy/conf.json"

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
        --exclude-from=$exclude_list \
        --log-file="$LOG_DIR/${DATE_NOW}_${domain}-deploy.log" \
        -e 'ssh -i '$keyfile \
        $REPO_DIR/ ubuntu@$domain:$deploy

        if ! [ -z "$local_conf" ]; then
            scp -i "$keyfile" "$local_conf" ubuntu@$domain:$conf
        fi

        if ! [ -z $restart ]; then
            echo "restarting $domain ..."
            ssh -i "$keyfile" ubuntu@$domain "$deploy/remote/restart.sh $domain $conf"
        fi
    done
}

mirror () {
    if [ -z $1 ]; then
        echo "usage: mirror <target_dir>"
        exit
    fi

    local target="$1"
    local exclude_list="$DEV_DIR/rsync-exclude.list"
    rsync \
    --recursive \
    --links \
    --perms \
    --times \
    --del \
    --compress \
    --progress \
    --human-readable \
    --exclude-from=$exclude_list \
    $REPO_DIR/ $target
}

main "$@"

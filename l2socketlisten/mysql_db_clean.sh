#!/bin/bash
set -x
cd /var/www/html/mfunhcu/l1mainentry
php cloud_callback_cron.php 7
echo $(date +%Y-%m-%d_%H:%M:%S) "mysql db cleaned."
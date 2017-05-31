ps -ef | grep 'php artisan serve' | grep -v grep | awk '{print "kill -9 " $2}' | sh -x
ps -ef | grep '/www/borabora-dev/borabora/server.php' | grep -v grep | awk '{print "kill -9 " $2}' | sh -x

ps -ef | grep 'php artisan serve' | grep -v grep | awk '{print "kill -9 " $2}' | sh -x

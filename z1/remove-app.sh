cd web
docker image rm web_php
docker image rm adminer
docker image rm mysql

docker volume rm web_mysql-data

echo "Removed app."
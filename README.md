# Z-Board Server

## Deployment
The code for the deployment can be found in a separate git [repository](https://github.com/theovier/zboard-docker-deployment).
When the server is restarted make sure to connect to its docker container via ```docker exec -it api /bin/bash```and execute the following commands:

```
#clear all caches/routes/configs
php artisan cache:clear
php artisan config:clear
php artisan route:clear

#migrate and freshly seed the database
php artisan migrate:fresh --seed
```

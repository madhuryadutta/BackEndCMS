## About BackEndCMS

BackEndCMS will be a Starter Template for Conetnt Management related web applications based on Laravel framework. I believe developing a Web Application from scratch is time consuming and not must be an enjoyable experience . So Lets work on Minimizng the efforts .

### Project Started on 30/11/2023 


## comands to be run on Producton ENvironment

```shell 
composer install --optimize-autoloader --no-dev 
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache
```
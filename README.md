# Laravel Users API - Serverless + RDS + SQS

## Local development
```bash
make setup
make up
make migrate
```

### Running commands in container
```bash
docker compose run --user $(id -u):$(id -g) worker composer require package
docker compose run --user $(id -u):$(id -g) worker php artisan cache:clear
docker compose run --user $(id -u):$(id -g) worker php artisan make:job AcmeJob
```

### Running tests
```bash
make php-unit
```

## Deployment
Make sure you done [Bref setup step](https://bref.sh/docs/setup) and already have AWS credentials configured.

Once done, go to `AWS Systems Manager -> Parameter Store` in AWS Console and create next parameters in the same region as this app (`us-east-1`):
 - `/sandbox/laravel-user-api/app-key`
 - `/sandbox/laravel-user-api/db-username`
 - `/sandbox/laravel-user-api/db-password`
 - `/sandbox/laravel-user-api/db-name`

They are required for application to run and connect to database.

Once done, run:
```bash
serverless deploy
```
and wait once finished.

Next step is to run migrations:
```bash
serverless bref:cli --args="migrate"
```

## Usage
### Creating a user
```bash
curl -H 'Content-Type: application/json' \
    -d '{ "email":"john.doe@example.com","password":"secret12345678"}' \
    -X POST \
    http://localhost/api/users
```

### Getting users list
```bash
curl -H 'Content-Type: application/json' \
    -X GET \
    http://localhost/api/users
```

### Deleting users
```bash
curl -H 'Content-Type: application/json' \
    -X DELETE \
    http://localhost/api/users/3
```

Replace `http://localhost` with endpoint url you got once deployment finished to test it on AWS.

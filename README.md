# Laravel User Api - Serverless Test Case with RDS + SQS

## Local development
```bash
make setup
make up
make migrate
```

## Running commands in container
```bash
docker compose run --user $(id -u):$(id -g) worker composer require package
docker compose run --user $(id -u):$(id -g) worker php artisan cache:clear
docker compose run --user $(id -u):$(id -g) worker php artisan make:job AcmeJob
```

## Creating a user
```bash
curl -H 'Content-Type: application/json' \
    -d '{ "email":"john.doe@example.com"}' \
    -X POST \
    http://localhost/api/users
```

## Getting users list
```bash
curl -H 'Content-Type: application/json' \
    -X GET \
    http://localhost/api/users
```

## Deleting users
```bash
curl -H 'Content-Type: application/json' \
    -X DELETE \
    http://localhost/api/users/3
```

## Running tests
```bash
make php-unit
```

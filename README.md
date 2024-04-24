# Laravel User Api - Serverless Test Case

## Local development
```bash
make setup
make up
make migrate
```

## Running artisan commands
```bash
docker compose run --user $(id -u):$(id -g) worker php artisan cache:clear
docker compose run --user $(id -u):$(id -g) worker php artisan make:job AcmeJob
```

## Creating a user
```bash
curl -H 'Content-Type: application/json' \
    -d '{ "email":"john.doe@example.com","password":"secret12345678"}' \
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

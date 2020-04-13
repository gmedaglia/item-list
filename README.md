Check the [Wiki Page](https://github.com/gmedaglia/item-list/wiki) for requirements.

# Local environment with Docker Compose

Build containers.
```
docker-compose up -d --build
```

Enter web container.
```
docker exec -it ilweb bash
```

Run setup script.
```
bash setup.sh
```

*OPTIONAL* You can run DB seeders if you want to have some data populated.
```
php artisan db:seed
```

Navigate to http://localhost:8000 and enjoy!

## Artisan commands

Remove uploaded images that are not associated to any item.
```
php artisan rm-img
```

## Tests

There are some tests that can be ran.
```
phpunit
```

## Postman

The `postman` directory contains a Postman collection and a Postman environment that can be imported into Postman and used for testing the API.

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

You can run db seeders if you want to have some data populated.
```
php artisan db:seed
```

Navigate to http://localhost:8000 and enjoy!
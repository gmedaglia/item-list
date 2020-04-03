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

Navigate to http://localhost:8000.
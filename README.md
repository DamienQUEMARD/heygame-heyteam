# Pre-requisites

- Docker
- Docker Compose
- PHP 8+
- Composer

# Starter Kit

## Install dependencies
    
```bash
composer install
```

## Run the application

```bash
./vendor/bin/sail up -d
```

## Run the migrations
```bash
./vendor/bin/sail artisan migrate
```

Now you can access the application at [http://localhost](http://localhost)


# Files

Product list is available in `storage/app/private/products.json` file.

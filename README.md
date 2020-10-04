# Barhive

Barhive is an open source project that implements a simple to use distributed point-of-sales (POS) system. This system is fit to be used by small hospitality industry businesses who wan't to adopt a modern sales process without investing in a physical POS system. Barhive is designed to run on any smartphone, table, or laptop.

The aim of the project is to enable business owners all over the world to digitize their bussiness without the upfront investment.

## Installation

The application is installed like any other Laravel application. It requires composer and npm to be installed.

```bash
# Clone the git repository
git clone https://github.com/bobluppes/barhive.git

cd ./barhive

# Install dependencies
composer install
npm install

# Build sources
npm run dev
```

Next, the environment variables need to be set. An example configuration can be found in `barhive/.env.example`, you can simply copy this file to `barhive/.env` and edit the variables accordingly. The most important settings are the database settings:

```
DB_DATABASE=[your_database_name]
DB_USERNAME=[database_username]
DB_PASSWORD=[database_password]
```

As a last step, artisan is used to get the application up and running.

```bash
# Set the application key
php artisan key:generate

# Migrate tables and seed
php artisan migrate
php artisan db:seed

# Serve the application on 127.0.0.1:8000
php artisan serve
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
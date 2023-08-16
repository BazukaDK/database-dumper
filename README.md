# Database Dumper

## Installation

Add the following to your `composer.json`
```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/BazukaDK/database-dumper"
    }
]
```

Run
```
composer require bazuka/database-dumper
```

Add this line to your `config/app.php` under "Package Service Providers"
```
Bazuka\DatabaseDumper\Providers\DatabaseDumperProvider::class,
```

Artisan command `database:dump` is now available.

Running `database:dump` will create a `.sql` backup of the database in `storage/app/backups`

For weekly backups add the following to your schedule in `kernel.php`.

```
$schedule->command('database:dump')->weekly();
```

## Development

To develop on this package a temporary dev project is needed. 

### Creating dev project

Create a temporary test project by following the [Laravel Documentation](https://laravel.com/docs/10.x/installation)

Once the project is created clone this repository into the project. Is should be cloned into the root of the project into `packages/bazuka`.

eg. `{YOUR_PROJECT}/packages/bazuka/database-dumper`.

### Installing necessary dependencies

Run
```
composer install
```

Add this line to your `config/app.php` under "Package Service Providers"
```
Bazuka\DatabaseDumper\Providers\DatabaseDumperProvider::class,
```

Add the following line to your `composer.json` under `autoload/psr-4`
```
"Bazuka\\DatabaseDumper\\": "packages/bazuka/database-dumper/src/"
```

### Install [Laravel Sail](https://laravel.com/docs/10.x/sail) for easier testing
```
composer require laravel/sail --dev
```
```
php artisan sail:install
```
Select `0` (mysql) and press `enter`

### Setting up `.env`

To overwrite default name *`backup-{Y-m-d}.sql`* add the following to your `.env`
```
DB_DUMP_NAME=my-dump
```
*`my-dump-{Y-m-d}.sql`*

### Running the test project

```
sail up -d
```

```
sail artisan migrate
```

```
sail artisan database:dump
```

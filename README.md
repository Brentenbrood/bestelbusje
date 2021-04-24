## Installation;

- Install composer dependencies using `composer install`
- Create a database with the same name and user as in the .env file
- Run `php artisan migrate`, `php artisan db:seed DatabaseSeeder`, and `php artisan serve`

## API endpoints
- List of companies: `127.0.0.1:8000/api/companies`
- List of total costs in ascending order: `127.0.0.1:8000/api/prices?km=148&days=1.5&volume=15` with adjustable parameters `km` `days` `volume`

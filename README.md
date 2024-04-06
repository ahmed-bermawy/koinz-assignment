# <p align="center">Koinz Assignment</p>

## Setup Instructions

1. Clone the repository `git clone git@github.com:ahmed-bermawy/koinz-assignment.git`
2. Run `composer install`
3. Run `php artisan key:generate`
4. Create a new database and update the `.env` file with the database credentials 
5. Run `php artisan config:cache`
6. Run `php artisan migrate`
7. Run `php artisan db:seed`
8. Run `php artisan serve`
9. To access api documentation visit `http://localhost:8000/api/documentation`
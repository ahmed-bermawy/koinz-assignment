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


## Docker Setup Instructions
1. Build the image by run `docker-compose build`
2. Run the container by run `docker-compose up -d`
3. To migrate database run `docker exec -it koinz-assignment php artisan migrate`
4. To seed database run `docker-compose exec koinz-assignment php artisan db:seed`
5. To access the container run `docker exec -it koinz-assignment /bin/bash`
6. After installation is finished you can access the application on `http://localhost:8006/`
7. To access api documentation visit `http://localhost:8006/api/documentation`

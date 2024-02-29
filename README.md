
## ABOUT 
The app is a simple task manager that allows users to create, read, update and delete tasks


## FEATURES

* Task CRUD operations
* User authentication
* Task assignment to users
* Task status update

## TECHNOLOGIES USED
* Laravel 10
* MySQL
* Vue 3
* Vuetify

## REQUIREMENTS
* PHP 8.0
* Git 
* Composer
* Node.js v18.0 or higher
* NPM v9.0 or higher
* NPM
* MySQL
* XAMPP or WAMP server

## INSTALLATION/RUNNING THE APP LOCALLY
To run the app locally, follow the steps below:

1. Clone the repository
    git clone https://github.com/andymush/Tasks.git


2. cd into the project directory & Install composer dependencies & npm dependencies

    composer install 
    npm install

3. Create a copy of your .env file

    cp .env.example .env

4. Generate an app encryption key

    php artisan key:generate

5. Create an empty database for our application

    e.g "tasks"

6. Add database information to the .env file

    DB_DATABASE=tasks
    DB_USERNAME=root
    DB_PASSWORD=

7. Migrate the database

    php artisan migrate

8. Seed the database

    php artisan db:seed

9. Run the server on two separate terminals

    terminal 1 - php artisan serve 
    terminal 2 - npm run dev

10. Visit the application on your browser

11. Login with the following credentials

    email: tester@gmail.com
    password: 1234567890

    
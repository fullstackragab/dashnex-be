# DashNex test project backend.

Create a FORK of this project (you'll need Bitbucket account), clone the project and run it before you proceed to task execution. You can check the code and when you are ready click the link provided to see the task description.

# Installation

## Docker way
- Install Docker and docker-compose from https://docs.docker.com/compose/install/
- Run `docker compose build --pull --no-cache` to build images
- Run `docker compose up` to start the containers, wait a few minutes for server to start. It does `composer install` under the hood so it can take some time. Wait for the message "NOTICE: ready to handle connections"

## CLI way
- Install PHP 8.2 with modules (common, intl, zip, apcu, opcache, xdebug, sqlite3) with apt, brew or exe file depending on your OS.
- Install Composer from https://getcomposer.org/download/
- Install Symfony CLI from https://symfony.com/download
- Run `composer install` to install vendor bundles
- Run `symfony serve` to start the development server

The server would be available on `http://localhost:8000` with the Swagger on `http://localhost:8000/api`

## Useful information:

- The database is included and located in `db` folder.
- Images are uploaded to `public/images` folder.
- To run the project run `symfony serve` or `docker-compose up`
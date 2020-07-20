# REST API Example
This is a REST API Example based on Symfony 5 and API Platform.

## Requirements
- PHP 7.4 CLI
- Composer
- Docker
- Docker-compose

## Setup
- Clone the project with git  
`git clone https://github.com/leondg/rest-api-example.git <project-dir>`

- Run composer in the project directory to install all the dependencies.  
`composer install`

- Run docker compose to start all the required containers.  
`docker-compose up -d`

- Now the REST API Example should be running on:  
`http://localhost:80`

- To get our API working we have to create our database and our tables with the following commands:  
`docker-compose exec fpm ./bin/console doctrine:database:create`  
`docker-compose exec fpm ./bin/console doctrine:schema:create`


## Tests
This API example contains the codeception test framework and the tests can be run with the following command:  
`docker-compose exec fpm ./vendor/bin/codecept run api`

Example results:
```
Codeception PHP Testing Framework v4.1.6
Powered by PHPUnit 9.2.6 by Sebastian Bergmann and contributors.
Running with seed:

App\Tests.api Tests (6) ----------------------------------------------------------
✔ RegistrationCest: Create registration (0.05s)
✔ RegistrationCest: Retrieve all registrations (0.02s)
✔ RegistrationCest: Retrieve registration by id (0.01s)
✔ RegistrationCest: Remove registration by id (0.01s)
✔ RegistrationCest: Replace registration by id (0.01s)
✔ RegistrationCest: Update registration by id (0.01s)
----------------------------------------------------------------------------------
Time: 00:00.257, Memory: 28.00 MB
OK (6 tests, 22 assertions)
```

## API Documentation
The API documentation can be found in the above mentioned url or click here:  
http://localhost/docs?ui=re_doc

_*No unit tests are available since everything is handled by API Platform_

## Improvements
- Handle composer installation inside its own container instead of locally so no seperate composer installation is necessary. This can cause problems when using different PHP versions locally versus the one used by the container.
- Use doctrine migrations bundle to handle database changes in the future.
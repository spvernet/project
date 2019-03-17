# PROJECT

This is a project developed using symfony 4.2. In order to execute the project, you only have to follow the steps.

### Steps:

**Step 1:** 
Clone this repository or if you have this project in a zip, unzip the project:

```
git clone https://github.com/spvernet/project.git test_sparra
cd test_sparra
``` 

**Step 2:** 
Install the dependencies that has the project

``` 
composer install
``` 

**Step 3:** 
Run the server using the following command:
``` 
php bin/console server:run
``` 

Once the server is up, there is an endpoint with the following structure:
```
localhost:8000/trial/{plaintiff}/{defendant} (GET)
```

### Other considerations:

- you can run the tests with the command:

```
php bin/phpunit 
```


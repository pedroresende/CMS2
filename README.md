CMS2
====

# Install

```
$ composer install
$ bin/console doctrine:schema:create
```

## Add base database 

```
$ bin/console doctrine:migrations:migrate -n
```


## Add an admin user

```
$ bin/console fos:user:create
```

### Promote the user to ROLE_ADMIN, in order to be able to access the admin interface

```
$ bin/console fos:user:promote
```

## Analytics

Step 1: Create a service account and download the JSON key

Follow the steps in the Google Identity Platform documentation to create a service account(https://developers.google.com/identity/protocols/OAuth2ServiceAccount#creatinganaccount) from the Google Developer Console(https://console.developers.google.com/).

Once the service account is created, you can click the Generate New JSON Key button to create and download the key and add it to your project.

Important!  Make sure to store your JSON key file privately and securely. Do not check it in to a public repository or store it on a public server. The file needs to be saved under app/config/client_secret.json.

Step 2: Add the service account as a user in Google Analytics

The service account you created in the previous step has an email address that you can add to any of the Google Analytics views you'd like to request data from. It's generally best to only grant the service account read-only access.

# Rest Api documentation

Access to /api/doc

# Docker

```
$ docker-compose up
```
In order to access the database

```
mysql -uroot -psymfony -P3307
```

Open your browser

```
http://localhost:81/
```

You can change the default variables values on .env file

# Tests

In order to execute the acceptance tests you need to run the following command

```
docker-compose run php bin/console doctrine:schema:create
docker-compose run php bin/console doctrine:migrations:migrate -n
docker-compose run php bin/console fos:user:create admin admin@admin.com admin
docker-compose run php bin/console fos:user:promote admin ROLE_ADMIN
docker-compose run php bin/codecept run acceptance --steps
```

CMS2
====

# Install

```
$ composer install
$ bin/console doctrine:schema:create
```

## Add base database 

```
$ bin/console doctrine:migrations:migrate
```


## Add an admin user

```
$ bin/console fos:user:create
```

### Promote the user to ROLE_ADMIN, in order to be able to access the admin interface

```
$ bin/console fos:user:promote
```

# Rest Api documentation

Access to /api/doc

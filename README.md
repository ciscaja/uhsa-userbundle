# Ciscaja Uhsa UserBundle

[![Build Status](https://travis-ci.org/ciscaja/uhsa-userbundle.svg?branch=master)](https://travis-ci.org/ciscaja/uhsa-userbundle)

The CiscajaUhsaUserBundle provides the backend functionality for the user
system of the ciscaja software suite.

Users can be stored in the following systems:
 
 * MySQL

## Usage

The ciscaja suite relies on the REST architecture with JWT authentication
which is done by the [LexikJWTAuthenticationBundle](https://github.com/lexik/LexikJWTAuthenticationBundle)
and the [GfreeauGetJWTBundle](https://github.com/gfreeau/GfreeauGetJWTBundle)
(opional).

Add both bundles to your composer.json:
```
        "lexik/jwt-authentication-bundle": "1.5.*",
        "gfreeau/get-jwt-bundle": "2.0.x-dev",
```

Configure both bundles properly according to their documentation with the
CiscajaUhsaUserbundle User entity and the user_checker. For security 
reasons you should also set an encoder for the User entity. 

*Note*: The user_checker is optional. If you dont configure it a user 
may be able to login, even if he isn't allowed to.

An example configuration of your security.yml could look like this:
```
security:
    encoders:
        Ciscaja\Uhsa\UserBundle\Entity\User: sha512
    providers:
        database:
            entity:
                class: CiscajaUhsaUserBundle:User
                property: username
    firewalls:
        token:
            pattern:  ^/api/token
            stateless: true
            gfreeau_get_jwt:
                user_checker: ciscaja.uhsa.userbundle.user_checker
        api:
            pattern:   ^/api
            stateless: true
            # default configuration
            lexik_jwt: ~ # check token in Authorization Header, with a value prefix of e:    bearer
```


## Testing

```
git clone https://github.com/ciscaja/uhsa-userbundle.git ciscaja-uhsa-userbundle
cd ciscaja-uhsa-userbundle/
composer update
bin/phpunit
```

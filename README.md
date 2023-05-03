## Laravel TestMobileApp (API)

Laravel Pet Project (TestMobileApp)


## Set-Up Commands (test data)

- php artisan migrate
- php artisan db:seed

For re-buildbing both migrations & seed you can use:
- php artisan migrate:fresh --seed

To rollback tables:
- php artisan migrate:rollback

## API

Locations:
- GET api/locations/ - list, paginated
- GET api/locations/{id} - single location details, includes 'shop', 'prefecture', 'socials' and 'photos' relational data
- POST api/locations/{id} - create location


Maps:
- api/maps/ - list, paginated
- api/maps/{id} - single map details


Tiles:
- api/tiles/ - list, paginated
- api/tiles/{id} - single tile details
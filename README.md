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
- api/locations/ - list, paginated
- api/locations/?shop_id=<shop_id> - list filtered by shop_id
- api/locations/<id> - single location details


Maps:
- api/maps/ - list, paginated
- api/maps/<id> - single map details


Tiles:
- api/tiles/ - list, paginated
- api/tiles/<id> - single tile details
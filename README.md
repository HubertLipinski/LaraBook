# LaraBook
Simple Book API

### Specs
- Php: 7.4 <br>
- MySql: 5.6

## Startup guide
### Project
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan passport:client --password
```

### SMS notifications
Update SMS_API_TOKEN in the .env file

### API Documentation
- **Live demo** at: https://app.swaggerhub.com/apis-docs/HubertLipinski/LaraBook_API/1.0.0
- Run ``` php artsan l5-swagger:generate ``` and then proceed to http://localhost/api/documentation

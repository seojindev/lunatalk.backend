# Lunatalk Backend

## Lunatalk Back-End Source.

### app script
1. app app-rewset

```angular2html
composer app-reset
```

```angular2html
php artisan migrate:refresh
php artisan passport:install
php artisan db:seed --class=CodesSeeder --force
```



> 데이베이스 초기화 조심해야함.

2. app clear
```angular2html
composer app-clear
```

2. unitest
```angular2html
composer unit-test:clear
composer unit-test:watch

./vendor/bin/phpunit-watcher watch --filter=test_login_

php artisan test
```

> php artisan db:seed --class=CodesSeeder --force


> 기존 상춤 정보 가지고 오기

```angular2html

# php artisan products:txt-to-json
# php artisan products:json-to-create

```

asdasdasdasd

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)

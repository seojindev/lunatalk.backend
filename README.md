# Lunatalk Backend

## Lunatalk Back-End Source.

### app script
1. app app-reset

```bash
composer app-reset
```

```bash
php artisan migrate:refresh
php artisan passport:install
php artisan db:seed --class=CodesSeeder --force
```



> 데이베이스 초기화 조심해야함.

2. app clear
```bash
composer app-clear
```

2. unitest
```bash
> 테스트 설정 리셋.
composer app-test:clear
php artisan db:wipe --env=testing && php artisan migrate --seed --env=testing && php artisan passport:install --force --env=testing
php artisan db:wipe && php artisan migrate --seed && php artisan passport:install --force

> 유닌 테스트 와치 실행. 
composer app-test:watch

> 팩토리 데이터 실행 ( 데이터 베이스 리셋. )
composer app-test:factory

./vendor/bin/phpunit-watcher watch --filter=test_login_

php artisan test
php artisan test --stop-on-failure
php artisan db:seed --class=CodesSeeder --force
```

3. 기존 상품 정보 가지고 오기

```bash

# php artisan products:txt-to-json
# php artisan products:json-to-create

php artisan dev:product-create-json
php artisan dev:product-create

```

> tinker factory

```bash
User::factory()->count(5)->create();
PhoneVerify::factory()->count(5)->create();
ProductCategory::factory()->count(5)->create();
UserRegisterSelects::factory()->count(5)->create();
MediaFiles::factory()->count(5)->create();



```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)

# Lunatalk Backend

## Lunatalk Back-End Source.

### app script

#### app-reset

```bash
composer app-reset
```

```bash
php artisan migrate:refresh
php artisan passport:install
php artisan db:seed --class=CodesSeeder --force
```

> 데이베이스 초기화 조심해야함.

#### ssh tunneling
```bash
ssh lunatalk-dev -N -L 63306:localhost:3306
```

#### app clear
```bash
composer app-clear
```

#### unitest
```bash
> 테스트 설정 리셋.
composer app-test:clear
php artisan db:wipe --env=testing && php artisan migrate --seed --env=testing && php artisan passport:install --force --env=testing
php artisan db:wipe && php artisan migrate --seed && php artisan passport:install --force

> 유닛 테스트 와치 실행.
composer app-test:watch

> 팩토리 데이터 실행 ( 데이터 베이스 리셋. )
composer app-test:factory

./vendor/bin/phpunit-watcher watch --filter=test_login_

php artisan test
php artisan test --stop-on-failure
php artisan db:seed --class=CodesSeeder --force
```

#### 기존 상품 정보 가지고 오기

```bash

# php artisan products:txt-to-json
# php artisan products:json-to-create

php artisan dev:product-create-json
php artisan dev:product-create

```

#### tinker factory

```bash
User::factory()->count(5)->create();
PhoneVerify::factory()->count(5)->create();
ProductCategory::factory()->count(5)->create();
UserRegisterSelects::factory()->count(5)->create();
MediaFiles::factory()->count(5)->create();
```

#### Docker
```bash
// 빌드
docker-compose build --force-rm

// 이미지 초기화
docker system prune -a


docker rmi $(docker images --filter "dangling=true" -q --no-trunc)
docker rmi $(docker images -q --no-trunc)
docker kill $(docker ps -q)
docker rm $(docker ps -a -q)

docker kill $(docker ps -q) && docker rm $(docker ps -a -q) && docker rmi $(docker images -q --no-trunc) && docker-compose build --force-rm

docker-compose up -d

// 컨테이너 접속
docker-compose exec lunatalk-backend /bin/bash


// production mysql
/dockerfiles/*.pem 추가.
docker-compose exec lunatalk-backend /bin/bash
ssh -i /tmp/data/lunatalk_backend.pem ubuntu@15.165.251.36 -N -L 63306:localhost:3306
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)

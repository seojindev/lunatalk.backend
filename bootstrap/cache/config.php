<?php return array (
  'app' => 
  array (
    'name' => 'Lunatalk Backend Server',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://lunatalk.backend.test',
    'asset_url' => NULL,
    'timezone' => 'Asia/Seoul',
    'locale' => 'ko',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:/4nr+AeJ2RmfxQz5MoDaUllx4VJcywJ93YYk7T9I4v8=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'App\\Providers\\AppServiceProvider',
      23 => 'App\\Providers\\AuthServiceProvider',
      24 => 'App\\Providers\\EventServiceProvider',
      25 => 'App\\Providers\\RouteServiceProvider',
      26 => 'Barryvdh\\LaravelIdeHelper\\IdeHelperServiceProvider',
      27 => 'App\\Providers\\ResponseMacroServiceProvider',
      28 => 'App\\Providers\\CustomFacadesProvider',
      29 => 'App\\Providers\\FrontServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'Date' => 'Illuminate\\Support\\Facades\\Date',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Http' => 'Illuminate\\Support\\Facades\\Http',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Helper' => 'App\\Http\\Repositories\\CustomFacades',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'passport',
        'provider' => 'users',
        'hash' => false,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
        'throttle' => 60,
      ),
    ),
    'password_timeout' => 10800,
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'useTLS' => true,
        ),
      ),
      'ably' => 
      array (
        'driver' => 'ably',
        'key' => NULL,
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
        'serialize' => false,
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
        'lock_connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/storage/framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
        'lock_connection' => 'default',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
      'octane' => 
      array (
        'driver' => 'octane',
      ),
    ),
    'prefix' => 'lunatalk_backend_server_cache',
  ),
  'cors' => 
  array (
    'paths' => 
    array (
      0 => 'api/*',
      1 => 'sanctum/csrf-cookie',
    ),
    'allowed_methods' => 
    array (
      0 => '*',
    ),
    'allowed_origins' => 
    array (
      0 => '*',
    ),
    'allowed_origins_patterns' => 
    array (
    ),
    'allowed_headers' => 
    array (
      0 => '*',
    ),
    'exposed_headers' => 
    array (
    ),
    'max_age' => 0,
    'supports_credentials' => false,
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'local_lunatalk',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => 'psmever.iptime.org',
        'port' => '43306',
        'database' => 'local_lunatalk',
        'username' => 'dbdev',
        'password' => '1212',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'testing' => 
      array (
        'driver' => 'mysql',
        'host' => 'psmever.iptime.org',
        'port' => '43306',
        'database' => 'local_lunatalk',
        'username' => 'dbdev',
        'password' => '1212',
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => 'psmever.iptime.org',
        'port' => '43306',
        'database' => 'local_lunatalk',
        'username' => 'dbdev',
        'password' => '1212',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => 'psmever.iptime.org',
        'port' => '43306',
        'database' => 'local_lunatalk',
        'username' => 'dbdev',
        'password' => '1212',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'phpredis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'lunatalk_backend_server_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '0',
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '1',
      ),
    ),
  ),
  'extract' => 
  array (
    'default' => 
    array (
      'list_paging' => 15,
      'user_client' => '0100010',
      'user_type' => '1100010',
      'user_level' => '1200010',
      'user_status' => '1300100',
      'front_code' => '0100010',
      'ios_code' => '0100020',
      'android_code' => '0100030',
      'service_front_code' => '0100040',
      'site_notice_code' => '2200000',
    ),
    'notification' => 
    array (
      'slack_webhook_url' => NULL,
    ),
    'user_level' => 
    array (
      'guest' => 
      array (
        'name' => '게스트',
        'level_code' => '1200000',
      ),
      'normal' => 
      array (
        'name' => '일반 사용자',
        'level_code' => '1200010',
      ),
      'admin' => 
      array (
        'name' => '관리자',
        'level_code' => '1200900',
      ),
      'root' => 
      array (
        'name' => '최고 관리자',
        'level_code' => '1209999',
      ),
    ),
    'user_status' => 
    array (
      'block' => 
      array (
        'name' => '차단',
        'code' => '1300000',
      ),
      'deny' => 
      array (
        'name' => '제한',
        'code' => '1300010',
      ),
      'waiting' => 
      array (
        'name' => '대기',
        'code' => '1300011',
      ),
      'normal' => 
      array (
        'name' => '정상',
        'code' => '1300100',
      ),
    ),
    'main_item' => 
    array (
      'bestItem' => 
      array (
        'name' => '베스트 아이템',
        'code' => '2300000',
      ),
      'newItem' => 
      array (
        'name' => '뉴 아이템',
        'code' => '2300010',
      ),
    ),
    'client' => 
    array (
      '0100010' => 'Front',
      '0100020' => 'iOS',
      '0100030' => 'Android',
      '0100040' => 'Service - Front',
    ),
    'type' => 
    array (
      1100010 => 'Lunatalk',
      1100020 => 'Kakao',
      1100030 => 'Naver',
    ),
    'level' => 
    array (
      1200000 => 'Guest',
      1200010 => '일반 사용자',
      1200900 => '관리자',
      1209999 => '최고 관리자',
    ),
    'state' => 
    array (
      1300000 => '차단',
      1300010 => '제한',
      1300011 => '대기',
      1300100 => '정상',
    ),
    'mediaCategory' => 
    array (
      'repImage' => 
      array (
        'name' => '상품이미지',
        'code' => '3000010',
      ),
      'thumbnailImage' => 
      array (
        'name' => '상품이미지',
        'code' => '3000020',
      ),
      'detailImage' => 
      array (
        'name' => '상품 상세 이미지',
        'code' => '3000030',
      ),
    ),
    'prohibit' => 
    array (
      'login_id' => 'admin,administrator,webmaster,sysop,manager,root,su,guest',
      'nickname' => '관리자,운영자,어드민,주인장,웹마스터,시삽,시샵,매니저,메니저,루트,방문객,테스트,닉네임',
      'word' => '18아,18놈,18새끼,18뇬,18노,18것,18넘,개년,개놈,개뇬,개새,개색끼,개세끼,개세이,개쉐이,개쉑,개쉽,개시키,개자식,개좆,게색기,게색끼,광뇬,뇬,눈깔,뉘미럴,니귀미,니기미,니미,도촬,되질래,뒈져라,뒈진다,디져라,디진다,디질래,병쉰,병신,뻐큐,뻑큐,뽁큐,삐리넷,새꺄,쉬발,쉬밸,쉬팔,쉽알,스패킹,스팽,시벌,시부랄,시부럴,시부리,시불,시브랄,시팍,시팔,시펄,실밸,십8,십쌔,십창,싶알,쌉년,썅놈,쌔끼,쌩쑈,썅,써벌,썩을년,쎄꺄,쎄엑,쓰바,쓰발,쓰벌,쓰팔,씨8,씨댕,씨바,씨발,씨뱅,씨봉알,씨부랄,씨부럴,씨부렁,씨부리,씨불,씨브랄,씨빠,씨빨,씨뽀랄,씨팍,씨팔,씨펄,씹,아가리,아갈이,엄창,접년,잡놈,재랄,저주글,조까,조빠,조쟁이,조지냐,조진다,조질래,존나,존니,좀물,좁년,좃,좆,좇,쥐랄,쥐롤,쥬디,지랄,지럴,지롤,지미랄,쫍빱,凸,퍽큐,뻑큐,빠큐,ㅅㅂㄹㅁ',
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/storage/app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/storage/app/public',
        'url' => 'http://lunatalk.backend.test/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'url' => NULL,
        'endpoint' => NULL,
        'use_path_style_endpoint' => false,
      ),
      'inside-space' => 
      array (
        'driver' => 'local',
        'root' => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/storage/inside/space',
      ),
      'inside-temp' => 
      array (
        'driver' => 'local',
        'root' => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/storage/inside/temp',
      ),
      'media-server' => 
      array (
        'driver' => 'sftp',
        'host' => 'psmever.iptime.org',
        'port' => '42022',
        'username' => 'sm',
        'password' => 'alsrns78',
        'privateKey' => '',
        'root' => '/var/www/site/lunatalk.co.kr/lunatalk.media/public',
        'timeout' => 30,
        'directoryPerm' => 493,
      ),
    ),
    'links' => 
    array (
      '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/public/storage' => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/storage/app/public',
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'ide-helper' => 
  array (
    'filename' => '_ide_helper.php',
    'meta_filename' => '.phpstorm.meta.php',
    'include_fluent' => false,
    'include_factory_builders' => false,
    'write_model_magic_where' => true,
    'write_model_external_builder_methods' => true,
    'write_model_relation_count_properties' => true,
    'write_eloquent_model_mixins' => false,
    'include_helpers' => false,
    'helper_files' => 
    array (
      0 => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/vendor/laravel/framework/src/Illuminate/Support/helpers.php',
    ),
    'model_locations' => 
    array (
      0 => 'app',
    ),
    'ignored_models' => 
    array (
    ),
    'model_hooks' => 
    array (
    ),
    'extra' => 
    array (
      'Eloquent' => 
      array (
        0 => 'Illuminate\\Database\\Eloquent\\Builder',
        1 => 'Illuminate\\Database\\Query\\Builder',
      ),
      'Session' => 
      array (
        0 => 'Illuminate\\Session\\Store',
      ),
    ),
    'magic' => 
    array (
    ),
    'interfaces' => 
    array (
    ),
    'custom_db_types' => 
    array (
    ),
    'model_camel_case_properties' => false,
    'type_overrides' => 
    array (
      'integer' => 'int',
      'boolean' => 'bool',
    ),
    'include_class_docblocks' => false,
    'force_fqn' => false,
    'additional_relation_types' => 
    array (
    ),
    'post_migrate' => 
    array (
    ),
  ),
  'image' => 
  array (
    'driver' => 'imagick',
  ),
  'logging' => 
  array (
    'default' => 'daily',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'daily',
        'path' => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/storage/logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/storage/logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => 'https://hooks.slack.com/services/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',
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'debug',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
      'emergency' => 
      array (
        'path' => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/storage/logs/laravel.log',
      ),
      'ServiceErrorExceptionLog' => 
      array (
        'driver' => 'daily',
        'path' => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/storage/logs/2021/12/ServiceErrorExceptionLog.log',
        'level' => 'debug',
        'days' => 31,
      ),
      'NotFoundHttpException' => 
      array (
        'driver' => 'daily',
        'path' => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/storage/logs/2021/12/NotFoundHttpException.log',
        'level' => 'debug',
        'days' => 31,
      ),
      'MethodNotAllowedHttpException' => 
      array (
        'driver' => 'daily',
        'path' => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/storage/logs/2021/12/MethodNotAllowedHttpException.log',
        'level' => 'debug',
        'days' => 31,
      ),
      'ClientErrorException' => 
      array (
        'driver' => 'daily',
        'path' => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/storage/logs/2021/12/ClientErrorException.log',
        'level' => 'debug',
        'days' => 31,
      ),
      'ServerErrorException' => 
      array (
        'driver' => 'daily',
        'path' => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/storage/logs/2021/12/ServerErrorException.log',
        'level' => 'debug',
        'days' => 31,
      ),
      'ForbiddenErrorException' => 
      array (
        'driver' => 'daily',
        'path' => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/storage/logs/2021/12/ForbiddenErrorException.log',
        'level' => 'debug',
        'days' => 31,
      ),
      'AuthenticationException' => 
      array (
        'driver' => 'daily',
        'path' => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/storage/logs/2021/12/AuthenticationException.log',
        'level' => 'debug',
        'days' => 31,
      ),
      'ThrottleRequestsException' => 
      array (
        'driver' => 'daily',
        'path' => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/storage/logs/2021/12/ThrottleRequestsException.log',
        'level' => 'debug',
        'days' => 31,
      ),
      'PDOException' => 
      array (
        'driver' => 'daily',
        'path' => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/storage/logs/2021/12/PDOException.log',
        'level' => 'debug',
        'days' => 31,
      ),
      'Throwable' => 
      array (
        'driver' => 'daily',
        'path' => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/storage/logs/2021/12/Throwable.log',
        'level' => 'debug',
        'days' => 31,
      ),
    ),
  ),
  'mail' => 
  array (
    'default' => 'smtp',
    'mailers' => 
    array (
      'smtp' => 
      array (
        'transport' => 'smtp',
        'host' => 'mailhog',
        'port' => '1025',
        'encryption' => NULL,
        'username' => NULL,
        'password' => NULL,
        'timeout' => NULL,
        'auth_mode' => NULL,
      ),
      'ses' => 
      array (
        'transport' => 'ses',
      ),
      'mailgun' => 
      array (
        'transport' => 'mailgun',
      ),
      'postmark' => 
      array (
        'transport' => 'postmark',
      ),
      'sendmail' => 
      array (
        'transport' => 'sendmail',
        'path' => '/usr/sbin/sendmail -bs',
      ),
      'log' => 
      array (
        'transport' => 'log',
        'channel' => NULL,
      ),
      'array' => 
      array (
        'transport' => 'array',
      ),
    ),
    'from' => 
    array (
      'address' => NULL,
      'name' => 'Lunatalk Backend Server',
    ),
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/resources/views/vendor/mail',
      ),
    ),
  ),
  'queue' => 
  array (
    'default' => 'database',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
        'after_commit' => false,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
        'after_commit' => false,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => '',
        'secret' => '',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'default',
        'suffix' => NULL,
        'region' => 'us-east-1',
        'after_commit' => false,
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
        'after_commit' => false,
      ),
    ),
    'failed' => 
    array (
      'driver' => 'database-uuids',
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'lunatalk_backend_server_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => NULL,
    'http_only' => true,
    'same_site' => 'lax',
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/resources/views',
    ),
    'compiled' => '/Users/sm/Workspaces/Project/Works/Lunatalk.co.kr/lunatalk.backend/storage/framework/views',
  ),
  'flare' => 
  array (
    'key' => NULL,
    'reporting' => 
    array (
      'anonymize_ips' => true,
      'collect_git_information' => false,
      'report_queries' => true,
      'maximum_number_of_collected_queries' => 200,
      'report_query_bindings' => true,
      'report_view_data' => true,
      'grouping_type' => NULL,
      'report_logs' => true,
      'maximum_number_of_collected_logs' => 200,
      'censor_request_body_fields' => 
      array (
        0 => 'password',
      ),
    ),
    'send_logs_as_events' => true,
    'censor_request_body_fields' => 
    array (
      0 => 'password',
    ),
  ),
  'ignition' => 
  array (
    'editor' => 'phpstorm',
    'theme' => 'light',
    'enable_share_button' => true,
    'register_commands' => false,
    'ignored_solution_providers' => 
    array (
      0 => 'Facade\\Ignition\\SolutionProviders\\MissingPackageSolutionProvider',
    ),
    'enable_runnable_solutions' => NULL,
    'remote_sites_path' => '',
    'local_sites_path' => '',
    'housekeeping_endpoint_prefix' => '_ignition',
  ),
  'passport' => 
  array (
    'private_key' => NULL,
    'public_key' => NULL,
    'client_uuids' => false,
    'personal_access_client' => 
    array (
      'id' => NULL,
      'secret' => NULL,
    ),
    'storage' => 
    array (
      'database' => 
      array (
        'connection' => 'mysql',
      ),
    ),
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 94,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);

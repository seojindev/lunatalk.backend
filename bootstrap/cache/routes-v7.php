<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/oauth/authorize' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.authorizations.authorize',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'passport.authorizations.approve',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'passport.authorizations.deny',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/oauth/token' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.token',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/oauth/tokens' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.tokens.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/oauth/token/refresh' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.token.refresh',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/oauth/clients' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.clients.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'passport.clients.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/oauth/scopes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.scopes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/oauth/personal-access-tokens' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.personal.tokens.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'passport.personal.tokens.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/test/default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.test.default',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/test/test' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.test.test',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/test/user-insert' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.test.user-insert',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/system/check-status' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.system.check.status',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/system/check-notice' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.system.check.server.notice',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/system/base-data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.system.base.data',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/front/v1/auth/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.auth.register',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/front/v1/auth/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.auth.login',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/front/v1/auth/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.auth.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/front/v1/auth/token-info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.auth.token.info',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/front/v1/product/total-products' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.product.total.product.list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/front/v1/pages/main/main-slide' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.pages.main.main.slide',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/front/v1/pages/main/main-product-category' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.pages.main.main.product.category',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/front/v1/pages/main/main-product-best-item' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.pages.main.main.best.item',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/front/v1/pages/main/main-product-new-item' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.pages.main.main.new.item',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/front/v1/pages/main/main-notice' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.pages.main.main.notice',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/front/v1/pages/cart/list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.pages.cart.wish.list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/front/v1/pages/cart/many-delete' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.pages.cart.many.delete.cart.list',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/front/v1/pages/my-page/my-info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.pages.my-page.my.info',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.pages.my-page.update.my.info',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin-front/v1/auth/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.auth.login',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin-front/v1/auth/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.auth.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin-front/v1/system/notice' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.system.get.notice',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.system.create.notice',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin-front/v1/product/create-product-category' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.product.create.product.category',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin-front/v1/product/show-product-category' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.product.show.product.category',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin-front/v1/product/delete-product-categories' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.product.delete.product.categories',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin-front/v1/product/create-product' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.product.create.product',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin-front/v1/product/show-product' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.product.show.product',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin-front/v1/product/delete-products' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.product.delete.products',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin-front/v1/product/show-product-reviews' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.product.show.product.review',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin-front/v1/product/create-product-badge-image' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.product.create.product.badge.image',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin-front/v1/product/show-product-badges' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.product.show-product-badges',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin-front/v1/page-manage/create-main-slide' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.page-manage.create.main.slide',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin-front/v1/page-manage/show-main-slide' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.page-manage.show.main.slide',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin-front/v1/page-manage/delete-main-slides' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.page-manage.delete.main.slides',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin-front/v1/page-manage/show-best-item' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.page-manage.show.best.item',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin-front/v1/page-manage/show-new-item' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.page-manage.show.new.item',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin-front/v1/site-manage/create-notice' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.site-manage.create.notice',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin-front/v1/site-manage/delete-notice' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.site-manage.delete.notice',
          ),
          1 => NULL,
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin-front/v1/site-manage/show-notice' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.site-manage.show.notice',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin-front/v1/user-manage/show-user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.user-manage.show.user',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin-front/v1/user-manage/create-user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.user-manage.create.user',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/oauth/(?|tokens/([^/]++)(*:32)|clients/([^/]++)(?|(*:58))|personal\\-access\\-tokens/([^/]++)(*:99))|/api/(?|other/v1/media/([^/]++)/([^/]++)/create(*:154)|front/v1/(?|auth/(?|([^/]++)/phone\\-auth(*:202)|([0-9]+)/phone\\-auth\\-confirm(*:239))|p(?|roduct/([^/]++)/(?|detail(*:277)|search\\-list(*:297)|list\\-review(*:317)|create\\-review(*:339))|ages/(?|main/([^/]++)/notice\\-detail(*:384)|product(?|\\-category/([^/]++)/list(*:426)|/([^/]++)/detail(*:450))|cart/(?|([^/]++)/create(*:482)|([0-9]+)/delete(*:505)))))|admin\\-front/v1/(?|p(?|roduct/(?|([^/]++)/(?|de(?|tail\\-product(?|\\-category(*:593)|(*:601))|lete\\-product(?|\\-category(*:636)|(*:644)))|update\\-product(?|\\-category(*:682)|(*:690)))|([0-9]+)/detail\\-product\\-reviews(*:733)|([0-9]+)/answer\\-product\\-review(*:773)|([^/]++)/(?|detail\\-product\\-badges(*:816)|update\\-product\\-badges(*:847)))|age\\-manage/([^/]++)/(?|de(?|tail\\-main\\-slide(*:903)|lete\\-(?|best\\-item(*:930)|new\\-item(*:947)))|update\\-main\\-slide(*:976)|create\\-(?|best\\-item(*:1005)|new\\-item(*:1023))))|site\\-manage/([^/]++)/(?|update\\-notice(*:1074)|detail\\-notice(*:1097))|user\\-manage/([^/]++)/(?|de(?|tail\\-user(*:1147)|lete\\-user(*:1166))|update\\-user(?|(*:1191)|\\-p(?|assword(*:1213)|hone\\-number(*:1234)))))))/?$}sDu',
    ),
    3 => 
    array (
      32 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.tokens.destroy',
          ),
          1 => 
          array (
            0 => 'token_id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      58 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.clients.update',
          ),
          1 => 
          array (
            0 => 'client_id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'passport.clients.destroy',
          ),
          1 => 
          array (
            0 => 'client_id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      99 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'passport.personal.tokens.destroy',
          ),
          1 => 
          array (
            0 => 'token_id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      154 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.other.v1.media.create',
          ),
          1 => 
          array (
            0 => 'mediaName',
            1 => 'mediaCategory',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      202 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.auth.phone.auth',
          ),
          1 => 
          array (
            0 => 'phoneNumber',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      239 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.auth.phone.auth.confirm',
          ),
          1 => 
          array (
            0 => 'authIndex',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      277 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.product.product.detail',
          ),
          1 => 
          array (
            0 => 'uuid',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      297 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.product.product.search.list',
          ),
          1 => 
          array (
            0 => 'search',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      317 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.product.product.review.list',
          ),
          1 => 
          array (
            0 => 'uuid',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      339 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.product.product.review.create',
          ),
          1 => 
          array (
            0 => 'uuid',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      384 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.pages.main.main.notice.detail',
          ),
          1 => 
          array (
            0 => 'uuid',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      426 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.pages.product-category.product.category.list',
          ),
          1 => 
          array (
            0 => 'uuid',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      450 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.pages.product.product.category.list',
          ),
          1 => 
          array (
            0 => 'uuid',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      482 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.pages.cart.create.cart.list',
          ),
          1 => 
          array (
            0 => 'product_uuid',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      505 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.front.v1.pages.cart.delete.cart.list',
          ),
          1 => 
          array (
            0 => 'cart_id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      593 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.product.detail.product.category',
          ),
          1 => 
          array (
            0 => 'productCategoryUUID',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      601 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.product.detail.product',
          ),
          1 => 
          array (
            0 => 'productUUID',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      636 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.product.delete.product.category',
          ),
          1 => 
          array (
            0 => 'productCategoryUUID',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      644 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.product.delete.product',
          ),
          1 => 
          array (
            0 => 'productUUID',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      682 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.product.update.product.category',
          ),
          1 => 
          array (
            0 => 'productCategoryUUID',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      690 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.product.update.product',
          ),
          1 => 
          array (
            0 => 'productUUID',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      733 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.product.detail.product.review',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      773 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.product.answer.product.review',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      816 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.product.detail.product.badges',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      847 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.product.update.product.badges',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      903 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.page-manage.detail.main.slide',
          ),
          1 => 
          array (
            0 => 'mainSlideUUID',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      930 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.page-manage.delete.best.item',
          ),
          1 => 
          array (
            0 => 'uuid',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      947 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.page-manage.delete.new.item',
          ),
          1 => 
          array (
            0 => 'uuid',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      976 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.page-manage.update.main.slide',
          ),
          1 => 
          array (
            0 => 'mainSlideUUID',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1005 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.page-manage.create.best.item',
          ),
          1 => 
          array (
            0 => 'uuid',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1023 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.page-manage.create.new.item',
          ),
          1 => 
          array (
            0 => 'uuid',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1074 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.site-manage.update.notice',
          ),
          1 => 
          array (
            0 => 'noticeUUID',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1097 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.site-manage.detail.notice',
          ),
          1 => 
          array (
            0 => 'noticeUUID',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1147 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.user-manage.detail.user',
          ),
          1 => 
          array (
            0 => 'uuid',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1166 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.user-manage.delete.user',
          ),
          1 => 
          array (
            0 => 'uuid',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1191 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.user-manage.update.user',
          ),
          1 => 
          array (
            0 => 'uuid',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1213 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.user-manage.update.user.password',
          ),
          1 => 
          array (
            0 => 'uuid',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1234 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'api.admin-front.v1.user-manage.update.user.phone.number',
          ),
          1 => 
          array (
            0 => 'uuid',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'passport.authorizations.authorize' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'oauth/authorize',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\AuthorizationController@authorize',
        'as' => 'passport.authorizations.authorize',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\AuthorizationController@authorize',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.authorizations.approve' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'oauth/authorize',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\ApproveAuthorizationController@approve',
        'as' => 'passport.authorizations.approve',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\ApproveAuthorizationController@approve',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.authorizations.deny' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'oauth/authorize',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\DenyAuthorizationController@deny',
        'as' => 'passport.authorizations.deny',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\DenyAuthorizationController@deny',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.token' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'oauth/token',
      'action' => 
      array (
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\AccessTokenController@issueToken',
        'as' => 'passport.token',
        'middleware' => 'throttle',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\AccessTokenController@issueToken',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.tokens.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'oauth/tokens',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\AuthorizedAccessTokenController@forUser',
        'as' => 'passport.tokens.index',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\AuthorizedAccessTokenController@forUser',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.tokens.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'oauth/tokens/{token_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\AuthorizedAccessTokenController@destroy',
        'as' => 'passport.tokens.destroy',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\AuthorizedAccessTokenController@destroy',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.token.refresh' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'oauth/token/refresh',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\TransientTokenController@refresh',
        'as' => 'passport.token.refresh',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\TransientTokenController@refresh',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.clients.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'oauth/clients',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController@forUser',
        'as' => 'passport.clients.index',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController@forUser',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.clients.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'oauth/clients',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController@store',
        'as' => 'passport.clients.store',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController@store',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.clients.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'oauth/clients/{client_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController@update',
        'as' => 'passport.clients.update',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController@update',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.clients.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'oauth/clients/{client_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController@destroy',
        'as' => 'passport.clients.destroy',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\ClientController@destroy',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.scopes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'oauth/scopes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\ScopeController@all',
        'as' => 'passport.scopes.index',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\ScopeController@all',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.personal.tokens.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'oauth/personal-access-tokens',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController@forUser',
        'as' => 'passport.personal.tokens.index',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController@forUser',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.personal.tokens.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'oauth/personal-access-tokens',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController@store',
        'as' => 'passport.personal.tokens.store',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController@store',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'passport.personal.tokens.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'oauth/personal-access-tokens/{token_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController@destroy',
        'as' => 'passport.personal.tokens.destroy',
        'controller' => '\\Laravel\\Passport\\Http\\Controllers\\PersonalAccessTokenController@destroy',
        'namespace' => '\\Laravel\\Passport\\Http\\Controllers',
        'prefix' => 'oauth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.test.default' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/test/default',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\TestController@default',
        'controller' => 'App\\Http\\Controllers\\Api\\TestController@default',
        'as' => 'api.test.default',
        'namespace' => NULL,
        'prefix' => 'api/test',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.test.test' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/test/test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\TestController@test',
        'controller' => 'App\\Http\\Controllers\\Api\\TestController@test',
        'as' => 'api.test.test',
        'namespace' => NULL,
        'prefix' => 'api/test',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.test.user-insert' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/test/user-insert',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\TestController@user_insert',
        'controller' => 'App\\Http\\Controllers\\Api\\TestController@user_insert',
        'as' => 'api.test.user-insert',
        'namespace' => NULL,
        'prefix' => 'api/test',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.system.check.status' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/system/check-status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\SystemController@checkStatus',
        'controller' => 'App\\Http\\Controllers\\Api\\SystemController@checkStatus',
        'as' => 'api.system.check.status',
        'namespace' => 'system',
        'prefix' => 'api/system',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.system.check.server.notice' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/system/check-notice',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\SystemController@checkServerNotice',
        'controller' => 'App\\Http\\Controllers\\Api\\SystemController@checkServerNotice',
        'as' => 'api.system.check.server.notice',
        'namespace' => 'system',
        'prefix' => 'api/system',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.system.base.data' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/system/base-data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\SystemController@baseData',
        'controller' => 'App\\Http\\Controllers\\Api\\SystemController@baseData',
        'as' => 'api.system.base.data',
        'namespace' => 'system',
        'prefix' => 'api/system',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.other.v1.media.create' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/other/v1/media/{mediaName}/{mediaCategory}/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Other\\v1\\MediaController@createMedia',
        'controller' => 'App\\Http\\Controllers\\Api\\Other\\v1\\MediaController@createMedia',
        'as' => 'api.other.v1.media.create',
        'namespace' => 'other\\v1',
        'prefix' => 'api/other/v1/media',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.auth.phone.auth' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/front/v1/auth/{phoneNumber}/phone-auth',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\AuthController@phoneAuth',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\AuthController@phoneAuth',
        'as' => 'api.front.v1.auth.phone.auth',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.auth.phone.auth.confirm' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/front/v1/auth/{authIndex}/phone-auth-confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\AuthController@phoneAuthConfirm',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\AuthController@phoneAuthConfirm',
        'as' => 'api.front.v1.auth.phone.auth.confirm',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'authIndex' => '[0-9]+',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.auth.register' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/front/v1/auth/register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\AuthController@register',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\AuthController@register',
        'as' => 'api.front.v1.auth.register',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.auth.login' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/front/v1/auth/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\AuthController@login',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\AuthController@login',
        'as' => 'api.front.v1.auth.login',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.auth.logout' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/front/v1/auth/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\AuthController@logout',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\AuthController@logout',
        'as' => 'api.front.v1.auth.logout',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.auth.token.info' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/front/v1/auth/token-info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\AuthController@tokenInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\AuthController@tokenInfo',
        'as' => 'api.front.v1.auth.token.info',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.product.total.product.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/front/v1/product/total-products',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\ProductController@totalProducts',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\ProductController@totalProducts',
        'as' => 'api.front.v1.product.total.product.list',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.product.product.detail' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/front/v1/product/{uuid}/detail',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\ProductController@productDetail',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\ProductController@productDetail',
        'as' => 'api.front.v1.product.product.detail',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.product.product.search.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/front/v1/product/{search}/search-list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\ProductController@productSearch',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\ProductController@productSearch',
        'as' => 'api.front.v1.product.product.search.list',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.product.product.review.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/front/v1/product/{uuid}/list-review',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\ProductController@listProductReview',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\ProductController@listProductReview',
        'as' => 'api.front.v1.product.product.review.list',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.product.product.review.create' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/front/v1/product/{uuid}/create-review',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\ProductController@createProductReview',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\ProductController@createProductReview',
        'as' => 'api.front.v1.product.product.review.create',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.pages.main.main.slide' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/front/v1/pages/main/main-slide',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\MainController@mainSlide',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\MainController@mainSlide',
        'as' => 'api.front.v1.pages.main.main.slide',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/pages/main',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.pages.main.main.product.category' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/front/v1/pages/main/main-product-category',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\MainController@mainProductCategory',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\MainController@mainProductCategory',
        'as' => 'api.front.v1.pages.main.main.product.category',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/pages/main',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.pages.main.main.best.item' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/front/v1/pages/main/main-product-best-item',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\MainController@mainBestItem',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\MainController@mainBestItem',
        'as' => 'api.front.v1.pages.main.main.best.item',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/pages/main',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.pages.main.main.new.item' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/front/v1/pages/main/main-product-new-item',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\MainController@mainNewItem',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\MainController@mainNewItem',
        'as' => 'api.front.v1.pages.main.main.new.item',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/pages/main',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.pages.main.main.notice' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/front/v1/pages/main/main-notice',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\MainController@mainNotice',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\MainController@mainNotice',
        'as' => 'api.front.v1.pages.main.main.notice',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/pages/main',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.pages.main.main.notice.detail' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/front/v1/pages/main/{uuid}/notice-detail',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\MainController@noticeDetail',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\MainController@noticeDetail',
        'as' => 'api.front.v1.pages.main.main.notice.detail',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/pages/main',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.pages.product-category.product.category.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/front/v1/pages/product-category/{uuid}/list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\ProductController@productCategoryList',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\ProductController@productCategoryList',
        'as' => 'api.front.v1.pages.product-category.product.category.list',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/pages/product-category',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.pages.product.product.category.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/front/v1/pages/product/{uuid}/detail',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\ProductController@productDetail',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\ProductController@productDetail',
        'as' => 'api.front.v1.pages.product.product.category.list',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/pages/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.pages.cart.wish.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/front/v1/pages/cart/list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\CartController@list',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\CartController@list',
        'as' => 'api.front.v1.pages.cart.wish.list',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/pages/cart',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.pages.cart.create.cart.list' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/front/v1/pages/cart/{product_uuid}/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\CartController@create',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\CartController@create',
        'as' => 'api.front.v1.pages.cart.create.cart.list',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/pages/cart',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.pages.cart.delete.cart.list' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/front/v1/pages/cart/{cart_id}/delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\CartController@delete',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\CartController@delete',
        'as' => 'api.front.v1.pages.cart.delete.cart.list',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/pages/cart',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'cart_id' => '[0-9]+',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.pages.cart.many.delete.cart.list' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/front/v1/pages/cart/many-delete',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\CartController@manyDelete',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\CartController@manyDelete',
        'as' => 'api.front.v1.pages.cart.many.delete.cart.list',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/pages/cart',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.pages.my-page.my.info' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/front/v1/pages/my-page/my-info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\MyPageController@myInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\MyPageController@myInfo',
        'as' => 'api.front.v1.pages.my-page.my.info',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/pages/my-page',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.front.v1.pages.my-page.update.my.info' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/front/v1/pages/my-page/my-info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\MyPageController@udpateMyInfo',
        'controller' => 'App\\Http\\Controllers\\Api\\Front\\v1\\Pages\\MyPageController@udpateMyInfo',
        'as' => 'api.front.v1.pages.my-page.update.my.info',
        'namespace' => 'front\\v1',
        'prefix' => 'api/front/v1/pages/my-page',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.auth.login' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/admin-front/v1/auth/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\AuthController@login',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\AuthController@login',
        'as' => 'api.admin-front.v1.auth.login',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.auth.logout' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/admin-front/v1/auth/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\AuthController@logout',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\AuthController@logout',
        'as' => 'api.admin-front.v1.auth.logout',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.system.get.notice' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin-front/v1/system/notice',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\SystemController@getSystemNotice',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\SystemController@getSystemNotice',
        'as' => 'api.admin-front.v1.system.get.notice',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/system',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.system.create.notice' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/admin-front/v1/system/notice',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\SystemController@createSystemNotice',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\SystemController@createSystemNotice',
        'as' => 'api.admin-front.v1.system.create.notice',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/system',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.product.create.product.category' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/admin-front/v1/product/create-product-category',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@createProductCategory',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@createProductCategory',
        'as' => 'api.admin-front.v1.product.create.product.category',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.product.show.product.category' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin-front/v1/product/show-product-category',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@showProductCategory',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@showProductCategory',
        'as' => 'api.admin-front.v1.product.show.product.category',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.product.detail.product.category' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin-front/v1/product/{productCategoryUUID}/detail-product-category',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@detailProductCategory',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@detailProductCategory',
        'as' => 'api.admin-front.v1.product.detail.product.category',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.product.update.product.category' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/admin-front/v1/product/{productCategoryUUID}/update-product-category',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@updateProductCategory',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@updateProductCategory',
        'as' => 'api.admin-front.v1.product.update.product.category',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.product.delete.product.category' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/admin-front/v1/product/{productCategoryUUID}/delete-product-category',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@deleteProductCategory',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@deleteProductCategory',
        'as' => 'api.admin-front.v1.product.delete.product.category',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.product.delete.product.categories' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/admin-front/v1/product/delete-product-categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@deleteProductCategories',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@deleteProductCategories',
        'as' => 'api.admin-front.v1.product.delete.product.categories',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.product.create.product' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/admin-front/v1/product/create-product',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@createProduct',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@createProduct',
        'as' => 'api.admin-front.v1.product.create.product',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.product.show.product' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin-front/v1/product/show-product',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@showProduct',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@showProduct',
        'as' => 'api.admin-front.v1.product.show.product',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.product.update.product' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/admin-front/v1/product/{productUUID}/update-product',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@updateProduct',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@updateProduct',
        'as' => 'api.admin-front.v1.product.update.product',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.product.detail.product' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin-front/v1/product/{productUUID}/detail-product',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@detailProduct',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@detailProduct',
        'as' => 'api.admin-front.v1.product.detail.product',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.product.delete.product' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/admin-front/v1/product/{productUUID}/delete-product',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@deleteProduct',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@deleteProduct',
        'as' => 'api.admin-front.v1.product.delete.product',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.product.delete.products' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/admin-front/v1/product/delete-products',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@deleteProducts',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@deleteProducts',
        'as' => 'api.admin-front.v1.product.delete.products',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.product.show.product.review' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin-front/v1/product/show-product-reviews',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@showProductReviews',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@showProductReviews',
        'as' => 'api.admin-front.v1.product.show.product.review',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.product.detail.product.review' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin-front/v1/product/{id}/detail-product-reviews',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@detailProductReviews',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@detailProductReviews',
        'as' => 'api.admin-front.v1.product.detail.product.review',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'id' => '[0-9]+',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.product.answer.product.review' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/admin-front/v1/product/{id}/answer-product-review',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@answerProductReview',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@answerProductReview',
        'as' => 'api.admin-front.v1.product.answer.product.review',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'id' => '[0-9]+',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.product.create.product.badge.image' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/admin-front/v1/product/create-product-badge-image',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@createProductBadgeImage',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@createProductBadgeImage',
        'as' => 'api.admin-front.v1.product.create.product.badge.image',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.product.show-product-badges' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin-front/v1/product/show-product-badges',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@showProductBadges',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@showProductBadges',
        'as' => 'api.admin-front.v1.product.show-product-badges',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.product.detail.product.badges' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin-front/v1/product/{id}/detail-product-badges',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@detailProductBadges',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@detailProductBadges',
        'as' => 'api.admin-front.v1.product.detail.product.badges',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.product.update.product.badges' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/admin-front/v1/product/{id}/update-product-badges',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@updateProductBadges',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\ProductController@updateProductBadges',
        'as' => 'api.admin-front.v1.product.update.product.badges',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/product',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.page-manage.create.main.slide' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/admin-front/v1/page-manage/create-main-slide',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\PageManageController@createMainSlide',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\PageManageController@createMainSlide',
        'as' => 'api.admin-front.v1.page-manage.create.main.slide',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/page-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.page-manage.show.main.slide' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin-front/v1/page-manage/show-main-slide',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\PageManageController@showMainSlide',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\PageManageController@showMainSlide',
        'as' => 'api.admin-front.v1.page-manage.show.main.slide',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/page-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.page-manage.detail.main.slide' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin-front/v1/page-manage/{mainSlideUUID}/detail-main-slide',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\PageManageController@detailMainSlide',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\PageManageController@detailMainSlide',
        'as' => 'api.admin-front.v1.page-manage.detail.main.slide',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/page-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.page-manage.update.main.slide' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/admin-front/v1/page-manage/{mainSlideUUID}/update-main-slide',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\PageManageController@updateMainSlide',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\PageManageController@updateMainSlide',
        'as' => 'api.admin-front.v1.page-manage.update.main.slide',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/page-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.page-manage.delete.main.slides' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/admin-front/v1/page-manage/delete-main-slides',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\PageManageController@deleteMainSlide',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\PageManageController@deleteMainSlide',
        'as' => 'api.admin-front.v1.page-manage.delete.main.slides',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/page-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.page-manage.create.best.item' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/admin-front/v1/page-manage/{uuid}/create-best-item',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\PageManageController@createBestItem',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\PageManageController@createBestItem',
        'as' => 'api.admin-front.v1.page-manage.create.best.item',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/page-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.page-manage.delete.best.item' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/admin-front/v1/page-manage/{uuid}/delete-best-item',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\PageManageController@deleteBestItem',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\PageManageController@deleteBestItem',
        'as' => 'api.admin-front.v1.page-manage.delete.best.item',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/page-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.page-manage.show.best.item' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin-front/v1/page-manage/show-best-item',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\PageManageController@showBestItem',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\PageManageController@showBestItem',
        'as' => 'api.admin-front.v1.page-manage.show.best.item',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/page-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.page-manage.create.new.item' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/admin-front/v1/page-manage/{uuid}/create-new-item',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\PageManageController@createNewItem',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\PageManageController@createNewItem',
        'as' => 'api.admin-front.v1.page-manage.create.new.item',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/page-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.page-manage.delete.new.item' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/admin-front/v1/page-manage/{uuid}/delete-new-item',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\PageManageController@deleteNewItem',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\PageManageController@deleteNewItem',
        'as' => 'api.admin-front.v1.page-manage.delete.new.item',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/page-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.page-manage.show.new.item' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin-front/v1/page-manage/show-new-item',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\PageManageController@showNewItem',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\PageManageController@showNewItem',
        'as' => 'api.admin-front.v1.page-manage.show.new.item',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/page-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.site-manage.create.notice' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/admin-front/v1/site-manage/create-notice',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\SiteManageController@createNotice',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\SiteManageController@createNotice',
        'as' => 'api.admin-front.v1.site-manage.create.notice',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/site-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.site-manage.update.notice' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/admin-front/v1/site-manage/{noticeUUID}/update-notice',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\SiteManageController@updateNotice',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\SiteManageController@updateNotice',
        'as' => 'api.admin-front.v1.site-manage.update.notice',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/site-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.site-manage.delete.notice' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/admin-front/v1/site-manage/delete-notice',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\SiteManageController@deleteNotice',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\SiteManageController@deleteNotice',
        'as' => 'api.admin-front.v1.site-manage.delete.notice',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/site-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.site-manage.detail.notice' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin-front/v1/site-manage/{noticeUUID}/detail-notice',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\SiteManageController@detailNotice',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\SiteManageController@detailNotice',
        'as' => 'api.admin-front.v1.site-manage.detail.notice',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/site-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.site-manage.show.notice' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin-front/v1/site-manage/show-notice',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\SiteManageController@showNotice',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\SiteManageController@showNotice',
        'as' => 'api.admin-front.v1.site-manage.show.notice',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/site-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.user-manage.show.user' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin-front/v1/user-manage/show-user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\UserManageController@showUser',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\UserManageController@showUser',
        'as' => 'api.admin-front.v1.user-manage.show.user',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/user-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.user-manage.detail.user' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin-front/v1/user-manage/{uuid}/detail-user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\UserManageController@detailUser',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\UserManageController@detailUser',
        'as' => 'api.admin-front.v1.user-manage.detail.user',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/user-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.user-manage.update.user' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/admin-front/v1/user-manage/{uuid}/update-user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\UserManageController@updateUser',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\UserManageController@updateUser',
        'as' => 'api.admin-front.v1.user-manage.update.user',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/user-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.user-manage.create.user' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/admin-front/v1/user-manage/create-user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\UserManageController@createUser',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\UserManageController@createUser',
        'as' => 'api.admin-front.v1.user-manage.create.user',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/user-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.user-manage.delete.user' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/admin-front/v1/user-manage/{uuid}/delete-user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\UserManageController@deleteUser',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\UserManageController@deleteUser',
        'as' => 'api.admin-front.v1.user-manage.delete.user',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/user-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.user-manage.update.user.password' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/admin-front/v1/user-manage/{uuid}/update-user-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\UserManageController@updateUserPassword',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\UserManageController@updateUserPassword',
        'as' => 'api.admin-front.v1.user-manage.update.user.password',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/user-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'api.admin-front.v1.user-manage.update.user.phone.number' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/admin-front/v1/user-manage/{uuid}/update-user-phone-number',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\UserManageController@updateUserPhoneNumber',
        'controller' => 'App\\Http\\Controllers\\Api\\Admin\\v1\\UserManageController@updateUserPhoneNumber',
        'as' => 'api.admin-front.v1.user-manage.update.user.phone.number',
        'namespace' => 'admin\\v1',
        'prefix' => 'api/admin-front/v1/user-manage',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Front\\HomeController@home',
        'controller' => 'App\\Http\\Controllers\\Front\\HomeController@home',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'home',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);

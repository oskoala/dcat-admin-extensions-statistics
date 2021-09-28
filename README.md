# Dcat Admin Extension

## 安装方法

```
    composer require oskoala/statistics -vvv
```

## 使用方法

- resources\web.php 添加如下路由

```
//统计接口
Route::post("statistics", \OsKoala\Statistics\Http\Controllers\StatisticsController::class . '@api');

//需要统计功能的页面
Route::get("/", function () {
    return view("index");
});
```

- 修改 app\Http\Middleware\VerifyCsrfToken.php

```
<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'statistics', //添加这一行
    ];
}
```

- 页面添加统计js

```
<h2>index 访问已统计</h2>

<script src="/vendor/dcat-admin-extensions/oskoala/statistics/js/statistics.js"></script>
```

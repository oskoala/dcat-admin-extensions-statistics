<?php

namespace OsKoala\Statistics;

use Dcat\Admin\Extend\ServiceProvider;

class StatisticsServiceProvider extends ServiceProvider
{
    protected $js = [
        'js/index.js',
        'js/echart/echarts.min.js',
        'js/echart/world.js',
        'js/map.js',
    ];
    protected $css = [
        'css/index.css',
    ];
    protected $middleware = [
        'middle' => [
        ]
    ];

    // 定义菜单
    protected $menu = [
        [
            'title' => '访客统计',
            'uri'   => 'auth/statistics',
            'icon'  => '', // 图标可以留空
        ],
    ];

    public function register()
    {
        $this->app->register(\Jenssegers\Agent\AgentServiceProvider::class);
    }

    public function init()
    {
        parent::init();
        //
    }

    public function settingForm()
    {
        return new Setting($this);
    }
}

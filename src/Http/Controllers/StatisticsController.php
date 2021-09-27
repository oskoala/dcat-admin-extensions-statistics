<?php

namespace OsKoala\Statistics\Http\Controllers;

use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Admin;
use Dcat\Admin\Layout\Row;
use Illuminate\Http\Request;
use OsKoala\Statistics\Http\Services\StatisticsService;
use OsKoala\Statistics\Models\PageView;
use OsKoala\Statistics\Models\Session;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index(Content $content)
    {
        if (isset($_GET['day'])) {
            $days = $_GET['day'];
        } else {
            $days = 1;
        }
        $start     = now()->subDays($days);
        $end       = now();
        $countries = Session::query()->whereBetween("created_at", [$start, $end])->groupBy('country')->select([DB::raw("country as name"), DB::raw("count(*) as value")])->orderBy("value", "desc")->get();
        $urls      = PageView::query()->whereBetween("created_at", [$start, $end])->groupBy('url')->select([DB::raw("url as name"), DB::raw("count(*) as value")])->orderBy("value", "desc")->get();
        $referrers = PageView::query()->whereBetween("created_at", [$start, $end])->groupBy('referrer')->select([DB::raw("referrer as name"), DB::raw("count(*) as value")])->orderBy("value", "desc")->get();

        $browsers = Session::query()->whereBetween("created_at", [$start, $end])->groupBy('browser')->select([DB::raw("browser as name"), DB::raw("count(*) as value")])->orderBy("value", "desc")->get();
        $os       = Session::query()->whereBetween("created_at", [$start, $end])->groupBy('os')->select([DB::raw("os as name"), DB::raw("count(*) as value")])->orderBy("value", "desc")->get();
        $devices  = Session::query()->whereBetween("created_at", [$start, $end])->groupBy('device')->select([DB::raw("device as name"), DB::raw("count(*) as value")])->orderBy("value", "desc")->get();
        $screens  = Session::query()->whereBetween("created_at", [$start, $end])->groupBy('screen')->select([DB::raw("screen as name"), DB::raw("count(*) as value")])->orderBy("value", "desc")->get();
        return $content
            ->title('访问数据统计')
            ->description('萌芽科技技术支持')
            ->body(function (Row $row) use ($days, $countries, $urls, $referrers, $browsers, $os, $devices, $screens) {

                $row->column(12, function (Column $column) {
                    $column->row(Admin::view('os-koala.statistics::time-range'));
                });

                $row->column(12, function (Column $column) use ($urls, $days) {
                    $title  = "浏览量统计";
                    $names  = $this->getVisitorsCount($days)['names'];
                    $values = $this->getVisitorsCount($days)['values'];
                    $column->row(Admin::view('os-koala.statistics::bar', compact('title', 'names', 'values')));
                });

                $row->column(8, function (Column $column) use ($urls) {
                    $items = $urls;
                    $num   = 8;
                    $title = "页面访问排名";
                    $column->row(Admin::view('os-koala.statistics::table', compact('items', 'num', 'title')));
                });
                $row->column(4, function (Column $column) use ($referrers) {
                    $items = $referrers;
                    $num   = 8;
                    $title = "来源域名排名";
                    $column->row(Admin::view('os-koala.statistics::table', compact('items', 'num', 'title')));
                });

                $row->column(3, function (Column $column) use ($browsers) {
                    $items = $browsers;
                    $num   = 8;
                    $title = "浏览器";
                    $column->row(Admin::view('os-koala.statistics::table', compact('items', 'num', 'title')));
                });

                $row->column(3, function (Column $column) use ($os) {
                    $items = $os;
                    $num   = 8;
                    $title = "操作系统";
                    $column->row(Admin::view('os-koala.statistics::table', compact('items', 'num', 'title')));
                });
                $row->column(3, function (Column $column) use ($devices) {
                    $items = $devices;
                    $num   = 8;
                    $title = "设备";
                    $column->row(Admin::view('os-koala.statistics::table', compact('items', 'num', 'title')));
                });
                $row->column(3, function (Column $column) use ($screens) {
                    $items = $screens;
                    $num   = 8;
                    $title = "分辨率";
                    $column->row(Admin::view('os-koala.statistics::table', compact('items', 'num', 'title')));
                });

                $row->column(8, function (Column $column) use ($countries) {
                    $column->row(Admin::view('os-koala.statistics::map', compact('countries')));
                });
                $row->column(4, function (Column $column) use ($countries) {
                    $items = $countries;
                    $num   = 8;
                    $title = "国家访问排名";
                    $column->row(Admin::view('os-koala.statistics::table', compact('items', 'num', 'title')));
                });

            });
    }

    public function getVisitorsCount($num = 7)
    {
        $names  = [];
        $values = [];
        if ($num == 1) {
            $dis_num = 24;

            for ($i = 0; $i < $dis_num; $i++) {
                $start    = now()->subHours($i + 1);
                $end      = now()->subHours($i);
                $num      = PageView::query()->whereBetween("created_at", [$start, $end])->count();
                $names[]  = now()->subHours($i)->format("H") . ":00";
                $values[] = $num;
            }
        } else {
            $dis_num = $num;
            for ($i = 0; $i < $dis_num; $i++) {
                $start    = now()->subDays($i + 1);
                $end      = now()->subDays($i);
                $num      = PageView::query()->whereBetween("created_at", [$start, $end])->count();
                $names[]  = now()->subDays($i)->toDateString();
                $values[] = $num;
            }
        }
//        dd([
//            'names'  => $names,
//            'values' => $values,
//        ]);
        return [
            'names'  => array_reverse($names),
            'values' => array_reverse($values),
        ];
    }

    public function api(Request $request)
    {
        $service = new StatisticsService();
        $service->handle($request);
        return response()->json([
            "code"    => 200,
            "massage" => '',
            "data"    => []
        ]);
    }
}

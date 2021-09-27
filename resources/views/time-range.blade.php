<style>
</style>
<div class="card dcat-box" style="margin-top: 10px;">
    <div style="padding-bottom: 20px;padding-top: 20px;width: 100%;">
        <h4 style="float: left;margin-left: 20px">
            {{\OsKoala\Statistics\StatisticsServiceProvider::setting("title") ?? "考拉开源网站数据统计"}}
        </h4>
        <select id="time-range" class="form-control" style="width: 200px!important;float: right;margin-right: 30px">
            <option value="{{admin_url('auth/statistics/index?day=1')}}"
                    @if(isset($_GET['day']) && $_GET['day'] == 1) selected @endif>
                最近24小时
            </option>
            <option value="{{admin_url('auth/statistics/index?day=3')}}"
                    @if(isset($_GET['day']) && $_GET['day'] == 3) selected @endif
            >
                最近三天
            </option>
            <option value="{{admin_url('auth/statistics/index?day=7')}}"
                    @if(isset($_GET['day']) && $_GET['day'] == 7) selected @endif
            >
                最近7天
            </option>
            <option value="{{admin_url('auth/statistics/index?day=30')}}"
                    @if(isset($_GET['day']) && $_GET['day'] == 30) selected @endif
            >
                最近30天
            </option>
            <option value="{{admin_url('auth/statistics/index?day=90')}}"
                    @if(isset($_GET['day']) && $_GET['day'] == 90) selected @endif
            >
                最近90天
            </option>
        </select>
    </div>
</div>
<script>
    let time_range_select = document.getElementById("time-range");

    time_range_select.onchange = function () {
        let index = time_range_select.selectedIndex;
        let value = time_range_select.options[index].value;
        window.location.href = value
    }
</script>

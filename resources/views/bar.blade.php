@php
    $id = mt_rand();
@endphp
<script src="@os-koala.statistics"></script>
<div class="box Dcat_Admin_Widgets_Box" style="margin-top: 10px">
    <div class="box-header with-border">
        <h3 class="box-title">{{$title}}</h3>
    </div>
    <div class="box-body collapse show">
        <div id="{{$id}}" style="width: 100%;height:600px;"></div>
    </div>
</div>

<script>
    $(function () {
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('{{$id}}'));


        var values = {!! json_encode($values) !!};
        var names = {!! json_encode($names) !!};
        let option = {
            color: ['#3398DB'],
            tooltip: {
                trigger: 'axis',
                axisPointer: {            // 坐标轴指示器，坐标轴触发有效
                    type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis: [
                {
                    type: 'category',
                    data: names,
                    axisTick: {
                        alignWithLabel: true
                    }
                }
            ],
            yAxis: [
                {
                    type: 'value'
                }
            ],
            series: [

                {
                    name: '访问量',
                    type: 'bar',
                    barWidth: '40%',
                    data: values
                }
            ]
        };


        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    })

</script>

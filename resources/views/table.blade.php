<style>
    .table td {
        height: 20px !important;
    }
</style>
<div class="card dcat-box" style="margin-top: 10px">
    <div class="box-header with-border">
        <h3 class="box-title">{{$title}}</h3>
    </div>

    <div class="card-body table-responsive">
        <table class="custom-data-table dataTable table dt-checkboxes-select" id="grid-table">
            <tbody>
            @foreach($items as $index => $item)
                @if($index <= $num)
                    <tr>
                        <td>
                            @if(isset($item['name']) && $item['name'] != "")
                                {{$item['name']??"未知"}}
                            @else
                                未知
                            @endif
                        </td>
                        <td>
                            {{$item['value']}}
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
</div>

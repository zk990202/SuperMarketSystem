@extends('layouts.main')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">商品销售信息
                @if($type == 'day')
                    --过去一天
                @elseif($type == 'week')
                    --过去一周
                @elseif($type == 'month')
                    --过去一月
                @elseif($type == 'season')
                    --过去一季度
                @elseif($type == 'year')
                    --过去一年
                @endif
            </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <form method="post" action="{{ url('/excel/export') }}">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_desc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">商品编号</th>
                                    <th class="sorting_desc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">商品名称</th>
                                    <th class="sorting_desc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">商品品牌</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >价格</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >销售数量</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >销售金额</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >销售时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($result as $item)
                                    <tr role="row" class="odd">
                                        <td>{{ $item->pid }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->brand }}</td>
                                        <td>{{ $item->unitprice  }}</td>
                                        <td>{{ $item->allamount }}</td>
                                        <td>{{ $item->allprice }}</td>
                                        <td>{{ $item->new_time }}</td>
                                    </tr>
                                    <input type="hidden" name="pid[]" value="{{ $item->pid }}">
                                    <input type="hidden" name="name[]" value="{{ $item->name }}">
                                    <input type="hidden" name="brand[]" value="{{ $item->brand }}">
                                    <input type="hidden" name="unitprice[]" value="{{ $item->unitprice }}">
                                    <input type="hidden" name="allamount[]" value="{{ $item->allamount }}">
                                    <input type="hidden" name="allprice[]" value="{{ $item->allprice }}">
                                    <input type="hidden" name="new_time[]" value="{{ $item->new_time }}">
                                @endforeach
                                </tbody>
                            </table>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="box-footer">
                                <button id="submitButton" type="submit" class="btn btn-primary">导出Excel</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
@extends('layouts.main')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">下架的商品信息</h3>
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
                        <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_desc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">类别</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >名称</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >品牌</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >价格</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >数量</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >大小</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >颜色</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >适合人群</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >保质期截止日期</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >产地</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >下架原因</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($result as $item)
                                <tr role="row" class="odd">
                                    <td>{{ $item->category }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->brand }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td>
                                        @if($item->size)
                                            {{ $item->size }}
                                        @else
                                            无
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->color)
                                            {{ $item->color }}
                                        @else
                                            无
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->forcrowd)
                                            {{ $item->forcrowd }}
                                        @else
                                            无
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->date)
                                            {{ $item->date }}
                                        @else
                                            无
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->place)
                                            {{ $item->place }}
                                        @else
                                            无
                                        @endif
                                    </td>
                                    <td>
                                        <input type="text" name="reason[]" class="form-control" value="{{ $item->drop_off_reason }}" readonly>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
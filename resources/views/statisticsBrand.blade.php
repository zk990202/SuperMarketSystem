@extends('layouts.main')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">商品销售信息--按品牌统计</h3>
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
                        <form method="post" action="{{ url('/excel/export-brand') }}">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_desc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">商品品牌</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >销售总金额</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($result as $item)
                                    <tr role="row" class="odd">
                                        <td>{{ $item->brand }}</td>
                                        <td>{{ $item->all_price }}</td>
                                    </tr>
                                    <input type="hidden" name="brand[]" value="{{ $item->brand }}">
                                    <input type="hidden" name="all_price[]" value="{{ $item->all_price }}">
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
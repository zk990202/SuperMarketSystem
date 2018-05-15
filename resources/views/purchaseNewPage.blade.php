@extends('layouts.main')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">进货——添加新的商品</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form method="post" action="{{ url('/purchase-new') }}">
                <div class="box-body">
                    <div class="form-group">
                        <label for="category">类别</label>
                        <select class="form-control" name="category">
                            <option value="服装">服装</option>
                            <option value="食品">食品</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">名称</label>
                        <input type="text" class="form-control" name="name">
                    </div>

                    <div class="form-group">
                        <label for="brand">品牌</label>
                        <input type="text" class="form-control" name="brand">
                    </div>

                    <div class="form-group">
                        <label for="price">价格(售价)</label>
                        <input type="text" class="form-control" name="price">
                    </div>

                    <div class="form-group">
                        <label for="price">进价</label>
                        <input type="text" class="form-control" name="purchase_price">
                    </div>

                    <div class="form-group">
                        <label for="amount">数量</label>
                        <input type="text" class="form-control" name="amount">
                    </div>

                    <div class="form-group">
                        <label for="size">大小(服装)</label>
                        <input type="text" class="form-control" name="size">
                    </div>

                    <div class="form-group">
                        <label for="color">颜色(服装)</label>
                        <input type="text" class="form-control" name="color">
                    </div>

                    <div class="form-group">
                        <label for="for_crowd">适合人群(服装)</label>
                        <input type="text" class="form-control" name="for_crowd">
                    </div>

                    <div class="form-group">
                        <label for="date">保质期截止日期(食品)</label>
                        <input type="date" class="form-control" name="date">
                    </div>

                    <div class="form-group">
                        <label for="place">产地(食品)</label>
                        <input type="text" class="form-control" name="place">
                    </div>

                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-info">确认进货</button>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
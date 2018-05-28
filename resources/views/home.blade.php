@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">欢迎你，{{ $user->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    你已成功登入系统！

                </div>

                <div class="card-body">
                    @if($user->role == '1')
                        <button class="form-control"><a href="{{ url('/select-page/products') }}">查看商品信息</a></button>
                        <button class="form-control"><a href="{{ url('/select-page/sales') }}">查看销售信息</a></button>
                    @elseif($user->role == '2')
                        <button class="form-control"><a href="{{ url('/drop-off/select') }}">查看商品下架信息</a></button>
                        <button class="form-control"><a href="{{ url('/drop-off-page') }}">商品下架处理</a></button>
                        <div class="form-group">
                            <label for="statistics">统计商品销售信息</label>
                            <button class="form-control"><a href="{{ url('/statistics/day') }}">今天</a></button>
                            <button class="form-control"><a href="{{ url('/statistics/week') }}">本周</a></button>
                            <button class="form-control"><a href="{{ url('/statistics/month') }}">本月</a></button>
                            <button class="form-control"><a href="{{ url('/statistics/season') }}">本季度</a></button>
                            <button class="form-control"><a href="{{ url('/statistics/year') }}">今年</a></button>
                            <button class="form-control"><a href="{{ url('/statistics/brand') }}">按品牌统计</a></button>
                        </div>
                    @elseif($user->role == '3')
                        <div class="form-group">
                            @if($user->receive_request)
                                <p class="form-control">
                                    <font color="red">收到采购请求!!</font>
                                </p>
                            @else
                                <p class="form-control">暂无采购请求</p>
                            @endif
                            <button class="form-control"><a href="{{ url('/purchase-page') }}">查看缺货的商品</a></button>
                            <button class="form-control"><a href="{{ url('/purchase-new-page') }}">进购新的商品</a> </button>
                        </div>
                    @elseif($user->role == '4')
                        <button class="form-control"><a href="{{ url('/sale-page') }}">购买商品</a></button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

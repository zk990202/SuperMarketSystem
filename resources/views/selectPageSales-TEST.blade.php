@extends('layouts.main')

@section('content')
    <form method="post" action="{{url('select/sales')}}">
        <div class="form-group">
            <label for="category">类别</label>
            <select class="form-control" name="category">
                @foreach($category as $item)
                    <option value="{{ $item->category }}">{{ $item->category }}</option>
                @endforeach
            </select>

            <label for="name">名称</label>
            <select class="form-control" name="name">
                <option selected value="">--(空)--</option>
                @foreach($name as $item)
                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                @endforeach
            </select>

            <label for="brand">品牌</label>
            <select class="form-control" name="brand">
                <option selected value="">--(空)--</option>
                @foreach($brand as $item)
                    <option value="{{ $item->brand }}">{{ $item->brand }}</option>
                @endforeach
            </select>

            <label for="size">大小(服装)</label>
            <select class="form-control" name="size">
                <option selected value="">--(空)--</option>
                @foreach($size as $item)
                    <option value="{{ $item->size }}">{{ $item->size }}</option>
                @endforeach
            </select>

            <label for="color">颜色(服装)</label>
            <select class="form-control" name="color">
                <option selected value="">--(空)--</option>
                @foreach($color as $item)
                    <option value="{{ $item->color }}">{{ $item->color }}</option>
                @endforeach
            </select>

            <label for="for_crowd">适合人群(服装)</label>
            <select class="form-control" name="for_crowd">
                <option selected value="">--(空)--</option>
                @foreach($for_crowd as $item)
                    <option value="{{ $item->forcrowd }}">{{ $item->forcrowd }}</option>
                @endforeach
            </select>

            <label for="date">保质期截止日期(食品)</label>
            <select class="form-control" name="date">
                <option selected value="">--(空)--</option>
                @foreach($date as $item)
                    <option value="{{ $item->date }}">{{ $item->date }}</option>
                @endforeach
            </select>

            <label for="place">产地(食品)</label>
            <select class="form-control" name="place">
                <option selected value="">--(空)--</option>
                @foreach($place as $item)
                    <option value="{{ $item->place }}">{{ $item->place }}</option>
                @endforeach
            </select>

            <label for="startTime">起始日期</label>
            <input class="form-control" type="date" name="startTime" value="{{ date('Y-m-d') }}">

            <label for="endTime">截止日期</label>
            <input class="form-control" type="date" name="endTime" value="{{ date('Y-m-d') }}">

            {{ csrf_field() }}
            <button type="submit" class="btn btn-info">查看销售信息</button>
        </div>
    </form>

@endsection